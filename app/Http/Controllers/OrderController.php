<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('pages.order.index');
        // $order = Order::inRandomOrder()->take(6)->get();
        // return view('pages.order.index')->with([
        //     'order'=> $order,
        // ]);
    }
    public function show($id)
    {
        $order = Order::find($id);
        $products = $order->products;
        return view('pages.order._detail')->with([
            'order' => $order,
            'products' => $products
        ]);
    }

    public function create(Request $request)
    {
        return view('pages.order._create')->with([
        ]);
    }

    public function delete($id, Request $request)
    {
        $product = Order::where('id', $id)->first();
        if (empty($product)){
            return redirect()->back()->with("error", "Could not find product!");
        }
        if(!User::isAdmin() && auth()->user()->id != $product->user_id){
            return redirect()->back()->with("error", "You can not delete this order!");
        }

        DB::beginTransaction();
        try {
            // Order::where('id', $id)->delete();
            Order::where('id', $id)->update(['active' => false]);
            DB::commit();
            return redirect()->back()->with("success", "Deleted!");
        }catch(\Exception $e){
            report($e);
            return redirect()->back()->with("error", "Failed!");
            DB::rollback();
        }
    }
}
