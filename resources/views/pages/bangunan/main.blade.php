@extends('layouts.main')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">{{ $title }}</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
					<div class="row">
						<div class="col-md-12">
							
								<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_export"><i class="fa fa-file-excel"></i> Excel</button>
							
								<a href="{{ url('bangunan/create') }}" class="btn btn-primary btn-sm" style="float: right; margin-left: 3px;"><i class="fa fa-plus"></i> Tambah Data</a>
								<button class="btn btn-secondary btn-sm" title="Import Excel" data-toggle="modal" data-target="#modal_import" style="float: right;"><i class="fas fa-file-import"></i></button>
							
						</div>
					</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
									<th>Unit</th>
                                    <th>No. Aset</th>
                                    <th>Nama Aset</th>
                                    <th>Luas</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bangunan as $item)
                                    
                                
                                <tr>
                                    <td>
                                        <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{ url('bangunan/'.$item->id_bangunan) }}" class="btn btn-secondary" title="Lihat Data"><i class="fa fa-eye"></i></a>
                                            
                                                <a href="{{ url('bangunan/'.$item->id_bangunan.'/edit') }}" class="btn btn-primary" title="Edit Data"><i class="fa fa-edit"></i></a>
                                            
                                            
                                                <a href="" class="btn btn-danger" title="Hapus Data" onclick=""><i class="fa fa-trash"></i></a>
                                                                                    
                                        </div>
                                    </td>
                                    <td>{{$item->unit->nama_call_center}}</td>
                                    <td>{{$item->nomor_asset}}</td>
                                    <td>{{$item->nama_asset}}</td>
                                    <td>{{$item->luas }}</td>
                                    <td>{{$item->lokasi }}</td>
                                    <td>
                                    @if ($item->status == 1)
                                        <span class='badge badge-pill badge-success'>Aktif</span>
                                    @else
                                        <span class='badge badge-pill badge-danger'>Non Aktif</span>
                                    @endif </td>
                                    <form id="" action="" method="POST" style="display: none;">
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width : '100%',
                theme: 'bootstrap4',
            });

            $(".table").DataTable({
                stateSave: true,
            });

            $('#btn_reset_form_export').click(function(){
                $("#unit").val('').trigger('change');
            });

            $("#form_import").submit(function (e) {
		        e.preventDefault();
                $("#btn_import_tanah").prop('disabled', true).html('<div class="loader"></div>');
                $("#btn_reset_import_tanah").prop('disabled', true);

                $.ajax({
                    url: base_url + "Tanah/importExcel/",
                    type: "post",
                    dataType: "json",
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data["status"]) {
                            $("#form_import_tanah").trigger("reset");
                            $('#modal_import_tanah').modal('toggle');
                            swal({
                                title: "Berhasil",
                                text: data.pesan,
                                icon: "success",
                            });
                            
                            setTimeout(function() { 
                                location.reload();
                            }, 2000);
                        } else {
                            swal({
                                title: "Gagal",
                                text: data.pesan,
                                icon: "error",
                            });
                            $("#form_import_tanah").trigger("reset");
                            $("#btn_import_tanah").html("Submit").prop('disabled', false);
                            $("#btn_reset_import_tanah").prop('disabled', false);
                        }
                    },
                });
            });
        });
    </script>
@endpush
