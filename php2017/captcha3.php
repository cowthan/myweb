<?php 
@session_start();
require_once './CCImage.class.php';
$img = "./images/test.jpg";
$filename = CCImage::imageWaterMark($img, 9, "", "cowthan");
echo "<img src='" . $filename . "' border='0'>" ;
?>
