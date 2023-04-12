    <?php
   require_once("../config.php");

    $id2=$_POST['id2'];

    $hapus = query("delete from ro where id_ob= ".$id2."");
    if($hapus){
        echo json_encode(array('status'=>true,'msg'=>$table));
    }else{
       echo json_encode(array('status'=>false,'msg'=>$table));
    }
    ?> 