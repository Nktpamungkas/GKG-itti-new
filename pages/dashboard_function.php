<?php
function Get_roll_bydate($day, $group)
{
    ini_set("error_reporting", 1);
    session_start();
    include "koneksi.php";
    $sql_sum_roll = mysqli_query($con,"SELECT sum(rol) as rolf 
    from tbl_schedule 
    where status = 'selesai' and DATE_FORMAT(tgl_mulai,'%Y-%m-%d') = '$day' and g_shift = '$group'
    group by g_shift");
    $sum_roll_day = mysqli_fetch_array($sql_sum_roll);

    if (empty($sum_roll_day['rolf'])) {
        return 0;
    } else {
        return $sum_roll_day['rolf'];
    }
}
$_GA = array();
$_GB = array();
$_GC = array();
$n = 0;
while ($n <= 14) {
    $_GA[] = intval(Get_roll_bydate(date('Y-m-d', strtotime("-$n days")), 'A'));
    $_GB[] = intval(Get_roll_bydate(date('Y-m-d', strtotime("-$n days")), 'B'));
    $_GC[] = intval(Get_roll_bydate(date('Y-m-d', strtotime("-$n days")), 'C'));
    $n++;
}
$groupA = json_encode($_GA);
$groupB = json_encode($_GB);
$groupC = json_encode($_GC);

// Label Hari 
$now = date('Y-m-d');
$hari = array();
$x = 0;
while ($x <= 14) {
    $hari[] = date('d F', strtotime("-$x days"));
    $x++;
}
$data_hari = json_encode($hari);
// label hari end here
