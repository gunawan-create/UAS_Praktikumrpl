<?php
include '../config/koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM anggota WHERE id_anggota='$id'");

header("Location: index.php");
exit;
