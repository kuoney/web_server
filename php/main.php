<?php

/* Show a link to links.php with the name of each directory under ../docs */
function show_links ()
{
	$dirs = scandir(dirname(__FILE__) . '/../docs');

	foreach ($dirs as $dir) {
		if (!strcmp($dir, ".") || !strcmp($dir, ".."))
			continue;

		print("<a href=\"php/links.php?dr=$dir\">$dir</a><br>\n");
	}
}

/* Show the update link as well as links to process each dir under docs/ */
function main ()
{
	print("<a href=\"php/update.php\">Update Links</a><br>\n");
	show_links();
}

main();
?>
