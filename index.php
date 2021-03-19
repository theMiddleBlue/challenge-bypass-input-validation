<?php

	echo "This web application is vulnerable to RCE on <b>code</b> POST argument. Find a way to execute <b>cat /etc/passwd</b> bypassing input validation.<br>\n";
	echo "Example: curl -d 'code=id' http://".$_SERVER["HTTP_HOST"]."/index.php <br><br>\n\n";
	error_reporting(0);
	$blacklist = [
		"alias","eval","bash","sh","bin","usr","etc","pass","src","source","ls","nc","apt","cat","more","less","vi","vim"
	];
	if(!preg_match('#[;/"\'&|()\-:.\s\t\n`<>=]#', urldecode($_POST["code"]))) {
		$allowed = true;

		foreach($blacklist as $k => $v) {
			if(preg_match('#'.$v.'#', urldecode($_POST["code"]))) {
				$allowed = false;
			}
		}
		
		if($allowed) {
			print_r($_POST);
			system($_POST["code"]);	
		} else {
			echo "Input contains blacklisted common Unix commands or paths\n";
		}
	} else {
		echo "Character not allowed\n";
	}
?>