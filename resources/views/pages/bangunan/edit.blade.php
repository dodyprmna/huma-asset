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
                    <form action="{{ url('bangunan/'.$bangunan->id_bangunan)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Unit *</label>
                            </div>
                            <div class="col-md-10">
                                <select name="call_center" class="form-control @error('call_center')is-invalid @enderror select2" data-placeholder="Pilih Unit" required>
                                    <option value="">- Pilih Unit -</option>
                                    @foreach($unit as $row)
                                        <option value="{{ $row->id_call_center }}" {{ $row->id_call_center == $bangunan->id_call_center ? 'selected' : ''}}>{{ $row->nama_call_center }}</option>
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
                                <input class="form-control @error('nomor_asset')is-invalid @enderror" type="text" name="nomor_asset" value="{{ old('nomor_asset', $bangunan->nomor_asset)}}" placeholder="Isikan nomor asset" required>
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
                                <input class="form-control @error('nama_asset')is-invalid @enderror" type="text" name="nama_asset" value="{{ old('nama_asset', $bangunan->nama_asset)}}" placeholder="Isikan nama asset" required>
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
                                <Textarea class="form-control @error('lokasi')is-invalid @enderror" name="lokasi" id="lokasi" required placeholder="Isikan lokasi" rows="3">{{ old('lokasi', $bangunan->lokasi)}}</Textarea>
                                @error('lokasi')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div id="map" style="height: 250px;"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Latitude *</label>
                            </div>
                            <div class="col-md-10">
                            <input class="form-control @error('latitude')is-invalid @enderror" type="text" name="latitude" value="{{ old('latitude', $bangunan->latitude)}}" id="latitude" placeholder="Isikan Latitude" required>
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
                            <input class="form-control @error('longitude')is-invalid @enderror" type="text" name="longitude" value="{{ old('longitude', $bangunan->longitude)}}" id="longitude" placeholder="Isikan longitude" required>
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
                                <input class="form-control @error('luas_bangunan')is-invalid @enderror" step="any" min="1" type="number" name="luas_bangunan" value="{{ old('luas_bangunan', $bangunan->luas_bangunan)}}" placeholder="Isikan luas bangunan" >
                                @error('luas_bangunan')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Tahun Perolehan</label></div>
                            <div class="col-md-10">
                                <input class="form-control @error('tahun_perolehan')is-invalid @enderror" min="1" type="number" name="tahun_perolehan" value="{{ old('tahun_perolehan', $bangunan->tahun_perolehan)}}" placeholder="Isikan tahun perolehan">
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
                                <input class="form-control numeric @error('nilai_perolehan')is-invalid @enderror" type="text" min="1" name="nilai_perolehan" value="{{ old('nilai_perolehan', $bangunan->nilai_perolehan)}}" placeholder="Isikan nilai perolehan">
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
                                <input class="form-control numeric  @error('nilai_buku')is-invalid @enderror" type="text" min="1" name="nilai_buku" value="{{ old('nilai_buku',$bangunan->nilai_buku)}}" placeholder="Isikan nilai buku">
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
                                <input class="form-control  @error('masa_berlaku_pajak')is-invalid @enderror" type="date" name="masa_berlaku_pajak" id="masa_berlaku_pajak" value="{{ old('masa_berlaku_pajak', $bangunan->masa_berlaku_pajak)}}" placeholder="Isikan Masa Berlaku pajak">
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
                                    @foreach ($file as $item)
                                        <tr>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-11">
                                                            <h5><?= $item->nama_file?></h5>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <form action="{{ url('bangunan/hapusFile/'.$item->id_file_bangunan)}}" method="post" class="delete_form">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td><input type="file" class="form-control @error('file')is-invalid @enderror" name="file[]"></td>
                                            <td><button type="button" class="btn btn-secondary btn-sm add-file"><i class="fa fa-plus"></i></button></td>
                                            @error('file.*')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
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
<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet@3.0.7/dist/esri-leaflet.js"></script>

<!-- Load Esri Leaflet Geocoder from CDN -->
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.2/dist/esri-leaflet-geocoder.css">
<script src="https://unpkg.com/esri-leaflet-geocoder@3.1.2/dist/esri-leaflet-geocoder.js"></script>

<!-- GEO SEARCH LEAFLET -->
<script src="https://unpkg.com/leaflet-geosearch@3.3.2/dist/geosearch.umd.js"></script>

<script>
    $(document).ready(function() {
        
    $('.select2').select2({
        theme: 'bootstrap4',
        width : '100%',
        placeholder : 'Select an option'
    });
    var marker;
    if ($('#latitude').val() && $('#longitude').val()) {
        var map = L.map('map').setView([$('#latitude').val(),$('#longitude').val()], 13);
        marker = L.marker([$('#latitude').val(),$('#longitude').val()]).addTo(map);
        marker.bindPopup($('#lokasi').val()).openPopup();
    }else{
        var map = L.map('map').setView([-2.2097007,113.8316245], 13);
    }

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZG9keXBybW5hIiwiYSI6ImNsMGcyNW91MjBteDUzY3F0bHR4d2w4cm0ifQ.3mmqPSYgQVzY0SuKLuLJQA', 
    {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiZG9keXBybW5hIiwiYSI6ImNsMGcyNW91MjBteDUzY3F0bHR4d2w4cm0ifQ.3mmqPSYgQVzY0SuKLuLJQA'
    }).addTo(map);

    //search box map
    var GeoSearchControl = window.GeoSearch.GeoSearchControl;
    var OpenStreetMapProvider = window.GeoSearch.OpenStreetMapProvider;

    // remaining is the same as in the docs, accept for the var instead of const declarations
    var provider = new OpenStreetMapProvider();



    var searchControl = new GeoSearchControl({
        provider: provider,
        showMarker: false, // optional: true|false  - default true
        showPopup: false, // optional: true|false  - default false
        position: 'topright',
        marker: {
            // optional: L.Marker    - default L.Icon.Default,
            icon: new L.Icon.Default(),
            draggable: true,
        },
        popupFormat: ({ query, result }) => result.label, // optional: function    - default returns result label,
        resultFormat: ({ result }) => result.label, // optional: function    - default returns result label
        maxMarkers: 1, // optional: number      - default 1
        retainZoomLevel: false, // optional: true|false  - default false
        animateZoom: true, // optional: true|false  - default true
        autoClose: false, // optional: true|false  - default false
        searchLabel: 'Enter address', // optional: string      - default 'Enter address'
        keepResult: true, // optional: true|false  - default false
        updateMap: true, // optional: true|false  - default true
        
    });
    map.addControl(searchControl); 

    //get coordinates 
    map.on('click', function(e){
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }
        var latInput = $('#latitude').val(lat);
        var longInput = $('#longitude').val(lng); 
        
        $.ajax({
            url:"https://nominatim.openstreetmap.org/reverse",
            data:"lat="+lat+
            "&lon="+lng+
            "&format=json",
            dataType:"JSON",
            success:function(data){
                console.log(data);
                marker.bindPopup(data.display_name).openPopup();
                $('#lokasi').val(data.display_name);
            }
        })
    });

    $("#form_import").submit(function (e) {
        e.preventDefault();
        
        $("#body_modal_import").html("<i class='fas fa-spinner fa-spin'></i>");
        
        // $.ajax({
            // 	url: base_url + "Bangunan/importExcel/",
            // 	type: "post",
            // 	dataType: "json",
            // 	data: new FormData(this),
            // 	cache: false,
            // 	contentType: false,
            // 	processData: false,
            // 	success: function (data) {
                // 		if (data["status"]) {
                    // 			$("#form_import")[0].reset();
                    // 			$('#modal_import').modal('toggle');
                    // 			swal({
                        // 				title: "Berhasil",
                        // 				text: data.pesan,
                        // 				icon: "success",
                        // 			});
                        
                        // 			setTimeout(function() { 
                            // 				location.reload();
                            // 			}, 2000);
                            // 		} else {
                                // 			swal({
                                    // 				title: "Gagal",
                                    // 				text: data.pesan,
                                    // 				icon: "error",
                                    // 			});
                                    // 		}
                                    // 	},
                                    // });
                                });
                                
                                $('.delete_form').submit(function (e) {
                                    e.preventDefault();

                                    var url = $(this).attr("action");
                                    swal({
                                        title: "Apakah anda yakin?",
                                        text: "file yang dihapus tidak dapat dipulihkan!",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    }).then((result) => {
                                        if (result) {	
                                            $.ajax({
                                                url: url,
                                                type: 'delete',
                                                dataType: 'json',
                                                data: {id : id},
                                                success:function(data){
                                                    // console.log(data);
                                                    if (data['status']) {
                                                        $('#item_file').html(data.html);
                                                    }
                                                }
                                            });
                                        }
                                    });
                                });
                                
                                $(document).on("click", ".add-file", function () {
                                    $('#file').append('<tr><td><input type="file" class="form-control" name="file[]"></td><td><button type="button" class="btn btn-danger btn-sm btn-min"><i class="fa fa-minus"></i></button></td></tr>')
                                });
                                
                                $(document).on("click", ".btn-min", function () {
                                    $(this).closest('tr').remove();
                                });
        });
    </script>
@endpush