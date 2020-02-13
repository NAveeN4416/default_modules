<div class="col-xs-12 filter-no-borders">
    <?PHP
		$this->load->view('reservations/snippets/filter_reservations');
	?>
	
	<div class="panel white">
		<table class="table table-hover" id="reservations_table" style="margin-bottom: 5em">
		      <thead>
		        <tr>
		          <th>
		            R.No
		          </th>
		          <th>
		            <?=getSystemString(177)?>
		          </th>
			      <th>
			        <?=getSystemString(311)?>
			      </th>
		          <th>
		            <?=getSystemString(17)?>
		          </th>
		          <th>
		            <?=getSystemString(158)?>
		          </th>
		          <th>
		            <?=getSystemString(202)?>
		          </th>
		          <th>
		            <?=getSystemString(431)?>
		          </th>
<!--
		          <th>
		            <?=getSystemString(431).' - '.getSystemString(139)?>
		          </th>
-->
		          <th>
		            <?=getSystemString(432)?>
		          </th>
		          <th>
		            <?=getSystemString(42)?>
		          </th>
		          
		        </tr>
		      </thead>
		      <tbody></tbody>
		</table>
	</div>
</div>