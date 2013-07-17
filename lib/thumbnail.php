<?php
	include("../config.php");
	header("Content-type: image/jpeg");
	if(file_exists($home_path."/thumbs/".$_GET['img'])) {
		include($home_path."/thumbs/".$_GET['img']);
//		$thumb = imagecreatefromjpeg($home_path."/thumbs/".$_GET['img']);
//		imagejpeg($thumb);
	} else {
		$image_data = getimagesize($home_path."/images/".$_GET['img']);
		if($image_data[mime]=="image/jpeg") {
			$temp = imagecreatefromjpeg($home_path."/images/".$_GET['img']);
		} else if($image_data[mime]=="image/png") {
			$temp = imagecreatefrompng($home_path."/images/".$_GET['img']);
		} else {
		}
		if($temp) {
			if($image_data[0]>$image_data[1]) {
				$new_height = $thumbnail_size*($image_data[1]/$image_data[0]);
				$new_width = $thumbnail_size;
			} else if($image_data[0]<$image_data[1]) {
				$new_height = $thumbnail_size;
				$new_width = $thumbnail_size*($image_data[0]/$image_data[1]);
			} else {
				$new_height = $thumbnail_size;
				$new_width = $thumbnail_size;
			}
			$thumb = imagecreatetruecolor($new_width,$new_height);
			imagecopyresampled($thumb,$temp,0,0,0,0,$new_width,$new_height,$image_data[0],$image_data[1]);
			if(imagejpeg($thumb,$home_path."/thumbs/".$_GET['img'],$thumbnail_quality)) {
				imagejpeg($thumb);
			}
		}
	}
	
	
	?>