<?php
/*
Plugin Name: Плагин портфолио для сайта Wardrobe-rehab.ru
Plugin URI: http://wardrobe-rehab.ru
Description: Плагин для создания проектов Преображения, фотосессий, шоппинг-сопровождений, мастер-классов и вывода страниц архивов (данных проектов) в определенном дизайне. При смене темы дизайн страниц архива остается тем же, за исключением шапки, подвала и окружения контента (берется из темы). Все написанные проекты в подробном описании берут дизайн темы.
Author: Konstantin Milyushenko
Version: 1.0
Author URI: garmoniagroup.ru
Copyright: 2015
Generated: 16.02.2015
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/* Disallow direct access to the plugin file */
if (basename($_SERVER['PHP_SELF']) == basename(__file__)) {
    die('Извините, но прямой доступ к файлу запрещен.');
}
if (!class_exists("wardrobe_rehab_portfolio")) {
    class wardrobe_rehab_portfolio
    {
        function __construct()
        {
            //регистрируем custom post type
            include_once plugin_dir_path(__file__) . "post_type.php";
            // Processing function for ShortCode - portfolio
            include_once plugin_dir_path(__file__) . "shortcodes.php";
            // другие функции
            include_once plugin_dir_path(__file__) . "other_functions.php";
            add_action("admin_menu", array(&$this, "wardrobe_rehab_portfolio_plugin_menu"));
            // For User - add files .js and .css
            add_action("wp_print_scripts", array(&$this, "wppg_user_script"));
            add_action("wp_print_styles", array(&$this, "wppg_user_stylesheet"));
        }
        function wardrobe_rehab_portfolio()
        {
            $this->__construct();
        }
        function wardrobe_rehab_portfolio_plugin_menu()
        {
            add_menu_page('Портфолио преображения', 'Преображение и Фотосессии', 8, basename(__file__), array(&$this, 'wardrobe_rehab_portfolio_options_page'));
// Creation of a newly created sub-menus
            if (function_exists('add_submenu_page')) {
                add_submenu_page(basename(__FILE__), 'Настройки', 'Настройки', 8, 'Настройки', array(&$this, 'submenu_page'));
            }
        }
        function wardrobe_rehab_portfolio_options_page()
        {
            echo "<h1>Портфолио Преображения, Фотосессии, Шоппинг-сопровождения и Мастер-класс.</h1><br />
            <div style='display: block;font-size: 18px;'>Короткий код для вывода галлереи проектов на любой странице :
             <ol>
             <li>Последние работы Портфолио преображения - [portfolio_post posts_per_page='5']</li>
             <li>Определенная работа Портфолио преображения - [portfolio_post post_id='1628']</li>
             <hr>
             <li>Последние работы Фотосессии - [fotosessii_post posts_per_page='6']</li>
             <li>определенная работа Фотосессии - [fotosessii_post posts_id='1670']</li>
             <hr>
             <li>Последние работы Мастер-класс - [master_class posts_per_page='6']</li>
             <li>определенная работа Мастер-класс - [master_class posts_id='1670']</li>
             <hr>
             <li>Последние работы Шоппинг-сопровождения - [shopping posts_per_page='6']</li>
             <li>определенная работа Шоппинг-сопровождения - [shopping posts_id='1670']</li>
            <p>post_per_page='X' - количество проектов на странице.</p>
            <p>post_id='X' - ID записи - на вкладке админ-панели (Все фотосессии и Все Портфолио преображения).</p>
             </ol>
             <hr>
             <div class='info'>
             <h3>Ссылки на страницы архивов:</h3>
            <p>1) " . get_bloginfo('url') . "/portfolio/ - <a href='" . get_bloginfo('url') . "/portfolio/'>Портфолио преображения<br /></a></p>
            <p>2) " . get_bloginfo('url') . "/fotosessii/ - <a href='" . get_bloginfo('url') . "/fotosessii/'>Примеры фотосессий<br /></a></p>
            <p>3) " . get_bloginfo('url') . "/shopping/ - <a href='" . get_bloginfo('url') . "/shopping/'>Шоппинг-сопровождение<br /></a></p>
            <p>4) " . get_bloginfo('url') . "/master_class/ - <a href='" . get_bloginfo('url') . "/master_class/'>Мастер-классы<br /></a></p>
             </div>
             <hr>
</div><div class='clear'></div>
           <div><p style='display: block;width: 100%;font-size: 18px;'>Внешний вид архива(галлереи) проектов:<br />
            <p style='display: block;float: left;margin: 10px;text-align:center;'>Ссылка на страницу для меню - " . get_bloginfo('url') . "/portfolio/<br />
             <a href='" . get_bloginfo('url') . "/portfolio'>Портфоолио преображения<br /> <img src='" . plugins_url('/img/portfolio_archive.png', __file__) . "' width='500' alt=''/></a></p>
            <p style='display: block;float: left;margin: 10px;text-align:center;'>Ссылка на страницу для меню - " . get_bloginfo('url') . "/fotosessii/<br />
            <a href='" . get_bloginfo('url') . "/fotosessii'>Фотосессии<br /> <img src='" . plugins_url('/img/fotosessii.png', __file__) . "' width='500' alt=''/></a></p> </p>
            <div class='clear'></div><br />
            <p style='display: block;width: 100%;font-size: 18px;'>Внешний одного проекта выведенного коротким кодом:<br />
            <p style='display: block;float: left;margin: 10px;text-align:center;'>[portfolio_post post_id='1628']<br /><br />
             <img src='" . plugins_url('/img/portfolio_1.png', __file__) . "' alt=''/></p>
            <p style='display: block;float: left;margin: 10px;text-align:center;'>[fotosessii_post posts_id='1670']<br /><br />
             <img src='" . plugins_url('/img/fotosessii_1.png', __file__) . "' alt=''/></p></p>
            <div class='clear'></div>
            <hr/>
            </div><div class='clear'></div>";
        }
        function submenu_page()
        {
            echo "<h2>Страница настроек</h2>";
            if (!class_exists('ControlPanel')) require_once(plugin_dir_path(__FILE__) . 'settings.php');
            $default_settings = array(
                'zagolovokfotoset' => 'Примеры фотосессий',
                'slogonfotoset' => 'Убедитесь в нашем профессионализме, на примере фотосессий наших работ',
                'zagolovokformfotoset' => 'Задать вопрос о фотосессиях',
                'formsfotoset' => "[contact-form-7 id='34' title='Контактная форма 1']",
                'zagolovokportfolio' => 'Тотальное преображение',
                'slogonportfolio' => 'Мы провели открытый урок на тему того, как специалисты преображают жизнь',
                'zagolovokformportfolio' => 'Задать вопрос о тотальном преображении',
                'formsportfolio' => "[contact-form-7 id='34' title='Контактная форма 1']",
                'zagolovokshopping' => 'Шоппинг-сопровождение',
                'slogonshopping' => 'Мы провели открытый урок на тему того, как специалисты преображают жизнь',
                'zagolovokformshopping' => 'Задать вопрос о шоппинг-сопровождении',
                'formsshopping' => "[contact-form-7 id='34' title='Контактная форма 1']",
                'zagolovokmasterclass' => 'Мастер-классы',
                'slogonmasterclass' => 'Мы провели открытый урок на тему того, как специалисты преображают жизнь',
                'zagolovokformmasterclass' => 'Задать вопрос о Мастер-классах',
                'formsmasterclass' => "[contact-form-7 id='34' title='Контактная форма 1']",
            );
            global $options;
            /*доп настройки*/
            if ($_POST['ss_action'] == 'save') {
                $this->options["zagolovokfotoset"] = $_POST['cp_zagolovokfotoset'];
                $this->options["slogonfotoset"] = $_POST['cp_slogonfotoset'];
                $this->options["zagolovokformfotoset"] = $_POST['cp_zagolovokformfotoset'];
                $this->options["formsfotoset"] = stripcslashes($_POST['cp_formsfotoset']);
                $this->options["zagolovokportfolio"] = $_POST['cp_zagolovokportfolio'];
                $this->options["slogonportfolio"] = $_POST['cp_slogonportfolio'];
                $this->options["zagolovokformportfolio"] = $_POST['cp_zagolovokformportfolio'];
                $this->options["formsportfolio"] = stripcslashes($_POST['cp_formsportfolio']);
                $this->options["zagolovokshopping"] = $_POST['cp_zagolovokshopping'];
                $this->options["slogonshopping"] = $_POST['cp_slogonshopping'];
                $this->options["zagolovokformshopping"] = $_POST['cp_zagolovokformshopping'];
                $this->options["formsshopping"] = stripcslashes($_POST['cp_formsshopping']);
                $this->options["zagolovokmasterclass"] = $_POST['cp_zagolovokmasterclass'];
                $this->options["slogonmasterclass"] = $_POST['cp_slogonmasterclass'];
                $this->options["zagolovokformmasterclass"] = $_POST['cp_zagolovokformmasterclass'];
                $this->options["formsmasterclass"] = stripcslashes($_POST['cp_formsmasterclass']);
                update_option('portfolio_options', $this->options);
                echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204); width: 400px; margin-left: 17px; margin-top: 17px;">
<p>Ваши изменения <strong>сохранены</strong>.</p></div>';
            } else {
                $this->options = $this->default_settings;
            }
            if (!is_array(get_option('portfolio_options')))
                add_option('portfolio_options', $this->default_settings);
            $this->options = get_option('portfolio_options');
            // Создаем форму для настроек
            echo '<form action="" method="post" class="themeform">
                <input type="hidden" id="ss_action" name="ss_action" value="save">
                <div class="cptab"><br />
 <b>Настройки внешнего вида архивных страниц</b>
 <br />
 <h3>Страница архива фотосессий</h3>
 <p><input placeholder="' . $default_settings["zagolovokfotoset"] . '" style="width:600px;" name="cp_zagolovokfotoset" id="cp_zagolovokfotoset" value="' . $this->options["zagolovokfotoset"] . '"><label> - Заголовок на странице архива фотосессий</label></p>
 <p><input placeholder="' . $default_settings["slogonfotoset"] . '" style="width:600px;" name="cp_slogonfotoset" id="cp_slogonfotoset" value="' . $this->options["slogonfotoset"] . '"><label> -Слоган на странице архива фотосессий</label></p>
 <p><input placeholder="' . $default_settings["zagolovokformfotoset"] . '" style="width:600px;" name="cp_zagolovokformfotoset" id="cp_zagolovokformfotoset" value="' . $this->options["zagolovokformfotoset"] . '">
 <label> - Заголовок формы связи на странице архива фотосессии</label></p>
 <p><input placeholder="' . $default_settings["formsfotoset"] . '" style="width:600px;" name="cp_formsfotoset" id="cp_formsfotoset" value="' . stripcslashes($this->options["formsfotoset"]) . '">
 <label> - Шорткод формы связи на странице архива фотосессий</label></p>
 <hr>
 <h3>Страница архива Портфолио преображения</h3>
 <p><input placeholder="' . $default_settings["zagolovokportfolio"] . '" style="width:600px;" name="cp_zagolovokportfolio" id="cp_zagolovokportfolio" value="' . $this->options["zagolovokportfolio"] . '">
 <label> - Заголовок на странице архива Портфолио преображения</label></p>
  <p><input placeholder="' . $default_settings["slogonportfolio"] . '" style="width:600px;" name="cp_slogonportfolio" id="cp_slogonportfolio" value="' . $this->options["slogonportfolio"] . '">
  <label> -Слоган на странице архива Портфолио преображения</label></p>
 <p><input placeholder="' . $default_settings["zagolovokformportfolio"] . '" style="width:600px;" name="cp_zagolovokformportfolio" id="cp_zagolovokformportfolio" value="' . $this->options["zagolovokformportfolio"] . '">
 <label> - Заголовок формы связи на странице архива Портфолио преображения</label></p>
 <p><input placeholder="' . $default_settings["formsportfolio"] . '" style="width:600px;" name="cp_formsportfolio" id="cp_formsportfolio" value="' . stripcslashes($this->options["formsportfolio"]) . '">
 <label> - Шорткод формы связи на странице архива Портфолио преображения</label></p>
 <hr>
 <h3>Страница архива Шоппинг</h3>
 <p><input placeholder="' . $default_settings["zagolovokshopping"] . '" style="width:600px;" name="cp_zagolovokshopping" id="cp_zagolovokshopping" value="' . $this->options["zagolovokshopping"] . '">
 <label> - Заголовок на странице архива Шоппинг</label></p>
  <p><input placeholder="' . $default_settings["slogonshopping"] . '" style="width:600px;" name="cp_slogonshopping" id="cp_slogonshopping" value="' . $this->options["slogonshopping"] . '">
  <label> -Слоган на странице архива Шоппинг</label></p>
 <p><input placeholder="' . $default_settings["zagolovokformshopping"] . '" style="width:600px;" name="cp_zagolovokformshopping" id="cp_zagolovokformshopping" value="' . $this->options["zagolovokformshopping"] . '">
 <label> - Заголовок формы связи на странице архива Шоппинг</label></p>
 <p><input placeholder="' . $default_settings["formsshopping"] . '" style="width:600px;" name="cp_formsshopping" id="cp_formsshopping" value="' . stripcslashes($this->options["formsshopping"]) . '">
 <label> - Шорткод формы связи на странице архива Шоппинг</label></p>
 <hr>
 <h3>Страница архива Мастер-классы</h3>
 <p><input placeholder="' . $default_settings["zagolovokmasterclass"] . '" style="width:600px;" name="cp_zagolovokmasterclass" id="cp_zagolovokmasterclass" value="' . $this->options["zagolovokmasterclass"] . '">
 <label> - Заголовок на странице архива Мастер-классы</label></p>
  <p><input placeholder="' . $default_settings["slogonmasterclass"] . '" style="width:600px;" name="cp_slogonmasterclass" id="cp_slogonmasterclass" value="' . $this->options["slogonmasterclass"] . '">
  <label> -Слоган на странице архива Мастер-классы</label></p>
 <p><input placeholder="' . $default_settings["zagolovokformmasterclass"] . '" style="width:600px;" name="cp_zagolovokformmasterclass" id="cp_zagolovokformmasterclass" value="' . $this->options["zagolovokformmasterclass"] . '">
 <label> - Заголовок формы связи на странице архива Мастер-классы</label></p>
 <p><input placeholder="' . $default_settings["formsmasterclass"] . '" style="width:600px;" name="cp_formsmasterclass" id="cp_formsmasterclass" value="' . stripcslashes($this->options["formsmasterclass"]) . '">
 <label> - Шорткод формы связи на странице архива Мастер-классы</label></p>
 </div><br />
 <input type="submit" value="Сохранить" name="cp_save" class="dochanges" />
 </form>';
        }
        function wppg_user_script()
        {
            wp_register_script('wppg_portfolio_js_js', plugins_url('/user_js/portfolio_js.js', __file__));
            wp_enqueue_script(array("wppg_portfolio_js_js"));
            wp_register_script('wppg_picture_js_js', plugins_url('/user_js/picture_js.js', __file__));
            wp_enqueue_script(array("wppg_picture_js_js"));
        }
        function wppg_user_stylesheet()
        {
            wp_register_style('wppg_portfolio-style_css', plugins_url('/user_css/portfolio-style.css', __file__));
            wp_enqueue_style(array("wppg_portfolio-style_css"));
        }
        function install()
        {
            // do not generate any output here
        }
        function wardrobe_rehab_portfolio_deactivate()
        {
            // do not generate any output here
        }
    } //End Class wardrobe_rehab_portfolio
} // end if
if (!isset($wp_wardrobe_rehab_portfolio)) {
    $wp_wardrobe_rehab_portfolio = new wardrobe_rehab_portfolio();
}
if (isset($wp_wardrobe_rehab_portfolio)) {
    //Actions
    register_activation_hook(__file__, array(&$wp_wardrobe_rehab_portfolio, 'install'));
    register_deactivation_hook(__file__, array(&$wp_wardrobe_rehab_portfolio, 'wardrobe_rehab_portfolio_deactivate'));
}
?>