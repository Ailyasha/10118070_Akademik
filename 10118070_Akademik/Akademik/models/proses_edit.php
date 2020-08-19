<?php
ob_start();
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include "../models/m_mahasiswa.php";
$mhs = new Mahasiswa($connection);
$connection = new Database($host, $user, $pass, $database);

$id_mhs = $_POST['id_mhs'];
$nim = $connection->conn->real_escape_string();
$nama = $connection->conn->real_escape_string($_POST['nama']);
$ttl = $connection->conn->real_escape_string($_POST['ttl']);
$jenis_kelamin = $connection->conn->real_escape_string($_POST['jenis_kelamin']);
$alamat = $connection->conn->real_escape_string($_POST['alamat']);
$email = $connection->conn->real_escape_string($_POST['email']);

if($pict == '') {
	$mhs->edit("UPDATE mahasiswa SET nim = '$nim', nama = '$nama', ttl = '$ttl', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', email = '$email' WHERE ");
} else {

}
?>