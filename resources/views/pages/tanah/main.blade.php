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
							
								<a href="{{ url('Tanah/create') }}" class="btn btn-primary btn-sm" style="float: right; margin-left: 3px;"><i class="fa fa-plus"></i> Tambah Data</a>
								<button class="btn btn-secondary btn-sm" title="Import Excel" data-toggle="modal" data-target="#modal_import_tanah" style="float: right;"><i class="fas fa-file-import"></i></button>
							
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
                                    <th>No Asset</th>
                                    <th>No Sertifikat</th>
                                    <th>Lokasi</th>
									<th>Luas Tanah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="" class="btn btn-secondary" title="Lihat Data"><i class="fa fa-eye"></i></a>
                                            
                                                <a href="" class="btn btn-primary" title="Edit Data"><i class="fa fa-edit"></i></a>
                                            
                                            
                                                <a href="" class="btn btn-danger" title="Hapus Data" onclick=""><i class="fa fa-trash"></i></a>
                                                                                    
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>></td>
                                    <form id="" action="" method="POST" style="display: none;">
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal import -->
	<div class="modal fade" id="modal_import_tanah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Import data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="body_modal_import">
					<form action="#" enctype="multipart/form-data" method="post" id="form_import_tanah">
						<div class="form-group row">
							<div class="col-md-2">
								<label>File Excel *</label>
							</div>
							<div class="col-md-10">
								<table id="file">
									<tr>
										<td><input type="file" class="form-control" name="file" required></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="form-group" style="text-align: right;">
							<button class="btn btn-danger btn-sm" type="reset" id="btn_reset_import_tanah">Reset</button>
							<button class="btn btn-outline-primary btn-sm" id="btn_import_tanah" type="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- end modal import -->
@endsection