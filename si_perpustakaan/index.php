<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:auth/login.php");
    exit;
}

include 'config/koneksi.php';

/* ===============================
   HITUNG DATA UTAMA
================================ */
$jmlAnggota = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM anggota")
)['total'];

$jmlBuku = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM buku")
)['total'];

$jmlPinjam = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM peminjaman")
)['total'];

// pengembalian dihitung dari peminjaman yang statusnya Dikembalikan
$jmlKembali = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM peminjaman WHERE status_pinjam='Dikembalikan'")
)['total'];

/* ===============================
   HITUNG TELAT & TOTAL DENDA
================================ */
$queryTelat = mysqli_query($conn,"
    SELECT tanggal_pinjam, tanggal_kembali
    FROM peminjaman
    WHERE status_pinjam='Dikembalikan'
");

$totalTelat = 0;
$totalDenda = 0;

while($row = mysqli_fetch_assoc($queryTelat)){
    $tglPinjam  = strtotime($row['tanggal_pinjam']);
    $tglKembali = strtotime($row['tanggal_kembali']);
    $jatuhTempo = strtotime("+7 days", $tglPinjam);

    $hariTelat = max(0, ceil(($tglKembali - $jatuhTempo) / 86400));

    if($hariTelat > 0){
        $totalTelat++;
        $totalDenda += $hariTelat * 1000;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard | Sistem Informasi Perpustakaan</title>

<style>
*{box-sizing:border-box;font-family:'Segoe UI',Arial,sans-serif}
body{margin:0;background:#f3f5f9;color:#333}

/* HEADER */
.header{
    background:linear-gradient(120deg,#283593,#5c6bc0);
    color:#fff;
    padding:45px 20px;
    text-align:center;
    position:relative;
}
.header h1{margin:0;font-size:32px}
.header p{margin-top:10px;font-size:15px;opacity:.95}

.logout{
    position:absolute;
    top:20px;
    right:20px;
}
.logout a{
    background:rgba(255,255,255,.2);
    color:#fff;
    padding:10px 16px;
    border-radius:10px;
    text-decoration:none;
    font-size:14px;
    transition:.3s;
}
.logout a:hover{background:rgba(255,255,255,.35)}

/* CONTAINER */
.container{padding:40px;max-width:1200px;margin:auto}

.dashboard-desc{
    background:#fff;
    padding:22px 26px;
    border-radius:14px;
    margin-bottom:30px;
    box-shadow:0 6px 18px rgba(0,0,0,.06);
    line-height:1.7;
    color:#555;
}

/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:25px;
}

.card{
    background:#fff;
    border-radius:18px;
    padding:28px 24px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
}
.card:hover{transform:translateY(-8px)}

.icon{
    width:55px;
    height:55px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:26px;
    margin-bottom:15px;
    background:#e8eaf6;
}

.card h3{margin:0;font-size:18px}
.card p{font-size:14px;color:#666;margin:10px 0 16px}

.total{
    font-size:34px;
    font-weight:700;
    color:#283593;
}
.total.telat{color:#d32f2f}

.card a{
    display:inline-block;
    padding:10px 18px;
    background:#283593;
    color:#fff;
    border-radius:8px;
    font-size:14px;
    text-decoration:none;
}
.card a:hover{background:#1a237e}

/* FOOTER */
.footer{
    text-align:center;
    margin-top:40px;
    padding:20px;
    color:#888;
    font-size:14px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="logout">
        <a href="auth/logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>
    </div>
    <h1>📚 SIMPERPUS</h1>
    <p>Dashboard Petugas | Sistem Informasi Perpustakaan</p>
</div>

<!-- CONTENT -->
<div class="container">

<div class="dashboard-desc">
Halaman dashboard SIMPERPUS digunakan untuk memantau dan 
mengelola seluruh aktivitas perpustakaan, meliputi data 
anggota, koleksi buku, transaksi peminjaman, pengembalian, 
serta perhitungan keterlambatan dan denda secara otomatis.
</div>

<div class="cards">

<div class="card">
    <div class="icon">👤</div>
    <h3>Data Anggota</h3>
    <div class="total"><?= $jmlAnggota ?></div>
    <p>Total anggota terdaftar</p>
    <a href="anggota/index.php">Kelola</a>
</div>

<div class="card">
    <div class="icon">📖</div>
    <h3>Data Buku</h3>
    <div class="total"><?= $jmlBuku ?></div>
    <p>Total koleksi buku</p>
    <a href="buku/index.php">Kelola</a>
</div>

<div class="card">
    <div class="icon">📕</div>
    <h3>Peminjaman</h3>
    <div class="total"><?= $jmlPinjam ?></div>
    <p>Total transaksi peminjaman</p>
    <a href="peminjaman/index.php">Kelola</a>
</div>

<div class="card">
    <div class="icon">📗</div>
    <h3>Pengembalian</h3>
    <div class="total"><?= $jmlKembali ?></div>
    <p>Total buku dikembalikan</p>
    <a href="pengembalian/index.php">Kelola</a>
</div>

<div class="card">
    <div class="icon">⏰</div>
    <h3>Keterlambatan</h3>
    <div class="total telat"><?= $totalTelat ?></div>
    <p>Buku terlambat dikembalikan</p>
    <a href="pengembalian/riwayat.php">Detail</a>
</div>

<div class="card">
    <div class="icon">💰</div>
    <h3>Total Denda</h3>
    <div class="total">Rp <?= number_format($totalDenda,0,',','.') ?></div>
    <p>Total denda keterlambatan</p>
    <a href="pengembalian/riwayat.php">Detail</a>
</div>

</div>
</div>

<div class="footer">
© <?= date('Y') ?> SIMPERPUS | Ali Gunawan
</div>

</body>
</html>
