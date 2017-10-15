<?php
class Retailer extends BaseModel  {
	
	protected $table = 'retailer';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT retailer.* FROM retailer  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE retailer.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
