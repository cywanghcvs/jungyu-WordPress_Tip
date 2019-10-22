<?php
function create_post_type_course()
{
    $labels = array(
        'name'                => __('課程資訊'),
        'singular_name'       => __('課程資訊'),
        'menu_name'           => __('課程資訊'),
        'parent_item_colon'   => __('上層課程'),
        'all_items'           => __('全部課程'),
        'view_item'           => __('檢視課程'),
        'add_new_item'        => __('新增課程'),
        'add_new'             => __('新增課程'),
        'edit_item'           => __('編輯課程'),
        'update_item'         => __('更新課程'),
        'search_items'        => __('搜尋課程'),
        'not_found'           => __('查無課程'),
        'not_found_in_trash'  => __('無課程在回收筒內')
    );
    $args = array(
        'description'         => __('Course content', '課程內容'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes'), //
        'taxonomies'          => array('courses', 'post_tag'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'           => true,
        'show_in_menu' => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'      => 4,
        'menu_icon'       => 'dashicons-calendar',
        'can_export'         => true,
        'has_archive'        => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'rewrite' => array('slug' => 'course')
    );
    register_post_type('course', $args);
}
add_action('init', 'create_post_type_course', 0);

function create_course_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('課程分類'),
        'singular_name' => __('課程分類'),
        'search_items' => __('搜尋課程分類'),
        'all_items' => __('全部分類'),
        'parent_item' => __('上層'),
        'parent_item_colon' => __('上層分類:'),
        'edit_item' => __('編輯課程分類'),
        'update_item' => __('更新課程分類'),
        'add_new_item' => __('新增課程分類'),
        'new_item_name' => __('新課程分類名稱'),
        'menu_name' => __('課程分類'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_nav_menus' => true,
        'rewrite'           => array('slug' => 'courses', 'with_front' => true),
    );
    $postTypes = array('course');
    register_taxonomy('courses', $postTypes, $args);
}
add_action('init', 'create_course_taxonomies', 0);
