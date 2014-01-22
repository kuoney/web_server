<?php
/**
 * Finds path, relative to the given root folder, of all files and directories in the given directory and its sub-directories non recursively.
 * Will return an array of the form
 * array(
 *   'files' => [],
 *   'dirs'  => [],
 * )
 * @author sreekumar
 * @param string $root
 * @result array
 */
function read_all_files($root = '.') {
	$files  = array('files'=>array(), 'dirs'=>array());
	$directories  = array();
	$last_letter  = $root[strlen($root)-1];
	$root  = ($last_letter == '\\' || $last_letter == '/') ? $root : $root.DIRECTORY_SEPARATOR;

	$directories[]  = $root;

	while (sizeof($directories)) {
		$dir  = array_pop($directories);
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file == '.' || $file == '..') {
					continue;
				}
				$file  = $dir.$file;
				if (is_dir($file)) {
					$directory_path = $file.DIRECTORY_SEPARATOR;
					array_push($directories, $directory_path);
					$files['dirs'][]  = $directory_path;
				} elseif (is_file($file)) {
					$files['files'][]  = $file;
				}
			}
		closedir($handle);
		}
	}
	return $files;
}

function top_dir($cdir, $f)
{
	$tmp = strpos($f, $cdir);
	$d = substr($f, $tmp + strlen($cdir));
	$d = substr($d, 0, strpos($d, '/'));
	return $d;
}

function print_table($cur_dir = "/docs/", $exclude_dirs = array()) {
	echo "<p>";
	echo "<p><a href=\"./index.html\">Back to Index</a></p>";
	echo "</p>";
	echo "<p>Reference Manuals</p>";

	$own_links = $exclude_dirs;

	$links = array ();

	$all_files = read_all_files(dirname(__FILE__) . $cur_dir);
	sort($all_files['files']);

	foreach ($own_links as $dir) {
		$link = "$dir.php";
		echo "<a href=\"$link\"> Directory: " . basename($dir) . "</a><br>\n";
	}

	foreach ($all_files['files'] as $i => $file) {
		$file = str_replace('\\', '/', $file);
		$tdir = top_dir($cur_dir, $file);
		$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

		if (in_array($tdir, $own_links) || ($ext === "pptx" || $ext === "ppt")) {
			unset($all_files['files'][$i]);
			continue;
		}
	}
	$files_str = implode("\" \"", $all_files['files']);
	$files_str = "\"" . $files_str . "\"";
	eval('$filedata = ' . `exiftool.exe -CreateDate -Title -n -e -php $files_str`);

	foreach ($filedata as $i => $filex) {
		$link = $filex["SourceFile"];
		$link = substr($link, strpos($link, $cur_dir));
		$descriptor = $filex["Title"];
		$date = $filex["CreateDate"];
		$ext = strtolower(pathinfo($link, PATHINFO_EXTENSION));
		$lnk = "<a href=\"$link\">[$ext]</a><br>\n";

		$dir = substr($link, 0, - strlen(basename($link)));
		$dirlnk = "<a href=\"$dir\">$dir</a>";

		$detailslnk = "details.php?file=." . urlencode($link);
		$details = "<a href=\"$detailslnk\">Details</a>";
		$links[$i] = array($dirlnk, $descriptor, $lnk, $date, $details);
	}

	echo '<hr><table id="links" class="gradienttable tablesorter"><thead>';

	echo '<th> Link </th><th>Description</th><th>Date</th><th>Directory</th>',
		'<th>Details</th></thead><tbody>';
	foreach($links as $entry => $el) {
		echo '<tr>';
		echo '<td><p>', $el[2], '</p></td>
				<td><p>', $el[1], '</p></td>
				<td><p>', $el[3], '</p></td>
				<td><p>', $el[0], '</p></td>
				<td><p>', $el[4], '</p></td>';
		echo '</tr>';
	}
	echo '</tbody></table>';
}
?>
<script type="text/javascript" src="tablesorter/jquery-latest.js"></script>
<script type="text/javascript" src="tablesorter/jquery.tablesorter.js"></script>
<script>
$(document).ready(function()
	{
		$("#links").tablesorter();
	}
);
</script>
