<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mobile Services</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Mobile Services</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
<br>
    <div class="container-fluid">
      <div class="row">
        <a type="button" class="btn btn-primary" href="<?=base_url($this->controller_path)?>/add_edit_service"> + Add Service
        </a>
      </div><br>
      <div class="row">
        <div class="accordion" id="accordionExample">
        <?php foreach ($services_list as $key => $service) { ?>  
          <div class="card">
            <div class="card-header" id="headingOne" style="background-color: #d6d8d9">
              <h5 class="mb-0">
                <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne<?=$key?>" aria-expanded="true" aria-controls="collapseOne">
                <?=$key+1?>. <?=$service['api_name']?>  </button>
                </button>
                <a href="#collapseOne<?=$key?>"><i class="fas fa-anchor"></i></a>
              </h5>
            </div>
            <div id="collapseOne<?=$key?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <p>Method Name : <span class="badge badge-secondary"><?=$service['api_method']?></span></p>
                <p>Http Method : <span class="badge badge-warning"><?=strtoupper($service['http_method'])?></span></p>
                <?php $class = ($service['status']=="InActive") ? 'badge-danger' : 'badge-success' ; ?>
                <p>Status :  <span class="badge <?=$class?>"><?=$service['status']?></span></p>
                <p>Description : <?=$service['api_description']?></p>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <section>
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_service" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true"></div>
  </section>
</div>
