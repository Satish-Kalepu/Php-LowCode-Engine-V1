<div style="background-color:white; padding:5px; height: 40px; border-bottom:1px solid #999;" >
	<?php if( $_SESSION['apimaker_login_ok'] ){ ?>
	<div style="float:right; padding:0px 10px;" >
		<a href="<?=$config_global_apimaker_path ?>settings" class="btn btn-outline-dark btn-sm" >Settings</a>&nbsp;
		&nbsp;<a href="?action=logout" class="btn btn-outline-dark btn-sm" >Logout</a>
	</div>
	<?php } ?>
	<div class="text-dark" style="font-weight:500; padding-left:10px;"><?=$config_global_apimaker['config_app_name'] ?></div>
</div>