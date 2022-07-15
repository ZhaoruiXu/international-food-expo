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

			get_template_part( 'template-parts/banner' ); 

      $new_post_id = $_GET["thankid"];
      
      if (get_post( $new_post_id ) ) : 
        $new_post = get_post( $new_post_id );
        ?>
        <section class="application-summary-section">
          <div class="content-wrapper">
            <h2>Thank you for your application.</h2>
            <p>We have received your application and will contact you pending our review process to get additional information or to finalize your application.</p>
            <table class="summary-table">
              <caption>Application Info</caption>
              <tbody>
                <?php
                if(function_exists( 'get_field' )){
                  if(get_field('select_vendor_tier', $new_post_id )){
                    ?>
                    <tr><td>Company Name</td><td><?php echo $new_post -> post_title ?></td></tr>
                    <?php
                  }
                  if(get_field('company_website', $new_post_id )){
                    ?>
                    <tr><td>Company Website</td><td><?php echo get_field('company_website', $new_post_id ) ?></td></tr>
                    <?php
                  }
                  if(get_field('company_description', $new_post_id )){
                    ?>
                    <tr><td>Company Description</td><td><?php echo get_field('company_description', $new_post_id ) ?></td></tr>
                    <?php
                  }
                  if(get_field('select_vendor_tier', $new_post_id )){
                    ?>
                    <tr><td>Selected Vendor Tier</td><td><?php echo get_field('select_vendor_tier', $new_post_id )->name ?></td></tr>
                    <?php
                  }
                  if(get_field('full_name', $new_post_id )){
                    ?>
                    <tr><td>Contact Name</td><td><?php echo get_field('full_name', $new_post_id ) ?></td></tr>
                    <?php
                  }
                  if(get_field('email_address', $new_post_id )){
                    ?>
                    <tr><td>Email</td><td><?php echo get_field('email_address', $new_post_id ) ?></td></tr>
                    <?php
                  }
                  if(get_field('phone_number', $new_post_id )){
                    ?>
                    <tr><td>Phone Number</td><td><?php echo get_field('phone_number', $new_post_id ) ?></td></tr>
                    <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </section>
        <?php
      endif;

      get_template_part( 'template-parts/featured-vendors' );
     
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
