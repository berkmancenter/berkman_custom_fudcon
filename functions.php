<?php

function featured_shortcode($atts) {
    $html = '';
    $numbers = array(
        'one' => 1,
        'two' => 2,
        'three' => 3
    );
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
            $columns = esc_attr(get_post_meta(get_the_ID(), 'columns', true));
            if ($current_columns == 0) {
                $html .= '<div class="row">';
            }
            $html .= '<section class="' . $columns . ' column">' .
                         '<header><h1>' . get_the_title() . '</h1></header>' .
                            get_the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ) .
                     '</section>';
            $current_columns += $numbers[$columns];
            if ($current_columns == 3) {
                $html .= '</div>';
                $current_columns = 0;
            }
        }
    }
    wp_reset_postdata();

	return $html;
}

add_shortcode( 'featured', 'featured_shortcode' );
