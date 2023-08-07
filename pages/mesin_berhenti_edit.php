<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id = $_GET['id'];
$modal = mysqli_query($con,"SELECT * FROM `tbl_schedule` WHERE id='$modal_id' ");
$r = mysqli_fetch_array($modal);
?>
<div class="modal-dialog modal1" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-content" role="document">
    <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="#EditMesinBerhenti" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">GKG-ITTI - GEROBAK</h4>
      </div>
      <div class="modal-body" id="bodee">
        <input type="hidden" id="id" name="id" value="<?php echo $r['id']; ?>">
        <input type="hidden" id="personil" name="personil" value="<?php echo $_SESSION['usridGkg']; ?>">
        <?php
        $lis = mysqli_query($con,"SELECT * from tbl_gerobak where id_schedule = '$r[id]'");
        $list = mysqli_fetch_array($lis);
        ?>
        <!-- edit petugas obras -->
        <div class="form-group">
          <label for="no_gerobak" class="col-md-3 control-label">Petugas Obras</label>
          <div class="col-sm-6">
            <input type="text" required name="petugas_obras" data="1" class="form-control" autocomplete="on" value="<?php echo strtoupper($r['petugas_obras']) ?>" style="text-transform: uppercase;">
          </div>
        </div>
        <div class="form-group">
          <label for="no_gerobak" class="col-md-3 control-label">Gerobak No. 1</label>
          <div class="col-sm-6">
            <input type="text" required name="gerobak_1" data="1" class="form-control" autocomplete="on" value="<?php echo strtoupper($list['no_gerobak1']) ?>" style="text-transform: uppercase;">
          </div>
          <div class="col-sm-1">
            <a href="pages/cetak/iden_produk.php?id=<?php echo $r['id']; ?>&gerobak=1" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="form-group">`
          <label for="no_gerobak" class="col-md-3 control-label">Gerobak No. 2</label>
          <div class="col-sm-6">
            <input type="text" name="gerobak_2" value="<?php echo strtoupper($list['no_gerobak2']) ?>" data="2" class="form-control" autocomplete="on" style="text-transform: uppercase;">
          </div>
          <div class="col-sm-1">
            <a href="pages/cetak/iden_produk2.php?id=<?php echo $r['id']; ?>&gerobak=2" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="form-group">
          <label for="no_gerobak" value="<?php echo $list['no_gerobak3'] ?>" class="col-md-3 control-label">Gerobak No. 3</label>
          <div class="col-sm-6">
            <input type="text" name="gerobak_3" data="3" value="<?php echo strtoupper($list['no_gerobak3']) ?>" class="form-control" autocomplete="on" style="text-transform: uppercase;">
          </div>
          <div class="col-sm-1">
            <a href="pages/cetak/iden_produk3.php?id=<?php echo $r['id']; ?>&gerobak=3" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="form-group">
          <label for="no_gerobak" class="col-md-3 control-label">Gerobak No. 4</label>
          <div class="col-sm-6">
            <input type="text" name="gerobak_4" value="<?php echo strtoupper($list['no_gerobak4']) ?>" data="4" class="form-control" autocomplete="on" style="text-transform: uppercase;">
          </div>
          <div class="col-sm-1">
            <a href="pages/cetak/iden_produk4.php?id=<?php echo $r['id']; ?>&gerobak=4" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="form-group">
          <label for="no_gerobak" class="col-md-3 control-label">Gerobak No. 5</label>
          <div class="col-sm-6">
            <input type="text" name="gerobak_5" value="<?php echo strtoupper($list['no_gerobak5']) ?>" data="5" class="form-control" autocomplete="on" style="text-transform: uppercase;">
          </div>
          <div class="col-sm-1">
            <a href="pages/cetak/iden_produk5.php?id=<?php echo $r['id']; ?>&gerobak=5" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="form-group">
          <label for="no_gerobak" class="col-md-3 control-label">Gerobak No. 6</label>
          <div class="col-sm-6">
            <input type="text" name="gerobak_6" value="<?php echo strtoupper($list['no_gerobak6']) ?>" data="6" class="form-control" autocomplete="on" style="text-transform: uppercase;">
          </div>
          <div class="col-sm-1">
            <a href="pages/cetak/iden_produk6.php?id=<?php echo $r['id']; ?>&gerobak=6" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="form-group">
          <label for="no_gerobak" class="col-md-3 control-label">Gerobak No. 7</label>
          <div class="col-sm-6">
            <input type="text" name="gerobak_7" value="<?php echo strtoupper($list['no_gerobak7']) ?>" data="7" class="form-control" autocomplete="on" style="text-transform: uppercase;">
          </div>
          <div class="col-sm-1">
            <a href="pages/cetak/iden_produk7.php?id=<?php echo $r['id']; ?>&gerobak=7" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="form-group">
          <label for="no_gerobak" class="col-md-3 control-label">Gerobak No. 8</label>
          <div class="col-sm-6">
            <input type="text" name="gerobak_8" value="<?php echo strtoupper($list['no_gerobak8']) ?>" data="8" class="form-control" autocomplete="on" style="text-transform: uppercase;">
          </div>
          <div class="col-sm-1">
            <a href="pages/cetak/iden_produk8.php?id=<?php echo $r['id']; ?>&gerobak=8" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-print"></i></a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<script>
  $(document).ready(function() {
    //--------------------------------- PETUGAS OBRAS  
    $('input[name="petugas_obras"]').blur(function() {
      var petugas_obras = $('input[name="petugas_obras"]').val()
      var id = $('#id').val()

      update_petugas_obras(id, petugas_obras)
    });

    function update_petugas_obras(id, petugas_obras) {
      if (petugas_obras != '') {
        $.ajax({
          url: "pages/ajax_update_Pobras.php",
          type: "POST",
          data: {
            id: id,
            petugas_obras: petugas_obras.toUpperCase(),
          },
          success: function(response) {
            toastr.success('success Update data !')
          }
        });
      } else {
        toastr.error("Isi Nama Petugas !")
      }
    }
    // ----------------------------- END PETUGAS OBRAS

    //------------------------------------------------gerobak
    function update_row_gerobak(id, gerobak, urutan_url) {
      if (gerobak != '') {
        $.ajax({
          url: "pages/ajax_update_gerobak" + urutan_url + ".php",
          type: "POST",
          data: {
            id: id,
            gerobak: gerobak.toUpperCase(),
          },
          success: function(response) {
            toastr.success('Success input data !')
          }
        });
      } else {
        toastr.error("Isi Nomor Gerobak !")
      }
    }
    $('input[name="gerobak_1"]').blur(function() {
      var urutan_url = $(this).attr('data')
      var gerobak = $(this).val()
      var id = $('#id').val()
      update_row_gerobak(id, gerobak, urutan_url)
    });
    $('input[name="gerobak_2"]').blur(function() {
      var urutan_url = $(this).attr('data')
      var gerobak = $(this).val()
      var id = $('#id').val()
      update_row_gerobak(id, gerobak, urutan_url)
    });
    $('input[name="gerobak_3"]').blur(function() {
      var urutan_url = $(this).attr('data')
      var gerobak = $(this).val()
      var id = $('#id').val()
      update_row_gerobak(id, gerobak, urutan_url)
    });
    $('input[name="gerobak_4"]').blur(function() {
      var urutan_url = $(this).attr('data')
      var gerobak = $(this).val()
      var id = $('#id').val()
      update_row_gerobak(id, gerobak, urutan_url)
    });
    $('input[name="gerobak_5"]').blur(function() {
      var urutan_url = $(this).attr('data')
      var gerobak = $(this).val()
      var id = $('#id').val()
      update_row_gerobak(id, gerobak, urutan_url)
    });
    $('input[name="gerobak_6"]').blur(function() {
      var urutan_url = $(this).attr('data')
      var gerobak = $(this).val()
      var id = $('#id').val()
      update_row_gerobak(id, gerobak, urutan_url)
    });
    $('input[name="gerobak_7"]').blur(function() {
      var urutan_url = $(this).attr('data')
      var gerobak = $(this).val()
      var id = $('#id').val()
      update_row_gerobak(id, gerobak, urutan_url)
    });
    $('input[name="gerobak_8"]').blur(function() {
      var urutan_url = $(this).attr('data')
      var gerobak = $(this).val()
      var id = $('#id').val()
      update_row_gerobak(id, gerobak, urutan_url)
    });
  })
</script>