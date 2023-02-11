<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sliders = Slider::select('id', 'picture_id')->get();
        return view('backend.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('upload')) {
            $image = $request->file('upload');

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

            $pictureId = $image->id;
        }
        else{
            $pictureId = Picture::getDefaultImage()->id;
        }

        $slider = new Slider;
        $slider->picture_id = $pictureId;
        $slider->save();

        return redirect()->back()->with('success', 'Updated');
    }


    public function show($id)
    {
        $slider = Slider::findorfail($id);
        return view('backend.slider.show', compact('slider'));
    }

    public function update(Request $request)
    {
        $slider = Slider::findorfail($request->id);

        if($request->hasFile('upload')) {
            $image = $request->file('upload');

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

            $pictureId = $image->id;
        }
        else{
            $pictureId = $slider->SliderPicture->id;
        }

        $updateSlider = $slider->update([
            'picture_id' => $pictureId,
            'status' => $request->status
        ]);
        if($updateSlider) {
            return redirect()->back()->with('success', 'Updated');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function delete($id)
    {
        $slider = Slider::findorFail($id);
        $slider->delete();

        return redirect('admin/sliders')->with('success', 'Deleted successfully');
    }
}
