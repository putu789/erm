<?php
require_once("../asset/plugins/dompdf/dompdf_config.inc.php");
require_once('config.php');
 $no_rawat = $_GET['no_rawat']; 
 $nama = str_replace(" ", "_", strtolower($_GET['no_rawat']));
	if(isset($_GET['no_rawat'])){
	$select = query("SELECT  a.no_rawat,a.umurdaftar,b.nm_pasien,b.agama,b.pnd,e.pemeriksaan,e.diagnosa_dr,e.intervensi,b.stts_nikah,b.pekerjaan,b.namakeluarga,b.keluarga,b.pekerjaanpj,b.no_rkm_medis,b.alamat,e.tgl_perawatan,b.jk, b.tgl_lahir,c.nm_kec, d.nm_kab, e.alergi ,e.keluhan,e.suhu_tubuh,e.tensi,e.nadi,e.respirasi,e.tinggi,e.berat,e.gcs,e.periksa_khusus, e.asesmen_fung,e.nyeri,e.nutrisi,e.perencanaan,e.lila, e.riwayat,e.pemer,f.mens_pertama,f.siklus,f.hpmt,f.hpl,f.usia_keh,f.lama,f.par_g,f.par_p,f.par_a,f.anak_hidup,f.diag_bid, h.no_rawat, h.kondisi,h.skor,h.kategori,i.kd_dokter,j.ttd, i.nm_dokter FROM reg_periksa a, pasien b,kecamatan c,kabupaten d,pemeriksaan_ralan e, pemeriksaan_obg_ralan f, ro g, resiko_jatuh h, dokter i,sign j WHERE a.kd_dokter = i.kd_dokter AND a.no_rawat ='".$no_rawat."' AND e.no_rawat = '".$no_rawat."' AND f.no_rawat = '".$no_rawat."' AND h.no_rawat = '".$no_rawat."' AND a.no_rkm_medis = b.no_rkm_medis AND a.kd_dokter = j.kd_dokter AND b.kd_kec = c.kd_kec AND d.kd_kab = b.kd_kab");
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
					
					$tanggal = $hasil['tgl_perawatan'];
					$format = date('d-m-Y', strtotime($tanggal));
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
	  <td class="a">DPJB : .......</td>
      <td class="a">Bangsal / Kelas : ......</td>
      <td class="a" >Tanggal / Pukul : .......</td>
	  </tr>
	   <tr>
	  <td class="a" colspan="3"><h3 align="center">ASESMEN AWAL MEDIS OBSTETRI GINEKOLOGI</h3></td>
	  </tr>
	  
      </table>
	  
	  <table>
	  <tr>
	  <td style="width:4px;"><b></b></td>
	  <td><b>Keluhan Utama</b>
	  <tr>
	  <td></td>
	  <td>'.$hasil['keluhan'].'</td>
	  </tr>
	  </td>
	  </tr>
	  <tr>
	  <td style="width:4px;"><b></b></td>
	  <td><b>Riwayat</b>
	  <tr>
	  <td></td>
	  <td>Menarche </td>
	  <td>:</td>
	   <td>'.$hasil['riwayat'].','.$hasil['riwayat_lain'].'</td>
	   <td></td>
	  <td>HPHT </td>
	  <td>:</td>
	   <td>'.$hasil['hpmt'].'</td>
	  </tr>
	  <tr>
	  <td></td>
	  <td>Siklus </td>
	  <td>:</td>
	   <td>'.$hasil['siklus'].'</td>
	   <td></td>
	  <td>HPL </td>
	  <td>:</td>
	   <td>'.$hasil['hpl'].'</td>
	  </tr>
	  <tr>
	  <td></td>
	  <td>Lama </td>
	  <td>:</td>
	   <td>'.$hasil['lama'].'</td>
	   <td></td>
	  <td>Umur Kehamilan </td>
	  <td>:</td>
	   <td>'.$hasil['usia_keh'].'</td>
	  </tr>
	  </td>
	  </tr>
	  <tr>
	  <td style="width:4px;"><b></b></td>
	  <td><b>Status Perkawinan</b>
	  <tr>
	  <td></td>
	  <td>'.$hasil['stts_nikah'].'</td>
	  </tr>
	  </td>
	  </tr>
	   <tr>
	  <td style="width:4px;"><b></b></td>
	  <td><b>Riwayat Kehamilan</b>
	  <tr>
	  <td></td>
	  <td width="20%">Paritas :</td>
	  <td width="20%">'.$hasil['par_g'].''.$hasil['par_p'].''.$hasil['par_a'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$hasil['anak_hidup'].'</td>
	  <td></td>
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
	  $s = query("SELECT umur, cara_persalinan,bb,tmpt_pers,keadaan_sekarang FROM ro WHERE no_rkm_medis ='".$hasil['no_rkm_medis']."'");
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
			
				
			</body>
	  
  			
				
	
	
	<table>
			<tr>
				  <td style="width:4px;"><b>1</b></td>
				  <td><b>Pemeriksaan Umum</b>
			  <tr>
				  <td></td>
				  <td>Suhu Tubuh</td>
				  <td>:</td>
				  <td>'.$hasil['suhu_tubuh'].'&nbsp;'.'&deg;'.C.'</td>
			
				  <td>Tensi</td>
				  <td>:</td>
				  <td>'.$hasil['tensi'].'&nbsp;'.mmHg.'</td>
			  
				  <td>Nadi</td>
				  <td>:</td>
				  <td>'.$hasil['nadi'].'&nbsp;'.x.'/'.menit.'</td>
				  <tr>
				  <td></td>
				  <td>Respirasi</td>
				  <td>:</td>
				  <td>'.$hasil['respirasi'].'&nbsp;'.x.'/'.menit.'</td>
				
			  	  <td>Tinggi Badan</td>
			      <td>:</td>
			      <td>'.$hasil['tinggi'].'&nbsp;'.Cm.'</td>
			
			      <td>Berat Badan</td>
			      <td>:</td>
			      <td>'.$hasil['berat'].'&nbsp;'.Kg.'</td>
			  <tr>
				<td></td>
			  <td>GCS</td>
			  <td>:</td>
			  <td>'.$hasil['gcs'].'</td>
			  
			  <td>IMT</td>
			  <td>:</td>
			  <td>'.$angka_format.'&nbsp;'.$st.'</td>
			  
			  <td>LILA</td>
			  <td>:</td>
			  <td>'.$hasil['lila'].'&nbsp;'.Cm.'</td>
			  </tr>
			 </table>
<br>
			
	  
	  <table>
	  <tr>
	  <td class="a" colspan="3" width="35%"><b>PEMERIKSAAN</b></td>
	  <td class="a">'.$hasil['pemeriksaan'].'</td>
	  </tr>
	  </table>
	  <table>
	  <tr>
	  <td class="a" colspan="3" width="35%"><b>DIAGNOSIS</b></td>
	  <td class="a">'.$hasil['diagnosa_dr'].'</td>
	  </tr>
	  </table>
	  <table>
	  <tr>
	  <td class="a" colspan="3" width="35%"><b>Intervensi / Terapi</b></td>
	  <td class="a">'.$hasil['intervensi'].'</td>
	  </tr>
	  </table>
	
<table style=""  width="100%" align="right">
		<tr>
		<td style="width:70%"></td>
		<td style="width:30%"  align="center">			
	  <font style="font-size: 14px;">
	  Boyolali,'.$format.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
	  Dokter<br>
	  <img width="200px" height="100px" src="../asset/images/sign/'.$hasil['ttd'].'">
	  ';
	 
	 $html .= '<br>'.$hasil['nm_dokter'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
	  </tr>
	  </table>
	 
	  ';
}
	}
$dompdf = new DOMPDF();
$dompdf->set_paper("legal");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('asesment_'.$nama.'.pdf', array("Attachment"=>0)); 
 
?>