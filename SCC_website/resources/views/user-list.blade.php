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
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
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
                            <a href="profile" class="btn btn-sm btn-primary">
                              <i class="fas fa-user"></i> @lang("Edit Profile")
                            </a>
                          @endif
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
{{--            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">--}}
{{--              <div class="card bg-light">--}}
{{--                <div class="card-header text-muted border-bottom-0">--}}
{{--                  Digital Strategist--}}
{{--                </div>--}}
{{--                <div class="card-body pt-0">--}}
{{--                  <div class="row">--}}
{{--                    <div class="col-7">--}}
{{--                      <h2 class="lead"><b>Nicole Pearson</b></h2>--}}
{{--                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>--}}
{{--                      <ul class="ml-4 mb-0 fa-ul text-muted">--}}
{{--                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>--}}
{{--                      </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-5 text-center">--}}
{{--                      <img src="assets/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                  <div class="text-right">--}}
{{--                    <a href="#" class="btn btn-sm bg-teal">--}}
{{--                      <i class="fas fa-comments"></i>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="btn btn-sm btn-primary">--}}
{{--                      <i class="fas fa-user"></i> View Profile--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">--}}
{{--              <div class="card bg-light">--}}
{{--                <div class="card-header text-muted border-bottom-0">--}}
{{--                  Digital Strategist--}}
{{--                </div>--}}
{{--                <div class="card-body pt-0">--}}
{{--                  <div class="row">--}}
{{--                    <div class="col-7">--}}
{{--                      <h2 class="lead"><b>Nicole Pearson</b></h2>--}}
{{--                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>--}}
{{--                      <ul class="ml-4 mb-0 fa-ul text-muted">--}}
{{--                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>--}}
{{--                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>--}}
{{--                      </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-5 text-center">--}}
{{--                      <img src="assets/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                  <div class="text-right">--}}
{{--                    <a href="#" class="btn btn-sm bg-teal">--}}
{{--                      <i class="fas fa-comments"></i>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="btn btn-sm btn-primary">--}}
{{--                      <i class="fas fa-user"></i> View Profile--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">--}}
{{--              <div class="card bg-light">--}}
{{--                <div class="card-header text-muted border-bottom-0">--}}
{{--                  Digital Strategist--}}
{{--                </div>--}}
{{--                <div class="card-body pt-0">--}}
{{--                  <div class="row">--}}
{{--                    <div class="col-7">--}}
{{--                      <h2 class="lead"><b>Nicole Pearson</b></h2>--}}
{{--                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>--}}
{{--                      <ul class="ml-4 mb-0 fa-ul text-muted">--}}
{{--                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>--}}
{{--                      </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-5 text-center">--}}
{{--                      <img src="assets/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                  <div class="text-right">--}}
{{--                    <a href="#" class="btn btn-sm bg-teal">--}}
{{--                      <i class="fas fa-comments"></i>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="btn btn-sm btn-primary">--}}
{{--                      <i class="fas fa-user"></i> View Profile--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">--}}
{{--              <div class="card bg-light">--}}
{{--                <div class="card-header text-muted border-bottom-0">--}}
{{--                  Digital Strategist--}}
{{--                </div>--}}
{{--                <div class="card-body pt-0">--}}
{{--                  <div class="row">--}}
{{--                    <div class="col-7">--}}
{{--                      <h2 class="lead"><b>Nicole Pearson</b></h2>--}}
{{--                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>--}}
{{--                      <ul class="ml-4 mb-0 fa-ul text-muted">--}}
{{--                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>--}}
{{--                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>--}}
{{--                      </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-5 text-center">--}}
{{--                      <img src="assets/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                  <div class="text-right">--}}
{{--                    <a href="#" class="btn btn-sm bg-teal">--}}
{{--                      <i class="fas fa-comments"></i>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="btn btn-sm btn-primary">--}}
{{--                      <i class="fas fa-user"></i> View Profile--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">--}}
{{--              <div class="card bg-light">--}}
{{--                <div class="card-header text-muted border-bottom-0">--}}
{{--                  Digital Strategist--}}
{{--                </div>--}}
{{--                <div class="card-body pt-0">--}}
{{--                  <div class="row">--}}
{{--                    <div class="col-7">--}}
{{--                      <h2 class="lead"><b>Nicole Pearson</b></h2>--}}
{{--                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>--}}
{{--                      <ul class="ml-4 mb-0 fa-ul text-muted">--}}
{{--                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>--}}
{{--                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>--}}
{{--                      </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-5 text-center">--}}
{{--                      <img src="assets/img/user2-160x160.jpg" alt="" class="img-circle img-fluid">--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                  <div class="text-right">--}}
{{--                    <a href="#" class="btn btn-sm bg-teal">--}}
{{--                      <i class="fas fa-comments"></i>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="btn btn-sm btn-primary">--}}
{{--                      <i class="fas fa-user"></i> View Profile--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
              {{ $user_list->links() }}
{{--            <ul class="pagination justify-content-center m-0">--}}
{{--              <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--              <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--              <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--              <li class="page-item"><a class="page-link" href="#">4</a></li>--}}
{{--              <li class="page-item"><a class="page-link" href="#">5</a></li>--}}
{{--              <li class="page-item"><a class="page-link" href="#">6</a></li>--}}
{{--              <li class="page-item"><a class="page-link" href="#">7</a></li>--}}
{{--              <li class="page-item"><a class="page-link" href="#">8</a></li>--}}
{{--            </ul>--}}
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

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
{{--<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
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
<!-- Navbar -->
@include("include/nav-extension")
</body>
</html>
