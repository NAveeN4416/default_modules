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
    <div cass="row">
      <a type="button" class="btn btn-primary" href="<?=base_url($this->controller_path)?>/add_edit_service"> + Add Service
      </a>
    </div><br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- Input addon -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Services List</h3>
            </div>
            <div class="card-body">
              <div class="accordion" id="accordionExample">
                <?php foreach ($services_list as $key => $service) { ?> 
                <?php $class = ($service['status']=="InActive") ? 'badge-danger' : 'badge-success' ; ?> 
                <?php $class_http = ($service['http_method']=="get") ? 'badge-warning' : 'badge-info' ; ?> 
                <?php $status_check = ($service['status']=="Active") ? 'checked' : '' ; ?> 
                  <div class="card" id="card<?=$key+1?>">
                    <div class="card-header" id="headingOne" style="background-color: #d6d8d9">
                      <h5 class="mb-0">
                        <a href="<?=base_url($this->controller_path)?>/add_edit_service/<?=$service['id']?>">
                          <button class="btn btn-info"><i class="fas fa-edit"></i></button>
                        </a>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne<?=$key?>" aria-expanded="true" aria-controls="collapseOne">
                        <?=$key+1?>. <?=$service['api_name']?>  
                        </button>
                        <a href="#card<?=$key+1?>" style="float: right;margin-left: 10px"><i class="fas fa-anchor"></i></a>
                        <span style="float: right" data-placement="top" data-toggle="tooltip" title="" id="service_status_message">
                          <input class="service_status_<?=$service['id']?>" onchange="Set_Service_Status(<?=$service['id']?>)" <?=$status_check?> type="checkbox" name="my-checkbox" data-bootstrap-switch data-toggle="toggle" data-on-text="On" data-off-color="danger" data-on-color="success" data-off-text="Off" data-handle-width="40">
                        </span>
                      </h5>
                    </div>
                    <div id="collapseOne<?=$key?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <p>Link : <a target="_blank" href="<?=base_url('apis/customer/').$service['api_method']?>"><span class="badge badge-primary"><?=base_url('apis/customer/').$service['api_method']?></span></a></p>
                        <p>Method Name : <span class="badge badge-secondary"><?=$service['api_method']?></span></p>
                        <p>HTT Method : <span class="badge <?=$class_http?>"><?=strtoupper($service['http_method'])?></span></p>
                        <p>Authentication Type: <span class="badge badge-info"><?=strtoupper($service['mobile_authentications']['authentication_name'])?></span></p>
                        <p>Status : <span class="badge <?=$class?>"><?=$service['status']?></span></p>
                        <p><?=$service['api_description']?></p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
            <!-- /.card -->
          </div>
        <!--/.col (left) -->
        </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <section>
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_service" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true"></div>
  </section>
</div>
