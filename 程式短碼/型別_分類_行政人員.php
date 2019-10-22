<?php
function create_post_type_staff()
{
    $labels = array(
        'name'                => __('行政人員'),
        'singular_name'       => __('行政人員'),
        'menu_name'           => __('行政人員'),
        'parent_item_colon'   => __('上層行政人員'),
        'all_items'           => __('全部行政人員'),
        'view_item'           => __('檢視行政人員'),
        'add_new_item'        => __('新增行政人員'),
        'add_new'             => __('新增行政人員'),
        'edit_item'           => __('編輯行政人員'),
        'update_item'         => __('更新行政人員'),
        'search_items'        => __('搜尋行政人員'),
        'not_found'           => __('查無行政人員'),
        'not_found_in_trash'  => __('無行政人員在回收筒內')
    );
    $args = array(
        'description'         => __('staff content', '行政人員'),
        'labels'              => $labels,
        'supports'            => array('title', 'custom-fields'), // 'editor', 'thumbnail', 'revisions', 'page-attributes'
        'taxonomies'          => array('staffs', 'post_tag'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'           => true,
        'show_in_menu' => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'      => 5,
        'menu_icon'       => 'dashicons-calendar',
        'can_export'         => true,
        'has_archive'        => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'rewrite' => array('slug' => 'staff')
    );
    register_post_type('staff', $args);
}
add_action('init', 'create_post_type_staff', 0);

function create_staff_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('行政人員'),
        'singular_name' => __('行政人員'),
        'search_items' => __('搜尋行政人員'),
        'all_items' => __('全部分類'),
        'parent_item' => __('上層'),
        'parent_item_colon' => __('上層分類:'),
        'edit_item' => __('編輯行政人員'),
        'update_item' => __('更新行政人員類'),
        'new_item_name' => __('新行政人員分類名稱'),
        'menu_name' => __('行政人員'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_nav_menus' => true,
        'rewrite'           => array('slug' => 'staffs', 'with_front' => true),
    );
    $postTypes = array('staff');
    register_taxonomy('staffs', $postTypes, $args);
}
add_action('init', 'create_staff_taxonomies', 0);
