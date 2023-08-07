<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
?>
<?php
$Awal  = isset($_POST['awal']) ? $_POST['awal'] : '';
$NoMC   = isset($_POST['no_mc']) ? $_POST['no_mc'] : '';
$Gshft   = isset($_POST['g_shift']) ? $_POST['g_shift'] : '';
$now = date("Y-m-d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Schedule</title>
</head>

<body>
  <?php
  $data = mysqli_query($con, "SELECT
   	id,
	g_shift,
	no_mesin,
	no_urut,
	buyer,
  `status`,
	langganan,
	no_order,
	nokk,
  nodemand,
	jenis_kain,
  pic_schedule,
	warna,
	lot,
	no_warna,
	sum(rol) as rol,
	sum(bruto) as bruto,
	proses,
  dept_tujuan,
	catatan,
	ket_status,
  nokk_legacy,
	tgl_delivery,
  jenis_kk,
	tgl_update
FROM
	tbl_schedule 
WHERE `status` = 'antri mesin'
GROUP BY
	id 
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
          <a href="FormSchedule" class="btn <?php if ($_SESSION['lvl_idGkg'] == 'USER') {
                                              echo "btn-primary";
                                            } else {
                                              echo 'btn-success';
                                            } ?>"><i class="fa fa-plus-circle"></i> Tambah </a>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover table-striped" width="100%">
              <thead class="bg-blue">
                <tr>
                  <th width="115">
                    <div align="center">Shift</div>
                  </th>
                  <th width="45">
                    <div align="center">Mesin</div>
                  </th>
                  <th width="24">
                    <div align="center">PIC\No.</div>
                  </th>
                  <th width="162">
                    <div align="center">Pelanggan</div>
                  </th>
                  <th width="118">
                    <div align="center">No. Order</div>
                  </th>
                  <th width="122">
                    <div align="center">Jenis Kain</div>
                  </th>
                  <th width="86">
                    <div align="center">Warna</div>
                  </th>
                  <th width="83">
                    <div align="center">No Warna</div>
                  </th>
                  <th width="38">
                    <div align="center">No Demand</div>
                  </th>
                  <th width="79">
                    <div align="center">Production Order</div>
                  </th>
                  <th width="46">
                    <div align="center">Rol</div>
                  </th>
                  <th width="48">
                    <div align="center">Kg</div>
                  </th>
                  <th width="59">
                    <div align="center">Procs/To</div>
                  </th>
                  <th>
                    <div align="center">Delivery</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $col = 0;
                while ($rowd = mysqli_fetch_array($data)) {
                  $bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
                  $qCek = mysqli_query($con, "SELECT `status` FROM tbl_produksi WHERE id_schedule='$rowd[id]' LIMIT 1");
                  $rCEk = mysqli_fetch_array($qCek);
                ?>
                  <div class="modal fade modal-super-scaled" id="PrintHalaman<?php echo $rowd['id']; ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Cetak Identifikasi Produk</h4>
                          </div>
                          <div class="modal-body" align="center">
                            <a href="pages/cetak/iden_produk1.php?idkk=<?php echo $rowd['id']; ?>" class="btn btn-danger" target="_blank"><i class="fa fa-print"></i> Gerobak ke-1</a>
                            <a href="pages/cetak/iden_produk2.php?idkk=<?php echo $rowd['id']; ?>" class="btn btn-danger" target="_blank"><i class="fa fa-print"></i> Gerobak ke-2</a><br><br>
                            <a href="pages/cetak/iden_produk3.php?idkk=<?php echo $rowd['id']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Gerobak ke-3</a>
                            <a href="pages/cetak/iden_produk4.php?idkk=<?php echo $rowd['id']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Gerobak ke-4</a><br><br>
                            <a href="pages/cetak/iden_produk5.php?idkk=<?php echo $rowd['id']; ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Gerobak ke-5</a>
                            <a href="pages/cetak/iden_produk6.php?idkk=<?php echo $rowd['id']; ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Gerobak ke-6</a>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <tr bgcolor="<?php echo $bgcolor; ?>">

                    <td align="center">
                      <font size="-1"><?php echo $rowd['g_shift']; ?><br>
                        <div class="btn-group">
                          <a href="index1.php?p=schedule_edit_admin&id=<?php echo $rowd['id']; ?>" id='
                          <?php echo $rowd['id']; ?>' class="btn btn-xs btn-info schedule_edit <?php if ($_SESSION['nama1Gkg'] != "GKG-LEADER") echo " disabled"; ?>">
                            <i class="fa fa-edit"></i>
                          </a>
                          <a href="#" onclick="confirm_del('HapusSch-<?php echo $rowd['id'] ?>');" class="btn btn-xs btn-danger <?php if ($_SESSION['nama1Gkg'] != "GKG-LEADER") echo " disabled"; ?>">
                            <i class=" fa fa-trash"><?php echo $rCEk['status'] ?></i>
                          </a>
                        </div>
                      </font>
                    </td>

                    <td align="center">
                      <font size="-1"><a href="#" id='
                        <?php echo $rowd['no_mesin'] . "-" . $rowd['g_shift'];
                        ?>' class="edit_status_mesin <?php if ($_SESSION['lvl_idGkg'] == "USER") echo " disabled"; ?>">
                          <?php echo $rowd['no_mesin']; ?>
                        </a></font>
                    </td>
                    <td align="center">
                      <font size="-1"><?php echo $rowd['pic_schedule']; ?>/<?php echo $rowd['no_urut']; ?>/
                        <a href="#" id='<?php echo $rowd['id']; ?>' class="btn btn-xs btn-warning mesin_mulai_edit <?php if ($_SESSION['lvl_idGkg'] == 'ADMIN') echo " disabled"; ?>">mulai
                        </a>
                    </td>
                    <td>
                      <font size="-1"><?php echo $rowd['langganan'] . "/" . $rowd['buyer']; ?></font>
                    </td>
                    <td align="center">
                      <font size="-1"><?php echo $rowd['no_order']; ?></font>
                    </td>
                    <td>
                      <font size="-1"><?php echo $rowd['jenis_kain']; ?></font>
                    </td>
                    <td align="center">
                      <font size="-1"><?php echo $rowd['warna']; ?></font>
                    </td>
                    <td align="center">
                      <font size="-1"><?php echo $rowd['no_warna']; ?></font>
                    </td>
                    <td align="center">
                      <font size="-1"><?php if ($rowd['nodemand'] != "") : ?>
                                        <a target="_BLANK" href="http://10.0.0.10/laporan/ppc_filter_steps.php?demand=<?= $rowd['nodemand']; ?>&prod_order=<?= $rowd['nokk']; ?>">`<?= $rowd['nodemand']; ?></a>
                                      <?php else : ?>
                                        <?= $rowd['lot']; ?>
                                      <?php endif;?>
                                      <br /> 
                                      <a href="#" class="posisi_kk" id="<?php echo $rowd['nokk_legacy']; ?>"><?php echo $rowd['nokk_legacy']; ?></a> <br /> 
                                      <?php if ($rowd['jenis_kk'] != "") { echo $rowd['jenis_kk']; } ?>
                        </font>
                    </td>
                    <td>
                      <font size="-1"><i><?php echo $rowd['nokk']; ?></i><br />
                        <i style="color:red;"><strong><?php echo $rowd['catatan']; ?></strong></i><br />
                        <a href="#" id='<?php echo $rowd['id']; ?>' class="detail_kartu"><span class="label label-danger"><?php echo $rowd['ket_kartu']; ?></span></a><?php echo $rowd['tgl_update']; ?>
                      </font>
                    </td>
                    <td align="center">
                      <font size="-1"><?php echo $rowd['rol'] . $rowd['kk']; ?></font>
                    </td>
                    <td align="center">
                      <font size="-1"><?php echo $rowd['bruto']; ?></font>
                    </td>
                    <td>
                      <span class="badge badge-dark"><?php echo $rowd['proses']; ?></span> /
                      <span class="label label-info"><?php echo $rowd['dept_tujuan']; ?></span>
                    </td>
                    <td align="center">
                      <font size="-1"><?php echo $rowd['tgl_delivery']; ?></font>
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
  </div>
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
  <div id="MesinMulaiEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  </div>
  <div id="MesinBerhentiEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  </div>
  <div id="EditStatusMesin" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  </div>
  <div id="GerobakTambah" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  </div>
  <div id="DetailKartu" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  </div>
  <div id="PosisiKK" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
</body>

</html>
<script type="text/javascript">
  function confirm_del(delete_url) {
    $('#delSchedule').modal('show', {
      backdrop: 'static'
    });
    document.getElementById('del_link').setAttribute('href', delete_url);
  }
</script>