
<style type="text/css">
.car_hover:hover {
  box-shadow: 0 0 11px rgba(33,33,33,.2); 
}
.car_hover {
  transition: box-shadow .3s;
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mobile Authentications</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Admin</a></li>
              <li class="breadcrumb-item active">Mobile Authentications</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <button type="button" class="btn btn-primary add_authentication" >
           + Add Authentication
          </button>
        </div><br>
        <div class="row">

          <div class="col-md-12">
            <!-- Input addon -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Authentications List</h3>
              </div>
              <div class="card-body">
                <?php foreach ($list as $key => $record) { ?>
                  <div class="col-12 col-md-3 car_hover">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="<?=$record['icon']?>"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text"><?=$record['authentication_name']?></span>
                        <span class="info-box-number badge badge-success"><?=$record['status']?></span>
                        <span class="info-box-number">Services - <?=count($record['mobile_apis'])?></span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                <?php } ?>                
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    

    <section>
      <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_authentication" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true">
      </div>
    </section>
    <!-- /.content -->
  </div>


<script type="text/javascript"> 
  function Check_Slug_InDB(slug)
  {
    var data = new FormData();
    data.append('slug',slug);
    data.append('table','<?=MOBILE_AUTHENTICATIONS?>');

    var object = {
        'url'  : "<?=base_url('settings/base/Check_Slug_InDB')?>" ,
        "data" : data,
        "type" : "post"
    } ;

    $response_object = JSON.parse(AjaxUpdate(object));
    //console.log($response_object);
    if($response_object.status==0)
    {
      $("#error_p").text("Record with this name already exist !");
      $("#input_slug").val('');
      $("#display_slug").text('');
    }
    else
    {
      $("#error_p").text("");
    }

  }
</script>