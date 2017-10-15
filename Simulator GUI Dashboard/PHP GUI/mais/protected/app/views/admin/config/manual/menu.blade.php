
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

			<h2> Menu Management  </h2>
			<p> Everytime you create modules or pages , it will not automatic show on your app , you need to create menu and linked it to modules.
There are 2 type of menu , <code>sidebar and topbar</code> .<br /> Use Topbar menu link for public pages and sidebar for registered users and for manage your own modules  </p>
			<p class="doc-line"></p>
			  
			  <p class="alert alert-warning"> Go to >> Control Panel >> Menu </p>
			  
			  <h5> Form Info </h5>
            <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-bordered">
              <tr>
                <th scope="col">Field</th>
                <th scope="col">Description</th>
                <th scope="col">Example</th>
              </tr>
              <tr>
                <td>Menu Name </td>
                <td>Caption / Title for your menu </td>
                <td>Contact Us , About Us , Customer </td>
              </tr>
              <tr>
                <td> Menu Type </td>
                <td>Internal : used to select module / page <br />
                  External : used for external link . exp ( http://google.com ) </td>
                <td>http://domain.com</td>
              </tr>
              <tr>
                <td>Module / Page  </td>
                <td>Select module / pages for menu link target </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Position</td>
                <td>Set menu position </td>
                <td>Top Menu / Side Menu </td>
              </tr>
              <tr>
                <td>Icon Class </td>
                <td>Add icon to menu , you can use fontawesome and iconmoon icon </td>
                <td>icon-user , icon-envelope </td>
              </tr>
              <tr>
                <td>Active</td>
                <td>Show menu or hidden </td>
                <td>TRUE / FALSE </td>
              </tr>
              <tr>
                <td>Menu Access </td>
                <td>Define who will able to see menu </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td> Public / Unlogged users</td>
                <td>If menu is public then it will automatic showed for all users . </td>
                <td>TRUE / FALSE </td>
              </tr>			  
            </table>
	
	</div>
</div>
</div>
	