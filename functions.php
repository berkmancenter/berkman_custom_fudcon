<?php

function featured_shortcode($atts) {
    $html = '';
    $numbers = array('one', 'two', 'three');
    $current_columns = 0;

    $args = array(
        'post_type' => 'any',
        'post_status' => 'publish',
        'meta_key' => 'featured',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    $my_query = new WP_Query($args);

    if ( $my_query->have_posts() ) { 
        while ( $my_query->have_posts() ) { 
            $my_query->the_post();
            global $post;
            global $more;
            $more = 0;
            $columns = intval(esc_attr(get_post_meta(get_the_ID(), 'columns', true)));
            if ($current_columns == 0) {
                $html .= '<div class="row">';
            }
            elseif ($current_columns > 0 && $current_columns + $columns > 3) {
                $html .= '</div>';
                $html .= '<div class="row">';
            }
            $html .= '<section class="' . $numbers[$columns - 1] . ' column">' .
                         '<header><h1><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h1></header>' .
                            do_shortcode(get_the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ) ) .
                     '</section>';
            $current_columns += $columns;
            if ($current_columns > 2) {
                $html .= '</div>';
                $current_columns = 0;
            }
        }
    }
    wp_reset_postdata();

    return $html;
}
function recent_shortcode($atts) {
    $html = '';
    $args = array(
    'numberposts'     => 5,
    'offset'          => 0,
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_type'       => 'post',
    'post_status'     => 'publish' );
    $my_query = new WP_Query($args);

    if ( $my_query->have_posts() ) { 
        ob_start();
        while ( $my_query->have_posts() ) { 
            $my_query->the_post();
            global $post;
            get_template_part( 'content', get_post_format() ); 
        }
        $html = ob_get_contents();
        ob_end_clean();
    }
    return $html;
}
function twitter_shortcode( $atts ) {
        return "<script src='http://widgets.twimg.com/j/2/widget.js'></script> 
              <script type='text/javascript' language='javascript'> 
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: 'berkmancenter',
  interval: 6000,
  title: 'Berkman Center',
  subject: 'berkmancenter',
  width: 188,
  height: 200,
  theme: {
    shell: {
      background: '#5FA1D0',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#444444',
      links: '#1985b5'
    }
  },
  features: {
    scrollbar: false,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    behavior: 'default'
  }
}).render().start();
</script>";
}
function fudcon_iframe_shortcode( $atts ){
    extract( shortcode_atts( array(
        'width' => '835',
        'height' => '920',
        'src' => ''
        ), $atts ) 
    );
    $output = '<iframe src=" ' . esc_attr($src) . '" allowfullscreen="" width="'. esc_attr($width) . '" frameborder="0" height="' . esc_attr($height) . '" ></iframe>';
    return $output;
}
add_shortcode( 'twitter', 'twitter_shortcode' );
add_shortcode( 'featured', 'featured_shortcode' );
add_shortcode( 'recent_posts', 'recent_shortcode' );
add_shortcode( 'iframe', 'fudcon_iframe_shortcode' );
