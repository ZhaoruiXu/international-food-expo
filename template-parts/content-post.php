<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Food_Expo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			get_template_part( 'template-parts/banner' );
		else :
			the_post_thumbnail('ife-thumbnail');
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;
		
		if ( 'post' === get_post_type() ) :
			?>

			<div class="entry-meta">
				<?php
				food_expo_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	
	<div class="entry-content">
		<?php
		if(is_single()) {
			the_content();
		}
		else {
			the_excerpt();
		}
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
