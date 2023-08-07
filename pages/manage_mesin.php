<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$sql_mesin = mysqli_query($con,"SELECT id, no_mesin, kapasitas, l_r, kode, ket, `status`
                        FROM tbl_no_mesin order by no_mesin DESC");

// handle add
if ($_POST['submit']) {
    mysqli_query($con,"INSERT INTO tbl_no_mesin (`no_mesin`, `kapasitas`, `l_r`, `ket`, `status`, `kode`)  values ('$_POST[no_mesin]', '$_POST[kapasitas]', '$_POST[l_r]', '$_POST[keterangan]', '$_POST[status]', '$_POST[kode]')");
    echo '<script>window.location="manage_mesin"</script>';
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
                    <i class="fa fa-plus-circle"></i> &nbsp;Add New Mesin
                </button>
            </div>
            <p></p>
            <table class="display compact nowrap table table-sm table-bordered" id="tbl_user" width="100%">
                <thead>
                    <tr style="background: #070721; color: white;">
                        <th width="20">#</th>
                        <th>No. Mesin</th>
                        <th>Kapasitas</th>
                        <th>L : R</th>
                        <th>Kode</th>
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
                            <td align="center" style="font-style: italic;"><b><?php echo $mesins['no_mesin'] ?></b></td>
                            <td><?php echo $mesins['kapasitas'] ?></td>
                            <td><?php echo $mesins['l_r'] ?></td>
                            <td><?php echo $mesins['kode'] ?></td>
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
                                        <h4 class="modal-title" id="myModalLabel">Edit Data Mesin <?php echo $mesins['no_mesin'] ?></h4>
                                    </div>
                                    <form action="pages/edit_data_mesin.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $mesins['id'] ?>">
                                        <div class="modal-body">
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="no_mesin">No. Mesin</label>
                                                <input required readonly type="text" title="no_mesin" class="form-control" name="no_mesin" id="no_mesin" placeholder="no_mesin..." value="<?php echo $mesins['no_mesin'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="kapasitas">kapasitas</label>
                                                <input required type="text" title="kapasitas" class="form-control" name="kapasitas" id="kapasitas" placeholder="kapasitas..." value="<?php echo $mesins['kapasitas'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="l_r">L : R</label>
                                                <input required type="text" title="l_r" class="form-control" name="l_r" id="l_r" placeholder="L : R..." value="<?php echo $mesins['l_r'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="kode">Kode</label>
                                                <input required type="text" title="kode" class="form-control" name="kode" id="kode" placeholder="kode..." value="<?php echo $mesins['kode'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="keterangan">Keterangan</label>
                                                <input required type="text" title="keterangan" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan..." value="<?php echo $mesins['ket'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="Status">Status</label>
                                                <select type="text" required title="Status" class="form-control" name="status" id="Status" placeholder="Status...">
                                                    <option <?php if ($mesins['status'] == 'Normal') echo "selected" ?> value="Normal">Normal</option>
                                                    <option <?php if ($mesins['status'] == 'Maintenance') echo "selected" ?> value="Maintenance">Maintenance</option>
                                                    <option <?php if ($mesins['status'] == 'Rusak') echo "selected" ?> value="Rusak">Rusak</option>
                                                    <option <?php if ($mesins['status'] == 'OFF') echo "selected" ?> value="OFF">OFF</option>
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
                        <label for="no_mesin">No. Mesin</label>
                        <input required type="text" title="no_mesin" class="form-control" name="no_mesin" id="no_mesin" placeholder="no_mesin...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="kapasitas">kapasitas</label>
                        <input required type="text" title="kapasitas" class="form-control" name="kapasitas" id="kapasitas" placeholder="kapasitas...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="l_r">L : R</label>
                        <input required type="text" title="l_r" class="form-control" name="l_r" id="l_r" placeholder="L : R...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="kode">Kode</label>
                        <input required type="text" title="kode" class="form-control" name="kode" id="kode" placeholder="kode...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="keterangan">Keterangan</label>
                        <input required type="text" title="keterangan" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan...">
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