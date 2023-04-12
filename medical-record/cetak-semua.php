
<?php



require_once('config.php');
 $kd_dokter = $_GET['dokter']; 
 $tanggal_awal = $_GET['tanggal_awal']; 
 $tanggal_akhir = $_GET['tanggal_akhir']; 
 $cara_bayar = $_GET['cara']; 

	
					 
require_once("../asset/plugins/dompdf/dompdf_config.inc.php");		
 $nama = "Cetak";						
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

.page_break {page-break-before: auto; }
</style>';

 $html .= '<body>';
 $select = query ("SELECT a.tgl_registrasi, b.nm_poli, c.keluhan, c.pemeriksaan, a.no_rawat,c.diagnosa_dr,a.no_rkm_medis,d.nm_pasien,c.tindakan_dr,c.tindakan_dr_lain,e.nm_dokter, f.ttd FROM reg_periksa a, poliklinik b, pemeriksaan_ralan c, pasien d , dokter e, sign f WHERE a.kd_dokter = '$kd_dokter' AND a.tgl_registrasi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND a.kd_dokter = e.kd_dokter  AND a.kd_pj = '$cara_bayar' AND a.kd_dokter = f.kd_dokter AND a.kd_poli = b.kd_poli AND a.no_rawat = c.no_rawat And a.no_rkm_medis = d.no_rkm_medis");
while ($hasil = fetch_array($select)) {
					$tmpil = "'";
					$tanggal = $hasil['tgl_registrasi'];
					$format = date('d-m-Y', strtotime($tanggal));
  $html .= '<div class="page_break"></div>
  <table width="100%" cellpadding="20px;">
  <table cellpadding="10px;">
    <tr class="bot" >
      <td colspan="2" class="bot" width="40%" style="border-right:0px;" align="center"><img src="../asset/images/PIN(blck).png" style="width:100px;height:100px" /></td>
      <td class="bot" style="border-right:solid 1px #00000; text-align:left; padding-right:120px;" ><p align="center"><font style="font-size: 28px"><b>RUMAH SAKIT UMUM</b><br><b>ASY SYIFA'.$tmpil.' SAMBI</b></font>
        <font style="font-size: 16px;"><br>Jl. Raya Bangak Simo Km. 7, Sambi, Boyolali 57376
         <br>Telp. (0276)3294459, Fax. (0276)3294459</font></p></td>
		
		 </tr>
		 
		 <tr>
		 <td colspan="3" align="center"><font style="font-size:24px; font-weight:bold;">SURAT BUKTI PELAYANAN RAWAT JALAN</font></td>
		 </tr>
		 <tr>
		 <td><font style="font-size:16px;">No RM</font></td><td style="width:2px;">:</td><td><font style="font-size:16px;">'.$hasil['no_rkm_medis'].'</font></td>
		 </tr>
		 <tr>
		 <td><font style="font-size:16px;">Nama Pasien</font></td><td>:</td><td><font style="font-size:16px;">'.$hasil['nm_pasien'].'</font></td>
		 </tr>
		 <tr>
		 <td><font style="font-size:16px;">Poliklinik</font></td><td>:</td><td><font style="font-size:16px;">'.$hasil['nm_poli'].'</font></td>
		 </tr>
		 <tr>
		 <td><font style="font-size:16px;">Dokter</font></td><td>:</td><td><font style="font-size:16px;">'.$hasil['nm_dokter'].'</font></td>
		 <tr>
		 <td><font style="font-size:16px;">Tanggal Kunjungan</font></td><td>:</td><td><font style="font-size:16px;">'.$format.'</font></td>
		 </tr>
		 </tr>
		
		 <tr>
		 <td class="pol"><font style="font-size:16px;">Diagnosa</font></td><td class="pol">:</td><td class="pol"><font style="font-size:16px;">'.$hasil['diagnosa_dr'].'</font></td>
		 </tr>
		 <tr>
		 <td class="pol"><font style="font-size:16px;">Tindakan</font></td><td class="pol">:</td><td class="pol"><font style="font-size:16px;">'.$hasil['tindakan_dr'].','.$hasil['tindakan_dr_lain'].'</font></td>
		 </tr>
		  <tr>
		 <td class="pol"><font style="font-size:16px;">Laborat</font></td><td class="pol">:</td><td class="pol"></td>
		 </tr>
		   <tr>
		 <td class="pol"><font style="font-size:16px;">RO</font></td><td class="pol">:</td><td class="pol"></td>
		 </tr>
		  <tr>
		 <td class="pol"><font style="font-size:16px;">USG</font></td><td class="pol">:</td><td class="pol"></td>
		 </tr>
		  <table style="padding:20px;">
		 <tr>
		 <td align="center" style="width:50%;"></td><td align="center"><font style="font-size:16px;">Tanda Tangan Dokter</font></td>
		 </tr>
		
		 <tr style="height:30px;">
		 <td align="center" style="height:30px;"></td><td  align="center" style="height:15px;"><br> <img src="../asset/images/sign/'.$hasil['ttd'].'" style="max-height: 150px;
	 
max-width: 200px;
width: 100px;
height: 100px;" />
<br><font style="font-size:16px;"('.$hasil['nm_dokter'].')</font></td>
		 </tr>
		 </table>
		 </table>';
}
$html .='</body>';
$dompdf = new DOMPDF();
$size = array(0,0,623,812);
$dompdf->set_paper($size);
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('bukti_pelayanan_'.$nama.'.pdf', array("Attachment"=>0)); 

?>