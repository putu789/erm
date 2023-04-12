<?php
ob_start();
session_start();
require_once("../config.php");




?>	
<table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="border:#CCC solid 1px;">No</th>
                                <th style="border:#CCC solid 1px;">UMUR</th>
                                <th style="border:#CCC solid 1px;">CARA PERSALINAN</th>
                                <th style="border:#CCC solid 1px;">BB</th>
                                <th style="border:#CCC solid 1px;">TEMPAT PERSALINAN</th>
                                <th style="border:#CCC solid 1px;">KEADAAN SEKARANG</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php
                       if($_POST['idob']){
	$idob = $_POST['idob'];
	 $o= query("SELECT *  FROM ro a, reg_periksa b
                                                  WHERE a.no_rawat = b.no_rawat and a.no_rawat = '".$idob."' ORDER BY a.id_ob ASC");
												  $no=1;
                            while ($ro = fetch_array($o)) 
	
                            {
                                ?>
                                <tr>
                                	<td><?php echo $no; ?></td>
                                    <td><?php echo $ro['umur']; ?></td>
                                    <td><?php echo $ro['cara_persalinan']; ?></td>
                                    <td><?php echo $ro['bb']; ?></td>
                                    <td><?php echo $ro['tmpt_pers']; ?></td>
                                    <td><?php echo $ro['keadaan_sekarang']; ?></td>
									<td><a href="#" id2="hapus" onClick="hapus("<?php echo $ro['id_ob'];?>")">Hapus</a></td>
                                	</tr>
                                <?php 
								$no++;
                            }
					   }
                                ?>
                    </tbody>
                </table>
                
                   <script>
					function hapus(id2) {
					$.ajax({
						  type: 'POST',
						  data: 'id2='+id2,
						  url: 'includes/hapus-obs.php',
						  success: function(result) {
							var response = JSON.parse(result);
							if(response.status){    
							  alert('berhasil');
							}else{                
							  alert('gagal');
							}
						  }
						});
					}
					</script>