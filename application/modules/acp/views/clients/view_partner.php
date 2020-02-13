	<style>
	.crop-image{
		width: 250px;
		height: 150px;
	}
	</style>
	<div id="content-main">
		<h1><?=getSystemString('Partner details')?></h1>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?=base_url('acp/dashboard')?>"><?=getSystemString(90)?></a></li>
		    <li class="breadcrumb-item"><a href="<?=base_url('acp/partners')?>"><?=getSystemString(179)?></a></li>
		    <li class="breadcrumb-item active" aria-current="page"><?=getSystemString('Partner details')?></li>
		  </ol>
		</nav>
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
			<div class="col-md-12">
			    <form action="#" class="form-horizontal">
	          		<div class="panel white" style="padding-bottom: 50px;">
				        <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title_en"><?=getSystemString(311)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<span><?=$partner->Company_name?></span>
							</div>
						</div>
				        <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title_en">Message</label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<span><?=$partner->Message?></span>
							</div>
						</div>
			        </div>  	
		     	</form>
			</div>
		</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>

</body>
</html>