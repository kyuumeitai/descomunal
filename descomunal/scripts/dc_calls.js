jQuery(document).ready(function($){

   	$('#form-region').change(function(){
   		var t = $(this);
		$('#form-comuna').attr('disabled','disabled').empty().append('<option value="">Seleccione</option>');;
		$.post(
			dc_script.uri,
		    {
		        'action' : 'dc-submit',
		        'region' : t.attr('value')
		    },
		    function(response){
		    	$('#form-provincia').removeAttr('disabled').empty().append('<option value="">Seleccione</option>');
	    		$.each(response.provincias, function(i, provincia){
					$('<option value="'+provincia.id+'">'+provincia.provincia_nombre+'</option>').appendTo('#form-provincia');
		    	});
		    }
		);
   	});

   	$('#form-provincia').change(function(){
   		var t = $(this);
		$.post(
			dc_script.uri,
		    {
		        'action' : 'dc-submit',
		        'provincia' : t.attr('value')
		    },
			function(response){
		    	$('#form-comuna').removeAttr('disabled').empty().append('<option value="">Seleccione</option>');
	    		$.each(response.comunas, function(i, comuna){
					$('<option value="'+comuna.id+'">'+comuna.comuna_nombre+'</option>').appendTo('#form-comuna');
		    	});
		    }
		);
   	});

	$('#form-comuna-live').keyup(function(){
		var t = $(this);
		if (t.val().length != '0'){
			$.post(
				dc_script.uri,
			    {
			        'action' : 'dc-submit',
			        'livequery' : t.attr('value')
			    },
				function(response){
			    	$('#form-comuna').removeAttr('disabled').empty().append('<option value="">Seleccione</option>');
		    		$.each(response.comunas, function(i, comuna){
						$('<option value="'+comuna.id+'">'+comuna.comuna_nombre+'</option>').appendTo('#form-comuna');
			    	});
			    }
			);
		} else {
			$("#results").empty();
			$('#content').css({'z-index':'5'});
		};
	});

});