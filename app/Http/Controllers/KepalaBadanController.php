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
            'file' => 'required|mimes:pdf,doc,docx',
        ], [
            'pengelola.required' => 'Pengelola harus diisi!',
            'jenis_dokumen.required' => 'Jenis Dokumen harus diisi!',
            'tanggal_dokumen.required' => 'Tanggal Dokumen harus diisi!',
            'asal_dokumen.required' => 'Asal Dokumen harus diisi!',
            'perihal.required' => 'Perihal harus diisi!',
            'file.required' => 'File harus diisi!',
            'file.mimes' => 'File harus berupa pdf, doc, atau docx!',
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

        return view ('user.super_admin.dokumentasi.show', compact('dokumentasi', 'foto'));
    }
}