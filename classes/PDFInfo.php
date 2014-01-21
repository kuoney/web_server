<?php

// Author: de77.com
// Licence: MIT
// Homepage: http://de77.com/php/extract-title-author-and-number-of-pages-from-pdf-with-php
// Version: 21.07.2010


class PDFInfo
{
	public $author;
	public $title;
	public $created;
	public $rev;

	private function get_field($string, $field)
	{
		$begin = "<" . $field . ">";
		$end = "</" . $field . ">";
		$start = strpos($string, $begin) + strlen($begin);
		// well... some of our documents have this twice...
		if ($start !== false) {
			$start2 = strpos($string, $begin, $start) + strlen($begin);

			if (($start2 !== false) and ($start2 > $start)) {
					$start = $start2;
			}
			$length = strpos(substr($string, $start), $end);

			if ($length) {
				$retval = strip_tags(substr($string, $start, $length));
				$retval = trim($this->pdfDecTxt($retval));
				return $retval;
			}
			return false;
		}
		return false;
	}

	public function load($filename)
	{
		ini_set('memory_limit', '256M');
		$string = file_get_contents($filename);

		if (($this->title = $this->get_field($string, "dc:title")) === false) {
		   $this->title	= '[Untitled] ' . basename($filename);
		}

		if (($this->created = $this->get_field($string, "xap:ModifyDate")) === false) {
			$this->created = "1970-01-01";
		}
		$this->created = reset(split('T', $this->created, -1));

		if (($this->author = $this->get_field($string, "dc:creator")) === false) {
			$this->author = 'Unknown';
		}
		$data;
	}

	private function pdfDecTxt($txt)
	{
		$len = strlen($txt);
		$out = '';
		$i = 0;
		while ($i<$len)
		{
			if ($txt[$i] == '\\')
			{
				$out .= chr(octdec(substr($txt, $i+1, 3)));
				$i += 4;
			}
			else
			{
				$out .= $txt[$i];
				$i++;
			}
		}

		if (!empty($out) && $out[0] == chr(254))
		{
			$enc = 'UTF-16';
		}
		else
		{
			$enc = mb_detect_encoding($out);
		}

		return iconv($enc, 'UTF-8//IGNORE', $out);
	}
}
