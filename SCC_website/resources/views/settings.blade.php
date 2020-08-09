<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | @lang("Settings")</title>
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
            <h1>@lang("Settings")</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">@lang("Dashboard")</a></li>
              <li class="breadcrumb-item active">@lang("Settings")</li>
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
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
{{--                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>--}}
                  <li class="nav-item"><a class="nav-link active" href="#system-settings" data-toggle="tab">@lang("System Settings")</a></li>
{{--                  <li class="nav-item"><a class="nav-link" href="#dashboard-settings" data-toggle="tab">@lang("Dashboard Settings")</a></li>--}}
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="system-settings">
        <form class="form-horizontal">
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">@lang("Backup Log System")</label>
                <div class="col-sm-10">
                    @if ($settings_array["backup_log_system"] == "true")
                        <input id="backup-log-system" type="checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    @else
                        <input id="backup-log-system" type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">@lang("Maintenance System")</label>
                <div class="col-sm-10">
                    @if ($settings_array["maintenance_system"] == "true")
                        <input id="maintenance-system" type="checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    @else
                        <input id="maintenance-system" type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    @endif
                </div>
            </div>
            <div class="form-group row setting-update-button-form-group">
                <div class="offset-sm-2 col-sm-10">
{{--                    updateSystemSettings($('#backup-log-system').value,$('#maintenance-system').value)--}}
                    <button type="button" onclick="updateSystemSettings($('#backup-log-system').is(':checked'),$('#maintenance-system').is(':checked'))" class="btn btn-danger">@lang("Update")</button>
                </div>
            </div>
        </form>
    </div>

{{--                  <div class="tab-pane" id="dashboard-settings">--}}
{{--                    <form class="form-horizontal">--}}
{{--                      <div class="form-group row">--}}
{{--                        <label for="inputName" class="col-sm-2 col-form-label">@lang("Update Temperature Every")</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                          <input type="email" class="form-control" id="inputName" placeholder="Name">--}}
{{--                            <div class="input-group mb-3">--}}
{{--                                <input id="time_update_temp" type="number" class="form-control" value="{{{$settings_array["time_update_temp"]}}}">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text">--}}
{{--                                        @lang("second(s)")--}}
{{--                                        <i class="fas fa-temperature-high"></i>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="inputName" class="col-sm-2 col-form-label">@lang("Update Humidity Every")</label>--}}
{{--                            <div class="col-sm-10">--}}
{{--                                --}}{{--                          <input type="email" class="form-control" id="inputName" placeholder="Name">--}}
{{--                                <div class="input-group mb-3">--}}
{{--                                    <input id="time_update_humid" type="number" class="form-control" value="{{{$settings_array["time_update_humid"]}}}">--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <span class="input-group-text">--}}
{{--                                            @lang("second(s)")--}}
{{--                                            <i class="far fa-snowflake"></i>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="inputName" class="col-sm-2 col-form-label">@lang("Update Heat Index Every")</label>--}}
{{--                            <div class="col-sm-10">--}}
{{--                                --}}{{--                          <input type="email" class="form-control" id="inputName" placeholder="Name">--}}
{{--                                <div class="input-group mb-3">--}}
{{--                                    <input id="time_update_heat_index" type="number" class="form-control" value="{{{$settings_array["time_update_heat_index"]}}}">--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <span class="input-group-text">--}}
{{--                                            @lang("second(s)")--}}
{{--                                            --}}{{--                                            <i class="far fa-snowflake"></i>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                      <div class="form-group row">--}}
{{--                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="form-group row">--}}
{{--                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                          <input type="text" class="form-control" id="inputName2" placeholder="Name">--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="form-group row">--}}
{{--                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="form-group row">--}}
{{--                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="form-group row">--}}
{{--                        <div class="offset-sm-2 col-sm-10">--}}
{{--                          <div class="checkbox">--}}
{{--                            <label>--}}
{{--                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>--}}
{{--                            </label>--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="form-group row setting-update-button-form-group">--}}
{{--                        <div class="offset-sm-2 col-sm-10">--}}
{{--                            <button type="button" onclick="updateDashboardSettings($('#time_update_temp').val(),$('#time_update_humid').val(),$('#time_update_heat_index').val())" class="btn btn-danger">@lang("Update")</button>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </form>--}}
{{--                  </div>--}}
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
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
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Toastr -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>

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
        $('.toastrDefaultInfo').click(function() {
            toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultError').click(function() {
            toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
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

    {{--function updateDashboardSettings(temp,humid,heat_index){--}}
    {{--    $.ajax({--}}
    {{--        url: "change-dashboard-settings",--}}
    {{--        type: "POST",--}}
    {{--        data: {_token: "{{csrf_token()}}", time_update_temp: temp, time_update_humid: humid, time_update_heat_index: heat_index },--}}
    {{--        async: false,--}}
    {{--        success: function (data) {--}}
    {{--            message_json = JSON.parse(data.split("GMT")[1]);--}}
    {{--            $(document).ready(function() {--}}
    {{--                $("#success-alert").click();--}}
    {{--            });--}}
    {{--        }--}}
    {{--    })--}}
    {{--}--}}

    $(".bootstrap-switch-success").text('@lang("ON")');

    $(".bootstrap-switch-danger").text('@lang("OFF")');

</script>
@include("include/session-timeout")
@include("include/chatbot")
</body>
</html>
