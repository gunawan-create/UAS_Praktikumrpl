<?php
include '../config/koneksi.php';

$data = mysqli_query($conn, "
    SELECT p.*, 
           a.nama_anggota, 
           b.judul
    FROM peminjaman p
    LEFT JOIN anggota a ON p.id_anggota = a.id_anggota
    LEFT JOIN buku b ON p.id_buku = b.id_buku
    ORDER BY p.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Peminjaman</title>
<style>
*{font-family:Arial;box-sizing:border-box;}
body{background:#f4f6f9;}
.container{width:95%;margin:30px auto;background:#fff;padding:20px;border-radius:10px;}
.header{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;}
.btn{padding:8px 14px;border-radius:6px;color:white;text-decoration:none;font-size:14px;}
.btn-back{background:#6c757d;}
.btn-add{background:#28a745;}
.btn-kembali{background:#007bff;}
.btn-hapus{background:#dc3545;}
table{width:100%;border-collapse:collapse;}
th,td{padding:10px;border-bottom:1px solid #ddd;text-align:center;}
th{background:#e9ecef;}
</style>
</head>
<body>

<div class="container">

<div class="header">
    <a href="../index.php" class="btn btn-back">← Dashboard</a>
    <a href="tambah.php" class="btn btn-add">+ Tambah Peminjaman</a>
</div>

<h2>📕 Data Peminjaman</h2>

<table>
<tr>
    <th>No</th>
    <th>Anggota</th>
    <th>Buku</th>
    <th>Tgl Pinjam</th>
    <th>Jatuh Tempo</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)){ ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_anggota']; ?></td>
    <td><?= $row['judul']; ?></td>
    <td><?= $row['tanggal_pinjam']; ?></td>
    <td><?= $row['tanggal_jatuh_tempo']; ?></td>
    <td><?= $row['status_pinjam']; ?></td>
    <td>
        <?php if($row['status_pinjam']=="Dipinjam"){ ?>
            <a href="kembali.php?id=<?= $row['id_peminjaman']; ?>" class="btn btn-kembali">Kembalikan</a>
        <?php } ?>
        <a href="hapus.php?id=<?= $row['id_peminjaman']; ?>" 
           onclick="return confirm('Hapus data?')" 
           class="btn btn-hapus">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

</div>
</body>
</html>
