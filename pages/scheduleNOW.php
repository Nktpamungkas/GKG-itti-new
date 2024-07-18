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
	<style>
	.container {
		max-width: 600px;
		margin: 0 auto;
		padding: 20px;
	}

	.form-group {
		margin-bottom: 20px;
	}

	label {
		font-weight: bold;
		margin-bottom: 5px;
		display: block;
	}

	select {
		width: 10%;
		padding: 5px;
		border: 1px solid #ccc;
		border-radius: 4px;
		font-size: 12px;
	}
	</style>

</head>

<body>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<!-- <h2>Data Keluar Kain Greige Perhari</h2> -->
					<?php
						// Query to get distinct dates with demand not null
						$q_dates = mysqli_query($connn, "SELECT DISTINCT tgl_tutup 
														FROM tblkeluarkain 
														WHERE demand IS NOT NULL 
														ORDER BY tgl_tutup DESC 
														LIMIT 30");

						$dates = [];
						while ($row = mysqli_fetch_assoc($q_dates)) {
							$dates[] = $row['tgl_tutup'];
						}

						// Set default selected date to the latest date available
						$default_date = $dates[0];
						$selected_date = isset($_POST['selected_date']) ? $_POST['selected_date'] : $default_date;
					?>
					<form method="POST" action="">
						<label for="selected_date">Pilih Tanggal:</label>
						<select id="selected_date" name="selected_date" required>
							<?php foreach ($dates as $date): ?>
							<option value="<?= $date; ?>" <?= $date == $selected_date ? 'selected' : ''; ?>>
								<?= $date; ?>
							</option>
							<?php endforeach; ?>
						</select>
						<input type="submit" value="Filter" class="btn btn-success">
					</form>
				</div>
				<div class="box-body">
					<div style="overflow-x:auto;">
						<table id="TableLeaderCheck" class="table table-bordered table-hover table-striped"
							width="100%">
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

									$sql1 = mysqli_query($connn, "SELECT *
																	FROM tblkeluarkain
																	WHERE tgl_tutup = '$selected_date'
																	AND demand IS NOT NULL
																	ORDER BY tgl_tutup DESC, id DESC");
									while ($r = mysqli_fetch_array($sql1)) {

										$sqlDB2 = "SELECT
													p.PRODUCTIONORDERCODE,
													p.PRODUCTIONDEMANDCODE,
													CASE
														WHEN TRIM(p.PRODRESERVATIONLINKGROUPCODE) IS NULL OR TRIM(p.PRODRESERVATIONLINKGROUPCODE) = '' THEN TRIM(p.OPERATIONCODE)
														ELSE TRIM(p.PRODRESERVATIONLINKGROUPCODE)
													END AS OPERATIONCODE,
													CASE
														WHEN p.PROGRESSSTATUS = 0 THEN 'Entered'
														WHEN p.PROGRESSSTATUS = 1 THEN 'Planned'
														WHEN p.PROGRESSSTATUS = 2 THEN 'Progress'
														WHEN p.PROGRESSSTATUS = 3 THEN 'Closed'
													END AS STATUS_OPERATION 
												FROM 
													PRODUCTIONDEMANDSTEP p 
												LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE 
												LEFT JOIN ADSTORAGE a ON a.UNIQUEID = o.ABSUNIQUEID AND a.FIELDNAME = 'Gerobak'
												LEFT JOIN ITXVIEW_POSISIKK_TGL_IN_PRODORDER iptip ON iptip.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND iptip.DEMANDSTEPSTEPNUMBER = p.STEPNUMBER
												LEFT JOIN ITXVIEW_POSISIKK_TGL_OUT_PRODORDER iptop ON iptop.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND iptop.DEMANDSTEPSTEPNUMBER = p.STEPNUMBER
												LEFT JOIN ITXVIEW_DETAIL_QA_DATA idqd ON idqd.PRODUCTIONDEMANDCODE = p.PRODUCTIONDEMANDCODE AND idqd.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE
																					-- AND idqd.OPERATIONCODE = COALESCE(p.PRODRESERVATIONLINKGROUPCODE, p.OPERATIONCODE)
																					AND idqd.OPERATIONCODE = CASE
																												WHEN TRIM(p.PRODRESERVATIONLINKGROUPCODE) IS NULL OR TRIM(p.PRODRESERVATIONLINKGROUPCODE) = '' THEN TRIM(p.OPERATIONCODE)
																												ELSE TRIM(p.PRODRESERVATIONLINKGROUPCODE)
																											END
																					AND (idqd.VALUEINT = p.STEPNUMBER OR idqd.VALUEINT = p.GROUPSTEPNUMBER) 
																					AND (idqd.CHARACTERISTICCODE = 'GRB1' OR
																						idqd.CHARACTERISTICCODE = 'GRB2' OR
																						idqd.CHARACTERISTICCODE = 'GRB3' OR
																						idqd.CHARACTERISTICCODE = 'GRB4' OR
																						idqd.CHARACTERISTICCODE = 'GRB5' OR
																						idqd.CHARACTERISTICCODE = 'GRB6' OR
																						idqd.CHARACTERISTICCODE = 'GRB7' OR
																						idqd.CHARACTERISTICCODE = 'GRB8' OR
																						idqd.CHARACTERISTICCODE = 'AREA')
																					AND NOT (idqd.VALUEQUANTITY = 999 OR idqd.VALUEQUANTITY = 9999 OR idqd.VALUEQUANTITY = 99999 OR idqd.VALUEQUANTITY = 99 OR idqd.VALUEQUANTITY = 91)
												WHERE
													p.PRODUCTIONORDERCODE  = '$r[prod_order]' AND p.PRODUCTIONDEMANDCODE = '$r[demand]' AND TRIM(p.OPERATIONCODE) = 'BAT2'
												GROUP BY
													p.PRODUCTIONORDERCODE,
													p.STEPNUMBER,
													p.OPERATIONCODE,
													p.PRODRESERVATIONLINKGROUPCODE,
													o.OPERATIONGROUPCODE,
													o.LONGDESCRIPTION,
													p.PROGRESSSTATUS,
													iptip.MULAI,
													iptop.SELESAI,
													p.LASTUPDATEDATETIME,
													p.PRODUCTIONORDERCODE,
													p.PRODUCTIONDEMANDCODE,
													iptip.LONGDESCRIPTION,
													iptop.LONGDESCRIPTION,
													a.VALUEBOOLEAN,
													idqd.WORKCENTERCODE 
												ORDER BY p.STEPNUMBER ASC";
										$stmt = db2_exec($conn1, $sqlDB2);
										$rowdb2 = db2_fetch_assoc($stmt);
								?>
								<?php if($rowdb2['STATUS_OPERATION'] != 'Closed') : ?>
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
								 	endif; ?>
								<?php
							} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
$(document).ready(function() {
	var table = $('#TableLeaderCheck').DataTable({
		dom: 'Bfrtip',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5'
		]
	});
});
</script>

</html>