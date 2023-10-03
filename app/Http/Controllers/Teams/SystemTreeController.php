<?php

namespace App\Http\Controllers\Teams;

use App\Core\AccountConstant;
use App\DataTables\Logs\SystemLogsDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Jackiedo\LogReader\LogReader;
use stdClass;

// class BinaryTree{

// }


class SystemTreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    function formatTree($tree, $parent)
    {
        $tree2 = array();
        foreach ($tree as $item) {
            if ($item['indirect_user_id'] == $parent) {
                // $tree2[$item['id']] = $item;
                $tree2[] = $item;
                $tree2 = array_merge($tree2, $this->formatTree($tree, $item['id']));
                // $tree2[] = $this->formatTree($tree, $item['id']);
                // $tree2[$item['id']]['child'] = $this->formatTree($tree, $item['id']);
            }
        }

        return $tree2;
    }

    public function index(SystemLogsDataTable $dataTable)
    {
        // $first = $users = User::with(['children' => function($q){
        //     $q->orderBy('created_at');
        // }])->Where(['username'=>'admin'])
        // ->get()->toArray();
        // dd($first);
        $root = null;

        // $root = User::insert_node($root, 50);
        // User::insert_node($root, 30);
        // User::insert_node($root, 20);
        // User::insert_node($root, 40);
        // User::insert_node($root, 70);
        // User::insert_node($root, 60);
        // User::insert_node($root, 80);
        // $user_id = auth()->user()->id;
        $user_id = auth()->user()->id;
        $user = User::with(['allChildren'])
        ->where('state' , AccountConstant::USER_STATE_PAID)
        ->where('id', $user_id)
        ->first();
        if(empty($user)){
            return redirect(route('wallet.upgrade.index'));
        }
        // $users = User::with('children', 'indirect_user')
        // ->where('direct_user_id', '<>', null)
        // ->where('indirect_user_id', '<>', null)
        //     // ->where('state' , AccountConstant::USER_STATE_PAID)
        //     ->orWhere(['username' => 'admin'])
        //     // ->orderBy('level')
        //     ->orderBy('created_at')
        //     ->get()->toArray();
            
        // dd($users);
        // $root = User::insert_node($root, $users[0]);
        // for($i = 1; $i < count($users); $i++){
        //     User::insert_node($root, $users[$i]);
        // }
        // $root = User::insert_node($root, $users[0]);
        // User::insert_node($root, $users[1]);
        // User::insert_node($root, $users[2]);
        // User::insert_node($root, $users[2]);
        // User::insert_node($root, $users[3]);
        // User::insert_node($root, $users[4]);
        // User::insert_node($root, $users[5]);
        // User::insert_node($root, $users[6]);
        // dd($root);
        // $arr = $users[0]['children'];
        // array_unshift($arr, $users[0]);

        // $n = count($users[0]['children']);
        // $root = User::insertLevelOrder($arr, 0, $n);
        // dd(User::search($root, '5a123888-8840-494e-acf4-c9cd44bdf7c1')));
        // User::insert_node($root, $users[7]);
        // User::insert_node2($root, $users[7]);
        // dd($root);

        // User::printPreorder($root, $tree);

        // $n = count($users);
        // $root = null;
        // $tree = '';
        // // foreach($users as $user){
        // //     User::insert($root, $user, $users);
        // // }
        // $root = User::insert($users, null);

        // dd($root);
        // $root = User::insertLevelOrder($users, 0, $n);

        // $level = User::getLevel($root, $users[11]);
        // dd($users[6]['first_name'], $level);
        // $nodeSearched = User::search($root, '28056440-e9b4-4467-9a43-0203ae1b335a');
        // $totalLeft = User::getTotalLeft($nodeSearched);
        // $totalRight = User::getTotalRight($nodeSearched);
        // dd($nodeSearched, $totalLeft, $totalRight);

        // dd($tree);
        // dd($users);
        // $this->insertLevelOrder($users, 0, $n, $tree);
        // $this->inOrder($root);
        // $$tree ='';
        // $afterTree = $this->formatTree($users, 0);
        // dd($tree);
        // dd($root);

        // User::printPreorder($root, $html);
        // dd($users[1]);

        // dd($html);
        // $user = User::find('e76294d6-38df-470a-a5ce-f62cb35cb8d2')->with('parents')->first();
        // $parents = $user->parents;
        // while(!empty($parents)){
        //     dd($parents);
        //     $parents = $parents->parents;
        // }
        $tree = [];

        User::generate_system_tree($user, $tree, null, 1, $total);
        // $total = User::calc_total($user);
        // dump($total);
        $tree = implode('', $tree);

        return view('team.system_tree.index', compact([
            'tree'
        ]));
    }
}
