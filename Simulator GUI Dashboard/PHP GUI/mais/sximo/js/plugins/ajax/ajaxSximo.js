/* CSS Document */

function reloadData( id,url   )
{
	$('.ajaxLoading').show();
	$.post( url ,function( data ) {
		$( id +'Grid' ).html( data );
		$('.ajaxLoading').hide();
	});

}


function ajaxDoSearch( id ,url )
{
	var attr = '';
	$( id +'Search :input').each(function() {
		if(this.value !=='') { attr += this.name+':'+this.value+'|'; }
	});
	reloadData( id ,url+'&search='+attr);
}


function ajaxQuickAdd(id, url )
{

	var attr = '';
	var datas = $( id +'Search :input').serialize();
	$.post( url+'/quicksave' ,datas, function( data ) {
		if(data.status =='success')
		{
			ajaxFilter( id , url+'/data' );
			$( ".resultData" ).html( data.message );
		} else {
			$( ".resultData" ).html( data.message );
		}			
	});

	
}

function ajaxFilter( id ,url )
{
	var attr = '';
	$( id +'Filter :input').each(function() {
		if(this.value !='') { attr += this.name+'='+this.value+'&'; }
	});	

	reloadData(id, url+"?"+attr);
}



function ajaxCopy(  id , url )
{
	var datas = $('#SximoTable :input').serialize();
	if(confirm('Are u sure copy selected row(s)?')) {
		$.post( url+'/copy' ,datas,function( data ) {
			if(data.status =='success')
			{
				$( ".resultData" ).html( data.message );
				ajaxFilter( id , url+'/data' );
			} else {
				$( ".resultData" ).html( data.message );
			}	
			
		});	
		
	}	
}

function ajaxRemove( id, url )
{
	var datas = $( id +'Table :input').serialize();
	if(confirm('Are u sure deleting selected row(s)?')) {
		$.post( url+'/destroy' ,datas,function( data ) {
			if(data.status =='success')
			{
				$( ".resultData" ).html( data.message );
				ajaxFilter( id ,url+'/data' );
			} else {
				$( ".resultData" ).html( data.message );
			}				
		});	
		
	}	
}

function ajaxViewDetail( id , url )
{
	$('.ajaxLoading').show();
	$.get( url ,function( data ) {
		$( id +'View').html( data );
		var w = $(window); 
		var duration = 300;
		$('html, body').animate({scrollTop: 0}, duration);
		$('.ajaxLoading').hide();
	});		
		
}

function ajaxViewClose( id )
{
	$( id +'View' ).html('');	
//	$( id +'Grid' ).show();	
}

var newwindow;
function ajaxPopupStatic(url ,w , h)
{
	var w = (w == '' ? w : 800 );	
	var h = (h == '' ? wh: 600 );	
	newwindow=window.open(url,'name','height='+w+',width='+h+',resizable=yes,toolbar=no,scrollbars=yes,location=no');
	if (window.focus) {newwindow.focus()}
}