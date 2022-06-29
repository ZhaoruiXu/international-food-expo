<?php
/**
 * The template for displaying about page
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

			// get_template_part( 'template-parts/content', 'page' );

      if ( function_exists ( 'get_field' ) ) {

            if ( get_field( 'description' ) ) {
            ?>

                <section class="about-description">
                  <?php the_title( '<h2>', '</h2>' ); ?>
                  <?php the_field( 'description' ); ?>
                </section>

            <?php 
            }
            ?>  

           <section class="about-history">
            <h2>Our History</h2>
           <?php  
           if( have_rows('history') ):
                // Loop through rows.
                ?>

                <div class="history-year">

                <?php  
                while( have_rows('history') ) : the_row();

                    // Load sub field value.
                    if( get_sub_field('year') ){
                      $sub_value_year = get_sub_field('year');
                    ?>
                      <h3><?php echo $sub_value_year ?></h3>
                    <?php    
                    }

                // End loop.
                endwhile;
                ?>

                </div>

                <div class="history-description">
                
                <?php 
                while( have_rows('history') ) : the_row();

                    // Load sub field value.
                    if( get_sub_field('description') ){
                      $sub_value_year = get_sub_field('description');
                    ?>
                      <h3><?php echo $sub_value_year ?></h3>
                    <?php    
                    }

                // End loop.
                endwhile;
                ?>

                </div>

            <?php 
            endif;
            ?>
            </section> 
            
            <section class="about-organizers">
            <?php     
            if( have_rows('organizers') ):
                // Loop through rows.
                ?>
                <h2>Organizers</h2>
                <div class="swiper swiper-organizers">
                  <button class="swiper-button-prev swiper-organizers-button-prev"></button>
                  <div class="swiper-wrapper">
                    <?php  
                    while( have_rows('organizers') ) : the_row();

                        // Load sub field value.
                        if(get_sub_field('name') && get_sub_field('description') && get_sub_field('image')){
                          $sub_value_name = get_sub_field('name');
                          $sub_value_description = get_sub_field('description');
                          $sub_value_image = get_sub_field('image');
                          ?>
                          <div class=swiper-slide>
                            <h3><?php echo $sub_value_name ?></h3>
                            <p><?php echo $sub_value_description ?></p>
                            <?php    
                            }
                            echo wp_get_attachment_image( $sub_value_image, 'thumbnail' );
                            ?>
                          </div>
                        <?php  

                    // End loop.
                    endwhile;
                    ?>
                </div>
                <nav class="swiper-organizers-pagination"></nav>
                <button class="swiper-button-next swiper-organizers-button-next"></button>
              </div>
            <?php 
            endif;
            ?>
            </section>
            
            <section class="about-location-time">
              
              <div class="location-time-info">
                <ul>
                <?php 
                
                while( have_rows('event_dates') ) : the_row();
                    
                    // Load sub field value.
                    if( get_sub_field('date') ){
                      $sub_value_date = get_sub_field('date');
                    ?>
                      <li><?php echo $sub_value_date ?></li>
                    <?php    
                    }

                // End loop.
                endwhile;

                ?>
                </ul>
                <a href="<?php echo home_url('vendors') ?>">See Our Vendors</a>
                <a href="<?php echo home_url('schedule') ?>">See Our Schedules</a>

              </div>

              <?php 
              get_template_part( 'template-parts/event-map' );
              ?>
              
            </section>

            <?php  
        } 

      get_template_part( 'template-parts/featured-vendors' );


		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
