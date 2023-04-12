<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
// get the HTML
ob_start();
// database connection here
require_once ( 'config.php' );
// get the id
$id = $_GET['no_rawat'];
// Retrieve record from database
// query code here
?>
<style type="text/css">
table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  h1 {color: #000033}
  h2 {color: #000055}
  h3 {color: #000077}
</style>
<!-- Setting Margin header/ kop -->
<page backtop="5mm" backbottom="5mm" backleft="1mm" backright="10mm">
  <page_header>
  
  </page_header>
  <!-- Setting Footer -->
  <page_footer>
    
  </page_footer>
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #000;
  }
  body,td,th {
	font-size: 10px;
	font-weight: bold;
}
  </style>
  <table width="357">
    <tr>
      <th width="135" rowspan="3"><img src="../images/PIN(blck).png" style="width:120px;height:100px" /></th>
      <td width="226" align="left" style="width: 190px;"><font style="font-size: 18px"><b>RUMAH SAKIT UMUM</b><br><b>ASY SYIFA SAMBI</b></font>
        <br>Jl. Raya Bangak Simo Km. 7, Sambi, Boyolali 57376
         <br>Telp. (0276)3294459, Fax. (0276)3294459</td>
      <td width="100" align="left" valign="top" style="width: 190px;">
      <p>Nama :</p>
      <p>NO RM :</p>
      <p>Tanggal Lahir/Umur:</p>
      <p>Alamat :</p></td>
      
     
      <td width="226" align="left" valign="top" style="width: 190px;">
     <?php
	 $no_rawat = $_GET['no_rawat']; 
	if(isset($_GET['no_rawat'])){
      $select = query("SELECT a.no_rawat, b.no_rkm_medis, b.nm_pasien, b.tgl_lahir, a.almt_pj, a.umurdaftar,a.nm_kecamatan b.jk FROM reg_periksa a, pasien b, kecamatan c,kabupaten d WHERE a.no_rawat = '{$no_rawat}' AND a.no_rkm_medis=b.no_rkm_medis AND b.kd_kec = c.kd_kec AND d.kd_kab = b.kd_kab");  
      while($data=mysqli_fetch_array($select)){
      ?>
      <p><?php echo $data['nm_pasien']; ?></p>
      <p><?php echo $data['no_rkm_medis']; ?></p>
      <p><?php echo date("j/m/Y", strtotime($data['tgl_lahir'])) ;?>&nbsp;/&nbsp;<?php echo $data['umurdaftar'];?>&nbsp; Th&nbsp;(<?php echo $data['jk'];?>)</p>
      <p><?php echo $data['almt_pj']; ?></p>
      
      </td>   
    </tr>
  </table>

  <hr width="700" size="5">
 
    <?php
   $no_rawat = $_GET['no_rawat']; 
	if(isset($_GET['no_rawat'])){
	$select = query("SELECT  a.no_rawat, c.suhu_tubuh,c.tensi,c.respirasi,c.suhu_tubuh,c.tinggi,c.nadi,c.berat, c.keluhan,c.pemeriksaan FROM reg_periksa a, pemeriksaan_ralan c WHERE a.no_rawat = c.no_rawat AND  a.no_rawat ='".$no_rawat."'");
				while ($hasil = fetch_array($select)) {
				 ?>
    <?php echo $hasil['no_rawat']; ?>
    <br><br>
  <div align="center">
    <b>ASSESMEN AWAL MEDIS OBSTETRI GINEKOLOGI</b>
    <br><br>
  </div>
  <?php $no_rawat = $_GET['no_rawat']; 
	if(isset($_GET['no_rawat'])){
	$select = query("SELECT  a.no_rawat, c.suhu_tubuh,c.tensi,c.respirasi,c.suhu_tubuh,c.tinggi,c.nadi,c.berat, c.keluhan,c.pemeriksaan,c.alergi, c.imun_ke FROM reg_periksa a, pemeriksaan_ralan c WHERE a.no_rawat = c.no_rawat AND  a.no_rawat ='".$no_rawat."'");
	while ($hl = fetch_array($select)) {
		?>
       
  <table width="306" border="0">
          <tr>
            <td width="88" height="26" align="left" valign="top" style="width: 190px;"><b>Anamnesa:</b></td>
            <td width="88" height="26" align="left" valign="top" style="width: 190px;"><?php echo $hl['keluhan']; ?><br ></td>
          </tr>
          
    <tbody>
  </tbody>
  </table>
 
                    <tbody>
  </tbody>
   <strong>Obstetri</strong> 
                        
                    <table width="679" border="1" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="44" align="center">NO</td>
                        <td width="78" align="center">UMUR</td>
                        <td width="136" align="center">CARA PERSALINAN</td>
                        <td width="32" align="center">BB</td>
                        <td width="207" align="center">TEMPAT PERSALINAN</td>
                        <td width="168" align="center">KEADAAN SEKARANG</td>
                      </tr>
                     
                                   <?php
                          $pilih = query ("SELECT a.no_rawat, a.umur, a.cara_persalinan, a.bb, a.tmpt_pers, 	a.keadaan_sekarang, c.kd_dokter, c.nm_dokter FROM ro a, reg_periksa b, dokter c WHERE b.no_rawat = a.no_rawat AND b.kd_dokter = c.kd_dokter AND a.no_rawat ='".$no_rawat."'");
															$no=1;
			while ($h = fetch_array($pilih)) 
	{
?>     
 <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $h['umur']; ?></td>
                        <td><?php echo $h['cara_persalinan']; ?></td>
                        <td><?php echo $h['bb']; ?></td>
                        <td><?php echo $h['tmpt_pers']; ?></td>
                        <td><?php echo $h['keadaan_sekarang']; ?></td>
                      </tr>
                        
                                       <?php 
  $no++;
   }
  ?>                       
               </table>
                                            
   


<br><br>
  <table width="700" border="0">
    <tr>
    <font style="font-size:12px"></font>
      <td width="216">Tekanan Darah:</td>
      <td width="133"><?php echo $hl['tensi']; ?> mmHg</td>
      <td width="228">Suhu Tubuh :</td>
      <td width="105"><?php echo $hl['suhu_tubuh']; ?> &deg;C</td>
    </tr>
    <tr>
      <td>Pernafasan:</td>
      <td><?php echo $hl['respirasi']; ?> X/Menit</td>
      <td>BB:</td>
      <td><?php echo $hl['berat']; ?> Kg</td>
    </tr>
    <tr>
      <td>Nadi:</td>
      <td><?php echo $hl['nadi']; ?> X/Menit</td>
      <td>TB:</td>
      <td><?php echo $hl['tinggi']; ?> cm</td>
    </tr>
    <tr>
      <td>Alergi:</td>
      <td><?php echo $hl['alergi']; ?></td>
      <td>Imun Ke:</td>
      <td><?php echo $hl['imun_ke']; ?></td>
    </tr>
    
  </table>
  
  <p><b><font style="font-size:12px">Pemeriksaan:</font></b></p>
  <p><font style="font-size:10px"><?php echo $hl['pemeriksaan']; ?></font></p>
  <br>
  <?php
  $pilih= query("SELECT a.id_diag_dok, a.diagnosa FROM diagnosa_dokter a WHERE a.no_rawat = '{$no_rawat}' ");
				while ($hi = fetch_array($pilih)) {
				
				?>
  <p><b><font style="font-size:12px">Diagnosa :</font></b></p>
  <p><font style="font-size:10px"><?php echo $hi['diagnosa'];?></font></p>
  <br>
 <p><b><font style="font-size:12px">Tindakan :</font></b></p>
 <p>
   <?php
   $query = query("SELECT a.id_tindakan_dr, a.tindakan FROM tindakan_dokter a WHERE a.no_rawat = '{$no_rawat}' ");
				while ($hsl = fetch_array($query)) {
					?>
   
   <font style="font-size:10px"><?php echo $hsl['tindakan'] ; ?><br></font>
   <?php } ?>
   <br><br><br><br>
 </p>
 <table width="306" border="0">
   <tr>
     <td width="1100" align="center" style="width: 200px;"><br><br><br><br>Dokter/Bidan</td>          
   </tr>
   <br><br>
   <?php
               $choose = query ("SELECT a.no_rawat, c.kd_dokter, c.nm_dokter FROM  reg_periksa a, dokter c WHERE a.kd_dokter = c.kd_dokter AND a.no_rawat = '{$no_rawat}'");
			 while ($d = fetch_array($choose)) {
			 
			 ?>
             
   <tr>
     <td width="1100" align="center" style="width: 200px;" font style="font-size:12px"><br><br><br><?php echo $d['nm_dokter']; ?></td>
   </tr>
   </table>
            
</page>
<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
require_once('html2pdf/html2pdf.class.php');
 try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output();
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
	}
	}
	}
	}
	 }
	  }
	}
	}
	
	
	?>

 
    

