<?php
/*
Plugin Name: User Agent Displayer
Plugin URI: http://www.7sal.com/user-agent-displayer/
Description: this plug-in displays the Browser and Platform of user who commented in your blog. it is capable of determining the version of the borwser.it supports the following browsers and platforms.<br /><b>Browsers:</b>, Firefox, Microsoft IE, Opera, Safari, Chrome, Chromium, WebTV, Galeon, Konqueror, iCab, omniweb, Amaya, FireBird, <br /><b>Platforms:</b>, Windows, GNU/Linux, MacIntosh, OS/2, BeOS.<br /><cite>this plugin is still in beta testing. use it at your own risk.</cite>
Author: Hamed Momeni
Version: 0.9 beta
Author URI: http://www.7sal.com
*/
class browser{

    var $Name = "Unknown";
    var $Version = "";
    var $Platform = "Unknown";
    var $Pver = "";
    var $Agent = "Not reported";
    var $AOL = false;

    public function browser($agent){
//        $agent = $_SERVER['HTTP_USER_AGENT'];

        // initialize properties
        $bd['platform'] = "Unknown";
        $bd['pver'] = "";
        $bd['browser'] = "Unknown";
        $bd['version'] = "";
        $this->Agent = $agent;

        // find operating system
        if (eregi("win", $agent)){
            $bd['platform'] = "Windows";
	    if(eregi("NT 6.1",$agent))
            $val = '7';
            elseif(eregi("NT 6.0",$agent))
            $val = 'Vista';
            elseif(eregi("NT 5.2",$agent))
            $val = 'XP 64-bit/Server 2003';
            elseif(eregi("NT 5.1",$agent))
            $val = 'XP';
            elseif(eregi("NT 5.01",$agent))
            $val = '2000 SP1';
            elseif(eregi("NT 5.0",$agent))
            $val = '2000';
            $bd['pver'] = $val;
            }
        elseif (eregi("mac", $agent))
            $bd['platform'] = "MacIntosh";
        elseif (eregi("linux", $agent))
            $bd['platform'] = "Linux";
        elseif (eregi("OS/2", $agent))
            $bd['platform'] = "OS2";
        elseif (eregi("BeOS", $agent))
            $bd['platform'] = "BeOS";
        elseif (eregi('j2me',$agent))
            $bd['platform'] = 'Java';

        // test for Opera        
        if (eregi("opera",$agent)){
        	if(eregi("opera mini",$agent)){ // test for Opera Mini
        		$bd['browser'] = "Opera Mini";
        		$val = explode('Mini',$agent);
        		$val = explode('.',$val[1]);
        		$bd['version'] = $val[0].'.'.$val[1];
        		}else{
            $val = stristr($agent, "opera");
            if (eregi("/", $val)){
                $val = explode("/",$val);
                $bd['browser'] = $val[0];
                $val = explode(" ",$val[1]);
                $bd['version'] = $val[0];
            }else{
                $val = explode(" ",stristr($val,"opera"));
                $bd['browser'] = $val[0];
                $bd['version'] = $val[1];
            }
            }

        
        }elseif(eregi("Flock",$agent)){// test  for Flock
        	$bd['browser'] = 'Flock';
        	$val = explode('Flock',$agent);
        	$bd['version'] = $val[1];
        }elseif(eregi('iphone',$agent)){//test for iPhone
        	$bd['browser'] = 'Safari';
        	$val = explode("Safari",$agent);
        	$bd['version'] = $val[1];
        	$bd['platform'] = 'iPhone';
        }elseif(eregi("lunascape",$agent)){ //test for Lunascape
        	$bd['browser'] = 'Lunascape';
        	$val = explode("lunascape",strtolower($agent));
        	$bd['version'] = $val[1];
        }elseif(eregi("konqueror",$agent)){ // test for Konqueror
        	$bd['browser'] = "Konqueror";
        	$val = explode("Konqueror",$agent);
        	$val = explode(";",$val[1]);
        	$bd['version'] = $val[0];
        }elseif(eregi('orca',$agent)){ // test for Orca
        	$bd['browser'] = 'Orca';
        	$val = explode('Orca',$agent);
        	$bd['version'] = $val[1];
        }elseif(eregi("webtv",$agent)){// test for WebTV
            $val = explode("/",stristr($agent,"webtv"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        
        // test for MS Internet Explorer version 1
        }elseif(eregi("microsoft internet explorer", $agent)){
            $bd['browser'] = "IE";
            $bd['version'] = "1.0";
            $var = stristr($agent, "/");
            if (ereg("308|425|426|474|0b1", $var)){
                $bd['version'] = "1.5";
            }

        // test for NetPositive
        }elseif(eregi("NetPositive", $agent)){
            $val = explode("/",stristr($agent,"NetPositive"));
            $bd['platform'] = "BeOS";
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for MS Internet Explorer
        }elseif(eregi("msie",$agent) && !eregi("opera",$agent)){
            $val = explode(" ",stristr($agent,"msie"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        
        // test for MS Pocket Internet Explorer
        }elseif(eregi("mspie",$agent) || eregi('pocket', $agent)){
            $val = explode(" ",stristr($agent,"mspie"));
            $bd['browser'] = "MSPIE";
            $bd['platform'] = "WindowsCE";
            if (eregi("mspie", $agent))
                $bd['version'] = $val[1];
            else {
                $val = explode("/",$agent);
                $bd['version'] = $val[1];
            }
            
        // test for Galeon
        }elseif(eregi("galeon",$agent)){
            $val = explode(" ",stristr($agent,"galeon"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
            
        // test for Konqueror
        }elseif(eregi("Konqueror",$agent)){
            $val = explode(" ",stristr($agent,"Konqueror"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
            
        // test for iCab
        }elseif(eregi("icab",$agent)){
            $val = explode(" ",stristr($agent,"icab"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for OmniWeb
        }elseif(eregi("omniweb",$agent)){
            $val = explode("/",stristr($agent,"omniweb"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for Phoenix
        }elseif(eregi("chrome",$agent)){
        	if(eregi('linux',$agent)){
        	$bd['browser'] = 'Chromium';
        	}else{
        	$bd['browser'] = "Chrome";
        	}
        	$val = explode('Chrome',$agent);
        	$val = explode(" ",$val[1]);
        	$bd['version'] = $val[0];
        }elseif(eregi("Phoenix", $agent)){
            $bd['browser'] = "Phoenix";
            $val = explode("/", stristr($agent,"Phoenix/"));
            $bd['version'] = $val[1];
        
        // test for Firebird
        }elseif(eregi("firebird", $agent)){
            $bd['browser']="Firebird";
            $val = stristr($agent, "Firebird");
            $val = explode("/",$val);
            $bd['version'] = $val[1];
            
        // test for Firefox
        }elseif(eregi("Firefox", $agent)){
            $bd['browser']="Firefox";
            $val = stristr($agent, "Firefox");
            $val = explode("/",$val);
            $bd['version'] = $val[1];
            
      // test for Mozilla Alpha/Beta Versions
        }elseif(eregi("mozilla",$agent) && 
            eregi("rv:[0-9].[0-9][a-b]",$agent) && !eregi("netscape",$agent)){
            $bd['browser'] = "Mozilla";
            $val = explode(" ",stristr($agent,"rv:"));
            eregi("rv:[0-9].[0-9][a-b]",$agent,$val);
            $bd['version'] = str_replace("rv:","",$val[0]);
            
        // test for Mozilla Stable Versions
        }elseif(eregi("mozilla",$agent) &&
            eregi("rv:[0-9]\.[0-9]",$agent) && !eregi("netscape",$agent)){
            $bd['browser'] = "Mozilla";
            $val = explode(" ",stristr($agent,"rv:"));
            eregi("rv:[0-9]\.[0-9]\.[0-9]",$agent,$val);
            $bd['version'] = str_replace("rv:","",$val[0]);
        
        // test for Lynx & Amaya
        }elseif(eregi("libwww", $agent)){
            if (eregi("amaya", $agent)){
                $val = explode("/",stristr($agent,"amaya"));
                $bd['browser'] = "Amaya";
                $val = explode(" ", $val[1]);
                $bd['version'] = $val[0];
            } else {
                $val = explode("/",$agent);
                $bd['browser'] = "Lynx";
                $bd['version'] = $val[1];
            }
        
        // test for Safari
        }elseif(eregi("safari", $agent)){
            $bd['browser'] = "Safari";
            $bd['version'] = "";

        // remaining two tests are for Netscape
        }elseif(eregi("netscape",$agent)){
            $val = explode(" ",stristr($agent,"netscape"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        }elseif(eregi("mozilla",$agent) && !eregi("rv:[0-9]\.[0-9]\.[0-9]",$agent)){
            $val = explode(" ",stristr($agent,"mozilla"));
            $val = explode("/",$val[0]);
            $bd['browser'] = "Netscape";
            $bd['version'] = $val[1];
        }
        
        // clean up extraneous garbage that may be in the name
        $bd['browser'] = ereg_replace("[^a-z,A-Z]", "", $bd['browser']);
        // clean up extraneous garbage that may be in the version        
        $bd['version'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $bd['version']);
        
        // check for AOL
        if (eregi("AOL", $agent)){
            $var = stristr($agent, "AOL");
            $var = explode(" ", $var);
            $bd['aol'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $var[1]);
        }
        
        // finally assign our properties
        $this->Name = $bd['browser'];
        $this->Version = $bd['version'];
        $this->Platform = $bd['platform'];
        $this->Pver = $bd['pver'];
        $this->AOL = $bd['aol'];
    }
}
function br_img($browser,$ver){
return '<img src="'.get_option('siteurl').'/wp-content/plugins/user-agent-displayer/img/24/net/'.strtolower($browser).'.png" alt="'.$browser.' '.$ver.'" title="'.$browser.' '.$ver.'">';
}
function os_img($os,$pver){
return '<img src="'.get_option('siteurl').'/wp-content/plugins/user-agent-displayer/img/24/os/'.strtolower($os).'.png" alt="'.$os.' '.$pver.'" title="'.$os.' '.$pver.'">';
}
function display_bf(){
global $comment;
$user = new browser($comment->comment_agent);
echo br_img($user->Name,$user->Version);
echo os_img($user->Platform,$user->Pver);
echo '<p>';
echo $comment->comment_content;
echo '</p>';
}
add_filter('get_comment_text','display_bf');
?>
