<?php
session_start();
require('../config.php');
$poan = $_GET['no_resep'];
if(isset($_GET['no_resep'])){
		$pilih ="SELECT a.kode_brng, a.jml, a.aturan_pakai,b.nama_brng, a.no_resep,d.nm_dokter FROM resep_dokter a, databarang b, dokter d, resep_obat c WHERE c.kd_dokter=d.kd_dokter AND a.kode_brng = b.kode_brng AND a.no_resep ='".$poan."'";
		$result = query($pilih);
		$set = fetch_array($result);
		echo "<table style='margin-top:0px;' width=450>
				<tr>
				<td align='center'><img src='../../asset/images/PIN(blck).png' width='80px;' height='80px;'/>
				</td>
				<td align='center'><b>RUMAH SAKIT UMUM<br> 
				ASY SYIFA' SAMBI</b><br>
				Jl. Raya Bangak -Simo Km.7,Sambi, Boyolali 57376<br>
				Telp. (0276)3294459, Fax.(0276)3294459</td>
				</tr>
				<tr><td align='center' colspan=2 style='border-top:5px double;></td></tr>";

				$dok = "SELECT nm_dokter FROM dokter WHERE kd_dokter = '".$_SESSION['username']."'";
				$create = date_create($data['2']);
				$ter = query($dok);
				$h = fetch_array($ter);
				echo "<tr><td align='center' style='padding:0px;' colspan=2>Resep Dokter : ".$h['nm_dokter']."</td></tr>"."<tr><td align='right' style='padding:0px;' colspan=2>Sambi, ".date_format($create,"d-F-y")."</td></tr>";
							
				$select = query("SELECT a.kode_brng, a.jml, a.aturan_pakai, a.no_resep, b.nama_brng FROM resep_dokter a, databarang b WHERE a.kode_brng=b.kode_brng AND no_resep ='".$poan."'");
				while ($hasil = fetch_array($select)) {
				echo "<tr><td colspan=1><p style='width=50%;' align='left'>"."<font color='#000000'>R/</font>"."<tr><td colspan=3><p style='width=100%;' align='left'>".$hasil['nama_brng']."<span style='padding-left:10%;'>&nbsp;No.&nbsp;".str_replace("1", "I", str_replace("2", "II", str_replace("3", "III", str_replace("4", "IV", str_replace("5", "V", str_replace("6", "VI", str_replace("7", "VII", str_replace("8", "VIII", str_replace("9", "IX", str_replace("10", "X", str_replace("11", "XI", str_replace("12", "XII", str_replace("13", "XIII", str_replace("14", "XIV", str_replace("15", "XV", str_replace("16", "XVI", str_replace("17", "XVII", str_replace("18", "XVIII", str_replace("19", "XIX", str_replace("20", "XX", $hasil['jml']))))))))))))))))))))."<tr><td colspan=2><p style='width=100%;' align='left'>"."<span style='padding-left:20%;'>&nbsp;S.&nbsp;".str_replace("X", "dd", str_replace("Sebelum Makan", "a.c.", str_replace("Sesudah Makan", "p.c.", $hasil['aturan_pakai'])))."<span style='padding-left:1%;'>"."</span></p></td></tr>";
				}
				
				$pas = "SELECT a.no_resep,b.no_rawat,c.no_rkm_medis,b.umurdaftar,c.tgl_lahir,c.jk,b.almt_pj, c.nm_pasien, d.berat, d.alergi FROM resep_obat a, reg_periksa b,pasien c, pemeriksaan_ralan d WHERE b.no_rkm_medis=c.no_rkm_medis AND b.no_rawat=a.no_rawat AND d.no_rawat=a.no_rawat AND a.no_resep = '".$poan."'";
				$tp = query($pas);
				$p = fetch_array($tp);
				$create = date_create($p['tgl_lahir']);
				
				echo "<table width=500><tr height='170px;'></tr>
						<tr style='margin-top:100px;'><td align='left' valign='top' style='padding:0px;'>Nama Pasien</td><td valign='top'>:</td><td> <b>".$p['nm_pasien']."<td></td></b></td></tr>
						<tr><td align='left' style='padding:0px;'>No.RM</td><td> :</td><td> <b>".$p['no_rkm_medis']."</b></td></tr>
						<tr><td align='left' style='padding:0px;'>Tgl.Lahir/Umur</td><td> :</td><td> <b>".date_format($create,"d-m-Y")."&nbsp;/&nbsp;".$p['umurdaftar']."&nbsp;Th&nbsp;(".$p['jk'].")</b></td></tr>
						<tr><td align='left' valign='top' style='padding:0px;'>Alamat</td><td valign='top'>: </td><td> <b>".$p['almt_pj']."</b></td></tr>
						<tr><td align='left' style='padding:0px;'>BB</td><td> :</td><td> <b>".$p['berat']."&nbsp;Kg&nbsp;&nbsp;&nbsp;&nbsp;Alergi:&nbsp;<b>".$p['alergi']."</b></td></tr>
						
						
				
				</table>";
		echo '<script>window.print()</script>';
			}else {
		echo '<div>GAGAAL</div>';
		
	}
	


?>
<p style="font-size:12px; color:#000;">*gunakan (&radic;) untuk mengisi YA/TIDAK</p>
<table class="table" table width="450" border="1" cellspacing="0" cellpadding="1" class="table border-collapse">
                        <thead>
                            <tr>
                                <th>Telaah Resep</th>
                                <th>YA</th>
                                <th>TIDAK</th>
                                <tr>
                                <td>Tepat Obat</td>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <tr>
                                <td>Tepat Dosis</td>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <tr>
                                <td>Tepat Rute</td>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <tr>
                                <td>Tepat Waktu</td>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <tr>
                                <td>Interaksi Obat</td>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <tr>
                                <td>Kontra Indikasi</td>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <tr>
                                </tr>
                                </thead>
                                </table>
                                