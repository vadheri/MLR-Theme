<?php if (get_row_layout() == 'banner') : 
if(get_sub_field('section_enabledisable') == 'enable'){
    $text_align = get_sub_field('text_align');
    $section_spacing = get_sub_field('section_spacing');
    $heading = get_sub_field('heading');
    $sub_heading = get_sub_field('sub_heading');
    $official_heading = get_sub_field('official_heading');
    $latest_heading = get_sub_field('latest_heading');
    $read_more = get_sub_field('read_more_text');
    $color = get_sub_field('color');
    $background_style = get_sub_field('background_style');
    $main_heading_tag_list = get_sub_field('main_heading_tag_list');
    $sub_heading_tag_list = get_sub_field('sub_heading_tag_list');
    $heading_font_weight = get_sub_field('heading_font_weight');
    ?>
    <section class="section banner <?php echo $section_spacing; ?>">
        <div class="container">
            <div class="main-banner d-flex j-between">
                <div class="col-7">
                    <?php
                    // Check if the relationship field has values
                    $related_posts = get_sub_field('select_post');

                    if ($related_posts) : 
                    ?>
                        <div class="banner-layout">
                            <?php foreach ($related_posts as $post) : 
                                // Setup post data
                                setup_postdata($post); 
                            ?>
                                <div class="banner-item">
                                    <h2><?php the_title(); ?></h2>
                                    <div class="banner-content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            <?php 
                                // Reset post data
                                wp_reset_postdata(); 
                            ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="button-main">
                        <?php
                        $link = get_sub_field('link');
                        $color = get_sub_field('color');
                        $class = get_sub_field('class');
                        $background_style = get_sub_field('background_style');
                        if ($link) : 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a style="color:<?php echo $color; ?>;" class="<?php echo $class; ?> button" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                            <?php echo esc_html($link_title); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-3 d-flex">
                        <div class="buy-ticket-container d-flex">
                            <a href="http://localhost/multisite_demo/tickets/" target="_self">
                                <div class="top-row d-flex">
                                    <div class="ticket-text">
                                        <div class="mlr-logo"></div>
                                        <div>
                                            <?php if ($heading) : ?>
                                                <div class="buy-text">
                                                    <<?php echo $main_heading_tag_list;?> class="<?php echo $heading_font_weight; ?>">
                                                        <?php echo $heading; ?>
                                                    </<?php echo $main_heading_tag_list?>>
                                                </div>
                                            <?php endif; ?>
                                            <?php ?>   
                                            <?php if($sub_heading) : ?>
                                                <div class="see-text">     
                                                    <<?php echo $sub_heading_tag_list;?>>  
                                                        <?php echo $sub_heading; ?>
                                                    </<?php echo $sub_heading_tag_list?>>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="http://localhost/multisite_demo/store/" target="_self">    
                                <div class="bottom-row d-flex">
                                    <?php if($official_heading) : ?>        
                                        <div class="official-text">
                                            <p class="black-c"><?php echo $official_heading; ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                        <div class="headline">
                                <?php if($latest_heading) : ?>
                                    <div class="headline-title">
                                        <h3><?php echo $latest_heading;?></h3>
                                    </div>
                                <?php endif; ?>
                                <ul>
                                    <?php
                                    $args = array(
                                        'post_type' => 'news', 
                                        'posts_per_page' => 6,
                                    );
                                    $custom_posts = new WP_Query($args);
                                    if ($custom_posts->have_posts()) :
                                        while ($custom_posts->have_posts()) : $custom_posts->the_post();
                                            ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </li>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        ?>
                                        <li><?php _e('No posts found', 'text-domain'); ?></li>
                                    <?php endif; ?>
                                </ul>
                                <div class="button-main">
                                    <?php
                                    $link = get_sub_field('link');
                                    $color = get_sub_field('color');
                                    $class = get_sub_field('class');
                                    $background_style = get_sub_field('background_style');
                                    if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                <a style="color:<?php echo $color;?>;" class="<?php echo $background_style;?> button text-end" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                </div>                  
            </div>
        </div>
    </section>
<?php } endif; ?>
