<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, 
    "SELECT * FROM petugas 
     WHERE username='$username' AND password='$password'"
);

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['nama'] = $data['nama_petugas'];
    header("location:../index.php");
} else {
    echo "Login gagal. <a href='login.php'>Coba lagi</a>";
}
