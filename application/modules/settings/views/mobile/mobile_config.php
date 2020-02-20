  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Configurations</h1>
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
      <div class="container-fluid">

        <!-- <div class="row">
          <div class="col-md-4">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">WEB Config</h3>
              </div>
              <div class="card-body">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                    <span class="nav-link">
                      <i class="nav-icon fas fa-file-code"></i>
                      <p class="text"> Status 
                        <?php $site_status = ($site_config['status'])  ? 'checked' : '' ; ?>
                        <span style="margin-left: 10%" data-placement="top" data-toggle="tooltip" title="" id="tooltip_message">
                          <input id="site_status" onchange="Set_Site_Status(this)" type="checkbox" name="my-checkbox" <?=$site_status?> data-bootstrap-switch data-toggle="toggle" data-on-text="On" data-off-color="danger" data-on-color="success" data-off-text="Off" data-handle-width="30">
                          </span>
                      </p>
                    </span>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-umbrella"></i>
                      <p> Mode
                          <?php $site_mode = ($site_config['mode']=='Production')  ? 'checked' : '' ; ?>
                          <span style="margin-left: 10%" data-placement="bottom" data-toggle="tooltip" title="" id="tooltip_message2">
                            <input id="site_mode" <?=$site_mode?> onchange="Set_Site_Mode(this)" type="checkbox" name="my-checkbox" data-bootstrap-switch data-toggle="toggle" data-on-text="Prod" data-off-color="warning" data-on-color="success" data-off-text="Dev" data-handle-width="40">
                          </span>
                      </p>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            Input addon
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Mobile Config</h3>
                <a href="<?=base_url('settings/database/mobile_config')?>">
                  <span data-placement="right" data-toggle="tooltip" id="mobile_manage" title="Manage Mobile Api's here">
                    <button style="margin-left: 120px" class="btn btn-light btn-sm"><i class="fas fa-eye"></i> Manage</button>
                  </span>
                </a>
              </div>
              <div class="card-body">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <?php foreach ($mobile_configs as $key => $mobile) { ?>
                  <li class="nav-item">
                    <span class="nav-link">
                      <i class="nav-icon <?=$mobile['icon_class']?>"></i>
                      <p> Mode
                          <?php 
                            $config = ($mobile['config']['mode']=='Production')  ? 'checked' : '' ;
                          ?>
                          <span style="margin-left: 10%" data-placement="right" data-toggle="tooltip" title="" id="tooltip_message_<?=$mobile['config']['id']?>">
                            <input onchange="Set_MobileConfig('<?=$mobile['name']?>','<?=$mobile['config']['id']?>')" id="mobile_mode_<?=$mobile['config']['id']?>" <?=$config?> type="checkbox" name="my-checkbox" data-bootstrap-switch data-toggle="toggle" data-on-text="Prod" data-off-color="warning" data-on-color="success" data-off-text="Dev" data-handle-width="40">
                          </span>
                      </p>
                    </span>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Information</h3>
                </div>
                <div class="card-body">
                  <ul>
                    <li>Status off means, Site is InActive.</li>
                    <li>Mode off Dev, That related category (eg: iOS) is under development.</li>
                  </ul>
                </div>
              </div>
          </div>
          <div class="col-md-4">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">REST API's Config</h3>
              </div>
              <div class="card-body">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                    <span class="nav-link">
                      <i class="nav-icon fas fa-file-code"></i>
                      <p class="text"> Status 
                        <?php $rest_status = ($site_config['rest_status']) ? 'checked' : '' ; ?>
                        <span style="margin-left: 10%" data-placement="right" data-toggle="tooltip" title="" id="tooltip_message_rs">
                          <input id="rest_status" onchange="Set_RestStatus(this)" type="checkbox" name="my-checkbox" <?=$rest_status?> data-bootstrap-switch data-toggle="toggle" data-on-text="On" data-off-color="danger" data-on-color="success" data-off-text="Off" data-handle-width="30">
                        </span>
                      </p>
                    </span>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-umbrella"></i>
                      <p> Mode
                          <?php $rest_mode = ($site_config['rest_mode']=='Production') ? 'checked' : '' ; ?>
                          <span style="margin-left: 10%" data-placement="right" data-toggle="tooltip" title="" id="tooltip_message_rm">
                            <input id="rest_mode" <?=$rest_mode?> onchange="Set_Rest_Mode(this)" type="checkbox" name="my-checkbox" data-bootstrap-switch data-toggle="toggle" data-on-text="Prod" data-off-color="warning" data-on-color="success" data-off-text="Dev" data-handle-width="40">
                          </span>
                      </p>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            Input addon
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Third Party API's Config</h3>
                <span data-placement="right" data-toggle="tooltip" id="thirdparty_manage" title="Manage ThirdParty Api's here">
                  <button style="margin-left: 50px" class="btn btn-light btn-sm"><i class="fas fa-eye"></i> Manage</button>
                </span>
              </div>
              <div class="card-body">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <?php foreach ($thirdparty_configs as $key => $tparty) { ?>
                  <li class="nav-item">
                    <span class="nav-link">
                      <i class="nav-icon <?=$tparty['icon_class']?>"></i>
                      <p> <?=$tparty['name']?>
                          <?php 
                            $config = ($tparty['mode']=='Production')  ? 'checked' : '' ;
                          ?>
                          <span style="margin-left: 10%" data-placement="right" data-toggle="tooltip" title="" id="thirdparty_message_<?=$tparty['id']?>">
                            <input <?=$config?> onchange="Set_ThirdPartyConfig('<?=$tparty['name']?>','<?=$tparty['id']?>')"  id="thirdparty_mode_<?=$tparty['id']?>" type="checkbox" name="my-checkbox" data-bootstrap-switch data-toggle="toggle" data-on-text="Prod" data-off-color="warning" data-on-color="success" data-off-text="Dev" data-handle-width="40">
                          </span>
                      </p>
                    </span>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div> -->
        <button type="button" class="btn btn-default add_category">
          Launch Default Modal
        </button>
      

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section>
      <div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_category" tabindex = "-1" role = "dialog" aria-labelledby="myModalLabel" aria-hidden = "true"></div>
    </section>
  </div>





