<?php
	require '../_inc/connect.php';

	$id_pertanyaan = (int) $_POST['id_pertanyaan'];
	$id_sesi = (int) $_POST['id_sesi'];
	$kunci_jawaban = $_POST['kunci_jawaban'];
	$nama_pertanyaan = $_POST['nama_pertanyaan'];
	$isi_pertanyaan = $_POST['isi_pertanyaan'];

	$query = "UPDATE pertanyaan SET
					id_sesi = $id_sesi,
					kunci_jawaban = '$kunci_jawaban',
					nama_pertanyaan = '$nama_pertanyaan',
					isi_pertanyaan = '$isi_pertanyaan'
				WHERE id_pertanyaan = $id_pertanyaan";
	$connect->query($query);
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error '.$connect->error);}
	else echo 'success';
?>