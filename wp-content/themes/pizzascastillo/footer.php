
    <footer>
      <?php
        $args = array(
          'theme_location' => 'header-menu',
          'container' => 'nav',
          'after' => '<span class="separador"> | </span>'
        );
        wp_nav_menu($args);
      ?>
      <div class="ubicacion">
        <p><?= esc_html( get_option('pizzascastillo_direccion') ); ?></p>
        <p>Teléfono: <?= esc_html( get_option('pizzascastillo_telefono') ); ?></p>
      </div>

      <p class="copyright">
        Todos los derechos reservados <?= date('Y') ?>
      </p>
    </footer>


    <?php wp_footer(); ?>
  
  </body>
</html>