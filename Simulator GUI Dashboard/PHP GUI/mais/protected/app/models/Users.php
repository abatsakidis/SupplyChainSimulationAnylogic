<?php
class Users extends BaseModel  {
	
	protected $table = 'tb_users';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return " SELECT  tb_users.*,  tb_groups.name 
FROM tb_users LEFT JOIN tb_groups ON tb_groups.group_id = tb_users.group_id ";
	}
	public static function queryWhere(  ){
		
		return "   WHERE tb_users.id !=''     ";
	}
	
	public static function queryGroup(){
		return "      ";
	}
	
	public static function getUserStatus()
	{
		$result = DB::select("
			SELECT tb_groups.name,COUNT(tb_users.id) AS users,
			SUM(CASE WHEN  tb_users.active = '1' THEN 1 ELSE 0 END) AS user_active ,
			SUM(CASE WHEN  tb_users.active = '2' THEN 1 ELSE 0 END) AS user_suspend ,
			SUM(CASE WHEN  tb_users.active = '0' THEN 1 ELSE 0 END) AS user_inactive
			FROM tb_groups LEFT JOIN tb_users ON tb_users.group_id = tb_groups.group_id
			GROUP BY tb_groups.group_id								   
		")	;
		return $result;		
	}	
	
	public static function getLatestUser()
	{
		$result =  DB::select("SELECT * FROM tb_users WHERE id !='1' ORDER BY created_at DESC LIMIT 5 ")	;
		return $result;
	}
		
	
}
