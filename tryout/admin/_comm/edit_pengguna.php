<?php
	require '../_inc/connect.php';

	$id_user = !empty($_POST['id_user']) ? (int) $_POST['id_user'] : NULL;
	$nama_lengkap = !empty($_POST['nama_lengkap']) ? htmlspecialchars($_POST['nama_lengkap']) : NULL;
	$nomor_hp = !empty($_POST['nomor_hp']) ? htmlspecialchars($_POST['nomor_hp']) : NULL;
	$email = !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : NULL;
	$asal_sekolah = !empty($_POST['asal_sekolah']) ? htmlspecialchars($_POST['asal_sekolah']) : NULL;
	$asal_provinsi = !empty($_POST['asal_provinsi']) ? htmlspecialchars($_POST['asal_provinsi']) : NULL;
	$asal_kota = !empty($_POST['asal_kota']) ? htmlspecialchars($_POST['asal_kota']) : NULL;
	$id_line = !empty($_POST['id_line']) ? htmlspecialchars($_POST['id_line']) : NULL;
	$id_instagram = !empty($_POST['id_instagram']) ? htmlspecialchars($_POST['id_instagram']) : NULL;
	$username = !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : NULL;

	$connect->query("UPDATE user
					SET
						nama_lengkap = '$nama_lengkap',
						nomor_hp = '$nomor_hp',
						email = '$email',
						asal_sekolah = '$asal_sekolah',
						asal_provinsi = $asal_provinsi,
						asal_kota = $asal_kota,
						id_line = '$id_line',
						id_instagram = '$id_instagram',
						username = '$username'
					WHERE id_user = $id_user");
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error');}
	else echo 'success';
?>