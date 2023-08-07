<?PHP
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");

if ($_POST) {
    mysqli_query($con,"UPDATE tbl_user SET `status` = 'Non-Aktif' WHERE `id_user` = '$_POST[id]'");
    $response = 'User di non-aktifkan !';
    echo json_encode($response);
}
