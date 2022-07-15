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
      
      get_template_part( 'template-parts/banner' );
      ?>

      <section id="vendor-application-form" class="vendor-application-form">
        <?php
        if ( function_exists( 'acf_form' ) ) :
          // To create a new vendor post (typeof ife-vendor CPT)
          acf_form(array(
            'post_id'		=> 'new_post',
            'post_title'	=> true,
            'post_content'	=> false,
            'new_post'		=> array(
              'post_type'		=> 'ife-vendor',
              'post_status'	=> 'pending'
            ),
            'uploader' => 'basic',
            'html_before_fields' => '<input type="text" id="issubmitform" name="issubmitform" value="yes" style="display:none;">',
            'submit_value'	=> 'Submit Application'
          ));
        endif;
        ?>
      </section>

      <?php  
      $terms = get_terms(array(
        'taxonomy' => 'ife-vendor-type',
      ));

      if( $terms && !is_wp_error( $terms ) ) :
        ?>
        <section class="vendor-tiers-section">
          <div class="content-wrapper">
            <h2>Vendor Tier Reference</h2>
            <?php
            foreach($terms as $term) :
              ?>
              <article class="vendor-tier vendor-tier-<?php echo strtolower($term->name) ?>">
                <h3><?php echo $term->name ?></h3>
                <p><?php echo $term->description ?></p>
              </article>
              <?php
            endforeach;
            ?>
          </div>
        </section>
        <?php
      endif;

      get_template_part( 'template-parts/featured-vendors' );

      ?>
   
    <?php  
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
