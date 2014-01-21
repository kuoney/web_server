web_server
==========

Laptop web server for internal documents

This is a setup I created to use with the Abyss Web Server on my laptop. Here are the steps:

1. Download and install Abyss Web Server.
2. Install php support for Abyss.
3. Change Chrome newtab page to 127.0.0.1 using an extension.
4. Clone this repository into C:/Abyss Web Server/htdocs (this is the root dir).

The documents/cpu_docs pages assume a docs/ directory and a docs/cpu_docs directory. The
rest of the directory names do not matter.

classes/ directory is a simple PDF metadata reader which will be replaced.

docs.php and cpu_docs.php are very similar. They can probably be combined into one file
with some sort of input magic.

docs_common.php includes the common functions to generate the document tables. Similarly,
docs.css has the common css stuff for the display elements.
