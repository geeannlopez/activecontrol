  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->user->info('user_name') ?></p>
          <!-- Status -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Admin</li>
        <!-- Optionally, you can add icons to the links -->
       <!--  <li><a href="#"><i class="fa fa-link"></i> <span></span></a></li> -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Items & Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url()?>admin/category"><i class="fa fa-circle-o"></i>Category</a></li>
            <li><a href="<?= base_url()?>admin/add_product"><i class="fa fa-circle-o"></i>Add Product</a></li>
            <li><a href="<?= base_url()?>admin/products"><i class="fa fa-circle-o"></i>View Products</a></li>
          </ul>          
        </li>
            <li><a href="<?= base_url()?>admin/inventory"><i class="fa fa-circle-o"></i>Inventory</a></li>
            <li><a href="<?= base_url()?>admin/customers"><i class="fa fa-circle-o"></i>Customers</a></li>
            <li><a href="<?= base_url()?>admin/products"><i class="fa fa-circle-o"></i>Orders</a></li>            
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>