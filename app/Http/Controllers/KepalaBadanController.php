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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KepalaBadanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        $role = Auth()->user()->role;

        $user = User::where('role', '!=', 1)->count();
        $agendaMasuk = Disposisi::where('disposisi', '=', $role)
            ->where('laporan', '=', null)
            ->count();
        $agendaSelesai = Disposisi::where('disposisi', '=', $role)
            ->where('laporan', '!=', null)
            ->count();
        $laporan = Disposisi::where('laporan', '!=', null)->count();
        $peraturan = Arsip::where('jenis_dokumen', 1)->count();
        $apbd = Arsip::where('jenis_dokumen', 2)->count();
        $keuangan = Arsip::where('jenis_dokumen', 3)->count();
        $slide = Arsip::where('jenis_dokumen', 4)->count();
        $lainnya = Arsip::where('jenis_dokumen', 5)->count();
        $dokumentasi = Dokumentasi::all()->count();

        return view ('user.kepala_badan.dashboard', compact('user', 'agendaMasuk', 'agendaSelesai', 'laporan', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya'));
    }

    // Agenda Start
    public function indexAgenda()
    {
        $agenda = DB::select(DB::raw('
            SELECT agenda.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.disposisi = 2 AND disposisi.laporan IS NULL AND disposisi.selesaikan = 0
        '));
        return view('user.kepala_badan.agenda.index', compact('agenda'));
    }

    public function tindakLanjut($id){
        $agenda = Agenda::findOrFail($id);
        $disposisi = Disposisi::where('agenda_id', $id)->first();
        return view('user.kepala_badan.agenda.tindakan', compact('agenda', 'disposisi'));
    }

    public function storeTindakLanjut(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $dp = Disposisi::where('agenda_id', $id)->first();
        $disposisi = $request->disposisi;
        $tindak_lanjut = $request->tindak_lanjut;
        $role = Auth()->user()->role;

        $request->validate([
            'disposisi' => 'required',
            'tindak_lanjut' => 'required',
        ], [
            'disposisi.required' => 'Disposisi harus diisi!',
            'tindak_lanjut.required' => 'Tindak Lanjut harus diisi!',
        ]);

        if ($disposisi == $role){
            if ($tindak_lanjut == 4){
                $agenda->update([
                    'tanggal_kegiatan' => $request->tanggal_kegiatan,
                    'tindak_lanjut' => $tindak_lanjut,
                    'status' => 1,
                ]);
                $dp->update([
                    'selesaikan' => 1,
                    'disposisi' => $disposisi,
                    'catatan' => $request->catatan
                ]);
            }else{
                $agenda->update([
                    'tindak_lanjut' => $tindak_lanjut,
                    'status' => 1,
                ]);
                $dp->update([
                    'selesaikan' => 1,
                    'disposisi' => $disposisi,
                    'catatan' => $request->catatan
                ]);
            }
        }else{
            if ($tindak_lanjut == 4){
                $agenda->update([
                    'tanggal_kegiatan' => $request->tanggal_kegiatan,
                    'tindak_lanjut' => $tindak_lanjut,
                    'status' => 1,
                ]);
                $dp->update([
                    'disposisi' => $disposisi,
                    'dp2' => $role,
                    'catatan' => $request->catatan
                ]);
            }else{
                $agenda->update([
                    'tindak_lanjut' => $tindak_lanjut,
                    'status' => 1,
                ]);
                $dp->update([
                    'disposisi' => $disposisi,
                    'dp2' => $role,
                    'catatan' => $request->catatan
                ]);
            }
        }

        Alert::success('Berhasil', 'Berhasil Menambahkan Data Tindak Lanjut');
        return redirect()->route('agendaKepalaBadan');
    }

    public function indexAgendaSaya()
    {
        $agenda = DB::select(DB::raw('
            SELECT agenda.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan, agenda.tindak_lanjut AS tindak_lanjut
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.disposisi = 2 AND agenda.status = 1 AND disposisi.selesaikan = 1 AND agenda.tindak_lanjut = 4
        '));

        $agendaSelesai = DB::select(DB::raw('
            SELECT agenda.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan, agenda.tindak_lanjut AS tindak_lanjut
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.disposisi = 2 AND agenda.status = 1 AND disposisi.selesaikan = 1
            AND NOT (agenda.tindak_lanjut = 4 AND disposisi.laporan IS NULL)
        '));
        return view('user.kepala_badan.agenda.agenda_saya', compact('agenda', 'agendaSelesai'));
    }

    public function uploadLaporan($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $agenda = Agenda::findOrFail($disposisi->agenda_id);

        return view('user.kepala_badan.agenda.uploadLaporan', compact('agenda', 'disposisi'));
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

        $agenda = Agenda::findOrFail($disposisi->agenda_id);
        $agenda->update([
            'status' => 1,
        ]);

        $disposisi->update([
            'laporan' => $laporan,
        ]);

        Alert::success('Berhasil', 'Laporan Berhasil Diupload');
        return redirect()->route('agendaKepalaBadan');
    }
    // Agenda End

    // User Start
    public function indexUser()
    {
        $user = User::all();
        return view('user.kepala_badan.user.index', compact('user'));
    }

    public function status($id)
    {
        $user = User::findOrFail($id);
        $statusGet = $user->status;
        if($statusGet == 0) {
            $user->update(['status' => 1]);
            return redirect()->route('userKepalaBadan');
        }else{
            $user->update(['status' => 0]);
            return redirect()->route('userKepalaBadan');
        }
    }
    // User End

    // Disposisi Start
    public function indexDisposisi()
    {
        $disposisi = DB::select(DB::raw('
            SELECT agenda.tanggal_dokumen AS tanggal_dokumen, agenda.tindak_lanjut AS tindak_lanjut, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan, disposisi.dp2 AS dp2, disposisi.dp3 AS dp3, disposisi.dp4 AS dp4, disposisi.selesaikan AS selesaikan
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE (disposisi.dp2 = 2 AND disposisi.disposisi IN (3, 4, 5, 6, 7)) OR (disposisi.dp2 = 2 AND disposisi.disposisi NOT IN (3, 4, 5, 6, 7));
        '));

        return view('user.kepala_badan.disposisi.index', compact('disposisi'));
    }
    // Disposisi End

    // Laporan Start
    public function indexLaporan()
    {
        $laporan = DB::select(DB::raw('
            SELECT agenda.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.laporan IS NOT NULL
        '));

        return view('user.kepala_badan.laporan.index', ['laporan' => $laporan]);
    }

    public function showLaporan($id)
    {
        $agenda = Agenda::findOrFail($id);
        $disposisi = Disposisi::where('agenda_id', $id)->first();

        $d = Disposisi::where('agenda_id', $id)->first()->disposisi;

        $dis = '';
        if($d==2){
            $dis = 'Kepala Badan';
        }elseif($d==3){
            $dis = 'Sekretaris';
        }elseif($d==4){
            $dis = 'Kepala Bidang Anggaran';
        }elseif($d==5){
            $dis = 'Kepala Bidang Perbendaharaan';
        }elseif($d==6){
            $dis = 'Kepala Bidang Akuntansi';
        }elseif($d==7){
            $dis = 'Kepala Bidang Aset';
        }elseif($d==8){
            $dis = 'SubBag Perencanaan & Evaluasi';
        }elseif($d==9){
            $dis = 'SubBag Keuangan';
        }elseif($d==10){
            $dis = 'SubBag Umum & Kepegawaian';
        }elseif($d==11){
            $dis = 'SubBid Anggaran Pendapatan & Pembiayaan';
        }elseif($d==12){
            $dis = 'SubBid Anggaran Belanja';
        }elseif($d==13){
            $dis = 'SubBid Pengelolaan Kas';
        }elseif($d==14){
            $dis = 'SubBid Administrasi Perbendahaan';
        }elseif($d==15){
            $dis = 'SubBid Pembukuan & Pelaporan';
        }elseif($d==16){
            $dis = 'SubBid Verifikasi';
        }elseif($d==17){
            $dis = 'SubBid Perencanaan & Penatausahaan';
        }elseif($d==18){
            $dis = 'SubBid Penggunaan dan Pemanfaatan';
        }

        return view('user.kepala_badan.laporan.show', compact('agenda', 'disposisi', 'dis'));
    }
    // Laporan End

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

        return view ('user.kepala_badan.arsip.index', compact('arsip', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya'));
    }

    public function createArsip()
    {
        $arsip = Arsip::all();
        return view('user.kepala_badan.arsip.create', compact('arsip'));
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
        Alert::success('Berhasil', 'Berhasil Menambahkan Data Arsip');
        return redirect()->route('arsipKepalaBadan');
    }

    public function editArsip($id)
    {
        $arsip = Arsip::findOrFail($id);
        return view ('user.kepala_badan.arsip.edit', compact('arsip'));
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
        return redirect()->route('arsipKepalaBadan');
    }

    public function peraturanIndex()
    {
        $peraturan = Arsip::where('jenis_dokumen', 1)->get();
        return view ('user.kepala_badan.arsip.peraturan.index', compact('peraturan'));
    }

    public function apbdIndex()
    {
        $apbd = Arsip::where('jenis_dokumen', 2)->get();
        return view ('user.kepala_badan.arsip.apbd.index', compact('apbd'));
    }

    public function keuanganIndex()
    {
        $keuangan = Arsip::where('jenis_dokumen', 3)->get();
        return view ('user.kepala_badan.arsip.keuangan.index', compact('keuangan'));
    }

    public function slideIndex()
    {
        $slide = Arsip::where('jenis_dokumen', 4)->get();
        return view ('user.kepala_badan.arsip.slide.index', compact('slide'));
    }

    public function lainnyaIndex()
    {
        $lainnya = Arsip::where('jenis_dokumen', 5)->get();
        return view ('user.kepala_badan.arsip.lainnya.index', compact('lainnya'));
    }
    // Arsip End

    // Dokumentasi Start
    public function indexDokumentasi()
    {
        $dokumentasi = Dokumentasi::all();
        $foto = Foto::all();
        return view ('user.kepala_badan.dokumentasi.index', compact('dokumentasi', 'foto'));
    }

    public function createDokumentasi()
    {
        return view ('user.kepala_badan.dokumentasi.create');
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
        return redirect()->route('dokumentasiKepalaBadan');
    }

    public function showDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        $foto = Foto::where('dokumentasi_id', $id)->get();

        return view ('user.kepala_badan.dokumentasi.show', compact('dokumentasi', 'foto'));
    }

    public function editDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::with('foto')->findOrFail($id);
        return view ('user.kepala_badan.dokumentasi.edit', ['dokumentasi' => $dokumentasi]);
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
        return redirect()->route('dokumentasiKepalaBadan');
    }
    // Dokumentasi End

    // Ganti Password Start
    public function gantiPassword()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view ('user.kepala_badan.password.index', compact('user'));
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
        return redirect()->route('dashboardKepalaBadan');
    }
    // Ganti Password End
}
