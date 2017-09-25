<?php
require '../_inc/connect.php';
$id_soal = (int) $_REQUEST['id_soal']; 

header("Content-Type: application/json; charset=UTF-8");

$data = $connect->query("SELECT * FROM soal WHERE id_soal = $id_soal ")->fetch_assoc();

$data['waktu_buka'] = date_create($data['waktu_buka'])->format('d/m/Y H:i');
$data['waktu_tutup'] = date_create($data['waktu_tutup'])->format('d/m/Y H:i');

$data['hasil_buka'] = date_create($data['hasil_buka'])->format('d/m/Y H:i');
$data['hasil_tutup'] = date_create($data['hasil_tutup'])->format('d/m/Y H:i');

echo json_encode($data);

?>