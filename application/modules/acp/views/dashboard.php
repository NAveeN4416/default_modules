<style>
	.panel.white{
		min-height: 230px;
	}
</style>
<div id="content-main">
		<div class="content">

				<div class="row" style="width: 100%">
					<div class="col-md-12">
						
						<div class="col-md-3">
							<a href="<?=base_url('acp_company/companies_list')?>">
							<div class="dash-stat light-shadow green rounded">
									<span class="dash-stat-icon"><i class="fa fa-building-o"></i></span>
									<div class="dash-stat-cont">
										<span class="dash-stat-main"><?=$total['TotalCompanies']?></span>
										<span class="dash-stat-sub"><?=getSystemString(327)?></span>
									</div>
							</div>
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="<?=base_url('acp_company/campaigns_list')?>">
							<div class="dash-stat light-shadow red rounded">
									<span class="dash-stat-icon"><i class="fa fa-bullhorn"></i></span>
									<div class="dash-stat-cont">
										<span class="dash-stat-main"><?=$total['TotalCampaigns']?></span>
										<span class="dash-stat-sub"><?=getSystemString(52)?></span>
									</div>
							</div>
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="<?=base_url('reservations/reservations_list')?>">
							<div class="dash-stat light-shadow blue rounded">
									<span class="dash-stat-icon"><i class="fa fa-calendar-check-o"></i></span>
									<div class="dash-stat-cont">
										<span class="dash-stat-main"><?=$total['TotalReservations']?></span>
										<span class="dash-stat-sub"><?=getSystemString(178)?></span>
									</div>
							</div>
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="<?=base_url('acp/customers_list')?>">
							<div class="dash-stat light-shadow orange rounded">
									<span class="dash-stat-icon"><i class="fa fa-users"></i></span>
									<div class="dash-stat-cont">
										<span class="dash-stat-main"><?=$total['TotalCustomers']?></span>
										<span class="dash-stat-sub"><?=getSystemString(492)?></span>
									</div>
							</div>
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="<?=base_url('news/manageNews')?>">
							<div class="dash-stat light-shadow yellow rounded">
									<span class="dash-stat-icon"><i class="fa fa-newspaper-o"></i></span>
									<div class="dash-stat-cont">
										<span class="dash-stat-main"><?=$total['TotalNews']?></span>
										<span class="dash-stat-sub"><?=getSystemString('total_news')?></span>
									</div>
							</div>
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="<?=base_url('acp/partners')?>">
							<div class="dash-stat light-shadow white rounded">
									<span class="dash-stat-icon"><i class="fa fa-camera"></i></span>
									<div class="dash-stat-cont">
										<span class="dash-stat-main"><?=$total['TotalClients']?></span>
										<span class="dash-stat-sub"><?=getSystemString('total_partners')?></span>
									</div>
							</div>
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="<?=base_url('acp/tickets/enquiries/users')?>">
							<div class="dash-stat light-shadow orange rounded">
									<span class="dash-stat-icon"><i class="fa fa-ticket"></i></span>
									<div class="dash-stat-cont">
										<span class="dash-stat-main"><?=$total['TotalUserTicket']?></span>
										<span class="dash-stat-sub"><?=getSystemString('total_tickets')?></span>
									</div>
							</div>
							</a>
						</div>
						
						<div class="col-md-3">
							<a href="<?=base_url('acp/tickets/enquiries/companies')?>">
							<div class="dash-stat light-shadow purple rounded">
									<span class="dash-stat-icon"><i class="fa fa-ticket"></i></span>
									<div class="dash-stat-cont">
										<span class="dash-stat-main"><?=$total['TotalCompTicket']?></span>
										<span class="dash-stat-sub"><?=getSystemString('total_company_tickets')?></span>
									</div>
							</div>
							</a>
						</div>
						
					</div>					
					
						<div class="col-xs-12">
							<div class="panel light-shadow white title-transparent rounded" data-title="<?=getSystemString(115)?>" data-toggle="true" data-expand="true">
								<div id="widgetIframe"><iframe width="100%" height="350" src="" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" id="visitsOverview"></iframe></div>
							</div>
					</div>						
						
						<div class="col-md-4">
							<div class="panel light-shadow white title-transparent rounded" data-title="<?=getSystemString(116)?>" data-toggle="true" data-expand="true">
								<div id="widgetIframe"><iframe width="100%" height="350" id="reportsForVisitors" src="" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
								
							</div>
						</div>

						<div class="col-md-4">
							<div class="panel light-shadow white title-transparent rounded" data-title="<?=getSystemString(117)?>" data-toggle="true" data-expand="true">
								<iframe style="width:100%; height:350px;border:0px" src="" id="geographicalLocation"></iframe>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="panel light-shadow white title-transparent rounded" data-title="<?=getSystemString(118)?>" data-toggle="true" data-expand="true">
								<iframe style="width:100%; height:350px;border:0px" src="" id="visitsByBrowser"></iframe>
							</div>
						</div>
												
					</div>

			</div>
		</div>
		
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	
	$(window).on('load',function(){
		$("#visitsOverview").attr("src", "https://analytics.dnet.sa/index.php?module=Widgetize&action=iframe&columns[0]=nb_visits&columns[1]=nb_uniq_visitors&widget=1&moduleToWidgetize=VisitsSummary&actionToWidgetize=getEvolutionGraph&idSite=50&period=day&date=yesterday&disableLink=1&widget=1&token_auth=c9fc857b5b6ee92279ac5f5695d51cf6");
		
		$("#reportsForVisitors").attr("src", "https://analytics.dnet.sa/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=VisitsSummary&actionToWidgetize=getSparklines&idSite=50&period=day&date=yesterday&disableLink=1&widget=1&token_auth=c9fc857b5b6ee92279ac5f5695d51cf6");
		
		$("#geographicalLocation").attr("src","https://analytics.dnet.sa/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=UserCountryMap&actionToWidgetize=visitorMap&idSite=50&period=day&date=yesterday&disableLink=1&widget=1&token_auth=c9fc857b5b6ee92279ac5f5695d51cf6");
		
		$("#visitsByBrowser").attr("src", "https://analytics.dnet.sa/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=DevicesDetection&actionToWidgetize=getBrowserEngines&idSite=50&period=day&date=yesterday&disableLink=1&widget=1&token_auth=c9fc857b5b6ee92279ac5f5695d51cf6");
	});

</script>
</body>
</html>