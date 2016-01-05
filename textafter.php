<?php
// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields()
{
    add_meta_box('extra_fields', 'Дополнительный текст', 'extra_fields_box_func', 'portfolio', 'normal', 'high');
    add_meta_box('extra_fields', 'Дополнительный текст', 'extra_fields_box_func_2', 'fotosessii', 'normal', 'high');
    add_meta_box('extra_fields', 'Дополнительный текст', 'extra_fields_box_func_3', 'master_class', 'normal', 'high');
    add_meta_box('extra_fields', 'Дополнительный текст', 'extra_fields_box_func_3', 'shopping', 'normal', 'high');
}

// код блока
function extra_fields_box_func($post)
{
    ?>
    <p><label> Фамилия и Имя клиента (например: Елена Иванова )*<br />
            <input type="text" name="extra[text_after]" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'text_after', 1); ?>" />
        </label>*текст над вотографиями до и после</p>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>"/>
<?php
}

// код блока 2
function extra_fields_box_func_2($post)
{
    ?>
    <p><label> Фамилия и Имя клиента в родительном падеже (например:Фотосессия Елены Ивановой)*
            <input type="text" name="extra[text_after_1]"
                   value="<?php echo get_post_meta($post->ID, 'text_after_1', 1); ?>" style="width:90%"/>
        </label><br />*текст под фотографией на странице архива Фотосессий</p>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>"/>
<?php
}

// код блока 3
function extra_fields_box_func_3($post)
{
    ?>
    <p><label> Фамилия и Имя клиента в творительном падеже<br />(например: 'Шоппинг-сопровождение с Еленой Ивановой' или 'Мастер-класс с Еленой Ивановой')*<br />
            <input type="text" name="extra[text_after_2]" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'text_after_2', 1); ?>" />
        </label><br />*текст под фотографией на страницеархива шопинг-сопровождения или мастер-класса соответственно</p>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>"/>
<?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'true_save_box_data_ui', 0);
/*
 * Сохраняем данные произвольного поля
 */
function true_save_box_data_ui( $post_id ) {
    if (!wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__)) return false; // проверка
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    if (!current_user_can('edit_post', $post_id)) return false; // если юзер не имеет право редактировать запись

    if (!isset($_POST['extra'])) return false;

    // Все ОК! Теперь, нужно сохранить/удалить данные
    $_POST['extra'] = array_map('trim', $_POST['extra']);
    foreach ($_POST['extra'] as $key => $value) {
        if (empty($value)) {
            delete_post_meta($post_id, $key); // удаляем поле если значение пустое
            continue;
        }

        update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
    }
    return $post_id;
}

add_action('save_post', 'true_save_box_data_ui');
?>