<?php
	include 'ckoneksi.php';
	
	class usr{}
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$_uv_Token=$_POST["Token"];
	
	if ((empty($username)) || (empty($password))) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong"; 
		die(json_encode($response));
	}
	
	$query = mysqli_query($db,"SELECT tbuser.iduser, tbuser.nama, tbuser.alamat, tbuser.hp, tbuser.username, tbuser.password, tbuser.statususer, tbuser.jabatan, tbuser.Token, tbuser.Imei, tbuser.idtoko, tbtoko.nama as namatoko FROM tbuser
JOIN tbtoko ON tbtoko.idtoko=tbuser.idtoko WHERE username='$username' AND password='$password'");
	$row = mysqli_fetch_array($query);

	
	
	if (!empty($row)){
		mysqli_query($db, "UPDATE tbuser set Token='$_uv_Token' WHERE iduser='$row[iduser]'");
		$response = new usr();
		$response->success = 1;
		$response->message = "Selamat datang ".$row['username'];
		$response->iduser = $row['iduser'];
		$response->nama = $row['nama'];
		$response->alamat = $row['alamat'];
		$response->hp = $row['hp'];
		$response->username = $row['username'];
		$response->statususer = $row['statususer'];
		$response->jabatan = $row['jabatan'];
		$response->idtoko=$row['idtoko'];
		$response->namatoko = $row['namatoko'];
		$response->Token = $row['Token'];
		die(json_encode($response));
	} else { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Username atau password salah";
		die(json_encode($response));
	}
	
	mysqli_close($db);


?>