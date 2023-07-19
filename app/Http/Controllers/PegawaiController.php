<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Unit;
use App\Models\Level;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = array(
            'title'     => 'List Pegawai',
            'menu'      => 'Pegawai', 
            'pegawai'   => Pegawai::all()
        );

        return view('pages.pegawai.main', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Create Pegawai',
            'menu'  => 'Pegawai',
            'level' => Level::all(),
            'unit'  => Unit::all()
        );

        return view('pages.pegawai.create', $data);
    }

    public function store(StorePegawaiRequest $request): RedirectResponse
    {
        $validated = $request->validated(); 

        $pegawai = new Pegawai;

        $pegawai->nip = $request->nip;
        $pegawai->nama = $request->nama;
        $pegawai->id_call_center = $request->unit;
        $pegawai->id_level = $request->level;
        $pegawai->alamat = $request->alamat;
        $pegawai->no_telp = $request->telepon;
        $pegawai->email = $request->email;
        $pegawai->status = $request->status;
        $pegawai->password = Hash::make($request->nip);

        $pegawai->save();

        return redirect('pegawai')->with('success','Data pegawai berhasil ditambahkan');

    }

    public function edit($id)
    {
        $data = array(
            'title'     => 'Edit Pegawai',
            'menu'      => 'Pegawai', 
            'pegawai'   => Pegawai::find($id),
            'level'     => Level::all(),
            'unit'      => Unit::all()
        );

        return view('pages.pegawai.edit', $data);
    }

    public function update(UpdatePegawaiRequest $request, Pegawai $id): RedirectResponse
    {
        $validated = $request->validated();

        $pegawai = Pegawai::find($request->id_pegawai);

        // echo json_encode($pegawai); die();

        $pegawai->nip = $request->nip;
        $pegawai->nama = $request->nama;
        $pegawai->id_call_center = $request->unit;
        $pegawai->id_level = $request->level;
        $pegawai->alamat = $request->alamat;
        $pegawai->no_telp = $request->telepon;
        $pegawai->email = $request->email;
        $pegawai->status = $request->status;

        $pegawai->save();

        return redirect('pegawai')->with('success','Data pegawai berhasil diperbarui');

    }

    public function show($id)
    {
        $data = array(
            'title'     => 'View Pegawai',
            'menu'      => 'Pegawai',
            'level'     => Level::all(),
            'unit'      => Unit::all(),
            'pegawai'   => Pegawai::find($id)
        );

        // var_dump($data); die();

        return view('pages.pegawai.view', $data);
    }

    function destroy(Pegawai $pegawai) : RedirectResponse {
        $pegawai->delete();

        return redirect('pegawai')->with('success','Data pegawai berhasil dihapus');
    }
}
