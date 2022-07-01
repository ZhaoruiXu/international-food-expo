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
		
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/banner' ); 
			
			?>
			<section class="event-details">
				<?php
				if ( function_exists('get_field' ) ) {
					if ( get_field( 'time' ) ) {
						?>
						<p class="event-time"><?php the_field('time'); ?></p>
						<?php
					}
					if ( get_field( 'description' ) ) {
						?>
						<div class="event-description">
							<?php the_field('description'); ?>
						</div>
						<?php
					}
				}
				?>
			</section>
			<?php

			if( have_rows('guests') ):
				?>
				<section class="featured-guests">
					<h2>Featured Guests</h2>
					<div class="guest-wrapper">
						<?php
							// loop through the rows of data
							while ( have_rows('guests') ) : 
								the_row();
								?>
								<article class="guest">
									<h3 class="guest-name"><?php the_sub_field('name') ?></h3>
									<?php
									$image = get_sub_field('image');
									echo wp_get_attachment_image($image,'full');
									?>
									<p class="guest-description"><?php the_sub_field('description') ?></p>
								</article>
								<?php
							endwhile;
						?>
					</div>
				</section>
				<?php
			endif;

		endwhile; // End of the loop.
		?>
		
		<?php get_template_part('template-parts/featured-vendors');?>
	</main><!-- #main -->

<?php

get_footer();
