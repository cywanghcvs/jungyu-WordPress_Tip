<?php
//簡碼語法範例：[count_term term_id="30"]
function count_term($atts)
{
    global $wpdb;
    $atts = shortcode_atts(
        array(
            'term_id' => '25'
        ),
        $atts,
        'count_term'
    );
    $query = "SELECT count(object_id) FROM wp_term_relationships where term_taxonomy_id = '" . $atts['term_id'] . "'";
    $count = $wpdb->get_var($query);
    return $count;
}
add_shortcode('count_term', 'count_term');
