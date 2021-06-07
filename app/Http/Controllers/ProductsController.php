<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Cart;

use Strip\Charge;


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
        redirect('/product.create')->with(['error'=>'Product deleted Suceesfully']);
    }
    public function viewProducts(){
        $products=Products::all();
        return view('FrontProducts.viewProduct',compact('products'));
    }
    public function addToCart(Request $request){
        $productQty=Products::find($request->ptd_id);
//$qtyGet=$request->all();
// dd($qty,$product);
$cart=Cart::add([
    'id'=>$productQty->id,
    'name'=>$productQty->pro_name,
    'qty'=>$request->qty,
    'price' =>$productQty->pro_price,
]);
//dd($cart);
//dd(Cart::content());

//for fixing The image issue we need to associate
// our cart with model property
Cart::associate($cart->rowId, 'App\Models\Products');
return redirect('/cart')->with('message','Product got added in cart');
    }
    /**
     * Get Function for getting the Cart Data
     */
    public function cartView(){
$title="Cart Page";
//Cart::destroy();
return view('FrontProducts.cartView',compact('title'));
    }
    public function cartDelete($id){
        Cart::remove($id);
        return redirect()->back();
    }
    /**
     * Updating the product qty through Update
     */
    public function cartIncrement($id,$qty){
        Cart::update($id,$qty+1);
        return redirect()->back()->with('info','One Product in added in cart');
    }
    public function cartDecrement($id,$qty){
        Cart::update($id,$qty-1);
        return redirect()->back()->with('info','One Product is deleted from cart');
    }
    /**
     * Here we added the method for adding the
     * product in cart through product page directly
     */
    public function rapidAdd($id){
        $product=Products::find($id);
       $cart= Cart::add([
'id'=>$product->id,
'name'=>$product->pro_name,
'qty'=>1,
'price'=>$product->pro_price,
        ]);
        Cart::associate($cart->rowId, 'App\Models\Products');
return redirect('/cart')->with('info', 'Product added in cart');
    }
    /**
     * method for creating the checkout page
     */
    public function checkOut(){
        $title="Products-Checkout";
        return view('FrontProducts.checkOut',compact('title'));
    }
    public function cartCheckout(Request $request){
    //    $data=$request->all();
    //    dd($data);
    
    \Stripe\Stripe::setApiKey('sk_test_51Iz2elSHQwAB5Kytp5lUCdsXF8LqkPTAW9mzK2wlLruzmgysmzuYydVkvUv1kuYavFxfwQiqTeyynXYswa9dykMx00YXpEWV2l');
   
    $charge=\Stripe\Charge::create([
       
'amount'=>Cart::total(),
'currency'=>'usd',
'description' =>'MY test Site Pucrhase',
'source'=>$request->stripeToken,
    ]);
    dd('Your Card payments done');
    }
}
