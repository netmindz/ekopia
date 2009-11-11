
                                      </div>

                                      <div class="module-bm">
                                        <div class="module-bl"></div>

                                        <div class="module-br"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="clr"></div>
                            </div>
                          </div>
                        </div>
                      </div><!--End Main Column (col1wrap)-->
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
										<h3 class="module-title">Browse</h3>
                                    </div>
                                    foo
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr align="left"><td><a href="<?= browse_link("album") ?>" class="mainlevel" >Albums</a></td></tr>
										<tr align="left"><td><a href="<?= browse_link("artist") ?>" class="mainlevel" >Artists</a></td></tr>
										<tr align="left"><td><a href="<?= browse_link("label") ?>" class="mainlevel" >Labels</a></td></tr>
										<!-- <tr align="left"><td><a href="browse.php?type=type" class="mainlevel" >Genres</a></td></tr> -->
									</table>		

<!--
                                    <div class="side-style-h3">
										<h3 class="module-title">Search</h3>
                                    </div>
									<form action="<?= $CONF['url'] ?>/search.php" method="post">
									<input type="text" name="keyword" class="inputbox" size="10"/>
									</form>
-->
		
									<div class="side-style-h3">
										<h3 class="module-title">Products</h3>
									</div>
									foo
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<?php
									$nav_type = new type();
									$nav_type->getList("where type_id=0");
									while($nav_type->getNext()) {
											?>
											<tr align="left"><td><a href="<?= $CONF['url'] ?>/type.php?id=<?= $nav_type->id ?>" class="mainlevel" ><?= $nav_type->DN ?>s</a></td></tr>
									<?php } ?>
									</table>

                                    <div class="module-inner">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="sidecol-bm">
                            <div class="sidecol-bl"></div>

                            <div class="sidecol-br"></div>
                          </div>
                        </div>
                      </div>
                      <!--End Left Column (col2)-->
                      <!--Begin Right Column (col3)-->
					<?php
					/*
                      <div class="col3">
                        <div id="rightcol">
                          <div class="sidecol-tm">
                            <div class="sidecol-tl"></div>

                            <div class="sidecol-tr"></div>
                          </div>

                          <div class="sidecol-m">
                            <div class="sidecol-l">
                              <div class="sidecol-r">
                                <div class="">
                                  <div class="moduletable">
                                    <div class="module-inner">
                                      <p style="text-align: center;"><a href="http://sandbox.ralf.netmindz.net/index.php?option=com_content&amp;view=article&amp;id=239&amp;Itemid=330"><img src="http://sandbox.ralf.netmindz.net/images/stories/events/Flyers/2009/General/christmas.jpg" border="0" /></a></p>

                                      <p style="text-align: center;"></p>

                                      <p style="text-align: left;"></p>
                                    </div>
                                  </div>
                                </div>

                                <div class="">
                                  <div class="moduletable">
                                    <div class="module-inner">
                                      <p style="text-align: center;">Superfoods now available in our online Shop!</p>

                                      <p style="text-align: center;"><a href="http://sandbox.ralf.netmindz.net/index.php?option=com_content&amp;view=article&amp;id=140&amp;Itemid=265"><img src="http://sandbox.ralf.netmindz.net/images/stories/Products/Superfood_Labels/detox-mix-large.jpg" border="0" width="190" /></a></p>

                                      <p style="text-align: left;"></p>
                                    </div>
                                  </div>
                                </div>

                                <div class="">
                                  <div class="moduletable">
                                    <div class="side-style-h3">
                                      <h3 class="module-title">Lounge Hours</h3>
                                    </div>

                                    <div class="module-inner">
                                      <ul>
                                        <li>Monday to Friday</li>

                                        <li>10:00 - 22:00</li>

                                        <li>Saturday to Sunday</li>

                                        <li>10:00 - 2:00 (late)</li>

                                        <li>Sunday</li>

                                        <li>10:00 - 23:30</li>
                                      </ul>

                                      <p style="text-align: left;"></p>
                                    </div>
                                  </div>
                                </div>

                                <div class="">
                                  <div class="moduletable">
                                    <div class="side-style-h3">
                                      <h3 class="module-title">Meet the Team</h3>
                                    </div>

                                    <div class="module-inner">
                                      <table width="100%" class="minifp">
                                        <tr>
                                          <td valign="top" width="100%" class="minifp">
                                            <br class="minifp-seperator" />
                                            <a href="http://sandbox.ralf.netmindz.net/index.php?option=com_content&amp;view=article&amp;id=202%3Alounge&amp;catid=68%3Aintro-meet-team&amp;Itemid=238"><img src="http://sandbox.ralf.netmindz.net/images/stories/minifp//kitchen-team_thumb.jpg" width="64" height="64" align="left" alt="article thumbnail" /></a>

                                            <p>who are the people behind the unique inSpiral concept? We are sure you must be curious to find out who all the amazing peeps behind the inSpiral curtains are. Well, it sure is busy there with now m&nbsp;[&nbsp;...&nbsp;]</p><br class="minifp-seperator" />

                                            <div class="minifp-full-link-wrp">
                                              <a class="minifp-full-link" href="http://sandbox.ralf.netmindz.net/index.php?option=com_content&amp;view=article&amp;id=202%3Alounge&amp;catid=68%3Aintro-meet-team&amp;Itemid=238">+ Full Story</a>
                                            </div>
                                          </td>
                                        </tr>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="sidecol-bm">
                            <div class="sidecol-bl"></div>

                            <div class="sidecol-br"></div>
                          </div>
                        </div>
                      </div>
                      */
                      ?>
                      <!--End Right Column (col3)-->
                    </div>
                  </div>
                </div>
              </div>
            </div><!--Begin Main Bottom-->
            <!--End Main Bottom-->
          </div>
        </div>
      </div>
    </div>

    <div class="main-bm">
      <div class="main-bl"></div>

      <div class="main-br"></div>
    </div><!--End Main Body-->
  </div><!--Begin Footer-->

  <div id="footer-bg">
    <div class="wrapper">
      <div id="footer">
        <div id="mainmodules4" class="spacer w33">
          <div class="block first">
            <div class="">
              <div class="moduletable">
                <div class="module-padding">
                  <h3 class="showcase">inSpiral Shop</h3>
					&copy; <a href="http://www.netmindz.net/?shop">WJT 2009</a> || <a href="froogle.php?download">RSS</a>

                  <!-- content bits here -->
                </div>
              </div>
            </div>
          </div>

          <div class="block middle">
            <div class="">
              <div class="moduletable">
                <div class="module-padding">
                  <h3 class="showcase">Contact Us</h3>

                  <p>250 Camden High Street<br />
                  London<br />
                  NW1 8QS</p>

                  <p>office: 0207 419 6798</p>

                  <p>lounge: 0207 4825875</p>

                  <p><a href="mailto:dom@inspiralled.net">e-mail</a></p>
                </div>
              </div>
            </div>
          </div>

          <div class="block last">
            <div class="">
              <div class="moduletable">
                <div class="module-padding">
                  <h3 class="showcase">Newsletter</h3>

                  <p>We are working hard on our new newsletter '<strong>inSpiral eyes</strong>' - full of exciting information about our events, food and community interests. To subscribe just sign up <a href="http://www.idspiral.org/cgi-local/dada/mail.cgi/list/inspiralled/">here</a>.</p>
                </div>
              </div>
            </div>
          </div>
        </div><!--Begin Copyright Section-->

        <div class="copyright-block">
          <div class="footer-div"></div>

          <div id="top-button">
            <a href="#" id="top-scroll" class="top-button-desc" name="top-scroll">Back to Top</a>
          </div>
        </div><!--End Copyright Section-->
      </div>

      <div id="footer-bg2"></div>

      <div id="footer-bg3"></div>
    </div>
  </div><!--End Footer-->

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-4868734-1";
urchinTracker();
</script>
<!-- 1206456645 -->
</body>
</html>
