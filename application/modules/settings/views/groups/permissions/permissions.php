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
            <h1>Group Permissions</h1>
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
            <h3 class="card-title"><?=$group['group_name']?> Permissions  <i class="fas fa-map-signs"></i></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <form id="permissions" onsubmit="return Submit_Permissions()">
            <input type="hidden" name="group_id" value="<?=$group_id?>">
            <!-- <div class="form-group">
              <label>Choose Group</label>
              <select class="form-control select2" style="width: 100%;" name="group_id" required>
                <option value='' selected="selected">-- Select --</option>
                <?php foreach ($groups as $key => $group) { ?>
                  <option value="<?=$group['id']?>" <?=($permissions['group_id']==$group['id'])? 'selected' : ''?> ><?=strtoupper($group['group_name'])?></option>
                <?php } ?>
              </select>
            </div> -->
            <div class="row">
            <?php if(@$permissions){ ?>  
              <div class="col-12">
                <div class="form-group">
                  <select class="duallistbox" multiple="multiple" name="permissions[]">
                  <?php foreach ($menu as $key => $m) { ?>
                    <option value="<?=$m['id']?>" <?php if(in_array($m['link'], $permissions['permissions'])) { echo "selected" ; }  ?>><?=$m['name']?></option>
                  <?php } ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
            <?php }else{ ?>
              <div class="col-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Choose Permissions</label>
                  <select class="duallistbox" multiple="multiple" name="permissions[]" required>
                  <?php foreach ($menu as $key => $m) { ?>
                    <option value="<?=$m['link']?>"><?=$m['name']?></option>
                  <?php } ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
            <?php } ?>
              <!-- /.col -->
            </div>
            <button type="submit" class="btn btn-primary btn-sm" style="float: right">Submit</button>
            <!-- /.row -->
          </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
  </div>


<!-- <script type="text/javascript">

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


</script> -->


<script type="text/javascript">
function Submit_Permissions()
{
  var data = new FormData($('form#permissions')[0]);  
  var object = {
      'url'  : "<?=base_url('settings/user_permissions/Submit_Permissions')?>" ,
      "data" : data,
      "type" : "post"
  } ;

  $response_object = AjaxUpdate(object);

  return false;
}
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(".moveall").html('Move All <i class="fa fa-arrow-right" aria-hidden="true"></i>');
    $(".removeall").html('<i class="fa fa-arrow-left" aria-hidden="true"></i> Remove All ')
  });
</script>