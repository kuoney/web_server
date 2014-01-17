<html>
<head>
	<title>Documents</title>
</head>
<META http-equiv="Content-Type" content="text/html; charset=iso 8859-1">
<STYLE type="text/css">
<!--
BODY {
	FONT-SIZE: small; COLOR: #000000; FONT-FAMILY: "trebuchet ms", Verdana, Arial, Helvetica, sans-serif; BACKGROUND-COLOR: #FFFFFF
}

H1 {
	FONT-SIZE: large;
}

table, th, td {
	border: 1px solid black;
	font-size: small;
}
td {
	text-align:left;
	padding:1px;
}
A:hover {
	COLOR: #ff9900; TEXT-DECORATION: underline;
}

.footer {
	TEXT-ALIGN: center; FONT-SIZE: smaller;
}

.footer IMG {
	BORDER: 1px solid #888;
}
-->
</STYLE>
<body>
<?php
include './classes/PDFInfo.php';
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

function get_descriptor($f)
{
	$p = new PDFInfo;
	$p->load($f);
	return "$p->title ";

}

function top_dir($f)
{
	$d = substr($f, strlen(dirname(__FILE__)) + strlen("docs/") + 1 , -1 - strlen(basename($f)));
	$d = substr($d, 0, strpos($d, '/'));
	return $d;
}

echo "<p>";
echo "<p><a href=\"./index.html\">Back to Index</a></p>";
echo "</p>";
echo "<p>Reference Manuals</p>";

$own_links = array (
		"cpu_docs",
);
$links = array ();

$all_files = read_all_files(dirname(__FILE__) . "/docs/");
sort($all_files['files']);

foreach ($own_links as $dir) {
	$link = "$dir.php";
	echo "<a href=\"$link\"> Directory: " . basename($dir) . "</a><br>\n";
}

$links[0] = array("Directory", "Description", "Link");
$row = 1;
foreach ($all_files['files'] as $file) {
	$file = str_replace('\\', '/', $file);
	$tdir = top_dir($file);
	$dir = substr($file, strlen(dirname(__FILE__)) , strlen(basename($file)));
	$dir = substr($file, strlen(dirname(__FILE__)) + 1 , -1 - strlen(basename($file)));

	if (in_array($tdir, $own_links)) {
		continue;
	}
	$link = substr($file, strlen(dirname(__FILE__)));
	$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

	if ($ext === "pdf") {
		$descriptor = get_descriptor($file);
	} else {
		$descriptor = basename($file);
	}
	$lnk = "<a href=\"$link\">[$ext]</a><br>\n";
	$dirlnk = "<a href=\"$dir\">$dir</a>";
	$links[$row] = array($dirlnk, $descriptor, $lnk);
	$row++;
}
echo '<hr><table>';

foreach($links as $entry => $el) {
	echo '<tr>';
	echo '<td>', $el[2], '</td>
			<td>', $el[1], '</td>
			<td>', $el[0], '</td>';
	echo '</tr>';
}
echo '</table>';
?>
</body></html>
