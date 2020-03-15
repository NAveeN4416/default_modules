
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Update <?=$device_name?> Configuration</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Update <?=$device_name?> Configuration</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12"><!--onsubmit="return Submit_Mobile_Config(this)"  -->
          <form id="submit_form" method="post" name="submit_form" action="<?=base_url($this->controller_path)?>Update_Configuration" enctype="multipart/form-data">
            <div class="card">
              <div class="card-body">
                <input type="hidden" name="id" value="<?=@$device_id?>">
                <div class="margin" style="float: right">
                  <button type="button" class="btn btn-sm btn-primary" onclick="Add_Input('Development')">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add input
                  </button>
                  <button type="button" class="btn btn-sm btn-primary" onclick="Add_File_Input('Development')">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add File
                  </button>
                </div>
                <h4>Development Configuration</h4>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Key</label>
                    <div id="dev_keys">
                      <input type="text" class="form-control" required placeholder="eg : Password" name="dev_keys[]">
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Values</label>
                    <div id="dev_values">
                      <input type="text" class="form-control" required placeholder="eg: *******" name="dev_values[]">
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <div class="card">
              <div class="card-body">
                <div class="margin" style="float: right">
                  <button type="button" class="btn btn-sm btn-primary" onclick="Add_Input('Production')">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add input
                  </button>
                  <button type="button" class="btn btn-sm btn-primary" onclick="Add_File_Input('Production')">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add File
                  </button>
                </div>
                <h4>Production Configuration</h4>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Key</label>
                    <div id="prod_keys">
                      <input type="text" class="form-control" required placeholder="eg : Password" name="prod_keys[]">
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Values</label>
                    <div id="prod_values">
                      <input type="text" class="form-control" required placeholder="eg: *******" name="prod_values[]">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputAddress">Description</label>
              <textarea name="description" id="api_description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-left: 93%">Upsert</button>
          </form>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>


<script type="text/javascript">
  function Append_HTML(flag,html_keys,html_values)
  {
    if(flag=='Development')
    {      
      $("#dev_keys").append(html_keys);
      $("#dev_values").append(html_values);
      return true;
    }

    $("#prod_keys").append(html_keys);
    $("#prod_values").append(html_values);
    return true;
  }


  function Add_Input(flag)
  {
    var Development_Keys = "<br><input type='text' class='form-control' placeholder='eg : Password' name='dev_keys[]'>";
    var Development_Values = "<br><input type='text' class='form-control' placeholder='eg : Password' name='dev_values[]'>";

    var Production_Keys = "<br><input type='text' class='form-control' placeholder='eg : Password' name='prod_keys[]'>";
    var Production_Values = "<br><input type='text' class='form-control' placeholder='eg : Password' name='prod_values[]'>";

    var html_keys = (flag=='Development') ? Development_Keys : Production_Keys ;
    var html_values = (flag=='Development') ? Development_Values : Production_Values ;

    Append_HTML(flag,html_keys,html_values);
  }


  function Add_File_Input(flag)
  {
    var Development_Keys = "<br><input type='text' class='form-control' placeholder='eg: PEM' name='dev_file_keys[]'>";
    var Development_Values = "<br><input type='file' class='form-control' name='dev_files[]'>";

    var Production_Keys = "<br><input type='text' class='form-control' placeholder='eg: PEM' name='prod_file_keys[]'>";
    var Production_Values = "<br><input type='file' class='form-control' name='prod_files[]'>";

    var html_keys = (flag=='Development') ? Development_Keys : Production_Keys ;
    var html_values = (flag=='Development') ? Development_Values : Production_Values ;

    Append_HTML(flag,html_keys,html_values);
  }

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