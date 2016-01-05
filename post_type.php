<?php
if (!function_exists('wardrobe_rehab_portfolio')) {
    // Register Custom Post Type
    function wardrobe_rehab_portfolio()
    {
        $labels = array(
            'name' => _x('Проекты', 'Post Type General Name', 'wardrobe-rehab.ru'),
            'singular_name' => _x('Проект', 'Post Type Singular Name', 'wardrobe-rehab.ru'),
            'menu_name' => __('Портфолио преображения', 'wardrobe-rehab.ru'),
            'parent_item_colon' => __('Портфолио:', 'wardrobe-rehab.ru'),
            'all_items' => __('Все проекты', 'wardrobe-rehab.ru'),
            'view_item' => __('Посмотреть проект', 'wardrobe-rehab.ru'),
            'add_new_item' => __('Добавить новый проект', 'wardrobe-rehab.ru'),
            'add_new' => __('Добавить новый', 'wardrobe-rehab.ru'),
            'edit_item' => __('Редактировать проект', 'wardrobe-rehab.ru'),
            'update_item' => __('Обновить проект', 'wardrobe-rehab.ru'),
            'search_items' => __('Поиск проекта', 'wardrobe-rehab.ru'),
            'not_found' => __('Проект не найден', 'wardrobe-rehab.ru'),
            'not_found_in_trash' => __('В корзине проект не найден', 'wardrobe-rehab.ru'),
        );
        $args = array(
            'label' => __('Portfolio', 'wardrobe-rehab.ru'),
            'description' => __('Портфолио Преображение', 'wardrobe-rehab.ru'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'post-formats',),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-awards',
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',
        );
        register_post_type('portfolio', $args);
        flush_rewrite_rules();
    }
    // Hook into the 'init' action
    add_action('init', 'wardrobe_rehab_portfolio', 0);
}

if (!function_exists('wardrobe_rehab_fotosesii')) {
// Register Custom Post Type
    function wardrobe_rehab_fotosesii() {
        $labels = array(
            'name'                => _x( 'Фотосессии', 'Post Type General Name', 'wardrobe-rehab.ru' ),
            'singular_name'       => _x( 'Фотосессия', 'Post Type Singular Name', 'wardrobe-rehab.ru' ),
            'menu_name'           => __( 'Фотосессии', 'wardrobe-rehab.ru' ),
            'parent_item_colon'   => __( 'Фотосессии:', 'wardrobe-rehab.ru' ),
            'all_items'           => __( 'Все фотосессии', 'wardrobe-rehab.ru' ),
            'view_item'           => __( 'Посмотресть фотосессию', 'wardrobe-rehab.ru' ),
            'add_new_item'        => __( 'Добавить новую фотосессию', 'wardrobe-rehab.ru' ),
            'add_new'             => __( 'Добавить новую', 'wardrobe-rehab.ru' ),
            'edit_item'           => __( 'Редактировать', 'wardrobe-rehab.ru' ),
            'update_item'         => __( 'Обновить', 'wardrobe-rehab.ru' ),
            'search_items'        => __( 'Искать фотосессию', 'wardrobe-rehab.ru' ),
            'not_found'           => __( 'Не найдено', 'wardrobe-rehab.ru' ),
            'not_found_in_trash'  => __( 'Не найдено в корзине', 'wardrobe-rehab.ru' ),
        );
        $args = array(
            'label'               => __( 'fotosessii', 'wardrobe-rehab.ru' ),
            'description'         => __( 'Фотосессии', 'wardrobe-rehab.ru' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'post-formats', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-camera',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );
        register_post_type( 'fotosessii', $args );
        flush_rewrite_rules();
    }
// Hook into the 'init' action
    add_action( 'init', 'wardrobe_rehab_fotosesii', 0 );
}

if (!function_exists('wardrobe_rehab_shopping')) {
// Register Custom Post Type
    function wardrobe_rehab_shopping() {
        $labels = array(
            'name'                => _x( 'Шоппинг', 'Post Type General Name', 'wardrobe-rehab.ru' ),
            'singular_name'       => _x( 'Шоппинг проект', 'Post Type Singular Name', 'wardrobe-rehab.ru' ),
            'menu_name'           => __( 'Шоппинг проекты', 'wardrobe-rehab.ru' ),
            'parent_item_colon'   => __( 'Шоппинг проекты:', 'wardrobe-rehab.ru' ),
            'all_items'           => __( 'Все проекты', 'wardrobe-rehab.ru' ),
            'view_item'           => __( 'Посмотресть проект', 'wardrobe-rehab.ru' ),
            'add_new_item'        => __( 'Добавить новый проект', 'wardrobe-rehab.ru' ),
            'add_new'             => __( 'Добавить новый', 'wardrobe-rehab.ru' ),
            'edit_item'           => __( 'Редактировать', 'wardrobe-rehab.ru' ),
            'update_item'         => __( 'Обновить', 'wardrobe-rehab.ru' ),
            'search_items'        => __( 'Искать Шоппинг проект', 'wardrobe-rehab.ru' ),
            'not_found'           => __( 'Не найдено', 'wardrobe-rehab.ru' ),
            'not_found_in_trash'  => __( 'Не найдено в корзине', 'wardrobe-rehab.ru' ),
        );
        $args = array(
            'label'               => __( 'shopping', 'wardrobe-rehab.ru' ),
            'description'         => __( 'Шоппинг', 'wardrobe-rehab.ru' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'post-formats', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-cart',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );
        register_post_type( 'shopping', $args );
        flush_rewrite_rules();
    }
// Hook into the 'init' action
    add_action( 'init', 'wardrobe_rehab_shopping', 0 );
}

if (!function_exists('wardrobe_rehab_master_class')) {
// Register Custom Post Type
    function wardrobe_rehab_master_class() {
        $labels = array(
            'name'                => _x( 'Мастер-класс', 'Post Type General Name', 'wardrobe-rehab.ru' ),
            'singular_name'       => _x( 'Мастер-класс', 'Post Type Singular Name', 'wardrobe-rehab.ru' ),
            'menu_name'           => __( 'Мастер-класс', 'wardrobe-rehab.ru' ),
            'parent_item_colon'   => __( 'Мастер-класс:', 'wardrobe-rehab.ru' ),
            'all_items'           => __( 'Все проекты', 'wardrobe-rehab.ru' ),
            'view_item'           => __( 'Посмотресть мастер-класс', 'wardrobe-rehab.ru' ),
            'add_new_item'        => __( 'Добавить новый проект', 'wardrobe-rehab.ru' ),
            'add_new'             => __( 'Добавить новый', 'wardrobe-rehab.ru' ),
            'edit_item'           => __( 'Редактировать', 'wardrobe-rehab.ru' ),
            'update_item'         => __( 'Обновить', 'wardrobe-rehab.ru' ),
            'search_items'        => __( 'Искать Мастер-класс', 'wardrobe-rehab.ru' ),
            'not_found'           => __( 'Не найдено', 'wardrobe-rehab.ru' ),
            'not_found_in_trash'  => __( 'Не найдено в корзине', 'wardrobe-rehab.ru' ),
        );
        $args = array(
            'label'               => __( 'master_class', 'wardrobe-rehab.ru' ),
            'description'         => __( 'Мастер-класс', 'wardrobe-rehab.ru' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'post-formats', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-admin-site',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );
        register_post_type( 'master_class', $args );
        flush_rewrite_rules();
    }
// Hook into the 'init' action
    add_action( 'init', 'wardrobe_rehab_master_class', 0 );
}
?>