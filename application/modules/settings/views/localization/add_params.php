  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Localization</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Localization</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">

            <!-- Input addon -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Website Pages</h3>
              </div><br>
              <div class="margin" style="float: right">
                <button class="btn btn-sm btn-info" onclick="Add_Param()">Add Key</button>
              </div>
              <!-- onsubmit="return Submit_Lang_Params()" -->
              <form id="lang_params_form" name="lang_params_form" action="<?=base_url($this->controller_path)?>Add_Params" method="post">
                <div class="card-body" id="input_div">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">1</span>
                    </div>
                    <input type="text" class="form-control" required name="keys[]" placeholder="eg: product_details">
                    <input type="text" class="form-control" required name="english[]" placeholder="eg: Product Details">
                    <input type="text" class="form-control" required name="arabic[]" placeholder="eg: تفاصيل المنتج ">
                  </div>
                </div>
                <button type="submit" class="btn btn-m btn-info" style="float: right">Submit</button>
              </form>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script type="text/javascript">

//Restrict from repeating the Keys
var Added_Keys = {};

//For Serial Number
var param_number = 2 ;
  function Add_Param() {
    var input = "<div class='input-group mb-3'><div class='input-group-prepend'><span class='input-group-text'>"+param_number+"</span></div><input type='text' class='form-control' name='keys[]' placeholder='eg: product_details'><input type='text' class='form-control' name='english[]' placeholder='eg: Product Details'><input type='text' class='form-control' name='arabic[]' placeholder='eg: تفاصيل المنتج '></div>";

    $("#input_div").append(input);

    param_number = param_number + 1;
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