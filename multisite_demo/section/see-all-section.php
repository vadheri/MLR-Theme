<?php if (get_row_layout() == 'see_all_section') : 
if(get_sub_field('section_enabledisable') == 'enable'){
    
    $text_align = get_sub_field('text_align');
    $section_spacing = get_sub_field('section_spacing');
    $color = get_sub_field('color');
    $background_style = get_sub_field('background_style');
    $main_heading_tag_list = get_sub_field('main_heading_tag_list');
    $standings_title = get_sub_field('standings_title');
    $all_match_score = get_sub_field('all_match_score');
    ?>
    <section class="section see-all-section <?php echo $section_spacing; ?>">
        <div class="container">
            <div class="see-all-main d-flex j-between">
                <div class="col col-3">
                    <?php if ($standings_title): ?>
                        <div class="standings-title center">
                            <h3><?php echo esc_html($standings_title); ?></h3>
                        </div>
                    <?php endif; ?>
                    <div class="main-match-score">
                    <?php if ($all_match_score): ?>
                        <div class="match-score-details">
                            <?php $index = 1; ?>
                            <?php foreach ($all_match_score as $match): ?>
                                <?php if ($index > 8) break; // Stop the loop after 8 matches ?>
                                <div class="match-row">
                                    <span class="match-index"><?php echo esc_html($index); ?></span> <!-- Display index -->
                                    <?php if (!empty($match['team_logo_image'])): ?>
                                        <img src="<?php echo esc_url($match['team_logo_image']['url']); ?>" alt="<?php echo esc_attr($match['team_logo_image']['alt']); ?>" class="team-logo">
                                    <?php endif; ?>
                                    <div class="team-scores">
                                        <span class="team-one-score"><?php echo esc_html($match['team_one_score']); ?></span> 
                                        - 
                                        <span class="team-two-score"><?php echo esc_html($match['team_two_score']); ?></span>
                                    </div>
                                </div>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

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
                                    <a style="background-color:<?php echo $background_style;?>"class="<?php echo $class;?> button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            </div>
                    </div>
                </div>
                <div class="col col-7">
                    <?php
                    $args = array(
                        'post_type' => 'member',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                    );
                    $members_query = new WP_Query($args);
                    if ($members_query->have_posts()) :
                    ?>
                    <div class="league-leaders">
                        <?php $top_title = get_sub_field('member_top_title');?>
                            <div class="right-title-top">
                                <?php if($top_title) : ?>
                                    <div class="member-top-title">
                                        <h3><?php echo $top_title; ?></h3>
                                    </div>
                                <?php endif; ?>

                                <div class="see-all-stat-link">
                                    <?php 
                                    $link = get_sub_field('see_all_statistics_link');
                                    if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>            
                            <div class="leaders-row d-flex j-between">
                            <?php
                            while ($members_query->have_posts()) : $members_query->the_post();
                                $team_name = get_field('team_name');
                                $score_value = get_field('score_value');; // You can remove this if not used elsewhere

                                // Get the taxonomy terms for the 'specialist' taxonomy
                                $specialists = get_the_terms(get_the_ID(), 'specialist');

                                // Check if terms exist
                                $specialist_names = [];
                                if ($specialists && !is_wp_error($specialists)) {
                                    foreach ($specialists as $specialist) {
                                        $specialist_names[] = $specialist->name;
                                    }
                                }
                                $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : get_template_directory_uri() . '/images/dummy-image.png';

                                ?>
                                <div class="leader box-rec">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="score-type">
                                            <h4><?php echo implode(', ', $specialist_names); ?></h4>
                                        </div>
                                        <div class="player-image" style="background:url(<?php echo esc_url($image_url); ?>) center">
                                        </div>
                                        <div class="player-name">
                                            <h4><?php the_title(); ?></h4>
                                        </div>
                                        <div class="score-value">
                                            <p><?php echo !empty($score_value) ? $score_value : '0'; ?></p>
                                        </div>
                                        <div class="d-flex">
                                            <div class="team-logo">
                                            <?php 
                                                $image = get_field('team_logo');
                                                if( !empty( $image ) ): ?>
                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="team-name">
                                                <p><?php echo $team_name; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php
                    wp_reset_postdata();
                    endif;
                    ?>                                                                         
                </div>
            </div>    
        </div>
    </section>
<?php } endif; ?>