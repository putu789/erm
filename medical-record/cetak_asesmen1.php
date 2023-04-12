<?php
require_once("../asset/plugins/dompdf/dompdf_config.inc.php");
require_once('config.php');
 $no_rawat = $_GET['no_rawat']; 
 $nama = str_replace(" ", "_", strtolower($_GET['no_rawat']));
	if(isset($_GET['no_rawat'])){
	$select = query("SELECT  a.no_rawat,a.umurdaftar,b.nm_pasien,b.agama,b.pnd,b.stts_nikah,b.pekerjaan,b.namakeluarga,b.keluarga,b.pekerjaanpj,b.no_rkm_medis,b.alamat,b.jk, b.tgl_lahir,c.nm_kec, d.nm_kab, e.alergi ,e.keluhan,e.suhu_tubuh,e.tensi,e.nadi,e.respirasi,e.tinggi,e.berat,e.gcs,e.periksa_khusus, e.asesmen_fung,e.nyeri,e.nutrisi,e.perencanaan,e.lila, e.riwayat,e.pemer, h.no_rawat, h.kondisi,h.skor,h.kategori,i.kd_dokter, i.nm_dokter FROM reg_periksa a, pasien b,kecamatan c,kabupaten d,pemeriksaan_ralan e, resiko_jatuh h, dokter i WHERE a.kd_dokter = i.kd_dokter AND a.no_rawat ='".$no_rawat."' AND e.no_rawat = '".$no_rawat."' AND h.no_rawat = '".$no_rawat."' AND a.no_rkm_medis = b.no_rkm_medis AND b.kd_kec = c.kd_kec AND d.kd_kab = b.kd_kab");
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
	  <td class="a" colspan="3"><h3 align="center">ASESMEN AWAL</h3></td>
	  </tr>
	  <tr>
	  <td colspan="3"><p align="left"><b>ALERGI :</b> '.$hasil['alergi'].'</p></td>
	  </tr>
	  <tr>
	  <td colspan="3"></td>
	  </tr>
	   <tr>
	  <td class="a" colspan="3"><b>A. DATA PASIEN MASUK RAWAT INAP</b></td>
	  </tr>
      </table>
	  
	  <table>
	  <tr>
	  <td colspan="3" class="k"><b>Identitas Pasien</b></td>
	  <td colspan="3"><b>Identitas Suami</b></td>
	  </tr>
	  <tr>
	  <td >Nama</td>
      <td style="width:2px;" >:</td>
      <td class="k">'.$hasil['nm_pasien'].'</td>
	  <td >Nama</td>
      <td style="width:2px;" >:</td>
      <td>'.$hasil['namakeluarga'].'</td>
	  </tr>
	  <tr>
	  <td >Tanggal Lahir</td>
      <td style="width:2px;" >:</td>
      <td class="k">'.$hasil['tgl_lahir'].'</td>
	  <td >Tanggal Lahir</td>
      <td style="width:2px;" >:</td>
      <td>-</td>
	  </tr>
	  <tr>
	  <td >Agama</td>
      <td style="width:2px;" >:</td>
      <td class="k">'.$hasil['agama'].'</td>
	  <td >Agama</td>
      <td style="width:2px;" >:</td>
      <td>-</td>
	  </tr>
	  <tr>
	  <td >Pendidikan</td>
      <td style="width:2px;" >:</td>
      <td class="k">'.$hasil['pnd'].'</td>
	  <td >Pendidikan</td>
      <td style="width:2px;" >:</td>
      <td>-</td>
	  </tr>
	  <tr>
	  <td >Pekerjaan</td>
      <td style="width:2px;" >:</td>
      <td class="k">'.$hasil['pekerjaan'].'</td>
	  <td >Pekerjaan</td>
      <td style="width:2px;" >:</td>
      <td>'.$hasil['pekerjaanpj'].'</td>
	  </tr>
      </table>
	  <table>
	  <tr>
	  <td class="a" colspan="3"><b>B. DATA SUBYEKTIF</b></td>
	  </tr>
	  </table>
	  
	  <table>
	  <tr>
	  <td style="width:4px;"><b>1</b></td>
	  <td><b>Keluhan Utama</b>
	  <tr>
	  <td></td>
	  <td>'.$hasil['keluhan'].'</td>
	  </tr>
	  </td>
	  </tr>
	  <tr>
	  <td style="width:4px;"><b>2</b></td>
	  
	  <tr>
	  <td style="width:4px;"><b>3</b></td>
	  <td><b>Status Perkawinan</b>
	  <tr>
	  <td></td>
	  <td>'.$hasil['stts_nikah'].'</td>
	  </tr>
	  </td>
	  </tr>
	   
	  </tr>
	  </table>
	 
	
			<table>
			  <tr>
			  <td class="a" colspan="3"><b>C. DATA OBYEKTIF</b></td>
			  </tr>
			</table>
			
				
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
				  <td style="width:10px;"><b>2</b></td>
				  <td><b>Pemeriksaan Khusus</b>
				  <tr>
				  <td></td>
				  <td width="14%">Pemeriksaan Khusus :</td>
				  <td width="30%">'.$hasil['periksa_khusus'].'</td>
				  <td width="14%">Asesment Fungsional :</td>
				  <td width="30%">'.$hasil['asesmen_fung'].'</td>
				  </tr>
				  </table>
	  <table>
	  <tr>
	  <td class="a" colspan="3" width="35%"><b>D. RESIKO JATUH</b></td>
	  <td class="a">'.$hasil['kondisi'].'&nbsp;'.$hasil['skor'].'&nbsp;'.$hasil['kategori'].'</td>
	  </tr>
	  </table>
	  <table>
	  <tr>
	  <td class="a" colspan="3" width="35%"><b>E. PEMERIKSAAN NYERI</b></td>
	  <td class="a">'.$hasil['nyeri'].'</td>
	  </tr>
	  </table>
	  <table>
	  <tr>
	  <td class="a" colspan="3" width="35%"><b>F. Edukasi</b></td>
	  <td class="a">'.$hasil['nutrisi'].'</td>
	  </tr>
	  </table>		  
		<table>
	  <tr>
	  <td class="a" colspan="3" width="35%"><b>G. DIAGNOSA KEBIDANAN DAN MASALAH</b></td>
	  <td class="a">'.$hasil['diag_bid'].'</td>
	  </tr>
	  </table>
	  <table>
	  <tr>
	  <td class="a" colspan="3" width="35%"><b>H. PERENCANAAN DAN KEBUTUHAN</b></td>
	  <td class="a">'.$hasil['perencanaan'].'</td>
	  </tr>
	  </table>
	
				  <table>
				  <tr>
	  				<td class="a" colspan="3"></td>
			<tr>
<table width="100%" align="right">
		<tr>
		
		<td class="a" colspan="3" width="50%" align="right">			
	  <font style="font-size: 14px;">
	  <p>Boyolali,'.date_format($create,"d-F-Y").'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>Perawat yang mengkaji&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br><br><br>';
	  $s = query("SELECT  b.nama FROM pemeriksaan_ralan a, petugas b WHERE a.no_rawat ='".$no_rawat."' AND a.pemer = b.nip");
				$h = fetch_array($s);
	 $html .= '<br>'.$h['nama'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
	  </tr>
	  </table>
	 
	  ';
}
	}
$dompdf = new DOMPDF();
$dompdf->set_paper("F4");
$dompdf->load_html($html);
$canvas = $dompdf->get_canvas();
$font = Font_Metrics::get_font("helvetica", "bold");
$dompdf->render();
$dompdf->stream('asesment_'.$nama.'.pdf', array("Attachment"=>0)); 
 
?>