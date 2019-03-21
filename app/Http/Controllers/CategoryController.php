<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{    
    // Do all functions in this controller when login otherwise redirect to login page.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        $categories = Category::paginate(5);;
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the Field
         $this->validate($request,[
            'category_name'=>'required|max:100'
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->route('category.index')->with('message','New Category Created Successfull !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('category.read',compact('category'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit',compact('category'));
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

        $category =  Category::find($id);
        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->route('category.index')->with('message','Category Updated Successfull !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();

        return back()->with('message','Category Deleted Successfull !');
    }
}
