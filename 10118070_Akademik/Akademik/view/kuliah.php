<?php
include "models/m_kuliah.php";

$klh = new Kuliah($connection);

if(@$_GET['act'] == '') {
?>
<div class="row">
          <div class="col-lg-12">
            <h1> <small>Admin</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Kuliah</a></li>
            </ol>
          </div>
        </div>

        <div class="row">
        	<div class="col-lg-12">
        		<div class="table-reponsive">
        			<table class="table table-bordered table-hover table-striped">
        				<tr>
                            <th>No.</th>
        					<th>Kode Kuliah</th>
        					<th>Nama Kuliah</th>
        					<th>SKS</th>
        				</tr>
                        <?php 
                        $no = 1; 
                        $tampil = $klh->tampil(); 
                        while($data =$tampil->fetch_object()) {
                        ?> 
        				<tr>
                            <td align="center"><?php echo $no++; ?></td>
                            <td><?php echo $data->kode_kuliah; ?></td>
                            <td><?php echo $data->nama_kuliah; ?></td> 
                            <td><?php echo $data->sks; ?></td> 
        					<td align="center">
        					<button class="btn btn-info btn-xs">Edit</button>
                            <a href="?page=kuliah&act=del&kode_kuliah=<?php echo $data->kode_kuliah; ?>" onclick="return confirm('Hapus?')">
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
        								<label>Kode Kuliah</label>
        								<input type="text" name="kode_kuliah" class="form-control" required>
        							</div>
        							<div class="form-group">
        								<label>Nama Kuliah</label>
        								<input type="text" name="nama_kuliah" class="form-control" required>
        							</div>
        							<div class="form-group">
        								<label>SKS</label>
        								<input type="number" name="sks" class="form-control" required>
        							</div>

        							<div class="modal-footer">
        							<button type="reset" class="btn btn-danger">Hapus</button>
        							<input type="submit" class="btn btn-success" name="tambah" value="simpan">
        							</div>
        						</div>
        					</form>
        					<?php
                            if(@$_POST['tambah']) {
                                $kode_kuliah = $connection->conn->real_escape_string($_POST['kode_kuliah']);
                                $nama_kuliah = $connection->conn->real_escape_string($_POST['nama_kuliah']);
                                $sks = $connection->conn->real_escape_string($_POST['sks']);
                                
                                if($kode_kuliah) {
                                    $klh->tambah($kode_kuliah, $nama_kuliah, $sks);
                                    header("location: ?page=kuliah");
                                } else {
                                    echo "<script>alert('gagal')</script>";
                                }
                                
                            }
                            ?>
        	</div>
        </div>
<?php
} else if(@$_GET['act'] == 'del') {
    $klh->hapus($_GET['kode_kuliah']);
    header("location: ?page=kuliah");
}