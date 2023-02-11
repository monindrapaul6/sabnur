<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

class CategoryController extends Controller
{
    public function index(){
        $cats = Category::select('id', 'parent_id', 'category_name', 'category_image_thumb')
            ->orderBy('id', 'DESC')
            ->get();

        if (count($cats) > 0) {
            $categories = [];
            foreach ($cats as $cat) {
                $categories[] = [
                    'id' => $cat->id,
                    'parent_id' => $cat->parent_id,
                    'category_name' => $cat->category_name,
                    'category_image_thumb' => $cat->category_image_thumb
                ];
            }
            return response()->json(['success' => $categories], 200);
        } else {
            return response()->json(['error' => 'No Category Found'], 404);
        }
    }

    public function show($id){
        $cat = Category::select('id', 'parent_id', 'category_name', 'category_image_thumb', 'status')
            ->where('id', $id)
            ->first();

        if ($cat) {
            $category = [
                'id' => $cat->id,
                'parent_id' => $cat->parent_id,
                'category_name' => $cat->category_name,
                'category_image_thumb' => asset($cat->category_image_thumb),
                'status' => $cat->status
            ];
            return response()->json(['success' => $category], 200);
        } else {
            return response()->json(['error' => 'No Category Found'], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),
            [
                'parent_id' => 'required',
                'category_name' => 'required|unique:categories',
                'image' => 'required'
            ], [
                'parent_id.required' => 'Parent Category is required',
                'category_name.required' => 'Category name is required',
                'category_name.unique' => 'Category name already exists',
                'image.required' => 'Enter Post Picture'
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
