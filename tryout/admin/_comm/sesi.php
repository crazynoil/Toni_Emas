<?php
require '../_inc/connect.php';
$id_soal = (int) $_REQUEST['id_soal']; 

header("Content-Type: application/json; charset=UTF-8");

$result = $connect->query("SELECT * FROM sesi WHERE id_soal = $id_soal");
$data = array();

while($row = $result->fetch_assoc()) {
   $data['sesi'][] = $row;
}

echo json_encode($data);

?>