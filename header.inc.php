<?
if(ereg($_SERVER['HTTP_HOST'],$CONF['media_url'])) {
	print "eak";
	ob_start();
	print_r($_SERVER);
	$tmp = ob_get_contents();
	ob_end_clean();
	mail("will@netmindz.net","shop eak",$message);
}
?>
<?php print "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php if(isset($page_title)) { print $page_title; } else { ?>inSpiral Shop<?php } ?></title>
<meta name="verify-v1" content="x0mbN0j6nJtcxY6kdrj+NoXpprraAAWQqDAM0Oo19T4=" />
<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="http://www.inspiralled.net/images/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php if(isset($page_meta)) { ?><meta name="description" content="<?= $page_meta ?>" /><?php } ?>
<meta name="keywords" content="inSpiral, chillout, psychill, downbeat, <?php if(isset($page_keywords)) print $page_keywords ?>" />
<link href="http://www.inspiralled.net/templates/sp_slim3/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?= $CONF['url'] ?>/default.css" rel="stylesheet" type="text/css" />
<link href="http://www.inspiralled.net/css/content.css" rel="stylesheet" type="text/css" />

<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" media="screen" 
href="http://www.inspiralled.net/templates/sp_main3/css/ie.css" />    
<![endif]-->

<!--[if lt IE 7]>
<script src="http://www.inspiralled.net//js/IE7.js" type="text/javascript"></script>
<![endif]-->

<!--[if lt IE 8]>
<script src="http://www.inspiralled.net//js/IE8.js" type="text/javascript"></script>
<![endif]-->

</head>


<body class="body">
<div id="wrapper">
<table border="0" cellpadding="0" cellspacing="0" width="789">
    <tr>
      <td class="outline">
      
      
     <div style="position: relative;
 background-image: url(http://www.inspiralled.net/images/slim_top2.jpg); height: 180px; width: 789px;"></div>


		  		  


        <div id="buttons_outer">
          <div id="buttons_inner">
            <div id="buttons">
                           <ul id="mainlevel-nav">
				<!-- nav -->
<li><a href="http://www.inspiralled.net/">Inspiral Homepage</a></li>
<li><a href="<?= $CONF['url']?>">Shop Homepage</a></li>
<li><a href="<?= $CONF['url']?>/browse.php">Browse</a></li>
<li><a href="<?= $CONF['url']?>/basket.php">Basket</a></li>

</ul>            </div>
          </div>
        </div>
        <div id="search_outer">
          <div id="search_inner">
            
<form action="<?= $CONF['url'] ?>/search.php" method="post">
	<div class="search">
		<input name="keyword" id="mod_search_searchword" maxlength="20" alt="search" class="inputbox" type="text" size="20" value="search..."  onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" />	</div>

	<input type="hidden" name="option" value="com_search" />
	<input type="hidden" name="Itemid" value="5" />	
</form>          </div>
        </div>
        <div class="clr"></div>



          <div id="left_outer">
            <div id="left_inner">
              		<div class="moduletable">
							<h3>Music</h3>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr align="left"><td><a href="<?= browse_link("album") ?>" class="mainlevel" >Albums</a></td></tr>
								<tr align="left"><td><a href="<?= $CONF['url'] ?>/new.php" class="mainlevel" >New Items</a></td></tr>
								<tr align="left"><td><a href="<?= $CONF['url'] ?>/downloads.php" class="mainlevel" >Downloads</a></td></tr>
								<tr align="left"><td><a href="<?= browse_link("artist") ?>" class="mainlevel" >Artists</a></td></tr>
								<tr align="left"><td><a href="<?= browse_link("label") ?>" class="mainlevel" >Labels</a></td></tr>
								<tr align="left"><td><a href="<?= $CONF['url'] ?>/tags.php" class="mainlevel" >Styles</a></td></tr>
							</table>		
				</div>
              		<div class="moduletable">
							<h3>Products</h3>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<?php
							$nav_type = new type();
							$nav_type->getList("where type_id=0");
							while($nav_type->getNext()) {
								?>
								<tr align="left"><td><a href="<?= $CONF['url'] ?>/type.php?id=<?= $nav_type->id ?>" class="mainlevel" ><?= $nav_type->DN ?>s</a></td></tr>
							<?php } ?>
							</table>
				</div>
 				<div class="moduletable">
					<h3>Search</h3>
					<table class="contentpaneopen">
					<tr>
                       <td valign="top" colspan="2">
                       <form action="<?= $CONF['url'] ?>/search.php" method="post">
                       <input type="text" name="keyword" class="inputbox" size="10"/>
                       </form>
                       </td>
	                </tr>
                    </table>
		           <span class="article_seperator">&nbsp;</span>

				</div>



		            </div>
          </div>
		  
<!-- -->
		  
          <div id="content_outer">
            <div id="content_inner">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="content_table">
                <tr valign="top">
                  <td width="99%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" class="content_table">
                                            
                      <tr>
                        <td colspan="0">  
                        
			<div style="padding: 0px; position: relative; border-top-width: 0px; border-bottom-width: 0px; background-position: 0px -9px;" class="myBox2<?php if($_SERVER['PHP_SELF'] != "/index.php") { ?>Wide<? } ?>">		
<!--start content-->   
			
		<table class="contentpaneopen<?php if($_SERVER['PHP_SELF'] != "/index.php") { ?>Wide<? } ?>">
				<tr>
			<td valign="top" colspan="2">

<!-- real start of content -->
<?php
$page = new page();
$page->getByOther(array('name'=>basename($_SERVER['PHP_SELF'])));
print $page->content;
?>
