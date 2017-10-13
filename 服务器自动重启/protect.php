<?php
set_time_limit(0);
$vpsAry = file("vps.txt");
$batStr = PHP_EOL."cd /d %~dp0".PHP_EOL;
foreach($vpsAry as $vid=>$vps){
	$vps=trim($vps);
	if($vps==""||!strstr($vps,'----')||substr($vps,0,1)=="#") continue;
	$ip = trim(explode("----",$vps)[0]);
	$pw = trim(explode("----",$vps)[1]);
	$batStr .= PHP_EOL."echo {$ip}-start".PHP_EOL;
	$batStr .= "pscp -pw {$pw} 0000_DenyIP.zip root@{$ip}:/opt/lampp/htdocs/".PHP_EOL;
	$batStr .= "plink -pw {$pw} root@{$ip} \"cd /opt/lampp/htdocs;rm -rf /opt/lampp/htdocs/0000_DenyIP;unzip 0000_DenyIP.zip && rm -rf 0000_DenyIP.zip;chmod -R 777 /opt/lampp/htdocs/0000_DenyIP;/etc/init.d/cron stop; chmod -R 777 /run/crond.pid ;rm -rf /run/crond.pid;chmod -R 777 /etc/rsyslog.d; chmod -R 777 /var/spool/cron/crontabs; chmod -R 777 /run/crond.reboot; rm -rf /run/crond.reboot; /opt/lampp/bin/php /opt/lampp/htdocs/0000_DenyIP/DenyIP/cron.php; chmod -R 600 /var/spool/cron/crontabs/root;/etc/init.d/rsyslog restart; /etc/init.d/cron restart;/etc/init.d/cron restart;  /opt/lampp/bin/php make.php;\"".PHP_EOL;
	$batStr .= "echo {$ip}-finished".PHP_EOL;
}

$dir = dirname(__FILE__);
file_put_contents($dir."/temp.bat",$batStr);
sleep(2);
exec($dir."/temp.bat");
sleep(2);
unlink($dir."/temp.bat");
?>