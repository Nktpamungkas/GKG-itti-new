<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";

$sql_data = mysqli_query($con, "SELECT
                                    date_laporan,
                                    group_s1,
                                    group_s2,
                                    group_s3,
                                    hadir_s1,
                                    hadir_s2,
                                    hadir_s3,
                                    sakit_s1,
                                    sakit_s2,
                                    sakit_s3,
                                    mangkir_s1,
                                    mangkir_s2,
                                    mangkir_s3,
                                    cuti_s1,
                                    cuti_s2,
                                    cuti_s3,
                                    libur_s1,
                                    libur_s2,
                                    libur_s3,
                                    izin_s1,
                                    izin_s2,
                                    izin_s3,
                                    masuk_kain_s1,
                                    masuk_kain_s2,
                                    masuk_kain_s3,
                                    pembagian_kain_s1,
                                    pembagian_kain_s2,
                                    pembagian_kain_s3,
                                    buka_kain_s1,
                                    buka_kain_s2,
                                    buka_kain_s3,
                                    belah_kain_s1,
                                    belah_kain_s2,
                                    belah_kain_s3,
                                    masalah_s1,
                                    masalah_s2,
                                    masalah_s3,
                                    terimakains1,
                                    terimakains2,
                                    terimakains3,
                                    inspeksis1,
                                    inspeksis2,
                                    inspeksis3,
                                    bagikains1,
                                    bagikains2,
                                    bagikains3,
                                    bukakains1,
                                    bukakains2,
                                    bukakains3,
                                    leader_s1,
                                    leader_s2,
                                    leader_s3,
                                    mc_buka_s1,
                                    mc_buka_s2,
                                    mc_buka_s3,
                                    mc_balik_s1,
                                    mc_balik_s2,
                                    mc_balik_s3,
                                    mc_belah_s1,
                                    mc_belah_s2,
                                    mc_belah_s3,
                                    jahit_pinggir_s1,
                                    jahit_pinggir_s2,
                                    jahit_pinggir_s3,
                                    created_at,
                                    created_by,
                                    last_updated_at,
                                    last_updated_by,
                                    `status`,
                                    absensi_s1,
                                    absensi_s2,
                                    absensi_s3,
                                    masalah_hadir_s1,
                                    masalah_hadir_s2,
                                    masalah_hadir_s3,
                                    penyusunan_s1,
                                    penyusunan_s2,
                                    penyusunan_s3,
                                    masuk_kain_manual,
                                    bagi_kain_manual 
                                FROM
                                    tbl_laporanharian 
                                WHERE
                                    date_laporan = '$_GET[date_laporan]'");
$data = mysqli_fetch_array($sql_data);
?>
<!DOCTYPE html>
<html lang="en">
<title>Laporan Shift <?php echo $data['date_laporan'] ?></title>
<link href="../../bower_components/print_tools/bootstrap4.css">
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<style>
	@page {
		size: A4;
		margin: 15px 15px 15px 15px;
		font-size: 10pt !important;
		size: landscape;
	}

	@media print {
		@page {
			size: A4;
			margin: 15px 15px 15px 15px;
			size: landscape;
			font-size: 10pt !important;
		}

		html,
		body {
			width: 210mm;
			height: 297mm;
			background: #FFF;
			overflow: visible;
		}

		/* body {
			padding-top: 15mm;
		} */

		.table-ttd {
			border-collapse: collapse;
			width: 100%;
			font-size: 10pt !important;
		}

		.table-ttd tr,
		.table-ttd tr td {
			border: 0.5px solid black;
			padding: 4px;
			padding: 4px;
			font-size: 10pt !important;
		}
	}

	.table-ttd {
		border-collapse: collapse;
		width: 100%;
		font-size: 10pt !important;
	}

	.table-ttd tr,
	.table-ttd tr td {
		border: 1px solid black;
		padding: 5px;
		padding: 5px;
		font-size: 10pt !important;
	}

	tr {
		page-break-inside: avoid;
		font-size: 10pt !important;
	}

	.tablee td,
	.tablee th {
		/* border: 1px solid black; */
		padding: 5px;
		font-size: 10pt !important;

	}

	.rotation {
		transform: rotate(-90deg);
		/* Legacy vendor prefixes that you probably don't need... */
		/* Safari */
		-webkit-transform: rotate(-90deg);
		/* Firefox */
		-moz-transform: rotate(-90deg);
		/* IE */
		-ms-transform: rotate(-90deg);
		/* Opera */
		-o-transform: rotate(-90deg);
		/* Internet Explorer */
		filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
	}

	ul,
	li {
		list-style-type: none;
		font-size: 10pt !important;
	}

	.tablee tr:nth-child(even) {
		background-color: #f2f2f2;
		font-size: 10pt !important;
	}

	.table-ttd thead tr td,
	#tr-footer {
		font-weight: bold;
	}

	.tablee th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
		font-size: 10pt !important;
	}
</style>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<table class="table-ttd" style="width:330mm;">
		<tr width="60mm">
			<td align="center">
				<img src="logo.png" width="40mm" height="40mm">
			</td>
			<td style="text-align:center; font-weight: bold;">
				<h3>LAPORAN SHIFT</h3>
			</td>
			<td width="250px">
				<li><b>No. Form : 14-02</b></li>
				<li>No. Revisi &nbsp;: 01 </li>
				<li>Tgl. Terbit : 29 Februari 2008</li>
			</td>
		</tr>
	</table>
	<br />
	<table class="table-ttd" style="width:330mm;">
		<tr>
			<td width="147">Departement :</td>
			<td width="39">GKG</td>
			<td width="59">Tanggal :</td>
			<td width="39" align="center"><?php echo $data['date_laporan'] ?></td>
			<td width="57">Shift :</td>
			<td width="47"><?php echo $data['group_s1'] ?>-1</td>
			<td width="147">Departement :</td>
			<td width="39">GKG</td>
			<td width="59">Tanggal :</td>
			<td width="39" align="center"><?php echo $data['date_laporan'] ?></td>
			<td width="57">Shift :</td>
			<td width="47"><?php echo $data['group_s2'] ?>-2</td>
			<td width="147">Departement :</td>
			<td width="39">GKG</td>
			<td width="59">Tanggal :</td>
			<td width="39" align="center"><?php echo $data['date_laporan'] ?></td>
			<td width="57">Shift :</td>
			<td width="54"><?php echo $data['group_s3'] ?>-3</td>
		</tr>
		<tr>
			<td height="120px" style="border-right: none;">
				<li>Absensi</li>
				<li>Hadir</li>
				<li>Sakit</li>
				<li>Mangkir</li>
				<li>Cuti</li>
				<li>Libur</li>
				<li>Izin</li>
			</td>
			<td colspan="5" height="120px" style="border-left: none;">
				<li> &nbsp;&nbsp;<?php echo $data['absensi_s1'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>
				<li>:
					<?php echo $data['hadir_s1'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['sakit_s1'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['mangkir_s1'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['cuti_s1'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['libur_s1'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['izin_s1'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
			</td>
			<td height="120px" style="border-right: none;">
				<li>Absensi</li>
				<li>Hadir</li>
				<li>Sakit</li>
				<li>Mangkir</li>
				<li>Cuti</li>
				<li>Libur</li>
				<li>Izin</li>
			</td>
			<td colspan="5" height="120px" style="border-left: none;">
				<li> &nbsp;&nbsp;<?php echo $data['absensi_s2'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>
				<li>:
					<?php echo $data['hadir_s2'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['sakit_s2'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['mangkir_s2'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['cuti_s2'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['libur_s2'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['izin_s2'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
			</td>
			<td height="120px" style="border-right: none;">
				<li>Absensi</li>
				<li>Hadir</li>
				<li>Sakit</li>
				<li>Mangkir</li>
				<li>Cuti</li>
				<li>Libur</li>
				<li>Izin</li>
			</td>
			<td colspan="5" height="120px" style="border-left: none;">
				<li> &nbsp;&nbsp;<?php echo $data['absensi_s3'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>
				<li>:
					<?php echo $data['hadir_s3'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['sakit_s3'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['mangkir_s3'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['cuti_s3'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['libur_s3'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
				<li>:
					<?php echo $data['izin_s3'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang
				</li>
			</td>
		</tr>
		<tr>
			<td width="147" height="110px" valign="top" style="border-right:none;">
				<li>Produksi</li>
				<li>&nbsp;-Masuk Kain</li>
				<li>&nbsp;-Pembagian Kain</li>
				<li>&nbsp;-Belah Kain</li>
				<li>&nbsp;-Buka Kain</li>
				<li>&nbsp;-Penyusunan Kain</li>
			</td>
			<td colspan="5" valign="top" style="border-left:none;">
				<li>&nbsp;</li>
				<li>:&nbsp;&nbsp;<?php echo number_format($data['masuk_kain_s1'], 2) ?></li>
				<li>:&nbsp;&nbsp;<?php echo number_format($data['pembagian_kain_s1'], 2) ?></li>
				<li>:&nbsp;&nbsp;<?php echo number_format($data['belah_kain_s1'], 2) ?></li>
				<li>:&nbsp;&nbsp;<?php echo number_format($data['buka_kain_s1'], 2) ?></li>
				<li>:&nbsp;&nbsp;<?php echo $data['penyusunan_s1'] ?></li>
			</td>
			<td width="147" height="110px" valign="top" style="border-right:none;">
				<li>Produksi</li>
				<li>&nbsp;-Masuk Kain</li>
				<li>&nbsp;-Pembagian Kain</li>
				<li>&nbsp;-Belah Kain</li>
				<li>&nbsp;-Buka Kain</li>
				<li>&nbsp;-Penyusunan Kain</li>
			</td>
			<td colspan="5" valign="top" style="border-left:none;">
				<li>&nbsp;</li>
				<li>:&nbsp;&nbsp;<?php echo number_format($data['masuk_kain_s2'], 2) ?></li>
				<li>:&nbsp;&nbsp;<?php echo number_format($data['pembagian_kain_s2'], 2) ?></li>
				<li>:&nbsp;&nbsp;<?php echo number_format($data['belah_kain_s2'], 2) ?></li>
				<li>:&nbsp;&nbsp;<?php echo number_format($data['buka_kain_s2'], 2) ?></li>
				<li>:&nbsp;&nbsp;<?php echo $data['penyusunan_s2'] ?></li>
			</td>
			<!-- <td height="110px" width="150px" style="border-right:none;border-left:none;">
				<li>&nbsp;</li>
				<li><font size="-2" >&nbsp;-Masuk Kain Manual :&nbsp;&nbsp;<?php echo number_format($data['masuk_kain_manual'], 2) ?></font></li>
				<li><font size="-2" >&nbsp;-Pembagian Kain Manual :&nbsp;&nbsp;<?php echo number_format($data['bagi_kain_manual'], 2) ?></font></li>
				<li><font size="-2" >&nbsp;<b>Total Masuk Kain :&nbsp;&nbsp;<?php $totmasuk = $data['masuk_kain_s3'] + $data['masuk_kain_manual'];
				echo number_format($totmasuk, 2) ?></b></font></li>
									<li><font size="-2" >&nbsp;<b>Total Bagi Kain :&nbsp;&nbsp;<?php $totbagi = $data['pembagian_kain_s3'] + $data['bagi_kain_manual'];
									echo number_format($totbagi, 2) ?></b></font></li>
									<li>&nbsp;</li>
								</td> -->
			<td height="110px" colspan="2" valign="top" style="border-right:none;">
				<li>Produksi</li>
				<li>&nbsp;<b>Total Masuk Kain </b></li>
				<li>&nbsp;<b>Total Pembagian Kain </b></li>
				<li>&nbsp;-Belah Kain </li>
				<li>&nbsp;<b>Total Belah Kain </b></li>
				<li>&nbsp;-Buka Kain </li>
				<li>&nbsp;<b>Total Buka Kain </b></li>
				<li>&nbsp;-Penyusunan Kain </li>
			</td>
			<!-- <td colspan="5" height="110px" width="150px" style="border-right:none;border-left:none;">
				<li>&nbsp;</li>
				<li>&nbsp;-Masuk Kain Manual :&nbsp;&nbsp;<?php echo number_format($data['masuk_kain_manual'], 2) ?></li>
				<li>&nbsp;-Pembagian Kain Manual :&nbsp;&nbsp;<?php echo number_format($data['bagi_kain_manual'], 2) ?></li>
				<li>&nbsp;<b>Total Masuk Kain :&nbsp;&nbsp;<?php $totmasuk = $data['masuk_kain_s3'] + $data['masuk_kain_manual'];
				echo number_format($totmasuk, 2) ?></b></li>
				<li>&nbsp;<b>Total Bagi Kain :&nbsp;&nbsp;<?php $totbagi = $data['pembagian_kain_s3'] + $data['bagi_kain_manual'];
				echo number_format($totbagi, 2) ?></b></li>
				<li>&nbsp;</li>
			</td> -->
			<!--<td colspan="4" valign="top" style="border-left:none;">
				<li>&nbsp;</li>
				<li>:<b> <?php $totmk = $data['masuk_kain_s1'] + $data['masuk_kain_s2'];
				echo number_format($totmk, 2) ?></b></li>
				<li>:<b> <?php $totpk = $data['pembagian_kain_s1'] + $data['pembagian_kain_s2'];
				echo number_format($totpk, 2) ?></b></li>
				<li>: <?php echo number_format($data['belah_kain_s3'], 2) ?></li>
				<li>: <b><?php $totbk = $data['belah_kain_s1'] + $data['belah_kain_s2'] + $data['belah_kain_s3'];
				echo number_format($totbk, 2) ?></b></li>
				<li>: <?php echo number_format($data['buka_kain_s3'], 2) ?></li>
				<li>: <b><?php $tot = $data['buka_kain_s1'] + $data['buka_kain_s2'] + $data['buka_kain_s3'];
				echo number_format($tot, 2) ?></b></li>
				<li>: <?php echo $data['penyusunan_s3'] ?></li>
			</td>-->
			<td colspan="4" valign="top" style="border-left:none;">
				<li>&nbsp;</li>
				<li>:<b> <?php echo number_format($data['masuk_kain_s3'], 2) ?></b></li>
				<li>:<b> <?php echo number_format($data['pembagian_kain_s3'], 2) ?></b></li>
				<li>: <?php echo number_format($data['belah_kain_s3'], 2) ?></li>
				<li>: <b><?php $totbk = $data['belah_kain_s1'] + $data['belah_kain_s2'] + $data['belah_kain_s3'];
				echo number_format($totbk, 2) ?></b></li>
				<li>: <?php echo number_format($data['buka_kain_s3'], 2) ?></li>
				<li>: <b><?php $tot = $data['buka_kain_s1'] + $data['buka_kain_s2'] + $data['buka_kain_s3'];
				echo number_format($tot, 2) ?></b></li>
				<li>: <?php echo $data['penyusunan_s3'] ?></li>
			</td>
		</tr>
		<tr>
			<td height="82px" colspan="6" style="vertical-align:top;"><b>Masalah Yang Terjadi :</b>
				<?php echo $data['masalah_s1'] ?></td>
			<td height="82px" colspan="6" style="vertical-align:top;"><b>Masalah Yang Terjadi :</b>
				<?php echo $data['masalah_s2'] ?></td>
			<td height="82px" colspan="6" style="vertical-align:top;"><b>Masalah Yang Terjadi :</b>
				<?php echo $data['masalah_s3'] ?></td>
		</tr>
		<tr>
			<td height="118px" colspan="3" valign="top" style="border-right:none;">
				<li>Lain-lain &nbsp;&nbsp;&nbsp; :</li>
				<li>Terima kain &nbsp;&nbsp; : <?php echo $data['terimakains1'] ?> ORANG</li>
				<li>Inspeksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['inspeksis1'] ?>
					ORANG</li>
				<li>Bagi kain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['bagikains1'] ?> ORANG</li>
				<li>Buka kain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['bukakains1'] ?> ORANG</li>
				<li><b>Leader</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
					<?php echo $data['leader_s1'] ?> ORANG
				</li>
				<?php if ($data['masalah_hadir_s1'] != "") { ?>
					<li><b>Masalah Kehadiran</b> &nbsp;&nbsp;&nbsp;: </li>
					<li><?php echo $data['masalah_hadir_s1'] ?></li>
				<?php } ?>
			</td>
			<td height="118px" colspan="3" valign="top" style="border-left:none;">
				<li>Cek Mesin buka kain &nbsp;&nbsp; :</li>
				<li>MC BK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_buka_s1'] ?></li>
				<li>MC BLK &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_balik_s1'] ?></li>
				<li>MC BLH &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_belah_s1'] ?></li>
				<li><small style="font-weight: bold;">MC JHT PGR &nbsp;&nbsp; :
						<?php echo $data['jahit_pinggir_s1'] ?></small></li>
			</td>
			<td height="118px" colspan="3" valign="top" style="border-right:none;">
				<li>Lain-lain &nbsp;&nbsp;&nbsp; :</li>
				<li>Terima kain &nbsp;&nbsp; : <?php echo $data['terimakains2'] ?> ORANG</li>
				<li>Inspeksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['inspeksis2'] ?>
					ORANG</li>
				<li>Bagi kain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['bagikains2'] ?> ORANG</li>
				<li>Buka kain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['bukakains2'] ?> ORANG</li>
				<li><b>Leader</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
					<?php echo $data['leader_s2'] ?> ORANG
				</li>
				<?php if ($data['masalah_hadir_s2'] != "") { ?>
					<li><b>Masalah Kehadiran</b> &nbsp;&nbsp;&nbsp;: </li>
					<li><?php echo $data['masalah_hadir_s2'] ?></li>
				<?php } ?>
			</td>
			<td height="118px" colspan="3" valign="top" style="border-left:none;">
				<li>Cek Mesin buka kain &nbsp;&nbsp; :</li>
				<li>MC BK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_buka_s2'] ?></li>
				<li>MC BLK &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_balik_s2'] ?></li>
				<li>MC BLH &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_belah_s2'] ?></li>
				<li><small style="font-weight: bold;">MC JHT PGR &nbsp;&nbsp; :
						<?php echo $data['jahit_pinggir_s2'] ?></small></li>
			</td>
			<td height="118px" colspan="3" valign="top" style="border-right:none;">
				<li>Lain-lain &nbsp;&nbsp;&nbsp; :</li>
				<li>Terima kain &nbsp;&nbsp; : <?php echo $data['terimakains3'] ?> ORANG</li>
				<li>Inspeksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['inspeksis3'] ?>
					ORANG</li>
				<li>Bagi kain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['bagikains3'] ?> ORANG</li>
				<li>Buka kain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['bukakains3'] ?> ORANG</li>
				<li><b>Leader</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
					<?php echo $data['leader_s3'] ?> ORANG
				</li>
				<?php if ($data['masalah_hadir_s3'] != "") { ?>
					<li><b>Masalah Kehadiran</b> &nbsp;&nbsp;&nbsp;: </li>
					<li><?php echo $data['masalah_hadir_s3'] ?></li>
				<?php } ?>

			</td>
			<td height="118px" colspan="3" valign="top" style="border-left:none;">
				<li>Cek Mesin buka kain &nbsp;&nbsp; :</li>
				<li>MC BK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_buka_s3'] ?></li>
				<li>MC BLK &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_balik_s3'] ?></li>
				<li>MC BLH &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $data['mc_belah_s3'] ?></li>
				<li><small style="font-weight: bold;">MC JHT PGR &nbsp;&nbsp; :
						<?php echo $data['jahit_pinggir_s3'] ?></small></li>
			</td>
		</tr>
	</table>
	<br />
	<table class="table-ttd" style="width:330mm;">
		<tr>
			<td align="center" width="200px">&nbsp;</td>
			<td align="center" colspan="3">Dibuat Oleh :</td>
			<td align="center" width="200px">Diketahui Oleh :</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td align="center">Leader</td>
			<td align="center">Leader</td>
			<td align="center">Leader</td>
			<td></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td align="center"><?php echo $_GET['date_laporan'] ?></td>
			<td align="center"><?php echo $_GET['date_laporan'] ?></td>
			<td align="center"><?php echo $_GET['date_laporan'] ?></td>
			<td></td>
		</tr>
		<tr height="90px">
			<td>Tanda Tangan</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
</body>
<script src="../../bower_components/print_tools/jquery.3.5.1.js"></script>
<script>
	setTimeout(function () {
		window.print()
	}, 900);
</script>

</html>