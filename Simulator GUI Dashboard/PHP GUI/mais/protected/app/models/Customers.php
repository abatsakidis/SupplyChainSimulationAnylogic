<?php
class Customers extends BaseModel  {
	
	protected $table = 'customers';
	protected $primaryKey = 'CustomerID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT customers.* FROM customers  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE customers.CustomerID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
