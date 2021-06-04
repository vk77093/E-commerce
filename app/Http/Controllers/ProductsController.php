<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $title='Main Page';
$products=Products::paginate(5);
        return view('FrontProducts.index',compact('title','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Products-Create";
        return view('FrontProducts.addProduct',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'pro_name' => 'required',
            'pro_price' => 'required|numeric',
            'pro_description' => 'required',
            'pro_image' => 'required',
        ]);
        $products=new Products;
       $product_image = $request->pro_image;
        $product_new_image=time().$product_image->getClientOriginalName();
        $product_image->move(public_path('/assets/uploads/'),$product_new_image);
        //$product_image->move('public_uploads',$product_new_image);
        

        // $imageName = time().'.'.$request->pro_image->getClientOriginalExtension();
        // $request->pro_image->move(public_path('/assets/uploads/'), $imageName);
        $products->pro_name=$request->pro_name;
        $products->pro_price=$request->pro_price;
        $products->pro_description=$request->pro_description;
        $products->pro_image='/uploads'.'/'.$product_new_image;
        $products->save();
        return redirect('/product/create')->with(['message'=>'New Product Added']); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Products::findOrFail($id);
        $title="Product details Page";
        return view('FrontProducts.singleDetails',compact('title','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Products::find($id);
        $title="Product Edit";
        return view('FrontProducts.editProduct',compact('title','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'pro_name' => 'required',
            'pro_price' => 'required|numeric',
            'pro_description' => 'required',
            'pro_image' => 'required',
        ]);
        $product=Products::findOrFail($id);
        if(file_exists($product->pro_image)){
            unlink($product->pro_image);
        }
        $product_image = $request->pro_image;
        $product_new_image=time().$product_image->getClientOriginalName();
        $product_image->move(public_path('/assets/uploads/'),$product_new_image);
        $product->pro_name=$request->pro_name;
        $product->pro_price=$request->pro_price;
        $product->pro_description=$request->pro_description;
        $product->pro_image='/uploads'.'/'.$product_new_image;
        $product->update();
        return redirect('/viewproduct')->with(['message'=>'Product Updated Suceesfully']);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Products::findOrFail($id);
        if(file_exists($product->pro_image)){
            unlink($product->pro_image);
        }
        $product->delete();
        redirect('/product.create')->with(['message'=>'Product deleted Suceesfully']);
    }
    public function viewProducts(){
        $products=Products::all();
        return view('FrontProducts.viewProduct',compact('products'));
    }
}
