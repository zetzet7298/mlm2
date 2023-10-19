<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\DataTables\ProductDataTable;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('pages.products.index');
        // $products = Product::inRandomOrder()->take(6)->get();
        // return view('pages.products.index')->with([
        //     'products'=> $products,
        // ]);
    }
    public function edit($id, Request $request)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('pages.products._edit')->with([
            'product'=> $product,
            'categories'=> $categories,
        ]);
    }

    public function upload($folder = 'images/products/dummy', $key = 'avatar', $validation = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|sometimes')
    {
        request()->validate(['avatar' => $validation]);
        $file = null;
        if (request()->hasFile('avatar')) {
            $file = Storage::disk('public')->putFile($folder, request()->file('avatar'), 'public');
        }

        return $file;
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $product = new Product();
            $product->slug = \Str::slug($request->name);
            $product->user_id = auth()->user()->id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->member_price = $request->member_price;
            $product->details = $request->details;
            $product->description = $request->description;
            $product->category_id = $request->category;
            if(!empty($request->featured)){
                $product->featured = true;
            }else{
                $product->featured = false;
            }
            if(!empty($request->avatar)){
                // dd($request->avatar->getClientOriginalName());
                if ($avatar = $this->upload('images/products/dummy', $request->avatar->getClientOriginalName())) {
                    $product->image = $avatar;
                }
                if ($request->boolean('avatar_remove')) {
                    Storage::delete(auth()->user()->avatar);
                    $product->image = null;
                }
            }
            $product->save();
            $new_coin = auth()->user()->coin - 1;
            auth()->user()->update([
                'coin' =>  $new_coin,
            ]);

            Withdrawal::create([
                'user_id'        => auth()->user()->id,
                'address'        => '',
                'coin'             => 1,
                'content'             => 'Post Product',
            ]);

            DB::commit();
            return redirect()->back()->with("success", "Created!");
        }catch(\Exception $e){
            dd($e);
            report($e);
            return redirect()->back()->with("error", "Failed!");
            DB::rollback();
        }
    }
    public function update($id, Request $request)
    {
        $product = Product::where('id', $id)->first();
        if (empty($product)){
            return redirect()->back()->with("error", "Could not find product!");
        }

        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->member_price = $request->member_price;
            $product->details = $request->details;
            $product->description = $request->description;
            $product->category_id = $request->category;
            if(!empty($request->featured)){
                $product->featured = true;
            }else{
                $product->featured = false;
            }
            if(!empty($request->avatar)){
                // dd($request->avatar->getClientOriginalName());
                if ($avatar = $this->upload('images/products/dummy', $request->avatar->getClientOriginalName())) {
                    $product->image = $avatar;
                }
                if ($request->boolean('avatar_remove')) {
                    Storage::delete(auth()->user()->avatar);
                    $product->image = null;
                }
            }
            $product->save();
            $new_coin = auth()->user()->coin - 1;
            auth()->user()->update([
                'coin' =>  $new_coin,
            ]);

            Withdrawal::create([
                'user_id'        => auth()->user()->id,
                'address'        => '',
                'coin'             => 1,
                'content'             => 'Update Product',
            ]);

            DB::commit();
            return redirect()->back()->with("success", "Success!");
        }catch(\Exception $e){
            dd($e);
            report($e);
            return redirect()->back()->with("error", "Failed!");
            DB::rollback();
        }
    }
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('pages.products._create')->with([
            'categories'=> $categories,
        ]);
    }

    public function delete($id, Request $request)
    {
        $product = Product::where('id', $id)->first();
        if (empty($product)){
            return redirect()->back()->with("error", "Could not find product!");
        }
        if(!User::isAdmin() && auth()->user()->id != $product->user_id){
            return redirect()->back()->with("error", "You can not delete this product!");
        }


        DB::beginTransaction();
        try {
            // Product::where('id', $id)->delete();
            Product::where('id', $id)->update(['active' => false]);
            DB::commit();
            return redirect()->back()->with("success", "Deleted!");
        }catch(\Exception $e){
            report($e);
            return redirect()->back()->with("error", "Failed!");
            DB::rollback();
        }
    }
}
