<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;


class AdminController extends Controller
{
    public function view_category()
    {
        $data=category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request)
    {
        $data=new category;
        $data->category_name=$request->category;
        $data->save();

        return redirect()->back()->with('message','Category Added Successfully');
    }
    public function delete_category($id)
    {
        $data=category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category deleted successfully');

    }

    public function view_product()
    {
        $category=category::all();
        return view ('admin.product',compact('category'));
    }

    public function add_product(Request $request)
    {
        $product=new product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->image=$request->image;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount_price;
        $product->category=$request->category;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;

        $product->color = json_encode($request->colors);
        $product->size = json_encode($request->sizes);
        $product->save();

        return redirect()->back()->with('message', 'Product added successfully');



    }
    public function show_product()
    {
        $product=product::all();
        return view('admin.show_product',compact('product'));
    }
    public function delete_product($id)
    {
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');

    }

    public function update_product($id)
    {
        $product=product::find($id);
        $category=category::all();
        return view('admin.update_product',compact('product','category'));
    }

    public function update_product_confirm(Request $request, $id)
    {
        $product = Product::find($id);  
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
    
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }
    
        $product->color = json_encode($request->colors);
        $product->size = json_encode($request->sizes);
    
        $product->save();
    
        return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function order()
    {
        $order=order::all();
        return view('admin.order',compact('order'));
    }

    public function delivered($id)
    {
        $order=order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status='Paid';

        $order->save();

        return  redirect()->back();

    }
    public function print_pdf($id)
    {
        $order=order::find($id);
        $pdf=PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');


    }

    public function searchdata(Request $request)
    {
        $searchText=$request->search;
        $order=order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->orWhere('delivery_status','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->orWhere('payment_status','LIKE',"%$searchText%")->get();

        return view('admin.order',compact('order'));

    }
    
    
}
