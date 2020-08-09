<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCC | @lang("Add Profile")</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" style="width: 1vw" href="../assets/logo/hcmut-logo.png"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/css/custom.css">
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
            <h1>@lang("Add Profile")</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="user-list">@lang("User List")</a></li>
              <li class="breadcrumb-item active">@lang("Add Profile")</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form method="post" action="new-profile" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                        <img id="avatar" class="profile-user-img img-fluid img-circle" src="../assets/img/avatar04.png">
                    </div>

                      <br>

                      <div class="input-group">
                          <div class="custom-file">
                                  {{csrf_field()}}
                                  <input name="user_avatar" type="file" class="custom-file-inputs" id="avatar-upload" hidden>
    {{--                          </form>--}}
                              <label class="custom-file-label custom-custom-file-label" for="avatar-upload">@lang("Avatar")</label>
                          </div>
                      </div>
                  </div>
                  <!-- /.card-body -->
                </div>
            <!-- /.card -->

            <!-- /.card -->
            </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">@lang("Settings")</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="settings">
{{--                    <form action="update-other-profile" method="post" class="form-horizontal">--}}
                        {{csrf_field()}}
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">@lang("Full Name")</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="user_fullname" placeholder="@lang("Fill in new full name")">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">@lang("Email")</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="user_email" placeholder="@lang("Fill in new email")">
                        </div>
                      </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">@lang("Mobile")</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputName2" name="user_mobile" placeholder="@lang("Fill in new mobile")">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">@lang("Role")</label>
                            <div class="col-sm-10">
                                <select name="user_role" id="select2bs4-role" class="form-control select2bs4" style="width: 100%;">
                                    <option></option>
                                    @foreach( $permission_db as $permission_each)
                                        <option value="{{{$permission_each->permission_role}}}">{{$permission_each->permission_role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNames" class="col-sm-2 col-form-label">@lang("Address")</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNames" name="user_address" placeholder="@lang("Fill in new address")">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">@lang("About")</label>
                            <div class="col-sm-10">
                                <textarea name="user_about" class="form-control" id="inputExperience" placeholder="..."></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName0" class="col-sm-2 col-form-label">@lang("Password")</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputName0" name="user_password" placeholder="@lang("Fill in new password")">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName1" class="col-sm-2 col-form-label">@lang("Password Confirm")</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputName1" name="user_password_confirmation" placeholder="@lang("Please confirm password")">
                            </div>
                        </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10 text-right">
                          <button onclick="$('#change-update-icon').removeClass('fas fa-sync-alt').addClass('fas fa-spinner fa-pulse');" type="submit" class="btn btn-danger"><i id="change-update-icon" class="fas fa-sync-alt"></i> @lang("Update")</button>
                        </div>
                      </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        </form>
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

<div id="success-update" class="toastrDefaultSuccess" ></div>
<div id="danger-update" class="toastrDefaultError" hidden></div>

<input id="select2-placeholder" type="hidden" value='@lang("Choose a role")'>
<input id="select2-noResults" type="hidden" value='@lang("No Results Found")'>

@if(session('msg_profile'))
    <input id="msg-profile" type="hidden" value="{{{ session('msg_profile') }}}">
@endif

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/js/demo.js"></script>
<!-- Bootstrap Switch -->
<script src="assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
@include("include/nav-extension")
<script>
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>
<!-- Toastr -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>
<!-- SweetAlert2 -->
<script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Select2 -->
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
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
@if (session("msg_type_profile") == "success")
    <script>
        $(document).ready(function() {
            $("#success-update").click();
        });
    </script>
@endif
@if (session("msg_type_profile") == "danger")
    <script>
        $(document).ready(function() {
            $("#danger-update").click();
        });
    </script>
@endif
<script>
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

        {{--$('#select2bs4-role').on('select2:select', function (e) {--}}
        {{--    var data = e.params.data;--}}
        {{--    $.ajax({--}}
        {{--        url: "choose-role",--}}
        {{--        type: "POST",--}}
        {{--        data: {_token: "{{csrf_token()}}", permission_role: data.id },--}}
        {{--        async: false,--}}
        {{--        success: function (data) {--}}
        {{--            // alert(data);--}}
        {{--            window.location.reload();--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}

    });
</script>
<!-- Preview Avatar -->
<script src="../assets/js/preview-avatar.js"></script>
@include("include/session-timeout")
@include("include/chatbot")
</body>
</html>
