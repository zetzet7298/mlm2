<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Password2Request;
use App\Http\Requests\Account\SettingsEmailRequest;
use App\Http\Requests\Account\SettingsInfoRequest;
use App\Http\Requests\Account\SettingsPasswordRequest;
use App\Http\Requests\Account\SettingsPassword2Request;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $info = auth()->user()->info;

        // get the default inner page
        return view('pages.account.settings.security', compact('info'));
    }

    /**
     * Function to accept request for change password
     *
     * @param  SettingsPasswordRequest  $request
     */
    public function changePassword(SettingsPasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->input('password'))]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }

        return redirect()->intended('account/settings');
    }

    /**
     * Function to accept request for change password
     *
     * @param  SettingsPasswordRequest  $request
     */
    public function changePassword2(SettingsPassword2Request $request)
    {
        // // prevent change password for demo account
        // if ($request->input('current_email') === 'admin@admin.com') {
        //     return redirect()->intended('account/settings');
        // }

        auth()->user()->update(['password2' => Hash::make($request->input('password2'))]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }

        return redirect()->intended('account/settings');
    }


    /**
     * Function to accept request for change password
     *
     * @param  SettingsPasswordRequest  $request
     */
    public function createPassword2(Request $request)
    {
        // dd($request->all());
        if($request->password2 != $request->password2_confirmation){
            return redirect()->back()->with("error", "Level 2 Password Confirmation Does Not Match");
        }
        DB::beginTransaction();
        try {
            auth()->user()->update(['password2' => Hash::make($request->input('password2'))]);
            DB::commit();
            return redirect()->back()->with("success", "Success!");
        }catch(\Exception $e){
            report($e);
            DB::rollback();
            return redirect()->back()->with("error", "Failed");
        }
    }
}
