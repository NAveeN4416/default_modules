
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>settings/base" class="brand-link">
      <img src="<?=base_url()?>style/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Site Name Here </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>style/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> -->

<!--           <li class="nav-header">Site Settings</li>
<li class="nav-item">
  <a href="<?=base_url('settings/database/db_constants')?>" class="nav-link">
    <i class="nav-icon fa fa-bars"></i>
    <p>Database Constants <span class="badge badge-info right">2</span>
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="<?=base_url('settings/database/site_config')?>" class="nav-link">
    <i class="nav-icon fa fa-cog"></i>
    <p>Site Config
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="pages/gallery.html" class="nav-link">
    <i class="nav-icon far fa-image"></i>
    <p>
      Gallery
    </p>
  </a>
</li> -->

          <!-- <li class="nav-header">Menu</li> -->
            <?php foreach ($this->menu as $key => $menu) { if(!$menu['is_parent']) { ?>
              <li class="nav-item">
                <a href="<?=base_url($menu['link'])?>" class="nav-link">
                  <i class="fas fa-circle nav-icon"></i>
                  <p><?=$menu['name']?></p>
                </a>
              </li>
            <?php }else{ ?>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>
                    <?=$menu['name']?>
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                <?php foreach ($menu['children'] as $key => $child_menu) { ?>  
                  <li class="nav-item">
                    <a href="<?=base_url($child_menu['link'])?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p><?=$child_menu['name']?></p>
                    </a>
                  </li>
                <?php } ?>  
                </ul>
              </li>
            <?php } } ?>
          </li>

          <li class="nav-header">Auth</li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('admin/auth/logout')?>">
              <p>
                SignOut
                <i style="font-size: 15px;color: red" class="fas fa-sign-out-alt" title="logout"></i>
              </p>
            </a>
          </li>

          <!--<li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
