<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<title>Data Pemakaian Bahan Baku <?php echo date('Y-m-d') ?></title>
<link rel="stylesheet" href="../../bower_components/print_tools/bootstrap4.css">
<link href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<style>
@page {
	size: A4;
	margin: 30px 30px 30px 30px;
	font-size: 8pt !important;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	size: landscape;
}

@media print {
	@page {
		size: A4;
		margin: 30px 30px 30px 30px;
		size: landscape;
		font-size: 8pt !important;
	}

	html,
	body {
		width: 297mm;
		height: 210mm;
		background: #FFF;
		overflow: visible;
	}

	/* body {
            padding-top: 15mm;
        } */

	.table-ttd {
		border-collapse: collapse;
		width: 100%;
		font-size: 8pt !important;
	}

	.table-ttd tr,
	.table-ttd tr td {
		border: 0.5px solid black;
		padding: 4px;
		padding: 4px;
		font-size: 8pt !important;
	}
}

.table-ttd {
	border-collapse: collapse;
	width: 100%;
	font-size: 8pt !important;
}

.table-ttd tr,
.table-ttd tr td {
	border: 1px solid black;
	padding: 5px;
	padding: 5px;
	font-size: 8pt !important;
}

tr {
	/* page-break-before: always; */
	page-break-inside: avoid;
	font-size: 8pt !important;
}

.tablee td,
.tablee th {
	/* border: 1px solid black; */
	padding: 5px;
	font-size: 8pt !important;

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
	font-size: 8pt !important;
}

.tablee tr:nth-child(even) {
	background-color: #f2f2f2;
	font-size: 8pt !important;
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
	font-size: 8pt !important;
}
</style>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<table class="table-ttd" style="width: 367mm;">
		<tr>
			<td align="center">
				<img src="logo.png" width="40mm" height="40mm">
			</td>
			<td>
				<b>
					<li>
						<h5 style="font-weight: bold;">DATA PEMAKAIAN BAHAN BAKU</h5>
					</li>
					<li><span>No. Form : <b>FW-14-GKG-09/06</b></span></li>
					<li><span>-</span></li>
				</b>
			</td>
		</tr>
	</table>
	<li style="display:inline; margin-left: 5px;">Tanggal : <?= $_GET['tgl1']; ?></li>
	<li style="display:inline; margin-left: 150px;">Shift : <?= $_GET['shift']; ?></li>
	<table class="table-ttd" style="width: 367mm;">
		<thead>
			<tr>
				<td align="center" rowspan=" 2">Langganan</td>
				<td align="center" rowspan="2">No.order</td>
				<td align="center" rowspan="2">Jns.kain</td>
				<td align="center" rowspan="2">Warna</td>
				<td align="center" rowspan="2">Prod. Order</td>
				<td align="center" rowspan="2">Prod. Demand</td>
				<td align="center" rowspan="2">Lot</td>
				<td align="center" rowspan="2">Roll</td>

				<td align="center" colspan="2" align="center">Quantity</td>

				<td align="center" rowspan="2" align="center">Operation</td>

				<td align="center" colspan="2" align="center">Jam</td>

				<td align="center" rowspan="2">No.MC</td>
				<td align="center" rowspan="2">No.Grbk</td>

				<td align="center" colspan="2" align="center">Petugas</td>

				<td align="center" class="rotation" rowspan="2">Leader <br> Check</td>
			</tr>
			<tr>
				<td align="center">Qty</td>
				<td colspan="1" align="center">Proces/To</td>

				<td align="center">Mulai</td>
				<td align="center">Selesai</td>

				<td align="center">Mulai</td>
				<td align="center">Selesai</td>
			</tr>
		</thead>
		<tbody>
			<?php
            if ($_GET["shift"] != 'ALL') {
                if ($_GET["shift"] == 1) {
                    $start_shift3 = $_GET['tgl1'] . " 07:00:00";
                    $end_shift3 = $_GET['tgl2'] . " 15:00:00";
                } else if ($_GET["shift"] == 2) {
                    $start_shift3 = $_GET['tgl1'] . " 15:00:00";
                    $end_shift3 = $_GET['tgl2'] . " 23:00:00";
                } else if ($_GET["shift"] == 3) {
                    $start_shift3 = $_GET['tgl1'] . " 23:00:00";
                    $end_shift3 = $_GET['tgl2'] . " 07:00:00";
                }
                $sqlDB21 = "SELECT
                                TRIM(x.PRODUCTIONORDERCODE) AS PRODUCTIONORDERCODE,
                                x.OPERATIONCODE, 
                                x.OPERATORCODE,
                                x.PROGRESSSTARTPROCESSDATE, 
                                x.PROGRESSSTARTPROCESSTIME ,
                                x.MACHINECODE ,
                                x.CREATIONDATETIME,
                                r.LONGDESCRIPTION,  
                                i.SUBCODE01,
                                i.SUBCODE02,
                                i.SUBCODE03,
                                i.SUBCODE04,
                                i.SUBCODE05,
                                i.SUBCODE06,
                                i.SUBCODE07,
                                i.SUBCODE08,
                                i.SUBCODE09,
                                i.SUBCODE10,
                                i.ITEMNO,
                                LISTAGG(TRIM(i.PRO_ORDER), ', ') PRO_ORDER,
                                LISTAGG(TRIM(i.PRODUCTIONDEMANDCODE), ', ') PRODUCTIONDEMANDCODE,
                                LISTAGG(i.LANGGANAN, ', ') AS LANGGANAN,
                                i.WARNA,
                                i.NO_WARNA,
                                i.JENISKAIN,
                                LISTAGG(i.LOT, ', ') AS LOT
                            FROM
                                PRODUCTIONPROGRESS x
                            LEFT OUTER JOIN (
                                    SELECT
                                        p.SUBCODE01,
                                        p.SUBCODE02,
                                        p.SUBCODE03,
                                        p.SUBCODE04,
                                        p.SUBCODE05,
                                        p.SUBCODE06,
                                        p.SUBCODE07,
                                        p.SUBCODE08,
                                        p.SUBCODE09,
                                        p.SUBCODE10,
                                        CONCAT(TRIM(p.SUBCODE02), TRIM(p.SUBCODE03)) AS ITEMNO,
                                        p.ORIGDLVSALORDLINESALORDERCODE AS PRO_ORDER,
                                        ps.PRODUCTIONORDERCODE,
                                        ps.PRODUCTIONDEMANDCODE,
                                        E.LEGALNAME1 AS LANGGANAN,
                                        TRIM(f.LONGDESCRIPTION) AS WARNA,
                                        TRIM(f.CODE) AS NO_WARNA,
                                        PRODUCT.LONGDESCRIPTION AS JENISKAIN,
                                        p.DESCRIPTION AS LOT
                                    FROM
                                        PRODUCTIONDEMAND p
                                    LEFT JOIN PRODUCT PRODUCT ON PRODUCT.ITEMTYPECODE = p.ITEMTYPEAFICODE
                                                            AND PRODUCT.SUBCODE01 = p.SUBCODE01
                                                            AND PRODUCT.SUBCODE02 = p.SUBCODE02
                                                            AND PRODUCT.SUBCODE03 = p.SUBCODE03
                                                            AND PRODUCT.SUBCODE04 = p.SUBCODE04
                                                            AND PRODUCT.SUBCODE05 = p.SUBCODE05
                                                            AND PRODUCT.SUBCODE06 = p.SUBCODE06
                                                            AND PRODUCT.SUBCODE07 = p.SUBCODE07
                                                            AND PRODUCT.SUBCODE08 = p.SUBCODE08
                                                            AND PRODUCT.SUBCODE09 = p.SUBCODE09
                                                            AND PRODUCT.SUBCODE10 = p.SUBCODE10
                                    LEFT OUTER JOIN 
                                            (
                                            SELECT
                                                PRODUCTIONDEMANDSTEP.PRODUCTIONORDERCODE,
                                                PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE
                                            FROM
                                                PRODUCTIONDEMANDSTEP PRODUCTIONDEMANDSTEP
                                            GROUP BY
                                                PRODUCTIONDEMANDSTEP.PRODUCTIONORDERCODE,
                                                PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE
                                        ) ps ON p.CODE = ps.PRODUCTIONDEMANDCODE
                                    LEFT OUTER JOIN
                                            (
                                            SELECT
                                                BUSINESSPARTNER.LEGALNAME1,
                                                ORDERPARTNER.CUSTOMERSUPPLIERCODE
                                            FROM
                                                BUSINESSPARTNER BUSINESSPARTNER
                                            LEFT JOIN ORDERPARTNER ORDERPARTNER ON
                                                BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
                                        ) E ON p.CUSTOMERCODE = E.CUSTOMERSUPPLIERCODE
                                    LEFT OUTER JOIN USERGENERICGROUP f ON p.SUBCODE05 = f.CODE AND f.USERGENERICGROUPTYPECODE = 'CL1'
                                    LEFT OUTER JOIN PRODUCTIONDEMAND h ON p.ORIGDLVSALORDLINESALORDERCODE = h.ORIGDLVSALORDLINESALORDERCODE
                                        AND p.SUBCODE01 = h.SUBCODE01
                                        AND p.SUBCODE02 = h.SUBCODE02
                                        AND p.SUBCODE03 = h.SUBCODE03
                                        AND p.SUBCODE04 = h.SUBCODE04
                                        AND h.ITEMTYPEAFICODE = 'KFF'
                                    GROUP BY
                                        p.SUBCODE01,
                                        p.SUBCODE02,
                                        p.SUBCODE03,
                                        p.SUBCODE04,
                                        p.SUBCODE05,
                                        p.SUBCODE06,
                                        p.SUBCODE07,
                                        p.SUBCODE08,
                                        p.SUBCODE09,
                                        p.SUBCODE10,
                                        p.ORIGDLVSALORDLINESALORDERCODE,
                                        ps.PRODUCTIONORDERCODE,
                                        ps.PRODUCTIONDEMANDCODE,
                                        E.LEGALNAME1,
                                        f.LONGDESCRIPTION,
                                        f.CODE,
                                        PRODUCT.LONGDESCRIPTION,
                                        p.DESCRIPTION
                                ) i ON i.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE
                            LEFT OUTER JOIN RESOURCES r ON r.CODE = x.OPERATORCODE
                            WHERE
                                (x.OPERATIONCODE = 'BAT2' OR x.OPERATIONCODE = 'BKN1' OR x.OPERATIONCODE = 'BEL1' OR x.OPERATIONCODE = 'BAT3'  OR x.OPERATIONCODE = 'BBS1' OR x.OPERATIONCODE = 'JHP1' OR x.OPERATIONCODE = 'WAIT36')
                                AND x.PROGRESSTEMPLATECODE = 'S01'
                                AND TIMESTAMP(TRIM(x.PROGRESSSTARTPROCESSDATE), TRIM(x.PROGRESSSTARTPROCESSTIME)) BETWEEN '$start_shift3' AND '$end_shift3'
                            GROUP BY 
                                x.PRODUCTIONORDERCODE,
                                x.OPERATIONCODE, 
                                x.OPERATORCODE,
                                x.PROGRESSSTARTPROCESSDATE, 
                                x.PROGRESSSTARTPROCESSTIME ,
                                x.MACHINECODE ,
                                x.CREATIONDATETIME,
                                r.LONGDESCRIPTION,
                                i.SUBCODE01,
                                i.SUBCODE02,
                                i.SUBCODE03,
                                i.SUBCODE04,
                                i.SUBCODE05,
                                i.SUBCODE06,
                                i.SUBCODE07,
                                i.SUBCODE08,
                                i.SUBCODE09,
                                i.SUBCODE10,
                                i.ITEMNO,
                                i.WARNA,
                                i.NO_WARNA,
                                i.JENISKAIN";
                $stmt1 = db2_exec($conn1, $sqlDB21);
            } else if ($_GET["shift"] == 'ALL') {
                $sqlDB21 = "SELECT
                                    TRIM(x.PRODUCTIONORDERCODE) AS PRODUCTIONORDERCODE,
                                    x.OPERATIONCODE, 
                                    x.OPERATORCODE,
                                    x.PROGRESSSTARTPROCESSDATE, 
                                    x.PROGRESSSTARTPROCESSTIME ,
                                    x.MACHINECODE ,
                                    x.CREATIONDATETIME,
                                    r.LONGDESCRIPTION,  
                                    i.SUBCODE01,
                                    i.SUBCODE02,
                                    i.SUBCODE03,
                                    i.SUBCODE04,
                                    i.SUBCODE05,
                                    i.SUBCODE06,
                                    i.SUBCODE07,
                                    i.SUBCODE08,
                                    i.SUBCODE09,
                                    i.SUBCODE10,
                                    i.ITEMNO,
                                    LISTAGG(TRIM(i.PRO_ORDER), ', ') PRO_ORDER,
                                    LISTAGG(TRIM(i.PRODUCTIONDEMANDCODE), ', ') PRODUCTIONDEMANDCODE,
                                    LISTAGG(i.LANGGANAN, ', ') AS LANGGANAN,
                                    i.WARNA,
                                    i.NO_WARNA,
                                    i.JENISKAIN,
                                    LISTAGG(i.LOT, ', ') AS LOT
                                FROM
                                    PRODUCTIONPROGRESS x
                                LEFT OUTER JOIN (
                                        SELECT
                                            p.SUBCODE01,
                                            p.SUBCODE02,
                                            p.SUBCODE03,
                                            p.SUBCODE04,
                                            p.SUBCODE05,
                                            p.SUBCODE06,
                                            p.SUBCODE07,
                                            p.SUBCODE08,
                                            p.SUBCODE09,
                                            p.SUBCODE10,
                                            CONCAT(TRIM(p.SUBCODE02), TRIM(p.SUBCODE03)) AS ITEMNO,
                                            p.ORIGDLVSALORDLINESALORDERCODE AS PRO_ORDER,
                                            ps.PRODUCTIONORDERCODE,
                                            ps.PRODUCTIONDEMANDCODE,
                                            E.LEGALNAME1 AS LANGGANAN,
                                            TRIM(f.LONGDESCRIPTION) AS WARNA,
                                            TRIM(f.CODE) AS NO_WARNA,
                                            PRODUCT.LONGDESCRIPTION AS JENISKAIN,
                                            p.DESCRIPTION AS LOT
                                        FROM
                                            PRODUCTIONDEMAND p
                                        LEFT JOIN PRODUCT PRODUCT ON PRODUCT.ITEMTYPECODE = p.ITEMTYPEAFICODE
                                                                AND PRODUCT.SUBCODE01 = p.SUBCODE01
                                                                AND PRODUCT.SUBCODE02 = p.SUBCODE02
                                                                AND PRODUCT.SUBCODE03 = p.SUBCODE03
                                                                AND PRODUCT.SUBCODE04 = p.SUBCODE04
                                                                AND PRODUCT.SUBCODE05 = p.SUBCODE05
                                                                AND PRODUCT.SUBCODE06 = p.SUBCODE06
                                                                AND PRODUCT.SUBCODE07 = p.SUBCODE07
                                                                AND PRODUCT.SUBCODE08 = p.SUBCODE08
                                                                AND PRODUCT.SUBCODE09 = p.SUBCODE09
                                                                AND PRODUCT.SUBCODE10 = p.SUBCODE10
                                        LEFT OUTER JOIN 
                                            (
                                                SELECT
                                                    PRODUCTIONDEMANDSTEP.PRODUCTIONORDERCODE,
                                                    PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE
                                                FROM
                                                    PRODUCTIONDEMANDSTEP PRODUCTIONDEMANDSTEP
                                                GROUP BY
                                                    PRODUCTIONDEMANDSTEP.PRODUCTIONORDERCODE,
                                                    PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE
                                            ) ps ON p.CODE = ps.PRODUCTIONDEMANDCODE
                                        LEFT OUTER JOIN
                                            (
                                                SELECT
                                                    BUSINESSPARTNER.LEGALNAME1,
                                                    ORDERPARTNER.CUSTOMERSUPPLIERCODE
                                                FROM
                                                    BUSINESSPARTNER BUSINESSPARTNER
                                                LEFT JOIN ORDERPARTNER ORDERPARTNER ON
                                                    BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
                                            ) E ON p.CUSTOMERCODE = E.CUSTOMERSUPPLIERCODE
                                        LEFT OUTER JOIN USERGENERICGROUP f ON p.SUBCODE05 = f.CODE AND f.USERGENERICGROUPTYPECODE = 'CL1'
                                        LEFT OUTER JOIN PRODUCTIONDEMAND h ON p.ORIGDLVSALORDLINESALORDERCODE = h.ORIGDLVSALORDLINESALORDERCODE
                                            AND p.SUBCODE01 = h.SUBCODE01
                                            AND p.SUBCODE02 = h.SUBCODE02
                                            AND p.SUBCODE03 = h.SUBCODE03
                                            AND p.SUBCODE04 = h.SUBCODE04
                                            AND h.ITEMTYPEAFICODE = 'KFF'
                                        GROUP BY
                                            p.SUBCODE01,
                                            p.SUBCODE02,
                                            p.SUBCODE03,
                                            p.SUBCODE04,
                                            p.SUBCODE05,
                                            p.SUBCODE06,
                                            p.SUBCODE07,
                                            p.SUBCODE08,
                                            p.SUBCODE09,
                                            p.SUBCODE10,
                                            p.ORIGDLVSALORDLINESALORDERCODE,
                                            ps.PRODUCTIONORDERCODE,
                                            ps.PRODUCTIONDEMANDCODE,
                                            E.LEGALNAME1,
                                            f.LONGDESCRIPTION,
                                            f.CODE,
                                            PRODUCT.LONGDESCRIPTION,
                                            p.DESCRIPTION
                                    ) i ON i.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE
                                LEFT OUTER JOIN RESOURCES r ON r.CODE = x.OPERATORCODE
                                WHERE
                                    (x.OPERATIONCODE = 'BAT2' OR x.OPERATIONCODE = 'BKN1' OR x.OPERATIONCODE = 'BEL1' OR x.OPERATIONCODE = 'BAT3'  OR x.OPERATIONCODE = 'BBS1' OR x.OPERATIONCODE = 'JHP1' OR x.OPERATIONCODE = 'WAIT36'))
                                    AND x.PROGRESSTEMPLATECODE = 'S01'
                                    AND TIMESTAMP(TRIM(x.PROGRESSSTARTPROCESSDATE), TRIM(x.PROGRESSSTARTPROCESSTIME)) BETWEEN '$_GET[tgl1] 23:00:00' AND '$_GET[tgl2] 23:00:00'
                                GROUP BY 
                                    x.PRODUCTIONORDERCODE,
                                    x.OPERATIONCODE, 
                                    x.OPERATORCODE,
                                    x.PROGRESSSTARTPROCESSDATE, 
                                    x.PROGRESSSTARTPROCESSTIME ,
                                    x.MACHINECODE ,
                                    x.CREATIONDATETIME,
                                    r.LONGDESCRIPTION,
                                    i.SUBCODE01,
                                    i.SUBCODE02,
                                    i.SUBCODE03,
                                    i.SUBCODE04,
                                    i.SUBCODE05,
                                    i.SUBCODE06,
                                    i.SUBCODE07,
                                    i.SUBCODE08,
                                    i.SUBCODE09,
                                    i.SUBCODE10,
                                    i.ITEMNO,
                                    i.LANGGANAN,
                                    i.WARNA,
                                    i.NO_WARNA,
                                    i.JENISKAIN";
                $stmt1 = db2_exec($conn1, $sqlDB21);
            }

            $totalQtyBagiKain = 0;
            $totalRollBagiKain = 0;
            ?>
			<?php while ($rowdb21 = db2_fetch_assoc($stmt1)): ?>
			<tr>
				<td align="left" valign="top"><?= $rowdb21['LANGGANAN']; ?></td>
				<td align="left" valign="top"><?= $rowdb21['PRO_ORDER']; ?></td>
				<td align="left" valign="top" style="font-size: 10px;"><?= $rowdb21['JENISKAIN']; ?></td>
				<td align="left" valign="top"><?= $rowdb21['WARNA']; ?></td>
				<td align="left" valign="top"><?= $rowdb21['PRODUCTIONORDERCODE']; ?></td>
				<td align="left" valign="top"><?= $rowdb21['PRODUCTIONDEMANDCODE']; ?></td>
				<td align="left" valign="top"><?= $rowdb21['LOT']; ?></td>
				<td align="left" valign="top">
					<?php
                        $q_roll_tdk_gabung = db2_exec($conn1, "SELECT count(*) AS ROLL, s2.PRODUCTIONORDERCODE
                                                                        FROM STOCKTRANSACTION s2 
                                                                        WHERE  (s2.ITEMTYPECODE ='KGF' OR s2.ITEMTYPECODE = 'KFF')
                                                                        AND s2.PRODUCTIONORDERCODE = '$rowdb21[PRODUCTIONORDERCODE]'
                                                                        GROUP BY s2.PRODUCTIONORDERCODE");
                        $d_roll_tdk_gabung = db2_fetch_assoc($q_roll_tdk_gabung);
                        echo $roll = $d_roll_tdk_gabung['ROLL'];
                        $totalRollBagiKain += $d_roll_tdk_gabung['ROLL'];
                        ?>
				</td>

				<td align="center" valign="top">
					<?php
                        $sqlkg = "SELECT DISTINCT
                                                    GROUPSTEPNUMBER,
                                                    INITIALUSERPRIMARYQUANTITY AS QTY_BAGI_KAIN,
                                                    INITIALUSERSECONDARYQUANTITY AS QTY_ORDER_YARD
                                                FROM 
                                                    VIEWPRODUCTIONDEMANDSTEP 
                                                WHERE 
                                                    PRODUCTIONORDERCODE = '$rowdb21[PRODUCTIONORDERCODE]'
                                                ORDER BY
                                                    GROUPSTEPNUMBER ASC LIMIT 1";
                        $stmtkg11 = db2_exec($conn1, $sqlkg, array('cursor' => DB2_SCROLLABLE));
                        $rowkg = db2_fetch_assoc($stmtkg11);
                        echo round($rowkg['QTY_BAGI_KAIN'], 2); // BAGIKAIN RESERVATION
                        $totalQtyBagiKain += $rowkg['QTY_BAGI_KAIN'];
                        ?>
				</td>
				<td align="center" valign="top">
					<?php
                        $sqlOutTo = "SELECT
                                            p.OPERATIONCODE,
                                            p.OPSTEPGROUPCODE
                                        FROM
                                            (
                                            SELECT
                                                GROUPSTEPNUMBER,
                                                PRODUCTIONORDERCODE
                                            FROM
                                                VIEWPRODUCTIONDEMANDSTEP
                                            WHERE
                                                PRODUCTIONORDERCODE = '$rowdb21[PRODUCTIONORDERCODE]'
                                                AND (OPERATIONCODE = 'BAT2'
                                                    OR OPERATIONCODE = 'BKN1'
                                                    OR OPERATIONCODE = 'JHP1'
                                                    OR OPERATIONCODE = 'BAT2'
                                                    OR OPERATIONCODE = 'BEL1'
                                                    OR OPERATIONCODE = 'BAT3'
                                                    OR OPERATIONCODE = 'BBS1'
                                                    OR OPERATIONCODE = 'WAIT36') ) s
                                        LEFT OUTER JOIN VIEWPRODUCTIONDEMANDSTEP p ON
                                            s.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE
                                            AND s.GROUPSTEPNUMBER < p.GROUPSTEPNUMBER";
                        $stmtOutTo = db2_exec($conn1, $sqlOutTo, array('cursor' => DB2_SCROLLABLE));
                        $rowOutTo = db2_fetch_assoc($stmtOutTo);
                        ?>
					<?= $rowOutTo['OPERATIONCODE']; ?> /
					<?= $rowOutTo['OPSTEPGROUPCODE']; ?>
				</td>
				<?php
                    // QUERY DIBAWAH INI MENGIKUTI QUERY POSISI KK DI LAPORAN
                    $sqlOut = "SELECT
                                        p.PRODUCTIONORDERCODE,
                                        p.STEPNUMBER AS STEPNUMBER,
                                        CASE
                                            WHEN TRIM(p.PRODRESERVATIONLINKGROUPCODE) IS NULL OR TRIM(p.PRODRESERVATIONLINKGROUPCODE) = '' THEN TRIM(p.OPERATIONCODE)
                                            ELSE TRIM(p.PRODRESERVATIONLINKGROUPCODE)
                                        END AS OPERATIONCODE,
                                        TRIM(o.OPERATIONGROUPCODE) AS DEPT,
                                        o.LONGDESCRIPTION,
                                        CASE
                                            WHEN p.PROGRESSSTATUS = 0 THEN 'Entered'
                                            WHEN p.PROGRESSSTATUS = 1 THEN 'Planned'
                                            WHEN p.PROGRESSSTATUS = 2 THEN 'Progress'
                                            WHEN p.PROGRESSSTATUS = 3 THEN 'Closed'
                                        END AS STATUS_OPERATION,
                                        iptip.MULAI,
                                        CASE
                                            WHEN p.PROGRESSSTATUS = 3 THEN COALESCE(iptop.SELESAI, SUBSTRING(p.LASTUPDATEDATETIME, 1, 19) || '(Run Manual Closures)')
                                            ELSE iptop.SELESAI
                                        END AS SELESAI,
                                        p.PRODUCTIONORDERCODE,
                                        p.PRODUCTIONDEMANDCODE,
                                        iptip.LONGDESCRIPTION AS OP1,
                                        iptop.LONGDESCRIPTION AS OP2,
                                        CASE
                                            WHEN a.VALUEBOOLEAN = 1 THEN 'Tidak Perlu Gerobak'
                                            ELSE 
                                                CASE
                                                    WHEN LISTAGG(DISTINCT FLOOR(idqd.VALUEQUANTITY), ', ') = '1' THEN 'PLASTIK'
                                                    WHEN LISTAGG(DISTINCT FLOOR(idqd.VALUEQUANTITY), ', ') = '2' THEN 'TONG'
                                                    WHEN LISTAGG(DISTINCT FLOOR(idqd.VALUEQUANTITY), ', ') = '3' THEN 'DALAM MESIN'
                                                    ELSE LISTAGG(DISTINCT FLOOR(idqd.VALUEQUANTITY), ', ')
                                                END
                                        END AS GEROBAK,
                                        idqd.WORKCENTERCODE 
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
                                        p.PRODUCTIONORDERCODE  = '$rowdb21[PRODUCTIONORDERCODE]' AND p.OPERATIONCODE = '$rowdb21[OPERATIONCODE]'
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
                    $stmtOut = db2_exec($conn1, $sqlOut, array('cursor' => DB2_SCROLLABLE));
                    $rowOut = db2_fetch_assoc($stmtOut);
                    ?>

				<td align="left" valign="top"><?= $rowOut['OPERATIONCODE']; ?></td>

				<td align="left" valign="top"><?= $rowOut['MULAI']; ?></td>
				<td align="left" valign="top"><?= $rowOut['SELESAI']; ?></td>

				<td align="left" valign="top"><?= $rowOut['WORKCENTERCODE']; ?></td>
				<td align="left" valign="top"><?= $rowOut['GEROBAK']; ?></td>

				<td align="center" valign="top"><?= $rowOut['OP1']; ?></td>
				<td align="center" valign="top"><?= $rowOut['OP2']; ?></td>
				<td align="center" valign="top"><?= $_SESSION['nama1Gkg']; ?></td>
			</tr>
			<?php endwhile; ?>
			<tr id="tr-footer">
				<td align="center" valign="bottom" colspan="7" style="text-align: right;" valign="bottom">Total</td>
				<td align="center" valign="bottom"><?= number_format($totalRollBagiKain, 0); ?></td>
				<td align="center" valign="bottom"><?= number_format($totalQtyBagiKain, 2); ?></td>
				<td align="center" valign="center" colspan="2">KG</td>
				<td align="left" valign="bottom" colspan="7"></td>
			</tr>
		</tbody>
	</table>
	<li><strong>Keterangan : Sebelum di serahkan ke departement user leader shift memastikan telah sesuai dengan
			permintaan pada kartu kerja dan di approve leader shift pada kolom leader check</strong></li>
	<table class="table-ttd" style="width: 367mm;">
		<thead>
			<tr>
				<td></td>
				<td style="text-align: center;">Dibuat Oleh</td>
				<td style="text-align: center;"></td>
				<td style="text-align: center;">Disetujui Oleh</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="font-weight: bold; width: 25mm;">Nama</td>
				<td align="center"><input type="text" width="100%"
						style="text-align:center; text-transform: uppercase; border:none; font-size: 8pt;"
						placeholder="_ _ _ _ _ _ _ _ _ _ _ _"></td>
				<td align="center"><input type="text" width="100%"
						style="text-align:center; text-transform: uppercase; border:none; font-size: 8pt;"></td>
				<td align="center"><input type="text" width="100%"
						style="text-align:center; text-transform: uppercase; border:none; font-size: 8pt;"
						placeholder="_ _ _ _ _ _ _ _ _ _ _ _"></td>
			</tr>
			<tr>
				<td style=" font-weight: bold;">Jabatan</td>
				<td align="center">LEADER</td>
				<td align="center"><input type="text" width="100%"
						style="text-align:center; text-transform: uppercase; border:none; font-size: 8pt;"></td>
				<td align="center">Assistant SPV</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">Tanggal</td>
				<td align="center"><input type="text" width="100%" class="datepick"
						style="text-align:center; border:none; font-size: 8pt;" placeholder="____ __ __"></td>
				<td align="center"><input type="text" width="100%" class="datepick"
						style="text-align:center; border:none; font-size: 8pt;"></td>
				<td align="center"><input type="text" width="100%" class="datepick"
						style="text-align:center; border:none; font-size: 8pt;" placeholder="____ __ __"></td>
			</tr>
		</tbody>
	</table>
</body>

</html>