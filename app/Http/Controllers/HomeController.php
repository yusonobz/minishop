<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }
    
    public function contact()
    {
        return view('contact');
    }
    
    // display all products to view by the users
    public function products()
    {

        $products = Products::all();
        return view('product',compact('products'));
    }
}
