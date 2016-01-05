<?php
add_image_size( 'fotoset', 320, 250 );
add_image_size( 'portfolio', 250, 300 );
 /* Вывести ID страницы/записи в таблицах в админке */
    add_filter ('manage_posts_columns', 'posts_columns_id', 5);
    add_action ('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
    function posts_columns_id ($defaults)
    {
        $defaults['wps_post_id'] = __ ('ID');
        return $defaults;
    }
    function posts_custom_id_columns ($column_name, $id)
    {
        if ($column_name === 'wps_post_id') {
            echo $id;
        }
    }
/* placeholder заголовка проекта */
function default_product_title($title)
{
	$screen = get_current_screen();
	if ($screen->post_type == 'portfolio') {
		return 'Введите название проекта';
	} else {
		return 'Введите заголовок';
	}
}
add_filter('enter_title_here', 'default_product_title');
// подключаем шаблон вывода портфолио
add_filter('template_include', 'include_template_function', 99);
function include_template_function($template_path)
{
	if (get_post_type() == 'portfolio') {
		if (is_archive()) {
			$template_path = plugin_dir_path(__file__) . '/archive-portfolio.php';
		}
	} elseif (get_post_type() == 'fotosessii') {
		if (is_archive()) {
			$template_path = plugin_dir_path(__file__) . '/archive-fotosessii.php';
		}
	} elseif (get_post_type() == 'master_class') {
		if (is_archive()) {
			$template_path = plugin_dir_path(__file__) . '/archive-master_class.php';
		}
	} elseif (get_post_type() == 'shopping') {
		if (is_archive()) {
			$template_path = plugin_dir_path(__file__) . '/archive-shopping.php';
		}
	}
	return $template_path;
}
include_once "upload_images.php";
include_once "textafter.php";
add_action('save_post', 'wpds_check_thumbnail');
add_action('admin_notices', 'wpds_thumbnail_error');
function wpds_check_thumbnail($post_id) {
	// меняем на любой произвольный тип записи
	if((get_post_type($post_id) != 'fotosessii')&&(get_post_type($post_id) != 'master_class')&&(get_post_type($post_id) != 'shopping'))
		return;
	if( !has_post_thumbnail( $post_id ) ) {
		// устанавливаем блокировку для вывода ее пользователям в виде административного сообщения
		set_transient( "has_post_thumbnail", "no" );
		// делаем анхук функции, чтобы та не впала в бесконечный цикл
		remove_action('save_post', 'wpds_check_thumbnail');
		// обновляем запись, переводим ее в черновики
		wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
		add_action('save_post', 'wpds_check_thumbnail');
	} else {
		delete_transient( "has_post_thumbnail" );
	}
}
function wpds_thumbnail_error()
{
	// проверяем, установлена ли блокировка, и выводим сообщение об ошибке
	if ( get_transient( "has_post_thumbnail" ) == "no" ) {
		echo "<div id='message' class='error' style='font-size: 20px; font-weight: bold;padding: 10px 0px;color:#ff0000;'>
Вы должны задать миниатюру записи. Проект, но не может быть опубликован без миниатюры.</div>";
		delete_transient( "has_post_thumbnail" );
	}
}
//Постраничная навигация
function pager()
{
	global $wp_query, $wp_rewrite;
	$pages = '';
	$max = $wp_query->max_num_pages;
	if (! $current = get_query_var ('paged'))
		$current = 1;
	$a['base'] = str_replace (999999999, '%#%', get_pagenum_link (999999999));
	$a['total'] = $max;
	$a['current'] = $current;
	$total = 1; //1 - выводить текст "Страница N из N", 0 - не выводить
	$a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
	$a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
	$a['prev_text'] = '&laquo;'; //текст ссылки "Предыдущая страница"
	$a['next_text'] = '&raquo;'; //текст ссылки "Следующая страница"
	if ($max > 1)
		echo '<div class="clear"></div><div class="navigation">';
	if ($total == 1 && $max > 1)
		$pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>' . "\r\n";
	echo $pages . paginate_links ($a);
	if ($max > 1)
		echo '</div>';
}
?>