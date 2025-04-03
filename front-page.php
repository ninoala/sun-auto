<?php
get_header();
?>

<main id="primary" class="site-main">
  <section class="hero">
    <div class="hero__image-container">
        <div class="hero__image-slice hero__slice1 fade-up"></div>
        <div class="hero__image-slice hero__slice2 fade-down"></div>
        <div class="hero__image-slice hero__slice3 fade-up"></div>
        <div class="hero__image-slice hero__slice4 fade-down"></div>
        <div class="hero__image-slice hero__slice5 fade-up"></div>
    </div>

    <div class="hero__full-image"></div>

    <div class="hero__content">
      <img src="<?php echo get_theme_file_uri('images/logo.png'); ?>" alt="Logo" class="hero__image appear">
      <h1 class="heading-primary"></h1>
    </div>

    <div class="animated-image">
      <div class="animated-image__car-container">
        <img src="<?php echo get_theme_file_uri('images/car-no-wheels.png'); ?>" alt="Image of a car" class="animated-image__car">
        <img src="<?php echo get_theme_file_uri('images/wheel-front.png'); ?>" alt="Front wheel of a car" class="animated-image__wheel-front">
        <img src="<?php echo get_theme_file_uri('images/wheel-back.png'); ?>" alt="Back wheel of a car" class="animated-image__wheel-back">
      </div>
      <span class="animated-image__text">
        <?php echo esc_html(get_field('car_animation_text')); ?>
      </span>
    </div>
  </section>

  <section class="services" id="services">
    <div class="services__intro">
      <p class="services__intro-paragraph">
        <img src="<?php echo get_theme_file_uri('images/wrench-icon-left.png'); ?>" alt="Icon of a wrench" class="services__inline-icon">
        ご予約はLINE・お電話にて受付中
        <img src="<?php echo get_theme_file_uri('images/wrench-icon-right.png'); ?>" alt="Icon of a wrench" class="services__inline-icon">
      </p>

      <div class="services__contact">
        <a href="https://lin.ee/K7GbL8t" class="services__contact-link" target="_blank">
          <img src="<?php echo get_theme_file_uri('images/line-logo-long.png'); ?>" alt="Line logo">
        </a>

        <a href="tel:+812856121212" class="services__contact-phone">
          <img src="<?php echo get_theme_file_uri('images/icon-phone.png'); ?>" alt="Line logo"><span>0258-61-1212</span>
        </a>
      </div>
    </div>

    <div class="services__flex-container fade-up">
      <div class="services__cards-container">
      <?php 
      $homepageServices = new WP_Query(array(
        'posts_per_page' => 9,
        'post_type' => 'service',
        'meta_key' => 'service_order',  // Custom field for order
        'orderby' => 'meta_value_num',  // Order by custom field value
        'order' => 'ASC'
      ));
      
      while ($homepageServices->have_posts()) {
        $homepageServices->the_post();
        get_template_part('template-parts/content', 'service-card');
      } wp_reset_postdata();
      ?>
      </div>
    </div>

    <div class="popup" id="popup">
      <div class="popup__content">
        <div class="popup__header">
          <a href="#" class="popup__close">&times;</a>
        </div>
        <h2 class="heading-secondary--no-after u-margin-bottom-medium popup__title"></h2>
        <div class="popup__flex-container">
          <img src="" alt="" class="popup__thumbnail" />
          <div class="popup__text"></div>
        </div>
        <a href="" target="_blank" class="btn popup__link"></a>
      </div>
    </div>

    <div class="services__message">
      <img src="<?php echo get_theme_file_uri('images/megaphone.png'); ?>" alt="Image of megaphone" class="services__icon">
      <a href="#" class="services__link" id="openPopup">社長メッセージ</a>
      <img src="<?php echo get_theme_file_uri('images/hand.png'); ?>" alt="Image of hand" class="services__icon">
    </div>
  </section>

  <section class="news" id="news">
    <h2 class="heading-secondary u-margin-bottom-large">お知らせ</h2>

    <div class="news__grid-container">
    <?php 
    $homepagePosts = new WP_Query(array(
      'posts_per_page' => 4,
    ));

    while ($homepagePosts->have_posts()) {
      $homepagePosts->the_post(); ?>
      <div class="news__post fade-up">
        <div class="news__content">
          <div class="news__date-heading-container">
            <a class="news__date" href="<?php the_permalink(); ?>">
              <?php 
              $post_date = get_the_date('Y-m-d');
              $date = new DateTime($post_date);
              $formatted_date = $date->format('Y年m月d日'); 
              $year = $date->format('Y年');
              $day = $date->format('m月d日');
              ?>
              <span class="news__full-date"> <?php echo $year . '<br>' . $day; ?></span>
            </a>
            <h5 class="heading-tertiary heading-tertiary--news"><?php the_title(); ?></h5>
          </div>
          <div class="news__text">
            <?php the_content() ?></p>
          </div>
        </div>
        <?php the_post_thumbnail('news-portrait'); ?>
      </div>
      <?php } wp_reset_postdata(); ?>
    </div>
  </section>

  <section class="gallery">
    <h2 class="heading-secondary u-margin-bottom-large u-margin-top-large">ギャラリー</h2>

    <div class="gallery__grid-container">
      <img src="<?php echo get_theme_file_uri('images/gallery/gallery-1.png'); ?>" alt="Car shop image" class="gallery__image gallery__image--1 fade-up">
      <img src="<?php echo get_theme_file_uri('images/gallery/gallery-2.png'); ?>" alt="Car shop image" class="gallery__image gallery__image--2 fade-up">
      <img src="<?php echo get_theme_file_uri('images/gallery/gallery-3.png'); ?>" alt="Car shop image" class="gallery__image gallery__image--3 fade-up">
      <img src="<?php echo get_theme_file_uri('images/gallery/gallery-4.png'); ?>" alt="Car shop image" class="gallery__image gallery__image--4 fade-up">
      <img src="<?php echo get_theme_file_uri('images/gallery/gallery-5.png'); ?>" alt="Car shop image" class="gallery__image gallery__image--5 fade-up">
      <img src="<?php echo get_theme_file_uri('images/gallery/gallery-6.png'); ?>" alt="Car shop image" class="gallery__image gallery__image--6 fade-up">
    </div>
  </section>

  <section class="address" id="about">
    <h2 class="heading-secondary u-margin-top-medium u-margin-bottom-large">会社概要</h2>
    
    <div class="profile fade-up">
      <table class="profile-table">
        <tr>
          <th>社名</th>
          <td>サンオート株式会社</td>
        </tr>
        <tr>
          <th>代表取締役</th>
          <td>山岡 典斗（ヤマオカ フミト）</td>
        </tr>
        <tr>
          <th>所在地</th>
          <td>新潟県見附市本所町370番地1</td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td>0258-61-1212</td>
        </tr>
        <tr>
          <th>FAX番号</th>
          <td>0258-63-4122</td>
        </tr>
        <tr>
          <th>E-mail</th>
          <td>sunautomitsuke@gmail.com</td>
        </tr>
        <tr>
          <th>営業時間</th>
          <td>月〜金曜日 8:30〜19:00<br>土曜日 8:30～18:00</td>
        </tr>
      </table>

      <table class="profile-table">
        <tr>
          <th>定休日</th>
          <td>日曜日・祝日</td>
        </tr>
        <tr>
          <th>設立年月日</th>  
          <td>昭和46年4月26日</td>
        </tr>  
        <tr>
          <th>業務内容</th>
          <td>自動車整備、車検、新車中古車販売、各種損害保険代理店、<br /> オリックスカーリース取扱店</td>
        </tr>
        <tr>
          <th>資本金</th>
          <td>15,000,000円</td>
        </tr>
        <tr>
          <th>整備資格者数</th>
          <td>
            一級自動車整備士---1名<br>
            二級自動車整備士---1名<br>
            三級自動車整備士---2名
          </td>
        </tr>
        <tr>
          <th>決済方法</th>
          <td>現金、振込、クレジットカード、QRコード決済、電子マネー対応</td>
        </tr>
      </table>
    </div>

    <div class="address__flex-container">
      <div class="acf-map fade-up">
        <?php $mapLocation = get_field('map_location'); ?>
        <?php if ($mapLocation) : ?>
        <div class="marker" 
          data-lat="<?php echo esc_attr($mapLocation['lat']); ?>" 
          data-lng="<?php echo esc_attr($mapLocation['lng']); ?>">
            <?php echo esc_html($mapLocation['address']); ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="fade-up form-container">
        <?php echo do_shortcode('[contact-form-7 id="92ed38d" title="Contact form 1"]') ?>
      </div>
    </div>
  </section>
  <a id="scroll-target" style="scroll-padiing-top: 100rem;"></a>
</main><!-- #main -->
<?php
get_footer();