<?php

namespace App\Http\Controllers;

use App\Products;
use App\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    // Do all functions in this controller when login otherwise redirect to login page.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Products::paginate(5);
        return view('products.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
         // Validate the Field
         $this->validate($request,[
            'product'=>'required|max:100',
            'quantity'=>'required',
            'photo' => 'required',
            'photo'=>'image|mimes:jpeg,png,jpg,svg|max:5120'
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->product)));

        $product = new Products;
        $product->product_name = $request->product;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category;

        if($request->hasfile('photo'))
         {
            $destinationPath = public_path().'/images/';
            $filename = $slug.'.jpg';
            $request->file('photo')->move($destinationPath, $filename);
            $product->photo = $filename;
         }

         $product->save();
         return redirect()->route('product.index')->with('message','New Product Created Successfull !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);
        $categories = Category::all();

        return view('products.read',compact('product','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        $categories = Category::all();
        return view('products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'photo' => 'required',
            'photo'=>'image|mimes:jpeg,png,jpg,svg|max:5120'
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));

        $product = Products::find($id);
        $product->product_name = $request->product;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category;

        if($request->hasfile('photo'))
         {
            $destinationPath = public_path().'/images/';
            $filename = $slug.'.jpg';
            $request->file('photo')->move($destinationPath, $filename);
            $product->photo = $filename;
         }

         $product->save();
         return redirect()->route('product.index')->with('message','Product Updated Successfull !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $filepath = public_path().'/images/'.$product->photo;
        \File::delete($filepath);

        
        $product->delete();
        return back()->with('message','Product Deleted Successfull !');
    }
}
