<?php 
if (get_row_layout() == 'grid_box_section') : 
    if (get_sub_field('section_enabledisable') == 'enable') {
        $text_align = get_sub_field('text_align');
        $section_spacing = get_sub_field('section_spacing');
    ?>

    <section class="section grid-box-section <?php echo esc_html($section_spacing); ?>" style="background-image: url('<?php echo esc_url('http://localhost/multisite_demo/wp-content/uploads/2024/06/grid-box-bg.png'); ?>');">
        <div class="container">
            <div class="row d-flex">
                <div class="main-box-left d-flex">
                   
                        <?php
                        $args = array(
                            'post_type' => 'news',
                            'posts_per_page' => -1
                        );
                        $custom_query = new WP_Query($args);
                        if ($custom_query->have_posts() || get_sub_field('post_left')) :
                        ?>
                            <div class="box-left">
                                    <?php
                                    $related_posts = get_sub_field('post_left');
                                    if ($related_posts) : 
                                        foreach ($related_posts as $post) : 
                                            setup_postdata($post); 
                                    ?>
                                            <div class="left-post">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php if (has_post_thumbnail()) : 
                                                        $thumbnail_id = get_post_thumbnail_id();
                                                        $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'custom-size', true);
                                                    ?>  
                                                        <div class="featured-image">
                                                            <img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php the_title_attribute(); ?>" />
                                                        </div>
                                                    <?php endif; ?>
                                    
                                                    <div class="single-main-text">
                                                        <div class="box-title">
                                                            <?php the_title('<h4>', '</h4>'); ?>
                                                        </div>
                                                        <div class="box-description">
                                                            <p><?php echo esc_html(get_the_excerpt()); ?></p>
                                                        </div>
                                                    </div>    
                                                </a>
                                            </div>
                                        <?php 
                                            wp_reset_postdata(); 
                                        endforeach; 
                                    endif; 
                                    ?>
                            </div>
                            <?php endif; ?>
                   
                    <div class="box-right">
                        <?php
                        $args = array(
                            'post_type' => 'news',
                            'posts_per_page' => -1
                        );
                        $custom_query = new WP_Query($args);
                        if ($custom_query->have_posts() || get_sub_field('post_right')) :
                        ?>
                        
                                <?php
                                $related_posts = get_sub_field('post_right');
                                if ($related_posts) : 
                                    foreach ($related_posts as $post) : 
                                        setup_postdata($post);
                                ?>
                                        <div class="right-post">
                                            <a href="<?php the_permalink(); ?>" class="d-flex">
                                                <?php if (has_post_thumbnail()) : 
                                                    $thumbnail_id = get_post_thumbnail_id();
                                                    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'custom-size', true);
                                                ?>  
                                                    <div class="featured-image">
                                                        <img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php the_title_attribute(); ?>" />
                                                    </div>
                                                <?php endif; ?>

                                                <div class="single-main-text">
                                                    <div class="box-title">
                                                        <?php the_title('<h4>', '</h4>'); ?>
                                                    </div>
                                                    <div class="box-description">
                                                        <p><?php echo esc_html(get_the_excerpt()); ?></p>
                                                    </div>
                                                </div>    
                                            </a>
                                        </div>
                                    <?php 
                                    endforeach; 
                                    wp_reset_postdata(); 
                                endif; 
                                ?>
                        </div>
                        <?php endif; ?>
                </div>
                

                <div class="image-player-image">
                    <div class="one-image-container">
                        <img src="http://localhost/multisite_demo/wp-content/uploads/2024/06/logo-2.png" alt="show post logo">
                    </div>
                    <div class="player-image"></div>
                    <div class="main-box-right">
                        <?php if (have_rows('player_details')) : ?>
                            <div class="player-details-container">
                                <?php while (have_rows('player_details')) : the_row(); ?>
                                    <?php 
                                    $name = get_sub_field('name');
                                    if ($name) : ?>
                                        <div class="player-name">
                                            <h4><?php echo esc_html($name); ?></h4>
                                        </div>    
                                    <?php endif; ?>

                                    <?php 
                                    $roll = get_sub_field('roll');
                                    if ($roll) : ?>
                                        <div class="player-roll">
                                            <h5><?php echo esc_html($roll); ?></h5>
                                        </div>
                                    <?php endif; ?>

                                    <?php 
                                    $team_name = get_sub_field('team_name');
                                    if ($team_name) : ?>
                                        <div class="team-name">
                                            <h5><?php echo esc_html($team_name); ?></h5>
                                        </div>    
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>                  
            </div>
        </div>        
    </section>

<?php 
    } 
endif; 
?>
