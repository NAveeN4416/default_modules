
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
        <div class="container">

          <div class="row">

            <div class="col-12 col-sm-6 col-md-3 car_hover">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-globe"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">No Authentication</span>
                  <span class="info-box-number badge badge-success">Active</span>
                  <span class="info-box-number">Services - 10</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3 car_hover">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-secret"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Basic Authentication</span>
                  <span class="info-box-number badge badge-success">Active</span>
                  <span class="info-box-number">Services - 10</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3 car_hover">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-id-card"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Token Authentication</span>
                  <span class="info-box-number badge badge-danger">InActive</span>
                  <span class="info-box-number">Services - 10</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

        </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>



    <section>
      <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_service" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true"></div>
    </section>
    <!-- /.content -->
  </div>
