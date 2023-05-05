<?php
include 'function.php';
top_header();
?>
<style type="text/css">.drop_down{background:rgb(0,0,0,.3);}</style>
<script type="text/javascript">document.title = 'Create Items | DSD Restaurant';document.getElementById('items').className = 'active';</script>

	<section class="content-header" style="margin:0">
        <h1>
          Create Item
          <small>D.S.D. Restaurant</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Properties</a></li>
          <li class="active">Create Item</li>
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
    		<div class="col-md-6">

	          <div class="box box-danger">
	            <div class="box-header">
	              <h3 class="box-title">Create Item</h3>
	            </div>
	            <form action="connection.php" method="post" autocomplete="off">
	            	<input type="hidden" name="status" value="create_item">
	            <div class="box-body">
	              <div class="form-group">
	                <label>Select Brand:</label>

	                <div class="input-group">
		                <div class="input-group-addon">
		                   <i class="fa fa-check"></i>
		                </div>
		                <select class="form-control" onchange="view_brand(this.value)" name="brand_id" required="">
		                	<option value="">Select Your Brand</option>
		                <?php
		                $vu=connect("SELECT * FROM brand");
		                while($v=$vu->fetch_assoc()) 
		                {
		                  	echo '<option value="'.$v['id'].','.$v['brand_name'].'">'.ucwords($v['brand_name']).'</option>';
		                }
		                ?>
		                </select>
	                </div>

	              </div>

	              <div class="form-group">
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-product"></i>
	                  </div>
	                  <input type="text" class="form-control" required="" name="item_name" placeholder="Enter Item's Name..">
	                </div>
	                <!-- /.input group -->
	              </div>
	              <!-- /.form group -->

	              <div class="form-group">
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-rupee"></i>
	                  </div>
	                  <input type="number" class="form-control" required="" name="price" placeholder="Enter Price..">
	                </div>
	                <!-- /.input group -->
	              </div>
	              <!-- /.form group -->

	            </div>
	            <!-- /.box-body -->
	            <div class="box-footer">
	            	<button class="btn btn-success">Create Item</button>
	            </div>
	          </form>
	          </div>
          <!-- /.box -->
          </div>
          <!-- /.box -->
          <div class="col-md-6" id="result">
          </div>

        </div>
    </section>
    <!-- /..Main content -->
    <section class="content-header" style="margin:0">
        <h1>
        	<?php
        	
        	?>
          View Item
          <small>D.S.D. Restaurant</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Properties</a></li>
          <li class="active">View Item</li>
        </ol>
    </section>
     <!-- Main content -->
    <section class="content">
    	<div class="row">
    		<?php
    		$b = connect("SELECT * FROM brand");
	    	if($b->num_rows)
	    	{ 
	    		while($res=$b->fetch_assoc())
	    		{
   $item = connect("SELECT * FROM items WHERE brand_id LIKE '".$res['id']."'");
	echo '<div class="col-sm-4">
		<div class="box box-';
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
	              <h3 class="box-title">'.ucwords($res['brand_name']).'</h3>
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
	            				  <button data-toggle="modal" data-target="#item_'.$v['id'].'" class="btn btn-xs btn-flat bg-purple"><i class="fa fa-edit"></i></button>
	            				  <button class="btn btn-xs btn-flat bg-maroon"><i class="fa fa-trash"></i></button>
	            				</td>
	            			  </tr>';
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
	            	}
	            	echo '</table>';
	            }
	            else
	            	echo '<p align="center" class="text-red">No Item Available..</p>';
	      echo '</div>
	      </div></div>';

		}
}
    		?>
    	</div>
    </section>

 

<?=bottom()?>