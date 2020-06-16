<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | Report Device LIGHT200</title>
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
</head>
<body class="hold-transition sidebar-mini">
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
            <h1>Report Device LIGHT200</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Report Device LIGHT200</li>
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
                    <h3 class="card-title">LIGHT200 History Record</h3>
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
                            <th>Device's ID</th>
                            <th>Device's Name</th>
                            <th>Status</th>
                            <th>Hours Usage</th>
                            <th>Electrical Usage</th>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>450</td>
                            <td>600 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>400</td>
                            <td>550 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>400</td>
                            <td>550 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>390</td>
                            <td>540 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>200</td>
                            <td>350 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>100</td>
                            <td>150 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>200</td>
                            <td>350 kW</td>
                            <td> 06/05/2020 5:50:30 PM</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>50</td>
                            <td>200 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>40</td>
                            <td>190 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>30</td>
                            <td>180 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>30</td>
                            <td>180 kW</td>
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
                            <td>LIGHT200</td>
                            <td>Light 1
                            </td>
                            <td>
                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </td>
                            <td>20</td>
                            <td>170 kW</td>
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
                            <th>Device's ID</th>
                            <th>Device's Name</th>
                            <th>Status</th>
                            <th>Hours Usage</th>
                            <th>Electrical Usage</th>
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
<!-- Bootstrap Switch -->
<script src="assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
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
