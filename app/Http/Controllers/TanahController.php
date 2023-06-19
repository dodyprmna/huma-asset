<?php

namespace App\Http\Controllers;

use App\Models\Tanah;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class TanahController extends Controller
{
    public function index()
    {
        return view(
            'pages/tanah/main',
            [
                'title' => 'Tanah',
                'menu'  => 'Tanah'
            ]
        );
    }

    public function create()
    {
        return view(
            'pages/tanah/create',
            [
                'title' => 'Create Tanah',
                'menu'  => 'Tanah'
            ]
        );
    }

    public function store(Request $request)
    {
        // echo json_encode($request->nama_asset);

        $tanah = new Tanah;

        $tanah->nama_asset = $request->nama_asset;

        $tanah->save();

        return redirect('Tanah');
    }
}
