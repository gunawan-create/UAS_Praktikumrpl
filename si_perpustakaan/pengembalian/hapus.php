<?php
include '../config/koneksi.php';

if(!isset($_GET['id'])){
    die("ID peminjaman tidak ditemukan");
}

$id = $_GET['id'];

// 1️⃣ Hapus dulu di tabel pengembalian (kalau ada)
mysqli_query($conn, "DELETE FROM pengembalian WHERE id_peminjaman='$id'");

// 2️⃣ Baru hapus di tabel peminjaman
$hapus = mysqli_query($conn, "DELETE FROM peminjaman WHERE id_peminjaman='$id'");

if($hapus){
    header("Location: riwayat.php?deleted=1");
    exit;
}else{
    die("Gagal menghapus data: ".mysqli_error($conn));
}
