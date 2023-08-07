<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id = $_GET['id'];

$querycek_gerobak = mysqli_query($con,"SELECT id_schedule from tbl_gerobak where id_schedule = '$modal_id'");
$querycek = mysqli_num_rows($querycek_gerobak);
if ($querycek > 0) {
    $modal = mysqli_query($con,"SELECT * FROM `tbl_schedule` WHERE id='$modal_id' ");
    while ($r = mysqli_fetch_array($modal)) {
?>
        <div class="modal-dialog modal1 modal-sm">
            <div class="modal-content">
                <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="EditMesinBerhenti" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">GKG-ITTI STOP SCHEDULE</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id" value="<?php echo $r['id']; ?>">
                        <input type="hidden" id="personil" name="personil" value="<?php echo $_SESSION['deptGkg']; ?>">
                        <input type="hidden" id="selesai_by" name="selesai_by" value="<?php echo $_SESSION['nama1Gkg']; ?>">
                        <div align="center">STOP Schedule ?</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    <?php }
} else { ?>
    <div class="modal-dialog modal1 modal-sm">
        <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="EditMesinBerhenti" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">GKG-ITTI STOP SCHEDULE</h4>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <span style="color: red;">
                            <h1><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            </h1>
                        </span>
                        <h3>Ubah status ke selesai ?</h3>
                        <h4>Harap isi data gerobak !</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    </div>
    </script>
<?php } ?>