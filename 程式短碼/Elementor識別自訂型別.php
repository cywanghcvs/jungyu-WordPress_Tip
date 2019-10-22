<?php
function custom_post_archive($query) {
        if ( ! is_admin() && $query->is_main_query() ) {
        // Not a query for an admin page. 
        // 非後臺頁面
        // It's the main query for a front end page of your site. 
        // 使用在網站前台query
        if ( is_tax() && $query->is_archive() ) {
            // It's the main query for a category archive.
			$query->set( 'post_type', array('album', 'teacher','staff', 'course', 'download', 'post') ); //當新增 Post type 時，要在這裡加入
			remove_action( 'pre_get_posts', 'custom_post_archive' );
            // Let's change the query for category archives.
        }
    }
}

add_action('pre_get_posts', 'custom_post_archive');