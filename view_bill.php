<?php
include 'function.php';
top_header();
	if(isset($_GET['order_id']))
	{
?>
<style type="text/css">#bill{background:rgb(0,0,0,.3);}</style>
<script type="text/javascript">
	document.title = 'Bill no. <?=$_GET['order_id']?> | DSD Restaurant';
	$('#order_id_input').val(<?=$_GET['order_id']?>);
</script>
<section class="content-header">
  <h1>
      Invoice
    <small>#007612</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Invoice</li>
  </ol>
</section>
<?php
$cus = connect("SELECT * FROM customer_details WHERE order_id = '".$_GET['order_id']."' and admin_id = '".$_SESSION['admin_id']."'");
$d = $cus->fetch_assoc();
if($cus->num_rows)
{
?>
	 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> D.S.D. Restaurant, Inc.
            <small class="pull-right">Date: <?=date('d/m/Y',strtotime($d['timestamp']))?></small>
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
            Phone: 6397367278
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
          <b>Payment Due:</b> <?=date('d/m/Y',strtotime($d['timestamp']))?>
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

      <div class="row">
      	<div class="col-sm-6">
      		<p class="lead">Customer Sign</p><br><br>	
      		<p style="border-bottom: 1px solid black;width:200px;"></p>
      	</div>
        <div class="col-md-6 pull-right">
          <p class="lead">Amount Due <?=date('d/m/Y',strtotime($d['timestamp']))?></p>

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
          <a href="print_bill.php?order_id=<?=$_GET['order_id']?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Bill</a>
          
        </div>
      </div>
    </section>
<?php
}
else
{
?>
   <section class="content">
   		<div class="row">
   			<div class="alert alert-danger">
   				Wrong Order Id...
   				<a href="view_bill.php">Back</a>
   			</div>
   		</div>
   </section>
<?php
}
	}
	else
	{
?>
<style type="text/css">#bill{background:rgb(0,0,0,.3);}</style>
<script type="text/javascript">
	document.title = 'View Bill | DSD Restaurant';
</script>
<section class="content-header">
        <h1>
          List of Bill
          <small>D.S.D. Restaurant</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">List Bill</li>
        </ol>
    </section>
     <!-- Main content -->
    <section class="content">
    	<?php

    	if(isset($_SESSION['error']))
    	{
    		echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
    	}
    	if(isset($_SESSION['success']))
    	{
    		echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
    	}
    	unset($_SESSION['error']);
    	unset($_SESSION['success']);
    	?>
    	<div class="row">
    		<div class="col-sm-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Bills</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>#.</th>
                  <th>order ID</th>
                  <th>Customer Name</th>
                  <th style="width:200px">Date</th>
                  <th>Item's List</th>
                  <th>Total</th>
                  <th>View Bill</th>
                </tr>
                <tbody style="height:300px;overflow-x: hidden;">
                	<?php
                	$list =  customer_list();
                	if($list->num_rows)
                	{
                		$x=1;
                		while ($res=$list->fetch_assoc()) 
                		{
                		echo'<tr>
                				  <td>'.$x++.'.</td>
                          <td>'.$res['order_id'].'</td>
			                    <td>'.ucwords($res['name']).'</td>
			                    <td style="width:200px">'.date('d-M-Y',strtotime($res['timestamp'])).'</td>
			                    <td>
			                     <ol style="margin:0;padding:0">';
			                    $sale = connect("SELECT * FROM sale_items WHERE order_id = '".$res['order_id']."'");
			                   
			                    while ($itemList = $sale->fetch_assoc()) 
			                    {

			                    	echo '<li title="Quantity = '.$itemList['qty'].'" style="margin-left:7px;padding:3px;font-size:15px" class="btn btn-app label label-';
			                    			if($itemList['id']%2==0)
			                    				echo 'danger';
			                    			else
			                    			{
			                    				if($itemList['id']%3==0)
			                    					echo 'info';
			                    				else
			                    					echo 'success';
			                    			}
			                    	echo'">'.ucwords(view_item($itemList['item_id'])->fetch_assoc()['item_name']).'
			                    		<span style="margin-top:-5px;" class="badge">'.$itemList['qty'].'</span>
			                    	</li>';
			                    }

			               echo' </ol>
			                    </td>
			                    <td style="width:70px">'.$res['ttl_price'].' <i class="fa fa-rupee pull-right"></i></td>
			                    <td><a href="view_bill.php?order_id='.$res['order_id'].'" class="btn bg-maroon btn-xs">View Bill</a></td>
                		    </tr>';
                		}
                	}
                	else
                	{
                		echo '<tr align="center"><td></td><td class="text-red" style="font-size:17px">No Bill Found.</td></tr>'.$_SESSION['admin_id'];
                	}
                	?>
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    	</div>
    </section>
<?php
	}
?>
<?=bottom()?>