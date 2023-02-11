<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Picture;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{
    public function index(Request $request){
        $categories = Category::select('id', 'category_name')->orderby('id', 'ASC')->get();
        if($request->category_id == null || $request->category_id == 'all') {
            $products = Product::get();
        }
        else{
            $products = Product::where('category_id', $request->category_id)->get();
        }
        return view('backend.product.index', compact('products', 'categories'));
    }

    public function create(){
        $categories = Category::active()->select('id', 'category_name')->get();
        return view('backend.product.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'category_id' => 'required|not_in:0',
            'product_name' => 'required|unique:products',
            'product_mrp_price' => 'required',
            'product_current_price' => 'required|lte:product_mrp_price'
        ],[
            'category_id.required' => 'Category is required',
            'category_id.not_in' => 'Category is required',
            'product_name.required' => 'Product name is required',
            'product_name.unique' => 'Product already exists',
            'product_mrp_price.required' => 'Product MRP is required',
            'product_current_price.required' => 'Product Current Price is required',
            'product_current_price.lte' => 'Current Price should be less than MRP Price'
        ]);

        $product_name = $request->product_name;
        $product_summary = strip_tags($request->product_summary, '<br>, <p>, <a>, <h1>, <h2>, <h3>,<h4>,<h5>,<h6>, <b>, <i>, <u>,<strong>, <em>, <img>, <ul>, <ol>, <li>,<iframe>, <embed>');
        $product_details = strip_tags($request->product_details, '<br>, <p>, <a>, <h1>, <h2>, <h3>,<h4>,<h5>,<h6>, <b>, <i>, <u>,<strong>, <em>, <img>, <ul>, <ol>, <li>,<iframe>, <embed>');

        /*$is_gst = $request->no_gst == 1 ? 1 : 0;

        if($is_gst == 0) {
            $m_tax = 100 + $request->tax_rate;
            $unit_price = $request->product_current_price * 100 / $m_tax;
            $tax_amount = $request->product_current_price - $unit_price;
            $tax_rate = $request->tax_rate;
        }
        else{
            $unit_price = $request->product_current_price;
            $tax_amount = 0;
            $tax_rate = 0;
        }*/
        $unit_price = $request->product_current_price;
        $tax_amount = 0;
        $tax_rate = 0;

        if($request->product_mrp_price != $request->product_current_price) {
            $productDiscount = (($request->product_mrp_price - $request->product_current_price) / $request->product_mrp_price) * 100;
        }
        else{
            $productDiscount = null;
        }

        $data = [
            'category_id' => $request->category_id,
            'hsn_no' => $request->hsn_no,
            'product_name' => $product_name,
            'product_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $product_name))).'-'.rand(0,999999999),
            'product_summary' => $product_summary,
            'product_details' => $product_details,
            'product_mrp_price' => $request->product_mrp_price,
            'product_current_price' => $request->product_current_price,
            'product_discount' => $productDiscount,
            'unit_price' => $unit_price,
            'net_amount' => $unit_price,
            'tax_rate' => $tax_rate,
            'tax_amount' => $tax_amount,
            'combo_discount' => 0,
            'stock_status' => $request->stock_status
        ];

        $product = Product::create($data);

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

        $product->update(['product_dp' => $pictureId]);

        return redirect()->back()->with('success', 'updated');
    }

    public function show($id){
        $product = Product::findorFail($id);

        $categories = Category::get();
        $allproducts = Product::where('id', '!=', $id)->get();
        return view('backend.product.show', compact('product', 'categories', 'allproducts'));
    }

    public function update(Request $request){
        $request->validate([
            'category_id' => 'required|not_in:0',
            'product_name' => 'required',
            'product_mrp_price' => 'required',
            'product_current_price' => 'required|lte:product_mrp_price'
        ],[
            'category_id.required' => 'Category is required',
            'product_name.required' => 'Product name is required',
            'product_name.unique' => 'Product already exists',
            'product_mrp_price.required' => 'Product MRP is required',
            'product_current_price.required' => 'Product Current Price is required',
            'product_current_price.lte' => 'Current Price should be less than MRP Price'
        ]);

        $product_name = $request->product_name;
        $product_summary = strip_tags($request->product_summary, '<br>, <p>, <a>, <h1>, <h2>, <h3>,<h4>,<h5>,<h6>, <b>, <i>, <u>,<strong>, <em>, <img>, <ul>, <ol>, <li>,<iframe>, <embed>');
        $product_details = strip_tags($request->product_details, '<br>, <p>, <a>, <h1>, <h2>, <h3>,<h4>,<h5>,<h6>, <b>, <i>, <u>,<strong>, <em>, <img>, <ul>, <ol>, <li>,<iframe>, <embed>');

        $product = Product::findorFail($request->id);

        if($product_name == $product->product_name){
            $product_slug = $request->product_slug;
        }
        else{
            $product_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $product_name))).'-'.rand(0,999999999);
        }

        /*$m_tax = 100 + $request->tax_rate;
        $unit_price = $request->product_current_price * 100 / $m_tax;
        $tax_amount = $request->product_current_price - $unit_price;*/

        $unit_price = $request->product_current_price;
        $tax_amount = 0;
        $tax_rate = 0;

        $productDiscount = (($request->product_mrp_price - $request->product_current_price)/$request->product_mrp_price) * 100;

        $product->update([
            'category_id' => $request->category_id,
            'hsn_no' => $request->hsn_no,
            'product_name' => $product_name,
            'product_slug' => $product_slug,
            'product_summary' => $product_summary,
            'product_details' => $product_details,
            'product_mrp_price' => $request->product_mrp_price,
            'product_current_price' => $request->product_current_price,
            'product_discount' => $productDiscount,
            'unit_price' => $unit_price,
            'net_amount' => $unit_price,
            'tax_rate' => $tax_rate,
            'tax_amount' => $tax_amount,
            'stock_status' => $request->stock_status,
            'status' => $request->status
        ]);

        /*$picture_orders = $request->picture_orders;

        $image_ids = $request->image_ids;

        $i=0;
        foreach($image_ids as $image_id){
            ProductImage::where('id', $image_id)->update(['picture_order' => $picture_orders[$i]]);
            $i++;
        }*/

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
            $pictureId = $product->product_dp;
        }

        $product->update(['product_dp' => $pictureId]);

        return redirect()->back()->with('success', 'Uploaded successfully');
    }

    public function productPictures(Request $request){
        if($request->hasFile('upload')) {
            $product = Product::findorFail($request->id);

            foreach ($request->file('upload') as $image) {
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

                $picId = $image->id;

                $product->productPictures()->attach($picId);
            }
            return redirect()->back()->with('success', 'Image uploaded');
        }
        else{
            return redirect()->back()->with('error', 'Please select Image');
        }
    }

    public function deletePicture($picid, $productid){
        $product = Product::findorFail($productid);
        $product->productPictures()->detach($picid);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
