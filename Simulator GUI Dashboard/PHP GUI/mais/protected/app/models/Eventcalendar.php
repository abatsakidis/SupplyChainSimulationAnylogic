<?php
class Eventcalendar extends BaseModel  {
	
	protected $table = 'events';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT events.* FROM events  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE events.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
