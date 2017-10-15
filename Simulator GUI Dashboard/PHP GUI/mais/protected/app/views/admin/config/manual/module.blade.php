
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('') }}">Home</a></li>
        <li class="active"> Documentation </li>
      </ul>
	</div>  
 <div class="page-content-wrapper m-t">  

	@include('admin.config.manual.manualsidebar')
	<div class="col-md-8 doc-content" style="margin-bottom:50px;">

			<h2> Modules Management  </h2>
			<p> What's Module ? A module is a part of a app . A module contain one or several routines that we call CRUDSD ( Create Read Update Delete Search and Download ). </p>
			<p>By default at the first time you create module , system will generate thoose routines . Except if your database table doesnt contain primary key , it only create routins View , Search and Download  </p>
			<p>the are 2 different module : CORE and Installed Module</p>
			<p class="doc-line"></p>

			<h6> Core Module  </h6>
			<p>This is built in modules , come with default distribution . Please Do not updates thooss module , because thoose module already have customizion , but if you know how it's work , then it's up to you . with your own risk ;) </p>
			<h6> Custom ( Installed ) Module  </h6>
			<p>This is your module list , every time you create module , it will shown up at installed tab . Let's create your first module  </p>		
			<p class="doc-line"></p>	
			
			<h4> Step By step creating new module </h4>
			<p>Before you create module , you have to create table for module you will buid . this app doest have feature to create table database , so you need phpmyadmin or other mysql tools for creating table </p>		  
			  <p class="alert alert-warning">  Control Panel >> Code Builder >> Create  </p>
			<img src="{{ asset('uploads/documents/create-module.jpg') }}" style="width:100%" />
			  
			 <h6> STEP 1 </h6>
			 
			 <table  class="table table-bordered table-striped">
               <tr>
                 <th scope="col">Parameter</th>
                 <th scope="col">Description</th>
                 <th scope="col">Example</th>
               </tr>
               <tr>
                 <td>Module Name / Title</td>
                 <td>Used for module title </td>
                 <td>Inventory , HRD System </td>
               </tr>
               <tr>
                 <td>Class Controller</td>
                 <td>Used for module class controller <br>
                 ( must be unix , no withspace , lowercase ) </td>
                 <td>customers , album , products </td>
               </tr>
               <tr>
                 <td>Table Master</td>
                 <td>Database table master used for basic CRUD </td>
                 <td> -- select from current database - </td>
               </tr>
               <tr>
                 <td>Module Note</td>
                 <td>Short description module </td>
                 <td>View all data </td>
               </tr>
               <tr>
                 <td>SQL statement</td>
                 <td>Module SQL statment </td>
                 <td>Auto , Manual </td>
               </tr>
             </table>
			 <p class="doc-line"></p>	
			 <p class="alert alert-success"> Example creating module </p>
			 <ul>
				<li>Module Name / Title : Customers </li>
				<li>Class Controller : customers.</li>
				<li>Table Master : customers.</li>
				<li>Module Note : View All Customer Data</li>
				<li>Select you SQL statement: Check Auto SQL</li>
				<li>Click Button " Create Module " </li>
			</ul>
			
			<p>If you not getting any error , its should be redirecting you to module manager page  </p>
			 <h6> STEP 2 </h6>
			 <p> From list installed module , click button gear dropdown and click view module . You should see you module grid with complete function !. <br />
			 YOU'RE AWESOME ! creating module in one step less than a minutes  </p>

			<p class="doc-line"></p>	
			
			
			<h2 id="edit-module"> Edit Modules   </h2>
			<p class="alert alert-warning">  Control Panel >> Code Builder   </p>
			<img src="{{ asset('uploads/documents/edit-module.jpg') }}" style="width:100%" />
			<p>From list installed module , click button gear dropdown and click Edit module. Then you should able to see edit form and following tabs  </p>
			<p> INFO , SQL , TABLE , FORM , MASTER DETAIL ,PERMISSION , REBUILD </p>
			<img src="{{ asset('uploads/documents/tab-module.jpg') }}" style="width:100%" />
			<p class="separator"> </p>
			
			
			<h2 id="edit-info"> Module Info </h2>
			<p> This is information of your module , you only able to change module title and module note </p>
			<p class="doc-line"></p>	
			<h2 id="edit-sql">  Module SQL </h2>
			<p> At the first time you create module , system will create automatic single query table  </p>	

			 <table  class="table table-bordered table-striped">
               <tr>
                 <th scope="col">Parameter</th>
                 <th scope="col">Description</th>
                 <th scope="col">Example</th>
               </tr>
               <tr>
                 <td>SQL SELECT &amp; JOIN </td>
                 <td>Begining with SELECT ,  </td>
                 <td>SELECT customer.* FROM customer</td>
               </tr>
               <tr>
                 <td>SQL WHERE </td>
                 <td>Begining with WHERE , </td>
                 <td> WHERE customer.CustomerId IS NOT NULL </td>
               </tr>
               <tr>
                 <td>SQL GROUP </td>
                 <td>Begining with GROUP BY, </td>
                 <td>&nbsp;</td>
               </tr>
             </table>

			 <p class="alert alert-danger"> DO Not Put ORDER BY Inisid query editor , ORDER BY and LIMIT automaticaly insert by system </p>
			 <p><img src="{{ asset('uploads/documents/tab-sql.jpg') }}" style="width:100%" />
			   
              </p>
			 <p> Why SXIMO BUILDER Creating automatic " WHERE employee.EmployeeId IS NOT NULL " ? this is for prevent error when users submit search form </p>
			<p>Every fields included on query select , will be displaying at grid table including fields from join table . so make sure every field you want to show on table grid and view detail , must be on your query statement</p>
			<p class="alert alert-danger">Everytime you made changes from SQL Editor , you have to rebuild models files </p>
			<p class="doc-line"> </p>
			
			<h2 id="edit-table">  Module Table </h2>
			<p> You can control Field to show ( table grid ) , view detail ( view detail page ) , sortable ( allow users to sort order by field ) , download ( include field to be downloadable )  </p>
			<h6> Displaying row as image</h6>
			<p>system does not store images on database , but the images are stored as a file at some directory . So make sure you create directory at uploads/your_directory_name . from image columns checkbox, checked form and put directory path uploads/your_directory_name</p>
			<img src="{{ asset('uploads/documents/image-path.jpg') }}" />
			<h6> Display As ( Aliasing ) </h6>
			<p> If you're not familiar with mysql syntax or getting lazzy to write query , then this feature is your solution

Example , you have field user_id on your table and you want to connect with tb_users and displaying username or firstname on your grid and view detail  </p>
<img src="{{ asset('uploads/documents/display-as.jpg') }}" style="width:100%" />
			
			<p class="doc-line"> </p>		
			

			<h2 id="edit-form">  Module Form </h2>
			<p> At this moment , system only able to work with , Hiddem Form , Text Form , Date Form , Date Time , Select , Checkbox , Radio  </p>
			
			<div class="tab-container">
				<ul class="nav nav-tabs">
				  <li  class="active"><a data-toggle="tab" href="#input">Input  </a></li>
				  <li ><a data-toggle="tab" href="#textarea"> Textarea </a></li>
				  <li><a data-toggle="tab" href="#select">Select</a></li>
				  <li ><a data-toggle="tab" href="#radio">Radio</a></li>
				  <li ><a data-toggle="tab" href="#checkbox">Checkbox</a></li>
				  <li ><a data-toggle="tab" href="#upload">Upload</a></li>
				</ul>
				<div class="tab-content ">
				  <div id="input" class="tab-pane use-padding active">
					<h3 >Input Type </h3>
<table  class="table table-bordered table-striped">
                <tr>
                  <th scope="col">Parameter</th>
                  <th scope="col">Description</th>
                  <th scope="col">Format</th>
                </tr>
                <tr>
                  <td>Input Text </td>
                  <td>Used for collect short text </td>
                  <td>String , number </td>
                </tr>
                <tr>
                  <td>Input Date </td>
                  <td>Used for collecting date </td>
                  <td>Y-m-d</td>
                </tr>
                <tr>
                  <td>Input Date Time  </td>
                  <td>Used for collecting date </td>
                  <td>Y-m-d H:i:s </td>
                </tr>
              </table>					

				  </div>
				  <div id="textarea" class="tab-pane use-padding">
					<h6>Textarea Type</h6>
<table  class="table table-bordered table-striped">
                <tr>
                  <th scope="col">Parameter</th>
                  <th scope="col">Description</th>
                  <th scope="col">Format Table </th>
                </tr>
                <tr>
                  <td>Textarea</td>
                  <td>Used for collecting long text<br>
                  native textarea form </td>
                  <td>mediumtext , text , longtext </td>
                </tr>
                <tr>
                  <td>Textarea</td>
                  <td>Used for collecting long text<br>
                  Interface , WysWyg Editor </td>
                  <td>mediumtext , text , longtext</td>
                </tr>
              </table>					
					
					<p></p>
				  </div>
				  <div id="select" class="tab-pane use-padding ">
					<h6>Select</h6>
					<p> Use select type for collecting values from other table ( lookup table ) </p>
					<img src="{{ asset('uploads/documents/select-type.jpg') }}" style="width:100%" />
					
					<h6>Parent Filter</h6>
					<p> This feature used for filtering select .<br /> 
					example , you have to field table countryid and stateid . Both fields are pulling data from table counties and state. The scenarion is when you select country , all value from states limited only for states belong to selected countryID. 
					
					</p>
					<p> What you need to do is check parent filter checkbox at states select form   , and type countryID on lookup filter key</p>
					

				  </div>
				  <div id="radio" class="tab-pane use-padding ">
					<h6>Radio button</h6>
					<table  class="table table-bordered table-striped">
					<tr>
					  <th scope="col">Parameter</th>
					  <th scope="col">Description</th>
					  <th scope="col">Format Table </th>
					</tr>
					<tr>
					  <td>Radio</td>
					  <td> Used for collection single value from  option value  <br />
					   All values option are define by your self
					   </td>
					  <td> Enum, string </td>
					</tr>               
				  </table>
				  
				  </div>
				  <div id="checkbox" class="tab-pane use-padding ">
					<h6>Checkbox</h6>
					<table  class="table table-bordered table-striped">
					<tr>
					  <th scope="col">Parameter</th>
					  <th scope="col">Description</th>
					  <th scope="col">Format Table </th>
					</tr>
					<tr>
					  <td>Checkbox</td>
					  <td> Used for collection multiple value from  option values  <br />
					   All values option are define by your self
					   </td>
					  <td> Set, string </td>
					</tr>               
				  </table>
				  </div>				  
				  				  
				  <div id="upload" class="tab-pane use-padding ">
					<h6>Upload</h6>
					<table  class="table table-bordered table-striped">
					<tr>
					  <th scope="col">Parameter</th>
					  <th scope="col">Description</th>
					  <th scope="col">Format Table </th>
					</tr>
					<tr>
					  <td>Image</td>
					  <td> Used for collection image  </td>
					  <td> string </td>
					</tr> 
					<tr>
					  <td>File</td>
					  <td> Used for collection file  </td>
					  <td> string </td>
					</tr>   					              
				  </table>
				  <p> System does not store images/files on database , but the images are stored as a file at some directory . So make sure you create directory at <code>uploads/your_directory_name</code>  </p>
				  </div>				  
				</div>
	  </div>			
			
			<p class="doc-line"> </p>			

			<h2 id="edit-permission">  Module Permission </h2>
			<p> Every CRUD module will have a couples function such view grid , add , edit etc . you can control wich group are able to access thoose function  </p>
			<img src="{{ asset('uploads/documents/permission-module.jpg') }}" style="width:100%" />
			<p><b> Limit users only view they own record  </b></p>
			<p>Please note , this feature required <code> entry_by (int 6) </code> field table , if you alredy having this field on your table , then just uncheck global column </p>  
			<p class="doc-line"> </p>	

			<h2 id="edit-rebuild">  Module Rebuild </h4>
			<p> By default at the first time you create module , system will generate files such controller , model , index, form and view . Ofcourse when application in development mode , there're possibility you made some changes from table , form grid etc.
We try to cover this possibility by adding rebuild modules features  </p>
			<h6> Database table syncronize</h6>
			<p>Next , when you have current module with table A then you alter table ,( insert or delete fields from current database ) , this will make module error </p>
			<p class="alert alert-warning"> Go to module ( Code Builder ) edit module -> SQL </p>
			<p>	Re save your SQL query , system will collect new information schema from table</p>
			<P class="alert alert-danger">	Rebuild , model , form and view  </p> 
			
			<h6> Rebuild Form </h6>
			<P class="alert alert-danger">After you made changes for setting/design you have to rebuild form files </p>
			<h6> Rebuild View Detail </h6>
			<P class="alert alert-danger">After you made changes at table settting for view detail you have to rebuild view files </p>
			
			<h6> Rebuild Grid Table and controller </h6>
			<p>Little posibility to rebuild controller and index table , since we design controller and index table works automatic reading realtime module configuration . so when you need to rebuild both controller and index table ? Usualy when you updrade version </p>
			
			<p class="doc-line"> </p>				
						
	  </div>	

	
	</div>
</div>
</div>	