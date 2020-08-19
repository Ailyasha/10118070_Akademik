<?php
include "models/m_mahasiswa.php";

$mhs = new Mahasiswa($connection);

if(@$_GET['act'] == '') {
?>
<div class="row">
          <div class="col-lg-12">
            <h1>Mahasiswa <small>Admin</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Mahasiswa</a></li>
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
        					<th>Nama</th>
        					<th>TTL</th> 
        					<th>Jenis Kelamin</th> 
        					<th>Alamat</th> 
        					<th>Email</th>
       	 				</tr> 
       	 				<?php 
       	 				$no = 1; 
       	 				$tampil = $mhs->tampil(); 
       	 				while($data =$tampil->fetch_object()) {
       	 				?> 
       	 				<tr>
       	 					<td align="center"><?php echo $no++; ?></td>
       	 					<td><?php echo $data->nim; ?></td> 
       	 					<td><?php echo $data->nama; ?></td>
        					<td><?php echo $data->ttl; ?></td> 
        					<td><?php echo $data->jenis_kelamin; ?></td> 
        					<td><?php echo $data->alamat; ?></td> 
        					<td><?php echo $data->email; ?></td> 
        					<td align="center">
        					<button class="btn btn-info btn-xs">Edit</button>
                            <a href="?page=mahasiswa&act=del&nim=<?php echo $data->nim; ?>" onclick="return confirm('Hapus?')">
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
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>TTL</label>
                                        <input type="date" name="ttl" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin">
                                            <option>-pilih-</option> 
                                            <option value="L">L</option>
                                            <option value="P">P</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" required>
                                    </div>

        						</div>
        					<div class="modal-footer">
        						<button type="reset" class="btn btn-danger">Hapus</button>
        						<input type="submit" class="btn btn-success" name="tambah" value="simpan">
        					</div>
        					</form>
        					<?php
                            if(@$_POST['tambah']) {
                                $nim = $connection->conn->real_escape_string($_POST['nim']);
                                $nama = $connection->conn->real_escape_string($_POST['nama']);
                                $ttl = $connection->conn->real_escape_string($_POST['ttl']);
                                $jenis_kelamin = $connection->conn->real_escape_string($_POST['jenis_kelamin']);
                                $alamat = $connection->conn->real_escape_string($_POST['alamat']);
                                $email = $connection->conn->real_escape_string($_POST['email']);

                                if($nim) {
                                    $mhs->tambah($nim, $nama, $ttl, $jenis_kelamin, $alamat, $email);
                                    header("location: ?page=mahasiswa");
                                } else {
                                    echo "<script>alert('gagal')</script>";
                                }
                                
                            }
                            ?>
        				</div>
        			</div>	
        		</div>


                
        	</div>
        </div>

<?php
} else if(@$_GET['act'] == 'del') {
    $mhs->hapus($_GET['nim']);
    header("location: ?page=mahasiswa");
}