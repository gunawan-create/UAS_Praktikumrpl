<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, 
        "SELECT * FROM petugas 
         WHERE username='$username' AND password='$password'"
    );

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("location:../index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | Sistem Informasi Perpustakaan</title>

<style>
*{
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}
body{
    margin:0;
    min-height:100vh;
    background:linear-gradient(120deg,#283593,#5c6bc0);
    display:flex;
    align-items:center;
    justify-content:center;
}

/* LOGIN CARD */
.container{
    width:380px;
    background:#fff;
    padding:32px 28px;
    border-radius:16px;
    box-shadow:0 14px 35px rgba(0,0,0,.15);
    transform:translateY(-6px);
}

/* TITLE */
h2{
    text-align:center;
    margin:0;
    font-size:22px;
}
p{
    text-align:center;
    margin:8px 0 22px;
    color:#666;
    font-size:14px;
}

/* ERROR */
.error{
    background:#fdecea;
    color:#c62828;
    padding:10px;
    border-radius:8px;
    text-align:center;
    margin-bottom:15px;
    font-size:14px;
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
    padding:12px;
    border-radius:10px;
    border:1px solid #ccc;
    font-size:14px;
}
input:focus{
    outline:none;
    border-color:#283593;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#283593;
    color:#fff;
    border:none;
    border-radius:12px;
    font-size:15px;
    cursor:pointer;
    margin-top:10px;
}
button:hover{
    background:#1a237e;
}

/* LINKS */
.links{
    text-align:center;
    margin-top:18px;
    font-size:14px;
}
.links a{
    text-decoration:none;
    color:#283593;
}
.links a:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<div class="container">
    <h2>SIMPERPUS</h2>
    <p>Login Petugas</p>

    <?php if (isset($error)) { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <form method="post">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button name="login">🔐 Login</button>
    </form>

    <div class="links">
        <a href="register.php">Buat Akun</a> • 
        <a href="lupa_password.php">Lupa Password?</a>
    </div>
</div>

</body>
</html>
