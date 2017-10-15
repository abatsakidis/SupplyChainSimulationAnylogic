<?php
class Orders extends BaseModel  {
	
	protected $table = 'orders';
	protected $primaryKey = 'OrderID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT orders.* FROM orders  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE orders.OrderID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
