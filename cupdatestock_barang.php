<?php
include_once "ckoneksi.php";
$queryremotestock = mysqli_query($db, "SELECT * FROM tbremotestockbarang where id_remotestock =1");
$rowRstock = mysqli_fetch_array($queryremotestock);
if ($rowRstock['status_remotestock']=="Of") {
	$json = '{"value":2, "message": "Remote Stock Of."}';
	echo $json;
}else if ($rowRstock['status_remotestock']=="On") {
    $idtoko = isset($_POST['idtoko']) ? $_POST['idtoko'] : '';
    $idbarang = isset($_POST['idbarang']) ? $_POST['idbarang'] : '';
    $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
    $tgl=date("Y-m-d H:i:s");
    

    	 $InsertSQL    = "INSERT INTO `tbstock`(`idstock`, `idbarang`, `stock`, `stock_min`, `tipe`, `ket`, `tgl_up`, `waktu_up`, `idtoko`) VALUES (NULL,'$idbarang','$stock','5','Masuk','Toko Tambah Stock','$tgl','$tgl','$idtoko')"; 
    	 
    			 if(mysqli_query($db, $InsertSQL)){
    				 $json = '{"value":1, "message": "Sukses."}';
    	   			 echo $json;
    			 }else{
    				 $json = '{"value":0, "message": "Gagal."}';
            		 echo $json;
    			 }
}else{
    $json = '{"value":0, "message": "Data Remote Kosong."}';
	echo $json;
}

mysqli_close($db);
?>