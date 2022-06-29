<?php
/**
 * The template for displaying vendor application page
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

      ?>

      <div id="vendor-application-form">
	
      <?php
      // To create a new vendor post (typeof ife-vendor CPT)
      acf_form(array(
        'post_id'		=> 'new_post',
        'post_title'	=> true,
        'post_content'	=> false,
        'new_post'		=> array(
          'post_type'		=> 'ife-vendor',
          'post_status'	=> 'pending'
        ),
        'html_before_fields' => '<input type="text" id="issubmitform" name="issubmitform" value="yes" style="display:none;">',
        // 'return'		=> home_url('vendor-thank-you/?thankid=' . $post_id), // redirect to thank-you page
        'submit_value'	=> 'Submit Application'
      ));
      
      ?>
      
      </div>

      <?php  
      $terms = get_terms(array(
        'taxonomy' => 'ife-vendor-type',
      ));

      if( $terms && !is_wp_error( $terms ) ) :
        foreach($terms as $term) :
          ?>
          <p><?php echo $term->name ?></p>
          <p><?php echo $term->description ?></p>
          <?php
        endforeach;
      endif;

      get_template_part( 'template-parts/featured-vendors' );

      ?>
   
    <?php  
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
