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

function get_descriptor($f)
{
	$p = new PDFInfo;
	$p->load($f);
	return "$p->title ";

}

echo "<p>";
echo "<p><a href=\"./index.html\">Back to Index</a></p>";
echo "</p>";
echo "<p>Reference Manuals</p>";
$files = glob(dirname(__FILE__) . "/docs/*RM.pdf");

foreach ($files as $file) {
	$descriptor = get_descriptor($file);
	echo "<a href=\"/docs/" . basename($file) . "\">$descriptor</a><br>\n";
}

echo "<p>Application Notes</p>";
$files = glob(dirname(__FILE__) . "/docs/AN*.pdf");

foreach ($files as $file) {
	$descriptor = get_descriptor($file);
	echo "<a href=\"/docs/" . basename($file) . "\">$descriptor</a><br>\n";
}
?>
</body></html>
