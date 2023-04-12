
<?php


require_once("../asset/plugins/dompdf/dompdf_config.inc.php");
require_once('config.php');
 $no_rawat = $_GET['no_rawat']; 
 $nama = str_replace(" ", "_", strtolower($_GET['no_rawat']));
	if(isset($_GET['no_rawat'])){
	$select = query ("SELECT a.tgl_registrasi, b.nm_poli, c.keluhan, c.pemeriksaan, a.no_rawat,c.diagnosa_dr,a.no_rkm_medis,d.nm_pasien,e.nm_dokter,c.tindakan_dr,c.tindakan_dr_lain FROM reg_periksa a, poliklinik b, pemeriksaan_ralan c, pasien d, dokter e WHERE a.no_rawat = '$no_rawat' AND a.kd_poli = b.kd_poli AND a.no_rawat = c.no_rawat And a.no_rkm_medis = d.no_rkm_medis And a.kd_dokter = e.kd_dokter");
				while ($hasil = fetch_array($select)) {
					$tmpil = "'";
					$tanggal = $hasil['tgl_registrasi'];
					$format = date('d-m-Y', strtotime($tanggal));
					 
								
$html =
  '<style>
 body{
	 border:#000 solid 1px;
 }
table {
    
    border-collapse: collapse;
    width: 100%;
}

td, th {
   
    text-align: left;
    padding: 5px;
	font-size:11px;
}
.a{
	border: solid 1px #00000 ;
}
.k {
	 border-right:solid 1px #00000;
}
.bot {
	border-bottom: solid 1px #00000;
}
.pol{
	border-top :solid 1px #00000;
	border-bottom: solid 1px #00000; 
}


}
</style>
<html>
<head></head>
<body>
  <table width="100%" cellpadding="20px;">
  <table cellpadding="10px;">
    <tr class="bot" >
      <td colspan="2" class="bot" width="70%" style="border-right:0px;" align="right"><img src="../asset/images/PIN(blck).png" style="width:100px;height:100px" /></td>
      <td class="bot" style="border-right:solid 1px #00000; text-align:left; padding-right:120px;" ><p align="center"><font style="font-size: 20px"><b>RUMAH SAKIT UMUM</b><br><b>ASY SYIFA'.$tmpil.' SAMBI</b></font>
        <font style="font-size: 12px;"><br>Jl. Raya Bangak Simo Km. 7, Sambi, Boyolali 57376
         <br>Telp. (0276)3294459, Fax. (0276)3294459</font></p></td>
		
		 </tr>
		 
		 <tr>
		 <td colspan="3" align="center"><font style="font-size:18px; font-weight:bold; text-decoration:underline;">SURAT PERINTAH RAWAT INAP</font><br> <font style="font-size:18px; font-weight:bold;"><i>(ADMISION NOTE)</i></font></td>
		 </tr>
		 <tr>
		 <td><font style="font-size:14px;">Nama </font></td><td style="width:2px;">:</td><td><font style="font-size:14px;">'.$hasil['nm_pasien'].'</font></td>
		 </tr>
		 <tr>
		 <td><font style="font-size:14px;">No RM</font></td><td>:</td><td><font style="font-size:14px;">'.$hasil['no_rkm_medis'].'</font></td>
		 </tr>
		  <tr>
		 <td><font style="font-size:14px;">Tanggal Masuk</font></td><td>:</td><td><font style="font-size:14px;">'.$format.'</font></td>
		 </tr>
		 <tr>
		 <td><font style="font-size:16px;">Diagnosa</font></td><td">:</td><td><font style="font-size:14px;">'.$hasil['diagnosa_dr'].'</font></td>
		 </tr>
		 
		 <tr>
		 <td><font style="font-size:14px;">Dokter yang Merawat</font></td><td>:</td><td><font style="font-size:16px;">'.$hasil['nm_dokter'].'</font></td>
		 </tr>
		
		
		 
		
		  
		  <table style="padding:20px;">
		 <tr>
		 <td align="center" style="width:50%;"></td><td align="center"><font style="font-size:16px;">Tanda Tangan Dokter</font></td>
		 </tr>
		
		 <tr style="height:30px;">
		 <td align="center" style="height:30px;"></td><td  align="center" style="height:15px;"><br><br><br><br><br>............</td>
		 </tr>
		 </table>
		 </table>
</table>
</body>
</html>
';
}
}
$dompdf = new DOMPDF();
$dompdf->set_paper("legal");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('bukti_pelayanan_'.$nama.'.pdf', array("Attachment"=>0)); 
 
?>