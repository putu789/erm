 <?php 
ob_start();
session_start();
require_once('set/config.php');
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) { redirect('index.php'); }

?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LOGIN E-RM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
  body{
	padding-left: 0;
	margin-top: 10%;
   margin-left: 30% ;
  
  }
  .box{
	   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	   padding:15px;
  }
  </style>
</head>
<body>
 <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Login E-RM RSU Asy syifa Sambi</h3>
            </div>
            <!-- /.box-header -->
             <?php if(!isset($_GET['action'])){ 

        if($_SERVER['REQUEST_METHOD'] == "POST") { 

            if (empty ($_POST['username']) || empty ($_POST['password'])) {
                $errors[] = 'Username or password empty'; 
            }

            if ($_POST['username'] !=="" || $_POST['password'] !=="") { 

                $sql = "SELECT * FROM user WHERE AES_DECRYPT(id_user,'nur') = '".$_POST["username"]."' and AES_DECRYPT(password,'windi')='".$_POST["password"]."'";
                
                $found = query($sql);
                echo "user : ".$_POST['username'] ;
                echo "password : ".$_POST['password'] ;
                echo "Data : ".num_rows($found);
                if(num_rows($found) !== 1) {
                    $errors[] = 'Username atau password tidak terdaftar atau tidak aktif.';
                }       

            }

            if(!empty($errors)) { 

                foreach($errors as $error) {
                    echo validation_errors($error);
                }

            } else { 

                if (isset($_POST['remember'])) {
                    /* Set cookie to last 1 year */
                    setcookie('username', $_POST['username'], time()+60*60*24*365);
                    setcookie('password', $_POST['password'], time()+60*60*24*365);
        
                } else {
                    /* Cookie expires when browser closes */
                    setcookie('username', $_POST['username'], false);
                    setcookie('password', $_POST['password'], false);
                }

                redirect('index.php');

            }
        
        }
        ?>
            <!-- form start -->
            <form class="form-horizontal" id="sign_in" method="POST"> 
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password"  name="password" class="form-control" id="inputPassword3" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><span class="glyphicon glyphicon-log-in"></span> Login</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
           <?php } ?>

    <?php
    //logout
    if(isset($_GET['action']) == "logout"){ 

        setcookie('username', '', time()-60*60*24*365);
        setcookie('password', '', time()-60*60*24*365);

        unset($_SESSION['username']); 
        unset($_SESSION['level']);
        unset($_SESSION['jenis_poli']);
        $_SESSION = array(); 
        session_destroy(); 

        redirect('login.php'); 

    } 
    ?>
          </div>
         <?php include "layout/footer.php";?>