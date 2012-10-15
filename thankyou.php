<?

$tweetText = array(
						'Did you hear? @StationCasinos is giving away #100VegasRooms this month! Enter to win: ',
				);
$rand = rand(0, count($tweetText)-1);

$tweetData = $tweetText[$rand];

$properties = array(
		'64061651400' => array('name' => "Station Casinos", 'url' => 'https://www.facebook.com/stationcasinos?sk=app_257451507634202'),
		'165106597073' => array('name' => "Texas Station", 'url' => 'https://www.facebook.com/texasstation?sk=app_257451507634202'),
		'53201180527' => array('name' => "Sunset Station", 'url' => 'https://www.facebook.com/sunsetstation?sk=app_257451507634202'),
		'157108104327456' => array('name' => "Santa Fe Station", 'url' => 'https://www.facebook.com/SantaFeStation?sk=app_257451507634202'),
		'52412782331' => array('name' => "Palace Station", 'url' => 'https://www.facebook.com/palacestation?sk=app_257451507634202'),
		'165791767689' => array('name' => "Boulder Station", 'url' => 'https://www.facebook.com/boulderstation?sk=app_257451507634202'),
		'47094012308' => array('name' => "Aliante Station", 'url' => 'https://www.facebook.com/aliantestation?sk=app_257451507634202'),
		'44758789266' => array('name' => "Green Valley Ranch", 'url' => 'https://www.facebook.com/greenvalleyranch?sk=app_257451507634202'),
		'119039581451551' => array('name' => "Fiesta Casinos", 'url' => 'https://www.facebook.com/fiestacasinos?sk=app_257451507634202'),
		'54202046498' => array('name' => "Red Rock", 'url' => 'https://www.facebook.com/RedRock?sk=app_257451507634202')
	);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta https-equiv="Content-Type" content="text/html; charset=utf-8" />
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
			 name: 'Win one of 100 Free 2-Night Stays in Vegas!',
			 link: '<?=$properties[$_GET['pageid']]['url']?>',
			 picture: 'https://www.stationcasinos.com/images/room_share2.jpg',
			 caption: 'Station Casinos is Giving Thanks',
			 description: 'You could win one of 100 Free 2-night stays in Las Vegas! Enter on any – or all of 10 Station Casinos Facebook Pages in November.',
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
	color: #8e670a;
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
p {
	margin-bottom: 12px;
}
</style>
</head>

<body>

<div id="container">
<?
//setup facebook app
$app_id = "257451507634202";

require_once("../facebook.php");

$config['appid'] = $app_id;
$config['secret'] = "4e783c752d2aa0dcb2a7c78adfd78272";

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


?>

<img src="images/giving-thanks-header.jpg" alt="Stations Casino Giving Thanks giveaway" style="display:block;" />
    
	<div class="content" style="padding-bottom:20px;border-bottom:1px solid black;text-align:center;">
    	<h1>Thanks for entering.</h1>
        <p style="text-align:left">We will notify the winners of our Giving Thanks giveaway via email in the first week of December, 2011. If you are a winner, you will receive an email with detailed instructions on how to claim your prize.</p>
        <p style="text-align:left">Participants will be reminded on Facebook when winners have been chosen, and to check your email to see if you are a winner.</p>
         <p style="text-align:left">Here is a tip: Increase your chances of winning by entering on any or all of our 10 Hotel & Casino Facebook Pages! Just click on the logos below. <br /><br />
         Don't forget to share and encourage your friends to sign-up. Hey, Vegas vacations make great gifts!
         </p>
        <div id="social" style="margin:30px auto 30px auto;width:225px;">
        	<div id="twitter">
            	<iframe allowtransparency="true" frameborder="0" scrolling="no" src="https://platform.twitter.com/widgets/tweet_button.html?url=<?=rawurlencode($properties[$_GET['pageid']]['url'])?>&text=<?=rawurlencode($tweetData)?>&count=none" style="width:65px; height:22px;"></iframe>
            	<!--<a href="http://twitter.com/share" class="twitter-share-button" data-text="<?=$tweetData?>" data-url="<?=$properties[$signed_request['page']['id']]['url']?>" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>-->
            </div>
            <div id="fb_like">
            	<fb:like href="https://www.facebook.com/stationcasinos?sk=app_257451507634202" send="false" layout="button_count" width="90" show_faces="false" font="arial"></fb:like>
            </div>
            <div id="fb_share">
            	<img src="images/button_share_whitebg.gif" height="20" width="58" alt="Share" class="fbshare" />
            </div>
            <br class="clear" />
        </div>
        <br class="clear" />
    </div>
    
    <div class="content" style="text-align:center;">
    	<a href="https://www.facebook.com/stationcasinos?sk=app_210231899020925" target="_blank"><img src="images/logo.jpg" height="48" width="169" alt="Station Casinos" /></a><br />
<br />
        <p style="margin-bottom:12px;">For 35 years, we have been proud to operate some of the best resorts and casinos in Las Vegas. Make sure you check out our other locations to see the fun things we have in store.</p>
        <img src="images/properties.jpg" alt="Station Casino Properties" width="446" height="100" border="0" usemap="#Social" />
        <map name="Social" id="Social">
          <area shape="rect" coords="1,6,100,48" href="https://www.facebook.com/RedRock?sk=app_257451507634202" target="_blank" alt="Red Rock" />
          <area shape="rect" coords="118,2,190,47" href="https://www.facebook.com/texasstation?sk=app_257451507634202" target="_blank" alt="Texas Station" />
          <area shape="rect" coords="198,2,269,51" href="https://www.facebook.com/greenvalleyranch?sk=app_257451507634202" target="_blank" alt="Green Valley Ranch" />
          <area shape="rect" coords="142,60,219,92" href="https://www.facebook.com/aliantestation?sk=app_257451507634202" target="_blank" alt="Aliante Station" />
          <area shape="rect" coords="60,51,134,96" href="https://www.facebook.com/boulderstation?sk=app_257451507634202" target="_blank" alt="Boulder Station" />
          <area shape="rect" coords="371,1,444,40" href="https://www.facebook.com/fiestacasinos?sk=app_257451507634202" target="_blank" alt="Fiesta Rancho" />
          <area shape="rect" coords="239,56,301,92" href="https://www.facebook.com/palacestation?sk=app_257451507634202" target="_blank" alt="Palace Station" />
          <area shape="rect" coords="321,54,395,93" href="https://www.facebook.com/sunsetstation?sk=app_257451507634202" target="_blank" alt="Sunset Station" />
          <area shape="rect" coords="287,2,361,42" href="https://www.facebook.com/SantaFeStation?sk=app_257451507634202" target="_blank" alt="Santa Fe Station" />
        </map>
        <br /><br /><br />
        <span style="font-size:9px;">&copy; 2011 Station Casinos. All Rights Reserved. <a href="https://www.facebook.com/note.php?note_id=10150462268809175 " target="_blank">CONTEST RULES</a></span>
    </div>
    
    <?
    if(!$like_status && $_GET['logged'] == "") {
		//fangate stuff here
		//echo '<img src="images/blank.gif" height="850" width="520" alt="" style="position:absolute;top:0px;left:0px;border:0" />';
		//echo '<img src="images/likegate.png" height="263" width="519" alt="" style="position:absolute;top:256px;left:0px;" />';
	}
	
	?>

</div>

<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
	FB.init({
		appId: '257451507634202', 
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
