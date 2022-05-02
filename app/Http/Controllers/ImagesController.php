<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ImagesController extends Controller
{

    public function uploadAvatar (Request $request): JsonResponse
    {
        $image = $request->file('file');
        $filename = time().'_'.strtolower($image->getClientOriginalName());
        $destinationPath = public_path('uploads/avatars');
        $img = $this->getImage($image);
        $img->resize(110, 110)->save($destinationPath.'/'.$filename);

        return response()->json([
            'message' => 'file is uploaded',
            'success' => 'true',
            'filename' =>$filename
        ]);
    }

    public function deleteAvatar(): JsonResponse
    {
        return response()->json(['message' => 'file is deleted', 'success' => 'true']);
    }

    public function uploadProductImage (Request $request): JsonResponse
    {
        $image = $request->file('file');
        $filename =  time().'_'.strtolower($image->getClientOriginalName());

        $destinationPath = public_path('uploads/productsImages');
        $img = $this->getImage($image);
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

    public function deleteProductImage(): JsonResponse
    {
        $image = request('image');

        @unlink (public_path('uploads/productsImages/'.$image));
        @unlink (public_path('uploads/productsImages/tn_'.$image));

        return response()->json([
            'message' => 'file is deleted',
            'success' => 'true',
            'image' => $image
        ]);
    }

    protected function getImage($image)
    {
        return Image::make($image->getRealPath());
    }
}
