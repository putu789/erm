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
				<td align='center'><img src='../images/PIN(blck).png' width='80px;' height='80px;'/>
				</td>
				<td align='center'><b>RSU ASY SYIFA SAMBI</b><br>
				Jl. Raya Bangak -Simo Km.7,Sambi, Boyolali 57376<br>
				Telp. (0276)3294459, Fax.(0276)3294459</td>
				</tr>
				<tr><td align='center' colspan=2 style='border-top:5px double;></td></tr>";
				$dok = "SELECT nm_dokter FROM dokter WHERE kd_dokter = '".$_SESSION['username']."'";
				$ter = query($dok);
				$h = fetch_array($ter);
				echo "<tr><td align='center' style='padding:0px;' colspan=2>Resep Dokter : ".$h['nm_dokter']."</td></tr>";
				
				$select = query("SELECT a.kode_brng, a.jml,a.aturan_pakai, a.no_resep, b.nama_brng FROM resep_dokter a, databarang b WHERE a.kode_brng=b.kode_brng AND no_resep ='".$poan."'");
				while ($hasil = fetch_array($select)) {
					
				echo "<tr><td colspan=2><p style='width=100%;' align='left'>".$hasil['nama_brng']."<span style='padding-left:30%;'>".str_replace("X", "dd", $hasil['aturan_pakai'])."</span></p></td></tr>";
				}
				echo "</table>";
				$pas = "SELECT a.no_resep,b.no_rawat,c.no_rkm_medis,b.umurdaftar,c.tgl_lahir,c.jk,b.almt_pj, c.nm_pasien FROM resep_obat a, reg_periksa b,pasien c WHERE b.no_rkm_medis=c.no_rkm_medis AND b.no_rawat=a.no_rawat AND a.no_resep = '".$poan."'";
				$tp = query($pas);
				$p = fetch_array($tp);
				$create = date_create($p['tgl_lahir']);
				echo "<table width=450><tr height='40px;'></tr>
						<tr style='margin-top:100px;'><td align='left' style='padding:0px;'>Nama Pasien</td><td>:</td><td> <b>".$p['nm_pasien']."</b></td></tr>
						<tr><td align='left' style='padding:0px;'>No.RM</td><td> :</td><td> <b>".$p['no_rkm_medis']."</b></td></tr>
						<tr><td align='left' style='padding:0px;'>Tgl.Lahir/Umur</td><td> :</td><td> <b>".date_format($create,"d-m-Y")."/".$p['umurdaftar']."&nbsp;Th&nbsp;(".$p['jk'].")</b></td></tr>
						<tr><td align='left' style='padding:0px;'>Alamat</td><td> :</td><td> <b>".$p['almt_pj']."</b></td></tr>
					
				</table>";
		echo '<script>window.print()</script>';
	}else {
		echo '<div>GAGAAL</div>';
		
	}
	


?>
