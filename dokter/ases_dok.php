
<?php


require_once("../asset/plugins/dompdf/dompdf_config.inc.php");
require_once('includes/config.php');
 $no_rawat = $_GET['no_rawat']; 
 $nama = str_replace(" ", "_", strtolower($_GET['no_rawat']));
	if(isset($_GET['no_rawat'])){
	$select = query("SELECT  a.no_rawat,a.umurdaftar,b.nm_pasien,b.agama,b.pnd,b.stts_nikah,b.pekerjaan,b.namakeluarga,b.keluarga,b.pekerjaanpj,b.no_rkm_medis,b.alamat,b.jk, b.tgl_lahir,c.nm_kec, d.nm_kab, e.alergi ,e.keluhan,e.pemeriksaan,e.suhu_tubuh,e.tensi,e.nadi,e.respirasi,e.tinggi,e.berat,e.gcs,e.periksa_khusus, e.asesmen_fung,e.nyeri,e.nutrisi,e.perencanaan,e.lila, e.riwayat,f.mens_pertama,f.siklus,f.hpmt,f.hpl,f.usia_keh,f.lama,f.par_g,f.par_p,f.par_a,f.anak_hidup, h.no_rawat, h.diagnosa_bidn, i.kd_dokter, i.nm_dokter FROM reg_periksa a, pasien b,kecamatan c,kabupaten d,pemeriksaan_ralan e, pemeriksaan_obg_ralan f, ro g, diagnosa_bidan h, dokter i WHERE a.kd_dokter = i.kd_dokter AND a.no_rawat ='".$no_rawat."' AND e.no_rawat = '".$no_rawat."' AND f.no_rawat = '".$no_rawat."' AND a.no_rkm_medis = b.no_rkm_medis AND b.kd_kec = c.kd_kec AND d.kd_kab = b.kd_kab");
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
      <td width="10%" style="border-right:0px;"><img src="images/PIN(blck).png" style="width:60px;height:60px" /></td>
      <td style="border-right:solid 1px #00000;"><font style="font-size: 14px"><b>RUMAH SAKIT UMUM</b><br><b>ASY SYIFA'.$tmpil.' SAMBI</b></font>
        <font style="font-size: 10px;"><br>Jl. Raya Bangak Simo Km. 7, Sambi, Boyolali 57376
         <br>Telp. (0276)3294459, Fax. (0276)3294459</font></td>

 
	<td width="20%">
      <font style="font-size: 11px;">
		<p>Nama <br> NO. RM<br>Tgl. Lahir /Umur<br>Alamat</font></td>
	  <td style="width:2px;"><font style="font-size: 11px;">:<br>:<br>:<br>:</td></font>
	  <td> <font style="font-size: 11px;">'.$hasil['nm_pasien'].'<br>'.$hasil['no_rkm_medis'].'<br>'.$hasil['tgl_lahir'].'
	  /'.$hasil['umurdaftar'].'Th ('.$hasil['jk'].')
	  <br>'.$hasil['alamat'].','.$hasil['nm_kec'].','.$hasil['nm_kab'].'</font></td></td></tr>
	  </table>
	 <table>
	  <tr>
	  <td class="a" colspan="3"><h3 align="center">ASESMEN AWAL OBSTETRI DAN GYNEKOLOGI</h3></td>
	  </tr>
	  </table
	  <table>
	  <tr>
	  <td style="width:10px;"><b></b></td>
	  <td><b>Anamnesa</b>
	  <tr>
	  <td style="width:5px;" valign="top">1.</td>
	  <td valign="top">Keluhan Utama :</td>
	  <td valign="top">'.$hasil['keluhan'].'</td>
	  <tr>
	  <td style="width:5px;">2.</td>
	  <td valign="top">Pemeriksaan :</td>
	  <td>'.$hasil['pemeriksaan'].'</td>
	  <tr>
	  <td style="width:5px;" valign="top">3.</td>
	  <td valign="top">Riwayat Penyakit Dahulu :</td>
	  <td>'.$hasil['riwayat'].'</td>
	  <tr>
	  <td style="width:4px;">4.</td>
	  <td>Riwayat Kehamilan</td>
	  <tr>
	  <td></td>
	  <td>'.$hasil['par_g'].'</td>
	  <td>'.$hasil['par_p'].'</td>
	  <td>'.$hasil['par_a'].'</td>
	  <td>'.$hasil['anak_hidup'].' Hidup</td>
	  </tr>
	  </tr>
	  </table>
	 	 <table>
	 <tr >
	 <td style="width:4px;"></td>
	<td class="a" style="width:4px;">NO</td>
	<td class="a">UMUR</td>
	<td class="a">CARA PERSALINAN</td>
	<td class="a">BERAT BADAN (gr)</td>
	<td class="a">TEMPAT PERSALINAN</td>
	<td class="a">KEADAAN SEKARANG</td>
	<td style="width:4px;"></td>
	</tr>';
	  $s = query("SELECT umur, cara_persalinan,bb,tmpt_pers,keadaan_sekarang FROM ro WHERE no_rawat ='".$no_rawat."'");
	  $no=1;
	  while ($u = fetch_array($s)) {
		  
			$html .= '
			<tr>
			<td style="width:4px;"></td>
			<td class="a" style="width:4px;">'.$no.'</td>
			<td class="a">'.$u['umur'].'</td>
			<td class="a">'.$u['cara_persalinan'].'</td>
			<td class="a">'.$u['bb'].'</td>
			<td class="a">'.$u['tmpt_pers'].'</td>
			<td class="a">'.$u['keadaan_sekarang'].'</td>
			<td style="width:4px;"></td>
			</tr>';
			$no++;
			}
	 
	  $html .= '</table>
	  <br><table>
			  <tr>
			  <td class="a" colspan="3" align="center"><b>Pemeriksaan Fisik</b></td>
			  </tr>
			</table>
			
			<table>
			<tr>
				  
				  <td style="width:5px;"><b></b></td>
				  <td><b>Pemeriksaan Umum</b></td>
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
			  
			  	  <td>Alergi</td>
			      <td>:</td>
			      <td>'.$hasil['alergi'].'</td>
			  <tr>
			  <td></td>
			  <td>HPMT</td>
			  <td>:</td>
			  <td>'.$hasil['hpmt'].'</td>
			  
			  <td>HPL</td>
			  <td>:</td>
			  <td>'.$hasil['hpl'].'</td>
			  
			  <td>Usia Kehamilan</td>
			  <td>:</td>
			  <td>'.$hasil['usia_keh'].'&nbsp;Minggu</td>
			 </tr>
			  </tr>
			 </table>
			 <table>
			  <tr>
			  <td class="a" colspan="3"><b></b></td>
			  </tr>
			</table>
			
			 <table>
	  <tr>
	  <td colspan="3" class="k"><b>Diagnosis Kerja</b></td>
	  <td colspan="3"><b>Tindakan</b></td>
	  </tr>
	  <tr>
	  <td >Diagnosis</td>
      <td style="width:2px;" >:</td>
      <td class="k">'.$hasil['diagnosa_dr'].'</td>
	  <td >Tindakan</td>
      <td style="width:2px;" >:</td>
      <td>'.$hasil['tindakan_dr'].'</td>
	  </tr>
	</table>
	 <table>
	 <tr>
		<td class="a" colspan="3" width="50%" align="right">			
	 <p>Boyolali, '.$date_time.' W.I.B</p>
	 <p>Dokter yang menyetujui&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
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