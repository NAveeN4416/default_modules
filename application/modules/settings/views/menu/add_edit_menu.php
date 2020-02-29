
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header">
        <h4 class="modal-title">Add Menu</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-- form start -->
      <form role="form" id="menu_form" name="menu_form" method="post" onsubmit="return Submit_Menu()">
        <input type="hidden" name="id" value="<?=@$id?>">
        <input type="hidden" name="slug" id="input_slug" value="<?=@$slug?>">
        <div class="card-body">
          <div class="form-group">
            <input type="text" class="form-control" name="name" onblur="Create_slug(this.value)" id="name" placeholder="Menu Name" required value="<?=@$name?>">
            <sub>slug : <span id="display_slug" style="color: green"><?=@$slug?></span> </sub>
          </div>
          <div class="form-group">
            <select class="custom-select" required name="is_parent" required onchange="Show_hidden_form(this.value)">
              <option value="">-- is Parent ? </option>
              <option value="1" <?=(@$is_parent==1)?'selected':''?>>is parent ? - Yes</option>
              <option value="0" <?=(@$is_parent==0)?'selected':''?>>is parent ? - No</option>
            </select>
          </div>
          <div class="form-group" id="parents_div">
            <select class="custom-select" name="parent_id" id="parent_id" required>
              <option value="0">-- Choose Parent (Optional) --</option>
              <?php foreach ($parents as $key => $parent) { ?>
                <option value="<?=$parent['id']?>" <?=(@$parent_id==$parent['id'])? 'selected' : '' ?>>Parent - <?=$parent['name']?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="link" id="link" placeholder="Link" required value="<?=@$link?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="lang_key" id="lang_key" placeholder="Lang Key" required value="<?=@$lang_key?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon Class" required value="<?=@$icon?>">
          </div>
          <div class="form-group">
            <select class="custom-select" required name="status">
              <option value="1" <?=(@$status==1)?'selected':''?>>Active</option>
              <option value="2" <?=(@$status==0)?'selected':''?>>InActive</option>
            </select>
          </div>
        </div>
        <p class="text-danger text-center" id="error_p"></p>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
        </div>
      </form>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
    <!-- /.modal-content -->
  </div>


<script type="text/javascript">
  function Show_hidden_form(value)
  {
    if(value==1)
    {
      $("#parents_div").hide();
      $("#parent_id").val(0);
      return ;
    }

     $("#parents_div").show();
  }


  function Submit_Menu() 
  {
    var data = new FormData($('#menu_form')[0]);

    if($("#input_slug").val()=='')
    {
      $("#error_p").text("Please Check Slug !");
      return false ;
    }

    $("#error_p").text('');

    var object = {
        'url'  : "<?=base_url('settings/menu/save_menu')?>",
        "data" : data,
        "type" : "post"
    } ;

    $response_object = JSONparse(AjaxUpdate(object));

    if($response_object.status=='1')
    {
      Show_Success($response_object.message);

      $(".close").click();

      setTimeout(function(){
        location.reload();
      },2000);
    }
    else
    {
      Show_Error($response_object.message);
    }

    return false;
  }
</script>
