<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Products::where('status',2)->paginate(10);
        return view('welcome',compact('products'));
    }
    
}
