<?php
	require '../_inc/connect.php';

	$id_user = (int) $_POST['id_user'];
	$id_soal = (int) $_POST['id_soal'];

	$connect->query("DELETE FROM akses WHERE id_user = $id_user AND id_soal = $id_soal");
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error');}
	else echo 'success';
?>