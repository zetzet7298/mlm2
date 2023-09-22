<?php

namespace App\Http\Controllers;

use App\Core\AccountConstant;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function find($id) {
        $user = User::
        // with('direct_user', function($q){
        //     $q->select(['id', 'first_name', 'last_name']);
        // })
        // ->with('indirect_user', function($q){
        //     $q->select(['id', 'first_name', 'last_name']);
        // })
        with('direct_user', 'indirect_user')
        ->find($id);
        $users = User::select('id', 'direct_user_id', 'indirect_user_id')->get()->toArray();
        $direct_user_name = $user->direct_user ? $user->direct_user->first_name . ' ' . $user->direct_user->last_name : '';
        // $direct_user_id = $user->direct_user ? $user->direct_user->id : -1;
        $indirect_user_name = $user->indirect_user ? $user->indirect_user->first_name . ' ' . $user->indirect_user->last_name : '';

        $count_direct_users = User::where(['direct_user_id'=>$id])->count();
        $count_indirect_users = User::where(['indirect_user_id'=>$id])->count();
        
        $children = User::where(['direct_user_id'=>$id])->get();
        $total_left_child = 0;
        $total_right_child = 0;

        if(!empty($children)){
            if (isset($children[0])){
                $total_left_child = 1;
                $leftChild = isset($children[0]) ? $children[0] : null;
                $total_left_child += $this->calcTieredTotal($users, $leftChild->id);
            }
            if (isset($children[1])){
                $total_right_child = 1;
                $rightChild = isset($children[1]) ? $children[1] : null;
                $total_right_child += $this->calcTieredTotal($users, $rightChild->id);
            }
            // dd($leftChild, $rightChild);
        }
        // dd($total_left_child, $total_right_child);
        // $total_left_child = $this->getTotalChild($users, $id);

        $direct_total = $count_direct_users * AccountConstant::DIRECT_COMISSION;
        // $indirect_total = $count_indirect_users * AccountConstant::INDIRECT_COMISSION;
        $indirect_total = 0;
        $tiered_total = $this->calcTieredTotal($users, $id);
        $gold_total = 0;
        $total = $tiered_total + $direct_total + $indirect_total;
        $user->type = User::getAccountType($user->type);
        $user->direct_user_name = $direct_user_name;
        $user->indirect_user_name = $indirect_user_name;
        $user->direct_total = $direct_total;
        $user->indirect_total = $indirect_total;
        $user->tiered_total = $tiered_total;
        $user->gold_total = $gold_total;
        $user->total = $total;
        return response()->json($user);
    }


    // public function calcTieredTotal($items, $direct_user_id, $level=0) {
    //     $total = 0;
    //     foreach($items as $k => $item){
    //         if($item['direct_user_id'] == $direct_user_id){
    //             $item['level'] = $level;
    //             #bỏ qua ng giới thiệu trực tiếp (con đầu tiên)
    //             # if item['level'] != 1:
    //             $total += 1;
    //             $child = $this->calcTieredTotal($items, $item['id'], $level+1);
    //             $total += $child;
    //         }
    //     }
    //     return $total;
    // }

    public function calcTieredTotal($items, $direct_user_id, $level=0) {
        $total = 0;
        foreach($items as $k => $item){
            if($item['direct_user_id'] == $direct_user_id){
                $item['level'] = $level;
                #bỏ qua ng giới thiệu trực tiếp (con đầu tiên)
                # if item['level'] != 1:
                $total += 1;
                $child = $this->calcTieredTotal($items, $item['id'], $level+1);
                $total += $child;
            }
        }
        return $total;
    }

    public function calcGoldTotal($items, $direct_user_id, $level=0) {
        $total = 0;
        foreach($items as $k => $item){
            if($item['direct_user_id'] == $direct_user_id){
                $item['level'] = $level;
                #bỏ qua ng giới thiệu trực tiếp (con đầu tiên)
                # if item['level'] != 1:
                $total += 1;
                $child = $this->calcTieredTotal($items, $item['id'], $level+1);
                $total += $child;
            }
        }
        return $total;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = theme()->getOption('page');

        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = theme()->getOption('page');

        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $config = theme()->getOption('page', 'edit');

        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
