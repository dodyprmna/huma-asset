@extends('layouts.main')

@section('content')
<div class="page-inner">
    <div class="page-header">
		<h4 class="page-title"><a href="{{ url()->previous() }}" title="Back"><i class=" fa fa-arrow-left"></i></a></h4>
        <ul class="breadcrumbs">
            <li class="nav-item">
                <a href="#"><?= $menu?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><?= $title?></h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('pegawai/'.$pegawai->id_pegawai) }}" method="post" id="form_pegawai">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id_pegawai" value="{{ isset($pegawai->id_pegawai) ? $pegawai->id_pegawai : '' }}">
                        <div class="form-group">
                            <label>NIP *</label>
							<input type="text" class="form-control @error('nip')is-invalid @enderror" pattern="^[^\s]+(\s+[^\s]+)*$" id="nip" name="nip" value="{{ old('nip',$pegawai->nip) }}" placeholder="Masukan NIP Pegawai" required>
                            @error('nip')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
						<div class="form-group">
                            <label>Nama *</label>
							<input type="text" class="form-control @error('nama')is-invalid @enderror" pattern="^[^\s]+(\s+[^\s]+)*$" id="nama" name="nama" value="{{ old('nama', $pegawai->nama) }}" placeholder="Masukan Nama Pegawai" required>
                            @error('nama')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
						<div class="form-group">
							<label>Unit *</label>
							<select name="unit" id="unit" class="form-control select2 @error('unit')is-invalid @enderror" required> 
								<option value="" disabled selected hidden="">- Pilih Unit -</option>
								@foreach ($unit as $row)   
								    <option value="{{ $row->id_call_center }}" {{ $pegawai->id_call_center == $row->id_call_center ? 'selected' : ''}}>{{ $row->nama_call_center }}</option>
								@endforeach
							</select>
                            @error('unit')
                                {{ $message }}
                            @enderror
						</div>
						<div class="form-group">
                            <label>Alamat</label>
							<input type="text" class="form-control @error('alamat')is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $pegawai->alamat) }}" placeholder="Masukan Alamat Pegawai">
                            @error('alamat')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
						<div class="form-group">
                            <label>No. Telepon</label>
							<input type="text" class="form-control @error('telepon')is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $pegawai->no_telp) }}" placeholder="Masukan No. Telepon">
                            @error('telepon')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
						<div class="form-group">
                            <label>Email *</label>
							<input type="text" class="form-control @error('email')is-invalid @enderror" id="email" name="email" value="{{ old('email', $pegawai->email) }}" placeholder="Masukan Email" required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
						<div class="form-group">
							<label>Level *</label>
							<select name="level" id="level" class="form-control select2 @error('level')is-invalid @enderror" required>
								<option value="" disabled selected hidden="">- Pilih Level -</option> 
                                @foreach ($level as $row)
								<option value="<?= $row->id_level;?>" {{ $pegawai->id_level == $row->id_level ? 'selected' : ''}}><?= $row->nama;?></option>
								@endforeach
							</select>
                            @error('level')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
						</div>		
						<div class="form-group">
							<div style="margin-left: 0pt;">
								<label>Status</label>
							</div>
                            <div class="col-sm-2">
                                <div class="form-group">
									<input class="form-check-input" type="radio" value="1" name="status" {{ $pegawai->status == 1 ? 'checked' : '' }}>
									<label class="form-check-label" for="exampleRadios1">
										Aktif
									</label><br>
									<input class="form-check-input" type="radio" name="status" value="0" {{ $pegawai->status == 0 ? 'checked' : '' }}>
									<label class="form-check-label" for="exampleRadios2">
										Tidak Aktif
									</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: right;">
                            <button class="btn btn-danger btn-sm" type="reset">Reset</button>
                            <button class="btn btn-primary btn-sm btn_submit" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection