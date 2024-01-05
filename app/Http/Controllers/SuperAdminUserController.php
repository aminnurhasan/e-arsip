<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = User::where('role', '!=', 1)->get();
        return view ('user.super_admin.user.index', compact('user'));
    }

    public function status($id)
    {
        $user = User::findOrFail($id);
        $statusGet = $user->status;
        // dd($user);
        if($statusGet == 0) {
            $user->update(['status' => 1]);
            return redirect()->route('userSuperAdmin');
        }else{
            $user->update(['status' => 0]);
            return redirect()->route('userSuperAdmin');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        return view ('user.super_admin.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jabatan = "";
        $role = $request->input('role');
        if ($role == 1){
            $jabatan = "Super Admin";
        }elseif ($role == 2){
            $jabatan = "Kepala Badan";
        }elseif ($role == 3){
            $jabatan = "Sekretaris";
        }elseif ($role == 4){
            $jabatan = "Kepala Bidang Anggaran";
        }elseif ($role == 5){
            $jabatan = "Kepala Bidang Perbendaharaan";
        }elseif ($role == 6){
            $jabatan = "Kepala Bidang Akuntansi";
        }elseif ($role == 7){
            $jabatan = "Kepala Bidang Aset";
        }elseif ($role == 8){
            $jabatan = "Kepala Subbag Perencanaan dan Evaluasi";
        }elseif ($role == 9){
            $jabatan = "Kepala Subbag Keuangan";
        }elseif ($role == 10){
            $jabatan = "Kepala Subbag Umum dan Kepegawaian";
        }elseif ($role == 11){
            $jabatan = "Kepala Subbid Anggaran Pendapatan dan Pembiayaan";
        }elseif ($role == 12){
            $jabatan = "Kepala Subbid Anggaran Belanja";
        }elseif ($role == 13){
            $jabatan = "Kepala Subbid Pengelolaan Kas";
        }elseif ($role == 14){
            $jabatan = "Kepala Subbid Administrasi Perbendaharaan";
        }elseif ($role == 15){
            $jabatan = "Kepala Subbid Pembukuan dan Pelaporan";
        }elseif ($role == 16){
            $jabatan = "Kepala Subbid Verifikasi";
        }elseif ($role == 17){
            $jabatan = "Kepala Subbid Perencanaan dan Penatausahaan";
        }else{
            $jabatan = "Kepala Subbid Penggunaan dan Pemanfaatan";
        }

        $request -> validate ([
            'nip' => 'required| unique:user',
            'name' => 'required',
            'email' => 'required| unique:user| email',
            'role' => 'required',
        ],[
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP sudah terdaftar',
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Email tidak valid',
            'role.required' => 'Jabatan tidak boleh kosong',
        ]);

        $user = [
            'nip' => $request -> nip,
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> nip),
            'role' => $request -> role,
            'jabatan' => $jabatan,
        ];
        // dd($user);
        User::create($user);
        return redirect ('/superadmin/user') -> with ('status', 'Data User Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $user = User::findOrFail($id);
          $roles = [
            ['id' => 1, 'name' => 'Super Admin' ],
            ['id' => 2, 'name' => 'Kepala Badan' ],
            ['id' => 3, 'name' => 'Sekretaris' ],
            ['id' => 4, 'name' => 'Kepala Bidang Anggaran' ],
            ['id' => 5, 'name' => 'Kepala Bidang Perbendaharaan' ],
            ['id' => 6, 'name' => 'Kepala Bidang Akuntansi' ],
            ['id' => 7, 'name' => 'Kepala Bidang Aset' ],
            ['id' => 8, 'name' => 'Kepala Subbag Perencanaan dan Evaluasi' ],
            ['id' => 9, 'name' => 'Kepala Subbag Keuangan' ],
            ['id' => 10, 'name' => 'Kepala Subbag Umum dan Kepegawaian' ],
            ['id' => 11, 'name' => 'Kepala Subbid Anggaran Pendapatan dan Pembiayaan' ],
            ['id' => 12, 'name' => 'Kepala Subbid Anggaran Belanja' ],
            ['id' => 13, 'name' => 'Kepala Subbid Pengelolaan Kas' ],
            ['id' => 14, 'name' => 'Kepala Subbid Administrasi Perbendaharaan' ],
            ['id' => 15, 'name' => 'Kepala Subbid Pembukuan dan Pelaporan' ],
            ['id' => 16, 'name' => 'Kepala Subbid Verifikasi' ],
            ['id' => 17, 'name' => 'Kepala Subbid Perencanaan dan Penatausahaan' ],
            ['id' => 18, 'name' => 'Kepala Subbid Penggunaan dan Pemanfaatan' ],
          ];
          return view ('user.super_admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User :: findOrFail($id);

        $jabatan = "";
        $role = $request->input('role');
        if ($role == 1){
            $jabatan = "Super Admin";
        }elseif ($role == 2){
            $jabatan = "Kepala Badan";
        }elseif ($role == 3){
            $jabatan = "Sekretaris";
        }elseif ($role == 4){
            $jabatan = "Kepala Bidang Anggaran";
        }elseif ($role == 5){
            $jabatan = "Kepala Bidang Perbendaharaan";
        }elseif ($role == 6){
            $jabatan = "Kepala Bidang Akuntansi";
        }elseif ($role == 7){
            $jabatan = "Kepala Bidang Aset";
        }elseif ($role == 8){
            $jabatan = "Kepala Subbag Perencanaan dan Evaluasi";
        }elseif ($role == 9){
            $jabatan = "Kepala Subbag Keuangan";
        }elseif ($role == 10){
            $jabatan = "Kepala Subbag Umum dan Kepegawaian";
        }elseif ($role == 11){
            $jabatan = "Kepala Subbid Anggaran Pendapatan dan Pembiayaan";
        }elseif ($role == 12){
            $jabatan = "Kepala Subbid Anggaran Belanja";
        }elseif ($role == 13){
            $jabatan = "Kepala Subbid Pengelolaan Kas";
        }elseif ($role == 14){
            $jabatan = "Kepala Subbid Administrasi Perbendaharaan";
        }elseif ($role == 15){
            $jabatan = "Kepala Subbid Pembukuan dan Pelaporan";
        }elseif ($role == 16){
            $jabatan = "Kepala Subbid Verifikasi";
        }elseif ($role == 17){
            $jabatan = "Kepala Subbid Perencanaan dan Penatausahaan";
        }else{
            $jabatan = "Kepala Subbid Penggunaan dan Pemanfaatan";
        }

        $update = [
            'nip' => $request -> nip,
            'name' => $request -> name,
            'email' => $request -> email,
            'role' => $request -> role,
            'jabatan' => $jabatan,
        ];
        $user -> update($update);
        return redirect ('/superadmin/user') -> with ('status', 'Data User Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
