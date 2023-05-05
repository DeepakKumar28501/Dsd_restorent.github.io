<?php
include 'function.php';

if($_POST['status']=='login')
{
	$t = connect("SELECT * FROM login WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'");
	$res = $t->fetch_assoc();
	if($t->num_rows)
	{

		$_SESSION['admin_id']		=	$res['id'];
		$_SESSION['admin'] 			= 	$res['username'];
		$_SESSION['admin_login'] 	= 	true;
		header('location:index.php');
	}
	else
	{
		$_SESSION['error'] = 'Wrong Username Or Password.';
		header('location:login.php');
	}
}
// jhasgdjad' or 1=1#
if($_POST['status']=='create_brand')
{
	$t = connect("SELECT * FROM brand WHERE brand_name = '".$_POST['brand_name']."'");
	if($t->num_rows)
	{
		$_SESSION['error']	= ucwords($_POST['brand_name']).' is already exist..';
	}
	else
	{
		connect("INSERT INTO `brand` (`id`, `timestamp`, `brand_name`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['brand_name']."');");
		$_SESSION['success'] = 'Brand added Successfully';
	}
	header('location:brand.php');
}

if($_POST['status']=='create_item')
{
	$t=connect("SELECT * FROM items WHERE brand_id LIKE '".explode(',',$_POST['brand_id'])[0]."' and item_name LIKE '".$_POST['item_name']."'");
	if($t->num_rows)
	{
		$_SESSION['error'] = ucwords($_POST['item_name']).' is already exist..';
	}
	else
	{
		connect("INSERT INTO `items` (`id`, `timestamp`, `item_name`, `brand_id`, `price`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['item_name']."', '".explode(',',$_POST['brand_id'])[0]."', '".$_POST['price']."');");
		$_SESSION['success']	=	ucwords($_POST['item_name']).' is added Successfully';
	}
	header('location:items.php');
}
if($_GET['status']=='update_item')
{
	$t = connect("UPDATE `items` SET `price` = '".$_GET['price']."' WHERE `items`.`id` = '".$_GET['itemId']."'");
	$_SESSION['success'] = 'Item\'s price Update Successfully';
	header('location:items.php');
}
if($_POST['status']=='view_brand')
{
	$item = connect("SELECT * FROM items WHERE brand_id LIKE '".$_POST['brand_id']."'");
	echo '<div class="box box-';
				if($_POST['brand_id']%2==0)
					          	echo 'primary';
				else
				{
				  	if($_POST['brand_id']%3==0)
					    echo 'success';
					else
					    echo 'danger';
				}
						echo'">
	            <div class="box-header">
	              <h3 class="box-title">'.ucwords($_POST['brand_name']).'</h3>
	            </div>
	            <div class="box-body" style="height:246px;overflow-x:hidden">';
	            if($item->num_rows)
	            {
	            	$x=1;
	            	echo '<table class="table table-hover">
	            			<tr>
	            				<th>#</th>
	            				<th>Item Name</th>
	            				<th>Price</th>
	            				<th>Manage</th>
	            			</tr>
	            	 ';
	            	while($v=$item->fetch_assoc())
	            	{
	            		echo '<tr>
	            				<td>'.$x++.'.</td>
	            				<td>'.ucwords($v['item_name']).'</td>
	            				<td>'.$v['price'].'</td>
	            				<td>
	            				  <button data-toggle="modal" data-target="#item_'.$v['id'].'" class="btn btn-xs btn-flat bg-purple">Edit</button>
	            				  <button class="btn btn-xs btn-flat bg-maroon">Delete</button>
	            				</td>
	            			  </tr>';


	            			  /*
	            		echo ' <div class="modal fade" id="item_'.$v['id'].'" role="dialog">
							    <div class="modal-dialog">
							    
							      <!-- Modal content-->
							      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Edit '.ucwords($_POST['brand_name']).'\'s Item</h4>
							        </div>

							        
							        <div class="modal-body body_product">
								        <input type="hidden" name="item_id" value="'.$v['id'].'">
							        <label style="width:100%;color:red;text-align:center">You can change only price..</label>
							         <div class="form-group">
						                <label >Select Brand:</label>

						                <div class="input-group">
							                <div class="input-group-addon">
							                   <i class="fa fa-check"></i>
							                </div>
							                <select disabled class="form-control" id="brand_id"  name="brand_id" required="">
							                	<option value="0">Select Your Brand</option>';
							               
									                $vu=connect("SELECT * FROM brand");
									                while($s=$vu->fetch_assoc())
									                {
									                	if($_POST['brand_id']==$s['id'])
									                  	echo '<option selected value="'.$s['id'].'">'.ucwords($s['brand_name']).'</option>';
									                  	else
									                  		echo '<option value="'.$s['id'].'">'.ucwords($s['brand_name']).'</option>';
									                }
									                echo'
									                </select>
								        </div>
						              		<label>Enter Item Name:</label>
								              <div class="form-group">
								                <div class="input-group">
								                  <div class="input-group-addon">
								                    <i class="fa fa-product"></i>
								                  </div>
								                  <input type="text" disabled class="form-control" required="" name="item_name" placeholder="Enter Item\'s Name.." id="item_name" value="'.$v['item_name'].'">
								                </div>
								                <!-- /.input group -->
								              </div>
								              <!-- /.form group -->
								              <label>Enter Price:</label>
								              <div class="form-group">
								                <div class="input-group">
								                  <div class="input-group-addon">
								                    <i class="fa fa-rupee"></i>
								                  </div>
								                  <input type="number" class="form-control" required="" name="price" id="price_'.$v['id'].'" placeholder="Enter Price.." value="'.$v['price'].'">
								                </div>
								                <!-- /.input group -->
								              </div>
					              <!-- /.form group -->
					             
							        </div>
							        <div class="modal-footer">
							          <button type="submit" class="btn btn-success" onclick="update_item('.$v['id'].')">Update Item</button>
							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        </div>
							      </div>
							       
							      
							    </div>
							  </div>';
							  */
	            	}
	            	echo '</table>';
	            }
	            else
	            	echo '<p align="center" class="text-red">No Item Available..</p>';
	      echo '</div>
	      </div>';
}
if($_POST['status']=='take_order')
{
	$order_id 	= 	$_POST['order_id'];
	$name 		= 	$_POST['name'];
	$mobile 	= 	$_POST['mobile'];
	$ttl_price 	= 	$_POST['ttl_price'];

	connect("INSERT INTO `customer_details` (`id`, `timestamp`, `order_id`, `name`, `mobile`, `ttl_price`, `admin_id`) VALUES (NULL, CURRENT_TIMESTAMP, '".$order_id."', '".$name."', '".$mobile."', '".$ttl_price."', '".$_SESSION['admin_id']."');");

	foreach ($_POST['list'] as $key) 
	{
		empty($_POST['quantity_'.$key]) ? $qty = 0 : $qty 	= $_POST['quantity_'.$key]; 

		$itemId = $key;
		
		connect("INSERT INTO `sale_items` (`id`, `timestamp`, `order_id`, `item_id`, `qty`) VALUES (NULL, CURRENT_TIMESTAMP, '".$order_id."', '".$itemId."', '".$qty."');");
	}
	
	header('location:view_bill.php?order_id='.$order_id.'');
}
if($_POST['status']=='change_pass')
{
	connect("UPDATE `login` SET `password` = '".$_POST['password']."' WHERE `login`.`id` = '".$_POST['id']."'");
	$_SESSION['success'] = "Your Password Changed Successfully.";
	header('location:profile.php');
}
?>