<?
if(ereg($_SERVER['HTTP_HOST'],$CONF['media_url'])) {
	ob_start();
	print_r($_SERVER);
	$tmp = ob_get_contents();
	ob_end_clean();
	mail("will@netmindz.net","shop eak",$tmp);
}

$template_root = "http://sandbox.ralf.netmindz.net";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >
	<head>
		  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php if(isset($page_title)) { print $page_title; } else { ?>inSpiral Shop<?php } ?></title>
<meta name="verify-v1" content="x0mbN0j6nJtcxY6kdrj+NoXpprraAAWQqDAM0Oo19T4=" />
<meta name="robots" content="index, follow" />
<link rel="shortcut icon" href="http://www.inspiralled.net/images/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php if(isset($page_meta)) { ?><meta name="description" content="<?= $page_meta ?>" /><?php } ?>

  <link rel="stylesheet" href="<?= $template_root ?>/plugins/system/rokbox/themes/light/rokbox-style.css" type="text/css" />
  <link rel="stylesheet" href="<?= $template_root ?>/templates/rt_infuse_j15/css/template.css" type="text/css" />
  <link rel="stylesheet" href="<?= $template_root ?>/templates/rt_infuse_j15/css/style1.css" type="text/css" />
  <link rel="stylesheet" href="<?= $template_root ?>/templates/rt_infuse_j15/css/typography.css" type="text/css" />
  <link rel="stylesheet" href="<?= $template_root ?>/templates/system/css/system.css" type="text/css" />
  <link rel="stylesheet" href="<?= $template_root ?>/templates/system/css/general.css" type="text/css" />


  <link rel="stylesheet" href="<?= $template_root ?>/templates/rt_infuse_j15/css/menu-fusion.css" type="text/css" />
  <style type="text/css">
    <!--

	div.wrapper { margin: 0 auto; width: 982px;padding:0;}
	body { min-width:982px;}
	#inset-block-left { width:0px;padding:0;}
	#inset-block-right { width:0px;padding:0;}
	#maincontent-block { margin-right:0px;margin-left:0px;}
	
	.s-c-s .colmid { left:280px;}
	.s-c-s .colright { margin-left:-510px;}
	.s-c-s .col1pad { margin-left:510px;}
	.s-c-s .col2 { left:230px;width:280px;}
	.s-c-s .col3 { width:230px;}
	
	.s-c-x .colright { left:280px;}
	.s-c-x .col1wrap { right:280px;}
	.s-c-x .col1 { margin-left:280px;}
	.s-c-x .col2 { right:280px;width:280px;}
	
	.x-c-s .colright { margin-left:-230px;}
	.x-c-s .col1 { margin-left:230px;}
	.x-c-s .col3 { left:230px;width:230px;}
	
    -->
  </style>

<link href="<?= $CONF['url'] ?>/default.css" rel="stylesheet" type="text/css" />


  <script type="text/javascript" src="<?= $template_root ?>/media/system/js/mootools.js"></script>
  <script type="text/javascript" src="<?= $template_root ?>/media/system/js/caption.js"></script>
  <script type="text/javascript" src="<?= $template_root ?>/plugins/system/rokbox/rokbox.js"></script>
  <script type="text/javascript" src="<?= $template_root ?>/plugins/system/rokbox/themes/light/rokbox-config.js"></script>

  <script type="text/javascript" src="<?= $template_root ?>/modules/mod_roknavmenu/themes/fusion/js/fusion.js"></script>
  <script type="text/javascript" src="<?= $template_root ?>/templates/rt_infuse_j15/js/rokfonts.js"></script>
  <script type="text/javascript" src="<?= $template_root ?>/templates/rt_infuse_j15/js/rokutils.js"></script>
  <script type="text/javascript" src="<?= $template_root ?>/templates/rt_infuse_j15/js/rokutils.inputs.js"></script>
  <script type="text/javascript">
var rokboxPath = '<?= $template_root ?>/plugins/system/rokbox/';
		        window.addEvent('load', function() {
					new Fusion('ul.menutop', {
						pill: 1,
						effect: 'slide and fade',
						opacity: 1,
						hideDelay: 500,
						tweakInitial: {'x': -12, 'y': 2},
        				tweakSubsequent: {'x': -12, 'y': -14},
						menuFx: {duration: 400, transition: Fx.Transitions.Quint.easeOut},
						pillFx: {duration: 400, transition: Fx.Transitions.Quint.easeOut}
					});
	            });
		window.templatePath = '<?= $template_root ?>/templates/rt_infuse_j15';
		window.uri = '';
		window.currentStyle = 'style1';
	
window.addEvent('domready', function() {
		var modules = ['side-mod', 'showcase-panel', 'moduletable', 'article-rel-wrapper'];
		var header = ['h3','h2','h1'];
		RokBuildSpans(modules, header);
	});
InputsExclusion.push('.content_vote')
  </script>
  <link rel="stylesheet" type="text/css" href="<?= $template_root ?>/modules/mod_minifrontpage/css/style.css" title="default" />

		
	</head>
	<body id="ff-infuse" class="f-infuse style1 full  iehandle">
	<!--Begin Header-->
	<div id="header">
		<div class="wrapper">
			<div class="padding">
				<!--Begin Logo-->
								<!--End Logo-->

<div class="myBox3">

<!--start radio-->   

<div><iframe name="basefrm" src="http://shop.inspiralled.net/now3.php" width="975" height="230" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" align="left" allowTransparency="true"></iframe>
</div>

<!--end radio-->   
</div>

								<div id="top-right-surround">
								<div id="top-right">		<div class="moduletable">
					<ul class="menu-nav"><li class="item28"><a href="/index.php?option=com_content&amp;view=article&amp;id=25&amp;Itemid=28"><span>About Joomla!</span></a></li><li class="item29"><a href="/index.php?option=com_content&amp;view=article&amp;id=22&amp;Itemid=29"><span>Features</span></a></li><li class="item18"><a href="/index.php?option=com_contact&amp;view=contact&amp;id=1&amp;Itemid=75"><span>Contact</span></a></li><li class="item30"><a href="/index.php?option=com_content&amp;view=article&amp;id=27&amp;Itemid=30"><span>The Community</span></a></li></ul>		</div>

	</div>
								<!--Begin Search-->
								<!--End Search-->
				</div>
							</div>
		</div>
	</div>
	<!--End Header-->
	<div class="wrapper">	
		<!--Begin Showcase-->

				<div class="show-tm"><div class="show-tl"></div><div class="show-tr"></div></div>
		<div class="show-m"><div class="show-l"><div class="show-r">
			<!--Begin Horizontal Menu-->
						<div id="horiz-menu" class="fusion">
				<div class="wrapper">
					<div class="padding">
						<div id="horizmenu-surround">
													<ul class="menutop level1" >
			<li class="item1 root" >

			<a class="orphan item bullet" href="http://sandbox.ralf.netmindz.net/"  >
			<span>
		    			Home			   
			</span>
		</a>
		
		
</li>	
			<li class="item175 parent root" >
			<a class="daddy item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=125&amp;Itemid=175"  >
			<span>
		    			Vision			   
			</span>

		</a>
		
			<div class="fusion-submenu-wrapper level2">
			<div class="drop-top"></div>
			<ul class="level2">
							
					<li class="item258" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=125&amp;Itemid=258"  >
			<span>
		    			Why we do what we do...			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item200" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=124&amp;Itemid=200"  >
			<span>
		    			Our Nutritional Vision			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item198" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=126&amp;Itemid=198"  >
			<span>
		    			Environmental Philosophy			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item259" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=127&amp;Itemid=259"  >
			<span>
		    			Our Creative Contritution			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item260" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=128&amp;Itemid=260"  >
			<span>
		    			Community - where its at!			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item176" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=129&amp;Itemid=176"  >
			<span>
		    			History - our roots			   
			</span>
		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
			<li class="item178 parent root" >

			<a class="daddy item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=195&amp;Itemid=178"  >
			<span>
		    			Events			   
			</span>
		</a>
		
			<div class="fusion-submenu-wrapper level2">
			<div class="drop-top"></div>
			<ul class="level2">
							
					<li class="item179" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=195&amp;Itemid=179"  >
			<span>
		    			Upcoming Events			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item307" >
			<a class="orphan item bullet" href="/index.php?option=com_jevents&amp;task=month.calendar&amp;Itemid=307"  >
			<span>
		    			Monthly Events			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item206" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=206"  >
			<span>
		    			Featured Events			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item207" >

			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=207"  >
			<span>
		    			Event Reviews			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item213" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=213"  >
			<span>
		    			Latest Releases			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item214" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=186&amp;Itemid=214"  >
			<span>
		    			inSpiral Radio			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item313" >

			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=313"  >
			<span>
		    			Meet the Artists			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item211" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=211"  >
			<span>
		    			Recommendations			   
			</span>

		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
			<li class="item180 parent root" >
			<a class="daddy item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=246&amp;Itemid=180"  >
			<span>
		    			Cuisine			   
			</span>

		</a>
		
			<div class="fusion-submenu-wrapper level2">
			<div class="drop-top"></div>
			<ul class="level2">
							
					<li class="item217" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=246&amp;Itemid=217"  >
			<span>
		    			Menu			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item262" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=131&amp;Itemid=262"  >
			<span>
		    			What&#039;s in What			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item261" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=130&amp;Itemid=261"  >
			<span>
		    			How it works			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item226" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=226"  >
			<span>
		    			This week&#039;s Special			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item269" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=269"  >
			<span>
		    			Flavour of the Fortnight			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item265" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=140&amp;Itemid=265"  >
			<span>
		    			Superfoods			   
			</span>
		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
			<li class="item326 parent root" >

			<a class="daddy item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=235&amp;Itemid=326"  >
			<span>
		    			Catering			   
			</span>
		</a>
		
			<div class="fusion-submenu-wrapper level2">
			<div class="drop-top"></div>
			<ul class="level2">
							
					<li class="item327" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=236&amp;Itemid=327"  >
			<span>
		    			Conscious Catering			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item328" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=237&amp;Itemid=328"  >
			<span>
		    			Raw Catering			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item330" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=239&amp;Itemid=330"  >
			<span>
		    			Christmas Menu			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item329" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=238&amp;Itemid=329"  >
			<span>
		    			Christmas Bookings			   
			</span>
		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
			<li class="item182 parent active root" >

			<a class="daddy item bullet" href="/index.php?option=com_wrapper&amp;view=wrapper&amp;Itemid=182"  >
			<span>
		    			Shop			   
			</span>
		</a>
		
			<div class="fusion-submenu-wrapper level2">
			<div class="drop-top"></div>
			<ul class="level2">
							
					<li class="item238 active" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=238"  >
			<span>
		    			Music			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item239 parent" >
			<a class="daddy item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=239"  >
			<span>
		    			Merchandize			   
			</span>

		</a>
		
			<div class="fusion-submenu-wrapper level3">
			<div class="drop-top"></div>
			<ul class="level3">
							
					<li class="item246" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=246"  >
			<span>
		    			Bags			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item247" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=247"  >
			<span>
		    			Mugs			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item248" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=248"  >
			<span>
		    			Shirts			   
			</span>
		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
							
					<li class="item240 parent" >

			<a class="daddy item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=240"  >
			<span>
		    			Superfoods			   
			</span>
		</a>
		
			<div class="fusion-submenu-wrapper level3">
			<div class="drop-top"></div>
			<ul class="level3">
							
					<li class="item249" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=249"  >
			<span>
		    			Tubs			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item250" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=250"  >
			<span>
		    			Chocolate Making Kids			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item251" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=251"  >
			<span>
		    			Kombucha Bottes			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item252" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=252"  >
			<span>
		    			Raw Chocolate Gift Boxes			   
			</span>
		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
							
					<li class="item241" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=241"  >
			<span>
		    			Sensatonics			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item242" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=242"  >
			<span>
		    			Cakes			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item243" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=243"  >
			<span>
		    			inSpiral ice			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item244" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=244"  >
			<span>
		    			Books			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item245" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=245"  >
			<span>
		    			Water Filter			   
			</span>

		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
			<li class="item181 parent root" >
			<a class="daddy item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=146&amp;Itemid=181"  >
			<span>
		    			Lounge			   
			</span>

		</a>
		
			<div class="fusion-submenu-wrapper level2">
			<div class="drop-top"></div>
			<ul class="level2">
							
					<li class="item325" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=325"  >
			<span>
		    			What&#039;s New			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item303" >
			<a class="orphan item bullet" href="/index.php?option=com_oziogallery2&amp;view=07flickrslidershow&amp;Itemid=295"  >
			<span>
		    			Photo Gallery			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item233" >

			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=191&amp;Itemid=233"  >
			<span>
		    			Venue Description			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item274" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=158&amp;Itemid=274"  >
			<span>
		    			Hire the Lounge			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item232" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=98&amp;Itemid=232"  >
			<span>
		    			What others say			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item237" >

			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=237"  >
			<span>
		    			Meet the Team			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item234" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=192&amp;Itemid=234"  >
			<span>
		    			How to find us			   
			</span>

		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
			<li class="item276 parent root" >
			<a class="daddy item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=159&amp;Itemid=276"  >
			<span>
		    			Community			   
			</span>

		</a>
		
			<div class="fusion-submenu-wrapper level2">
			<div class="drop-top"></div>
			<ul class="level2">
							
					<li class="item322" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=322"  >
			<span>
		    			Newsletter			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item278" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=278"  >
			<span>
		    			Permaculture			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item279" >

			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=279"  >
			<span>
		    			Eco Tips			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item277" >
			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=277"  >
			<span>
		    			Customer Spotlight			   
			</span>

		</a>
		
		
</li>	
							
					<li class="item280" >
			<a class="orphan item bullet" href="/index.php?option=com_content&amp;view=article&amp;id=163&amp;Itemid=280"  >
			<span>
		    			Friends of the Lounge			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item324" >

			<a class="orphan item bullet" href="/index.php?option=com_alphacontent&amp;view=alphacontent&amp;Itemid=324"  >
			<span>
		    			Spiral Blogs			   
			</span>
		</a>
		
		
</li>	
							
					<li class="item305" >
			<a class="orphan item bullet" href="/index.php?option=com_weblinks&amp;view=categories&amp;Itemid=305"  >
			<span>
		    			Web Links			   
			</span>

		</a>
		
		
</li>	
							</ul>
		</div>
		
</li>	
			<li class="item304 root" >
			<a class="orphan item bullet" href="/index.php?option=com_google&amp;view=google&amp;id=1&amp;Itemid=304"  >
			<span>
		    			Contact Us			   
			</span>

		</a>
		
		
</li>	
	</ul>
												</div>
					<div class="clr"></div>
					</div>
				</div>
			</div>
						<!--End Horizontal Menu-->

			<!--Begin Showcase Modules-->
									<!--End Showcase Modules-->
		</div></div></div>
		<div class="show-bm"><div class="show-bl"></div><div class="show-br"></div></div>
				<!--End Showcase-->
		<!--Begin Scroller-->
				<!--End Scroller-->
		<!--Begin Main Body-->
		<div class="main-tm"><div class="main-tl"></div><div class="main-tr"></div></div>

		<div class="main-m"><div class="main-l"><div class="main-r">
			<div id="main-body">
				<div id="main-content" class="s-c-s">
				    <div class="colmask leftmenu "><div class="wrapper">				        <div class="colmid">
				    	    <div class="colright">
						       <!--Begin Main Column (col1wrap)-->   
							    <div class="col1wrap">
							        <div class="col1pad">
							            <div class="col1">

									        <div id="maincol">
																																						    									<div class="bodycontent">
		    												    												    										<div id="maincontent-block">
														
																												<div class="">
	<div id="page" class="full-article">
				<div class="module-tm"><div class="module-tl"></div><div class="module-tr"></div></div>
		<div class="module-inner">
		
		<div class="article-rel-wrapper">

<!-- real start of content -->
<?php
$page = new page();
$page->getByOther(array('name'=>basename($_SERVER['PHP_SELF'])));
print $page->content;
?>
