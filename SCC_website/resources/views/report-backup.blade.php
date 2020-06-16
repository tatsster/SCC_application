<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | Report</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include("include/nav")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("include/sidebar-menu")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
{{--              <h3 class="card-title">Control Devices</h3>--}}
            </div>
            <!-- /.card-header -->
{{--            <div class="card-body">--}}
{{--              <table id="example2" class="table table-bordered table-hover">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                  <th>Rendering engine</th>--}}
{{--                  <th>Browser</th>--}}
{{--                  <th>Platform(s)</th>--}}
{{--                  <th>Engine version</th>--}}
{{--                  <th>CSS grade</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                  <td>Trident</td>--}}
{{--                  <td>Internet--}}
{{--                    Explorer 4.0--}}
{{--                  </td>--}}
{{--                  <td>Win 95+</td>--}}
{{--                  <td> 4</td>--}}
{{--                  <td>X</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Trident</td>--}}
{{--                  <td>Internet--}}
{{--                    Explorer 5.0--}}
{{--                  </td>--}}
{{--                  <td>Win 95+</td>--}}
{{--                  <td>5</td>--}}
{{--                  <td>C</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Trident</td>--}}
{{--                  <td>Internet--}}
{{--                    Explorer 5.5--}}
{{--                  </td>--}}
{{--                  <td>Win 95+</td>--}}
{{--                  <td>5.5</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Trident</td>--}}
{{--                  <td>Internet--}}
{{--                    Explorer 6--}}
{{--                  </td>--}}
{{--                  <td>Win 98+</td>--}}
{{--                  <td>6</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Trident</td>--}}
{{--                  <td>Internet Explorer 7</td>--}}
{{--                  <td>Win XP SP2+</td>--}}
{{--                  <td>7</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Trident</td>--}}
{{--                  <td>AOL browser (AOL desktop)</td>--}}
{{--                  <td>Win XP</td>--}}
{{--                  <td>6</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Firefox 1.0</td>--}}
{{--                  <td>Win 98+ / OSX.2+</td>--}}
{{--                  <td>1.7</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Firefox 1.5</td>--}}
{{--                  <td>Win 98+ / OSX.2+</td>--}}
{{--                  <td>1.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Firefox 2.0</td>--}}
{{--                  <td>Win 98+ / OSX.2+</td>--}}
{{--                  <td>1.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Firefox 3.0</td>--}}
{{--                  <td>Win 2k+ / OSX.3+</td>--}}
{{--                  <td>1.9</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Camino 1.0</td>--}}
{{--                  <td>OSX.2+</td>--}}
{{--                  <td>1.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Camino 1.5</td>--}}
{{--                  <td>OSX.3+</td>--}}
{{--                  <td>1.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Netscape 7.2</td>--}}
{{--                  <td>Win 95+ / Mac OS 8.6-9.2</td>--}}
{{--                  <td>1.7</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Netscape Browser 8</td>--}}
{{--                  <td>Win 98SE+</td>--}}
{{--                  <td>1.7</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Netscape Navigator 9</td>--}}
{{--                  <td>Win 98+ / OSX.2+</td>--}}
{{--                  <td>1.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.0</td>--}}
{{--                  <td>Win 95+ / OSX.1+</td>--}}
{{--                  <td>1</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.1</td>--}}
{{--                  <td>Win 95+ / OSX.1+</td>--}}
{{--                  <td>1.1</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.2</td>--}}
{{--                  <td>Win 95+ / OSX.1+</td>--}}
{{--                  <td>1.2</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.3</td>--}}
{{--                  <td>Win 95+ / OSX.1+</td>--}}
{{--                  <td>1.3</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.4</td>--}}
{{--                  <td>Win 95+ / OSX.1+</td>--}}
{{--                  <td>1.4</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.5</td>--}}
{{--                  <td>Win 95+ / OSX.1+</td>--}}
{{--                  <td>1.5</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.6</td>--}}
{{--                  <td>Win 95+ / OSX.1+</td>--}}
{{--                  <td>1.6</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.7</td>--}}
{{--                  <td>Win 98+ / OSX.1+</td>--}}
{{--                  <td>1.7</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Mozilla 1.8</td>--}}
{{--                  <td>Win 98+ / OSX.1+</td>--}}
{{--                  <td>1.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Seamonkey 1.1</td>--}}
{{--                  <td>Win 98+ / OSX.2+</td>--}}
{{--                  <td>1.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Gecko</td>--}}
{{--                  <td>Epiphany 2.20</td>--}}
{{--                  <td>Gnome</td>--}}
{{--                  <td>1.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Webkit</td>--}}
{{--                  <td>Safari 1.2</td>--}}
{{--                  <td>OSX.3</td>--}}
{{--                  <td>125.5</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Webkit</td>--}}
{{--                  <td>Safari 1.3</td>--}}
{{--                  <td>OSX.3</td>--}}
{{--                  <td>312.8</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Webkit</td>--}}
{{--                  <td>Safari 2.0</td>--}}
{{--                  <td>OSX.4+</td>--}}
{{--                  <td>419.3</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Webkit</td>--}}
{{--                  <td>Safari 3.0</td>--}}
{{--                  <td>OSX.4+</td>--}}
{{--                  <td>522.1</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Webkit</td>--}}
{{--                  <td>OmniWeb 5.5</td>--}}
{{--                  <td>OSX.4+</td>--}}
{{--                  <td>420</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Webkit</td>--}}
{{--                  <td>iPod Touch / iPhone</td>--}}
{{--                  <td>iPod</td>--}}
{{--                  <td>420.1</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Webkit</td>--}}
{{--                  <td>S60</td>--}}
{{--                  <td>S60</td>--}}
{{--                  <td>413</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Opera 7.0</td>--}}
{{--                  <td>Win 95+ / OSX.1+</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Opera 7.5</td>--}}
{{--                  <td>Win 95+ / OSX.2+</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Opera 8.0</td>--}}
{{--                  <td>Win 95+ / OSX.2+</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Opera 8.5</td>--}}
{{--                  <td>Win 95+ / OSX.2+</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Opera 9.0</td>--}}
{{--                  <td>Win 95+ / OSX.3+</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Opera 9.2</td>--}}
{{--                  <td>Win 88+ / OSX.3+</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Opera 9.5</td>--}}
{{--                  <td>Win 88+ / OSX.3+</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Opera for Wii</td>--}}
{{--                  <td>Wii</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Nokia N800</td>--}}
{{--                  <td>N800</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Presto</td>--}}
{{--                  <td>Nintendo DS browser</td>--}}
{{--                  <td>Nintendo DS</td>--}}
{{--                  <td>8.5</td>--}}
{{--                  <td>C/A<sup>1</sup></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>KHTML</td>--}}
{{--                  <td>Konqureror 3.1</td>--}}
{{--                  <td>KDE 3.1</td>--}}
{{--                  <td>3.1</td>--}}
{{--                  <td>C</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>KHTML</td>--}}
{{--                  <td>Konqureror 3.3</td>--}}
{{--                  <td>KDE 3.3</td>--}}
{{--                  <td>3.3</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>KHTML</td>--}}
{{--                  <td>Konqureror 3.5</td>--}}
{{--                  <td>KDE 3.5</td>--}}
{{--                  <td>3.5</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Tasman</td>--}}
{{--                  <td>Internet Explorer 4.5</td>--}}
{{--                  <td>Mac OS 8-9</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>X</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Tasman</td>--}}
{{--                  <td>Internet Explorer 5.1</td>--}}
{{--                  <td>Mac OS 7.6-9</td>--}}
{{--                  <td>1</td>--}}
{{--                  <td>C</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Tasman</td>--}}
{{--                  <td>Internet Explorer 5.2</td>--}}
{{--                  <td>Mac OS 8-X</td>--}}
{{--                  <td>1</td>--}}
{{--                  <td>C</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Misc</td>--}}
{{--                  <td>NetFront 3.1</td>--}}
{{--                  <td>Embedded devices</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>C</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Misc</td>--}}
{{--                  <td>NetFront 3.4</td>--}}
{{--                  <td>Embedded devices</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>A</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Misc</td>--}}
{{--                  <td>Dillo 0.8</td>--}}
{{--                  <td>Embedded devices</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>X</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Misc</td>--}}
{{--                  <td>Links</td>--}}
{{--                  <td>Text only</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>X</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Misc</td>--}}
{{--                  <td>Lynx</td>--}}
{{--                  <td>Text only</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>X</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Misc</td>--}}
{{--                  <td>IE Mobile</td>--}}
{{--                  <td>Windows Mobile 6</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>C</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Misc</td>--}}
{{--                  <td>PSP browser</td>--}}
{{--                  <td>PSP</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>C</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <td>Other browsers</td>--}}
{{--                  <td>All others</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>-</td>--}}
{{--                  <td>U</td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--                <tfoot>--}}
{{--                <tr>--}}
{{--                  <th>Rendering engine</th>--}}
{{--                  <th>Browser</th>--}}
{{--                  <th>Platform(s)</th>--}}
{{--                  <th>Engine version</th>--}}
{{--                  <th>CSS grade</th>--}}
{{--                </tr>--}}
{{--                </tfoot>--}}
{{--              </table>--}}
{{--            </div>--}}
            <!-- /.card-body -->
                  <div class="card-header">
                      <h3 class="card-title">A4 Building - HCMUT</h3>
                      <button type="button" data-toggle="modal" data-target="#modal-success" class="btn btn-success btn-sm float-right" style="margin-right: 5px;">
                          <i class="fas fa-download"></i> Generate all records to excel
                      </button>
                      <button type="button" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm float-right" style="margin-right: 5px;">
                          <i class="fas fa-download"></i> Delete all records
                      </button>
                  </div>
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              <th class="text-center">
                                  <div class="icheck-success d-inline">
                                      <input type="checkbox" id="checkboxSuccess1">
                                      <label for="checkboxSuccess1">
                                      </label>
                                  </div>
                              </th>
                              <th>Floor's ID</th>
                              <th>Floor's Name</th>
                              <th>Total Hours Of Electrical Usage</th>
                              <th>Total Electrical Usage</th>
                              <th>Update Datetime</th>
                              <th>
                                  <button type="button" data-toggle="modal" data-target="#modal-success" class="btn btn-success btn-sm" style="margin-right: 5px;">
                                      <i class="fas fa-download"></i> Generate to excel
                                  </button>
                                  <button data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </button>
                              </th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td class="text-center">
                                  <div class="icheck-success d-inline">
                                      <input type="checkbox" id="checkboxSuccess2">
                                      <label for="checkboxSuccess2">
                                      </label>
                                  </div>
                              </td>
                              <td>F0005</td>
                              <td>Floor 5
                              </td>
                              <td>200
                              </td>
                              <td>400 kW</td>
                              <td> 11/05/2020 6:00:00 PM</td>
                              <td class="project-actions text-left">
                                  <a class="btn btn-primary btn-sm" href="report-floor">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a>
                                  <a class="btn btn-info btn-sm" href="#">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Edit
                                  </a>
                                  <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </a>
                              </td>
                          </tr>
                          <tr>
                              <td class="text-center">
                                  <div class="icheck-success d-inline">
                                      <input type="checkbox" id="checkboxSuccess3">
                                      <label for="checkboxSuccess3">
                                      </label>
                                  </div>
                              </td>
                              <td>F0004</td>
                              <td>Floor 4
                              </td>
                              <td>150
                              </td>
                              <td>350 kW</td>
                              <td> 11/05/2020 6:00:00 PM</td>
                              <td class="project-actions text-left">
                                  <a class="btn btn-primary btn-sm" href="report-floor">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a>
                                  <a class="btn btn-info btn-sm" href="#">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Edit
                                  </a>
                                  <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </a>
                              </td>
                          </tr>
                          <tr>
                              <td class="text-center">
                                  <div class="icheck-success d-inline">
                                      <input type="checkbox" id="checkboxSuccess4">
                                      <label for="checkboxSuccess4">
                                      </label>
                                  </div>
                              </td>
                              <td>F0003</td>
                              <td>Floor 3
                              </td>
                              <td>300
                              </td>
                              <td>450 kW</td>
                              <td> 11/05/2020 6:00:00 PM</td>
                              <td class="project-actions text-left">
                                  <a class="btn btn-primary btn-sm" href="report-floor">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a>
                                  <a class="btn btn-info btn-sm" href="#">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Edit
                                  </a>
                                  <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </a>
                              </td>
                          </tr>
                          <tr>
                              <td class="text-center">
                                  <div class="icheck-success d-inline">
                                      <input type="checkbox" id="checkboxSuccess5">
                                      <label for="checkboxSuccess5">
                                      </label>
                                  </div>
                              </td>
                              <td>F0002</td>
                              <td>Floor 2
                              </td>
                              <td>100
                              </td>
                              <td>300 kW</td>
                              <td> 11/05/2020 6:00:00 PM</td>
                              <td class="project-actions text-left">
                                  <a class="btn btn-primary btn-sm" href="report-floor">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a>
                                  <a class="btn btn-info btn-sm" href="#">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Edit
                                  </a>
                                  <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </a>
                              </td>
                          </tr>
                          <tr>
                              <td class="text-center">
                                  <div class="icheck-success d-inline">
                                      <input type="checkbox" id="checkboxSuccess6">
                                      <label for="checkboxSuccess6">
                                      </label>
                                  </div>
                              </td>
                              <td>F0001</td>
                              <td>Floor 1
                              </td>
                              <td>100
                              </td>
                              <td>300 kW</td>
                              <td> 11/05/2020 6:00:00 PM</td>
                              <td class="project-actions text-left">
                                  <a class="btn btn-primary btn-sm" href="report-floor">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a>
                                  <a class="btn btn-info btn-sm" href="#">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Edit
                                  </a>
                                  <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </a>
                              </td>
                          </tr>
                          <tr>
                              <td class="text-center">
                                  <div class="icheck-success d-inline">
                                      <input type="checkbox" id="checkboxSuccess7">
                                      <label for="checkboxSuccess7">
                                      </label>
                                  </div>
                              </td>
                              <td>F0000</td>
                              <td>Ground Floor
                              </td>
                              <td>450
                              </td>
                              <td>600 kW</td>
                              <td> 11/05/2020 6:00:00 PM</td>
                              <td class="project-actions text-left">
                                  <a class="btn btn-primary btn-sm" href="report-floor">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a>
                                  <a class="btn btn-info btn-sm" href="#">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Edit
                                  </a>
                                  <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </a>
                              </td>
                          </tr>
                          <tfoot>
                          <tr>
                              <th class="text-center">
                                  <div class="icheck-success d-inline">
                                      <input type="checkbox" id="checkboxSuccess8">
                                      <label for="checkboxSuccess8">
                                      </label>
                                  </div>
                              </th>
                              <th>Floor's ID</th>
                              <th>Floor's Name</th>
                              <th>Total Hours Of Electrical Usage</th>
                              <th>Total Electrical Usage</th>
                              <th>Update Datetime</th>
                              <th>
                                  <button type="button" data-toggle="modal" data-target="#modal-success" class="btn btn-success btn-sm" style="margin-right: 5px;">
                                      <i class="fas fa-download"></i> Generate to excel
                                  </button>
                                  <button data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </button>
                              </th>
                          </tr>
                          </tfoot>
                      </table>
                  </div>
          </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Action</h3>
                    <button type="button" data-toggle="modal" data-target="#modal-success" class="btn btn-success btn-sm float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate all records to excel
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Delete all records
                    </button>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservationtime">
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary btn-sm float-right" style="margin-right: 5px;">
                        Apply time range
                    </button>
                </div>
                <div class="card-body">
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess9">
                                    <label for="checkboxSuccess9">
                                    </label>
                                </div>
                            </th>
                            <th>User's ID</th>
                            <th>User's Name</th>
                            <th>User's Role</th>
                            <th>Action</th>
                            <th>Datetime</th>
                            <th>
                                <button type="button" data-toggle="modal" data-target="#modal-success" class="btn btn-success btn-sm" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate to excel
                                </button>
                                <button data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess10">
                                    <label for="checkboxSuccess10">
                                    </label>
                                </div>
                            </td>
                            <td>1752051</td>
                            <td>Huỳnh Ngọc Thiện
                            </td>
                            <td>Admin
                            </td>
                            <td>Generate all records in backup log table to excel</td>
                            <td> 11/05/2020 12:00:00 AM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess11">
                                    <label for="checkboxSuccess11">
                                    </label>
                                </div>
                            </td>
                            <td>199857</td>
                            <td>Dương Anh Vũ
                            </td>
                            <td>School Manager
                            </td>
                            <td>Turn all light on in room 100 on floor 1</td>
                            <td> 11/05/2020 8:50:30 AM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess12">
                                    <label for="checkboxSuccess12">
                                    </label>
                                </div>
                            </td>
                            <td>199857</td>
                            <td>Trần Đình Trọng
                            </td>
                            <td>School Manager
                            </td>
                            <td>Turn all air-conditioner off in room 502 on floor 5</td>
                            <td> 10/05/2020 4:50:30 PM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess13">
                                    <label for="checkboxSuccess13">
                                    </label>
                                </div>
                            </td>
                            <td>129857</td>
                            <td>Trần Đình Quang
                            </td>
                            <td>School Manager
                            </td>
                            <td>Turn all fan on in room 302 on floor 3</td>
                            <td> 10/05/2020 8:50:30 AM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess14">
                                    <label for="checkboxSuccess14">
                                    </label>
                                </div>
                            </td>
                            <td>1752051</td>
                            <td>Huỳnh Ngọc Thiện
                            </td>
                            <td>Admin
                            </td>
                            <td>Turn on backup log system</td>
                            <td> 08/05/2020 12:00:00 AM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess15">
                                    <label for="checkboxSuccess15">
                                    </label>
                                </div>
                            </td>
                            <td>199857</td>
                            <td>Dương Anh Vũ
                            </td>
                            <td>School Manager
                            </td>
                            <td>Generate room 502 records to excel</td>
                            <td> 06/05/2020 10:50:30 AM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess16">
                                    <label for="checkboxSuccess16">
                                    </label>
                                </div>
                            </td>
                            <td>199857</td>
                            <td>Trần Đình Trọng
                            </td>
                            <td>School Manager
                            </td>
                            <td>Turn all light off in room 302 on floor 3</td>
                            <td> 6/05/2020 5:50:30 PM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess17">
                                    <label for="checkboxSuccess17">
                                    </label>
                                </div>
                            </td>
                            <td>129857</td>
                            <td>Trần Đình Quang
                            </td>
                            <td>School Manager
                            </td>
                            <td>Edit temperature threshold</td>
                            <td> 04/05/2020 11:30:30 AM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess18">
                                    <label for="checkboxSuccess18">
                                    </label>
                                </div>
                            </td>
                            <td>1752051</td>
                            <td>Huỳnh Ngọc Thiện
                            </td>
                            <td>Admin
                            </td>
                            <td>Edit humidity threshold</td>
                            <td> 02/05/2020 2:00:00 PM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess19">
                                    <label for="checkboxSuccess19">
                                    </label>
                                </div>
                            </td>
                            <td>199857</td>
                            <td>Dương Anh Vũ
                            </td>
                            <td>School Manager
                            </td>
                            <td>Turn all fan off in room 400 on floor 4</td>
                            <td> 01/05/2020 1:50:30 PM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess20">
                                    <label for="checkboxSuccess20">
                                    </label>
                                </div>
                            </td>
                            <td>199857</td>
                            <td>Trần Đình Trọng
                            </td>
                            <td>School Manager
                            </td>
                            <td>Turn all air-conditioner oon in room 303 on floor 3</td>
                            <td> 01/05/2020 9:50:30 AM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess21">
                                    <label for="checkboxSuccess21">
                                    </label>
                                </div>
                            </td>
                            <td>129857</td>
                            <td>Trần Đình Quang
                            </td>
                            <td>School Manager
                            </td>
                            <td>Turn all light on in room 300 on floor 3</td>
                            <td> 01/05/2020 10:50:30 AM</td>
                            <td class="project-actions text-left">
                                {{--                                        <a class="btn btn-primary btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-folder">--}}
                                {{--                                            </i>--}}
                                {{--                                            View--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm" href="#">--}}
                                {{--                                            <i class="fas fa-pencil-alt">--}}
                                {{--                                            </i>--}}
                                {{--                                            Edit--}}
                                {{--                                        </a>--}}
                                <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-center">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkboxSuccess999">
                                    <label for="checkboxSuccess999">
                                    </label>
                                </div>
                            </th>
                            <th>User's ID</th>
                            <th>User's Name</th>
                            <th>User's Role</th>
                            <th>Action</th>
                            <th>Datetime</th>
                            <th>
                                <button data-toggle="modal" data-target="#modal-success" type="button" class="btn btn-success btn-sm" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate to excel
                                </button>
                                <button data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </button>
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @include("include/footer")
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<div class="modal fade" id="modal-success">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Generate excel...</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-light">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Delete record...</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-light">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="assets/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="assets/plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="assets/plugins/flot-old/jquery.flot.pie.min.js"></script>
<!-- date-range-picker -->
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
      $("#example3").DataTable({
          "responsive": true,
          "autoWidth": false,
      });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
          format: 'DD/MM/YYYY hh:mm A'
      }
  })
</script>
</body>
</html>
