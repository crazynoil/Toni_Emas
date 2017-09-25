<?php
	require('connect.php');
	session_start();
	$id_user = $_SESSION['id'];
	$id_soal = $_GET['sl'];

	$prodi1 = !empty($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan']) : NULL;
	$prodi2 = !empty($_POST['jurusano']) ? htmlspecialchars($_POST['jurusano']) : NULL;
	$prodi3 = !empty($_POST['jurusani']) ? htmlspecialchars($_POST['jurusani']) : NULL;
	
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, "UPDATE akses SET data1=?, data2=?, data3=? Where id_user ='$id_user' AND id_soal = '$id_soal'");
	mysqli_stmt_bind_param($stmt, "sss", $prodi1, $prodi2, $prodi3);
	mysqli_stmt_execute($stmt);
			if(mysqli_stmt_affected_rows($stmt) < 1) echo "HAHAHAHAH";;
	mysqli_stmt_close($stmt);

	$_SESSION['success'] = TRUE;
	header('Location: gerbang.php?sl='.$id_soal);
	
?>