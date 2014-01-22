<html>
<head>
	<title>Details</title>
	<link rel="stylesheet" type="text/css" href="docs.css">
</head>
<META http-equiv="Content-Type" content="text/html; charset=iso 8859-1">
<body>
<?php
	$file = rawurldecode($_GET["file"]);
	$data = array();
	exec ("exiftool.exe -h \"$file\"", $data);
	echo "<p>";
	foreach($data as $line) {
		echo "$line";
	}
	echo "</p>";
?>
