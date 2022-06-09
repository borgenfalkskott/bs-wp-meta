<?php
  add_action('wp_head', function(){
    global $wp;
    $bs_wp_meta_title = esc_attr( wp_title('-', false, 'right') . get_bloginfo('name') );
    $bs_wp_meta_desc = esc_attr( get_bloginfo('description') );
    $bs_wp_meta_author = esc_attr( get_bloginfo('name') );
    $bs_wp_meta_img = esc_url( get_template_directory_uri() . '/img/og.jpg' );
    $bs_wp_meta_url = esc_url( home_url($wp->request) );
    $bs_wp_meta_locale = esc_attr( get_locale() );

    if( is_front_page() ){
      $bs_wp_meta_title = esc_attr( get_bloginfo('name') . ' - ' . get_bloginfo('description') );
    } else if( is_page() ){
      $bs_wp_meta_desc = esc_attr( get_the_excerpt() );
    }

    // og:image
    if( has_post_thumbnail() ){
      $bs_wp_meta_img = esc_url( get_the_post_thumbnail_url() );
    }

    // woo pages
    if( class_exists('woocommerce') ){
      // product archive shop page
      if( is_shop() ){
        // og:image for product archive shop page
        if( has_post_thumbnail( get_option('woocommerce_shop_page_id') ) ){
          $bs_wp_meta_img = esc_url( get_the_post_thumbnail_url( get_option('woocommerce_shop_page_id') ) );
        }

      // product page
      } else if( is_product() ){
        // single product page meta
        $bs_wp_meta_desc = esc_attr( get_the_excerpt() );
      }
    }

    echo '<title>' . $bs_wp_meta_title . '</title>';
    echo '<meta name="description" content="' . $bs_wp_meta_desc . '">';
    echo '<meta name="author" content="' . $bs_wp_meta_author . '">';
    
    echo '<meta property="og:title" content="' . $bs_wp_meta_title . '">';
    echo '<meta property="og:description" content="' . $bs_wp_meta_desc . '">';
    echo '<meta property="og:image" content="' . $bs_wp_meta_img . '">';

    echo '<meta property="og:locale" content="' . $bs_wp_meta_locale . '">';
    echo '<meta property="og:type" content="website">';

    echo '<meta property="og:url" content="' . $bs_wp_meta_url . '">';
    echo '<link rel="canonical" href="' . $bs_wp_meta_url . '">';
  });
?>