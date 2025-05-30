<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
include 'db.php';
$id = $_GET['id'];
$anggota_mpk = $conn->query("SELECT * FROM anggota_mpk WHERE id=$id")->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $absen = $_POST['divisi'];
    if ($_FILES['foto']['name']) {
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto);
        $conn->query("UPDATE siswa SET nama='$nama', kelas='$kelas', divisi='$divisi', foto='$foto' WHERE id=$id");
    } else {
        $conn->query("UPDATE siswa SET nama='$nama', kelas='$kelas', divisi='$divisi' WHERE id=$id");
    }
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="style.css" rel="stylesheet" /></head>
<body>
    <footer class="text-center mt-0 py-0" style="background-color: DarkSlateGray; color: white;">
    IP Lokal : <?= $_SERVER['SERVER_ADDR'] ?><br>
    <?php echo 'IP Public : ' . file_get_contents('http://checkip.amazonaws.com'); ?>
</footer>

<?php include 'menu.php'; ?>
<div class="container mt-4">
        <div style='text-align:center;'>
        <h2 >Tumbuh Bersama</h2>
        <h4>Absensi Majelis Perwakilan Kelas</h4>
        <p>SMKN 1 Banyumas - Periode. 2024 2025</p>
        <hr>
    </div>
    <h2>Edit Data Anggota</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nama" value="<?= $anggota_mpk['nama'] ?>" class="form-control mb-2" required>
        <input type="text" name="kelas" value="<?= $anggota_mpk['kelas'] ?>" class="form-control mb-2" required>
        <input type="text" name="divisi" value="<?= $anggota_mpk['divisi'] ?>" class="form-control mb-2" required>
        <input type="file" name="foto" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>