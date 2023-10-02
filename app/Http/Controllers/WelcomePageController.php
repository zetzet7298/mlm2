<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class WelcomePageController extends Controller
{
    public function index()
    {
        $products = Product::active()->orderBy('created_at')
        // ->orderBy('featured', 'desc')
        ->take(3)->get();
        $hotProducts = Product::inRandomOrder()->take(6)->get();
        // dd($hotProducts);
        return view('pages.index')->with([
            'products'=> $products,
            'hotProducts' => $hotProducts
        ]);
    }
}
