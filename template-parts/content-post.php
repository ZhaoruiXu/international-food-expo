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
		<?php food_expo_post_thumbnail(); ?>
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;
		
		if ( 'post' === get_post_type() ) :
			?>

			<div class="entry-meta">
				<?php
				food_expo_posted_on();
				// food_expo_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	
	<div class="entry-content">

	<article class = 'moreinfo'>
		<?php
		
		if(is_single()) {
			the_content();
		}
		else {
			the_excerpt();
		}
					?>
			</article>
			</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php food_expo_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
