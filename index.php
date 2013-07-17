<html>
<head>
<script>
	function error(message) {
		document.getElementById("output").innerHTML += "<div class='error'>" + message + "</div>";
	}
	function success(message) {
		document.getElementById("output").innerHTML += "<div class='success'>" + message + "</div>";
	}
	function clear_spaces(clear_me) {
		clear_me.replace(/ /g,"_");
		return clear_me;
	}


</script>
<title>
<?php
	include("config.php");
	$sql_connection = mysql_connect($sql_server,$sql_user,$sql_password);
	if(!$sql_connection) {
		print("Woah, dude. Couldn't connect to the MySQL server.");
	} else {
		mysql_select_db($sql_database,$sql_connection);
	}
	
	print("$site_name</title>\n");
	print("<link href='themes/$current_theme/$current_theme.css' rel='stylesheet' type='text/css' />\n");
?>
</title>

</head>
<body>
<div id="output"></div>
<div class="menu">
<a href="?">Browse</a><br />
<a href="?module=upload">UploadTest</a><br />

<?php

?>

<?php
	if($_GET['img']) {
		include("modules/viewer.php");
	} else if($_GET['module'] == "upload") {
		include("modules/upload.php");
	} else {
		include("modules/browse.php");
	}
	mysql_close($sql_connection);
?>
</body>
</html>
