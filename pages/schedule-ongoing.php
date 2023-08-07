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

<body>
    <?php
    $data = mysqli_query($con,"SELECT
   	id,
    nodemand,
	no_mesin,
	no_urut,
	buyer,
	langganan,
	no_order,
	nokk,
	jenis_kain,
	warna,
	no_warna,
    dept_tujuan,
    proses,
	sum(rol) as rol,
	sum(bruto) as bruto,
	proses,
	`status`,
	lot,
	catatan,
    nokk_legacy,
	ket_status,
	tgl_delivery
FROM
	tbl_schedule 
WHERE
	STATUS = 'sedang jalan' and petugas_buka = '$_SESSION[usridGkg]'
GROUP BY
	no_mesin,
	no_urut 
ORDER BY
	no_mesin ASC,no_urut ASC");
    $no = 1;
    $n = 1;
    $c = 0;
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <!-- <a href="pages/cetak/cetak_schedule.php" class="btn btn-danger pull-right" target="_blank"><i class="fa fa-print"></i> Cetak</a> -->
                    <!--<a href="#" data-toggle="modal" data-target="#PrintHalaman" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Cetak</a>-->
                </div>
                <div class="box-body">
                    <table id="tableongoing" class="table table-bordered table-hover table-striped" width="100%">
                        <thead class="bg-blue">
                            <tr>
                                <th width="20">No.</th>
                                <th width="24">Mesin/Urut</th>
                                <th width="162">Pelanggan</th>
                                <th width="118"> No. Order</th>
                                <th width="180">Item</th>
                                <th width="86">Warna</th>
                                <th width="46">Rol</th>
                                <th width="48">Kg</th>
                                <th width="38">Prod. Demand</th>
                                <th>Delivery</th>
                                <th>Procs/To</th>
                                <th width="79">Prod. Order</t>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $col = 0;
                            $no = 1;
                            while ($rowd = mysqli_fetch_array($data)) {
                                $bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
                                // $qCek = mysqli_query($con,"SELECT `status` FROM tbl_fin_oven WHERE id_schedule='$rowd[id]' LIMIT 1");
                                // $rCEk = mysqli_fetch_array($qCek);
                            ?>
                                <tr bgcolor="<?php echo $bgcolor; ?>">
                                    <td align="center"><?php echo $no; ?></td>
                                    <td align="center"><?php echo $rowd['no_mesin']; ?>/<?php echo $rowd['no_urut']; ?>
                                        <li style="margin-top: 2px;">
                                            <a href="#" id='<?php echo $rowd['id']; ?>' class="btn btn-xs btn-danger mesin_berhenti_edit"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                Gerobak</a>
                                        </li>
                                        <li style="margin-top: 3px;">
                                            <button class="btn btn-success btn-xs stop_mesin" attribute="<?php echo $rowd['id']; ?>"><i class="fa fa-ban" aria-hidden="true"></i> |
                                                Stop</button>
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
                                    <td align="center">
                                        <span class="badge bg-warning"><?php echo $rowd['proses'] ?></span> /
                                        <span class="label label-info"><?php echo $rowd['dept_tujuan'] ?></span>
                                    </td>
                                    <td><i><?php echo $rowd['nokk']; ?></i><br />
                                        <i style="color:red;"><strong><?php echo $rowd['catatan']; ?></strong></i><br />
                                        <a href="#" id='<?php echo $rowd['id']; ?>' class="detail_kartu"><span class="label label-danger"><?php echo $rowd['ket_kartu']; ?></span></a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="ScheduleEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>
    <div id="MesinStop" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>
    <div id="MesinBerhentiEdit" class="modal fade modal-3d-slit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>
    <div id="EditStatusMesin" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>
    <div id="GerobakTambah" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>
    <div id="DetailKartu" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableongoing').DataTable({
            'scrollX': true,
            'scrollY': true,
            'paging': true,
            responsive: true,
            fixedHeader: true
        })
        // $(".modal").on("hidden.bs.modal", function() {
        //     $("#MesinBerhentiEdit").empty();
        //     location.reload()
        // });
    })
    $(document).on('click', '.stop_mesin', function(e) {
        var m = $(this).attr("attribute");
        $.ajax({
            url: "pages/mesin_stop_edit.php",
            type: "GET",
            data: {
                id: m,
            },
            success: function(ajaxData) {
                $("#MesinStop").html(ajaxData);
                $("#MesinStop").modal('show', {
                    backdrop: 'static',
                    keyboard: 'false',
                });
            }
        });
    });

    function confirm_del(delete_url) {
        $('#delSchedule').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('del_link').setAttribute('href', delete_url);
    }
</script>