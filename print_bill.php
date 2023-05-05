<?php
include 'function.php';

$cus = connect("SELECT * FROM customer_details WHERE order_id = '".$_GET['order_id']."' and admin_id = '".$_SESSION['admin_id']."'");
$d = $cus->fetch_assoc();
if($cus->num_rows)
{
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Bill Print | DSD Restaurant</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script src="jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
</head>
<body onload="window.print();">
<div class="wrapper">
  
	 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> D.S.D. Restaurant, Inc.
            <small class="pull-right">Date: <?=date('m/d/Y',strtotime($d['timestamp']))?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>D.S.D. Restaurant, Inc.</strong><br>
            S.R.K College<br>
            Firozabad<br>
            Phone: (827) 935-0461
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?=$d['name']?></strong><br>
            Phone: <?=$d['mobile']?><br>
            Email: 
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> <?='#'.$_GET['order_id']?><br>
          <b>Payment Due:</b> <?=date('m/d/Y',strtotime($d['timestamp']))?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Item Name</th>
              <th>Brand</th>
              <th>Price</th>
              <th>QTY</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $l = connect("SELECT * FROM sale_items WHERE order_id = '".$_GET['order_id']."'");
            $x=1;
            while($s=$l->fetch_assoc())
            {
            	$i = view_item($s['item_id'])->fetch_assoc();
              echo '<tr>
		              <td>'.$x++.'.</td>
		              <td>'.ucwords($i['item_name']).'</td>
                  <td>'.ucwords(view_brand($i['brand_id'])['brand_name']).'</td>
		              <td>'.$i['price'].' <i class="fa fa-rupee"></i><i class="pull-right">*</i></td>
		              <td>'.$s['qty'].'<i class="pull-right">=</i></td>
		              <td>'.$i['price']*$s['qty'].' <i class="fa fa-rupee"></i></td>
		            </tr>';
            }	
            ?>
            
           
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row invoice-info">
      	<div class="col-sm-6 invoice-col">
      		<p class="lead">Customer Sign</p><br><br>	
      		<p style="border-bottom: 1px solid black;width:200px"></p>
      	</div>
        <div class="col-sm-6 pull-right invoice-col">
          <p class="lead">Amount Due <?=date('m/d/Y',strtotime($d['timestamp']))?></p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td><?=$d['ttl_price']?> <i class="fa fa-rupee"></i></td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td><?=round($d['ttl_price']*(9.3/100),2)?> <i class="fa fa-rupee"></i></td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>10 <i class="fa fa-rupee"></i></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?=$d['ttl_price']+round($d['ttl_price']*(9.3/100),2)+10?> <i class="fa fa-rupee"></i></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print Bill</button>
          <button onclick="window.close()" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button>
        </div>
      </div>
    </section>
</div>
<!-- ./wrapper -->
</body>
</html>
	<?php
}
else
{
	?>
<script type="text/javascript">
	alert("Wrong Order Id .....");
    window.close();
</script>
	<?php
}

?>