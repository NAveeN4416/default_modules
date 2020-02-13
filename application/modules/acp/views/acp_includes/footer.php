</div>
	<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/jquery.js')?>"></script>
	<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/framework.js')?>"></script>
	<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/jquery-cookie.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('style/site/js/tokenIntercepter.js?v=1')?>"></script>
	<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/jquery.slimscroll.min.js')?>"></script>
<!--<script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script> -->
	<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/ckeditor/ckeditor.js')?>"></script>
    <script src="<?=base_url($GLOBALS['acp_js_dir'].'/hurkanSwitch.js')?>"></script>
<script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js" integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo=" crossorigin="anonymous"></script>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/croppie.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('style/site/js/jquery-parsley.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/jquery.ays.js')?>"></script>
<script type="text/javascript">
	var __base_url = '<?=base_url()?>';
	var __acp_js_path = '<?=base_url($GLOBALS['acp_js_dir'])?>';
	var __acp_css_path = '<?=base_url($GLOBALS['acp_css_dir'])?>';
	var __confirmMessage = '<?=getSystemString(45)?>';
</script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/editors_config.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/acp_custom.js')?>"></script>

<script type="text/javascript" src="<?=base_url('style/site/js/utilities/crop_it_img.js"')?>"></script>

<script>
	$(function(){
		
		$('img').each(function(ind){
			// check for editor img
			if(!$(this).is('.cr-image'))
			{
				$(this).on("error", function () {
					console.log();
					this.src = '<?=base_url('style/acp/img/placeholder.png')?>';
				});
			}
		});
	});
</script>
        