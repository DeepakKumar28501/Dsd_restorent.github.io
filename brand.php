<?php
include 'function.php';
top_header();
?>
<style type="text/css">.drop_down{background:rgb(0,0,0,.3);}</style>
<script type="text/javascript">document.title = 'Create Brand | DSD Restaurant';document.getElementById('brand').className = 'active';</script>
	<section class="content-header">
        <h1>
          Create Brand
          <small>D.S.D. Restaurant</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Properties</a></li>
          <li class="active">Create Brand</li>
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
	    	<form action="connection.php" method="post" autocomplete="off">
	    		<input type="hidden" name="status" value="create_brand">
		    	<div class="input-group input-group-sm">
			        <input type="text" required="" name="brand_name" class="form-control" placeholder="Enter Brand Name......." autofocus="">
			        <span class="input-group-btn">
			           <button type="submit" class="btn btn-info btn-flat">Save Brand!</button>
			        </span>
		        </div>
		    </form>
		</div><br>
	    <div class="row">
	    	<?php
	    	$b = view_brand();
	    	if($b->num_rows)
	    	{ 
	    		while($res=$b->fetch_assoc())
	    		{ 
	    			echo '<div class="col-lg-3 col-xs-6">
					          <div class="small-box ';
					          if($res['id']%2==0)
					          	echo 'bg-aqua';
					          else
					          {
					          	if($res['id']%3==0)
					          		echo 'bg-green'; 
					          	else
					          		echo 'bg-red';
					          }
					          echo'">
					            <div class="inner">
					              <h3 style="text-shadow:1px 3px 3px black" title="Items">'.get_items_by_brand($res['id'])->num_rows.' 
					               <small style="color:white;text-shadow:1px 3px 3px black;font-size:18px">Items</small>
					              </h3>

					              <strong style="font-size:19px;text-shadow:1px 3px 3px black">'.ucwords($res['brand_name']).'</strong>
					            </div>
					            <div class="icon">
					              <i class="ion ion-bag"></i>
					            </div>
					            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>';

	    		}
	    	}
	    	else
	    	{
	    	?>
	    	<div class="alert alert-danger">No Brand Available..</div>
	    	<?php
	    	}
	    	?>
	    </div>
    </section>

<?=bottom()?>
