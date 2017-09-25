<?php
	require '../_inc/connect.php';

	$id_pertanyaan = (int) $_POST['id_pertanyaan'];

	$query = "DELETE FROM pertanyaan WHERE id_pertanyaan = $id_pertanyaan";
	$connect->query($query);
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error');}
	else echo 'success';
?>