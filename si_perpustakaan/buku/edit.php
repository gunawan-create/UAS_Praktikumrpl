<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'")
);

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE buku SET
        judul='$_POST[judul]',
        pengarang='$_POST[pengarang]',
        penerbit='$_POST[penerbit]',
        tahun_terbit='$_POST[tahun]',
        stok='$_POST[stok]'
        WHERE id_buku='$id'
    ");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Buku</title>
<style>
/* SAMA PERSIS DENGAN EDIT ANGGOTA */
*{box-sizing:border-box;font-family:Arial;}
body{margin:0;background:#f4f6f9;}
.wrapper{min-height:100vh;display:flex;justify-content:center;align-items:flex-start;padding-top:60px;}
.card{width:100%;max-width:520px;background:#fff;padding:28px;border-radius:14px;box-shadow:0 8px 20px rgba(0,0,0,.08);}
.back{color:#007bff;text-decoration:none;font-size:14px;}
h2{margin:12px 0 22px;}
.form-group{margin-bottom:16px;}
.form-group input{width:100%;padding:12px;border:1px solid #ccc;border-radius:8px;font-size:14px;}
button{width:100%;padding:13px;background:#0d6efd;color:#fff;border:none;border-radius:8px;font-size:15px;cursor:pointer;}
button:hover{background:#0b5ed7;}
</style>
</head>
<body>

<div class="wrapper">
<div class="card">
<a href="index.php" class="back">← Kembali</a>
<h2>Edit Buku</h2>

<form method="post">
    <div class="form-group"><input type="text" name="judul" value="<?= $data['judul']; ?>" placeholder="Judul Buku" required></div>
    <div class="form-group"><input type="text" name="pengarang" value="<?= $data['pengarang']; ?>" placeholder="Pengarang" required></div>
    <div class="form-group"><input type="text" name="penerbit" value="<?= $data['penerbit']; ?>" placeholder="Penerbit" required></div>
    <div class="form-group"><input type="number" name="tahun" value="<?= $data['tahun_terbit']; ?>" placeholder="Tahun Terbit" required></div>
    <div class="form-group"><input type="number" name="stok" value="<?= $data['stok']; ?>" placeholder="Stok" required></div>
    <button name="update">Update</button>
</form>
</div>
</div>

</body>
</html>
