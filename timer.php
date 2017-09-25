<?php
	require'connect.php';
    session_start();

    //cek login
	if(isset($_SESSION['id'])){
    	$id_user = (int) $_SESSION['id'];
    	$id_soal = (int) $_POST['sl'];
    } else {
    	header('Location: tryout.php');
    	exit();
    }

    function error() {
		header('HTTP/1.1 403 Forbidden');
		echo 'error';
		exit();
   }

    date_default_timezone_set('Asia/Jakarta');
    $sekarang = date("Y-m-d H:i:s");

    //cek soal
    $query = "SELECT * FROM soal WHERE id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) error();
    $soal = mysqli_fetch_object($result);
    if($soal->waktu_buka > $sekarang) error();
    else if($soal->waktu_tutup < $sekarang) error();

    //cek akses
    $query = "SELECT status FROM akses WHERE id_user = $id_user AND id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) error();
    $status = mysqli_fetch_object($result)->status;
    if($status != 2) error();

    //cek timer
    $query = "SELECT * FROM timer WHERE id_user = $id_user AND id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) { //ngga ada timer
    	 $query = "INSERT INTO timer(id_user, id_soal, nomor_sesi) VALUES ($id_user, $id_soal, 1)";
    	 mysqli_query($conn, $query);
    	 if(mysqli_affected_rows($conn) < 1) error();
    	 $query = "SELECT * FROM timer WHERE id_user = $id_user AND id_soal = $id_soal";
    	 $result = mysqli_query($conn, $query);
    }

    //cek deadline_sesi
    $timer = mysqli_fetch_object($result);
    $deadline_sesi = $timer->deadline_sesi;
    $deadline_soal = $timer->deadline_soal;
    if($deadline_sesi == '0000-00-00 00:00:00') {
    	$sesi = $timer->nomor_sesi;
    	$query = "SELECT durasi FROM sesi WHERE id_soal = $id_soal AND nomor_sesi = 1";
	    $result = mysqli_query($conn, $query);
	    $durasi = mysqli_fetch_object($result)->durasi;
	    $query = "SELECT durasi FROM sesi WHERE id_soal = $id_soal AND nomor_sesi = 2";
	    $result = mysqli_query($conn, $query);
	    $durasi2 = mysqli_fetch_object($result)->durasi;
	    $durasi2 += $durasi+10;
    	$query = "UPDATE timer SET deadline_sesi = DATE_ADD(CONVERT_TZ( NOW( ) , '+00:00', '+07:00' ), INTERVAL $durasi MINUTE), deadline_soal = DATE_ADD(CONVERT_TZ( NOW( ) , '+00:00', '+07:00' ), INTERVAL $durasi2 MINUTE) WHERE id_user = $id_user AND id_soal = $id_soal";
    	mysqli_query($conn, $query);
    	$dur = new DateInterval('PT'.$durasi.'M');
	    $d_se = new DateTime('now');
	    $deadline_sesi = $d_se->add($dur)->format('Y-m-d H:i:s');
    } 
    else if($deadline_sesi > $sekarang) $sesi = $timer->nomor_sesi;

    else {
    	//cek jumlah_sesi
	    $query = "SELECT COUNT(*) AS jumlah_sesi FROM sesi WHERE id_soal = $id_soal";
	    $result = mysqli_query($conn, $query);
	    $jumlah_sesi = mysqli_fetch_object($result)->jumlah_sesi;
	    if($timer->nomor_sesi >= $jumlah_sesi) { //ngga ada sesi lagi
	    	$query = "UPDATE akses SET status = 3 WHERE id_user = $id_user AND id_soal = $id_soal";
	    	mysqli_query($conn, $query);
	    	$query = "DELETE FROM timer WHERE id_user = $id_user AND id_soal = $id_soal";
	    	mysqli_query($conn, $query);
	    	error();
	    }
	    
	    //cek durasi
	    $query = "SELECT durasi FROM sesi WHERE id_soal = $id_soal AND nomor_sesi = 2";
	    $result = mysqli_query($conn, $query);
	    $durasi = mysqli_fetch_object($result)->durasi;
	    $dur = new DateInterval('PT'.$durasi.'M');
	    $d_so = new DateTime($deadline_soal);
	    $sekarang = new DateTime('now');
	    $mulai_sesi = clone $d_so;
	    $mulai_sesi->sub($dur);

	    if($sekarang < $mulai_sesi) $istirahat = TRUE;
	    else {
	    	$deadline_sesi = $deadline_soal;
	    	$query = "UPDATE timer SET nomor_sesi = nomor_sesi + 1, deadline_sesi = '$deadline_sesi' WHERE id_user = $id_user AND id_soal = $id_soal";
	    	mysqli_query($conn, $query);
	    	$sesi = (($timer->nomor_sesi)+1);
	    }
    }

    if(isset($sesi)) {
    	$data['status'] = $sesi;
    	$data['deadline'] = $deadline_sesi;
    }
    else {
    	$data['status'] = 0;
    	$data['deadline'] = $mulai_sesi->format('Y-m-d H:i:s');
    }

    echo json_encode($data);
    //echo new DateTime()->format('Y-m-d H:i:s');
