<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\product;
use App\Models\Category;
use App\Models\Order;
use App\Models\shippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = product::where('product_category_id', $id)->latest()->get();
        return view('user_template.categorypage', compact('category', 'products'));
    }

    public function singleproduct($id)

    {
        $product = Product::findOrFail($id);
        $subcat_id = product::where('id', $id)->value('product_subcategory_id');
        $related_products = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('user_template.singleproduct', compact('product', 'related_products'));
    }

    public function userprofile()
    {
        return view('user_template.userprofile');
    }

    public function pendingorders()
    {
        $pending_orders = order::where('status', 'pending')->latest()->get();
        return view('user_template.pendingorders', compact('pending_orders'));
    }


    public function history()
    {

        return view('user_template.history');
    }

    public function addtocart()
    {
        $user_id = Auth::id();
        $cart_items = Cart::where('user_id', $user_id)->get();
        return view('user_template.addtocart', compact('cart_items'));
    }

    public function addproductTocart(Request $request)
    {
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;

        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'price' => $price
        ]);

        return redirect()->route('addtocart')->with('message', 'Your item added to cart successfully');
    }

    public function removecartitem($id)
    {
        Cart::findOrFail($id)->delete();

        return redirect()->route('addtocart')->with('message', 'Your item removed from cart successfully');
    }

    public function getshippingAdd()
    {
        return view('user_template.shippingAdd');
    }

    public function addshippingAdd(Request $request)
    {
        shippingInfo::insert([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code,

        ]);

        return redirect()->route('checkout');
    }

    public function checkout()
    {
        $user_id = Auth::id();
        $cart_items = Cart::where('user_id', $user_id)->get();

        $shipping_add = shippingInfo::where('user_id', $user_id)->first();
        return view('user_template.checkout', compact('cart_items', 'shipping_add'));
    }

    public function placeorder()
    {
        $user_id = Auth::id();
        $shipping_add = shippingInfo::where('user_id', $user_id)->first();
        $cart_items = Cart::where('user_id', $user_id)->get();

        foreach ($cart_items as $item) {
            Order::insert([
                'user_id' => $user_id,
                'shipping_phone_number' => $shipping_add->phone_number,
                'shipping_city_name' => $shipping_add->city_name,
                'shipping_postal_code' => $shipping_add->postal_code,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->price,
            ]);

            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }

        shippingInfo::where('user_id', $user_id)->first()->delete();

        return redirect()->route('pendingorders')->with('message', 'Your order is placed successfully!');
    }
}
