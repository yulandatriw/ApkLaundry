<?php include 'header.php'; ?>

<div class="container" margin="10px 10px 10px 10px";>
	<div class="panel">
		<div class="panel-heading">
			<h4><b>Data Pelanggan</b></h4>
		</div>
		<div class="panel-body">
	

 <div class="col-xs">
			<a href="pelanggan_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>
		
			
			<div class="col-xs">
				<form class="form-inline my-2 my-lg-0 " action="pelanggan.php"method="get">
					<input class="form-control mr-sm-2 mt-4"type="search"placeholder="Cari Nama atau Alamat" aria-label="Search"name="cari">
						<button class="btn btn-outline-success mt-4"type="submit">Search</button>
				</form>
				<br>
				<?php
				if(isset($_GET['cari'])){
				$cari = $_GET['cari'];
				echo "Hasil Pencarian : ".$cari." <br> <br>";
				
				}
				?>
				</div>

			<table class="table table-bordered table-striped">
				<tr>
				<th width="1%">ID</th> 
				<th class="text-center"> Nama </th> 
				<th class="text-center">No HP</th>
				<th class="text-center"> Alamat</th>
				<th class="text-center"width="15%">OPSI</th>
				</tr>

				<?php 
				// koneksi database
				include '../koneksi.php';
					
										
					if(isset($_GET['cari'])){
					$cari = $_GET['cari'];

					$data = mysqli_query($koneksi, "SELECT * FROM pelanggan
					WHERE pelanggan_nama like '%".$cari."%'
					OR  pelanggan_alamat LIKE '%".$cari."%'
					");
					} else{
				// mengambil data pelanggan dari database
				$data = mysqli_query($koneksi,"select * from pelanggan ORDER BY pelanggan_id ASC");

					}
								
				// mengubah data ke array dan menampilkannya dengan perulangan while
				while($d=mysqli_fetch_array($data)){
					?>
					<tr>
						<td class="text-center"><?php echo $d['pelanggan_id']; ?></td>
						<td class="text-center"><?php echo $d['pelanggan_nama']; ?></td>
						<td class="text-center"><?php echo $d['pelanggan_hp']; ?></td>
						<td class="text-center"><?php echo $d['pelanggan_alamat']; ?></td>
						<td class="text-center">
						<?php echo "<a class ='btn btn-sm btn-info' href=\"pelanggan_edit.php?id=$d[pelanggan_id]\" onClick=\"return confirm('Apakan anda yakin ingin mengedit?')\">Edit</a>
						<a class ='btn btn-sm btn-danger' href=\"pelanggan_hapus.php?id=$d[pelanggan_id]\" onClick=\"return confirm('Apakah anda yakin ingin menghapus?')\">Delete</a></td>"; ?>
						</td>
					</tr>
					<?php 
				}
				?>
			</table>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>

