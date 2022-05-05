<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\View\View;
use App\Mail\OrderSucceded;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Repositories\OrderRepo;
use Illuminate\Http\JsonResponse;
use App\Repositories\ProductRepo;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\OrderFormRequest;

class BusketController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $totalAmount = session()->get('totalAmount');
        $totalAmount? session()->put('totalAmount', $totalAmount+1): session()->put('totalAmount', 1);
        $totalSumma = session()->get('totalSumma');
        $totalSumma? session()->put('totalSumma', $totalSumma+ $request->price): session()->put('totalSumma', $request->price);
        $busketContent = session('busketContent')?? [];
        $itemAmount = Arr::get($busketContent, (int)$request->id, 0);
        Arr::set($busketContent, $request->id, ++$itemAmount);
        session()->put('busketContent', $busketContent);

        return response()->json([
            "totalAmount" => session('totalAmount'),
            "totalSumma" =>session('totalSumma'),
            "success"=> true,
            "busket" =>session('busketContent')
        ]);
    }

    public function show(ProductRepo $productRepo): View
    {
        $keys = @array_keys(session('busketContent'));

        $content = $productRepo->findItems($keys);

        return view('custom.modalWindow.bigBusketContent')->with('content', $content );
    }

    public function update(ProductRepo $productRepo): View
    {
        $busketContent = [];
        $products = request('busketContent');

        foreach($products as $key => $value){
           $amount = (int)$value;
           if(is_numeric($key) AND $amount >0){ $busketContent[$key]= $amount ;}
        }

        session()->put('busketContent', $busketContent);
        //get totalAmount and totalSumma
        session()->put('totalAmount', array_sum($busketContent));
        $totalSumma = 0;
        foreach ($busketContent as $key => $amount){
            $price = $productRepo->getPrice($key);
            $totalSumma+= $price*$amount;
        }
        session()->put('totalSumma', $totalSumma);

        return $this->show($productRepo);
    }

    public function updateHeader(): JsonResponse
    {
        return response()->json([
            "totalAmount" => session('totalAmount'),
            "totalSumma" =>session('totalSumma'),
            "success"=> true,
            "busket" =>session('busketContent')
        ]);
    }

    public function showOrderForm(): View
    {
        return view('custom.modalWindow.orderForm');
    }

    public function validateBusketContent(): JsonResponse
    {
        //$busketContent = request()->all();
        $busketContent = request('busketContent');
        $errors =[];
        foreach ($busketContent as $key => $value){
            if( is_numeric($key) AND ($value<1 OR !is_numeric($value))) $errors[] = $key;
        }

        if(!empty($errors)) {
            return response()->json(["fail" => true, "errors"=>$errors ]);
        }

        return response()->json(["success"=> true, ]);
    }

    public function makeOrder(OrderFormRequest $orderFormRequest, OrderRepo $orderRepo): JsonResponse
    {
        $validated = $orderFormRequest->validated();
        $order['totalAmount'] = session()->get('totalAmount');
        $order['totalSumma'] = session()->get('totalSumma');
        $order['busketContent'] = [];
        $content = session('busketContent');

        foreach ($content as $key => $value) {
            $product = Product::find($key);
            $order['busketContent'][$product->title] = $value;
        }

        session()->put('totalAmount', 0);
        session()->put('totalSumma', 0);
        session()->put('busketContent', []);

        $orderRepo->create($validated, $order);

        Mail::to(request()->email)->send(new OrderSucceded($order));

        return response()->json([
            "totalAmount" => session('totalAmount'),
            "totalSumma" => session('totalSumma'),
            "success" => true,
            "busket" => session('busketContent'),
            "email" => $validated['email'],
            "order" => $order
        ]);
    }

    public function succeededOrder(): View
    {
        return view('custom.partials.succeededOrder');
    }
}
