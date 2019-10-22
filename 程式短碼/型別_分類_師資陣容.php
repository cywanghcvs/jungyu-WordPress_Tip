<?php
function create_post_type_teacher()
{
    $labels = array(
        'name'                => __('師資陣容'),
        'singular_name'       => __('教師資料'),
        'menu_name'           => __('師資陣容'),
        'parent_item_colon'   => __('上層師資'),
        'all_items'           => __('全部師資'),
        'view_item'           => __('檢視師資'),
        'add_new_item'        => __('新增教師'),
        'add_new'             => __('新增教師'),
        'edit_item'           => __('編輯教師'),
        'update_item'         => __('更新教師'),
        'search_items'        => __('搜尋教師'),
        'not_found'           => __('查無教師'),
        'not_found_in_trash'  => __('無教師在回收筒內')
    );
    $args = array(
        'description'         => __('Teacher content', '師資內容'),
        'labels'              => $labels,
        'supports'            => array('title', 'custom-fields'), //'editor', 'thumbnail', 'revisions', 'page-attributes'
        'taxonomies'          => array('teachers', 'post_tag'),
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
        'rewrite' => array('slug' => 'teacher')
    );
    register_post_type('teacher', $args);
}
add_action('init', 'create_post_type_teacher', 0);

function create_teacher_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('師資分類'),
        'singular_name' => __('師資分類'),
        'search_items' => __('搜尋師資分類'),
        'all_items' => __('全部分類'),
        'parent_item' => __('上層'),
        'parent_item_colon' => __('上層分類:'),
        'edit_item' => __('編輯師資分類'),
        'update_item' => __('更新師資分類'),
        'add_new_item' => __('新增師資分類'),
        'new_item_name' => __('新師資分類名稱'),
        'menu_name' => __('師資分類'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_nav_menus' => true,
        'rewrite'           => array('slug' => 'teachers', 'with_front' => true),
    );
    $postTypes = array('teacher');
    register_taxonomy('teachers', $postTypes, $args);
}
add_action('init', 'create_teacher_taxonomies', 0);
