<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Seo;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::select('id', 'parent_id', 'category_name', 'category_image_thumb', 'tax_rate')->get();
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        return view('backend.category.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required',
            'category_name' => 'required'
        ],[
            'parent_id.required' => 'Parent Category is required',
            'category_name.required' => 'Category name is required',
        ]);

        if ($request->hasFile('upload')) {
            $this->validate($request, [
                'upload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:300'
            ],[
                'upload.max' => 'Please select image within 300KB'
            ]);

            $upload = $request->file('upload');
            $imageName = date('his').'-'.date('his').'-'.date('his').'.'.request()->upload->getClientOriginalExtension();
            $upload->move('static/images/full/', $imageName);
            $cat_pic = 'static/images/full/'.$imageName;
        }
        else{
            $cat_pic = Picture::getDefaultImage()->image_thumb;
        }

        //$tax_rate = $request->tax_rate == "" ? 0 : $request->tax_rate;

        $category = new Category;
        $category->parent_id = $request->parent_id;
        $category->category_name = $request->category_name;
        $category->category_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name)));
        $category->category_image_full = $cat_pic;
        $category->category_image_thumb = $cat_pic;
        $category->tax_rate = 0;
        $category->status = $request->status;
        $category->save();


        return redirect()->back()->with('success', 'Updated');
    }


    public function show($id)
    {
        $category = Category::findorfail($id);
        $parentCategories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        return view('backend.category.show', compact('category', 'parentCategories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ],[
            'category_name.required' => 'Category name is required'
        ]);

        $category = Category::findorFail($request->id);

        if ($request->hasFile('upload')) {
            $this->validate($request, [
                'upload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:300'
            ],[
                'upload.max' => 'Please select image within 300KB'
            ]);

            $upload = $request->file('upload');
            $imageName = date('his').'-'.date('his').'-'.date('his').'.'.request()->upload->getClientOriginalExtension();
            $upload->move('static/images/full/', $imageName);
            $cat_pic = 'static/images/full/'.$imageName;
        }
        else{
            $cat_pic = $category->category_image_full;
        }

        if($request->category_name != $category->category_name){
            $category_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name)));
        }
        else{
            $category_slug = $category->category_slug;
        }

        //$tax_rate = $request->tax_rate == "" ? 0 : $request->tax_rate;

        $updateCategory = $category->update([
            'parent_id' => $request->parent_id,
            'category_name' => $request->category_name,
            'category_slug' => $category_slug,
            'category_image_full' => $cat_pic,
            'category_image_thumb' => $cat_pic,
            'tax_rate' => 0,
            'status' => $request->status
        ]);

        $products = Product::where('category_id', $request->id)->get();
        foreach($products as $product){
            $m_tax = 100 + $tax_rate;
            $unit_price = $product->product_current_price * 100 / $m_tax;
            $tax_amount = $product->product_current_price - $unit_price;
            $product->update([
                'unit_price' => $unit_price,
                'net_amount' => $unit_price,
                'tax_rate' => $tax_rate,
                'tax_amount' => $tax_amount
            ]);
        }
        return redirect()->back()->with('success', 'Updated');
    }


    public function delete($id)
    {
        $category = Category::findorFail($id);
        $category->delete();

        return redirect('admin/categories')->with('success', 'Deleted successfully');
    }

    public function categorySEOupdate(Request $request){
        $category = Category::findorFail($request->id);

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
            $pictureFull = $image_full;
        }
        else{
            $pictureId = null;
            $pictureFull = null;
        }

        $updateData = Seo::updateOrCreate(
            [
                'category_id' => $category->id,
            ],
            [
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'og_title' => $request->og_title,
                'og_description' => $request->og_description,
                'og_image' => $pictureFull,
                'image_id' => $pictureId
            ]
        );

        if($updateData){
            return redirect()->back()->with('success', 'Updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
