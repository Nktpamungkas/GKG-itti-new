<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
</head>
<style>
    td.details-control {
        background: url('bower_components/datatables.net/img/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('bower_components/datatables.net/img/details_close.png') no-repeat center center;
    }

    #TableLeaderCheck tr:hover {
        background-color: rgb(151, 170, 212);
    }
</style>

<body>
    <?php
    $data = mysqli_query($con,"SELECT a.id, a.nodemand,a.no_mesin, a.no_urut, a.buyer, a.langganan, a.no_order, a.nokk, a.jenis_kain,
    a.warna, a.no_warna, sum(a.rol) as rol, sum(a.bruto) as bruto, a.proses, a.dept_tujuan, a.`status`, a.lot, a.catatan, a.nokk_legacy, a.ket_status, 
    a.tgl_delivery, b.no_gerobak1, b.tgl_out1, b.no_gerobak2, b.tgl_out2, b.no_gerobak3, b.tgl_out3, b.no_gerobak4, 
    b.tgl_out4, b.no_gerobak5, b.tgl_out5, b.no_gerobak6, b.tgl_out6, b.no_gerobak7, b.tgl_out7, b.no_gerobak8, b.tgl_out8, a.create_time, a.tgl_mulai, a.tgl_update, a.tgl_stop, a.approve_time,
    a.create_by, a.selesai_by, a.petugas_buka, a.pic_schedule
    FROM tbl_schedule a
    left join tbl_gerobak b on a.id = b.id_schedule
    WHERE a.`status` = 'selesai' and a.leader_check = 'FALSE'
    GROUP BY no_mesin, no_urut
    ORDER BY a.tgl_stop DESC");
    $no = 1;
    $n = 1;
    $c = 0;
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <table id="TableLeaderCheck" class="table table-bordered table-hover table-striped display compact" width="100%">
                        <thead class="bg-blue">
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    <div align="center" valign="center">
                                        <input type="checkbox" class="form-check-input <?php if ($_SESSION['lvl_idGkg'] != "LEADER") {
                                                                                            echo " disabled";
                                                                                        } ?>" id="checkall" <?php if ($_SESSION['lvl_idGkg'] != "LEADER") {
                                                                                                                echo " disabled";
                                                                                                            } ?>>
                                    </div>
                                </th>
                                <th>
                                    <div align="center">Mesin/Urut</div>
                                </th>
                                <th>
                                    <div align="center">Pelanggan</div>
                                </th>
                                <th>
                                    <div align="center">No. Order</div>
                                </th>
                                <th>
                                    <div align="center">Item</div>
                                </th>
                                <th>
                                    <div align="center">Warna</div>
                                </th>
                                <th>
                                    <div align="center">Rol</div>
                                </th>
                                <th>
                                    <div align="center">Kg</div>
                                </th>
                                <th>
                                    <div align="center">Prod. Demand</div>
                                </th>
                                <th>
                                    <div align="center">Delivery</div>
                                </th>
                                <th>
                                    <div align="center">Prod. Order</div>
                                </th>
                                <th class="12">gerobak 1</th>
                                <th class="13">out gerobak 1</th>
                                <th class="14">gerobak 2</th>
                                <th class="15">out gerobak 2</th>
                                <th class="16">gerobak 3</th>
                                <th class="17">out gerobak 3</th>
                                <th class="18">gerobak 4</th>
                                <th class="19">out gerobak 4</th>
                                <th class="20">gerobak 5</th>
                                <th class="21">out gerobak 5</th>
                                <th class="22">gerobak 6</th>
                                <th class="23">out gerobak 6</th>
                                <th class="22">gerobak 7</th>
                                <th class="23">out gerobak 7</th>
                                <th class="22">gerobak 8</th>
                                <th class="23">out gerobak 8</th>
                                <th class="24">id</th>
                                <th class="25">buat</th>
                                <th class="26">mulai</th>
                                <th class="27">update</th>
                                <th class="28">stop</th>
                                <th class="29">buat by</th>
                                <th class="30">stop by</th>
                                <th class="31">petugas_buka</th>
                                <th class="32">Prosc/To</th>
                                <th style="width: 20px; text-align: center;">PIC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $col = 0;
                            $no = 1;
                            while ($rowd = mysqli_fetch_array($data)) {
                                $bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
                                
                            ?>
                                <tr bgcolor="<?php echo $bgcolor; ?>">
                                    <td class="details-control"></td>
                                    <td align="center">
                                        <div align="center" valign="center">
                                            <input type="checkbox" value="<?php echo $rowd['id']; ?>" class="form-check-input target-checked 
                                            <?php if ($_SESSION['lvl_idGkg'] != "LEADER") echo "disabled" ?>" <?php if ($_SESSION['lvl_idGkg'] != "LEADER") echo "disabled"; ?>>
                                        </div>
                                    </td>

                                    <td align="center">
                                        <?php echo $rowd['no_mesin'] . ' / ' . $rowd['no_urut']; ?> /
                                        <button class="btn btn-xs btn-info disabled" disabled><?php echo $rowd['status']; ?></button>
                                        <p></p>
                                        <li <?php if ($_SESSION['lvl_idGkg'] == "USER") echo "style='display:none;'"; ?>><a href="index1.php?p=schedule_edit_admin&id=<?php echo $rowd['id']; ?>" id='
                                                <?php echo $rowd['id']; ?>' style="color: black;" class="btn btn-xs btn-warning schedule_edit <?php if ($_SESSION['lvl_idGkg'] == "USER") echo " disabled"; ?>">
                                                <i class="fa fa-edit"></i>
                                            </a></li>
                                        <li <?php if ($_SESSION['lvl_idGkg'] == "USER") echo "style='display:none;'"; ?>>
                                            <button style="color: black;" class="btn btn-xs btn-danger _delete_task" data-id="<?php echo $rowd['id'] ?>" data="<?php echo $rowd['nokk']; ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </li>
                                    </td>

                                    <td><?php echo $rowd['langganan'] . "/" . $rowd['buyer']; ?></td>
                                    <td align="center"><?php echo $rowd['no_order']; ?></td>
                                    <td><?php echo $rowd['jenis_kain']; ?></td>
                                    <td align="center"><?php echo $rowd['warna']; ?></td>
                                    <td align="center"><?php echo $rowd['rol'] . $rowd['kk']; ?></td>
                                    <td align="center"><?php echo $rowd['bruto']; ?></td>
                                    <td align="center"><?php if($rowd['nodemand']!=""){echo $rowd['nodemand'];}else{echo $rowd['lot'];} ?><br/> <?php echo $rowd['nokk_legacy']; ?></td>
                                    <td align="center"><?php echo $rowd['tgl_delivery']; ?></td>
                                    <td><i><?php echo $rowd['nokk']; ?></i><br />
                                        <i style="color:red;"><strong><?php echo $rowd['catatan']; ?></strong></i><br />
                                        <a href="#" id='<?php echo $rowd['id']; ?>' class="detail_kartu"><span class="label label-danger"><?php echo $rowd['ket_kartu']; ?></span></a>
                                    </td>
                                    <td class="12"><?php echo  $rowd['no_gerobak1'] ?></td>
                                    <td class="13"><?php echo  $rowd['tgl_out1'] ?></td>
                                    <td class="14"><?php echo  $rowd['no_gerobak2'] ?></td>
                                    <td class="15"><?php echo  $rowd['tgl_out2'] ?></td>
                                    <td class="16"><?php echo  $rowd['no_gerobak3'] ?></td>
                                    <td class="17"><?php echo  $rowd['tgl_out3'] ?></td>
                                    <td class="18"><?php echo  $rowd['no_gerobak4'] ?></td>
                                    <td class="19"><?php echo  $rowd['tgl_out4'] ?></td>
                                    <td class="20"><?php echo  $rowd['no_gerobak5'] ?></td>
                                    <td class="21"><?php echo  $rowd['tgl_out5'] ?></td>
                                    <td class="22"><?php echo  $rowd['no_gerobak6'] ?></td>
                                    <td class="23"><?php echo  $rowd['tgl_out6'] ?></td>
                                    <td class="24"><?php echo  $rowd['no_gerobak7'] ?></td>
                                    <td class="25"><?php echo  $rowd['tgl_out7'] ?></td>
                                    <td class="26"><?php echo  $rowd['no_gerobak8'] ?></td>
                                    <td class="27"><?php echo  $rowd['tgl_out8'] ?></td>
                                    <td class="28"><?php echo  $rowd['id'] ?></td>
                                    <td class="29"><?php echo $rowd['create_time'] ?></td>
                                    <td class="30"><?php echo $rowd['tgl_mulai'] ?></td>
                                    <td class="31"><?php echo $rowd['tgl_update'] ?></td>
                                    <td class="32"><?php echo $rowd['tgl_stop'] ?></td>
                                    <td class="33"><?php echo $rowd['create_by'] ?></td>
                                    <td class="34"><?php echo $rowd['selesai_by'] ?></td>
                                    <td class="35"><?php echo $rowd['petugas_buka'] ?></td>
                                    <td class="36"> <span class="badge badge-dark"><?php echo $rowd['proses']; ?></span> /
                                        <span class="label label-info"><?php echo $rowd['dept_tujuan']; ?></span>
                                    </td>
                                    <td class="37"><?php echo $rowd['pic_schedule'] ?></td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                    </table>
                </div>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-block btn-success <?php if ($_SESSION['lvl_idGkg'] != "LEADER") {
                                                                echo " disabled";
                                                            } ?>" id="checkbox-submit" <?php if ($_SESSION['lvl_idGkg'] != "LEADER") {
                                                                                            echo ' disabled="true"';
                                                                                        } ?>)>Submit Checked Form
                </button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("._delete_task").click(function() {
                var nokk = $(this).attr('data');
                var id = $(this).attr('data-id');
                if (confirm('Are you sure, to delete task ' + nokk + ' ?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'pages/delete_task_on_leader_check.php',
                        data: {
                            nokk: nokk,
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            location.reload();
                        },
                        error: function() {
                            swal({
                                title: 'Error !',
                                text: 'Hubungi DIT secepatnya',
                                type: 'warning'
                            })
                        }
                    });
                } else {
                    console.log('Thing was not saved to the database.');
                }

            })
        })
    </script>
    <!-- Modal Popup untuk delete-->
    <div class="modal fade" id="delSchedule" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>

                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="del_link">Delete</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ScheduleEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#TableLeaderCheck').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "columnDefs": [{
                    "className": "text-center",
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 36, 37]
                },
                {
                    "targets": [10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35],
                    "visible": false
                },
                {
                    "targets": [0, 1, 2],
                    "orderable": false
                }
            ]
        });

        $('#TableLeaderCheck tbody').on('click', 'td.details-control', function() {
            var tr = $(this).parents('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row (the format() function would return the data to be shown)
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

        $('#TableLeaderCheck tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });

        function format(d) {
            return '<div class="col-md-12" style="background: #97aad4;">' +
                '<div class="container-fluid" style="margin-top: 5px">' +
                '<table class="table table-bordered table-striped"%">' +
                '<thead>' +
                '<tr style="background-color: blueviolet; border: 1px solid black;">' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Tanggal buat</th>' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Tanggal mulai</th>' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Tanggal update</th>' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Tanggal stop</th>' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Delivery</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '<tr style="border: 1px solid black;">' +
                '<td style="border: 1px solid black;">' + d[29] + ' (' + d[33] + ')</td>' +
                '<td style="border: 1px solid black;">' + d[30] + ' (' + d[35] + ')</td>' +
                '<td style="border: 1px solid black;">' + d[31] + '</td>' +
                '<td style="border: 1px solid black;">' + d[32] + ' (' + d[34] + ')</td>' +
                '<td style="border: 1px solid black;">' + d[10] + '</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '<hr class="divider">' +
                // 
                '<table class="table table-sm table-striped table-bordered" id="tablee"%" style="margin-top: 10px;">' +
                '<tbody>' +
                // 1
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 1 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[12] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 1 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[13] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk.php?id=' + d[28] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 1</a></td>' +
                '</tr>' +
                // 2
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 2 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[14] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 2 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[15] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk2.php?id=' + d[28] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 2</a></td>' +
                '</tr>' +
                // 3
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 3 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[16] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 3 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[17] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk3.php?id=' + d[28] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 3</a></td>' +
                '</tr>' +
                // 4
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 4 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[18] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 4 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[19] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk4.php?id=' + d[28] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 4</a></td>' +
                '</tr>' +
                // 5
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 5 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[20] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 5 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[21] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk5.php?id=' + d[28] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 5</a></td>' +
                '</tr>' +
                // 6
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 6 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[22] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 6 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[23] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk6.php?id=' + d[28] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 6</a></td>' +
                '</tr>' +
                // 7
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 7 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[24] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 7 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[25] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk7.php?id=' + d[28] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 7</a></td>' +
                '</tr>' +
                // 8
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 8 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[26] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 8 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[27] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk8.php?id=' + d[28] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 8</a></td>' +
                '</tr>' +
                // end here
                '</tbody>' +
                '</table>' +
                '</div>' +
                '</div>';
        }
        $('#checkall').click(function() {
            if ($(this).prop("checked") == true) {
                $('table tbody tr td div input.form-check-input.target-checked').prop('checked', true)
            } else {
                $('table tbody tr td div input.form-check-input.target-checked').prop('checked', false)
            }
        });

        $('#checkbox-submit').click(function() {
            $(this).prop('disabled', true);
            if ($('input[type=checkbox]:checked').length == 0) {
                swal({
                    title: 'Belum ada schedule terpilih !',
                    text: 'Silahkan pilih sebelum submit',
                    type: 'warning'
                })
                $(this).prop('disabled', false);
            } else {
                $('.form-check-input.target-checked[type=checkbox]:checked').each(function(index) {
                    $.ajax({
                        type: 'POST',
                        url: 'pages/input_leader_check.php',
                        data: {
                            id: $(this).val(),
                            nama: '<?php echo $_SESSION['nama1Gkg'] ?>',
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response.id)
                        },
                        error: function() {
                            swal({
                                title: 'Error !',
                                text: 'Hubungi DIT secepatnya',
                                type: 'warning'
                            })
                        }
                    });
                });
            }
            setTimeout(function() {
                location.reload();
            }, 1000);
        });
    });
</script>