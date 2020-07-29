<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | @lang("Permission")</title>
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
            <h1>@lang("Permission")</h1>
              @if (session("1752051_user_role")["permission_create_role"])
                  <br>
                  <a href="#/" onclick="addNewRole('@lang("Submit a new role name")','@lang("Create")','@lang("Cancel")','@lang("New Role Create")','@lang("Please check the option to modify new role permission")','@lang("OK")','@lang("Input role name cannot be empty !!!")','@lang("Error !!!")','@lang("This role name had already existed !!!")')" class="btn btn-lg btn-primary">
                      <i class="fas fa-user"></i>&ensp;@lang("Add Role")
                  </a>
              @endif
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">@lang("Dashboard")</a></li>
              <li class="breadcrumb-item active">@lang("Permission")</li>
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
                      <h3 class="card-title">@lang("Permission Setting")</h3>
                  </div>
                  <div class="card-body">
                    <form action="update-or-delete-role" method="post">
                        {{csrf_field()}}
{{--                      <h5 class="mt-4 mb-2">@lang("Choose role and set permission")</h5>--}}

                      <select id="select2bs4-role" class="form-control select2bs4" style="width: 100%;">
                          @if (session("1752051_current_role")["permission_role"] == "")
                              <option></option>
                          @endif
                          @foreach( $permission_db as $permission_each)
                              @if (session("1752051_current_role")["permission_role"] == $permission_each->permission_role)
                                  <option selected value="{{{$permission_each->permission_role}}}">{{$permission_each->permission_role}}</option>
                              @else
                                  <option value="{{{$permission_each->permission_role}}}">{{$permission_each->permission_role}}</option>
                              @endif
                          @endforeach
                      </select>

                      @if (session("1752051_current_role")["permission_role"] != "" )

                          <h5 class="mt-4 mb-2">@lang("Change Role Name")</h5>

                          <input type="text" class="form-control" name="permission_role" value='@lang(session("1752051_current_role")["permission_role"])'>

                            @php

                                $permission_array = session("1752051_current_role")->toArray();

                                unset($permission_array["permission_id"]);
                                unset($permission_array["permission_role"]);

                                $permission_values = array_values($permission_array);
                                $permission_keys = array_keys($permission_array);

                            @endphp

                          <h5 class="mt-4 mb-2">@lang("Permission Options")</h5>
                      <br>
                          <div class="form-group row">
                      @for($i = 0; $i < count($permission_values); $i++)
                          @php

                            $name = ucwords(str_replace("_", " ", explode("permission_",$permission_keys[$i])[1]));

                          @endphp
                              <label for="inputName" class="col-sm-2 col-form-label">@lang($name)</label>
                              <div class="col-sm-2">
                                  @if ($permission_values[$i] == "true")
                                      <input name="{{{$permission_keys[$i]}}}" type="checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                  @else
                                      <input name="{{{$permission_keys[$i]}}}" type="checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                  @endif
                              </div>
                      @endfor

                          </div>
                            <br>
                          <div class="form-group row setting-update-button-form-group">
                              <div class="offset-sm-2 col-sm-10">
                                  <button type="submit" name="btn-delete" value="1" class="btn btn-danger">@lang("Delete")</button>
                                  <button type="submit" name="btn-update" value="1" class="btn btn-success">@lang("Update")</button>
                              </div>
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

<input id="select2-placeholder" type="hidden" value='@lang("Choose a role to modify")'>
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
        $('#select2bs4-role').select2({
            theme: 'bootstrap4',
            placeholder: $('#select2-placeholder').val(),
            language: {
                "noResults": function(){
                    return $('#select2-noResults').val();
                }
            }
        })

        $('#select2bs4-role').on('select2:select', function (e) {
            var data = e.params.data;
            $.ajax({
                url: "choose-role",
                type: "POST",
                data: {_token: "{{csrf_token()}}", permission_role: data.id },
                async: false,
                success: function (data) {
                    // alert(data);
                    window.location.reload();
                }
            })
        });

    });

    function addNewRole(title,create,cancel,title_inform,text_inform,reconfirm,required,error_title,error_text) {
        Swal.fire({
            title: title,
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return required
                }
            },
            inputAttributes: {
                autocapitalize: 'off',
            },
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonText: create,
            showLoaderOnConfirm: true,
            preConfirm: (role) => {
                $.ajax({
                    url: "create-role",
                    type: "POST",
                    data: {_token: "{{csrf_token()}}", permission_role: role },
                    async: false,
                    success: function (data) {
                        // alert(data);
                        // window.location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
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
            },
            allowOutsideClick: () => !Swal.isLoading()
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
