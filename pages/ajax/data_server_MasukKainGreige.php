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
$totalMasukKain = 0;


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
    $sql_s1 = "SELECT 
    TRIM(x.OPERATIONCODE) AS OPERATIONCODE,
    SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
FROM
    PRODUCTIONPROGRESS x --Penyebab looping karena FROM nya dari sini, dan operationnya masih ada
LEFT OUTER JOIN ( --Tambahan juga, LEFT OUTER JOIN hanya buat ambil data yang sama dan menampilkan data yang beda, sedangkan karena operationnya dibaca semua sehingga datanya keluar semua 
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
                PRODUCTIONDEMANDSTEP
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
                BUSINESSPARTNER
            LEFT JOIN ORDERPARTNER ON BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
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
    x.OPERATIONCODE  IN ('BEL1','BKN1') AND --Operation ini ditambahin karena di laporan shift hanya perlu operation ini dan metode JOIN hanya membuat DATA bertambah sehingga terlopping & DATA lebih bnyak
    x.PROGRESSTEMPLATECODE = 'S01' --Kalau pengen sesuai kondisi harus tambahin FILTER yang di atas 
    AND TIMESTAMP(x.PROGRESSSTARTPROCESSDATE, x.PROGRESSSTARTPROCESSTIME) BETWEEN
         '$start_shift1' AND '$end_shift1'
    AND x.INACTIVE = 1
GROUP BY 
    x.OPERATIONCODE";
    $stmt1 = db2_exec($conn1, $sql_s1);
    if ($stmt1) {
        $results = []; // Array untuk menyimpan hasil

        // Ambil semua hasil dari query
        while ($row = db2_fetch_assoc($stmt1)) {
            $operation_code = $row['OPERATIONCODE'];
            $total_qty_bagi_kain = $row['TOTAL_QTY_BAGI_KAIN'] ?? 0;

            // Simpan dalam array dengan operation_code sebagai kunci
            $results[$operation_code] = $total_qty_bagi_kain;
        }
        //print_r($results);
        $totB1 = $results['BEL1'] ?? 0;
        $totBk1 = $results['BKN1'] ?? 0;
    } else {
        error_log("Error executing sql_s1: " . db2_stmt_errormsg());
    }

    // Mengambil data shift 2
    $sql_s2 = "SELECT 
    TRIM(x.OPERATIONCODE) AS OPERATIONCODE,
    SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
FROM
    PRODUCTIONPROGRESS x --Penyebab looping karena FROM nya dari sini, dan operationnya masih ada
LEFT OUTER JOIN ( --Tambahan juga, LEFT OUTER JOIN hanya buat ambil data yang sama dan menampilkan data yang beda, sedangkan karena operationnya dibaca semua sehingga datanya keluar semua 
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
                PRODUCTIONDEMANDSTEP
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
                BUSINESSPARTNER
            LEFT JOIN ORDERPARTNER ON BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
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
    x.OPERATIONCODE  IN ('BEL1','BKN1') AND --Operation ini ditambahin karena di laporan shift hanya perlu operation ini dan metode JOIN hanya membuat DATA bertambah sehingga terlopping & DATA lebih bnyak
    x.PROGRESSTEMPLATECODE = 'S01' --Kalau pengen sesuai kondisi harus tambahin FILTER yang di atas 
    AND TIMESTAMP(x.PROGRESSSTARTPROCESSDATE, x.PROGRESSSTARTPROCESSTIME) BETWEEN
         '$start_shift2' AND '$end_shift2'
    AND x.INACTIVE = 1
GROUP BY 
    x.OPERATIONCODE";
    $stmt2 = db2_exec($conn1, $sql_s2);
    if ($stmt2) {

        $results = []; // Array untuk menyimpan hasil

        // Ambil semua hasil dari query
        while ($row = db2_fetch_assoc($stmt2)) {
            //echo "Operation Code: " . htmlspecialchars($row['OPERATIONCODE']) . "<br>";
            //echo "Total Qty Bagi Kain: " . htmlspecialchars($row['TOTAL_QTY_BAGI_KAIN']) . "<br>";
            $operation_code = $row['OPERATIONCODE'];
            $total_qty_bagi_kain = $row['TOTAL_QTY_BAGI_KAIN'] ?? 0;

            // Simpan dalam array dengan operation_code sebagai kunci
            $results[$operation_code] = $total_qty_bagi_kain;
        }
        //print_r($results);
        $totB2 = $results['BEL1'] ?? 0;
        $totBk2 = $results['BKN1'] ?? 0;
    } else {
        error_log("Error executing sql_s2: " . db2_stmt_errormsg());
    }

    // Mengambil data shift 3
    $sql_s3 = "SELECT 
    TRIM(x.OPERATIONCODE) AS OPERATIONCODE,
    SUM(DISTINCT v.QTY_BAGI_KAIN) AS TOTAL_QTY_BAGI_KAIN
FROM
    PRODUCTIONPROGRESS x --Penyebab looping karena FROM nya dari sini, dan operationnya masih ada
LEFT OUTER JOIN ( --Tambahan juga, LEFT OUTER JOIN hanya buat ambil data yang sama dan menampilkan data yang beda, sedangkan karena operationnya dibaca semua sehingga datanya keluar semua 
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
                PRODUCTIONDEMANDSTEP
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
                BUSINESSPARTNER
            LEFT JOIN ORDERPARTNER ON BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
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
    x.OPERATIONCODE  IN ('BEL1','BKN1') AND --Operation ini ditambahin karena di laporan shift hanya perlu operation ini dan metode JOIN hanya membuat DATA bertambah sehingga terlopping & DATA lebih bnyak
    x.PROGRESSTEMPLATECODE = 'S01' --Kalau pengen sesuai kondisi harus tambahin FILTER yang di atas 
    AND TIMESTAMP(x.PROGRESSSTARTPROCESSDATE, x.PROGRESSSTARTPROCESSTIME) BETWEEN
         '$start_shift3' AND '$end_shift3'
    AND x.INACTIVE = 1
GROUP BY 
    x.OPERATIONCODE";
    $stmt3 = db2_exec($conn1, $sql_s3);
    if ($stmt3) {

        $results = []; // Array untuk menyimpan hasil

        // Ambil semua hasil dari query
        while ($row = db2_fetch_assoc($stmt3)) {

            $operation_code = $row['OPERATIONCODE'];
            $total_qty_bagi_kain = $row['TOTAL_QTY_BAGI_KAIN'] ?? 0;

            // Simpan dalam array dengan operation_code sebagai kunci
            $results[$operation_code] = $total_qty_bagi_kain;
        }
        //print_r($results);
        $totB3 = $results['BEL1'] ?? 0;
        $totBk3 = $results['BKN1'] ?? 0;


    } else {
        error_log("Error executing sql_s3: " . db2_stmt_errormsg());
    }

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
    // Log hasil penjumlahan
    error_log("Total Masuk Kain: " . $totalMasukKain);
    // Menjumlahkan hasil dari kedua query
    $totalMasukKain = $rowdb2['QTY_MASUK'] + $rowdb['QTY_MASUK'];
    $totalBelahKain = $totB1 + $totB2 + $totB3;
    $totalBukaKain = $totBk1 + $totBk2 + $totBk3;


}
$response = array(
    'session' => 'LIB_SUCCSS',
    // db2
    'value_masuk' => number_format($totalMasukKain, '2', '.', ''),
    'value_bagi' => number_format($rowKKG['QTY_KELUAR'], '2', '.', ''),
    'buka_kain_s1' => number_format($totBk1, '2', '.', ''),
    'buka_kain_s2' => number_format($totBk2, '2', '.', ''),
    'buka_kain_s3' => number_format($totBk3, '2', '.', ''),
    'belahkains1' => number_format($totB1, '2', '.', ''),
    'belahkains2' => number_format($totB2, '2', '.', ''),
    'belahkains3' => number_format($totB3, '2', '.', ''),

);
echo json_encode($response);