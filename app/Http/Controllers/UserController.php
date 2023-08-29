<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\Unit;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title'     => 'List Pegawai',
            'menu'      => 'Pegawai', 
            'pegawai'   => User::all()
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

        $user = new User;

        $user->nip = $request->nip;
        $user->nama = $request->nama;
        // $user->id_call_center = $request->unit;
        // $user->id_level = $request->level;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->telepon;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->password = Hash::make($request->nip);

        $user->save();

        return redirect('user')->with('success','Data user berhasil ditambahkan');

    }

    public function edit($id)
    {
        $data = array(
            'title'     => 'Edit Pegawai',
            'menu'      => 'Pegawai', 
            'pegawai'   => User::find($id),
            'level'     => Level::all(),
            'unit'      => Unit::all()
        );

        return view('pages.pegawai.edit', $data);
    }

    public function update(UpdatePegawaiRequest $request, User $id): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::find($request->id_pegawai);

        // echo json_encode($pegawai); die();

        $user->nip = $request->nip;
        $user->nama = $request->nama;
        // $user->id_call_center = $request->unit;
        // $user->id_level = $request->level;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->telepon;
        $user->email = $request->email;
        $user->status = $request->status;

        $user->save();

        return redirect('user')->with('success','Data user berhasil diperbarui');

    }

    public function show($id)
    {
        $data = array(
            'title'     => 'View Pegawai',
            'menu'      => 'Pegawai',
            'level'     => Level::all(),
            'unit'      => Unit::all(),
            'pegawai'   => User::find($id)
        );

        // var_dump($data); die();

        return view('pages.pegawai.view', $data);
    }

    function destroy(User $user) : RedirectResponse {
        $user->delete();

        return redirect('user')->with('success','Data user berhasil dihapus');
    }
}
