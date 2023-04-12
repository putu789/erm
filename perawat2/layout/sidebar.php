<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
         <?php
                if ($dataGet['1'] == 'L') { 
                    echo '<img src="dist/img/avatar.png" class="img-circle" alt="User Image">';
                } else if ($dataGet['1'] == 'P') { 
                    echo '<img src="dist/img/avatar3.png" class="img-circle" alt="User Image">';
                }
                ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $dataGet['0'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $dataGet['2'];?></a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
         
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wheelchair"></i> <span>Rawat Jalan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=pilih-poli"><i class="fa fa-circle-o"></i> Assesment Perawat</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Assesment Dokter</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Farmasi</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Kasir</a></li>
          </ul>
        </li>
        
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bed"></i>
            <span>Rawat Inap</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Coming Soon</a></li>
          </ul>
        </li>
        
        <li>
          <a href="index.php?page=resumerj">
            <i class="fa fa-edit"></i> <span> Resume Rawat Jalan</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-edit"></i> <span> Resume Rawat Inap</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa  fa-align-justify"></i> <span> Rekam Medik</span>
          </a>
        </li>
      
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>