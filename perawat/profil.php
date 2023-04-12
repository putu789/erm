
<?php include_once ('layout/header.php'); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD PERAWAT</h2>
            </div>
 <?php
								 if ($_POST['ub_pwd']) {
								
								if (($_POST['ub_pwd'] <> "") and ($_POST['password_baru'] <> "")) {
								$pwd_new = $_POST['password_baru'];
                                $insert = query("UPDATE user SET  password = AES_ENCRYPT('$pwd_new','windi') WHERE AES_DECRYPT(id_user,'nur') = '".$_SESSION['username']."'");
													  
													 
													 
                                if ($insert) {
                                    redirect("login.php?action=logout");
									
                                }
								
							}
                        }
                        ?>
           
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>UBAH PASSWORD</h2>
                                </div>
                                <hr>
                                <form action="" method="post">
                            <table>
                            <tr  style="padding:10px;">
                            <td  style="padding:30px;">
                      		<?php $dataGet = fetch_array(query("SELECT nama, jk FROM petugas WHERE nip = '{$_SESSION['username']}'")); ?>
          
                <?php
                if ($dataGet['1'] == 'L') { 
                    echo '<img src="../asset/images/pria.png" height="300" width="300" class="image img-rounded"  alt="User" />';
                } else if ($dataGet['1'] == 'P') { 
                    echo '<img src="../asset/images/wanita.png" height="300" width="300" class="image img-rounded" alt="User" />';
                }
                ?>
                </td>
                <td>
                <input type="text" placeholder="Password Baru" name="password_baru" class="form-control">
                </td>
                <td>
                <button type="submit" name="ub_pwd" value="ub_pwd" onclick="this.value=\'ub_pwd\'" class="btn btn-success">Ubah Password</button> 
                </td>
                </tr>
                </table>
                </form>
                        </div>
                        </div>
                    </div>
                </div>
            <!-- #END# CPU Usage -->
           
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>

<?php include_once ('layout/footer.php'); ?>
