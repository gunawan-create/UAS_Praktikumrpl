<?php
include '../config/koneksi.php';

if (isset($_POST['reset'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE petugas 
            SET password='$password' 
            WHERE username='$username'");
        echo "<script>
            alert('Password berhasil direset');
            window.location='login.php';
        </script>";
    } else {
        echo "<script>alert('Username tidak ditemukan');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Reset Password</title>

<style>
*{
    box-sizing:border-box;
    font-family:Arial;
}
body{
    margin:0;
    min-height:100vh;
    background: linear-gradient(120deg,#8360c3,#2ebf91);
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
.form-group{
    margin-bottom:15px;
}
.form-group input{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}
button{
    width:100%;
    padding:13px;
    background:#2ebf91;
    color:white;
    border:none;
    border-radius:8px;
    font-size:15px;
    cursor:pointer;
}
button:hover{
    background:#25a07a;
}
.back{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
    color:#555;
    font-size:14px;
}
</style>
</head>

<body>

<div class="card">
    <h2>Reset Password</h2>

    <form method="post">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password Baru" required>
        </div>
        <button type="submit" name="reset">Reset Password</button>
    </form>

    <a href="login.php" class="back">← Kembali ke Login</a>
</div>

</body>
</html>
