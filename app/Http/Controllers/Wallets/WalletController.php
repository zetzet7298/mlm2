<?php

namespace App\Http\Controllers\Wallets;

use App\Core\AccountConstant;
use App\DataTables\Logs\SystemLogsDataTable;
use App\DataTables\Wallets\IncomeDataTable;
use App\DataTables\Wallets\TransferDataTable;
use App\DataTables\Wallets\WithdrawalDataTable;
use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
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

    public function confirm($id){
        if(!User::isAdmin()){
            return redirect()->back()->with("error", "Now allow!");
        }
        $find = Withdrawal::find($id);
        if(empty($find)){
            return redirect()->back()->with("error", "Not found!");
        }
        DB::beginTransaction();
        try {     
            $user = User::find($find->user_id);
            $new_coin = $user->coin - floatval($find->coin);
            User::where('id', $find->user_id)->update([
                'coin' =>  $new_coin,
            ]);

            Withdrawal::where('id', $id)->update([
                'is_received' => true
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

    public function withdrawal(Request $request){
        // if(empty(User::where(['username' => $request->username])->first()) || $request->username == auth()->user()->username){
        //     return redirect()->back()->with("error", "Receiver Not Exists!");
        // }
        if(auth()->user()->coin < 100){
            return redirect()->back()->with("error", "A minimum account balance of $100 is allowed to withdraw!");
        }
        if($request->coin > auth()->user()->coin){
            return redirect()->back()->with("error", "Insufficient balance!");
        }
        if(Hash::check($request->password2, auth()->user()->password2) == False){
            return redirect()->back()->with("error", "Level 2 password does not match, please check again!");
        }
        DB::beginTransaction();
        try {     
            $new_coin = auth()->user()->coin - floatval($request->coin);
            auth()->user()->update([
                'coin' =>  $new_coin,
            ]);

            Withdrawal::create([
                'user_id'        => auth()->user()->id,
                'address'        => $request->address,
                'coin'             => floatval($request->coin),
                'content'             => 'Cashwithdrawal',
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

    function handle_income($user_id, $coin, $content){
        $direct_coin = AccountConstant::DIRECT_COMISSION;
        Income::create([
            'user_id' => $user_id,
            'coin' => $direct_coin,
            'content' => $content
        ]);
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
            $count = User::where(['indirect_user_id' => $indirect_user->id])->count();
            if($count >= 2){
                return redirect()->back()->with("error", "This indirect code has exhausted all entries!");
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
                    // 'txid'        => $request->txid,
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
                    // 'state'             => AccountConstant::USER_STATE_PAID
                ]);
                User::handleUpgrade(auth()->user()->id, $direct_user->id);
            }else{
                $admin = User::getAdmin();
                Transfer::create([
                    'txid'        => $request->txid,
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

            // $users = User::where('indirect_user_id', '<>', null)
            // ->orWhere(['username' => 'admin'])
            // ->orderBy('level')
            // ->orderBy('created_at')
            // ->get()->toArray();

            // $n = count($users);
            // $root = null;
            // $root = User::insertLevelOrder($users, 0, $n);
            // $level = User::getLevel($root, $users[6]);
            // $totalLeft = User::getTotalLeft($root);
            // // dd($totalLeft);
            // $totalRight = User::getTotalRight($root);
            // $totalNode = $totalLeft + $totalRight;
            // // dd($totalRight);

            // foreach($users as $user){
            //     $gold_commission = 0;
            //     $total_coin = 0;
            //     $new_type = User::getAccountType(auth()->user()->type, $totalLeft, $totalRight);
            //     User::where(['id' => $user['id']])->update(['type' => $new_type]);
            //     // switch($user['type']){
            //     switch($new_type){
            //         case AccountConstant::TYPE_USER_SAPHIRE:
            //             $count_user_saphire = User::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
            //             if ($count_user_saphire > 0){
            //                 $gold_commission = (AccountConstant::DIRECT_COMISSION * (3/100))/$count_user_saphire;
            //             }
            //             break;
            //         case AccountConstant::TYPE_USER_RUBY:
            //             $count_user_ruby = User::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
            //             if ($count_user_ruby > 0){
            //                 $gold_commission = (AccountConstant::DIRECT_COMISSION * (5/100))/$count_user_ruby;
            //             }
            //             break;
            //         case AccountConstant::TYPE_USER_DIAMOND:
            //             $count_user_diamond = User::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
            //             if ($count_user_diamond > 0){
            //                 $gold_commission= (AccountConstant::DIRECT_COMISSION * (7/100))/$count_user_diamond;
            //             }
            //             break;
            //     }

            //     if($gold_commission > 0 || $user['id'] == $direct_user->id || $totalNode > 0){
            //         $total_coin = $user['coin'];
            //         $content = '';
            //         if($user['id'] == $direct_user->id){
            //             $total_coin += AccountConstant::DIRECT_COMISSION;
            //             $content = 'direct commission';
            //             Income::create([
            //                 'user_id'        => $user->id,
            //                 'coin'             => AccountConstant::DIRECT_COMISSION,
            //                 'content'             => $content,
            //             ]);
            //         }
            //         if($gold_commission > 0){
            //             $total_coin += $gold_commission;
            //             $content = "{$new_type} commission";
            //             Income::create([
            //                 'user_id'        => $user->id,
            //                 'coin'             => $gold_commission,
            //                 'content'             => $content,
            //             ]);
            //         }
            //         User::where(['id' => $user['id']])->update([
            //             'coin' => $total_coin
            //         ]);
            //         if($totalNode > 0){
            //             $coin = $totalNode * AccountConstant::INDIRECT_COMISSION;
            //             $total_coin += $gold_commission;
            //             $content = "{$new_type} commission";
            //             Income::create([
            //                 'user_id'        => $user->id,
            //                 'coin'             => $coin,
            //                 'content'             => $content,
            //             ]);
            //         }
            //     }
            // }
            DB::commit();
            return redirect()->back()->with("success", "Success!");
            // all good
        } catch (\Exception $e) {
            dd($e);
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
