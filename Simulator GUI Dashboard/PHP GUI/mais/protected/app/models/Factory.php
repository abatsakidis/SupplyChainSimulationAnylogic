<?php
class Factory extends BaseModel  {
	
	protected $table = 'factory';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT factory.* FROM factory  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE factory.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
