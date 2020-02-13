	<style>
		#map{
			width: 100%;
			height: 350px;
		}
		
		#map .form-control{
			width: 50% !important;
			top: 8px !important;
		}
		.panel.white{
			min-height: 440px;
		}
		.add-location{
			color:#4caf50 !important;
			font-size: 2em;
			opacity: 0.8;
		}
		.add-location:hover{
			opacity: 1;
		}
	</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<form action="<?=base_url($__controller.'/updateAddress');?>" class="form-horizontal" method="post">
					<div class="col-md-10">
						
						<?PHP
						$section = "SectionName_".$__lang;
						$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
					?>
					<h1>
						<?=$wbs[0]->$section?> 
						
<!--
						<div class="dropdown d-inline-block float-left-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
						    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url($__controller."/editSection/".$wbs[0]->Section_ID."/".$return_url."/")?>"><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
						    </ul>
						</div>
-->
			
					</h1>
						
<!-- 						<h4 class="page-title"> <?=getSystemString(17)?></h4> -->
						
						<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
						
			          <div class="panel white" style="padding-bottom: 50px;">
				          
				          
							
							<div class="tab-content">
					          
					           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
						           
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor1"><?=getSystemString(371)?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
											<textarea name="editor1" id="editor1" rows="12" class="margin-bottom editors1" cols="40" ><?=$wbs[0]->Company_Address_en?></textarea>
											
										</div>
									</div>
					           </div>
					           
					           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
						           	<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="editor2"><?=getSystemString(371)?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
											<textarea name="editor2" id="editor2" rows="12" class="margin-bottom editors2" cols="40" ><?=$wbs[0]->Company_Address_ar?></textarea>
											
										</div>
									</div>
					           </div>
					           
							</div>
						
				          
			          </div>
					</div>
					<br><br>
					
					<div class="hide col-xs-12 col-sm-12 col-md-10">
						<h4 class="page-title"><?=getSystemString(240)?></h4>
						<div class="panel white" style="padding-bottom: 50px;height: 100%;overflow: hidden">
				          
				          <div class="col-xs-12" style="padding: 0px">
					          <a href="#" class="add-location btn hide"><i class="fa fa-plus-circle"></i></a>
					          <input id="pac-input" class="controls form-control" type="text" placeholder="Search Box"> 
							  		<div id="map"></div>
								  <input type="hidden" id="latitude" name="latitude" value="<?=$wbs[0]->Latitude?>" >
								  <input type="hidden" id="longitude" name="longitude" value="<?=$wbs[0]->Longitude?>">
								  <input type="hidden" id="frm_address" name="frm_address" value="">
								  <input type="hidden" id="markers" value='<?=json_encode($markers)?>'>
				          </div>
			          </div>
					</div>
					
								<div class="col-xs-12 col-md-10 text-center">
									<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
								</div>
						      
		          </form>
				
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<!-- <script src="<?=base_url('style/acp/js/setMap.js')?>"></script> -->
<script>
 	var uniqueId = 1;
 	var mp_markers = {};
	function initAutocomplete() {
		var myLatLng = {
				lat: parseFloat(document.getElementById("latitude").value), 
				lng: parseFloat(document.getElementById("longitude").value)
			};
        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 6,
          mapTypeId: 'roadmap'
        });

		// google map search box manipulation
		googleSearch(map);
        
        // adding markers to google map from database
		if(JSON.parse(document.getElementById("markers").value).length > 0){
			createMarkers(map);
		}
        
        google.maps.event.addListenerOnce(map, 'idle', function(){
			$('#pac-input').after($('.add-location'));
			$('.add-location').removeClass('hide');
			$('body[dir="ltr"] .add-location').css({
				'z-index': '1',
				'position': 'absolute',
				'top': '2px',
				'left': (parseInt($('#pac-input').width()) + 96) + "px"
			});
			
			$('body[dir="rtl"] .add-location').css({
				'z-index': '1',
				'position': 'absolute',
				'top': '-7px',
				'left': '110px'
			});
		});
        
      }
      
    function updateInput(lat, lng) {
	    document.getElementById("latitude").value = lat ;
      	document.getElementById("longitude").value = lng;
    }
	
	window.onload = initAutocomplete;

function addMarkerToDB(){
	var data = {
				latitude: $('#latitude').val(),
				longitude: $('#longitude').val(),
				address: $('#frm_address').val()
			};
	$.ajax({
			url: "<?=base_url('acp/saveLocation')?>",
			type: "POST",
			dataType: "JSON",
			data: data,
			success: function(result){
				console.log(result);
				$('#pac-input').val('');
				alert('Location added to google map');
			},
			error:function(err, status, xhr){
				console.log(err);
				console.log(status);
				console.log(xhr);
			}
	});
}

function googleSearch(map){
	    var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

		// searching in map and add marker to google map after search
        var markers = [];
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          places.forEach(function(place) {
	          document.getElementById("frm_address").value = place.formatted_address;
	          document.getElementById("latitude").value = place.geometry.location.lat();
	          document.getElementById("longitude").value = place.geometry.location.lng();
          });
          
          if (places.length == 0) {
            return;
          }
		  
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          var bounds = new google.maps.LatLngBounds();
          //Create marker for the address returned
          createMakerForSearchResult(map, places);
          
          map.fitBounds(bounds);
        });
}

function createMakerForSearchResult(map, places){
	places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            var marker_srch = new google.maps.Marker({
              map: map,
              draggable: true,
              title: place.name,
              position: place.geometry.location
            });
            
             google.maps.event.addListener(marker_srch, 'dragend', function() {
			 	updateInput(this.position.lat(), this.position.lng());
        	 });

            if (place.geometry.viewport) {
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
}

function createMarkers(map){
        var infoWindow = new google.maps.InfoWindow();
        var uniqueId = 0;
        var ll_mk = JSON.parse(document.getElementById("markers").value);
        for(var i = 0; i < ll_mk.length; i++) {
			var lat = parseFloat(ll_mk[i].lat);
			var lng = parseFloat(ll_mk[i].lng);	
			
			var pos = new google.maps.LatLng(lat, lng);
			marker = new google.maps.Marker({
	          position: pos,
	          draggable: true,
	          map: map,
	        });
	        var data = ll_mk[i];
			mp_markers[i] = marker;
			marker.id = i;
            // add click event for google map markers
			(function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    console.log(marker.id);
                    var content = data.Address;
					content += "<br /><input type = 'button' value = 'Delete' class='delete-marker' data-id='"+marker.id+"' data-lat ='"+data.lat+"' data-lng='"+data.lng+"' value = 'Delete' />";
                    infoWindow.setContent(content);
                    infoWindow.open(map, marker);
                });
            })(marker, data);
					
		}
        
        google.maps.event.addListener(marker, 'dragend', function() {
			updateInput(this.position.lat(), this.position.lng());
        });
}

$(function(){
	$('.add-location').click(function(){
		addMarkerToDB();
		return false;
	});
	var cc = 0;
	$('#pac-input').keydown(function (e){
		
	    if(e.keyCode == 13){
		    cc++;
		    if(cc == 2){
	        	addMarker();
	        	cc = 0;
	        }
	        return false;
	    }
	});
	
$(document).on('click', '.delete-marker', function(){
	var id = $(this).attr('data-id');
	var lat = $(this).attr('data-lat');
	var lng = $(this).attr('data-lng');
	var index = $(this).attr('data-index');
        //Remove the marker from Map
        	var marker = mp_markers[id];
            marker.setMap(null);
            var data = {
	            lat: lat,
	            lng: lng
            };
            $.ajax({
			 		url: "<?=base_url('acp/deleteLocation')?>",
			 		type: "POST",
	                dataType: "JSON",
	                data: data,
			 		success: function(result){
				 		console.log(result);
				 		 //location.reload(true);
				 	},
			 		error:function(err, status, xhr){
				 		console.log(err);
				 		console.log(status);
				 		console.log(xhr);
			 		}
			});
	});
	
});
</script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC88G_-I2GZl8sVDs95qoxcuqBy9_q36nQ&libraries=places"
         async defer></script>
         </body>
</html>