<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id = $_GET['id'];
$modal = mysqli_query($con,"SELECT * FROM `tbl_schedule` WHERE id='$modal_id' ");
while ($r = mysqli_fetch_array($modal)) {
?>

  <div class="modal-dialog modal1 modal-md">
    <div class="modal-content">
      <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="EditMesinMulai" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">GKG-ITTI</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id" name="id" value="<?php echo $r['id']; ?>">
          <input type="hidden" id="personil" name="personil" value="<?php echo $_SESSION['nama1Gkg']; ?>">
          <!-- <div align="center">Mulai Schedule ?</div>
        </div> -->
        <div class="form-group">
					<label for="g_shift" class="col-sm-3 control-label">Group Shift</label>
					<div class="col-sm-4">
						<select name="g_shift" class="form-control" required>
							<option value="">-Pilih-</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</div>
				</div>
        <div class="form-group">
					<label for="shift" class="col-sm-3 control-label">Waktu Shift</label>
					<div class="col-sm-4">
						<select name="shift" class="form-control" required>
							<option value="">-Pilih-</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="proses" class="col-sm-3 control-label">Proses</label>
					<div class="col-sm-5">
						<select name="proses" class="form-control" id="proses" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlKap = mysqli_query($con,"SELECT proses FROM tbl_proses ORDER BY id ASC");
							while ($rK = mysqli_fetch_array($sqlKap)) {
							?>
								<option value="<?php echo $rK['proses']; ?>"><?php echo $rK['proses']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
        <div class="form-group">
					<label for="buka" class="col-sm-3 control-label">Buka/Balik</label>
					<div class="col-sm-3">
						<select name="buka" class="form-control" id="buka" required>
							<option value="">-Pilih-</option>
							<option value="Biasa">Buka</option>
							<option value="Balik">Balik</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="no_mc" class="col-sm-3 control-label">No MC</label>
					<div class="col-sm-5">
						<select name="no_mc" class="form-control" id="no_mc" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlKap = mysqli_query($con,"SELECT no_mesin FROM tbl_no_mesin where `status` = 'Normal' ORDER BY no_mesin ASC");
							while ($rK = mysqli_fetch_array($sqlKap)) {
							?>
								<option value="<?php echo $rK['no_mesin']; ?>"><?php echo $rK['no_mesin']; ?></option>
							<?php } ?>

						</select>
					</div>

				</div>
				<div class="form-group">
					<label for="no_urut" class="col-sm-3 control-label">No Urut</label>
					<div class="col-sm-4">
						<select name="no_urut" class="form-control" id="no_urut" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlKap = mysqli_query($con,"SELECT no_urut FROM tbl_urut ORDER BY no_urut ASC");
							while ($rK = mysqli_fetch_array($sqlKap)) {
							?>
								<option value="<?php echo $rK['no_urut']; ?>"><?php echo $rK['no_urut']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
        <!-- <div class="form-group" style="display: none;">
					<label for="personil" class="col-sm-3 control-label">Personil</label>
					<div class="col-sm-5">
						<input name="personil" type="text" class="form-control" id="personil" value="<?php echo $_SESSION['nama1Gkg']; ?>" placeholder="personil" readonly>
					</div>
				</div> -->
        <?php if ($_SESSION['lvl_idGkg'] == 'ADMIN' or $_SESSION['lvl_idGkg'] == 'LEADER') { ?>
					<div class="form-group">
						<label for="operator" class="col-sm-3 control-label">Operator</label>
						<div class="col-sm-5">
							<select name="operator" class="form-control" id="operator" required>
								<option value="">-Pilih-</option>
								<?php
								$sqlNO = mysqli_query($con,"SELECT DISTINCT nama FROM tbl_user WHERE `status`='Aktif' ORDER BY nama ASC");
								while ($rNO = mysqli_fetch_array($sqlNO)) {
								?>
									<option value="<?php echo $rNO['nama']; ?>"><?php echo $rNO['nama']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label for="personil" class="col-sm-3 control-label">Operator</label>
						<div class="col-sm-5">
							<input name="operator" id="operator" class="form-control" value="<?php echo $_SESSION['usridGkg'] ?>" readonly>
						</div>
					</div>
				<?php } ?>
        <div class="form-group">
					<label for="personil" class="col-sm-3 control-label">Tujuan</label>
					<div class="col-sm-5">
						<select name="dept_tujuan" required class="form-control select2">
							<option selected disabled>-Pilih-</option>
							<?php
							$sql_dept = mysqli_query($con,"SELECT * from tbl_departement where is_active = 'TRUE' ");
							while ($li = mysqli_fetch_array($sql_dept)) {
							?>
								<option value="<?php echo $li['acronym'] ?>"><?php echo $li['acronym'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
        <div class="form-group">
					<label for="catatan" class="col-sm-3 control-label">Catatan</label>
					<div class="col-sm-8">
						<textarea name="catatan" class="form-control" id="catatan" placeholder="Catatan...."><?php echo $r['catatan'] ?></textarea>
					</div>

				</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Mulai & Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
<?php } ?>