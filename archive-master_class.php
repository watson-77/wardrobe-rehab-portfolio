<?php/*Template Name: Архив проектов запись Мастер-класс*/?><?php get_header(); ?><?php$mytheme = get_option('portfolio_options');global $mytheme;?>    <div id="fotosessii-content" class="block">        <div class="aligncenter zagolovok">            <h2>                <?php echo $mytheme['zagolovokmasterclass']; ?>            </h2>        </div>        <div class="aligncenter slogon">            <h3>                <?php echo $mytheme['slogonmasterclass']; ?>            </h3>        </div>        <?php if (have_posts()) :            while (have_posts()) : the_post(); ?>                  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                    <a class="fotosessii-block" href="<?php the_permalink(); ?>">                        <div class="fotosessii-archive-thumb aligncenter">                            <div class="before">                                <?php the_post_thumbnail('fotoset'); ?>                                <div class="fotocaption">                                    <?php echo get_post_meta($post->ID, 'text_after_2', 1); ?>                                </div>                            </div>                        </div>                    </a>                </div>            <?php endwhile; pager(); endif; ?>        <div style="clear:both;"></div>        <br/>        <div class="aligncenter formslogon">            <h3>                <?php echo $mytheme['zagolovokformmasterclass']; ?>            </h3>        <div class="aligncenter portfolioform form">            <?php $formsmasterclass = $mytheme['formsmasterclass']; echo do_shortcode($formsmasterclass); ?>        </div>        </div>    </div><?php get_footer(); ?>