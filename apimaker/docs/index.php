<?php
if( $_POST['action'] =="save" ){

	if( $_POST['vid'] != md5($_POST['file']."xx") ){
		echo "ERROR: Incorrect key";exit;
	}

	file_put_contents($_POST['file'], $_POST['body']);
	chmod($_POST['file'], 0777);
	echo "File Saved Successfully";
	exit;
}
if( $_POST['action'] == "createfile" ){

	if( preg_match("/[a-z][a-z0-9\.\-\_]{3,50}\.html$/", $_POST['file']) ){
		file_put_contents( $_POST['file'], "New file ...");
		chmod($_POST['file'], 0777);
		echo "File Created Successfully";
	}else{
		echo "Error\n\nFilename incorrect\nNo special chars, spaces allowed\nshould end with .html\nlower case";
	}

	exit;
}
if( $_GET['file'] ){
	if( preg_match("/[a-z][a-z0-9\.\-\_]{3,50}\.html$/", $_GET['file']) ){
		if( file_exists($_GET['file'] ) ){

		}else{
			echo "File not found";exit;
		}
	}else{
		echo "Incorrect file name";exit;
	}
}
if( $_GET['file'] ){
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://cdn.tiny.cloud/1/qebaanae2h0zl1r8e43qbkos7w8eepcd5xnakknfpfqv664a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

	<div contenteditable style="height:500px; resize:both;padding:10px; border:1px solid black; margin:10px; overflow: auto;" id="html"><?=file_get_contents($_GET['file']) ?></div>
	<div><input type="button" value="SAVE" onclick="saveit()" > &nbsp;&nbsp; <input type="button" value="HTML to Text" onclick="html_to_text()" >  &nbsp;&nbsp; <input type="button" value="Text to Html" onclick="text_to_html()" ></div>
	<textarea style="width:100%; height:500px; resize:both; white-space: nowrap;" id="output"></textarea>
	<script>
		function text_to_html(){
			document.getElementById("html").innerHTML = document.getElementById("output").value;
		}
		function html_to_text(){
			var content = document.getElementById("html").innerHTML;
			content = content.replace(/\<[a-z0-9]+/g, function(v){
				//console.log( v );
				return "\n" + v;
			});
			content = content.replace(/\<\/[a-z0-9]+\>/g, function(v){
				//console.log( v );
				return v + "\n";
			});
			content = content.replace(/font\-[a-z\-]+\:\ \;/g, function(v){
				return "";
			});
			content = content.replace(/overflow\-x\: auto\;/g, "");
			content = content.replace(/line\-height\: [a-z0-9\.]+\;/g, "");
			content = content.replace(/style\=\"[\ \t\r\n]+\"/g, "");
			content = content.replace(/[\r\n\t]+/g, "\n");
			//content = content.replace(/width\: [0-9]+[a-z]+\;/g, "");

			document.getElementById("output").value = content;
		}
		function saveit(){
			html_to_text();
			var content = document.getElementById("output").value;
			var vp = new FormData();
			vp.append( "action", "save");
			vp.append( "file", "<?=$_GET['file'] ?>");
			vp.append( "vid", "<?=md5($_GET['file']."xx") ?>");
			vp.append( "body", content);
			con = new XMLHttpRequest();
			con.open( "POST", "?", true);
			con.onload = function(){
				alert(this.responseText);
			}
			con.send( vp );
		}

	</script>
</body>
</html>
<?php }else{ ?>
<html>
<head>
	<title>Files</title>
</head>
<body>
	<div>
		<input type="text" id="newfile" placeholder="newfilename.html" >
		<input type="button" value="Create File" onclick="create_file()" >
	</div>
	<script>
		function create_file(){
			fn = document.getElementById("newfile").value;
			con = new XMLHttpRequest();
			con.open("POST","?",true);
			con.onload = function(){
				alert(this.responseText);
				if( this.responseText == "File Created Successfully"){
					document.location.reload();
				}
			}
			var vp = new FormData();
			vp.append("action", "createfile");
			vp.append("file", fn);
			con.send(vp);
		}
	</script>
	<?php
	$fp = dir("./");
	while( $fn = $fp->read() ){if( preg_match("/\.html$/", $fn ) ){
		echo "<div><a href='?file=".urlencode($fn)."' >" . $fn . "</a></div>";
	}}
	?>

</body>
</html>

<?php } ?>