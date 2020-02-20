
  <!-- /.content-wrapper -->
<!--   <footer class="main-footer">
  <strong>Copyright &copy; 2014-2019 <a href="<?=base_url()?>">Admin.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.0.3-pre
  </div>
</footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- Bootstrap 4 -->
<script src="<?=base_url()?>style/settings/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?=base_url()?>style/settings/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?=base_url()?>style/settings/plugins/toastr/toastr.min.js"></script>

<!-- Select2 -->
<script src="<?=base_url()?>style/settings/plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="<?=base_url()?>style/settings/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>


<!-- ChartJS -->
<script src="<?=base_url()?>style/settings/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>style/settings/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?=base_url()?>style/settings/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url()?>style/settings/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url()?>style/settings/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url()?>style/settings/plugins/moment/moment.min.js"></script>
<script src="<?=base_url()?>style/settings/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?=base_url()?>style/settings/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url()?>style/settings/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url()?>style/settings/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?=base_url()?>style/settings/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url()?>style/settings/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url()?>style/settings/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>style/settings/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url()?>style/settings/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>style/settings/dist/js/demo.js"></script>

<!-- Datables -->
<script type="text/javascript" src="<?=base_url()?>style/datatables.js"></script>



<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
  //Bootstrap Duallistbox
  $('.duallistbox').bootstrapDualListbox()
</script>

<script type="text/javascript">
//Sweet alert var
const Toast = Swal.mixin({
      toast: true,
      position: 'top-left',
      showConfirmButton: false,
      timer: 3000
    });

//Bootstrap Toastr's START
toastr.options = {
    tapToDismiss: false
    , timeOut: 0
    , newestOnTop: true
    , closeButton: true
}
const success_toastr = '' ;
const warning_toastr = '' ;
//Bootstrap Toastr's END


$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function () {
  //bsCustomFileInput.init();
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });

});

</script>

<!-- Site Config Page Start -->
<script type="text/javascript">

function Set_Site_Status(element)
{
  var status = 0 ;
  var title = "Site InActive" ;

  if($("#site_status").is(":checked")==true)
  {
    var status = 1 ;
    var title = "Site Active" ;
  }

  $("#tooltip_message").attr('data-original-title',title);

  var data = new FormData();

  data.append('status',status);

  var object = {
      'url'  : "<?=base_url('settings/base/Change_SiteStatus')?>" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);

  toastr.clear();

  if(status==1)
  {
    Show_Success("Site Active");
    return;
  }

  Show_Warning("Site InActive");
}


function Set_RestStatus(element)
{
  var rest_status = 0 ;
  var title = "Rest Api's InActive" ;

  if($("#rest_status").is(":checked")==true)
  {
    var rest_status = 1 ;
    var title = "Rest Api's Active" ;
  }

  $("#tooltip_message_rs").attr('data-original-title',title);

  var data = new FormData();
  data.append('rest_status',rest_status);

  var object = {
      'url'  : "<?=base_url('settings/base/Change_RestStatus')?>" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);

  toastr.clear();

  if(rest_status==1)
  {
    Show_Success("Rest Api's Active");
    return;
  }

  Show_Warning("Rest Api's InActive");
}



function Set_Site_Mode(element)
{
  var mode = 0 ;
  var title = "Site under development" ;

  if($("#site_mode").is(":checked")==true)
  {
    var mode = 1 ;
    var title = "Site under Production" ;
  }

  $("#tooltip_message2").attr('data-original-title',title);

  var data = new FormData();
  data.append('mode',mode);

  var object = {
      'url'  : "<?=base_url('settings/base/Change_SiteMode')?>" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);

  toastr.clear();

  if(mode==1)
  {
    Show_Success(title);
    return;
  }

  Show_Warning(title);
}



function Set_Rest_Mode(element)
{
  var rest_mode = 0 ;
  var title = "Rest Api's under development" ;

  if($("#rest_mode").is(":checked")==true)
  {
    var rest_mode = 1 ;
    var title = "Rest Api's under Production" ;
  }

  $("#tooltip_message_rm").attr('data-original-title',title);

  var data = new FormData();
  data.append('rest_mode',rest_mode);

  var object = {
      'url'  : "<?=base_url('settings/base/Change_RestMode')?>" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);

  toastr.clear();

  if(rest_mode==1)
  {
    Show_Success(title);
    return;
  }

  Show_Warning(title);
}


function Set_MobileConfig(device_name,config_id)
{
  var mode = "Development" ;
  var title = device_name +" under development" ;

  if($("#mobile_mode_"+config_id).is(":checked")==true)
  {
    mode = "Production" ;
    var title = device_name + " under Production" ;
  }

  $("#tooltip_message_"+config_id).attr('data-original-title',title);

  var data = new FormData();
  data.append('config_id',config_id);
  data.append('mode',mode);

  var object = {
      'url'  : "<?=base_url('settings/base/Change_MobileMode')?>" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);
}

function Set_ThirdPartyConfig(Thirdparty_name,config_id)
{
  var mode = "Development" ;
  var title = Thirdparty_name +" API's under development" ;

  if($("#thirdparty_mode_"+config_id).is(":checked")==true)
  {
    mode = "Production" ;
    var title = Thirdparty_name + " API's under Production" ;
  }

  $("#thirdparty_message_"+config_id).attr('data-original-title',title);

  var data = new FormData();

  data.append('config_id',config_id);
  data.append('mode',mode);

  var object = {
      'url'  : "<?=base_url('settings/base/Change_ThirdPartyMode')?>",
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);
}

</script>
<!-- Site Config Page END -->



<script type="text/javascript">
    var $modal = $('#add_category');

    $('.add_category').on('click',function(event){ 

        var id = $(this).data('id');

        event.stopPropagation();

        $modal.load('<?php echo site_url('settings/database/Get_Device_Form');?>', {id: id},
        function(){
        /*$('.modal').replaceWith('');*/
          $("#add_category").modal('show');
        });

    });
</script>

<script type="text/javascript">
    var $modal = $('#add_group');

    $('.add_group').on('click',function(event){ 
        var id = $(this).data('id');
        event.stopPropagation();

        $modal.load('<?php echo site_url('settings/user_groups/add_edit_group');?>', {id: id},
        function(){
        /*$('.modal').replaceWith('');*/
          $modal.modal('show');
        });

    });
</script>



<script type="text/javascript">
function Show_Success(msg)
{
  toastr.success(msg);
}

function Show_Warning(msg)
{
  toastr.warning(msg);
}

function Show_Error(msg)
{
  toastr.danger(msg);
}

//Overload this with custom method
function AjaxBeforeSend()
{
  console.log("Requesting Server");
}

//Overload this method with custom method
function AjaxComplete()
{
  console.log("Response Recieved")
  Toast.fire({
    type: 'success',
    title: 'Ajax Response 200 OK'
  })
}

function Ajaxerror()
{
  Toast.fire({
    type: 'error',
    title: 'Ajax Response Error !'
  })
}


function JSONparse($response)
{
  return JSON.parse($response);
}

function AjaxUpdate(object,async=false)
{
  var response = '' ;

  //Params
  var mimeType = (object.mimeType) ? object.mimeType : '' ;
  var contentType = (object.contentType) ? object.contentType : false ;
  var cache = (object.cache) ? object.cache : false ;
  var processData = (object.processData) ? object.processData : false ;

  $.ajax({
          url: object.url ,
          type: object.type,
          data: object.data,
          mimeType: mimeType, //"multipart/form-data",
          contentType: contentType,
          cache: cache,
          processData:processData,
          async:async,
          beforeSend: AjaxBeforeSend,
          error:function(request,response)
          {
              console.log(request);
          },                  
          success: function(result)
          {
            response = JSON.parse(JSON.stringify(result));
          },
          complete : AjaxComplete,
      });

  return response ;
}

</script>



</body>
</html>
