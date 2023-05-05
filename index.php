<?php
include 'function.php';
top_header();
?>
<style type="text/css">#home{background:rgb(0,0,0,.3)</style>
 <section class="content-header">
        <h1>
          Take Order
          <small>D.S.D. Restaurant</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Take Order</li>
        </ol>
      </section>

      <!-- Main content -->
      <form action="connection.php" autocomplete="off" method="post" id="take_order">
      	<input type="hidden" name="order_id" value="<?=time()?>">
      	<input type="hidden" id="ttl_price" name="ttl_price" value="0">
      <section class="content" style="margin:0;padding:0;" >
       <div class="row" style="margin-left:-80px">
       	<div style="width:70%;">
       	<?php
       	$b = connect("SELECT * FROM brand");
	    if($b->num_rows)
	    { 
	        while($res=$b->fetch_assoc())
	    	{
	    		echo '<div class="col-md-4">
				          <div class="box box-';
				          if($res['id']%2==0)
					          	echo 'primary';
					          else
					          {
					          	if($res['id']%3==0)
					          		echo 'success';
					          	else
					          		echo 'danger';
					          }
				          echo'">
				            <div class="box-header with-border">
				              <h3 class="box-title">'.ucwords($res['brand_name']).'</h3>

				              <div class="box-tools pull-right">
				                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				                </button>
				                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				              </div>
				            </div>
				            <div class="box-body">
					             <table class="table table-hover">
					              <tr><th>ID</th><th>ITEM</th><th>PRICE</th><th><i class="fa fa-check"></i></th></tr>
					             </table>
				              	<div class="direct-chat-messages" style="height:400px;padding:0">
					           		';
				           $item = connect("SELECT * FROM items WHERE brand_id LIKE '".$res['id']."'");
				            if($item->num_rows)
				            {
				            	$x=1;
				            	echo '<table class="table table-hover">
				            			
				            	 ';
				            	while($v=$item->fetch_assoc())
				            	{
				            		echo '<tr>
				            				<td>'.$x++.'.</td>
				            				<td>'.ucwords($v['item_name']).'</td>
				            				<td>'.$v['price'].'<i class="pull-right fa fa-rupee"></i></td>
				            				<td>
				            				<input type="hidden" id="price_'.$v['id'].'" value="'.$v['price'].'">
				            				 <input style="cursor:pointer" class="checkbox" type="checkbox" name="list[]" id="check_'.$v['id'].'" value="'.$v['id'].'">
				            				</td>
				            			  </tr>';
						            }
						           echo'</tbody></table>';
						 	}
						 	else
						 		echo '<p align="center" class="text-red">No Item Available..</p>';

				           	echo'</div>

					            <div class="box-footer">
					             
					            </div>
				          	</div>
				          </div>
				       </div>';
	    	}
	    }
       	?>
       	<div class="col-md-4 pull-right navbar-fixed-bottom" id="bill_box" style="margin-top:-50px;margin-left:900px;display:none;">
       		<div class="box box-warning">
       			 <div class="box-header with-border">
				              <h3 class="box-title text-white">Create Bill</h3>

				    <div class="box-tools pull-right">
				        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				        </button>
				    </div>
				</div>

			    
			    	<input type="hidden" name="status" value="take_order">
				<div class="box-body" style="height: 450px;overflow-x: hidden;">
					<table class="table table-hover">
						<tr>
							<th>Item Name</th>
							<th>Price</th>
							<th>QTY</th>
							<th>Total</th>
						</tr>
						<?php
						$t = connect("SELECT * FROM items");
						while($r=$t->fetch_assoc())
						{
							echo '
								<tr id="view_item_'.$r['id'].'" style="display:none;">
									<td>'.ucwords($r['item_name']).'</td>
									<td>'.$r['price'].'<label class="pull-right">*</label></td>
									<td><input type="number" id="quantity_'.$r['id'].'" onkeyup="cal(this,'.$r['id'].')" name="quantity_'.$r['id'].'" style="width:35px;border:none;border-bottom:1px groove red;outline:none" placeholder="QTY" value="1"></td>
									<td id="ttl_price_'.$r['id'].'" class="price">'.$r['price'].'</td>
								</tr>';
						}
						?>
					</table>
				</div>
				<div class="box-footer">
					<div class="row">
	                <div class="col-sm-4 border-right">
	                  <div class="description-block">
	                    <h5 class="description-header" id="ttl_product"></h5>
	                    <span class="description-text">Total Items</span>
	                  </div>
	                  <!-- /.description-block -->
	                </div>
	                <!-- /.col -->
	                <div class="col-sm-4 border-right">
	                  <div class="description-block">
	                    <h5 class="description-header"></h5>
	                    <span class="description-text"></span>
	                  </div>
	                  <!-- /.description-block -->
	                </div>
	                <!-- /.col -->
	                <div class="col-sm-4">
	                  <div class="description-block">
	                    <h5 class="description-header" id="ttl"></i></h5>
	                    <span class="description-text">Total Price</span>
	                  </div>
	                  <!-- /.description-block -->
	                </div>
	                <!-- /.col -->
	              </div>
				<div class="row">
	                <div class="col-lg-4">
	                  <div class="input-group">
	                    <input type="text" autocomplete="off" name="name" class="form-control" placeholder="Enter Name.">
	                  </div>
	                  <!-- /input-group -->
	                </div>
	                <!-- /.col-lg-6 -->
	                <div class="col-lg-5">
	                  <div class="input-group">
	                    <input type="text" autocomplete="off" name="mobile" class="form-control" placeholder="Enter Mobile Number.">
	                  </div>
	                  <!-- /input-group -->
	                </div>
	                <div class="col-lg-2">
	                	<div class="input-group">                		
		    				<button type="button" class="btn bg-maroon" disabled id="bill_print">
		    					Print Bill
		    				</button>
	                	</div>
	                </div>
	                <!-- /.col-lg-6 -->
	            </div>
				</div>
				</form>
       		</div>	
       	</div>
       </div>
   	  </div>
      
      </section>

<?=bottom()?>