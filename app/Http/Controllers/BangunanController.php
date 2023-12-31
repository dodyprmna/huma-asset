<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bangunan;
use App\Models\Unit;

class BangunanController extends Controller
{
    public function index()
    {
        $data = array(
            'title'     => 'List Bangunan',
            'menu'      => 'Bangunan', 
            'bangunan'  => Bangunan::with('unit:id_call_center,nama_call_center')->get()
        );

        // echo json_encode($data); die();

        return view('pages.bangunan.main', $data);
    }

    public function create()
    {
        $data = array(
            'title'     => 'Create Bangunan',
            'menu'      => 'Bangunan', 
            'unit'      => Unit::all()
        );

        // echo json_encode($data); die();

        return view('pages.bangunan.create', $data);
    }

    public function store()
    {
        $data = array(
            'title'     => 'List Bangunan',
            'menu'      => 'Bangunan', 
            'bangunan'  => Bangunan::with('unit:id_call_center,nama_call_center')->get()
        );

        // echo json_encode($data); die();

        return view('pages.bangunan.main', $data);
    }

    public function edit()
    {
        $data = array(
            'title'     => 'List Bangunan',
            'menu'      => 'Bangunan', 
            'bangunan'  => Bangunan::with('unit:id_call_center,nama_call_center')->get()
        );

        // echo json_encode($data); die();

        return view('pages.bangunan.main', $data);
    }
}
