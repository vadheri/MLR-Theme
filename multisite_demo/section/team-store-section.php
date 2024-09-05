<?php if (get_row_layout() == 'team_store_section') : 
if (get_sub_field('section_enabledisable') == 'enable') {
    $text_align = get_sub_field('text_align');
    $section_spacing = get_sub_field('section_spacing');
    $section_class = get_sub_field('section_class');
    $background_option = get_sub_field('background_option');
    $image = get_sub_field('background_image');
    $section_title = get_sub_field('title');
    $banner_text = get_sub_field('banner_text');
    ?>
    <section class="<?php echo esc_attr($section_class); ?> section <?php echo esc_attr($section_spacing); ?>">
        <div class="container">
            <div class="standings-main">
                <div class="section-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="store-banner-part">
                    <div class="banner-image">
                        <?php 
                        $image = get_sub_field('banner_image');
                        if( !empty( $image ) ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="white-c banner-text">
                        <h3><?php echo esc_html($banner_text); ?></h3>
                    </div>
                </div>
                <div class="row d-flex">
                    <?php
                    $args = array(
                        'post_type' => 'store',
                        'posts_per_page' => -1,
                        'order' => 'ASC'
                    );
                    $custom_query = new WP_Query($args);

                    if ($custom_query->have_posts()) :
                        while ($custom_query->have_posts()) : $custom_query->the_post();

                            // Get the value of the prize_or_text field
                            $prize_or_text = get_field('prize_or_text');
                            ?>
                            <div class="col col-3 team-details">
                                <div class="full-team-logo">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php 
                                        if ( has_post_thumbnail() ) : 
                                            the_post_thumbnail('full', array('alt' => get_the_title()));
                                        endif; 
                                        ?>
                                    </a>
                                </div>
                                <div class="teamname-ticketlink d-flex">
                                    <div class="team-name">
                                        <a class="white-c" href="<?php the_permalink(); ?>">
                                            <?php echo the_title();?>
                                        </a>
                                    </div>
                                    <div class="ticket-link">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php 
                                            $prize = get_field('prize');
                                            if (!empty($prize)) {
                                                echo esc_html($prize);
                                            } else {
                                                echo esc_html('team score');
                                            }
                                            ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata(); // Reset post data after the custom query
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php } endif; ?>
