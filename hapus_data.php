<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

$id = $_POST['id'];

$query = "DELETE FROM tbl_mahasiswa_base64 WHERE id=?";
$dewan1 = $db1->prepare($query);
$dewan1->bind_param("i", $id);
$dewan1->execute();

echo json_encode(['success' => 'Sukses']);

$db1->close();
?>