<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Page;
use App\Models\Product;
use App\Models\Seo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::select('id', 'category_name', 'category_image_thumb', 'category_slug')->where('parent_id', 0)->get();
        return view('android.category.index', compact('categories'));
    }

    public function show($category_slug, Request $request){
        $category = Category::where('category_slug', $category_slug)->first();

        if(!$category){
            abort(404);
        }

        if(count($category->children) > 0){
            return view('android.category.child', compact('category'));
        }

        $product = Product::active()->where('category_id', $category->id);

        $products = $product->paginate(10);

        return view('android.category.show', compact('category', 'products'));
    }
}
