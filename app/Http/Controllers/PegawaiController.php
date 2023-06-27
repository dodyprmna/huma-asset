<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Unit;
use App\Models\Level;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate(
            [
                'nip'       => ['required','max:50',Rule::unique('pegawai', 'nip')->ignore($request->id_pegawai, 'id_pegawai')],
                'nama'      => 'required|max:70',
                'unit'      => 'required',
                'email'     => ['required','email','max:40',Rule::unique('pegawai', 'email')->ignore($request->id_pegawai, 'id_pegawai')],
                'level'     => 'required',
                'telepon'   => 'max:15',
                'alamat'    => 'max:225',
            ],
            [
                'nip.required'      => 'Field NIP harus diisi.',
                'nip.unique'        => 'NIP sudah terdaftar',
                'nama.required'     => 'Field nama harus diisi',
                'unit.required'     => 'Field unit harus diisi.',
                'email.required'    => 'Field email harus diisi.',
                'email.email'       => 'Field email tidak valid',
                'email.max'         => 'Field email maksimal 40 karakter',
                'email.unique'      => 'Email sudah terdaftar',
                'telepon.max'       => 'Field telepon maksimal 15 karakter',
                'alamat.max'        => 'Field alamat maksimal 225 karakter'
            ]
        );

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
}
