
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header">
        <h4 class="modal-title">Add Authenticaion</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-- form start -->
      <form role="form" id="menu_form" name="menu_form" method="post" onsubmit="return Submit_Authentication()">
        <input type="hidden" name="id" value="<?=@$id?>">
        <input type="hidden" name="slug" id="input_slug" value="<?=@$slug?>">
        <div class="card-body">
          <div class="form-group">
            <input type="text" class="form-control" name="authentication_name" onblur="Create_slug(this.value)" id="authentication_name" placeholder="Authenticaion Name" required value="<?=@$authentication_name?>">
            <sub>slug : <span id="display_slug" style="color: green"><?=@$slug?></span> </sub>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="authentication_type" id="authentication_type" placeholder="Type  - eg: Basic Authenticaion" required value="<?=@$authentication_type?>">
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
 CHECK_DB_FLAG = true ;


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


  function Submit_Authentication() 
  {
    var data = new FormData($('#menu_form')[0]);

    if($("#input_slug").val()=='')
    {
      $("#error_p").text("Please Check Slug !");
      return false ;
    }

    $("#error_p").text('');

    var object = {
        'url'  : "<?=base_url($this->controller_path.'save_authentication')?>",
        "data" : data,
        "type" : "post"
    } ;

    $response_object = JSONparse(AjaxUpdate(object));

    if($response_object.status=='1')
    {
      Show_Success($response_object.message);

      $(".close").click();

      setTimeout(function(){
        //location.reload();
      },2000);
    }
    else
    {
      Show_Error($response_object.message);
    }

    return false;
  }
</script>
