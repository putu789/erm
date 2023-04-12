<?php


require_once("../asset/plugins/dompdf/dompdf_config.inc.php");
require_once('includes/config.php');
 $no_rawat = $_GET['no_rawat']; 
 $nama = str_replace(" ", "_", strtolower($_GET['no_rawat']));
	if(isset($_GET['no_rawat'])){
	$select = query("SELECT  a.no_rawat,a.umurdaftar,a.kd_poli,a.tgl_registrasi,b.nm_pasien,b.agama,b.pnd,b.stts_nikah,b.pekerjaan,b.namakeluarga,b.keluarga,b.pekerjaanpj,b.no_rkm_medis,b.alamat,b.jk, b.tgl_lahir,c.nm_kec, d.nm_kab, e.alergi ,e.keluhan,e.pemeriksaan,e.suhu_tubuh,e.tensi,e.nadi,e.respirasi,e.tinggi,e.berat,e.gcs,e.periksa_khusus, e.asesmen_fung,e.nyeri,e.nutrisi,e.perencanaan,e.lila,e.tgl_perawatan, e.riwayat,e.tindakan_dr,e.diagnosa_dr,e.kontrol_ul_tg,f.mens_pertama,f.siklus,f.hpmt,f.hpl,f.usia_keh,f.lama,f.par_g,f.par_p,f.par_a,f.anak_hidup, h.no_rawat, h.diagnosa_bidn, i.kd_dokter, i.nm_dokter, j.kd_poli, j.nm_poli, k.kode_brng, k.jml, k.aturan_pakai, k.no_resep, l.nama_brng FROM reg_periksa a, pasien b,kecamatan c,kabupaten d,pemeriksaan_ralan e, pemeriksaan_obg_ralan f, ro g, diagnosa_bidan h, dokter i, poliklinik j, resep_dokter k, databarang l, resep_obat m WHERE a.kd_dokter = i.kd_dokter AND k.kode_brng = l.kode_brng AND k.no_resep = m.no_resep AND a.kd_poli = j.kd_poli AND a.no_rawat ='".$no_rawat."' AND e.no_rawat = '".$no_rawat."' AND f.no_rawat = '".$no_rawat."' AND a.no_rkm_medis = b.no_rkm_medis AND b.kd_kec = c.kd_kec AND d.kd_kab = b.kd_kab");
				while ($hasil = fetch_array($select)) {
					 			
								$tanggal = $hasil['tgl_perawatan'];
								$format = date('d-m-Y', strtotime($tanggal));
								
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
								$create = date_create($data['2']);
					$tanggalan = $hasil['tgl_lahir'];
					$tgl = date("d-m-Y", $tanggalan);
					$tmpil = "'";
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
<head></head>
<body>
  <table width="100%">
    <tr >
      <td width="10%" style="border-right:0px;"><img src="../asset/images/PIN(blck).png" style="width:60px;height:60px" /></td>
      <td style="border-right:solid 1px #00000;"><font style="font-size: 16px"><b>RUMAH SAKIT UMUM</b><br><b>ASY SYIFA'.$tmpil.' SAMBI</b></font>
        <font style="font-size: 10px;"><br>Jl. Raya Bangak Simo Km. 7, Sambi, Boyolali 57376
         <br>Telp. (0276)3294459, Fax. (0276)3294459</font></td>
		 
		 <td width="20%">
      <font style="font-size: 11px;">
		<p>Nama <br> NO. RM<br>Tgl. Lahir /Umur<br>Alamat<br>Tanggal Kunjungan<br>Poli</font></td>
	  <td style="width:2px;"><font style="font-size: 11px;">:<br>:<br>:<br>:<br>:<br>:</td></font>
	  <td> <font style="font-size: 11px;">'.$hasil['nm_pasien'].'<br>'.$hasil['no_rkm_medis'].'<br>'.$hasil['tgl_lahir'].'
	  /'.$hasil['umurdaftar'].'Th ('.$hasil['jk'].')
	  <br>'.$hasil['alamat'].','.$hasil['nm_kec'].','.$hasil['nm_kab'].'<br>'.$hasil['tgl_registrasi'].'<br>'.$hasil['nm_poli'].'</font></td></td></tr>
	  </table>
	   <table>
	  <tr>
	  <td class="a" colspan="3"><h3 align="center">RINGKASAN PELAYANAN PASIEN RAWAT JALAN</h3></td>
	  </tr>
	  </table>
	   <table>
	  <tr>
	  <td style="width:10px;"><b></b></td>
	  <td valign="top"><b>Anamnesa</b></td>
	  <td>'.$hasil['keluhan'].'</td>
	  <tr>
	  <td style="width:10px;"><b></b></td>
	  <td valign="top"><b>Pemeriksaan</b></td>
	  <td>'.$hasil['pemeriksaan'].'</td>
			  </tr>
			 </table>
			 
			 <table>
			  <tr>
			  <td class="a" colspan="3" align="center"><b></b></td>
			  </tr>
			</table>
			
			<table>
			<tr>
				  
				  <td style="width:5px;"><b></b></td>
				  <td><b>Pemeriksaan Fisik</b></td>
				  <td></td>
			  <tr>
				  <td></td>
				  <td>Tensi</td>
				  <td>:</td>
				  <td>'.$hasil['tensi'].'</td>
			
				  <td>Nadi</td>
				  <td>:</td>
				  <td>'.$hasil['nadi'].'</td>
			  
				  <td>Respirasi</td>
				  <td>:</td>
				  <td>'.$hasil['respirasi'].'</td>
				  
				  <td>Suhu Tubuh</td>
				  <td>:</td>
				  <td>'.$hasil['suhu_tubuh'].'&nbsp;&deg;C</td>
				  <tr>
				  <td></td>				
			  	  <td>Berat Badan</td>
			      <td>:</td>
			      <td>'.$hasil['berat'].'&nbsp;Kg</td>
				  
			      <td>IMT</td>
			  	  <td>:</td>
			      <td>'.$angka_format.'&nbsp;'.$st.'</td>
			 </tr>
			  </tr>
			 </table><br>
			 <table>
			  <tr>
	  <td style="width:10px;"><b></b></td>
	  <td valign="top"><b>Diagnosa</b></td>
	  <td>'.$hasil['diagnosa_dr'].'</td>
	  <tr>
	   <td style="width:10px;"><b></b></td>
	  <td valign="top"><b>Tindakan</b></td>
	  <td>'.$hasil['tindakan_dr'].'</td>
	  <br>
	  <tr>
	   <td style="width:10px;"><b></b></td>
	  <td><b>Tanggal Kontrol Ulang</b></td>
	  <td>'.$hasil['kontrol_ul_tg'].'</td>
	  <tr>
	  <br>
	  <td style="width:10px;"><b></b></td>
	  <td><b>Terapi Obat</b></td>
	  <table class="table table-striped">
	 <tr >
	 <td style="width:0px;"></td>
	<td class="a" style="width:4px;">NO</td>
	<td class="a">Nama Obat</td>
	<td class="a">Jumlah</td>
	<td style="width:0px;"></td>
	</tr>';
	  $s = query("SELECT a.kode_brng, a.jml, a.aturan_pakai,b.nama_brng, a.no_resep,d.nm_dokter FROM resep_dokter a, databarang b, dokter d, resep_obat c WHERE c.kd_dokter=d.kd_dokter AND a.kode_brng = b.kode_brng AND c.no_resep = a.no_resep AND c.no_rawat = '".$no_rawat."'");
	  $no=1;
	  while ($u = fetch_array($s)) {
		  
			$html .= '
			<tr>
			<td style="width:0px;"></td>
			<td class="a" style="width:4px;">'.$no.'</td>
			<td class="a">'.$u['nama_brng'].'</td>
			<td class="a">'.$u['jml'].'</td>
			<td style="width:0px;"></td>
			</tr>';
			$no++;
			}
	 
	  $html .= '</table>
	  <tr>
	  <td style="width:10px;"><b></b></td>
	  <td><b></b></td>
	  </tr>
	  </table>
	   <table>
	 <tr>
		<td class="a" colspan="3" width="50%" align="right">			
	 <p>Boyolali, '.$format.'</p>
	 <p>Dokter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
	 <br>
	 <br>
	 <br>
	 <br>
	 <p>('.$hasil['nm_dokter'].')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
	 
	  </tr>
	  </table>
	  
';


  }
}
$dompdf = new DOMPDF();
$dompdf->set_paper("F4");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('asesment_'.$nama.'.pdf', array("Attachment"=>0)); 
 
?>