<?php
require_once("../asset/plugins/dompdf/dompdf_config.inc.php");
require_once('config.php');
 $no_rawat = $_GET['no_rawat']; 
 $nama = str_replace(" ", "_", strtolower($_GET['no_rawat']));
	if(isset($_GET['no_rawat'])){
	$select = query("SELECT  a.no_rawat,a.umurdaftar,b.nm_pasien,b.agama,b.pnd,b.stts_nikah,b.pekerjaan,b.namakeluarga,b.keluarga,b.pekerjaanpj,b.no_rkm_medis,b.alamat,b.jk, b.tgl_lahir,c.nm_kec, d.nm_kab, e.alergi ,e.keluhan,e.suhu_tubuh,e.tensi,e.nadi,e.respirasi,e.tinggi,e.berat,e.gcs,e.periksa_khusus, e.tgl_perawatan,e.asesmen_fung,e.nyeri,e.nutrisi,e.perencanaan,e.lila, e.riwayat,e.riwayat_lain,e.pemer,e.intervensi,e.diagnosa_dr, h.no_rawat, h.kondisi,h.skor,h.kategori,i.kd_dokter, i.nm_dokter FROM reg_periksa a, pasien b,kecamatan c,kabupaten d,pemeriksaan_ralan e, resiko_jatuh h, dokter i WHERE a.kd_dokter = i.kd_dokter AND a.no_rawat ='".$no_rawat."' AND e.no_rawat = '".$no_rawat."' AND h.no_rawat = '".$no_rawat."' AND a.no_rkm_medis = b.no_rkm_medis AND b.kd_kec = c.kd_kec AND d.kd_kab = b.kd_kab");
				while ($hasil = fetch_array($select)) {
					$bb=$hasil['berat'];
								$tb=$hasil['tinggi']/100;
								$imt=$bb/($tb*$tb);
								$angka_format = number_format($imt,2);
								
								$st="";
								if($imt<18.5){
									$st="(Kurus)";
								}
								else if($imt>=18.5&&$imt<=24.9) {
									$st="(Normal)";
								}
							
								else if($imt>=25&&$imt<=29.9) {
									$st="(Overweight)";
								}
								else if($imt>=30) {
									$st="(Obesitas)";
								}
								$create = date_create($hasil['tgl_perawatan']);
					$tanggalan = $hasil['tgl_lahir'];
					$tgl = date("d-m-Y", $tanggalan);
					$tmpil = "'";
					$tanggal = $hasil['tgl_perawatan'];
					$format = date('d-m-Y', strtotime($tanggal));
$html =
  '
  <style>
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



}
</style>
<html>
<head>
<title>Asesmen - '.$hasil['nm_pasien'].'</title>
</head>
<body>
  <table width="100%" height="100%">
    <tr >
      <td width="10%" style="border-right:0px;"><img src="../asset/images/PIN(blck).png" style="width:60px;height:60px" /></td>
      <td style="border-right:solid 1px #00000;"><font style="font-size: 14px"><b>RUMAH SAKIT UMUM</b><br><b>ASY SYIFA'.$tmpil.' SAMBI</b></font>
        <font style="font-size: 10px;"><br>Jl. Raya Bangak Simo Km. 7, Sambi, Boyolali 57376
         <br>Telp. (0276)3294459, Fax. (0276)3294459</font></td>

 
	  <td width="20%">
      <font style="font-size: 12px;">
		<p>Nama <br> NO. RM<br>Tgl. Lahir /Umur<br>Alamat</font></td>
	  <td style="width:2px;"><font style="font-size: 12px;">:<br>:<br>:<br>:</td></font>
	  <td> <font style="font-size: 12px;">'.$hasil['nm_pasien'].'<br>'.$hasil['no_rkm_medis'].'<br>'.$hasil['tgl_lahir'].'
	  /'.$hasil['umurdaftar'].'Th ('.$hasil['jk'].')
	  <br>'.$hasil['alamat'].','.$hasil['nm_kec'].','.$hasil['nm_kab'].'</font></td></td></tr>
	  </table>
	  <table>
	  <tr>
      <td class="a"><font style="font-size: 12px;">Bangsal / Kelas : ......</font></td>
      <td class="a" ><font style="font-size: 12px;">Tanggal Asesmen : '.$format.'</font></td>
	  <td class="a"><font style="font-size: 12px;">Pukul : '.$hasil['jam_rawat'].'</font></td>
	  </tr>
	   <tr>
	  <td class="a" colspan="3"><font style="font-size: 18px;"><h3 align="center">PENGKAJIAN AWAL MEDIS PASIEN RAWAT INAP</h3></font></td>
	  </tr>
	  <tr>
	   <td colspan="3">
	  <font style="font-size: 14px;">Auto Anamnase : '.$hasil['keluhan'].'</font>
	  <br>
	  <br>
	  <br>
	  <font style="font-size: 14px;">Riwayat Penyakit : '.$hasil['riwayat'].','.$hasil['riwayat_lain'].'</font>
		<br>
	  <br>
	  <br>
	  <font style="font-size: 14px;">Pemeriksaan : '.$hasil['pemeriksaan'].'</font>
	  <br>
	  <br>
	  <table style="width:100%;">
	  <tr>
	  <td style="width:50%;"></td>
	  <td><font style="font-size: 14px;"><b><u>Vital Sign</u></b></font><br>
	  <font style="font-size: 14px;">Tensi : '.$hasil['tensi'].'  mm/Hg</font>
	  <br>
	  <font style="font-size: 14px;">Nadi  : '.$hasil['nadi'].'  /Mnt</font>
	  <br>
	  <font style="font-size: 14px;">Suhu  : '.$hasil['suhu_tubuh'].' &deg;C</font>
	  <br>
	  <font style="font-size: 14px;">Nafas : '.$hasil['respirasi'].' /Mnt</font>
	  <br>
	  <font style="font-size: 14px;">BB    : '.$hasil['berat'].' Kg</font>
	  </td>
	  </tr>
	  </table>
	  <br>
	  <font style="font-size: 14px;">Diagnosa Medis : '.$hasil['diagnosa_dr'].'</font>
	  <br>
	  <br>
	  <br>
	  <font style="font-size: 14px;">Intervensi / Terapi : '.$hasil['intervensi'].'</font>
	  
	  
	  </td>
	  </tr>
	  <table style="width:100%">
	  <tr>
	  <td style="width:65%"></td>
	  <td style="width:35%" align="center"><font style="font-size: 14px;">Dokter<br><br />
	  <br><br /><br><br />
	  ('.$hasil['nm_dokter'].')</font>
	  </td>
	 
	  
	  </table>
	  </table>
	 
	 
	  ';
				
}
	}
$dompdf = new DOMPDF();
$dompdf->set_paper("legal","potrait");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('asesment_'.$nama.'.pdf', array("Attachment"=>0)); 
 
?>