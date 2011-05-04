jQuery(document).ready(function($) {
   	$('#form-region').change(function(){
   		alert('henge!');
   		var t = $(this);
		$.post(
		    dc_script.uri,
		    {
		        action : 'dc-submit',
		        valor : t.attr('value')
		    },
		    function( response ) {
		        alert( response );
		    }
		);  

   	});
});