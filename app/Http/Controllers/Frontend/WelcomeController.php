<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Page;
use App\Models\Product;
use App\Models\Seo;
use App\Models\Slider;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function dashboard(){
        $sliders = Slider::where('status', 'ACTIVE')->select('picture_id')->get();

        //new arrival products
        $newarrivals = Product::select('id', 'product_dp', 'product_name', 'product_slug', 'product_mrp_price', 'product_current_price', 'product_discount')
            ->where('status', 'ACTIVE')
            ->wherenotIn('category_id', Offer::notApplicableCats)
            ->orderby('created_at', 'desc')
            ->skip(0)->limit(10)->get();

        $bestsellers = Product::select('id', 'product_dp', 'product_name', 'product_slug', 'product_mrp_price', 'product_current_price', 'product_discount')
            ->where('status', 'ACTIVE')
            ->wherenotIn('category_id', Offer::notApplicableCats)
            ->orderby('num_of_views', 'desc')
            ->skip(0)->limit(10)->get();

        /*$mostviewproduts = Product::active()->select('id', 'product_dp', 'product_name', 'product_slug', 'product_mrp_price', 'product_current_price', 'product_discount')
            ->orderby('num_of_views', 'desc')->skip(0)->limit(10)->get();*/

        $bestdeals = Product::active()->select('id', 'product_dp', 'product_name', 'product_slug', 'product_mrp_price', 'product_current_price', 'product_discount')
            ->where('product_discount', '>=', 10)
            ->wherenotIn('category_id', Offer::notApplicableCats)
            ->skip(0)->limit(10)->get();

        return view('android.dashboard.index', compact('newarrivals', 'bestsellers', 'bestdeals', 'sliders'));
    }

    public function getpages($path){
        $page = Page::where('page_slug', $path)->first();

        if(!$path || !$page){
            abort(404);
        }

        $metaseo = Seo::where('page_id', $page->id)->first();

        return view('frontend.page.index', compact('page', 'metaseo'));
    }
}
