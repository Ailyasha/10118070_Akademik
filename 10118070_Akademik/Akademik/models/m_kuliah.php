<?php
class Kuliah {

	private $mysqli;

	function __construct($conn) {
		$this->mysqli = $conn;
	}

	public function tampil($id =  null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM kuliah";
		if($id != null) {
			$sql .= " WHERE kode_kuliah = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tambah($kode_kuliah, $nama_kuliah, $sks) {
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO kuliah VALUES ('$kode_kuliah', '$nama_kuliah', '$sks')") or die ($db->error);
}
	public function hapus($kode_kuliah) {
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM kuliah WHERE kode_kuliah = '$kode_kuliah' ") or die ($db->error);
	}

	function __desctruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>