<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO anggota 
    (nama_anggota, alamat, no_telp)
    VALUES (
        '$_POST[nama]',
        '$_POST[alamat]',
        '$_POST[hp]'
    )");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Anggota</title>

<style>
*{
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}
body{
    background:#f4f6f9;
    margin:0;
}

/* CONTAINER FORM */
.container{
    width:420px;
    margin:60px auto;
    background:#fff;
    padding:28px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

/* BACK */
.back{
    display:inline-block;
    margin-bottom:12px;
    color:#3f51b5;
    text-decoration:none;
    font-size:14px;
}

/* TITLE */
h3{
    text-align:center;
    margin:10px 0 22px;
}

/* FORM */
.form-group{
    margin-bottom:16px;
}
label{
    display:block;
    margin-bottom:6px;
    font-size:14px;
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

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#28a745;
    color:white;
    border:none;
    border-radius:10px;
    font-size:15px;
    cursor:pointer;
    margin-top:10px;
}
button:hover{
    background:#218838;
}
</style>
</head>

<body>

<div class="container">
    <a href="index.php" class="back">← Kembali</a>
    <h3>Tambah Data Anggota</h3>

    <form method="post">

        <div class="form-group">
            <label>Nama Anggota</label>
            <input type="text" name="nama" placeholder="Masukkan nama anggota" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" placeholder="Masukkan alamat" required>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="hp" placeholder="Masukkan nomor HP" required>
        </div>

        <button name="simpan">💾 Simpan Anggota</button>
    </form>
</div>

</body>
</html>
