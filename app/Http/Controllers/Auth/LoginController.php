<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $kabid = [4, 5, 6, 7];
        $subbag = [8, 9, 10];
        $subbid = [11, 12, 13, 14, 15, 16, 17, 18];
        $admin = [19, 20, 21, 22, 23];
        $staff = [24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34];

        if($user->role == 1 && $user->status == 1){
            return redirect('/superadmin/dashboard');
        }else if($user->role == 2 && $user->status == 1){
            return redirect('/kepalabadan/dashboard');
        }else if($user->role == 3 && $user->status == 1){
            return redirect('/sekretaris/dashboard');
        }else if(in_array($user->role, $kabid) && $user->status == 1){
            return redirect('/kabid/dashboard');
        }else if(in_array($user->role, $subbag) && $user->status == 1){
            return redirect('/subbag/dashboard');
        }else if(in_array($user->role, $subbid) && $user->status == 1){
            return redirect('/subbid/dashboard');
        }else if(in_array($user->role, $admin) && $user->status == 1){
            return redirect('/admin/dashboard');
        }else if(in_array($user->role, $staff) && $user->status == 1){
            return redirect('/staff/dashboard');
        }
    }

    public function username()
    {
        return 'nip';
    }
}
