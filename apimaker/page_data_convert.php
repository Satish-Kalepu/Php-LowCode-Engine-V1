
<form method="post" >
<select name="key" >
<?php foreach( $config_bre_encrypt_keys as $i=>$j ){ ?> 
 <option value="<?=$i ?>" ><?=$i ?></option>
<?php } ?>
</select>
<input type="text" name="text" placeholder="Text to encrypt">
<input type="submit"  value="Encrypt">
<input type="hidden" name="action" value="Encrypt">
</form>

<?php if( $_POST['action'] == "Encrypt" ){

	echo "<p>Encrypted Text: " . $_POST['key'] . ":" . openssl_encrypt( $_POST['text'], "aes-128-cbc", $config_bre_encrypt_keys[ $_POST['key'] ]['password'] ) . "</p>";

} ?>