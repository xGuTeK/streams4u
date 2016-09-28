<?php

class db extends logger{
	public static $queriesCounter = 0;
	private static $conn;
	
	
	public function connect()
	{
		global $cfg;
			self::$conn = mysql_connect ($cfg['db']['server'], $cfg['db']['user'], $cfg['db']['pass']) or die ("Can't connect to database");
			$select = mysql_select_db ($cfg['db']['name'], self::$conn) or die ("Can't select database");
			
				
	}	
    static function query($query) 
	{ 
        global $cfg;
        $resource = @mysql_query(trim($query), self::$conn);
 
        if ($resource == false) 
		{
           //$logger::addEvent (1, __FILE__, __LINE__, 'SQL query error: '.self::getError());
        } else {
            ++self::$queriesCounter;
            return $resource;
        }
    }
	static function secure ($data) {
        return mysql_real_escape_string($data, self::$conn);
    }
 
    static function fetch ($result, $mode = '') {
        switch ($mode) {
            case 'ROW':
                return mysql_fetch_row($result);
                break;
 
            case 'BOTH':
                return mysql_fetch_array($result);
                break;
 
            default:
                return mysql_fetch_assoc($result);
                break;
        }
    }
 
    static function returnedRows ($resource) {
    $result = mysql_num_rows($resource);
    return $result;
    }
 
    static function modifiedRows ($resource) {
    $result = mysql_affected_rows($resource);
    return $result;
    }
 
    static function getError () {
        return '['.mysql_errno().']'.' '.mysql_error();
    }
 
    static function getOneRecord ($query) {
        $record = self::fetch(self::query($query), 'ROW');
        return $record[0];
    }
 
    static function close() {
        mysql_close();
        self::$queriesCounter = 0;
    }
	
	public function fieldFilter($field){
		$field = strip_tags($field);
		$banlist = array ("'", ";", "%", "$", "-", ">", "drop", "\"", "<", "\\", "|", "/", 
		"=", "echo", "insert", "select", "update", "delete", "distinct", "having", "truncate", 
		"replace", "handler", "like", "procedure", "limit", "order by", "group by", "asc", "desc", 
		"union", "include");
		$field = str_replace($banlist, " ", $field);
		$field = trim($field);
		return $field;
	}
	public function queriescounter(){
		return '<font color=white>Zapytañ do bazy:</font> <font color=yellow>'.self::$queriesCounter.'</font>';
	}
	
}
	
?>