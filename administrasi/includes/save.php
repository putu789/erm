<?php 
require_once('config.php');
                      
                                $insert = query("INSERT INTO pemeriksaan_ralan 
                                                (no_rawat, tgl_perawatan,jam_rawat,
                                                 suhu_tubuh,tensi,nadi,respirasi,
                                                tinggi,berat,gcs,keluhan,pemeriksaan,alergi,imun_ke
                                                ) 
                                                 VALUES ('{$no_rawat}',
                                                         '{$_POST['tgl_perawatan']}',
                                                          '{$_POST['jam_rawat']}',
                                                         '{$_POST['suhu']}',
                                                         '{$_POST['tensi']}',
                                                         '{$_POST['nadi']}',
                                                          '{$_POST['respirasi']}',
                                                         '{$_POST['tinggi']}',
                                                         '{$_POST['berat']}',
                                                          '{$_POST['gcs']}',
                                                         '{$_POST['keluhan']}',
                                                         '{$_POST['pemeriksaan']}',
                                                          '{$_POST['alergi']}',
                                                         '{$_POST['imun_ke']}'
                                                     )");
                        ?>