<?php
class Categories extends BaseModel  {
	
	protected $table = 'categories';
	protected $primaryKey = 'CategoryID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT categories.* FROM categories  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE categories.CategoryID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
