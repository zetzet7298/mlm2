<?php

namespace App\Http\Controllers\Teams;

use App\Core\AccountConstant;
use App\DataTables\Teams\FeeUserDataTable;
use App\DataTables\Teams\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jackiedo\LogReader\LogReader;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function confirm($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        if (empty($user)){
            return redirect()->back()->with("error", "Could not find user!");
        }
        if(User::isAdmin() == False){
            return redirect()->back()->with("error", "You are not admin!");
        }
        DB::beginTransaction();
        try {
            User::where('id', $id)->update(['state' => AccountConstant::USER_STATE_PAID, 'type' => AccountConstant::TYPE_USER_MEMBER]);
            // User::handleUpgrade($id, $user->direct_user_id);
            // auth()->user()->update([
            //     'direct_user_id' => $direct_user->id,
            //     'indirect_user_id' => $indirect_user->id,
            //     'state'             => AccountConstant::USER_STATE_PROCESSING
            // ]);
            DB::commit();
            return redirect()->back()->with("success", "Success!");
        }catch(\Exception $e){
            report($e);
            return redirect()->back()->with("error", "Failed!");
            DB::rollback();
        }
    }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('pages.teams.users.index');
    }

    public function indexFeeUsers(FeeUserDataTable $dataTable)
    {
        return $dataTable->render('pages.teams.fee-users.index');
    }
}
