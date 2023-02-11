<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $prods = Product::select('id', 'category_id', 'product_dp', 'product_name')
            ->orderBy('id', 'DESC')
            ->get();

        if (count($prods) > 0) {
            $products = [];
            foreach ($prods as $prod) {
                $products[] = [
                    'id' => $prod->id,
                    'category_id' => $prod->category_id,
                    'product_name' => $prod->product_name,
                    'product_dp' => asset($prod->productDPImage->image_thumb)
                ];
            }
            return response()->json(['success' => $products], 200);
        } else {
            return response()->json(['error' => 'No Product Found'], 200);
        }
    }

    public function show($id){
        $prod = Product::select('id', 'category_id', 'product_dp', 'product_name', 'status')
            ->where('id', $id)
            ->first();

        if ($prod) {
            $product = [
                'id' => $prod->id,
                'category_id' => $prod->category_id,
                'product_name' => $prod->product_name,
                'category_image_thumb' => asset($prod->productDPImage->image_thumb),
                'status' => $prod->status
            ];
            return response()->json(['success' => $product], 200);
        } else {
            return response()->json(['error' => 'No Product Found'], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),
            [
                'category_id' => 'required|not_in:0',
                'product_name' => 'required|unique:products',
                'product_mrp_price' => 'required',
                'product_current_price' => 'required|lte:product_mrp_price'
            ], [
                'category_id.required' => 'Category is required',
                'category_id.not_in' => 'Category is required',
                'product_name.required' => 'Product name is required',
                'product_name.unique' => 'Product already exists',
                'product_mrp_price.required' => 'Product MRP is required',
                'product_current_price.required' => 'Product Current Price is required',
                'product_current_price.lte' => 'Current Price should be less than MRP Price'
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }

        if ($request->get('image')) {
            $image = $request->get('image');
            $name = 'feed-' . time(). '-'. time(). '-'. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            Image::make($request->get('image'))->save(public_path('static/images/full/').$name);

            $cat_pic = 'static/images/full/' . $name;
        }
        else{
            $cat_pic = Picture::getDefaultImage()->image_thumb;
        }

        $category = new Category;
        $category->parent_id = $request->parent_id;
        $category->category_name = $request->category_name;
        $category->category_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name)));
        $category->category_image_full = $cat_pic;
        $category->category_image_thumb = $cat_pic;
        $category->tax_rate = 0;
        $category->status = Category::STATUS_ACTIVE;
        $category->save();

        $id = $category->id;

        if($id){
            return response()->json(['success' => 'Updated successfully'], 200);
        }
        else{
            return response()->json(['error' => 'Something went wrong'], 200);
        }
    }

    public function update(Request $request){
        $id = $request->id;

        if(!$id){
            return response()->json(["status" => 404, 'message' => 'Please provide category Id']);
        }

        $category = Category::findorFail($request->id);

        $validator = Validator::make($request->all(),
            [
                'parent_id' => 'required',
                'category_name' => ['required',
                    Rule::unique('categories')->ignore($id),
                ],
                'status' => 'required'
            ], [
                'parent_id.required' => 'Parent Id is required',
                'category_name.required' => 'Category Name is required',
                'category_name.unique' => 'Category Name is already exists',
                'status.required' => 'Status is required'
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }

        if ($request->get('image')) {
            $image = $request->get('image');
            $name = 'feed-' . time(). '-'. time(). '-'. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            Image::make($request->get('image'))->save(public_path('static/images/full/').$name);

            $cat_pic = 'static/images/full/' . $name;
        }
        else{
            $cat_pic = Picture::getDefaultImage()->image_thumb;
        }

        if($request->category_name != $category->category_name){
            $category_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name)));
        }
        else{
            $category_slug = $category->category_slug;
        }

        $updateCategory = $category->update([
            'parent_id' => $request->parent_id,
            'category_name' => $request->category_name,
            'category_slug' => $category_slug,
            'category_image_full' => $cat_pic,
            'category_image_thumb' => $cat_pic,
            'tax_rate' => 0,
            'status' => $request->status
        ]);

        if($updateCategory){
            return response()->json(['success' => 'Updated successfully'], 200);
        }
        else{
            return response()->json(['error' => 'Something went wrong'], 200);
        }
    }
}
