<?php

namespace App\Http\Controllers;

use App\Category;
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
        $categories = Category::all();
        // dd($hotProducts);
        return view('pages.index')->with([
            'categories'=> $categories,
            'products'=> $products,
            'hotProducts' => $hotProducts
        ]);
    }
}
