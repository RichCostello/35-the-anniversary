<?
//setup facebook app
$app_id = "210231899020925";
//$canvas_page = "http://www.facebook.com/DwayneJohnson?sk=app_183222878395202";
//$auth_url = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($canvas_page) . "&scope=email,publish_stream";

require_once("../../common/facebook.php");

$config['appid'] = $app_id;
$config['secret'] = "2ac9e7a40662b2c507f0faeaa5a03e72";

$facebook = new Facebook(array(
				'appId'  => $config['appid'],
				'secret' => $config['secret'],
				'cookie' => true,
			));

$signed_request = $facebook->getSignedRequest();

//require_once("../../common/common_functions.php");

$page_admin = $signed_request["page"]["admin"];
$like_status = $signed_request["page"]["liked"];

//echo "<h1>" . $signed_request['page']['id'] . "</h1>";

//print_r($signed_request);
//exit;


/*

SIGNED REQUEST
Array ( [algorithm] => HMAC-SHA256 [expires] => 1309906800 [issued_at] => 1309903039 [oauth_token] => 210231899020925|2.AQBatW00kY8V9M35.3600.1309906800.0-126200176|4gMBK1RWYdujZ_6yE5_SOkO2RO8 
[page] => Array ( [id] => 216381761722875 [liked] => 1 [admin] => 1 ) [user] => Array ( [country] => us [locale] => en_US [age] => Array ( [min] => 21 ) ) [user_id] => 126200176 )

PAGE IDS

Digital Royalty Apps - 216381761722875
Station Casinos - 64061651400
*/

$tweetText = array(
						'Wow! @StationCasinos is giving away #100VegasRooms in July! Enter to win: ',
						'Did you hear? @StationCasinos to give away #100VegasRooms for their 35th Anniversary this month! Enter to win: ',
						'You can win free #Vegas rooms in July from @StationCasinos! #100VegasRooms. Here\'s how: '
				);
$rand = rand(0, count($tweetText)-1);

$tweetData = $tweetText[$rand];

$properties = array(
		'64061651400' => array('name' => "Station Casinos", 'url' => 'http://www.facebook.com/stationcasinos?sk=app_210231899020925'),
		'165106597073' => array('name' => "Texas Station", 'url' => 'http://www.facebook.com/texasstation?sk=app_210231899020925'),
		'53201180527' => array('name' => "Sunset Station", 'url' => 'http://www.facebook.com/sunsetstation?sk=app_210231899020925'),
		'157108104327456' => array('name' => "Santa Fe Station", 'url' => 'http://www.facebook.com/SantaFeStation?sk=app_210231899020925'),
		'52412782331' => array('name' => "Palace Station", 'url' => 'http://www.facebook.com/palacestation?sk=app_210231899020925'),
		'165791767689' => array('name' => "Boulder Station", 'url' => 'http://www.facebook.com/boulderstation?sk=app_210231899020925'),
		'47094012308' => array('name' => "Aliante Station", 'url' => 'http://www.facebook.com/aliantestation?sk=app_210231899020925'),
		'44758789266' => array('name' => "Green Valley Ranch", 'url' => 'http://www.facebook.com/greenvalleyranch?sk=app_210231899020925'),
		'119039581451551' => array('name' => "Fiesta Casinos", 'url' => 'http://www.facebook.com/fiestacasinos?sk=app_210231899020925'),
		'54202046498' => array('name' => "Red Rock", 'url' => 'http://www.facebook.com/RedRock?sk=app_210231899020925')
	);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" language="javascript"></script>
<link href="main.css" rel="stylesheet" type="text/css" />
<script src="/clients/common/js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
<link href="/clients/common/js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<script language="javascript">
$(document).ready(function() {
	$('.fbshare').click(function() {
		FB.ui(
		   {
			 method: 'feed',
			 name: 'Station Casinos 35th Anniversary Giveaway',
			 link: '<?=$properties[$signed_request['page']['id']]['url']?>',
			 picture: 'http://www.digitalroyaltyapps.com/clients/stations/35th/images/room_share2.jpg',
			 caption: 'Enter Now!',
			 description: 'At Station Casinos we are celebrating our 35th Anniversary with an exclusive fan giveaway. Enter to win 1 of 100 2-night stays (10 total 2-night giveaways from each of our 10 properties).',
			 message: ''
		   },
		   function(response) {
			 if (response && response.post_id) {
			   //alert('Post was published.');
			 } else {
			   //alert('Post was not published.');
			 }
		   }
		 );
	});
	
	$(".details").fancybox({
		'width'				: 443,
		'height'			: 388,
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
});

function checkForm() {
	
	var first = $('#first').val();
	var last = $('#last').val();
	var email = $('#email').val();
	var zip = $('#zip').val();
	
	if(first == "" || first == "FIRST NAME") {
		alert("Please enter your first name.");
		return false;
	}
	if(last == "" || last == "LAST NAME") {
		alert("Please enter your last name.");
		return false;
	}
	if(email == "" || email == "EMAIL ADDRESS") {
		alert("Please enter your email address.");
		return false;
	}
	if(zip == "" || zip == "ZIP CODE") {
		alert("Please enter your zip code.");
		return false;
	}
	
	if(!$("input[name='Check box 21']").is(":checked")) {
		alert("Please verify you are 21 or over.");
		return false;
	}
	return true;
	
}

</script>
<style>
* {
	margin: 0;
	padding: 0;
}
body {
	width: 520px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000;
}
#container {
	position: relative;
	width: 520px;
	overflow: hidden;
}
.content {
	width: 480px;
	margin: 0px auto;
	margin-bottom: 30px;
}
.clear {
	display: block;
	height: 0px;
	clear: both;
}
h1 {
	color: red;
	font-size: 17px;
	margin-bottom: 6px;
}
#social {
	margin-top: 10px;
}
#twitter {
	float: left;
	width: 65px;
}
#fb_like {
	float: left;
	width: 90px;
	display: none;
}
#fb_share {
	float: left;
	width: 60px;
}
.fbshare {
	cursor: pointer;
}
img {
	border: 0;
}
.field {
	background-color: #f3f3f5;
	border: 1px solid #525352;
	font-size: 13px;
	padding: 3px 5px;
	width: 220px;
	text-align: center;
	margin-bottom: 13px;
}
a, a:active, a:visited {
	color:#0072bc;
}
a:hover {
	color: #ccc;
}
</style>
</head>

<body>

<div id="container">

<img src="images/header.jpg" height="160" width="520" alt="Stations Casino 35th Anniversary giveaway" style="display:block;" />

<div class="content">
		<img src="images/room2.jpg" style="float:right;margin-left:18px;border:1px solid black;" />
        <h1>Exclusive Fan Giveaway</h1>
      	<p style="font-size:17px;line-height:23px;">10 - 2-night stays at <br />one of our Las Vegas <br />Hotels & Casinos.<br />
        Enter below to win.<br />
        <a href="details.html" class="details">Click for details</a>.</p>
        <div id="social">
        	<div id="twitter">
            	<iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?url=<?=rawurlencode($properties[$signed_request['page']['id']]['url'])?>&text=<?=rawurlencode($tweetData)?>&count=none" style="width:65px; height:22px;"></iframe>
            	<!--<a href="http://twitter.com/share" class="twitter-share-button" data-text="<?=$tweetData?>" data-url="<?=$properties[$signed_request['page']['id']]['url']?>" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>-->
            </div>
            <div id="fb_like">
            	<fb:like href="<?=$properties[$signed_request['page']['id']]['url']?>" send="false" layout="button_count" width="90" show_faces="false" font="arial"></fb:like>
            </div>
            <div id="fb_share">
            	<img src="/clients/common/images/button_share_whitebg.gif" height="20" width="58" alt="Share" class="fbshare" />
            </div>
        </div>
        <br class="clear" />
    </div>
    
<div class="content" style="padding-bottom:20px;border-bottom:1px solid black;">
    	<form id="subscribeForm" action="http://cl.exct.net/subscribe.aspx?lid=120158"  name="subscribeForm" method="post" onsubmit="return checkForm();">
        	<input type="hidden" name="thx" value="http://www.digitalroyaltyapps.com/clients/stations/35th/thankyou.php?pageid=<?=$signed_request['page']['id']?>" />  
            <input type="hidden" name="err" value="http://www.digitalroyaltyapps.com/clients/stations/35th/error.php?pageid=<?=$signed_request['page']['id']?>" />  
            <input type="hidden" name="usub" value="http://www.digitalroyaltyapps.com/clients/stations/35th/index.php" />  
            <input type="hidden" name="MID" value="1032124" />
        	<input type="text" class="field" value="FIRST NAME" onclick="if(this.value=='FIRST NAME') this.value='';" onblur="if(this.value=='') this.value='FIRST NAME';" name="First name" id="first" style="float:left;margin-right:10px;" />
            <input type="text" class="field" value="LAST NAME" onclick="if(this.value=='LAST NAME') this.value='';" onblur="if(this.value=='') this.value='LAST NAME';" name="Last name" id="last" />
            <br class="clear" />
            <input type="text" class="field" value="EMAIL ADDRESS" onclick="if(this.value=='EMAIL ADDRESS') this.value='';" onblur="if(this.value=='') this.value='EMAIL ADDRESS';" name="Email Address" id="email" style="float:left;margin-right:10px;" />
            <input type="text" class="field" value="ZIP CODE" onclick="if(this.value=='ZIP CODE') this.value='';" onblur="if(this.value=='') this.value='ZIP CODE';" name="Zip Code" id="zip" />
            <input type="hidden" name="Hidden Field" id="hf" value="<?=$properties[$signed_request['page']['id']]['name']?>" />
            <br class="clear" />
            <p style="text-align:center;margin-bottom:10px;">ALL FIELDS ARE MANDATORY.</p>
            <p style="text-align:center;margin-bottom:10px;"><span style="font-size:9px;">By checking the box you confirm you are 21+ years of age.</span> <input type="checkbox" name="Check box 21" id="Check box 21" value="Yes I am 21" />
            &nbsp; &nbsp;<input type="image" src="images/button_enter.jpg" height="23" width="88" alt="Submit" style="margin-bottom:-4px;" /></p>
            <p style="text-align:center;margin-bottom:10px;"><a href="https://www.facebook.com/note.php?note_id=10150326667054175" target="_blank">Contest Rules</a></p>
        </form>
    </div>
    
    <div class="content" style="text-align:center;">
    	<a href="http://www.facebook.com/stationcasinos"><img src="images/logo.jpg" height="48" width="169" alt="Station Casinos" /></a><br />
<br />
        <p style="margin-bottom:12px;">For 35 years, we have been proud to operate some of the best resorts and casinos in Las Vegas. Make sure you check out our other locations to see the fun things we have in store.</p>
        <img src="../ufc_promo/images/properties.jpg" alt="Station Casino Properties" width="446" height="100" border="0" usemap="#Social" />
        <map name="Social" id="Social">
          <area shape="rect" coords="1,6,100,48" href="http://www.facebook.com/RedRock " target="_blank" alt="Red Rock" />
          <area shape="rect" coords="118,2,190,47" href="https://www.facebook.com/texasstation" target="_blank" alt="Texas Station" />
          <area shape="rect" coords="198,2,269,51" href="https://www.facebook.com/greenvalleyranch" target="_blank" alt="Green Valley Ranch" />
          <area shape="rect" coords="142,60,219,92" href="https://www.facebook.com/aliantestation" target="_blank" alt="Aliante Station" />
          <area shape="rect" coords="60,51,134,96" href="https://www.facebook.com/boulderstation" target="_blank" alt="Boulder Station" />
          <area shape="rect" coords="371,1,444,40" href="https://www.facebook.com/fiestacasinos" target="_blank" alt="Fiesta Rancho" />
          <area shape="rect" coords="239,56,301,92" href="https://www.facebook.com/palacestation" target="_blank" alt="Palace Station" />
          <area shape="rect" coords="321,54,395,93" href="https://www.facebook.com/sunsetstation" target="_blank" alt="Sunset Station" />
          <area shape="rect" coords="287,2,361,42" href="https://www.facebook.com/SantaFeStation" target="_blank" alt="Santa Fe Station" />
        </map>
        <br /><br /><br />
        <span style="font-size:9px;">&copy; 2011 Station Casinos. All Rights Reserved. <a href="https://www.facebook.com/note.php?note_id=10150326667054175" target="_blank">CONTEST RULES</a></span>
    </div>
    
    <?
    if(!$like_status && $_GET['logged'] == "") {
		//fangate stuff here
		echo '<img src="images/blank.gif" height="850" width="520" alt="" style="position:absolute;top:0px;left:0px;border:0" />';
		echo '<img src="images/likegate.png" height="263" width="519" alt="" style="position:absolute;top:256px;left:0px;" />';
	}
	
	?>

</div>

<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
	FB.init({
		appId: '210231899020925', 
		status: true, 
		cookie: true,
		xfbml: true
	});
	FB.Canvas.setAutoResize(100);
};
(function() {
	var e = document.createElement('script'); e.async = true;
	e.src = document.location.protocol +
	'//connect.facebook.net/en_US/all.js';
	document.getElementById('fb-root').appendChild(e);
}());
</script>

</body>
</html>
