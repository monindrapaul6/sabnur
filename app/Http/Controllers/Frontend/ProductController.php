<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seo;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product_slug){
        $product = Product::where('product_slug', $product_slug)->first();

        if(!$product || $product->status == false){
            abort(404);
        }

        $product->update([
            'num_of_views' => $product->num_of_views + 1
        ]);

        $AllrelProducts = Product::active()
            ->select('id', 'product_name', 'product_slug', 'product_dp', 'product_discount', 'product_mrp_price', 'product_current_price')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->product_category->id)
            ->skip(0)->limit(10)->get();

        if(count($AllrelProducts) < 10){
            $getrelProducts = Product::active()
                ->select('id', 'product_name', 'product_slug', 'product_dp', 'product_discount', 'product_mrp_price', 'product_current_price')
                ->where('id', '!=', $product->id)
                /*->inRandomOrder()*/
                ->skip(0)->limit(10 - count($AllrelProducts))->get();

            $relatedProducts = $AllrelProducts->merge($getrelProducts);
        }
        else {
            $relatedProducts = $AllrelProducts;
        }

        //return $relatedProducts;

        return view('android.product.index', compact('product', 'relatedProducts'));
    }
}
