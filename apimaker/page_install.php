<div class="container" >
	<h2>Setup System</h2>
	<p>Last setup date: <?=$config_settings['last_setup_date']?$config_settings['last_setup_date']:"Undefined" ?></p>

	<?php if( $issettting && $collections_cnt ){ ?>
		<table class="table table-bordered table-sm w-auto" >
			<tr>
				<td>Setting</td>
				<td>Value</td>
			</tr>
			<?php foreach( $config_settings as $f=>$v ){ ?>
			<tr>
				<td><?=htmlspecialchars($f) ?></td>
				<td><?=is_string($v)?htmlspecialchars($v):print_r($v) ?></td>
			</tr>
			<?php } ?>
		</table>
		<p><a href="?action=initialize" >Click here to Re-Initialize and Reset</a></p>
	<?php }else if( $collections_cnt ){ ?>
		<p>Settings Error</p>
		<p>The apimaker table prefix has a conflict</p>
		<p><a href="?action=initialize" >Click here to Re-Initialize</a></p>
		<p>Caution! All the settings will be deleted. Data may be lost!</p>
		<p>Recommened to solve manually!</p>
	<?php }else if( $other_prefix_found ){ ?>
		<p>Settings Error</p>
		<p>The apimaker was already initialized with different prefix!</p>
		<p>Take DB Snapshot and Contact Support</p>
	<?php }else{ ?>
		<p>Initialize Settings</p>
		<p><a href="?action=initialize" >Click here to Initialize</a></p>
	<?php } ?>

</div>