<?php 

/***
* e-Dokter from version 0.1 Beta
* Last modified: 02 Pebruari 2018
* Author : drg. Faisol Basoro
* Email : drg.faisol@basoro.org
*
* File : login.php
* Description : Login, cookie and session process
* Licence under GPL
***/ 

ob_start();
session_start();

require_once('config.php');

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) { redirect('pasien.php'); }

?>
﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $dataSettings['nama_instansi']; ?></title>
    <!-- Favicon-->
     <link rel="icon" href="LOG.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="../asset/css/roboto.css" rel="stylesheet">

    <!-- Material Icon Css -->
    <link href="../asset/css/material-icon.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="../asset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../asset/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../asset/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../asset/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../asset/css/theme-all.css" rel="stylesheet" />
    <style>
	/* Remove default checkbox */
[type="checkbox"]:not(:checked),
[type="checkbox"]:checked {
  position: absolute;
  left: -9999px;
  opacity: 1;
}

[type="checkbox"] {
  /* checkbox aspect */
}

[type="checkbox"] + label {
  position: relative;
  padding-left: 35px;
  cursor: pointer;
  display: inline-block;
  height: 25px;
  line-height: 25px;
  font-size: 1rem;
  -webkit-user-select: none;
  /* webkit (safari, chrome) browsers */
  -moz-user-select: none;
  /* mozilla browsers */
  -khtml-user-select: none;
  /* webkit (konqueror) browsers */
  -ms-user-select: none;
  /* IE10+ */
}

[type="checkbox"] + label:before,
[type="checkbox"]:not(.filled-in) + label:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 18px;
  height: 18px;
  z-index: 0;
  border: 2px solid #5a5a5a;
  border-radius: 1px;
  margin-top: 2px;
  transition: .2s;
}

[type="checkbox"]:not(.filled-in) + label:after {
  border: 0;
  -webkit-transform: scale(0);
          transform: scale(0);
}

[type="checkbox"]:not(:checked):disabled + label:before {
  border: none;
  background-color: rgba(0, 0, 0, 0.26);
}

[type="checkbox"].tabbed:focus + label:after {
  -webkit-transform: scale(1);
          transform: scale(1);
  border: 0;
  border-radius: 50%;
  box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.1);
  background-color: rgba(0, 0, 0, 0.1);
}

[type="checkbox"]:checked + label:before {
  top: -4px;
  left: -5px;
  width: 12px;
  height: 22px;
  border-top: 2px solid transparent;
  border-left: 2px solid transparent;
  border-right: 2px solid #26a69a;
  border-bottom: 2px solid #26a69a;
  -webkit-transform: rotate(40deg);
          transform: rotate(40deg);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transform-origin: 100% 100%;
          transform-origin: 100% 100%;
}

[type="checkbox"]:checked:disabled + label:before {
  border-right: 2px solid rgba(0, 0, 0, 0.26);
  border-bottom: 2px solid rgba(0, 0, 0, 0.26);
}

/* Indeterminate checkbox */
[type="checkbox"]:indeterminate + label:before {
  top: -11px;
  left: -12px;
  width: 10px;
  height: 22px;
  border-top: none;
  border-left: none;
  border-right: 2px solid #26a69a;
  border-bottom: none;
  -webkit-transform: rotate(90deg);
          transform: rotate(90deg);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transform-origin: 100% 100%;
          transform-origin: 100% 100%;
}

[type="checkbox"]:indeterminate:disabled + label:before {
  border-right: 2px solid rgba(0, 0, 0, 0.26);
  background-color: transparent;
}

[type="checkbox"].filled-in + label:after {
  border-radius: 2px;
}

[type="checkbox"].filled-in + label:before,
[type="checkbox"].filled-in + label:after {
  content: '';
  left: 0;
  position: absolute;
  /* .1s delay is for check animation */
  transition: border .25s, background-color .25s, width .20s .1s, height .20s .1s, top .20s .1s, left .20s .1s;
  z-index: 1;
}

[type="checkbox"].filled-in:not(:checked) + label:before {
  width: 0;
  height: 0;
  border: 3px solid transparent;
  left: 6px;
  top: 10px;
  -webkit-transform: rotateZ(37deg);
  transform: rotateZ(37deg);
  -webkit-transform-origin: 20% 40%;
  transform-origin: 100% 100%;
}

[type="checkbox"].filled-in:not(:checked) + label:after {
  height: 20px;
  width: 20px;
  background-color: transparent;
  border: 2px solid #5a5a5a;
  top: 0px;
  z-index: 0;
}

[type="checkbox"].filled-in:checked + label:before {
  top: 0;
  left: 1px;
  width: 8px;
  height: 13px;
  border-top: 2px solid transparent;
  border-left: 2px solid transparent;
  border-right: 2px solid #fff;
  border-bottom: 2px solid #fff;
  -webkit-transform: rotateZ(37deg);
  transform: rotateZ(37deg);
  -webkit-transform-origin: 100% 100%;
  transform-origin: 100% 100%;
}

[type="checkbox"].filled-in:checked + label:after {
  top: 0;
  width: 20px;
  height: 20px;
  border: 2px solid #26a69a;
  background-color: #26a69a;
  z-index: 0;
}

[type="checkbox"].filled-in.tabbed:focus + label:after {
  border-radius: 2px;
  border-color: #5a5a5a;
  background-color: rgba(0, 0, 0, 0.1);
}

[type="checkbox"].filled-in.tabbed:checked:focus + label:after {
  border-radius: 2px;
  background-color: #26a69a;
  border-color: #26a69a;
}

[type="checkbox"].filled-in:disabled:not(:checked) + label:before {
  background-color: transparent;
  border: 2px solid transparent;
}

[type="checkbox"].filled-in:disabled:not(:checked) + label:after {
  border-color: transparent;
  background-color: #BDBDBD;
}

[type="checkbox"].filled-in:disabled:checked + label:before {
  background-color: transparent;
}

[type="checkbox"].filled-in:disabled:checked + label:after {
  background-color: #BDBDBD;
  border-color: #BDBDBD;
}
	</style>
</head>

<body class="login-page" style="background:#a85005;">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Memproses data ke server.....</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <div class="login-box">
        <div class="logo">
        <p align="center"><img src="../asset/images/logo.png" width="70px" height="70px"></p>
            <a href="index.php"><?php echo $dataSettings['nama_instansi']; ?></a>
            <small><?php echo $dataSettings['alamat_instansi']; ?> - <?php echo $dataSettings['kabupaten']; ?></small>
        </div>

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
                    $errors[] = 'Kode petugas tidak terdaftar atau tidak aktif.';
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

        <div class="card">        
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Silahkan login dulu untuk memulai</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Kode Petugas" required autofocus>
                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Kata Kunci" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Ingat saya</label>
                        </div>
                        <br>
                        <div class="col-xs-4">
                            <button class="btn btn-block btn-success" type="submit">Log Masuk</button>
                        </div>
                    </div>
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
    </div>

    <!-- Jquery Core Js -->
    <script src="../asset/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../asset/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../asset/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../asset/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../asset/js/admin.js"></script>
</body>

</html>
