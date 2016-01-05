<?php
// Shortcode выборки из портфолио
// Add Shortcode [portfolio_post posts_per_page="1"]
function portfolio_custom_shortcode($atts)
{
    ob_start();
?>
    <?php
    // Attributes
    extract(shortcode_atts(array(
        'post_type' => 'portfolio',
        'posts_per_page' => '10',
        'post_id' => '1653',
        ), $atts));
    // Code
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    // WP_Query arguments
    $args = array(
        'post_type' => 'portfolio',
        'p' => $atts['post_id'],
        'post_status' => 'publish',
        'posts_per_page' => $atts['posts_per_page'],
        'paged' => $paged,
        );
    // The Query
    $portfolio = new WP_Query($args);
    global $post;
?>
    <div id="portfolio-content">
        <?php
    // Posts are found
    if ($portfolio->have_posts()) {
        while ($portfolio->have_posts()) { //:
            $portfolio->the_post();
?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a class="portfolio-block" href="<?php the_permalink(); ?>">
                        <div class="portfolio-title aligncenter">
                            <h2 class="portfolios"><?php echo get_post_meta($post->ID, 'text_after',
            1); ?></h2>
                        </div>
                        <div class="archive-thumb aligncenter">
                            <div class="before">
                                <?php $img_2 = get_post_meta($post->ID,
            'uploader_before', 1); ?>
                                <img src="<?php echo wp_get_attachment_url($img_2); ?>" alt=""/>
                                <div class="caption_before">До</div></div>
                            <div class="after">
                                <?php
            for ($i = 0; $i <= 2; $i++) {
                $name_meta = "uploader_after_" . $i;
                $imgs = get_post_meta($post->ID, $name_meta, 1);
                echo '<img src="' . wp_get_attachment_url($imgs) . '" alt=""/>';
            }
?>
                                <div class="caption_after">После</div></div>
                        </div>
                    </a>
                </div>
            <?php
        }
    }
    /*Restore original Post Data*/
    wp_reset_postdata(); ?>
        <div class='clear'></div>
    </div>
    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

add_shortcode('portfolio_post', 'portfolio_custom_shortcode');

// Shortcode выборки из Фотосессии
// Add Shortcode [fotosessii_post posts_per_page="1"]
function fotosessii_custom_shortcode($atts)
{
    ob_start();
?>
    <?php
    // Attributes
    extract(shortcode_atts(array(
        'post_type' => 'fotosessii',
        'post_id' => '1653',
        'posts_per_page' => '10',
        ), $atts));
    // Code
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    // WP_Query arguments
    $args = array(
        'post_type' => 'fotosessii',
        'p' => $atts['post_id'],
        'post_status' => 'publish',
        'posts_per_page' => $atts['posts_per_page'],
        'paged' => $paged,
        );
    // The Query
    $fotosessii = new WP_Query($args);
    global $post;
?>
    <div class="reset"></div>
    <div id="fotosessii-content" >
        <?php
    // Posts are found
    if ($fotosessii->have_posts()) {
        while ($fotosessii->have_posts()) { //:
            $fotosessii->the_post();
?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a class="fotosessii-block" href="<?php the_permalink(); ?>">
                        <div class="fotosessii-archive-thumb aligncenter">
                            <div class="before">
                                <?php the_post_thumbnail('fotoset'); ?>
                                <div class="fotocaption">
                                    <?php echo get_post_meta($post->ID, 'text_after_1', 1); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
        }
    }
    /*Restore original Post Data*/
    wp_reset_postdata(); ?>
        <div class='clear'></div>
    </div>
    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

add_shortcode('fotosessii_post', 'fotosessii_custom_shortcode');

// Shortcode выборки из Шоппинг-сопровождения
// Add Shortcode [fotosessii_post posts_per_page="1"]
function shopping_shortcode($atts)
{
    ob_start();
    ?>
    <?php
    // Attributes
    extract(shortcode_atts(array(
        'post_type' => 'shopping',
        'post_id' => '1653',
        'posts_per_page' => '10',
    ), $atts));
    // Code
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    // WP_Query arguments
    $args = array(
        'post_type' => 'shopping',
        'p' => $atts['post_id'],
        'post_status' => 'publish',
        'posts_per_page' => $atts['posts_per_page'],
        'paged' => $paged,
    );
    // The Query
    $shopping = new WP_Query($args);
    global $post;
    ?>
    <div class="reset"></div>
    <div id="fotosessii-content" >
        <?php
        // Posts are found
        if ($shopping->have_posts()) {
            while ($shopping->have_posts()) { //:
                $shopping->the_post();
                ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a class="fotosessii-block" href="<?php the_permalink(); ?>">
                        <div class="fotosessii-archive-thumb aligncenter">
                            <div class="before">
                                <?php the_post_thumbnail('fotoset'); ?>
                                <div class="fotocaption">
                                    <?php echo get_post_meta($post->ID, 'text_after_2', 1); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
        }
        /*Restore original Post Data*/
        wp_reset_postdata(); ?>
        <div class='clear'></div>
    </div>
    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

add_shortcode('shopping', 'shopping_shortcode');

// Shortcode выборки из Мастер-класс
// Add Shortcode [master_class posts_per_page="1"]
function master_class_shortcode($atts)
{
    ob_start();
    ?>
    <?php
    // Attributes
    extract(shortcode_atts(array(
        'post_type' => 'master_class',
        'post_id' => '1653',
        'posts_per_page' => '10',
    ), $atts));
    // Code
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    // WP_Query arguments
    $args = array(
        'post_type' => 'master_class',
        'p' => $atts['post_id'],
        'post_status' => 'publish',
        'posts_per_page' => $atts['posts_per_page'],
        'paged' => $paged,
    );
    // The Query
    $master_class = new WP_Query($args);
    global $post;
    ?>
    <div class="reset"></div>
    <div id="fotosessii-content" >
        <?php
        // Posts are found
        if ($master_class->have_posts()) {
            while ($master_class->have_posts()) { //:
                $master_class->the_post();
                ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a class="fotosessii-block" href="<?php the_permalink(); ?>">
                        <div class="fotosessii-archive-thumb aligncenter">
                            <div class="before">
                                <?php the_post_thumbnail('fotoset'); ?>
                                <div class="fotocaption">
                                    <?php echo get_post_meta($post->ID, 'text_after__2', 1); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
        }
        /*Restore original Post Data*/
        wp_reset_postdata(); ?>
        <div class='clear'></div>
    </div>
    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

add_shortcode('master_class', 'master_class_shortcode');
?>