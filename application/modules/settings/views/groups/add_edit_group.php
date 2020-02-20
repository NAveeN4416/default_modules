
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header">
        <h4 class="modal-title">Add Group</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                      <!-- form start -->
      <form role="form" id="group_form" name="group_form" action="<?=base_url('settings/user_groups/save_group')?>" enctype="multipart/form-data" method="post" onsubmit="return Submit_Group()">
        <input type="hidden" name="id" value="<?=@$id?>">
        <div class="card-body">
          <div class="form-group">
            <input type="text" class="form-control" name="group_name" id="name" placeholder="Group Name" required value="<?=@$group_name?>">
          </div>
          <div class="form-group">
            <select class="custom-select" required name="status">
              <option value="">--Select Status--</option>
              <option value="1" <?=(@$status==1)?'selected':''?>>Active</option>
              <option value="2" <?=(@$status==0)?'selected':''?>>InActive</option>
            </select>
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
  function Submit_Group() 
  {
    var data = new FormData($('#group_form')[0]);

    var object = {
        'url'  : "<?=base_url('settings/user_groups/save_group')?>",
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
