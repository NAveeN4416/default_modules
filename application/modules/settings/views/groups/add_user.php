
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                      <!-- form start -->
      <form role="form" id="user_form" name="user_form" action="#" enctype="multipart/form-data" method="post" onsubmit="return Submit_User()">
        <input type="hidden" name="user[id]" value="<?=@$id?>">
        <input type="hidden" name="group_id" value="<?=@$group_id?>">
        <div class="card-body">
          <div class="form-group">
            <input type="text" class="form-control" name="user[username]" id="username" placeholder="User Name" required value="<?=@$username?>">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="user[email]" id="email" placeholder="Email" required value="<?=@$email?>">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="user[password]" id="password" placeholder="Password" required value="<?=@$phone?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="user[phone]" id="phone" placeholder="Mobile" required value="<?=@$phone?>">
          </div>
          <div class="form-group">
            <select class="custom-select" required name="user[is_active]">
              <option value="">--Select Status--</option>
              <option value="1" <?=(@$is_active==1)?'selected':''?>>Active</option>
              <option value="0" <?=(@$is_active==0)?'selected':''?>>InActive</option>
            </select>
          </div>
        </div>
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
  function Submit_User() 
  {
    var data = new FormData($('#user_form')[0]);

    var object = {
        'url'  : "<?=base_url($this->controller_path)?>save_user",
        "data" : data,
        "type" : "post"
    } ;


    $response_object = JSONparse(AjaxUpdate(object));

    return false;

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
