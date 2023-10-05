<?php

namespace App\Http\Controllers;

use App\Gift;
use Illuminate\Http\Request;
use App\DataTables\GiftDataTable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GiftController extends Controller
{
    public function index()
    {
        // $order = Gift::inRandomGift()->take(6)->get();
        return view('gift')->with([
        ]);
    }

    public function gratitude()
    {
        // $order = Gift::inRandomGift()->take(6)->get();
        return view('gratitude')->with([
        ]);
    }

    public function show($id)
    {
        $order = Gift::find($id);
        $products = $order->products;
        return view('pages.order._detail')->with([
            'order' => $order,
            'products' => $products
        ]);
    }
}
