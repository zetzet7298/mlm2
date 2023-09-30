<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('pages.category.index');
        // $category = Category::inRandomOrder()->take(6)->get();
        // return view('pages.category.index')->with([
        //     'category'=> $category,
        // ]);
    }
    public function edit($id, Request $request)
    {
        $category = Category::find($id);
        return view('pages.category._edit')->with([
            'category'=> $category,
        ]);
    }


    public function store(Request $request){
        DB::beginTransaction();
        try {
            $product = new Category();
            $product->slug = \Str::slug($request->name);
            $product->name = $request->name;
            $product->save();
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
        $product = Category::where('id', $id)->first();
        if (empty($product)){
            return redirect()->back()->with("error", "Could not find product!");
        }

        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->save();
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
        return view('pages.category._create')->with([
        ]);
    }

    public function delete($id, Request $request)
    {
        $product = Category::where('id', $id)->first();
        if (empty($product)){
            return redirect()->back()->with("error", "Could not find product!");
        }
        if(!User::isAdmin() && auth()->user()->id != $product->user_id){
            return redirect()->back()->with("error", "You can not delete this category!");
        }


        DB::beginTransaction();
        try {
            // Category::where('id', $id)->delete();
            Category::where('id', $id)->update(['active' => false]);
            DB::commit();
            return redirect()->back()->with("success", "Deleted!");
        }catch(\Exception $e){
            report($e);
            return redirect()->back()->with("error", "Failed!");
            DB::rollback();
        }
    }
}
