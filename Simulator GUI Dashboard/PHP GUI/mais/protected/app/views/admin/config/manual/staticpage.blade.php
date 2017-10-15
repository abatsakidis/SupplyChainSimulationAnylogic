
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
	 <div class="page-content-wrappe m-t">  

	@include('admin.config.manual.manualsidebar')
	<div class="col-md-8" style="margin-bottom:50px;">

			<h2> Page CMS ( Static Pages )  </h2>
			<p> Page CMS allow you to create page for frontend ( Public ) or Private. This can be put for creating , contact , about us , service , TOC etc</p>
			<p>Before you begin creating pages , you have to know that SXIMO create file everytime you create pages , its mean you have full control to insert everything in content such tag php , css , exclude javscript </p>
			<p class="separator"></p>
			  
			  <p class="alert alert-warning"> Go to >> Control Panel >> Pages >> new </p>
			  
			  <h5> Form Info </h5>

              <table  class="table table-bordered table-striped">
                <tr>
                  <th scope="col">Parameter</th>
                  <th scope="col">Description</th>
                  <th scope="col">Example</th>
                </tr>
                <tr>
                  <td>Title </td>
                  <td>This is title of your page</td>
                  <td>Inventory , HRD System </td>
                </tr>
                <tr>
                  <td>Alias/slug</td>
                  <td>Users for UL structure ( http://domain.com/about-us) </td>
                  <td>about-us , contactus , toc </td>
                </tr>
                <tr>
                  <td>Filename </td>
                  <td>When you create page , it will create new file . the name of file are given by this field</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Content </td>
                  <td>The content give you powerfull ability to create any layout desain using bootsrtap CSS framework</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Access </td>
                  <td>Limit wich group are able to view the page</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Enable</td>
                  <td>Make the page accessible </td>
                  <td>True / False </td>
                </tr>
              </table>			  

	
	</div>