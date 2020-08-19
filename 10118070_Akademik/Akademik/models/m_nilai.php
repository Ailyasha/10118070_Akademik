<?php
class Nilai {

	private $mysqli;

	function __construct($conn) {
		$this->mysqli = $conn;
	}

	public function tampil($id =  null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM nilai";
		if($id != null) {
			$sql .= " WHERE nim = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}
	public function tambah($nim, $kode_kuliah, $uts, $uas, $na, $hm) {
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO nilai VALUES ('$nim', '$kode_kuliah', '$uts', '$uas', '$na', '$hm')") or die ($db->error);
}

	public function hapus($na) {
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM nilai WHERE na = '$na' ") or die ($db->error);
	}

	function __desctruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>
