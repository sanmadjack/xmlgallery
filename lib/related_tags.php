<?php
	function get_top_tags() {
		$tags = mysql_query("SELECT tag, COUNT(tag) AS TagCount FROM tags GROUP BY tag ORDER BY TagCount DESC;");
		$tag_list;
		for($i=0;$row = mysql_fetch_array($tags);$i++) {
			$tag_list[$i][0] = $row['tag'];
			$tag_list[$i][1] = $row['TagCount'];
			
		}
		return $tag_list;
	}
	
	function get_image_tags($image) {
		$tag_list;
//		$tags = mysql_query("SELECT tag FROM tags WHERE hash = '$image' ORDER BY tag;");
//		for($i=0;$row = mysql_fetch_array($tags);$i++) {
//			$count = mysql_query("SELECT COUNT(hash) AS TagCount FROM tags WHERE tag = '".$row['tag']."';");
//			while($rows = mysql_fetch_array($count)) {
//				$tag_list[$i][0] = $row['tag'];
//				$tag_list[$i][1] = $rows['TagCount'];
//			}
//		}
		$tags = mysql_query("SELECT t1.tag AS tag, COUNT(t2.hash) AS TagCount FROM (SELECT tag FROM tags WHERE hash = '$image') AS t1 JOIN tags AS t2 ON t1.tag = t2.tag GROUP BY tag ORDER BY TagCount DESC, tag");
		for($i=0;$row = mysql_fetch_array($tags);$i++) {
			$tag_list[$i][0] = $row['tag'];
			$tag_list[$i][1] = $row['TagCount'];
		}
		
		return $tag_list;
	}
	
	function list_related_tags($tags) {
		$tag_list;
		$tag_list = get_related_tags($tags);
		if(is_array($tag_list)) {
		foreach($tag_list as $tag) {
			print("<a href='?");
			if(is_array($tags)) {
				$i = 1;
				foreach($tags as $existing_tag) {
					print("tag".$i."=".$existing_tag."&");
					$i++;
				}
				print("tag".$i."=");
			} else {
				print("tag1=$tags&tag2=");
			}
			print($tag[0]."'>+</a> <a href='?tag1=$tag[0]'>".$tag[0]."(".$tag[1].")</a><br />");
		}
		} else {
			print("No related tags");
		}
	}
	
	
	function get_related_tags($tags) {
		if(is_array($tags)) {
			$new_query;
			$iteration = 1;
			foreach($tags as $tag) {
				if($iteration==1) {
					$new_query = "SELECT hash FROM tags WHERE tag = '$tag'";
				} else {
					$new_query = "SELECT t1.hash AS hash FROM (".$new_query.") AS t1 JOIN tags AS t2 ON t1.hash = t2.hash WHERE tag = '$tag'";
				}
				$iteration++;
			}
			$new_query = "SELECT t2.tag, COUNT(t2.tag) AS TagCount FROM (".$new_query.") AS t1 JOIN tags AS t2 ON t1.hash = t2.hash WHERE ";
			$iteration = 1;
			foreach($tags as $tag) {
				if($iteration==1) {
					$new_query .= "tag <> '$tag'";
				} else {
					$new_query .= " AND tag <> '$tag'";
				}
				$iteration++;
			}
			$new_query .= " GROUP BY t2.tag ORDER BY TagCount DESC";
			
			$tags = mysql_query($new_query);

			
		} else {
			$tag = $tags;
			$tags = mysql_query("SELECT t1.tag, COUNT(t1.tag) AS TagCount FROM tags AS t1 JOIN tags AS t2 ON t1.hash = t2.hash WHERE (t2.tag = '$tag'  AND t1.tag <> '$tag') GROUP BY t1.tag ORDER By TagCount DESC");
		}
		$tag_list;
		$i = 0;
		while($row = mysql_fetch_array($tags)) {
			$tag_list[$i][0] = $row['tag'];
			$tag_list[$i][1] = $row['TagCount'];
			$i++;
		}
		return $tag_list;
	}
?>
