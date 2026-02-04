<?php
include '../config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"UPDATE peminjaman SET 
status_pinjam='Dikembalikan'
WHERE id_peminjaman='$id'");

header("Location: index.php");
exit;
