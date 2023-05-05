<?php
include 'function.php';
top_header();
?>
<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php
			if(isset($_SESSION['success']))
			{
				echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
			}
			unset($_SESSION['success']);

			?>
          <div class="nav-tabs-custom" style="box-shadow:1px 2px 13px 1px gray">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false">Profile</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
                <form class="form-horizontal">
                	<?php 
                	$d = admin_detail()->fetch_assoc();
                	?>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" disabled="" class="form-control" id="inputName" placeholder="Name" value="<?=ucwords($d['username'])?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="password" disabled class="form-control" id="inputEmail" placeholder="password" value="<?=$d['password']?>">
                    </div>
                  </div>
                 
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      
                    </div>
                  </div>
                </form>
               
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" autocomplete="off" method="post" action="connection.php">

                    <input type="hidden" name="id" value="<?=$d['id']?>">
                    <input type="hidden" name="status" value="change_pass">

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" disabled id="inputName" value="<?=ucwords($d['username'])?>" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="text" name="password" maxlength="10" required class="form-control" value="<?=$d['password']?>" id="inputEmail" placeholder="Enter New Password...">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input required id="chk" type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="update_btn" disabled="" class="btn btn-danger">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
	</div>
	
</section>
<script type="text/javascript">
	$('#chk').click(function()
	{
		if(document.getElementById('chk').checked)
			document.getElementById('update_btn').disabled = false;
		else
			document.getElementById('update_btn').disabled = true;
			
	});
</script>

<?php bottom(); ?>