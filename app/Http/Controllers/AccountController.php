<?php

namespace App\Http\Controllers;

use App\Models\Export_Rig;
use App\Models\RIG;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use function PHPUnit\Framework\isNull;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $current_user = Auth::user();
        $current_user_rigs = Export_Rig::where('username', $current_user->name)->get();
        return view('account', ['user' => $current_user, "rigs" => $current_user_rigs]);
    }

    public function changeInDetails()
    {
        $current_user = Auth::user();
        $current_user_rigs = Export_Rig::where('username', $current_user->name)->get();
        $username = request('username');
        $email = request('email');
        $oldPassword = request('oldPassword');
        $newPassword = request('newPassword');
        $confirmPass = request('confirmPass');
        if (!is_null($username)) {
            if ($username != $current_user->name&&!User::where('name', $username)->exists()) {
                $current_user->name = $username;
                $current_user->save();
            }
        } else if (!is_null($email)) {
            if ($email != $current_user->email &&!User::where('email', $email)->exists()) {
                $current_user->email = $email;
                $current_user->save();
            }
        } else if (!is_null($oldPassword) && !is_null($newPassword) && !is_null($confirmPass)) {
            if (Hash::check($oldPassword, $current_user->getAuthPassword()) &&
                !Hash::check($newPassword, $current_user->getAuthPassword()) &&
                $newPassword == $confirmPass) {
                $current_user->password = Hash::make($newPassword);
                $current_user->save();
            }
        }
        return view('account', ['user' => $current_user, "rigs" => $current_user_rigs]);
    }


}
