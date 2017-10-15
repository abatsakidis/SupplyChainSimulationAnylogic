
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>


   
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
    <li><a href="{{ URL::to('instantmodule') }}">{{ $pageTitle }}</a></li>
        <li class="active"> Add Or Edit </li>
     </ul>
  </div>  
  
  <div class="page-content-wrapper">
  @if(Session::has('message'))    
       {{ Session::get('message') }}
  @endif  
  <div class="panel-default panel">
    <div class="panel-body">

    <ul class="parsley-error-list">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>

          <div class="col-md-6">
              <div class="header" >
                <h3> Instant Module</h3>
              </div>
              
              <div class="content col-md-12" >
                <div class="form-group  " >
                  <label for="Module Id" class=" control-label  text-left"> Application Title </label>
                  <div>{{ $app_name }}</div>
                </div>           
                  
              </div>
          </div>
          
          
          <div class="col-md-6">
            <div class="header">
              <h3> Download Link</h3>
            </div>
            
            <div class="content col-md-12" >
              <div class="form-group  " >
                <label for="Module Id" class=" control-label  text-left"> Click here to start download</label>
                <div class="">
                  {{ $download_link }} 
                </div> 
              </div>           
              
              
            </div>
              
          </div>
      
      
      <div style="clear:both"></div>  
        
    </div>
  </div>  
</div>  
</div>       
   <script type="text/javascript">
  $(document).ready(function() { 
     
  });
  </script>     