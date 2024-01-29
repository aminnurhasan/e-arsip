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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SubbagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        $role = Auth()->user()->role;

        $agendaMasuk = Disposisi::where('disposisi', '=', $role)
            ->where('selesaikan', '=', 0)
            ->count();
        $agendaSelesai = Disposisi::join('agenda', 'disposisi.agenda_id', '=', 'agenda.id')
            ->where('disposisi.disposisi', $role)
            ->where('disposisi.selesaikan', 1)
            ->where(function ($query) {
                $query->where('agenda.tindak_lanjut', '<>', 4)
                    ->orWhere(function ($subquery) {
                        $subquery->where('agenda.tindak_lanjut', 4)
                            ->whereNotNull('disposisi.laporan');
                    });
            })
            ->count();
        $laporan = Disposisi::where('laporan', '!=', null)->count();
        $peraturan = Arsip::where('jenis_dokumen', 1)->count();
        $apbd = Arsip::where('jenis_dokumen', 2)->count();
        $keuangan = Arsip::where('jenis_dokumen', 3)->count();
        $slide = Arsip::where('jenis_dokumen', 4)->count();
        $lainnya = Arsip::where('jenis_dokumen', 5)->count();
        $dokumentasi = Dokumentasi::all()->count();

        return view ('user.subbag.dashboard', compact('agendaMasuk', 'agendaSelesai', 'laporan', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya'));
    }

    // Agenda Start
    public function indexAgenda()
    {
        $role = Auth()->user()->role;
        $agenda = DB::select(DB::raw('
            SELECT agenda.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.disposisi = :role AND disposisi.laporan IS NULL AND disposisi.selesaikan = 0
        '), ['role' => $role]);

        return view('user.subbag.agenda.index', compact('agenda'));
    }

    public function tindakLanjut($id){
        $agenda = Agenda::findOrFail($id);
        $disposisi = Disposisi::where('agenda_id', $id)->first();
        $tindakan = $agenda->tindak_lanjut;
        return view('user.subbag.agenda.tindakan', compact('agenda', 'disposisi', 'tindakan'));
    }

    public function storeTindakLanjut(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $dp = Disposisi::where('agenda_id', $id)->first();
        $disposisi = $request->disposisi;
        $tindak_lanjut = $request->tindak_lanjut;
        $catatan = $request->catatan;
        $role = Auth()->user()->role;

        $request->validate([
            'disposisi' => 'required',
        ], [
            'disposisi.required' => 'Disposisi harus diisi!',
        ]);

        if ($tindak_lanjut == 4){
            $agenda->update([
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'tindak_lanjut' => $tindak_lanjut,
            ]);
        }else{
            $agenda->update([
                'tindak_lanjut' => $request->tindak_lanjut,
            ]);
        }

        if($dp->dp3 == null){
            $dp = [
                'disposisi' => $disposisi,
                'catatan' => $catatan,
                'dp3' => $role,
            ];
        }else if($dp->dp4 == null){
            $dp = [
                'disposisi' => $disposisi,
                'catatan' => $catatan,
                'dp4' => $role,
            ];
        }
        // dd($dp);
        Disposisi::where('agenda_id', $id)->update($dp);

        Alert::success('Berhasil', 'Berhasil Menambahkan Data Tindak Lanjut');
        return redirect()->route('agendaSubbag');
    }

    public function uploadLaporan($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $agenda = Agenda::findOrFail($disposisi->agenda_id);

        return view('user.subbag.agenda.uploadLaporan', compact('agenda', 'disposisi'));
    }

    public function storeLaporan(Request $request, $id)
    {
        $request->validate([
            'laporan' => 'sometimes|mimes:pdf,doc,docx',
        ], [
            'laporan.mimes' => 'File harus berupa pdf, doc, atau docx',
        ]);

        $disposisi = Disposisi::findOrFail($id);
        
        $file = $request->file('laporan');
        if($file == null){
            $laporan = null;
        }else{
            $laporan = $file->storeAs('laporan', $file->getClientOriginalName(), 'public');
        }

        $disposisi->update([
            'laporan' => $laporan,
        ]);

        Alert::success('Berhasil', 'Laporan Berhasil Diupload');
        return redirect()->route('agendaSayaSubbag');
    }

    public function indexAgendaSaya()
    {
        $role = Auth()->user()->role;
        $agenda = DB::select(DB::raw('
            SELECT disposisi.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan, agenda.tindak_lanjut AS tindak_lanjut
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.disposisi = :role AND agenda.status = 1 AND disposisi.selesaikan = 1 AND agenda.tindak_lanjut = 4 AND disposisi.laporan IS NULL
        '), ['role' => $role]);

        $agendaSelesai = DB::select(DB::raw('
            SELECT disposisi.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan, agenda.tindak_lanjut AS tindak_lanjut
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.disposisi = :role AND agenda.status = 1 AND disposisi.selesaikan = 1
            AND NOT (agenda.tindak_lanjut = 4 AND disposisi.laporan IS NULL)
        '), ['role' => $role]);
        return view('user.subbag.agenda.agenda_saya', compact('agenda', 'agendaSelesai'));
    }

    public function selesaikan($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $agenda = Agenda::findOrFail($disposisi->agenda_id);
        $disposisi->update([
            'selesaikan' => 1,
        ]);
        Alert::success('Berhasil', 'Berhasil Menyelesaikan Data Agenda');
        return redirect()->route('agendaSubbag');
    }
    // Agenda End

    // Disposisi Start
    public function indexDisposisi()
    {
        $role = Auth()->user()->role;
        if($role == 8){
            $disposisi = DB::select(DB::raw('
            SELECT disposisi.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.tindak_lanjut AS tindak_lanjut, disposisi.disposisi AS disposisi, agenda.nomor_dokumen AS nomor_dokumen, agenda.perihal AS perihal, agenda.asal_dokumen AS asal_dokumen, disposisi.dp2 AS dp2, disposisi.dp3 AS dp3, disposisi.dp4 AS dp4, disposisi.dp5 AS dp5, agenda.file_path AS file_path
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE (disposisi.dp3 = 8 AND disposisi.disposisi IN (24)) OR (disposisi.dp3 = 8 AND disposisi.disposisi NOT IN (24) OR disposisi.dp4 = 8);
        '));
        }else if($role == 9){
            $disposisi = DB::select(DB::raw('
            SELECT disposisi.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.tindak_lanjut AS tindak_lanjut, disposisi.disposisi AS disposisi, agenda.nomor_dokumen AS nomor_dokumen, agenda.perihal AS perihal, agenda.asal_dokumen AS asal_dokumen, disposisi.dp2 AS dp2, disposisi.dp3 AS dp3, disposisi.dp4 AS dp4, disposisi.dp5 AS dp5, agenda.file_path AS file_path
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE (disposisi.dp3 = 9 AND disposisi.disposisi IN (25)) OR (disposisi.dp3 = 9 AND disposisi.disposisi NOT IN (25) OR disposisi.dp4 = 9);
        '));
        }else{
            $disposisi = DB::select(DB::raw('
            SELECT disposisi.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.tindak_lanjut AS tindak_lanjut, disposisi.disposisi AS disposisi, agenda.nomor_dokumen AS nomor_dokumen, agenda.perihal AS perihal, agenda.asal_dokumen AS asal_dokumen, disposisi.dp2 AS dp2, disposisi.dp3 AS dp3, disposisi.dp4 AS dp4, disposisi.dp5 AS dp5, agenda.file_path AS file_path
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE (disposisi.dp3 = 10 AND disposisi.disposisi IN (26)) OR (disposisi.dp3 = 10 AND disposisi.disposisi NOT IN (26) OR disposisi.dp4 = 10);
        '));
        }

        return view('user.subbag.disposisi.index', compact('disposisi'));
    }
    // Disposisi End

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

        return view ('user.subbag.arsip.index', compact('arsip', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya'));
    }

    public function createArsip()
    {
        $arsip = Arsip::all();
        return view ('user.subbag.arsip.create', compact('arsip'));
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
            'file_path' => $file_path,
        ];

        Arsip::create($arsip);
        Alert::success('Berhasil', 'Berhasil Menambahkan Data Dokumen');
        return redirect()->route('arsipSubbag');
    }

    public function editArsip($id)
    {
        $arsip = Arsip::findOrFail($id);
        return view ('user.subbag.arsip.edit', compact('arsip'));
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
        return redirect()->route('arsipSubbag');
    }

    public function peraturanIndex()
    {
        $peraturan = Arsip::where('jenis_dokumen', 1)->get();
        return view ('user.subbag.arsip.peraturan.index', compact('peraturan'));
    }

    public function apbdIndex()
    {
        $apbd = Arsip::where('jenis_dokumen', 2)->get();
        return view ('user.subbag.arsip.apbd.index', compact('apbd'));
    }

    public function keuanganIndex()
    {
        $keuangan = Arsip::where('jenis_dokumen', 3)->get();
        return view ('user.subbag.arsip.keuangan.index', compact('keuangan'));
    }

    public function slideIndex()
    {
        $slide = Arsip::where('jenis_dokumen', 4)->get();
        return view ('user.subbag.arsip.slide.index', compact('slide'));
    }

    public function lainnyaIndex()
    {
        $lainnya = Arsip::where('jenis_dokumen', 5)->get();
        return view ('user.subbag.arsip.lainnya.index', compact('lainnya'));
    }
    // Arsip End

    // Dokumentasi Start
    public function indexDokumentasi()
    {
        $dokumentasi = Dokumentasi::all();
        $foto = Foto::all();
        return view ('user.subbag.dokumentasi.index', compact('dokumentasi', 'foto'));
    }

    public function createDokumentasi()
    {
        $dokumentasi = Dokumentasi::all();
        return view ('user.subbag.dokumentasi.create', compact('dokumentasi'));
    }

    public function storeDokumentasi(Request $request)
    {
        $request->validate([
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
        return redirect()->route('dokumentasiSubbag');
    }

    public function showDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        $foto = Foto::where('dokumentasi_id', $id)->get();

        return view ('user.subbag.dokumentasi.show', compact('dokumentasi', 'foto'));
    }

    public function editDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::with('foto')->findOrFail($id);
        return view ('user.subbag.dokumentasi.edit', ['dokumentasi' => $dokumentasi]);
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
        return redirect()->route('dokumentasiSubbag');
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
        return redirect()->route('dokumentasiSubbag');
    }
    // Dokumentasi End

    // Ganti Password Start
    public function gantiPassword()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view ('user.subbag.password.index', compact('user'));
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
        return redirect()->route('dashboardSubbag');
    }
    // Ganti Password End
}
