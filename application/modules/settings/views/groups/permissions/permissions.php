<style type="text/css">
  .bootstrap-duallistbox-container select
  {
    padding: 15px;
    min-height: 40vh;
  }
  #bootstrap-duallistbox-nonselected-list_ option:hover {
    background-color: #6c757d;
    color: white;
    cursor: pointer;
    padding: 10px;
    transition: all 0.5s;
  }
  #bootstrap-duallistbox-nonselected-list_ option,  #bootstrap-duallistbox-selected-list_ option
  {
    transition: all 0.5s;
  }

  #bootstrap-duallistbox-selected-list_ option:hover {
    background-color: #ffc107;
    color: black;
    cursor: pointer;
    padding: 10px;
    transition: all 0.5s;
  }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Groups Permissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permissions</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Manager Permissions  <i class="fas fa-map-signs"></i></h3>
            
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <select class="duallistbox" multiple="multiple">
                    <option selected>Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section>
      <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_group" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true"></div>
    </section>
  </div>

<script type="text/javascript">

$(document).ready(function(){
var dTable =  $('#example').DataTable({
    ajax: {
      url: '<?=base_url('settings/user_groups/getgroups')?>',
      dataSrc: 'data'
    },
    drawCallback: function(settings){
      $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
      $(document).find('input[data-bootstrap-switch]').each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

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

    },
    columns: [
                { data: 'group_name' },
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
function GroupActivity(group_id)
{
  var status = 0 ;

  if($("#group_status"+group_id).is(":checked")==true)
  {
    status = 1 ;
  }

  var data = new FormData();
  data.append('group_id',group_id);
  data.append('status',status);

  var object = {
      'url'  : "<?=base_url('settings/user_groups/GroupActivity')?>" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);
}
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(".moveall").html('Move All <i class="fa fa-arrow-right" aria-hidden="true"></i>');
    $(".removeall").html('<i class="fa fa-arrow-left" aria-hidden="true"></i> Remove All ')
  });
</script>