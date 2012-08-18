#!/usr/bin/php
<?php

// Define file names and paths.
$css_variables   = "variables.php";
$css_style_sheet = "style.css";
$php_style_sheet = "style.php.css";


// Check for '-merge' input argument.
if (sizeof($argv) == 1)
	$merge_css = false;
elseif ($argv[1] == "-merge")
	$css_contents = file_get_contents($style_sheet) or die("Can't open $css_file.");
else
	die("Invalid argument. Use -merge to keep new css content.\n");

// Include "css variables" from file and define
// any other variables we may need.
include $css_variables;
$date = date("l, j M Y H:i:s T");

// Evaluate the contents of our "php style sheet"
// and store it in a variable.
$php_contents = file_get_contents("style.php.css")
	or die("Can't open $php_style_sheet.");	
eval("\$php_contents = \"$php_contents\";");

// Overwrite the contents of our old style sheet
// with the newly generated content.
$css_handle = fopen($css_style_sheet, 'w')
	or die("Can't open $css_style_sheet.");
fwrite($css_handle, $php_contents);
fclose($css_handle);

?>
