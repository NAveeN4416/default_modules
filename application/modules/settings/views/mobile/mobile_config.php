<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mobile Configurations</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Site Configuration</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
          <!-- <button type="button" class="btn btn-primary add_mobile" style="float: right">
        Add Device
      </button><br> -->

    <div class="container-fluid">
      <div class="row">
      <?php foreach ($mobiles as $key => $mobile) { ?>  
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><i class="nav-icon <?=$mobile['icon_class']?>"></i> <?=$mobile['name']?> Attributes <button onclick="Accept_Attrs()">Accept Attrs</button></h3>
            </div> 
            <div class="card-body">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <b>Development</b> 
                  <span class="nav-link">
                    <?php $config = json_decode($mobile['mobile_configurations'][0]['configuration_dev'],True); 
                        foreach ($config as $key => $value) { ?>
                      <p class="text"><?=$key?> : <?=$value?></p><br>
                    <?php } ?>
                  </span>
                </li>
                <li class="nav-item"> <b>Production</b>
                  <span class="nav-link"> 
                    <?php $config = json_decode($mobile['mobile_configurations'][0]['configuration_prod'],True); 
                        foreach ($config as $key => $value) { ?>
                      <p class="text"><?=$key?> : <?=$value?></p><br>
                    <?php } ?>
                  </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <section>
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_mobile" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true"></div>
  </section>
</div>


<script type="text/javascript">
function Accept_Attrs()
{

  var popup  = window.open("https://sweetalert.js.org/docs/#methods", "www.google.com","width=100, height=100");


  popup.onClose = function () { popup.opener.location.reload(); }

/*  var key = prompt("Please enter key");
  var password = prompt("Please enter password");
  var link = prompt("Please enter link");

  var message = "You entered :" + key + password + link ;

swal(message, {
  //buttons: false,
  //timer: 3000,
  icon: "success",
  buttons: ["Stop", "Do it!"],
},);*/
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

