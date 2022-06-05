
<?php include 'header.php'; ?>

<?php 
// koneksi database
include '../koneksi.php'; 
?>

<div class="container">
	<div class="alert alert-info text-center">
		<h4 style="margin-bottom: 0px"><b>Selamat datang!</b> di RAYYA LAUNDRY</h4>			
	</div>

	<div class="panel">
		<div class="panel-heading">
			<h4><b>Dashboard</b></h4>
		</div>
		<div class="panel-body">
			
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-user"></i> 
								<span class="pull-right">
									
									<?php 
									$pelanggan = mysqli_query($koneksi,"select * from pelanggan");
									echo mysqli_num_rows($pelanggan);
									?>
								</span>
							</h1>
							Jumlah Pelanggan
						</div>						
					</div>				
				</div>		

				<div class="col-md-3">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-retweet"></i> 
								<span class="pull-right">
									
									<?php 
									$proses = mysqli_query($koneksi,"select * from transaksi where transaksi_status='0'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							Jumlah Cucian Di Proses
						</div>						
					</div>				
				</div>		

				<div class="col-md-3">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-info-sign"></i> 
								<span class="pull-right">
									
									<?php 
									$proses = mysqli_query($koneksi,"select * from transaksi where transaksi_status='1'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							Jumlah Cucian Dicuci
						</div>						
					</div>				
				</div>				

				<div class="col-md-3">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h1>
								<i class="glyphicon glyphicon-ok-circle"></i> 
								<span class="pull-right">
									
									<?php 
									$proses = mysqli_query($koneksi,"select * from transaksi where transaksi_status='2'");
									echo mysqli_num_rows($proses);
									?>
								</span>
							</h1>
							Jumlah Cucian Selesai
						</div>						
					</div>				
				</div>				
			</div>		

		</div>
	</div>

	<div class="panel">
		<div class="panel-heading">
			<h4><b>Riwayat Transaksi Terakhir</b></h4>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-striped">
				<tr>
					<th width="1%">No</th>
					<th class="text-center">Invoice</th>
					<th class="text-center">Tanggal</th>
					<th class="text-center">Pelanggan</th>
					<th class="text-center">Berat (Kg)</th>
					<th class="text-center">Tgl. Selesai</th>
					<th class="text-center">Harga</th>
					<th class="text-center">Status</th>									
				</tr>

				<?php 				
				// mengambil data pelanggan dari database
				$data = mysqli_query($koneksi,"select * from pelanggan,transaksi where transaksi_pelanggan=pelanggan_id order by transaksi_id desc limit 7");
				$no = 1;
				// mengubah data ke array dan menampilkannya dengan perulangan while
				while($d=mysqli_fetch_array($data)){
					?>
					<tr>
						<td class="text-center"><?php echo $no++; ?></td>
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
					</tr>
					<?php 
				}
				?>
			</table>
		</div>
	</div>


</div>

<?php include 'footer.php'; ?>