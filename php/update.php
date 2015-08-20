<style> <?php include "../docs.css"; ?> </style>
<?php

function update_db ($path, $db )
{
	$sha1 = sha1_file($path);

	if (empty($db->querySingle("select checksum from documents where checksum=\"$sha1\""))) {
		/* Figure out the relative link to the file */
		$link = substr_replace($path, '/', 0, strlen($GLOBALS["TOPDIR"]));
		$link = '<a href="' . $link . '">[pdf]</a><br>';

		/* split file name and directory from path */
		$fn = basename($path);
		$dir = dirname($path);

		/*
		 * Run exiftool to get the description and the date from
		 * metadata
		 */
		$cmd = '"' . $GLOBALS["TOPDIR"] . 'tools/exiftool.exe"' . " -m -f -CreateDate -Title -n -e -php \"$path\"";
		eval('$filedata = ' . `$cmd`);

		$date = 0;
		$desc = 0;
		foreach ($filedata as $i => $filex) {
			$desc = $filex["Title"];
			$desc = str_replace("'", "", $desc);
			$date = $filex["CreateDate"];
		}

		$ret = $db->exec("insert into documents values ('$link', '$path', '$dir', '$fn',
				'$desc', '$date', '$sha1')");
		if (!$ret)
			print "<p> XXX $desc $date $path </p>";
		return 1;
	}
	return 0;
}

function update ($dir, $db)
{
	$updated = 0;
	$files = scandir($dir);

	foreach ($files as $file) {
		if (!strcmp($file, ".") || !strcmp($file, ".."))
			continue;

		if (is_dir($dir . '/' . $file)) {
			$updated += update($dir . '/' . $file, $db);
		} else {
			if (substr($file, -3) === "pdf")
				$updated += update_db($dir . '/' . $file, $db);
		}

	}
	return $updated;
}

function main ()
{
	$db = new SQLite3($GLOBALS["TOPDIR"] . 'db/docs.db');

	/* Create the table if it doesn't exist */
	$db->exec('create table if not exists documents(
			link, path, dir, fn, description, date, checksum)');

	$count = update($GLOBALS["TOPDIR"] . 'docs', $db);

	echo '<hr><table id="links" class="gradienttable"><thead>';

	echo '<th> Link </th><th>Path</th><th>dir</th><th>filename</th><th>Description</th><th>Date</th><th>Checksum</th>',
		'</thead><tbody>';
	$results = $db->query('select * from documents');

	while ($row = $results->fetchArray(SQLITE3_NUM)) {
		echo ('<tr>');
		foreach ($row as $cell) {
			echo('<td>' . $cell . '</td>');
		}
		echo ('</tr>');
	}
	$db->close();

	print("<p>Done. Updated $count files.</p>\n");
}

$TOPDIR = dirname(dirname(__FILE__)) . '/';
$TOPDIR = str_replace('\\', '/', $TOPDIR);
main();
?>
