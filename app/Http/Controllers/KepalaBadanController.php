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

class KepalaBadanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        return view ('user.kepala_badan.dashboard');
    }

    // Agenda Start
    public function indexAgenda()
    {
        $agenda = Agenda::where('status', 0)->get();
        return view('user.kepala_badan.agenda.index', compact('agenda'));
    }

    public function disposisiAgenda(Request $request , $id)
    {
        $agenda = Agenda::findOrFail($id);
        $disposisi = [
            ['id' => 2, 'name' => 'Kepala Badan' ],
            ['id' => 3, 'name' => 'Sekretaris' ],
            ['id' => 4, 'name' => 'Kepala Bidang Anggaran' ],
            ['id' => 5, 'name' => 'Kepala Bidang Perbendaharaan' ],
            ['id' => 6, 'name' => 'Kepala Bidang Akuntansi' ],
            ['id' => 7, 'name' => 'Kepala Bidang Aset' ],
        ];
        return view('user.kepala_badan.agenda.disposisi', compact('agenda', 'disposisi'));
    }

    public function storeDisposisiAgenda(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $ke = intval($request->disposisi);
        $catatan = $request->catatan;

        $disposisi = [
            'agenda_id' => $agenda->id,
            'disposisi' => $ke,
            'catatan' => $catatan,
        ];

        Agenda::where('id', $agenda->id)->update([
            'status' => 1,
        ]);

        Disposisi::create($disposisi);
        
        Alert::success('Berhasil', 'Berhasil Menambahkan Data Disposisi');
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
            SELECT agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
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

        Alert::success('Berhasil', 'Berhasil Mengubah Data Dokumen');
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
        $lainnya = Arsip::where('jenis_dokumen', 6)->get();
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
        $validator = Validator::make ( $request->all(), [
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'file' => 'sometimes|mimes:jpg,jpeg,png',
        ], [
            'tanggal_kegiatan.required' => 'Tanggal harus diisi!',
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi!',
            'file.mimes' => 'File harus berupa jpg, jpeg, atau png!',
        ]);

        foreach ($dokumentasi->foto as $foto) {
            Storage::delete($foto->file);
            $foto->delete();
        }

        if ($request->file('file') == '') {
            $dokumentasi->update([
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'nama_kegiatan' => $request->nama_kegiatan,
            ]);
        } else {
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

        Alert::success('Berhasil', 'Berhasil Mengubah Data Dokumentasi');
        return redirect()->route('dokumentasiKepalaBadan');
    }
    // Dokumentasi End
}
