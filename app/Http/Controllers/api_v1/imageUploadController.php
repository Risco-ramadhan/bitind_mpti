<?php

namespace App\Http\Controllers\api_v1;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ImageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class imageUploadController extends Controller
{
    public static function uploads(Request $request)
    {
        if (!$request->hasFile('image_reference')) {
            return false;
        }
        // dd($request);

        $allowedfileExtension = ['pdf', 'jpg', 'png'];
        $files = $request->file('image_reference');
        $errors = [];


        $image = new Image();
        $image->save();

        foreach ($files as $file) {

            $extension = $file->getClientOriginalExtension();
            
            $check = in_array($extension, $allowedfileExtension);
            
            if ($check) {
                foreach ($request->image_reference as $mediaFiles) {
                    $name = $file->getClientOriginalName();
                    
                    $path = $mediaFiles->store('images');

                    //store image file into directory and db
                    $imageDetail = new ImageDetail();
                    $imageDetail->image_id = $image->id;
                    $imageDetail->title = $name;
                    $imageDetail->path = $path;
                    $imageDetail->save();
                }
            } else {
                $data = array('status' => false, 'data' => null );
                return $data;
            }
            $data = array('status' => true, 'data' => $image->id);
            return $data; 
        }


        // foreach ($files as $file) {

        //     $extension = $file->getClientOriginalExtension();

        //     $check = in_array($extension, $allowedfileExtension);

        //     if ($check) {
        //         foreach ($request->fileName as $mediaFiles) {

        //             $path = $mediaFiles->store('public/assets/images');
        //             $name = $mediaFiles->getClientOriginalName();

        //             //store image file into directory and db
        //             $save = new Image();
        //             $save->title = $name;
        //             $save->path = $path;
        //             $save->save();
        //         }
        //     } else {
        //         return false;
        //     }

        //     return true;
        // }

    }
}
