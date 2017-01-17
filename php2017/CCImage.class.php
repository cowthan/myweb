<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

class CCImage
{
	public static function test($str){
		/*
		 1、画布管理：
		 imagecreate(int w, int h) ： 新建一个基于调色板的图像
		 imagecreatetruecolor(int w, int h)：新建一个真彩色图像
		 
		 imagedestroy($img)：销毁资源
		 
		 2、获取画布的高度和宽度
		 imagesx($img), imagesy($img)
		 
		 3、imagegif, imagejpeg, imagepng, imagewbmp生成图像
		 如果不设置别的参数，则直接作为输出流输出到浏览器, 可以设置输出文件名
		 
		 */
	}

	public static function br(){
		echo "<br/>";
	}

	public static function draw1(){
		$image = imagecreatetruecolor(100, 100); //创建一个100*100的背景图
		
		//初始化颜色
		$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
		$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
		$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
		$navy = imagecolorallocate($image, 0x00, 0x00, 0x80);
		$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
		$red = imagecolorallocate($image, 0xFF, 0x00, 0x00);
		$darkred = imagecolorallocate($image, 0x90, 0x00, 0x00);
		
		//给背景图头填充颜色
		imagefill($image, 0, 0, $white);
		
		//制作动态3D效果
		for($i = 60; $i > 50; $i--){  //循环10次画出立体效果
			imagefilledarc($image, 50, $i, 100, 50, -160, 40, $darknavy, IMG_ARC_PIE);
			imagefilledarc($image, 50, $i, 100, 50, 40, 75, $darkgray, IMG_ARC_PIE);
			imagefilledarc($image, 50, $i, 100, 50, -75, 200, $darkred, IMG_ARC_PIE);
		}
		
		//画椭圆弧且填充
		imagefilledarc($image, 50, $i, 100, 50, -160, 40, $darknavy, IMG_ARC_PIE);
		imagefilledarc($image, 50, $i, 100, 50, 40, 75, $darkgray, IMG_ARC_PIE);
		imagefilledarc($image, 50, $i, 100, 50, -75, 200, $darkred, IMG_ARC_PIE);
		
		//水平的画一行字符串
		imagestring($image, 1, 15, 55, '34.7%', $white);
		imagestring($image, 1, 45, 35, '55.6%', $white);
		
		//输出到浏览器
		header("Content-type:image/png");
		imagepng($image);
		imagedestroy($image);
	}
	
	public static function generateImage($image){
		if(function_exists("imagegif")){
			header("Content-type: image/gif");
			imagegif($image);
		}else if(function_exists("imagejpeg")){
			header("Content-type: image/jpeg");
			imagejpeg($image, "", 0.5);
		}else if(function_exists("imagepng")){
			header("Content-type: image/png");
			imagepng($image);
		}else if(function_exists("imagewbmp")){
			header("Content-type: image/vnd.wap.wbmp");
			imagegwbmp($image);
		}else{
			die("不支持图像");
		}
	}
	
	/**
	 * 验证码：80*20的图像，4个字符
	 * @param unknown $vericode
	 */
	public static function vericodeImage($vericode){
		
		static $width = 80;
		static $height = 20;
		static $codenum = 4;
		$disturbColorNum = 0; //干扰元素
		
		//--计算干扰元素数量
		$number = floor($height * $width / 15);
		if($number > 240 - $codenum){
			$disturbColorNum = 240 - $codenum;
		}else{
			$disturbColorNum = $number;
		}
		
		//--创建图像，初始化
		$image = imagecreatetruecolor($width, $height);
		$bgColor = imagecolorallocate($image, rand(225, 225), rand(225, 225), rand(225, 225));
		@imagefill($image, 0, 0, $bgColor);
		$border = imagecolorallocate($image, 0, 0, 0);
		imagerectangle($image, 0, 0, $width-1, $height-1, $border);
		
		//--设置干扰像素，向图像输出不同颜色的点
		for($i = 0; $i < $disturbColorNum; $i++){
			$color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0,255));
			imagesetpixel($image, rand(1, $width-2), rand(1, $height-2), $color);
		}
		
		for($i = 0; $i < 10; $i++){
			$color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0,255));
			imagearc($image, rand(-10, $width), rand(-10, $height), rand(30, 300), rand(20, 200), 55, 44, $color);
		}
		
		//--随机颜色，随机摆放，输出验证码
		for($i = 0; $i <= $codenum; $i++){
			$fontcolor = imagecolorallocate($image, rand(0, 128), rand(0, 128), rand(0, 128));
			$fontsize = rand(3, 5);
			$x = floor($width/$codenum) * $i + 3;
			$y = rand(0, $height - imagefontheight($fontsize));
			imagechar($image, $fontsize, $x, $y, $vericode[$i], $fontcolor);
			
		}
		
		//--输出图像
		if(function_exists("imagegif")){
			header("Content-type: image/gif");
			imagegif($image);
		}else if(function_exists("imagejpeg")){
			header("Content-type: image/jpeg");
			imagejpeg($image, "", 0.5);
		}else if(function_exists("imagepng")){
			header("Content-type: image/png");
			imagepng($image);
		}else if(function_exists("imagewbmp")){
			header("Content-type: image/vnd.wap.wbmp");
			imagegwbmp($image);
		}else{
			die("不支持图像");
		}
	}
	
	public static function generateVerifyCode($num){
		$codes = "3456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$res = "";
		for($i = 0; $i < $num; $i++){
			$ch = $codes[rand(0, strlen($codes) - 1)];
			$res .= $ch;
		}
		return $res;
	}
	
	public static function testVerifyCodeImage(){
		$code = CCImage::generateVerifyCode(4);
		//echo $code;
		CCImage::vericodeImage($code);
		return "";
	}
	
	/*
	 * 功能：PHP图片水印 (水印支持图片或文字)
	* 参数：
	*      $groundImage    背景图片，即需要加水印的图片，暂只支持GIF,JPG,PNG格式；
	*      $waterPos        水印位置，有10种状态，0为随机位置；
	*                        1为顶端居左，2为顶端居中，3为顶端居右；
	*                        4为中部居左，5为中部居中，6为中部居右；
	*                        7为底端居左，8为底端居中，9为底端居右；
	*      $waterImage        图片水印，即作为水印的图片，暂只支持GIF,JPG,PNG格式；
	*      $waterText        文字水印，即把文字作为为水印，支持ASCII码，不支持中文；
	*      $textFont        文字大小，值为1、2、3、4或5，默认为5；
	*      $textColor        文字颜色，值为十六进制颜色值，默认为#FF0000(红色)；
	*
	* 注意：Support GD 2.0，Support FreeType、GIF Read、GIF Create、JPG 、PNG
	*      $waterImage 和 $waterText 最好不要同时使用，选其中之一即可，优先使用 $waterImage。
	*      当$waterImage有效时，参数$waterString、$stringFont、$stringColor均不生效。
	*      加水印后的图片的文件名和 $groundImage 一样。
	* 作者：longware @ 2004-11-3 14:15:13
	*/
	public static function imageWaterMark($groundImage,$waterPos=0,$waterImage="",$waterText="",$textFont=5,$textColor="#FF0000", $prefix = "wm_")
	{
		$isWaterImage = FALSE;
		$formatMsg = "暂不支持该文件格式，请用图片处理软件将图片转换为GIF、JPG、PNG格式。";
	
		//读取水印文件
		if(!empty($waterImage) && file_exists($waterImage))
		{
			$isWaterImage = TRUE;
			$water_info = getimagesize($waterImage);
			$water_w    = $water_info[0];//取得水印图片的宽
			$water_h    = $water_info[1];//取得水印图片的高
	
			switch($water_info[2])//取得水印图片的格式
			{
				case 1:$water_im = imagecreatefromgif($waterImage);break;
				case 2:$water_im = imagecreatefromjpeg($waterImage);break;
				case 3:$water_im = imagecreatefrompng($waterImage);break;
				default:die($formatMsg);
			}
		}
	
		//读取背景图片
		if(!empty($groundImage) && file_exists($groundImage))
		{
			$ground_info = getimagesize($groundImage);
			$ground_w    = $ground_info[0];//取得背景图片的宽
			$ground_h    = $ground_info[1];//取得背景图片的高
	
			switch($ground_info[2])//取得背景图片的格式
			{
				case 1:$ground_im = imagecreatefromgif($groundImage);break;
				case 2:$ground_im = imagecreatefromjpeg($groundImage);break;
				case 3:$ground_im = imagecreatefrompng($groundImage);break;
				default:die($formatMsg);
			}
		}
		else
		{
			die("需要加水印的图片不存在！");
		}
	
		//水印位置
		if($isWaterImage)//图片水印
		{
			$w = $water_w;
			$h = $water_h;
			$label = "图片的";
		}
		else//文字水印
		{
			$temp = imagettfbbox(ceil($textFont*2.5),0,"./font/Elephant.ttf",$waterText);//取得使用 TrueType 字体的文本的范围
			$w = $temp[2] - $temp[6];
			$h = $temp[3] - $temp[7];
			unset($temp);
			$label = "文字区域";
		}
		if( ($ground_w<$w) || ($ground_h<$h) )
		{
			echo "需要加水印的图片的长度或宽度比水印".$label."还小，无法生成水印！";
			return;
		}
		switch($waterPos)
		{
			case 0://随机
				$posX = rand(0,($ground_w - $w));
				$posY = rand(0,($ground_h - $h));
				break;
			case 1://1为顶端居左
				$posX = 0;
				$posY = 0;
				break;
			case 2://2为顶端居中
				$posX = ($ground_w - $w) / 2;
				$posY = 0;
				break;
			case 3://3为顶端居右
				$posX = $ground_w - $w;
				$posY = 0;
				break;
			case 4://4为中部居左
				$posX = 0;
				$posY = ($ground_h - $h) / 2;
				break;
			case 5://5为中部居中
				$posX = ($ground_w - $w) / 2;
				$posY = ($ground_h - $h) / 2;
				break;
			case 6://6为中部居右
				$posX = $ground_w - $w;
				$posY = ($ground_h - $h) / 2;
				break;
			case 7://7为底端居左
				$posX = 0;
				$posY = $ground_h - $h;
				break;
			case 8://8为底端居中
				$posX = ($ground_w - $w) / 2;
				$posY = $ground_h - $h;
				break;
			case 9://9为底端居右
				$posX = $ground_w - $w;
				$posY = $ground_h - $h;
				break;
			default://随机
				$posX = rand(0,($ground_w - $w));
				$posY = rand(0,($ground_h - $h));
				break;
		}
	
		//设定图像的混色模式
		imagealphablending($ground_im, true);
	
		if($isWaterImage)//图片水印
		{
			imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//拷贝水印到目标文件
		}
		else//文字水印
		{
			if( !empty($textColor) && (strlen($textColor)==7) )
			{
				$R = hexdec(substr($textColor,1,2));
				$G = hexdec(substr($textColor,3,2));
				$B = hexdec(substr($textColor,5));
			}
			else
			{
				die("水印文字颜色格式不正确！");
			}
			imagestring ( $ground_im, $textFont, $posX, $posY, $waterText, imagecolorallocate($ground_im, $R, $G, $B));
		}
	
		//生成水印后的图片
		//@unlink($groundImage);
		
		$dir = dirname($groundImage);
		$filename = basename($groundImage);
		$finalpath = $dir . "/" . $prefix . $filename;
		@chmod($dir, 0757);
		switch($ground_info[2])//取得背景图片的格式
		{
			case 1:
				//$finalpath .= "_mark.gif";
				imagegif($ground_im,$finalpath);
				break;
			case 2:
				//$finalpath .= "_mark.jpg";
				imagejpeg($ground_im,$finalpath);
				break;
			case 3:
				//$finalpath .= "_mark.png";
				imagepng($ground_im,$finalpath);
				break;
			default:die($errorMsg);
		}
	
		//释放内存
		if(isset($water_info)) unset($water_info);
		if(isset($water_im)) imagedestroy($water_im);
		unset($ground_info);
		imagedestroy($ground_im);
		return $finalpath;
	}
	
	/**
	 * 生成缩略图，一般网站而言，不管上传多大图片，首先处理成500*500，并覆盖原图，再存个中图，250*250，thumb开头，再存个小图80*80,icon开头
	 * @param unknown $filename
	 * @param number $width
	 * @param number $height
	 * @return string
	 */
	public static function thumb($filename, $width=200, $height=200, $prefix="thumb_"){
		list($wo, $ho) = getimagesize($filename);
		if($width && ($wo < $ho)){
			$width = ($height / $ho) * $wo;
		}else{
			$height = ($width / $wo) * $ho;
		}
		
		//将原图缩放到这个新创建到图片资源中
		$image_p = imagecreatetruecolor($width, $height);
		//获取原图的图像资源
		$dir = dirname($filename);
		$filename1 = basename($filename);
		$finalpath = $dir . "/" . $prefix . $filename1;
		$image = imagecreatefromjpeg($finalpath);
		//缩放
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $wo, $ho);
		//保存
		imagejpeg($image_p, $filename . ".jpg", 100);
		
		imagedestroy($image_p);
		imagedestroy($image);
		
		return $filename . ".jpg";
	}
	
	/**
	 * 裁剪图片，从xy开始，裁剪大小为width*height
	 * @param unknown $filename
	 * @param unknown $x
	 * @param unknown $y
	 * @param unknown $width
	 * @param unknown $height
	 */
	public static function cut($filename, $x, $y, $width, $height, $prefix="cut_"){
		$back = imagecreatefromjpeg($filename);
		$cutimg = imagecreatetruecolor($width, $height);
		imagecopyresampled($cutimg, $back, 0, 0, $x, $y, $width, $height, $width, $height);
		
		$dir = dirname($filename);
		$filename1 = basename($filename);
		$finalpath = $dir . "/" . $prefix . $filename1;
		imagejpeg($cutimg, $finalpath);
		
		imagedestroy($cutimg);
		imagedestroy($back);
	}
	
	/**
	 * 加水印，water是水印图片路径
	 * @param unknown $filename  jpeg
	 * @param unknown $water     gif
	 */
	public static function watermark($filename, $water, $prefix="wm2_"){
		list($bw, $bh) = getimagesize($filename);
		list($ww, $wh) = getimagesize($water);
		
		$posx = rand(0, ($bw - $ww));
		$posy = rand(0, ($bh - $wh));
		
		$back = imagecreatefromjpeg($filename);
		$water = imagecreatefromgif($water);
		
		imagecopy($back, $water, $posx, $posy, 0, 0, $ww, $wh);
		
		$dir = dirname($filename);
		$filename1 = basename($filename);
		$finalpath = $dir . "/" . $prefix . $filename1;
		imagejpeg($back, $finalpath);
		
		imagedestroy($back);
		imagedestroy($water);
	}
	
	/**
	 * 旋转图片
	 * @param unknown $filename
	 * @param unknown $degrees   180
	 */
	public static function rotate($filename, $degrees)
	{
		$src = imagecreatefromjpeg($filename);
		$rotate = imagerotate($src, $degrees, 0);
		
		$dir = dirname($filename);
		$filename1 = basename($filename);
		$finalpath = $dir . "/" . $prefix . $filename1;
		imagejpeg($rotate, $finalpath);
		
		imagedestroy($rotate);
		imagedestroy($src);
	}
}

/**
 * 验证码类
 * 
 * 使用方法：
1、先把验证码类保存为一个名为 ValidateCode.class.php 的文件；
2、新建一个名为 captcha.php 的文件进行调用该类；

captcha.php
复制代码 代码如下:

session_start();
require './ValidateCode.class.php';  //先把类包含进来，实际路径根据实际情况进行修改。
$_vc = new ValidateCode();  //实例化一个对象
$_vc->doimg();  
$_SESSION['authnum_session'] = $_vc->getCode();//验证码保存到SESSION中

<img  title="点击刷新" src="./captcha.php" align="absbottom" onclick="this.src='captcha.php?'+Math.random();"></img>
 * 
 */
class ValidateCode {
	private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';//随机因子
	private $code;//验证码
	private $codelen = 4;//验证码长度
	private $width = 130;//宽度
	private $height = 50;//高度
	private $img;//图形资源句柄
	private $font;//指定的字体
	private $fontsize = 20;//指定字体大小
	private $fontcolor;//指定字体颜色
	//构造方法初始化
	public function __construct() {
		$this->font = dirname(__FILE__).'/font/elephant.ttf';//注意字体路径要写对，否则显示不了图片
	}
	//生成随机码
	private function createCode() {
		$_len = strlen($this->charset)-1;
		for ($i=0;$i<$this->codelen;$i++) {
			$this->code .= $this->charset[mt_rand(0,$_len)];
		}
	}
	//生成背景
	private function createBg() {
		$this->img = imagecreatetruecolor($this->width, $this->height);
		$color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
		imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
	}
	//生成文字
	private function createFont() {
		$_x = $this->width / $this->codelen;
		for ($i=0;$i<$this->codelen;$i++) {
			$this->fontcolor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
			imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height / 1.4,$this->fontcolor,$this->font,$this->code[$i]);
		}
	}
	//生成线条、雪花
	private function createLine() {
		//线条
		for ($i=0;$i<6;$i++) {
			$color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
			imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
		}
		//雪花
		for ($i=0;$i<100;$i++) {
			$color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
			imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
		}
	}
	//输出
	private function outPut() {
		header('Content-type:image/png');
		imagepng($this->img);
		imagedestroy($this->img);
// 		if(function_exists("imagegif")){
// 			header("Content-type: image/gif");
// 			imagegif($this->img);
// 		}else if(function_exists("imagejpeg")){
// 			header("Content-type: image/jpeg");
// 			imagejpeg($this->img, "", 0.5);
// 		}else if(function_exists("imagepng")){
// 			header("Content-type: image/png");
// 			imagepng($this->img);
// 		}else if(function_exists("imagewbmp")){
// 			header("Content-type: image/vnd.wap.wbmp");
// 			imagegwbmp($this->img);
// 		}else{
// 			die("不支持图像");
// 		}
// 		imagedestroy($this->img);
	}
	//对外生成
	public function doimg() {
		$this->createBg();
		$this->createCode();
		$this->createLine();
		$this->createFont();
		$this->outPut();
	}
	//获取验证码
	public function getCode() {
		return strtolower($this->code);
	}
}


// if(!extension_loaded("gd")){
// 	echo "gd没有加载<br/>";
// 	die();
// }else{
// 	//echo "有gd";
// 	echo CCImage::testVerifyCodeImage();
// }


?>
















</body>
</html>