<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

$id = $_POST['id'];
$query = "SELECT * FROM tbl_mahasiswa_base64 WHERE id=? ORDER BY id DESC";
$dewan1 = $db1->prepare($query);
$dewan1->bind_param('i', $id);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    $h['id'] = $row["id"];
    $h['nama_mahasiswa'] = base64_decode($row["nama_mahasiswa"]);
    $h['alamat'] = base64_decode($row["alamat"]);
    $h['jurusan'] = base64_decode($row["jurusan"]);
    $h['jenis_kelamin'] = base64_decode($row["jenis_kelamin"]);
    $h['tgl_masuk'] = base64_decode($row["tgl_masuk"]);
}
echo json_encode($h);

$db1->close();
?>