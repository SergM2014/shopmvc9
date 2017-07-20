<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;


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

}
