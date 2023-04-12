<?php 

/***
* e-Dokter from version 0.1 Beta
* Last modified: 02 Pebruari 2018
* Author : drg. Faisol Basoro
* Email : drg.faisol@basoro.org
*
* File : layout/header.php
* Description : Header layout
* Licence under GPL
***/

ob_start();
session_start();

require_once('config.php');

$data=fetch_array(query("SELECT AES_DECRYPT(a.id_user,'nur') as id_user, AES_DECRYPT(a.password,'windi') as password, b.nip as jbtn  from user a, petugas b where a.id_user = AES_ENCRYPT('{$_COOKIE[username]}','nur') and b.nip ='$_COOKIE[username]' and b.kd_jbtn = 'J008'  and a.password = AES_ENCRYPT('{$_COOKIE[password]}','windi') ")); 

$user = $data[0];
$pass = $data[1];

if (!isset($_COOKIE['username']) && !isset($_COOKIE['password'])) { 
    redirect('login.php'); 
} else if (($_COOKIE['username'] != $user) || ($_COOKIE['password'] != $pass)) { 
    redirect('login.php?action=logout'); 
} else { 
    $_SESSION['username'] = $_COOKIE['username'];
	$_SESSION['jabatan'] = $data['kd_jbtn']; 
}

?>
﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $dataSettings['nama_instansi']; ?> - MEDICAL RECORD</title>
    <!-- Favicon-->
    <link rel="icon" href="LOG.ico">
     <link href="../asset/css/tab.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="../asset/css/roboto.css" rel="stylesheet">

    <!-- Material Icon Css -->
    <link href="../asset/css/material-icon.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="../asset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <!-- Animation Css -->

    <!-- Sweet Alert Css -->
    <link href="../asset/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../asset/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Wait Me Css -->

    <link rel="stylesheet" href="../asset/css/jquery-ui.min.css">
    <link rel="stylesheet" href="../asset/css/select2.min.css">

    <!-- Custom Css -->
    <link href="../asset/css/style.css" rel="stylesheet">
    <link href="../asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../asset/css/all-themes.min.css" rel="stylesheet" />
    <script src="../asset/plugins/jquery/jquery.min.js"></script>
    <script src="../asset/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap-select.js" defer></script>
    <script type="text/javascript" src="../asset/js/select2.min.js" defer></script>
    <script type="text/javascript" src="../asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
     
    <style>
	.info-box{
		background-color:#9C0;
		
	}

	</style>
</head>
<body class="theme-orange">
    <!-- Page Loader 
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
            <p>Please wait...</p>
        </div>
    </div>-->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <?php $dataGet = fetch_array(query("SELECT nama, jk FROM petugas WHERE nip = '{$_SESSION['username']}'")); ?>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php"><?php echo $dataSettings['nama_instansi']; ?> - MEDICAL RECORD</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
         <li class="active">
                        <a href="index.php">
                            <span class="glyphicon glyphicon-home"> Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="rekam-medik.php">
                            <span class="glyphicon glyphicon-book"> Rekam Medik (Pasien)</span>
                        </a>
                    </li>
                     <li>
                        <a href="rekam-medik1.php">
                            <span class="glyphicon glyphicon-book"> Rekam Medik (Dokter)</span>
                        </a>
                    </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"> </span>User <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><?php echo $dataGet['0']; ?></a></li>
            <li><a href="login.php?action=logout"> Logout</a></li>
          </ul>
                   </li>
                    
                    
        </div>
    </nav>
    <!-- #Top Bar -->
