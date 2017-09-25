<?php
require '../_inc/connect.php';

header("Content-Type: application/json; charset=UTF-8");

$row = $connect->query('SELECT u.*, p.nama AS nama_provinsi, k.nama AS nama_kota FROM user u, wilayah_provinsi p, wilayah_kota k WHERE asal_provinsi = p.id AND asal_kota = k.id')->fetch_all(MYSQLI_ASSOC);

$data['data'] = $row;

echo json_encode($data);

?>