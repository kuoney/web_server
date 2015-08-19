<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><HTML><HEAD>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso 8859-1">
<title>FAE Documents Web Server Powered by Abyss</title>
<link rel="stylesheet" type="text/css" href="docs.css">
</head>

<body>
<!-- Our first div is the links section. This contains links to commonly used
     stuff as well as the directory structure -->
<div id="links" style="height:100%;width:400px;float:left;">
	<p> Personal links: </p>
	<a href="http://www.gmail.com">gmail</a><br>
	<a href="https://drive.google.com/?authuser=0#my-drive">google docs</a><br>
	<a href="http://www.espn.com">ESPN</a><br>
	<a href="http://www.nytimes.com">New York Times</a><br>
	<a href="http://www.facebook.com">Facebook</a><br>
	<a href="http://www.pandora.com">Pandora</a><br>

	<p> Professional links: </p>
	<a href="http://community.freescale.com">Freescale Community</a><br>
	<a href="http://git.freescale.com/git/cgit.cgi/imx/linux-2.6-imx.git/">Freescale Linux Git</a><br>
	<a href="http://git.freescale.com/git/cgit.cgi/imx/uboot-imx.git/">Freescale u-boot Git</a><br>

	<p> Home Network: </p>
	<a href="http://192.168.0.1">TWC Router</A><br>
	<a href="http://10.0.0.1">Linksys Router</A><br>

	<p> Documents: </p>
</div>

<!-- Our second div is for the weather. We need to reset the style here for the
     weather widget since the default CSS makes it look ugly with borders. -->
<div id="weather" style="height:100%;width:400px;float:right;">
	<style type="text/css">
	table, th, td {
		text-align: center;
		padding: 0;
		border: 0;
	}
	</style>
	<script type="text/javascript" src="http://voap.weather.com/weather/oap/27617?template=GENXH&par=3000000007&unit=0&key=twciweatherwidget"></script>
</div>
</body></html>
