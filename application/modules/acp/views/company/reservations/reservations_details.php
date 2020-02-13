	<style>
		.panel.white{
			min-height: 150px;
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
		.img-thumbs img{
			width: 150px;
		}
		.img-sm-thumbs img{
			width: 50px;
		}
		.filter-no-borders{
			background-color: #FFF;
		}
		.filter-no-borders .panel{
			border: 0px solid transparent;
		}
	</style>

	<div id="content-main">
		
		<div class="row">
			<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
		</div>
		
		<div class="row">
						
			<div class="col-md-12">
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
								<th><?=getSystemString(158)?></th>
								<td>
									<?=getSystemString($campaign->Campaign_Type)?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(144)?></th>
								<td>
									<?=$campaign->Campaign_Features?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(164)?></th>
								<td><?=$campaign->Address?></td>
							</tr>
							<tr>
								<th><?=getSystemString(138)?></th>
								<td>
									<?PHP 
										echo $campaign->From_Date.' - '.$campaign->To_Date;
									?>
								</td>
							</tr>
							
							<tr>
								<th><?=getSystemString(167)?></th>
								<td><?=$campaign->Amount_Person?></td>
							</tr>
							<tr>
								<th><?=getSystemString(382)?></th>
								<td><?=$reservation->Amount_Paid/$campaign->Amount_Person?></td>
							</tr>
							<tr>
								<th><?=getSystemString(491)?></th>
								<td class="text-success"><?=$reservation->Amount_Paid.' '.getSystemString(480)?></td>
							</tr>
							<tr>
								<th><?=getSystemString(491)?></th>
								<td><?=$reservation->Payment_Reference?></td>
							</tr>
<!--
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
-->
						</tbody>
					</table>
											
				</div>
			</div>
			
			<div class="col-xs-12">
				<ul class="nav nav-tabs">
				   
				    <li class="active"><a data-toggle="tab" href="#family"><i class="fa fa-user"></i> <?=getSystemString(408)?></a></li>
				</ul>
				
				<div class="tab-content" style="padding-top: 0px !important">
					<div class="tab-pane fade in active" id="family">
						<div class="panel white">
							<?PHP
								$this->load->view('company/reservations/snippets/members_list');
							?>
						</div>
					</div>
					
				</div>
				
			</div>
						
		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
</body>
</html>