<?php
	require '../_inc/connect.php';

	$id_sesi = (int) $_POST['id_sesi'];
	$kunci_jawaban = $_POST['kunci_jawaban'];
	$nama_pertanyaan = $_POST['nama_pertanyaan'];
	$isi_pertanyaan = $_POST['isi_pertanyaan'];

	$query = "INSERT INTO pertanyaan(id_sesi,kunci_jawaban,nama_pertanyaan,isi_pertanyaan) VALUES ($id_sesi, '$kunci_jawaban', '$nama_pertanyaan', '$isi_pertanyaan')";
	$connect->query($query);
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error'.mysqli_error($connect));}
	else echo 'success';
?>