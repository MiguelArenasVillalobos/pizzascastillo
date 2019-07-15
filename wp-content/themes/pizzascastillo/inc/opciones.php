<?php

function pizzascastillo_ajustes() {

  add_menu_page('Pizzas Castillo', 'Pizzas Castillo Ajustes', 'administrator', 'pizzascastillo_ajustes', 'pizzascastillo_opciones', '', '20');
  add_submenu_page('pizzascastillo_ajustes', 'Reservaciones', 'Reservaciones', 'administrator', 'pizzascastillo_reservaciones', 'pizzascastillo_reservaciones');

  //llamar al registro de las opciones de nuestro theme
  add_action('admin_init', 'pizzascastillo_registrar_opciones');
}

add_action('admin_menu', 'pizzascastillo_ajustes');

function pizzascastillo_registrar_opciones() {
  // Registar opciones una por campo
  register_setting( 'pizzascastillo_opciones_grupo', 'pizzascastillo_direccion' );
  register_setting( 'pizzascastillo_opciones_grupo', 'pizzascastillo_telefono' );

  register_setting('pizzascastillo_opciones_gmaps', 'pizzascastillo_gmap_latitud');
  register_setting('pizzascastillo_opciones_gmaps', 'pizzascastillo_gmap_longitud');
  register_setting('pizzascastillo_opciones_gmaps', 'pizzascastillo_gmap_zoom');
  register_setting('pizzascastillo_opciones_gmaps', 'pizzascastillo_gmap_apikey');
}

function pizzascastillo_opciones() {
?>
  
  <div class="wrap">
    <h1>Ajustes Pizzas Castillo</h1>

    <?php
      if(isset($_GET['tab'])):
        $active_tab = $_GET['tab'];
      endif;
    ?>

    <h2 class="nav_tab_wrapper">
      <a href="?page=pizzascastillo_ajustes&tab=tema" class="nav-tab <?= empty($active_tab) || $active_tab == 'tema' ? 'nav-tab-active' : '' ?>">Ajustes</a>
      <a href="?page=pizzascastillo_ajustes&tab=gmaps" class="nav-tab <?= $active_tab == 'gmaps' ? 'nav-tab-active' : '' ?>">Google Maps</a>
    </h2>

    <form action="options.php" method="post">

      <?php if(empty($active_tab) || $active_tab === 'tema'): ?>
        <?php settings_fields( 'pizzascastillo_opciones_grupo' ); ?>
        <?php do_settings_sections( 'pizzascastillo_opciones_grupo' ); ?>
        <table class="form-table">
          <tr valign="top">
            <th scope="row">Dirección: </th>
            <td><input type="text" name="pizzascastillo_direccion" value="<?= esc_attr( get_option('pizzascastillo_direccion') ); ?>"> </td>
          </tr>

          <tr valign="top">
            <th scope="row">Teléfono: </th>
            <td><input type="text" name="pizzascastillo_telefono" value="<?= esc_attr( get_option('pizzascastillo_telefono') ); ?>"> </td>
          </tr>
        </table>
        <?php submit_button(); ?>

      <?php elseif($active_tab === 'gmaps'): ?>

        <?php settings_fields( 'pizzascastillo_opciones_gmaps' ); ?>
        <?php do_settings_sections( 'pizzascastillo_opciones_gmaps' ); ?>
        <table class="form-table">
          <tr valign="top">
            <th scope="row">Latitud: </th>
            <td><input type="text" name="pizzascastillo_gmap_latitud" value="<?= esc_attr( get_option('pizzascastillo_gmap_latitud') ); ?>"> </td>
          </tr>

          <tr valign="top">
             <th scope="row">Longitud: </th>
            <td><input type="text" name="pizzascastillo_gmap_longitud" value="<?= esc_attr( get_option('pizzascastillo_gmap_longitud') ); ?>"> </td>
          </tr>

          <tr valign="top">
             <th scope="row">Zoom: </th>
            <td><input type="number" name="pizzascastillo_gmap_zoom" value="<?= esc_attr( get_option('pizzascastillo_gmap_zoom') ); ?>"> </td>
          </tr>

          <tr valign="top">
             <th scope="row">API Key: </th>
            <td><input type="text" name="pizzascastillo_gmap_apikey" value="<?= esc_attr( get_option('pizzascastillo_gmap_apikey') ); ?>"> </td>
          </tr>
        </table>

        <?php submit_button(); ?>
      <?php else: ?>
        <div class="card">
          <h2>La página solicitada no existe</h2>
        </div>
      <?php endif; ?>
    </form>
  </div>

<?php
}

function pizzascastillo_reservaciones() {
  ?>
    <div class="wrap">
      <h1>Reservaciones</h1>

      <table class="wp-list-table widefat striped">
        <thead>
          <tr>
            <th class="manage-column">ID</th>
            <th class="manage-column">Nombre</th>
            <th class="manage-column">Fecha de Reserva</th>
            <th class="manage-column">Correo</th>
            <th class="manage-column">Teléfono</th>
            <th class="manage-column">Mensaje</th>
            <th class="manage-column">Eliminar</th>
          </tr>
        </thead>

        <tbody>
          <?php global $wpdb;
            $reservaciones = $wpdb->prefix . 'reservaciones';
            $registros = $wpdb->get_results(" SELECT * FROM $reservaciones", ARRAY_A);

            foreach($registros as $registro): ?>
              <tr>
                <td><?= $registro['id']; ?></td>
                <td><?= $registro['nombre']; ?></td>
                <td><?= $registro['fecha']; ?></td>
                <td><?= $registro['correo']; ?></td>
                <td><?= $registro['telefono']; ?></td>
                <td><?= $registro['mensaje']; ?></td>
                <td>
                  <a class="borrar_registro" href="#" data-reservaciones="<?= $registro['id']; ?>">Eliminar</a>
                </td>
              </tr>
          
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php
}

