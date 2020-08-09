<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | Dashboard</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" style="width: 1vw" href="../assets/logo/hcmut-logo.png"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../assets/css/custom.css">
    <!-- Flag Icon -->
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang("Dashboard")</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
{{--              <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
              <li class="breadcrumb-item active">@lang("Dashboard")</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$hours_usage}}</h3>

                <p>@lang("Hours Usage (Devices)")</p>
              </div>
              <div class="icon">
                <i class="fas fa-clock"></i>
              </div>
              <a href="report" class="small-box-footer">@lang("More info") <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                  <h3>{{$electrical_consumption}}<sup>kwh</sup></h3>

                  <p>@lang("Electrical Consumption (Devices)")</p>
              </div>
              <div class="icon">
                <i class="fas fa-bolt"></i>
              </div>
              <a href="report" class="small-box-footer">@lang("More info") <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                          <a class="nav-link active" href="#real-time" data-toggle="tab">Real-time Temperature</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#real-time2" data-toggle="tab">Real-time Humidity</a>
                      </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="real-time"
                         style="position: relative; height: 300px;">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Celsius Degree
                            </h3>

                            <div class="card-tools">
                                Real time
                                <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="interactive" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="1486" height="600" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 743px; height: 300px;"></canvas><canvas class="flot-overlay" width="1486" height="600" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 743px; height: 300px;"></canvas><div class="flot-svg" style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;"><svg style="width: 100%; height: 100%;"><g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="28.0234375" y="293.96875" class="flot-tick-label tickLabel" transform="" style="position: absolute; text-align: center;">0</text><text x="95.05697601010101" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">10</text><text x="166.06707702020202" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">20</text><text x="237.07717803030303" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">30</text><text x="308.08727904040404" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">40</text><text x="379.0973800505051" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">50</text><text x="450.10748106060606" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">60</text><text x="521.1175820707072" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">70</text><text x="592.1276830808081" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">80</text><text x="663.1377840909091" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">90</text></g><g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="8.953125" y="268.03125" class="flot-tick-label tickLabel" transform="" style="position: absolute; text-align: right;">0</text><text x="1" y="217.63125" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;" transform="">20</text><text x="1" y="167.23125" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;" transform="">40</text><text x="1" y="116.83125" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;" transform="">60</text><text x="1" y="66.43125" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;" transform="">80</text><text x="-6.953125" y="16.03125" class="flot-tick-label tickLabel" transform="" style="position: absolute; text-align: right;">100</text></g></svg></div></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="real-time2"
                         style="position: relative; height: 300px;">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Percentage
                            </h3>

                            <div class="card-tools">
                                Real time
                                <div class="btn-group" id="realtime2" data-toggle="btn-toggle">
                                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="interactive2" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="1486" height="600" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 743px; height: 300px;"></canvas><canvas class="flot-overlay" width="1486" height="600" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 743px; height: 300px;"></canvas><div class="flot-svg" style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;"><svg style="width: 100%; height: 100%;"><g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="28.0234375" y="293.96875" class="flot-tick-label tickLabel" transform="" style="position: absolute; text-align: center;">0</text><text x="95.05697601010101" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">10</text><text x="166.06707702020202" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">20</text><text x="237.07717803030303" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">30</text><text x="308.08727904040404" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">40</text><text x="379.0973800505051" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">50</text><text x="450.10748106060606" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">60</text><text x="521.1175820707072" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">70</text><text x="592.1276830808081" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">80</text><text x="663.1377840909091" y="293.96875" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;" transform="">90</text></g><g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="8.953125" y="268.03125" class="flot-tick-label tickLabel" transform="" style="position: absolute; text-align: right;">0</text><text x="1" y="217.63125" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;" transform="">20</text><text x="1" y="167.23125" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;" transform="">40</text><text x="1" y="116.83125" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;" transform="">60</text><text x="1" y="66.43125" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;" transform="">80</text><text x="-6.953125" y="16.03125" class="flot-tick-label tickLabel" transform="" style="position: absolute; text-align: right;">100</text></g></svg></div></div>
                        </div>
                    </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
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
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../assets/plugins/moment/moment.min.js"></script>
<script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../assets/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="../assets/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../assets/plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../assets/plugins/flot-old/jquery.flot.pie.min.js"></script>
<!-- date-range-picker -->
<script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Navbar -->
@include("include/nav-extension")
<script>
    $(function () {

        $("#example1").DataTable({
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
@include("include/session-timeout")
@include("include/chatbot")
</body>
</html>
