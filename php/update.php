<style> <?php include "../docs.css"; ?> </style>
<?php

function update_db ($path, $db )
{
	$sha1 = sha1_file($path);

	if (empty($db->querySingle("select checksum from documents where checksum=\"$sha1\""))) {
		/* TODO: exiftool */
		$db->exec("insert into documents values (\"$path\", \"D\", \"14\", \"$sha1\")");
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
	print("<p>Updating...</p>\n");

	$db = new SQLite3(dirname(__FILE__) . '/../db/docs.db');

	/* Create the table if it doesn't exist */
	$db->exec('create table if not exists documents(
			link, description, date, checksum)');

	$count = update(dirname(__FILE__) . '/../docs', $db);

	echo '<hr><table id="links" class="gradienttable"><thead>';

	echo '<th> Link </th><th>Description</th><th>Date</th><th>Checksum</th>',
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

main();
?>
