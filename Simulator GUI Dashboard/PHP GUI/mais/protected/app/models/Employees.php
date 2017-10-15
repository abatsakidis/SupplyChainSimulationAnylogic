<?php
class Employees extends BaseModel  {
	
	protected $table = 'employees';
	protected $primaryKey = 'EmployeeID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT employees.* FROM employees  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE employees.EmployeeID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
