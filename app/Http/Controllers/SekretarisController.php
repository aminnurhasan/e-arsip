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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SekretarisController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        $role = Auth()->user()->role;

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

        return view ('user.sekretaris.dashboard', compact('agendaMasuk', 'agendaSelesai', 'laporan', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya'));
    }

    // Agenda Start
    public function indexAgenda()
    {
        $agenda = DB::select(DB::raw('
            SELECT disposisi.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.disposisi = 3 AND disposisi.laporan IS NULL
        '));

        $agendaSelesai = DB::select(DB::raw('
            SELECT disposisi.id AS id, agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.disposisi = 3 AND disposisi.laporan IS NOT NULL
        '));

        return view('user.sekretaris.agenda.index', compact('agenda', 'agendaSelesai'));
    }

    public function uploadLaporan($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $agenda = Agenda::findOrFail($disposisi->agenda_id);

        return view('user.sekretaris.agenda.uploadLaporan', compact('agenda', 'disposisi'));
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
        return redirect()->route('agendaSekretaris');
    }

    public function disposisiAgenda($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $agenda = Agenda::findOrFail($disposisi->agenda_id);

        return view('user.sekretaris.agenda.disposisi', compact('agenda', 'disposisi'));
    }

    public function storeDisposisiAgenda(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $ke = intval($request->disposisi);
        $catatan = $request->catatan;
        $disposisi = Disposisi::where('agenda_id', $agenda->id)->first();
        $role = Auth()->user()->role;

        if($disposisi->dp2 == null){
            $disposisi = [
                'disposisi' => $ke,
                'catatan' => $catatan,
                'dp2' => $role,
            ];
            Disposisi::where('agenda_id', $agenda->id)->update($disposisi);
        
            Alert::success('Berhasil', 'Disposisi Berhasil Dikirim');
            return redirect()->route('agendaSekretaris');
        }else{
            $disposisi = [
                'disposisi' => $ke,
                'catatan' => $catatan,
                'dp3' => $role,
            ];
            Disposisi::where('agenda_id', $agenda->id)->update($disposisi);
        
            Alert::success('Berhasil', 'Disposisi Berhasil Dikirim');
            return redirect()->route('agendaSekretaris');
        }
    }
    // Agenda End

    // Disposisi Start
    public function indexDisposisi()
    {
        $disposisi = DB::select(DB::raw('
            SELECT agenda.tanggal_dokumen AS tanggal_dokumen, agenda.nomor_dokumen AS nomor_dokumen, agenda.asal_dokumen AS asal_dokumen, agenda.perihal AS perihal, agenda.file_path AS file_path, disposisi.disposisi AS disposisi, disposisi.catatan AS catatan, disposisi.laporan AS laporan
            FROM disposisi
            JOIN agenda ON disposisi.agenda_id = agenda.id
            WHERE disposisi.dp2 = '.Auth()->user()->role.'
        '));

        return view('user.sekretaris.disposisi.index', compact('disposisi'));
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

        return view ('user.sekretaris.arsip.index', compact('arsip', 'peraturan', 'apbd', 'keuangan', 'slide', 'dokumentasi', 'lainnya'));
    }

    public function createArsip()
    {
        $arsip = Arsip::all();
        return view ('user.sekretaris.arsip.create', compact('arsip'));
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
        return redirect()->route('arsipSekretaris');
    }

    public function editArsip($id)
    {
        $arsip = Arsip::findOrFail($id);
        return view ('user.sekretaris.arsip.edit', compact('arsip'));
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
        return redirect()->route('arsipSekretaris');
    }

    public function peraturanIndex()
    {
        $peraturan = Arsip::where('jenis_dokumen', 1)->get();
        return view ('user.sekretaris.arsip.peraturan.index', compact('peraturan'));
    }

    public function apbdIndex()
    {
        $apbd = Arsip::where('jenis_dokumen', 2)->get();
        return view ('user.sekretaris.arsip.apbd.index', compact('apbd'));
    }

    public function keuanganIndex()
    {
        $keuangan = Arsip::where('jenis_dokumen', 3)->get();
        return view ('user.sekretaris.arsip.keuangan.index', compact('keuangan'));
    }

    public function slideIndex()
    {
        $slide = Arsip::where('jenis_dokumen', 4)->get();
        return view ('user.sekretaris.arsip.slide.index', compact('slide'));
    }

    public function lainnyaIndex()
    {
        $lainnya = Arsip::where('jenis_dokumen', 5)->get();
        return view ('user.sekretaris.arsip.lainnya.index', compact('lainnya'));
    }
    // Arsip End

    // Dokumentasi Start
    public function indexDokumentasi()
    {
        $dokumentasi = Dokumentasi::all();
        $foto = Foto::all();
        return view ('user.sekretaris.dokumentasi.index', compact('dokumentasi', 'foto'));
    }

    public function createDokumentasi()
    {
        $dokumentasi = Dokumentasi::all();
        return view ('user.sekretaris.dokumentasi.create', compact('dokumentasi'));
    }

    public function storeDokumentasi(Request $request)
    {
        $validator = Validator::make ( $request->all(), [
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
        return redirect()->route('dokumentasiSekretaris');
    }

    public function showDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        $foto = Foto::where('dokumentasi_id', $id)->get();

        return view ('user.sekretaris.dokumentasi.show', compact('dokumentasi', 'foto'));
    }

    public function editDokumentasi($id)
    {
        $dokumentasi = Dokumentasi::with('foto')->findOrFail($id);
        return view ('user.sekretaris.dokumentasi.edit', ['dokumentasi' => $dokumentasi]);
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
        return redirect()->route('dokumentasiSekretaris');
    }

}
