<?php
class Mahasiswa {

	private $mysqli;

	function __construct($conn) {
		$this->mysqli = $conn;
	}

	public function tampil($id =  null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM mahasiswa";
		if($id != null) {
			$sql .= " WHERE nim = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tambah($nim, $nama, $ttl, $jenis_kelamin, $alamat, $email) {
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO mahasiswa VALUES ('$nim', '$nama', '$ttl', '$jenis_kelamin', '$alamat', '$email')") or die ($db->error);

	}

	public function edit($sql) {
		$db = $this->mysqli->conn;
		$db->query($sql) or die ($db->error); 
	}

	public function hapus($nim) {
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM mahasiswa WHERE nim = '$nim' ") or die ($db->error);
	}

	function __desctruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>