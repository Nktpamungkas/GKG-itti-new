<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Schedule</title>
</head>

<body>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<h2>Data Keluar Kain Greige Perhari</h2>

				<?php
				// Ambil tanggal minimum dan maksimum dari database
				$q_min = mysqli_query($connn, "SELECT MIN(tgl_tutup) AS tgl_tutup FROM tblkeluarkain");
				$date_min = mysqli_fetch_assoc($q_min)['tgl_tutup'];

				$q_max = mysqli_query($connn, "SELECT MAX(tgl_tutup) AS tgl_tutup FROM tblkeluarkain");
				$date_max = mysqli_fetch_assoc($q_max)['tgl_tutup'];
				?>

				<form method="POST" action="">
					<label for="selected_date">Pilih Tanggal:</label>
					<input type="date" id="selected_date" name="selected_date" min="<?= $date_min; ?>"
						max="<?= $date_max; ?>" required>
					<input type="submit" value="Filter">
				</form>


				<div class="box-body">
					<table id="TableLeaderCheck" class="table table-bordered table-hover table-striped" width="100%">
						<thead class="bg-blue">
							<tr>
								<th width="100">
									<div align="center">No</div>
								</th>
								<th width="45">
									<div align="center">Tgl Keluar</div>
								</th>
								<th width="24">
									<div align="center">Buyer</div>
								</th>
								<th width="162">
									<div align="center">Customer</div>
								</th>
								<th width="118">
									<div align="center">Project Code</div>
								</th>
								<th width="122">
									<div align="center">Prod. Order</div>
								</th>
								<th width="122">
									<div align="center">Demand</div>
								</th>
								<th width="86">
									<div align="center">Item Code</div>
								</th>
								<th width="83">
									<div align="center">Lot</div>
								</th>
								<th width="38">
									<div align="center">Jenis Benang 1</div>
								</th>
								<th width="38">
									<div align="center">Jenis Benang 2</div>
								</th>
								<th width="38">
									<div align="center">Jenis Benang 3</div>
								</th>
								<th width="38">
									<div align="center">Jenis Benang 4</div>
								</th>
								<th width="79">
									<div align="center">Warna</div>
								</th>
								<th width="46">
									<div align="center">Jenis Kain</div>
								</th>
								<th width="48">
									<div align="center">Qty</div>
								</th>
								<th width="59">
									<div align="center">Berat/Kg</div>
								</th>
								<th>
									<div align="center">Project Awal</div>
								</th>
								<th>
									<div align="center">Note</div>
								</th>
								<th>
									<div align="center">User</div>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							$selected_date = isset($_POST['selected_date']) ? $_POST['selected_date'] : date('Y-m-d');

							$sql1 = mysqli_query($connn, "SELECT *
															FROM tblkeluarkain
															WHERE tgl_tutup = '$selected_date'
															AND demand IS NOT NULL
															ORDER BY tgl_tutup DESC, id DESC
															LIMIT 1000");
							while ($r = mysqli_fetch_array($sql1)) {
								?>
								<tr>
									<td align="center">
										<font size="-1"><?= $no; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['tglkeluar']; ?></font>
									</td>
									<td>
										<font size="-1"><?= $r['buyer']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['custumer']; ?></font>
									</td>
									<td>
										<font size="-1"><?= $r['projectcode']; ?></font>
									</td>
									<td>
										<font size="-1"><?= $r['prod_order']; ?></font>
									</td>
									<td align="center">
										<font size="-1">
											<a target="_BLANK"
												href="http://online.indotaichen.com/laporan/ppc_filter_steps.php?demand=<?= $r['demand']; ?>&prod_order=<?= $r['prod_order']; ?>"><?= $r['demand']; ?></a>
										</font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['code']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['lot']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['benang1']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['benang2']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['benang3']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['benang4']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['warna']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['jenis_kain']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['qty']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['berat']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['proj_awal']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['ket']; ?></font>
									</td>
									<td align="center">
										<font size="-1"><?= $r['userid']; ?></font>
									</td>
								</tr>
								<?php
								$no++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		var table = $('#TableLeaderCheck').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5'
			]
		});
	});
</script>

</html>