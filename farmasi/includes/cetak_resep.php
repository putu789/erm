<?php
session_start();
require('../config.php');
$poan = $_GET['no_resep'];
$rwt = $_GET['rwt'];
if(isset($_GET['no_resep'])){
		$pilih ="SELECT a.kode_brng, a.jml, a.aturan_pakai,b.nama_brng, a.no_resep,d.nm_dokter FROM resep_dokter a, databarang b, dokter d, resep_obat c WHERE c.kd_dokter=d.kd_dokter AND a.kode_brng = b.kode_brng AND a.no_resep ='".$poan."'";
		$result = query($pilih);
		$set = fetch_array($result);
		echo "
		<div style='height:604px;font-size:10px;' ><table style='margin-top:0px;' width=340>
				<tr>
				<td align='center'><img src='../../asset/images/PIN(blck).png' width='60px;' height='60px;'/>
				</td>
				<td align='center' style='font-size:12px;'><b>RUMAH SAKIT UMUM<br> 
				ASY SYIFA' SAMBI</b><br>
				Jl. Raya Bangak -Simo Km.7,Sambi, Boyolali 57376<br>
				Telp. (0276)3294459, Fax.(0276)3294459</td>
				</tr>
				<tr><td align='center' colspan=2 style='border-top:5px double;></td></tr>";

				$dok = "SELECT b.nm_dokter FROM reg_periksa a, dokter b WHERE a.no_rawat = '".$rwt."' AND b.kd_dokter = a.kd_dokter";
				$create = date_create($data['2']);
				$ter = query($dok);
				$h = fetch_array($ter);
				echo "<tr><td align='center' style='padding:0px;font-size:11px;' colspan=2 >Resep Dokter : ".$h['nm_dokter']."</td></tr>"."<tr><td align='right' style='padding:0px;font-size:11px;' colspan=2>Sambi, ".date_format($create,"d-F-y")."</td></tr>";
							
				$select = query("SELECT a.kode_brng, a.jml, a.aturan_pakai, a.no_resep, b.nama_brng FROM resep_dokter a, databarang b WHERE a.kode_brng=b.kode_brng AND no_resep ='".$poan."'");
				while ($hasil = fetch_array($select)) {
				echo "<tr><td colspan=1><p style='width=50%;' align='left'><tr><td colspan=3><p style='width=100%;font-size:11px;' align='left'>R/ ".$hasil['nama_brng']."<span style='padding-left:10%;'>&nbsp;No.&nbsp;".str_replace("1", "I", str_replace("2", "II", str_replace("3", "III", str_replace("4", "IV", str_replace("5", "V", str_replace("6", "VI", str_replace("7", "VII", str_replace("8", "VIII", str_replace("9", "IX", str_replace("10", "X", str_replace("11", "XI", str_replace("12", "XII", str_replace("13", "XIII", str_replace("14", "XIV", str_replace("15", "XV", str_replace("16", "XVI", str_replace("17", "XVII", str_replace("18", "XVIII", str_replace("19", "XIX", str_replace("20", "XX", str_replace("30","XXX",str_replace("40", "XL",str_replace("50","L",str_replace("60","LX",str_replace("70", "LXX", str_replace("80","LXXX", str_replace("90","XC", str_replace("100","C", $hasil['jml']))))))))))))))))))))))))))))."<tr><td colspan=2><p style='width=100%;font-size:11px;' align='left'>"."<span style='padding-left:20%;'>&nbsp;S.&nbsp;".str_replace("X", "dd", str_replace("sebelum makan", "a.c.", str_replace("sesudah makan", "p.c.", $hasil['aturan_pakai'])))."<span style='padding-left:1%;'>"."</span></p></td></tr>";
				}
				
				$pas = "SELECT a.no_resep,b.no_rawat,c.no_rkm_medis,b.umurdaftar,c.tgl_lahir,c.jk,b.almt_pj,e.png_jawab, c.nm_pasien, d.berat, d.alergi FROM resep_obat a, reg_periksa b,pasien c, pemeriksaan_ralan d,penjab e WHERE b.no_rkm_medis=c.no_rkm_medis AND b.no_rawat=a.no_rawat AND d.no_rawat=a.no_rawat AND b.kd_pj = e.kd_pj AND a.no_resep = '".$poan."'";
				$tp = query($pas);
				$p = fetch_array($tp);
				$create = date_create($p['tgl_lahir']);
				
				echo "<br><table width=340>
						<tr style='margin-top:100px;'><td align='left' valign='top' style='padding:0px;font-size:11px;'>Nama Pasien</td><td valign='top' style='font-size:11px;'>:</td><td style='font-size:11px;'> <b>".$p['nm_pasien']."<td></td></b></td></tr>
						<tr style='margin-top:100px;'><td align='left' valign='top' style='padding:0px;font-size:11px;'>Cara Bayar</td><td valign='top'>:</td><td style='font-size:11px;'> <b>".$p['png_jawab']."<td></td></b></td></tr>
						<tr><td align='left' style='padding:0px;font-size:11px;'>No.RM</td><td style='font-size:11px;'> :</td><td style='font-size:11px;'> <b>".$p['no_rkm_medis']."</b></td></tr>
						<tr><td align='left' style='padding:0px;font-size:11px;'>Tgl.Lahir/Umur</td><td style='font-size:11px;'> :</td><td style='font-size:11px;'> <b>".date_format($create,"d-m-Y")."&nbsp;/&nbsp;".$p['umurdaftar']."&nbsp;Th&nbsp;(".$p['jk'].")</b></td></tr>
						<tr><td align='left' valign='top' style='padding:0px;font-size:11px;'>Alamat</td><td valign='top' style='font-size:11px;'>: </td><td style='font-size:11px;'> <b>".$p['almt_pj']."</b></td></tr>
						<tr><td align='left' style='padding:0px;font-size:11px;'>BB</td><td style='font-size:11px;'> :</td><td style='font-size:11px;'> <b>".$p['berat']."&nbsp;Kg&nbsp;&nbsp;&nbsp;&nbsp;Alergi:&nbsp;<b>".$p['alergi']."</b></td></tr>
						
						
				
				</table>";
		echo '<script>window.print()</script>';
			}else {
		echo '<div>GAGAAL</div>';
		
	}
	


?>
<p style="font-size:9px; color:#000;">*gunakan (&radic;) untuk mengisi YA/TIDAK</p>
<table class="table" table width="340" border="1" cellspacing="0" cellpadding="1" class="table border-collapse" style="font-size:10px;">
                        <thead>
                                <th>Telaah Resep</th>
                                <th>YA</th>
                                <th>TIDAK</th>
                                </thead>
                                <tbody>
                                <td>Tepat Obat</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
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
                                </tr>
 </table>
                          
                          </div>      