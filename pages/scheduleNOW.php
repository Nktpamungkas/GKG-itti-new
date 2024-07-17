<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Schedule</title>
</head>

<body>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!--<div class="box-header">
          <a href="FormSchedule"
            class="btn <?php echo ($_SESSION['lvl_idGkg'] == 'USER') ? 'btn-primary' : 'btn-success'; ?>">
            <i class="fa fa-plus-circle"></i> Tambah
          </a>
        </div>-->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover table-striped" width="100%">
            <thead class="bg-blue">
              <tr>
                <th width="115">
                  <div align="center">No</div>
                </th>
                <th width="45">
                  <div align="center">Tgl Keluar</div>
                </th>
                <th width="24">
                  <div align="center">Buyer</div>
                </th>
                <th width="162">
                  <div align="center">Customer</div>
                </th>
                <th width="118">
                  <div align="center">Project Code</div>
                </th>
                <th width="122">
                  <div align="center">Prod. Order</div>
                </th>
                <th width="122">
                  <div align="center">Demand</div>
                </th>
                <th width="86">
                  <div align="center">Item Code</div>
                </th>
                <th width="83">
                  <div align="center">Lot</div>
                </th>
                <th width="38">
                  <div align="center">Jenis Benang 1</div>
                </th>
                <th width="38">
                  <div align="center">Jenis Benang 2</div>
                </th>
                <th width="38">
                  <div align="center">Jenis Benang 3</div>
                </th>
                <th width="38">
                  <div align="center">Jenis Benang 4</div>
                </th>
                <th width="79">
                  <div align="center">Warna</div>
                </th>
                <th width="46">
                  <div align="center">Jenis Kain</div>
                </th>
                <th width="48">
                  <div align="center">Qty</div>
                </th>
                <th width="59">
                  <div align="center">Berat/Kg</div>
                </th>
                <th>
                  <div align="center">Project Awal</div>
                </th>
                <th>
                  <div align="center">Note</div>
                </th>
                <th>
                  <div align="center">User</div>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql1 = mysqli_query($connn, "SELECT *
                                            FROM tblkeluarkain
                                            WHERE tgl_tutup <= CURDATE() -- Memilih data sampai dengan hari ini
                                            AND demand IS NOT NULL
                                            ORDER BY tgl_tutup DESC, id DESC
                                            LIMIT 1000");

              if (!$sql1) {
                die("Query Error: " . mysqli_error($connn));
              }

              while ($r = mysqli_fetch_array($sql1)) {
                ?>
                <tr>
                  <td align="center">
                    <font size="-1"><?php echo $no; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['tglkeluar']; ?></font>
                  </td>
                  <td>
                    <font size="-1"><?php echo $r['buyer']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['custumer']; ?></font>
                  </td>
                  <td>
                    <font size="-1"><?php echo $r['projectcode']; ?></font>
                  </td>
                  <td>
                    <font size="-1"><?php echo $r['prod_order']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['demand']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['code']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['lot']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['benang1']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['benang2']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['benang3']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['benang4']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['warna']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['jenis_kain']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['qty']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['berat']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['proj_awal']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['ket']; ?></font>
                  </td>
                  <td align="center">
                    <font size="-1"><?php echo $r['userid']; ?></font>
                  </td>
                </tr>
                <?php
                $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>