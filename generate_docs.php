<html>
<head>

<?php
/*
 * dr=directory name: which directory we want to traverse
 * ex[]=a&ex[]=b: an array of 'excludes' - do not traverse
 */
$dr = isset($_GET['dr']) ? $_GET['dr'] : "";
$ex = isset($_GET['ex']) ? $_GET['ex'] : array();
?>

<title><?php echo $dr?></title>
	<link rel="stylesheet" type="text/css" href="docs.css">
</head>
<META http-equiv="Content-Type" content="text/html; charset=iso 8859-1">
<body>
<?php
include_once './docs_common.php';

print_table("/docs/" . $dr , $ex);
?>
</body></html>

