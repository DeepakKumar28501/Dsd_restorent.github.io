<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
if($_SESSION['admin_login']!=true)
{
	header('location:login.php');
}
function connect($query)
{
	$q = mysqli_connect('localhost','root','12345678','dsd_restaurant');
	$res = $q->query($query);
	return $res;
}
function view_brand($id='')
{
  if($id!='')
    return connect("SELECT * FROM brand WHERE id LIKE $id")->fetch_assoc();
  else
    return connect("SELECT * FROM brand");
}
function get_items_by_brand($brand_id){
	return connect("SELECT * FROM items WHERE brand_id LIKE $brand_id");
}
function customer_list($custId='0')
{ 
  if($custId)
    return connect("SELECT * FROM customer_details WHERE id = $custId  and admin_id='".$_SESSION['admin_id']."'");
  else
    return connect("SELECT * FROM customer_details WHERE admin_id='".$_SESSION['admin_id']."' ORDER BY id  desc");
}
function admin_detail()
{
  $q = "SELECT * FROM login WHERE id LIKE '".$_SESSION['admin_id']."'";
  return connect($q);
}
function view_item($itemId=0)
{
  if($itemId)
    return connect("SELECT * FROM items WHERE id = $itemId");
  else
    return connect("SELECT * FROM items");
}
function top_header(){
 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home | DSD Restaurant</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <script src="jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
   <!-- Font Awesome -->
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <style type="text/css">
  	input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button,
  input[type=date]::-webkit-inner-spin-button,
  input[type=date]::-webkit-outer-spin-button{
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
    margin: 0;
  }.as_menu li:hover{background:black;}
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-red layout-top-nav fixed">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="" class="navbar-brand"><b>DSD</b>Restaurant</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li id="home"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
            <li id="bill"><a href="view_bill.php">Bill</a></li>
            <li class="dropdown drop_down">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Properties <span class="caret"></span></a>
              <ul class="dropdown-menu as_menu" role="menu">
                <li id="brand" class=""><a href="brand.php">Create Brand</a></li>
                <li id="items" class=""><a href="items.php">Create Item</a></li>

                <li class="divider"></li>
                <li class="divider"></li>

                <li><a href="#" >One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <form action="view_bill.php" class="navbar-form navbar-left" role="search" autocomplete="off">
            <div class="form-group">
              <input type="text" id="order_id_input" name="order_id" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="user user-menu">
              <!-- Menu Toggle Button -->
              <a href="profile.php" class="dropdown-toggle">
                <!-- The user image in the navbar-->
                <img src="dist/img/user6-128x128.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?=ucwords($_SESSION['admin'])?></span>
              </a>
            </li>
            <li class="user user-menu">
                <a href="logout.php" class="dropdown-toggle">
                  <span><i class="fa fa-power-off"></i> Log-Out</span>
                </a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper" >
    <div class="container">
 <?php
}

function bottom()
{
?>
  </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.7
      </div>
      <strong>Copyright &copy; 2019-2020 <a href="">D.S.D. Restaurant</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

      <script type="text/javascript" src="take_order.js"></script>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

<?php
}
?>