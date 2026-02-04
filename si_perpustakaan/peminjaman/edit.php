<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$row = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'")
);

if (isset($_POST['update'])) {
    mysqli_query($conn,
        "UPDATE peminjaman SET status='$_POST[status]'
         WHERE id_peminjaman='$id'"
    );
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Peminjaman</title>
<style>
*{box-sizing:border-box;font-family:Arial;}
body{margin:0;background:#f4f6f9;}
.wrapper{min-height:100vh;display:flex;justify-content:center;align-items:flex-start;padding-top:60px;}
.card{width:100%;max-width:420px;background:#fff;padding:28px;border-radius:14px;box-shadow:0 8px 20px rgba(0,0,0,.08);}
.back{color:#007bff;text-decoration:none;font-size:14px;}
h2{margin:12px 0 22px;}
select{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
}
button{width:100%;padding:13px;margin-top:18px;background:#0d6efd;color:#fff;border:none;border-radius:8px;font-size:15px;}
</style>
</head>
<body>

<div class="wrapper">
<div class="card">
<a href="index.php" class="back">← Kembali</a>
<h2>Edit Peminjaman</h2>

<form method="post">
    <select name="status">
        <option value="dipinjam" <?= $row['status']=="dipinjam"?"selected":""; ?>>Dipinjam</option>
        <option value="dikembalikan" <?= $row['status']=="dikembalikan"?"selected":""; ?>>Dikembalikan</option>
    </select>
    <button name="update">Update</button>
</form>
</div>
</div>

</body>
</html>
