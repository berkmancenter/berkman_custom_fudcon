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
            $html .= '<section class="' . $numbers[$columns - 1] . ' column">' .
                         '<header><h1>' . get_the_title() . '</h1></header>' .
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
add_shortcode( 'featured', 'featured_shortcode' );
add_shortcode( 'recent_posts', 'recent_shortcode' );
