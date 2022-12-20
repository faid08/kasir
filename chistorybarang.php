<?php
include_once "ckoneksi.php";

$idtoko=$_POST['idtoko'];
$query = mysqli_query($db,"SELECT tbbarang.idbarang,tbbarang.idjenisbrg,tbbarang.isibarang ,tbbarang.barcode,tbbarang.nama_barang, tbharga.hargabeli, tbharga.hecer1, tbharga.hecer2, tbharga.hgrosir1, tbharga.hgrosir2, tbharga.hgrosir3, tbbarang.hpromo, tbbarang.tanggalpromo, tbbarang.statuspromo, tbbarang.statusbarang,tbstock.idtoko,sum(tbstock.stock) as stock FROM tbbarang 
JOIN tbstock ON tbstock.idbarang=tbbarang.idbarang
JOIN tbharga ON tbharga.idbarang=tbbarang.idbarang
WHERE tbstock.idtoko='$idtoko' AND tbharga.idtoko='$idtoko'
GROUP BY tbstock.idbarang limit 0,100");
// limit 0,100
	$num_rows = mysqli_num_rows($query);
	if ($num_rows > 0){
		$json = '{"value":1, "results": [';
		$no=1;
		while ($row = mysqli_fetch_array($query)){
			$char ='"';
			if($idtoko =="1"){
			    $hpp=$row['hargabeli'];
			}else{
			    $hpp="0";
			}
			$json .= '{
			    "no": "'.str_replace($char,'`',strip_tags($no++)).'",
				"idbarang": "'.str_replace($char,'`',strip_tags($row['idbarang'])).'",
				"idjenisbrg": "'.str_replace($char,'`',strip_tags($row['idjenisbrg'])).'",
				"isibarang": "'.str_replace($char,'`',strip_tags($row['isibarang'])).'",
				"barcode": "'.str_replace($char,'`',strip_tags($row['barcode'])).'",
				"nama_barang": "'.str_replace($char,'`',strip_tags($row['nama_barang'])).'",
				"hargabeli": "'.str_replace($char,'`',strip_tags($hpp)).'",
				"hecer1": "'.str_replace($char,'`',strip_tags($row['hecer1'])).'",
				"hecer2": "'.str_replace($char,'`',strip_tags($row['hecer2'])).'",
				"hgrosir1": "'.str_replace($char,'`',strip_tags($row['hgrosir1'])).'",
				"hgrosir2": "'.str_replace($char,'`',strip_tags($row['hgrosir2'])).'",
				"hgrosir3": "'.str_replace($char,'`',strip_tags($row['hgrosir3'])).'",
				"hpromo": "'.str_replace($char,'`',strip_tags($row['hpromo'])).'",
				"tanggalpromo": "'.str_replace($char,'`',strip_tags($row['tanggalpromo'])).'",
				"statuspromo": "'.str_replace($char,'`',strip_tags($row['statuspromo'])).'",
				"statusbarang": "'.str_replace($char,'`',strip_tags($row['statusbarang'])).'",
				"idtoko": "'.str_replace($char,'`',strip_tags($row['idtoko'])).'",
				"stock": "'.str_replace($char,'`',strip_tags($row['stock'])).'"
			},';
		}
		$json = substr($json,0,strlen($json)-1);
		$json .= ']}';
	} else {
		$json = '{"value":0, "message": "Data tidak ditemukan."}';
	}
	echo $json;
	mysqli_close($db);
?>
