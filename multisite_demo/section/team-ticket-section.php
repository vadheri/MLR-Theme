<?php if (get_row_layout() == 'team_ticket_section') : 
if (get_sub_field('section_enabledisable') == 'enable') {
    $text_align = get_sub_field('text_align');
    $section_spacing = get_sub_field('section_spacing');
    $section_class = get_sub_field('section_class');
    $background_option = get_sub_field('background_option');
    $image = get_sub_field('background_image');
    $section_title = get_sub_field('title');
    ?>
    <section class="<?php echo esc_attr($section_class); ?> section <?php echo esc_attr($section_spacing); ?>">
        <div class="container">
            <div class="standings-main">
                <div class="section-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="row all-team-details d-flex">
                    <?php
                    $args = array(
                        'post_type' => 'team',
                        'posts_per_page' => -1
                    );
                    $custom_query = new WP_Query($args);

                    if ($custom_query->have_posts()) :
                        while ($custom_query->have_posts()) : $custom_query->the_post();
   
                            ?>
                            <div class="col-4 team-details">
                                <div class="full-team-logo">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php 
                                        $image = get_field('team_logo');
                                        if( !empty( $image ) ): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="teamname-ticketlink d-flex">
                                    <div class="team-name">
                                        <a class="white-c" href="<?php the_permalink(); ?>">
                                            <?php echo the_title();?>
                                        </a>
                                    </div>
                                    <div class="ticket-link">
                                        <?php 
                                        $link = get_field('ticket_link');
                                        if( $link ): 
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                        <?php endif; ?>
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
