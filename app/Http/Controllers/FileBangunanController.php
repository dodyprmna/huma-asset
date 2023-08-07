<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileBangunan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Bangunan;

class FileBangunanController extends Controller
{
    function destroy($id) {
        $file = FileBangunan::find($id);

        $filePath = public_path('uploads/bangunan/'.$file->nama_file);
        if (File::exists($filePath)) {
            $deletedFile = File::delete($filePath);
        }
        
        $file->delete($id);

        $file_bangunan = Bangunan::find($file->id_bangunan)->file;
        $html = '';

        foreach ($file_bangunan as $item) {
            $html .= '<div class="card">'.
            '<div class="card-body">'.
                '<div class="row">'.
                    '<div class="col-md-11">'.
                        '<h5>'.$item->nama_file.'</h5>'.
                    '</div>'.
                    '<div class="col-md-1">'.
                        '<button type="button" class="btn btn-danger btn-xs btn-hapus-file" data-id="'.$item->id_file_bangunan.'"><i class="fa fa-trash"></i></button>'.
                    '</div>'.
                '</div>'.
            '</div>'.
        '</div>';
        }
        return response()->json([
            'status'    => 200,
            'html'      => $html
        ]);
    }
}
