<link href="<?=base_url('style/acp/css/select2.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('style/acp/css/select2-bootstrap.min.css')?>" rel="stylesheet" />
<style>
    .panel.white{
        min-height: 100px;
    }
    .crop-image{
        width: 200px;
        height: 200px;
    }
    #map{
        width: 100%;
        height: 350px;
    }
    
    #map .form-control{
        width: 50% !important;
        top: 8px !important;
    }
</style>
<div id="content-main">
    
        <div class="row">
            
            <?PHP
                $this->load->view('acp_includes/response_messages');
            ?>

            <div class="col-md-12">
                <h3>Modify Menu</h3>
                <form action="<?=base_url($__controller.'/edit_POST/'.$menu_id);?>" class="form-horizontal" method="post" data-parsley-validate>	
                    <div class="panel white" style="padding-bottom: 50px;">

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="title">Parent Menu</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                <select name="parentMenu" class="form-control select2">
                                    <option value="0">-- Select Parent Menu --</option>
                                    <?PHP
                                    foreach($menus as $m):
                                    ?>
                                        <option value="<?=$m->Id?>" <?PHP if($menu->Parent_ID == $m->Id){ echo 'selected'; } ?>><?=getSystemString($m->Menu_String_Key)?></option>
                                    <?PHP
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
						
						<div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="title">Menu Name</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                <input type="text" 
                                        class="form-control" 
                                        name="menuName" 
                                        placeholder="e.g: Dashboard"
										value="<?=$menu->Menu_Key?>"
                                        required
                                        data-parsley-required-message="<?=getSystemString(213)?>">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="title">Menu Localization Key</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                <input type="text" 
                                        class="form-control" 
                                        name="localizationKey" 
                                        placeholder="132 or e.g: dashboard"
                                        value="<?=$menu->Menu_String_Key?>">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="title">Menu Link</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                <input type="text" 
                                        class="form-control" 
                                        name="link"
                                        value="<?=$menu->Link?>"
                                        placeholder="acp/dashboard"
                                        value="<?=$menu->Link?>">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="title">Menu Icon</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                <input type="text" 
                                        class="form-control" 
                                        name="icon"
                                        value="<?=$menu->Icon?>"
                                        placeholder="techometer">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="title">JS Function</label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                <input type="text" 
                                        class="form-control" 
                                        name="jsFunction"
                                        value="<?=$menu->JS_Function?>"
                                        placeholder="clickFunction()">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="title"></label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-6">
                                <label class="checkbox">
                                    <input type="checkbox" 
                                                name="isSidebarMenu"
                                                varlue="1" style="font-size: 16px" <?PHP if($menu->Is_SideBar_Menu){ echo 'checked'; } ?>> Is Sidebar Menu ?
                                </label>
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12 text-right">
                            <input type="submit" class="btn btn-primary" value="Modify Menu" name="submit"/>
                        </div>
                    </div>

                </form>
                
            </div>
            
        </div>
</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url('style/acp/js/select2.min.js')?>"></script>
<script>
	$(function(){
		$('.select2').select2({
			theme: 'bootstrap',
			placeholder: '<?=getSystemString(426)?>'
		});
	});
</script>
</body>
</html>