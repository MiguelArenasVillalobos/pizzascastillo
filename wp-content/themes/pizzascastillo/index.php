<?php get_header(); ?>

    <?php
      $pagina_blog = get_option('page_for_posts');
      $imagen = get_post_thumbnail_id($pagina_blog);
      $imagen = wp_get_attachment_image_src($imagen, 'full');
    ?>

    <div class="hero" style="background-image:url(<?php echo $imagen[0]; ?>);">
      <div class="contenido-hero">
        <div class="texto-hero">
          <h1><?php echo get_the_title($pagina_blog); ?></h1>
        </div>
      </div>
    </div>

    <div class="principal contenedor">
      <div class="contenedor-grid justify-center contenido-paginas">
        <main class="contenedor-blog columnas2-4">
         <?php while(have_posts()): the_post();  ?>
          <article class="entrada-blog">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('especialidades'); ?>
            </a>
            <header class="informacion-entrada">
              <div class="fecha">
                <time>
                  <?php echo the_time('d'); ?>
                  <span><?php the_time('M'); ?></span>
                </time>
              </div>
              <div class="titulo-entrada">
                <?php the_title('<h2>', '</h2>'); ?>
        
                <p class="autor">
                  <i class="fas fa-user" aria-hidden="true"></i>
                  <?php the_author(); ?>
                </p>
              </div>
              
              <?php the_tags(); ?>

            </header>
            <div class="contenido-entrada">
              <?php the_excerpt(); ?>
            </div>
        
            <a href="<?php the_permalink(); ?>" class="button">Leer más</a>
          </article>
          <?php endwhile; ?>

          <div class="paginacion">
            <?php echo paginate_links(); ?>
          </div>
          <div class="anteriores">
            <?php //next_posts_link('Anteriores'); ?>
          </div>
          <div class="siguientes">
            <?php //previous_posts_link('Siguientes'); ?>
          </div>
          
        </main><!--.contenedor-grid-->
        
        <?php get_sidebar(); ?>
      </div><!--.principal-->
    </div>
  

<?php get_footer(); ?>
