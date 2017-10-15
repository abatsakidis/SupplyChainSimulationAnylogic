<?php
class {controller} extends BaseModel  {
	
	protected $table = '{table}';
	protected $primaryKey = '{key}';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return " {sql_select} ";
	}
	public static function queryWhere(  ){
		
		return "{sql_where}   ";
	}
	
	public static function queryGroup(){
		return " {sql_group} ";
	}
	

}
