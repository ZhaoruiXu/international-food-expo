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

			get_template_part( 'template-parts/banner' );

      if ( function_exists ( 'get_field' ) ) {
        ?>
        <section class="about-description">
          <?php 
          if ( get_field( 'about_title' ) ) {
            ?>
            <h2><?php the_field( 'about_title' ) ?></h2>
            <?php
          };
          ?>
          <?php
          if ( get_field( 'description' ) ) {
            the_field( 'description' );
          }
          ?>  
        </section>

        <section class="about-history">
          <?php 
          if( get_field( 'history_title' ) ) {
            ?>
            <h2><?php the_field( 'history_title' )  ?></h2>
            <?php
          }
          ?>
          <?php  
          if( have_rows('history') ):
            // Loop through rows.
            ?>
            <div class="history-years">
              <?php
              $rowCount = 0;
              while( have_rows('history') ) : 
                the_row();

                // Load sub field value.
                if( get_sub_field('year') ){
                  $year = get_sub_field('year');
                  ?>
                    <button class="year-btn <?php echo $rowCount===0 ? "active" : "" ?>" value=<?php echo "history-" . $year ?>>
                      <?php echo $year ?>
                    </button>
                  <?php    
                }
                $rowCount++;

              // End loop.
              endwhile;
              ?>
            </div>

            <div class="history-description">
              <?php 
              $rowCount = 0;
              while( have_rows('history') ) : 
                the_row();

                // Load sub field value.
                if( get_sub_field('description') ){
                  $year = get_sub_field('year');
                  $description = get_sub_field('description');
                  ?>
                    <div class="<?php echo "history-" . $year ?> <?php echo $rowCount===0 ? "active" : "" ?>" >
                      <p>
                        <?php echo $description ?>
                      </p>
                    </div>
                  <?php    
                }

                $rowCount++;

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
            <?php 
            // Event Dates
            if ( get_field( 'start_date' ) && get_field( 'end_date' ) ) {
              ?>
              <p class="event-dates"><?php the_field( 'start_date' )?> - <?php the_field( 'end_date' )?></p>
              <?php
            }

            // Event Address
            if( get_field('event_address') ): 
              $location = get_field('event_address');
              ?>
              <p class="event-address"><?php echo $location['address']; ?></p>
              <?php 
            endif; 
            ?>
            <p>
              <?php  ?>
            </p>
            <a href="<?php echo home_url('schedule') ?>">Event Schedule</a>

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
