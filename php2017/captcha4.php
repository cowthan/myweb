<?php 
@session_start();
require_once './CCImage.class.php';
$img = "./images/test.jpg";
$filename = CCImage::thumb($img, 100, 100);
echo "<img src='" . $filename . "' border='0'>";
?>
