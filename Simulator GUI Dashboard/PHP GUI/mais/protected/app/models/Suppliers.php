<?php
class Suppliers extends BaseModel  {
	
	protected $table = 'suppliers';
	protected $primaryKey = 'SupplierID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT suppliers.* FROM suppliers  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE suppliers.SupplierID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
