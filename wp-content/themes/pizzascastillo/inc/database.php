<?php

function pizzascastillo_database() {
  // WPDB nos da los metodos para trabajar con tablas
  global $wpdb;
  // Agregamos una versión
  global $pizzascastillo_dbversion;
  $pizzascastillo_dbversion = '1.0';

  // Obtenemos el prefijo
  $tabla = $wpdb->prefix . 'reservaciones';

  //obtenemos el collation del a instalacion
  $charset_collate = $wpdb->get_charset_collate();

  // Agregamos la estructura de la base de datos
  $sql = "CREATE TABLE $tabla (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          nombre varchar(50) NOT NULL,
          fecha datetime NOT NULL,
          correo varchar(50) DEFAULT '' NOT NULL,
          telefono varchar(15) NOT NULL,
          mensaje longtext NOT NULL,
          PRIMARY KEY (id)
  ) $charset_collate; ";

  // Se necesita dbDelta para ejecutar el SQL y esta en la siguiente dirección
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);

  //Agregamos la versión de la DB Para compararla con futuras actualizaciones
  add_option('pizzascastillo_dbversion', $pizzascastillo_dbversion);

  // ACTUALIZAR EN CASO DE SER NECESARIO
  $version_actual = get_option('pizzascastillo_dbversion');

  // Comparamos las 2 versiones
  if($pizzascastillo_dbversion != $version_actual) {
    // Aquí se realiza las actualizaciones
    $sql = "CREATE TABLE $tabla (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            nombre varchar(50) NOT NULL,
            fecha datetime NOT NULL,
            correo varchar(50) DEFAULT '' NOT NULL,
            telefono varchar(15) NOT NULL,
            mensaje longtext NOT NULL,
            PRIMARY KEY (id)
    ) $charset_collate; ";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    // Actualizamos a la version actual en caso de que así sea
    update_option('pizzascastillo_dbversion', $pizzascastillo_dbversion);
  }
}

add_action('after_setup_theme', 'pizzascastillo_database');


// Funcion para comprobar que la version instalada es igual a la base datos nueva.
function pizzascastillo_revisar() {
  global $pizzascastillo_dbversion;

  if(get_site_option('pizzascastillo_version') != $pizzascastillo_dbversion) {
    pizzascastillo_database();
  }
}

add_action('plugins_loaded', 'pizzascastillo_revisar');



