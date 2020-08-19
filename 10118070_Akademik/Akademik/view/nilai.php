<?php
include "models/m_nilai.php";

$nli = new Nilai($connection);

if(@$_GET['act'] == '') {
?>
<div class="row">
          <div class="col-lg-12">
            <h1>Nilai <small>Admin</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Nilai</a></li>
            </ol>
          </div>
        </div>

        <div class="row">
        	<div class="col-lg-12">
        		<div class="table-reponsive">
        			<table class="table table-bordered table-hover table-striped">
        				<tr>
                            <th>No.</th>
        					<th>NIM</th>
        					<th>Kode Kuliah</th>
        					<th>UTS</th>
        					<th>UAS</th>
        					<th>Nilai Akhir</th>
        					<th>Indeks</th>
        				</tr>
                        <?php 
                        $no = 1; 
                        $tampil = $nli->tampil(); 
                        while($data =$tampil->fetch_object()) {
                        ?> 
        				<tr>
                            <td align="center"><?php echo $no++; ?></td>
                            <td><?php echo $data->nim; ?></td> 
                            <td><?php echo $data->kode_kuliah; ?></td>
                            <td><?php echo $data->uts; ?></td> 
                            <td><?php echo $data->uas; ?></td> 
                            <td><?php echo $data->na; ?></td> 
                            <td><?php echo $data->hm; ?></td>
        					<td align="center">
        					<button class="btn btn-info btn-xs">Edit</button>
                            <a href="?page=nilai&act=del&na=<?php echo $data->na; ?>" onclick="return confirm('Hapus?')">
        					<button class="btn btn-danger btn-xs">Delete</button>
                            </a>
        					</td>
        				</tr>
                        <?php
                        } ?>    		
        			</table>
        		</div>

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
                
                <div id="tambah" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Tambah Data</h4>
                            </div>
                            <form method="post" action="">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <input type="number" name="nim" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Kuliah</label>
                                        <input type="text" name="kode_kuliah" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>UTS</label>
                                        <input type="number" name="uts" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>UAS</label>
                                        <input type="number" name="uas" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nilai Akhir</label>
                                        <input type="number" name="na" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Indeks</label>
                                        <select class="form-control" name="hm">
                                            <option>-pilih-</option>
                                            <option value="A">A (100-80)</option>
                                            <option value="B">B (80-65)</option>
                                            <option value="C">C (65-55)</option>
                                            <option value="D">D (55-45)</option>
                                            <option value="E">E (45-0)</option>
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                    <button type="reset" class="btn btn-danger">Hapus</button>
                                    <input type="submit" class="btn btn-success" name="tambah" value="simpan">
                                    </div>
                                </div>
                            </form>
                            <?php
                            if(@$_POST['tambah']) {
                                $nim = $connection->conn->real_escape_string($_POST['nim']);
                                $kode_kuliah = $connection->conn->real_escape_string($_POST['kode_kuliah']);
                                $uts = $connection->conn->real_escape_string($_POST['uts']);
                                $uas = $connection->conn->real_escape_string($_POST['uas']);
                                $na = $connection->conn->real_escape_string($_POST['na']);
                                $hm = $connection->conn->real_escape_string($_POST['hm']);
                                
                                if($na) {
                                    $nli->tambah($nim, $kode_kuliah, $uts, $uas, $na, $hm);
                                    header("location: ?page=nilai");
                                } else {
                                    echo "<script>alert('gagal')</script>";
                                }
                                
                            }
                            ?>
        	</div>
        </div>
<?php
} else if(@$_GET['act'] == 'del') {
    $nli->hapus($_GET['na']);
    header("location: ?page=nilai");
}