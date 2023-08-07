<?PHP
session_start();
include "../koneksi.php";
$time = date('Y-m-d H:i:s');
if ($_POST['submit']) {
    mysqli_query($con,"UPDATE tbl_mesin_gkg SET
    nama_mesin = '$_POST[nama_mesin]',
    jenis_mesin = '$_POST[jenis_mesin]',
    ket = '$_POST[keterangan]',
    `status` = '$_POST[status]'
    WHERE id='$_POST[id]'
    ");
} 
echo "<script>window.location='/gkg-itti/manage_mesin_gkg'</script>";
