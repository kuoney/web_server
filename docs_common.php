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

	$row = 0;
	foreach ($all_files['files'] as $file) {
		$file = str_replace('\\', '/', $file);
		$tdir = top_dir($cur_dir, $file);
		$dir = substr($file, strlen(dirname(__FILE__)) , strlen(basename($file)));
		$dir = substr($file, strlen(dirname(__FILE__)) + 1 , -1 - strlen(basename($file)));

		if (in_array($tdir, $own_links))
			continue;

		$link = substr($file, strlen(dirname(__FILE__)));
		$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

		$filedata = array();
		eval('$filedata = ' . `exiftool.exe -CreateDate -Title -n -e -php "$file"`);
		$descriptor = $filedata[0]["Title"];
		$date = $filedata[0]["CreateDate"];

		if ($ext === "pptx" || $ext === "ppt")
			continue;
		$lnk = "<a href=\"$link\">[$ext]</a><br>\n";
		$dirlnk = "<a href=\"$dir\">$dir</a>";
		$detailslnk = "details.php?file=." . urlencode($link);
		$details = "<a href=\"$detailslnk\">Details</a>";
		$links[$row] = array($dirlnk, $descriptor, $lnk, $date, $details);
		$row++;
	}
	echo '<hr><table class="gradienttable">';

	echo '<th> Link </th><th>Description</th><th>Date</th><th>Directory</th><th>Details</th>';
	foreach($links as $entry => $el) {
		echo '<tr>';
		echo '<td><p>', $el[2], '</p></td>
				<td><p>', $el[1], '</p></td>
				<td><p>', $el[3], '</p></td>
				<td><p>', $el[0], '</p></td>
				<td><p>', $el[4], '</p></td>';
		echo '</tr>';
	}
	echo '</table>';
}
?>
