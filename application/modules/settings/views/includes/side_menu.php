
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">      
      <img src="<?=base_url()?>style/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Site Name Here</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>style/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a style="cursor: pointer;" href="javascript:location.reload()" class="d-block"><?=$this->username?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Settings</li>
          <li class="nav-item">
            <a href="<?=base_url('settings/base/site_config')?>" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>Configurations
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('settings/mobile_services')?>" class="nav-link">
              <i class="nav-icon fas fa-taxi"></i>
              <p>Mobile Services</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('settings/database/db_constants')?>" class="nav-link">
              <i class="nav-icon fa fa-bars"></i>
              <p>Database Constants <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>

          <li class="nav-header">Auth Links</li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('admin/auth/logout')?>">
              <p>
                SignOut
                <i style="font-size: 15px;color: red" class="fas fa-sign-out-alt" title="logout"></i>
              </p>
            </a>
          </li>

        </ul>

      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
