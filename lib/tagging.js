	var tag_count = 0;
	
	function blank_tag_check(tag_input) {
		if(tag_input.value!='') {
		 	
		} else {
		   add_blank_tag();
		}
	}

	function add_tag(tag_to_add) {
		 if(tag_to_add!='') {
			tag_count++;
			document.getElementById('selected_tags').innerHTML += "<input type='checkbox' checked />";
			document.getElementById('selected_tags').innerHTML += "<input type='text' class='tag' name='tags[]' value='" + tag_to_add.replace(/ /g,'_') + "' /><br />\n";
			document.getElementById('tag_entry').value = "";
			document.getElementById('tag_entry').focus();
		}
		
	}

