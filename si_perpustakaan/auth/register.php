<?php
include '../config/koneksi.php';

if (isset($_POST['daftar'])) {
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO petugas (nama_petugas, username, password)
                         VALUES ('$nama', '$username', '$password')");

    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Akun</title>

<style>
*{box-sizing:border-box;font-family:Arial;}
body{
    margin:0;
    min-height:100vh;
    background: linear-gradient(120deg,#11998e,#38ef7d);
    display:flex;
    justify-content:center;
    align-items:center;
}
.card{
    width:100%;
    max-width:380px;
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
.card h2{
    text-align:center;
    margin-bottom:22px;
}
input{
    width:100%;
    padding:12px;
    margin-bottom:14px;
    border-radius:8px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:13px;
    background:#11998e;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}
button:hover{background:#0d7f75;}
a{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
    color:#555;
}
</style>
</head>

<body>

<div class="card">
    <h2>Daftar Akun Petugas</h2>

    <form method="post">
        <input type="text" name="nama" placeholder="Nama Petugas" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="daftar">Daftar</button>
    </form>

    <a href="login.php">← Kembali ke Login</a>
</div>

</body>
</html>
