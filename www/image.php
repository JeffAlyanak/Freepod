<?php

require_once dirname( dirname( __FILE__ ) ) . '/freepod/bootstrap.php';
require_once DIR_VIEW . 'image.php';

$imageName  = $_GET['i'];    // Image
$imageSize  = $_GET['s'];    // Size
$resizeType = $_GET['t'];    // Type

$img = new Image($imageName, $imageSize, $resizeType);

// TODO: add something to clear/rebuild cache
$img->generateImage();
$img->returnImage();

?>
