<?php

namespace App\Http\Controllers\Teams;

use App\DataTables\Logs\SystemLogsDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Jackiedo\LogReader\LogReader;

class SystemTreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generate_system_tree($tree_data, &$new_data, $direct_user_id = 0, $level = 0){
        $children = [];
        foreach ($tree_data as $k => $item) {
            # code...
            if($item['direct_user_id'] == $direct_user_id){
                $item['level'] = $level;
                array_push($children, $item);
            }
        }
        if($children){
            array_push($new_data, '<ul>');
            foreach ($children as $k => $item) {
                $avatar = $item['avatar'] ? asset($item['avatar']) :  asset(theme()->getMediaUrlPath().'avatars/blank.png');
                # code...
                $full_name = $item['first_name'] .' '. $item['last_name'];
                array_push($new_data, "<li><a class='view_detail cursor-pointer' data-id='{$item['id']}' data-full_name='{$full_name}' data-level='{$item['level']}'>
                <div class='symbol symbol-50px symbol-sm-30px'>
																		<img src='{$avatar}' alt=''>
																	</div>
                </a>");
                $this->generate_system_tree($tree_data, $new_data, $item['id'], $level + 1);
                array_push($new_data, '</li>');
            }
            array_push($new_data, '</ul>');
        }
    }
    public function index(SystemLogsDataTable $dataTable)
    {
        $users = User::where('indirect_user_id', '<>', null)->orWhere(['username'=>'admin'])->get()->toArray();
        $tree = [];
        $this->generate_system_tree($users, $tree, null, 0);
        $tree = implode('', $tree);
        return view('team.system_tree.index', compact([
            'tree'
        ]));
    }
}
