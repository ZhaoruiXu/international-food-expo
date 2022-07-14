<?php
/**
 * The template for displaying schedule page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */
get_header();
?>
    <main id="primary" class="site-main">
        <?php
		while ( have_posts() ) :
			the_post();

			get_template_part('template-parts/banner');

            $args = array(
                'post_type'     =>'ife-event',
                'posts_per_page' => -1,
                'meta_key'	=> 'time',
                'orderby'   => 'meta_value',
                'order'     => 'asc'
            );

            $query = new WP_Query( $args );
            if( $query -> have_posts() ) {
                ?>
                <section class="events">
                <?php
                while(  $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <article class="ife-event">
                        <?php the_post_thumbnail( 'ife-thumbnail') ?>
                        <h3 class="event-heading"><a href="<?php the_permalink(); ?> "><?php the_title() ?></a></h3>
                        <p class="event-time"><?php the_field('time'); ?></p>
                        <div class="event-description">
                            <p>
                                <?php the_field('description'); ?><?php the_excerpt(); ?>
                                <a class="read-more" href="<?php the_permalink() ?>">More Info<span class="screen-reader-text"> about <?php the_title() ?></span></a>
                            </p>
                        </div>
                    </article>
                    <?php
                }
                ?>
                </section>
                <?php
                wp_reset_postdata();
            };
            ?>
        <?php 
        
        get_template_part('template-parts/featured-vendors');

		endwhile; // End of the loop.
		?>
          
    </main><!-- #primary -->
<?php
get_footer();
