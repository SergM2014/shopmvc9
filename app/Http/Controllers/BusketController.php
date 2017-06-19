<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Product;
use App\Mail\OrderSucceded;


class BusketController extends Controller
{
    public function add(Request $request)
    {
        $totalAmount = session()->get('totalAmount');

        $totalAmount? session()->put('totalAmount', $totalAmount+1): session()->put('totalAmount', 1);

        $totalSumma = session()->get('totalSumma');

        $totalSumma? session()->put('totalSumma', $totalSumma+ $request->price): session()->put('totalSumma', $request->price);

        $busketContent = session('busketContent')?? [];

        $itemAmount = array_get($busketContent, $request->id, 0);

        array_set($busketContent, $request->id, ++$itemAmount);
        session()->put('busketContent', $busketContent);


        return response()->json([
            "totalAmount" => session('totalAmount'),
            "totalSumma" =>session('totalSumma'),
            "success"=> true,
            "busket" =>session('busketContent')
        ]);

    }

    public function show()
    {
        $keys = @array_keys(session('busketContent'));

        $content = Product::find($keys);

       return view('custom.modalWindow.bigBusketContent')->with('content', $content );
    }

    public function update()
    {
        $busketContent = [];
        $products = request()->all();


       foreach($products as $key => $value){
           $amount = (int)$value;
           if(is_numeric($key) AND $amount >1){ $busketContent[$key]= $amount ;}
       }
       session()->put('busketContent', $busketContent);


        $keys = @array_keys(session('busketContent'));

        $content = Product::find($keys);

        //get totalAmount and totalSumma
        session()->put('totalAmount', array_sum($busketContent));

        $totalSumma= 0;

        foreach ($busketContent as $key => $amount){
            $price = Product::find($key)->price;

            $totalSumma+= $price*$amount;
        }

       session()->put('totalSumma', $totalSumma);

        return $this->show();

    }

    public function updateHeader()
    {
        return response()->json([
            "totalAmount" => session('totalAmount'),
            "totalSumma" =>session('totalSumma'),
            "success"=> true,
            "busket" =>session('busketContent')
        ]);
    }

    public function showOrderForm()
    {
        return view('custom.modalWindow.orderForm');
    }


    public function validateBusketContent()
    {

        $busketContent = request()->all();

        $errors =[];

        foreach ($busketContent as $key => $value){
            if( is_numeric($key) AND ($value<1 OR !is_numeric($value))){
                $errors[] = $key;
            }
        }

        if(!empty($errors)) {
            return response()->json([
                "fail" => true,
                "errors"=>$errors
            ]);
        }

        return response()->json([

            "success"=> true,

        ]);
    }


    public function makeOrder()
    {
        $this->validate(request(), [
            'name' => 'min:6',
            'email' => 'email'
        ]);

//hide modal previous modal window with busket+
        //to zeroise the small busket vriables and refresh them in view+
        //show modal window description of success+
        //send a letter

      //  $order['busketContent'] = session('busketContent');
        $order['totalAmount'] = session()->get('totalAmount');
        $order['totalSumma'] = session()->get('totalSumma');
        $order['busketContent'] =[];
        foreach (session('busketContent') as $key => $value) {

            $product = Product::find($key);

            $order['busketContent'][$product->title] = $value;
        }

        session()->put('totalAmount', 0);
        session()->put('totalSumma', 0);
        session()->put('busketContent', []);

        \Mail::to(request()->email)->send(new OrderSucceded($order));
        return $this->updateHeader();

    }

    public function succeededOrder()
    {
        return view('custom.partials.succeededOrder');
    }






}
