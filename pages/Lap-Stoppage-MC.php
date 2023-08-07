<?PHP
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Stoppage Mesin</title>

</head>
<body>
<?php
$Awal	    = isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	    = isset($_POST['akhir']) ? $_POST['akhir'] : '';
$JenisMC	= isset($_POST['jenis_mesin']) ? $_POST['jenis_mesin'] : '';
$NamaMC	    = isset($_POST['nama_mesin']) ? $_POST['nama_mesin'] : '';
$GShift	    = isset($_POST['g_shift']) ? $_POST['g_shift'] : '';	
?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> Filter Laporan Stoppage Mesin</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
    <div class="box-body">
      <div class="form-group">
        <label for="awal" class="col-sm-1 control-label">Tanggal Awal</label>
        <div class="col-sm-2">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="awal" type="date" class="form-control pull-right" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off"/>
          </div>
        </div>
        </div>
        <div class="form-group">
        <label for="akhir" class="col-sm-1 control-label">Tanggal Akhir</label>
        <div class="col-sm-2">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="akhir" type="date" class="form-control pull-right" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off"/>
          </div>
        </div>
        <!-- /.input group -->
      </div>
        <div class="form-group">
			<label for="jenis_mesin" class="col-sm-1 control-label">Jenis Mesin</label>
			<div class="col-sm-2">
				<select name="jenis_mesin" class="form-control" id="jenis_mesin" required>
					<option value="">-Pilih-</option>
					<?php
					    $sqlJM = mysqli_query($con,"SELECT DISTINCT jenis_mesin FROM tbl_mesin_gkg ORDER BY jenis_mesin ASC");
					    while ($rJM = mysqli_fetch_array($sqlJM)) {
					?>
					<option value="<?php echo $rJM['jenis_mesin']; ?>" <?php if($JenisMC==$rJM['jenis_mesin']){ echo "SELECTED";}?>><?php echo $rJM['jenis_mesin']; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
        <div class="form-group">
			<label for="nama_mesin" class="col-sm-1 control-label">Nama Mesin</label>
			<div class="col-sm-2">
				<select name="nama_mesin" class="form-control" id="nama_mesin" required>
					<option value="">-Pilih-</option>
					<?php
						$sqlNM = mysqli_query($con,"SELECT nama_mesin FROM tbl_mesin_gkg ORDER BY nama_mesin ASC");
						while ($rNM = mysqli_fetch_array($sqlNM)) {
					?>
					<option value="<?php echo $rNM['nama_mesin']; ?>" <?php if($NamaMC==$rNM['nama_mesin']){ echo "SELECTED";}?>><?php echo $rNM['nama_mesin']; ?></option>
					<?php } ?>
			    </select>
			</div>
		</div>
        <div class="form-group">
			<label for="g_shift" class="col-sm-1 control-label">Group Shift</label>
			<div class="col-sm-1">
				<select name="g_shift" class="form-control" required>
					<option value="ALL">ALL</option>
					<option value="A" <?php if($GShift=="A"){ echo "SELECTED";}?>>A</option>
					<option value="B" <?php if($GShift=="B"){ echo "SELECTED";}?>>B</option>
					<option value="C" <?php if($GShift=="C"){ echo "SELECTED";}?>>C</option>
				</select>
			</div>
		</div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-2">
        <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="save" style="width: 60%">Search <i class="fa fa-search"></i></button>
      </div>
    </div>
    <!-- /.box-footer -->
  </form>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
            <h3 class="box-title">Data Stoppage Mesin</h3><br>
            <?php if($_POST['awal']!="") { ?><b>Periode: <?php echo $_POST['awal']." to ".$_POST['akhir']; ?></b>
            <?php } ?>
            <div class="pull-right">
                <a href="pages/cetak/stoppage_cetak.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&g_shift=<?php echo $_POST['g_shift']; ?>&jenis_mesin=<?php echo $_POST['jenis_mesin']; ?>&nama_mesin=<?php echo $_POST['nama_mesin']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Lap Stoppage Mesin</a> 
            </div>
	    </div>
      <div class="box-body">
        <table class="table table-bordered table-hover table-striped nowrap" id="example8" style="width:100%">
          <thead class="bg-blue">
            <tr>
              <th><div align="center">No</div></th>
              <th><div align="center">Group Shift</div></th>
              <th><div align="center">Shift</div></th>
              <th><div align="center">Jenis Mesin</div></th>
              <th><div align="center">Nama Mesin</div></th>
              <th><div align="center">Operator</div></th>
              <th><div align="center">Tgl Mulai Stop Mesin</div></th>
              <th><div align="center">Tgl Selesai Stop Mesin</div></th>
              <th><div align="center">Kode Stop Mesin</div></th>
              <th><div align="center">Aksi</div></th>
            </tr>
          </thead>
          <tbody>
          <?php
            $no=1;
            if($Awal!=""){ $Where =" AND DATE_FORMAT( tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
            if($GShift=="ALL"){$gshift=" ";}else{$gshift=" AND `g_shift`='$GShift' ";}
            if($Awal!=""){
              $qry1=mysqli_query($con,"SELECT * FROM tbl_stoppage_mc WHERE jenis_mesin='$JenisMC' AND nama_mesin='$NamaMC' $Where $gshift ORDER BY id ASC");
            }else{
              $qry1=mysqli_query($con,"SELECT * FROM tbl_stoppage_mc WHERE jenis_mesin='$JenisMC' AND nama_mesin='$NamaMC' $Where $gshift ORDER BY id ASC");
            }
                while($row1=mysqli_fetch_array($qry1)){
              ?>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $no; ?></td>
            <td align="center"><?php echo $row1['g_shift'];?></td>
            <td align="center"><?php echo $row1['shift'];?></td>
            <td align="center"><?php echo $row1['jenis_mesin'];?></td>
            <td align="center"><?php echo $row1['nama_mesin'];?></td>
            <td align="center"><?php echo $row1['operator'];?></td>
            <td align="center"><?php echo $row1['tgl_mulai']." ".$row1['jam_mulai'];?></td>
            <td align="center"><?php echo $row1['tgl_stop']." ".$row1['jam_stop'];?></td>
            <td align="center"><?php echo $row1['kode_stop'];?></td>
            <td align="center"><div class="btn-group">
            <a href="EditStoppageMC-<?php echo $row1['id']; ?>" class="btn btn-info btn-xs" target="_blank"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i> </a>
            <a href="#" class="btn btn-danger btn-xs" onclick="confirm_delete('./HapusDataStoppageMC-<?php echo $row1['id'] ?>');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i> </a>
            </div></td>
            </tr>
          <?php	
          $no++;} ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_del" tabindex="-1" >
  <div class="modal-dialog modal-sm" >
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Are you sure to delete the data ?</h4>
      </div>

      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div id="StsRTEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>		
<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#modal_del').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>	
<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>
</body>
</html>