<?php

function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}

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
            $html .= '<section class="' . $numbers[$columns - 1] . ' column">';
            if (!get_post_meta(get_the_ID(), 'hide_title', true)) {
                         $html .= '<header><h1><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h1></header>';
            }
            $html .= do_shortcode(get_the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ) ) . '</section>';
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
    extract( shortcode_atts( array( 'number' => '4' ), $atts ) );
    $html = '';
    $args = array(
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_type'       => 'post',
    'post_status'     => 'publish',
    'posts_per_page'  => $number );
    $my_query = new WP_Query($args);

    if ( $my_query->have_posts() ) { 
        ob_start();
        while ( $my_query->have_posts() ) { 
            $my_query->the_post();
            global $post;
            get_template_part( 'content', 'post-front' ); 
        }
        $html = ob_get_contents();
        ob_end_clean();
    }
    $html .= '<div class="read-more">Read more on the <a href="' . get_home_url(null, '/blog') .'">Blog &rarr;</a></div>';
    return $html;
}
    
function twitter_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'width' => '835',
        'height' => '50',
        'title' => 'Truthiness in Digital Media',
        'subject' => '#truthicon',
        'search' => '#truthicon',
        'interval' => '6000'
        ), $atts ) 
    );
        return "<script src='http://widgets.twimg.com/j/2/widget.js'></script> 
              <script type='text/javascript' language='javascript'> 
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '" . esc_js($search) . "',
  interval: " . esc_js($interval) . ",
  title: '" . esc_js($title) . "',
  subject: '" . esc_js($subject) . "',
  width: " . esc_js($width) . ",
  height: " . esc_js($height) . ",
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
function storify_shortcode( $atts ){
    extract( shortcode_atts( array(
        'user' => 'rebekahredux',
        'story' => 'truthicon-tomorrow'
    ), $atts ));
    return '<script src="http://storify.com/' . esc_attr($user) . '/' . esc_attr($story) . '.js"></script><noscript>[<a href="//storify.com/' . esc_attr($user) . '/' . esc_attr($story) .'" target="_blank">View the story on Storify</a>]</noscript>';
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
function gilad_zoomit_shortcode( $atts ) {
    return '<script src="http://zoom.it/GQnt.js?width=auto&height=400px"></script>';
}
register_sidebar(array(
    'name' => 'Top Bar',
    'id' => 'top-sidebar',
    'description' => 'The bar above the nav and below the header'
));
add_shortcode( 'twitter', 'twitter_shortcode' );
add_shortcode( 'storify', 'storify_shortcode' );
add_shortcode( 'gilad_zoomit', 'gilad_zoomit_shortcode' );
add_shortcode( 'featured', 'featured_shortcode' );
add_shortcode( 'recent_posts', 'recent_shortcode' );
add_shortcode( 'iframe', 'fudcon_iframe_shortcode' );
