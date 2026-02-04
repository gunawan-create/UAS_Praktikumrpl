<style>
.navbar {
    background: #1d2671;
    padding: 12px 20px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.navbar .brand {
    font-size: 18px;
    font-weight: bold;
}
.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    font-size: 14px;
}
.navbar a:hover {
    text-decoration: underline;
}
</style>

<div class="navbar">
    <div class="brand">📚 SI Perpustakaan</div>
    <div class="menu">
        <a href="/si_perpustakaan/index.php">Dashboard</a>
        <a href="/si_perpustakaan/anggota/index.php">Anggota</a>
        <a href="/si_perpustakaan/buku/index.php">Buku</a>
        <a href="/si_perpustakaan/peminjaman/index.php">Peminjaman</a>
        <a href="/si_perpustakaan/auth/logout.php">Logout</a>
    </div>
</div>
