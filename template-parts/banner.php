<?php 
?>
<header class="banner-part">
  <?php 
  if ( is_home() ) : 
    echo get_the_post_thumbnail(29, 'ife-banner');
    ?>
    <div class="banner-content">
      <h1 class="banner-text"><?php echo get_the_title(29) ?></h1>
    </div>
    <?php
  else :
    the_post_thumbnail('ife-banner');
    ?>
    <div class="banner-content">
      <h1 class="banner-text"><?php the_title() ?></h1>
    </div>
    <?php
  endif  
  ?>
</header>

<?php
