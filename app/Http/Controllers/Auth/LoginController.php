<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->role == 1 && $user->status == 1){
            return redirect('/superadmin/dashboard');
        }else if($user->role == 2 && $user->status == 1){
            return redirect('/kepalabadan/dashboard');
        }else if($user->role == 3 && $user->status == 1){
            return redirect('/sekretaris/dashboard');
        }else if($user->role == 4 && $user->status == 1){
            return redirect('/b_anggaran/dashboard');
        }else if($user->role == 5 && $user->status == 1){
            return redirect('/b_perbendaharaan/dashboard');
        }else if($user->role == 6 && $user->status == 1){
            return redirect('/b_akuntansi/dashboard');
        }else if($user->role == 7 && $user->status == 1){
            return redirect('/b_aset/dashboard');
        }else if($user->role == 8 && $user->status == 1){
            return redirect('/subbag_perencanaan/dashboard');
        }else if($user->role == 9 && $user->status == 1){
            return redirect('/subbag_keuangan/dashboard');
        }else if($user->role == 10 && $user->status == 1){
            return redirect('/subbag_umum/dashboard');
        }else if($user->role == 11 && $user->status == 1){
            return redirect('/subbid_anggaran_pendapatan/dashboard');
        }else if($user->role == 12 && $user->status == 1){
            return redirect('/subbid_anggaran_belanja/dashboard');
        }else if($user->role == 13 && $user->status == 1){
            return redirect('/subbid_pengelolaan/dashboard');
        }else if($user->role == 14 && $user->status == 1){
            return redirect('/subbid_administrasi/dashboard');
        }else if($user->role == 15 && $user->status == 1){
            return redirect('/subbid_pembukuan/dashboard');
        }else if($user->role == 16 && $user->status == 1){
            return redirect('/subbid_verifikasi/dashboard');
        }else if($user->role == 17 && $user->status == 1){
            return redirect('/subbid_perencanaan/dashboard');
        }else if($user->role == 18 && $user->status == 1){
            return redirect('/subbid_penggunaan/dashboard');
        }
    }

    public function username()
    {
        return 'nip';
    }
}
