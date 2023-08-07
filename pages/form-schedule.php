<script>
	function roundToTwo(num) {
		return +(Math.round(num + "e+2") + "e-2");
	}

	function aktif_staff() {
		if (document.forms['form1']['personil'].value == "bayu" || document.forms['form1']['personil'].value == "putri") {
			document.form1.acc_staff.removeAttribute("disabled");
			document.form1.acc_staff.setAttribute("required", true);
		} else {
			document.form1.acc_staff.setAttribute("disabled", true);
			document.form1.acc_staff.removeAttribute("required");
		}
	}

	function aktif() {
		if (document.forms['form1']['manual'].checked == true) {
			document.form1.nodemand.setAttribute("readonly", true);
			document.form1.nodemand.removeAttribute("required");
			document.form1.nodemand.value = "";
			document.form1.datepicker2.setAttribute("readonly", true);
			document.form1.datepicker2.removeAttribute("required");
			document.form1.datepicker2.value = "";
			document.form1.langganan.setAttribute("readonly", true);
			document.form1.langganan.removeAttribute("required");
			document.form1.langganan.value = "";
			document.form1.buyer.setAttribute("readonly", true);
			document.form1.buyer.removeAttribute("required");
			document.form1.buyer.value = "";
			document.form1.no_order.setAttribute("readonly", true);
			document.form1.no_order.removeAttribute("required");
			document.form1.no_order.value = "";
			document.form1.no_po.setAttribute("readonly", true);
			document.form1.no_po.removeAttribute("required");
			document.form1.no_po.value = "";
			document.form1.no_hanger.setAttribute("readonly", true);
			document.form1.no_hanger.removeAttribute("required");
			document.form1.no_hanger.value = "";
			document.form1.no_item.setAttribute("readonly", true);
			document.form1.no_item.removeAttribute("required");
			document.form1.no_item.value = "";
			document.form1.jns_kain.setAttribute("readonly", true);
			document.form1.jns_kain.removeAttribute("required");
			document.form1.jns_kain.value = "";
			document.form1.lebar.setAttribute("readonly", true);
			document.form1.lebar.removeAttribute("required");
			document.form1.lebar.value = "";
			document.form1.grms.setAttribute("readonly", true);
			document.form1.grms.removeAttribute("required");
			document.form1.grms.value = "";
			document.form1.warna.setAttribute("readonly", true);
			document.form1.warna.removeAttribute("required");
			document.form1.warna.value = "";
			document.form1.no_warna.setAttribute("readonly", true);
			document.form1.no_warna.removeAttribute("required");
			document.form1.no_warna.value = "";
			document.form1.qty1.setAttribute("readonly", true);
			document.form1.qty1.removeAttribute("required");
			document.form1.qty1.value = "";
			document.form1.qty2.setAttribute("readonly", true);
			document.form1.qty2.removeAttribute("required");
			document.form1.qty2.value = "";
			document.form1.satuan1.setAttribute("disabled", true);
			document.form1.satuan1.removeAttribute("required");
			document.form1.satuan1.value = "";
			document.form1.lot.setAttribute("readonly", true);
			document.form1.lot.removeAttribute("required");
			document.form1.lot.value = "";
			document.form1.qty3.setAttribute("readonly", true);
			document.form1.qty3.removeAttribute("required");
			document.form1.qty3.value = "";
			document.form1.qty4.setAttribute("readonly", true);
			document.form1.qty4.removeAttribute("required");
			document.form1.qty4.value = "";
			document.form1.loading.setAttribute("readonly", true);
			document.form1.loading.removeAttribute("required");
			document.form1.loading.value = "";
			document.form1.no_rajut.setAttribute("readonly", true);
			document.form1.no_rajut.removeAttribute("required");
			document.form1.no_rajut.value = "";
			document.form1.kategori_warna.setAttribute("disabled", true);
			document.form1.kategori_warna.removeAttribute("required");
			document.form1.kategori_warna.value = "";
			document.form1.no_resep.setAttribute("readonly", true);
			document.form1.no_resep.removeAttribute("required");
			document.form1.no_resep.value = "";
			document.form1.resep.setAttribute("disabled", true);
			document.form1.resep.removeAttribute("required");
			document.form1.resep.value = "";
		} else {
			document.form1.nodemand.removeAttribute("readonly");
			document.form1.nodemand.setAttribute("required", true);
			document.form1.datepicker2.removeAttribute("readonly");
			document.form1.datepicker2.setAttribute("required", true);
			document.form1.langganan.removeAttribute("readonly");
			document.form1.langganan.setAttribute("required", false);
			document.form1.buyer.removeAttribute("readonly");
			document.form1.buyer.setAttribute("required", false);
			document.form1.no_order.removeAttribute("readonly");
			document.form1.no_order.setAttribute("required", false);
			document.form1.no_po.removeAttribute("readonly");
			document.form1.no_po.setAttribute("required", false);
			document.form1.no_hanger.removeAttribute("readonly");
			document.form1.no_hanger.setAttribute("required", false);
			document.form1.no_item.removeAttribute("readonly");
			document.form1.no_item.setAttribute("required", false);
			document.form1.jns_kain.removeAttribute("readonly");
			document.form1.jns_kain.setAttribute("required", false);
			document.form1.lebar.removeAttribute("readonly");
			document.form1.lebar.setAttribute("required", true);
			document.form1.grms.removeAttribute("readonly");
			document.form1.grms.setAttribute("required", true);
			document.form1.warna.removeAttribute("readonly");
			document.form1.warna.setAttribute("required", false);
			document.form1.no_warna.removeAttribute("readonly");
			document.form1.no_warna.setAttribute("required", false);
			document.form1.qty1.removeAttribute("readonly");
			document.form1.qty1.setAttribute("required", true);
			document.form1.qty2.removeAttribute("readonly");
			document.form1.qty2.setAttribute("required", true);
			document.form1.satuan1.removeAttribute("disabled");
			document.form1.satuan1.setAttribute("required", true);
			document.form1.lot.removeAttribute("readonly");
			document.form1.lot.setAttribute("required", true);
			document.form1.qty3.removeAttribute("readonly");
			document.form1.qty3.setAttribute("required", true);
			document.form1.qty4.removeAttribute("readonly");
			document.form1.qty4.setAttribute("required", true);
			document.form1.loading.removeAttribute("readonly");
			document.form1.loading.setAttribute("required", true);
			document.form1.no_rajut.removeAttribute("readonly");
			document.form1.no_rajut.setAttribute("required", false);
			document.form1.kategori_warna.removeAttribute("disable");
			document.form1.kategori_warna.setAttribute("required", false);
			document.form1.no_resep.removeAttribute("readonly");
			document.form1.no_resep.setAttribute("required", false);
			document.form1.resep.removeAttribute("disabled");
			document.form1.resep.setAttribute("required", false);
		}
	}

	function angka(e) {
		if (!/^[0-9 .]+$/.test(e.value)) {
			e.value = e.value.substring(0, e.value.length - 1);
		}
	}
</script>
<?php
	ini_set("error_reporting", 1);
	session_start();
	include_once ('koneksi.php');
	function nourut()
	{
		include ('koneksi.php');
		$format = date("ymd");
		$sql = mysqli_query($con,"SELECT nodemand FROM tbl_schedule WHERE substr(nodemand,1,6) like '%" . $format . "%' ORDER BY nodemand DESC LIMIT 1 ") or die(mysqli_error());
		$d = mysqli_num_rows($sql);
		if ($d > 0) {
			$r = mysqli_fetch_array($sql);
			$d = $r['nodemand'];
			$str = substr($d, 6, 2);
			$Urut = (int)$str;
		} else {
			$Urut = 0;
		}
		$Urut = $Urut + 1;
		$Nol = "";
		$nilai = 2 - strlen($Urut);
		for ($i = 1; $i <= $nilai; $i++) {
			$Nol = $Nol . "0";
		}
		$nipbr = $format . $Nol . $Urut;
		return $nipbr;
	}
	$nou = nourut();
	$nodemand=$_GET['nodemand'];
	$sql_ITXVIEWKK  = db2_exec($conn1, "SELECT
                                            TRIM(PRODUCTIONORDERCODE) AS PRODUCTIONORDERCODE,
                                            TRIM(DEAMAND) AS DEMAND,
                                            ORIGDLVSALORDERLINEORDERLINE,
                                            PROJECTCODE,
                                            ORDPRNCUSTOMERSUPPLIERCODE,
                                            TRIM(SUBCODE01) AS SUBCODE01, TRIM(SUBCODE02) AS SUBCODE02, TRIM(SUBCODE03) AS SUBCODE03, TRIM(SUBCODE04) AS SUBCODE04,
                                            TRIM(SUBCODE05) AS SUBCODE05, TRIM(SUBCODE06) AS SUBCODE06, TRIM(SUBCODE07) AS SUBCODE07, TRIM(SUBCODE08) AS SUBCODE08,
                                            TRIM(SUBCODE09) AS SUBCODE09, TRIM(SUBCODE10) AS SUBCODE10, 
                                            TRIM(ITEMTYPEAFICODE) AS ITEMTYPEAFICODE,
                                            TRIM(DSUBCODE05) AS NO_WARNA,
                                            TRIM(DSUBCODE02) || '-' || TRIM(DSUBCODE03)  AS NO_HANGER,
                                            TRIM(ITEMDESCRIPTION) AS ITEMDESCRIPTION,
                                            DELIVERYDATE
                                        FROM 
                                            ITXVIEWKK 
                                        WHERE 
											DEAMAND = '$nodemand'");
    $dt_ITXVIEWKK	= db2_fetch_assoc($sql_ITXVIEWKK);

	$sql_pelanggan_buyer 	= db2_exec($conn1, "SELECT TRIM(LANGGANAN) AS PELANGGAN, TRIM(BUYER) AS BUYER FROM ITXVIEW_PELANGGAN 
    												WHERE ORDPRNCUSTOMERSUPPLIERCODE = '$dt_ITXVIEWKK[ORDPRNCUSTOMERSUPPLIERCODE]' AND CODE = '$dt_ITXVIEWKK[PROJECTCODE]'");
    $dt_pelanggan_buyer		= db2_fetch_assoc($sql_pelanggan_buyer);

	if (!empty($dt_demand['ORIGDLVSALORDERLINEORDERLINE'])) {
        $orderline	= $dt_demand['ORIGDLVSALORDERLINEORDERLINE'];
    } else {
        $orderline	= '0';
    }

	$sql_po			= db2_exec($conn1, "SELECT TRIM(EXTERNALREFERENCE) AS NO_PO FROM ITXVIEW_KGBRUTO 
                    					WHERE PROJECTCODE = '$dt_ITXVIEWKK[PROJECTCODE]' AND ORIGDLVSALORDERLINEORDERLINE IN ($orderline)");
    $dt_po    		= db2_fetch_assoc($sql_po);

	$sql_noitem     = db2_exec($conn1, "SELECT * FROM ORDERITEMORDERPARTNERLINK WHERE INACTIVE = 0 
													AND ORDPRNCUSTOMERSUPPLIERCODE = '$dt_ITXVIEWKK[ORDPRNCUSTOMERSUPPLIERCODE]' 
													AND SUBCODE01 = '$dt_ITXVIEWKK[SUBCODE01]' AND SUBCODE02 = '$dt_ITXVIEWKK[SUBCODE02]' 
													AND SUBCODE03 = '$dt_ITXVIEWKK[SUBCODE03]' AND SUBCODE04 = '$dt_ITXVIEWKK[SUBCODE04]' 
													AND SUBCODE05 = '$dt_ITXVIEWKK[SUBCODE05]' AND SUBCODE06 = '$dt_ITXVIEWKK[SUBCODE06]'
													AND SUBCODE07 = '$dt_ITXVIEWKK[SUBCODE07]' AND SUBCODE08 ='$dt_ITXVIEWKK[SUBCODE08]'
													AND SUBCODE09 = '$dt_ITXVIEWKK[SUBCODE09]' AND SUBCODE10 ='$dt_ITXVIEWKK[SUBCODE10]'");
    $dt_item        = db2_fetch_assoc($sql_noitem);

	$sql_lebargramasi	= db2_exec($conn1, "SELECT i.LEBAR,
                                            CASE
                                                WHEN i2.GRAMASI_KFF IS NULL THEN i2.GRAMASI_FKF
                                                ELSE i2.GRAMASI_KFF
                                            END AS GRAMASI 
                                            FROM 
                                                ITXVIEWLEBAR i 
                                            LEFT JOIN ITXVIEWGRAMASI i2 ON i2.SALESORDERCODE = '$dt_ITXVIEWKK[PROJECTCODE]' AND i2.ORDERLINE = '$dt_ITXVIEWKK[ORIGDLVSALORDERLINEORDERLINE]'
                                            WHERE 
                                                i.SALESORDERCODE = '$dt_ITXVIEWKK[PROJECTCODE]' AND i.ORDERLINE = '$dt_ITXVIEWKK[ORIGDLVSALORDERLINEORDERLINE]'");
    $dt_lg				= db2_fetch_assoc($sql_lebargramasi);
	
	$sql_warna		= db2_exec($conn1, "SELECT DISTINCT TRIM(WARNA) AS WARNA FROM ITXVIEWCOLOR 
                                            WHERE ITEMTYPECODE = '$dt_ITXVIEWKK[ITEMTYPEAFICODE]' 
                                            AND SUBCODE01 = '$dt_ITXVIEWKK[SUBCODE01]' 
                                            AND SUBCODE02 = '$dt_ITXVIEWKK[SUBCODE02]'
                                            AND SUBCODE03 = '$dt_ITXVIEWKK[SUBCODE03]' 
                                            AND SUBCODE04 = '$dt_ITXVIEWKK[SUBCODE04]'
                                            AND SUBCODE05 = '$dt_ITXVIEWKK[SUBCODE05]' 
                                            AND SUBCODE06 = '$dt_ITXVIEWKK[SUBCODE06]'
                                            AND SUBCODE07 = '$dt_ITXVIEWKK[SUBCODE07]' 
                                            AND SUBCODE08 = '$dt_ITXVIEWKK[SUBCODE08]'
                                            AND SUBCODE09 = '$dt_ITXVIEWKK[SUBCODE09]' 
                                            AND SUBCODE10 = '$dt_ITXVIEWKK[SUBCODE10]'");
    $dt_warna		= db2_fetch_assoc($sql_warna);

	$sql_qtyorder   = db2_exec($conn1, "SELECT DISTINCT
                                                USEDUSERPRIMARYQUANTITY AS QTY_ORDER,
                                                USEDUSERSECONDARYQUANTITY AS QTY_ORDER_YARD,
                                                CASE
                                                    WHEN TRIM(USERSECONDARYUOMCODE) = 'kg' THEN 'Kg'
                                                    WHEN TRIM(USERSECONDARYUOMCODE) = 'yd' THEN 'Yard'
                                                    WHEN TRIM(USERSECONDARYUOMCODE) = 'm' THEN 'Meter'
                                                    ELSE 'PCS'
                                                END AS SATUAN_QTY
                                            FROM 
                                                ITXVIEW_RESERVATION_KK 
                                            WHERE 
                                                ORDERCODE = '$dt_ITXVIEWKK[DEMAND]'");
    $dt_qtyorder    = db2_fetch_assoc($sql_qtyorder);

	$sqlCek = mysqli_query($con,"SELECT * FROM tbl_schedule WHERE nodemand='$nodemand' ORDER BY id DESC LIMIT 1");
	$cek = mysqli_num_rows($sqlCek);
	$rcek = mysqli_fetch_array($sqlCek);
	$sqlCek1 = mysqli_query($con,"SELECT * FROM tbl_schedule WHERE nodemand='$nodemand' AND not status='selesai' ORDER BY id DESC LIMIT 1");
	$cek1 = mysqli_num_rows($sqlCek1);

?>
<?php
$Kapasitas	= isset($_POST['kapasitas']) ? $_POST['kapasitas'] : '';
$TglMasuk	= isset($_POST['tglmsk']) ? $_POST['tglmsk'] : '';
$Item		= isset($_POST['item']) ? $_POST['item'] : '';
$Warna		= isset($_POST['warna']) ? $_POST['warna'] : '';
$Langganan	= isset($_POST['langganan']) ? $_POST['langganan'] : '';
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Input Data Kartu Kerja</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="col-md-6">

				<div class="form-group">
					<label for="nodemand" class="col-sm-3 control-label">No Demand</label>
					<div class="col-sm-4">
						<input name="nodemand" type="text" class="form-control" id="nodemand" onchange="window.location='FormSchedule-'+this.value" value="<?php echo $_GET['nodemand']; ?>" placeholder="No Demand" required>
					</div>
				</div>
				<div class="form-group">
					<label for="langganan" class="col-sm-3 control-label">Langganan</label>
					<div class="col-sm-8">
						<input name="langganan" type="text" class="form-control" id="langganan" value="<?php if ($cek > 0) {
																											echo $rcek['langganan'];
																										} else {
																											echo $dt_pelanggan_buyer['PELANGGAN'];
																										} ?>" placeholder="Langganan">
					</div>
				</div>
				<div class="form-group">
					<label for="buyer" class="col-sm-3 control-label">Buyer</label>
					<div class="col-sm-8">
						<input name="buyer" type="text" class="form-control" id="buyer" value="<?php if ($cek > 0) {
																									echo $rcek['buyer'];
																								} else {
																									echo $dt_pelanggan_buyer['BUYER'];
																								} ?>" placeholder="Buyer">
					</div>
				</div>
				<div class="form-group">
					<label for="no_order" class="col-sm-3 control-label">No Order</label>
					<div class="col-sm-4">
						<input name="no_order" type="text" class="form-control" id="no_order" value="<?php if ($cek > 0) {
																											echo $rcek['no_order'];
																										} else {
																											echo $dt_ITXVIEWKK['PROJECTCODE'];
																										} ?>" placeholder="No Order">
					</div>
				</div>
				<div class="form-group">
					<label for="no_po" class="col-sm-3 control-label">PO</label>
					<div class="col-sm-5">
						<input name="no_po" type="text" class="form-control" id="no_po" value="<?php if ($cek > 0) {
																									echo $rcek['po'];
																								} else {
																									echo $dt_po['NO_PO'];
																								} ?>" placeholder="PO">
					</div>
				</div>
				<div class="form-group">
					<label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
					<div class="col-sm-3">
						<input name="no_hanger" type="text" class="form-control" id="no_hanger" value="<?php if ($cek > 0) {
																											echo $rcek['no_hanger'];
																										} else {
																											if ($dt_ITXVIEWKK['SUBCODE02']!="") {
																												echo trim($dt_ITXVIEWKK['SUBCODE02']).'-'.trim($dt_ITXVIEWKK['SUBCODE03']);
																											}
																										} ?>" placeholder="No Hanger">
					</div>
					<div class="col-sm-3">
						<input name="no_item" type="text" class="form-control" id="no_item" value="<?php if ($rcek['no_item'] != "") {
																										echo $rcek['no_item'];
																									} else if ($dt_item['EXTERNALITEMCODE'] != "") {
																										echo $dt_item['EXTERNALITEMCODE'];
																									}?>" placeholder="No Item">
					</div>
				</div>
				<div class="form-group">
					<label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
					<div class="col-sm-8">
						<textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain"><?php if ($cek > 0) {
																													echo $rcek['jenis_kain'];
																												} else {
																													if ($dt_ITXVIEWKK['ITEMDESCRIPTION']!="") {
																														echo $dt_ITXVIEWKK['ITEMDESCRIPTION'];
																													} 
																												} ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_delivery" class="col-sm-3 control-label">Tgl. Delivery</label>
					<div class="col-sm-4">
						<div class="input-group date">
							<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
							<input name="tgl_delivery" type="text" class="form-control pull-right" id="datepicker2" placeholder="0000-00-00" value="<?php if ($cek > 0) {
																																						echo $rcek['tgl_delivery'];
																																					} else {
																																						if ($dt_ITXVIEWKK['DELIVERYDATE']!="") {
																																							echo date('Y-m-d', strtotime($dt_ITXVIEWKK['DELIVERYDATE']));
																																						}
																																					} ?>" required />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="l_g" class="col-sm-3 control-label">Lebar X Gramasi</label>
					<div class="col-sm-2">
						<input name="lebar" type="text" class="form-control" id="lebar" value="<?php if ($cek > 0) {
																									echo $rcek['lebar'];
																								} else {
																									echo $dt_lg['LEBAR'];
																								} ?>" placeholder="0" required>
					</div>
					<div class="col-sm-2">
						<input name="grms" type="text" class="form-control" id="grms" value="<?php if ($cek > 0) {
																									echo $rcek['gramasi'];
																								} else {
																									echo $dt_lg['GRAMASI'];
																								} ?>" placeholder="0" required>
					</div>
				</div>
				<div class="form-group">
					<label for="warna" class="col-sm-3 control-label">Warna</label>
					<div class="col-sm-8">
						<input name="warna" type="text" class="form-control" id="warna" value="<?php if ($cek > 0) {
																									echo $rcek['warna'];
																								} else {
																									if ($dt_warna['WARNA']!="") {
																										echo $dt_warna['WARNA'];
																									}
																								} ?>" placeholder="Warna">
					</div>
				</div>

			</div>
			<!-- col -->
			<div class="col-md-6">
				<div class="form-group">
					<label for="no_warna" class="col-sm-3 control-label">No Warna</label>
					<div class="col-sm-8">
						<input name="no_warna" type="text" class="form-control" id="no_warna" value="<?php if ($cek > 0) {
																											echo $rcek['no_warna'];
																										} else {
																											if ($dt_ITXVIEWKK['NO_WARNA']!="") {
																												echo $dt_ITXVIEWKK['NO_WARNA'];
																											}
																										} ?>" placeholder="No Warna">
					</div>
				</div>
				<div class="form-group">
					<label for="qty_order" class="col-sm-3 control-label">Qty Order</label>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="qty1" type="text" class="form-control" id="qty1" value="<?php if ($cek > 0) {
																										echo $rcek['qty_order'];
																									} else {
																										echo round($dt_qtyorder['QTY_ORDER'], 2);
																									} ?>" placeholder="0.00" required>
							<span class="input-group-addon">KGs</span>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
							<input name="qty2" type="text" class="form-control" id="qty2" value="<?php if ($cek > 0) {
																										echo $rcek['pjng_order'];
																									} else {
																										echo round($dt_qtyorder['QTY_ORDER_YARD'], 2);
																									} ?>" placeholder="0.00" style="text-align: right;" required>
							<span class="input-group-addon">
								<select name="satuan1" style="font-size: 12px;" id="satuan1" required>
									<option value="" selected disabled>-Pilih-</option>
									<option value="Yard" <?php if ($dt_qtyorder['SATUAN_QTY']=="yd") {
																echo "SELECTED";
															} ?>>Yard</option>
									<option value="Meter" <?php if ($dt_qtyorder['SATUAN_QTY']=="m") {
																echo "SELECTED";
															} ?>>Meter</option>
									<option value="PCS" <?php if ($dt_qtyorder['SATUAN_QTY']=="un") {
															echo "SELECTED";
														} ?>>PCS</option>
								</select>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="lot" class="col-sm-3 control-label">Lot</label>
					<div class="col-sm-2">
						<input name="nokk" type="hidden" class="form-control" id="nokk" value="<?php if ($cek > 0) {
																								echo $rcek['nokk'];
																							} else {
																								echo $dt_ITXVIEWKK['PRODUCTIONORDERCODE'];
																							} ?>" placeholder="Lot">
						<input name="lot" type="text" class="form-control" id="lot" value="<?php if ($cek > 0) {
																								echo $rcek['lot'];
																							} else {
																								echo $dt_ITXVIEWKK['PRODUCTIONORDERCODE'];
																							} ?>" placeholder="Lot">
					</div>
				</div>
				<div class="form-group">
					<label for="jml_bruto" class="col-sm-3 control-label">Roll &amp; Qty</label>
					<div class="col-sm-2">
						<input name="qty3" type="text" class="form-control" id="qty3" value="<?php if ($cek > 0) {
																									echo $rcek['rol'];
																								} else {
																									if ($rowr['JML_ROLL'] != 0) {
																										echo $rowr['JML_ROLL'];
																									}
																								} ?>" placeholder="0.00" required>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input name="qty4" type="text" class="form-control" id="qty4" value="<?php if ($cek > 0) {
																										echo $rcek['bruto'];
																									} else {
																										echo round($dt_qtyorder['QTY_ORDER'],2);
																									} ?>" placeholder="0.00" style="text-align: right;" required>
							<span class="input-group-addon">KGs</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="nokk_legacy" class="col-sm-3 control-label">No KK Legacy</label>
					<div class="col-sm-4">
						<input name="nokk_legacy" type="text" class="form-control" id="nokk_legacy" value="<?php if ($cek > 0) {
																								echo $rcek['nokk_legacy'];
																							}?>" placeholder="No KK Legacy" required>
					</div>
				</div>
				<div class="form-group">
					<label for="jenis_kk" class="col-sm-3 control-label">Jenis KK</label>
					<div class="col-sm-4">
						<select name="jenis_kk" class="form-control">
							<option value="">-Pilih-</option>
							<option value="TEST MINIBULK" <?php if($rcek['jenis_kk']=="TEST MINIBULK"){echo "SELECTED";}?>>TEST MINIBULK</option>
							<option value="TEST RESEP BARU" <?php if($rcek['jenis_kk']=="TEST RESEP BARU"){echo "SELECTED";}?>>TEST RESEP BARU</option>
							<option value="FIRST LOT" <?php if($rcek['jenis_kk']=="FIRST LOT"){echo "SELECTED";}?>>FIRST LOT</option>
							<option value="URGENT GANTI KAIN" <?php if($rcek['jenis_kk']=="URGENT GANTI KAIN"){echo "SELECTED";}?>>URGENT GANTI KAIN</option>
							<option value="UNTUK MESIN KOSONG" <?php if($rcek['jenis_kk']=="UNTUK MESIN KOSONG"){echo "SELECTED";}?>>UNTUK MESIN KOSONG</option>
							<option value="TEST KAIN" <?php if($rcek['jenis_kk']=="TEST KAIN"){echo "SELECTED";}?>>TEST KAIN</option>
							<option value="KAIN BONGKARAN" <?php if($rcek['jenis_kk']=="KAIN BONGKARAN"){echo "SELECTED";}?>>KAIN BONGKARAN</option>
							<option value="KK URGENT" <?php if($rcek['jenis_kk']=="KK URGENT"){echo "SELECTED";}?>>KK URGENT</option>
						</select>
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="no_mc" class="col-sm-3 control-label">No MC</label>
					<div class="col-sm-3">
						<select name="no_mc" class="form-control" id="no_mc" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlKap = mysqli_query($con,"SELECT no_mesin FROM tbl_no_mesin where `status` = 'Normal' ORDER BY no_mesin ASC");
							while ($rK = mysqli_fetch_array($sqlKap)) {
							?>
								<option value="<?php echo $rK['no_mesin']; ?>"><?php echo $rK['no_mesin']; ?></option>
							<?php } ?>

						</select>
					</div>

				</div> -->
				<!-- <div class="form-group">
					<label for="no_urut" class="col-sm-3 control-label">No Urut</label>
					<div class="col-sm-2">
						<select name="no_urut" class="form-control" id="no_urut" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlKap = mysqli_query($con,"SELECT no_urut FROM tbl_urut ORDER BY no_urut ASC");
							while ($rK = mysqli_fetch_array($sqlKap)) {
							?>
								<option value="<?php echo $rK['no_urut']; ?>"><?php echo $rK['no_urut']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div> -->
				<!-- <div class="form-group">
					<label for="g_shift" class="col-sm-3 control-label">Group Shift</label>
					<div class="col-sm-2">
						<select name="g_shift" class="form-control" required>
							<option value="">-Pilih-</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="shift" class="col-sm-3 control-label">Waktu Shift</label>
					<div class="col-sm-2">
						<select name="shift" class="form-control" required>
							<option value="">-Pilih-</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="proses" class="col-sm-3 control-label">Proses</label>
					<div class="col-sm-5">
						<select name="proses" class="form-control" id="proses" onChange="cekpro(); cekpro1(); cekpro2(); aktif_staff();" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlKap = mysqli_query($con,"SELECT proses FROM tbl_proses ORDER BY id ASC");
							while ($rK = mysqli_fetch_array($sqlKap)) {
							?>
								<option value="<?php echo $rK['proses']; ?>"><?php echo $rK['proses']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div> -->

				<!-- <div class="form-group">
					<label for="buka" class="col-sm-3 control-label">Buka/Balik</label>
					<div class="col-sm-3">
						<select name="buka" class="form-control" id="buka" required>
							<option value="">-Pilih-</option>
							<option value="Biasa">Buka</option>
							<option value="Balik">Balik</option>
						</select>
					</div>
				</div> -->
				<!-- <div class="form-group" style="display: none;">
					<label for="personil" class="col-sm-3 control-label">Personil</label>
					<div class="col-sm-5">
						<input name="personil" type="text" class="form-control" id="personil" value="<?php echo $_SESSION['deptGkg']; ?>" placeholder="personil" readonly>
					</div>
				</div> -->
				<!-- <?php if ($_SESSION['lvl_idGkg'] == 'ADMIN' or $_SESSION['lvl_idGkg'] == 'LEADER') { ?>
					<div class="form-group">
						<label for="operator" class="col-sm-3 control-label">Operator</label>
						<div class="col-sm-5">
							<select name="operator" class="form-control" id="operator" required>
								<option value="">-Pilih-</option>
								<?php
								$sqlNO = mysqli_query($con,"SELECT DISTINCT nama FROM tbl_user WHERE `status`='Aktif' ORDER BY nama ASC");
								while ($rNO = mysqli_fetch_array($sqlNO)) {
								?>
									<option value="<?php echo $rNO['nama']; ?>"><?php echo $rNO['nama']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label for="personil" class="col-sm-3 control-label">Operator</label>
						<div class="col-sm-5">
							<input name="operator" id="operator" class="form-control" value="<?php echo $_SESSION['usridGkg'] ?>" readonly>
						</div>
					</div>
				<?php } ?>
				<div class="form-group">
					<label for="personil" class="col-sm-3 control-label">Tujuan</label>
					<div class="col-sm-5">
						<select name="dept_tujuan" required class="form-control select2">
							<option selected disabled>-Pilih-</option>

							<?php
							$sql_dept = mysqli_query($con,"SELECT * from tbl_departement where is_active = 'TRUE' ");
							while ($li = mysqli_fetch_array($sql_dept)) {
							?>
								<option value="<?php echo $li['acronym'] ?>"><?php echo $li['acronym'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="catatan" class="col-sm-3 control-label">Catatan</label>
					<div class="col-sm-8">
						<textarea name="catatan" class="form-control" id="catatan" placeholder="Catatan...."></textarea>
					</div>

				</div> -->
			</div>
			<input type="hidden" value="<?php if ($cek > 0) {
											echo $rcek['no_ko'];
										} else {
											echo $rKO['KONo'];
										} ?>" name="no_ko">
		</div>
		<div class="box-footer">
			<button type="button" class="btn btn-default pull-left" name="back" value="kembali" onClick="window.location='Schedule'">Kembali <i class="fa fa-arrow-circle-o-left"></i></button>

			<button type="submit" class="btn btn-primary pull-right" name="save" value="save">Simpan <i class="fa fa-save"></i></button>
		</div>
		<!-- /.box-footer -->
	</div>
</form>

<?php
if ($_POST['save'] == "save") {
	$qryCek = mysqli_query($con,"SELECT * from tbl_schedule WHERE `status`='sedang jalan' and  no_mesin='$_POST[no_mc]'");
	$row = mysqli_num_rows($qryCek);
	$qryCekN = mysqli_query($con,"SELECT * from tbl_schedule WHERE nodemand='$_POST[nodemand]' and  no_mesin='$_POST[no_mc]' and DATE_FORMAT(tgl_update,'%Y-%m-%d')=DATE_FORMAT( now( ), '%Y-%m-%d' )");
	$rowN = mysqli_num_rows($qryCekN);
	$qryCekN1 = mysqli_query($con,"SELECT * from tbl_schedule WHERE no_urut='$_POST[no_urut]' and  no_mesin='$_POST[no_mc]' and DATE_FORMAT(tgl_update,'%Y-%m-%d')=DATE_FORMAT( now( ), '%Y-%m-%d' )");
	$rowN1 = mysqli_num_rows($qryCekN1);
	// if ($row > 0 and $_POST[no_urut] == "1") {
	// 	echo "<script> swal({
	//         title: 'Tidak bisa input urutan ke-`1`, mesin masih jalan',
	//         text: ' Klik OK untuk Input No Urut kembali',
	//         type: 'warning'
	//     }, function(){
	//         window.location='';
	//     });</script>";
	// } else if ($rowN > 0) {
	// 	echo "<script> swal({
	//         title: 'Tidak bisa input, NoKK sudah di mesin ini',
	//         text: ' Klik OK untuk Input No Urut kembali',
	//         type: 'warning'
	//     }, function(){
	//         window.location='';
	//     });</script>";
	// } else if ($rowN1 > 0) {
	// 	echo "<script> swal({
	//         title: 'Tidak bisa input, No Urut $_POST[no_urut] ini sudah di mesin ini',
	//         text: ' Klik OK untuk Input No Urut kembali',
	//         type: 'warning'
	//     }, function(){
	//         window.location='';
	//     });</script>";
	// } else {
	// if ($_POST['nodemand'] != "") {
	// 	$kartu = $_POST['nodemand'];
	// } else {
	// 	$kartu = $nou;
	// }
	$warna = str_replace("'", "''", $_POST['warna']);
	$nowarna = str_replace("'", "''", $_POST['no_warna']);
	$jns = str_replace("'", "''", $_POST['jns_kain']);
	$po = str_replace("'", "''", $_POST['no_po']);
	$catatan = str_replace("'", "''", $_POST['catatan']);
	$lot = trim($_POST['lot']);
	$nomesin = str_replace("'", "''", $_POST['no_mc']);

	if ($_SESSION['lvl_idGkg'] == "USER") {
		$status = 'sedang jalan';
		$waktu_mulai = date('Y-m-d H:i:s');
		$petugas_buka = $_SESSION['nama1Gkg'];
	} else {
		$status = 'antri mesin';
		$waktu_mulai = null;
		$petugas_buka = null;
	}
	$operator = strtoupper($_POST['operator']);
	// var_dump($operator);
	// die;

	$sqlData = mysqli_query($con,"INSERT INTO tbl_schedule SET
		  nodemand='$_POST[nodemand]',
		  nokk='$_POST[nokk]',
		  langganan='$_POST[langganan]',
		  buyer='$_POST[buyer]',
		  no_order='$_POST[no_order]',
		  po='$po',
		  no_hanger='$_POST[no_hanger]',
		  no_item='$_POST[no_item]',
		  jenis_kain='$jns',
		  tgl_delivery='$_POST[tgl_delivery]',
		  lebar='$_POST[lebar]',
		  gramasi='$_POST[grms]',
		  warna='$warna',
		  no_warna='$nowarna',
		  qty_order='$_POST[qty1]',
		  pjng_order='$_POST[qty2]',
		  satuan_order='$_POST[satuan1]',
		  lot='$lot',
		  rol='$_POST[qty3]',
		  bruto='$_POST[qty4]',	
		  no_sch='$_POST[no_urut]',
		  revisi='$_POST[revisi]',
		  ket_status='$_POST[ket]',
		  `status`='$status',
		  `tgl_mulai`='$waktu_mulai',
		  `petugas_buka`='$petugas_buka',
		  ket_kain='$_POST[ket_kain]',
		  tgl_masuk=now(),
		  create_by='$_SESSION[nama1Gkg]',
		  nokk_legacy='$_POST[nokk_legacy]',
		  jenis_kk='$_POST[jenis_kk]',
		  create_time=now(),
		  tgl_update=now()");

	if ($sqlData) {
		echo "<script>swal({
					title: 'Data Tersimpan',   
					text: 'Klik Ok untuk input data kembali',
					type: 'success',
					}).then((result) => {
					if (result.value) {
						window.location.href='Schedule'; 
					}
					});</script>";
	}
	// }
}
if ($_POST['update'] == "update") {
	$warna = str_replace("'", "''", $_POST['warna']);
	$nowarna = str_replace("'", "''", $_POST['no_warna']);
	$jns = str_replace("'", "''", $_POST['jns_kain']);
	$po = str_replace("'", "''", $_POST['no_po']);
	$catatan = str_replace("'", "''", $_POST['catatan']);
	$lot = trim($_POST['lot']);
	$sqlData = mysqli_query($con,"UPDATE tbl_schedule SET 
		  no_sch='$_POST[no_urut]',
		  proses='$_POST[proses]',
		  revisi='$_POST[revisi]',
		  g_shift='$_POST[g_shift]',
		  shift='$_POST[shift]',
		  ket_status='$_POST[ket]',
		  personil='$_POST[personil]',
		  catatan='$catatan',
		  buka='$_POST[buka]',
		  jenis_kk='$_POST[jenis_kk]',
		  tgl_stop=now(),
		  tgl_update=now()
		  WHERE nodemand='$_POST[nodemand]'");

	if ($sqlData) {
		// echo "<script>alert('Data Telah Diubah');</script>";
		// echo "<script>window.location.href='?p=Input-Data-KJ;</script>";
		echo "<script>swal({
  title: 'Data Telah DiUbah',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    
	 window.location.href='Schedule'; 
  }
});</script>";
	}
}
?>