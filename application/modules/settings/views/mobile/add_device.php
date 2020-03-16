
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header">
        <h4 class="modal-title">Add Device</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                      <!-- form start -->
      <form role="form" id="submit_form" name="submit_form" onsubmit="Submit_Device()" action="#" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?=@$id?>">
        <div class="card-body">
          <div class="form-group">
            <input type="text" onkeyup="Create_slug(this.value)" value="<?=@$name?>" class="form-control" name="name" id="name" placeholder="Device Name" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" value="<?=@$icon_class?>" name="icon_class" id="icon-class" placeholder="Icon  eg:fa fa-tv" required>
            <sub>displays icon like this <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></sub>
          </div>
          <div class="form-group">
            <select class="custom-select" required name="status">
              <option value="">--Select Status--</option>
              <option value="Active" <?=(@$status=='Active')?'selected':''?>>Active</option>
              <option value="InActive" <?=(@$status=='InActive')?'selected':''?>>InActive</option>
            </select>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" value="" id="exampleCheck1" name="order_in_list">
            <label class="form-check-label" for="exampleCheck1">Display on Top</label>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" style="float: right"> Save Data</button>
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
  function Submit_Device() 
  {
    var data = new FormData($('#submit_form')[0]);

    if($("#input_slug").val()=='')
    {
      $("#error_p").text("Please Check Slug !");
      return false ;
    }

    $("#error_p").text('');

    var object = {
        'url'  : "<?=base_url('settings/mobile/save_device')?>",
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