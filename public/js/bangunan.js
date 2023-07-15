$(document).ready(function () {
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

	$(document).on("click", ".btn-hapus-file", function () {
		var id = $(this).data('id');
        swal({
			title: "Apakah anda yakin?",
			text: "file yang dihapus tidak dapat dipulihkan!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			}).then((result) => {
				if (result) {	
					$.ajax({
						url: base_url+"Bangunan/hapus_file/",
						type: 'post',
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

inputMask();
function inputMask(){
	$('.numeric').inputmask({
		alias:"numeric",
		digits:2,
		repeat:18,
		digitsOptional:false,
		decimalProtect:true,
		groupSeparator:",",
		placeholder: '0',
		radixPoint:".",
		radixFocus:true,
		autoGroup:true,
		autoUnmask:false,
		rightAlign: false,
		allowMinus: false,
		clearMaskOnLostFocus: false,
		onBeforeMask: function (value, opts) {
			return value;
		},
		removeMaskOnSubmit:true
	});
}
