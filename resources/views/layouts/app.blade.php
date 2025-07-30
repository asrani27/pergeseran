<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BPKPAD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/bower_components/Ionicons/css/ionicons.min.css">
  @stack('css')
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- IziToast -->
  <link rel="stylesheet" href="/notif/dist/css/iziToast.min.css">
  <script src="/notif/dist/js/iziToast.min.js" type="text/javascript"></script>
</head>
<style>
  body {
    margin: 0;
    padding: 0;

  }

  #countdown-container {
    position: fixed;
    top: 0px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #333;
    color: #fff;
    padding: 5px 5px;
    border-radius: 5px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    font-size: 16px;
    z-index: 1050;
    text-align: center;
  }

  #countdown-title {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 6px;
  }

  .countdown-section {
    display: inline-block;
    margin: 0 10px;
    text-align: center;
  }

  .countdown-time {
    font-size: 25px;
    font-weight: bold;
    line-height: 1;
    color: #FFD700;
  }

  .countdown-label {
    font-size: 12px;
    margin-top: 0px;
    display: block;
    color: #FFD700;
  }
</style>
{{-- <div id="running-text">
  <marquee>{{runningText()}}</marquee>
</div> --}}

<body class="hold-transition skin-blue-light sidebar-mini" style="background-color: #008080">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">BPKPAD</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>BPKPAD</b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        @include('layouts.navbar')
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      @include('layouts.sidebar')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- Main content -->
      <section class="content container-fluid">
        <div id="countdown-container">
          <div id="countdown-title">SISA WAKTU INPUT</div>
          <div id="countdown">
            <div class="countdown-section">
              <span id="days" class="countdown-time">00</span>
              <span class="countdown-label">Hari</span>
            </div>
            <div class="countdown-section">
              <span id="hours" class="countdown-time">00</span>
              <span class="countdown-label">Jam</span>
            </div>
            <div class="countdown-section">
              <span id="minutes" class="countdown-time">00</span>
              <span class="countdown-label">Menit</span>
            </div>
            <div class="countdown-section">
              <span id="seconds" class="countdown-time">00</span>
              <span class="countdown-label">Detik</span>
            </div>
          </div>
        </div>
        @yield('content')

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        BIDANG ANGGARAN
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2022 <a href="#">Kota Banjarmasin</a>.</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Some information about this general settings option
              </p>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/assets/dist/js/adminlte.min.js"></script>

  <script>
    // Set target date and time
  console.log("{{ targetDate() }}")
        const targetDate = new Date("{{ targetDate() }}").getTime();

  function updateCountdown() {
      const now = new Date().getTime();
      const distance = targetDate - now;

      // Calculate time components
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result
            document.getElementById("days").textContent = days.toString().padStart(2, '0');
            document.getElementById("hours").textContent = hours.toString().padStart(2, '0');
            document.getElementById("minutes").textContent = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").textContent = seconds.toString().padStart(2, '0');

      // If the countdown is over
      if (distance < 0) {
          clearInterval(interval);
          document.getElementById("countdown").textContent = "Waktu Habis!";
      }
  }

  // Update the countdown every second
  const interval = setInterval(updateCountdown, 1000);
  </script>
  {{-- <script>
    @include('layouts.notif')
var tanggal = {!!json_encode(batasWaktu())!!}
var countDownDate = new Date(tanggal+" 23:59:59").getTime();
var x = setInterval(function() {
// Get today's date and time
var now = new Date().getTime();
// Find the distance between now and the count down date
var distance = countDownDate - now;
// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
// Display the result in the element with id="demo"
document.getElementById("timer").innerHTML = days + " hari  " + hours + ":"
+ minutes + ":" + seconds + "";

// If the count down is finished, write some text
if (distance < 0) {
  clearInterval(x);
  document.getElementById("demo").innerHTML = "EXPIRED";
}
}, 1000);
console.log(tanggal,countDownDate);
  </script> --}}
  @stack('js')


  <script type="text/javascript">
    @include('layouts.notif')
  </script>
</body>

</html>