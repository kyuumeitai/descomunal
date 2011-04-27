<?php 
/*
Archivo de Funciones. Siéntase libre de agregar alguna si le faltan.
¿Dudas, consultas?

@kyuumeitai (Twitter)

aacuna@multinet.cl
alex@lunamedia.cl

*/

/*
Listado de sólo nombres. 
Devuelve en 
*/
function dc_get_col($type=''){
	global $wpdb;
	
	switch ($type) {
	    case 'regiones':
	        $type = 'region';
	        break;
	    case 'provincias':
	        $type = 'provincia';
	        break;
		default:
	        $type = 'comuna';
		}
		
	$option = get_option('mnet_descomunal');	
	$tabla = $wpdb->prefix.'descomunal_'.$option['dbtable_'.$type];
	$output = $wpdb->get_col("SELECT ".$type."_nombre FROM $tabla");
	return $output;
	}

function dc_get_all($type=''){
	global $wpdb;
	
	switch ($type) {
	    case 'regiones':
	        $type = 'region';
	        break;
	    case 'provincias':
	        $type = 'provincia';
	        break;
		default:
	        $type = 'comuna';
		}
		
	$option = get_option('mnet_descomunal');	
	$tabla = $wpdb->prefix.'descomunal_'.$option['dbtable_'.$type];
	$output = $wpdb->get_results("SELECT * FROM $tabla");
	return $output;
	}
	?>