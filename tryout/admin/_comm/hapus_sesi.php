<?php
	require '../_inc/connect.php';

	$id_soal = (int) $_POST['id_soal'];
	$nomor_sesi = (int) $_POST['nomor_sesi'];

	$connect->query("DELETE FROM sesi WHERE id_soal = $id_soal AND nomor_sesi = $nomor_sesi");
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error'.mysqli_error($connect));}
	else echo 'success';
?>