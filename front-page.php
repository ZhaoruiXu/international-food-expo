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
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'description', 60 ) ) {
							the_field( 'description', 60 );
						}
					}
					?>
					
					<a href=<?php echo get_page_link(60) ?>>More Info <span class="screen-reader-text">About the Convention</span></a>
				</div>
				<div class="right-column">

				</div>
			</section>
			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
