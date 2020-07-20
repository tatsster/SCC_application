<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | @lang("User List")</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" style="width: 1vw" href="../assets/logo/hcmut-logo.png"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
{{--    <link rel="stylesheet" href="../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">--}}
    <!-- iCheck -->
{{--    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">--}}
    <!-- JQVMap -->
{{--    <link rel="stylesheet" href="../assets/plugins/jqvmap/jqvmap.min.css">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
{{--    <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">--}}
    <!-- summernote -->
{{--    <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.css">--}}
    <!-- DataTables -->
{{--    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">--}}
{{--    <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">--}}
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../assets/css/custom.css">
    <!-- Flag Icon -->
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../assets/plugins/toastr/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
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
            <h1>@lang("User List")</h1>
              @if (session("1752051_user_role")["permission_create_user"] == "true")
                  <br>
                  <a href="add-profile" class="btn btn-lg btn-primary">
                      <i class="fas fa-user"></i> @lang("Add User")
                  </a>
              @endif
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">@lang("Dashboard")</a></li>
              <li class="breadcrumb-item active">@lang("User List")</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="input-group input-group-md mb-3">
                <form id="real-user-search-form" action="find-profile" method="get">
                    <input id="real-user-search-input" name="search" type="text" class="form-control" hidden>
                    @if (session("search-button-type") == null)
                        <input id="real-user-search-type" name="type" type="text" value="0" class="form-control" hidden>
                    @else
                        <input id="real-user-search-type" name="type" type="text" value="{{{ session('search-button-type') }}}" class="form-control" hidden>
                    @endif
                </form>
                    <input type="text" id="fake-user-search-input" value="{{{ $search ?? '' }}}" onchange="$('#real-user-search-input').val($('#fake-user-search-input').val())" class="form-control">
                    <div class="input-group-prepend">
                        @if (session("search-button-type") == 0)
                            <button type="button" id="finding-option" class="btn btn-primary dropdown-toggle custom-dropdown-toggle" data-toggle="dropdown">
                                @lang("Find All Profile")
                            </button>
                        @elseif (session("search-button-type") == 1)
                            <button type="button" id="finding-option" class="btn btn-success dropdown-toggle custom-dropdown-toggle" data-toggle="dropdown">
                                @lang("Find Activated Profile")
                            </button>
                        @else
                            <button type="button" id="finding-option" class="btn btn-warning dropdown-toggle custom-dropdown-toggle" data-toggle="dropdown">
                                @lang("Find Deactivated Profile")
                            </button>
                        @endif
                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="#/" onclick="$('#real-user-search-input').val($('#fake-user-search-input').val());$('#real-user-search-type').val(0);$('#real-user-search-form').submit();">@lang("Find All Profile")</a></li>
                            <li class="dropdown-item"><a href="#/" onclick="$('#real-user-search-input').val($('#fake-user-search-input').val());$('#real-user-search-type').val(1);$('#real-user-search-form').submit();">@lang("Find Activated Profile")</a></li>
                            <li class="dropdown-item"><a href="#/" onclick="$('#real-user-search-input').val($('#fake-user-search-input').val());$('#real-user-search-type').val(2);$('#real-user-search-form').submit();">@lang("Find Deactivated Profile")</a></li>
                        </ul>
                    </div>
                <!-- /btn-group -->
            </div>
            <!-- /input-group -->
          <div class="row d-flex align-items-stretch">
              @foreach($user_list as $user_each)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                  <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                      {{  $user_each["user_role"] }}
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                          <h2 class="lead"><b>{{  $user_each["user_fullname"] }}</b></h2>
                            <div class="text-muted border-bottom-0">
                                {{  $user_each["user_about"] }}
                            </div>
                            <hr>
    {{--                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>--}}
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-marker-alt"></i></span> {{  $user_each["user_address"] }}</li>
                              <br>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span><a href="mailto:{{{  $user_each["user_email"] }}}" style="text-decoration: none; color: #6c757d" > {{  $user_each["user_email"] }}</a></li>
                              <br>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mobile"></i></span><a href="tel:{{{  $user_each["user_mobile"] }}}" style="text-decoration: none; color: #6c757d" > {{ $user_each["user_mobile"] }}</a></li>
                          </ul>
                        </div>
                        <div class="col-5 text-center">
                            @if ($user_each["user_avatar"] == "")
                                <img id="avatar" class="img-circle img-fluid" src="../assets/img/avatar04.png">
                            @else
                                <img id="avatar" class="img-circle img-fluid" src="{{{$user_each["user_avatar"]}}}">
                            @endif
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="text-right">
                        <a href="#" class="btn btn-sm bg-teal">
                          <i class="fas fa-comments"></i>
                        </a>
                          @if($user_each["user_id"] != session("1752051_user")["user_id"] && session("1752051_user_role")["permission_edit_user"] == "true")
                              <form action="edit-other-profile-get" method="post" style="display: inline-block">
                                  {{ csrf_field() }}
                                <button type="submit" name="current_user_email" value="{{{ $user_each["user_email"] }}}" name="current_user_email" class="btn btn-sm btn-primary">
                                  <i class="fas fa-user"></i> @lang("Edit")
                                </button>
                                  @if($user_each["user_active"] == true)
                                      <button id="deactivate-email-{{{ $loop->iteration }}}" type="submit" name="current_user_deactivate" value="{{{ $user_each["user_email"] }}}" class="btn btn-sm btn-warning" hidden>
                                          <i class="fa fa-lock"></i> @lang("Deactivate")
                                      </button>
                                      <a type="submit" onclick="deactivateUser('@lang("Are you sure?")','@lang("You are deactivating "){{{ $user_each["user_email"] }}} !!!','@lang("Yes, deactivate!")','@lang("Cancel")','@lang("Deactivate!")','@lang("You deactivated ") {{{ $user_each["user_email"] }}} !!!','@lang("OK")','{{{ $loop->iteration }}}')" class="btn btn-sm btn-warning">
                                          <i class="fa fa-lock"></i> @lang("Deactivate")
                                      </a>
                                  @else
                                      <button id="activate-email-{{{ $loop->iteration }}}" type="submit" name="current_user_activate" value="{{{ $user_each["user_email"] }}}" class="btn btn-sm btn-warning" hidden>
                                          <i class="fa fa-unlock"></i> @lang("Activate")
                                      </button>
                                      <a type="submit" onclick="activateUser('@lang("Are you sure?")','@lang("You are activating "){{{ $user_each["user_email"] }}} !!!','@lang("Yes, activate!")','@lang("Cancel")','@lang("Activate!")','@lang("You activated ") {{{ $user_each["user_email"] }}} !!!','@lang("OK")','{{{ $loop->iteration }}}')" class="btn btn-sm btn-warning">
                                          <i class="fa fa-unlock"></i> @lang("Activate")
                                      </a>
                                  @endif
                                  <button type="submit" id="delete-email-{{{ $loop->iteration }}}" name="current_user_email_delete" value="{{{ $user_each["user_email"] }}}" name="current_user_email" hidden>
                                  </button>
                                  <a href="#/" onclick="deleteUser('@lang("Are you sure?")','@lang("You might not want to delete "){{{ $user_each["user_email"] }}} !!!','@lang("Yes, delete!")','@lang("Cancel")','@lang("Delete!")','@lang("You deleted ") {{{ $user_each["user_email"] }}} !!!','@lang("OK")','{{{ $loop->iteration }}}')" class="btn btn-sm btn-danger">
                                      <i class="fa fa-trash"></i> @lang("Delete")
                                  </a>
                              </form>
                          @endif
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
              {{ $user_list->links() }}
          </nav>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

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

<div id="success-update" class="toastrDefaultSuccess" ></div>
<div id="danger-update" class="toastrDefaultError" hidden></div>

@if(session('msg_user_list'))
    <input id="msg-profile" type="hidden" value="{{{ session('msg_user_list') }}}">
@endif

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
<!-- Tempusdominus Bootstrap 4 -->
{{--<script src="../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>--}}
<!-- Summernote -->
<script src="../assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.js"></script>
<!-- date-range-picker -->
<script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Toastr -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>
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
            toastr.success($("#msg-profile").val())
        });

        $('.toastrDefaultInfo').click(function() {
            toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });

        $('.toastrDefaultError').click(function() {
            toastr.error($("#msg-profile").val())
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
@if (session("msg_type_user_list") == "success")
    <script>
        $(document).ready(function() {
            $("#success-update").click();
        });
    </script>
@endif
@if (session("msg_type_user_list") == "danger")
    <script>
        $(document).ready(function() {
            $("#danger-update").click();
        });
    </script>
@endif
<script>

    function deleteUser(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,email_number){
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
                    icon: 'error',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#d33',
                    confirmButtonText: reconfirm
                }).then((result) => {
                    $("#delete-email-" + email_number).click();
                })
            }
        })

    }

    function activateUser(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,email_number){
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
                    $("#activate-email-" + email_number).click();
                })
            }
        })

    }

    function deactivateUser(title_ask,text_warning,confirm,cancel,title_inform,text_inform,reconfirm,email_number){
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
                    icon: 'error',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#d33',
                    confirmButtonText: reconfirm
                }).then((result) => {
                    $("#deactivate-email-" + email_number).click();
                })
            }
        })

    }

    document.onkeypress = keyPress;

    function keyPress(e){
        var x = e || window.event;
        var key = (x.keyCode || x.which);
        if(key == 13 || key == 3){
            //  myFunc1();
            $('#real-user-search-input').val($('#fake-user-search-input').val());
            $('#real-user-search-form').submit();
        }
    }

</script>
<!-- Navbar -->
@include("include/nav-extension")
@include("include/session-timeout")
@include("include/chatbot")
</body>
</html>
