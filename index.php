<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso 8859-1">
<title>Home</title>
<link rel="stylesheet" type="text/css" href="docs.css">
</head>

<body>
<!-- First the header -->
<div id="header">
	<h1 style="margin-bottom:0;" align="center">Home</h1> <hr>
</div>

<!-- Our second div is the links section. This contains links to commonly used
     stuff as well as the directory structure -->
<div id="links" style="height:100%;width:400px;float:left;">
	<p> Personal links: </p>
	<a href="http://www.gmail.com">				gmail		</a><br>
	<a href="https://drive.google.com/?authuser=0#my-drive">google drive	</a><br>
	<a href="http://www.pandora.com">			Pandora		</a><br>

	<p> Professional links: </p>
	<a href="http://community.nxp.com">NXP Community</a><br>
	<a href="http://git.freescale.com/git/cgit.cgi/imx/linux-imx.git/">Freescale Linux Git</a><br>
	<a href="http://git.freescale.com/git/cgit.cgi/imx/uboot-imx.git/">Freescale u-boot Git</a><br>

	<p> Home Network: </p>
	<a href="http://routerlogin.net">	NightHawk Router</A><br>
	<a href="http://192.168.0.19">		Brother Printer</A><br>
	<a href="http://192.168.0.20">		HP Printer</A><br>

	<p> Documents: </p>
	<?php
		include 'php/main.php';
	?>
</div>

<!-- Our final div is for the weather. We need to reset the style here for the
     weather widget since the default CSS makes it look ugly with borders. -->
<div id="weather" style="height:100%;width:400px;float:right;">
	<style type="text/css">
	table, th, td {
		text-align: center;
		padding: 0;
		border: 0;
	}
	</style>
	<iframe style="display: block;" src="//cdnres.willyweather.com/widget/loadView.html?id=67420" width="199" height="82" frameborder="0" scrolling="no"></iframe>
</div>

<!-- Our last div is the footer. Let's give credit to the nice people from Aprelium -->
<div id="footer" align="center">
<!-- Put this div to the bottom and hard align it to the center of the 100% width of the browser -->
<style type="text/css">
#footer {
	position : absolute;
	bottom : 0;
	width: 100%;
	text-align : center;
}
</style>
	<p class="footer"> Abyss Web Server - Copyright &#169; 2001-2013 <A HREF="http://www.aprelium.com" >Aprelium</A> - All rights reserved </p>
</div>
</body></html>
