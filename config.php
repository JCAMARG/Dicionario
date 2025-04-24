<?php
	define("SITE_SUBFOLDER","");
	define("SITE_ROOT", $_SERVER["DOCUMENT_ROOT"].SITE_SUBFOLDER);
	//define("SITE_URL", "http://". $_SERVER["SERVER_NAME"].SITE_SUBFOLDER);

	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
	$host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME']; // fallback se HTTP_HOST não existir
	define("SITE_URL", $protocol . "://" . $host . SITE_SUBFOLDER);
	
	define("_DB_HOST", "localhost");
	define("_DB_USER", "root");
	define("_DB_PASS","");
	define("_DB_NAME", "projeto_lab");
	
	include(SITE_ROOT."/mysql.php");
?>
