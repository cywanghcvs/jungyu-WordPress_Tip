<?php
function custom_post_archive($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if (is_tax() && $query->is_archive()) {
            //當新增 Post type 時，要在這裡加入
            $query->set('post_type', array('album', 'teacher', 'staff', 'course', 'getfile', 'post'));
            remove_action('pre_get_posts', 'custom_post_archive');
        }
    }
}

add_action('pre_get_posts', 'custom_post_archive');
