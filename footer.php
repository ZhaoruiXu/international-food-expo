<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Food_Expo
 */

	$credits = array(
		array(
			"name" => "Clayton Jang",
			"link" => "https://claytonjang.com/",
		),
		array(
			"name" => "Zhaorui Xu",
			"link" => "https://zhaoruixu.com/personal-portfolio/",
		),
		array(
			"name" => "Amrik Grewal",
			"link" => "https://www.amrikgrewal.com/",
		),
		array(
			"name" => "Reuel Sobiono",
			"link" => "https://sobiono.ca/",
		),
	);
?>

	<footer id="colophon" class="site-footer">
		<div class="content-wrapper">
			<div class="logo">
				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
				if ( has_custom_logo() ) :
					?>
					<img class="site-logo" src=<?php echo esc_url( $logo[0] ) ?> alt=<?php echo get_bloginfo( 'name' ) ?> >
					<span class="screen-reader-text"><?php bloginfo( 'name' ) ?></span>
					<?php
				endif;
				?>
			</div>
			<nav id="site-navigation" class="footer-navigation">
				<?php
				// Left Column
				wp_nav_menu(
					array(
						'theme_location' => 'footer-left',
						'menu_id'        => 'footer-left',
					)
				);
				// Right Column
				wp_nav_menu(
					array(
						'theme_location' => 'footer-right',
						'menu_id'        => 'footer-right',
					)
				);
				?>
			</nav>
			<div class="site-info">
				<span class="message">Built By:</span>
				<ul class="credits">
					<?php
					foreach($credits as $id=>$credit):
						?>
						<li>
							<a href="<?php echo esc_url( __( $credit["link"], 'food-expo' ) ); ?>"><?php echo $credit["name"] ?></a>
						</li>
						<?php
							if ( $id !== (sizeof($credits)-1) ) :
								echo "<span class='separator'>" . "·" . "</span>";
							endif;
					endforeach;
					?>
				</ul>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
