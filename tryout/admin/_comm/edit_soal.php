<?php
	require '../_inc/connect.php';

	$id_soal = (int) $_POST['id_soal'];
	$harga = (int) $_POST['harga'];
	$nama_soal = $_POST['nama_soal'];
	$petunjuk_pembayaran = $_POST['petunjuk_pembayaran'];
	$petunjuk_pengerjaan = $_POST['petunjuk_pengerjaan'];

	$waktu = explode(' - ', $_POST['waktu'], 2);
	$buka = DateTime::createFromFormat('d/m/Y H:i', $waktu[0]);
	$tutup = DateTime::createFromFormat('d/m/Y H:i', $waktu[1]);
	$waktu_buka = $buka->format('Y-m-d H:i:s');
	$waktu_tutup = $tutup->format('Y-m-d H:i:s');
	
	$waktu2 = explode(' - ', $_POST['waktu_pengumuman'], 2);
	$buka2 = DateTime::createFromFormat('d/m/Y H:i', $waktu2[0]);
	$tutup2 = DateTime::createFromFormat('d/m/Y H:i', $waktu2[1]);
	$waktu_buka2 = $buka2->format('Y-m-d H:i:s');
	$waktu_tutup2 = $tutup2->format('Y-m-d H:i:s');

	$query = "UPDATE soal SET harga = '$harga', hasil_buka = '$waktu_buka2', hasil_tutup = '$waktu_tutup2', nama_soal = '$nama_soal', waktu_buka = '$waktu_buka', waktu_tutup = '$waktu_tutup', petunjuk_pembayaran = '$petunjuk_pembayaran', petunjuk_pengerjaan = '$petunjuk_pengerjaan' WHERE id_soal = $id_soal";
	$connect->query($query);
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error');}
	else echo 'success'.$query;
?>