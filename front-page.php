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
			
			// Home Banner Carousel
			if ( function_exists('have_rows') ) :
				if( have_rows('carousel_slides') ):
					?>
					<section class="section-home-banner">
						<div class="carousel">
							<button class="swiper-button-prev swiper-home-button-prev"></button>
							<div class="swiper swiper-home">
								<div class="swiper-wrapper">
									<?php
									while( have_rows('carousel_slides') ) :
										the_row();
										$text = get_sub_field('text');
										$image = get_sub_field('background_image');
										$page_link = get_sub_field('page_link');
										?>
										<div class="swiper-slide">
											<?php
												if ($page_link) :
													?>
													<a href=<?php echo $page_link ?>>
													<?php
												endif;
												if ($image) :
													echo wp_get_attachment_image($image,'full');
												endif;
												if ($text) :
													?>
													<p class="banner-text"><?php echo $text ?></p>
													<?php
												endif;
												if ($page_link) :
													?>
													</a>
													<?php
												endif;
											?>
										</div>
										<?php
									endwhile;
									?>
								</div>
							</div>
							<button class="swiper-button-next swiper-home-button-next"></button>
							<nav class="swiper-pagination swiper-home-pagination"></nav>
						</div>
					</section>
					<?php
				endif;
			endif;

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

					if ( function_exists( 'get_field' ) ) :
						// Event Dates
            if ( get_field( 'start_date', 60 ) && get_field( 'end_date', 60 ) ) {
              ?>
              <p class="event-dates"><?php the_field( 'start_date', 60 )?> - <?php the_field( 'end_date', 60 )?></p>
              <?php
            }

            // Event Address
            if( get_field('event_address', 60) ): 
              $location = get_field('event_address', 60);
              ?>
              <p class="event-address"><?php echo $location['address']; ?></p>
              <?php 
            endif; 
					endif;
					?>
					
					<a class="schedule-page-link" href="<?php echo esc_url( get_page_link( 42 ) ) ?>">
						See Event Schedule
					</a>
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
							<?php the_excerpt() ?>
						</article>
						<?php
					}
					wp_reset_postdata();
				}
				?>
			</section>
			<?php
			the_content();
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
