<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Offer;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Service\OrderNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('guest');
    }*/

    public function index()
    {
        //$this->checkQtyOne();

        //return session()->get('cart');

        $iswelcomeoffer = false;
        $specialdiscount = 0;
        $cartSpecialDis = 0;

        $carts = [];
        $mrp_total = 0;
        $current_total = 0;

        $getoffer = [];

        if(Auth::user() == null) {
            $apCarts = session()->get('cart');

            if($apCarts != []) {
                foreach ($apCarts as $id => $apCart) {
                    $product = Product::select('id', 'product_dp', 'product_name', 'product_slug', 'product_mrp_price', 'product_current_price', 'product_discount', 'rating', 'num_of_rating')->where('id', $apCart['product_id'])->first();

                    $carts[] = [
                        'id' => $id,
                        'user_id' => null,
                        'product_id' => $apCart['product_id'],
                        'product_name' => $product->product_name,
                        'product_slug' => $product->product_slug,
                        'product_dp' => isset($product->productDPImage->image_thumb) ? asset($product->productDPImage->image_thumb) : null,
                        'product_mrp' => $product->product_mrp_price,
                        'product_current' => $product->product_current_price,
                        'product_quantity' => $apCart['product_quantity'],
                        'product_total' => $product->product_current_price * $apCart['product_quantity'],
                        'special_discount' => $cartSpecialDis,
                        'special_total' => ($product->product_current_price * $apCart['product_quantity']) - $cartSpecialDis,
                        'product_discount' => $product->product_discount,
                        'product_rating' => $product->rating,
                        'product_num_rating' => $product->num_of_rating
                    ];

                    $mrp_total += $product->product_mrp_price * $apCart['product_quantity'];
                    $current_total += $product->product_current_price * $apCart['product_quantity'];

                }
            }
        }
        else {

            $this->sessiontoAuthCart();

            $getCarts = Cart::where('user_id', Auth::user()->id)->get();

            $checkuseroffer = DB::table('offer_users')->where('user_id', Auth::user()->id)->first();
            if(!$checkuseroffer){
                $iswelcomeoffer = true;
            }

            $now = Carbon::now();
            $getoffer = Offer::active()
                ->whereDate('offer_start', '<=', $now->toDateString())
                ->whereDate('offer_expiry', '>=', $now->toDateString())
                ->first();

            if(count($getCarts) > 0) {
                foreach ($getCarts as $getCart) {
                    if ($getCart->cart_product->stock_status == false) {
                        $getCart->delete();
                    } else {
                        if($iswelcomeoffer == true && $getoffer){
                            $cartSpecialDis = !in_array($getCart->cart_product->product_category->id, Offer::notApplicableCats) ? Offer::active()->whereDate('offer_start', '<=', $now->toDateString())->whereDate('offer_expiry', '>=', $now->toDateString())->first()->offer_value * $getCart->product_quantity : 0;
                            $specialdiscount += !in_array($getCart->cart_product->product_category->id, Offer::notApplicableCats) ? Offer::active()->whereDate('offer_start', '<=', $now->toDateString())->whereDate('offer_expiry', '>=', $now->toDateString())->first()->offer_value * $getCart->product_quantity : 0;
                        }
                        $carts[] = [
                            'id' => $getCart->id,
                            'user_id' => $getCart->user_id,
                            'product_id' => $getCart->product_id,
                            'product_name' => $getCart->cart_product->product_name,
                            'product_slug' => $getCart->cart_product->product_slug,
                            'product_dp' => isset($getCart->cart_product->productDPImage->image_thumb) ? asset($getCart->cart_product->productDPImage->image_thumb) : null,
                            'product_mrp' => $getCart->cart_product->product_mrp_price,
                            'product_current' => $getCart->cart_product->product_current_price,
                            'product_quantity' => $getCart->product_quantity,
                            'product_total' => $getCart->cart_product->product_current_price * $getCart->product_quantity,
                            'special_discount' => $cartSpecialDis,
                            'product_discount' => $getCart->cart_product->product_discount,
                            'special_total' => ($getCart->cart_product->product_current_price * $getCart->product_quantity) - $cartSpecialDis,
                            'product_rating' => $getCart->cart_product->rating,
                            'product_num_rating' => $getCart->cart_product->num_of_rating,
                        ];

                        $mrp_total += $getCart->cart_product->product_mrp_price * $getCart->product_quantity;
                        $current_total += $getCart->cart_product->product_current_price * $getCart->product_quantity;
                    }
                }
            }

        }

        /*else{
            $carts = [];
        }*/

        //return $carts;

        return view('android.cart.index', compact('carts', 'specialdiscount', 'mrp_total', 'current_total', 'getoffer'));
    }

    public function sessiontoAuthCart(){
        $apCarts = session()->get('cart');

        if($apCarts != []) {
            foreach ($apCarts as $id => $apCart) {
                $product = Product::select('id', 'product_dp', 'product_name', 'product_mrp_price', 'product_current_price')->where('id', $apCart['product_id'])->first();

                $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();

                if (!$cart) {
                    $data = [
                        'user_id' => Auth::user()->id,
                        'product_id' => $apCart['product_id'],
                        'product_name' => $product->product_name,
                        'product_current_price' => $product->product_current_price,
                        'product_quantity' => $apCart['product_quantity'],
                        'product_total_price' => $product->product_current_price * $apCart['product_quantity']
                    ];

                    $addCart = Cart::create($data);
                } else {
                    $addCart = $cart->update([
                        /*'product_quantity' => $cart->product_quantity + $apCart['product_quantity'],*/
                        'product_quantity' => 1,
                        'product_total_price' => $cart->product_current_price * ($cart->product_quantity + $apCart['product_quantity'])
                    ]);
                }

                unset($apCarts[$product->id]);
                session()->put('cart', $apCarts);
            }
        }
    }

    public function checkQtyOne(){
        $carts = Cart::where('user_id', Auth::user()->id)->get();

        foreach ($carts as $cart){
            $cart->update([
                'product_current_price' => $cart->cart_product->product_current_price,
                'product_quantity' => 1,
                'product_total_price' => $cart->cart_product->product_current_price
            ]);
        }
    }

    public function addToCart($id, $qty)
    {
        $qty = 1;

        $product = Product::select('id', 'product_name', 'product_mrp_price', 'product_current_price', 'stock_status', 'status')->where('id', $id)->first();

        if(!$product || $product->status == false) {
            abort(404);
        }

        if($product->stock_status == false){
            return redirect()->back();
        }

        if(Auth::user() == null){
            $cart = session()->get('cart');
            if(!$cart) {
                $cart = [
                    $id => [
                        "product_id" => $product->id,
                        "name" => $product->product_name,
                        "product_quantity" => $qty,
                        "product_mrp_price" => $product->product_mrp_price,
                        "product_current_price" => $product->product_current_price
                    ],
                ];
                session()->put('cart', $cart);
                //return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
            if(isset($cart[$id])) {
                $cart[$id]['product_quantity'] = $cart[$id]['product_quantity'] + $qty;
                session()->put('cart', $cart);
                //return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
            $cart[$id] = [
                "product_id" => $product->id,
                "name" => $product->product_name,
                "product_quantity" => $qty,
                "product_mrp_price" => $product->product_mrp_price,
                "product_current_price" => $product->product_current_price
            ];
            session()->put('cart', $cart);
        }
        else{
            $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $id)->first();

            if(!$cart) {
                $data = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $id,
                    'product_name' => $product->product_name,
                    'product_current_price' => $product->product_current_price,
                    'product_quantity' => $qty,
                    'product_total_price' => $product->product_current_price * $qty
                ];

                $addCart = Cart::create($data);
            }

            else {
                $addCart = $cart->update([
                    'product_quantity' => $cart->product_quantity + $qty,
                    'product_total_price' => $cart->product_current_price * ($cart->product_quantity + $qty)
                ]);
            }
        }

        $addCart = true;

        if($addCart) {
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }

        // if item not exist in cart then add to cart with quantity = 1
        /*$cart[$id] = [
            "id" => $product->id,
            "name" => $product->product_name,
            "quantity" => $qty,
            "product_mrp_price" => $product->product_mrp_price,
            "product_current_price" => $product->product_current_price,
            "photo" => $product->product_dp->product_image_thumb
        ];*/

        //session()->put('cart', $cart);
    }

    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = Cart::where('id', $request->id)->first();

            $cart->update([
                'product_quantity' => $request->quantity,
                'product_total_price' => $cart->product_current_price * $request->quantity
            ]);

            if($cart){
                return "success";
            }
            else{
                return "failed";
            }
        }
    }

    public function removeCart(Request $request)
    {
        if($request->id) {
            if(Auth::user() == null){
                if($request->id) {
                    $cart = session()->get('cart');
                    if(isset($cart[$request->id])) {
                        unset($cart[$request->id]);
                        session()->put('cart', $cart);
                    }
                    session()->flash('success', 'Product removed successfully');
                }
            }
            else {
                $cart = Cart::where('id', $request->id)->delete();
                if ($cart) {
                    return 'YES';
                } else {
                    return 'NO';
                }
            }

        }
    }
}
