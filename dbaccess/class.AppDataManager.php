<?php 
class AppDataManager{
	var $db_manager;
	var $last_query;
    var $last_error;
    var $notify_webmaster;

    // Data Managers
    var $newsDataManager;

	function __construct($db_manager){
		$this->db_manager = $db_manager;
		$this->last_query = "";
        $this->last_error = "";
        $this->notify_webmaster = false;
        $this->initDataManagers();
    }
    
    function __call($command, $args){
        return $this->returnDataManager($command)->$command($args[0]);
    }
    
    function initDataManagers(){
        $this->newsDataManager = new NewsDataManager($this);
    }

    function returnDataManager($command){        
        $commandDataManagerMap = array();
        $commandDataManagerMap['news_list'] = $this->newsDataManager;
        $commandDataManagerMap['news_new'] = $this->newsDataManager;
        $commandDataManagerMap['news_modify'] = $this->newsDataManager;

        return $commandDataManagerMap[$command];
    }
    
	function _call($type, $query){
		$result = false;
		$this->last_query = $query;
		
		if($type == "SELECT"){
			$result = $this->db_manager->select($query);
		}
		else{
			$result = $this->db_manager->action($query);
		}
		
		return $result;
	}
	
	function _onError($error_message){
		$this->last_error = $error_message;

		if($this->notify_webmaster === true){
			// Send a mail to webmaster here...
		}
		
		return false;
	}
	
	function lastQuery(){
		return $this->last_query;
	}

	function lastError(){
		return $this->last_error;
    }
    
    function escape($input){
        
        if(is_null($input)){
            return "NULL";
        }

        if(is_array($input)){
            for($i=0; $i < count($input); $i++){
                $input[$i] = $this->db_manager->escape($input[$i]);
            }

            return $input;
        }
        
		return $this->db_manager->escape($input);
	}
	
	function begin(){
		$result = $this->_call("BEGIN", "BEGIN");
		if($result === false){
			return $this->_onError("Unable to startT!");
		}

		return true;
	}
	
	function commit(){
		$result = $this->_call("COMMIT", "COMMIT");
		if($result === false){
			return $this->_onError("Unable to endT!");
		}

		return true;
    }

}
?>