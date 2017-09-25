<?php
	require'connect.php';
    session_start();

    function redirect_user() {
		header('Location: user.php');
		exit();
   }

   function redirect_sesi($id_soal) {
		header('Location: sesi.php?sl='.$id_soal);
		exit();
   }


   function redirect_gerbang($code, $sl) {
		if(!is_null($code)) $_SESSION['kacau'] = $code;
		header('Location: gerbang.php?sl='.$sl);
		exit();
   }

  	//cek login
	if(isset($_SESSION['id'])){
    	$id_user = (int) $_SESSION['id'];
    	$id_soal = (int) $_POST['sl'];
    } else {
    	header('Location: tryout.php');
    	exit();
    }

    date_default_timezone_set('Asia/Jakarta');
    $sekarang = date("Y-m-d H:i:s");

    //cek soal
    $query = "SELECT * FROM soal WHERE id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) redirect_user();
    $soal = mysqli_fetch_object($result);
    if($soal->waktu_buka > $sekarang) redirect_gerbang(0, $id_soal);
    //else if($soal->waktu_tutup < $sekarang) redirect_gerbang(1, $id_soal);

    //cek akses
    $query = "SELECT status FROM akses WHERE id_user = $id_user AND id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) redirect_gerbang(0,$id_soal);
    $status = mysqli_fetch_object($result)->status;
    if($status != 2) redirect_gerbang(NULL,$id_soal);

    //cek timer
    $query = "SELECT * FROM timer WHERE id_user = $id_user AND id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) {redirect_sesi($id_soal);}

    //cek deadline_sesi
    $timer = mysqli_fetch_object($result);
    $deadline_sesi = $timer->deadline_sesi;
    $deadline_soal = $timer->deadline_soal;
    if($deadline_sesi == '0000-00-00 00:00:00') {redirect_sesi($id_soal);}

    else {
    	//simpan jawaban
    	foreach ($_POST as $key => $value) {
    		if($key != 'sl') {
    			$value = substr($value, 0, 1);
                $query = "SELECT kunci_jawaban FROM pertanyaan WHERE id_pertanyaan = $key";
                $result = mysqli_query($conn, $query);
                if(mysqli_fetch_object($result)->kunci_jawaban == $value) $nilai = 1; else $nilai = 0;
    			$query = "INSERT INTO jawaban(id_user, id_pertanyaan, jawaban_user, nilai) VALUES ($id_user, $key, '$value', $nilai)";
    			mysqli_query($conn, $query);
    		}
    	}
    	$query = "UPDATE timer SET deadline_sesi =  CONVERT_TZ( NOW( ) , '+00:00', '+07:00' ) WHERE id_user = $id_user AND id_soal = $id_soal";
    	mysqli_query($conn, $query);
    	redirect_sesi($id_soal);

    }