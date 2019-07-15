<?php
// Añadir ReCaptcha
function pizzascastillo_agregar_recaptcha() { ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  });
  </script>
<?php
}
add_action('wp_head', 'pizzascastillo_agregar_recaptcha');

// Tablas personalizadas y otras funciones
require get_template_directory() . '/inc/database.php';

// Funciones para las reservaciones
require get_template_directory() . '/inc/reservaciones.php';

// Crear opciones para el template
require get_template_directory() . '/inc/opciones.php';

function pizzascastillo_setup() {
  add_theme_support('post-thumbnails');
  add_theme_support('title-tag');
  
  add_image_size('nosotros', 437, 291, true);
  add_image_size('especialidades', 768, 515, true);
  add_image_size('especialidades_portrait', 435, 526, true);

  update_option('thumbnail_size_w',253);
  update_option('thumbnail_size_h',164);
}
add_action('after_setup_theme', 'pizzascastillo_setup');

function pizzascastillo_custom_logo() {
  $logo = array(
    'height' => 216,
    'width' => 280
  );
  add_theme_support('custom-logo', $logo);
}
add_action('after_setup_theme', 'pizzascastillo_custom_logo');

function pizzascastillo_styles() {

  // Registrar los estilos
  wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.1' );
  wp_register_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,800|Raleway:400,700,900', array(), '1.0.0' );
  wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome/all.min.css', array('normalize'), '5.6.3' );
  wp_register_style( 'fluidboxcss', get_template_directory_uri() . '/css/fluidbox.min.css', array('normalize'), '1.0.0' );
  wp_register_style( 'datetime-local', get_template_directory_uri() . '/css/datetime-local-polyfill.css', array('normalize'), '1.0.0' );
  wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');

  // Llamar a los estilos
  wp_enqueue_style('normalize');
  wp_enqueue_style('google_fonts');
  wp_enqueue_style('fontawesome');
  wp_enqueue_style('fluidboxcss');
  wp_enqueue_style('datetime-local');
  wp_enqueue_style('style');

  // Registrar JS
  
  $apikey = esc_html(get_option('pizzascastillo_gmap_apikey'));
  wp_register_script('maps', 'https://maps.googleapis.com/maps/api/js?key='.$apikey.'&callback=initMap', array(), '', true);
  wp_register_script('fluidbox', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', array('jquery'), '1.0.0', true);
  wp_register_script('datetime-local-polyfill', get_template_directory_uri() . '/js/datetime-local-polyfill.min.js', array('jquery','modernizr'), '1.0.0', true);
  wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-build.min.js', array(), '3.6.0', true);
  wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);

  wp_enqueue_script('maps');
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-ui-core');
  wp_enqueue_script('jquery-ui-datepicker');
  wp_enqueue_script('modernizr');
  wp_enqueue_script('fluidbox');
  wp_enqueue_script('datetime-local-polyfill');
  wp_enqueue_script('scripts');

  // Pasar variables de PHP a JS
  wp_localize_script (
    'scripts',
    'opciones',
    array(
      'longitud' => get_option('pizzascastillo_gmap_longitud'),
      'latitud' => get_option('pizzascastillo_gmap_latitud'),
      'zoom' => get_option('pizzascastillo_gmap_zoom')
    )
  );
}
add_action('wp_enqueue_scripts', 'pizzascastillo_styles');

// STYLES ADMIN
function pizzascastillo_admin_scripts() {
  wp_enqueue_script('sweetalert', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js', array('jquery'), '1.0', true);
  wp_enqueue_script('adminjs', get_template_directory_uri() . '/js/admin-ajax.js', array('jquery'), '1.0', true);

  // Pasar la URL de WP Ajax al adminjs
  wp_localize_script(
    'adminjs',
    'url_eliminar',
    array('ajaxurl' => admin_url('admin-ajax.php'))
  );
}
add_action('admin_enqueue_scripts', 'pizzascastillo_admin_scripts');

// Agregar Async y Defer Google Maps
function agregar_async_defer($tag, $handle) {
  if('maps' === $handle) {
    $tag = str_replace(' src', ' async="async" defer="defer" src', $tag);
  }
  
  return $tag;
}
add_filter( 'script_loader_tag', 'agregar_async_defer', 10, 2 );


// Creación de menus
function pizzascastillo_menus() {
  register_nav_menus(array(
    'header-menu' => __('Header Menu', 'pizzascastillo'),
    'social-menu' => __('Social Menu', 'pizzascastillo')
  ));
}
add_action( 'init', 'pizzascastillo_menus' );

// Custom post type
add_action( 'init', 'pizzascastillo_especialidades' );
function pizzascastillo_especialidades() {
  $labels = array(
    'name'               => _x( 'Pizzas', 'pizzascastillo' ),
    'singular_name'      => _x( 'Pizzas', 'post type singular name', 'pizzascastillo' ),
    'menu_name'          => _x( 'Pizzas', 'admin menu', 'pizzascastillo' ),
    'name_admin_bar'     => _x( 'Pizzas', 'add new on admin bar', 'pizzascastillo' ),
    'add_new'            => _x( 'Add New', 'book', 'pizzascastillo' ),
    'add_new_item'       => __( 'Add New Pizza', 'pizzascastillo' ),
    'new_item'           => __( 'New Pizzas', 'pizzascastillo' ),
    'edit_item'          => __( 'Edit Pizzas', 'pizzascastillo' ),
    'view_item'          => __( 'View Pizzas', 'pizzascastillo' ),
    'all_items'          => __( 'All Pizzas', 'pizzascastillo' ),
    'search_items'       => __( 'Search Pizzas', 'pizzascastillo' ),
    'parent_item_colon'  => __( 'Parent Pizzas:', 'pizzascastillo' ),
    'not_found'          => __( 'No Pizzases found.', 'pizzascastillo' ),
    'not_found_in_trash' => __( 'No Pizzases found in Trash.', 'pizzascastillo' )
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'pizzascastillo' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'especialidades' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 6,
    'supports'           => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'          => array( 'category' ),
  );

  register_post_type( 'especialidades', $args );
}

//widgets
function pizzascastillo_widgets() {
  register_sidebar( array(
    'name'          =>  'Blog Sidebar',
    'id'            =>  'blog_sidebar',
    'before_widget' =>  '<div class="widget">',
    'after_widget'  =>  '</div>',
    'before_title'  =>  '<h3>',
    'after_title'   =>  '</h3>'
  ));
}
add_action('widgets_init', 'pizzascastillo_widgets');

/** ADVANCED CUSTOM FIELDS */
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_template_directory() . '/advanced-custom-fields/' );
define( 'MY_ACF_URL', get_template_directory_uri() . '/advanced-custom-fields/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf';
    
    
    // return
    return $paths;
    
}

