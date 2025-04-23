<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Stripe;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function Home()
    {
        $products = Product::all();
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Carts::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.index', compact('products', 'count'));
    }
    public function index()
    {
        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status', 'delivered')->get()->count();
        return view('admin.index', compact('user', 'order', 'product', 'delivered'));
    }
    public function login_home()
    {
        $products = Product::all();
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Carts::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.index', compact('products', 'count'));
    }

    public function produc_details($id)
    {
        $data = Product::find($id);
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Carts::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.produc_details', compact('data', 'count'));
    }

    public function add_cart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $user = Auth::user();

        $cart = new Carts();
        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        $cart->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product added to cart Successfully.');

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function mycart()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Carts::where('user_id', $userid)->count();
            $cart = Carts::where('user_id', $userid)->get();
        } else {
            $count = '';
        }
        return view('home.mycart', compact('count', 'cart'));
    }

    public function delete_cart($id)
    {

        $data = Carts::find($id);

        $data->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Removeed to cart Successfully.');

        return redirect()->back();
    }

    public function comfirm_order(Request $request)
    {

        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Carts::where('user_id', $userid)->get();
        foreach ($cart as $carts)
            $order = new Order;

        $order->name = $name;
        $order->rec_address = $address;
        $order->phone = $phone;
        $order->user_id = $userid;
        $order->product_id = $carts->product_id;
        $order->save();


        $cart_remove = Carts::where('user_id', $userid)->get();

        foreach ($cart_remove as $remove) {
            $data = Carts::find($remove->id);
            $data->delete();
        }
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Ordered Successfully.');

        return redirect()->back();
    }

    public function myorders()
    {
        $user = Auth::user()->id;
        // $userid = $user->id;
        $count = Carts::where('user_id', $user)->count();
        $order = Order::where('user_id', $user)->get();
        return view('home.orders', compact('count', 'order'));
    }

    public function stripe($value)
    {

        return view('home.stripe', compact('value'));
    }

    public function stripePost(Request $request, $value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $value * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from complete"
        ]);

        $name = Auth::user()->name;
        $address = Auth::user()->address;
        $phone = Auth::user()->phone;
        $userid = Auth::user()->id;
        $cart = Carts::where('user_id', $userid)->get();
        foreach ($cart as $carts)

            $order = new Order;

        $order->product_id = $carts->product_id;
        $order->name = $name;
        $order->rec_address = $address;
        $order->phone = $phone;
        $order->user_id = $userid;
        $order->payment_status = "paid";
        $order->save();


        $cart_remove = Carts::where('user_id', $userid)->get();

        foreach ($cart_remove as $remove) {
            $data = Carts::find($remove->id);
            $data->delete();
        }
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Ordered Successfully.');

        return redirect()->back();
    }

    public function shop()
    {
        $products = Product::all();
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Carts::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.shop', compact('products', 'count'));
    }

    public function why()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Carts::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.why', compact('count'));
    }

    public function testimonial()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Carts::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.testimonial', compact('count'));
    }

    public function contact()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Carts::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.contact', compact('count'));
    }

}
