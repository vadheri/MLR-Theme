<?php if (get_row_layout() == 'player_stats_section') : 
if (get_sub_field('section_enabledisable') == 'enable') : ?>
    <section class="section player-stats-section <?php echo esc_attr($section_spacing); ?>">
        <div class="container">
            <div class="player-stat-main d-flex">
                <?php
                $specialists = get_terms(array(
                    'taxonomy' => 'specialist',
                    'hide_empty' => false,
                ));

                if (!empty($specialists) && !is_wp_error($specialists)) {
                    foreach ($specialists as $specialist) {
                        $specialist_slug = $specialist->slug;
                        $specialist_name = $specialist->name;
                        $specialist_description = $specialist->description; // Retrieve description

                        $args = array(
                            'post_type' => 'member',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'specialist',
                                    'field'    => 'slug',
                                    'terms'    => $specialist_slug,
                                ),
                            ),
                            'meta_key' => 'score_value',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                        );

                        $members_query = new WP_Query($args);

                        if ($members_query->have_posts()) : ?>
                            <div class="specialist-group" data-specialist-group="<?php echo esc_attr($specialist_slug); ?>">
                                <div class="specialist-title">
                                    <h3><?php echo esc_html($specialist_name); ?>
                                        <b class="question-image">
                                            <?php if (!empty($specialist_description)) : ?>
                                                <div class="specialist-description">
                                                    <p><?php echo esc_html($specialist_description); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </b>
                                    </h3>
                                </div>

                                <div class="member-wrapper">
                                    <div class="member-list box-rec">
                                        <?php
                                        $first_member = true;
                                        while ($members_query->have_posts()) : $members_query->the_post();
                                            $team_name = get_field('team_name');
                                            $score_value = get_field('score_value');
                                            $specialists = get_the_terms(get_the_ID(), 'specialist');
                                            $specialist_names = [];
                                            if ($specialists && !is_wp_error($specialists)) {
                                                foreach ($specialists as $specialist) {
                                                    $specialist_names[] = $specialist->name;
                                                }
                                            }
                                            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); 
                                            ?>
                                            <div class="member-item" data-player-id="<?php echo get_the_ID(); ?>" style="<?php echo $first_member ? '' : 'display:none;'; ?>">
                                                <div class="rank-accordion">
                                                    <p># <?php echo sprintf('%02d', $members_query->current_post + 1); ?></p>
                                                </div>
                                                <div class="player-image">
                                                    <?php
                                                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                                    $default_image_url = get_template_directory_uri() . '/images/player-dummy-image.png'; // Path to your dummy image

                                                    // Use the default image if the thumbnail URL is empty
                                                    $image_url = !empty($thumbnail_url) ? esc_url($thumbnail_url) : esc_url($default_image_url);
                                                    ?>
                                                    <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" class="member-image">
                                                </div>
                                                <div class="member-score" data-player-id="<?php echo get_the_ID(); ?>">
                                                    <h5><?php echo esc_html($score_value); ?></h5>
                                                </div>
                                            </div>
                                            <?php
                                            $first_member = false; 
                                        endwhile;
                                        ?>
                                    </div>
                                    <div class="member-info-list">
                                        <?php
                                        $first_member = true;
                                        while ($members_query->have_posts()) : $members_query->the_post();
                                            $score_value = get_field('score_value');
                                            ?>
                                            <div class="member-info <?php echo $first_member ? 'active' : ''; ?>" data-player-id="<?php echo get_the_ID(); ?>">
                                                <span class="player-name" data-player-id="<?php echo get_the_ID(); ?>"><?php the_title(); ?></span>
                                                <span class="score-value"><?php echo !empty($score_value) ? esc_html($score_value) : '0'; ?></span>
                                            </div>
                                            <?php
                                            $first_member = false;
                                        endwhile;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endif;
                        wp_reset_postdata();
                    }
                }
                ?>
            </div>
        </div>
    </section>
<?php endif; endif; ?>
