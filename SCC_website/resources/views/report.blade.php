<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | @lang("Report")</title>
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
            <h1>@lang("Report")</h1>
              @if (session("1752051_user_role")["permission_create_building_floor_room"])
                  <br>
                  <a href="#/" onclick="addNewBuilding('@lang("Create Building")','@lang("Submit a new building name")','@lang("Create Floor")','@lang("Submit a new floor name")','@lang("Create Room")','@lang("Submit a new room name")','@lang("Input name cannot be empty !!!")','@lang("Error !!!")','@lang("This building / floor / room had already existed !!!")','@lang("OK")','@lang("Successfully created !!!")','@lang("The room is now editable !!!")','@lang("Next &rarr;")')" class="btn btn-lg btn-primary">
                      <i class="fas fa-building"></i>&ensp;@lang("Add Building")
                  </a>
              @endif
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">@lang("Dashboard")</a></li>
              <li class="breadcrumb-item active">@lang("Report")</li>
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
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-12">
              <div class="card card-info">
                  <div class="card-header">
                      <h3 class="card-title">@lang("Building Setting")</h3>
                  </div>
                  <div class="card-body">
                    <form action="update-or-delete-role" method="post">
                        {{csrf_field()}}
{{--                      <h5 class="mt-4 mb-2">@lang("Choose role and set permission")</h5>--}}

                      <select name="user_lang" id="select2bs4-building" class="form-control select2bs4" style="width: 100%;">
                          @if (session("1752051_current_building")["building"] == null)
                              <option></option>
                          @endif
                          @foreach( $building_db as $building_each)
                              @if (session("1752051_current_building")["building"]["building_name"] == $building_each["building_name"])
                                  <option selected value="{{{$building_each["building_name"]}}}">{{$building_each["building_name"]}}</option>
                              @else
                                  <option value="{{{$building_each["building_name"]}}}">{{$building_each["building_name"]}}</option>
                              @endif
                          @endforeach
                      </select>

                        <br>

                      @if (session("1752051_current_building")["building"] != null )
{{--                            @php--}}
{{--                                dd(session("1752051_current_building")["building"]["building_active"])--}}
{{--                            @endphp--}}
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- The time line -->
                                    <div class="timeline">
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-primary"><a href="#/" onclick="renameBuilding('@lang("Rename Building?")','@lang('Do you want to rename building '){{{ session("1752051_current_building")["building"]["building_name"] }}} ?','@lang("Yes")','@lang("No")','@lang("New Building Name")','@lang("Input the new name")','@lang("Input name cannot be empty !!!")','@lang("Error !!!")','@lang("This building name had already existed !!!")','@lang("OK")','@lang("Successfully renamed !!!")','@lang("The building is now editable !!!")','{{{ session("1752051_current_building")["building"]["building_name"] }}}')">@lang("Building: ") {{ session("1752051_current_building")["building"]["building_name"] }}</a></span>
                                            <span class="bg-danger float-right"><i class="fa fa-trash"></i> <a href="#/" onclick="deleteBuilding('@lang("Are you sure?")','@lang("You might not want to delete "){{{ session("1752051_current_building")["building"]["building_name"] }}} !!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted ") {{{ session("1752051_current_building")["building"]["building_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ session("1752051_current_building")["building"]["building_name"] }}}')">@lang("Delete Building: ") {{ session("1752051_current_building")["building"]["building_name"] }}</a></span>
                                            @if (session("1752051_current_building")["building"]["building_active"] == true)
                                                <span class="bg-warning float-right custom-next-building-option"><i class="fa fa-lock"></i> <a href="#/" onclick="activateDeactivateBuilding('@lang("Are you sure?")','@lang("You are deactivating "){{{ session("1752051_current_building")["building"]["building_name"] }}}!!!','@lang("Yes, deactivate!")','@lang("Cancel")','@lang("Deactivate!")','@lang("You deactivated ") {{{ session("1752051_current_building")["building"]["building_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ session("1752051_current_building")["building"]["building_name"] }}}',1)">@lang("Deactivate Building: ") {{ session("1752051_current_building")["building"]["building_name"] }}</a></span>
                                            @else
                                                <span class="bg-warning float-right custom-next-building-option"><i class="fa fa-unlock"></i> <a href="#/" onclick="activateDeactivateBuilding('@lang("Are you sure?")','@lang("You are activating "){{{ session("1752051_current_building")["building"]["building_name"] }}}!!!','@lang("Yes, activate!")','@lang("Cancel")','@lang("Activate!")','@lang("You activated ") {{{ session("1752051_current_building")["building"]["building_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ session("1752051_current_building")["building"]["building_name"] }}}',0)">@lang("Activate Building: ") {{ session("1752051_current_building")["building"]["building_name"] }}</a></span>

                                            @endif
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                            @php

                                                $floor_array = session("1752051_current_building");


                                                unset($floor_array["building"]);

                                                $floor_keys = array_keys($floor_array);

                                                // dd(session("1752051_current_building"));

                                            @endphp
                                            @for ($i = 0; $i < count($floor_array); $i++)
                                                <div>
                                                    @php
                                                        $random_number = rand(0,2);
                                                    @endphp
                                                    @if ($random_number == 0)
                                                        <i class="fas fa-building bg-success"></i>
                                                    @elseif ($random_number == 1)
                                                        <i class="fas fa-building bg-info"></i>
                                                    @else
                                                        <i class="fas fa-building bg-danger"></i>
                                                    @endif
                                                    <div class="timeline-item">
                                                        <a href="#/" onclick="deleteFloor('@lang("Are you sure?")','@lang("You might not want to delete "){{{ $floor_keys[$i] }}} !!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted ") {{{ $floor_keys[$i] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}')" class="time"><i class="custom-icon-delete-size fas fa-times"></i></a>
                                                        @if (session("1752051_current_building")["building"]["building_active"] == true)
                                                            @if ($floor_array[$floor_keys[$i]][0]["floor_active"] == true)
                                                                <a href="#/" onclick="addNewRoom('@lang("Create Room")','@lang("Submit a new room name")','@lang("Input name cannot be empty !!!")','@lang("Error !!!")','@lang("This building / floor / room had already existed !!!")','@lang("OK")','@lang("Successfully created !!!")','@lang("The room is now editable !!!")','@lang("Next &rarr;")','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}')" class="time"><i class="custom-icon-add-size fas fa-plus"></i></a>
                                                                <a href="#/" onclick="activateDeactivateFloor('@lang("Are you sure?")','@lang("You are deactivating "){{{ $floor_keys[$i] }}}!!!','@lang("Yes, deactivate!")','@lang("Cancel")','@lang("Deactivate!")','@lang("You deactivated ") {{{ $floor_keys[$i] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}',1)" class="time"><i class="custom-icon-activate-deactivate-size fas fa-lock"></i></a>
                                                            @else
                                                                <a href="#/" onclick="activateDeactivateFloor('@lang("Are you sure?")','@lang("You are activating "){{{ $floor_keys[$i] }}}!!!','@lang("Yes, activate!")','@lang("Cancel")','@lang("Activate!")','@lang("You activated ") {{{ $floor_keys[$i] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}',0)" class="time"><i class="custom-icon-activate-deactivate-size fas fa-unlock"></i></a>
                                                            @endif
                                                        @endif
                                                        <h3 class="timeline-header text-danger text-bold"><a href="#/" onclick="renameFloor('@lang("Rename Floor?")','@lang('Do you want to rename floor '){{{ $floor_keys[$i] }}} ?','@lang("Yes")','@lang("No")','@lang("New Floor Name")','@lang("Input the new name")','@lang("Input name cannot be empty !!!")','@lang("Error !!!")','@lang("This floor name had already existed !!!")','@lang("OK")','@lang("Successfully renamed !!!")','@lang("The floor is now editable !!!")','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}')">@lang("Floor: ") {{  $floor_keys[$i] }}</a></h3>
                                                        @if ( count($floor_array[$floor_keys[$i]][1]) != 0 )
                                                            <div class="timeline-footer">
                                                        @endif
                                                        @for ($j = 0; $j < count($floor_array[$floor_keys[$i]][1]); $j++)
                                                                <div class="btn-group">
                                                                    @php
                                                                        $random_number = rand(0,3);

                                                                        if ($random_number == 0){
                                                                            $class = "btn-success";
                                                                        }
                                                                        else if ($random_number == 1){
                                                                            $class = "btn-info";
                                                                        }
                                                                        else if ($random_number == 2){
                                                                            $class = "btn-danger";
                                                                        }
                                                                        else{
                                                                            $class = "btn-warning";
                                                                        }

                                                                    @endphp
                                                                    @if ($floor_array[$floor_keys[$i]][1][$j]["room_active"] == true)
                                                                        <button type="button" onclick="chooseRoom('{{{ session("1752051_current_building")["building"]["building_name"] }}}','{{{  $floor_keys[$i] }}}','{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}')" class="btn {{{ $class }}}">{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}</button>
                                                                        <button type="button" class="btn {{{ $class }}} dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                                            <span class="sr-only">Toggle Dropdown</span>
                                                                            <div class="dropdown-menu" role="menu" style="">
                                                                                <a class="dropdown-item" href="#/" onclick="renameRoom('@lang("Rename Room?")','@lang('Do you want to rename room '){{{ $floor_keys[$i] }}} ?','@lang("Yes")','@lang("No")','@lang("New Room Name")','@lang("Input the new name")','@lang("Input name cannot be empty !!!")','@lang("Error !!!")','@lang("This room name had already existed !!!")','@lang("OK")','@lang("Successfully renamed !!!")','@lang("The room is now editable !!!")', '{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}')">@lang("Rename")</a>
                                                                                <a class="dropdown-item" href="#/" onclick="deleteRoom('@lang("Are you sure?")','@lang("You might not want to delete "){{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}!!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted ") {{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}')">@lang("Delete")</a>
                                                                                @if (session("1752051_current_building")["building"]["building_active"] == true && $floor_array[$floor_keys[$i]][0]["floor_active"] == true)
                                                                                    @if ($floor_array[$floor_keys[$i]][1][$j]["room_active"] == true)
                                                                                        <a class="dropdown-item" href="#/" onclick="activateDeactivateRoom('@lang("Are you sure?")','@lang("You are deactivating "){{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}!!!','@lang("Yes, deactivate!")','@lang("Cancel")','@lang("Deactivate!")','@lang("You deactivated ") {{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}',1)">@lang("Deactivate")</a>
                                                                                    @else
                                                                                        <a class="dropdown-item" href="#/" onclick="activateDeactivateRoom('@lang("Are you sure?")','@lang("You are activating "){{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}!!!','@lang("Yes, activate!")','@lang("Cancel")','@lang("Activate!")','@lang("You activated ") {{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}',0)">@lang("Activate")</a>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </button>
                                                                    @else
                                                                        <button type="button" class="btn btn-secondary">{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}</button>
                                                                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                                            <span class="sr-only">Toggle Dropdown</span>
                                                                            <div class="dropdown-menu" role="menu" style="">
                                                                                <a class="dropdown-item" href="#/" onclick="renameRoom('@lang("Rename Room?")','@lang('Do you want to rename room '){{{ $floor_keys[$i] }}} ?','@lang("Yes")','@lang("No")','@lang("New Room Name")','@lang("Input the new name")','@lang("Input name cannot be empty !!!")','@lang("Error !!!")','@lang("This room name had already existed !!!")','@lang("OK")','@lang("Successfully renamed !!!")','@lang("The room is now editable !!!")', '{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}')">@lang("Rename")</a>
                                                                                <a class="dropdown-item" href="#/" onclick="deleteRoom('@lang("Are you sure?")','@lang("You might not want to delete "){{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}!!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted ") {{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}')">@lang("Delete")</a>
                                                                                @if (session("1752051_current_building")["building"]["building_active"] == true && $floor_array[$floor_keys[$i]][0]["floor_active"] == true)
                                                                                    @if ($floor_array[$floor_keys[$i]][1][$j]["room_active"] == true)
                                                                                        <a class="dropdown-item" href="#/" onclick="activateDeactivateRoom('@lang("Are you sure?")','@lang("You are deactivating "){{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}!!!','@lang("Yes, deactivate!")','@lang("Cancel")','@lang("Deactivate!")','@lang("You deactivated ") {{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}',1)">@lang("Deactivate")</a>
                                                                                    @else
                                                                                        <a class="dropdown-item" href="#/" onclick="activateDeactivateRoom('@lang("Are you sure?")','@lang("You are activating "){{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}!!!','@lang("Yes, activate!")','@lang("Cancel")','@lang("Activate!")','@lang("You activated ") {{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}} !!!','@lang("OK")','@lang("Error !!!")','@lang("Something wrong happened, please try again !!!")','{{{ $floor_array[$floor_keys[$i]][1][$j]["room_name"] }}}','{{{ $floor_keys[$i] }}}','{{{ session("1752051_current_building")["building"]["building_name"] }}}',0)">@lang("Activate")</a>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                        @endfor
                                                            @if ( count($floor_array[$floor_keys[$i]][1]) != 0 )
                                                                </div>
                                                            @endif
                                                    </div>
                                                </div>
                                            @endfor
                                        @if (session("1752051_current_building")["building"]["building_active"] == true)
                                            <div style="cursor: pointer" onclick="addNewFloor('@lang("Create Floor")','@lang("Submit a new floor name")','@lang("Create Room")','@lang("Submit a new room name")','@lang("Input name cannot be empty !!!")','@lang("Error !!!")','@lang("This building / floor / room had already existed !!!")','@lang("OK")','@lang("Successfully created !!!")','@lang("The floor is now editable !!!")','@lang("Next &rarr;")','{{{ session("1752051_current_building")["building"]["building_name"] }}}')">
                                                <i class="fas fa-plus bg-warning"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>

                      @endif

                      </div>
                  </form>
                      <!-- /input-group -->
                  </div>
                  <!-- /.card-body -->
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

<input id="select2-placeholder" type="hidden" value='@lang("Choose a building to modify")'>
<input id="select2-noResults" type="hidden" value='@lang("No Results Found")'>

@if(session('msg_permission'))
    <input id="msg-permission" type="hidden" value="{{{ session('msg_permission') }}}">
@endif
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
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
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
@include("include/nav-extension")
<script>
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
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
        $('#select2bs4-building').select2({
            theme: 'bootstrap4',
            placeholder: $('#select2-placeholder').val(),
            language: {
                "noResults": function(){
                    return $('#select2-noResults').val();
                }
            }
        })

        $('#select2bs4-building').on('select2:select', function (e) {
            var data = e.params.data;
            $.ajax({
                url: "choose-building",
                type: "POST",
                data: {_token: "{{csrf_token()}}", building: data.id },
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

    function addNewBuilding(building_title,building_text,floor_title,floor_text,room_title,room_text,required,error_title,error_text,reconfirm,success_title,success_text,confirm_button) {
        Swal.mixin({
            input: 'text',
            confirmButtonText: confirm_button,
            showCancelButton: true,
            progressSteps: ['1', '2', '3']
        }).queue([
            {
                title: building_title,
                text: building_text,
                inputValidator: (value) => {
                    if (!value) {
                        return required
                    }
                },
                inputAttributes: {
                    autocapitalize: 'off',
                }
            },
            {
                title: floor_title,
                text: floor_text,
                inputValidator: (value) => {
                    if (!value) {
                        return required
                    }
                },
                inputAttributes: {
                    autocapitalize: 'off',
                }
            },
            {
                title: room_title,
                text: room_text,
                inputValidator: (value) => {
                    if (!value) {
                        return required
                    }
                },
                inputAttributes: {
                    autocapitalize: 'off',
                }
            }
        ]).then((result) => {
            if (result.value) {
                // alert(1);
                // alert(result.value[0]);
                const answers = result.value
                $.ajax({
                    url: "create-building",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: answers[0], floor: answers[1], room: answers[2] },
                    async: false,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                        Swal.fire({
                            title: success_title,
                            text: success_text,
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

    function renameBuilding(title_ask,text_warning,confirm_button,cancel,building_title,building_text,required,error_title,error_text,reconfirm,success_title,success_text,current_building) {

        Swal.fire({
            title: title_ask,
            text: text_warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirm_button,
            cancelButtonText: cancel
        }).then((result) => {
            if (result.value) {

                Swal.mixin({
                    input: 'text',
                    confirmButtonText: confirm_button,
                    showCancelButton: true,
                    progressSteps: ['1']
                }).queue([
                    {
                        title: building_title,
                        text: building_text,
                        inputValidator: (value) => {
                            if (!value) {
                                return required
                            }
                        },
                        inputAttributes: {
                            autocapitalize: 'off',
                        }
                    }
                ]).then((result) => {
                    if (result.value) {
                        // alert(1);
                        // alert(result.value[0]);
                        const answers = result.value
                        $.ajax({
                            url: "rename-building",
                            type: "POST",
                            data: {_token: "{{csrf_token()}}", building: answers[0], current_building: current_building  },
                            async: false,
                            success: function (data) {
                                // alert(data);
                                // window.location.reload();
                                Swal.fire({
                                    title: success_title,
                                    text: success_text,
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
        })

    }

    function deleteBuilding(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,error_title,error_text,current_building){
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
                    url: "delete-building",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: current_building  },
                    async: false,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
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

    function activateDeactivateBuilding(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,error_title,error_text,current_building,button){
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
                    url: "activate-deactivate-building",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: current_building, button: button  },
                    async: true,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.message);
                        // alert(thrownError);
                        // Swal.fire({
                        //     title: error_title,
                        //     text: error_text,
                        //     icon: 'error',
                        //     showCancelButton: false,
                        //     allowOutsideClick: false,
                        //     confirmButtonColor: '#dc3545',
                        //     cancelButtonColor: '#d33',
                        //     confirmButtonText: reconfirm
                        // }).then((result) => {
                        //     if (result.value) {
                        //         window.location.reload();
                        //     }
                        // })
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

    function addNewFloor(floor_title,floor_text,room_title,room_text,required,error_title,error_text,reconfirm,success_title,success_text,confirm_button,current_building) {
        Swal.mixin({
            input: 'text',
            confirmButtonText: confirm_button,
            showCancelButton: true,
            progressSteps: ['1', '2']
        }).queue([
            {
                title: floor_title,
                text: floor_text,
                inputValidator: (value) => {
                    if (!value) {
                        return required
                    }
                },
                inputAttributes: {
                    autocapitalize: 'off',
                }
            },
            {
                title: room_title,
                text: room_text,
                inputValidator: (value) => {
                    if (!value) {
                        return required
                    }
                },
                inputAttributes: {
                    autocapitalize: 'off',
                }
            }
        ]).then((result) => {
            if (result.value) {
                // alert(1);
                // alert(result.value[0]);
                const answers = result.value
                $.ajax({
                    url: "create-floor",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: current_building, floor: answers[0], room: answers[1] },
                    async: false,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                        Swal.fire({
                            title: success_title,
                            text: success_text,
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

    function renameFloor(title_ask,text_warning,confirm_button,cancel,building_title,building_text,required,error_title,error_text,reconfirm,success_title,success_text,current_floor,current_building) {

        Swal.fire({
            title: title_ask,
            text: text_warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirm_button,
            cancelButtonText: cancel
        }).then((result) => {
            if (result.value) {

                Swal.mixin({
                    input: 'text',
                    confirmButtonText: confirm_button,
                    showCancelButton: true,
                    progressSteps: ['1']
                }).queue([
                    {
                        title: building_title,
                        text: building_text,
                        inputValidator: (value) => {
                            if (!value) {
                                return required
                            }
                        },
                        inputAttributes: {
                            autocapitalize: 'off',
                        }
                    }
                ]).then((result) => {
                    if (result.value) {
                        // alert(1);
                        // alert(result.value[0]);
                        const answers = result.value
                        $.ajax({
                            url: "rename-floor",
                            type: "POST",
                            data: {_token: "{{csrf_token()}}", building: current_building, current_floor: current_floor, new_floor: answers[0]  },
                            async: false,
                            success: function (data) {
                                // alert(data);
                                // window.location.reload();
                                Swal.fire({
                                    title: success_title,
                                    text: success_text,
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
        })

    }

    function deleteFloor(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,error_title,error_text,current_floor,current_building){
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
                    url: "delete-floor",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: current_building, current_floor: current_floor  },
                    async: false,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
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

    function activateDeactivateFloor(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,error_title,error_text,current_floor,current_building,button){
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
                    url: "activate-deactivate-floor",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: current_building, current_floor: current_floor, button: button  },
                    async: true,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.message);
                        // alert(thrownError);
                        // Swal.fire({
                        //     title: error_title,
                        //     text: error_text,
                        //     icon: 'error',
                        //     showCancelButton: false,
                        //     allowOutsideClick: false,
                        //     confirmButtonColor: '#dc3545',
                        //     cancelButtonColor: '#d33',
                        //     confirmButtonText: reconfirm
                        // }).then((result) => {
                        //     if (result.value) {
                        //         window.location.reload();
                        //     }
                        // })
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

    function addNewRoom(room_title,room_text,required,error_title,error_text,reconfirm,success_title,success_text,confirm_button,current_floor,current_building) {
        Swal.mixin({
            input: 'text',
            confirmButtonText: confirm_button,
            showCancelButton: true,
            progressSteps: ['1']
        }).queue([
            {
                title: room_title,
                text: room_text,
                inputValidator: (value) => {
                    if (!value) {
                        return required
                    }
                },
                inputAttributes: {
                    autocapitalize: 'off',
                }
            }
        ]).then((result) => {
            if (result.value) {
                // alert(1);
                // alert(result.value[0]);
                const answers = result.value
                $.ajax({
                    url: "create-room",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: current_building, floor: current_floor, room: answers[0] },
                    async: false,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                        Swal.fire({
                            title: success_title,
                            text: success_text,
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

    function renameRoom(title_ask,text_warning,confirm_button,cancel,building_title,building_text,required,error_title,error_text,reconfirm,success_title,success_text,current_room,current_floor,current_building) {

        Swal.fire({
            title: title_ask,
            text: text_warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirm_button,
            cancelButtonText: cancel
        }).then((result) => {
            if (result.value) {

                Swal.mixin({
                    input: 'text',
                    confirmButtonText: confirm_button,
                    showCancelButton: true,
                    progressSteps: ['1']
                }).queue([
                    {
                        title: building_title,
                        text: building_text,
                        inputValidator: (value) => {
                            if (!value) {
                                return required
                            }
                        },
                        inputAttributes: {
                            autocapitalize: 'off',
                        }
                    }
                ]).then((result) => {
                    if (result.value) {
                        // alert(1);
                        // alert(result.value[0]);
                        const answers = result.value
                        $.ajax({
                            url: "rename-room",
                            type: "POST",
                            data: {_token: "{{csrf_token()}}", building: current_building, current_floor: current_floor, current_room: current_room, new_room: answers[0]  },
                            async: false,
                            success: function (data) {
                                // alert(data);
                                // window.location.reload();
                                Swal.fire({
                                    title: success_title,
                                    text: success_text,
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
        })

    }

    function deleteRoom(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,error_title,error_text,current_room,current_floor,current_building){
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
                    url: "delete-room",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: current_building, current_floor: current_floor, current_room: current_room  },
                    async: false,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
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

    function activateDeactivateRoom(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,error_title,error_text,current_room,current_floor,current_building,button){
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
                    url: "activate-deactivate-room",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", building: current_building, current_floor: current_floor, current_room: current_room, button: button  },
                    async: true,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.message);
                        // alert(thrownError);
                        // Swal.fire({
                        //     title: error_title,
                        //     text: error_text,
                        //     icon: 'error',
                        //     showCancelButton: false,
                        //     allowOutsideClick: false,
                        //     confirmButtonColor: '#dc3545',
                        //     cancelButtonColor: '#d33',
                        //     confirmButtonText: reconfirm
                        // }).then((result) => {
                        //     if (result.value) {
                        //         window.location.reload();
                        //     }
                        // })
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

    $(".bootstrap-switch-success").text('@lang("ON")');

    $(".bootstrap-switch-danger").text('@lang("OFF")');


</script>
@if (session("msg_type_permission") == "success")
    <script>
        $(document).ready(function() {
            $("#success-update").click();
        });
    </script>
@endif
@if (session("msg_type_permission") == "danger")
    <script>
        $(document).ready(function() {
            $("#danger-update").click();
        });
    </script>
@endif
@include("include/session-timeout")
@include("include/chatbot")
</body>
</html>
