<?php

namespace App\Http\Controllers;

use App\Featured;
use App\Footer;
use App\Logo;
use App\Product;
use App\Support;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Cart;
class CartController extends Controller
{
    public function showCartProduct()
    {
        $show_logo = Logo::where('status', 1)->first();
        $show_about = Footer::where('status', 1)->first();
        $show_support_page = Support::orderBy('id', 'desc')->first();
        $cartProducts = \Cart::content();
        return view('front.cart.show-cart', compact('show_logo', 'show_about', 'show_support_page', 'cartProducts'));
    }
    public function addToCart($id)
    {
        $products = Featured::where('id', $id)->first();
        $data = [
            'id' => $products->id,
            'name' => $products->featured_name,
            'qty' => 1,
            'price' => $products->price,
            'weight' => 0,
            'options' => [
                'image' => $products->image
            ]
        ];
        Cart::add($data);
        return response()->json(['success' => 'Product add to card', 'totalItems' => Cart::count()], 200);
    }

    public function addToFashonableCart($id)
    {
        $product = Product::where('id', $id)->first();
        $data = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->balance,
            'weight' => 0,
            'options' => [
                'image' => $product->image
            ]
        ];
        Cart::add($data);
        return response()->json(['success' => 'Product add to card', 'totalItems' => Cart::count()], 200);
    }

    public function showCartProductUpdate(Request $request)
    {
        Cart::update($request->rowId, $request->qty);
        Toastr::success('Cart has been Updated :)', 'Success');
        return redirect()->back();
    }

    public function deleteCartProduct($id)
    {
        Cart::remove($id);
        Toastr::success('Product has been deleted :)', 'Success');
        return redirect()->back();
    }
}
