<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DSD Restaurant | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page" style="background:url('assest/image/back.jpg');background-size:100% 100%">
<div class="login-box">
  <div class="login-logo">
    <a href="" class="text-yellow" style="font-family:cursive;text-shadow:1px 2px 1px white">
      <b>
        <b class="text-red" >D.</b>
        <b class="text-green">S.</b>
        <b class="text-aqua">D.</b>
      </b>
      Restaurant
    </a>
  </div>
  <?php
  if(isset($_SESSION['error']))
  {
    echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
  }
  ?>
  <!-- /.login-logo -->
  <div class="login-box-body" style="box-shadow:0  0 10px 0 white;border-radius:10px;background:rgb(0,0,0,.5)">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="connection.php" method="post" autocomplete="off">
      <input type="hidden" name="status" value="login">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" autofocus="">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
