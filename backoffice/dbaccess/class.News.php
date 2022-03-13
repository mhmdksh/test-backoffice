<?php
class NewsDataManager{
    
    var $dataManager;

	function __construct($dataManager){
		$this->dataManager = $dataManager;
    }
    
    function news_list($inputs){
		
		$constraints = "";
		if(isset($inputs['id'])){
			$constraints .= " AND n_id = ".$this->dataManager->escape($inputs['id'])." ";
		}
		if(isset($inputs['hashcode'])){
			$constraints .= " AND n_hashcode='".$this->dataManager->escape($inputs['hashcode'])."' ";
		}
        if(isset($inputs['user_id'])){
			$constraints .= " AND ".DB_PREFIX."news.user_id=".$this->dataManager->escape($inputs['user_id'])." ";
		}
        if(isset($inputs['status'])){
			$constraints .= " AND ".DB_PREFIX."news.n_status=".$this->dataManager->escape($inputs['status'])." ";
		}
		if(isset($inputs['title'])){
			$constraints .= " AND LOWER(n_title) LIKE LOWER('%".$this->dataManager->escape($inputs['title'])."%') ";
		}
		
		$query = "
        SELECT * 
        FROM ".DB_PREFIX."news 
            LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."news.user_id=".DB_PREFIX."users.u_id 
        WHERE 1=1 ".$constraints." ORDER BY n_id ASC";
		$result = $this->dataManager->_call("SELECT", $query);
		
		if($result === false){
			return $this->dataManager->_onError("Unable to get news!");
		}
		
		return $result;
	}
}
?>