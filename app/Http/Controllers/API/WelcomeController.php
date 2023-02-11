<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Page;
use App\Models\Picture;
use App\Models\PostalZip;
use App\Models\SellDevice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class WelcomeController extends Controller
{

    /*public function getUserAddress(Request $request){
        $user = User::where('id', $request->id)->first();
        $addresses = $user->user_addresses;
        return $addresses;
    }*/

    public function getdeliveryDetails(Request $request){
        $address = Address::where('id', $request->id)->first();
        $postalZip = PostalZip::where('zip_code', $address->zip)->first();

        if(!$postalZip){
            $response = [
                'zip_available' => 0,
                'is_cod' => 0,
                'is_delivery' => 0
            ];
        }
        else{
            $response = [
                'zip_available' => 1,
                'is_cod' => $postalZip->is_cod == 'YES' ? 1 : 0,
                'is_delivery' => $postalZip->is_delivery == 'YES' ? 1 : 0,
            ];
        }
        return $response;
    }

    public function allImages(){
        $pictures = Picture::where('status', 'ACTIVE')->get();
        return $pictures;
    }

    public function imagedetails(Request $request){
        $picture = Picture::where('id', $request->id)->first();
        return $picture;
    }

    public function updateImagedetails(Request $request){
        $picture = Picture::where('id', $request->id)->first();

        $updatePicture = $picture->update([
            'image_title' => $request->title,
            'image_alt' => $request->alt
        ]);

        $response = [
            'id' => $picture->id,
            'image_title' => $request->title,
            'image_alt' => $request->alt
        ];

        if($updatePicture){
            return response(['message' => 'Saved successfully', 'response' => $response]);
        }
        else{
            return response(['message' => 'Something went wrong', 'response' => $response]);
        }
    }

    public function getCategoryTaxRate(Request $request){
        $category_id = $request->category_id;

        $category = Category::select('tax_rate')->where('id', $category_id)->first();

        return $category;
    }

    public function DeviceuploadPicture(Request $request){
        //return $request->all();

        $validator = Validator::make($request->all(),
            [
                'images' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ], [
                'images.required' => 'Please select images',
                'images.mimes' => 'Please select valid image',
                'images.max' => 'Upload image within 2MB'
            ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }

        if($request->has('images')) {

            $image = $request->file('images');
            $name = time() . '-' . time() . '-' . rand(0, 999999999) . '.' . $image->extension();

            $thumbnailImage = Image::make($image);
            $smallImage = Image::make($image);

            Image::make($request->file('images'))->save(public_path('static/images/full/') . $name);

            $thumbnailPath = public_path('static/images/thumb/');
            $smallPath = public_path('static/images/small/');
            $originalPath = public_path('static/images/full/');

            $thumbnailImage->save(public_path('static/images/thumb/') . $name);
            /*$thumbnailImage->resize(300, 300, function($constraint) {
                $constraint->aspectRatio();
            });*/
            $thumbnailImage->fit(300);
            $thumbnailImage->save(public_path('static/images/thumb/') . $name);

            $smallImage->save(public_path('static/images/small/') . $name);
            /*$smallImage->resize(65, 65, function ($constraint) {
                $constraint->aspectRatio();
            });*/
            $smallImage->fit(65);
            $smallImage->save(public_path('static/images/small/') . $name);


            $image_title = $name;
            $image_alt = $name;
            $image_full = 'static/images/full/' . $name;
            $image_thumb = 'static/images/thumb/' . $name;
            $image_small = 'static/images/small/' . $name;

            $picture = new Picture;
            $picture->image_title = $image_title;
            $picture->image_alt = $image_alt;
            $picture->image_full = $image_full;
            $picture->image_thumb = $image_thumb;
            $picture->image_small = $image_small;
            $picture->save();

            $sellDevice = SellDevice::where('id', $request->id)->first();

            $sellDevice->sellDevicePictures()->attach($picture->id);

            return response()->json('success');
        }
        else{
            return response()->json('failed');
        }


        /*if($request->has('images')) {
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
            return response()->json('success');
        }
        else{
            return response()->json('failed');
        }*/
    }
}
