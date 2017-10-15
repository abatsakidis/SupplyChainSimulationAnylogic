<?php
class Wholesaler extends BaseModel  {
	
	protected $table = 'wholesaler';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT wholesaler.* FROM wholesaler  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE wholesaler.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
