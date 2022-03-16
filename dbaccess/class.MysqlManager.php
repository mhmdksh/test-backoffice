<?php 
class MysqlManager{
	var $localhost;
	var $username;
	var $password;
	var $dbname;
	var $dblink;
	var $db_result;

	function __construct($db_localhost, $db_username, $db_password, $db_database){
		$this->localhost = $db_localhost;
		$this->username = $db_username;
		$this->password = $db_password;
		$this->dbname = $db_database;
		$this->dblink = false;
	}
	
	function open(){
        $success = true;
        $this->dblink = @mysqli_connect($this->localhost, $this->username, $this->password, $this->dbname) or ($success = false);
		if(!$this->dblink){
            $success = false;
			$this->dblink = false;
		}
		return $success;
    }

	function close(){
		$success = true;
		if($this->dblink){
			@mysqli_close($this->dblink) or ($success = false);
		}
		return $success;
    }

	function setEncoding($charset){
		return @mysqli_query($this->dblink, "SET NAMES ".$charset);
    }

    function escape($input){
        return @mysqli_real_escape_string($this->dblink, $input);
    }
    
	function lastError(){
		return @mysqli_error($this->dblink);
    }
    
	function fetchRow(){
		if(!$this->db_result){
			return false;
        }
		return @mysqli_fetch_array($this->db_result, MYSQLI_ASSOC);
    }
	
	function select($query){
		$result = array();
        $this->db_result = @mysqli_query($this->dblink, $query);

		if(!$this->db_result){
            return false;
        }
		while($line = $this->fetchRow()){
			$result[] = $line;
        }
		return $result;
    }
	
	function action($query){
		$this->db_result = @mysqli_query($this->dblink, $query);
		if(!$this->db_result){
			return false;
        }			
		return @mysqli_affected_rows($this->dblink);
    }

}
?>