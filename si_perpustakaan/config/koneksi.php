<?php
$host = "sql202.infinityfree.com";
$user = "if0_41002741";
$pass = "Sipus2026";
$db   = "if0_41002741_si_perpustakaan";

$conn = mysqli_connect($host,$user,$pass,$db);
if(!$conn){ die("Koneksi gagal: ".mysqli_connect_error()); }
?>
