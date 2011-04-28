jQuery(document).ready(function($) {
   	$('#form-region').change(function(){
   		var t = $(this);
   		$.ajax({
			'type'		: 'post',
			'cache'		: false,
			'url'		: '../includes/process.php',
			'data'		: t.attr('value'),
			'success'	: function(data) {
				alert('guardado, devolvió: ' + data);
				}
   			});
   		});
	});