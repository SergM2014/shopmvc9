<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusketController extends Controller
{
    public function add(Request $request)
    {
        //add +1 totalItem
        //add +sum total sum

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
}
