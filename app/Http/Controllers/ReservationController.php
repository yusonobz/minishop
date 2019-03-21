<?php

namespace App\Http\Controllers;

use App\Reservations;
use App\Products;
use App\Customers;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Do all functions in this controller when login otherwise redirect to login page.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // list of all reservations made by each registered user
        $reservations = Reservations::paginate(5);
        return view('reservation.index',compact('products','reservations'));

    }


    public function create()
    {
        $products = Products::all();
        return view('reservation.create', compact('products'));
    }


    public function store(Request $request)
    {
        // add reservation of product by specefic user
        $reservation = new Reservations;
        $reservation->product_id = $request->product_id;
        $reservation->customer_id = Auth::id();
        $reservation->reserved_quantity = $request->quantity;

        //update product quantity
        $product = Products::find($request->product_id);
        // minus reserved product quantity to product quantity
        $product->quantity = $product->quantity - $request->quantity;
        $product->save();
        $reservation->save();

        return redirect()->route('reservation.index')->with('message','New Reservation Created Successfull !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $reservation = Reservations::find($id);

        $product = Products::find($reservation->product_id);
        // add the reserved quantity to total product quantity
        $product->quantity = $product->quantity + $reservation->reserved_quantity;
        $product->save();
        $reservation->delete();

        return back()->with('message','Reservation Deleted Successfull !');
        
    }
}
