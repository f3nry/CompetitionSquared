<?php
use \lithium\core\Libraries;

require_once LITHIUM_LIBRARY_PATH . "/li3_messy_data/File.php";
require_once LITHIUM_LIBRARY_PATH . "/li3_messy_data/CsvFile.php";

$name = 'li3_messy_data';
$library = Libraries::get($name);

if (empty($library)) {
	Libraries::add($name, array(
		'bootstrap' => false,
		'path' => LITHIUM_LIBRARY_PATH . "/li3_messy_data/",
		'prefix' => 'li3_messy_data'
	));
}