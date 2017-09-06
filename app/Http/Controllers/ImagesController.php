<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;


class ImagesController extends Controller
{
    public function uploadAvatar (Request $request)
    {
        $image = $request->file('file');
        $filename = time().'_'.strtolower($image->getClientOriginalName());

        $destinationPath = public_path('uploads/avatars');
        $img = Image::make($image->getRealPath());
        $img->resize(110, 110)->save($destinationPath.'/'.$filename);


        return response()->json([
            'message' => 'file is uploaded',
            'success' => 'true',
            'filename' =>$filename

        ]);
    }

    public function deleteAvatar ()
    {


        return response()->json([
            'message' => 'file is deleted',
            'success' => 'true'
        ]);
    }


    public function uploadProductImage (Request $request)
    {
        $image = $request->file('file');
        $filename =  time().'_'.strtolower($image->getClientOriginalName());

        $destinationPath = public_path('uploads/productsImages');
        $img = Image::make($image->getRealPath());
        $img->resize(250, 250)->save($destinationPath.'/tn_'.$filename);


       $path = $image->storeAs(
           'productsImages', $filename );



        return response()->json([
            'message' => 'file is uploaded',
            'success' => 'true',
            'filename' => $filename,
            'path' => $path,


        ]);
    }


    public function deleteProductImage ()
    {
        $image =request('image');

        unlink (public_path('uploads/productsImages/'.$image));
        unlink (public_path('uploads/productsImages/tn_'.$image));

        return response()->json([
            'message' => 'file is deleted',
            'success' => 'true',
            'image' => $image
        ]);
    }

}
