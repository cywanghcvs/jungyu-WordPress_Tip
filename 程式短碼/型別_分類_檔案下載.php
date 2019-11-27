<?php
function create_post_type_getfile()
{
    $labels = array(
        'name'                => __('檔案下載'),
        'singular_name'       => __('檔案下載'),
        'menu_name'           => __('檔案下載'),
        'parent_item_colon'   => __('上層檔案'),
        'all_items'           => __('全部檔案'),
        'view_item'           => __('檢視檔案'),
        'add_new_item'        => __('新增檔案'),
        'add_new'             => __('新增檔案'),
        'edit_item'           => __('編輯檔案'),
        'update_item'         => __('更新檔案'),
        'search_items'        => __('搜尋檔案'),
        'not_found'           => __('查無檔案'),
        'not_found_in_trash'  => __('無檔案在回收筒內')
    );
    $args = array(
        'description'         => __('getfile content', '檔案內容'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes'), //
        'taxonomies'          => array('getfiles', 'post_tag'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'           => true,
        'show_in_menu' => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'      => 5,
        'menu_icon'       => 'dashicons-download',
        'can_export'         => true,
        'has_archive'        => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'rewrite' => array('slug' => 'getfile')
    );
    register_post_type('getfile', $args);
}
add_action('init', 'create_post_type_getfile', 0);

function create_getfile_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('檔案分類'),
        'singular_name' => __('檔案分類'),
        'search_items' => __('搜尋檔案分類'),
        'all_items' => __('全部分類'),
        'parent_item' => __('上層'),
        'parent_item_colon' => __('上層分類:'),
        'edit_item' => __('編輯檔案分類'),
        'update_item' => __('更新檔案分類'),
        'add_new_item' => __('新增檔案分類'),
        'new_item_name' => __('新檔案分類名稱'),
        'menu_name' => __('檔案分類'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_nav_menus' => true,
        'rewrite'           => array('slug' => 'getfiles', 'with_front' => true),
    );
    $postTypes = array('getfile');
    register_taxonomy('getfiles', $postTypes, $args);
}
add_action('init', 'create_getfile_taxonomies', 0);
