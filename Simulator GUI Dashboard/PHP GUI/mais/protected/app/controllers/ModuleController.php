 <?php
 class ModuleController extends BaseController {

    protected $layout = "layouts.main";
    protected $data = array();    
    public $module = 'module';
    
    
    public function __construct() {
        parent::__construct();
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->model = new Module();        

        $this->data = array(
            'pageTitle'    => 'Module',
            'pageNote'    => 'View All Installed Module',
        );
        $driver         = Config::get('database.default');
        $database         = Config::get('database.connections');
        $this->db         = $database[$driver]['database'];
        $this->dbuser     = $database[$driver]['username'];
        $this->dbpass     = $database[$driver]['password'];
        $this->dbhost     = $database[$driver]['host'];
        if(Session::get('gid') != '1'){            
            echo "
            <script type='text/javascript' >
                location.href='".url( 'dashboard' )."';
            </script>                
            ";        
        } 
                
    } 
        
    public function getIndex()
    {

		if(!is_null(Input::get('t')))
		{
			$rowData = DB::table('tb_module')->where('module_type','=','core')
					->orderby('module_title','asc')->get();    
			$type = 'core';        
		} else {
			$rowData = DB::table('tb_module')->where('module_type','=','addon')
						->orderby('module_title','asc')->get();
			$type = 'addon';
		}        

		$this->data['type']    = $type;    
		$this->data['rowData']    = $rowData;
		$this->data['module'] = $this->module;
		$this->layout->nest('content','admin.module.index',$this->data)->with('menus', SiteHelpers::menus());
    }
    
    public function getRebuild( $id = 0)
    {
       
            $row = DB::table('tb_module')->where('module_id', $id)
                                    ->get();
            if(count($row) <= 0){
                return Redirect::to($this->module)
                    ->with('message', SiteHelpers::alert('error','Can not find module'));        
            }
            $row = $row[0];                                    
            $this->data['row'] = $row;    
            $config = SiteHelpers::CF_decode_json($row->module_config); 
            $class         = $row->module_name;
            $ctr = ucwords($row->module_name);
            $path         = $row->module_name;
            // build Field entry 
            $f = '';
            $req = '';
        
            // End Build Field Entry
            
            $codes = array(
                'controller'        => ucwords($class),
                'class'                => $class,
                'fields'            => $f,
                'required'            => $req,
                'table'                => $row->module_db ,
                'title'                => $row->module_title ,
                'note'                => $row->module_note ,
                'key'                => $row->module_db_key,
                'sql_select'                => $config['sql_select'],
                'sql_where'                    => $config['sql_where'],
                'sql_group'                    => $config['sql_group'],
            );                                        
            if(!isset($config['form_layout'])) 
                $config['form_layout'] = array('column'=>1,'title'=>$row->module_title,'format'=>'grid','display'=>'horizontal');
                
            $codes['form_javascript'] = SiteHelpers::toJavascript($config['forms'],$path,$class);
            $codes['form_entry'] = SiteHelpers::toForm($config['forms'],$config['form_layout']);
            $codes['form_display'] = (isset($config['form_layout']['display']) ? $config['form_layout']['display'] : 'horizontal');
            $codes['form_view'] = SiteHelpers::toView($config['grid']);
    
            $setting = array(
                'gridtype'        => (isset($config['setting']) ? $config['setting']['gridtype'] : 'native'  ),
                'orderby'        => (isset($config['setting']) ? $config['setting']['orderby'] : $row->module_db_key  ),
                'ordertype'        => (isset($config['setting']) ? $config['setting']['ordertype'] : 'asc'  ),
                'perpage'        => (isset($config['setting']) ? $config['setting']['perpage'] : '10'  ),
            );    
            
            if($setting['gridtype'] =='ajax')
            {
    
            $controller = file_get_contents(  app_path().'/views/admin/module/template/ajax/controller.tpl' );
                $grid = file_get_contents(  app_path().'/views/admin/module/template/ajax/grid.tpl' );                
                $view = file_get_contents(  app_path().'/views/admin/module/template/ajax/view.tpl' );
                $form = file_get_contents(  app_path().'/views/admin/module/template/ajax/form.tpl' );
                $model = file_get_contents(  app_path().'/views/admin/module/template/ajax/model.tpl' );    
                $table = file_get_contents(  app_path().'/views/admin/module/template/ajax/table.tpl' );
                $toolbar = file_get_contents(  app_path().'/views/admin/module/template/ajax/toolbar.tpl' );        
            
                if($row->module_db_key =='')
                {
                    $controller = file_get_contents(  app_path().'/views/admin/module/template/ajax/controller_view.tpl' );
                    $grid = file_get_contents(  app_path().'/views/admin/module/template/ajax/grid_view.tpl' );
                    $toolbar = file_get_contents(  app_path().'/views/admin/module/template/ajax/toolbar_view.tpl' );
                    $table = file_get_contents(  app_path().'/views/admin/module/template/ajax/table_view.tpl' );
                    
                }                     
                
                $build_controller     = SiteHelpers::blend($controller,$codes);    
                $build_view            = SiteHelpers::blend($view,$codes);    
                $build_form            = SiteHelpers::blend($form,$codes);    
                $build_grid            = SiteHelpers::blend($grid,$codes);    
                $build_table        = SiteHelpers::blend($table,$codes);    
                $build_model        = SiteHelpers::blend($model,$codes);
                $build_toolbar        = SiteHelpers::blend($toolbar,$codes);
    
                if(!is_dir(app_path()."/views/{$class}"))
                {
                        mkdir( app_path()."/views/{$class}" ,0777 );            
                }     
                
                if(!is_null(Input::get('rebuild')))
                {
                    // rebuild spesific files
                    if(Input::get('c') =='y') file_put_contents(  app_path()."/controllers/{$ctr}Controller.php" , $build_controller) ;    
                    if(Input::get('m') =='y') file_put_contents(  app_path()."/models/{$ctr}.php" , $build_model) ;                
                    if(Input::get('g') =='y') file_put_contents(  app_path()."/views/{$class}/index.blade.php" , $build_grid) ;
                    if(Input::get('g') =='y') file_put_contents(  app_path()."/views/{$class}/table.blade.php" , $build_grid) ;
                    if($row->module_db_key !='')
                    {        
                        if(Input::get('f') =='y') file_put_contents(  app_path()."/views/{$class}/form.blade.php" , $build_form) ;
                        if(Input::get('v') =='y') file_put_contents(  app_path()."/views/{$class}/view.blade.php" , $build_view) ;
                    }        
                
                } else {
                    
                    if($row->module_db_key =='')
                    {
                    
                        file_put_contents(  app_path()."/controllers/{$ctr}Controller.php" , $build_controller) ;    
                        file_put_contents(  app_path()."/models/{$ctr}.php" , $build_model) ;
                        file_put_contents(  app_path()."/views/{$class}/index.blade.php" , $build_grid) ;    
                        file_put_contents(  app_path()."/views/{$class}/table.blade.php" , $build_table) ;    
                        file_put_contents(  app_path()."/views/{$class}/toolbar.blade.php" , $build_toolbar) ;        
                    
                    } else {
                    
                        file_put_contents(  app_path()."/controllers/{$ctr}Controller.php" , $build_controller) ;    
                        file_put_contents(  app_path()."/models/{$ctr}.php" , $build_model) ;
                        file_put_contents(  app_path()."/views/{$class}/index.blade.php" , $build_grid) ;                    
                        file_put_contents(  app_path()."/views/{$class}/form.blade.php" , $build_form) ;
                        file_put_contents(  app_path()."/views/{$class}/view.blade.php" , $build_view) ;    
                        file_put_contents(  app_path()."/views/{$class}/table.blade.php" , $build_table) ;
                        file_put_contents(  app_path()."/views/{$class}/toolbar.blade.php" , $build_toolbar) ;
                    }     
                
                }    
            
            
            } else {
            
                // Start Native CRUD 
                
                if($row->module_db_key =='')
                {
                    // No CRUD 
                    $controller = file_get_contents(  app_path().'/views/admin/module/template/controller_view.tpl' );
                    $grid = file_get_contents(  app_path().'/views/admin/module/template/grid_view.tpl' );        
                } else {
                    $controller = file_get_contents(  app_path().'/views/admin/module/template/controller.tpl' );
                    $grid = file_get_contents(  app_path().'/views/admin/module/template/grid.tpl' );        
                }        
        
                $view = file_get_contents(  app_path().'/views/admin/module/template/view.tpl' );
                $form = file_get_contents(  app_path().'/views/admin/module/template/form.tpl' );
                $model = file_get_contents(  app_path().'/views/admin/module/template/model.tpl' );
        
                $build_controller     = SiteHelpers::blend($controller,$codes);    
                $build_view            = SiteHelpers::blend($view,$codes);    
                $build_form            = SiteHelpers::blend($form,$codes);    
                $build_grid            = SiteHelpers::blend($grid,$codes);    
                $build_model        = SiteHelpers::blend($model,$codes);
            
                    
                if(!is_dir(app_path()."/views/{$class}"))
                {
                        mkdir( app_path()."/views/{$class}" ,0777 );            
                }     
                    
                            
                if(!is_null(Input::get('rebuild')))
                {
                    // rebuild spesific files
                    if(Input::get('c') =='y'){

                        file_put_contents(  app_path()."/controllers/{$ctr}Controller.php" , $build_controller) ;    
                    }
                    if(Input::get('m') =='y'){
                        file_put_contents(  app_path()."/models/{$ctr}.php" , $build_model) ;
                    }    
                    
                    if(Input::get('g') =='y'){
                        file_put_contents(  app_path()."/views/{$class}/index.blade.php" , $build_grid) ;
                    }    
                    if($row->module_db_key !='')
                    {            
                        if(Input::get('f') =='y'){
                            file_put_contents(  app_path()."/views/{$class}/form.blade.php" , $build_form) ;
                        }    
                        if(Input::get('v') =='y'){
                            file_put_contents(  app_path()."/views/{$class}/view.blade.php" , $build_view) ;
                        }
                    }        
                
                } else {
                
                    file_put_contents(  app_path()."/controllers/{$ctr}Controller.php" , $build_controller) ;    
                    file_put_contents(  app_path()."/models/{$ctr}.php" , $build_model) ;
        
                    file_put_contents(  app_path()."/views/{$class}/index.blade.php" , $build_grid) ;
                    if($row->module_db_key !='')
                    {
                        file_put_contents(  app_path()."/views/{$class}/form.blade.php" , $build_form) ;
                        file_put_contents(  app_path()."/views/{$class}/view.blade.php" , $build_view) ;        
                    }                         
                
                }                    
                
                // end Native CRUD 
            }
    
    
        
            
            self::createRouters();
    
            return Redirect::to('module')->with('message',SiteHelpers::alert('success','Code Script has been replaced successfull'));
 
    }
    
    
    function getAdd()
    {

		$this->data = array(
			'pageTitle'    => 'Create New Module',
			'pageNote'    => 'Create Quick Module ',
		);        
	
		$this->data['tables'] = Module::getTableList($this->db);
		$this->layout->nest('content','admin.module.add',$this->data)
		->with('menus', SiteHelpers::menus());    
      
    
    }
    
    function getDestroy( $id = null )
    {
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();        
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];
        $path = $row->module_name;    
        $class = ucwords($row->module_name);                            
        if($row->module_type !='core')
        {
            
            if($class !='') {
                
                if(file_exists(  app_path()."/controllers/{$class}Controller.php")) 
                    unlink( app_path()."/controllers/{$class}Controller.php");
                    
                if(file_exists( app_path()."/models/{$class}.php")) 
                    unlink( app_path()."/models/{$class}.php");
                    
                self::removeDir( app_path()."/views/{$class}");
                DB::table('tb_module')->where('module_id','=',$row->module_id)->delete();
                DB::table('tb_groups_access')->where('module_id','=',$row->module_id)->delete();
                self::createRouters();
                
                return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('success','Module has been removed successfull'));                
                
            }    
            
        }
        return Redirect::to($this->module)
        ->with('message', SiteHelpers::alert('error','No Module removed !'));
                                
    }
    
    function removeDir($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                removedir($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }    
    
    function postCreate()
    {
        $rules = array(
            'module_name'    =>'required|alpha|min:2|unique:tb_module',
            'module_title'    =>'required',
            'module_note'    =>'required',
            'module_db'        =>'required',
        );    
        
        $validator = Validator::make(Input::all(), $rules);    
        if ($validator->passes()) {
            
            $table = Input::get('module_db');    
            $primary = self::findPrimarykey(Input::get('module_db'));
            
            $select = Input::get('sql_select');
            $where     = Input::get('sql_where');
            $group     = Input::get('sql_group');    

            if(Input::get('creation') == 'manual')
            {
                if($where =="")                
                {
                    return Redirect::to($this->module.'/add')                    
                    ->withErrors($validator)->withInput()->with('message', SiteHelpers::alert('error',"SQL WHERE REQUIRED"));
                }
                
                try {
                
                    DB::select( $select .' '.$where.' '.$group );            
                    
                }catch(Exception $e){
                    // Do something when query fails. 
                    $error ='Error : '.$select .' '.$where.' '.$group ;
                    return Redirect::to($this->module.'/add')                    
                    ->withErrors($validator)->withInput()->with('message', SiteHelpers::alert('error',$error));
                }                
                $columns = array();
                $results = $this->model->getColoumnInfo($select .' '.$where.' '.$group);
                //echo '<pre>'; print_r($results); echo '</pre>';    exit;
                $primary_exits = '';
                foreach($results as $r)
                {
                    $Key = (isset($r['flags'][1]) && $r['flags'][1] =='primary_key'  ? 'PRI' : '');
                    if($Key !='') $primary_exits = $r['name'];
                    $columns[] = (object) array('Field'=> $r['name'],'Table'=> $r['table'],'Type'=>$r['native_type'],'Key'=>$Key); 
                }
                $primary  = ($primary_exits !='' ? $primary_exits : '');    
                
                        
                
            } else {
                $columns = DB::select("SHOW COLUMNS FROM ".Input::get('module_db'));
                $select =  " SELECT {$table}.* FROM {$table} ";
                $where = " WHERE ".$table.".".$primary." IS NOT NULL";
                if($primary !='') {
                    $where     = " WHERE ".$table.".".$primary." IS NOT NULL";
                } else { $where  ='' ;}
                
            }
        //    echo '<pre>'; print_r($columns); echo '</pre>';    exit;
            
            $i = 0; $rowGrid = array();$rowForm = array();
            foreach($columns as $column)
            {
                if(!isset($column->Table)) $column->Table = $table;
                if($column->Key =='PRI') $column->Type ='hidden';
                if($column->Table == $table) 
                {                
                    $form_creator = self::configForm($column->Field,$column->Table,$column->Type,$i);
                    $relation = self::buildRelation($table ,$column->Field);
                    foreach($relation as $row) 
                    {
                        $array = array('external',$row['table'],$row['column']);
                        $form_creator = self::configForm($column->Field,$table,'select',$i,$array);
                        
                    }
                    $rowForm[] = $form_creator;
                }    
                
                $rowGrid[] = self::configGrid($column->Field,$column->Table,$column->Type,$i);                
                $i++;
            }    

            $setting = array(
                'gridtype'        => Input::get('module_template'),
                'orderby'        => $primary ,
                'ordertype'        => 'asc' ,
                'perpage'        => '10'  ,
                'frozen'        => 'false',    
                
            );                        

        //    echo '<pre>'; print_r($rowGrid); echo '</pre>';    exit;
            $json_data['sql_select']     = $select;
            $json_data['sql_where']     = $where;
            $json_data['sql_group']        = $group;
            $json_data['table_db']        = $table ;
            $json_data['primary_key']    = $primary;
            $json_data['grid']    = $rowGrid ;
            $json_data['forms']    = $rowForm ;        
            $json_data['setting']    = $setting ;                                
            //echo '<pre>'; print_r($json_data); echo '</pre>';    exit;    
                
            $data = array(
                'module_name'    =>Input::get('module_name'),
                'module_title'    =>Input::get('module_title'),
                'module_note'    =>Input::get('module_note'),
                'module_db'        =>Input::get('module_db'),    
                'module_db_key' => $primary,
                'module_type'     => 'addon',
                'module_created'     => date("Y-m-d H:i:s"),
                'module_config' => SiteHelpers::CF_encode_json($json_data),            
            );
            
            
            DB::table('tb_module')->insert($data);
            
            // Add Default permission
            $tasks = array(
                'is_global'        => 'Global',
                'is_view'        => 'View ',
                'is_detail'        => 'Detail',
                'is_add'        => 'Add ',
                'is_edit'        => 'Edit ',
                'is_remove'        => 'Remove ',
                'is_excel'        => 'Excel ',    
                
            );                    
            $groups = DB::table('tb_groups')->get();
            $row = DB::table('tb_module')->where('module_name',Input::get('module_name'))->get();        
            if(count($row) >= 1)
            {
                $id = $row[0];
                
                foreach($groups as $g)
                {
                    $arr = array();
                    foreach($tasks as $t=>$v)            
                    {
                        if($g->group_id =='1') {
                            $arr[$t] = '1' ;
                        } else {
                            $arr[$t] = '0' ;
                        }    
                    
                    }        
                    $data = array
                    (
                        "access_data"    => json_encode($arr),
                        "module_id"        => $id->module_id,                
                        "group_id"        => $g->group_id,
                    );
                    DB::table('tb_groups_access')->insert($data);    
                }
                            
                
                return Redirect::to($this->module.'/rebuild/'.$id->module_id);        
            } else {
                return Redirect::to($this->module);
            }
            
                
            
        } else {
            return Redirect::to($this->module.'/add')
            ->with('message', SiteHelpers::alert('error','The following errors occurred'))
            ->withErrors($validator)->withInput();
        }                    
    
    }
    
    function findPrimarykey( $table )
    {
        $query = "SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'";
        $primaryKey = '';
        foreach(DB::select("SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'") as $key)
        {
            $primaryKey = $key->Column_name;
        }
        return $primaryKey;    
    }    
    
    function buildRelation( $table , $field)
    {

        $pdo = DB::getPdo();
        $sql = "
        SELECT
            referenced_table_name AS 'table',
            referenced_column_name AS 'column'
        FROM
            information_schema.key_column_usage
        WHERE
            referenced_table_name IS NOT NULL
            AND table_schema = '".$this->db."'  AND table_name = '{$table}' AND column_name = '{$field}' ";
        $Q = $pdo->query($sql);
        $rows = array();
        while ($row =  $Q->fetch()) {
            $rows[] = $row;
        } 
        return $rows;    

    
    }    
    
    
    function getConfig( $id )
    {
        
	
		$row = DB::table('tb_module')->where('module_name', $id)
								->get();        
		if(count($row) <= 0){
			return Redirect::to($this->module)
				->with('message', SiteHelpers::alert('error','Can not find module'));        
		}
		$row = $row[0];                            
		$this->data['row'] = $row;            
		$this->data['module'] = $this->module;
		$this->data['module_lang'] = json_decode($row->module_lang,true);    
		$this->data['module_name'] = $row->module_name;
		$config = SiteHelpers::CF_decode_json($row->module_config,true); 
		$this->data['setting'] = array(
			'gridtype'        => (isset($config['setting']) ? $config['setting']['gridtype'] : 'native'  ),
			'orderby'        => (isset($config['setting']) ? $config['setting']['orderby'] : $row->module_db_key  ),
			'ordertype'        => (isset($config['setting']) ? $config['setting']['ordertype'] : 'asc'  ),
			'perpage'        => (isset($config['setting']) ? $config['setting']['perpage'] : '10'  ),
			'frozen'        => (isset($config['setting']['frozen'])  ? $config['setting']['frozen'] : 'false'  ),
		);            
		$this->data['tables']     = $config['grid'];        
		
		$this->layout->nest('content','admin.module.config',$this->data);        
                                                 
    }
    
    function postSaveconfig()
    {
        
        $rules = array(
            'module_title'=>'required',
            'module_id'  =>'required',
        );    
        $validator = Validator::make(Input::all(), $rules);    
        if ($validator->passes()) {
            $data = array(
                'module_title'    => Input::get('module_title'),
                'module_note'    => Input::get('module_note'),
            );
            $lang = SiteHelpers::langOption();
            $language =array();
            foreach($lang as $l)
            {
                if($l['folder'] !='en'){
                    $label_lang = (isset($_POST['language_title'][$l['folder']]) ? $_POST['language_title'][$l['folder']] : ''); 
                    $note_lang = (isset($_POST['language_note'][$l['folder']]) ? $_POST['language_note'][$l['folder']] : ''); 
                    
                    $language['title'][$l['folder']] = $label_lang;    
                    $language['note'][$l['folder']] = $note_lang;        
                }    
            }
            
            $data['module_lang'] = json_encode($language);        
            $id = Input::get('module_id');
            $affected = DB::table('tb_module')->where('module_id', '=',$id )->update($data);

            return Redirect::to($this->module.'/config/'.Input::get('module_name'))
            ->with('message', SiteHelpers::alert('success','Module Info Has Been Save Successfull'));
        } else {
            return Redirect::to($this->module.'/config/'.Input::get('module_name'))
            ->with('message', SiteHelpers::alert('error','The following errors occurred'))
            ->withErrors($validator)->withInput();
        }        
    }    
    
    public function postSavesetting()
    {
        $this->beforeFilter('csrf', array('on'=>'post'));
        
        $id = Input::get('module_id');
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }                                
        $row = $row[0];        
        $config = SiteHelpers::CF_decode_json($row->module_config); 
        $setting = array(
            'gridtype'        => Input::get('grid-type') ,
            'orderby'        => Input::get('orderby') ,
            'ordertype'        => Input::get('ordertype') ,
            'perpage'        => Input::get('perpage') ,
            'frozen'        => (!is_null(Input::get('frozen'))  ? 'true' : 'false' ) ,
        
            
        );
        if(isset($config['setting'])) unset($config['setting']);

        $new_config =     array_merge($config,array("setting" => $setting));
        $data['module_config'] = SiteHelpers::CF_encode_json($new_config);
        
        $affected = DB::table('tb_module')
            ->where('module_id', '=',$id )
            ->update(array('module_config' => SiteHelpers::CF_encode_json($new_config)));        

        return Redirect::to($this->module.'/config/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','Module Setting Has Been Save Successfull'));    
                
        
    }        
    
    function getSql( $id )
    {


		$row = DB::table('tb_module')->where('module_name', $id)
								->get();
		if(count($row) <= 0){
			return Redirect::to($this->module)
				->with('message', SiteHelpers::alert('error','Can not find module'));        
		}
		$row = $row[0];                                    
		$this->data['row'] = $row;        
		$config = SiteHelpers::CF_decode_json($row->module_config); 
		$this->data['sql_select']     = $config['sql_select'];
		$this->data['sql_where']     = $config['sql_where'];
		$this->data['sql_group']     = $config['sql_group'];            
		$this->data['module_name'] = $row->module_name;    
		$this->data['module'] = $this->module;
		$this->layout->nest('content','admin.module.ConfigSql',$this->data)
							->with('menus', SiteHelpers::menus());
                               
    }
    
    function postSavesql( $id )
    {

        $select = Input::get('sql_select');
        $where     = Input::get('sql_where');
        $group     = Input::get('sql_group');
        
        try {
        
            DB::select( $select .' '.$where.' '.$group );            
            
        }catch(Exception $e){
            // Do something when query fails. 
            $error ='Error : '.$select .' '.$where.' '.$group ;
            return Redirect::to($this->module.'/sql/'.Input::get('module_name'))
            ->with('message', SiteHelpers::alert('error',$error));
        }
        
        $row = DB::table('tb_module')->where('module_name', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        
        $row = $row[0];        
        $config = SiteHelpers::CF_decode_json($row->module_config); 
                                    
        $this->data['row'] = $row;    

        $pdo = DB::getPdo();
        $columns = $this->model->getColoumnInfo($select .' '.$where.' '.$group);
        $i =0;$form =array(); $grid = array();
        foreach($columns as $field)
        {
            
            
            $name = $field['name'];    $alias = $field['table'];    
            $grids =  self::configGrid( $name , $alias , '' ,$i);

            foreach($config['grid'] as $g) 
            {
                if(!isset($g['type'])) $g['type'] = 'text';
                if($g['field'] == $name && $g['alias'] == $alias) 
                {
                    $grids = $g;                
                } 
            }
            $grid[] = $grids ;
            
            if($row->module_db == $alias ) 
            {
                $forms = self::configForm($name,$alias,'text',$i);
                foreach($config['forms'] as $f)
                {
                    if($f['field'] == $name && $f['alias'] == $alias) 
                    {                            
                        $forms = $f;                            
                    }
                }                
                $form[] = $forms ;
            }    
                            
            
             $i++;    
        }

        //echo '<pre>';print_r($grid); echo '</pre>'; exit;
            // Remove Old Grid
            unset($config["forms"]);
            // Remove Old Form    
            unset($config["grid"]);
            // Remove Old Query    
            unset($config["sql_group"]);
            unset($config["sql_select"]);            
            unset($config["sql_where"]);            
                        
            // Inject New Grid     
            $new_config = array(
                "sql_select"         => $select ,
                "sql_where"            => $where ,
                "sql_group"            => $group,
                "grid"                 => $grid,
                "forms"             => $form                
            );    
            
        $config =     array_merge($config,$new_config);

        $affected = DB::table('tb_module')
            ->where('module_id', '=',$row->module_id )
            ->update(array('module_config' => SiteHelpers::CF_encode_json($config)));            
                
        return Redirect::to($this->module.'/sql/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','SQL Has Changed Successful.'));        
                        
    
    
    }    
    
    function getTable( $id )
    {
    
		$row = DB::table('tb_module')->where('module_name', $id)
								->get();
		if(count($row) <= 0){
			return Redirect::to($this->module)
				->with('message', SiteHelpers::alert('error','Can not find module'));        
		}
		$row = $row[0];                                    
		$this->data['row'] = $row;    
		$config = SiteHelpers::CF_decode_json($row->module_config); 
		$this->data['tables']     = $config['grid'];
						
		$this->data['module'] = $this->module;
		$this->data['module_name'] = $row->module_name;
		$this->layout->nest('content','admin.module.ConfigTable',$this->data)
							->with('menus', SiteHelpers::menus());
                               
    }

    public function postSavetable()
    {
      
        $id = Input::get('module_id');
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }                                
        $row = $row[0];        
        $config = SiteHelpers::CF_decode_json($row->module_config); 
        $lang = SiteHelpers::langOption();
        $grid = array();
        $total = count($_POST['field']);
        extract($_POST);
        for($i=1; $i<= $total ;$i++) {    
            $language =array();
            foreach($lang as $l)
            {
                if($l['folder'] !='en'){
                    $label_lang = (isset($_POST['language'][$i][$l['folder']]) ? $_POST['language'][$i][$l['folder']] : ''); 
                    $language[$l['folder']] =$label_lang;        
                }    
            }    
            $grid[] = array(
                'field'        => $field[$i],
                'alias'        => $alias[$i],
                'language'    => $language,
                'label'        => $label[$i],
                'view'        => (isset($view[$i]) ? 1 : 0 ),
                'detail'    => (isset($detail[$i]) ? 1 : 0 ),
                'sortable'    => (isset($sortable[$i]) ? 1 : 0 ),
                'search'    => (isset($search[$i]) ? 1 : 0 ) ,
                'download'    => (isset($download[$i]) ? 1 : 0 ),
                'frozen'    => (isset($frozen[$i]) ? 1 : 0 ),
                'width'        => $width[$i],
                'align'        => $align[$i],
                'sortlist'    => $sortlist[$i],
                'conn'    =>     array(
                            'valid'     => $conn_valid[$i],
                            'db'        => $conn_db[$i],
                            'key'        => $conn_key[$i],
                            'display'    => $conn_display[$i]
                ),
                'attribute'    => array(
                    'hyperlink'    => array(
                            'active'        => (isset($attr_link_active[$i]) ? 1 : 0 ) ,
                            'link'            => $attr_link[$i],
                            'target'        => (isset($attr_target[$i]) ? $attr_target[$i] : 'native' ),
                            'html'            => $attr_link_html[$i],
                        ),
                    'image'        => array(
                            'active'        => (isset($attr_image_active[$i]) ? 1 : 0 ),
                            'path'            => $attr_image[$i],
                            'size_x'        => $attr_image_width[$i],
                            'size_y'        => $attr_image_height[$i],
                            'html'            => $attr_image_html[$i],
                        ),
                    'formater'        => array(
                            'active'        => (isset($attr_formater_active[$i]) ? 1 : 0 ),
                            'value'            => (isset($attr_formater_value[$i]) ? $attr_formater_value[$i] : '' ),
                        )                        
                )                     
            );
            
        }

        unset($config["grid"]);
        $new_config =     array_merge($config,array("grid" => $grid));
        $data['module_config'] = SiteHelpers::CF_encode_json($new_config);
        
        //echo '<pre>'; print_r($new_config); echo '</pre>';    exit;
        
        $affected = DB::table('tb_module')
            ->where('module_id', '=',$id )
            ->update(array('module_config' => SiteHelpers::CF_encode_json($new_config)));        

        return Redirect::to($this->module.'/table/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','Module Table Has Been Save Successfull'));        
        
        
    }    
    
    function getConn( $id )
    {
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                            
        $this->data['row'] = $row;    
        $config = SiteHelpers::CF_decode_json($row->module_config); 

        $module_id = $id;
        $field_id     = Input::get('field'); 
        $alias         = Input::get('alias'); 
        $f = array();
        foreach($config['grid'] as $form)
        {
            if($form['field'] == $field_id)
            {
                
                $f = array(
                    'db'        => (isset($form['conn']['db']) ? $form['conn']['db'] : ''),
                    'key'        => (isset($form['conn']['key']) ? $form['conn']['key'] : ''),
                    'display'    => (isset($form['conn']['display']) ? $form['conn']['display'] : ''),
                    );    
            }    
        }
        
        $this->data['module_id']     = $id;    
        $this->data['f']     = $f;
        $this->data['module'] = $this->module;
        $this->data['module_name'] = $row->module_name;    
        $this->data['field_id'] = $field_id ;    
        $this->data['alias'] = $alias;            
        return View::make('admin.module.ConfigEditConn',$this->data);
    }
    
    function postConn()
    {
        $id = Input::get('module_id');
        $field_id     = Input::get('field_id'); 
        $alias         = Input::get('alias');         
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                
                                
        $this->data['row'] = $row;
        $fr = array();    
        $config = SiteHelpers::CF_decode_json($row->module_config); 
        foreach($config['grid'] as $form)
        {
            if($form['field'] == $field_id && $form['alias'] == $alias )
            {
                if(Input::get('db') !='')
                {                    
                    $value = implode("|",Input::get('display'));
                    $form['conn'] = array(
                        'valid'        => '1',
                        'db'        => Input::get('db'),
                        'key'        => Input::get('key'),
                        'display'    => implode("|",array_filter(Input::get('display'))),
                        );                        
                } else {
                    
                    $form['conn'] = array(
                        'valid'        => '0',
                        'db'        => '',
                        'key'        => '',
                        'display'    => '',
                        );    

                }
                $fr[] =  $form;    
            }    else {
                $fr[] =  $form;
            }
        }    
        unset($config["grid"]);
        $new_config =     array_merge($config,array("grid" => $fr));
        
    //    echo '<pre>'; print_r($new_config); echo '</pre>';    exit;
        $affected = DB::table('tb_module')
            ->where('module_id', '=',$id )
            ->update(array('module_config' => SiteHelpers::CF_encode_json($new_config)));    
                    
        return Redirect::to($this->module.'/table/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','Module Forms Has Changed Successful.'));                
        //return SiteHelpers::alert('success','Connection has been save successfull');            

    }
    

    
    function getFormdesign( $id)
    {
    
        $row = DB::table('tb_module')->where('module_name', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                    
        $this->data['row'] = $row;    
        $config = SiteHelpers::CF_decode_json($row->module_config); 
        $this->data['forms']     = $config['forms'];                
        $this->data['module'] = $this->module;
        $this->data['form_column'] = (isset($config['form_column']) ? $config['form_column'] : 1 );    
        if(!is_null(Input::get('block')))     $this->data['form_column'] = Input::get('block');
        
        if(!isset($config['form_layout']))
        {
            $this->data['title'] = array($row->module_name);
            $this->data['format'] = 'grid';
            $this->data['display'] = 'horizontal';
            
            
        } else {
            $this->data['title']     =    explode(",",$config['form_layout']['title']);
            $this->data['format']     =    $config['form_layout']['format'];    
            $this->data['display']     =    (isset($config['form_layout']['display']) ? $config['form_layout']['display']: 'horizontal');        
        }
        $this->data['module_name'] = $row->module_name;
        $this->layout->nest('content','admin.module.ConfigFormDesign',$this->data)
                            ->with('menus', SiteHelpers::menus());    
    }
    
    function postFormdesign()
    {
    
        $id = Input::get('module_id');
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                
                                
        $this->data['row'] = $row;    
        $config = SiteHelpers::CF_decode_json($row->module_config); 
        $data = $_POST['reordering'];
        $data = explode('|',$data);
        $currForm = $config['forms'];
        
        foreach($currForm as $f)
        {
            $cform[$f['field']] = $f;     
        }    
    
        $i = 0; $order = 0;
        $f = array();
        foreach($data as $dat)
        {
            
            $forms = explode(",",$dat);
            foreach($forms as $form)
            {
                if(isset($cform[$form]))
                {
                    $cform[$form]['form_group'] = $i;
                    $cform[$form]['sortlist'] = $order;
                    $f[] = $cform[$form];
                }
                $order++;
            }
            $i++;
            
        }    
    //    echo '<pre>'; print_r($f); echo '</pre>';    exit;
        $config['form_column'] = count($data);
        $config['form_layout'] = array(
            'column'    => count($data),
            'title' => implode(',',Input::get('title')) ,
            'format' => Input::get('format'),
            'display' => Input::get('display')
            
        );
        
    //    echo '<pre>'; print_r($config); echo '</pre>';    exit;
        unset($config["forms"]);
        $new_config =     array_merge($config,array("forms" => $f));
        $data['module_config'] = SiteHelpers::CF_encode_json($new_config);
        
    //    echo '<pre>'; print_r($new_config); echo '</pre>';    exit;
        $affected = DB::table('tb_module')
            ->where('module_id', '=',$id )
            ->update(array('module_config' => SiteHelpers::CF_encode_json($new_config)));            
                
        return Redirect::to($this->module.'/formdesign/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','Module Forms Has Changed Successful.'));            


    }
    
    function getForm( $id )
    {
    
            $row = DB::table('tb_module')->where('module_name', $id)
                                    ->get();
            if(count($row) <= 0){
                return Redirect::to($this->module)
                    ->with('message', SiteHelpers::alert('error','Can not find module'));        
            }
            $row = $row[0];                                    
            $this->data['row'] = $row;    
            $config = SiteHelpers::CF_decode_json($row->module_config); 
            
            $this->data['forms']     = $config['forms'];    
            $this->data['form_column'] = (isset($config['form_column']) ? $config['form_column'] : 1 );        
            $this->data['module'] = $this->module;
            $this->data['module_name'] = $row->module_name;
            $this->layout->nest('content','admin.module.ConfigForm',$this->data)
                                ->with('menus', SiteHelpers::menus());
                             
    }
    

    function postSaveform()
    {
        
        $id = Input::get('module_id');
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                
                                
        $this->data['row'] = $row;    
        $config = SiteHelpers::CF_decode_json($row->module_config); 
        $lang = SiteHelpers::langOption();
        $this->data['tables']     = $config['grid'];
        $total = count($_POST['field']);
        extract($_POST);    
        $f = array();
        for($i=1; $i<= $total ;$i++) {        

            $language =array();
            foreach($lang as $l)
            {
                if($l['folder'] !='en'){
                    $label_lang = (isset($_POST['language'][$i][$l['folder']]) ? $_POST['language'][$i][$l['folder']] : ''); 
                    $language[$l['folder']] =$label_lang;        
                }    
            }    
    
            $f[] = array(
                "field"         => $field[$i],
                "alias"         => $alias[$i],
                "language"         => $language,
                "label"         => $label[$i],
                'form_group'    => $form_group[$i],
                'required'        => (isset($required[$i]) ? $required[$i] : 0 ),
                'view'            => (isset($view[$i]) ? 1 : 0 ),
                'type'            => $type[$i],
                'add'            => 1,
                'size'            => '0',
                'edit'            => 1,
                'search'        => (isset($search[$i]) ? $search[$i] : 0 ),
                "sortlist"         => $sortlist[$i] ,
                'option'        => array(
                    "opt_type"                 => $opt_type[$i],
                    "lookup_query"             => $lookup_query[$i],
                    "lookup_table"             => $lookup_table[$i],
                    "lookup_key"             => $lookup_key[$i],
                    "lookup_value"            => $lookup_value[$i],
                    'is_dependency'            => $is_dependency[$i],
                    'is_multiple'            => (isset($is_multiple[$i]) ? $is_multiple[$i] : 0),
                    'lookup_dependency_key'    => $lookup_dependency_key[$i],
                    'path_to_upload'        => $path_to_upload[$i],
                    'resize_width'            => $resize_width[$i],
                    'resize_height'            => $resize_height[$i],                    
                    'upload_type'            => $upload_type[$i],
                    'tooltip'                => $tooltip[$i],
                    'attribute'                => $attribute[$i],
                    'extend_class'            => $extend_class[$i]
                    ),    
                );
        }
        
        unset($config["forms"]);
        $new_config =     array_merge($config,array("forms" => $f));
        $data['module_config'] = SiteHelpers::CF_encode_json($new_config);
        //echo '<pre>'; print_r($new_config); echo '</pre>';    exit;
        $affected = DB::table('tb_module')
            ->where('module_id', '=',$id )
            ->update(array('module_config' => SiteHelpers::CF_encode_json($new_config)));            
                
        return Redirect::to($this->module.'/form/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','Module Forms Has Changed Successful.'));            
    }    
    
    function getEditform( $id )
    {
    
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                            
        $this->data['row'] = $row;    
        $config = SiteHelpers::CF_decode_json($row->module_config); 

        $module_id = $id;
        $field_id     = Input::get('field'); 
        $alias         = Input::get('alias'); 
                
        $f = array();
        foreach( $config['forms'] as $form )
        {            
            $tooltip = '';$attribute = '';
            if(isset($form['option']['tooltip'])) $tooltip = $form['option']['tooltip'];
            if(isset($form['option']['attribute'])) $attribute = $form['option']['attribute'];
            $size = isset($form['size']) ? $form['size'] : 'span12'; 
            if($form['field'] == $field_id && $form['alias'] == $alias)
            {
                //$multiVal = explode(":",$form['option']['lookup_value']);
                $f = array(
                    "field"     => $form['field'],
                    "alias"     => $form['alias'],
                    "label"     =>  $form['label'],
                    'form_group'    =>  $form['form_group'],
                    'required'        => $form['required'],
                    'view'            => $form['view'],
                    'type'            => $form['type'],
                    'add'            => $form['add'],
                    'size'            => $size,
                    'edit'            => $form['edit'],
                    'search'        => $form['search'],
                    "sortlist"         => $form['sortlist'] ,
                    'option'        => array(
                        "opt_type"                 => $form['option']['opt_type'],
                        "lookup_query"             => $form['option']['lookup_query'],
                        "lookup_table"             => $form['option']['lookup_table'],
                        "lookup_key"             => $form['option']['lookup_key'],
                        "lookup_value"            => $form['option']['lookup_value'],
                        'is_dependency'            => $form['option']['is_dependency'],
                        'is_multiple'            => (isset($form['option']['is_multiple']) ? $form['option']['is_multiple'] : 0 ) ,
                        'lookup_dependency_key'    => $form['option']['lookup_dependency_key'],
                        'path_to_upload'        => $form['option']['path_to_upload'],
                        'upload_type'            => $form['option']['upload_type'],
                        'resize_width'            => isset( $form['option']['resize_width'])?$form['option']['resize_width']:'' ,
                        'resize_height'            => isset( $form['option']['resize_height'])? $form['option']['resize_height']:'',
                        'extend_class'            => isset( $form['option']['extend_class'])?$form['option']['extend_class']:'',
                        'tooltip'                => $tooltip ,
                        'attribute'                => $attribute,
                        'extend_class'            => isset( $form['option']['extend_class'])?$form['option']['extend_class']:''
                        ),    
                    );                
            }
        }


        $this->data['field_type_opt'] = array(
            'text'            => 'Text' ,
            'text_date'        => 'Date',
            'text_datetime'        => 'Date & Time',
            'textarea'        => 'Textarea',
            'textarea_editor'    => 'Textarea With Editor ',
            'select'        => 'Select Option',
            'radio'            => 'Radio' ,
            'checkbox'        => 'Checkbox',
            'file'            => 'Upload File',            
            'hidden'        => 'Hidden',
                    
        );
        
        $this->data['tables']        = $this->model->getTableList($this->db);    
        $this->data['f']     = $f;    
        $this->data['module_id']     = $id;    
        
        $this->data['module'] = $this->module;
        $this->data['module_name'] = $row->module_name;
        return View::make('admin.module.ConfigEditField',$this->data);
    }        
    
    function postSaveformfield()
    {

    
        $lookup_value = (is_array(Input::get('lookup_value')) ? implode("|",array_filter(Input::get('lookup_value'))) : '');        
        $id = Input::get('module_id');
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                    
        $this->data['row'] = $row;    
        $config = SiteHelpers::CF_decode_json($row->module_config);     

        $view = 0;$search = 0;
        if(!is_null(Input::get('view'))) $view = 1; 
        if(!is_null(Input::get('search'))) $search = 1; 
    
        if(preg_match('/(select|radio|checkbox)/',Input::get('type'))) 
        {
            if(Input::get('opt_type') == 'datalist')
            {
                $datalist = '';
                $cf_val     = Input::get('custom_field_val');
                $cf_display = Input::get('custom_field_display');
                for($i=0; $i<count($cf_val);$i++)
                {
                    $value         = $cf_val[$i];
                    if(isset($cf_display[$i])) { $display = $cf_display[$i]; } else { $display ='none';}
                    $datalist .= $value.':'.$display.'|';
                }
                $datalist = substr($datalist,0,strlen($datalist)-1);
            
            } else {
                $datalist = ''; 
            }
        }  else {
            $datalist = '';
        }
                 
        $new_field = array(
            "field"         => Input::get('field'),
            "alias"         => Input::get('alias'),
            "label"         => Input::get('label'),
            "form_group"     => Input::get('form_group'),
            'required'        => Input::get('required'),
            'view'            => $view,
            'type'            => Input::get('type'),
            'add'            => 1,
            'edit'            => 1,
            'search'        => Input::get('search'),
            'size'            =>     '',
            'sortlist'        => Input::get('sortlist'),
            'option'        => array(
                "opt_type"         =>  Input::get('opt_type'),
                "lookup_query"     =>  $datalist,
                "lookup_table"     =>  Input::get('lookup_table'),
                "lookup_key"     =>  Input::get('lookup_key'),
                "lookup_value"    =>     $lookup_value,
                'is_dependency'    =>  Input::get('is_dependency'),
                'is_multiple'    =>  Input::get('is_multiple'),
                'lookup_dependency_key'=>  Input::get('lookup_dependency_key'),
                'path_to_upload'=>  Input::get('path_to_upload'),
                'upload_type'    =>  Input::get('upload_type'),
                'resize_width'    =>  Input::get('resize_width'),
                'resize_height'    =>  Input::get('resize_height'),
                'tooltip'        =>  Input::get('tooltip'),
                'attribute'        =>  Input::get('attribute'),
                'extend_class'    =>  Input::get('extend_class')
                )            
        );
        //print_r($_POST);
        $forms = array();
        foreach($config['forms'] as $form_view)
        {
            if($form_view['field'] == Input::get('field') && $form_view['alias'] == Input::get('alias') ) 
            {
                $new_form = $new_field;        
            } else     {
                $new_form  = $form_view;
            }    
            $forms[] = $new_form ;
    
        }    
    
        
        unset($config["forms"]);
        $new_config =     array_merge($config,array("forms" => $forms));    
        //echo '<pre>'; print_r($new_config); echo '</pre>';    exit;
        
        $affected = DB::table('tb_module')
            ->where('module_id', '=',$id )
            ->update(array('module_config' => SiteHelpers::CF_encode_json($new_config)));            
                
        return Redirect::to($this->module.'/form/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','Forms Has Changed Successful.')); 
    }    
    
    function getPermission( $id )
    {

            $row = DB::table('tb_module')->where('module_name', $id)
                                    ->get();
            if(count($row) <= 0){
                return Redirect::to($this->module)
                    ->with('message', SiteHelpers::alert('error','Can not find module'));        
            }
            $row = $row[0];                                    
            $this->data['row'] = $row;            
            $this->data['module'] = $this->module;
            $this->data['module_name'] = $row->module_name;
            $config = SiteHelpers::CF_decode_json($row->module_config);                         
        
            $tasks = array(
                'is_global'        => 'Global ',
                'is_view'        => 'View ',
                'is_detail'        => 'Detail',
                'is_add'        => 'Add ',
                'is_edit'        => 'Edit ',
                'is_remove'        => 'Remove ',
                'is_excel'        => 'Excel ',            
            );    
            /* Update permission global / own access new ver 1.1
               Adding new param is_global
               End Update permission global / own access new ver 1.1
            */   
            if(isset($config['tasks'])) {
                foreach($config['tasks'] as $row)
                {
                    $tasks[$row['item']] = $row['title'];
                }
            }
            $this->data['tasks'] = $tasks;        
            $this->data['groups'] = DB::table('tb_groups')->get();
    
            $access = array();
            foreach($this->data['groups'] as $r)        
            {
            //    $GA = $this->model->gAccessss($this->uri->rsegment(3),$row['group_id']);
                $group = ($r->group_id !=null ? "and group_id ='".$r->group_id."'" : "" );
                $GA = DB::select("SELECT * FROM tb_groups_access where module_id ='".$row->module_id."' $group");
                if(count($GA) >=1){
                    $GA = $GA[0];
                }
                
                $access_data = (isset($GA->access_data) ? json_decode($GA->access_data,true) : array());
                $rows = array();
                //$access_data = json_decode($AD,true);
                $rows['group_id'] = $r->group_id;
                $rows['group_name'] = $r->name;
                foreach($tasks as $item=>$val)
                {
                    $rows[$item] = (isset($access_data[$item]) && $access_data[$item] ==1  ? 1 : 0);
                }
                $access[$r->name] = $rows;
                
            
            }
            $this->data['access'] = $access;                    
            $this->data['groups_access'] = DB::select("select * from tb_groups_access where module_id ='".$row->module_id."'");
            
            $this->layout->nest('content','admin.module.ConfigPermission',$this->data)
                                ->with('menus', SiteHelpers::menus());
                      
                            
    }
    
    function postSavepermission()
    {
    
        $id = Input::get('module_id');
        $row = DB::table('tb_module')->where('module_id', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                    
        $this->data['row'] = $row;    
        $config = SiteHelpers::CF_decode_json($row->module_config); 
        $tasks = array(
            'is_global'        => 'Global ',
            'is_view'        => 'View ',
            'is_detail'        => 'Detail',
            'is_add'        => 'Add ',
            'is_edit'        => 'Edit ',
            'is_remove'        => 'Remove ',
            'is_excel'        => 'Excel ',            
        );    
        /* Update permission global / own access new ver 1.1
           Adding new param is_global
           End Update permission global / own access new ver 1.1
        */         
        if(isset($config['tasks'])) {
            foreach($config['tasks'] as $row)
            {
                $tasks[$row['item']] = $row['title'];
            }
        }    
        
        $permission = array();
        $groupID = Input::get('group_id');
        for($i=0;$i<count($groupID); $i++) 
        {
            // remove current group_access             
            $group_id = $groupID[$i];
            DB::table('tb_groups_access')
                              ->where('module_id','=',Input::get('module_id'))
                              ->where('group_id','=',$group_id)
                              ->delete();    

            $arr = array();
            $id = $groupID[$i];
            foreach($tasks as $t=>$v)            
            {
                $arr[$t] = (isset($_POST[$t][$id]) ? "1" : "0" );
            
            }
            $permissions = json_encode($arr); 
            
            $data = array
            (
                "access_data"    => $permissions,
                "module_id"        => Input::get('module_id'),                
                "group_id"        => $groupID[$i],
            );
            DB::table('tb_groups_access')->insert($data);    
        }
                
        return Redirect::to($this->module.'/permission/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','Permission Has Changed Successful.')); 
    }    
    
    
    function getBuild( $id )
    {
    
        $row = DB::table('tb_module')->where('module_name', $id)
                                ->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];        
    
        $this->data['module'] = $this->module;
        $this->data['module_name'] = $id;
        $this->data['module_id'] = $row->module_id;
        return View::make('admin.module.ConfigBuild',$this->data);
                                    
    }
    
    function postDobuild( $id )
    {
        
        $id = Input::get('module_id');
        $c = (isset($_POST['controller']) ? 'y' : 'n');
        $m = (isset($_POST['model']) ? 'y' : 'n');
        $g = (isset($_POST['grid']) ? 'y' : 'n');
        $f = (isset($_POST['form']) ? 'y' : 'n');
        $v = (isset($_POST['view']) ? 'y' : 'n');
        
        //return redirect('')
        $url = $this->module.'/rebuild/'.$id."?rebuild=y&c={$c}&m={$m}&g={$g}&f={$f}&v={$v}";
        
        return Redirect::to($url);
    }
    

    function configGrid ( $field , $alias , $type, $sort ) {
        $grid = array ( 
            "field"     => $field,
            "alias"     => $alias,
            "label"     => ucwords(str_replace('_',' ',$field)),
            "language"    => array(),
            "search"     => '1' ,
            "download"     => '1' ,
            "align"     => 'left' ,
            "view"         => '1' ,
            "detail"      => '1',
            "sortable"     => '1',
            "frozen"     => '0',
            'hidden'    => '0',            
            "sortlist"     => $sort ,
            "width"     => '100',
            "conn"         => array('valid'=>'0','db'=>'','key'=>'','display'=>''),
            'attribute'    => array(
                'hyperlink'    => array(
                        'active'            => '0',
                        'link'            => '',
                        'target'        => '',
                        'html'            => '',
                    ),
                'image'        => array(
                        'active'            => '0',
                        'path'            => '',
                        'size_x'        => '',
                        'size_y'        => '',
                        'html'            => '',
                    ),
                'formater'        => array(
                        'active'        => 0,
                        'value'            => '',
                    )                        
        )              
        );     
        return $grid;
    
    }    
 
    function configForm( $field , $alias, $type , $sort, $opt = array()) {
        
        $opt_type = ''; $lookup_table =''; $lookup_key ='';
        if(count($opt) >=1) {
            $opt_type = $opt[0]; $lookup_table = $opt[1]; $lookup_key = $opt[2];
        }
        
    
        $forms = array(
            "field"     => $field,
            "alias"     => $alias,
            "label"     => ucwords(str_replace('_',' ',$field)),
            "language"    => array(),
            'required'        => '0',
            'view'            => '1',
            'type'            => self::configFieldType($type),
            'add'            => '1',
            'edit'            => '1',
            'search'        => '1',

            'size'            => 'span12',
            "sortlist"     => $sort ,
            'form_group'    => '',
            'option'        => array(
                "opt_type"                 => $opt_type,
                "lookup_query"             => '',
                "lookup_table"             =>     $lookup_table,
                "lookup_key"             =>  $lookup_key,
                "lookup_value"            => $lookup_key,
                'is_dependency'            => '',
                'lookup_dependency_key'    => '',
                'path_to_upload'        => '',
                'upload_type'        => '',
                'tooltip'        => '',
                'attribute'        => '',
                'extend_class'        => ''
                )
            );
        return $forms;    
    
    } 
        
    function configFieldType( $type )
    {
        switch($type)
        {
            default: $type = 'text'; break;
            case 'timestamp'; $type = 'text_datetime'; break;
            case 'datetime'; $type = 'text_datetime'; break;
            case 'string'; $type = 'text'; break;
            case 'int'; $type = 'text'; break;
            case 'text'; $type = 'textarea'; break;
            case 'blob'; $type = 'textarea'; break;
            case 'select'; $type = 'select'; break;
        }
        return $type;
    
    }
    
    function createRouters()
    {
        $rows = DB::table('tb_module')->where('module_type','=','addon')->get();
        $val  =    "<?php
        "; 
        foreach($rows as $row)
        {
            $class = $row->module_name;
            $controller = ucwords($row->module_name).'Controller';
            $val .= "Route::controller('{$class}', '{$controller}');
                    ";        
        }
        $val .=     "?>";
        $filename = app_path().'/moduleroutes.php';
        $fp=fopen($filename,"w+"); 
        fwrite($fp,$val); 
        fclose($fp);    
        return true;    
        
    }

    function getSub( $id ='')
    {
            $row = DB::table('tb_module')->where('module_name', $id)
                                    ->get();
            if(count($row) <= 0){
                return Redirect::to($this->module)->with('message', SiteHelpers::alert('error','Can not find module'));        
            }
            $row = $row[0];    
            $config = SiteHelpers::CF_decode_json($row->module_config); 
            $this->data['row'] = $row;
            $this->data['fields'] = $config['grid'];
            $this->data['subs'] = (isset($config['subgrid']) ? $config['subgrid'] : array());
            $this->data['tables'] = Module::getTableList($this->db);
            $this->data['module'] = $this->module;
            $this->data['module_name'] = $id;    
            $this->data['modules'] = Module::all();    
            $this->layout->nest('content','admin.module.ConfigSub',$this->data)
            ->with('menus', SiteHelpers::menus());    
   

    }


    function postSavesub()
    {

        $rules = array(
            'title'            =>'required',
            'master'          =>'required',
            'master_key'      =>'required',
            'module'          =>'required',
            'key'              =>'required',
        );    
        $validator = Validator::make(Input::all(), $rules);    
        if ($validator->passes()) {                

            $id = Input::get('module_id');
            $row = DB::table('tb_module')->where('module_id', $id)
                                    ->get();
            if(count($row) <= 0){
                return Redirect::to($this->module)
                    ->with('message', SiteHelpers::alert('error','Can not find module'));        
            }
            $row = $row[0];                                    
            $this->data['row'] = $row;    
            $config = SiteHelpers::CF_decode_json($row->module_config); 

            $newData[] = array(
                'title'            => Input::get('title'), 
                'master'        => Input::get('master'),
                'master_key'    => Input::get('master_key'),
                'module'        => Input::get('module'),
                'table'            => Input::get('table'),
                'key'            => Input::get('key'),
            );
            
            $subgrid = array();
            if(isset($config["subgrid"]))
            {
                foreach($config['subgrid'] as $sb)
                {
                    $subgrid[] =$sb;
                }    
                
            }
            $subgrid = array_merge($subgrid,$newData);
            
            if(isset($config["subgrid"])) unset($config["subgrid"]);
            $new_config =     array_merge($config,array("subgrid" => $subgrid));    
            //echo '<pre>'; print_r($new_config); echo '</pre>'; exit;
            
            $affected = DB::table('tb_module')
                ->where('module_id', '=',$id )
                ->update(array('module_config' => SiteHelpers::CF_encode_json($new_config)));            
            
            return Redirect::to($this->module.'/sub/'.$row->module_name)
            ->with('message',SiteHelpers::alert('success','Forms Has Changed Successful.'));  

        }    else {

            return Redirect::to($this->module.'/sub/'.Input::get('module_name'))
            ->with('message', SiteHelpers::alert('error','The following errors occurred'))
            ->withErrors($validator)->withInput();

        }            

    }    

    function getRemovesub()
    {
        $id = Input::get('id');
        $module = Input::get('mod');
        $row = DB::table('tb_module')->where('module_id', $id)->get();
        if(count($row) <= 0){
            return Redirect::to($this->module)
                ->with('message', SiteHelpers::alert('error','Can not find module'));        
        }
        $row = $row[0];                                    
        $this->data['row'] = $row;            

        $config = SiteHelpers::CF_decode_json($row->module_config); 
        $subgrid = array();

        foreach($config['subgrid'] as $sb)
        {
            if($sb['module'] != $module) {
                $subgrid[] = $sb;
            }    
        }    
        unset($config["subgrid"]);
        $new_config =     array_merge($config,array("subgrid" => $subgrid));    
        //echo '<pre>'; print_r($new_config); echo '</pre>'; exit;
        
        $affected = DB::table('tb_module')
            ->where('module_id', '=',$id )
            ->update(array('module_config' => SiteHelpers::CF_encode_json($new_config)));    
            
        
        return Redirect::to($this->module.'/sub/'.$row->module_name)
        ->with('message',SiteHelpers::alert('success','Master Has Changed Successful.'));      

    }        
  function postPackage() 
  {
    if( count( $id = Input::get('id'))<1){
      return Redirect::to( 'instantmodule' )
        ->with('message', SiteHelpers::alert('warning',' Nothing to select, please reselect module '));
    
    };
    
    //$id = explode(',', $id ); 
    
    $_id = array(); 
    foreach ( $id as $k => $v ){ 
      if( !is_numeric( $v )) continue; 
      $_id[] = $v; 
    } 
     
    $ids = implode(',',$_id); 
     
    $sql = "  
        SELECT * FROM tb_module 
        WHERE module_id IN (".$ids.") 
        ORDER by module_id 
        ";
     
    $rows = DB::select($sql); 
    
    $this->data['zip_content'] = array(); 
    $app_info = array(); 
    $inc_tables = array(); 
     
    foreach ( $rows as $k => $row ){ 
     
      $zip_content[] = array( 
        'module_id'   =>  $row->module_id, 
        'module_name' =>  $row->module_name, 
        'module_db'   =>  $row->module_db, 
        'module_type' =>  $row->module_type,
      ); 
       
    } 
    
    // encrypt info
    $this->data['enc_module'] = base64_encode( serialize( $zip_content ));
    $this->data['enc_id'] = base64_encode( serialize( $id ));

    
    // module info
    $this->data['zip_content'] = $zip_content;
    
    /* CHANGE START HERE */
    $app_path = app_path();
    
    // file helper list
    $_path_inc = array( 'library','lang/en' );
    
    foreach( $_path_inc as $path){
      $file_inc[$path]  = scandir( $app_path .'/'. $path);
      foreach ( $file_inc[$path] as $k => $v ){
        if( $v=='.' || $v=='..') unset( $file_inc[$path][ $k ] );
        if( ! preg_match( '/.php$/i', $v )) unset( $file_inc[$path][ $k ] );
      }
    }
    
    $this->data['file_inc'] = $file_inc;
    
    /* CHANGE END HERE */
    
    $this->layout->nest('content','admin.module.package',$this->data)->with('menus', $this->menus );  
    
  }
  
  
  function postDopackage() {

    // app name
    $app_name     = input::get('app_name');
    
    // encrypt info
    $enc_module   = input::get('enc_module'); 
    $enc_id       = input::get('enc_id'); 
    
    // query command || file
    $sql_cmd      = input::get('sql_cmd');
    
    if( !( $_FILES['sql_cmd_upload']['error'])){
      $sql_path     = input::file('sql_cmd_upload')->getrealpath();
      if( $sql_content = file_get_contents( $sql_path )){
        $sql_cmd = $sql_content;
      }
    }
    
    /* CHANGE START */
    
    // file to include
    $file_library = input::get('file_library');
    $file_lang    = input::get('file_lang');
    
    /* CHANGE END */
    
    // create app name
    $tapp_code    = preg_replace('/([s[:punct:]]+)/',' ',$app_name);
    $app_code     = str_replace(' ','_', trim( $tapp_code ));
     
    $module_id    = unserialize( base64_decode( $enc_id )); 
    $modules      = unserialize( base64_decode( $enc_module  )); 
    $c_module_id  = implode( ',',$module_id );
    
    $zip_file = dirname(base_path())."/uploads/zip/{$app_code}.zip"; 
    
    $cf_zip = new ZipHelpers;

    $app_path = app_path() ; 
     
    $cf_zip->add_data( ".mysql" , $sql_cmd ); 
     
    // App ID Name 
    $ain = $module_id; 
    $cf_zip->add_data( ".ain", base64_encode( serialize($ain ))); 
     
    // setting  
    $sql = " select * from tb_module where module_id in ( {$c_module_id} )"; 
    
    $_modules = DB::select( $sql );
     
    foreach ( $_modules as $n => $_module ){ 
      $_modules[$n]->module_id = ''; 
    } 
     
    $setting['tb_module'] = $_modules; 
     
    $cf_zip->add_data( ".setting", base64_encode(serialize($setting))); 

    unset( $_module ); 

    foreach ( $_modules as $n => $_module ){ 
      $file = $_module->module_name; 
      $cf_zip->add_data( "controllers/". ucwords($file)."Controller.php", 
                          file_get_contents( $app_path."/controllers/". ucwords($file)."Controller.php")) ; 
      $cf_zip->add_data( "models/". ucwords($file).".php", file_get_contents($app_path."/models/". ucwords($file).".php")) ;
      $cf_zip->get_files_from_folder( $app_path."/views/{$file}/","views/{$file}/" ); 

    } 
    
    // CHANGE START 
    
    // push library files
    if( ! empty( $file_library )){
      foreach ( $file_library as $k => $file ){
        $cf_zip->add_data( "library/". $file , 
                             file_get_contents( $app_path."/library/".$file)) ; 
      }
    }
    
    // push language files
    
    if( ! empty ( $file_lang )){
      $lang_path = scandir( $app_path . '/lang' );
      foreach ( $lang_path as $k => $path ){
        if( $path=='.' || $path=='..') continue;
        if( is_file( $app_path . '/' . $path )) continue;
          
        foreach ( $file_lang as $k => $file ){
          $cf_zip->add_data( 'lang/'. $path .'/'. $file , 
                   file_get_contents( $app_path."/lang/". $path . '/'. $file)) ; 
          
        }  
      }
      $this->data['lang_path'] = $lang_path;
    
    }
    
    
    // CHANGE END 
    
    $_zip = $cf_zip->archive( $zip_file ); 
    
    $cf_zip->clear_data(); 
     
    $this->data['download_link'] = link_to("uploads/zip/{$app_name}.zip","download here",array('target'=>'_new')); 
     
    $this->data['module_title'] = "ZIP Packager"; 
    $this->data['app_name'] = $app_name;

   // $this->layout->nest('content','admin.module.dopackage',$this->data)->with('menus', $this->menus );
    return Redirect::to( 'module' )
        ->with('message', SiteHelpers::alert('success',' Module(s) zipped successful ! '));
    
  }
  
  function postInstall( $id =0)
  {

    $rules = array(
      //    'file'    => 'required'
    );
    
    $validator = Validator::make(Input::all(), $rules);  
    if ($validator->passes()) {
      
      $path = $_FILES['installer']['tmp_name'];
      $data = SximoHelpers::cf_unpackage($path);
      
      $msg = '.';
      if( isset($data['sql_error'])){
        $msg = ", with SQL error ". $data['sql_error'];
      }
      
      SximoHelpers::write_route();
      
          return Redirect::to('module')->with('message', SiteHelpers::alert('success','Module Installed' . $msg));
    }  else  {
         return Redirect::to('module')->with('message', SiteHelpers::alert('error','Please select file to upload !'));
    } 
  
  }  
  
 
}      
