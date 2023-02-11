<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seo;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $query = $request->q;
        $product = Product::active()
            ->whereRaw("MATCH(product_name) AGAINST(? IN BOOLEAN MODE)", array($query));

        if(isset($request->brand)){
            $mystring = $request->brand;
            $myArray = explode(',', $mystring);

            $product->whereIn('brand_id', $myArray);
        }

        $products = $product->paginate(10);

        return view('frontend.search.index', compact('products', 'query'));
    }
}
