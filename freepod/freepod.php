<?php

require_once dirname( dirname( __FILE__ ) ) . '/freepod/bootstrap.php';

require_once DIR_MODEL . 'config.php';
require_once DIR_MODEL . 'page.php';

$c = new Configuration();
$c->LoadConfig('config.toml');

try
{
	$fp_title       = $c->GetTitle();
	$fp_description = $c->GetDescription();
	$fp_email       = $c->GetEmail();
	$fp_url         = $c->GetURL();
	$fp_debug       = $c->GetDebug();
}
catch (Exception $e)
{
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$path = explode("?", $_SERVER['REQUEST_URI']);
$path = $path[0];

if ($path != "/image.php")
{
	$c = new Page($path);	
}

?>