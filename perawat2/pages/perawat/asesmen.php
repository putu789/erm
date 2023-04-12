 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Keperawatan	
        <small>Asesmen Keperawatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Poliklinik</li>
      </ol>
    </section>    
    <br />
    <div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"> <i class="fa fa-list"></i> Pilih Unit</h3>
    <small class="pull-right"><a href="index.php?page=semua-pasien"><button type="button" class="btn btn-warning">Semua Pasien hari ini</button></a></small>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <?php
  $query = query("SELECT kd_poli,nm_poli FROM poliklinik"); 
            						
  while ($hasil = fetch_array($query)){
  ?>
  <div class="col-md-4" style="padding:2px; padding-left:10px;" ><div class="inner"> <a href="index.php?page=pasienrj&poli=<?php echo $hasil['0'];?>"><button type="button" class="btn btn-success"><i class="fa fa-building-o"></i> <?php echo $hasil['nm_poli'];?></button></a></div></div>
  <?php }?>
  </div>
  </div>
  </div>
  