<?php
session_start();
ob_start();
include_once('config.php'); //buat koneksi ke database
echo "<table style='margin-top:0px;' width=450>
				<tr>
				<td align='center'><img src='../images/PIN(blck).png' width='80px;' height='80px;'/>
				</td>
				<td align='center'><b>RSU ASY SYIFA SAMBI</b><br>
				Jl. Raya Bangak -Simo Km.7,Sambi, Boyolali 57376<br>
				Telp. (0276)3294459, Fax.(0276)3294459</td>
				</tr>
				<tr><td align='center' colspan=2 style='border-top:5px double;></td></tr>";
$kode   = $_GET['no_rawat']; //kode berita yang akan dikonvert
$query = query("SELECT a.no_rawat, a.kd_jenis_prw, a.tgl_perawatan, a.jam_rawat, a.biaya_rawat, b.nm_perawatan FROM rawat_jl_dr a, jns_perawatan b WHERE a.kd_jenis_prw = b.kd_jenis_prw AND a.no_rawat = '{$no_rawat}' ");
$data   = mysql_fetch_array($query);

?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $data['no_rawat']; ?></title>
</head>
<?php
echo "<h1>".$data['no_rawat']."</h1>"; 
echo '<table border="0">
  <tr>
    <td width="100">RUMAH SAKIT UMUM</td>
    <td width="10">:</td>
  </tr>
  <tr>
    <td>ASY SYIFA SAMBI</td>
    <td>:</td>
  </tr>
  <tr>
    <td>Jl. Raya Bangak Simo Km. 7, Sambi, Boyolali 57376</td>
    <td>:</td>
  </tr>
   <tr>
    <td>Telp. (0276)3294459, Fax. (0276)3294459</td>
    <td>:</td>
  </tr>
</table>';
?>

</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="mhs-".$kode.".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
 require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
 try
 {
  $html2pdf = new HTML2PDF('P','LEGAL','mm', false, 'ISO-8859-15',array(30, 0, 20, 0));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>