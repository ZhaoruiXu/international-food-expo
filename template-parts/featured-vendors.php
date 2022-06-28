<?php
/**
 * Template part for displaying featured vendors
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Food_Expo
 */

?>

<?php 

// Get the first ordered vendor type
// Vendors are returned based on a custom order set using the 'Category Order and Taxonomy Terms Order' Plugin
$terms = get_terms(array(
  'taxonomy' => 'ife-vendor-type',
  'number' =>		1,
));

if( $terms && !is_wp_error( $terms ) ) :
  $term = $terms[0];

  $args = array(
    'post_type' 	=> 'ife-vendor',
    'tax_query'		=> array(
      array(
        'taxonomy'	=> 'ife-vendor-type',
        'field'			=> 'slug',
        'terms'			=> $term->slug,
      )
    )
  );
  
  $query = new WP_Query( $args );
  
  if ( $query -> have_posts() ){
    ?>
    <section class="featured-vendors">
      <h2>Featured Vendors</h2>
      <div class="vendors swiper">
        <button class="swiper-button-prev"></button>
        <div class="vendor-wrapper swiper-wrapper">
          <?php
          while ( $query -> have_posts() ) {
            $query -> the_post();
            ?>
            <figure class="vendor swiper-slide">
              <figcaption class="vendor-name"><?php echo get_the_title() ?></figcaption>
              <?php the_post_thumbnail('post-thumbnail', ['class' => 'vendor-image']) ?>
            </figure>
            <?php
          
          }
          wp_reset_postdata();
          ?>
        </div>
        <button class="swiper-button-next"></button>
      </div>
      <a class="vendor-page-link" href="<?php echo esc_url( get_page_link( 40 ) ) ?>">
        See All Vendors
      </a>
    </section>
    <?php
  }
endif;