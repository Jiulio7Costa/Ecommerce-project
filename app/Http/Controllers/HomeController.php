<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use Session;

use Stripe;


class HomeController extends Controller
{
    public function index()
    {
        $product=Product::paginate(9);
        return view('home.userpage',compact('product'));
    }
    
    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        if ($usertype=='1')
        {
            return view('admin.home');
        }
        else
        {
            $product=Product::paginate(9);
        return view('home.userpage',compact('product'));
        }
    }

    public function product_details($id)
    {
        $product=product::find($id);
        return view ('home.product_details',compact('product'));

    }
    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $product=product::find($id);
            $cart=new cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;
            $cart->product_title=$product->title;
            if($product->discount_price!=null)
            {
                $cart->price=$product->discount_price *  $request->quantity;

            }
            else{
                $cart->price=$product->price * $request->quantity;
            }
           
            $cart->image=$product->image;
            $cart->size=$request->size;
            $cart->color=$request->color;
            $cart->Product_id=$product->id;
            $cart->quantity=$request->quantity;
            $cart->save();
            return redirect()->back();
        }
        else{
            return redirect('login');
        }

    }

    public function show_cart()
{
    if (Auth::id()) {
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', '=', $id)->get();
        
        // Calculate total price from the cart items
        $totalprice = $cart->sum('price');
        
        return view('home.showcart', compact('cart', 'totalprice'));
    } else {
        return redirect('login');
    }
        }
        public function products()
        {
            // Fetch paginated products from the database
            $products = Product::paginate(9); // You can change the number to however many products you want per page
            
            return view('home.products', compact('products')); // Passing the paginated products to the 'home.products' view
        }
        

        public function remove_cart($id) // Accepting $id as a parameter
        {
            // Find the cart item by its ID
            $cart = Cart::find($id);
        
            // Check if the cart item exists
            if ($cart) {
                // Delete the cart item
                $cart->delete();
            }
        
            // Redirect back to the cart page
            return redirect()->back();
        
        
    }        

    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        
        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->User_id=$data->User_id;

            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->color=$data->color;
            $order->size=$data->size;
            $order->Product_id=$data->Prodcut_id;

            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message','We have received your order. We will connect with you soon...');


    }
    public function stripe($totalprice)
    {
        return view('home.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([
            
                "amount" => $totalprice * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Thanks for shopping with us." 

        ]);

        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        
        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->User_id=$data->User_id;

            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->color=$data->color;
            $order->size=$data->size;
            $order->Product_id=$data->Prodcut_id;

            $order->payment_status='Paid';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }

      

        Session::flash('success', 'Payment successful!');

              

        return back();

    }

}
