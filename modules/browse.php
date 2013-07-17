<?php
	include("lib/related_images.php");
	include("lib/related_tags.php");
	include("lib/tagging.php");
	
	if(is_array($_POST["tag_text"])) {
		foreach($_POST["tag_text"] as $tag) {
			echo $tag;
		}
	}
	
	if($_GET['offset']) {
		$offset = $_GET['offset'];
	} else {
		$offset = 0;
	}

	$max_items = 10;
	if($_GET['tag1']) {
		$tags;
		$images;
		for($i=1;$_GET["tag".$i];$i++) {
			$tags[$i-1] = $_GET["tag".$i];
		}
		$images = get_related_images($tags);

		if(is_array($_POST['tags'])||is_array($_POST['remove_tags'])) {
			if(FALSE) {
			} else {
				apply_tags($images, $_POST['tags'],$_POST['remove_tags']);
			}

			$tags = $_POST['tags'];
			$images = get_related_images($tags);
		}

		print("<br/>Selected Tags:<br/>");
		foreach($tags as $tag) {
			print($tag."<a href='?");
			$i=1;
			foreach($tags as $tagged) {
				if($tag!=$tagged) {
					print("tag".$i."=".$tagged."&");
					$i++;
				}
			}
			print("' alt='Remove ".$tag." from filter'>-</a><br/>");
		}
		print("<br/>Related tags:<br />\n");
		list_related_tags($tags);
		print("<br/>Update Tags:<br/>\n");
		print("<form enctype='multipart/form-data' name='tagger' action='?");
		$i = 1;
		foreach($tags as $tag) {
			print("tag".$i."=".$tag."&");
		}
		print("' method='post'>\n");
		print("<input type='checkbox' name='update_all_images' onchange='if(this.checked){}else{}' checked/>Update all images<br/>");
		draw_tag_editor($tags);
		print("<input type='submit' value='Update Tags' />\n");


		print("</form>\n");

	} else {
		print("<br/>Top tags:<br/>");
		$top_tags = get_top_tags();
		if(is_array($top_tags)) {
		foreach($top_tags as $tag) {
			print("<a href='?tag1=".$tag[0]."'>".$tag[0]."(".$tag[1].")</a><br />");
		}
		}
		$items = mysql_query("SELECT `hash` FROM `images` ORDER BY `added` DESC LIMIT 0, $max_items");
		for($i=0;$row = mysql_fetch_array($items);$i++) {
			$images[$i] = $row['hash'];
		}
		print("<form enctype='multipart/form-data' name='tagger' action='' method='post'>\n");
		draw_tag_editor($tags);
		print("<input type='submit' value='Update Tags' />\n");


		print("</form>\n");

	}



	print("</div>\n");

	print("<div class='content'>\n");
	if(is_array($images)) {
	foreach($images as $image) {
		print("<div class='thumbnail' style='float:left;height:".$thumbnail_size."px;width:".$thumbnail_size."px;position:relative;'>\n");
		print("<a href='?img=".$image."' style='opacity:1;'><img id='img_".$image."' src='lib/thumbnail.php?img=".$image."' style=''/></a>");
		print("<input type='checkbox' class='image_selector' onchange='if(this.checked){this.previousSibling.style.opacity=1;}else{this.previousSibling.style.opacity=0.25;}' checked />\n");
		print("</div>\n");
	}
	} else {
		print("No Images meeting criteria");
	}
	print("<div class='page_select'>\n");
	print("Previous <a href='".$_SERVER["REQUEST_URI"]."offset=$max_items'>2</a> Nexxt");
	print("</div>\n");
	print("</div>\n");
?>
