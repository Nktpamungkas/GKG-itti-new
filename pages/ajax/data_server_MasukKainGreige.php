<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$sql_get = mysqli_query($con, "SELECT * from tbl_laporanharian where date_laporan = '$_POST[tgl_laporan]'");
$get = mysqli_fetch_array($sql_get);


$tgl_laporan = '';
$qty_masuk = 0;
$qty_keluar = 0;
$totB1 = 0;
$totB2 = 0;
$totB3 = 0;
$totBk1 = 0;
$totBk2 = 0;
$totBk3 = 0;
$totW36 = 0;
$totBEL1 = 0;
$totalMasukKain = 0;
$BKN1 = 0;
$BAT2 = 0;
$BAT3 = 0;
$WAIT36 = 0;
$JHP1 = 0;
$total1 = 0;
$total2 = 0;
$total3 = 0;

// Cekform telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tgl_laporan = isset($_POST['tgl_laporan']) ? $_POST['tgl_laporan'] : '';
    if ($tgl_laporan) {
        // Format untuk MySQL
        $formatted_date = date('Y-m-d H:i:s', strtotime($tgl_laporan));
        // Gunakan $formatted_date dalam query Anda
        error_log("Formatted Date: " . htmlspecialchars($formatted_date));
    }
    error_log("Tanggal Laporan: " . htmlspecialchars($tgl_laporan));

    // Mengambil data masuk kain greige
    $sqlDB2 = "SELECT
                    STOCKTRANSACTION.TRANSACTIONDATE,
                    SUM(STOCKTRANSACTION.WEIGHTNET) AS QTY_MASUK
                FROM
                    STOCKTRANSACTION
                WHERE
                    (STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG')
                    AND STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021'
                    AND STOCKTRANSACTION.TRANSACTIONDATE ='$tgl_laporan'
                GROUP BY
                    STOCKTRANSACTION.TRANSACTIONDATE";
    $stmt0 = db2_exec($conn1, $sqlDB2);
    $rowdb2 = db2_fetch_assoc($stmt0);


    $sqlDB = "SELECT
                    STOCKTRANSACTION.TRANSACTIONDATE,
                    SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY_MASUK
                FROM
                    STOCKTRANSACTION
                WHERE
                    (STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG')
                    AND STOCKTRANSACTION.TEMPLATECODE  ='OPN'
                    AND STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021'
                    AND STOCKTRANSACTION.TRANSACTIONDATE ='$tgl_laporan'
                    GROUP BY
                    STOCKTRANSACTION.TRANSACTIONDATE";
    $stmt10 = db2_exec($conn1, $sqlDB);
    $rowdb = db2_fetch_assoc($stmt10);


    // Mengambil data keluar kain greige
    $sqlKKG = "SELECT
                    STOCKTRANSACTION.TRANSACTIONDATE,
                    SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY_KELUAR
                FROM
                    STOCKTRANSACTION
                WHERE
                    (STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG')
                    AND STOCKTRANSACTION.TEMPLATECODE ='120'
                    AND STOCKTRANSACTION.TRANSACTIONDATE='$tgl_laporan'
                    AND STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021'
                    AND STOCKTRANSACTION.ONHANDUPDATE > 1
                GROUP BY
                    STOCKTRANSACTION.TRANSACTIONDATE";
    $stmt2 = db2_exec($conn1, $sqlKKG);
    $rowKKG = db2_fetch_assoc($stmt2);


    // Menentukan waktu shift berdasarkan input 'fulls'
    if (isset($_POST['fulls']) && $_POST['fulls'] == "ya") {
        $start_shift1 = $tgl_laporan . ' 07:00:00';
        $end_shift1 = $tgl_laporan . ' 15:00:00';
        $start_shift2 = $tgl_laporan . ' 15:00:00';
        $end_shift2 = $tgl_laporan . ' 23:00:00';
        $start_shift3 = $tgl_laporan . ' 23:00:00';
        $end_shift3 = date('Y-m-d H:i:s', strtotime($tgl_laporan . ' +1 day' . ' 07:00:00'));
    } else {
        $start_shift1 = $tgl_laporan . ' 07:00:00';
        $end_shift1 = $tgl_laporan . ' 12:00:00';
        $start_shift2 = $tgl_laporan . ' 12:00:00';
        $end_shift2 = $tgl_laporan . ' 17:00:00';
        $start_shift3 = $tgl_laporan . ' 17:00:00';
        $end_shift3 = $tgl_laporan . ' 22:00:00';
    }

    // Mengambil data shift 1
        // BUKA KAIN
        $sql_s1 = "SELECT
                        SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
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
                    LEFT OUTER JOIN (
                        SELECT 
                            PRODUCTIONORDERCODE, 
                            SUM(INITIALUSERPRIMARYQUANTITY) AS QTY_BAGI_KAIN,
                            OPERATIONCODE
                        FROM 
                            VIEWPRODUCTIONDEMANDSTEP 
                        GROUP BY 
                            PRODUCTIONORDERCODE,
                            OPERATIONCODE --Perlu di grup berdasarkan operation karena ada sum
                    ) v ON v.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE 
                    AND v.OPERATIONCODE = x.OPERATIONCODE
                    WHERE
                        (
                            x.OPERATIONCODE = 'BAT2' 
                            OR x.OPERATIONCODE = 'BKN1' 
                    --        OR x.OPERATIONCODE = 'BEL1' 
                            OR x.OPERATIONCODE = 'BAT3' 
                            -- OR x.OPERATIONCODE = 'BBS1' 
                            OR x.OPERATIONCODE = 'JHP1' 
                            OR x.OPERATIONCODE = 'WAIT36'
                        )
                        AND x.PROGRESSTEMPLATECODE = 'S01'
                        AND TIMESTAMP(TRIM(x.PROGRESSSTARTPROCESSDATE), TRIM(x.PROGRESSSTARTPROCESSTIME)) BETWEEN '$start_shift1' AND '$end_shift1'
                    AND x.INACTIVE = 1";
        $stmt1 = db2_exec($conn1, $sql_s1);
        $row_stmt1  = db2_fetch_assoc($stmt1);
        $total1 = $row_stmt1['TOTAL_QTY_BAGI_KAIN'];
        
        // BELAH KAIN
        $sql_s1 = "SELECT
                        SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
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
                    LEFT OUTER JOIN (
                        SELECT 
                            PRODUCTIONORDERCODE, 
                            SUM(INITIALUSERPRIMARYQUANTITY) AS QTY_BAGI_KAIN,
                            OPERATIONCODE
                        FROM 
                            VIEWPRODUCTIONDEMANDSTEP 
                        GROUP BY 
                            PRODUCTIONORDERCODE,
                            OPERATIONCODE --Perlu di grup berdasarkan operation karena ada sum
                    ) v ON v.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE 
                    AND v.OPERATIONCODE = x.OPERATIONCODE
                    WHERE
                        (x.OPERATIONCODE = 'BEL1')
                        AND x.PROGRESSTEMPLATECODE = 'S01'
                        AND TIMESTAMP(TRIM(x.PROGRESSSTARTPROCESSDATE), TRIM(x.PROGRESSSTARTPROCESSTIME)) BETWEEN '$start_shift1' AND '$end_shift1'
                    AND x.INACTIVE = 1";
        $stmt1 = db2_exec($conn1, $sql_s1);
        $row_stmt1  = db2_fetch_assoc($stmt1);
        $totB1 = $row_stmt1['TOTAL_QTY_BAGI_KAIN'];

    // Mengambil data shift 2
        // BUKA KAIN
        $sql_s2 = "SELECT
                        SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
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
                    LEFT OUTER JOIN (
                        SELECT 
                            PRODUCTIONORDERCODE, 
                            SUM(INITIALUSERPRIMARYQUANTITY) AS QTY_BAGI_KAIN,
                            OPERATIONCODE
                        FROM 
                            VIEWPRODUCTIONDEMANDSTEP 
                        GROUP BY 
                            PRODUCTIONORDERCODE,
                            OPERATIONCODE --Perlu di grup berdasarkan operation karena ada sum
                    ) v ON v.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE 
                    AND v.OPERATIONCODE = x.OPERATIONCODE
                    WHERE
                        (
                            x.OPERATIONCODE = 'BAT2' 
                            OR x.OPERATIONCODE = 'BKN1' 
                    --        OR x.OPERATIONCODE = 'BEL1' 
                            OR x.OPERATIONCODE = 'BAT3' 
                            -- OR x.OPERATIONCODE = 'BBS1' 
                            OR x.OPERATIONCODE = 'JHP1' 
                            OR x.OPERATIONCODE = 'WAIT36'
                        )
                        AND x.PROGRESSTEMPLATECODE = 'S01'
                        AND TIMESTAMP(TRIM(x.PROGRESSSTARTPROCESSDATE), TRIM(x.PROGRESSSTARTPROCESSTIME)) BETWEEN '$start_shift2' AND '$end_shift2'
                    AND x.INACTIVE = 1";
        $stmt2 = db2_exec($conn1, $sql_s2);
        $row_stmt2  = db2_fetch_assoc($stmt2);
        $total2 = $row_stmt2['TOTAL_QTY_BAGI_KAIN'];
    
        // BELAH KAIN
        $sql_s2 = "SELECT
                        SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
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
                    LEFT OUTER JOIN (
                        SELECT 
                            PRODUCTIONORDERCODE, 
                            SUM(INITIALUSERPRIMARYQUANTITY) AS QTY_BAGI_KAIN,
                            OPERATIONCODE
                        FROM 
                            VIEWPRODUCTIONDEMANDSTEP 
                        GROUP BY 
                            PRODUCTIONORDERCODE,
                            OPERATIONCODE --Perlu di grup berdasarkan operation karena ada sum
                    ) v ON v.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE 
                    AND v.OPERATIONCODE = x.OPERATIONCODE
                    WHERE
                        (x.OPERATIONCODE = 'BEL1')
                        AND x.PROGRESSTEMPLATECODE = 'S01'
                        AND TIMESTAMP(TRIM(x.PROGRESSSTARTPROCESSDATE), TRIM(x.PROGRESSSTARTPROCESSTIME)) BETWEEN '$start_shift2' AND '$end_shift2'
                    AND x.INACTIVE = 1";
        $stmt2 = db2_exec($conn1, $sql_s2);
        $row_stmt2  = db2_fetch_assoc($stmt2);
        $totB2 = $row_stmt2['TOTAL_QTY_BAGI_KAIN'];

    // Mengambil data shift 3
        // BUKA KAIN
        $sql_s3 = "SELECT
                        SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
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
                    LEFT OUTER JOIN (
                        SELECT 
                            PRODUCTIONORDERCODE, 
                            SUM(INITIALUSERPRIMARYQUANTITY) AS QTY_BAGI_KAIN,
                            OPERATIONCODE
                        FROM 
                            VIEWPRODUCTIONDEMANDSTEP 
                        GROUP BY 
                            PRODUCTIONORDERCODE,
                            OPERATIONCODE --Perlu di grup berdasarkan operation karena ada sum
                    ) v ON v.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE 
                    AND v.OPERATIONCODE = x.OPERATIONCODE
                    WHERE
                        (
                            x.OPERATIONCODE = 'BAT2' 
                            OR x.OPERATIONCODE = 'BKN1' 
                            --OR x.OPERATIONCODE = 'BEL1' 
                            OR x.OPERATIONCODE = 'BAT3' 
                            -- OR x.OPERATIONCODE = 'BBS1' 
                            OR x.OPERATIONCODE = 'JHP1' 
                            OR x.OPERATIONCODE = 'WAIT36'
                        )
                        AND x.PROGRESSTEMPLATECODE = 'S01'
                        AND TIMESTAMP(TRIM(x.PROGRESSSTARTPROCESSDATE), TRIM(x.PROGRESSSTARTPROCESSTIME)) BETWEEN '$start_shift3' AND '$end_shift3'
                    AND x.INACTIVE = 1";
        $stmt3 = db2_exec($conn1, $sql_s3);
        $row_stmt3  = db2_fetch_assoc($stmt3);
        $total3 = $row_stmt3['TOTAL_QTY_BAGI_KAIN'];
    
        // BELAH KAIN
        $sql_s3 = "SELECT
                        SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
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
                    LEFT OUTER JOIN (
                        SELECT 
                            PRODUCTIONORDERCODE, 
                            SUM(INITIALUSERPRIMARYQUANTITY) AS QTY_BAGI_KAIN,
                            OPERATIONCODE
                        FROM 
                            VIEWPRODUCTIONDEMANDSTEP 
                        GROUP BY 
                            PRODUCTIONORDERCODE,
                            OPERATIONCODE --Perlu di grup berdasarkan operation karena ada sum
                    ) v ON v.PRODUCTIONORDERCODE = x.PRODUCTIONORDERCODE 
                    AND v.OPERATIONCODE = x.OPERATIONCODE
                    WHERE
                        (x.OPERATIONCODE = 'BEL1')
                        AND x.PROGRESSTEMPLATECODE = 'S01'
                        AND TIMESTAMP(TRIM(x.PROGRESSSTARTPROCESSDATE), TRIM(x.PROGRESSSTARTPROCESSTIME)) BETWEEN '$start_shift3' AND '$end_shift3'
                    AND x.INACTIVE = 1";
        $stmt3 = db2_exec($conn1, $sql_s3);
        $row_stmt3  = db2_fetch_assoc($stmt3);
        $totB3 = $row_stmt3['TOTAL_QTY_BAGI_KAIN'];

    // Logging hasil
    error_log("Tanggal Laporan: " . htmlspecialchars($tgl_laporan));
    error_log("Qty Masuk: " . htmlspecialchars($qty_masuk));
    error_log("Qty Keluar: " . htmlspecialchars($qty_keluar));
    error_log("Total Belah Kain Shift 1: " . htmlspecialchars($totB1));
    error_log("Total Belah Kain Shift 2: " . htmlspecialchars($totB2));
    error_log("Total Belah Kain Shift 3: " . htmlspecialchars($totB3));
    error_log("Total Buka Kain Shift 1: " . htmlspecialchars($totBk1));
    error_log("Total Buka Kain Shift 2: " . htmlspecialchars($totBk2));
    error_log("Total Buka Kain Shift 3: " . htmlspecialchars($totBk3));
    error_log("Total Buka Kain Shift 3: " . htmlspecialchars($BAT2));
    error_log("Total Buka Kain Shift 3: " . htmlspecialchars($BAT3));
    error_log("Total Buka Kain Shift 3: " . htmlspecialchars($WAIT36));
    error_log("Total Buka Kain Shift 3: " . htmlspecialchars($JHP1));
    error_log("Total Buka Kain Shift 3: " . htmlspecialchars($total1));
    error_log("Total Buka Kain Shift 3: " . htmlspecialchars($total2));
    error_log("Total Buka Kain Shift 3: " . htmlspecialchars($total3));
    // Log hasil penjumlahan
    error_log("Total Masuk Kain: " . $totalMasukKain);
    // Menjumlahkan hasil dari kedua query
    $totalMasukKain = $rowdb2['QTY_MASUK'] + $rowdb['QTY_MASUK'];
    $totalBelahKain = $totB1 + $totB2 + $totB3;
}
$response = array(
    'session' => 'LIB_SUCCSS',
    // db2
    'value_masuk'   => number_format($totalMasukKain, '2', '.', ''),
    'value_bagi'    => number_format($rowKKG['QTY_KELUAR'], '2', '.', ''),
    'buka_kain_s1'  => number_format($total1, '2', '.', ''),
    'buka_kain_s2'  => number_format($total2, '2', '.', ''),
    'buka_kain_s3'  => number_format($total3, '2', '.', ''),
    'belahkains1'   => number_format($totB1, '2', '.', ''),
    'belahkains2'   => number_format($totB2, '2', '.', ''),
    'belahkains3'   => number_format($totB3, '2', '.', ''),

);
echo json_encode($response);