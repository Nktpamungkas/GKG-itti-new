<?PHP
ini_set("error_reporting", 1);
session_start();
include "../koneksi.php";

mysqli_query($con,"UPDATE tbl_user SET
            `nama` = '$_POST[Nama]',
            `level` = '$_POST[Level]',
            `dept` = '$_POST[Dept]',
            `jabatan` = '$_POST[Jabatan]',
            `status` = '$_POST[Status]'
            where `id_user` =  '$_POST[id]'");
echo "<script>window.location='/gkg-itti/manage_user'</script>";
