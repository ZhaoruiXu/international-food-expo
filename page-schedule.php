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

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
          <?php the_post_thumbnail(); ?>
           <?php if ( have_posts() ) : ?>
            
            
            <header class="page-header">

                <h1 class="page-header"></h1>
                
                
            </header>
            
        
            <!-- .page-header -->
        <?php

        $args = array(
            'post_type'     =>'ife-event',
            'posts_per_page' => -1,
            'orderby'       => 'title',
            'order'         => 'asc'
        );

        
    
        $query = new WP_Query( $args );
        if( $query -> have_posts() ) {
            echo '<section class="events">';
            while(  $query->have_posts() ) {
                $query->the_post();
                ?>
                <article class="ife-events">
                    <a href="<?php the_permalink(); ?> "><h2><?php the_title() ?></h2></a>
                    <p><?php the_field('time'); ?></p>
                    <?php the_post_thumbnail( 'day-1-pass') ?>
                    <p> <?php the_field('description'); ?></p>
                    <a href="<?php the_permalink(); ?> "><h2>More Info</h2></a>
                    <?php the_excerpt() ?>
                    <?php $currentID = get_the_ID();
                        echo get_the_term_list( get_the_ID(), 'ife-event-type');
                        ?></p>
                </article>
				<?php
            }
            echo '</section>';
            wp_reset_postdata();
        };
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
        <?php get_template_part('template-parts/vendors', 'featured');?>
    </main><!-- #primary -->
<?php
get_footer();
