<html>
<head>
<?php
/*
 * dr=directory name: which directory we want to traverse
 */
$dr = isset($_GET['dr']) ? $_GET['dr'] : "";
?>
<title><?php echo $dr?></title>
<style> <?php include "../docs.css"; ?> </style>
</head>
<META http-equiv="Content-Type" content="text/html; charset=iso 8859-1">

<body>
<?php

function print_subdirs ($dir)
{
	$files = scandir($dir);

	foreach ($files as $file) {
		if (!strcmp($file, ".") || !strcmp($file, ".."))
			continue;

		if (is_dir($dir . '/' . $file)) {
			echo '<tr>';
			$link = '<a href="links.php?dr=';
			/* Strip the web server path from $dir */
			$rel_dir = substr_replace($dir, '', 0, strlen($GLOBALS["TOPDIR"]) + 5);
			$drn = $rel_dir . '/' . $file;
			$link = $link . $drn;
			$link = $link . '">' . $file . '</a>';

			echo '<td><p>' . $link . '</p></td>';
			echo '</tr>';
		}

	}
}

function main ()
{
	$db = new SQLite3($GLOBALS["TOPDIR"] . 'db/docs.db');

	$curdir = $GLOBALS["TOPDIR"] . 'docs/' . $GLOBALS["dr"];

	/* First list the subdirectories */
	echo '<hr><table id="subdirs" class="gradienttable"><thead>';
	echo '<th>Subdirectories</th></thead><tbody>';
	print_subdirs($curdir);
	echo '</tbody></table>';

	echo '<hr><table id="links" class="gradienttable"><thead>';
	echo '<th>Filename</th><th>Link</th><th>Description</th>
		<th>Date</th></thead><tbody>';
	$results = $db->query("select * from documents where dir=\"$curdir\"");

	while ($row = $results->fetchArray(SQLITE3_NUM)) {
		echo ('<tr>');
		echo '<td><p>', $row[3], '</p></td>';
		echo '<td><p>', $row[0], '</p></td>';
		echo '<td><p>', $row[4], '</p></td>';
		echo '<td><p>', $row[5], '</p></td>';
		echo ('</tr>');
	}
	echo '</tbody></table>';
	$db->close();
}

$TOPDIR = dirname(dirname(__FILE__)) . '/';
$TOPDIR = str_replace('\\', '/', $TOPDIR);
main();
?>
</body></html>
