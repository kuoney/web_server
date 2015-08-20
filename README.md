__FAE web_server__
================================================

Laptop web server for internal documents

This is a setup I created to use with the Abyss Web Server on my laptop.

__Instructions:__
=================================================
1. Download and install Abyss Web Server.
2. Install php support for Abyss.
3. Change Chrome newtab page to 127.0.0.1 using an extension.
4. Clone this repository into C:/Abyss Web Server/htdocs (this is the root dir).

The index is in index.php so make sure that's your default in Abyss index file
configuration.

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
