<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\Request;
use Image;

class PictureController extends Controller
{
    public function index(){
        $pictures = Picture::orderby('created_at', 'desc')->get();
        return view('backend.image.index', compact('pictures'));
    }

    public function create(){
        return view('backend.image.create');
    }

    public function store(Request $request){
        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ], [
            'images.required' => 'Please select images',
            'images.mimes' => 'Please select valid image',
            'images.max' => 'Upload image within 2MB'
        ]);


        if($request->has('images')) {
            foreach($request->file('images') as $image) {
                $name = time() . '-' . time() . '-' . rand(0, 999999999) . '.' . $image->extension();
                $thumbnailImage = Image::make($image);
                $smallImage = Image::make($image);

                Image::make($image)->save(public_path('static/images/full/') . $name);

                $thumbnailImage->save(public_path('static/images/thumb/') . $name);
                $thumbnailImage->resize(300, 300);
                $thumbnailImage->save(public_path('static/images/thumb/') . $name);

                $smallImage->save(public_path('static/images/small/') . $name);
                $smallImage->resize(65, 65);
                $smallImage->save(public_path('static/images/small/') . $name);

                $image_title = $name;
                $image_alt = $name;
                $image_full = 'static/images/full/' . $name;
                $image_thumb = 'static/images/thumb/' . $name;
                $image_small = 'static/images/small/' . $name;


                $image = new Picture;
                $image->image_title = $image_title;
                $image->image_alt = $image_alt;
                $image->image_full = $image_full;
                $image->image_thumb = $image_thumb;
                $image->image_small = $image_small;
                $image->save();
            }
        }

        return redirect()->back();
    }
}
