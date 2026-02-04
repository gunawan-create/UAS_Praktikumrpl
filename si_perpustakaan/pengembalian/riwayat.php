<?php
include '../config/koneksi.php';

// =====================
// AMBIL DATA ANGGOTA (FILTER)
// =====================
$listAnggota = mysqli_query($conn,"SELECT * FROM anggota");

// =====================
// FILTER
// =====================
$where = "";
if(isset($_GET['anggota']) && $_GET['anggota']!=""){
    $id_anggota = $_GET['anggota'];
    $where = " AND p.id_anggota='$id_anggota'";
}

// =====================
// DATA RIWAYAT
// =====================
$data = mysqli_query($conn, "
    SELECT p.*, a.nama_anggota, b.judul
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id_anggota
    JOIN buku b ON p.id_buku = b.id_buku
    WHERE p.status_pinjam='Dikembalikan' $where
    ORDER BY p.tanggal_kembali DESC
");

if(!$data){
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Riwayat Pengembalian</title>
<style>
*{font-family:Arial;box-sizing:border-box;}
body{background:#f4f6f9;margin:0;}
.container{width:95%;margin:30px auto;background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);}
.header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
.left-action a{margin-right:8px;}
.btn{padding:8px 14px;border-radius:6px;color:white;text-decoration:none;font-size:14px;}
.btn-back{background:#6c757d;}
.btn-hapus{background:#dc3545;}
.btn-hapus:hover{background:#b02a37;}
table{width:100%;border-collapse:collapse;}
th,td{padding:12px;border-bottom:1px solid #ddd;text-align:center;}
th{background:#e9ecef;font-weight:bold;}
.status-tepat{color:green;font-weight:bold;}
.status-telat{color:red;font-weight:bold;}
.row-tepat{background:#e8f5e9;}
.row-telat{background:#ffe6e6;}
.filter{margin-bottom:15px;}
select{padding:8px;border-radius:6px;}
</style>
</head>
<body>

<div class="container">
<div class="header">
    <div class="left-action">
        <a href="../index.php" class="btn btn-back">← Dashboard</a>
    </div>
    <h2>📘 Riwayat Pengembalian</h2>
</div>

<!-- FILTER -->
<div class="filter">
<form method="get">
    <label>Filter Anggota: </label>
    <select name="anggota" onchange="this.form.submit()">
        <option value="">-- Semua Anggota --</option>
        <?php while($a=mysqli_fetch_assoc($listAnggota)){ ?>
            <option value="<?= $a['id_anggota']; ?>"
                <?= isset($_GET['anggota']) && $_GET['anggota']==$a['id_anggota']?'selected':'' ?>>
                <?= $a['nama_anggota']; ?>
            </option>
        <?php } ?>
    </select>
</form>
</div>

<?php if(mysqli_num_rows($data)==0){ ?>
    <p style="text-align:center;margin-top:20px;">Belum ada data pengembalian.</p>
<?php } else { ?>

<table>
<tr>
    <th>No</th>
    <th>Anggota</th>
    <th>Buku</th>
    <th>Tgl Pinjam</th>
    <th>Jatuh Tempo</th>
    <th>Tgl Kembali</th>
    <th>Status</th>
    <th>Hari Telat</th>
    <th>Denda</th>
    <th>Aksi</th>
</tr>

<?php
$no=1;
$totalDenda = 0;

while($row=mysqli_fetch_assoc($data)){
    $pinjam = strtotime($row['tanggal_pinjam']);
    $kembali = strtotime($row['tanggal_kembali']);
    $jatuhTempo = strtotime("+7 days", $pinjam);

    $hariTelat = max(0, ceil(($kembali - $jatuhTempo)/86400));
    $denda = $hariTelat * 1000;
    $totalDenda += $denda;

    $telat = $hariTelat > 0;
?>
<tr class="<?= $telat?'row-telat':'row-tepat'; ?>">
    <td><?= $no++; ?></td>
    <td><?= $row['nama_anggota']; ?></td>
    <td><?= $row['judul']; ?></td>
    <td><?= $row['tanggal_pinjam']; ?></td>
    <td><?= date('Y-m-d',$jatuhTempo); ?></td>
    <td><?= $row['tanggal_kembali']; ?></td>
    <td>
        <?= $telat ? "<span class='status-telat'>🔴 Terlambat</span>" 
                   : "<span class='status-tepat'>🟢 Tepat Waktu</span>"; ?>
    </td>
    <td><?= $hariTelat; ?> hari</td>
    <td>Rp <?= number_format($denda,0,',','.'); ?></td>
    <td>
        <a href="hapus.php?id=<?= $row['id_peminjaman']; ?>" 
           class="btn btn-hapus"
           onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
    </td>
</tr>
<?php } ?>

<tr>
    <td colspan="8" style="text-align:right;font-weight:bold;">Total Denda:</td>
    <td style="font-weight:bold;">Rp <?= number_format($totalDenda,0,',','.'); ?></td>
    <td></td>
</tr>

</table>
<?php } ?>
</div>

</body>
</html>
