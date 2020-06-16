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
{{--            <div class="col-lg-3 col-6">--}}
{{--                <!-- small box -->--}}
{{--                <div class="small-box bg-danger">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>34<sup style="font-size: 20px">&#8451</sup></h3>--}}

{{--                        <p>Temperature</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="fas fa-temperature-high"></i>--}}
{{--                    </div>--}}
{{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- ./col -->--}}
{{--          <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-info">--}}
{{--              <div class="inner">--}}
{{--                <h3>50<sup style="font-size: 20px">%</sup></h3>--}}

{{--                <p>Humidity</p>--}}
{{--              </div>--}}
{{--              <div class="icon">--}}
{{--                <i class="far fa-snowflake"></i>--}}
{{--              </div>--}}
{{--              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}
          <!-- ./col -->
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

                  <p>@lang("Electrical Consumption")</p>
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
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
{{--                <h3 class="card-title">--}}
{{--                  <i class="fas fa-chart-pie mr-1"></i>--}}
{{--                  Sales--}}
{{--                </h3>--}}
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
{{--                      <li class="nav-item">--}}
{{--                          <a class="nav-link" href="#backup-log" data-toggle="tab">Backup Log Table</a>--}}
{{--                      </li>--}}
                      <li class="nav-item">
                          <a class="nav-link active" href="#real-time" data-toggle="tab">Real-time Temperature</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#real-time2" data-toggle="tab">Real-time Humidity</a>
                      </li>
{{--                      <li class="nav-item">--}}
{{--                          <a class="nav-link" href="#temperature" data-toggle="tab">Average Temperature</a>--}}
{{--                      </li>--}}
{{--                    <li class="nav-item">--}}
{{--                      <a class="nav-link" href="#humidity" data-toggle="tab">Average Humidity</a>--}}
{{--                    </li>--}}
                      <li class="nav-item">
                          <a class="nav-link" href="#hours-usage" data-toggle="tab">Top Hours Usage</a>
                      </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#electrical-usage" data-toggle="tab">Top Electrical Usage</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                    <div class="chart tab-pane" id="backup-log"
                         style="position: relative; height: 300px; overflow: auto">
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
                                            <input type="checkbox" id="checkboxSuccess2">
                                            <label for="checkboxSuccess2">
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
                                            <input type="checkbox" id="checkboxSuccess3">
                                            <label for="checkboxSuccess3">
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
                                            <input type="checkbox" id="checkboxSuccess4">
                                            <label for="checkboxSuccess4">
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
                                            <input type="checkbox" id="checkboxSuccess5">
                                            <label for="checkboxSuccess5">
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
                                            <input type="checkbox" id="checkboxSuccess6">
                                            <label for="checkboxSuccess6">
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
                                            <input type="checkbox" id="checkboxSuccess7">
                                            <label for="checkboxSuccess7">
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
                                            <input type="checkbox" id="checkboxSuccess8">
                                            <label for="checkboxSuccess8">
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
                                            <input type="checkbox" id="checkboxSuccess9">
                                            <label for="checkboxSuccess9">
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

                    </div>
                    <div class="chart tab-pane active" id="real-time"
                         style="position: relative; height: 300px;">
                        {{--                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
{{--                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 344px;" width="688" height="500" class="chartjs-render-monitor"></canvas>--}}
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
                        {{--                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
                        {{--                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 344px;" width="688" height="500" class="chartjs-render-monitor"></canvas>--}}
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
                    <div class="chart tab-pane" id="temperature"
                         style="position: relative; height: 300px;">
                        {{--                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 344px;" width="688" height="500" class="chartjs-render-monitor"></canvas>
                    </div>
                  <div class="chart tab-pane" id="humidity"
                       style="position: relative; height: 300px;">
{{--                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
                      <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 344px;" width="688" height="500" class="chartjs-render-monitor"></canvas>
                   </div>
                    <div class="chart tab-pane" id="hours-usage" style="position: relative; height: 300px;">
                        {{--                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
                        <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block;" width="688" height="500" class="chartjs-render-monitor"></canvas>
                    </div>
                  <div class="chart tab-pane" id="electrical-usage" style="position: relative; height: 300px;">
{{--                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
                      <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 344px;" width="688" height="500" class="chartjs-render-monitor"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DIRECT CHAT -->
{{--            <div class="card direct-chat direct-chat-primary">--}}
{{--              <div class="card-header">--}}
{{--                <h3 class="card-title">Direct Chat</h3>--}}

{{--                <div class="card-tools">--}}
{{--                  <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>--}}
{{--                  <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                    <i class="fas fa-minus"></i>--}}
{{--                  </button>--}}
{{--                  <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"--}}
{{--                          data-widget="chat-pane-toggle">--}}
{{--                    <i class="fas fa-comments"></i>--}}
{{--                  </button>--}}
{{--                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>--}}
{{--                  </button>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <!-- /.card-header -->--}}
{{--              <div class="card-body">--}}
{{--                <!-- Conversations are loaded here -->--}}
{{--                <div class="direct-chat-messages">--}}
{{--                  <!-- Message. Default to the left -->--}}
{{--                  <div class="direct-chat-msg">--}}
{{--                    <div class="direct-chat-infos clearfix">--}}
{{--                      <span class="direct-chat-name float-left">Alexander Pierce</span>--}}
{{--                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-infos -->--}}
{{--                    <img class="direct-chat-img" src="../assets/img/user1-128x128.jpg" alt="message user image">--}}
{{--                    <!-- /.direct-chat-img -->--}}
{{--                    <div class="direct-chat-text">--}}
{{--                      Is this template really for free? That's unbelievable!--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-text -->--}}
{{--                  </div>--}}
{{--                  <!-- /.direct-chat-msg -->--}}

{{--                  <!-- Message to the right -->--}}
{{--                  <div class="direct-chat-msg right">--}}
{{--                    <div class="direct-chat-infos clearfix">--}}
{{--                      <span class="direct-chat-name float-right">Sarah Bullock</span>--}}
{{--                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-infos -->--}}
{{--                    <img class="direct-chat-img" src="../assets/img/user3-128x128.jpg" alt="message user image">--}}
{{--                    <!-- /.direct-chat-img -->--}}
{{--                    <div class="direct-chat-text">--}}
{{--                      You better believe it!--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-text -->--}}
{{--                  </div>--}}
{{--                  <!-- /.direct-chat-msg -->--}}

{{--                  <!-- Message. Default to the left -->--}}
{{--                  <div class="direct-chat-msg">--}}
{{--                    <div class="direct-chat-infos clearfix">--}}
{{--                      <span class="direct-chat-name float-left">Alexander Pierce</span>--}}
{{--                      <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-infos -->--}}
{{--                    <img class="direct-chat-img" src="../assets/img/user1-128x128.jpg" alt="message user image">--}}
{{--                    <!-- /.direct-chat-img -->--}}
{{--                    <div class="direct-chat-text">--}}
{{--                      Working with AdminLTE on a great new app! Wanna join?--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-text -->--}}
{{--                  </div>--}}
{{--                  <!-- /.direct-chat-msg -->--}}

{{--                  <!-- Message to the right -->--}}
{{--                  <div class="direct-chat-msg right">--}}
{{--                    <div class="direct-chat-infos clearfix">--}}
{{--                      <span class="direct-chat-name float-right">Sarah Bullock</span>--}}
{{--                      <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-infos -->--}}
{{--                    <img class="direct-chat-img" src="../assets/img/user3-128x128.jpg" alt="message user image">--}}
{{--                    <!-- /.direct-chat-img -->--}}
{{--                    <div class="direct-chat-text">--}}
{{--                      I would love to.--}}
{{--                    </div>--}}
{{--                    <!-- /.direct-chat-text -->--}}
{{--                  </div>--}}
{{--                  <!-- /.direct-chat-msg -->--}}

{{--                </div>--}}
{{--                <!--/.direct-chat-messages-->--}}

{{--                <!-- Contacts are loaded here -->--}}
{{--                <div class="direct-chat-contacts">--}}
{{--                  <ul class="contacts-list">--}}
{{--                    <li>--}}
{{--                      <a href="#">--}}
{{--                        <img class="contacts-list-img" src="../assets/img/user1-128x128.jpg">--}}

{{--                        <div class="contacts-list-info">--}}
{{--                          <span class="contacts-list-name">--}}
{{--                            Count Dracula--}}
{{--                            <small class="contacts-list-date float-right">2/28/2015</small>--}}
{{--                          </span>--}}
{{--                          <span class="contacts-list-msg">How have you been? I was...</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.contacts-list-info -->--}}
{{--                      </a>--}}
{{--                    </li>--}}
{{--                    <!-- End Contact Item -->--}}
{{--                    <li>--}}
{{--                      <a href="#">--}}
{{--                        <img class="contacts-list-img" src="../assets/img/user7-128x128.jpg">--}}

{{--                        <div class="contacts-list-info">--}}
{{--                          <span class="contacts-list-name">--}}
{{--                            Sarah Doe--}}
{{--                            <small class="contacts-list-date float-right">2/23/2015</small>--}}
{{--                          </span>--}}
{{--                          <span class="contacts-list-msg">I will be waiting for...</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.contacts-list-info -->--}}
{{--                      </a>--}}
{{--                    </li>--}}
{{--                    <!-- End Contact Item -->--}}
{{--                    <li>--}}
{{--                      <a href="#">--}}
{{--                        <img class="contacts-list-img" src="../assets/img/user3-128x128.jpg">--}}

{{--                        <div class="contacts-list-info">--}}
{{--                          <span class="contacts-list-name">--}}
{{--                            Nadia Jolie--}}
{{--                            <small class="contacts-list-date float-right">2/20/2015</small>--}}
{{--                          </span>--}}
{{--                          <span class="contacts-list-msg">I'll call you back at...</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.contacts-list-info -->--}}
{{--                      </a>--}}
{{--                    </li>--}}
{{--                    <!-- End Contact Item -->--}}
{{--                    <li>--}}
{{--                      <a href="#">--}}
{{--                        <img class="contacts-list-img" src="../assets/img/user5-128x128.jpg">--}}

{{--                        <div class="contacts-list-info">--}}
{{--                          <span class="contacts-list-name">--}}
{{--                            Nora S. Vans--}}
{{--                            <small class="contacts-list-date float-right">2/10/2015</small>--}}
{{--                          </span>--}}
{{--                          <span class="contacts-list-msg">Where is your new...</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.contacts-list-info -->--}}
{{--                      </a>--}}
{{--                    </li>--}}
{{--                    <!-- End Contact Item -->--}}
{{--                    <li>--}}
{{--                      <a href="#">--}}
{{--                        <img class="contacts-list-img" src="../assets/img/user6-128x128.jpg">--}}

{{--                        <div class="contacts-list-info">--}}
{{--                          <span class="contacts-list-name">--}}
{{--                            John K.--}}
{{--                            <small class="contacts-list-date float-right">1/27/2015</small>--}}
{{--                          </span>--}}
{{--                          <span class="contacts-list-msg">Can I take a look at...</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.contacts-list-info -->--}}
{{--                      </a>--}}
{{--                    </li>--}}
{{--                    <!-- End Contact Item -->--}}
{{--                    <li>--}}
{{--                      <a href="#">--}}
{{--                        <img class="contacts-list-img" src="../assets/img/user8-128x128.jpg">--}}

{{--                        <div class="contacts-list-info">--}}
{{--                          <span class="contacts-list-name">--}}
{{--                            Kenneth M.--}}
{{--                            <small class="contacts-list-date float-right">1/4/2015</small>--}}
{{--                          </span>--}}
{{--                          <span class="contacts-list-msg">Never mind I found...</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.contacts-list-info -->--}}
{{--                      </a>--}}
{{--                    </li>--}}
{{--                    <!-- End Contact Item -->--}}
{{--                  </ul>--}}
{{--                  <!-- /.contacts-list -->--}}
{{--                </div>--}}
{{--                <!-- /.direct-chat-pane -->--}}
{{--              </div>--}}
{{--              <!-- /.card-body -->--}}
{{--              <div class="card-footer">--}}
{{--                <form action="#" method="post">--}}
{{--                  <div class="input-group">--}}
{{--                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">--}}
{{--                    <span class="input-group-append">--}}
{{--                      <button type="button" class="btn btn-primary">Send</button>--}}
{{--                    </span>--}}
{{--                  </div>--}}
{{--                </form>--}}
{{--              </div>--}}
{{--              <!-- /.card-footer-->--}}
{{--            </div>--}}
            <!--/.direct-chat -->

            <!-- TO DO List -->
{{--            <div class="card">--}}
{{--              <div class="card-header">--}}
{{--                <h3 class="card-title">--}}
{{--                  <i class="ion ion-clipboard mr-1"></i>--}}
{{--                  To Do List--}}
{{--                </h3>--}}

{{--                <div class="card-tools">--}}
{{--                  <ul class="pagination pagination-sm">--}}
{{--                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">1</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">2</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">3</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>--}}
{{--                  </ul>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <!-- /.card-header -->--}}
{{--              <div class="card-body">--}}
{{--                <ul class="todo-list" data-widget="todo-list">--}}
{{--                  <li>--}}
{{--                    <!-- drag handle -->--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                    <!-- checkbox -->--}}
{{--                    <div  class="icheck-primary d-inline ml-2">--}}
{{--                      <input type="checkbox" value="" name="todo1" id="todoCheck1">--}}
{{--                      <label for="todoCheck1"></label>--}}
{{--                    </div>--}}
{{--                    <!-- todo text -->--}}
{{--                    <span class="text">Design a nice theme</span>--}}
{{--                    <!-- Emphasis label -->--}}
{{--                    <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>--}}
{{--                    <!-- General tools such as edit or delete-->--}}
{{--                    <div class="tools">--}}
{{--                      <i class="fas fa-edit"></i>--}}
{{--                      <i class="fas fa-trash-o"></i>--}}
{{--                    </div>--}}
{{--                  </li>--}}
{{--                  <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                    <div  class="icheck-primary d-inline ml-2">--}}
{{--                      <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>--}}
{{--                      <label for="todoCheck2"></label>--}}
{{--                    </div>--}}
{{--                    <span class="text">Make the theme responsive</span>--}}
{{--                    <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>--}}
{{--                    <div class="tools">--}}
{{--                      <i class="fas fa-edit"></i>--}}
{{--                      <i class="fas fa-trash-o"></i>--}}
{{--                    </div>--}}
{{--                  </li>--}}
{{--                  <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                    <div  class="icheck-primary d-inline ml-2">--}}
{{--                      <input type="checkbox" value="" name="todo3" id="todoCheck3">--}}
{{--                      <label for="todoCheck3"></label>--}}
{{--                    </div>--}}
{{--                    <span class="text">Let theme shine like a star</span>--}}
{{--                    <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>--}}
{{--                    <div class="tools">--}}
{{--                      <i class="fas fa-edit"></i>--}}
{{--                      <i class="fas fa-trash-o"></i>--}}
{{--                    </div>--}}
{{--                  </li>--}}
{{--                  <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                    <div  class="icheck-primary d-inline ml-2">--}}
{{--                      <input type="checkbox" value="" name="todo4" id="todoCheck4">--}}
{{--                      <label for="todoCheck4"></label>--}}
{{--                    </div>--}}
{{--                    <span class="text">Let theme shine like a star</span>--}}
{{--                    <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>--}}
{{--                    <div class="tools">--}}
{{--                      <i class="fas fa-edit"></i>--}}
{{--                      <i class="fas fa-trash-o"></i>--}}
{{--                    </div>--}}
{{--                  </li>--}}
{{--                  <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                    <div  class="icheck-primary d-inline ml-2">--}}
{{--                      <input type="checkbox" value="" name="todo5" id="todoCheck5">--}}
{{--                      <label for="todoCheck5"></label>--}}
{{--                    </div>--}}
{{--                    <span class="text">Check your messages and notifications</span>--}}
{{--                    <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>--}}
{{--                    <div class="tools">--}}
{{--                      <i class="fas fa-edit"></i>--}}
{{--                      <i class="fas fa-trash-o"></i>--}}
{{--                    </div>--}}
{{--                  </li>--}}
{{--                  <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                    <div  class="icheck-primary d-inline ml-2">--}}
{{--                      <input type="checkbox" value="" name="todo6" id="todoCheck6">--}}
{{--                      <label for="todoCheck6"></label>--}}
{{--                    </div>--}}
{{--                    <span class="text">Let theme shine like a star</span>--}}
{{--                    <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>--}}
{{--                    <div class="tools">--}}
{{--                      <i class="fas fa-edit"></i>--}}
{{--                      <i class="fas fa-trash-o"></i>--}}
{{--                    </div>--}}
{{--                  </li>--}}
{{--                </ul>--}}
{{--              </div>--}}
{{--              <!-- /.card-body -->--}}
{{--              <div class="card-footer clearfix">--}}
{{--                <button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</button>--}}
{{--              </div>--}}
{{--            </div>--}}
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
{{--          <section class="col-lg-5 connectedSortable">--}}

{{--            <!-- Map card -->--}}
{{--            <div class="card bg-gradient-primary">--}}
{{--              <div class="card-header border-0">--}}
{{--                <h3 class="card-title">--}}
{{--                  <i class="fas fa-map-marker-alt mr-1"></i>--}}
{{--                  HCMUT--}}
{{--                </h3>--}}
{{--                <!-- card tools -->--}}
{{--                <div class="card-tools">--}}
{{--                  <button type="button"--}}
{{--                          class="btn btn-primary btn-sm daterange"--}}
{{--                          data-toggle="tooltip"--}}
{{--                          title="Date range">--}}
{{--                    <i class="far fa-calendar-alt"></i>--}}
{{--                  </button>--}}
{{--                  <button type="button"--}}
{{--                          class="btn btn-primary btn-sm"--}}
{{--                          data-card-widget="collapse"--}}
{{--                          data-toggle="tooltip"--}}
{{--                          title="Collapse">--}}
{{--                    <i class="fas fa-minus"></i>--}}
{{--                  </button>--}}
{{--                </div>--}}
{{--                <!-- /.card-tools -->--}}
{{--              </div>--}}
{{--              <div class="card-body">--}}
{{--                <div id="world-map" style="height: 250px; width: 100%;"></div>--}}
{{--              </div>--}}
{{--              <!-- /.card-body-->--}}
{{--              <div class="card-footer bg-transparent">--}}
{{--                <div class="row">--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <div id="sparkline-1"></div>--}}
{{--                    <div class="text-white">Visitors</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <div id="sparkline-2"></div>--}}
{{--                    <div class="text-white">Online</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <div id="sparkline-3"></div>--}}
{{--                    <div class="text-white">Sales</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                </div>--}}
{{--                <!-- /.row -->--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <!-- /.card -->--}}

{{--            <!-- solid sales graph -->--}}
{{--            <div class="card bg-gradient-info">--}}
{{--              <div class="card-header border-0">--}}
{{--                <h3 class="card-title">--}}
{{--                  <i class="fas fa-th mr-1"></i>--}}
{{--                  Sales Graph--}}
{{--                </h3>--}}

{{--                <div class="card-tools">--}}
{{--                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">--}}
{{--                    <i class="fas fa-minus"></i>--}}
{{--                  </button>--}}
{{--                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">--}}
{{--                    <i class="fas fa-times"></i>--}}
{{--                  </button>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="card-body">--}}
{{--                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
{{--              </div>--}}
{{--              <!-- /.card-body -->--}}
{{--              <div class="card-footer bg-transparent">--}}
{{--                <div class="row">--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"--}}
{{--                           data-fgColor="#39CCCC">--}}

{{--                    <div class="text-white">Mail-Orders</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"--}}
{{--                           data-fgColor="#39CCCC">--}}

{{--                    <div class="text-white">Online</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"--}}
{{--                           data-fgColor="#39CCCC">--}}

{{--                    <div class="text-white">In-Store</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                </div>--}}
{{--                <!-- /.row -->--}}
{{--              </div>--}}
{{--              <!-- /.card-footer -->--}}
{{--            </div>--}}
{{--            <!-- /.card -->--}}

{{--            <!-- Calendar -->--}}
{{--            <div class="card bg-gradient-success">--}}
{{--              <div class="card-header border-0">--}}

{{--                <h3 class="card-title">--}}
{{--                  <i class="far fa-calendar-alt"></i>--}}
{{--                  Calendar--}}
{{--                </h3>--}}
{{--                <!-- tools card -->--}}
{{--                <div class="card-tools">--}}
{{--                  <!-- button with a dropdown -->--}}
{{--                  <div class="btn-group">--}}
{{--                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">--}}
{{--                      <i class="fas fa-bars"></i></button>--}}
{{--                    <div class="dropdown-menu float-right" role="menu">--}}
{{--                      <a href="#" class="dropdown-item">Add new event</a>--}}
{{--                      <a href="#" class="dropdown-item">Clear events</a>--}}
{{--                      <div class="dropdown-divider"></div>--}}
{{--                      <a href="#" class="dropdown-item">View calendar</a>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">--}}
{{--                    <i class="fas fa-minus"></i>--}}
{{--                  </button>--}}
{{--                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">--}}
{{--                    <i class="fas fa-times"></i>--}}
{{--                  </button>--}}
{{--                </div>--}}
{{--                <!-- /. tools -->--}}
{{--              </div>--}}
{{--              <!-- /.card-header -->--}}
{{--              <div class="card-body pt-0">--}}
{{--                <!--The calendar -->--}}
{{--                <div id="calendar" style="width: 100%"></div>--}}
{{--              </div>--}}
{{--              <!-- /.card-body -->--}}
{{--            </div>--}}
{{--            <!-- /.card -->--}}
{{--          </section>--}}
          <!-- right col -->
            <section class="col-lg-12 connectedSortable">
                <div class="container-fluid">

                    <!-- Timelime example  -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <div class="timeline">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-primary"><a href="report">A4 Building - HCMUT</a></span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-building bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> Cập nhật cấu trúc tầng ngày 11/05/2020</span>
                                        <h3 class="timeline-header text-danger text-bold"><a href="report-floor">Floor 5</a></h3>

                                        <div class="timeline-body">
                                            Floor with 5 studying rooms with 1 library
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="report-room" class="btn btn-primary btn-lg">Room 500</a>
                                            <a href="report-room" class="btn btn-info btn-lg">Room 501</a>
                                            <a href="report-room" class="btn btn-success btn-lg">Room 502</a>
                                            <a href="report-room" class="btn btn-info btn-lg">Room 503</a>
                                            <a href="report-room" class="btn btn-danger btn-lg">Room 504</a>
                                            <a href="report-room" class="btn btn-warning btn-lg">Library 505</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-building bg-warning"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> Cập nhật cấu trúc tầng ngày 11/05/2020</span>
                                        <h3 class="timeline-header text-danger text-bold"><a href="report-floor">Floor 4</a></h3>

                                        <div class="timeline-body">
                                            Floor with 3 studying rooms (the rest is being renewed)
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="report-room" class="btn btn-primary btn-lg">Room 400</a>
                                            <a href="report-room" class="btn btn-info btn-lg">Room 401</a>
                                            <a href="report-room" class="btn btn-success btn-lg">Room 402</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 403</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 404</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 405</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-building bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> Cập nhật cấu trúc tầng ngày 11/05/2020</span>
                                        <h3 class="timeline-header text-danger text-bold"><a href="report-floor">Floor 3</a></h3>

                                        <div class="timeline-body">
                                            Floor with 6 studying rooms
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="report-room" class="btn btn-primary btn-lg">Room 300</a>
                                            <a href="report-room" class="btn btn-info btn-lg">Room 301</a>
                                            <a href="report-room" class="btn btn-success btn-lg">Room 302</a>
                                            <a href="report-room" class="btn btn-info btn-lg">Room 303</a>
                                            <a href="report-room" class="btn btn-danger btn-lg">Room 304</a>
                                            <a href="report-room" class="btn btn-warning btn-lg">Room 305</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-building bg-danger"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> Cập nhật cấu trúc tầng ngày 11/05/2020</span>
                                        <h3 class="timeline-header text-danger text-bold"><a href="report-floor">Floor 2</a></h3>

                                        <div class="timeline-body">
                                            Shut down temporarily for quarantine (corona virus)
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-secondary btn-lg maintenance">Room 200</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 201</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 202</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 203</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 204</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 205</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-building bg-danger"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> Cập nhật cấu trúc tầng ngày 11/05/2020</span>
                                        <h3 class="timeline-header text-danger text-bold"><a href="report-floor">Floor 1</a></h3>

                                        <div class="timeline-body">
                                            Shut down temporarily for quarantine (corona virus)
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-secondary btn-lg maintenance">Room 100</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 101</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 102</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 103</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 104</a>
                                            <a class="btn btn-secondary btn-lg maintenance">Room 105</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-building bg-secondary"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> Cập nhật cấu trúc tầng ngày 11/05/2020</span>
                                        <h3 class="timeline-header text-danger text-bold"><a href="report-floor">Ground Floor</a></h3>

                                        <div class="timeline-body">
                                            Admin Room Only
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="report-room" class="btn btn-primary btn-lg">Admin Room</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
{{--                                <div>--}}
{{--                                    <i class="fas fa-user bg-green"></i>--}}
{{--                                    <div class="timeline-item">--}}
{{--                                        <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>--}}
{{--                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- END timeline item -->--}}
{{--                                <!-- timeline item -->--}}
{{--                                <div>--}}
{{--                                    <i class="fas fa-comments bg-yellow"></i>--}}
{{--                                    <div class="timeline-item">--}}
{{--                                        <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>--}}
{{--                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>--}}
{{--                                        <div class="timeline-body">--}}
{{--                                            Take me to your leader!--}}
{{--                                            Switzerland is small and neutral!--}}
{{--                                            We are more like Germany, ambitious and misunderstood!--}}
{{--                                        </div>--}}
{{--                                        <div class="timeline-footer">--}}
{{--                                            <a class="btn btn-warning btn-sm">View comment</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- END timeline item -->--}}
{{--                                <!-- timeline time label -->--}}
{{--                                <div class="time-label">--}}
{{--                                    <span class="bg-green">3 Jan. 2014</span>--}}
{{--                                </div>--}}
{{--                                <!-- /.timeline-label -->--}}
{{--                                <!-- timeline item -->--}}
{{--                                <div>--}}
{{--                                    <i class="fa fa-camera bg-purple"></i>--}}
{{--                                    <div class="timeline-item">--}}
{{--                                        <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>--}}
{{--                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>--}}
{{--                                        <div class="timeline-body">--}}
{{--                                            <img src="http://placehold.it/150x100" alt="...">--}}
{{--                                            <img src="http://placehold.it/150x100" alt="...">--}}
{{--                                            <img src="http://placehold.it/150x100" alt="...">--}}
{{--                                            <img src="http://placehold.it/150x100" alt="...">--}}
{{--                                            <img src="http://placehold.it/150x100" alt="...">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- END timeline item -->--}}
{{--                                <!-- timeline item -->--}}
{{--                                <div>--}}
{{--                                    <i class="fas fa-video bg-maroon"></i>--}}

{{--                                    <div class="timeline-item">--}}
{{--                                        <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>--}}

{{--                                        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>--}}

{{--                                        <div class="timeline-body">--}}
{{--                                            <div class="embed-responsive embed-responsive-16by9">--}}
{{--                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen=""></iframe>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="timeline-footer">--}}
{{--                                            <a href="#" class="btn btn-sm bg-maroon">See comments</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <!-- END timeline item -->
                                <div>
                                    <i class="fas fa-building bg-gray"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.timeline -->

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
</body>
</html>
