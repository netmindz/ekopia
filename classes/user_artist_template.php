<?
class user_artist_template
{
	var $id, $user_FK, $artist_FK;
	
	var $database, $lastError, $DN;
	var $_PK, $_table;
	var $_field_descs;
	var $_labels;			 	//  used for custom form labels e.g GMCNO = GMC Member Number
	var $_form_label_ids;			//  used internaly for html labels. DO NOT SET MANUALLY !!!!
	var $_data_format;			//flags if object data is in 'db' or 'php' format for convertDBProperties
	
	
	/**
	 * @return void
	 * @desc This is the PHP4 constructor. It calles the PHP5 constructor __construct()
	 */
	function user_artist_template()
	{
		$this->__construct();
	}//PHP4 constructor
	
	
	
	/**
	 * @return void
	 * @param 
	 * @desc This is the PHP5 constructor.
	 */
	function __construct()
	{
		$this->id = 0;

		$this->user_FK = "";
		$this->artist_FK = "";
		
		$this->database = new database();
		$this->_PK = 'id';
		$this->_PKs = array('id');
		$this->_table = 'user_artists';
		$this->_data_format = 'php';
		$this->_labels = array(); 
		$this->_form_label_ids = array();
		$this->_table_data = array(
			'album_tags'	=>	array ("pk"	=>	"id", "link_table"	=>	"1", "comment"	=>	""),
			'albums'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'artists'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'basket_items'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'baskets'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'images'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'labels'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'line_items'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'orders'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'pages'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'product_variations'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'products'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'tags'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'track_tags'	=>	array ("pk"	=>	"id", "link_table"	=>	"1", "comment"	=>	""),
			'tracks'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'types'	=>	array ("pk"	=>	"id", "comment"	=>	""),
			'user_artists'	=>	array ("pk"	=>	"id", "link_table"	=>	"1", "comment"	=>	""),
			'user_labels'	=>	array ("pk"	=>	"id", "link_table"	=>	"1", "comment"	=>	""),
			'users'	=>	array ("pk"	=>	"id", "comment"	=>	""),
		);

		$this->_field_descs['id'] = array ("pk" => "1", "auto" => "1", "type" => "int(11)", "length" => "11", "gen_type" => "int");
		$this->_field_descs['user_FK'] = array ("type" => "int(11)", "length" => "11", "gen_type" => "int");
		$this->_field_descs['artist_FK'] = array ("type" => "int(11)", "length" => "11", "gen_type" => "int");

	}//__constructor
	
	

	
	
	/**
	 * @return bool - false on fail, new ID on success, or true if no auto-inc primary key
	 * @desc This generic method enters all the current values of the properties into the database as a new record
	 */
	function add() {
		
		if($this->id != (int)$this->id && $this->id!='NOW()' && $this->id!='NULL'){
			trigger_error("wrong type for user_artist->id",E_USER_WARNING);
			settype($this->id,"int");
		}//IF


		if($this->user_FK != (int)$this->user_FK && $this->user_FK!='NOW()' && $this->user_FK!='NULL'){
			trigger_error("wrong type for user_artist->user_FK",E_USER_WARNING);
			settype($this->user_FK,"int");
		}//IF


		if($this->artist_FK != (int)$this->artist_FK && $this->artist_FK!='NOW()' && $this->artist_FK!='NULL'){
			trigger_error("wrong type for user_artist->artist_FK",E_USER_WARNING);
			settype($this->artist_FK,"int");
		}//IF


		
		$raw_sql  = "INSERT INTO user_artists (`user_FK`, `artist_FK`)";
		
		$raw_sql.= " VALUES ('".$this->database->escape($this->user_FK)."', '".$this->database->escape($this->artist_FK)."')";
		
		$raw_sql = str_replace("'NOW()'", "NOW()", $raw_sql);		//remove quotes
		$sql = str_replace("'NULL'", "NULL", $raw_sql);			//remove quotes
		
		
		if ($this->database->query($sql)) {
			$this->id = $this->database->InsertedID;
			
			return $this->database->InsertedID;
		
		}else{
			return false;
		}
	}//add
	
	
	
	/**
	 * @return unknown
	 * @desc This generic method updates the database to reflect the current values of the objects properties
	 */
	function update()
	{
	
		if($this->id != (int)$this->id && $this->id!='NOW()' && $this->id!='NULL'){
			trigger_error("wrong type for user_artist->id",E_USER_WARNING);
			settype($this->id,"int");
		}//IF


		if($this->user_FK != (int)$this->user_FK && $this->user_FK!='NOW()' && $this->user_FK!='NULL'){
			trigger_error("wrong type for user_artist->user_FK",E_USER_WARNING);
			settype($this->user_FK,"int");
		}//IF


		if($this->artist_FK != (int)$this->artist_FK && $this->artist_FK!='NOW()' && $this->artist_FK!='NULL'){
			trigger_error("wrong type for user_artist->artist_FK",E_USER_WARNING);
			settype($this->artist_FK,"int");
		}//IF


		$raw_sql  = "UPDATE user_artists SET ";
		$raw_sql.= "`user_FK`='".$this->database->escape($this->user_FK)."', `artist_FK`='".$this->database->escape($this->artist_FK)."'";
		$raw_sql.= " WHERE 
		AND id = '$this->id' ";
		
		$raw_sql = str_replace("'NOW()'", "NOW()", $raw_sql);		//remove quotes
		$sql = str_replace("'NULL'", "NULL", $raw_sql);			//remove quotes
		
		$this->database->query($sql);
		
		//return($this->id);		<-- used to be this, but should not effect anything? rs 12/08/04
		return true;
		
	}//Update
	
	
	
	/////////////////////////////////////
	//	set($fieldname)
	//	Rob S - 08/11/03
	/**
	* @return bool
	* @param string $fieldname		-	The exact name of the field in the table / object property
	* @desc Sets individual fields in the record, allowing special cases to be executed (eg. sess_expires), and leaving others unchanged.
 	*/
	/*
	function set($fieldname) {
		
		//define the SQL to use to UPDATE the field...
		if ($this->_field_descs[$fieldname]['gen_type'] == 'int' || $this->$fieldname == "NULL" || $this->$fieldname == "NOW()")
			$sql = "UPDATE user_artists SET $fieldname = ".$this->$fieldname;
		else
			$sql = "UPDATE user_artists SET $fieldname = '".$this->database->escape($this->$fieldname)."'";
		
		
		//Now add the WHERE clause
		$sql.= " WHERE 
		AND id = '$this->id' ";
		
		if ($this->database->query($sql))
			return true;
		else
			return false;
		
	}//set
	*/
	
	/**
	* @return bool
	* @param string $fieldname		-	The exact name of the field in the table / object property
	* @param string $value		-	The value of the field in the table / object property
	* @desc Wrapper that calls setProperties for the supplied pair and calls set()
 	*/
	function setField($field,$value)
	{
		$this->setProperties(array($field=>$value));
		return($this->set($field));
	}
	
	
	/**
	 * @return void
	 * @param int $id		-	primary key of record

	 * @param int 		-	id of record to delete
	 * @desc This generic method deletes a specified record from the database
	 */
	function delete($id)
	{
		$sql = "DELETE FROM user_artists WHERE id = '".$this->database->escape($id)."' ";
		
		if ($this->database->query($sql))
			return true;
		else
			return false;
		
	}//delete
	
	
	
	/**
	 * @return mixed	-	The number of rows found, or FALSE on query fail
	 * @param string $where = ""		-	The Where clause SQL
	 * @param string $order = ""		-	The Order By SQL
	 * @param string $limit = ""		-	The Limit SQL
	 * @desc This generic method runs a database query with the optional WHERE statement, sorted as defined in the global $CONF array or overridden with a order parameter. There is also an optional limit parameter
	 */
	function getList($where="", $order="", $limit="")
	{
		if(!$order) $order = "";
		$select = "SELECT user_artists.* FROM user_artists ";
		if ($this->database->query("$select $where $order $limit")) {
			return($this->database->RowCount);
		}else{
			return false;
		}//IF
	}//getList
		
	
	
	/**
	 * @return unknown
	 * @desc This generic method gets the next result from the last database query and loads the values into the properties of the object
	 */
	function getNext()
	{
		$tmp = $this->database->getNextRow();
		
		$this->DN = "";
		if($tmp) {
			/*if (empty($tmp['id']))		//something wrong if PKs are missing
				trigger_error ('Some primary keys missing from meta table '.get_class($this), E_USER_NOTICE);*/
			
			// TODO - rewrite this bit to work with meta tables, e.g
			// class::get{field}CB
			
			$this->setProperties($tmp);
			
			//convert from DB properties
			$this->convertDBProperties('from');		//needs to be changed to 'php' when legacy stuff is removed

			if (isset($this->name) && ($this->name))
				$this->DN = $this->name;
			elseif (isset($this->title) && ($this->title))
				$this->DN = $this->title;
			else
				$this->DN = "$this->id";
			return true;
			
		}
		else {
			return false;
		}
	}//getNext
	
	
	
	
	/**
	 * @return unknown
	 * @param int $id		-	primary key of record

	 * @desc Extracts the requested record from the database and puts it into the properties of the object
	 */
	function get($id)
	{
		settype($id,"int");
		
		$sql = "WHERE id = '".$this->database->escape($id)."'";
		
		$count = $this->getList($sql);
		
		//retrieve all fields from the table and map to user object
		//Also, confirm we have only retrieved a unique record
		if ($count > 1){
			trigger_error("More than one record returned using non-unique PK values", E_USER_ERROR);
			return false;
			
		}else{
			if ($this->getNext())
				return true;
			else
				return false;
			
		}//IF non-unique get
		
	}//get
	
	
	
	
	/////////////////////////////////////
	//	getByOther()
	//	Rob S - 07/11/03
	/**
	 * @return bool
	 * @param mixed $fields		-	A name value associative array of fields and values
	 * @desc This method is used to extract the requested record from the database by field(s) other than ID, and populates the object properties
	 */
	function getByOther($field_array) {
		$sql = "WHERE 1";
		foreach ($field_array as $fieldname => $value) {
			/*if ($this->_field_descs[$fieldname]['gen_type'] == 'int')
				$sql.= " AND $fieldname = $value";
			else
				$sql.= " AND $fieldname = '$value' ";*/
			//^cant trust that supplied data is numeric for INT fields, so....
			
			$sql.= " AND $fieldname = '".$this->database->escape($value)."'";
		}//FOREACH
		
		//retrieve all fields from the table and map to user object
		//Also, confirm we have only retrieved a unique record
		$count = $this->getList($sql);
		switch ($count){
			case 0:		//no record
				return false;
				break;
				
			case 1:		//match found
				$this->getNext();
				
				return $this->id;		//single PK, so returns pk value
				break;
				
			default:	//non-unique getByOther
				trigger_error("More than one record returned using non-unique \$field_array values", E_USER_WARNING);
				return false;
				break;
		}//SWITCH record count
		
	}//getByOther
	
	
	
	
	/**
	 * @return bool			-	True on Success, False otherwise
	 * @param array $properties		-	An array of the property values with which to update the object
	 * @param array $addSlashes		-	does what it says on the tin!
	 * @desc sets an objects properties off the back of an array - filters out any irrelevent properties.
	 */
	function setProperties($properties, $addSlashes=0)	{
		
		if(is_array($properties)) {
			$object_props = get_object_vars($this);		//retrieve array of properties
			
			foreach ($properties as $key => $value) {
				if(isset($this->_field_descs[$key]['fk'])) {
					$child_class = $this->_field_descs[$key]['fk'];
					
					if(!class_exists($child_class)) {
						# Todo - Write so this can be done without @
						@include "$child_class.php";		//attempt to load class file, but suppress errors if not found
						@include "$child_class.class.php";		//attempt to load class file, but suppress errors if not found
					}
					$child = new $child_class();
					if($this->_field_descs[$key]['gen_type'] == "many2many") {
					
	                        $child->_setPropertiesLinkages("user_artist", $this->id, array_keys($value));
                        
					}
					else {
						if((isset($_FILES[$key]))&&($_FILES[$key]["size"])) {
							if($value) {
								$child->delete($value);
							}
							$this->$key = $child->upload($_FILES[$key]["tmp_name"],$_FILES[$key]["name"]);
						}
						else {
							// use old value
							$this->$key = $value;
						}
					}
				}
				else {
					if(array_key_exists($key, $object_props)){
						if(is_array($value)) {
							if(isset($value['month']) && isset($value['year']) ) {
								$value = $this->mysqlDateJoin($value);
							}
							else {
								trigger_error("::setProperties can't set $key to be an array",E_USER_WARNING);
							}
						}
						// provided by PHPOF
						if(($this->_field_descs[$key]['gen_type'] == "string")&&(class_exists("XString"))) {
		                                        $value = XString::FilterMS_ASCII($value);
                               			}
						$this->$key = $value;
					}//IF key matched
				}
			}//FOREACH element
			
			return true;
			
		}else{	//not array
			return false;
		}//IF is array
		
	}//setProperties

	///////////////////////////////////////////////////////////////////
	//      rob s - 04/12/03
	/**
	 * @return array        -       An array of seperate date/time fields
	 * @param $mysql_date           - Accepts an array of type defined by mysqlDateSplit function
	 * @param $timestamp            - If set, a MySQL timestamp is created, rather than a MySQL DATETIME
	 * @desc This function takes a Date array created by mysqlDateSplit and joins it into a MySQL DATEIME or TIMESTAMP field
	 */
	function mysqlDateJoin ($mysql_date, $timestamp=0) {
	        if (!$timestamp) {      //therefore is DATETIME
	                $date_string = $mysql_date['year']."-".$mysql_date['month']."-".$mysql_date['day'];
	                if (isset($mysql_date['hour']))
	                        $date_string.= " ".$mysql_date['hour'].":".$mysql_date['min'].":".$mysql_date['sec'];

        	}else{  //is TIMESTAMP
	                return $mysql_date['year'].$mysql_date['month'].$mysql_date['day'].$mysql_date['hour'].$mysql_date['min'].$mysql_date['sec'];
	                $date_string = $mysql_date['year'].$mysql_date['month'].$mysql_date['day'];
	                if (isset($mysql_date['hour']))
	                        $date_string.= $mysql_date['hour'].$mysql_date['min'].$mysql_date['sec'];
	        }//IF DATETIME

	        return $date_string;
	}//mysqlDateJoin
	
	
	
	/**
	 * @return bool			-	False if no format is specified, or format already matches.
	 * @param enum $format	-	Either 'php' or 'db' depending on if we are converting to PHP or MySQL formats
	 * @desc Abstract Method! converts object properties to MySQL data or Vice Versa
	 */
	//PHP5:
	//protected abstract function convertDBProperties();
	
	//PHP4:
	function convertDBProperties($format) {
		/*require_once 'premier_common.php';
		
		//legacy conversions...
		if ($format=='from') $format = 'php';
		if ($format=='to') $format = 'db';
		
		
		if ($format=='db' && $this->_data_format=='php') {
			...
			
			$this->_data_format='db';
			
		}elseif ($format=='php' && $this->_data_format=='db'){
			...
			
			$this->_data_format='php';
			
		}else{	//either no $format entered, or format already matches
			trigger_error('Invalid situation for convertDBProperties call. $format='.$format.'; $this->_data_format='.$this->_data_format.';', E_USER_NOTICE);
			return false;
		}//IF*/
	}//convertDBProperties
	
	
	
	
	/**
	 * @return int
	 * @param string $keyword			-	Search criteria
	 * @param string $field_list		-	Comma separated list
	 * @param string $type = ""			-	Enum: "begins_with", "ends_with"
	 * @param string $where=""			-	A basic where clause to be included
	 * @desc This generic method searches the comma delimited field list for the specified keyword. types are begins_with or ends_with
	 */
	function search($keyword, $field_list, $type=null, $where=null)
	{
		if($type != "begins_with") $start = "%";
		if($type != "ends_with") $end = "%";
		if(!is_array($field_list)) {
			$field_list = split(",", $field_list);
		}//IF
		foreach($field_list as $key => $field) {
			$sql_array[] = "$field  like '$start$keyword$end' ";
		}
		
		
		if ($where)
			$where .= "\nAND (".implode("\n\tOR ", $sql_array).")\n";
		else
			$where .= "WHERE ".implode("\nOR ", $sql_array);
		
		return($this->getList($where));
	}//search
	
	
	
	
	/**
	 * @return void
	 * @param string $select_name		-	The select box name
	 * @param string $value = ""		-	Select value
	 * @param string $where = ""		-	The Where clause of the getList method call
	 * @param string $extra = ""		-	Any extra HTML code to insert inside the <select>
	 * @desc This generic method will create a select box. Single Primary Keys only!
	 */
	function select($select_name, $value="", $where="", $extra="")
	{
		//NB: Still a single Primary key function!...
		
		print "<select name=\"$select_name\" $extra>\n";
		print "<option value=\"\">-None-</option>\n";
		$this->getList($where);
		$used = array();
		while($this->getNext()) {
			print "<option value=\"$this->id\"";
			if($this->id == $value) print " SELECTED";
			print ">$this->DN</option>\n";
			$used[] = $this->id;
		}//WHILE
		if((!in_array($value, $used))&&($value))
			print "<option value=\"$value\" selected>$value</option>\n";
		print "</select>\n";
	}//select
	
	
	/**
	 * @return see select function
	 * @desc Alias for select
	 */
	function createSelect($select_name, $value="", $where="", $extra="") 
	{
		$this->select($select_name, $value, $where, $extra);
	}//createSelect




	function _getLinkTableChildClassDetails($parent_class)
	{
		$details = array();
		
		// hacky auto discovery
		foreach(array_keys($this->_field_descs) as $field) {
			if(!isset($this->_field_descs[$field]['pk'])) {
				if(!ereg($parent_class,$field)) {
					if(eregi("(.+)(_FK|_id)",$field,$matches)) {
						$details['child_class'] = $matches[1];
						$details['suffix'] = $matches[2];
						return($details);
					}
				}
			}
		}
		trigger_error("_getLinkTableChildClass failed for ($parent_class)",E_USER_ERROR);
	}
	
	function _setPropertiesLinkages($parent_class, $pk, $values)
	{
		$child_details = $this->_getLinkTableChildClassDetails($parent_class);
		$child_class = $child_details['child_class'];
		$child_table = premier_class_to_table($child_class);
		$child_table_pk = $this->_table_data[$child_table]['pk'];

		$sql = "DELETE FROM user_artists WHERE {$parent_class}_FK = '$pk'\n";
		$sql .= " AND {$child_class}_FK NOT IN(" . implode("," , $values) .")";
		$this->database->query($sql);
	
		$sql = "INSERT INTO user_artists\n";
		$sql .= " (`{$parent_class}_FK`, `{$child_class}_FK`) ";
		$sql .= "select '$pk',$child_table." . $child_table_pk. " from $child_table left join user_artists on ({$parent_class}_FK = '$pk' AND {$child_class}_FK = $child_table.$child_table_pk) where user_artists.id is null and $child_table.$child_table_pk in (" . implode(",",$values) . ")";
		$this->database->query($sql);
		
	}
	
	function createMatrix($input_name, $parent_class, $parent_pk)
	{
		$html = "";
		$html_id_base = $this->_createFormObjectID($input_name);
		
		$parent = new $parent_class();
		if(!$parent_pk) {
			return($html);
		}
		$parent->get($parent_pk) or die("failed to load parent $parent_class($parent_pk)");
	
		$child_details = $this->_getLinkTableChildClassDetails($parent_class);
		
		$child_class = $child_details['child_class'];
		$suffix = $child_details['suffix'];
		
		@include_once("$child_class.class.php");
		$child = new $child_class();
		$child->getList();
		while($child->getNext()) {
			
			$child_id = $child->{$child->_PK};
			$html_id = $html_id_base . "_" . $child_id;
			
			$html .= "<div style=\"float: left; width: 220px;padding-bottom: 2px;\">\n\t<label for=\"$html_id\" style=\"text-align: right; width: 88%; float: left;\">$child->DN</label>\n\t<input style=\"float: left; text-align: left;\" type=\"checkbox\" name=\"" . $input_name . "[$child_id]\" id=\"$html_id\"";
			if($this->getByOther(array($parent_class . $suffix => $parent_pk, $child_class . $suffix => $child->{$child->_PK}))) {
				$html .= " CHECKED";
			}
			$html .= " />\n</div> " ;
		}
		
		return($html);
	}


	
	
	
	
	/**
	 * @return string	-	The field label
	 * @param string $property			-	The name of the object property to be used
	 * @param string $input_name		-	The name of the HTML input field that this matches up with when calling createFormObject
	 * @desc This generic method will create a user friendly name for an objects property name suitable for use on a form
	 */
	function createFormLabel($property, $input_name="")
	{
		//if (substr($input_name, -2)=="[]" && stristr($extra, 'multiple')===false)	//autocomplete the array key, if none was specified (and its not a multi select object which requires an array)!
		if (substr($input_name, -2)=="[]")	//autocomplete the array key, if none was specified (and its not a multi select object which requires an array)!
			$input_name = substr($input_name, 0,-2)."[$property]";
		
		//check for specified label name
		if(isset($this->_labels[$property])) {
			$name = $this->_labels[$property];		//all object properties now have a _label!
			
		}else{
			//generate label from fieldname
			if(isset($this->_field_descs[$property]['fkl'] )) {
				$property = str_replace("_FKL","",$property);
			}
			elseif(isset($this->_field_descs[$property]['fk'] )) {
				$property = $this->_field_descs[$property]['fk'];
			}//IF fk
			$name = ucwords(str_replace("_"," ",$property));
		}//IF
		
		if($input_name) {
			$html_id = $this->_createFormObjectID($input_name);
			$name = "<label for=\"$html_id\">" . ucwords($name) . "</label>";
		}//label is used on Form object
		
		
		return($name);
		
	}//createFormLabel
	
	
	
	/**
	 * @return string
	 * @param string $property			-	The name of the object property to be used
	 * @param string $input_name		-	The name of the HTML input field, usually an array ie. properties[]
	 * @param unknown $value			-	The current value of the input field, defaults to the current value of property
	 * @param string $empty 			-	Defines the text for the "Empty" option in Select and other input boxes
	 * @param string $extra				-	Any extra parameters to be set inside the form object, or javascript etc.
	 * @param string $where				-	The Where clause for any createSelect's to be used
	 * @desc This generic method will create a HTML form object dependent on the type of field submitted.
	 */
	function createFormObject ($property, $input_name, $value='***ROGUE_VALUE***', $empty='-None-', $extra='', $where='') {
		global $CONF;
		$html = "";
		
		$property_value = ($value=='***ROGUE_VALUE***')? $this->$property : $value;	//check if $value was passed or not
		if(is_array($property_value)){
			foreach ($property_value as $arr_name => $arr_value)
				$property_value[$arr_name] = htmlspecialchars($arr_value);
		}else{
			$property_value = htmlspecialchars($property_value);
		}//IF
		
		if (substr($input_name, -2)=="[]" && stristr($extra, 'multiple')===false)	//autocomplete the array key, if none was specified (and its not a multi select object which requires an array)!
			$input_name = substr($input_name, 0,-2)."[$property]";
		
		$html_id = $this->_createFormObjectID($input_name);
		
		//begin filtering appropriate field type...
		if (isset($this->_field_descs[$property]['fk'] )){	//we have found a foreign key
			$fk_class = $this->_field_descs[$property]['fk'];
			
			if (!$fk_class) {
				$html.= "couldnt match foreign key $fieldname to a table";
			}else{
				if(!class_exists($fk_class)) {
					# Todo - Write so this can be done without @
					@include "$fk_class.php";		//attempt to load class file, but suppress errors if not found
					@include "$fk_class.class.php";		//attempt to load class file, but suppress errors if not found
				}
				$fk = new $fk_class();
				if($this->_field_descs[$property]['gen_type'] == "many2many") {
				
						$html .= $fk->createMatrix($input_name,"user_artist",$this->id);
						
				}
				elseif($fk_class == "image") {
					$fk->get($value);
                                        if($fk->id) {
                                        	print "$fk->name ";
                                       	}
                                        $html .= "<input type=\"hidden\" name=\"" . $input_name  ."\" value=\"$value\"><br>\n";
                                   	$html .= "<input type=\"file\" name=\"".$property."\">";
				}
				else {
					$fk_obj = new $fk_class();
					ob_start();
					$extra .= " id=\"$html_id\" ";
					$fk_obj->createSelect($input_name, $property_value, $where, $extra);
					$html.= ob_get_contents();
					ob_end_clean();
				}
			}//IF foreign key matched to table
			
			
		} else {	//not a Foreign Key field...
			switch ($this->_field_descs[$property]['gen_type']) {
                          case 'blob' :
					$html .= 'Binary Data';
					break;
                          case 'timestamp' :
					$html .= $this->$property;
					break;
			  case 'int' :
			  case 'number' :
				preg_match ("/\((\d+)\)/", $this->_field_descs[$property]['type'], $matches);		//get field length
				if (isset($matches[1]) && ($matches[1] ==1 || 			//a tiny int of display length 1 char is presumed to be a boolean
						(isset($CONF['user_artist'][$property]['max']) && $CONF['user_artist'][$property]['max']==1)) ){		//or setting the max value to 1 presumes a boolean
					$html.= "<input type=\"radio\" name=\"$input_name\" value=\"1\" id=\"$html_id\"";
					if($property_value)	//allow any possible value for True
						$html.= " checked";
					$html.= " $extra>Yes ";
					
					$html.= "<input type=\"radio\" name=\"$input_name\" value=\"0\" id=\"$html_id\"";
					if(!$property_value)	//allow any possible value for True
						$html.= " checked";
					$html.= " $extra>No";
					
					break;	//escape SWITCH statement
					
				}elseif (isset($CONF['user_artist'][$property]['max']) && $CONF['user_artist'][$property]['max']){
					$min = ($CONF['user_artist'][$property]['min'])? $CONF['user_artist'][$property]['min'] : 0;
					$step = ($CONF['user_artist'][$property]['step'])? $CONF['user_artist'][$property]['step'] : 1;
					if ($empty=='-None-')
						$empty = '--';
					$html.= createNumberSelect($input_name, $property_value, $min, $CONF['user_artist'][$property]['max'], $step, $empty);
					break;	//escape SWITCH statement
				}//IF integer is a Boolean
				
				//ELSE .... carry on and treat as a STRING.....
				
			  case 'string' :
				preg_match ("/\((\d+),?(\d+)?\)/", $this->_field_descs[$property]['type'], $matches);		//get field length
				if (preg_match ("/decimal/", $this->_field_descs[$property]['type']) )		//decimal
					$maxlength = $matches[1] + $matches[2] + 1;	//need to add space for decimalpoint!
				elseif(isset($matches[1]))
					$maxlength = $matches[1];
				else
					$maxlength = 11;
				
				if (isset($CONF['user_artist'][$property]['size']))
					$size = $CONF['user_artist'][$property]['size'];
				elseif($maxlength <= 30)
					$size = $maxlength+1;
				elseif ($maxlength <= 50)
					$size = 40;
				else
					$size = 60;
				
				if (strpos(strtolower($property), "password") !== FALSE || strpos(strtolower($property), "pwd") !== FALSE)
					$html.= "<input type=\"password\" name=\"$input_name\" value=\"$property_value\" size=\"10\" maxlength=\"20\" id=\"$html_id\" $extra>";
				else
					$html.= "<input type=\"text\" name=\"$input_name\" value=\"$property_value\" size=\"$size\" maxlength=\"$maxlength\" id=\"$html_id\" $extra>";
				break;
				
				
			  case 'text' :
				//get field length
				if (strpos($this->_field_descs[$property]['type'], "medium") || strpos($this->_field_descs[$property]['type'], "long") || ereg('^text$',$this->_field_descs[$property]['type']) ) {
					$cols = 50;
					$rows = 12;
				}else{
					$cols = 40;
					$rows = 6;
				}//IF
				
				$html.= "<textarea name=\"$input_name\" cols=\"$cols\" rows=\"$rows\" id=\"$html_id\" $extra>$property_value</textarea>\n";
				break;
				
				
			  case 'enum' :
				$enums = $this->_field_descs[$property]['values'];
				
				if (sizeof($enums) < 4){
					
					if (sizeof($enums)==1){ //Use a check box as we only have one option
						$html.= "<input type=\"radio\" name=\"$input_name\" value=\"1\" id=\"$html_id\"";
						if($property_value)	//allow any possible value for True
							$html.= " checked";
						$html.= " $extra>Yes ";
						
						$html.= "<input type=\"radio\" name=\"$input_name\" value=\"0\" id=\"$html_id\"";
						if(!$property_value)	//allow any possible value for True
							$html.= " checked";
						$html.= " $extra>No\n";
						
					}else{ //use Radio buttons
						if($empty!="-None-") {
							$radio_id = $html_id . "none";
							$html.= "<input type=\"radio\" name=\"$input_name\" value=\"\" id=\"$radio_id\"";
							if(empty($property_value))
								$html.= " checked";
							$html.= " $extra> <label for=\"$radio_id\">$empty</label>&nbsp;&nbsp; ";
						}//IF
						
						foreach($enums as $i=>$type) {
							$radio_id = $html_id . eregi_replace("[^a-z0-9_-]","",$type);
							$html.= "<input type=\"radio\" name=\"$input_name\" value=\"$type\" id=\"$radio_id\"";
							if($property_value == $type)
								$html.= " checked";
							$html.= " $extra> <label for=\"$radio_id\">$type</label>&nbsp;&nbsp; ";
						}//FOREACH
						$html.= "\n";
					}//IF only one Enum option
					
				}else{	//many options so use SELECT list
					
					$html.= "<select name=\"$input_name\" id=\"$html_id\" $extra>\n";
					$html.= "<option value=\"\">$empty</option>\n";
					foreach($enums as $i=>$enum_value) {
						$html.= "<option value=\"$enum_value\"";
						if( $enum_value==$property_value ||
							(is_array($property_value) && in_array($enum_value, $property_value)) )
							$html.= " selected";
						$html.= ">$enum_value</option>\n";
					}//FOREACH
					$html.= "</select>\n";
				}//IF less than 4 options
				break;
				
				
			  case 'datetime' :
				$seperator = '';
				//check that date is an array...
				if (!is_array($property_value)){	//then value needs to be converted to standard date array
					$property_value = mysqlDateSplit($property_value);		//function from premier_common
				}//IF
				
				
				//check for date part
				if (strpos($this->_field_descs[$property]['type'], "date") !== FALSE) {
					if	(strpos(strtolower($property), "dob") !== FALSE || strpos(strtolower($property), "birth") !== FALSE || strpos(strtolower($property), "b_day") !== FALSE) {
						$past = 85;
						$future = 0;
					}else{
						$past = 5;
						$future = 5;
					}//IF date of birth field
					
					if (isset($CONF['user_artist'][$property]['past']))
						$past = $CONF['user_artist'][$property]['past'];
					
					if (isset($CONF['user_artist'][$property]['future']))
						$future = $CONF['user_artist'][$property]['future'];
					
					$html.= createDateSelect($input_name, $property_value, $past, $future);
					$separator = " @ ";
				}//IF date
				
				
				//check for time part...
				if (strpos($this->_field_descs[$property]['type'], "time") !== FALSE){
					$html.= $separator.createTimeSelect($input_name, $property_value, 1);
				}//IF date
				
				break;
				
			  default:
				$html.= "<b>ERROR</b> - outside switch for MySQL type '".$this->_field_descs[$property]['type']."' from field '$property' in createFormObject()<br>\n";
				if ($this->_field_descs[$property]['gen_type'])
					$html.= "gen-type: ".$this->_field_descs[$property]['gen_type'];
				$html.= "<br>\nPossibly misspelt fieldname / newly added db field?\n";
				break;
			}//SWITCH
		}//IF foreign key field
		
		return $html;
	}//createFormObject
	
	
	
	
	/**
	 * @return void
	 * @desc x
	 */
	function _createFormObjectID($input_name)
	{
		$input_name = eregi_replace("[^a-z0-9_-]","",$input_name);
		if(!isset($this->_form_label_ids[$input_name])) {
			$this->_form_label_ids[$input_name]  = $input_name . "_" . substr(microtime(),-4) . "_" .  rand(0,99);
		}
		return($this->_form_label_ids[$input_name]);
	}
	
	
	
	
	/**
	 * @return void
	 * @desc This is the template PHP5 destructor. It calls $this->database->finish()
	 */
	function  __destruct()
	{
		$this->database->finish();
		foreach ($this as $property=>$value)
			$this->$property = null;
	}

}