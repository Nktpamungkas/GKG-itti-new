<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
function cekDesimal($angka)
{
    $bulat = round($angka);
    if ($bulat > $angka) {
        $jam = $bulat - 1;
        $waktu = $jam . ":30";
    } else {
        $jam = $bulat;
        $waktu = $jam . ":00";
    }
    return $waktu;
}
if ($_POST['submit']) {
    $sqlupdate = mysqli_query($con,"UPDATE `tbl_schedule` SET 
				`no_mesin`='$_POST[no_mc]',
				`g_shift`='$_POST[g_shift]',
				`shift`='$_POST[shift]',
				`no_urut`='$_POST[no_urut]',
				`no_sch`='$_POST[no_urut]',
				`proses`='$_POST[proses]',
				`catatan`='$_POST[catatan]',
				`pic_schedule`='$_POST[personil]',
				`dept_tujuan`='$_POST[dept_tujuan]',
				`buka`='$_POST[buka]',
                `edit_time`=now(),
                `edit_by`= '$_SESSION[nama1Gkg]'
                WHERE `id`='$id'");
    $sqlupdate;
    echo " <script>window.location='NeedLeaderCheck';</script>";
}
?>
<?php
$lis = mysqli_query($con,"SELECT * from tbl_schedule where id = '$_GET[id]' LIMIT 1");
$list = mysqli_fetch_array($lis);
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">EDIT Data Schedule</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="bg-danger" style="border:1px solid black">
                <th style="text-align: center; border:1px solid black">NO. KK</th>
                <th style="text-align: center; border:1px solid black">BUYER(LANGGANAN)</th>
                <th style="text-align: center; border:1px solid black">No. Order</th>
                <th style="text-align: center; border:1px solid black">PO</th>
                <th style="text-align: center; border:1px solid black">No. Hanger</th>
                <th style="text-align: center; border:1px solid black">Kd. item</th>
                <th style="text-align: center; border:1px solid black" width="20%">Jenis kain</th>
                <th style="text-align: center; border:1px solid black">Qty Order(Panjang)</th>
                <th style="text-align: center; border:1px solid black">Lot - Rol - Bruto</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border:1px solid black">
                <td style="border:1px solid black"><?php echo $list['nokk'] ?></td>
                <td style="border:1px solid black"><?php echo $list['buyer'] . '(' . $list['langganan'] . ')' ?></td>
                <td style="border:1px solid black"><?php echo $list['no_order'] ?></td>
                <td style="border:1px solid black"><?php echo $list['po'] ?></td>
                <td style="border:1px solid black"><?php echo $list['no_hanger'] ?></td>
                <td style="border:1px solid black"><?php echo $list['no_item'] ?></td>
                <td style="border:1px solid black"><?php echo $list['jenis_kain'] ?></td>
                <td style="border:1px solid black"><?php echo $list['qty_order'] . " (" . $list['pjng_order'] . ' ' . $list['satuan_order'] . ')' ?></td>
                <td style="border:1px solid black"><?php echo $list['lot'] . ' - ' . $list['rol'] . ' - ' . $list['bruto'] ?></td>
            </tr>
        </tbody>
    </table>
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1">
        <div class="box-body">
            <input type="hidden" value="<?php echo $_GET['id']; ?>">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_mc" class="col-sm-3 control-label">No MC</label>
                    <div class="col-sm-3">
                        <select name="no_mc" class="form-control" id="no_mc" required>
                            <option value="">Pilih</option>
                            <?php
                            $sqlKap = mysqli_query($con,"SELECT no_mesin FROM tbl_no_mesin ORDER BY no_mesin ASC");
                            while ($rK = mysqli_fetch_array($sqlKap)) {
                            ?>

                                <option <?php if ($list['no_mesin'] == $rK['no_mesin']) echo "selected"; ?> value="<?php echo $rK['no_mesin']; ?>"><?php echo $rK['no_mesin']; ?> </option>

                            <?php } ?>

                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="no_urut" class="col-sm-3 control-label">No Urut</label>
                    <div class="col-sm-2">
                        <select name="no_urut" class="form-control" id="no_urut" required>
                            <option value="">Pilih</option>
                            <?php
                            $sqlKap = mysqli_query($con,"SELECT no_urut FROM tbl_urut ORDER BY no_urut ASC");
                            while ($rK = mysqli_fetch_array($sqlKap)) {
                            ?>
                                <option <?php if ($list['no_urut'] == $rK['no_urut']) echo "selected"; ?> value="<?php echo $rK['no_urut']; ?>"><?php echo $rK['no_urut']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="g_shift" class="col-sm-3 control-label">Group Shift</label>
                    <div class="col-sm-2">
                        <select name="g_shift" class="form-control" required>
                            <option value="">Pilih</option>
                            <option <?php if ($list['g_shift'] == 'A') echo "selected"; ?> value="A">A</option>
                            <option <?php if ($list['g_shift'] == 'B') echo "selected"; ?> value="B">B</option>
                            <option <?php if ($list['g_shift'] == 'C') echo "selected"; ?> value="C">C</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="shift" class="col-sm-3 control-label">Waktu Shift</label>
                    <div class="col-sm-2">
                        <select name="shift" class="form-control" required>
                            <option value="">Pilih</option>
                            <option <?php if ($list['shift'] == 1) echo "selected"; ?> value="1">1</option>
                            <option <?php if ($list['shift'] == 2) echo "selected"; ?> value="2">2</option>
                            <option <?php if ($list['shift'] == 3) echo "selected"; ?> value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="proses" class="col-sm-3 control-label">Proses</label>
                    <div class="col-sm-5">
                        <select name="proses" class="form-control" id="proses" onChange="cekpro(); cekpro1(); cekpro2(); aktif_staff();" required>
                            <option value="">Pilih</option>
                            <?php
                            $sqlKap = mysqli_query($con,"SELECT proses FROM tbl_proses ORDER BY id ASC");
                            while ($rK = mysqli_fetch_array($sqlKap)) {
                            ?>
                                <option <?php if ($list['proses'] == $rK['proses']) echo "selected" ?> value="<?php echo $rK['proses']; ?>"><?php echo $rK['proses']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="buka" class="col-sm-3 control-label">Buka</label>
                    <div class="col-sm-3">
                        <select name="buka" class="form-control" id="buka" required>
                            <option disabled>Pilih</option>
                            <option <?php if ($list['buka'] == "Biasa") echo "selected" ?> value="Biasa">Biasa</option>
                            <option <?php if ($list['buka'] == "Balik") echo "selected" ?> value="Balik">Balik</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="personil" class="col-sm-3 control-label">Personil</label>
                    <div class="col-sm-5">
                        <input name="personil" type="text" class="form-control" id="personil" value="<?php echo $list['pic_schedule'] ?>" placeholder="personil">
                    </div>

                </div>
                <div class="form-group">
                    <label for="tujuan" class="col-sm-3 control-label">Tujuan</label>
                    <div class="col-sm-5">
                        <select name="dept_tujuan" required class="form-control">
                            <option selected disabled>Pilih ...</option>
                            <option <?php if ($list['dept_tujuan'] == "GKG") echo "selected" ?> value="GKG">GKG</option>
                            <option <?php if ($list['dept_tujuan'] == "LAB") echo "selected" ?> value="LAB">LAB</option>
                            <option <?php if ($list['dept_tujuan'] == "DYE") echo "selected" ?> value="LAB">DYE</option>
                            <option <?php if ($list['dept_tujuan'] == "BRS") echo "selected" ?> value="BRS">BRS</option>
                            <option <?php if ($list['dept_tujuan'] == "FIN") echo "selected" ?> value="FIN">FIN</option>
                            <option <?php if ($list['dept_tujuan'] == "PRT") echo "selected" ?> value="PRT">PRT</option>
                            <option <?php if ($list['dept_tujuan'] == "QCF") echo "selected" ?> value="QCF">QCF</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="catatan" class="col-sm-3 control-label">Catatan</label>
                    <div class="col-sm-8">
                        <textarea name="catatan" class="form-control" id="catatan" placeholder="catatan..."><?php echo $list['catatan'] ?></textarea>
                    </div>

                </div>
            </div>
            <input type="hidden" value="<?php if ($cek > 0) {
                                            echo $rcek['no_ko'];
                                        } else {
                                            echo $rKO['KONo'];
                                        } ?>" name="no_ko">
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-default pull-left" name="back" value="kembali" onClick="window.location='Schedule'">Kembali <i class="fa fa-arrow-circle-o-left"></i></button>

            <button type="submit" class="btn btn-primary pull-right" name="submit" value="submit">Simpan <i class="fa fa-save"></i></button>
        </div>
</div>
</form>