<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota='$id'")
);

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE anggota SET
        nama_anggota='$_POST[nama]',
        alamat='$_POST[alamat]',
        no_telp='$_POST[hp]'
        WHERE id_anggota='$id'
    ");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Anggota</title>
<style>
*{box-sizing:border-box;font-family:Arial;}
body{
    margin:0;
    background:#f4f6f9;
}
.wrapper{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:flex-start;
    padding-top:60px;
}
.card{
    width:100%;
    max-width:520px;
    background:#fff;
    padding:28px;
    border-radius:14px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}
.back{
    color:#007bff;
    text-decoration:none;
    font-size:14px;
}
h2{
    margin:12px 0 22px;
}
.form-group{
    margin-bottom:16px;
}
.form-group input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
}
button{
    width:100%;
    padding:13px;
    background:#0d6efd;
    color:#fff;
    border:none;
    border-radius:8px;
    font-size:15px;
    cursor:pointer;
}
button:hover{background:#0b5ed7;}
</style>
</head>
<body>

<div class="wrapper">
    <div class="card">
        <a href="index.php" class="back">← Kembali</a>
        <h2>Edit Anggota</h2>

        <form method="post">
            <div class="form-group">
                <input type="text" name="nama" value="<?= $data['nama_anggota']; ?>" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <input type="text" name="alamat" value="<?= $data['alamat']; ?>" placeholder="Alamat" required>
            </div>
            <div class="form-group">
                <input type="text" name="hp" value="<?= $data['no_telp']; ?>" placeholder="No HP" required>
            </div>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</div>

</body>
</html>
