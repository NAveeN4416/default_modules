<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mobile Platforms</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Mobile Platforms</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="margin">
        <button type="button" class="btn btn-primary add_mobile">
         + Add Device
        </button>
      </div><br>
      <div class="row">
        <div class="col-md-12">
          <!-- Input addon -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Active - Mobile Platforms</h3>
            </div>
            <div class="card-body">
              <div class="accordion" id="accordionExample">
                <div class="row">
                  <?php $deleted_mobiles = [];  foreach ($mobiles as $key => $mobile) { if($mobile['is_deleted']=='YES') { $deleted_mobiles[$key] = $mobile ; continue; } ?>
                    <?php 
                      $class_status = ($mobile['status']=='Active') ? 'checked' : '' ; 
                    ?>
                    <div class="col-md-4">
                      <div class="card" id="card<?=$key+1?>">
                        <div class="card-header" id="headingOne" style="background-color: #d6d8d9">
                          <h5 class="mb-0">
                            <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne<?=$key?>" aria-expanded="true" aria-controls="collapseOne">
                            <?=$key+1?>. <?=$mobile['name']?>  
                            </button>
                            <a href="#card<?=$key+1?>" style="float: right;margin-left: 10px"><i class="fas fa-anchor"></i></a>
                            <span style="float: right" data-placement="top" data-toggle="tooltip" id="device_status_message">
                              <input class="device_status_<?=$mobile['id']?>" onchange="Set_Device_Status(<?=$mobile['id']?>)"  type="checkbox" <?=$class_status?> name="my-checkbox" data-bootstrap-switch data-toggle="toggle" data-on-text="On" data-off-color="danger" data-on-color="success" data-off-text="Off" data-handle-width="40">
                            </span>
                          </h5>
                        </div>
                        <div id="collapseOne<?=$key?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">
                            <p style="float: right">
                              <a href="javascript:Delete_Record('<?=base64_encode(MOBILE_DEVICES)?>','<?=base64_encode($mobile['id'])?>')" title="Delete">
                                <button class="btn btn-danger"><i class="fa fa-trash" ></i></button>
                              </a>
                              <button class="btn btn-info add_mobile" data-id="<?=$mobile['id']?>"><i class="fas fa-edit" ></i></button>
                              <a href="<?=base_url($this->controller_path)?>Edit_Configuration/<?=$mobile['id']?>">
                                <button class="btn btn-warning" title="Update Configuration"><i class="fas fa-eye" ></i></button>
                              </a>
                            </p>
                            <p>Status : <span class="badge badge-info"><?=$mobile['status']?></span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-md-12">
          <!-- Input addon -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Deleted - Devices</h3>
            </div>
            <div class="card-body">
              <div class="accordion" id="accordionExample2">
                <div class="row">
                  <?php foreach ($deleted_mobiles as $key => $mobile) { ?>
                    <?php 
                      $class_status = ($mobile['status']=='Active') ? 'checked' : '' ; 
                    ?>
                    <div class="col-md-4">
                      <div class="card" id="card<?=$key+1?>">
                        <div class="card-header" id="headingOne" style="background-color: #d6d8d9">
                          <h5 class="mb-0">
                            <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne<?=$key?>" aria-expanded="true" aria-controls="collapseOne">
                            <?=$key+1?>. <?=$mobile['name']?>  
                            </button>
                            <a href="#card<?=$key+1?>" style="float: right;margin-left: 10px"><i class="fas fa-anchor"></i></a>
                            <a href="javascript:Restore_Record('<?=base64_encode(MOBILE_DEVICES)?>','<?=base64_encode($mobile['id'])?>')" title="Restore This Device">
                            <button class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i></button>
                          </a>
                          </h5>
                        </div>
                        <div id="collapseOne<?=$key?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample2">
                          <div class="card-body">
                            <p>Status : <span class="badge badge-info"><?=$mobile['status']?></span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <section>
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_mobile" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true">
    </div>
  </section>
</div>


<script type="text/javascript">
function Accept_Attrs()
{

/*  var key = prompt("Please enter key");
  var password = prompt("Please enter password");
  var link = prompt("Please enter link");
*/
  var message = "You entered :";

swal(message, {
  //buttons: false,
  timer: 3000,
  icon: "success",
  buttons: ["Stop", "Do it!"],
},);
}
</script>

<style type="text/css">

.swal-footer {
  background-color: rgb(245, 248, 250);
  margin-top: 32px;
  border-top: 1px solid #E9EEF1;
  overflow: hidden;
}
</style>


<style type="text/css">
.swal-text {
  background-color: #FEFAE3;
  padding: 17px;
  border: 1px solid #F0E1A1;
  display: block;
  margin: 22px;
  text-align: center;
  color: #61534e;
}
.swal-overlay {
  background-color: rgba(0, 0, 0, 0.82);
}
</style>
