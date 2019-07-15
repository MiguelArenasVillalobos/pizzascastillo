<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php wp_head(); ?>
</head>

<body>
  <header class="encabezado-sitio">
    <div class="contenedor">
      <div class="logo">
        <a href="<?= esc_url(home_url('/')); ?>">
          <?php if (function_exists('the_custom_logo')) {
            the_custom_logo();
          } ?>
        </a>
      </div> <!--.logo--> 
      <div class="informacion-encabezado">
        <div class="redes-sociales">
          <?php $args = array(
            'theme_location' => 'social-menu',
            'container' => 'nav',
            'container_class' => 'sociales',
            'container_id' => 'sociales',
            'link_before' => '<span class="sr-text">',
            'link_after' => '</span>'
          );
          wp_nav_menu($args);
          ?>
        </div> <!--.redes-sociales-->
        <div class="direccion">
          <p><?= esc_html( get_option('pizzascastillo_direccion') ); ?></p>
          <p>Teléfono: <?= esc_html( get_option('pizzascastillo_telefono') ); ?></p>
        </div>

      </div>

    </div> <!--.contenedor-->
  </header>

    <div class="menu-principal">
      <div class="mobile-menu">
        <a href="#" class="mobile"><i class="fas fa-bars"></i> Menú</a>
      </div>


      <div class="contenedor navegacion">
        <?php
        $args = array(
          'theme_location' => 'header-menu',
          'container' => 'nav',
          'container_class' => 'menu-sitio'
        );
      
        wp_nav_menu($args);
      
        ?>
      </div>
    </div>
