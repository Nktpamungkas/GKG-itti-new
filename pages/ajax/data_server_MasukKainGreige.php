<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$sql_get = mysqli_query($con,"SELECT * from tbl_laporanharian where date_laporan = '$_POST[tgl_laporan]'");
$get = mysqli_fetch_array($sql_get);

//MASUK KAIN GREIGE

/*$sqlDB2="SELECT 
STOCKTRANSACTION.TRANSACTIONDATE,
SUM(STOCKTRANSACTION.WEIGHTNET) AS QTY_MASUK
FROM ITXVIEWLAPMASUKGREIGE ITXVIEWLAPMASUKGREIGE 
LEFT JOIN STOCKTRANSACTION STOCKTRANSACTION 
ON ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE = STOCKTRANSACTION.ORDERCODE 
AND ITXVIEWLAPMASUKGREIGE.ORDERLINE  = STOCKTRANSACTION.ORDERLINE
AND ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE  = STOCKTRANSACTION.ORDERCOUNTERCODE 
WHERE (STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG') AND STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021'
AND STOCKTRANSACTION.TRANSACTIONDATE ='$_POST[tgl_laporan]'
GROUP BY 
STOCKTRANSACTION.TRANSACTIONDATE";*/
$sqlDB2=" SELECT
STOCKTRANSACTION.TRANSACTIONDATE,
SUM(STOCKTRANSACTION.WEIGHTNET) AS QTY_MASUK
FROM  STOCKTRANSACTION STOCKTRANSACTION 
WHERE (STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG') AND STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021'
AND STOCKTRANSACTION.TRANSACTIONDATE ='$_POST[tgl_laporan]'
GROUP BY 
STOCKTRANSACTION.TRANSACTIONDATE
";
$stmt1   = db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
$rowdb2 = db2_fetch_assoc($stmt1);

//KELUAR KAIN GREIGE
$sqlKKG=" SELECT 
STOCKTRANSACTION.TRANSACTIONDATE,
SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY_KELUAR
FROM STOCKTRANSACTION STOCKTRANSACTION 
WHERE 
(STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG') AND STOCKTRANSACTION.TEMPLATECODE ='120' AND
STOCKTRANSACTION.TRANSACTIONDATE='$_POST[tgl_laporan]' and STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' AND
STOCKTRANSACTION.ONHANDUPDATE > 1
GROUP BY 
STOCKTRANSACTION.TRANSACTIONDATE ";
$stmt2   = db2_exec($conn1,$sqlKKG, array('cursor'=>DB2_SCROLLABLE));
$rowKKG = db2_fetch_assoc($stmt2);

$start_shift1 = $_POST['tgl_laporan'] . ' 07:00';
$end_shift1 = $_POST['tgl_laporan'] . ' 15:00';
$sql_s1 = mysqli_query($con,"SELECT b.langganan, b.buyer, b.no_order, b.jenis_kain, b.warna, b.lot, b.rol, b.proses, b.pic_schedule,
                    b.bruto, b.buka, b.tgl_mulai, b.tgl_stop, b.no_mesin, b.petugas_buka, b.petugas_obras,
                    b.no_gerobak, b.leader_check
                    from tbl_schedule b
                    join tbl_gerobak a on b.id = a.id_schedule
                    where b.`status` = 'selesai' AND b.leader_check = 'TRUE' and b.buka!='' and
                    DATE_FORMAT(b.tgl_update,'%Y-%m-%d %H:%i') >= '$start_shift1'
                    AND DATE_FORMAT(b.tgl_update,'%Y-%m-%d %H:%i') <= '$end_shift1'
                    GROUP by b.nodemand, b.proses, b.no_mesin, b.no_urut
                    ORDER by b.tgl_stop DESC");
while ($shft1 = mysqli_fetch_array($sql_s1)) {
    $tots1 = $tots1 + $shft1['bruto'];
}

$start_shift2 = $_POST['tgl_laporan'] . ' 15:00';
$end_shift2 = $_POST['tgl_laporan'] . ' 23:00';
$sql_s2 = mysqli_query($con,"SELECT b.langganan, b.buyer, b.no_order, b.jenis_kain, b.warna, b.lot, b.rol, b.proses, b.pic_schedule,
                    b.bruto, b.buka, b.tgl_mulai, b.tgl_stop, b.no_mesin, b.petugas_buka, b.petugas_obras,
                    b.no_gerobak, b.leader_check
                    from tbl_schedule b
                    join tbl_gerobak a on b.id = a.id_schedule
                    where b.`status` = 'selesai' AND b.leader_check = 'TRUE' and b.buka!='' and
                    DATE_FORMAT(b.tgl_update,'%Y-%m-%d %H:%i') >= '$start_shift2'
                    AND DATE_FORMAT(b.tgl_update,'%Y-%m-%d %H:%i') <= '$end_shift2'
                    GROUP by b.nodemand, b.proses, b.no_mesin, b.no_urut
                    ORDER by b.tgl_stop DESC");
while ($shft2 = mysqli_fetch_array($sql_s2)) {
    $tots2 = $tots2 + $shft2['bruto'];
}


// shift 3
$endShift3 = $_POST['tgl_laporan'] . ' 07:00';
$dates3end = date('Y-m-d H:i', strtotime($endShift3 . ' +1 day'));
$start_shift3 = $_POST['tgl_laporan'] . ' 23:00';
$end_shift3 = $dates3end;

$sql_s3 = mysqli_query($con,"SELECT b.langganan, b.buyer, b.no_order, b.jenis_kain, b.warna, b.lot, b.rol, b.proses, b.pic_schedule,
                    b.bruto, b.buka, b.tgl_mulai, b.tgl_stop, b.no_mesin, b.petugas_buka, b.petugas_obras,
                    b.no_gerobak, b.leader_check
                    from tbl_schedule b
                    join tbl_gerobak a on b.id = a.id_schedule
                    where b.`status` = 'selesai' AND b.leader_check = 'TRUE' and b.buka!='' and
                    DATE_FORMAT(b.tgl_update,'%Y-%m-%d %H:%i') >= '$start_shift3'
                    AND DATE_FORMAT(b.tgl_update,'%Y-%m-%d %H:%i') <= '$end_shift3'
                    GROUP by b.nodemand, b.proses, b.no_mesin, b.no_urut
                    ORDER by b.tgl_stop DESC");
while ($shft3 = mysqli_fetch_array($sql_s3)) {
    $tots3 = $tots3 + $shft3['bruto'];
}

// $bukakains1 = if ($get['buka_kain_s1'] == 0){number_format($tots1, '2', '.', '');} else {number_format($get['buka_kain_s1'], '2', '.', '');}
// $bukakains2 = if ($get['buka_kain_s2'] == 0){number_format($tots2, '2', '.', '');} else {number_format($get['buka_kain_s2'], '2', '.', '');}
// $bukakains3 = if ($get['buka_kain_s3'] == 0){number_format($tots3, '2', '.', '');} else {number_format($get['buka_kain_s3'], '2', '.', '');}

$response = array(
    'session' => 'LIB_SUCCSS',
    // sqlsrv
    'value_masuk' => number_format($rowdb2['QTY_MASUK'], '2', '.', ''),
    'value_bagi' =>  number_format($rowKKG['QTY_KELUAR'], '2', '.', ''),
    // mysqli
    'buka_kain_s1' =>  number_format($tots1, '2', '.', ''),
    'buka_kain_s2' =>  number_format($tots2, '2', '.', ''),
    'buka_kain_s3' =>  number_format($tots3, '2', '.', ''),

);
echo json_encode($response);
