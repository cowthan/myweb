<?php

class CCFile
{
	public static function test($str){
		
		/*
		 file_exists()
		 filesize()
		 filetype():返回file，dir, block－－块设备文件, char－－字符设备文件, fifo－－命名管道文件, link－－符号链接, unknown
		 is_readable()
		 is_writeable()
		 is_executable()
		 filectime()：文件创建时间
		 filemtime()：文件修改时间
		 fileatime()：文件访问时间
		 stat()--获取文件大部分属性值
		 Array(
		 	dev = 30  文件所在设备号
		 	ino = 0   inode号，是与每个文件关联的唯一数值标识符
		 	mode = 33206   inode保护模式，确定访问和修改权限
		 	nlink = 1   与文件关联的硬链接的数组
		 	uid = 0     文件所有者的用户id
		 	gid = 0      文件所属组
		 	rdev = 3   设备类型
		 	size = 6103
		 	atime = 12306121212     访问时间
		 	mtime = 23312121212     修改时间
		 	ctime = 11212312323     创建时间
		 	blksize = -1     文件块大小
		 	blocks = -1      文件块数量
		 )
		 
		 2、对于$p = "/var/www/html/page.php"：
		 basename($p)：返回page
		 dirname($p)：返回/var/www/html
		 pathinfo($p)：返回数组，dirname=/var/www/html, basename=page, extension=.php
		 
		 3、遍历目录：$p = /var/www/html;
		 opendir($p)：打开目录，返回句柄，如果打不开，就返回false
		 readdir($dir)：返回目录下当前指针指向的文件，并指向下一个
		 closedir($dir)
		 rewinddir($dir)：指针回到开头
		 
		 例子：
		 
		 $num = 0;
		 $dirname = "D:/";
		 $dir = opendir($dirname);
		 
		 while($file = readdir($dir)){
		 	$dirFile = $dirname . "/" . $file;
		 	$bgcolor = $num++%2 == 0 ? "#FFFFFF" : "#CCCCCC";
		 	
		 	echo "<tr bgcolor=" . $bgcolor . ">";
		 	
		 	echo '<td>' . $file . '</td>';
		 	echo '<td>' . filesize($dirFile) . '</td>';	
		 	echo '<td>' . filetype($dirFile) . '</td>';
		 	echo '<td>' . date("Y/n/t", filemtime($dirFile)) . '</td>';
		 	
		 	echo "</tr>";
		 }
		 
		 echo "</table>";
		 closedir($dir);
		 
		 echo "在<b>" . $dirname . "</b>目录下的子目录和文件共有<b>" . $num . "</b>个";
		 
		 
		 4、目录操作：
		 mkdir()
		 rmdir()：只能删除空目录，且必须存在
		 unlink()：先清空文件，有文件时用这个删，但如果有子目录，就得自己写递归删除了
		 
		 */
		/*
		
		1、打开文件和关闭文件
		
		int fopen($filename, string mode)
		mode的值是：
		a：追加，若不存在，则试图创建，创建失败，此函数才失败
		a+：追加和读取
		r：只读
		r+：读写，并且写时是覆盖，从头写--内容可能只是被覆盖的才丢失
		w：只写，内容全部丢失，如果不存在，则创建
		w+：读写，内容全部丢失，如果不存在，则创建
		b：以二进制打开，如图像
		
		--如果文件是URL，即别人的网页，则只能只读打开，即r，因为不能修改别人的网页
		--如果是ftp，则可以上传，写入，但不能同时开启读和写模式，
		
		返回值是：文件句柄
		
		if(!$file = fopen("img.gif", "rb"){
				echo("打不开文件");
			 }else{
				fpassthru($file); //把文件内容送到输出流，给浏览器直接，成功true，失败false
			 }
		
			 int fclose($file)--关闭文件，成功true，失败false
		
			 2、直接发送文件内容：
		
			 fpassthre($file_handle)：从文件当前位置开始读，读到文件尾，并且会自动关闭文件
			 readfile($filename)：也是直接发送到缓冲区，返回文件字节数
		
			 3、读取文件内容：
		
			 不想显示全部内容，或者文件需要某种解析时，
			 读取的函数基本都带一个附加作用，读到哪儿， 文件指针就指到哪儿
		
			 --String fread(文件句柄，字符个数length)
			 length超出时，就只读到文件尾
		
			 --fgetc()：读取当前位置的一个字符，然后下移一位
		
			 --fgets(文件句柄，字符串长度length)：
			 实际读取长度：length - 1，而且如果遇到换行，就停止，所以实际长度没法预测
		
			 --fgetss()：类似于fgets，但是读完之后，还会去掉html和php的标记字符串
		
			 --array file($filename)：一条龙函数，直接读取整个文件，数组的一个元素就是一行
			 $text = file("text.txt");
		
			 4、写入内容：
		
			 --fputs(句柄，写入内容，写入的字符串长度)
			 参数3默认是全部
		
			 --fwrite(句柄，写入内容，写入的字符串长度)
			 参数3默认是全部
			 
			 --file_put_contents($filename, $data)：简捷函数，将data字符串全部写入文件filename
			 --file_get_contents($filename); //返回文件所有内容string
			 --file($filename)：返回文件所有内容，array，一行是一个元素
		
			 5、文件指针操作：
		
			 --rewind(句柄)：把指针移到文件头，返回true或false
			 --fseek(句柄，偏移量, 相对位置)：参数3表示偏移量是相对于谁，SEEK_CUR－相对于当前位置，SEEK_END－从结尾开始算，参数2必须是负值， SEEK_SET－从头开始，默认
			 偏移量从0开始算，成功返回0，失败返回-1
			 --ftell(句柄)：当前指针位置，0表示在文件开始
			 --feof(句柄)：是否到文件尾了
			 while(!feof($file)){
				echo fgetc($file);
			 }
		
			 6、文件操作：
		
			 copy($from, $to); //to的文件可以不存在，但目录总得存在吧，没测过
		
			 unlink($filename)：永久删除
		
			 rename($oldname, $newname)：重命名
			 
			 ftruncate($filename, 截取长度)：将文件截取到指定长度
		
			 目录：
			 --int chdir($path)：设置path为当前目录
			 默认的当前目录是php脚本所在的目录
		
			 --int opendir($path)：打开目录，返回目录句柄
		
			 --string readdir($dir)：返回目录dir中的下一个条目
		
			 chdir('/temp');
			 $dir = opendir("."); //相对路径
			 while($file = readdir($dir){
			 		echo "$file<br />";
			 		}
		
			 		--rewinddir($dir)：回到目录头
			 		--closedir($dir)：关闭目录
		
			 		目录对象：
			 		chdir("/temp");
			 		$dir = dir(".");
			 		$dir->rewind();
			 		while($file = $dir->read()){
			 		echo $file . "<br />";
			 		}
			 		$dir->close();
		
 		目录对象有两个只读属性：handle，即目录句柄，path即路径

 		其他目录操作：
 		--mkdir(目录路径，mode）：创建目录
 				参数2：目录的操作权限，windows会忽略，就是0777那些，0755什么的，一般用8进制，0开头

 				--rmdir(路径)：删除目录，有权限且目录为空，就可以

 				7、文件属性访问：

 				--file_exist($filename)：是否存在

 				--filesize()：文件大小（字节）

 				--filetype()：返回文件类型
 				fifo：命名管道FIFO
 				char：字符专用设备
 				dir：目录
 				block：块专用设备
 				link：以符号表示的链接
 				file：标准文件
 				unknown：未知类型

 				--is_dir(), is_executable(), is_file(), is_link()
 				--is_readable(), is_writeable()

 				*/
	}

	public static function br(){
		echo "<br/>";
	}
	/**
	 * 格式化文件大小
	 * @param unknown $bytes
	 * @return string
	 */
	public static function formatFileSize($bytes){
		$return = "";
		$suffix = "";
		if($bytes >= pow(2, 40)){
			$return = round($bytes / pow(1024, 4), 2);
			$suffix = "TB";
		}else if($bytes >= pow(2, 30)){
			$return = round($bytes / pow(1024, 3), 2);
			$suffix = "GB";
		}else if($bytes >= pow(2, 20)){
			$return = round($bytes / pow(1024, 2), 2);
			$suffix = "MB";
		}else if($bytes >= pow(2, 10)){
			$return = round($bytes / pow(1024, 1), 2);
			$suffix = "MB";
		}else{
			$return = $bytes;
			$suffix = "Byte";
		}
		
		return $return . "" . $suffix;
	}
	
	/**
	 * 获取目录大小
	 * @param unknown $dirname
	 * @return number
	 */
	public static function getDirSize($dirname){
		$dir_size = 0;
		if($dir = @opendir($dirname)){
			
			while($filename = readdir($dir)){
				
				if($filename != "." && $filename != ".."){
					$subFile = $dirname . "/" . $filename;
					if(is_dir($subFile)){
						$dir_size += CCFile::getDirSize($subFile);
					}
					
					if(is_file($subFile)){
						$dir_size += filesize($subFile);
					}
				}
				
			}
			closedir($dir);
			return $dir_size;
		}
	}
	
	/**
	 * 清空并删除指定目录，相当于命令行 rm -rf
	 * @param unknown $dirname 指定目录
	 */
	public static function deleteDir($dirname)
	{
		if(file_exists($dirname)){
			if($dir = @opendir($dirname)){
				
				while($filename = readdir($dir)){
					
					if($filename != "." && $filename != ".."){
						$subFile = $dirname . "/" . $filename;
						if(is_dir($subFile)){
							CCFile::deleteDir($subFile);
						}
						
						if(is_file($subFile)){
							unlink($subFile);
						}
					}
					
				}
				closedir($dir);
				rmdir($dirname);
			}
		}
	}
	
	/**
	 * 拷贝目录，src为要拷贝的目录，dest为拷贝到哪个目录下（不存在会自动创建）
	 * @param unknown $src
	 * @param unknown $dest
	 * 
	 * 用法：
	 * copyDir("./phoMyAdmin", "D:/admin");
	 */
	public static function copyDir($src, $dest){
		if(is_file($dest)){
			echo "目标不是目录不能创建";
			return;
		}
		
		if(!file_exists($dest)){
			mkdir($dest);
		}
		
		if(is_file($src)){
			copy($src, $dest);
			return;
		}
		
		if($dir = @opendir($src)){
			while($filename = readdir($dir)){
				if($filename != "." && $filename != ".."){
					$subSrcFile = $src . "/" . $filename;
					$subToFile = $dest . "/" . $filename;
					
					if(is_dir($subSrcFile)){
						CCFile::copyDir($subSrcFile, $subToFile);
					}
					
					if(is_file($subSrcFile)){
						copy($subSrcFile, $subToFile);
					}
				}
				
			}
			closedir($dir);
		}
		
	}
	
	/**
	 * 
	 * @param unknown $part_path
	 * @return string
	 */
	public static function getFileInRoot($part_path){
		static $dir_name = "cowthan-php";
		return $_SERVER["DOCUMENT_ROOT"] . "/" . $dir_name . "/" . $part_path;
	}
	
	public static function getTitleOfWebPage($url){
		$file = fopen($url, "r") or die("打开远程文件失败");
		while(!feof($file)){
			$line = fgets($file, 1024);
			if(preg_match("/<title>(.*)<\/title>/", $line, $out)){
				$title = $out[1];
				break;
			}
		}
		fclose($file);
		return $title;
	}
}
?>