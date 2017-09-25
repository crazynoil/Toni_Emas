<?php
require '../_inc/connect.php';
$id_user = (int) $_REQUEST['id_user'];
$id_soal = (int) $_REQUEST['id_soal'];  

header("Content-Type: application/json; charset=UTF-8");

$data['hasil'] = $connect->query("SELECT kelulusan, data1, data2, data3 FROM akses WHERE id_user = $id_user AND id_soal = $id_soal")->fetch_array();
for($i=1; $i<=3; $i++) {
	if(!empty($data['hasil']['data'.$i])) {
		$data['hasil']['pilihan'][$i] = $connect->query("SELECT nama_jurusan FROM jurusan WHERE id_jurusan = ".$data['hasil']['data'.$i])->fetch_object()->nama_jurusan.' - '.$connect->query("SELECT nama_ptn FROM ptn WHERE id_ptn = ".substr($data['hasil']['data'.$i],0,2))->fetch_object()->nama_ptn;
	}
}
echo json_encode($data);

?>