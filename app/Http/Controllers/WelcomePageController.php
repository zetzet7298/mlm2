<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;

class WelcomePageController extends Controller
{
    public function index()
    {
        $products = Product::active()->orderBy('created_at', 'desc')
        // ->orderBy('featured', 'desc')
        ->take(3)->get();
        $categories = Category::all();
        $hotProducts = Product::active()->orderBy('featured', 'desc')->inRandomOrder()->take(6)->get();
        // dd($hotProducts);
        return view('pages.index')->with([
            'categories'=> $categories,
            'products'=> $products,
            'hotProducts' => $hotProducts
        ]);
    }
}
