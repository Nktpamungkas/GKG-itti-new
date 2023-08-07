<?php 
ini_set("error_reporting", 1);
session_start();
include_once ('koneksi.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stoppage Mesin</title>

</head>
<body>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Input Data Stoppage Machine</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="col-md-6">
                <?php if ($_SESSION['lvl_idGkg'] == 'ADMIN' or $_SESSION['lvl_idGkg'] == 'LEADER') { ?>
					<div class="form-group">
						<!-- <label for="operator" class="col-sm-3 control-label">Operator</label>
						<div class="col-sm-5">
							<input type="text" name="operator" id="operator" required class="form-control" placeholder="-Nama Operator-" style="text-transform: uppercase;">
						</div> -->
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
						<label for="operator" class="col-sm-3 control-label">Operator</label>
						<div class="col-sm-5">
							<input name="operator" id="operator" class="form-control" value="<?php echo $_SESSION['usridGkg'] ?>" readonly>
						</div>
					</div>
				<?php } ?>
                <div class="form-group">
					<label for="g_shift" class="col-sm-3 control-label">Group Shift</label>
					<div class="col-sm-2">
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
					<div class="col-sm-2">
						<select name="shift" class="form-control" required>
							<option value="">-Pilih-</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>
				</div>
                <div class="form-group">
					<label for="jenis_mesin" class="col-sm-3 control-label">Jenis Mesin</label>
					<div class="col-sm-3">
						<select name="jenis_mesin" class="form-control" id="jenis_mesin" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlJM = mysqli_query($con,"SELECT DISTINCT jenis_mesin FROM tbl_mesin_gkg ORDER BY jenis_mesin ASC");
							while ($rJM = mysqli_fetch_array($sqlJM)) {
							?>
								<option value="<?php echo $rJM['jenis_mesin']; ?>"><?php echo $rJM['jenis_mesin']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
                <div class="form-group">
					<label for="nama_mesin" class="col-sm-3 control-label">Nama Mesin</label>
					<div class="col-sm-3">
						<select name="nama_mesin" class="form-control" id="nama_mesin" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlNM = mysqli_query($con,"SELECT nama_mesin FROM tbl_mesin_gkg ORDER BY nama_mesin ASC");
							while ($rNM = mysqli_fetch_array($sqlNM)) {
							?>
								<option value="<?php echo $rNM['nama_mesin']; ?>"><?php echo $rNM['nama_mesin']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
                <div class="form-group">
                    <label for="tgl_mulai" class="col-sm-3 control-label">Tgl Mulai Stop Mesin</label>
                    <div class="col-sm-4">
                        <div class="input-group date">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                            <input name="tgl_mulai" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Mulai"  autocomplete="off" required/>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input type="text" class="form-control jam_mulai" name="jam_mulai" placeholder="00:00" autocomplete="off" required>
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl_stop" class="col-sm-3 control-label">Tgl Selesai Stop Mesin</label>
                    <div class="col-sm-4">
                        <div class="input-group date">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                            <input name="tgl_stop" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Selesai"  autocomplete="off" required/>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input type="text" class="form-control jam_mulai" name="jam_stop" placeholder="00:00" autocomplete="off" required>
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
					<label for="kode_stop" class="col-sm-3 control-label">Kode Stop</label>
					<div class="col-sm-5">
						<select name="kode_stop" class="form-control" id="kode_stop" required>
							<option value="">-Pilih-</option>
							<?php
							$sqlKD = mysqli_query($con,"SELECT kode FROM tbl_stop_mesin ORDER BY id ASC");
							while ($rKD = mysqli_fetch_array($sqlKD)) {
							?>
								<option value="<?php echo $rKD['kode']; ?>"><?php echo $rKD['kode']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div> 
            </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary pull-right" name="save" value="save">Simpan <i class="fa fa-save"></i></button>
        </div>
        <!-- /.box-footer -->
	</div>
</form>
</body>
</html>
<?php
if ($_POST['save'] == "save") {
    if(strlen($_POST['jam_mulai'])==5){
        $jamMulai = $_POST['jam_mulai'];
    }else{
        $jamMulai = '0'.$_POST['jam_mulai'];
    }
    if(strlen($_POST['jam_stop'])==5){
        $jamStop = $_POST['jam_stop'];
    }else{
        $jamStop = '0'.$_POST['jam_stop'];
    }
    $operator = strtoupper($_POST['operator']);
    $sqlData=mysqli_query($con,"INSERT INTO tbl_stoppage_mc SET
        g_shift     ='$_POST[g_shift]',
        shift       ='$_POST[shift]',
        jenis_mesin ='$_POST[jenis_mesin]',
        nama_mesin  ='$_POST[nama_mesin]',
        operator    ='$operator',
        tgl_mulai   ='$_POST[tgl_mulai]',
        tgl_stop    ='$_POST[tgl_stop]',
        jam_mulai   ='$jamMulai',
        jam_stop    ='$jamStop',
        kode_stop   ='$_POST[kode_stop]',
        tgl_buat    =now(),
        tgl_update  =now()
    ");

    if($sqlData){
        echo "<script>swal({
    title: 'Data Tersimpan',   
    text: 'Klik Ok untuk input data kembali',
    type: 'success',
    }).then((result) => {
    if (result.value) {
    window.location.href='StoppageMC';

    }
    });</script>";
    }
}
?>