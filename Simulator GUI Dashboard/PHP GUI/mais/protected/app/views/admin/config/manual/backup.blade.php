
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
	<div class="col-md-8" style="margin-bottom:50px;">

			<h2> Backup & Install  </h2>
			<p> <strong>Backup feature </strong>giving you ability to package you module into zip installer . Zip installer will contain files and folder with following structure 
			</p>
			<ol>
				<li> Controller.php </li>
				<li> Model.php </li>
				<li> view/modules/index.blade.php </li>
				<li> view/modules/form.blade.php </li>
				<li> view/modules/inlineview.blade.php </li>
				<li> view/modules/view.blade.php </li>

			</ol>
			
			<p><strong>Install</strong> : with Install feature , you can put back your backuped modules </p>
			<p class="alert alert-success"> This feature will usable for migration / upgrade version </p>
			
	
			<h4> Backup Current module(s) </h4>
			<p class="alert alert-warning"> GO to : Control Panel >> Code Builder </p>
			<h6> Step 1 </h6>
			<p> Select desire module to backup </p>
			<h6> Step 2 </h6>
			<p> Submit <strong>Backup</strong> Button  </p>
			<h6> Step 3 </h6>
			<p> Give name for your backuped module   </p>	
              <table  class="table table-bordered table-striped">
                <tr>
                  <th scope="col">Parameter</th>
                  <th scope="col">Description</th>
                  <th scope="col">Example</th>
                </tr>
                <tr>
                  <td>Application Title  </td>
                  <td>This is title of your page</td>
                  <td>Inventory , HRD System </td>
                </tr>
                <tr>
                  <td>SQL Statement </td>
                  <td>  This should be containt mysql syntac begining Create and Insert . system only backup files and folder from module selected , but backup doesnt include database schema , so u need to do this manualy 
				  
				   </td>
                  <td>
				 
				  </td>
                </tr>
                <tr>
                  <td>Upload SQL Statement Fil</td>
                  <td> Or you can just upload files contain database schema and rows </td>
                  <td>mybackup.sql </td>
                </tr>
								
			</table>
			<img src="{{ asset('uploads/documents/zip-install.jpg') }}" style="width:100%" />
			<div class="doc-line"></div>
			<p> SQL Statment and Upload file SQL is <code>not mandatory</code> , without filling both input , you can still do backup / zip module </p>	
			<h6> Create Backup SQL statment </h6>
			<p> you can do this step using Export tool from phpmyadmin or other DB tools  , simple just select tables and do export ( as text or as files ) </p>
			<h6>As text files </h6>
			<p> copy and paste into SQL statment textarea , and leave SQL statment file blank </p>
			<h6>As SQL files </h6>
			<p> if you using this methode , then leave SQL statment textarea blank , and upload SQL statment file </p>
			<p class="alert alert-info"> Save it </p>
			
			<h4> Zip Modules / Backup Directories </h4>
			<p>All module zipped are stored at <code>uploads/zip</code> folder , you can download them. </p>
			
			
			
			
			</div>			
</div>
</div>	