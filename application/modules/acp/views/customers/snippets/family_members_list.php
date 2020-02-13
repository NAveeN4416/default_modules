<div class="col-xs-12 filter-no-borders">
	<div class="panel white">
		<table class="table table-hover">
			<thead>
				<tr>
					<th><?=getSystemString(81)?></th>
					<th><?=getSystemString(137)?></th>
					<th><?=getSystemString(200)?></th>
					<th><?=getSystemString(210)?></th>
					<th><?=getSystemString(420)?></th>
					<th><?=getSystemString(416)?></th>
					<th><?=getSystemString(440)?></th>
				</tr>
			</thead>
			<tbody>
				<?PHP
					foreach($family_members as $member)
					{
						?>
						
						<tr>
							<td><?=$member->Name?></td>
							<td><?=$member->Phone?></td>
							<td><?=getSystemString($member->Gender)?></td>
							<td><?=$member->DOB?></td>
							<td><?=$member->Family_Relation?></td>
							<td><?=$member->Passport_No?></td>
							<td class="img-sm-thumbs">
								<?PHP
									$base_dir = base_url($GLOBALS['img_customers_dir']);
								?>
								<a href="<?=$base_dir.$member->NIC_Picture?>" target="_blank">
									<img src="<?=$base_dir.$member->NIC_Picture?>">
								</a>
								<a href="<?=$base_dir.$member->Passport_Picture?>" target="_blank">
									<img src="<?=$base_dir.$member->Passport_Picture?>">
								</a>
								<a href="<?=$base_dir.$member->Health_Certificate?>" target="_blank">
									<img src="<?=$base_dir.$member->Health_Certificate?>">
								</a>
							</td>
						</tr>
						
						<?PHP
					}
				?>
			</tbody>
		</table>
	</div>
</div>