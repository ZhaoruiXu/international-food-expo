<?php
/**
 * The template for displaying all single events posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Food_Expo
 */

get_header();

?>

	<main id="primary" class="site-main">
	<?php get_template_part( 'template-parts/banner' ); ?>
	<p><?php the_field('date'); ?></p>


	<article>

	<div class = 'events'>

		<?php
		while ( have_posts() ) :
			the_post();
			
		
          	if ( function_exists('get_field' ) ) {

                if ( get_field( 'description' ) ) {
					echo "<p>". get_field( 'description'). "</p>";
				}
            }

			if( have_rows('guests') ):

				echo '<h2> Featured Guests</h2>';
				// loop through the rows of data
			   while ( have_rows('guests') ) : the_row();
		   
				   // display a sub field value
				   the_sub_field('name');
				   $image = get_sub_field('image');
				   echo wp_get_attachment_image($image,'full');
				   the_sub_field('description');
					
			   endwhile;
			   
			endif;
			

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		
		<?php get_template_part('template-parts/featured-vendors');?>
		
	</div>
	</article>
	</main><!-- #main -->

<?php


get_sidebar();
get_footer();
