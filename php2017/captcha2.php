<?php 
@session_start();
require_once './CCImage.class.php';
echo CCImage::testVerifyCodeImage();
?>