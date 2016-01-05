<?php
// функция загрузчика изображений
function true_image_uploader_field( $name, $value = '', $w = 250, $h = 300) {
    $default = plugins_url('/img/no_image.png', __file__);
    if( $value ) {
        $image_attributes = wp_get_attachment_image_src( $value, array($w, $h) );
        $src = $image_attributes[0];
    } else {
        $src = $default;
    }
    echo '
	<div class="left photo">
    <div class="title">Фотография ДО</div>
		<img data-src="' . $default . '" src="' . $src . '" width="' . $w . 'px" height="' . $h . 'px" />
		<div>
			<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
			<button type="submit" class="upload_image_button button">Загрузить</button>
			<button type="submit" class="remove_image_button button">&times;</button>
		</div>
	</div>
	';
}
function true_image_uploader_field_2( $name_2, $value_2 = '', $w_2 = 250, $h_2 = 300) {
    $default_2 = plugins_url('/img/no_image.png', __file__);
    if( $value_2 ) {
        $image_attributes_2 = wp_get_attachment_image_src( $value_2, array($w_2, $h_2) );
        $src_2 = $image_attributes_2[0];
    } else {
        $src_2 = $default_2;
    }
    echo '
	<div class="left photo">
    <div class="title">Фотография ПОСЛЕ (1)</div>
		<img data-src="' . $default_2 . '" src="' . $src_2 . '" width="' . $w_2 . 'px" height="' . $h_2 . 'px" />
		<div>
			<input type="hidden" name="' . $name_2 . '" id="' . $name_2 . '" value="' . $value_2 . '" />
			<button type="submit" class="upload_image_button button">Загрузить</button>
			<button type="submit" class="remove_image_button button">&times;</button>
		</div>
	</div>
	';
}

function true_image_uploader_field_3( $name_3, $value_3 = '', $w_3 = 250, $h_3 = 300) {
    $default_3 = plugins_url('/img/no_image.png', __file__);
    if( $value_3 ) {
        $image_attributes_3 = wp_get_attachment_image_src( $value_3, array($w_3, $h_3) );
        $src_3 = $image_attributes_3[0];
    } else {
        $src_3 = $default_3;
    }
    echo '
	<div class="left photo">
    <div class="title">Фотография ПОСЛЕ (2)</div>
		<img data-src="' . $default_3 . '" src="' . $src_3 . '" width="' . $w_3 . 'px" height="' . $h_3 . 'px" />
		<div>
			<input type="hidden" name="' . $name_3 . '" id="' . $name_3 . '" value="' . $value_3 . '" />
			<button type="submit" class="upload_image_button button">Загрузить</button>
			<button type="submit" class="remove_image_button button">&times;</button>
		</div>
	</div>
	';
}
function true_image_uploader_field_4( $name_4, $value_4 = '', $w_4 = 250, $h_4 = 300) {
    $default_4 = plugins_url('/img/no_image.png', __file__);
    if( $value_4 ) {
        $image_attributes_4 = wp_get_attachment_image_src( $value_4, array($w_4, $h_4) );
        $src_4 = $image_attributes_4[0];
    } else {
        $src_4 = $default_4;
    }
    echo '
	<div class="left photo">
    <div class="title">Фотография ПОСЛЕ (3)</div>
		<img data-src="' . $default_4 . '" src="' . $src_4 . '" width="' . $w_4 . 'px" height="' . $h_4 . 'px" />
		<div>
			<input type="hidden" name="' . $name_4 . '" id="' . $name_4 . '" value="' . $value_4 . '" />
			<button type="submit" class="upload_image_button button">Загрузить</button>
			<button type="submit" class="remove_image_button button">&times;</button>
		</div>
	</div><div class="clear clearfix"></div>
	';
}
//метабокс загрузки изображений
/*
 * Добавляем метабокс
 */
function true_meta_boxes_u() {
    add_meta_box('truediv', 'Фотографии ДО и ПОСЛЕ', 'true_print_box_u', 'Portfolio', 'normal', 'high');
}

add_action( 'admin_menu', 'true_meta_boxes_u' );

/*
 * Заполняем метабокс
 */
function true_print_box_u($post) {
    /*	if( function_exists( 'true_image_uploader_field' ) ) {
            true_image_uploader_field( 'uploader_custom', get_post_meta($post->ID, 'uploader_custom',true) );
        }*/
    if( function_exists( 'true_image_uploader_field' ) ) {
        true_image_uploader_field( 'uploader_before', get_post_meta($post->ID, 'uploader_before',true) );
    }
    if( function_exists( 'true_image_uploader_field_2' ) ) {
        true_image_uploader_field_2( 'uploader_after_0', get_post_meta($post->ID, 'uploader_after_0',true) );
    }
    if( function_exists( 'true_image_uploader_field_3' ) ) {
        true_image_uploader_field_3( 'uploader_after_1', get_post_meta($post->ID, 'uploader_after_1',true) );
    }
    if( function_exists( 'true_image_uploader_field_4' ) ) {
        true_image_uploader_field_4( 'uploader_after_2', get_post_meta($post->ID, 'uploader_after_2',true) );
    }

}

function true_save_box_data_u( $post_id ) {
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;
    //update_post_meta( $post_id, 'uploader_custom', $_POST['uploader_custom']);
    update_post_meta( $post_id, 'uploader_before', $_POST['uploader_before']);
    update_post_meta( $post_id, 'uploader_after_0', $_POST['uploader_after_0']);
    update_post_meta( $post_id, 'uploader_after_1', $_POST['uploader_after_1']);
    update_post_meta( $post_id, 'uploader_after_2', $_POST['uploader_after_2']);

    return $post_id;
}

add_action('save_post', 'true_save_box_data_u');
?>