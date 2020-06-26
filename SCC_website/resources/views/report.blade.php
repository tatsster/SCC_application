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

            <!-- Profile Image -->
{{--            <div class="card card-primary card-outline">--}}
{{--              <div class="card-body box-profile">--}}
{{--                <div class="text-center">--}}
{{--                  <img class="profile-user-img img-fluid img-circle"--}}
{{--                       src="../assets/img/user4-128x128.jpg"--}}
{{--                       alt="User profile picture">--}}
{{--                </div>--}}

{{--                <h3 class="profile-username text-center">Nina Mcintire</h3>--}}

{{--                <p class="text-muted text-center">Software Engineer</p>--}}

{{--                <ul class="list-group list-group-unbordered mb-3">--}}
{{--                  <li class="list-group-item">--}}
{{--                    <b>Followers</b> <a class="float-right">1,322</a>--}}
{{--                  </li>--}}
{{--                  <li class="list-group-item">--}}
{{--                    <b>Following</b> <a class="float-right">543</a>--}}
{{--                  </li>--}}
{{--                  <li class="list-group-item">--}}
{{--                    <b>Friends</b> <a class="float-right">13,287</a>--}}
{{--                  </li>--}}
{{--                </ul>--}}

{{--                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>--}}
{{--              </div>--}}
{{--              <!-- /.card-body -->--}}
{{--            </div>--}}
            <!-- /.card -->

            <!-- About Me Box -->
{{--            <div class="card card-primary">--}}
{{--              <div class="card-header">--}}
{{--                <h3 class="card-title">About Me</h3>--}}
{{--              </div>--}}
{{--              <!-- /.card-header -->--}}
{{--              <div class="card-body">--}}
{{--                <strong><i class="fas fa-book mr-1"></i> Education</strong>--}}

{{--                <p class="text-muted">--}}
{{--                  B.S. in Computer Science from the University of Tennessee at Knoxville--}}
{{--                </p>--}}

{{--                <hr>--}}

{{--                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>--}}

{{--                <p class="text-muted">Malibu, California</p>--}}

{{--                <hr>--}}

{{--                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>--}}

{{--                <p class="text-muted">--}}
{{--                  <span class="tag tag-danger">UI Design</span>--}}
{{--                  <span class="tag tag-success">Coding</span>--}}
{{--                  <span class="tag tag-info">Javascript</span>--}}
{{--                  <span class="tag tag-warning">PHP</span>--}}
{{--                  <span class="tag tag-primary">Node.js</span>--}}
{{--                </p>--}}

{{--                <hr>--}}

{{--                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>--}}

{{--                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>--}}
{{--              </div>--}}
{{--              <!-- /.card-body -->--}}
{{--            </div>--}}
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

                      <select name="user_lang" id="select2bs4-building" style="" class="form-control select2bs4" style="width: 100%;">
                          @if (session("1752051_current_building")["building"] == "")
                              <option></option>
                          @endif
                          @foreach( $building_db as $building_each)
                              @if (session("1752051_current_building")["building"] == $building_each->building_name)
                                  <option selected value="{{{$building_each->building_name}}}">{{$building_each->building_name}}</option>
                              @else
                                  <option value="{{{$building_each->building_name}}}">{{$building_each->building_name}}</option>
                              @endif
                          @endforeach
                      </select>

                        <br>

                      @if (session("1752051_current_building")["building"] != "" )

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- The time line -->
                                    <div class="timeline">
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-primary"><a href="report">@lang("Building: ") {{ session("1752051_current_building")["building"] }}</a></span>
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <div>
                                            @php

                                                $floor_array = session("1752051_current_building");

                                                unset($floor_array["building"]);

                                                $floor_keys = array_keys($floor_array);

                                            @endphp
                                            @for ($i = 0; $i < count($floor_array); $i++)
                                                <i class="fas fa-building bg-success"></i>
                                                <div class="timeline-item">
    {{--                                                <span class="time"><i class="fas fa-clock"></i> Cập nhật cấu trúc tầng ngày 11/05/2020</span>--}}
                                                    <h3 class="timeline-header text-danger text-bold"><a href="report-floor">@lang("Floor: ") {{  $floor_keys[$i] }}</a></h3>

{{--                                                    <div class="timeline-body">--}}
{{--                                                        @lang("Room(s): ")--}}
{{--                                                    </div>--}}
                                                    <div class="timeline-footer">
                                                        @for ($j = 0; $j < count($floor_array[$floor_keys[$i]]); $j++)
                                                            <div class="btn-group">
                                                                <button type="button" onclick="chooseRoom('{{{ session("1752051_current_building")["building"] }}}','{{{  $floor_keys[$i] }}}','{{{ $floor_array[$floor_keys[$i]][$j] }}}')" class="btn btn-info">{{ $floor_array[$floor_keys[$i]][$j] }}</button>
                                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                    <div class="dropdown-menu" role="menu" style="">
        {{--                                                                <a class="dropdown-item" href="#">Action</a>--}}
        {{--                                                                <a class="dropdown-item" href="#">Another action</a>--}}
        {{--                                                                <a class="dropdown-item" href="#">Something else here</a>--}}
        {{--                                                                <div class="dropdown-divider"></div>--}}
        {{--                                                                <a class="dropdown-item" href="#">Separated link</a>--}}
                                                                    </div>
                                                                </button>
                                                            </div>
        {{--                                                    <a href="report-room" class="btn btn-primary btn-lg">Room 500</a>--}}
        {{--                                                    <a href="report-room" class="btn btn-info btn-lg">Room 501</a>--}}
        {{--                                                    <a href="report-room" class="btn btn-success btn-lg">Room 502</a>--}}
        {{--                                                    <a href="report-room" class="btn btn-info btn-lg">Room 503</a>--}}
        {{--                                                    <a href="report-room" class="btn btn-danger btn-lg">Room 504</a>--}}
        {{--                                                    <a href="report-room" class="btn btn-warning btn-lg">Library 505</a>--}}
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endfor
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
</body>
</body>
</html>
