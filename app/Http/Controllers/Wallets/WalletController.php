<?php

namespace App\Http\Controllers\Wallets;

use App\Core\AccountConstant;
use App\DataTables\Logs\SystemLogsDataTable;
use App\DataTables\Wallets\IncomeDataTable;
use App\DataTables\Wallets\TransferDataTable;
use App\DataTables\Wallets\WithdrawalDataTable;
use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jackiedo\LogReader\LogReader;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexUpgrade(SystemLogsDataTable $dataTable)
    {
        $receiver = User::getAdmin();
        return view('pages.wallets.upgrade.index', compact([
            'receiver'
        ]));
    }

    public function create(Request $request){
        if(empty(User::where(['username' => $request->username])->first()) || $request->username == auth()->user()->username){
            return redirect()->back()->with("error", "Receiver Not Exists!");
        }
        if($request->coin > auth()->user()->coin){
            return redirect()->back()->with("error", "Insufficient balance to transfer!");
        }
        if(Hash::check($request->password2, auth()->user()->password2) == False){
            return redirect()->back()->with("error", "Level 2 password does not match, please check again!");
        }
        DB::beginTransaction();
        try {     
            $receiver = User::where(['username' => $request->username])->first();
            $new_coin = auth()->user()->coin - floatval($request->coin);
            $receiver_new_coin = $receiver->coin + floatval($request->coin);
            auth()->user()->update([
                'coin' =>  $new_coin,
            ]);
            User::where(['username' => $request->username])->update([
                'coin' =>  $receiver_new_coin,
            ]);
            Transfer::create([
                'sender_id'        => auth()->user()->id,
                'receiver_id'         => $receiver->id,
                'coin'             => $receiver_new_coin,
                'content'             => 'Transfer coin',
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Success!");
            // all good
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with("error", "Failed");
            // something went wrong
        }
    }

    public function upgrade(Request $request)
    {
        if(auth()->user()->type != AccountConstant::TYPE_USER_FREE)
        {
            return redirect()->back()->with("error", "Already Member!");
        }
        // dd(User::where(['id' => $request->direct_user_id])->first());
        $direct_user = User::where(['username' => $request->direct_user_id])->first();
        $indirect_user = User::where(['username' => $request->indirect_user_id])->first();
        if(empty($direct_user) || $request->direct_user_id == auth()->user()->username){
            return redirect()->back()->with("error", "Direct User Code Not Exists!");
        }else{
            $count = User::where(['direct_user_id' => $direct_user->id])->count();
            if($count >= 2){
                return redirect()->back()->with("error", "This code has exhausted all entries!");
            }
        }
        if(empty($indirect_user) || $request->indirect_user_id == auth()->user()->username){
            return redirect()->back()->with("error", "Indirect User Code Not Exists!");
        }
        DB::beginTransaction();
        try {
            // Income::create([
            //     'user_id'        => $user1->id,
            //     'coin'             => 11,
            // ]);
            if($request->enough){
                Transfer::create([
                    'sender_id'        => auth()->user()->id,
                    'receiver_id'         => auth()->user()->id,
                    'coin'             => -AccountConstant::COIN_NEED_UPGRADE,
                    'content'             => 'Upgrade account',
                ]);
                $new_coin = auth()->user()->coin - AccountConstant::COIN_NEED_UPGRADE;
                auth()->user()->update([
                    'coin' =>  $new_coin,
                    'type' => AccountConstant::TYPE_USER_MEMBER,
                    'direct_user_id' => $direct_user->id,
                    'indirect_user_id' => $indirect_user->id,
                    'state'             => AccountConstant::USER_STATE_PAID
                ]);
            }else{
                $admin = User::getAdmin();
                Transfer::create([
                    'sender_id'        => $admin->id,
                    'receiver_id'         => auth()->user()->id,
                    'coin'             => AccountConstant::ADMIN_TRANSFER,
                    'content'             => 'Send Request To Upgrade account',
                ]);
                auth()->user()->update([
                    'direct_user_id' => $direct_user->id,
                    'indirect_user_id' => $indirect_user->id,
                    'state'             => AccountConstant::USER_STATE_PROCESSING
                ]);
            }
            DB::commit();
            return redirect()->back()->with("success", "Success!");
            // all good
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with("error", "Failed");
            // something went wrong
        }
    }

    public function indexIncomeHistory(IncomeDataTable $dataTable)
    {
        return $dataTable->render('pages.wallets.income.index');
    }
    public function indexTransferHistory(TransferDataTable $dataTable)
    {
        return $dataTable->render('pages.wallets.transfer.index');

    }
    public function indexWithdrawalHistory(WithdrawalDataTable $dataTable)
    {
        return $dataTable->render('pages.wallets.withdrawal.index');

    }
}
