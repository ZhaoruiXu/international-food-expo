<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Food_Expo
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/featured-vendors' );
			
			?>
			<section class="section-about">
				<div class="left-column">
					<?php
					// ID: 60 - About Page
					if ( function_exists( 'get_field' ) ) :
						if ( get_field( 'description', 60 ) ) :
							the_field( 'description', 60 );
						endif;
					endif;
					?>
					
					<a href=<?php echo get_page_link(60) ?> class="about-page-link" >More Info <span class="screen-reader-text">About the Convention</span></a>
				</div>
				<div class="right-column">
					<?php 
					get_template_part( 'template-parts/event-map' );

					// ID: 60 - About Page
					if ( function_exists( 'get_field' ) ) :
						if( get_field('event_address', 60) ): 
							$location = get_field('event_address', 60);
							?>
							<p class="event-address"><?php echo $location['address']; ?></p>
							<?php 
						endif; 

						// Event Dates
						if( have_rows('event_dates', 60) ):
							?>
							<div class="event-dates">
								<h3>Event Dates</h3>
								<ul class="date-list">
									<?php
									while( have_rows('event_dates', 60) ) : 
										the_row();

										// Format as Day of Week, Month Day Year
										$date = date( 'l, F j Y', strtotime( get_sub_field('date') ) );

										?>
										<li><?php echo $date ?></li>
										<?php
									endwhile;
									?>
								</ul>
								</div>
							<?php
						endif;
					endif;
					?>
				</div>
			</section>

			<section class="section-news">
				<h2>News and Updates</h2>
				<?php 
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3,
				);
				
				$query = new WP_Query( $args );
				
				if ( $query -> have_posts() ){
					while ( $query -> have_posts() ) {
						$query -> the_post();

						?>
						<article>
							<a href=<?php echo get_page_link() ?>>
								<?php the_post_thumbnail() ?>
								<h3><?php the_title() ?></h3>
							</a>
							<p><?php echo get_the_date() ?></p>
							<p><?php the_excerpt() ?></p>
						</article>
						<?php
					}
					wp_reset_postdata();
				}
				?>
			</section>
			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
