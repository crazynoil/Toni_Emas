<?php
	require '../_inc/connect.php';

	$id_soal = (int) $_POST['id_soal'];
	$nomor_sesi = (int) $_POST['nomor_sesi'];
	$jumlah_pertanyaan = (int) $_POST['jumlah_pertanyaan'];
	$durasi = (int) $_POST['durasi'];
	$connect->query("UPDATE sesi SET jumlah_pertanyaan = $jumlah_pertanyaan, durasi = $durasi WHERE id_soal = $id_soal AND nomor_sesi = $nomor_sesi");
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error');}
	else echo 'success';
?>