<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>inspiralled - <?php if(isset($page_title)) { print $page_title; } else { ?>shop<?php } ?></title>
<meta name="description" content="A showcase for some of the finest in downbeat electronica, multimedia" />
<meta name="keywords" content="inSpiral lounge, chillout lounge, psychill lounge, psychill cafe, chillout music shop, psychill music shop, downbeat electronica music shop, <?php if(isset($page_keywords)) print $page_keywords ?>" />
<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="http://www.inspiralled.net/images/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="http://www.inspiralled.net/templates/sp_main2/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="http://www.inspiralled.net/css/content.css" rel="stylesheet" type="text/css" />

<link href="default.css" rel="stylesheet" type="text/css" />


<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" media="screen" 
href="http://www.inspiralled.net/templates/sp_main2/css/ie.css" />    
<![endif]-->


</head>

<script type="text/JavaScript" src="http://www.inspiralled.net/js/rounded_corners_lite.inc.js"></script>
<script type="text/JavaScript">

  window.onload = function()
  {
      /*
      The new 'validTags' setting is optional and allows
      you to specify other HTML elements that curvyCorners
      can attempt to round.

      The value is comma separated list of html elements
      in lowercase.

      validTags: ["div", "form"]

      The above example would enable curvyCorners on FORM elements.
      */
 settings = {
          tl: { radius: 12 },
          tr: { radius: 12 },
          bl: { radius: 12 },
          br: { radius: 12 },
          antiAlias: true,
          autoPad: false,
          validTags: ["div"]
      }

      var myBoxObject = new curvyCorners(settings, "myBox2");
      myBoxObject.applyCornersToAll();
      
 settings = {
          tl: { radius: 12 },
          tr: { radius: 12 },
          bl: { radius: 12 },
          br: { radius: 12 },
          antiAlias: true,
          autoPad: false,
          validTags: ["div"]
      }

      var myBoxObject2 = new curvyCorners(settings, "myBox3");
      myBoxObject2.applyCornersToAll();

       /*
      Usage:

      newCornersObj = new curvyCorners(settingsObj, classNameStr);
      newCornersObj = new curvyCorners(settingsObj, divObj1[, divObj2[, divObj3[, . . . [, divObjN]]]]);
      */
     
      }
  
</script>



<body class="body">
<div id="wrapper">
<table border="0" cellpadding="0" cellspacing="0" width="789">
    <tr>

      <td class="outline">
      
      
     <div style="position: relative;
 background-image: url(http://www.inspiralled.net/images/top_2.jpg); height: 335px; width: 789px;"></div>


	<div class="lozenge_images">

		<div id="left_lozenge"><script language="javascript" type="text/javascript"><!--
var rnd = Math.round(Math.random() * 4)
	           var markup = '<img border="0" src="http://www.inspiralled.net/images/left_images/image_'+rnd+'.png" alt="" width="141" height="80">'
	            document.write(markup)
//-->
</script></div>
		<div id="middle_lozenge"><script language="javascript" type="text/javascript"><!--
var rnd = Math.round(Math.random() * 3)
	           var markup = '<img border="0" src="http://www.inspiralled.net/images/middle_images/image_'+rnd+'.png" alt="" width="141" height="80">'
	            document.write(markup)
//-->
</script></div>
		<div id="right_lozenge"><script language="javascript" type="text/javascript"><!--
var rnd = Math.round(Math.random() * 4)
	           var markup = '<img border="0" src="http://www.inspiralled.net/images/right_images/image_'+rnd+'.png" alt="" width="141" height="80">'
	            document.write(markup)
//-->

</script></div>


</div>
		  		  


        <div id="buttons_outer">
          <div id="buttons_inner">
            <div id="buttons">
              <ul id="mainlevel-nav">
				<!-- nav -->
<li><a href="http://www.inspiralled.net/">Inspiral Homepage</a></li>
<li><a href="./">Shop Homepage</a></li>
<li><a href="browse.php">Browse</a></li>
<li><a href="basket.php">Basket</a></li>

</ul>            </div>

          </div>
        </div>
        <div class="clr"></div>



          <div id="left_outer">
            <div id="left_inner">
              		<div class="moduletable">
							<h3>Browse</h3>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr align="left"><td><a href="browse.php?type=album" class="mainlevel" >Albums</a></td></tr>
								<tr align="left"><td><a href="browse.php?type=artist" class="mainlevel" >Artists</a></td></tr>
								<tr align="left"><td><a href="browse.php?type=label" class="mainlevel" >Labels</a></td></tr>
								<!-- <tr align="left"><td><a href="browse.php?type=type" class="mainlevel" >Genres</a></td></tr> -->
							</table>		
				</div>
				<div class="moduletable">
							<h3>Search</h3>
				
		<table class="contentpaneopen">
				<tr>
			<td valign="top" colspan="2">
			<form action="search.php">
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
                  <td width="99%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="content_table">
                                            
                      <tr>
                        <td colspan="0">                      <div class="myBox2" style="width: 100%;">
						<!--start content-->   

<?php
$page = new page();
$page->getByOther(array('name'=>basename($_SERVER['PHP_SELF'])));
print $page->content;
?>			
