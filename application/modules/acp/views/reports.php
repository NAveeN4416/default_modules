<style>
	.panel.white{
		min-height: 230px;
	}
	.bar-chart {
		width	: 100%;
		height	: 500px;
	}
	.amcharts-chart-div a:last-child, .amcharts-chart-div svg+a{
		display: none !important;
	}
	.line-chart{
		width	: 100%;
		height	: 500px;
	}
</style>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<div id="content-main">
	<div class="content">

			<div class="row" style="width: 100%">
				<div class="col-md-12">
					
					<div class="col-md-3">
						<div class="dash-stat light-shadow orange rounded">
							<span class="dash-stat-icon"><i class="fa fa-shopping-cart"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main"><?=$total_sales?></span>
								<span class="dash-stat-sub"><?=getSystemString('Total_Sale')?></span>
							</div>
						</div>
					</div>
					
<!--
					<div class="col-md-3">
						<div class="dash-stat light-shadow green rounded">
							<span class="dash-stat-icon"><i class="fa fa-shopping-bag"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main"><?=$reports['deliveredOrders']?></span>
								<span class="dash-stat-sub"><?=getSystemString(378)?></span>
							</div>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="dash-stat light-shadow blue rounded">
							<span class="dash-stat-icon"><i class="fa fa-money"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main"><?=$reports['storeWorth'][0]->StoreWorth.' SAR'?></span>
								<span class="dash-stat-sub"><?=getSystemString(379)?></span>
							</div>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="dash-stat light-shadow red rounded">
							<span class="dash-stat-icon"><i class="fa fa-usd"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main"><?=$reports['totalSales'][0]->TotalSales.' SAR'?></span>
								<span class="dash-stat-sub"><?=getSystemString(380)?></span>
							</div>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="dash-stat light-shadow green rounded">
							<span class="dash-stat-icon"><i class="fa fa-money"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main"><?=$reports['totalIncome'][0]->TotalIncome?></span>
								<span class="dash-stat-sub"><?=getSystemString(381)?></span>
							</div>
						</div>
					</div>
-->
					
				</div>
				
				<div class="col-xs-12 no-padding">
					
					<div class="col-xs-12">
						<div class="panel light-shadow white title-transparent rounded" data-title="<?=getSystemString(178)?>" data-toggle="true" data-expand="true">
							<form class="form-inline" action="<?php echo base_url('acp/reports'); ?>" method="post">
							  <div class="form-group">
							    <label for="inputPassword6"><?=getSystemString(421)?></label>
							    <input type="date" id="inputPassword6" required name="from_date"  class="form-control mx-sm-3" aria-describedby="passwordHelpInline" value="<?=@$_SESSION['from_date']?>">
							    <label for="inputPassword7"><?=getSystemString(422)?></label>
							    <input type="date" id="inputPassword7" required name="to_date"  class="form-control mx-sm-3" aria-describedby="passwordHelpInline" value="<?=@$_SESSION['to_date']?>">
							    <button class="btn btn-info"><?=getSystemString(106)?></button>
							  </div><br></br>
							</form>
							<div id="totalIncome" class="line-chart"></div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6">
						<div class="panel light-shadow white title-transparent rounded" data-title="<?=getSystemString('Most_Reserved_Campaigns')?>" data-toggle="true" data-expand="true">
							<div id="mostOrdered" class="bar-chart"></div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-6">
						<div class="panel light-shadow white title-transparent rounded" data-title="<?=getSystemString('Companies-Trip')?>" data-toggle="true" data-expand="true">
							<div id="mostViewed" class="bar-chart"></div>
						</div>
					</div>
					
				</div>				
				
				
											
			</div>

	</div>
</div>
		
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>																				
<script>
	$(function(){
		var _controller = '<?=$__controller?>';
		
		$.get(_controller+'/getStoreTotalIncome', function(result){
			console.log(result);
			var chart = AmCharts.makeChart("totalIncome", {
			    "type": "serial",
			    "theme": "light",
			    "marginRight": 40,
			    "marginLeft": 40,
			    "autoMarginOffset": 20,
			    "mouseWheelZoomEnabled":true,
			    "dataDateFormat": "YYYY-MM-DD",
			    "valueAxes": [{
			        "id": "v1",
			        "axisAlpha": 0,
			        "position": "left",
			        "ignoreAxisWidth":true
			    }],
			    "balloon": {
			        "borderThickness": 1,
			        "shadowAlpha": 0
			    },
			    "graphs": [{
			        "id": "g1",
			        "balloon":{
			          "drop":true,
			          "adjustBorderColor":false,
			          "color":"#ffffff"
			        },
			        "bullet": "round",
			        "bulletBorderAlpha": 1,
			        "bulletColor": "#FFFFFF",
			        "bulletSize": 5,
			        "hideBulletsCount": 50,
			        "lineThickness": 2,
			        "title": "red line",
			        "useLineColorForBulletBorder": true,
			        "valueField": "value",
			        "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
			    }],
			    "chartScrollbar": {
			        "graph": "g1",
			        "oppositeAxis":false,
			        "offset":30,
			        "scrollbarHeight": 80,
			        "backgroundAlpha": 0,
			        "selectedBackgroundAlpha": 0.1,
			        "selectedBackgroundColor": "#888888",
			        "graphFillAlpha": 0,
			        "graphLineAlpha": 0.5,
			        "selectedGraphFillAlpha": 0,
			        "selectedGraphLineAlpha": 1,
			        "autoGridCount":true,
			        "color":"#AAAAAA"
			    },
			    "chartCursor": {
			        "pan": true,
			        "valueLineEnabled": true,
			        "valueLineBalloonEnabled": true,
			        "cursorAlpha":1,
			        "cursorColor":"#258cbb",
			        "limitToGraph":"g1",
			        "valueLineAlpha":0.2,
			        "valueZoomable":true
			    },
			    "valueScrollbar":{
			      "oppositeAxis":false,
			      "offset":50,
			      "scrollbarHeight":10
			    },
			    "categoryField": "date",
			    "categoryAxis": {
			        "parseDates": true,
			        "dashLength": 1,
			        "minorGridEnabled": true
			    },
			    "export": {
			        "enabled": true
			    },
			    "dataProvider": JSON.parse(result)
			});
	
			chart.addListener("rendered", zoomChart);
	
			zoomChart();
			
		    function zoomChart() {
		   	 	chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
			}
		});
		
		$.get(_controller+'/getMostOrderedProducts', function(result){
			var chart = AmCharts.makeChart( "mostOrdered", {
			  "type": "serial",
			  "theme": "light",
			  "dataProvider": JSON.parse(result),
			  "gridAboveGraphs": true,
			  "startDuration": 1,
			  "graphs": [ {
			    "balloonText": "[[category]]: <b>[[value]]</b>",
			    "fillAlphas": 0.8,
			    "lineAlpha": 0.2,
			    "type": "column",
			    "valueField": "reservations"
			  } ],
			  "chartCursor": {
			    "categoryBalloonEnabled": false,
			    "cursorAlpha": 0,
			    "zoomable": false
			  },
			  "categoryField": "ProductTitle",
			  "categoryAxis": {
			     "gridPosition": "start",
			     "labelRotation": 45
	  		  },
			  "export": {
			    "enabled": true
			  }
			
			});
		});
		
		$.get(_controller+'/getHighTripCompanies', function(result){
			var chart = AmCharts.makeChart( "mostViewed", {
			  "type": "serial",
			  "theme": "light",
			  "dataProvider": JSON.parse(result),
			  "gridAboveGraphs": true,
			  "startDuration": 1,
			  "graphs": [ {
			    "balloonText": "[[category]]: <b>[[value]]</b>",
			    "fillAlphas": 0.8,
			    "lineAlpha": 0.2,
			    "type": "column",
			    "valueField": "trips"
			  } ],
			  "chartCursor": {
			    "categoryBalloonEnabled": false,
			    "cursorAlpha": 0,
			    "zoomable": false
			  },
			  "categoryField": "Company",
			  "categoryAxis": {
			     "gridPosition": "start",
			     "labelRotation": 45
	  		  },
			  "export": {
			    "enabled": true
			  }
			
			});
		});
		
	});
</script>
</body>
</html>