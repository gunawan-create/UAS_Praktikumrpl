<?php
session_start();
include '../config/koneksi.php';

$anggota = mysqli_query($conn,"SELECT * FROM anggota");
$buku    = mysqli_query($conn,"SELECT * FROM buku");

if(isset($_POST['simpan'])){
    $id_anggota  = $_POST['anggota'];
    $id_buku     = $_POST['buku'];
    $id_petugas  = 1;
    $tgl_pinjam  = date('Y-m-d');
    $jatuh_tempo = date('Y-m-d', strtotime('+7 days'));

    // ===============================
    // ✅ TAMBAHAN: CEK STOK BUKU
    // ===============================
    $cekStok = mysqli_fetch_assoc(mysqli_query($conn,"
        SELECT stok FROM buku WHERE id_buku='$id_buku'
    "));

    if($cekStok['stok'] <= 0){
        echo "<script>
                alert('Stok buku habis, peminjaman tidak bisa dilakukan!');
                history.back();
              </script>";
        exit;
    }

    // ===============================
    // INSERT PEMINJAMAN (KODE ASLI)
    // ===============================
    mysqli_query($conn,"
        INSERT INTO peminjaman
        (id_anggota,id_petugas,id_buku,tanggal_pinjam,tanggal_jatuh_tempo,status_pinjam)
        VALUES(
            '$id_anggota',
            '$id_petugas',
            '$id_buku',
            '$tgl_pinjam',
            '$jatuh_tempo',
            'Dipinjam'
        )
    ");

    // ===============================
    // ✅ TAMBAHAN: KURANGI STOK BUKU
    // ===============================
    mysqli_query($conn,"
        UPDATE buku SET stok = stok - 1 WHERE id_buku='$id_buku'
    ");

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Peminjaman</title>

<style>
*{
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}
body{
    background:#f4f6f9;
    margin:0;
}
.container{
    width:420px;
    margin:60px auto;
    background:white;
    padding:28px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}
.back{
    display:inline-block;
    margin-bottom:10px;
    color:#3f51b5;
    text-decoration:none;
    font-size:14px;
}
h3{
    text-align:center;
    margin:10px 0 22px;
}
.form-group{
    margin-bottom:16px;
}
label{
    display:block;
    margin-bottom:6px;
    font-size:14px;
    color:#555;
}
select{
    width:100%;
    padding:11px 12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}
select:focus{
    outline:none;
    border-color:#3f51b5;
}
button{
    width:100%;
    padding:12px;
    background:#3f51b5;
    color:white;
    border:none;
    border-radius:10px;
    font-size:15px;
    cursor:pointer;
    margin-top:10px;
}
button:hover{
    background:#2c387e;
}
</style>
</head>

<body>

<div class="container">
    <a href="index.php" class="back">← Kembali</a>
    <h3>Tambah Data Peminjaman</h3>

    <form method="post">

        <div class="form-group">
            <label>Nama Anggota</label>
            <select name="anggota" required>
                <option value="">-- Pilih Anggota --</option>
                <?php while($a=mysqli_fetch_assoc($anggota)){ ?>
                    <option value="<?= $a['id_anggota']; ?>">
                        <?= $a['nama_anggota']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Judul Buku</label>
            <select name="buku" required>
                <option value="">-- Pilih Buku --</option>
                <?php while($b=mysqli_fetch_assoc($buku)){ ?>
                    <option value="<?= $b['id_buku']; ?>">
                        <?= $b['judul']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button name="simpan">💾 Simpan Peminjaman</button>
    </form>
</div>

</body>
</html>
