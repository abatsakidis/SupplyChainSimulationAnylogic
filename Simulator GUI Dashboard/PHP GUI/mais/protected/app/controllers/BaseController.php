<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	//public $menus =''; 
	
	public function __construct() {
		
		$this->menus = SiteHelpers::menus(); 
		$this->sidebar = SiteHelpers::menus('sidebar'); 
		$driver = Config::get('database.default');
		$database = Config::get('database.connections');
		$this->db = $database[$driver]['database'];		
		
		
	}
	 
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	function prepare()
	{
		
		$info = $this->model->makeInfo( $this->module);	
		$data = array(
			'tableGrid' => $this->info['grid']
		);	
		return $data;	
		
	}
	
	function infoTable()
	{
		$info = $this->model->makeInfo( $this->module);
		return $info['module_config']['grid'];
	}
	
	function getDownload()
	{
	
		$info = $this->model->makeInfo( $this->module);
		// Take param master detail if any
		$master  = $this->buildMasterDetail(); 
		$masterParam  = $this->masterDetailParam(); 
		$params = array(
			'params'	=> $master['masterFilter']
		);
		
		$results 	= $this->model->getRows( $params );
		$fields		= $info['config']['grid'];
		$rows		= $results['rows'];
		
		$content = $this->data['pageTitle'];
		$content .= '<table border="1">';
		$content .= '<tr>';
		foreach($fields as $f )
		{
			if($f['download'] =='1') $content .= '<th style="background:#f9f9f9;">'. $f['label'] . '</th>';
		}
		$content .= '</tr>';
		
		foreach ($rows as $row)
		{
			$content .= '<tr>';
			foreach($fields as $f )
			{
				if($f['download'] =='1'):
					$conn = (isset($f['conn']) ? $f['conn'] : array() );					
					$content .= '<td>'. SiteHelpers::gridDisplay($row->$f['field'],$f['field'],$conn) . '</td>';
				endif;	
			}
			$content .= '</tr>';
		}
		$content .= '</table>';
		
		@header('Content-Type: application/ms-excel');
		@header('Content-Length: '.strlen($content));
		@header('Content-disposition: inline; filename="'.$title.' '.date("d/m/Y").'.xls"');
		
		echo $content;
		exit;
		
		
		//return View::make('excel',$this->data);		
	}
	
	function postSearch()
	{
		$keyword = $this->module;
		if(!is_null(Input::get('keyword')))
		{
			$keyword = $this->module.'?search='.str_replace(' ','_',Input::get('keyword'));		
		}
		return Redirect::to($keyword);
	
	}
	
	function postMultisearch()
	{
		//echo '<pre>';print_r($_POST);echo '</pre>';exit;
		$post = $_POST;
		$items ='';
		foreach($post as $item=>$val):
			if($_POST[$item] !='' and $item !='_token' and $item !='md' && $item !='id'):
				$items .= $item.':'.trim($val).'|';
			endif;	
		
		endforeach;
		return Redirect::to($this->module.'?search='.substr($items,0,strlen($items)-1).'&md='.Input::get('md'));
	}
	
	function postFilter()
	{
		$module = $this->module;
		$sort 	= (!is_null(Input::get('sort')) ? Input::get('sort') : '');
		$order 	= (!is_null(Input::get('order')) ? Input::get('order') : '');
		$rows 	= (!is_null(Input::get('rows')) ? Input::get('rows') : '');
		$md 	= (!is_null(Input::get('md')) ? Input::get('md') : '');
		
		$filter = '?';
		if($sort!='') $filter .= '&sort='.$sort; 
		if($order!='') $filter .= '&order='.$order; 
		if($rows!='') $filter .= '&rows='.$rows; 
		if($md !='') $filter .= '&md='.$md;
		 
		 

		return Redirect::to($module . $filter);
	
	}	
	
	function injectPaginate()
	{
		$sort 	= (!is_null(Input::get('sort')) ? Input::get('sort') : '');
		$order 	= (!is_null(Input::get('order')) ? Input::get('order') : '');
		$rows 	= (!is_null(Input::get('rows')) ? Input::get('rows') : '');
		$search 	= (!is_null(Input::get('search')) ? Input::get('search') : '');
		$masterDetail 	= (!is_null(Input::get('md')) ? Input::get('md') : '');
		$appends = array();
		if($sort!='') 	$appends['sort'] = $sort; 
		if($order!='') 	$appends['order'] = $order; 
		if($rows!='') 	$appends['rows'] = $rows; 
		if($search!='') $appends['search'] = $search; 
		if($masterDetail!='') $appends['md'] = $masterDetail; 
		return $appends;
			
	}
	
	function trackUriSegmented()
	{
		$pages 	= (!is_null(Input::get('page')) ? Input::get('page') : '');
		$sort 	= (!is_null(Input::get('sort')) ? Input::get('sort') : '');
		$order 	= (!is_null(Input::get('order')) ? Input::get('order') : '');
		$rows 	= (!is_null(Input::get('rows')) ? Input::get('rows') : '');
		$search 	= (!is_null(Input::get('search')) ? Input::get('search') : '');
		$masterDetail 	= (!is_null(Input::get('md')) ? Input::get('md') : '');
		$appends = array();
		if($pages!='') 	$appends['page'] = $pages; 
		if($sort!='') 	$appends['sort'] = $sort; 
		if($order!='') 	$appends['order'] = $order; 
		if($rows!='') 	$appends['rows'] = $rows; 
		if($search!='') $appends['search'] = $search; 
		if($masterDetail!='') $appends['md'] = $masterDetail; 
		$url = "";
		foreach($appends as $key=>$val)
		{
			$url .= "&$key=$val";
		}
		return $url;
			
	}	

	function infoFieldSearch()
	{
		$info =$this->model->makeInfo( $this->module);
		$forms = $info['config']['forms'];
		$data = array();
		foreach($forms as $f)
		{
			if($f['search'] ==1) 	
            	if($f['alias'] !='' )  {
				$data[] =  array('id'=> $f['alias'].".".$f['field']);
			}
		}
		return $data;		
	}	
	function buildSearch()
	{
		$keywords = ''; $fields = '';	$param ='';
		$allowsearch = $this->info['config']['forms'];
		foreach($allowsearch as $as) $arr[$as['field']] = $as ;		
		if(Input::get('search') !='')
		{
			$type = explode("|",Input::get('search'));
			if(count($type) >= 1)
			{
				foreach($type as $t)
				{
					$keys = explode(":",$t);
					
					if(in_array($keys[0],array_keys($arr))):
						if($arr[$keys[0]]['type'] == 'select' || $arr[$keys[0]]['type'] == 'radio' )
						{
							$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." = '".$keys[1]."' ";
						} else {
							$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." REGEXP '".$keys[1]."' ";						
						}						
					endif;	
				}
			} 
		}		
		return $param;
	
	}

	
	function buildMasterDetail( $template = null)
	{
		// check if url contain $_GET['md'] , that mean master detail
		if(!is_null(Input::get('md')) and Input::get('md') != '' )
		{
			
			$values 				= array();
			$data 					= explode(" ", Input::get('md') );
			// Split all param get 
			$master 				= ucwords($data[0]) ; $master_key = $data[1]; $module = $data[2]; $key = $data[3];  $val = $data[4];
			$val 					=  SiteHelpers::encryptID($val,true) ;
			$values['row'] 			= $master::getRow( $val );
			$loadInfo 				= $master::makeInfo( $master);
			$values['grid']         = $loadInfo ['config']['grid'];
			$filter 				= 	" AND  ".$this->info['table'].".".$key."='".$val."' ";	
			if($template != null)
			{
				$view 					= View::make($template, $values); 			
			} else {	
				$view 					= View::make('layouts/masterview', $values); 
			}	
			$result = array(
				'masterFilter' => $filter,
				'masterView'	=> $view
			);
			return $result;	
			
		} else {
			$result = array(
				'masterFilter' => '',
				'masterView'	=> ''
			);	
			return $result;		
		}
			
	
	}
	
	public function masterDetailParam()
	{
		if(!is_null(Input::get('md')))
		{
			$data 	= explode(" ", Input::get('md') );
			$data = array(
				'filtermodule' 		=> (isset($data[2]) ? $data[2] : ''),
				'filterkey'			=> (isset($data[3]) ? $data[3] : ''),
				'filtervalue' 		=> (isset($data[4]) ? $data[4] : ''),
				'filtermd' 			=> str_replace(" ","+",Input::get('md')),
				
			);
		} else {
			$data = array(
				'filtermodule' 	=> '',
				'filterkey' 	=> '',
				'filtervalue' 	=> '',
				'filtermd' 		=> '',
			);				
		}	
		return $data;
	
	}	
	
	function getComboselect()
	{

		if(Request::ajax() == true && Auth::check() == true)
		{
			$param = explode(':',Input::get('filter'));
			$limit = (!is_null(Input::get('limit')) ? Input::get('limit') : null);
			$rows = $this->model->getComboselect($param,$limit);
			$items = array();
		
			$fields = explode("|",$param[2]);
			
			foreach($rows as $row) 
			{
				$value = "";
				foreach($fields as $item=>$val)
				{
					if($val != "") $value .= $row->$val." ";
				}
				$items[] = array($row->$param['1'] , $value); 	
	
			}
			
			return json_encode($items); 	
		} else {
			return json_encode(array('OMG'=>" Are u trying to cheat ?? FUCK YOU !!"));
		}	
	}
	
	function getCombotable()
	{
		if(Request::ajax() == true && Auth::check() == true)
		{				
			$rows = $this->model->getTableList($this->db);
			$items = array();
			foreach($rows as $row) $items[] = array($row , $row); 	
			return json_encode($items); 	
		} else {
			return json_encode(array('OMG'=>" Are u trying to cheat ?? FUCK YOU !!"));
		}				
	}		
	
	function getCombotablefield()
	{
		if(Request::ajax() == true && Auth::check() == true)
		{	
				
			$items = array();
			$table = Input::get('table');
			if($table !='')
			{
				$rows = $this->model->getTableField(Input::get('table'));			
				foreach($rows as $row) 
					$items[] = array($row , $row); 				 	
			} 
			return json_encode($items);	
		} else {
			return json_encode(array('OMG'=>" Are u trying to cheat ?? FUCK YOU !!"));
		}					
	}		
	
	function validateListError( $rules )
	{
		$errMsg = Lang::get('core.note_error') ;
		$errMsg .= '<hr /> <ul>';
		foreach($rules as $key=>$val)
		{
			$errMsg .= '<li>'.$key.' : '.$val[0].'</li>';
		}
		$errMsg .= '</li>';	
		return $errMsg;
	}
	function validateForm()
	{
		$forms = $this->info['config']['forms'];
		$rules = array();
		foreach($forms as $form)
		{
			if($form['required']== '' || $form['required'] !='0')
			{
				$rules[$form['field']] = 'required';
			} elseif ($form['required'] == 'alpa'){
				$rules[$form['field']] = 'required|alpa';
			} elseif ($form['required'] == 'alpa_num'){
				$rules[$form['field']] = 'required|alpa_num';					
			} elseif ($form['required'] == 'alpa_dash'){
				$rules[$form['field']]='required|alpa_dash';																
			} elseif ($form['required'] == 'email'){
				$rules[$form['field']] ='required|email';
			} elseif ($form['required'] == 'numeric'){
				$rules[$form['field']] = 'required|numeric';		
			} elseif ($form['required'] == 'date'){
				$rules[$form['field']]='required|date';
			} else if($form['required'] == 'url'){
				$rules[$form['field']] = 'required|active_url';
			} else {
			
			}										
		}	
		return $rules ;
	}
	
	function validatePost(  $table )
	{			
		$str = $this->info['config']['forms'];
		$data = array();
		foreach($str as $f){
			$field = $f['field'];
			if($f['view'] ==1) 
			{
		
				if($f['type'] =='textarea_editor' || $f['type'] =='textarea')
				{
					$content = (isset($_POST[$field]) ? $_POST[$field] : '');
					$data[$field] =  Purifier::clean($content); 
				} else {

					SiteHelpers::globalXssClean();
					if(!is_null(Input::get($field)))
					{
						$data[$field] = Input::get($field);				
					}
					// if post is file or image			
					if($f['type'] =='file')
					{				
						if(!is_null(Input::file($field)))
						{
							$file = Input::file($field); 
							$destinationPath = './'.str_replace('.','',$f['option']['path_to_upload']);
							$filename = $file->getClientOriginalName();
							$extension =$file->getClientOriginalExtension(); //if you need extension of the file
							$uploadSuccess = Input::file($field)->move($destinationPath, $filename);
							 if($f['option']['resize_width'] != '0' && $f['option']['resize_width'] !='')
							 {
							 	if( $f['option']['resize_height'] ==0 )
								{
									$f['option']['resize_height']	= $f['option']['resize_width'];
								}
							 	$orgFile = $destinationPath.'/'.$filename;
								 SiteHelpers::cropImage($f['option']['resize_width'] , $f['option']['resize_height'] , $orgFile ,  $extension,	 $orgFile)	;						 
							 }
							 
							if( $uploadSuccess ) {
							   $data[$field] = $filename;
							} 
						} else {
							unset($data[$field]);
						}					
					}
					// if post is checkbox	
					if($f['type'] =='checkbox')
					{
						if(!is_null(Input::get($field)))
						{
							$data[$field] = implode(",",Input::get($field));
						}	
					}
					// if post is date						
					if($f['type'] =='date')
					{
						$data[$field] = date("Y-m-d",strtotime(Input::get($field)));
					}
					
					// if post is seelct multiple						
					if($f['type'] =='select')
					{
						if( isset($f['option']['is_multiple']) &&  $f['option']['is_multiple'] ==1 )
						{
							$data[$field] = implode(",",Input::get($field));
						}	
					}									
					
				}	 						

			}	
		}
		 $global	= (isset($this->access['is_global']) ? $this->access['is_global'] : 0 );
		
		if($global == 0 )
			$data['entry_by'] = Session::get('uid');
					
		return $data;
	}
	
	function validAccess( $methode )
	{

		if($this->model->validAccess( $methode ,$this->info['id']) == false)
		{
			return Redirect::to('home')
			->with('message', SiteHelpers::alert('error',' Your are not allowed to access the page '));
			
		}
		
	}
	
	function inputLogs( $note = NULL)
	{
		$data = array(
			'module'	=> Request::segment(1),
			'task'		=> Request::segment(2),
			'user_id'	=> Session::get('uid'),
			'ipaddress'	=> Request::getClientIp(),
			'note'		=> $note
		);
		 DB::table( 'tb_logs')->insert($data);		;
	
	}	
	
	function btnAction( $row , $id)
	{
	
		$id = SiteHelpers::encryptID($id);
		if($this->access['is_detail'] ==1):
			$val = '<a href="'.URL::to('logs/show/'.$id).'"  class="tips btn btn-xs btn-default"  title="'.Lang::get('core.btn_view').'"
			onclick="SximoModal(this.href,\'Add New\')" 
			> <i class="icon-paragraph-justify"></i> </a>';
		endif;
		
		if($this->access['is_edit'] ==1):
			$val ='<a  href="'.URL::to('logs/add/'.$id).'"  class="tips btn btn-xs btn-success"  title="'.Lang::get('core.btn_edit').'"
			onclick="SximoModal(this.href,\''.Lang::get('core.btn_edit').'\')" ><i class="icon-pencil4"></i></a>';
		endif;	
		return $val;
	}	
	
	function postMultiupload()
	{
		$targetFolder = '/uploads'; // Relative to the root
		
		$verifyToken = md5('unique_salt' . Input::get('timestamp'));
		//!empty($_FILES) &&
	//	if (  Input::get('token') == $verifyToken) {
			$tempFile =  $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				return '1';
			} else {
				return 'Invalid file type.';
			}
		//} else {
			return 'error uploading file';
	//	}	
		
	}	
							

}