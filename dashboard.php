<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';

$anggota_mpk = $conn->query("SELECT * FROM anggota_mpk");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota MPK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="style.css" rel="stylesheet" />
</head>
<body>


<footer class="text-center mt-0 py-0" style="background-color: DarkSlateGray; color: white;">
    IP Lokal : <?= $_SERVER['SERVER_ADDR'] ?><br>
    <?php echo 'IP Public : ' . file_get_contents('http://checkip.amazonaws.com'); ?>
</footer>
<?php include 'menu.php'; ?>

<div class="container mt-4">
    <div style='text-align:center;'>
        <h2>Tumbuh Bersama</h2>
        <h4>Absensi Majelis Perwakilan Kelas</h4>
        <p>SMKN 1 Banyumas - Periode. 2024 2025</p>
        <hr>
    </div>

    <h4>Data Anggota MPK</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Divisi</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $siswa->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['kelas']) ?></td>
            <td><?= htmlspecialchars($row['divisi']) ?></td>
            <td><img src="uploads/<?= $row['foto'] ?>" width="50"></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>



</body>
</html>
