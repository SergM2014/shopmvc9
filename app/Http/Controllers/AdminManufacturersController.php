<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manufacturer;

class AdminManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::all();

        return view('admin.manufacturers.index', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>'required|min:6',
        ]);

        Manufacturer::create(['eng_translit_title'=> request('title'), 'title' => request('title'),
            'url'=> '/'.request('title')]);

        return redirect('/admin/manufacturers/succeeded')->with('status', 'Manufacturer Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>'required|min:6',
        ]);

        $manufacturer = Manufacturer::find($id);
        $manufacturer::where('id', $id)->update(['eng_translit_title' => request('title'), 'title' => request('title'), 'url'=> '/'.request('title') ]);
        return redirect('/admin/manufacturers/succeeded')->with('status', 'Manufacturer Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manufacturer::destroy($id);
        return redirect('/admin/manufacturers/succeeded')->with('status', 'Manufacturer deleted!');
    }

    public function showConfirmWindow()
    {



        return view('admin.modal.deleteManufacturer');
    }
}
