<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SettingsEmailRequest;
use App\Http\Requests\Account\SettingsInfoRequest;
use App\Http\Requests\Account\SettingsPasswordRequest;
use App\Http\Requests\Account\SettingsPassword2Request;
use App\Models\UserInfo;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsInfoRequest $request)
    {
        // save user name
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
        ]);
        dd($validated);
        auth()->user()->update($validated);

        // save on user info
        // $info = UserInfo::where('user_id', auth()->user()->id)->first();

        // if ($info === null) {
        //     // create new model
        //     $info = new UserInfo();
        // }

        // attach this info to the current user
        // $info->user()->associate(auth()->user());

        // foreach ($request->only(array_keys($request->rules())) as $key => $value) {
        //     if (is_array($value)) {
        //         $value = serialize($value);
        //     }
        //     $info->$key = $value;
        // }

        // include to save avatar
        if ($avatar = $this->upload()) {
            $info->avatar = $avatar;
        }

        if ($request->boolean('avatar_remove')) {
            Storage::delete($info->avatar);
            $info->avatar = null;
        }

        $info->save();

        return redirect()->intended('account/settings');
    }

    /**
     * Function to accept request for change email
     *
     * @param  SettingsEmailRequest  $request
     */
    public function changeEmail(SettingsEmailRequest $request)
    {
        // prevent change email for demo account
        if ($request->input('current_email') === 'admin@admin.com') {
            return redirect()->intended('account/settings');
        }

        auth()->user()->update(['email' => $request->input('email')]);

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
    public function changePassword(SettingsPasswordRequest $request)
    {
        // prevent change password for demo account
        if ($request->input('current_email') === 'admin@admin.com') {
            return redirect()->intended('account/settings');
        }

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
        // prevent change password for demo account
        if ($request->input('current_email') === 'admin@admin.com') {
            return redirect()->intended('account/settings');
        }

        auth()->user()->update(['password2' => Hash::make($request->input('password2'))]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }

        return redirect()->intended('account/settings');
    }
}
