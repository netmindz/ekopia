<?
if(ereg($_SERVER['HTTP_HOST'],$CONF['media_url'])) {
	ob_start();
	print_r($_SERVER);
	$tmp = ob_get_contents();
	ob_end_clean();
	mail("will@netmindz.net","shop eak",$tmp);
}

$template_root = "http://www.inspiralled.net";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >
	<head>
		  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php if(isset($page_title)) { print $page_title; } else { ?>inSpiral Shop<?php } ?></title>
<meta name="verify-v1" content="x0mbN0j6nJtcxY6kdrj+NoXpprraAAWQqDAM0Oo19T4=" />
<meta name="robots" content="index, follow" />
<link rel="shortcut icon" href="<?= $template_root ?>/templates/rt_infuse_j15/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php if(isset($page_meta)) { ?><meta name="description" content="<?= $page_meta ?>" /><?php } ?>
<meta name="keywords" content="inSpiral, chillout, psychill, idm, <?php if(isset($page_keywords)) print $page_keywords ?>" />

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

	.s-c-s .colmid { left:180px; }
	.s-c-s .colright { margin-left:-510px; } 
	.s-c-s .col1pad { margin-left:600px; } 
	.s-c-s .col2 { left:330px; width:280px;}
	.s-c-s .col3 {  margin-left:-372px; width:688px;}

	.s-c-x .colright { left:280px;}
	.s-c-x .col1wrap { right:280px;}
	.s-c-x .col1 { margin-left:280px; }
	.s-c-x .col2 { right:280px;width:280px;}

	.s-c-s .col1pad {
	overflow-x: auto;
	overflow-y: auto;
	}

	.x-c-s .colright { margin-left:-230px; }
	.x-c-s .col1 { margin-left:230px; border: 1px green solid;}
	.x-c-s .col3 { left:230px;width:230px;}


	.moduletable1 { background-color:#eae9b8;}
	.side-style-h3 { background-color:#f1eed9;}
	.sidecol-m { background-color:#eae9b8;}
	.topic1 {padding:10px;}
	.links {text-decoration: none;text-indent: 0pt;color: #225769;font-weight: normal;font-style: normal;font-size: 110%;font-family:Arial;}
	.links:link, .links:visited, .links:active { font-style: normal;color: #225769;text-decoration: none;text-indent: 0pt;font-weight: normal;}
	.links:hover {color: #9fb400;font-style: normal;text-decoration: none;text-indent: 0pt;font-weight:lighter; }
	.ccc{text-decoration: none;text-indent: 0pt;color: #225769;font-weight: normal;font-style: normal;font-size: 110%;font-family:Arial; }
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
	
<body id="ff-infuse" class="f-infuse style1 full iehandle">

  <!--Begin Header-->

  <div id="header">
    <div class="wrapper">
      <div class="padding">
        <!--Begin Logo-->
        <!--End Logo-->
        <div class="myBox3">
          <!--start radio-->
          <div>
            <iframe name="basefrm" src="<?= $CONF['url'] ?>/now3.php" width="975" height="230" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" align="left" allowtransparency="true" id="basefrm"></iframe>

          </div><!--end radio-->
        </div>
      </div>
    </div>
  </div><!--End Header-->

  <div class="wrapper">
    <!--Begin Showcase-->

    <div class="show-tm">
      <div class="show-tl"></div>
      <div class="show-tr"></div>
    </div>

    <div class="show-m">
      <div class="show-l">
        <div class="show-r">


			<?php include("menu.inc.php"); ?>	

          <!--Begin Showcase Modules-->
          <!--End Showcase Modules-->
        </div>
      </div>
    </div>

    <div class="show-bm">
      <div class="show-bl"></div>
      <div class="show-br"></div>
    </div><!--End Showcase-->
    <!--Begin Scroller-->
    <!--End Scroller-->
    <!--Begin Main Body-->

    <div class="main-tm">
      <div class="main-tl"></div>
      <div class="main-tr"></div>
    </div>

    <div class="main-m">
      <div class="main-l">
        <div class="main-r">
          <div id="main-body">

            <div id="main-content" class="s-c-s">
              <div class="colmask leftmenu">
                <div class="wrapper">
                  <div class="colmid">
                    <div class="colright">
                      <!--Begin Main Column (col1wrap)-->

                      <!--<div class="col1wrap">
                        <div class="col1pad">

                          <div class="col1">
                            <div id="maincol">
                              <div class="bodycontent">
                                <div id="maincontent-block">
                                  <div class="">
                                    <div id="page" class="full-article">
                                      <div class="module-inner">
                                      </div>                                    
                                    </div>

                                  </div>
                                </div>
                              </div>
                              <div class="clr"></div>
                            </div>
                          </div>
                        </div>
                      </div>--><!--End Main Column (col1wrap)-->
                      <!--Begin Left Column (col2)-->

                      <div class="col2">
                        <div id="leftcol">

                          <div class="sidecol-tm">
                            <div class="sidecol-tl"></div>
                            <div class="sidecol-tr"></div>
                          </div>

                          <div class="sidecol-m">
                            <div class="sidecol-l">

                              <div class="sidecol-r">
                                <div class="">

                                  <div class="moduletable">
									<!-- side nav here -->
                                    <div class="side-style-h3">
										<h3 class="module-title">Music</h3>
									</div>
		
                                    <div class="module-inner">

				<ul class="menu">
					<li class="item283"><a href="<?= $CONF['url']?>/latest-albums.php"><span>Latest Albums</span></a></li>
					<li class="item283"><a href="<?= $CONF['url']?>/downloads.php"><span>Latest Downloads</span></a></li>
					<li class="item283"><a href="<?= browse_link("album") ?>"><span>Albums</span></a></li>
					<li class="item283"><a href="<?= browse_link("artist") ?>"><span>Artists</span></a></li>
					<li class="item283"><a href="<?= browse_link("label") ?>"><span>Labels</span></a></li>
					<li class="item283"><a href="<?= $CONF['url']?>/tags.php"><span>Genre</span></a></li>
				</ul>			
						</div>						
		</div>
	</div>

	
																					</div></div></div>
										<div class="sidecol-bm"><div class="sidecol-bl"></div><div class="sidecol-br"></div></div>
									</div><br>

<?php // ************************* Admin ?>
									<?php
									if($user->id) {
									?>
									<div id="leftcol">
										<div class="sidecol-tm"><div class="sidecol-tl"></div><div class="sidecol-tr"></div></div>
										<div class="sidecol-m"><div class="sidecol-l"><div class="sidecol-r">
																							
		<div class="">
		<div class="moduletable">
						<div class="side-style-h3"><h3 class="module-title">Admin</h3></div>
						<div class="module-inner">
							<ul class="menu">
								<li class="item283"><a href="<?= $CONF['url'] ?>/admin.php">Admin Home</a></li>
								<li class="item283"><a href="<?= $CONF['url'] ?>/login.php?logout=1">Logout <?= $user->username?></a></li>
							</ul>							
						</div>						
		</div>
		
		
		
	</div>
	</div></div></div>
										<div class="sidecol-bm"><div class="sidecol-bl"></div><div class="sidecol-br"></div></div>
									</div><br/>

								<?php } ?>

<?php // ************************* Types ?>
									<div id="leftcol">
										<div class="sidecol-tm"><div class="sidecol-tl"></div><div class="sidecol-tr"></div></div>
										<div class="sidecol-m"><div class="sidecol-l"><div class="sidecol-r">
																							
		<div class="">
		<div class="moduletable">
						<div class="side-style-h3"><h3 class="module-title">Products</h3></div>
						<div class="module-inner">

				<ul class="menu">
				<?php
				$nav_type = new type();
				$nav_type->getList("where type_id=0");
				while($nav_type->getNext()) {
						?>
					<li class="item283"><a href="<?= $CONF['url'] ?>/type.php?id=<?= $nav_type->id ?>"><span><?= $nav_type->DN ?></span></a></li>
				<?php } ?>
				</ul>			
						</div>						
		</div>
		
		
		
	</div>
	</div></div></div>
										<div class="sidecol-bm"><div class="sidecol-bl"></div><div class="sidecol-br"></div></div>
									</div><br/>
									

<?php // ************************* Search ?>

									<div id="leftcol">
										<div class="sidecol-tm"><div class="sidecol-tl"></div><div class="sidecol-tr"></div></div>
										<div class="sidecol-m"><div class="sidecol-l"><div class="sidecol-r">
																							
		<div class="">
		<div class="moduletable">
						<div class="side-style-h3"><h3 class="module-title">Search</h3></div>
						<div class="module-inner">
							<form action="<?= $CONF['url'] ?>/search.php">
								<input type="text" name="keyword" size="15" />
								<input type="submit" value="Search"/>
							</form>
							
						</div>						
		</div>
		
		
		
	</div>
	</div></div></div>
										<div class="sidecol-bm"><div class="sidecol-bl"></div><div class="sidecol-br"></div></div>
									</div>

<?php // ************************* End Side nav ?>

							    </div>
                      <!--End Left Column (col2)-->

                      <!--Begin Right Column (col3)-->
					  <div class="col3">

                        <div id="leftcol">

                          <div class="sidecol-tm">

                            <div class="sidecol-tl"></div>
                            <div class="sidecol-tr"></div>
                          </div>

                          <div class="sidecol-m">
                            <div class="sidecol-l">
                              <div class="sidecol-r">							  
                                <div class="moduletable1">
                                <!-- 
								<div class="side-style-h3">
									<h3 class="module-title"><span>inSpiral</span> online shop</h3>
								</div>
								-->

<!-- real start of content --> 
<?php
$page = new page();
$page->getByOther(array('name'=>basename($_SERVER['PHP_SELF'])));
print $page->content;
?>
