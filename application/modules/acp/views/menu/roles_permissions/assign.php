<link rel="stylesheet" type="text/css" href="<?=base_url('style/acp/css/custom_css/style.min.css')?>">


<style>
    body[dir="rtl"] textarea{
        direction: rtl;
    }
</style>
<div id="content-main">
    <div class="row">
        <?PHP
            $this->load->view('acp_includes/response_messages');
        ?>
        <div class="col-md-12">
            <h3><?=getSystemString('permission')?></h3>
        </div>
        <div class="col-md-12">
            <form action="<?=base_url($__controller.'/updatePermissions');?>" class="form-horizontal" method="post" data-parsley-validate> 
                <div class="panel white" style="padding-bottom: 50px;">
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor1"><?=getSystemString(505)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <div id="jstree"></div>
                            <input type="hidden" name="rolesPermissions" value="" id="jMenus">
                        </div>
                    </div>

                </div>
                    
                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="Save Details" name="submit" />
                    </div>
                </div>
            
            </form>
        
        </div>
    </div>
</div>

<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/jstree.min.js')?>"></script>
<script>
	$(function(){
		
		$("#jstree").jstree({
			'core' : {
		       'data' : {
		         "url" : "<?=base_url($__controller.'/getRolesAndMenus')?>",
		         "dataType" : "json"
		       }
		    },
			"plugins" : [ "checkbox", "wholerow"]
		});
		
		$('#jstree').on("changed.jstree", function (e, data) {
			//console.log(data);
			$("#jMenus").val(data.selected.join());
		});
		
	});
</script>
</body>
</html>