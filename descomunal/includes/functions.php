<?php
/*
Archivo de Funciones. Siéntase libre de agregar alguna si le faltan.
¿Dudas, consultas?

@kyuumeitai (Twitter)

aacuna@multinet.cl
alex@lunamedia.cl

TODOs:
- Un string más inteligente que una función para seleccionar la tabla. ¿Definir constantes, quizás?
- Constructor de selectores HTML
- Registrar función en AJAX
	- Archivo que devuelva onChange del select
- Live query de comunas en AJAX

*/

include "int-functions.php";

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
	$tabla = dc_tabla($type);
	$output = $wpdb->get_col("SELECT ".$type."_nombre FROM $tabla");
	if(!empty($output)) return $output;
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
	(array)(object)
    un Array con Objetos, con los siguientes índices:

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
	$tabla = dc_tabla($type);
	$output = $wpdb->get_results("SELECT * FROM $tabla");
	if(!empty($output)) return $output;
	}

/*
dc_get_child($type, $parent_id)
Devuelve tipos (provincia o comuna) que pertenezcan a un id específico. Si se utiliza para regiones, obtienes el mismo resultado que con $dc_get_all('regiones').

- Uso por defecto:
dc_get_all('',$parent_id);

Llama a las comunas cuya provincia pertenece a $parent_id.

- Parámetros:
$type
    (string) (opcional) Selecciona la tabla a llamar.

    'regiones' - Llama todas las regiones de Chile.
    'provincias' - Llama todas las provincias de Chile.
    'comunas' - Llama todas las comunas de Chile. Opción por defecto.

$parent_id
    (integer)(obligatorio) Selecciona el id del $type padre.

- Devuelve:
	(array)(object)
    Un Array con Objetos, con los siguientes índices:

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

function dc_get_child($type='', $parent_id=''){
	global $wpdb;
	switch ($type) {
	    case 'regiones':
	        $type = 'region';
	        break;
	    case 'provincias':
	        $type = 'provincia';
	        $parent = 'region';
	        break;
		default:
	        $type = 'comuna';
	        $parent = 'provincia';
		}

	if(!empty($parent_id)){
		$parent_id = (int)$parent_id;
		} else {
		$parent_id = 0;
		}

	$tabla = dc_tabla($type);
	$pquery = $type.'_'.$parent.'_id';

	if($type == 'provincia' || $type == 'comuna'){
		$output = $wpdb->get_results("SELECT * FROM $tabla WHERE $pquery = $parent_id");
		}
	else{
		$output = $wpdb->get_results("SELECT * FROM $tabla");
		}

	if(!empty($output)) return $output;

	}


?>