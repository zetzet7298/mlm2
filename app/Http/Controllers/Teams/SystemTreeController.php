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

    public function generate_system_tree($tree_data, &$new_data, $direct_user_id = 0, $level = 0)
    {
        $children = [];
        foreach ($tree_data as $k => $item) {
            # code...
            if ($item['direct_user_id'] == $direct_user_id) {
                $item['level'] = $level;
                array_push($children, $item);
            }
        }
        if ($children) {
            array_push($new_data, '<ul>');
            foreach ($children as $k => $item) {
                $avatar = $item['avatar'] ? asset($item['avatar']) :  asset(theme()->getMediaUrlPath() . 'avatars/blank.png');
                # code...
                $full_name = $item['first_name'] . ' ' . $item['last_name'];
                array_push($new_data, "<li><a class='view_detail cursor-pointer' data-id='{$item['id']}' data-full_name='{$full_name}' data-level='{$item['level']}'>
                <div class='symbol symbol-50px symbol-sm-30px'>
																		<img src='{$avatar}' alt=''>
                                                                        {$item['level']}
																	</div>
                </a>");
                $this->generate_system_tree($tree_data, $new_data, $item['id'], $level + 1);
                array_push($new_data, '</li>');
            }
            array_push($new_data, '</ul>');
        }
    }

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

        $users = User::where('direct_user_id', '<>', null)
            ->where('state' , AccountConstant::USER_STATE_PAID)
            ->orWhere(['username' => 'admin'])
            // ->orderBy('level')
            ->orderBy('created_at')
            ->get()->toArray();
        // dd($users);
        $n = count($users);
        $root = null;
        $tree = '';
        $root = User::insertLevelOrder($users, 0, $n);
        User::printPreorder($root, $tree);
        // $level = User::getLevel($root, $users[11]);
        // dd($users[6]['first_name'], $level);
        // $nodeSearched = User::search($root, '28056440-e9b4-4467-9a43-0203ae1b335a');
        // $totalLeft = User::getTotalLeft($nodeSearched);
        // $totalRight = User::getTotalRight($nodeSearched);
        // dd($nodeSearched, $totalLeft, $totalRight);

        // dd($tree);
        // dd($root);
        // $this->insertLevelOrder($users, 0, $n, $tree);
        // $this->inOrder($root);
        // $afterTree = $this->formatTree($users, 0);
        // dd($tree);
        // dd($root);

        // User::printPreorder($root, $html);
        // dd($users[1]);

        // dd($html);
        // $tree = [];
        // $this->generate_system_tree($users, $tree, null, 0);
        // $tree = implode('', $tree);
        return view('team.system_tree.index', compact([
            'tree'
        ]));
    }
}
