<?php
class Values extends BaseModel  {
	
	protected $table = 'tb_values';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT tb_values.* FROM tb_values  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_values.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
