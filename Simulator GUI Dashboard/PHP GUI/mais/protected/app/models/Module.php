<?php
class Module extends BaseModel  {
	
	protected $table = 'tb_module';
	protected $primaryKey = 'module_id';

	public function __construct() {
		parent::__construct();
		
	} 
	
	function isModuleExists()
	{
		
	}


}