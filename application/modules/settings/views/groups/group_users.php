  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=strtoupper($group_details['group_name'])?> - Users Lists</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="margin" style="float: right">
          <!-- <a href="<?=base_url('settings/user_permissions')?>">
            <button type="button" class="btn btn-sm btn-primary">
              <i class="fa fa-lock" aria-hidden="true"></i> Manage Permissions
            </button>
          </a> -->
          <button type="button" class="btn btn-sm btn-primary add_user">
            <i class="fa fa-plus" aria-hidden="true"></i> Add User
          </button>
        </div>
        <br>
        <div class="card-body">
          <table id="example" class="table table-bordered table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section>
      <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_user" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true"></div>
    </section>
  </div>

<script type="text/javascript">

$(document).ready(function(){
var dTable =  $('#example').DataTable({
    ajax: {
      url: '<?=base_url($this->controller_path.'/Get_Group_Users')?>',
      data:{'group_id':'<?=$group_id?>'},
      dataSrc: 'data',
      type : 'post'
    },
    drawCallback: function(settings){
      $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
      $(document).find('input[data-bootstrap-switch]').each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

      var $modal = $('#add_user');
      $('.add_user').on('click',function(event){ 
          var id = $(this).data('id');
          var group_id = "<?=$group_id?>";
          event.stopPropagation();

          $modal.load('<?php echo site_url('settings/user_groups/add_edit_user');?>', {id: id,group_id:group_id},
          function(){
          /*$('.modal').replaceWith('');*/
            $modal.modal('show');
          });

      });

    },
    columns: [
                { data: 'username' },
                { data: 'email' },
                { data: 'phone' },
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
function UserActivity(user_id)
{
  var status = 0 ;

  if($("#user_status"+user_id).is(":checked")==true)
  {
    status = 1 ;
  }

  var data = new FormData();
  data.append('user_id',user_id);
  data.append('status',status);

  var object = {
      'url'  : "<?=base_url($this->controller_path)?>UserActivity" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);
}
</script>