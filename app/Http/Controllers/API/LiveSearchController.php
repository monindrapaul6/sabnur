<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class LiveSearchController extends Controller
{
    public function livesearch(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->q;
            $output = "";

            $products = Product::where('status', 'ACTIVE')->where('product_name', 'LIKE', '%' . $request->q . "%")->skip(0)->limit(10)->get();

            /*$product = Product::active()
                ->whereRaw("MATCH(product_name) AGAINST(? IN BOOLEAN MODE)", array($query));

            $products = $product->get();*/

            if (count($products) > 0) {
                foreach ($products as $product) {
                    $output .= '<div class="col-12 mb-4 floatingLiveSearchItem">' .
                            '<a href="' . url('product/' . $product->product_slug) . '" class="d-flex">' .
                            '<div class="col-2">' .
                                '<img src="' . asset($product->productDPImage->image_thumb) . '"/>' .
                            '</div>' .
                            '<div class="col-10 px-2">' .
                                '<h6>' . $product->product_name . '</h6>' .
                                '<strong>₹ ' . $product->product_current_price . '</strong>' .
                            '</div></a></div>';
                }
            }

            return Response($output);
        }
    }
}
