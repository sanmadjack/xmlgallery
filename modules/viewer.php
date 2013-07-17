<br />Image Tags:<br/>
<?php
	include("lib/related_tags.php");
	include("lib/tagging.php");

	if(is_array($_POST['tags'])||is_array($_POST['remove_tags'])) {
		if(FALSE) {
		} else {
			apply_tags($images, $_POST['tags'],$_POST['remove_tags']);
		}
	}
	
	$tags = get_image_tags($_GET['img']);
	if(is_array($tags)) {
		foreach($tags as $tag) {
			print("<a href='?tag1=".$tag[0]."'>".$tag[0]."(".$tag[1].")</a><br />");
		}
	}

	print("<form enctype='multipart/form-data' name='updater' action='' method='post'>\n");

	draw_tag_editor($tags);

	print("<input type='submit' value='Update Tags' />\n");
	print("</form>\n");

	

?>

</div>
<div class="content">
<?php
	
	print("<img src='images/".$_GET['img']."' class='image_viewer' />");

?>
</div>
