<?php
	require '../_inc/connect.php';

	$id_soal = (int) $_POST['id_soal'];
	$jumlah_pertanyaan = (int) $_POST['jumlah_pertanyaan'];
	$durasi = $_POST['durasi'];

	$connect->query("INSERT INTO sesi(id_soal, nomor_sesi, jumlah_pertanyaan, durasi) VALUES ($id_soal, IFNULL((SELECT MAX(nomor_sesi) FROM sesi s WHERE s.id_soal = $id_soal GROUP BY s.id_soal),0)+1, $jumlah_pertanyaan, '$durasi')");
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error');}
	else echo 'success';
?>