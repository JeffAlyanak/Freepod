<?php

define('DIR_BASE',      dirname( dirname( __FILE__ ) ) . '/');
define('DIR_FREEPOD',   DIR_BASE . 'freepod/');
define('DIR_VEND',      DIR_BASE . 'vendor/');

define('DIR_MODEL',     DIR_FREEPOD . 'model/');
define('DIR_VIEW',      DIR_FREEPOD . 'view/');
define('DIR_CONTROL',   DIR_FREEPOD . 'control/');

define('DIR_ASSET',     DIR_BASE . 'www/assets/');
define('DIR_IMAGE',     DIR_ASSET . 'images/');
define('DIR_SCRIPT',    DIR_ASSET . 'scripts/');
define('DIR_COMPONENT', DIR_ASSET . 'components/');

require_once DIR_VEND . 'autoload.php';

?>