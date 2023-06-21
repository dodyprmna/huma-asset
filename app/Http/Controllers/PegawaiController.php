<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Unit;
use App\Models\Level;
use Illuminate\Http\RedirectResponse;

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
                'nip'       => 'required|unique:pegawai',
                'nama'      => 'required',
                'unit'      => 'required',
                'email'     => 'required|email|unique:pegawai',
                'level'     => 'required'
            ],
            [
                'nip.required'      => 'Field NIP harus diisi.',
                'nama.required'     => 'Field nama harus diisi',
                'unit.required'     => 'Field unit harus diisi.',
                'email.required'    => 'Field email harus diisi.',
                'email.email'       => 'Field email harus alamat email.'
            ]
        );

        $pegawai = Pegawai::create($validateData);

        return back()->with('success', 'Pegawai berhasil ditambahkan');
    }
}
