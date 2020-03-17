<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Menu</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="margin" style="float: right">
        <button type="button" class="btn btn-sm btn-primary add_menu">
          <i class="fa fa-plus" aria-hidden="true"></i> Add Menu
        </button>
      </div>
      <br>

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
                <span class="input-group-text">Index</span>
              </div>
              <input type="text" class="form-control" required name="keys[]" placeholder="eg: product_details">
              <input type="text" class="form-control" required name="english[]" placeholder="eg: Product Details">
            </div>
          </div>
          <button type="submit" class="btn btn-m btn-info" style="float: right">Submit</button>
        </form>
        <!-- /.card -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <section>
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_menu" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true"></div>
  </section>
</div>
<!-- 
<script type="text/javascript">
  CHECK_DB_FLAG = true ;
</script>


<script type="text/javascript">

$(document).ready(function(){
var dTable =  $('#example').DataTable({
    ajax: {
      url: '<?=base_url('settings/menu/getmenu')?>',
      dataSrc: 'data',
      type : 'post'
    },
    drawCallback: function(settings){
      $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
      $(document).find('input[data-bootstrap-switch]').each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

      var $modal = $('#add_menu');
      $('.add_menu').on('click',function(event){ 
          var id = $(this).data('id');
          event.stopPropagation();

          $modal.load('<?php echo site_url('settings/menu/add_edit_menu');?>', {id: id},
          function(){
          /*$('.modal').replaceWith('');*/
            $modal.modal('show');
          });

      });

    },
    columns: [
                { data: 'name' },
                { data: 'type' },
                { data: 'link' },
                { data: 'status' },
                { data: 'actions' },
            ],
    select: true,
    pageLength: 15,
    order: [[ 0, 'desc' ]],  
    serverSide: true,
    processing: true,
    filter: true,
    responsive: true,
    autoWidth:false,
    searching: false,
    lengthMenu: [
      [ 15, 25, 50, 100, 1000, -1 ],
      [ '15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all' ]
    ],
    });

   // filter campaigns
   $(".filter_plans").on("click", function(){

     $('#example').DataTable().draw();
     return false;
   });
});


</script>


<script type="text/javascript">
function MenuActivity(menu_id)
{
  var status = 0 ;

  if($("#menu_status"+menu_id).is(":checked")==true)
  {
    status = 1 ;
  }

  var data = new FormData();
  data.append('menu_id',menu_id);
  data.append('status',status);

  var object = {
      'url'  : "<?=base_url('settings/menu/MenuActivity')?>" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);
}
</script>


<script type="text/javascript">
  function Check_Slug_InDB(slug)
  {
    var data = new FormData();
    data.append('slug',slug);
    data.append('table',"menu");

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
</script> -->