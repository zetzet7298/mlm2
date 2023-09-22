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
        if(User::isAdmin() == False){
            return redirect()->back()->with("error", "You are not admin!");
        }
        DB::beginTransaction();
        try {
            User::where('id', $id)->update(['state' => AccountConstant::USER_STATE_PAID, 'type' => AccountConstant::TYPE_USER_MEMBER]);
            DB::commit();
            return redirect()->back()->with("success", "Success!");
        }catch(\Exception $e){
            report($e);
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
