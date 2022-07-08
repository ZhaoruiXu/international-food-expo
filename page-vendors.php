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

			get_template_part( 'template-parts/banner' );

			get_template_part( 'template-parts/featured-vendors' );
			
			$args = array(
				'post_type' 			=> 'ife-vendor',
				'orderby' 				=> 'name',
				'order' 					=> 'ASC',
				'posts_per_page' 	=> -1
			);
			
			$query = new WP_Query( $args );
			
			if ( $query -> have_posts() ) :
				?>
				<section class="all-vendors-section">
					<h2>All Vendors</h2>
					<form>
						<label for="vendor-search">Looking for a vendor?</label>
						<input type="search" class="vendor-search" id="vendor-search" name="vendor-search" placeholder="Search here...">
					</form>

					<div class="vendors-grid">
						<?php
						while ( $query -> have_posts() ) :
							$query -> the_post();

							// Assign vendor type classes
							$term_obj_list = get_the_terms( get_the_ID(), 'ife-vendor-type' );
							$terms_classlist = empty($term_obj_list) ? "" : ".vendor-type-" . join(' .vendor-type-', wp_list_pluck($term_obj_list, 'slug'));

							?>
							<article 
								class="vendor vendor-<?php echo get_the_ID() ?> vendor-<?php echo get_post()->post_name ?> <?php echo $terms_classlist ?>"	
							>
								<a href="" src="<?php echo get_the_post_thumbnail_url() ?>" class="vendor-link" id="<?php echo get_the_ID() ?>" >
									<?php the_post_thumbnail('ife-vendor-logo') ?>
									<h3 class="vendor-heading"><?php the_title() ?></h3>
								</a>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</section>
				<div class="vendor-modal hidden">
					<div class="vendor-modal-wrapper">
						<?php 
						get_template_part("template-parts/loading")
						?>
						<div class="vendor-modal-content">
							<h2 class="vendor-modal-heading"></h2>
							<p class="vendor-modal-text"></p>
							<img class="vendor-modal-image" src="" alt="">
						</div>
						<button class="vendor-modal-close-btn">Close</button>
					</div>
				</div>
				<?php
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
