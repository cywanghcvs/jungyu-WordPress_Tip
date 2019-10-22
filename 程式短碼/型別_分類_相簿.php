<?php
function create_post_type_album()
{
  $labels = array(
    'name'                => __('相簿'),
    'singular_name'       => __('相簿'),
    'menu_name'           => __('相簿'),
    'parent_item_colon'   => __('上層相簿'),
    'all_items'           => __('全部相簿'),
    'view_item'           => __('檢視相簿'),
    'add_new_item'        => __('新增相簿'),
    'add_new'             => __('新增相簿'),
    'edit_item'           => __('編輯相簿'),
    'update_item'         => __('更新相簿'),
    'search_items'        => __('搜尋相簿'),
    'not_found'           => __('查無相簿'),
    'not_found_in_trash'  => __('無相簿在回收筒內')
  );
  $args = array(
    'description'         => __('album content', '相簿'),
    'labels'              => $labels,
    'supports'            => array('title', 'custom-fields', 'thumbnail'), // 'editor', 'thumbnail', 'revisions', 'page-attributes'
    'taxonomies'          => array('albums', 'post_tag'),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'           => true,
    'show_in_menu' => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'      => 6,
    'menu_icon'       => 'dashicons-calendar',
    'can_export'         => true,
    //'has_archive'        => 'albums',
    'has_archive'        => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'capability_type'    => 'post',
    'rewrite' => array('slug' => 'album', 'with_front' => true)
  );
  register_post_type('album', $args);
}
add_action('init', 'create_post_type_album', 0);

function create_album_taxonomies()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __('相簿分類'),
    'singular_name' => __('相簿分類'),
    'search_items' => __('搜尋相簿分類'),
    'all_items' => __('全部分類'),
    'parent_item' => __('上層'),
    'parent_item_colon' => __('上層分類:'),
    'edit_item' => __('編輯相簿分類'),
    'update_item' => __('更新相簿分類'),
    'new_item_name' => __('新相簿分類名稱'),
    'menu_name' => __('相簿分類'),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'public'       => true,
    'show_in_nav_menus' => true,
    'rewrite'           => array('slug' => 'albums', 'with_front' => true),
  );
  $postTypes = array('album');
  register_taxonomy('albums', $postTypes, $args);
}
add_action('init', 'create_album_taxonomies', 0);
