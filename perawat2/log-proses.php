<?php
include "config.php";
$login = mysqli_query("SELECT * FROM user WHERE AES_DECRYPT(id_user,'nur') = '".$_POST["username"]."' and AES_DECRYPT(password,'windi')='".$_POST["password"]."'");
$cek = mysqli_num_rows($login);
 
if($cek > 0){
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:index.php");
}else{
	header("location:login.php");	
}
?>

