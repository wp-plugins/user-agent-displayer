<?php
/*
Plugin Name: User Agent Displayer
Plugin URI: http://www.7sal.com/user-agent-displayer/
Description: this plug-in displays the Browser and Platform of user who commented in your blog. it is capable of determining the version of the borwser.it supports the following browsers and platforms.<br /><b>Browsers:</b>, Firefox, Microsoft IE, Opera, Opera Mini, Safari, Chrome, Chromium, WebTV, Galeon, iCab, omniweb, Amaya, FireBird, Maxthon, Avant, Camino, Shiira, Galeon, Epiphany, K-Meleon, Lunascape, Konqueror, Orca. <br /><b>Platforms:</b>, Windows, GNU/Linux, MacIntosh, OS/2, BeOS, Java.<br /><cite>this plugin is still in beta testing. use it at your own risk.</cite>
Author: Hamed Momeni
Version: 1.6
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
        if (stripos($agent,'win')){
            $bd['platform'] = "Windows";
	    if(stripos($agent,'NT 6.1'))
            $val = '7';
            elseif(stripos($agent,'NT 6.0'))
            $val = 'Vista';
            elseif(stripos($agent,'NT 5.2'))
            $val = 'XP 64-bit/Server 2003';
            elseif(stripos($agent,'NT 5.1'))
            $val = 'XP';
            elseif(stripos($agent,'NT 5.01'))
            $val = '2000 SP1';
            elseif(stripos($agent,'NT 5.0'))
            $val = '2000';
            $bd['pver'] = $val;
            }
        elseif (stripos($agent,'mac'))
            $bd['platform'] = "MacIntosh";
        elseif (stripos($agent,'linux'))
            $bd['platform'] = "GNU/Linux";
        elseif (stripos($agent,'OS/2'))
            $bd['platform'] = "OS/2";
        elseif (stripos($agent,'BeOS'))
            $bd['platform'] = "BeOS";
        elseif (stripos($agent,'j2me'))
            $bd['platform'] = 'Java';

        // test for Opera        
        if (stripos($agent,'opera') === 0){
        	if(stristr($agent,'opera mini')){ // test for Opera Mini
        		$bd['browser'] = "Opera Mini";
        		$val = explode('Mini',$agent);
        		$val = explode('.',$val[1]);
        		$bd['version'] = $val[0].'.'.$val[1];
        		}else{
        		if(stripos($agent,'version/10')){ // test for Opera 10
        		$bd['browser'] = 'Opera';
        		$bd['version'] = '10';
        		}else{
            $val = stristr($agent, "opera");
                $val = explode("/",$val);
                $bd['browser'] = $val[0];
                $val = explode(" ",$val[1]);
                $bd['version'] = $val[0];
                }
            }
        }elseif(stripos($agent,'k-meleon')){// test for K-Meleon
        	$bd['browser'] = 'K-Meleon';
        	$val = explode('K-Meleon',$agent);
        	$bd['version'] = $val[1];
        }elseif(stripos($agent,'shiira')){// test for Shiira
        	$bd['browser'] = 'Shiira';
        	$val = explode('Shiira',$agent);
        	$val = explode(" ",$val[1]);
        	$bd['version'] = $val[0];
        }elseif(stripos($agent,'galeon')){// test for Galoen
        	$bd['browser'] = "Galeon";
        	$val = explode('Galeon',$agent);
        	$val = explode(" ",$val[1]);
        	$bd['version'] = $val[0];
        }elseif(stripos($agent,'epiphany')){// test for Epiphany
        	$bd['browser'] = 'Epiphany';
        	$val = explode('Epiphany',$agent);
        	$val = explode(" ",$val[1]);
        	$bd['version'] = $val[0];
        }elseif(stripos($agent,'camino')){// test for Camino
        	$bd['browser'] = 'Camino';
        	$val = explode('Camino',$agent);
        	$val = explode(' ',$val[1]);
        	$bd['version'] = $val[0];
        }elseif(stripos($agent,'avant')){// test for Avant Browser
        	$bd['browser'] = 'Avant';
        	$bd['version'] = 'Browser';
        }elseif(stripos($agent,'maxthon')){// test for Maxthon
		$bd['browser'] = 'Maxthon';
		$val = explode('MAXTHON',$agent);
		$val = explode(";",$val[1]);
		$bd['version'] = $val[0];
	}elseif(stripos($agent,'Flock')){// test  for Flock
        	$bd['browser'] = 'Flock';
        	$val = explode('Flock',$agent);
        	$bd['version'] = $val[1];
        }elseif(stripos($agent,'iphone')){//test for iPhone
        	$bd['browser'] = 'Safari';
        	$val = explode('Safari',$agent);
        	$bd['version'] = $val[1];
        	$bd['platform'] = 'iPhone';
        }elseif(stripos($agent,'lunascape')){ //test for Lunascape
        	$bd['browser'] = 'Lunascape';
        	$val = explode("lunascape",strtolower($agent));
        	$bd['version'] = $val[1];
        }elseif(stripos($agent,'konqueror')){ // test for Konqueror
        	$bd['browser'] = "Konqueror";
        	$val = explode('Konqueror',$agent);
        	$val = explode(";",$val[1]);
        	$bd['version'] = $val[0];
        }elseif(stripos($agent,'orca')){ // test for Orca
        	$bd['browser'] = 'Orca';
        	$val = explode('Orca',$agent);
        	$bd['version'] = $val[1];
        }elseif(stripos($agent,'webtv')){// test for WebTV
            $val = explode("/",stristr($agent,"webtv"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        
        // test for MS Internet Explorer version 1
        }elseif(stripos($agent,'microsoft internet explorer')){
            $bd['browser'] = "IE";
            $bd['version'] = "1.0";
            $var = stristr($agent, "/");
            if (ereg("308|425|426|474|0b1", $var)){
                $bd['version'] = "1.5";
            }

        // test for NetPositive
        }elseif(stripos($agent,'NetPositive')){
            $val = explode("/",stristr($agent,"NetPositive"));
            $bd['platform'] = "BeOS";
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for MS Internet Explorer
        }elseif(stripos($agent,'msie') && !stripos($agent,'opera')){
            $val = explode(" ",stristr($agent,"msie"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        
        // test for MS Pocket Internet Explorer
        }elseif(stripos($agent,'mspie') || stripos($agent,'pocket')){
            $val = explode(" ",stristr($agent,"mspie"));
            $bd['browser'] = "MSPIE";
            $bd['platform'] = "WindowsCE";
            if (stripos($agent,'mspie'))
                $bd['version'] = $val[1];
            else {
                $val = explode('/',$agent);
                $bd['version'] = $val[1];
            }
            
        // test for Galeon
        }elseif(stripos($agent,'galeon')){
            $val = explode(" ",stristr($agent,"galeon"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
            
        // test for Konqueror
        }elseif(stripos($agent,'Konqueror')){
            $val = explode(" ",stristr($agent,"Konqueror"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
            
        // test for iCab
        }elseif(stripos($agent,'icab')){
            $val = explode(" ",stristr($agent,"icab"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for OmniWeb
        }elseif(stripos($agent,'omniweb')){
            $val = explode("/",stristr($agent,"omniweb"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        }elseif(stripos($agent,'chrome')){// test for Google Chrome and Chromium
        	if(stripos($agent,'linux')){
        	$bd['browser'] = 'Chromium';
        	}else{
        	$bd['browser'] = "Chrome";
        	}
        	$val = explode('Chrome',$agent);
        	$val = explode(" ",$val[1]);
        	$bd['version'] = $val[0];
        }elseif(stripos($agent,'Phoenix')){// test for Phoenix
            $bd['browser'] = "Phoenix";
            $val = explode("/", stristr($agent,"Phoenix/"));
            $bd['version'] = $val[1];
        
        // test for Firebird
        }elseif(stripos($agent,'firebird')){
            $bd['browser']="Firebird";
            $val = stristr($agent, "Firebird");
            $val = explode("/",$val);
            $bd['version'] = $val[1];
        
        }elseif(stripos($agent,'shiretoko')){ // test for Shiretoko
        	$bd['browser'] = 'Shiretoko';
        	$val = explode('Shiretoko',$agent);
        	$bd['version'] = $val[1];    
        // test for Firefox
        }elseif(stripos($agent,'Firefox')){
            $bd['browser']="Firefox";
            $val = stristr($agent, "Firefox");
            $val = explode("/",$val);
            $bd['version'] = $val[1];
            
      // test for Mozilla Alpha/Beta Versions
        }elseif(stripos($agent,'mozilla') && 
            stripos($agent,'rv:[0-9].[0-9][a-b]') && !stripos($agent,'netscape')){
            $bd['browser'] = "Mozilla";
            $val = explode(" ",stristr($agent,"rv:"));
            stripos($agent,'rv:[0-9].[0-9][a-b]',$val);
            $bd['version'] = str_replace("rv:","",$val[0]);
            
        // test for Mozilla Stable Versions
        }elseif(stripos($agent,'mozilla') &&
            stripos($agent,'rv:[0-9]\.[0-9]') && !stripos($agent,'netscape')){
            $bd['browser'] = "Mozilla";
            $val = explode(" ",stristr($agent,"rv:"));
            stripos($agent,'rv:[0-9]\.[0-9]\.[0-9]',$val);
            $bd['version'] = str_replace("rv:","",$val[0]);
        
        // test for Lynx & Amaya
        }elseif(stripos($agent,'libwww')){
            if (stripos($agent,'amaya')){
                $val = explode("/",stristr($agent,"amaya"));
                $bd['browser'] = "Amaya";
                $val = explode(" ", $val[1]);
                $bd['version'] = $val[0];
            } else {
                $val = explode('/',$agent);
                $bd['browser'] = "Lynx";
                $bd['version'] = $val[1];
            }
        
        // test for Safari
        }elseif(stripos($agent,'safari')){
            $bd['browser'] = "Safari";
            $bd['version'] = "";

        // remaining two tests are for Netscape
        }elseif(stripos($agent,'netscape')){
            $val = explode(" ",stristr($agent,"netscape"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        }elseif(stripos($agent,'mozilla') && !stripos($agent,'rv:[0-9]\.[0-9]\.[0-9]')){
            $val = explode(" ",stristr($agent,"mozilla"));
            $val = explode("/",$val[0]);
            $bd['browser'] = "Netscape";
            $bd['version'] = $val[1];
        }
        
        // clean up extraneous garbage that may be in the name
        $bd['browser'] = ereg_replace("[^a-z,A-Z,-]", "", $bd['browser']);
        // clean up extraneous garbage that may be in the version        
        $bd['version'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $bd['version']);
        
        // check for AOL
        if (stripos($agent,'AOL')){
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
function br_img($browser,$ver,$id){
$browseri = ereg_replace("[^a-z,A-Z,-]", "", $browser);
return '<img src="'.get_option('siteurl').'/wp-content/plugins/user-agent-displayer/img/24/net/'.strtolower($browseri).'.png" alt="'.$browser.' '.$ver.'" title="'.$browser.' '.$ver.'" onmouseover="display_uad('.$id.');" onmouseout="hide_uad('.$id.');">';
}
function os_img($os,$pver,$id){
$osi = ereg_replace("[^a-z,A-Z,-]", "", $os);
return '<img src="'.get_option('siteurl').'/wp-content/plugins/user-agent-displayer/img/24/os/'.strtolower($osi).'.png" alt="'.$os.' '.$pver.'" title="'.$os.' '.$pver.'" onmouseover="display_uad('.$id.');" onmouseout="hide_uad('.$id.');">';
}

function display_bf(){
global $comment;
$user = new browser($comment->comment_agent);
$uad = br_img($user->Name,$user->Version,$comment->comment_ID);
$uad .= os_img($user->Platform,$user->Pver,$comment->comment_ID);
$uad .= '<div id="useragents'.$comment->comment_ID.'" style="display:none;direction:rtl;text-align:left;"><b>User Agent:</b> '.$comment->comment_agent.'</div>';
return $uad;
}
function uad_dis(){
echo display_bf();
apply_comment_filters();
add_filter('comment_text', 'uad_dis');
}
function apply_comment_filters(){
	global $comment;
	remove_filter('comment_text', 'uad_dis');
	apply_filters('get_comment_text', $comment->comment_content);
	echo apply_filters('comment_text', $comment->comment_content);
}
add_filter('comment_text', 'uad_dis');
function uad_style(){
echo '<script>
function display_uad(id){
document.getElementById(\'useragents\'+id).style.display= \'block\';
}
function hide_uad(id){
document.getElementById(\'useragents\'+id).style.display= \'none\';
}
</script>';
}
add_filter('wp_head','uad_style');
/*add_action('admin_menu', 'uadmenu');
function uadmenu(){
	add_options_page('UAD Options', 'User Agent Displayer', 10, 'user-agent-displayer', 'uado');
	}
function uado(){
echo 'user agent displayer';
}*/
?>
