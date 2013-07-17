<script>
	
</script>
<?php
	if($_FILES['upload_me']&&$sql_connection) {
		$current_hash = md5_file($_FILES['upload_me']['tmp_name']);
		echo $current_hash;
		if(move_uploaded_file($_FILES['upload_me']['tmp_name'], $home_path."/images/".$current_hash)) {
	
			if(mysql_query("INSERT INTO `images` (`hash` ,`user_id`,`added`)VALUES ('$current_hash' , '00000000000000000001', NOW())")){
				for($i=1;$i<=$_POST['tag_count'];$i++) {
					mysql_query("INSERT INTO `tags` (`hash`,`tag`)VALUES('$current_hash','".$_POST["tag_text_".$i]."')");
				}
				print($_FILES['upload_me']['name']."<br/>");

				print($current_hash."<br/>");
			} else {
				print "Error, man. Probably a duplicate image file.";
			}
		} else{
			echo "Couldn't move the uploaded file. What's up with that?";
		}
	}
	// ;
?>
</div>
<div class="content">
<form enctype="multipart/form-data" name="uploader" action="" method="post">
<input type="file" name="upload_me" />
<?php include("$home_path/lib/tagging.php"); ?>

<input type="submit" />
</form>
</div>