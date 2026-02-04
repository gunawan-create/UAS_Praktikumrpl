<?php
include '../config/koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM buku");
if (!$data) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Buku</title>
<style>
* { box-sizing: border-box; font-family: Arial, sans-serif; }
body { background: #f4f6f9; }

.container {
    width: 95%;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.btn {
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    font-size: 14px;
}
.btn-back { background: #6c757d; }
.btn-add { background: #28a745; }
.btn-edit { background: #007bff; }
.btn-hapus { background: #dc3545; }

table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}
th { background: #e9ecef; }
</style>
</head>
<body>

<div class="container">

    <div class="header">
        <a href="../index.php" class="btn btn-back">← Dashboard</a>
        <a href="tambah.php" class="btn btn-add">+ Tambah Buku</a>
    </div>

    <h2>📖 Data Buku</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['judul']; ?></td>
            <td><?= $row['pengarang']; ?></td>
            <td><?= $row['penerbit']; ?></td>
            <td><?= $row['tahun_terbit']; ?></td>
            <td><?= $row['stok']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_buku']; ?>" class="btn btn-edit">Edit</a>
                <a href="hapus.php?id=<?= $row['id_buku']; ?>"
                   class="btn btn-hapus"
                   onclick="return confirm('Yakin hapus buku?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>
</body>
</html>
