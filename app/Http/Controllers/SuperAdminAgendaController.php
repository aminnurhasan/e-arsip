<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SuperAdminAgendaController extends Controller
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
        $agenda = Agenda::all();
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view ('user.super_admin.agenda.index', compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agenda = Agenda::where('status', 1)->get();
        return view ('user.super_admin.agenda.create', compact('agenda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $formattedDate = Carbon::parse($request->tanggal_dokumen)->format('d-m-Y');

        $request -> validate ([
            'jenis_dokumen' => 'required',
            'tanggal_dokumen' => 'required',
            'asal_dokumen' => 'required',
            'perihal' => 'required',
            'file' => 'required|mimes:pdf,doc,docx',
        ],[
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
        ];
        Agenda::create($agenda);
        Alert::success('Berhasil', 'Berhasil Menambahkan Data User');
        return redirect()->route('agendaSuperAdmin');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = Agenda::find($id);

        Agenda::where('id', $id)->delete();
        Storage::disk('public')->delete($agenda->file_path);
        alert()->success('Berhasil', 'Berhasil Menghapus Data Agenda');
        return redirect()->route('agendaSuperAdmin');
    }
}
