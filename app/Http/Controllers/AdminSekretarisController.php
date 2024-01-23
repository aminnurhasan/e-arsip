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

class AdminSekretarisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view ('user.sekretaris.admin.dashboard');
    }

    // Agenda Start
    public function indexAgenda()
    {
        $agenda = Agenda::all();
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view ('user.sekretaris.admin.agenda.index', compact('agenda'));
    }

    public function createAgenda()
    {
        $agenda = Agenda::where('status', 1)->get();
        return view ('user.sekretaris.admin.agenda.create', compact('agenda'));
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

        $agenda = [
            'jenis_dokumen' => $request->jenis_dokumen,
            'tanggal_dokumen' => $request->tanggal_dokumen,
            'nomor_dokumen' => $request->nomor_dokumen,
            'asal_dokumen' => $request->asal_dokumen,
            'perihal' => $request->perihal,
            'file_path' => $file_path,
            'status' => 0
        ];
        Agenda::create($agenda);
        Alert::success('Berhasil', 'Berhasil Menambahkan Data Agenda');
        return redirect()->route('agendaAdminSekretaris');
    }

    public function destroyAgenda($id)
    {
        $agenda = Agenda::find($id);

        Agenda::where('id', $id)->delete();
        Storage::disk('public')->delete($agenda->file_path);
        alert()->success('Berhasil', 'Berhasil Menghapus Data Agenda');
        return redirect()->route('agendaAdminSekretaris');
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

        return view ('user.sekretaris.admin.arsip.index', compact('arsip', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya'));
    }

    public function createArsip()
    {
        $arsip = Arsip::all();
        return view ('user.sekretaris.admin.arsip.create', compact('arsip'));
    }

    public function storeArsip(Request $request)
    {
        $validator = Validator::make ( $request->all(), [
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
            'file_path' => $file_path,
        ];

        Arsip::create($arsip);
        Alert::success('Berhasil', 'Berhasil Menambahkan Data Dokumen');
        return redirect()->route('arsipAdminSekretaris');
    }

    public function editArsip($id)
    {
        $arsip = Arsip::findOrFail($id);
        return view ('user.sekretaris.admin.arsip.edit', compact('arsip'));
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

        Alert::success('Berhasil', 'Berhasil Mengubah Data Dokumen');
        return redirect()->route('arsipAdminSekretaris');
    }

    public function peraturanIndex()
    {
        $peraturan = Arsip::where('jenis_dokumen', 1)->get();
        return view ('user.sekretaris.admin.arsip.peraturan.index', compact('peraturan'));
    }

    public function apbdIndex()
    {
        $apbd = Arsip::where('jenis_dokumen', 2)->get();
        return view ('user.sekretaris.admin.arsip.apbd.index', compact('apbd'));
    }

    public function keuanganIndex()
    {
        $keuangan = Arsip::where('jenis_dokumen', 3)->get();
        return view ('user.sekretaris.admin.arsip.keuangan.index', compact('keuangan'));
    }

    public function slideIndex()
    {
        $slide = Arsip::where('jenis_dokumen', 4)->get();
        return view ('user.sekretaris.admin.arsip.slide.index', compact('slide'));
    }

    public function lainnyaIndex()
    {
        $lainnya = Arsip::where('jenis_dokumen', 5)->get();
        return view ('user.sekretaris.admin.arsip.lainnya.index', compact('lainnya'));
    }
    // Arsip End

    // Dokumentasi Start
    public function indexDokumentasi()
    {
        $dokumentasi = Dokumentasi::all();
        $foto = Foto::all();
        return view ('user.sekretaris.admin.dokumentasi.index', compact('dokumentasi', 'foto'));
    }

    public function createDokumentasi()
    {
        return view ('user.sekretaris.admin.dokumentasi.create');
    }

    public function storeDokumentasi(Request $request)
    {
        $validator = Validator::make ( $request->all(), [
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png',
        ], [
            'tanggal_kegiatan.required' => 'Tanggal harus diisi!',
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi!',
            'file.required' => 'File harus diisi!',
            'file.mimes' => 'File harus berupa jpg, jpeg, atau png!',
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
        return redirect()->route('dokumentasiAdminSekretaris');
    }

    public function showDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        $foto = Foto::where('dokumentasi_id', $id)->get();

        return view ('user.sekretaris.admin.dokumentasi.show', compact('dokumentasi', 'foto'));
    }

    public function editDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::with('foto')->findOrFail($id);
        return view ('user.sekretaris.admin.dokumentasi.edit', ['dokumentasi' => $dokumentasi]);
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
        return redirect()->route('dokumentasiSubbidAnggaranPendapatan');
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
        return redirect()->route('dokumentasiAdminSekretaris');
    }
    // Dokumentasi End

    // Staff Start
    public function indexStaff()
    {
        $staff = User::whereIn('role', [24, 25, 26])->get();
        return view ('user.sekretaris.admin.staff.index', compact('staff'));
    }

    public function status($id)
    {
        $staff = User::findOrFail($id);
        $statusGet = $staff->status;
        if($statusGet == 0) {
            $staff->update(['status' => 1]);
            return redirect()->route('staffAdminSekretaris');
        }else{
            $staff->update(['status' => 0]);
            return redirect()->route('staffAdminSekretaris');
        }
    }

    public function createStaff()
    {
        $staff = User::all();
        return view ('user.sekretaris.admin.staff.create', compact('staff'));
    }

    public function storeStaff(Request $request)
    {
        $jabatan = "";
        $role = $request->input('role');
        if ($role == 24){
            $jabatan = "Staff SubBag Perencanaan dan Evaluasi";
        }elseif ($role == 25){
            $jabatan = "Staff SubBag Keuangan";
        }elseif ($role == 26){
            $jabatan = "Staff SubBag Umum dan Kepegawaian";
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

        $staff = [
            'nip' => $request -> nip,
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> nip),
            'role' => $request -> role,
            'jabatan' => $jabatan,
            'status' => 1
        ];
        User::create($staff);
        Alert::success('Berhasil', 'Berhasil Menambahkan Data Staff');
        return redirect ('/admin_sekretaris/staff');
    }

    public function editStaff($id)
    {
        $staff = User::findOrFail($id);
          $roles = [
            ['id' => 24, 'name' => 'Staff SubBag Perencanaan dan Evaluasi' ],
            ['id' => 25, 'name' => 'Staff SubBag Keuangan' ],
            ['id' => 26, 'name' => 'Staff SubBag Umum dan Kepegawaian' ],
          ];
          return view ('user.sekretaris.admin.staff.edit', compact('staff', 'roles'));
    }

    public function updateStaff(Request $request, $id)
    {
        $staff = User :: findOrFail($id);

        $jabatan = "";
        $role = $request->input('role');
        if ($role == 24){
            $jabatan = "Staff SubBag Perencanaan dan Evaluasi";
        }elseif ($role == 25){
            $jabatan = "Staff SubBag Keuangan";
        }elseif ($role == 26){
            $jabatan = "Staff SubBag Umum dan Kepegawaian";
        }
        $update = [
            'nip' => $request -> nip,
            'name' => $request -> name,
            'email' => $request -> email,
            'role' => $request -> role,
            'jabatan' => $jabatan,
        ];
        $staff -> update($update);
        Alert::success('Berhasil', 'Berhasil Merubah Data Staff');
        return redirect ('/admin_sekretaris/staff');
    }
    // Staff End
}
