<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
</head>
<style>
#table_Report td.details-control {
	background: url('bower_components/datatables.net/img/details_open.png') no-repeat center center;
	cursor: pointer;
}

#table_Report tr.shown td.details-control {
	background: url('bower_components/datatables.net/img/details_close.png') no-repeat center center;
}

#table_Report tr:hover {
	background-color: rgb(151, 170, 212);
}
</style>

<body>
	<?php
    if (!empty($_POST["submit"])) {
        $date_s = $_POST["date-start"];
        $date_e = $_POST["date-end"];
        $shift = $_POST["w_shift"];
        $_SESSION['date_s'] = $_POST["date-start"];
        $_SESSION['date_e'] = $_POST["date-end"];
        $_SESSION['shift'] = $_POST["w_shift"];

        if ($_POST["w_shift"] != 'ALL') {
            if ($_POST['w_shift'] == 1) {
                $start_shift3 = $_POST["date-start"] . " 07:00:00";
                $end_shift3 = $_POST["date-end"] . " 15:00:00";
            } else if ($_POST['w_shift'] == 2) {
                $start_shift3 = $_POST["date-start"] . " 15:00:00";
                $end_shift3 = $_POST["date-end"] . " 23:00:00";
            } else if ($_POST['w_shift'] == 3) {
                $start_shift3 = $_POST["date-start"] . " 23:00:00";
                $end_shift3 = $_POST["date-end"] . " 07:00:00";
            } else if ($_POST['w_shift'] == "1 TIDAK FULL") {
                $start_shift3 = $_POST["date-start"] . " 07:00:00";
                $end_shift3 = $_POST["date-end"] . " 12:00:00";
            } else if ($_POST['w_shift'] == "2 TIDAK FULL") {
                $start_shift3 = $_POST["date-start"] . " 12:00:00";
                $end_shift3 = $_POST["date-end"] . " 15:00:00";
            } else if ($_POST['w_shift'] == "3 TIDAK FULL") {
                $start_shift3 = $_POST["date-start"] . " 15:00:00";
                $end_shift3 = $_POST["date-end"] . " 22:00:00";
            }
            $sqlDB21 = "SELECT
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
                                LISTAGG(TRIM(i.SUBCODE04), ', ') AS SUBCODE04,
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
                                i.NO_WARNA
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
                                        TRIM(f.CODE) AS NO_WARNA
                                    FROM
                                        PRODUCTIONDEMAND p
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
                                        ) ps
                                        ON
                                        p.CODE = ps.PRODUCTIONDEMANDCODE
                                    LEFT OUTER JOIN
                                            (
                                            SELECT
                                                BUSINESSPARTNER.LEGALNAME1,
                                                ORDERPARTNER.CUSTOMERSUPPLIERCODE
                                            FROM
                                                BUSINESSPARTNER BUSINESSPARTNER
                                            LEFT JOIN ORDERPARTNER ORDERPARTNER ON
                                                BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
                                        ) E
                                        ON
                                        p.CUSTOMERCODE = E.CUSTOMERSUPPLIERCODE
                                    LEFT OUTER JOIN USERGENERICGROUP f
                                            ON
                                        p.SUBCODE05 = f.CODE
                                        AND f.USERGENERICGROUPTYPECODE = 'CL1'
                                    LEFT OUTER JOIN PRODUCTIONDEMAND h
                                        ON
                                        p.ORIGDLVSALORDLINESALORDERCODE = h.ORIGDLVSALORDLINESALORDERCODE
                                        AND 
                                        p.SUBCODE01 = h.SUBCODE01
                                        AND 
                                        p.SUBCODE02 = h.SUBCODE02
                                        AND
                                        p.SUBCODE03 = h.SUBCODE03
                                        AND
                                        p.SUBCODE04 = h.SUBCODE04
                                        AND 
                                        h.ITEMTYPEAFICODE = 'KFF'
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
                                        f.CODE
                                ) i ON
                                i.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE
                            LEFT OUTER JOIN RESOURCES r ON
                                r.CODE = x.OPERATORCODE
                            WHERE
                                (
                                    x.OPERATIONCODE = 'BAT2' 
                                    OR x.OPERATIONCODE = 'BKN1' 
                                    OR x.OPERATIONCODE = 'BEL1' 
                                    OR x.OPERATIONCODE = 'BAT3' 
                                    OR x.OPERATIONCODE = 'BBS1' 
                                    OR x.OPERATIONCODE = 'JHP1' 
                                    OR x.OPERATIONCODE = 'WAIT36'
                                )
                                AND x.PROGRESSTEMPLATECODE = 'S01'
                                AND TIMESTAMP(
                                    TRIM(x.PROGRESSSTARTPROCESSDATE),
                                    TRIM(x.PROGRESSSTARTPROCESSTIME)
                                ) BETWEEN '$start_shift3' AND '$end_shift3'
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
                                i.SUBCODE05,
                                i.SUBCODE06,
                                i.SUBCODE07,
                                i.SUBCODE08,
                                i.SUBCODE09,
                                i.SUBCODE10,
                                i.ITEMNO,
                                i.WARNA,
                                i.NO_WARNA";
            $stmt1 = db2_exec($conn1, $sqlDB21, array('cursor' => DB2_SCROLLABLE));
        } else if ($_POST["w_shift"] == 'ALL') {
            $sqlDB21 = "SELECT
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
                            LISTAGG(TRIM(i.SUBCODE04), ', ') AS SUBCODE04,
                            i.SUBCODE05,
                            i.SUBCODE06,
                            i.SUBCODE07,
                            i.SUBCODE08,
                            i.SUBCODE09,
                            i.SUBCODE10,
                            i.ITEMNO,
                            LISTAGG(
                                TRIM(i.PRO_ORDER),
                                ','
                            ) PRO_ORDER,
                            LISTAGG(
                                TRIM(i.PRODUCTIONDEMANDCODE),
                                ','
                            ) PRODUCTIONDEMANDCODE,
                            i.LANGGANAN,
                            i.WARNA,
                            i.NO_WARNA
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
                                    TRIM(f.CODE) AS NO_WARNA
                                FROM
                                    PRODUCTIONDEMAND p
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
                                    ) ps
                                    ON
                                    p.CODE = ps.PRODUCTIONDEMANDCODE
                                LEFT OUTER JOIN
                                        (
                                        SELECT
                                            BUSINESSPARTNER.LEGALNAME1,
                                            ORDERPARTNER.CUSTOMERSUPPLIERCODE
                                        FROM
                                            BUSINESSPARTNER BUSINESSPARTNER
                                        LEFT JOIN ORDERPARTNER ORDERPARTNER ON
                                            BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
                                    ) E
                                    ON
                                    p.CUSTOMERCODE = E.CUSTOMERSUPPLIERCODE
                                LEFT OUTER JOIN USERGENERICGROUP f
                                        ON
                                    p.SUBCODE05 = f.CODE
                                    AND f.USERGENERICGROUPTYPECODE = 'CL1'
                                LEFT OUTER JOIN PRODUCTIONDEMAND h
                                    ON
                                    p.ORIGDLVSALORDLINESALORDERCODE = h.ORIGDLVSALORDLINESALORDERCODE
                                    AND 
                                    p.SUBCODE01 = h.SUBCODE01
                                    AND 
                                    p.SUBCODE02 = h.SUBCODE02
                                    AND
                                    p.SUBCODE03 = h.SUBCODE03
                                    AND
                                    p.SUBCODE04 = h.SUBCODE04
                                    AND 
                                    h.ITEMTYPEAFICODE = 'KFF'
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
                                    f.CODE
                            ) i ON
                            i.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE
                        LEFT OUTER JOIN RESOURCES r ON
                            r.CODE = x.OPERATORCODE
                        WHERE
                            (
                                x.OPERATIONCODE = 'BAT2' 
                                OR x.OPERATIONCODE = 'BKN1' 
                                OR x.OPERATIONCODE = 'BEL1' 
                                OR x.OPERATIONCODE = 'BAT3' 
                                OR x.OPERATIONCODE = 'BBS1' 
                                OR x.OPERATIONCODE = 'JHP1' 
                                OR x.OPERATIONCODE = 'WAIT36')
                            )
                            AND x.PROGRESSTEMPLATECODE = 'S01'
                            AND TIMESTAMP(
                                TRIM(x.PROGRESSSTARTPROCESSDATE),
                                TRIM(x.PROGRESSSTARTPROCESSTIME)
                            ) BETWEEN '$date_s 23:00:00' AND '$date_e 23:00:00'
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
                            i.SUBCODE05,
                            i.SUBCODE06,
                            i.SUBCODE07,
                            i.SUBCODE08,
                            i.SUBCODE09,
                            i.SUBCODE10,
                            i.ITEMNO,
                            i.LANGGANAN,
                            i.WARNA,
                            i.NO_WARNA";
            $stmt1 = db2_exec($conn1, $sqlDB21, array('cursor' => DB2_SCROLLABLE));
        }
    } else {
        unset($_SESSION['date_s'], $_SESSION['group'], $_SESSION['date_e'], $_SESSION['shift']);
        // $sqlDB21 = "SELECT
        //                     x.PRODUCTIONORDERCODE,
        //                     x.OPERATIONCODE, 
        //                     x.OPERATORCODE,
        //                     x.PROGRESSSTARTPROCESSDATE, 
        //                     x.PROGRESSSTARTPROCESSTIME ,
        //                     x.MACHINECODE ,
        //                     x.CREATIONDATETIME,
        //                     r.LONGDESCRIPTION,  
        //                     i.SUBCODE01,
        //                     i.SUBCODE02,
        //                     i.SUBCODE03,
        //                     i.SUBCODE04,
        //                     i.SUBCODE05,
        //                     i.SUBCODE06,
        //                     i.SUBCODE07,
        //                     i.SUBCODE08,
        //                     i.SUBCODE09,
        //                     i.SUBCODE10,
        //                     i.ITEMNO,
        //                     LISTAGG(TRIM(i.PRO_ORDER), ', ') PRO_ORDER,
        //                     LISTAGG(TRIM(i.PRODUCTIONDEMANDCODE), ', ') PRODUCTIONDEMANDCODE,
        //                     LISTAGG(i.LANGGANAN, ', ') AS LANGGANAN,
        //                     i.WARNA,
        //                     i.NO_WARNA
        //                 FROM
        //                     PRODUCTIONPROGRESS x
        //                 LEFT OUTER JOIN (
        //                         SELECT
        //                             p.SUBCODE01,
        //                             p.SUBCODE02,
        //                             p.SUBCODE03,
        //                             p.SUBCODE04,
        //                             p.SUBCODE05,
        //                             p.SUBCODE06,
        //                             p.SUBCODE07,
        //                             p.SUBCODE08,
        //                             p.SUBCODE09,
        //                             p.SUBCODE10,
        //                             CONCAT(TRIM(p.SUBCODE02), TRIM(p.SUBCODE03)) AS ITEMNO,
        //                             p.ORIGDLVSALORDLINESALORDERCODE AS PRO_ORDER,
        //                             ps.PRODUCTIONORDERCODE,
        //                             ps.PRODUCTIONDEMANDCODE,
        //                             E.LEGALNAME1 AS LANGGANAN,
        //                             TRIM(f.LONGDESCRIPTION) AS WARNA,
        //                             TRIM(f.CODE) AS NO_WARNA
        //                         FROM
        //                             PRODUCTIONDEMAND p
        //                         LEFT OUTER JOIN 
        //                                 (
        //                                 SELECT
        //                                     PRODUCTIONDEMANDSTEP.PRODUCTIONORDERCODE,
        //                                     PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE
        //                                 FROM
        //                                     PRODUCTIONDEMANDSTEP PRODUCTIONDEMANDSTEP
        //                                 GROUP BY
        //                                     PRODUCTIONDEMANDSTEP.PRODUCTIONORDERCODE,
        //                                     PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE
        //                             ) ps
        //                             ON
        //                             p.CODE = ps.PRODUCTIONDEMANDCODE
        //                         LEFT OUTER JOIN
        //                                 (
        //                                 SELECT
        //                                     BUSINESSPARTNER.LEGALNAME1,
        //                                     ORDERPARTNER.CUSTOMERSUPPLIERCODE
        //                                 FROM
        //                                     BUSINESSPARTNER BUSINESSPARTNER
        //                                 LEFT JOIN ORDERPARTNER ORDERPARTNER ON
        //                                     BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
        //                             ) E
        //                             ON
        //                             p.CUSTOMERCODE = E.CUSTOMERSUPPLIERCODE
        //                         LEFT OUTER JOIN USERGENERICGROUP f
        //                                 ON
        //                             p.SUBCODE05 = f.CODE
        //                             AND f.USERGENERICGROUPTYPECODE = 'CL1'
        //                         LEFT OUTER JOIN PRODUCTIONDEMAND h
        //                             ON
        //                             p.ORIGDLVSALORDLINESALORDERCODE = h.ORIGDLVSALORDLINESALORDERCODE
        //                             AND 
        //                             p.SUBCODE01 = h.SUBCODE01
        //                             AND 
        //                             p.SUBCODE02 = h.SUBCODE02
        //                             AND
        //                             p.SUBCODE03 = h.SUBCODE03
        //                             AND
        //                             p.SUBCODE04 = h.SUBCODE04
        //                             AND 
        //                             h.ITEMTYPEAFICODE = 'KFF'
        //                         GROUP BY
        //                             p.SUBCODE01,
        //                             p.SUBCODE02,
        //                             p.SUBCODE03,
        //                             p.SUBCODE04,
        //                             p.SUBCODE05,
        //                             p.SUBCODE06,
        //                             p.SUBCODE07,
        //                             p.SUBCODE08,
        //                             p.SUBCODE09,
        //                             p.SUBCODE10,
        //                             p.ORIGDLVSALORDLINESALORDERCODE,
        //                             ps.PRODUCTIONORDERCODE,
        //                             ps.PRODUCTIONDEMANDCODE,
        //                             E.LEGALNAME1,
        //                             f.LONGDESCRIPTION,
        //                             f.CODE
        //                     ) i ON
        //                     i.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE
        //                 LEFT OUTER JOIN RESOURCES r ON
        //                     r.CODE = x.OPERATORCODE
        //                 WHERE
        //                     (
        //                         x.OPERATIONCODE = 'BAT2'
        //                             OR x.OPERATIONCODE = 'BKN1'
        //                     )
        //                     AND x.PROGRESSTEMPLATECODE = 'S01'
        //                     AND x.PROGRESSSTARTPROCESSDATE = CURRENT DATE
        //                     AND x.PRODUCTIONORDERCODE = '00155518'
        //                 GROUP BY 
        //                     x.PRODUCTIONORDERCODE,
        //                     x.OPERATIONCODE, 
        //                     x.OPERATORCODE,
        //                     x.PROGRESSSTARTPROCESSDATE, 
        //                     x.PROGRESSSTARTPROCESSTIME ,
        //                     x.MACHINECODE ,
        //                     x.CREATIONDATETIME,
        //                     r.LONGDESCRIPTION,
        //                     i.SUBCODE01,
        //                     i.SUBCODE02,
        //                     i.SUBCODE03,
        //                     i.SUBCODE04,
        //                     i.SUBCODE05,
        //                     i.SUBCODE06,
        //                     i.SUBCODE07,
        //                     i.SUBCODE08,
        //                     i.SUBCODE09,
        //                     i.SUBCODE10,
        //                     i.ITEMNO,
        //                     i.WARNA,
        //                     i.NO_WARNA";
    
        // $stmt1   = db2_exec($conn1, $sqlDB21, array('cursor' => DB2_SCROLLABLE));
    }
    $no = 1;
    $n = 1;
    $c = 0;
    ?>
	<?php ini_set("error_reporting", 0); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="container col-sm-10">
						<div class="form-group row">
							<form action="" method="post">
								<div class="col-sm-2">
									<div class="input-group date">
										<div class=" input-group-addon"> <i class="fa fa-calendar"></i> </div>
										<input required class="form-control input-sm" type="text" value="<?php
                                        if (empty($date_s)) {
                                            echo date('Y-m-d');
                                        } else {
                                            echo $date_s;
                                        }
                                        ?>" id="datepicker" autocomplete="off" name="date-start" />
									</div>
								</div>
								<div class="col-sm-1">
									<button disabled
										class="disable btn btn-outline-danger"><strong>S/D</strong></button>
								</div>
								<div class="col-sm-2">
									<div class="input-group date">
										<div class=" input-group-addon"> <i class="fa fa-calendar"></i> </div>
										<input required class="form-control input-sm" value="<?php
                                        if (empty($date_e)) {
                                            echo date('Y-m-d');
                                        } else {
                                            echo $date_e;
                                        }
                                        ?>" type="text" id="datepicker2" autocomplete="off" name="date-end" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-2">
										<select name="w_shift" class="form-control input-sm" required>
											<option <?php if ($shift == "ALL")
                                                echo "selected"; ?> value="ALL">ALL SHIFT
											</option>
											<option <?php if ($shift == "1")
                                                echo "selected"; ?> value="1">1</option>
											<option <?php if ($shift == "2")
                                                echo "selected"; ?> value="2">2</option>
											<option <?php if ($shift == "3")
                                                echo "selected"; ?> value="3">3</option>
											<option <?php if ($shift == "1 TIDAK FULL")
                                                echo "selected"; ?> value="1 TIDAK FULL">1 TIDAK FULL</option>
											<option <?php if ($shift == "2 TIDAK FULL")
                                                echo "selected"; ?> value="2 TIDAK FULL">2 TIDAK FULL</option>
											<option <?php if ($shift == "3 TIDAK FULL")
                                                echo "selected"; ?> value="3 TIDAK FULL">3 TIDAK FULL</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-2">
										<button type="submit" name="submit" value="submit"
											class="btn btn-success btn-block">Generate</button>
									</div>
								</div>
								<div>
									<a href="pages/cetak/cetak_pemakaian_bahanbaku.php?tgl1=<?= $_POST['date-start'] ?>&tgl2=<?= $_POST['date-end'] ?>&shift=<?= $_POST['w_shift'] ?>"
										target="_blank" class="btn btn-danger pull-right" target="_blank"><i
											class="fa fa-print"></i> Cetak</a>
								</div>
							</form>
						</div>
					</div>
					<!--
                        <div>
                            <a href="<?php if (!empty($_POST['submit'])) {
                                echo 'pages/cetak/cetak_schedule_bydate.php';
                            } else {
                                echo 'pages/cetak/cetak_schedule.php';
                            } ?>" class="btn btn-danger pull-right" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                        </div>
                    -->
				</div>
                <?php if (!empty($_POST["submit"])) : ?>
                    <div class="box-body">
                        <table id="table_Report" class="table table-bordered table-hover table-striped display compact"
                            width="100%">
                            <thead class="bg-blue">
                                <tr>
                                    <th width="10">
                                        #
                                    </th>
                                    <th width="5">
                                        hidden number
                                    </th>
                                    <th width="162">
                                        <div align="center">Mesin / Operation</div>
                                    </th>
                                    <th width="162">
                                        <div align="center">Pelanggan</div>
                                    </th>
                                    <th width="118">
                                        <div align="center">No. Order</div>
                                    </th>
                                    <th width="122">
                                        <div align="center">Item</div>
                                    </th>
                                    <th width="86">
                                        <div align="center">Warna</div>
                                    </th>
                                    <th width="46">
                                        <div align="center">Rol</div>
                                    </th>
                                    <th width="48">
                                        <div align="center">Kg</div>
                                    </th>
                                    <th width="38">
                                        <div align="center">Prod. Demand</div>
                                    </th>
                                    <th>
                                        <div align="center">Delivery</div>
                                    </th>
                                    <th width="79">
                                        <div align="center">Prod. Order</div>
                                    </th>
                                    <th class="12">gerobak 1</th>
                                    <th class="13">out gerobak 1</th>
                                    <th class="14">gerobak 2</th>
                                    <th class="15">out gerobak 2</th>
                                    <th class="16">gerobak 3</th>
                                    <th class="17">out gerobak 3</th>
                                    <th class="18">gerobak 4</th>
                                    <th class="19">out gerobak 4</th>
                                    <th class="20">gerobak 5</th>
                                    <th class="21">out gerobak 5</th>
                                    <th class="22">gerobak 6</th>
                                    <th class="23">out gerobak 6</th>
                                    <th class="24">id</th>
                                    <th class="25">create_time</th>
                                    <th class="26">tgl_mulai</th>
                                    <th class="27">tgl_update</th>
                                    <th class="28">tgl_stop</th>
                                    <th class="29">approve_time</th>
                                    <th class="30">petugas_buka</th>
                                    <th class="31">approve_by</th>
                                    <th class="32">create_by</th>
                                    <th class="33">selesai_by</th>
                                    <th class="34">Procs/To</th>
                                    <th class="35">PIC</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $col = 0;
                                $no = 1;
                                while ($rowdb21 = db2_fetch_assoc($stmt1)) {
                                    $bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
                                    $sqlroll = "SELECT
                                                    STOCKTRANSACTION.ORDERCODE,
                                                    COUNT(STOCKTRANSACTION.ITEMELEMENTCODE) AS JML_ROLL
                                                FROM
                                                    STOCKTRANSACTION STOCKTRANSACTION
                                                WHERE
                                                    STOCKTRANSACTION.ORDERCODE = '" . $rowdb21['PRODUCTIONORDERCODE'] . "'
                                                    AND STOCKTRANSACTION.TEMPLATECODE = '120'
                                                    AND STOCKTRANSACTION.ITEMTYPECODE = 'KGF'
                                                GROUP BY
                                                    STOCKTRANSACTION.ORDERCODE";
                                    $stmt11 = db2_exec($conn1, $sqlroll, array('cursor' => DB2_SCROLLABLE));

                                    $rowr = db2_fetch_assoc($stmt11);

                                    $sqlroll1 = "SELECT
                                                    SUM(USERPRIMARYQUANTITY) AS KG,
                                                    COUNT(ITEMELEMENTCODE) AS ROLL
                                                FROM
                                                    DB2ADMIN.STOCKTRANSACTION x
                                                WHERE
                                                    ORDERCODE = '" . $rowdb21['PRODUCTIONORDERCODE'] . "'
                                                    AND (ITEMTYPECODE = 'KFF' OR ITEMTYPECODE = 'FKG')";
                                    $stmt111 = db2_exec($conn1, $sqlroll1, array('cursor' => DB2_SCROLLABLE));
                                    $rowr1 = db2_fetch_assoc($stmt111);

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

                                    $sqlds = "SELECT
                                                PRODUCTIONRESERVATION.PRODUCTIONORDERCODE,
                                                LISTAGG(
                                                    TRIM(PRODUCTIONRESERVATION.ORDERCODE),
                                                    ','
                                                ) ORDERCODE,
                                                SALESORDERDELIVERY.DELIVERYDATE,
                                                PRODUCTIONRESERVATION.ITEMTYPEAFICODE
                                            FROM
                                                PRODUCTIONRESERVATION
                                            LEFT OUTER JOIN PRODUCTIONDEMAND ON
                                                PRODUCTIONRESERVATION.ORDERCODE = PRODUCTIONDEMAND.CODE
                                            LEFT JOIN SALESORDERDELIVERY SALESORDERDELIVERY ON
                                                SALESORDERDELIVERY.SALESORDERLINESALESORDERCODE = PRODUCTIONDEMAND.DLVSALORDERLINESALESORDERCODE
                                                AND SALESORDERDELIVERY.SALESORDERLINEORDERLINE = PRODUCTIONDEMAND.DLVSALESORDERLINEORDERLINE
                                            WHERE
                                                PRODUCTIONRESERVATION.ITEMTYPEAFICODE = 'KGF'
                                                AND PRODUCTIONRESERVATION.PRODUCTIONORDERCODE = '$rowdb21[PRODUCTIONORDERCODE]'
                                                AND PRODUCTIONRESERVATION.ORDERCODE IN ('" . implode("', '", explode(', ', $rowdb21['PRODUCTIONDEMANDCODE'])) . "'
                                                )
                                            GROUP BY
                                                PRODUCTIONRESERVATION.PRODUCTIONORDERCODE,
                                                SALESORDERDELIVERY.DELIVERYDATE,
                                                PRODUCTIONRESERVATION.ITEMTYPEAFICODE";
                                    $stmtkg11ds = db2_exec($conn1, $sqlds, array('cursor' => DB2_SCROLLABLE));
                                    $rowds = db2_fetch_assoc($stmtkg11ds);

                                    $sqlOut = "SELECT
                                                p2.PROGRESSTEMPLATECODE,
                                                p2.PROGRESSENDDATE,
                                                p2.PROGRESSENDTIME,
                                                p2.MACHINECODE,
                                                r.LONGDESCRIPTION
                                            FROM
                                            PRODUCTIONPROGRESS p2 
                                            LEFT JOIN RESOURCES r ON
                                                r.CODE = p2.OPERATORCODE
                                            WHERE
                                                p2.INACTIVE = 1
                                                AND p2.PROGRESSTEMPLATECODE = 'E01'
                                                AND p2.OPERATIONCODE = '$rowdb21[OPERATIONCODE]'
                                                AND p2.PRODUCTIONORDERCODE  = '$rowdb21[PRODUCTIONORDERCODE]'";
                                    $stmtOut = db2_exec($conn1, $sqlOut, array('cursor' => DB2_SCROLLABLE));
                                    $rowOut = db2_fetch_assoc($stmtOut);

                                    $sqlOutTo = "SELECT
                                                    p.OPERATIONCODE,
                                                    p.STEPNUMBER,
                                                    p.OPSTEPGROUPCODE
                                                FROM
                                                    (
                                                    SELECT
                                                        STEPNUMBER,
                                                        PRODUCTIONORDERCODE
                                                    FROM
                                                        PRODUCTIONDEMANDSTEP
                                                    WHERE
                                                        PRODUCTIONORDERCODE = '$rowdb21[PRODUCTIONORDERCODE]'
                                                        AND (OPERATIONCODE = 'BAT2'
                                                            OR OPERATIONCODE = 'BKN1'
                                                            OR OPERATIONCODE = 'JHP1'
                                                            OR OPERATIONCODE = 'BAT2'
                                                            OR OPERATIONCODE = 'BEL1'
                                                            OR OPERATIONCODE = 'BAT3'
                                                            OR OPERATIONCODE = 'BBS1'
                                                            OR OPERATIONCODE = 'WAIT36') ORDER BY STEPNUMBER DESC LIMIT 1 ) s
                                                LEFT OUTER JOIN PRODUCTIONDEMANDSTEP p ON p.PRODUCTIONORDERCODE = s.PRODUCTIONORDERCODE
                                                                                        AND p.STEPNUMBER > s.STEPNUMBER
                                                ORDER BY
                                                    p.STEPNUMBER ASC";
                                    $stmtOutTo = db2_exec($conn1, $sqlOutTo, array('cursor' => DB2_SCROLLABLE));
                                    $rowOutTo = db2_fetch_assoc($stmtOutTo);

                                    $sqlGerobak = "SELECT
                                                        LISTAGG(a.VALUEQUANTITY, ', ') AS NO_GEROBAK,
                                                        LISTAGG(TRIM(a.CHARACTERISTICCODE), ', ') AS KODE,
                                                        LISTAGG(TRIM(a.LASTUPDATEDATETIME), ', ') AS TGL
                                                    FROM
                                                        (
                                                            SELECT
                                                                a.CHARACTERISTICCODE,
                                                                a.VALUEQUANTITY,
                                                                b.LASTUPDATEDATETIME
                                                            FROM
                                                                ITXVIEW_DETAIL_QA_DATA a
                                                            LEFT OUTER JOIN QUALITYDOCLINE b ON
                                                                a.QUALITYDOCUMENTHEADERNUMBERID = b.QUALITYDOCUMENTHEADERNUMBERID
                                                                AND a.QUALITYDOCUMENTHEADERLINE = b.QUALITYDOCUMENTHEADERLINE
                                                                AND a.CHARACTERISTICCODE = b.CHARACTERISTICCODE
                                                                AND a.PRODUCTIONORDERCODE = b.QUALITYDOCPRODUCTIONORDERCODE
                                                            WHERE
                                                                a.PRODUCTIONORDERCODE = '" . $rowdb21[' PRODUCTIONORDERCODE'] . "'
                                                                AND (
                                                                    a.CHARACTERISTICCODE = 'GRB1'
                                                                        OR a.CHARACTERISTICCODE = 'GRB2'
                                                                        OR a.CHARACTERISTICCODE = 'GRB3'
                                                                        OR a.CHARACTERISTICCODE = 'GRB4'
                                                                        OR a.CHARACTERISTICCODE = 'GRB5'
                                                                        OR a.CHARACTERISTICCODE = 'GRB6'
                                                                )
                                                                AND NOT (
                                                                    a.VALUEQUANTITY = '9'
                                                                        OR a.VALUEQUANTITY = '999'
                                                                        OR a.VALUEQUANTITY = '1'
                                                                        OR a.VALUEQUANTITY = '9999'
                                                                        OR a.VALUEQUANTITY = '99999'
                                                                        OR a.VALUEQUANTITY = '99'
                                                                )
                                                                AND (
                                                                    a.OPERATIONCODE = 'BAT2'
                                                                        OR a.OPERATIONCODE = 'BKN1'
                                                                        OR a.OPERATIONCODE = 'JHP1'
                                                                )
                                                            GROUP BY
                                                                a.CHARACTERISTICCODE,
                                                                a.VALUEQUANTITY,
                                                                b.LASTUPDATEDATETIME
                                                            ORDER BY
                                                                a.CHARACTERISTICCODE
                                                        ) a";
                                    $stmtGerobak = db2_exec($conn1, $sqlGerobak, array('cursor' => DB2_SCROLLABLE));
                                    $rowG = db2_fetch_assoc($stmtGerobak);

                                    $Ngrk = $rowG['NO_GEROBAK'];
                                    $arr = explode(",", $Ngrk);
                                    $Ngrk1 = $rowG['TGL'];
                                    $arr1 = explode(",", $Ngrk1);
                                    ?>
                                <tr bgcolor="<?php echo $bgcolor; ?>">
                                    <td class="details-control"></td>
                                    <td align="center">&nbsp;</td>
                                    <td><?php echo $rowdb21['MACHINECODE']; ?> / <?php echo $rowdb21['OPERATIONCODE']; ?>
                                    </td>
                                    <td><?php echo $rowdb21['LANGGANAN']; ?></td>
                                    <td align="center"><?php echo $rowdb21['PRO_ORDER']; ?></td>
                                    <td><?php echo $rowdb21['ITEMNO']; ?></td>
                                    <td align="center"><?php echo $rowdb21['WARNA']; ?></td>
                                    <td align="center" title="ngambil dari color remarks di salesorderline, harusnya isiannya itu terakhir nomor roll. Contoh (10 ROLLS)">
                                        <?php
                                            if(substr($rowdb21['PRO_ORDER'], 0, 3) == 'CWD'){
                                                $q_roll_jasa        = db2_exec($conn1, "SELECT
                                                                                            s.ABSUNIQUEID 
                                                                                        FROM
                                                                                            PRODUCTIONDEMAND p 
                                                                                        LEFT JOIN SALESORDERLINE s ON s.SALESORDERCODE = p.ORIGDLVSALORDLINESALORDERCODE 
                                                                                                                    AND s.ORDERLINE = p.ORIGDLVSALORDERLINEORDERLINE 
                                                                                        WHERE
                                                                                            p.CODE = '$rowdb21[PRODUCTIONDEMANDCODE]'");
                                                $data_roll_jasa     = db2_fetch_assoc($q_roll_jasa);
                                                
                                                $q_roll_jasa2        = db2_exec($conn1, "SELECT
                                                                                                UNIQUEID,
                                                                                                SUBSTR(ROLL, 1,2) AS ROLL
                                                                                            FROM (SELECT
                                                                                                    UNIQUEID,
                                                                                                    CASE 
                                                                                                        WHEN LOCATE('(', VALUESTRING) > 0 AND LOCATE(')', VALUESTRING) > 0 THEN
                                                                                                            SUBSTRING(VALUESTRING, LOCATE('(', VALUESTRING) + 1, LOCATE(')', VALUESTRING) - LOCATE('(', VALUESTRING) - 1)
                                                                                                    END AS ROLL
                                                                                                FROM
                                                                                                    ADSTORAGE
                                                                                                WHERE
                                                                                                    NAMENAME = 'ColorRemarks'
                                                                                                    AND VALUESTRING LIKE '%ROLL%'
                                                                                                    AND UNIQUEID = '$data_roll_jasa[ABSUNIQUEID]'
                                                                                                    AND NOT CASE 
                                                                                                        WHEN LOCATE('(', VALUESTRING) > 0 AND LOCATE(')', VALUESTRING) > 0 THEN
                                                                                                            SUBSTRING(VALUESTRING, LOCATE('(', VALUESTRING) + 1, LOCATE(')', VALUESTRING) - LOCATE('(', VALUESTRING) - 1)
                                                                                                    END IS NULL)");
                                                $data_roll_jasa2     = db2_fetch_assoc($q_roll_jasa2);

                                                echo $data_roll_jasa2['ROLL'];
                                            }else{
                                                if ($rowr['JML_ROLL'] == "") {
                                                    echo $rowr1['ROLL'];
                                                } else {
                                                    echo $rowr['JML_ROLL'];
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td align="right">
                                        <?php
                                            // if (round($rowkg['QTY_BAGI_KAIN'], 2) > 0) {
                                            echo round($rowkg['QTY_BAGI_KAIN'], 2); // BAGIKAIN RESERVATION
                                            // } else {
                                            //     echo round($rowr1['KG'], 2); // STOCKTRANSACTION
                                            // } 
                                            ?>
                                    </td>
                                    <td align="center">
                                        <?php echo $rowdb21['PRODUCTIONDEMANDCODE']; ?>
                                    </td>
                                    <td align="center" width="20"><?php echo $rowds['DELIVERYDATE']; ?></td>
                                    <td><?php echo $rowdb21['PRODUCTIONORDERCODE']; ?></td>
                                    <td class="12">
                                        <?php
                                            if (intval($arr['0']) > 0) {
                                                echo intval($arr['0']);
                                            }
                                            ?>
                                    </td>
                                    <td class="13">
                                        <span class="12">
                                            <?php
                                                if ($arr1['0'] != "") {
                                                    echo $arr1['0'];
                                                }
                                                ?>
                                        </span>
                                    </td>
                                    <td class="14">
                                        <?php
                                            if (intval($arr['1']) > 0) {
                                                echo intval($arr['1']);
                                            }
                                            ?>
                                    </td>
                                    <td class="15">
                                        <span class="12">
                                            <?php
                                                if ($arr1['1'] != "") {
                                                    echo $arr1['1'];
                                                }
                                                ?>
                                        </span>
                                    </td>
                                    <td class="16">
                                        <?php if (intval($arr['2']) > 0) {
                                                echo intval($arr['2']);
                                            }
                                            ?>
                                    </td>
                                    <td class="17"><span class="12">
                                            <?php if ($arr1['2'] != "") {
                                                    echo $arr1['2'];
                                                } ?>
                                        </span></td>
                                    <td class="18"><?php if (intval($arr['3']) > 0) {
                                            echo intval($arr['3']);
                                        } ?></td>
                                    <td class="19"><span class="12">
                                            <?php if ($arr1['3'] != "") {
                                                    echo $arr1['3'];
                                                } ?>
                                        </span></td>
                                    <td class="20"><?php if (intval($arr['4']) > 0) {
                                            echo intval($arr['4']);
                                        } ?></td>
                                    <td class="21"><span class="12">
                                            <?php if ($arr1['4'] != "") {
                                                    echo $arr1['4'];
                                                } ?>
                                        </span></td>
                                    <td class="22"><?php if (intval($arr['5']) > 0) {
                                            echo intval($arr['5']);
                                        } ?></td>
                                    <td class="23"><span class="12">
                                            <?php if ($arr1['5'] != "") {
                                                    echo $arr1['5'];
                                                } ?>
                                        </span></td>
                                    <td class="24">&nbsp;</td>
                                    <td class="25">
                                        <?php echo $rowdb21['PROGRESSSTARTPROCESSDATE'] . " " . $rowdb21['PROGRESSSTARTPROCESSTIME']; ?>
                                    </td>
                                    <td class="26">
                                        <?php echo $rowdb21['PROGRESSSTARTPROCESSDATE'] . " " . $rowdb21['PROGRESSSTARTPROCESSTIME']; ?>
                                    </td>
                                    <td class="27">&nbsp;</td>
                                    <td class="28">
                                        <?php echo $rowOut['PROGRESSENDDATE'] . " " . $rowOut['PROGRESSENDTIME']; ?>
                                    </td>
                                    <td class="29">
                                        <?php echo $rowOut['PROGRESSENDDATE'] . " " . $rowOut['PROGRESSENDTIME']; ?>
                                    </td>
                                    <th class="30"><?php echo $rowdb21['LONGDESCRIPTION']; ?></th>
                                    <th class="31"><?php echo $rowOut['LONGDESCRIPTION']; ?></th>
                                    <th class="32"><?php echo $rowdb21['LONGDESCRIPTION']; ?></th>
                                    <th class="33"><?php echo $rowOut['LONGDESCRIPTION']; ?></th>
                                    <td class="34">
                                        <span class="badge badge-dark"><?php echo $rowOutTo['OPERATIONCODE']; ?></span> /
                                        <span class="label label-info"><?php echo $rowOutTo['OPSTEPGROUPCODE']; ?></span>
                                    </td>
                                    <td class="35"><?php echo $rowdb21['LONGDESCRIPTION']; ?></td>
                                </tr>
                                <?php
                                    $no++;
                                } ?>
                        </table>
                    </div>
                <?php endif; ?>
			</div>
		</div>
	</div>
</body>

</html>
<script type="text/javascript">
$(document).ready(function() {
	var table = $('#table_Report').DataTable({
		responsive: true,
		dom: 'Bfrtip',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
		],
		"columnDefs": [{
				"className": "align-center",
				"targets": [0]
			},
			{
				"targets": [1, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,
					29, 30, 31, 32, 33
				],
				"visible": false
			},
			{
				"targets": [0, 1, 2],
				"orderable": false
			}
		]
	});

	$('#table_Report tbody').on('click', 'td.details-control', function() {
		var tr = $(this).parents('tr');
		var row = table.row(tr);

		if (row.child.isShown()) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		} else {
			// Open this row (the format() function would return the data to be shown)
			row.child(format(row.data())).show();
			tr.addClass('shown');
		}
	});

	$('#table_Report tbody').on('click', 'tr', function() {
		$(this).toggleClass('selected');
	});

	function format(d) {
		return '<div class="col-md-12" style="background: #97aad4;">' +
			'<div class="container-fluid">' +
			'<table class="table table-bordered table-striped" width="100%">' +
			'<thead>' +
			'<tr style="background-color: blueviolet; border: 1px solid black;">' +
			'<th class="text-center" style="color: white; border: 1px solid black;">Waktu Buat / Oleh</th>' +
			'<th class="text-center" style="color: white; border: 1px solid black;">Waktu Mulai / Oleh</th>' +
			'<th class="text-center" style="color: white; border: 1px solid black;">Waktu Selesai / Oleh</th>' +
			'<th class="text-center" style="color: white; border: 1px solid black;">Waktu Approve / Oleh</th>' +
			'<th class="text-center" style="color: white; border: 1px solid black;">Delivery KK</th>' +
			'</tr>' +
			'</thead>' +
			'<tbody>' +
			'<tr style="border: 1px solid black;">' +
			'<td style="border: 1px solid black;">' + d[25] + ' / ' + d[32] + '</td>' +
			'<td style="border: 1px solid black;">' + d[26] + ' / ' + d[30] + '</td>' +
			'<td style="border: 1px solid black;">' + d[28] + ' / ' + d[33] + '</td>' +
			'<td style="border: 1px solid black;">' + d[29] + ' / ' + d[31] + '</td>' +
			'<td style="border: 1px solid black;">' + d[10] + '</td>' +
			'</tr>' +
			'</tbody>' +
			'</table>' +
			'<hr class="divider">' +

			// 
			'<table class="table table-sm table-striped table-bordered" id="tablee" width="100%" style="margin-top: 10px;">' +
			'<tbody>' +
			// 1
			'<tr style="border: 1px solid black;">' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 1 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[12] + '</td>' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 1 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[13] + '</td>' +
			'<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk.php?id=' +
			d[24] +
			'" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 1</a></td>' +
			'</tr>' +
			// 2
			'<tr style="border: 1px solid black;">' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 2 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[14] + '</td>' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 2 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[15] + '</td>' +
			'<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk2.php?id=' +
			d[24] +
			'" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 2</a></td>' +
			'</tr>' +
			// 3
			'<tr style="border: 1px solid black;">' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 3 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[16] + '</td>' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 3 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[17] + '</td>' +
			'<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk3.php?id=' +
			d[24] +
			'" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 3</a></td>' +
			'</tr>' +
			// 4
			'<tr style="border: 1px solid black;">' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 4 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[18] + '</td>' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 4 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[19] + '</td>' +
			'<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk4.php?id=' +
			d[24] +
			'" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 4</a></td>' +
			'</tr>' +
			// 5
			'<tr style="border: 1px solid black;">' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 5 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[20] + '</td>' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 5 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[21] + '</td>' +
			'<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk5.php?id=' +
			d[24] +
			'" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 5</a></td>' +
			'</tr>' +
			// 6
			'<tr style="border: 1px solid black;">' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 6 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[22] + '</td>' +
			'<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 6 :</th>' +
			'<td align="center" style="border: 1px solid black;">' + d[23] + '</td>' +
			'<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk6.php?id=' +
			d[24] +
			'" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 6</a></td>' +
			'</tr>' +
			// end here
			'</tbody>' +
			'</table>' +
			'</div>' +
			'</div>';
	}
});
</script>