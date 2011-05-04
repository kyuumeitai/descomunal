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
	wp_enqueue_script( 'dc_script', plugins_url('descomunal/scripts/dc_calls.js'), array( 'jquery' ) );
	wp_localize_script( 'dc_script', 'dc_script', array( 'uri' => admin_url( 'admin-ajax.php' ) ) );
	}
 
function dc_submit() {
    $valor = $_POST['valor'];
    $response = json_encode( array(
    	'success' => true,
    	'aidi' => 'probandooooooooo',
    	'valor' => $valor
    	) );
    header( "Content-Type: application/json" );
    echo $response;
    exit;
	}

add_action( 'wp_ajax_nopriv_dc-submit', 'dc_submit' );
add_action( 'wp_ajax_dc-submit', 'dc_submit' );
add_action('init', 'dc_script');	

?>