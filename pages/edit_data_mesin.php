<?PHP
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$time = date('Y-m-d H:i:s');
$sql_status = mysqli_query($con,"SELECT * from tbl_no_mesin where id = '$_POST[id]'");
$status = mysqli_fetch_array($sql_status);
if ($status['status'] == $_POST['status']) {
    mysqli_query($con,"UPDATE tbl_no_mesin SET
            `no_mesin` = '$_POST[no_mesin]',
            `kapasitas` = '$_POST[kapasitas]',
            `l_r` = '$_POST[l_r]', 
            `ket` = '$_POST[keterangan]',
            `kode` = '$_POST[kode]',
            `status` = '$_POST[status]'
            where `id` =  '$_POST[id]'");
} else {
    mysqli_query($con,"INSERT into history_status_mesin (`no_mesin`, `status`, `date_status`) 
                                        VALUES ('$_POST[no_mesin]', '$_POST[status]', '$time')");


    mysqli_query($con,"UPDATE tbl_no_mesin SET
    `no_mesin` = '$_POST[no_mesin]',
    `kapasitas` = '$_POST[kapasitas]',
    `l_r` = '$_POST[l_r]', 
    `ket` = '$_POST[keterangan]',
    `kode` = '$_POST[kode]',
    `status` = '$_POST[status]'
    where `id` =  '$_POST[id]'");
}
echo "<script>window.location='/gkg-itti/manage_mesin'</script>";
