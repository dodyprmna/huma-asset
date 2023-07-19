<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBangunanRequest;
use App\Models\FileBangunan;
use App\Models\Bangunan;
use App\Models\Unit;
use Illuminate\Http\Request;

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

    public function store(StoreBangunanRequest $request) 
    {
        $validated = $request->validated(); 

        $bangunan = new Bangunan;

        $bangunan->id_call_center       = $request->call_center;
        $bangunan->nomor_asset          = $request->nomor_asset;
        $bangunan->nama_asset           = $request->nama_asset;
        $bangunan->lokasi               = $request->lokasi;
        $bangunan->latitude             = $request->latitude;
        $bangunan->longitude            = $request->longitude;
        $bangunan->luas_bangunan        = $request->luas_bangunan;
        $bangunan->tahun_perolehan      = $request->tahun_perolehan;
        $bangunan->nilai_perolehan      = $request->nilai_perolehan;
        $bangunan->masa_berlaku_pajak   = $request->masa_berlaku_pajak;
        $bangunan->keterangan           = $request->keterangan;
        $bangunan->status               = $request->status;
        $bangunan->status_pajak         = $request->status_pajak;


        $bangunan->save();
        $id = $bangunan->id_bangunan;

        if ($request->hasfile('file')) { 
            $files = [];
            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->move(public_path('uploads/bangunan'), $filename);                    
                    $files[] = [
                        'id_bangunan'   => $id,
                        'nama_file'     => $filename,
                    ];
                }
            }
            FileBangunan::insert($files);       
        }else{
            echo "gagal upload";
        }

        return redirect('bangunan')->with('success','Data bangunan berhasil diperbarui');

    }

    public function edit($id)
    {
        $data = array(
            'title'     => 'List Bangunan',
            'menu'      => 'Bangunan', 
            'bangunan'  => Bangunan::find($id),
            'file'      => Bangunan::find($id)->file,
            'unit'      => Unit::all()
        );

        // echo json_encode($data); die();

        return view('pages.bangunan.edit', $data);
    }

    function hapusFile(Request $request) {
        $bangunan = FileBangunan::find($request->id);

        echo json_encode($bangunan);
        // $bangunan->delete();
        
    }
}
