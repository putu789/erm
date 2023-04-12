<?php 
include "layout/header.php";
include "layout/sidebar.php";
?>
 <!-- Content Wrapper. Contains page content -->
 	<?php 
	if(isset($_GET['page'])){
		$page = $_GET['page'];
 
		switch ($page) {
			case 'home':
				include "pages/home.php";
				break;
			case 'pilih-poli':
				include "pages/perawat/asesmen.php";
				break;
				break;
			case 'semua-pasien':
				include "pages/perawat/semua-pasien.php";
				break;
			case 'pasienrj':
				include "pages/perawat/pasien-rj.php";
				break;
			case 'input-asesmen':
				include "pages/perawat/input-ases.php";
				break;
				
			case 'tutorial':
				include "halaman/tutorial.php";
				break;	
			case 'tutorial':
				include "pages/perawat/cetak/cetak-asesmen.php";
				break;	
			case 'cetak':
				include "pages/perawat/cetak/cetak-asesmen1.php";
				break;
			case 'resumerj':
				include "pages/resume-rj.php";
				break;
			default:
				include "pages/notfound.php";
				break;
		}
	}else{
		include "pages/home.php";
	}
 
	 ?>
<!-- ./wrapper -->

<?php include "layout/footer.php";?>