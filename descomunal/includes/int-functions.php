<?php

/*
Archivo de Funciones Internas. Trate de no meterse mucho acá.
¿Dudas, consultas?

@kyuumeitai (Twitter)

aacuna@multinet.cl
alex@lunamedia.cl

*/

function dc_tabla($type){
	global $wpdb;
	$option = get_option('descomunal');	
	$tabla = $wpdb->prefix.'descomunal_'.$type;
	return $tabla;
	}

function dc_script() {
	$baseuri = plugins_url('descomunal'); ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
	   	$('#form-region').change(function(){
	   		var t = $(this);
	   		$.ajax({
				'type'		: 'post',
				'cache'		: false,
				'url'		: '<?php echo $baseuri;?>/includes/process.php',
				'data'		: t.attr('value'),
				'success'	: function(data) {
					alert('guardado, devolvió: ' + data);
					}
	   			});
	   		});
		});		
	</script>
	<?php }    

add_action('wp_print_scripts', 'dc_script');

?>