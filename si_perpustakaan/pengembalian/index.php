<?php
include '../config/koneksi.php';

$data = mysqli_query($conn, "
    SELECT p.*, a.nama_anggota, b.judul
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id_anggota
    JOIN buku b ON p.id_buku = b.id_buku
    WHERE p.status_pinjam='Dipinjam'
");

if(!$data){
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengembalian Buku</title>
<style>
*{font-family:Arial;box-sizing:border-box;}
body{background:#f4f6f9;margin:0;}
.container{width:95%;margin:30px auto;background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);}
.header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
.left-action a{margin-right:8px;}
.btn{padding:8px 14px;border-radius:6px;color:white;text-decoration:none;font-size:14px;}
.btn-back{background:#6c757d;}
.btn-riwayat{background:#007bff;}
.btn-kembali{background:#28a745;}
.btn-kembali:hover{background:#218838;}
table{width:100%;border-collapse:collapse;}
th,td{padding:12px;border-bottom:1px solid #ddd;text-align:center;}
th{background:#e9ecef;font-weight:bold;}
.status-tepat{color:green;font-weight:bold;}
.status-telat{color:red;font-weight:bold;}
.row-tepat{background:#e8f5e9;}
.row-telat{background:#ffe6e6;}
</style>
</head>
<body>

<div class="container">
<div class="header">
    <div class="left-action">
        <a href="../index.php" class="btn btn-back">← Dashboard</a>
        <a href="riwayat.php" class="btn btn-riwayat">📘 Riwayat Pengembalian</a>
    </div>
    <h2>📗 Pengembalian Buku</h2>
</div>

<?php if(mysqli_num_rows($data)==0){ ?>
    <p style="text-align:center;margin-top:20px;">Belum ada buku yang sedang dipinjam.</p>
<?php } else { ?>
<table>
<tr>
    <th>No</th>
    <th>Anggota</th>
    <th>Buku</th>
    <th>Tgl Pinjam</th>
    <th>Tgl Jatuh Tempo</th>
    <th>Status</th>
    <th>Denda</th>
    <th>Aksi</th>
</tr>

<?php
$no=1;
$today = strtotime(date('Y-m-d'));

while($row=mysqli_fetch_assoc($data)){
    $tanggalPinjam = strtotime($row['tanggal_pinjam']);
    $jatuhTempo = strtotime("+7 days", $tanggalPinjam);
    $hariTelat = max(0, ceil(($today - $jatuhTempo)/86400));
    $denda = $hariTelat * 1000;
    $telat = $hariTelat > 0;
    $rowClass = $telat ? 'row-telat' : 'row-tepat';
?>
<tr class="<?= $rowClass; ?>">
    <td><?= $no++; ?></td>
    <td><?= $row['nama_anggota']; ?></td>
    <td><?= $row['judul']; ?></td>
    <td><?= $row['tanggal_pinjam']; ?></td>
    <td><?= date('Y-m-d',$jatuhTempo); ?></td>
    <td>
        <?php if($telat){ ?>
            <span class="status-telat">🔴 Terlambat <?= $hariTelat; ?> hari</span>
        <?php } else { ?>
            <span class="status-tepat">🟢 Tepat Waktu</span>
        <?php } ?>
    </td>
    <td>Rp <?= number_format($denda,0,',','.'); ?></td>
    <td>
        <a href="proses.php?id=<?= $row['id_peminjaman']; ?>" class="btn btn-kembali" onclick="return confirm('Proses pengembalian buku ini?')">Kembalikan</a>
    </td>
</tr>
<?php } ?>
</table>
<?php } ?>
</div>
</body>
</html>
