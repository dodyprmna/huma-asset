@extends('layouts.main')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"><a href="{{ url('bangunan') }}" title="Back"><i class=" fa fa-arrow-left"></i></a></h4>
        <input type="hidden" name="" id="hrefback" value="{{ url('bangunan')}}">
        <ul class="breadcrumbs">
            <li class="nav-item">
                <a href="#">{{ $menu }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Create</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $title}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('bangunan')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Unit *</label>
                            </div>
                            <div class="col-md-10">
                                <select name="call_center" class="form-control @error('call_center')is-invalid @enderror select2" data-placeholder="Pilih Unit" required>
                                    <option value="">- Pilih Unit -</option>
                                    @foreach($unit as $row)
                                        <option value="{{ $row->id_call_center }}" {{ $row->id_call_center == old('call_center') ? 'selected' : ''}}>{{ $row->nama_call_center }}</option>
                                    @endforeach
                                </select>
                                @error('call_center')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Nomor Asset *</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('nomor_asset')is-invalid @enderror" type="text" name="nomor_asset" value="{{ old('nomor_asset')}}" placeholder="Isikan nomor asset" required>
                                @error('nomor_asset')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Nama Asset *</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('nama_asset')is-invalid @enderror" type="text" name="nama_asset" value="{{ old('nama_asset')}}" placeholder="Isikan nama asset" required>
                                @error('nama_asset')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Lokasi *</label>
                            </div>
                            <div class="col-md-6">
                                <Textarea class="form-control @error('lokasi')is-invalid @enderror" name="lokasi" id="lokasi" required placeholder="Isikan lokasi" rows="3">{{ old('lokasi')}}</Textarea>
                                @error('lokasi')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4" id='map'>
                                {{-- <div id="map" style="height: 150px;"></div> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Latitude *</label>
                            </div>
                            <div class="col-md-10">
                            <input class="form-control @error('latitude')is-invalid @enderror" type="text" name="latitude" value="{{ old('latitude')}}" id="latitude" placeholder="Isikan Latitude" required>
                                @error('latitude')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Longitude *</label>
                            </div>
                            <div class="col-md-10">
                            <input class="form-control @error('longitude')is-invalid @enderror" type="text" name="longitude" value="{{ old('longitude')}}" id="longitude" placeholder="Isikan longitude" required>
                                @error('longitude')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Luas Bangunan</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('luas_bangunan')is-invalid @enderror" step="any" min="1" type="number" name="luas_bangunan" value="{{ old('luas_bangunan')}}" placeholder="Isikan luas bangunan" >
                                @error('luas_bangunan')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Tahun Perolehan</label></div>
                            <div class="col-md-10">
                                <input class="form-control @error('tahun_perolehan')is-invalid @enderror" min="1" type="number" name="tahun_perolehan" value="{{ old('tahun_perolehan')}}" placeholder="Isikan tahun perolehan">
                                @error('tahun_perolehan')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Nilai Perolehan</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control numeric @error('nilai_perolehan')is-invalid @enderror" type="text" min="1" name="nilai_perolehan" value="{{ old('nilai_perolehan')}}" placeholder="Isikan nilai perolehan">
                                @error('nilai_perolehan')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Nilai Buku</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control numeric  @error('nilai_buku')is-invalid @enderror" type="text" min="1" name="nilai_buku" value="{{ old('nilai_buku')}}" placeholder="Isikan nilai buku">
                                @error('nilai_buku')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-2">
                                <label>Masa Berlaku Pajak</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control  @error('masa_berlaku_pajak')is-invalid @enderror" type="date" name="masa_berlaku_pajak" id="masa_berlaku_pajak" value="{{ old('masa_berlaku_pajak')}}" placeholder="Isikan Masa Berlaku pajak">
                                @error('masa_berlaku_pajak')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Keterangan</label>
                            </div>
                            <div class="col-md-10">
                                <Textarea class="form-control" name="keterangan" placeholder="Isikan keterangan">{{ old('keterangan')}}</Textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>File</label><br><i>jpg, jpeg, png, pdf max. 3mb</i>
                            </div>
                            <div class="col-md-10">
                                <table id="file">
                                    <tr>
                                        <td><input type="file" class="form-control" name="file[]"></td>
                                        <td><button type="button" class="btn btn-secondary btn-sm add-file"><i class="fa fa-plus"></i></button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Status</label>
                            </div>
                            <div class="col-md-10 mt--2">
                                    <div class="form-check ml-2">
                                        <input class="form-check-input" id="aktif" type="radio" value="1" name="status" checked>
                                        <label class="form-check-label" for="aktif">
                                            Aktif
                                        </label>
                                    </div>
                                    <div class="form-check ml-2">
                                        <input class="form-check-input" id="nonaktif" type="radio" name="status" value="0" >
                                        <label class="form-check-label" for="nonaktif">
                                            Tidak Aktif
                                        </label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Status Pajak</label>
                            </div>
                            <div class="col-md-10 mt--2">
                                    <div class="form-check ml-2">
                                        <input class="form-check-input" id="kena_pajak" type="radio" value="1" name="status_pajak" checked>
                                        <label class="form-check-label" for="kena_pajak">
                                            Kena Pajak
                                        </label>
                                    </div>
                                    <div class="form-check ml-2">
                                        <input class="form-check-input" id="tidak_kena_pajak" type="radio" name="status_pajak" value="0" >
                                        <label class="form-check-label" for="tidak_kena_pajak">
                                            Tidak Kena Pajak
                                        </label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: right;">
                            <button class="btn btn-danger btn-sm" type="reset">Reset</button>
                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ url('template/js/plugin/leaflet/leaflet.js')}}"></script>
	<script src="{{ url('js/bangunan.js') }}"></script>
@endpush