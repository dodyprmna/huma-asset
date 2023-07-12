<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bangunan;

class BangunanController extends Controller
{
    public function index()
    {
        $data = array(
            'title'     => 'List Bangunan',
            'menu'      => 'Bangunan', 
            'bangunan'  => Bangunan::all()->join('call_center')
        );

        echo json_encode($data); die();

        return view('pages.bangunan.main', $data);
    }
}
