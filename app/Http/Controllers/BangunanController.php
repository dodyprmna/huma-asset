<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBangunanRequest;
use App\Models\FileBangunan;
use App\Models\Bangunan;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBangunanRequest;
use Illuminate\Http\RedirectResponse;

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

    function deleteFile(Request $request) {

        $file = FileBangunan::find($request->id);
        return response()->json(['file' => $file]);
    }

    function update(UpdateBangunanRequest $request) {
        $validated = $request->validated(); 

        $bangunan = Bangunan::find($request->id_bangunan);

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

        if ($request->hasfile('file')) { 
            $files = [];
            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    $file->move(public_path('uploads/bangunan'), $filename);                    
                    $files[] = [
                        'id_bangunan'   => $request->id_bangunan,
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

    function destroy(Bangunan $bangunan) : RedirectResponse{
        $bangunan->delete();

        return redirect('bangunan')->with('success','Data bangunan berhasil dihapus');
    }
    
    public function exportExcel()
    {
        if ($this->input->post('unit') == 'all') {
            $unit_name = 'All Unit';
            if ($this->session->userdata('jenis_call_center') == 0) {
                $id = null;
            }elseif($this->session->userdata('jenis_call_center') == 1){
                $bawahan = $this->db->get_where('call_center', ['bawah_up3' => $this->session->userdata('id_call_center'), 'deleted_at' => null])->result();
    
                $id = array_column($bawahan,'id_call_center');
                array_push($id, $this->session->userdata('id_call_center'));
            }else{
                $id = $this->input->post('unit');
            }
            $bangunan = $this->Bangunan_model->getAll($id)->result();
        }else{
            $bangunan = $this->Bangunan_model->getAll($this->input->post('unit'))->result();
            $unit_name = $this->db->get_where('call_center',['id_call_center' => $this->input->post('unit')])->row()->nama_call_center;
        }

        $filename = 'Content-Disposition: attachment; filename=Bangunan '.$unit_name.'_'.date('dmyHis').'.xlsx';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
        'font' => ['bold' => true], // Set font nya jadi bold
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ],
        'borders' => [
            'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
            'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
            'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
        ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
        ],
        'borders' => [
            'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
            'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
            'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
        ]
        ];

        $sheet->setCellValue('A1', "DATA BANGUNAN");
        $sheet->mergeCells('A1:L1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center'); // Set bold kolom A1

        $sheet->setCellValue('A3', "NO"); 
        $sheet->setCellValue('B3', "Unit");
        $sheet->setCellValue('C3', "No. Asset");
        $sheet->setCellValue('D3', "Nama Aset");
        $sheet->setCellValue('E3', "Lokasi");
        $sheet->setCellValue('F3', "Luas Bangunan");
        $sheet->setCellValue('G3', "Tahun Perolehan");
        $sheet->setCellValue('H3', "Nilai Perolehan");
        $sheet->setCellValue('I3', "Nilai Buku");
        $sheet->setCellValue('J3', "Masa Berlaku Pajak");
        $sheet->setCellValue('K3', "Keterangan");
        $sheet->setCellValue('L3', "Status");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        $sheet->getStyle('I3')->applyFromArray($style_col);
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);
        $sheet->getStyle('L3')->applyFromArray($style_col);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($bangunan as $data){ 
            $sheet->setCellValue('A'.$numrow, $no);
            $sheet->setCellValue('B'.$numrow, $data->nama_call_center);
            $sheet->setCellValue('C'.$numrow, $data->nomor_asset);
            $sheet->setCellValue('D'.$numrow, $data->nama_asset);
            $sheet->setCellValue('E'.$numrow, $data->lokasi);
            $sheet->setCellValue('F'.$numrow, !empty($data->luas_bangunan) ? $data->luas_bangunan : '-');
            $sheet->setCellValue('G'.$numrow, !empty($data->tahun_perolehan) ? $data->tahun_perolehan : '-');
            $sheet->setCellValueExplicit('H'.$numrow, !empty($data->nilai_perolehan) ? $data->nilai_perolehan : '-',\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('I'.$numrow, !empty($data->nilai_buku) ? $data->nilai_buku : '-',\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('J'.$numrow, !empty($data->masa_berlaku_pajak) ? $data->masa_berlaku_pajak : '-');
            $sheet->setCellValue('K'.$numrow, !empty($data->keterangan) ? $data->keterangan : '-');
            $sheet->setCellValue('L'.$numrow, $data->status == 1 ? 'Aktif' : 'Nonaktif');
            
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('K'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('L'.$numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Bangunan");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header($filename); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
