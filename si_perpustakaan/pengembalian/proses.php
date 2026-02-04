<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
    die("ID peminjaman tidak ditemukan");
}

$id = $_GET['id'];
$today = date('Y-m-d');

// ==================================
// AMBIL DATA PEMINJAMAN (BUAT STOK)
// ==================================
$data = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT id_buku 
    FROM peminjaman 
    WHERE id_peminjaman='$id'
"));

if(!$data){
    die("Data peminjaman tidak ditemukan");
}

$id_buku = $data['id_buku'];

// ==================================
// UPDATE STATUS + TANGGAL KEMBALI
// ==================================
$update = mysqli_query($conn, "
    UPDATE peminjaman 
    SET status_pinjam='Dikembalikan', tanggal_kembali='$today'
    WHERE id_peminjaman='$id'
");

if($update){

    // ==================================
    // ✅ TAMBAHAN: STOK BUKU DIKEMBALIKAN
    // ==================================
    mysqli_query($conn,"
        UPDATE buku SET stok = stok + 1 WHERE id_buku='$id_buku'
    ");

    header("Location: index.php?success=1");
    exit;
} else {
    die("Gagal mengupdate data: " . mysqli_error($conn));
}
