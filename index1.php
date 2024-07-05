<?php
ini_set("error_reporting", 1);
session_start();
include ('koneksi.php');
include ('tgl_indo.php');
?>

<?php
if (!isset($_SESSION['usridGkg'])) { ?>
  <script>
    setTimeout("location.href='login'", 500);
  </script>
<?php die('Illegal Acces');
} else if (!isset($_SESSION['pasidGkg'])) { ?>
  <script>
    setTimeout("location.href='lockscreen'", 500);
  </script>
<?php die('Illegal Acces');
}

$page = isset($_GET['p']) ? $_GET['p'] : '';
$act  = isset($_GET['act']) ? $_GET['act'] : '';
$id   = isset($_GET['id']) ? $_GET['id'] : '';
$page = strtolower($page);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GKG-ITTI |
    <?php if ($_GET['p'] != "") {
      echo ucwords($_GET['p']);
    } else {
      echo "Home";
    } ?>
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link href="bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
  <link href="bower_components/toastr/toastr.css" rel="stylesheet">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="bower_components/sweetalert/sweetalert2.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="bower_components/sweetalert/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="bower_components/circle-indicator-spinner/dist/jquery-spinner.min.css">
  <script type="text/javascript" src="bower_components/circle-indicator-spinner/dist/jquery-spinner.min.js"></script>
  <?php if ($_GET['p'] == "Delete_khusus_report") : ?>
    <link rel="stylesheet" href="bower_components/xeditable/bootstrap3-editable/css/bootstrap-editable.css">
  <?php endif; ?>

  <style>
    body {
      font-family: Calibri, "sans-serif", "Courier New";
      font-style: normal;
    }
  </style>
  <link rel="icon" type="image/png" href="dist/img/ITTI_Logo index.ico">
  <style>
    .blink_me {
      animation: blinker 1s linear infinite;
    }

    .bulat {
      border-radius: 50%;
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .border-dashed {
      border: 3px dashed #083255;
    }

    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }

    body {
      font-family: Calibri, "sans-serif", "Courier New";
      /* "Calibri Light","serif" */
      font-style: normal;
    }
  </style>

</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse fixed" id="block-full-page">
  <!--<body class="hold-transition skin-blue sidebar-mini">-->
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="Home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>GKG</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>GKG</b>-ITTI</span>
      </a>
      <?php if ($_SESSION['deptGkg'] == "GKG") {
        $Wdept = " ";
      } else {
        $Wdept = " AND dept='$_SESSION[deptGkg]' ";
      } ?>
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="dist/img/<?php echo $_SESSION['fotoGkg'] . ".png"; ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo strtoupper($_SESSION['usridGkg']); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="dist/img/<?php echo $_SESSION['fotoGkg'] . ".png"; ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo strtoupper($_SESSION['usridGkg']); ?> - <?php echo $_SESSION['jabatanGkg']; ?>
                    <small>Member since <?php echo $_SESSION['mamberGkg']; ?></small>
                  </p>
                </li>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <!--<a href="lockscreen" class="btn btn-default btn-flat">LockScreen</a>-->
              </div>
              <div class="pull-right">
                <a href="logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
          </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/<?php echo $_SESSION['fotoGkg'] . ".png"; ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo strtoupper($_SESSION['usridGkg']); ?></p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">HEADER</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="<?php if ($_GET['p'] == "Home" or $_GET['p'] == "") {
                        echo "active";
                      } ?>"><a href="Home"><i class="fa fa-dashboard text-gray"></i> <span>DashBoard</span></a>
          </li>
          <li class="<?php if ($_GET['p'] == "Schedule") {
                        echo "active";
                      } ?>"><a href="Schedule"><i class="fa fa-download text-success"></i> <span>Pick-up Schedule</span></a>
          </li>
          <li class="<?php if ($_GET['p'] == "Schedule-Ongoing") {
                        echo "active";
                      } ?>"><a href="Scheduleongoing"><i class="fa fa-line-chart text-danger"></i> <span>Schedule on Going</span></a>
          </li>
          <li class="<?php if ($_GET['p'] == "Need-Leader-Check") {
                        echo "active";
                      } ?>"><a href="NeedLeaderCheck"><i class="fa fa-check text-primary"></i> <span>Need Leader Check</span></a>
          </li>
          <li class="<?php if ($_GET['p'] == "Lap-Schedule") {
                        echo "active";
                      } ?>"><a href="LapSchedule"><i class="fa fa-laptop"></i> <span>Report Schedule</span></a>
          </li>

          <li class="treeview <?php if (
                                $_GET['p'] == "Status-Mesin" or $_GET['p'] == "Line-News"
                                or $_GET['p'] == "Monitoring-Schedule-Report" or $_GET['p'] == "Monitoring_report_operator" or $_GET['p'] == "history_status_mesin" or $_GET['p'] == "Delete_khusus_report" or $_GET['p'] == "Stoppage_Mc" or $_GET['p'] == "Lap-Stoppage-MC"
                              ) {
                                echo "active";
                              } ?>">
            <a href="#"><i class="fa fa-archive text-warning"></i> <span>GKG</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if ($_GET['p'] == "Monitoring-Schedule-Report") {
                            echo "active";
                          } ?>"><a href="MonitoringScheduleReport"><i class="fa fa-users text-danger"></i> <span>Schedule Report Group</span></a>
              </li>
			  <li class="<?php if ($_GET['p'] == "Monitoring-Schedule-Report-Now") {
                            echo "active";
                          } ?>"><a href="MonitoringScheduleReportNow"><i class="fa fa-users text-danger"></i> <span>Schedule Report Group NOW</span></a>
              </li>	
              <li class="<?php if ($_GET['p'] == "Monitoring_report_operator") {
                            echo "active";
                          } ?>"><a href="Monitoring_report_operator"><i class="fa fa-user text-info"></i> <span>Schedule Report Operator</span></a>
              </li>
              <li class="<?php if ($_GET['p'] == "history_status_mesin") {
                            echo "active";
                          } ?>"><a href="history_status_mesin"><i class="fa fa-industry" aria-hidden="true"></i>
                  <span>History status mesin</span></a>
              </li>
              <li <?php if ($_SESSION['nama1Gkg'] != "GKG-LEADER") echo "style='display:none;'"; ?> class="<?php if ($_GET['p'] == "Delete_khusus_report") {
                                                                                                              echo "active";
                                                                                                            } ?>"><a href="Delete_khusus_report"><i class="fa fa-free-code-camp" aria-hidden="true"></i>
                  <span>Fitur Khusus</span></a>
              </li>
              <li <?php if ($_SESSION['nama1Gkg'] != "GKG-LEADER") echo "style='display:none;'"; ?> class="<?php if ($_GET['p'] == "Line-News") {
                                                                                                              echo "active";
                                                                                                            } ?>"><a href="LineNews"><i class="fa fa-volume-up text-danger" aria-hidden="true"></i>
                  <span>Line News</span></a>
              </li>
              <li class="<?php if ($_GET['p'] == "Status-Mesin") {
                            echo "active";
                          } ?>"><a href="StatusMesin"><i class="fa fa-television text-primary"></i> <span>Status Mesin</span></a>
              </li>
              <li class="<?php if ($_GET['p'] == "Stoppage_Mc") {
                            echo "active";
                          } ?>"><a href="StoppageMC"><i class="fa fa-stop-circle text-primary"></i> <span>Stoppage Mesin</span></a>
              </li>
              <li class="<?php if ($_GET['p'] == "Lap-Stoppage-MC") {
                            echo "active";
                          } ?>"><a href="LapStoppageMC"><i class="fa fa-stop-circle text-primary"></i> <span>Laporan Stoppage Mesin</span></a>
              </li>
            </ul>
          </li>
          <li class="treeview <?php if ($_GET['p'] == "manage_user" or $_GET['p'] == "manage_mesin"  or $_GET['p'] == "Ganti_Password" or $_GET['p'] == "manage_mesin_gkg") {
                                echo "active";
                              } ?>">
            <a href="#"><i class="fa fa-cog"></i> <span>SETTING</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if ($_GET['p'] == "manage_user") {
                            echo "active";
                          } ?>" <?php if ($_SESSION['lvl_idGkg'] == "USER" or $_SESSION['lvl_idGkg'] == "LEADER") echo "style='display: none';" ?>><a href="manage_user"><i class="fa fa-user text-danger"></i> <span>Manage User</span></a>
              </li>
              <li class="<?php if ($_GET['p'] == "manage_mesin") {
                            echo "active";
                          } ?>" <?php if ($_SESSION['lvl_idGkg'] == "USER" or $_SESSION['lvl_idGkg'] == "LEADER") echo "style='display: none';" ?>><a href="manage_mesin"><i class="fa fa-cogs"></i> <span>Manage Mesin</span></a>
              </li>
              <li class="<?php if ($_GET['p'] == "manage_mesin_gkg") {
                            echo "active";
                          } ?>" <?php if ($_SESSION['lvl_idGkg'] == "USER" or $_SESSION['lvl_idGkg'] == "LEADER") echo "style='display: none';" ?>><a href="manage_mesin_gkg"><i class="fa fa-cogs"></i> <span>Manage Mesin GKG</span></a>
              </li>
              <li class="<?php if ($_GET['p'] == "Ganti_Password") {
                            echo "active";
                          } ?>"><a href="Ganti_Password"><i class="fa fa-key"></i> <span>Change Password</span></a>
              </li>
            </ul>
          </li>
          <li <?php if ($_SESSION['lvl_idGkg'] != 'LEADER') echo 'style=display:none;' ?> class="<?php if ($_GET['p'] == "Schedule-jalan") {
                                                                                                    echo "active";
                                                                                                  } ?>"><a href="Schedule-jalan"><i class="fa fa-tags text-danger"></i> <span>Schedule Belum Selesai</span></a>
          </li>
          <li class="<?php if ($_GET['p'] == "Laporan_shift") {
                        echo "active";
                      } ?>"><a href="Laporan_shift">
              <i class="fa fa-file-pdf-o text-success" aria-hidden="true"></i>
              <span>Laporan shift</span></a>
          </li>


        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content container-fluid">
        <?php
        if (!empty($page) and !empty($act)) {
          $files = 'pages/' . $page . '.' . $act . '.php';
        } else
          if (!empty($page)) {
          $files = 'pages/' . $page . '.php';
        } else {
          $files = 'pages/home.php';
        }

        if (file_exists($files)) {
          include ($files);
        } else {
          include ("blank.php");
        }
        ?>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        DIT
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; <?php echo date("Y");?> <a href="#">DIT ITTI</a>.</strong> All rights reserved.
    </footer>

    <div class="control-sidebar-bg"></div>
  </div>

  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <!-- Select2 -->
  <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- start - This is for export functionality only -->
  <script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
  <script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>
  <!-- end - This is for export functionality only -->
  <!-- bootstrap datepicker -->
  <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="bower_components/toast-master/js/jquery.toast.js"></script>
  <script src="bower_components/toastr/toastr.js"></script>
  <?php if ($_GET['p'] == "Delete_khusus_report") : ?>
    <script src="bower_components/xeditable/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#roll_id').editable({
          type: 'text',
          url: 'pages/ajax/editable_roll.php',
        });
        $('#bruto_id').editable({
          type: 'text',
          url: 'pages/ajax/editable_bruto.php',
        });

        // gerobak here
        $(document).click('#grbk1_id', function() {
          $('#grbk1_id').editable({
            type: 'text',
            url: 'pages/ajax/editable_grbk1.php',
          });
        })
        $(document).click('#grbk2_id', function() {
          $('#grbk2_id').editable({
            type: 'text',
            url: 'pages/ajax/editable_grbk2.php',
          });
        })
        $(document).click('#grbk3_id', function() {
          $('#grbk3_id').editable({
            type: 'text',
            url: 'pages/ajax/editable_grbk3.php',
          });
        })
        $(document).click('#grbk4_id', function() {
          $('#grbk4_id').editable({
            type: 'text',
            url: 'pages/ajax/editable_grbk4.php',
          });
        })
        $(document).click('#grbk5_id', function() {
          $('#grbk5_id').editable({
            type: 'text',
            url: 'pages/ajax/editable_grbk5.php',
          });
        })
        $(document).click('#grbk6_id', function() {
          $('#grbk6_id').editable({
            type: 'text',
            url: 'pages/ajax/editable_grbk6.php',
          });
        })

      })
    </script>
  <?php endif; ?>

  <script>
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.select3').select2();
    $('.select').select2();
    $("select2").on("select3:select2", function(evt) {
      var element = evt.params.data.element;
      var $element = $(element);

      $element.detach();
      $(this).append($element);
      $(this).trigger("change");
    });

    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    })
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
      }),
      //Date picker
      $('#datepicker1').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
      }),
      //Date picker
      $('#datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
      }),
      //Date picker
      $('#datepicker3').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
      })
  </script>
  <script>
    $(function() {

      $('#example1').DataTable({
        'scrollX': true,
        'paging': true,


      })
      $('#example2').DataTable()
      $('#example3').DataTable({
        'scrollX': true,
        dom: 'Bfrtip',
        buttons: [
          'excel',
          {
            orientation: 'portrait',
            pageSize: 'LEGAL',
            extend: 'pdf',
            footer: true,
          },
        ]
      })
      $('#example4').DataTable({
        'paging': false,
      })
      $('#example8').DataTable({
      'scrollX'	: true,
      dom: 'Bfrtip',
          buttons: [
                {extend : 'excel', footer: true },
        {
            orientation: 'portrait',
            pageSize: 'LEGAL',
            extend: 'pdf',
            footer: true,
            },
            ]
      })
      $('#example5').DataTable()
      $('#example6').DataTable()
      $('#tblr1').DataTable()
      $('#tblr2').DataTable()
      $('#tblr3').DataTable()
      $('#tblr4').DataTable()
      $('#tblr5').DataTable()
      $('#tblr6').DataTable()
      $('#tblr7').DataTable()
      $('#tblr8').DataTable()
      $('#tblr9').DataTable()
      $('#tblr10').DataTable()
      $('#tblr11').DataTable()
      $('#tblr12').DataTable()
      $('#tblr13').DataTable()
      $('#tblr14').DataTable()
      $('#tblr15').DataTable()
      $('#tblr16').DataTable()
      $('#tblr17').DataTable()
      $('#tblr18').DataTable()
      $('#tblr19').DataTable()
      $('#tblr20').DataTable()
      $('#lookup').DataTable()

    })
  </script>
  <!-- Javascript untuk popup modal Edit-->
  <script type="text/javascript">
    $(document).ready(function() {
      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      })
      //Initialize Select2 Elements
      $('.select2').select2()
    });
  </script>
  <script type="text/javascript">
    //            jika dipilih, BON akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih-kk', function(e) {
      document.getElementById("nokk").value = $(this).attr('data-kk');
      document.getElementById("nokk").focus();
      $('#myModal').modal('hide');
    });
    $(document).on('click', '.detail_status', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/cek-status-mesin.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#CekDetailStatus").html(ajaxData);
          $("#CekDetailStatus").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.data_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/data_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#DataEdit").html(ajaxData);
          $("#DataEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.gerobak_tambah', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/gerobak_tambah.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#GerobakTambah").html(ajaxData);
          $("#GerobakTambah").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.edit_status_mesin', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/edit-status-mesin.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#EditStatusMesin").html(ajaxData);
          $("#EditStatusMesin").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.edit_bon', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/bon_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#EditBon").html(ajaxData);
          $("#EditBon").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.sts_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/sts_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#StsEdit").html(ajaxData);
          $("#StsEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.penyelesaian_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/penyelesaian_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#SelesaiEdit").html(ajaxData);
          $("#SelesaiEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.ncp_lama', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/ncp_lama.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#NcpLama").html(ajaxData);
          $("#NcpLama").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.terima_ncp_lama', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/ncp_lama_terima.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#NcpLamaTerima").html(ajaxData);
          $("#NcpLamaTerima").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.dtmail', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/detail_email.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#DtMail").html(ajaxData);
          $("#DtMail").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.schedule_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/schedule_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#ScheduleEdit").html(ajaxData);
          $("#ScheduleEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.mesin_mulai_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/mesin_mulai_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#MesinMulaiEdit").html(ajaxData);
          $("#MesinMulaiEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.mesin_berhenti_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/mesin_berhenti_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#MesinBerhentiEdit").html(ajaxData);
          $("#MesinBerhentiEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.news_edit', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/news_edit.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#NewsEdit").html(ajaxData);
          $("#NewsEdit").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.resep', function(e) {
      var m = $(this).attr("id");
      $.ajax({
        url: "pages/resep.php",
        type: "GET",
        data: {
          id: m,
        },
        success: function(ajaxData) {
          $("#Resep").html(ajaxData);
          $("#Resep").modal('show', {
            backdrop: 'true'
          });
        }
      });
    });
    $(document).on('click', '.posisi_kk', function (e) {
      var m = $(this).attr("id");
        $.ajax({
          url: "pages/posisikk.php",
          type: "GET",
          data : {id: m,},
          success: function (ajaxData){
            $("#PosisiKK").html(ajaxData);
            $("#PosisiKK").modal('show',{backdrop: 'true'});
          }
        });
    });
  </script>
  <script src="bower_components/ckeditor/ckeditor.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    $(function() {
      CKEDITOR.replace('editor1')
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
    })
  </script>
  <script type="text/javascript">
    $(function () {	
      //Time Picker
      $('.jam_mulai').timepicker({
                    minuteStep: 1,
                    showInputs: false,
                    showMeridian: false,
                    defaultTime: false	
          
        })
        
      $('.timepicker1').timepicker({
        showInputs: true,
        defaultTime: false
      })		
    })	
  </script>