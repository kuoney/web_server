__FAE web_server__
================================================

Laptop web server for internal documents

This is a setup I created to use with the Abyss Web Server on my laptop.

__Instructions:__
=================================================
1. Download and install Abyss Web Server.
	https://aprelium.com/data/abwsx1.exe
2. Install the preconfigured php5 package for Abyss.
	Site: https://aprelium.com/abyssws/php5win.html
	File: https://aprelium.com/data/php5630.exe
3. Setup your password at http://127.0.0.1:9999/console. If you use
   lastpass, fill it out from your other instances of the same webserver.

	3.1. Declare the Interpreter
	http://127.0.0.1:9999/hosts/host@0/edit/scripting
	Add Interpreter:
		FastCGI (Local - Pipes)
		C:\Program Files (x86)\PHP5\php-cgi.exe
		Associated extensions: php

	3.2 Add php index file
	http://127.0.0.1:9999/hosts/host@0/edit/indexes
	index.php

	3.2 Restart the web server.

3. Change Chrome newtab page to 127.0.0.1 using an extension.
4. Clone this repository into C:/Abyss Web Server/htdocs (this is the root dir).
5. cd htdocs && mkdir docs
   This step is necessary for now but will be unnecessary in the future when
   I finally fix that code that assumes it's there.

__Directory Structure:__
==================================================
__db/__
	Includes docs.db which is the database of files in docs/

__docs/__
	Includes PDF files we want to view and traverse in a browser

__php/__
	All php files except for index.php

__tools/__
	Tools such as exiftool

__Usage:__
==================================================
When the main page is generated, it'll have an "Update Links" link and a bunch
of links to the subdirectories in the docs/ directory.

Use the Update Links link to refresh the database with the information from the
newly downloaded files. Then use the directory links to traverse your files.
