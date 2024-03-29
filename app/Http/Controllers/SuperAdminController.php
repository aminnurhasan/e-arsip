<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Dokumentasi;
use App\Models\Foto;
use App\Models\Disposisi;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Notifications\AgendaAddNotification;
use App\Mail\agendaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = User::where('role', '!=', 1)->count();
        $agenda = Agenda::all()->count();
        $peraturan = Arsip::where('jenis_dokumen', 1)->count();
        $apbd = Arsip::where('jenis_dokumen', 2)->count();
        $keuangan = Arsip::where('jenis_dokumen', 3)->count();
        $slide = Arsip::where('jenis_dokumen', 4)->count();
        $lainnya = Arsip::where('jenis_dokumen', 5)->count();
        $dokumentasi = Dokumentasi::all()->count();

        return view ('user.super_admin.dashboard', compact('user', 'agenda', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya'));
    }

    // Agenda Start
    public function indexAgenda()
    {
        $agenda = Agenda::where('status', 0)->get();
        return view ('user.super_admin.agenda.index', compact('agenda'));
    }

    public function disposisiAgenda(){
        $agenda = Agenda::where('status', 1)->get();
        return view ('user.super_admin.agenda.disposisi', compact('agenda'));
    }

    public function createAgenda()
    {
        $agenda = Agenda::where('status', 1)->get();
        return view ('user.super_admin.agenda.create', compact('agenda'));
    }

    public function storeAgenda(Request $request)
    {
        $request->validate([
            'jenis_dokumen' => 'required',
            'tanggal_dokumen' => 'required',
            'asal_dokumen' => 'required',
            'perihal' => 'required',
            'file' => 'required|mimes:pdf,doc,docx',
        ], [
            'jenis_dokumen.required' => 'Jenis Dokumen tidak boleh kosong',
            'tanggal_dokumen.required' => 'Tanggal Dokumen tidak boleh kosong',
            'asal_dokumen.required' => 'Asal Dokumen tidak boleh kosong',
            'perihal.required' => 'Perihal tidak boleh kosong',
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berupa pdf, doc, docx',
        ]);

        $file = $request->file('file');
        $file_path = $file->storeAs('agenda', $file->getClientOriginalName(), 'public');

        $agenda = new Agenda;
        $agenda->jenis_dokumen = $request->jenis_dokumen;
        $agenda->tanggal_dokumen = $request->tanggal_dokumen;
        $agenda->nomor_dokumen = $request->nomor_dokumen;
        $agenda->asal_dokumen = $request->asal_dokumen;
        $agenda->perihal = $request->perihal;
        $agenda->file_path = $file_path;
        $agenda->status = 0;
        $agenda->save();

        $disposisi = new Disposisi;
        $disposisi->agenda_id = $agenda->id;
        $disposisi->disposisi = 2;
        $disposisi->save();

        $kepalaBadan = User::where('role', 2)->first();
        $kepalaBadan->notify(new AgendaAddNotification($agenda));

        Alert::success('Berhasil', 'Berhasil Menambahkan Data Agenda');
        return redirect()->route('agendaSuperAdmin');
    }

    public function destroyAgenda($id)
    {
        $agenda = Agenda::find($id);

        Agenda::where('id', $id)->delete();
        Storage::disk('public')->delete($agenda->file_path);
        alert()->success('Berhasil', 'Berhasil Menghapus Data Agenda');
        return redirect()->route('agendaSuperAdmin');
    }
    // Agenda End

    // Arsip Start
    public function indexArsip()
    {
        $arsip = Arsip::all();

        $peraturan = Arsip::where('jenis_dokumen', 1)->count();
        $apbd = Arsip::where('jenis_dokumen', 2)->count();
        $keuangan = Arsip::where('jenis_dokumen', 3)->count();
        $slide = Arsip::where('jenis_dokumen', 4)->count();
        $lainnya = Arsip::where('jenis_dokumen', 5)->count();
        $dokumentasi = Dokumentasi::all()->count();
        $suratMasuk = Agenda::join('disposisi', 'agenda.id', '=', 'disposisi.agenda_id')
            ->where('disposisi.selesaikan', 1)
            ->select('agenda.id AS id', 'agenda.tanggal_dokumen AS tanggal_dokumen', 'agenda.nomor_dokumen AS nomor_dokumen', 'agenda.asal_dokumen AS asal_dokumen', 'agenda.perihal AS perihal', 'agenda.file_path AS file_path', 'disposisi.selesaikan AS selesaikan')
            ->count();

        return view ('user.super_admin.arsip.index', compact('arsip', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya', 'suratMasuk'));
    }

    public function createArsip()
    {
        $arsip = Arsip::all();
        return view ('user.super_admin.arsip.create', compact('arsip'));
    }

    public function storeArsip(Request $request)
    {
        $request->validate([
            'pengelola' => 'required',
            'jenis_dokumen' => 'required',
            'tanggal_dokumen' => 'required',
            'asal_dokumen' => 'required',
            'perihal' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx',
        ], [
            'pengelola.required' => 'Pengelola harus diisi!',
            'jenis_dokumen.required' => 'Jenis Dokumen harus diisi!',
            'tanggal_dokumen.required' => 'Tanggal Dokumen harus diisi!',
            'asal_dokumen.required' => 'Asal Dokumen harus diisi!',
            'perihal.required' => 'Perihal harus diisi!',
            'file.required' => 'File harus diisi!',
            'file.mimes' => 'File harus berupa pdf, doc, docx, ppt, atau pptx!',
        ]);

        $file = $request->file('file');
        $file_path = $file->storeAs('arsip', $file->getClientOriginalName(), 'public');

        $arsip = [
            'pengelola' => $request->pengelola,
            'jenis_dokumen' => $request->jenis_dokumen,
            'tanggal_dokumen' => $request->tanggal_dokumen,
            'nomor_dokumen' => $request->nomor_dokumen,
            'asal_dokumen' => $request->asal_dokumen,
            'perihal' => $request->perihal,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'file_path' => $file_path,
        ];

        Arsip::create($arsip);
        Alert::success('Berhasil', 'Berhasil Menambahkan Data Arsip');
        return redirect()->route('arsipSuperAdmin');
    }

    public function editArsip($id)
    {
        $arsip = Arsip::findOrFail($id);
        return view ('user.super_admin.arsip.edit', compact('arsip'));
    }

    public function updateArsip(Request $request, $id)
    {
        $arsip = Arsip::findOrFail($id);
        $request->validate([
            'pengelola' => 'required',
            'jenis_dokumen' => 'required',
            'tanggal_dokumen' => 'required',
            'asal_dokumen' => 'required',
            'perihal' => 'required',
            'file' => 'sometimes|mimes:pdf,doc,docx,ppt,pptx',
        ], [
            'pengelola.required' => 'Pengelola harus diisi!',
            'jenis_dokumen.required' => 'Jenis Dokumen harus diisi!',
            'tanggal_dokumen.required' => 'Tanggal Dokumen harus diisi!',
            'asal_dokumen.required' => 'Asal Dokumen harus diisi!',
            'perihal.required' => 'Perihal harus diisi!',
            'file.mimes' => 'File harus berupa pdf, doc, docx, ppt, atau pptx!',
        ]);

        if ($request->file('file') == '') {
            $arsip->update([
                'pengelola' => $request->pengelola,
                'jenis_dokumen' => $request->jenis_dokumen,
                'tanggal_dokumen' => $request->tanggal_dokumen,
                'nomor_dokumen' => $request->nomor_dokumen,
                'asal_dokumen' => $request->asal_dokumen,
                'perihal' => $request->perihal,
            ]);
        } else {
            $file = $request->file('file');
            $file_path = $file->storeAs('arsip', $file->getClientOriginalName(), 'public');

            $arsip->update([
                'pengelola' => $request->pengelola,
                'jenis_dokumen' => $request->jenis_dokumen,
                'tanggal_dokumen' => $request->tanggal_dokumen,
                'nomor_dokumen' => $request->nomor_dokumen,
                'asal_dokumen' => $request->asal_dokumen,
                'perihal' => $request->perihal,
                'file_path' => $file_path,
            ]);
        }

        Alert::success('Berhasil', 'Berhasil Mengubah Data Arsip');
        return redirect()->route('arsipSuperAdmin');
    }

    public function peraturanIndex()
    {
        $years = Arsip::selectRaw('YEAR(tanggal_dokumen) as year')->distinct()->pluck('year')->toArray();
        $peraturan = Arsip::where('jenis_dokumen', 1)->get();
        return view ('user.super_admin.arsip.peraturan.index', compact('peraturan', 'years'));
    }

    public function peraturanFilter(Request $request)
{
        $tahun = $request->tahun;
        $data = Arsip::whereYear('tanggal_dokumen', $tahun)
            ->where('jenis_dokumen', 1)
            ->get();

        return response()->json(['data' => $data]);
    }

    public function apbdIndex()
    {
        $years = Arsip::selectRaw('YEAR(tanggal_dokumen) as year')->distinct()->pluck('year')->toArray();
        $apbd = Arsip::where('jenis_dokumen', 2)->get();
        return view ('user.super_admin.arsip.apbd.index', compact('apbd', 'years'));
    }

    public function apbdFilter(Request $request)
    {
        $tahun = $request->tahun;
        $data = Arsip::whereYear('tanggal_dokumen', $tahun)
            ->where('jenis_dokumen', 2)
            ->get();

        return response()->json(['data' => $data]);
    }

    public function keuanganIndex()
    {
        $years = Arsip::selectRaw('YEAR(tanggal_dokumen) as year')->distinct()->pluck('year')->toArray();
        $keuangan = Arsip::where('jenis_dokumen', 3)->get();
        return view ('user.super_admin.arsip.keuangan.index', compact('keuangan', 'years'));
    }

    public function keuanganFilter(Request $request)
    {
        $tahun = $request->tahun;
        $data = Arsip::whereYear('tanggal_dokumen', $tahun)
            ->where('jenis_dokumen', 3)
            ->get();

        return response()->json(['data' => $data]);
    }

    public function slideIndex()
    {
        $years = Arsip::selectRaw('YEAR(tanggal_dokumen) as year')->distinct()->pluck('year')->toArray();
        $slide = Arsip::where('jenis_dokumen', 4)->get();
        return view ('user.super_admin.arsip.slide.index', compact('slide', 'years'));
    }

    public function slideFilter(Request $request)
    {
        $tahun = $request->tahun;
        $data = Arsip::whereYear('tanggal_dokumen', $tahun)
            ->where('jenis_dokumen', 4)
            ->get();

        return response()->json(['data' => $data]);
    }

    public function lainnyaIndex()
    {
        $years = Arsip::selectRaw('YEAR(tanggal_dokumen) as year')->distinct()->pluck('year')->toArray();
        $lainnya = Arsip::where('jenis_dokumen', 5)->get();
        return view ('user.super_admin.arsip.lainnya.index', compact('lainnya', 'years'));
    }

    public function lainnyaFilter(Request $request)
    {
        $tahun = $request->tahun;
        $data = Arsip::whereYear('tanggal_dokumen', $tahun)
            ->where('jenis_dokumen', 5)
            ->get();

        return response()->json(['data' => $data]);
    }

    public function suratMasukIndex()
    {
        $years = Agenda::selectRaw('YEAR(tanggal_dokumen) as year')->distinct()->pluck('year')->toArray();
        $suratMasuk = Agenda::join('disposisi', 'agenda.id', '=', 'disposisi.agenda_id')
            ->where('disposisi.selesaikan', 1)
            ->select('agenda.id AS id', 'agenda.tanggal_dokumen AS tanggal_dokumen', 'agenda.nomor_dokumen AS nomor_dokumen', 'agenda.asal_dokumen AS asal_dokumen', 'agenda.perihal AS perihal', 'agenda.file_path AS file_path', 'agenda.tindak_lanjut AS tindak_lanjut', 'disposisi.selesaikan AS selesaikan')
            ->get();
        return view ('user.super_admin.arsip.surat_masuk.index', compact('suratMasuk', 'years'));
    }

    public function suratMasukFilter(Request $request)
    {
        $tahun = $request->tahun;
        $data = Agenda::join('disposisi', 'agenda.id', '=', 'disposisi.agenda_id')
            ->where('disposisi.selesaikan', 1)
            ->whereYear('agenda.tanggal_dokumen', $tahun)
            ->select('agenda.id AS id', 'agenda.tanggal_dokumen AS tanggal_dokumen', 'agenda.nomor_dokumen AS nomor_dokumen', 'agenda.asal_dokumen AS asal_dokumen', 'agenda.perihal AS perihal', 'agenda.file_path AS file_path', 'agenda.tindak_lanjut AS tindak_lanjut', 'disposisi.selesaikan AS selesaikan')
            ->get();
        
        return response()->json(['data' => $data]);
    }
    // Arsip End

    // Dokumentasi Start
    public function indexDokumentasi()
    {
        $dokumentasi = Dokumentasi::all();
        $foto = Foto::all();
        return view ('user.super_admin.dokumentasi.index', compact('dokumentasi', 'foto'));
    }

    public function createDokumentasi()
    {
        return view ('user.super_admin.dokumentasi.create');
    }

    public function storeDokumentasi(Request $request)
    {
        $request->validate([
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'file' => 'required',
        ], [
            'tanggal_kegiatan.required' => 'Tanggal harus diisi!',
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi!',
            'file.required' => 'File harus diisi!',
            // 'file.mimes' => 'File harus berupa jpg, jpeg, atau png!',
        ]);

        $dokumentasi = Dokumentasi::create([
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
        ]);

        if($request->hasFile('file'))
        {
            $files = $request->file('file');
            foreach($files as $file)
            {
                $file_path = $file->storeAs('dokumentasi', $file->getClientOriginalName(), 'public');
                $foto = [
                    'dokumentasi_id' => $dokumentasi->latest()->first()->id,
                    'file' => $file_path,
                ];
                Foto::create($foto);
            }
        }
    
        Alert::success('Berhasil', 'Berhasil Menambahkan Data Dokumentasi');
        return redirect()->route('dokumentasiSuperAdmin');
    }

    public function showDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        $foto = Foto::where('dokumentasi_id', $id)->get();

        return view ('user.super_admin.dokumentasi.show', compact('dokumentasi', 'foto'));
    }

    public function editDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::with('foto')->findOrFail($id);
        return view ('user.super_admin.dokumentasi.edit', ['dokumentasi' => $dokumentasi]);
    }

    public function updateDokumentasi(Request $request, $id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        $request->validate([
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            // 'file' => 'sometimes|mimes:jpg,jpeg,png',
        ], [
            'tanggal_kegiatan.required' => 'Tanggal harus diisi!',
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi!',
            // 'file.mimes' => 'File harus berupa jpg, jpeg, atau png!',
        ]);

        if (!$request->hasFile('file')) {
            $dokumentasi->update([
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'nama_kegiatan' => $request->nama_kegiatan,
            ]);
        } else {
            foreach ($dokumentasi->foto as $foto) {
                Storage::delete($foto->file);
                $foto->delete();
            }
            $files = $request->file('file');
            foreach($files as $file)
            {
                $file_path = $file->storeAs('dokumentasi', $file->getClientOriginalName(), 'public');
                $foto = [
                    'dokumentasi_id' => $dokumentasi->id,
                    'file' => $file_path,
                ];
                Foto::create($foto);
            }
        };

        Alert::success('Berhasil', 'Berhasil Mengubah Data Dokumentasi');
        return redirect()->route('dokumentasiSuperAdmin');
    }

    public function destroyDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        $foto = Foto::where('dokumentasi_id', $id)->get();

        foreach($foto as $f)
        {
            $f->delete();
        }

        $dokumentasi->delete();

        Alert::success('Berhasil', 'Berhasil Menghapus Data Dokumentasi');
        return redirect()->route('dokumentasiSuperAdmin');
    }
    // Dokumentasi End

    // User Start
    public function indexUser()
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
            return redirect()->route('statusUserSuperAdmin');
        }else{
            $user->update(['status' => 0]);
            return redirect()->route('statusUserSuperAdmin');
        }
    }

    public function createUser()
    {
        $user = User::all();
        return view ('user.super_admin.user.create', compact('user'));
    }

    public function storeUser(Request $request)
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
        }elseif ($role == 18){
            $jabatan = "Kepala Subbid Penggunaan dan Pemanfaatan";
        }elseif ($role == 19){
            $jabatan = "Admin Pembantu Sekretaris";
        }elseif ($role == 20){
            $jabatan = "Admin Pembantu Bidang Anggaran";
        }elseif ($role == 21){
            $jabatan = "Admin Pembantu Bidang Perbendaharaan";
        }elseif ($role == 22){
            $jabatan = "Admin Pembantu Bidang Akuntansi";
        }else{
            $jabatan = "Admin Pembantu Bidang Aset";
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
            'status' => 1
        ];
        // dd($user);
        User::create($user);
        Alert::success('Berhasil', 'Berhasil Menambahkan Data User');
        return redirect ('/superadmin/user');
    }

    public function editUser($id)
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
            ['id' => 19, 'name' => 'Admin Pembantu Sekretaris' ],
            ['id' => 20, 'name' => 'Admin Pembantu Bidang Anggaran' ],
            ['id' => 21, 'name' => 'Admin Pembantu Bidang Perbendaharaan' ],
            ['id' => 22, 'name' => 'Admin Pembantu Bidang Akuntansi' ],
            ['id' => 23, 'name' => 'Admin Pembantu Bidang Aset' ],
          ];
          return view ('user.super_admin.user.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id)
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
        }elseif ($role == 18){
            $jabatan = "Kepala Subbid Penggunaan dan Pemanfaatan";
        }elseif ($role == 19){
            $jabatan = "Admin Pembantu Sekretaris";
        }elseif ($role == 20){
            $jabatan = "Admin Pembantu Bidang Anggaran";
        }elseif ($role == 21){
            $jabatan = "Admin Pembantu Bidang Perbendaharaan";
        }elseif ($role == 22){
            $jabatan = "Admin Pembantu Bidang Akuntansi";
        }else{
            $jabatan = "Admin Pembantu Bidang Aset";
        }

        $update = [
            'nip' => $request -> nip,
            'name' => $request -> name,
            'email' => $request -> email,
            'role' => $request -> role,
            'jabatan' => $jabatan,
        ];
        $user -> update($update);
        Alert::success('Berhasil', 'Berhasil Merubah Data User');
        return redirect ('/superadmin/user');
    }
    // User End

    // Ganti Password Start
    public function gantiPassword()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view ('user.super_admin.password.index', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|confirmed',
        ], [
            'password_lama.required' => 'Masukkan password lama Anda.',
            'password.required' => 'Masukkan password baru.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah'])->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Berhasil', 'Berhasil Mengubah Password');
        return redirect()->route('dashboardSuperAdmin');
    }
    // Ganti Password End
}
