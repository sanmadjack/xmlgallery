<?php
	function get_related_images($tags) {
		if(is_array($tags)) {
		$image_list;
		$iteration = 1;
		$new_query;
		foreach($tags as $tag) {
			if($iteration==1) {
				$new_query = "SELECT DISTINCT t1.hash AS hash FROM tags AS t1 WHERE tag = '$tag'";
			} else {
				$new_query = "SELECT DISTINCT t1.hash FROM (".$new_query.") AS t1 JOIN tags AS t2 ON t1.hash = t2.hash WHERE t2.tag = '$tag'";
			}
			$iteration++;
		}
			$items = mysql_query($new_query);
			for($i=0;$row = mysql_fetch_array($items);$i++) {
				$image_list[$i] = $row['hash'];
			}
		}

		
		return $image_list;
	}
?>