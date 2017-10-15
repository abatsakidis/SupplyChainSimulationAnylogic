<?php
class Blogcomment extends BaseModel  {
	
	protected $table = 'tb_blogcomments';
	protected $primaryKey = 'commentID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT tb_blogcomments.* FROM tb_blogcomments  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_blogcomments.commentID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
