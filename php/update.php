<style> <?php include "../docs.css"; ?> </style>
<?php

function update_db ( $file )
{
/*	if (checksum($file) not equal checksum_from_db()) {
		exif_tool(file);
		add_to_db(file_output);
		return 1;
	}
 */
	print "<p>$file</p>";
	return 0;
}

function update ($dir)
{
	$updated = 0;
	$files = scandir($dir);

	foreach ($files as $file) {
		if (!strcmp($file, ".") || !strcmp($file, ".."))
			continue;

		if (is_dir($dir . '/' . $file)) {
			update($dir . '/' . $file);
		} else {
			if (substr($file, -3) === "pdf")
				$updated += update_db($file);
		}

	}
	return $updated;
}

function main ()
{
	print("<p>Updating...</p>\n");
	$count = update(dirname(__FILE__) . '/../docs');
	print("<p>Done. Updated $count files.</p>\n");
}

main();
?>
