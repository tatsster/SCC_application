<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | @lang("Room")</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" style="width: 1vw" href="../assets/logo/hcmut-logo.png"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../assets/css/custom.css">
    <!-- Flag Icon -->
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../assets/plugins/toastr/toastr.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Extract -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
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
            <h1>@lang("Room ") {{ session("1752051_room_name") }}, @lang("Floor ") {{ session("1752051_room_floor") }}, @lang("Building ") {{ session("1752051_room_building") }}</h1>
              @if (session("1752051_user_role")["permission_create_building_floor_room"])
                  <br>
                  <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addSensor" > <i class="fas fa-temperature-high"></i> @lang("Add Sensor")</button>
                  <button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target="#addDevice" > <i class="fas fa-cog"></i> @lang("Add Device")</button>
                  <div class="modal fade" id="addSensor" tabindex="-1" role="dialog" aria-labelledby="addSensorLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <form action="create-sensor" method="post">
                                  {{csrf_field()}}
                                  <div class="modal-header">
                                      <h5 class="modal-title text-danger" id="exampleModalLabel">@lang("Add Sensor")</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                          <div class="form-group">
                                              <label for="add-sensor-id" class="col-form-label">@lang("Sensor ID:")</label>
                                              <input type="text" name="sensor_id" class="form-control" id="add-sensor-id">
                                          </div>
                                          <div class="form-group">
                                              <label for="add-sensor-name" class="col-form-label">@lang("Sensor name:")</label>
                                              <input type="text" name="sensor_name" class="form-control" id="add-sensor-name">
                                          </div>
                                          <div class="form-group">
                                              <label for="add-sensor-ip" class="col-form-label">@lang("MQTT IP:")</label>
                                              <input type="text" name="sensor_ip" class="form-control" id="add-sensor-ip">
                                          </div>
                                          <div class="form-group">
                                              <label for="add-sensor-port" class="col-form-label">@lang("MQTT port:")</label>
                                              <input type="number" name="sensor_port" class="form-control" id="add-sensor-port">
                                          </div>
                                          <div class="form-group">
                                              <label for="add-sensor-topic" class="col-form-label">@lang("MQTT Topic:")</label>
                                              <input type="text" name="sensor_topic" class="form-control" id="add-sensor-topic">
                                          </div>
                                          <div class="form-group">
                                              <label for="add-sensor-username" class="col-form-label">@lang("MQTT Username:")</label>
                                              <input type="text" name="sensor_username" class="form-control" id="add-sensor-username">
                                          </div>
                                          <div class="form-group">
                                              <label for="add-sensor-password" class="col-form-label">@lang("MQTT Password:")</label>
                                              <input type="text" name="sensor_password" class="form-control" id="add-sensor-password">
                                          </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang("Close")</button>
                                      <button type="submit" class="btn btn-primary">@lang("Create")</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="modal fade" id="addDevice" tabindex="-1" role="dialog" aria-labelledby="addSensorLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <form action="create-device" method="post">
                                  {{csrf_field()}}
                                  <div class="modal-header">
                                      <h5 class="modal-title text-danger" id="exampleModalLabel">@lang("Add Device")</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label for="add-device-id" class="col-form-label">@lang("Device ID:")</label>
                                          <input type="text" name="device_id" class="form-control" id="add-device-id">
                                      </div>
                                      <div class="form-group">
                                          <label for="add-device-name" class="col-form-label">@lang("Device name:")</label>
                                          <input type="text" name="device_name" class="form-control" id="add-device-name">
                                      </div>
                                      <div class="form-group">
                                          <label for="add-device-kwh" class="col-form-label">@lang("Device Electrical Consumption (KWH):")</label>
                                          <input type="text" name="device_kwh" class="form-control" id="add-device-kwh">
                                      </div>
                                      <div class="form-group">
                                          <label for="add-device-status-value" class="col-form-label">@lang("Device Status Value:")</label>
                                          <input type="text" name="device_status_value" class="form-control" id="add-device-status-value">
                                      </div>
                                      <div class="form-group">
                                          <label for="add-device-ip" class="col-form-label">@lang("MQTT IP:")</label>
                                          <input type="text" name="device_ip" class="form-control" id="add-device-ip">
                                      </div>
                                      <div class="form-group">
                                          <label for="add-device-port" class="col-form-label">@lang("MQTT port:")</label>
                                          <input type="number" name="device_port" class="form-control" id="add-device-port">
                                      </div>
                                      <div class="form-group">
                                          <label for="add-device-topic" class="col-form-label">@lang("MQTT Topic:")</label>
                                          <input type="text" name="device_topic" class="form-control" id="add-device-topic">
                                      </div>
                                      <div class="form-group">
                                          <label for="add-device-username" class="col-form-label">@lang("MQTT Username:")</label>
                                          <input type="text" name="device_username" class="form-control" id="add-device-username">
                                      </div>
                                      <div class="form-group">
                                          <label for="add-device-password" class="col-form-label">@lang("MQTT Password:")</label>
                                          <input type="text" name="device_password" class="form-control" id="add-device-password">
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang("Close")</button>
                                      <button type="submit" class="btn btn-primary">@lang("Create")</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              @endif
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">@lang("Dashboard")</a></li>
                <li class="breadcrumb-item"><a href="report">@lang("Report")</a></li>
              <li class="breadcrumb-item active">@lang("Room")</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
          </div>
          <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            {{--                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>--}}
                            @if( session("1752051_current_room_tab") == 0)
                                <li class="nav-item"><a class="nav-link active" onclick="currentTab(0)" href="#sensors" data-toggle="tab">@lang("Sensors")</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" onclick="currentTab(0)" href="#sensors" data-toggle="tab">@lang("Sensors")</a></li>
                            @endif
                            @if( session("1752051_current_room_tab") == 1)
                                <li class="nav-item"><a class="nav-link active" onclick="currentTab(1)" href="#devices" data-toggle="tab">@lang("Devices")</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" onclick="currentTab(1)" href="#devices" data-toggle="tab">@lang("Devices")</a></li>
                            @endif
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            @if( session("1752051_current_room_tab") == 0)
                                <div class="tab-pane active" id="sensors">
                            @else
                                <div class="tab-pane" id="sensors">
                            @endif
                                <select id="select2bs4-sensor" class="form-control select2bs4" style="width: 100%;">
                                    @if (session("1752051_current_sensor")["sensor_id"] == "")
                                        <option></option>
                                    @endif
                                    @foreach( $sensor_db as $sensor_each)
                                        @if (session("1752051_current_sensor")["sensor_id"] == $sensor_each["sensor_id"])
                                            <option selected value="{{{$sensor_each["sensor_id"]}}}">{{$sensor_each["sensor_name"]}} ({{$sensor_each["sensor_id"]}})</option>
                                        @else
                                            <option value="{{{$sensor_each["sensor_id"]}}}">{{$sensor_each["sensor_name"]}} ({{$sensor_each["sensor_id"]}})</option>
                                        @endif
                                    @endforeach
                                </select>

                                <br>

{{--                                    <h1>{{session("1752051_current_sensor_log")}}</h1>--}}

                                @if (session("1752051_current_sensor")["sensor_id"] != "")

                                    <div class="chart tab-pane" id="backup-log">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang("Sensor Log")</h3>
                                            @if (session("1752051_current_sensor")["sensor_pid"] == null && session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                <button type="button" onclick="deleteAllLog('@lang("Are you sure?")','@lang("You might not want to delete all log of "){{{ session("1752051_current_sensor")["sensor_id"] }}} !!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted all log of ") {{{ session("1752051_current_sensor")["sensor_id"] }}} !!!','@lang("OK")',0)" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-trash"></i> @lang("Delete all records")
                                                </button>
                                            @elseif (session("1752051_current_sensor")["sensor_pid"] != null)
                                                <button type="button" data-target="#modal-danger" class="btn btn-secondary btn-sm float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-spinner fa-pulse"></i> @lang("Running")
                                                </button>
                                            @endif
                                        </div>

                                        <section class="col-lg-12 connectedSortable">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-tools">
                                                        <ul class="nav nav-pills ml-auto">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" href="#real-time-temperature" data-toggle="tab">@lang('Real-time Temperature')</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#real-time-humidity" data-toggle="tab">@lang('Real-time Humidity')</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#real-time-heat-index" data-toggle="tab">@lang('Real-time Heat Index')</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#all-records-temperature" data-toggle="tab">@lang('All Temperature Records')</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#all-records-humidity" data-toggle="tab">@lang('All Humidity Records')</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#all-records-heat-index" data-toggle="tab">@lang('All Heat Index Records')</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="tab-content p-0">
                                                        <!-- Morris chart - Sales -->
                                                        <div class="chart tab-pane active" id="real-time-temperature">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <i class="far fa-chart-bar"></i>
                                                                    @lang('Celsius Degree')
                                                                </h3>

                                                                <div class="card-tools">
                                                                    <div class="label">@lang("Stream Duration:")</div>
                                                                    {{--                                                                        <span id="durationValue" class="value">20000</span>--}}
                                                                    <span><input type="range" min="1000" max="60000" step="100" value="20000" id="duration-temperature" class="control"></span>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div>
                                                                    @lang('Pause:')&nbsp;
                                                                    <div class="btn-group" id="temperature" data-toggle="btn-toggle">
                                                                        <input type="checkbox" class="control" id="pause-temperature">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <canvas id="chart-real-time-temperature"></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="chart tab-pane" id="real-time-humidity">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <i class="far fa-chart-bar"></i>
                                                                    %
                                                                </h3>

                                                                <div class="card-tools">
                                                                    <div class="label">@lang("Stream Duration:")</div>
                                                                    {{--                                                                        <span id="durationValue" class="value">20000</span>--}}
                                                                    <span><input type="range" min="1000" max="60000" step="100" value="20000" id="duration-humidity" class="control"></span>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div>
                                                                    @lang('Pause:')&nbsp;
                                                                    <div class="btn-group" id="humidity" data-toggle="btn-toggle">
                                                                        <input type="checkbox" class="control" id="pause-humidity">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <canvas id="chart-real-time-humidity"></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="chart tab-pane" id="real-time-heat-index">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <i class="far fa-chart-bar"></i>
                                                                    %
                                                                </h3>

                                                                <div class="card-tools">
                                                                    <div class="label">@lang("Stream Duration:")</div>
                                                                    {{--                                                                        <span id="durationValue" class="value">20000</span>--}}
                                                                    <span><input type="range" min="1000" max="60000" step="100" value="20000" id="duration-heat-index" class="control"></span>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div>
                                                                    @lang('Pause:')&nbsp;
                                                                    <div class="btn-group" id="heat-index" data-toggle="btn-toggle">
                                                                        <input type="checkbox" class="control" id="pause-heat-index">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <canvas id="chart-real-time-heat-index"></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="chart tab-pane" id="all-records-temperature">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <i class="far fa-chart-bar"></i>
                                                                    @lang('Celsius Degree')
                                                                </h3>

                                                                <div class="card-tools">
                                                                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                                                        <button onclick="resetZoomTemperature()" type="button" class="btn btn-default btn-sm active" data-toggle="on">@lang("Refresh Zoom")</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="chart-all-records-temperature"></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="chart tab-pane" id="all-records-humidity">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <i class="far fa-chart-bar"></i>
                                                                    %
                                                                </h3>

                                                                <div class="card-tools">
                                                                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                                                        <button onclick="resetZoomHumidity()" type="button" class="btn btn-default btn-sm active" data-toggle="on">@lang("Refresh Zoom")</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="chart-all-records-humidity"></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="chart tab-pane" id="all-records-heat-index">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <i class="far fa-chart-bar"></i>
                                                                    %
                                                                </h3>

                                                                <div class="card-tools">
                                                                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                                                        <button onclick="resetZoomHeatIndex()" type="button" class="btn btn-default btn-sm active" data-toggle="on">@lang("Refresh Zoom")</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="chart-all-records-heat-index"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->

                                        </section>

                                        <div class="card-body">
                                            <form action="sensor-search-time-range" method="post">
                                                {{ csrf_field() }}
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                    </div>
                                                    <input type="hidden" name="sensor_id" value="{{{ session("1752051_current_sensor")["sensor_id"] }}}">
                                                    <input type="text" name="sensor_time_range" class="form-control float-right" id="reservationtime-sensor">
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-sm float-right" style="margin-right: 5px;">
                                                    @lang("Apply time range")
                                                </button>
                                            </form>
                                            <button type="button" onclick="refreshSensor()" class="btn btn-info btn-sm float-right" style="margin-right: 5px;">
                                                @lang("Refresh")
                                            </button>
                                        </div>


                                        <div class="card-body">
                                            <table id="sensor-table" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        @if (session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                            @if (session("1752051_current_sensor")["sensor_pid"] == null)
                                                                <div class="icheck-success d-inline">
                                                                    <input type="checkbox" onclick="checkAllCheckBox(0,0)" id="check-mark-sensor-upper">
                                                                    <label for="check-mark-sensor-upper">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </th>
                                                    <th>@lang("Order")</th>
                                                    <th>@lang("Sensor ID")</th>
                                                    <th>@lang("Sensor Temperature")</th>
                                                    <th>@lang("Sensor Humidity")</th>
                                                    <th>@lang("Heat Index")</th>
                                                    <th>@lang("Date")</th>
                                                    <th>
                                                        @if (session("1752051_current_sensor")["sensor_pid"] == null && session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                            <button onclick="deleteLog('@lang("Are you sure?")','@lang("You might not want to delete these sensor logs !!!")','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted these sensor logs !!!")','@lang("OK")',0,'check-mark-sensor')" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                                @lang("Delete selected")
                                                            </button>
                                                        @elseif (session("1752051_current_sensor")["sensor_pid"] != null)
                                                            <button type="button" data-target="#modal-danger" class="btn btn-secondary btn-sm float-right" style="margin-right: 5px;">
                                                                <i class="fas fa-spinner fa-pulse"></i> @lang("Running")
                                                            </button>
                                                        @endif
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="sensor-tbody">
{{--                                                @php--}}

{{--                                                dd(session("1752051_current_sensor_log"))--}}

{{--                                                    @endphp--}}
                                                <script>
                                                    var staticTemperatureData = [];
                                                    var staticHumidityData = [];
                                                    var staticHeatIndexData = [];
                                                </script>
                                                @foreach (session("1752051_current_sensor_log") as $each)
                                                    <script>
                                                        staticTemperatureData.push({
                                                                x: parseInt("{{{ $each["sensor_timestamp"] }}}") * 1000,
                                                                y: parseFloat("{{{ $each["sensor_temp"] }}}"),
                                                            }
                                                        );

                                                        staticHumidityData.push({
                                                                x: parseInt("{{{ $each["sensor_timestamp"] }}}") * 1000,
                                                                y: parseFloat("{{{ $each["sensor_humid"] }}}"),
                                                            }
                                                        );

                                                        staticHeatIndexData.push({
                                                                x: parseInt("{{{ $each["sensor_timestamp"] }}}") * 1000,
                                                                y: parseFloat("{{{ $each["sensor_heat_index"] }}}"),
                                                            }
                                                        );
                                                    </script>
                                                    <tr>
                                                        <td class="text-center">
                                                            @if (session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                                @if (session("1752051_current_sensor")["sensor_pid"] == null)
                                                                    <div class="icheck-success d-inline">
                                                                        <input value="{{{ $each["sensor_order"] }}}" type="checkbox" class="check-mark-sensor">
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>{{ $each["sensor_order"] }}</td>
                                                        <td>{{ $each["sensor_id"] }}</td>
                                                        <td>{{ $each["sensor_temp"] }}</td>
                                                        <td>{{ $each["sensor_humid"] }}</td>
                                                        <td>{{ $each["sensor_heat_index"] }}</td>
                                                        @if ($loop->iteration == 1)
                                                            <input type="hidden" id="newest-timestamp-sensor" value="{{{ $each["sensor_timestamp"] }}}">
                                                        @endif
                                                        <td> @php echo date('d/m/Y H:i:s', $each["sensor_timestamp"]); @endphp </td>
                                                        <td class="project-actions text-left">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="text-center">
                                                        @if (session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                            @if (session("1752051_current_sensor")["sensor_pid"] == null)
                                                                <div class="icheck-success d-inline">
                                                                    <input type="checkbox" onclick="checkAllCheckBox(0,1)" id="check-mark-sensor-lower">
                                                                    <label for="check-mark-sensor-lower">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </th>
                                                    <th>@lang("Order")</th>
                                                    <th>@lang("Sensor ID")</th>
                                                    <th>@lang("Sensor Temperature")</th>
                                                    <th>@lang("Sensor Humidity")</th>
                                                    <th>@lang("Heat Index")</th>
                                                    <th>@lang("Date")</th>
                                                    <th>
                                                        @if (session("1752051_current_sensor")["sensor_pid"] == null && session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                            <button onclick="deleteLog('@lang("Are you sure?")','@lang("You might not want to delete these sensor logs !!!")','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted these sensor logs !!!")','@lang("OK")',0,'check-mark-sensor')" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                                @lang("Delete selected")
                                                            </button>
                                                        @elseif (session("1752051_current_sensor")["sensor_pid"] != null)
                                                            <button type="button" data-target="#modal-danger" class="btn btn-secondary btn-sm float-right" style="margin-right: 5px;">
                                                                <i class="fas fa-spinner fa-pulse"></i> @lang("Running")
                                                            </button>
                                                        @endif
                                                    </th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>

                                    <br>

                                    <form action="update-sensor" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="sensor-id" class="col-form-label">@lang("Sensor ID:")</label>
                                                <input value="{{{ session("1752051_current_sensor")["sensor_id"] }}}" type="text" name="sensor_id" class="form-control" id="sensor-id">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="sensor-name" class="col-form-label">@lang("Sensor name:")</label>
                                                <input value="{{{ session("1752051_current_sensor")["sensor_name"] }}}" type="text" name="sensor_name" class="form-control" id="sensor-name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="sensor-ip" class="col-form-label">@lang("MQTT IP:")</label>
                                                <input value="{{{ session("1752051_current_sensor")["sensor_ip"] }}}" type="text" name="sensor_ip" class="form-control" id="sensor-ip">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="sensor-port" class="col-form-label">@lang("MQTT port:")</label>
                                                <input value="{{{ session("1752051_current_sensor")["sensor_port"] }}}" type="number" name="sensor_port" class="form-control" id="sensor-port">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="sensor-topic" class="col-form-label">@lang("MQTT Topic:")</label>
                                                <input value="{{{ session("1752051_current_sensor")["sensor_topic"] }}}" type="text" name="sensor_topic" class="form-control" id="sensor-topic">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="sensor-username" class="col-form-label">@lang("MQTT Username:")</label>
                                                <input value="{{{ session("1752051_current_sensor")["sensor_username"] }}}" type="text" name="sensor_username" class="form-control" id="sensor-username">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="sensor-password" class="col-form-label">@lang("MQTT Password:")</label>
                                                <input value="{{{ session("1752051_current_sensor")["sensor_password"] }}}" type="text" name="sensor_password" class="form-control" id="sensor-password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10 text-right">
                                                @if (session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                    @if (session("1752051_current_sensor")["sensor_pid"] == null)
                                                        <button type="submit" id="current-{{{ session("1752051_current_sensor")["sensor_id"] }}}" name="btn-delete" value="1" hidden></button>
                                                        <button type="button" class="btn btn-danger" onclick="deleteSensorDevice('@lang("Are you sure?")','@lang("You might not want to delete "){{{ session("1752051_current_sensor")["sensor_id"] }}} !!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted ") {{{ session("1752051_current_sensor")["sensor_id"] }}} !!!','@lang("OK")','current-{{{ session("1752051_current_sensor")["sensor_id"] }}}')" data-dismiss="modal">@lang("Delete")</button>
                                                    @endif
                                                @endif
                                                @if (session("1752051_current_sensor")["sensor_pid"] != null)
                                                    <button type="button" onclick="runStopSensor(1,'@lang("Successfully stopped !!!")','@lang("You can turn on later !!!")','@lang("Are you sure you want to turn off sensor?")','@lang("You will stop sensor immediately !!!")','@lang("Yes, turn it off!")','@lang("OK")','@lang("Cancel")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")')" class="btn btn-info">@lang("Stop")</button>
                                                @endif
                                                @if (session("1752051_current_sensor")["sensor_pid"] == null)
                                                    <button type="submit" class="btn btn-success">@lang("Update")</button>
                                                    <button type="button" onclick="runStopSensor(2,'@lang("Successfully ran !!!")','@lang("You can turn off later !!!")','@lang("Are you sure you want to turn on sensor ?")','@lang("")','@lang("Yes, turn it on!")','@lang("OK")','@lang("Cancel")','@lang("Sensor is opening !!!")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")')" class="btn btn-primary">@lang("Run")</button>
                                                @endif
                                            </div>
                                        </div>

                                    </form>

                                @endif
                            </div>

                            @if( session("1752051_current_room_tab") == 1)
                                <div class="tab-pane active" id="devices">
                            @else
                                <div class="tab-pane" id="devices">
                            @endif

                                <select id="select2bs4-device" class="form-control select2bs4" style="width: 100%;">
                                    @if (session("1752051_current_device")["device_id"] == "")
                                        <option></option>
                                    @endif
                                    @foreach( $device_db as $device_each)
                                        @if (session("1752051_current_device")["device_id"] == $device_each["device_id"])
                                            <option selected value="{{{$device_each["device_id"]}}}">{{$device_each["device_name"]}} ({{$device_each["device_id"]}})</option>
                                        @else
                                            <option value="{{{$device_each["device_id"]}}}">{{$device_each["device_name"]}} ({{$device_each["device_id"]}})</option>
                                        @endif
                                    @endforeach
                                </select>

                                <br>

                                @if (session("1752051_current_device")["device_id"] != "")

                                    <div class="chart tab-pane" id="backup-log">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang("Device Log")</h3>
                                            @if (session("1752051_current_device")["device_pid"] == null && session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                <button type="button" onclick="deleteAllLog('@lang("Are you sure?")','@lang("You might not want to delete all log of "){{{ session("1752051_current_device")["device_id"] }}} !!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted all log of ") {{{ session("1752051_current_device")["device_id"] }}} !!!','@lang("OK")',1)" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-trash"></i> @lang("Delete all records")
                                                </button>
                                            @elseif (session("1752051_current_device")["device_pid"] != null)
                                                <button type="button" data-target="#modal-danger" class="btn btn-secondary btn-sm float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-spinner fa-pulse"></i> @lang("Running")
                                                </button>
                                            @endif
                                        </div>

                                        <section class="col-lg-12 connectedSortable">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-tools">
                                                        <ul class="nav nav-pills ml-auto">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" href="#all-records-device-hours" data-toggle="tab">@lang('Hours Usage')</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#all-records-device-consumption" data-toggle="tab">@lang('Electrical Consumption')</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="tab-content p-0">
                                                        <!-- Morris chart - Sales -->
                                                        <div class="chart tab-pane active" id="all-records-device-hours">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <i class="far fa-chart-bar"></i>
                                                                    @lang('Hours Usage')
                                                                </h3>

                                                                <div class="card-tools">
                                                                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                                                        <button onclick="resetZoomDeviceHours()" type="button" class="btn btn-default btn-sm active" data-toggle="on">@lang("Refresh Zoom")</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="chart-all-records-device-hours"></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="chart tab-pane" id="all-records-device-consumption">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <i class="far fa-chart-bar"></i>
                                                                    @lang('Electrical Consumption')
                                                                </h3>

                                                                <div class="card-tools">
                                                                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                                                        <button onclick="resetZoomDeviceConsumption()" type="button" class="btn btn-default btn-sm active" data-toggle="on">@lang("Refresh Zoom")</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="chart-all-records-device-consumption"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>

                                        <div class="card-body">
                                            <form action="device-search-time-range" method="post">
                                                {{ csrf_field() }}
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                    </div>
                                                    <input type="hidden" name="device_id" value="{{{ session("1752051_current_device")["device_id"] }}}">
                                                    <input type="text" name="device_time_range" class="form-control float-right" id="reservationtime-device">
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-sm float-right" style="margin-right: 5px;">
                                                    @lang("Apply time range")
                                                </button>
                                            </form>
                                            <button type="button" onclick="refreshDevice()" class="btn btn-info btn-sm float-right" style="margin-right: 5px;">
                                                @lang("Refresh")
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <table id="device-table" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        @if (session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                            @if (session("1752051_current_device")["device_pid"] == null)
                                                                <div class="icheck-success d-inline">
                                                                    <input onclick="checkAllCheckBox(1,0)" type="checkbox" id="check-mark-device-upper">
                                                                    <label for="check-mark-device-upper">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </th>
                                                    <th>@lang("Order")</th>
                                                    <th>@lang("Device ID")</th>
                                                    <th>@lang("Device Status")</th>
                                                    <th>@lang("Device Status Value")</th>
                                                    <th>@lang("Device Hours Usage")</th>
                                                    <th>@lang("Device Electrical Connsumption")</th>
                                                    <th>@lang("Date")</th>
                                                    <th>
                                                        @if (session("1752051_current_device")["device_pid"] == null && session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                            <button onclick="deleteLog('@lang("Are you sure?")','@lang("You might not want to delete these device logs !!!")','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted these device logs !!!")','@lang("OK")',1,'check-mark-device')" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                                @lang("Delete selected")
                                                            </button>
                                                        @elseif (session("1752051_current_device")["device_pid"] != null)
                                                            <button type="button" data-target="#modal-danger" class="btn btn-secondary btn-sm float-right" style="margin-right: 5px;">
                                                                <i class="fas fa-spinner fa-pulse"></i> @lang("Running")
                                                            </button>
                                                        @endif
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="device-tbody">
                                                <script>
                                                    var staticDeviceHours = [];
                                                    var staticDeviceConsumption = [];
                                                </script>
                                                @foreach (session("1752051_current_device_log") as $each)
                                                    <tr>
                                                        <td class="text-center">
                                                            @if (session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                                @if (session("1752051_current_device")["device_pid"] == null)
                                                                        <div class="icheck-success d-inline">
                                                                            <input value="{{{ $each["device_order"] }}}" type="checkbox" class="check-mark-device">
                                                                        </div>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>{{ $each["device_order"] }}</td>
                                                        <td>{{ $each["device_id"] }}</td>
                                                        <td>
                                                            @if($each["device_status"] == true)
                                                                <input type="checkbox" checked data-bootstrap-switch-disabled data-off-color="danger" data-on-color="success">
                                                            @else
                                                                <input type="checkbox" data-bootstrap-switch-disabled data-off-color="danger" data-on-color="success">
                                                                <script>
                                                                    staticDeviceHours.push({
                                                                            x: parseInt("{{{ $each["device_timestamp"] }}}") * 1000,
                                                                            y: parseFloat("{{{ $each["device_hours_usage"] }}}"),
                                                                        }
                                                                    );
                                                                    staticDeviceConsumption.push({
                                                                            x: parseInt("{{{ $each["device_timestamp"] }}}") * 1000,
                                                                            y: parseFloat("{{{ $each["device_electrical_consumption"] }}}"),
                                                                        }
                                                                    );
                                                                </script>
                                                            @endif
                                                        </td>

                                                        <td>{{ $each["device_status_value"] }}</td>
                                                        <td>
                                                            @if($each["device_status"] == true)
                                                                ---
                                                            @else
                                                                {{ $each["device_hours_usage"] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($each["device_status"] == true)
                                                                ---
                                                            @else
                                                                {{ $each["device_electrical_consumption"] }}
                                                            @endif
                                                        </td>
                                                        @if ($loop->iteration == 1)
                                                            <input type="hidden" id="newest-timestamp-device" value="{{{ $each["device_timestamp"] }}}">
                                                        @endif
                                                        <td> @php echo date('d/m/Y H:i:s', $each["device_timestamp"]); @endphp </td>
                                                        <td class="project-actions text-left">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="text-center">
                                                        @if (session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                            @if (session("1752051_current_device")["device_pid"] == null)
                                                                <div class="icheck-success d-inline">
                                                                    <input onclick="checkAllCheckBox(1,1)" type="checkbox" id="check-mark-device-lower">
                                                                    <label for="check-mark-device-lower">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </th>
                                                    <th>@lang("Order")</th>
                                                    <th>@lang("Device ID")</th>
                                                    <th>@lang("Device Status")</th>
                                                    <th>@lang("Device Status Value")</th>
                                                    <th>@lang("Device Hours Usage")</th>
                                                    <th>@lang("Device Electrical Connsumption")</th>
                                                    <th>@lang("Date")</th>
                                                    <th>
                                                        @if (session("1752051_current_device")["device_pid"] == null && session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                            <button onclick="deleteLog('@lang("Are you sure?")','@lang("You might not want to delete these device logs !!!")','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted these device logs !!!")','@lang("OK")',1,'check-mark-device')" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm" href="#">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                                @lang("Delete selected")
                                                            </button>
                                                        @elseif (session("1752051_current_device")["device_pid"] != null)
                                                            <button type="button" data-target="#modal-danger" class="btn btn-secondary btn-sm float-right" style="margin-right: 5px;">
                                                                <i class="fas fa-spinner fa-pulse"></i> @lang("Running")
                                                            </button>
                                                        @endif
                                                    </th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>

                                    <br>

                                    <form action="update-device" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="device-id" class="col-form-label">@lang("Device ID:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_id"] }}}" type="text" name="device_id" class="form-control" id="device-id">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="device-name" class="col-form-label">@lang("Device name:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_name"] }}}" type="text" name="device_name" class="form-control" id="device-name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="device-kwh" class="col-form-label">@lang("Device KWH:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_kwh"] }}}" type="number" name="device_kwh" class="form-control" id="device-kwh">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="device-status-value" class="col-form-label">@lang("Device Status Value:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_status_value"] }}}" type="number" name="device_status_value" class="form-control" id="device-status-value">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="device-ip" class="col-form-label">@lang("MQTT IP:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_ip"] }}}" type="text" name="device_ip" class="form-control" id="device-ip">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="device-port" class="col-form-label">@lang("MQTT port:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_port"] }}}" type="number" name="device_port" class="form-control" id="device-port">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="sensor-topic" class="col-form-label">@lang("MQTT Topic:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_topic"] }}}" type="text" name="device_topic" class="form-control" id="device-topic">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="device-username" class="col-form-label">@lang("MQTT Username:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_username"] }}}" type="text" name="device_username" class="form-control" id="device-username">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="device-password" class="col-form-label">@lang("MQTT Password:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_password"] }}}" type="text" name="device_password" class="form-control" id="device-password">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="device-lower-threshold" class="col-form-label">@lang("Device Lower Threshold:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_lower_threshold"] }}}" type="number" name="device_lower_threshold" class="form-control" id="device-lower-threshold">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="device-upper-threshold" class="col-form-label">@lang("Device Upper Threshold:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_upper_threshold"] }}}" type="number" name="device_upper_threshold" class="form-control" id="device-upper-threshold">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="device-auto-based-on-sensor-topic" class="col-form-label">@lang("Device Auto Based On Sensor Topic:")</label>
                                                <input value="{{{ session("1752051_current_device")["device_auto_based_on_sensor_topic"] }}}" type="text" name="device_auto_based_on_sensor_topic" class="form-control" id="device-auto-based-on-sensor-topic">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10 text-right">
                                                @if (session("1752051_user_role")["permission_delete_device_sensor"] == true)
                                                    @if (session("1752051_current_device")["device_pid"] == null)
                                                        <button type="submit" id="current-{{{ session("1752051_current_device")["device_id"] }}}" name="btn-delete" value="1" hidden></button>
                                                        <button type="button" class="btn btn-danger" onclick="deleteSensorDevice('@lang("Are you sure?")','@lang("You might not want to delete "){{{ session("1752051_current_device")["device_id"] }}} !!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted ") {{{ session("1752051_current_device")["device_id"] }}} !!!','@lang("OK")','current-{{{ session("1752051_current_device")["device_id"] }}}')" data-dismiss="modal">@lang("Delete")</button>
                                                    @endif
                                                @endif
                                                @if (session("1752051_current_device")["device_pid"] != null)
                                                    <button type="button" onclick="runStopDevice(1,'@lang("Successfully stopped !!!")','@lang("You can turn on later !!!")','@lang("Are you sure you want to turn off device?")','@lang("You will stop device immediately !!!")','@lang("Yes, turn it off!")','@lang("OK")','@lang("Cancel")','@lang("Device is opening !!!")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")')" class="btn btn-info">@lang("Off")</button>
                                                @endif
                                                @if (session("1752051_current_device")["device_pid"] == null)
                                                    <button type="submit" class="btn btn-success">@lang("Update")</button>
                                                    <button type="button" onclick="autoRunStopDevice('@lang("Successfully ran !!!")','@lang("You can turn off later !!!")','@lang("Are you sure you want to turn on auto mode for device ?")','','@lang("Yes, turn it on!")','@lang("OK")','@lang("Cancel")')" class="btn btn-warning">@lang("Auto")</button>
                                                    <button type="button" onclick="runStopDevice(2,'@lang("Successfully ran !!!")','@lang("You can turn off later !!!")','@lang("Are you sure you want to turn on device ?")','','@lang("Yes, turn it on!")','@lang("OK")','@lang("Cancel")','@lang("Device is opening !!!")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")')" class="btn btn-primary">@lang("On")</button>
                                                @endif
                                            </div>
                                        </div>

                                    </form>

                                @endif
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>

            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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

<div id="success-alert" class="toastrDefaultSuccess" hidden></div>
<div id="danger-alert" class="toastrDefaultError" hidden></div>

<div id="success-update" class="toastrDefaultSuccessMsg" ></div>
<div id="danger-update" class="toastrDefaultErrorMsg" hidden></div>

<input id="select2-placeholder-device" type="hidden" value='@lang("Choose a device to modify")'>
<input id="select2-placeholder-sensor" type="hidden" value='@lang("Choose a sensor to modify")'>
<input id="select2-noResults" type="hidden" value='@lang("No Results Found")'>

<div id="id-buttons-copy" onclick="changeButtonsCopy('@lang('Copy')')"></div>
<div id="id-buttons-csv" onclick="changeButtonsCSV('@lang('CSV')')"></div>
<div id="id-buttons-excel" onclick="changeButtonsExcel('@lang('Excel')')"></div>
<div id="id-buttons-pdf" onclick="changeButtonsPDF('@lang('PDF')')"></div>
<div id="id-buttons-print" onclick="changeButtonsPrint('@lang('Print')')"></div>

@if(session('msg_room'))
    <input id="msg-permission" type="hidden" value="{{{ session('msg_room') }}}">
@endif
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/js/demo.js"></script>
<!-- Bootstrap Switch -->
<script src="../assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Toastr -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>
<script src="../assets/js/chartjs-plugin-streaming.js"></script>
<!-- Apexharts -->
<script src="../assets/apexcharts-bundle/dist/apexcharts.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="../assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- FLOT CHARTS -->
<script src="../assets/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../assets/plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../assets/plugins/flot-old/jquery.flot.pie.min.js"></script>
<!-- date-range-picker -->
<script src="../assets/plugins/moment/moment.min.js"></script>
<script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
@include("include/nav-extension")
<!-- Extract -->
<script src="../assets/js/dataTables.buttons.min.js"></script>
<script src="../assets/js/buttons.flash.min.js"></script>
<script src="../assets/js/jszip.min.js"></script>
<script src="../assets/js/pdfmake.min.js"></script>
<script src="../assets/js/vfs_fonts.js"></script>
<script src="../assets/js/buttons.html5.min.js"></script>
<script src="../assets/js/buttons.print.min.js"></script>
<script>
    // $("input[data-bootstrap-switch]").each(function(){
    //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
    // });
    $("input[data-bootstrap-switch-disabled]").each(function(){
        $(this).bootstrapSwitch('toggleDisabled',true,true);
    });
</script>
<!-- SweetAlert2 -->
<script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultInfo').click(function() {
            Toast.fire({
                icon: 'info',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultError').click(function() {
            Toast.fire({
                icon: 'error',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultWarning').click(function() {
            Toast.fire({
                icon: 'warning',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultQuestion').click(function() {
            Toast.fire({
                icon: 'question',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });

        $('.toastrDefaultSuccess').click(function() {
            toastr.success(message_json["message"])
        });

        $('.toastrDefaultSuccessMsg').click(function() {
            toastr.success($("#msg-permission").val())
        });

        $('.toastrDefaultInfo').click(function() {
            toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });

        $('.toastrDefaultError').click(function() {
            toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });

        $('.toastrDefaultErrorMsg').click(function() {
            toastr.error($("#msg-permission").val())
        });

        $('.toastrDefaultWarning').click(function() {
            toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });

        $('.toastsDefaultDefault').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultTopLeft').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'topLeft',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultBottomRight').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'bottomRight',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultBottomLeft').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'bottomLeft',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultAutohide').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                autohide: true,
                delay: 750,
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultNotFixed').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                fixed: false,
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultFull').click(function() {
            $(document).Toasts('create', {
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                icon: 'fas fa-envelope fa-lg',
            })
        });
        $('.toastsDefaultFullImage').click(function() {
            $(document).Toasts('create', {
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                image: '../../dist/img/user3-128x128.jpg',
                imageAlt: 'User Picture',
            })
        });
        $('.toastsDefaultSuccess').click(function() {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultInfo').click(function() {
            $(document).Toasts('create', {
                class: 'bg-info',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultWarning').click(function() {
            $(document).Toasts('create', {
                class: 'bg-warning',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultDanger').click(function() {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultMaroon').click(function() {
            $(document).Toasts('create', {
                class: 'bg-maroon',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
    });

</script>
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    var message_json = "";
    function updateSystemSettings(backup,maintenance){
        $.ajax({
            url: "change-system-settings",
            type: "POST",
            data: {_token: "{{csrf_token()}}", backup_log_system: backup, maintenance_system: maintenance },
            async: false,
            success: function (data) {
                message_json = JSON.parse(data.split("GMT")[1]);
                $(document).ready(function() {
                    $("#success-alert").click();
                });
            }
        })
    }

    function updateDashboardSettings(temp,humid,heat_index){
        $.ajax({
            url: "change-dashboard-settings",
            type: "POST",
            data: {_token: "{{csrf_token()}}", time_update_temp: temp, time_update_humid: humid, time_update_heat_index: heat_index },
            async: false,
            success: function (data) {
                message_json = JSON.parse(data.split("GMT")[1]);
                $(document).ready(function() {
                    $("#success-alert").click();
                });
            }
        })
    }

    $(".bootstrap-switch-success").text('@lang("ON")');

    $(".bootstrap-switch-danger").text('@lang("OFF")');

    $(function () {

        //Initialize Select2 Elements
        $('#select2bs4-sensor').select2({
            theme: 'bootstrap4',
            placeholder: $('#select2-placeholder-sensor').val(),
            language: {
                "noResults": function(){
                    return $('#select2-noResults').val();
                }
            }
        })

        $('#select2bs4-sensor').on('select2:select', function (e) {
            var data = e.params.data;
            $.ajax({
                url: "choose-sensor",
                type: "POST",
                data: {_token: "{{csrf_token()}}", sensor_id: data.id },
                async: false,
                success: function (data) {
                    // alert(data);
                    window.location.reload();
                }
            })
        });

        $('#select2bs4-device').select2({
            theme: 'bootstrap4',
            placeholder: $('#select2-placeholder-device').val(),
            language: {
                "noResults": function(){
                    return $('#select2-noResults').val();
                }
            }
        })

        $('#select2bs4-device').on('select2:select', function (e) {
            var data = e.params.data;
            $.ajax({
                url: "choose-device",
                type: "POST",
                data: {_token: "{{csrf_token()}}", device_id: data.id },
                async: false,
                success: function (data) {
                    // alert(data);
                    window.location.reload();
                }
            })
        });

    });

    function chooseRoom(building,floor,room){
        $.ajax({
            url: "choose-room",
            type: "POST",
            data: {_token: "{{csrf_token()}}", building: building, floor: floor, room: room },
            async: false,
            success: function (data) {
                // alert(data);
                window.location.href = "room";
            }
        })
    }

    function currentTab(tab_id){
        $.ajax({
            url: "set-current-room-tab",
            type: "POST",
            data: {_token: "{{csrf_token()}}", tab_id: tab_id },
            async: false,
            success: function (data) {
                // alert(data);
                // window.location.href = "room";
            }
        })
    }

    function runStopSensor(button,notice_title,notice_text,title_ask,text_warning,confirms,reconfirm,cancel,sensor_title,error_title,error_text){

        if (button == 2){

            Swal.fire({
                title: title_ask,
                text: text_warning,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirms,
                cancelButtonText: cancel
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "run-stop-sensor",
                        type: "POST",
                        data: {_token: "{{csrf_token()}}", button: button },
                        async: true,
                        success: function (data) {
                            // alert(data);
                            // window.location.reload();
                        }
                    })

                    Swal.fire({
                        title: notice_title,
                        text: notice_text,
                        icon: 'success',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: reconfirm
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload();
                        }
                    })

                }
            })

        }
        else {

            Swal.fire({
                title: title_ask,
                text: text_warning,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirms,
                cancelButtonText: cancel
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: "run-stop-sensor",
                        type: "POST",
                        data: {_token: "{{csrf_token()}}", button: button },
                        async: false,
                        success: function (data) {
                            // alert(data);
                            // window.location.reload();
                            Swal.fire({
                                title: notice_title,
                                text: notice_text,
                                icon: 'success',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#28a745',
                                cancelButtonColor: '#d33',
                                confirmButtonText: reconfirm
                            }).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            })
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            // alert(xhr.message);
                            // alert(thrownError);
                            Swal.fire({
                                title: error_title,
                                text: error_text,
                                icon: 'error',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#dc3545',
                                cancelButtonColor: '#d33',
                                confirmButtonText: reconfirm
                            }).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            })
                        }
                    })
                }
            })
        }
    }

    function runStopDevice(button,notice_title,notice_text,title_ask,text_warning,confirms,reconfirm,cancel,sensor_title,error_title,error_text){

        if (button == 2){
            Swal.fire({
                title: title_ask,
                text: text_warning,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirms,
                cancelButtonText: cancel
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "run-stop-device",
                        type: "POST",
                        data: {_token: "{{csrf_token()}}", button: button },
                        async: false,
                        success: function (data) {
                            // alert(data);
                            // window.location.reload();
                            Swal.fire({
                                title: notice_title,
                                text: notice_text,
                                icon: 'success',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#28a745',
                                cancelButtonColor: '#d33',
                                confirmButtonText: reconfirm
                            }).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            })
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            // alert(xhr.message);
                            // alert(thrownError);
                            Swal.fire({
                                title: error_title,
                                text: error_text,
                                icon: 'error',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#dc3545',
                                cancelButtonColor: '#d33',
                                confirmButtonText: reconfirm
                            }).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            })
                        }
                    })

                }
            })

        }
        else {

            Swal.fire({
                title: title_ask,
                text: text_warning,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirms,
                cancelButtonText: cancel
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: "run-stop-device",
                        type: "POST",
                        data: {_token: "{{csrf_token()}}", button: button },
                        async: false,
                        success: function (data) {
                            // alert(data);
                            // window.location.reload();
                            Swal.fire({
                                title: notice_title,
                                text: notice_text,
                                icon: 'success',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#28a745',
                                cancelButtonColor: '#d33',
                                confirmButtonText: reconfirm
                            }).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            })
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            // alert(xhr.message);
                            // alert(thrownError);
                            Swal.fire({
                                title: error_title,
                                text: error_text,
                                icon: 'error',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#dc3545',
                                cancelButtonColor: '#d33',
                                confirmButtonText: reconfirm
                            }).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            })
                        }
                    })

                }
            })
        }
    }

    function autoRunStopDevice(notice_title,notice_text,title_ask,text_warning,confirms,reconfirm,cancel){

        Swal.fire({
            title: title_ask,
            text: text_warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirms,
            cancelButtonText: cancel
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "auto-run-stop-device",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}"},
                    async: true,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                    }
                })

                Swal.fire({
                    title: notice_title,
                    text: notice_text,
                    icon: 'success',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: reconfirm
                }).then((result) => {
                    if (result.value) {
                        window.location.reload();
                    }
                })

            }
        })
    }

    function refreshSensor(){
        $.ajax({
            url: "refresh-sensor",
            type: "POST",
            data: {_token: "{{csrf_token()}}"},
            async: true,
            success: function (data) {
                // alert(data);
                // window.location.href = "room";
                window.location.reload();
            }
        })
    }

    function refreshDevice(){
        $.ajax({
            url: "refresh-device",
            type: "POST",
            data: {_token: "{{csrf_token()}}"},
            async: true,
            success: function (data) {
                // alert(data);
                // window.location.href = "room";
                window.location.reload();
            }
        })
    }

    function deleteSensorDevice(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,current_button){
        Swal.fire({
            title: title_ask,
            text: text_warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirm,
            cancelButtonText: cancel
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: title_inform,
                    text: text_inform,
                    icon: 'success',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: reconfirm
                }).then((result) => {
                    if (result.value) {
                        $("#"+current_button).click();
                    }
                })
            }
        })

    }

    function deleteAllLog(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,delete_type){
        Swal.fire({
            title: title_ask,
            text: text_warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirm,
            cancelButtonText: cancel
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    url: "delete-all-log",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", delete_type: delete_type},
                    async: false,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                    }
                })

                Swal.fire({
                    title: title_inform,
                    text: text_inform,
                    icon: 'success',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: reconfirm
                }).then((result) => {
                    if (result.value) {
                        window.location.reload();
                    }
                })

            }
        })

    }

    function deleteLog(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,delete_type,delete_name){
        Swal.fire({
            title: title_ask,
            text: text_warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirm,
            cancelButtonText: cancel
        }).then((result) => {
            if (result.value) {

                var checkbox = document.getElementsByClassName(delete_name);
                for (var i = 0; i < checkbox.length; i++){
                    if (checkbox[i].checked == true) {
                        $.ajax({
                            url: "delete-log",
                            type: "POST",
                            data: {_token: "{{csrf_token()}}", delete_type: delete_type, delete_order: checkbox[i].value},
                            async: true,
                            success: function (data) {
                                // alert(data);
                                // window.location.reload();
                            }
                        })
                    }
                }

                Swal.fire({
                    title: title_inform,
                    text: text_inform,
                    icon: 'success',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: reconfirm
                }).then((result) => {
                    if (result.value) {
                        window.location.reload();
                    }
                })

            }
        })

    }

    function checkAllCheckBox(current,divide){
        if (current == 0){
            var lower = document.getElementById("check-mark-sensor-lower");
            var upper = document.getElementById("check-mark-sensor-upper");
            if (divide == 0){
                lower.checked = upper.checked;
            }
            else{
                upper.checked = lower.checked;
            }
            var checkbox = document.getElementsByClassName("check-mark-sensor");
            for (var i = 0; i < checkbox.length; i++){
                checkbox[i].checked = upper.checked;
            }
        }
        else{
            var lower = document.getElementById("check-mark-device-lower");
            var upper = document.getElementById("check-mark-device-upper");
            if (divide == 0){
                lower.checked = upper.checked;
            }
            else{
                upper.checked = lower.checked;
            }
            var checkbox = document.getElementsByClassName("check-mark-device");
            for (var i = 0; i < checkbox.length; i++){
                checkbox[i].checked = upper.checked;
            }
        }
    }

    $(".bootstrap-switch-success").text('@lang("ON")');

    $(".bootstrap-switch-danger").text('@lang("OFF")');


</script>
@if (session("msg_type_room") == "success")
    <script>
        $(document).ready(function() {
            $("#success-update").click();
        });
    </script>
@endif
@if (session("msg_type_room") == "danger")
    <script>
        $(document).ready(function() {
            $("#danger-update").click();
        });
    </script>
@endif
<script>
    $(function () {

        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        $("#sensor-table").DataTable({
            "responsive": true,
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        $("#device-table").DataTable({
            "responsive": true,
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
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

    $('#reservation-sensor').daterangepicker()
    //Date range picker with time picker
    @if (session('1752051_sensor_start_datetime') != null && session('1752051_sensor_end_datetime') != null)
        $('#reservationtime-sensor').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerSeconds: true,
            timePickerIncrement: 1,
            startDate: "{{{ session('1752051_sensor_start_datetime') }}}",
            endDate: "{{{ session('1752051_sensor_end_datetime') }}}",
            locale: {
                format: 'DD/MM/YYYY HH:mm:ss'
            }
        })
    @else
        $('#reservationtime-sensor').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerSeconds: true,
            timePickerIncrement: 1,
            locale: {
                format: 'DD/MM/YYYY HH:mm:ss'
            }
        })
    @endif

    $('#reservation-device').daterangepicker()
    //Date range picker with time picker
    @if (session('1752051_device_start_datetime') != null && session('1752051_device_end_datetime') != null)
        $('#reservationtime-device').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerSeconds: true,
            timePickerIncrement: 1,
            startDate: "{{{ session('1752051_device_start_datetime') }}}",
            endDate: "{{{ session('1752051_device_end_datetime') }}}",
            locale: {
                format: 'DD/MM/YYYY HH:mm:ss'
            }
        })
    @else
        $('#reservationtime-device').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerSeconds: true,
            timePickerIncrement: 1,
            locale: {
                format: 'DD/MM/YYYY HH:mm:ss'
            }
        })
    @endif

    function changeButtonsCopy(name){
        $('.buttons-copy').text(name);
        $('.buttons-copy').addClass("btn btn-primary");
    }

    function changeButtonsCSV(name){
        $('.buttons-csv').text(name);
        $('.buttons-csv').addClass("btn btn-info");
    }

    function changeButtonsExcel(name){
        $('.buttons-excel').text(name);
        $('.buttons-excel').addClass("btn btn-success");
    }

    function changeButtonsPDF(name){
        $('.buttons-pdf').text(name);
        $('.buttons-pdf').addClass("btn btn-danger");
    }

    function changeButtonsPrint(name){
        $('.buttons-print').text(name);
        $('.buttons-print').addClass("btn btn-warning");
    }

    $('.buttons-copy').ready( function() {

        $('#id-buttons-copy').click();

    });

    $('.buttons-excel').ready( function() {

        $('#id-buttons-excel').click();

    });

    $('.buttons-csv').ready( function() {

        $('#id-buttons-csv').click();

    });

    $('.buttons-pdf').ready( function() {

        $('#id-buttons-pdf').click();

    });

    $('.buttons-print').ready( function() {

        $('#id-buttons-print').click();

    });

</script>
@include("include/room-js")
@include("include/session-timeout")
@include("include/chatbot")
</body>
</html>
