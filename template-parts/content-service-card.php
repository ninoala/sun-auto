<div class="service-card">
  <div class="service-card__image-box"><?php if (has_post_thumbnail()) {
      the_post_thumbnail('service-thumb');
    } ?> </div>
  <h3 class="heading-tertiary heading-tertiary--services"><?php the_title(); ?></h3>
  <a href="#" class="square-btn square-btn--services" data-id="<?php the_ID(); ?>">詳細を見る &rarr;</a>
</div>
