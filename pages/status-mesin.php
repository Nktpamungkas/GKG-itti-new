<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="refresh" content="180">
	<title>Status Mesin</title>
	<style>
		td {
			padding: 1px 0px;
		}

		p {
			line-height: 4px;
			font-size: 10px;
		}
	</style>
	<style type="text/css">
		.teks-berjalan {
			background-color: #03165E;
			color: #F4F0F0;
			font-family: monospace;
			font-size: 24px;
			font-style: italic;
		}

		.tbl-berjalan {
			background-color: ;
			color: #F4F0F0;
			font-family: monospace;
			font-size: 14px;
			font-style: italic;
		}
	</style>
</head>

<body>
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Schedule GKG</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="10000">
						<div class="carousel-inner">
							<?php
							$qryGmbr = mysqli_query($con,"SELECT
   	ceil(count(*)/10) as jumlah
FROM
	tbl_schedule 
WHERE
	NOT STATUS = 'selesai' 
	AND tgl_update BETWEEN CONCAT(DATE_FORMAT( now( ), '%Y-%m-%d' ),' 07:00:00') 
	AND CONCAT(DATE_FORMAT( now( ), '%Y-%m-%d' ) + INTERVAL 1 DAY,' 07:00:00')");
							$rG = mysqli_fetch_array($qryGmbr);
							$pages = $rG['jumlah'] - 1;
							for ($i = 0; $i <= $pages; $i++) {
							?>
								<div class="item <?php if ($i == "0") {
														echo "active";
													} ?>">

									<!-- awal table -->
									<?php
									$bts = $i * 3;
									$data = mysqli_query($con,"SELECT
   	id,
	no_mesin,
	no_urut,
	buyer,
	langganan,
	no_order,
	nokk,
	jenis_kain,
	warna,
	no_warna,
	lot,
	sum(rol) as rol,
	sum(bruto) as bruto,
	proses,
	`status`,
	catatan,
	ket_status,
	tgl_delivery
FROM
	tbl_schedule 
WHERE
	NOT STATUS = 'selesai'
	AND tgl_update BETWEEN CONCAT(DATE_FORMAT( now( ), '%Y-%m-%d' ),' 07:00:00') 
	AND CONCAT(DATE_FORMAT( now( ), '%Y-%m-%d' ) + INTERVAL 1 DAY,' 07:00:00')
GROUP BY
	no_mesin,
	no_urut 
ORDER BY
	no_mesin ASC,no_urut ASC LIMIT $bts,10");
									?>
									<div class="box-body table-responsive">
										<table id="tblr21" class="table table-bordered table-hover table-striped" width="100%">
											<thead class="bg-blue">
												<tr>
													<th width="45">
														<div align="center">Mesin</div>
													</th>
													<th width="24">
														<div align="center">No/Status</div>
													</th>
													<th width="162">
														<div align="center">Pelanggan</div>
													</th>
													<th width="118">
														<div align="center">No. Order</div>
													</th>
													<th width="182">
														<div align="center">Jenis Kain</div>
													</th>
													<th width="82">
														<div align="center">Warna</div>
													</th>
													<th width="93">
														<div align="center">No Warna</div>
													</th>
													<th width="34">
														<div align="center">Lot</div>
													</th>
													<th width="109">
														<div align="center">Keterangan</div>
													</th>
													<th width="62">
														<div align="center">Rol</div>
													</th>
													<th width="68">
														<div align="center">Kg</div>
													</th>
													<th width="71">
														<div align="center">Proses</div>
													</th>
													<th width="86">
														<div align="center">Delivery</div>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$col = 0;
												while ($rowd = mysqli_fetch_array($data)) {
													$bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
													$qCek = mysqli_query($con,"SELECT `status` FROM tbl_inspection WHERE id_schedule='$rowd[id]' LIMIT 1");
													$rCEk = mysqli_fetch_array($qCek);
												?>

													<tr bgcolor="<?php echo $bgcolor; ?>">
														<td align="center">
															<font size="-1"><a href="#" id='<?php echo $rowd['no_mesin']; ?>' class="edit_status_mesin <?php if ($_SESSION['lvl_id10'] == "3") {
																																							echo "disabled";
																																						} ?>"><?php echo $rowd['no_mesin']; ?></a></font>
														</td>
														<td align="center">
															<font size="-1"><?php echo $rowd['no_urut'] ?>/<?php echo $rowd['status']; ?></font>
														</td>
														<td>
															<font size="-2"><?php echo $rowd['langganan'] . "/" . $rowd['buyer']; ?></font>
														</td>
														<td align="center">
															<font size="-1"><?php echo $rowd['no_order']; ?></font>
														</td>
														<td>
															<font size="-2"><?php echo $rowd['jenis_kain']; ?></font>
														</td>
														<td align="center">
															<font size="-1"><?php echo $rowd['warna']; ?></font>
														</td>
														<td align="center">
															<font size="-1"><?php echo $rowd['no_warna']; ?></font>
														</td>
														<td align="center">
															<font size="-1"><a href="#"><?php echo $rowd['lot']; ?></a></font>
														</td>
														<td>
															<font size="-2"><?php echo $rowd['ket_status']; ?><br />
																<i><?php echo $rowd['nokk']; ?></i><br />
																<i style="color:red;"><strong><?php echo $rowd['catatan']; ?></strong></i><br />
																<a href="#" id='<?php echo $rowd['id']; ?>' class="detail_kartu"><span class="label label-danger"><?php echo $rowd['ket_kartu']; ?></span></a></font>
														</td>
														<td align="center">
															<font size="-1"><?php echo $rowd['rol'] . $rowd['kk']; ?></font>
														</td>
														<td align="center">
															<font size="-1"><?php echo $rowd['bruto']; ?></font>
														</td>
														<td>
															<font size="-1"><?php echo $rowd['proses']; ?></font>
														</td>
														<td align="center">
															<font size="-1"><?php echo $rowd['tgl_delivery']; ?></font>
														</td>
													</tr>
												<?php
													$no++;
												} ?>

											</tbody>

										</table>
									</div>
									<!-- akhir table -->



									<div class="carousel-caption">
										<?php $hal = $i + 1;
										echo "Halaman " . $hal . "/" . $rG['jumlah']; ?>
									</div>
								</div>
							<?php } ?>
						</div>

					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>

	</div>




	<div id="CekDetailStatus" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

</body>
<!-- Tooltips -->
<script src="dist/js/tooltips.js"></script>
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>

</html>