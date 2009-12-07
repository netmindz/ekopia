<?php
/**
 * @version             $Id: plugin_search_shop.php 0.1 2009-12-07 Will Tatam
 * @copyright           Copyright
 * @license             License, for example GNU/GPL
 * All other information you would like to add
 */
 
//To prevent accessing the document directly, enter this code:
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
//Now define the registerEvent and the language file. Replace 'plugin_search_shop' with the name of your plugin.
$mainframe->registerEvent( 'onSearch', 'plgSearchplugin_search_shop' );
$mainframe->registerEvent( 'onSearchAreas', 'plgSearchplugin_search_shopAreas' );
 
JPlugin::loadLanguage( 'plg_search_plugin_search_shop' );
 
//Then define a function to return an array of search areas. Replace 'plugin_search_shop' with the name of your plugin.
function &plgSearchplugin_search_shopAreas()
{
        static $areas = array(
                'plugin_search_shop' => 'plugin_search_shop'
        );
        return $areas;
}
 
//Then the real function has to be created. The database connection should be made. 
//The function will be closed with an } at the end of the file.
function plgSearchplugin_search_shop( $text, $phrase='', $ordering='', $areas=null )
{
	$db = &JFactory::getDBO();
	$user = &JFactory::getUser(); 

	//If the array is not correct, return it:
	if (is_array( $areas )) {
		    if (!array_intersect( $areas, array_keys( plgSearchplugin_search_shopAreas() ) )) {
		            return array();
		    }
	}
 
	//It is time to define the parameters! First get the right plugin; 'search' (the group), 'plugin_search_shop'. 
	$plugin =& JPluginHelper::getPlugin('search', 'plugin_search_shop');
	 
	//Then load the parameters of the plugin..
	$pluginParams = new JParameter( $plugin->params );
	 
	//And define the parameters. For example like this..
	$limit = $pluginParams->def( 'nameofparameter', defaultsetting );
	 
	//Use the function trim to delete spaces in front of or at the back of the searching terms
	$text = trim( $text );
	 
	//Return Array when nothing was filled in
	if ($text == '') {
		return array();
	}
 
	//After this, you have to add the database part. This will be the most difficult part, because this changes per situation.
	//In the coding examples later on you will find some of the examples used by Joomla! 1.5 core Search Plugins.
	//It will look something like this.
        $wheres = array();
        switch ($phrase) {
 
		//search exact
                case 'exact':
                        $text          = $db->Quote( '%'.$db->getEscaped( $text, true ).'%', false );
                        $wheres2       = array();
                        $wheres2[]   = 'LOWER(a.name) LIKE '.$text;
                        $where                 = '(' . implode( ') OR (', $wheres2 ) . ')';
                        break;
 
		//search all or any
                case 'all':
                case 'any':
 
		//set default
                default:
                        $words         = explode( ' ', $text );
                        $wheres = array();
                        foreach ($words as $word)
                        {
                                $word          = $db->Quote( '%'.$db->getEscaped( $word, true ).'%', false );
                                $wheres2       = array();
                                $wheres2[]   = 'LOWER(a.name) LIKE '.$word;
                                $wheres[]    = implode( ' OR ', $wheres2 );
                        }
                        $where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
                        break;
        }
 
//ordering of the results
        switch ( $ordering ) {
 
//alphabetic, ascending
                case 'alpha':
                        $order = 'a.name ASC';
                        break;
 
//oldest first
                case 'oldest':
 
//popular first
                case 'popular':
 
//newest first
                case 'newest':
 
//default setting: alphabetic, ascending
                default:
                        $order = 'a.name ASC';
        }
 
//replace plugin_search_shop
        $searchplugin_search_shop = JText::_( 'plugin_search_shop' );
 
 		$rows = array();
 		$doc = simplexml_load_file($pluginParams->get('shop_url') . "/search.php?keyword=" . urlencode($text) . "&output=xml");
		foreach($doc->result as $xmlResult) {
			$result = new stdclass();
			$result->title = $xmlResult->attributes()->title . "";
			$result->section = $xmlResult->attributes()->section . "";
			$result->browsernav = 1;
			$result->href = $xmlResult->attributes()->href . "";
			$rows[] = $result;
		}
		return $rows;
}
?>
