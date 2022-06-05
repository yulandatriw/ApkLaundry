<?php include 'header.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4><b>Data Transaksi Laundry</b></h4>
		</div>
		<div class="panel-body">

			<a href="transaksi_tambah.php" class="btn btn-sm btn-info pull-right">Transaksi Baru</a>
			<br/>
			<br>
			<br>

			<table class="table table-bordered table-striped">
				<tr>
				
				<th class="text-center"> INVOICE </th>
				<th class="text-center"> Tanggal</th>
				<th class="text-center"> Pelanggan</th>
				<th class="text-center"> Berat (Kg)</th>
				<th class="text-center"> Tgl. Selesai</th>
				<th class="text-center"> Harga</th>
				<th class="text-center"> Status</th>				
				<th class="text-center"width="20%">OPSI</th>
				</tr>

				<?php 
				// koneksi database
				include '../koneksi.php';

				// mengambil data pelanggan dari database
				$data = mysqli_query($koneksi,"select * from pelanggan,transaksi where transaksi_pelanggan=pelanggan_id order by transaksi_id desc");

				// mengubah data ke array dan menampilkannya dengan perulangan while
				while($d=mysqli_fetch_array($data)){
					?>
					<tr>
						
						<td class="text-center">INVOICE-<?php echo $d['transaksi_id']; ?></td>
						<td class="text-center"><?php echo $d['transaksi_tgl']; ?></td>
						<td class="text-center"><?php echo $d['pelanggan_nama']; ?></td>
						<td class="text-center"><?php echo $d['transaksi_berat']; ?></td>
						<td class="text-center"><?php echo $d['transaksi_tgl_selesai']; ?></td>
						<td class="text-center"><?php echo "Rp. ".number_format($d['transaksi_harga']) ." ,-"; ?></td>
						<td class="text-center">
							<?php 
							if($d['transaksi_status']=="0"){
								echo "<div class='label label-warning'>PROSES</div>";
							}else if($d['transaksi_status']=="1"){
								echo "<div class='label label-info'>DICUCI</div>";
							}else if($d['transaksi_status']=="2"){
								echo "<div class='label label-success'>SELESAI</div>";
							}
							?>							
						</td>
						<td>
							<a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank" class="btn btn-sm btn-warning">Detail</a>
							<?php echo "<a class ='btn btn-sm btn-info' href=\"transaksi_edit.php?id=$d[transaksi_id]\" onClick=\"return confirm('Apakah anda yakin ingin mengedit?')\">Edit</a>
							<a class ='btn btn-sm btn-danger' href=\"transaksi_hapus.php?id=$d[transaksi_id]\" onClick=\"return confirm('Apakah anda yakin ingi membatalkan?')\">Batalkan</a></td>"; ?>
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