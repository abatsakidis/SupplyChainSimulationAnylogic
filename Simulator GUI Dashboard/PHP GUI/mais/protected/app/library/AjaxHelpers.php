<?php
class AjaxHelpers
{

	public static function gridFormater($val , $row, $attribute = array() , $arr = array()) {
	//	print_r($attribute);exit;
		// Handling Image & file Field
		if($attribute['image']['active'] =='1' && $attribute['image']['active'] !='') {
			$val =  SiteHelpers::showUploadedFile($val,$attribute['image']['path']) ;
		}
		// Handling Quick Display As 
		if(isset($arr['valid']) && $arr['valid'] ==1)
		{
			$fields = str_replace("|",",",$arr['display']);
			$Q = DB::select(" SELECT ".$fields." FROM ".$arr['db']." WHERE ".$arr['key']." = '".$val."' ");
			if(count($Q) >= 1 )
			{
				$rowObj = $Q[0];
				$fields = explode("|",$arr['display']);
				$v= '';
				$v .= (isset($fields[0]) && $fields[0] !='' ?  $rowObj->$fields[0].' ' : '');
				$v .= (isset($fields[1]) && $fields[1] !=''  ? $rowObj-> $fields[1].' ' : '');
				$v .= (isset($fields[2]) && $fields[2] !=''  ? $rowObj->$fields[2].' ' : '');
				
				
				$val = $v;
			} 
		} 	
		
		// Handling format function 	
		if(isset($attribute['formater']['active']) and $attribute['formater']['active']  ==1)
		{
			$val = $attribute['formater']['value'];
			foreach($row as $k=>$i)
			{
				if (preg_match("/$k/",$val))
					$val = str_replace($k,$i,$val);				
			}
			$c = explode("|",$val);
			if(isset($c[0]) && class_exists($c[0]))
			{
				$val = call_user_func( array($c[0],$c[1]), str_replace(":",",",$c[2])); 
			}	
			
		}
		// Handling Link  function 	
		if(isset($attribute['hyperlink']['active']) && $attribute['hyperlink']['active'] ==1 && $attribute['hyperlink']['link'] != '')
		{	
	
			$attr = '';
			$linked = $attribute['hyperlink']['link'];
			foreach($row as $k=>$i)
			{
				
				if (preg_match("/$k/",$attribute['hyperlink']['link']))
					$linked = str_replace($k,$i, $linked);				
			}
			if($attribute['hyperlink']['target'] =='modal')
			{
				$attr = 'onclick="SximoModal(this.href,\''.addslashes ($val).'\'); return false"';
			}
			
			$val =  "<a href='".URL::to($linked)."' $attr style='display:block' >".$val." <span class='fa fa-arrow-circle-right pull-right'></span></a>";
		}
		
		
		
		return $val;
		
	}	
	
	static public function fieldLang( $fields ) 
	{ 
		$l = array();
		foreach($fields as $fs)
		{			
			foreach($fs as $f)
				$l[$fs['field']] = $fs; 									
		}
		return $l;	
	}	
	
	static public function instanceGrid(  $class) 
	{
		$data = array(
			'class'	=> $class ,
		);
		return View::make('admin.module.utility.instance',$data);
	
	}  			

}