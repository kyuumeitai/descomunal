<?php 
/*
Archivo de Funciones. Siéntase libre de agregar alguna si le faltan.
¿Dudas, consultas?

@kyuumeitai (Twitter)

aacuna@multinet.cl
alex@lunamedia.cl

*/

/*
dc_get_col($type)
Devuelve un array sólo de nombres de la tabla seleccionada. 

- Uso por defecto:
dc_get_col();

Llama a las comunas.

- Parámetros:
$type
    (string) (opcional) Selecciona la tabla a llamar.

    'regiones' - Llama todas las regiones de Chile.
    'provincias' - Llama todas las provincias de Chile.
    'comunas' - Llama todas las comunas de Chile. Opción por defecto.
   
- Devuelve:
	(array_n) 
	Retorna un array indexado numericamente.
	
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
		
	$option = get_option('descomunal');	
	$tabla = $wpdb->prefix.'descomunal_'.$option['dbtable_'.$type];
	$output = $wpdb->get_col("SELECT ".$type."_nombre FROM $tabla");
	return $output;
	}

/*
dc_get_all($type)
Devuelve la tabla completa seleccionada. 

- Uso por defecto:
dc_get_all();

Llama a las comunas.

- Parámetros:
$type
    (string) (opcional) Selecciona la tabla a llamar.

    'regiones' - Llama todas las regiones de Chile.
    'provincias' - Llama todas las provincias de Chile.
    'comunas' - Llama todas las comunas de Chile. Opción por defecto.
   
- Devuelve:
	(object) 
    Objetos con los siguientes índices:
    
    	Para todos los $type:
	    id
	    	(integer) el ID de región/provincia/comuna

	Dependiendo de $type devuelve los siguientes índices:
			
		- Regiones:
		region_nombre
		    (string) El nombre de la región
		    
		- Provincias:
		provincia_nombre
		    (string) El nombre de la provincia
		provincia_region_id
		    (integer) El id de la región a la cual la provincia está asociada.
		    
		- Comunas:
		comuna_nombre
		    (string) El nombre de la comuna
		comuna_provincia_id
		    (integer) El id de la provincia a la cual la comuna está asociada.
		    
*/

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
		
	$option = get_option('descomunal');	
	$tabla = $wpdb->prefix.'descomunal_'.$option['dbtable_'.$type];
	$output = $wpdb->get_results("SELECT * FROM $tabla");
	return $output;
	}

	?>