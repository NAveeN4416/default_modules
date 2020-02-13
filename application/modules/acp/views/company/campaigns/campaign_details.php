	<style>
		.panel.white{
			min-height: 150px;
		}
		.nav-social{
			padding: 0px;
			list-style: none;
			width: auto;
			margin: auto;
			height: 30px;
		}
		table th{
			width: 200px;
		}
		body[dir="ltr"] table td, body[dir="ltr"] table th{
			text-align: left !important;
		}
		body[dir="rtl"] table td, body[dir="rtl"] table th{
			text-align: right !important;
		}
		#map{
			width: 100%;
			height: 350px;
		}
	</style>

	<div id="content-main">
		
		<div class="row">
			<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
		</div>
		
		<div class="row">
						
			<div class="col-md-11">
			<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer"><?=$campaign->Campaign_Name?></h3>
			<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
				
				<table class="table table-hover display" id="campaign_table" width="100%">
					<tbody>
						<tr>
							<th><?=getSystemString(311)?></th>
							<td>
								<?PHP
									echo $campaign->Company_Name;
								?>	
							</td>
						</tr>
						<tr>
							<th><?=getSystemString(72)?></th>
							<td>
								<?=$campaign->Company_Description?>
							</td>
						</tr>
						<!-- <tr>
							<th><?=getSystemString(158)?></th>
							<td>
								<?=getSystemString($campaign->Campaign_Type)?>
							</td>
						</tr> -->
						<tr>
							<th><?=getSystemString(144)?></th>
							<td>
								<?=$campaign->Campaign_Features?>
							</td>
						</tr>
						<tr>
							<th><?=getSystemString(164)?></th>
							<td><?=$campaign->Address?> <a href="https://www.google.com/maps/place/<?=$campaign->Location?>" target="_blank"> <i class="fa fa-map-marker" aria-hidden="true"></i> View on map</a></td>
						</tr>
						<tr>
							<th><?=getSystemString(167)?></th>
							<td><?=$campaign->Amount_Person?> SAR</td>
						</tr>
						<?php if($campaign->child_allowed==1){ ?>
							<tr>
								<th>Charges PerChild</th>
								<td><?=$campaign->Amount_child?> SAR</td>
							</tr>
						<?php }else{ ?>
							<tr>
								<th>Charges PerChild</th>
								<td style="color: red">Child Not Allowed</td>
							</tr>
						<?php } ?>
						<tr>
							<th><?=getSystemString(138)?></th>
							<td><?=$campaign->From_Date?></td>
						</tr>
						<tr>
							<th><?=getSystemString(139)?></th>
							<td><?=$campaign->To_Date?></td>
						</tr>
						<tr>
							<th><?=getSystemString(148)?></th>
							<td><?=$campaign->Total_Days?></td>
						</tr>
						<tr>
							<th><?=getSystemString(178)?></th>
							<td><?=$campaign->Total_Reservations?> <a href="<?php echo base_url(); ?>reservations/reservations_list/<?=$campaign->Campaign_ID?>" target="_blank"> - View Reservations</a></td>
						</tr>
						<tr>
							<th><?=getSystemString(177)?></th>
							<td><?=$campaign->Created_At?></td>
						</tr>
						<tr>
							<th><?=getSystemString(159)?></th>
							<td>
								<?PHP
								  $lat = '24.7136';
								  $lng = '46.6753';
								  
								  if(strlen($campaign->Location) > 0)
								  {
									  $location = explode(",", $campaign->Location);
									  $lat = $location[0];
									  $lng = $location[1];
								  }
							  ?>
								<div id="map"></div>
								<input type="hidden" id="latitude" name="latitude" value="<?=$lat?>">
							    <input type="hidden" id="longitude" name="longitude" value="<?=$lng?>">
							</td>
						</tr>
						<tr>
							<th></th>
							<td>
								<?PHP
									foreach($pictures as $pic)
									{
										?>
										
										<img src="<?=base_url($GLOBALS['img_camp_pics_dir'].$pic->Picture)?>" style="width: 200px; margin: 5px;">
										
										<?PHP
									}
								?>
							</td>
						</tr>
					</tbody>
				</table>
										
			</div>
		</div>
						
		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
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
          zoom: 8,
          mapTypeId: 'roadmap'
        });
		
		var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          draggable: false, 
		  animation: google.maps.Animation.DROP,
        });
        
      }
	
	  window.onload = initAutocomplete;
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC88G_-I2GZl8sVDs95qoxcuqBy9_q36nQ&libraries=places"
         async defer></script>
</body>
</html>