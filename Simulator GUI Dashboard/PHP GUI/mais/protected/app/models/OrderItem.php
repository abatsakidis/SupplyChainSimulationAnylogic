<?php
class OrderItem extends BaseModel  {
	
	protected $table = 'orderdetails';
	protected $primaryKey = 'OrderDetailsID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT orderdetails.* FROM orderdetails  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE orderdetails.OrderDetailsID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
