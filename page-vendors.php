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
			
			$terms = get_terms(array(
				'taxonomy' => 'ife-vendor-type',
			));
			
			if( $terms && !is_wp_error( $terms ) ) :
				foreach($terms as $term) :
					$args = array(
						'post_type' =>	'ife-vendor',
						'orderby' =>		'name',
						'order' =>			'ASC',
						'tax_query'		=> array(
							array(
								'taxonomy'	=> 'ife-vendor-type',
								'field'			=> 'slug',
								'terms'			=> $term->slug,
							)
						)
					);
					
					$query = new WP_Query( $args );
					
					if ( $query -> have_posts() ) :
						?>
						<section class="vendor-type-<?php echo $term->slug ?>">
							<h2><?php echo $term->name ?></h2>
							<?php
							while ( $query -> have_posts() ) :
								$query -> the_post();
								?>
								<article class="vendor vendor-<?php echo get_the_ID() ?> vendor-<?php echo get_post()->post_name ?>">
									<h3><?php the_title() ?></h3>
									<?php the_post_thumbnail('medium') ?>
								</article>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</section>
						<?php
					endif;
				endforeach;
			endif;

			

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
