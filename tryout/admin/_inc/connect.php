<?php
 $connect = new mysqli("mysql.idhostinger.com", "u578925922_to", "hasrulganteng", "u578925922_to");
 if (!$connect) {
    die("Gagal koneksi ke database.\n" . $connect->error);
}
?>