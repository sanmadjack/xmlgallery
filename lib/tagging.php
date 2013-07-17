<?php
	function apply_tags($hashes, $tags_to_add, $tags_to_delete) {
		if(is_array($hashes)) {
			foreach($hashes as $hash) {
				if(is_array($tags_to_delete)) {
					foreach($tags_to_delete as $tag) {
						mysql_query("DELETE FROM tags WHERE hash = '".$hash."' AND tag = '".$tag."'");
					}
				}
				if(is_array($tags_to_add)) {
					foreach($tags_to_add as $tag) {
						if($tag) {
							mysql_query("INSERT INTO tags (hash,tag) VALUES('".$hash."','".$tag."')");
						}
					}
				}
			}
		} else {
		}
	}
	
	
	
	function draw_tag_editor($existing_tags) {
		print("<script src='lib/tagging.js'></script>\n");
		print("<div id='selected_tags'>\n");
		print("<div id='existing_tags'>\n");
		if(is_array($existing_tags)) {
			$i=1;
			foreach($existing_tags as $tag) {
				if(is_array($tag)) {
					print("<input type='checkbox' checked onchange='if(!this.checked){document.getElementById(\"tag_text_".$i."\").name = \"remove_tags[]\";}else{document.getElementById(\"tag_text_".$i."\").name = \"tags[]\";}'/>");
					print("<input type='hidden' class='tag' name='tags[]' value='$tag[0]' id='tag_text_".$i."' />$tag[0]<br/>\n");
				} else {
					print("<input type='checkbox' checked onchange='if(!this.checked){document.getElementById(\"tag_text_".$i."\").name = \"remove_tags[]\";}else{document.getElementById(\"tag_text_".$i."\").name = \"tags[]\";}'/>");
					print("<input type='hidden' class='tag' name='tags[]' value='$tag' id='tag_text_".$i."' />$tag<br/>\n");
				}
				$i++;
			}
		}
		print("</div>\n");
		print("</div>\n");
		print("<div id='suggested_tags'>\n");
		print("</div>\n");
		print("<input type='checkbox' disabled />");
		print("<input type='text' class='tag' id='tag_entry' onblur='add_tag(this.value)' /><br/>\n");

	}
?>
