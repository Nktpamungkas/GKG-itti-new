<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$sql_mesin = mysqli_query($con,"SELECT * FROM tbl_mesin_gkg order by nama_mesin ASC");
$cekR = mysqli_num_rows($sql_mesin);

$sql_mesin_gkg = mysqli_query($con,"SELECT * FROM tbl_mesin_gkg WHERE nama_mesin='$_POST[nama_mesin]'");
$cekDt = mysqli_num_rows($sql_mesin_gkg);

// handle add
if($_POST['submit']=="add" AND $cekDt>0){
	echo "<script>swal({
		title: 'Nama Mesin Sudah Ada!',   
		text: 'Silahkan untuk input data kembali',
		type: 'info',
		}).then((result) => {
		if (result.value) {
		   window.location.href='manage_mesin_gkg';
		}
	  });</script>";
}else if ($_POST['submit']=="add" AND $cekDt==0) {
    function kode_mesin($nama_mesin){
        include "koneksi.php";
        $sql    = mysqli_query($con,"SELECT kode_mesin,LEFT(nama_mesin,CHAR_LENGTH(nama_mesin)-3) AS nama_mesin FROM tbl_mesin_gkg 
                                WHERE nama_mesin LIKE CONCAT(LEFT('$nama_mesin',CHAR_LENGTH('$nama_mesin')-3),'%') ORDER BY kode_mesin DESC LIMIT 1");
        $dt     = mysqli_num_rows($sql);
        if ($dt>0) {
            $rd=mysqli_fetch_array($sql);
            if($rd['nama_mesin']=="Buka Kain"){
                if($rd['nama_mesin']=="Buka Kain"){
                    $dt=$rd['kode_mesin'];
                    $strd=substr($dt, 2, 2);
                    $Urutd = (int)$strd;
                }else {
                    $Urutd = 0;
                }
                $Urutd = $Urutd + 1;
                $Nold="";
                $nilaid=2-strlen($Urutd);
                for ($i=1;$i<=$nilaid;$i++) {
                    $Nold= $Nold."0";
                }
                $no2 ='BK'.$Nold.$Urutd;
                return $no2;
            }else if($rd['nama_mesin']=="Jahit Pinggir"){
                if($rd['nama_mesin']=="Jahit Pinggir"){
                    $dt=$rd['kode_mesin'];
                    $strd=substr($dt, 2, 2);
                    $Urutd = (int)$strd;
                }else {
                    $Urutd = 0;
                }
                $Urutd = $Urutd + 1;
                $Nold="";
                $nilaid=2-strlen($Urutd);
                for ($i=1;$i<=$nilaid;$i++) {
                    $Nold= $Nold."0";
                }
                $no2 ='JP'.$Nold.$Urutd;
                return $no2;
            }else if($rd['nama_mesin']=="Balik Kain"){
                if($rd['nama_mesin']=="Balik Kain"){
                    $dt=$rd['kode_mesin'];
                    $strd=substr($dt, 3, 2);
                    $Urutd = (int)$strd;
                }else {
                    $Urutd = 0;
                }
                $Urutd = $Urutd + 1;
                $Nold="";
                $nilaid=2-strlen($Urutd);
                for ($i=1;$i<=$nilaid;$i++) {
                    $Nold= $Nold."0";
                }
                $no2 ='BLK'.$Nold.$Urutd;
                return $no2;
            }else if($rd['nama_mesin']=="Belah Kain"){
                if($rd['nama_mesin']=="Belah Kain"){
                    $dt=$rd['kode_mesin'];
                    $strd=substr($dt, 3, 2);
                    $Urutd = (int)$strd;
                }else {
                    $Urutd = 0;
                }
                $Urutd = $Urutd + 1;
                $Nold="";
                $nilaid=2-strlen($Urutd);
                for ($i=1;$i<=$nilaid;$i++) {
                    $Nold= $Nold."0";
                }
                $no2 ='BLH'.$Nold.$Urutd;
                return $no2;
            }else if($rd['nama_mesin']=="Inspeksi"){
                if($rd['nama_mesin']=="Inspeksi"){
                    $dt=$rd['kode_mesin'];
                    $strd=substr($dt, 3, 2);
                    $Urutd = (int)$strd;
                }else {
                    $Urutd = 0;
                }
                $Urutd = $Urutd + 1;
                $Nold="";
                $nilaid=2-strlen($Urutd);
                for ($i=1;$i<=$nilaid;$i++) {
                    $Nold= $Nold."0";
                }
                $no2 ='INS'.$Nold.$Urutd;
                return $no2;
            }
        }
    }
    $kd_mc=kode_mesin($_POST['nama_mesin']);	
    mysqli_query($con,"INSERT INTO tbl_mesin_gkg (`kode_mesin`, `nama_mesin`, `jenis_mesin`, `ket`, `status`)  values ('$kd_mc', '$_POST[nama_mesin]', '$_POST[jenis_mesin]', '$_POST[keterangan]', '$_POST[status]')");
    echo '<script>window.location="manage_mesin_gkg"</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table thead tr th {
        text-align: center;
    }

    table thead tr th,
    table tbody tr td {
        border-bottom: 1px solid #515357 !important;
    }

    tr:hover {
        background-color: #ffff99;
    }
</style>

<body>

</body>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <br />
            <div style="margin-left: 15px;">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-plus-circle"></i> &nbsp;Add New Mesin GKG
                </button>
            </div>
            <p></p>
            <table class="display compact nowrap table table-sm table-bordered" id="tbl_user" width="100%">
                <thead>
                    <tr style="background: #38761D; color: white;">
                        <th width="20">#</th>
                        <th>Kode Mesin</th>
                        <th>Jenis Mesin</th>
                        <th>Nama Mesin</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th width="20">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($mesins = mysqli_fetch_array($sql_mesin)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td align="center" style="font-style: italic;"><b><?php echo $mesins['kode_mesin'] ?></b></td>
                            <td><?php echo $mesins['jenis_mesin'] ?></td>
                            <td><?php echo $mesins['nama_mesin'] ?></td>
                            <td><?php echo $mesins['ket'] ?></td>
                            <td align="center">
                                <?php if ($mesins['status'] == "Normal") {
                                    echo '<span class="label label-success">' . $mesins['status'] . '</span>';
                                } else if ($mesins['status'] == "OFF") {
                                    echo '<span class="label label-default">' . $mesins['status'] . '</span>';
                                } else {
                                    echo '<span class="label label-danger">' . $mesins['status'] . '</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#Modaledit<?php echo $mesins['id'] ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</button>
                            </td>
                        </tr>
                        <!-- modal -->
                        <div class="modal fade" id="Modaledit<?php echo $mesins['id'] ?>" data-backdrop="static" keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Data Mesin <?php echo $mesins['nama_mesin'] ?></h4>
                                    </div>
                                    <form action="pages/edit_data_mesin_gkg.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $mesins['id'] ?>">
                                        <div class="modal-body">
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="kode_mesin">Kode Mesin</label>
                                                <input required readonly type="text" title="kode_mesin" class="form-control" name="kode_mesin" id="kode_mesin" placeholder="kode_mesin..." value="<?php echo $mesins['kode_mesin'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="jenis_mesin">Jenis Mesin</label>
                                                <input required type="text" title="jenis_mesin" class="form-control" name="jenis_mesin" id="jenis_mesin" placeholder="jenis_mesin..." value="<?php echo $mesins['jenis_mesin'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="nama_mesin">Nama Mesin</label>
                                                <input required type="text" title="nama_mesin" class="form-control" name="nama_mesin" id="nama_mesin" placeholder="nama_mesin..." value="<?php echo $mesins['nama_mesin'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" title="keterangan" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan..." value="<?php echo $mesins['ket'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="Status">Status</label>
                                                <select type="text" required title="Status" class="form-control" name="status" id="Status" placeholder="Status...">
                                                    <option selected disabled>Pilih</option>
                                                    <option <?php if ($mesins['status'] == 'Normal') echo "selected" ?> value="Normal">Normal</option>
                                                    <option <?php if ($mesins['status'] == 'Maintenance') echo "selected" ?> value="Maintenance">Maintenance</option>
                                                    <option <?php if ($mesins['status'] == 'Rusak') echo "selected" ?> value="Rusak">Rusak</option>
                                                    <option <?php if ($mesins['status'] == 'OFF') echo "selected" ?> value="OFF">OFF</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" value="edit" class="btn btn-primary">Save</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- //modal -->
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="myModal" data-backdrop="static" keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Mesin</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="nama_mesin">Nama Mesin</label>
                        <input required type="text" title="nama_mesin" class="form-control" name="nama_mesin" id="nama_mesin" placeholder="nama_mesin...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="jenis_mesin">Jenis Mesin</label>
                        <select type="text" required title="Jenis Mesin" class="form-control" name="jenis_mesin" id="jenis_mesin" placeholder="jenis_mesin...">
                            <option selected disabled>Pilih jenis mesin ...</option>
                            <option value="Buka Kain">Buka Kain</option>
                            <option value="Inspek">Inspeksi</option>
                        </select>
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" title="keterangan" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="Status">Status</label>
                        <select type="text" required title="Status" class="form-control" name="status" id="Status" placeholder="Status...">
                            <option selected disabled>Pilih status ...</option>
                            <option value="Normal">Normal</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Rusak">Rusak</option>
                            <option value="OFF">OFF</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="add" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</html>
<script>
    $(document).ready(function() {
        $('#tbl_user').DataTable({
            select: true,
        });

        $('.btn.btn-success.btn-xs').click(function() {
            var id = $(this).attr('data-attribute')
            var confirmm = confirm("Anda Akan Menon-aktifkan user ini, apakah anda yakin ?");
            if (confirmm) {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: 'pages/ajax_nonaktifkan_user.php',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        toastr.success('User telah di non-aktifkan');
                        location.reload()
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }
        })
        $('.btn.btn-danger.btn-xs').click(function() {
            var id = $(this).attr('data-attribute')
            var confirmm = confirm("Anda Akan Mengaktifkan user ini, apakah anda yakin ?");
            if (confirmm) {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: 'pages/ajax_aktifkan_user.php',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        toastr.success('User telah di aktifkan');
                        location.reload()
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }
        })
    });
</script>