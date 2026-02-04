<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO buku 
    (judul, pengarang, penerbit, tahun_terbit, stok)
    VALUES (
        '$_POST[judul]',
        '$_POST[pengarang]',
        '$_POST[penerbit]',
        '$_POST[tahun]',
        '$_POST[stok]'
    )");

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Buku</title>

<style>
*{
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}
body{
    background:#f4f6f9;
    margin:0;
}
.container{
    width:420px;
    margin:60px auto;
    background:#fff;
    padding:28px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}
h3{
    margin:10px 0 20px;
    text-align:center;
}
.back{
    display:inline-block;
    margin-bottom:10px;
    color:#3f51b5;
    text-decoration:none;
    font-size:14px;
}
.form-group{
    margin-bottom:14px;
}
label{
    display:block;
    font-size:14px;
    margin-bottom:6px;
    color:#555;
}
input{
    width:100%;
    padding:11px 12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}
input:focus{
    outline:none;
    border-color:#3f51b5;
}
button{
    width:100%;
    padding:12px;
    background:#3f51b5;
    color:white;
    border:none;
    border-radius:10px;
    font-size:15px;
    cursor:pointer;
    margin-top:10px;
}
button:hover{
    background:#2c387e;
}
</style>
</head>

<body>

<div class="container">
    <a href="index.php" class="back">← Kembali</a>
    <h3>Tambah Data Buku</h3>

    <form method="post">
        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul" required>
        </div>

        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" name="pengarang" required>
        </div>

        <div class="form-group">
            <label>Penerbit</label>
            <input type="text" name="penerbit" required>
        </div>

        <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" required>
        </div>

        <button name="simpan">💾 Simpan Data</button>
    </form>
</div>

</body>
</html>
