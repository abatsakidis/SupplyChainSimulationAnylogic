<?php
class Menu extends BaseModel  {
	
	protected $table = 'tb_menu';
	protected $primaryKey = 'menu_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return " SELECT tb_menu.menu_id,tb_menu.parent_id,tb_menu.module,tb_menu.url,tb_menu.menu_name,tb_menu.menu_type,tb_menu.role_id,tb_menu.deep,tb_menu.ordering,tb_menu.position,tb_menu.menu_icons,tb_menu.active  FROM tb_menu  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_menu.menu_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
