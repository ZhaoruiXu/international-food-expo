<?php
/**
 * The template for displaying vendor application thank you page
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
acf_form_head();
get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

      $new_post_id = $_GET["thankid"];

      if(function_exists( 'get_field' )){
        if(get_field('full_name', $new_post_id )){
          $full_name = get_field('full_name', $new_post_id );
          echo $full_name;
        }
        if(get_field('select_vendor_tier', $new_post_id )){
          $select_vendor_tier = get_field('select_vendor_tier', $new_post_id );
          echo $select_vendor_tier->name;
          // echo '<pre>'; print_r($select_vendor_tier); echo '</pre>';
        }
      }
     

      $new_post = get_post( $new_post_id );
      echo $new_post -> post_title;

      echo "Today is " . date("M d, Y") . "<br>";

      get_template_part( 'template-parts/featured-vendors' );
     
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
