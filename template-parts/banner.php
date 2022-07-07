<?php 
?>
<header class="banner-part">
  <?php 
  if ( is_home() ) : 
    echo get_the_post_thumbnail(29, 'ife-banner');
    ?>
    <h1><?php echo get_the_title(29) ?></h1>
    <?php
  else :
    the_post_thumbnail('ife-banner');
    ?>
    <h1><?php the_title() ?></h1>
    <?php
  endif  
  ?>
</header>

<?php
