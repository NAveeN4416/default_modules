
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add/Edit Services</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add/Edit Services</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form id="submit_form" method="post" name="submit_form" onsubmit="return Submit_Service(this)">
                <input type="hidden" name="id" value="<?=@$id?>">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Service Name</label>
                    <input type="text" class="form-control" required placeholder="eg: Get Products list" name="api_name" value="<?=@$api_name?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">API Method Name</label>
                    <input type="text" class="form-control" required placeholder="eg: Get_Products" name="api_method" value="<?=@$api_method?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">Http Method</label>
                    <select id="inputState" class="form-control" name="http_method" required>
                      <option value="">--Select--</option>
                      <option value="get" <?php echo (@$http_method=='get') ? 'selected' : '' ;?>>GET</option>
                      <option value="post" <?php echo (@$http_method=='post') ? 'selected' : '' ;?>>POST</option>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Default Authentication</label>
                    <select class="form-control"  name="default_authentication">
                      <option value="">--Select--</option>
                      <option value="YES" <?php echo (@$default_authentication=='YES') ? 'selected' : '' ;?>>Required</option>
                      <option value="NO" <?php echo (@$default_authentication=='NO') ? 'selected' : '';?>>Not Required</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Check Permissions</label>
                    <select class="form-control" name="check_permissions">
                      <option value="">--Select--</option>
                      <option value="YES" <?php echo (@$check_permissions=='YES') ? 'selected' : '' ;?>>Yes</option>
                      <option value="NO" <?php echo (@$check_permissions=='NO') ? 'selected' : '' ;?>>NO</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="" selected>--Select--</option>
                      <option value="Active" <?php echo (@$status=='Active') ? 'selected' : '' ;?>>Active</option>
                      <option value="InActive" <?php echo (@$status=='InActive') ? 'selected' : '' ;?>>InActive</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputState">Authentication Type</label>
                  <select id="inputState" class="form-control" name="authentication_type" required>
                    <option value="">--Select--</option>
                    <?php foreach ($authentications as $key => $authentication) { ?>
                      <option value="<?=$authentication['id']?>" <?php echo (@$authentication['id']==@$authentication_type) ? 'selected' : '' ;?>><?=$authentication['authentication_name']?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Service Description</label>
                  <textarea name="api_description" id="api_description" class="form-control"><?=@$api_description?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-left: 93%">Upsert</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>


<script type="text/javascript">
  function Submit_Service() 
  {
    var data = new FormData($('#submit_form')[0]);

    var api_description =  CKEDITOR.instances['api_description'].getData();

    data.append('api_description',api_description);

    if($("#input_slug").val()=='')
    {
      $("#error_p").text("Please Check Slug !");
      return false ;
    }

    $("#error_p").text('');

    var object = {
        'url'  : "<?=base_url($this->controller_path)?>save_service",
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