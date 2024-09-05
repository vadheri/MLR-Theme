<?php if (get_row_layout() == 'schedule_section') : 
if (get_sub_field('section_enabledisable') == 'enable') :
    $text_align = get_sub_field('text_align');
    $section_spacing = get_sub_field('section_spacing');
    $section_class = get_sub_field('section_class');
    $background_option = get_sub_field('background_option');
    $image = get_sub_field('background_image');
    $section_id = get_sub_field('id');
    $section_title = get_sub_field('title');
    
    ?>
    <section id="<?php echo esc_attr($section_id); ?>" class="section <?php echo esc_attr($section_class); ?> <?php echo esc_attr($section_spacing); ?>">
        <div class="container">
            <div class="row">
                <div class="section-content">
                    <div class="team-top d-flex">
                        <div class="section-title">
                                <h2><?php echo esc_html($section_title); ?></h2>
                        </div>
                        <select id="team-filter-taxonomy">
                                <option value="">Select Team</option>
                                <?php
                                // Fetch the terms from the 'team-name' taxonomy
                                $team_terms = get_terms(array(
                                    'taxonomy' => 'team-name', 
                                    'hide_empty' => false,
                                ));
                                if (!empty($team_terms) && !is_wp_error($team_terms)) {
                                    foreach ($team_terms as $team_term) {
                                        ?>
                                        <option value="<?php echo esc_attr($team_term->slug); ?>"><?php echo esc_html($team_term->name); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <div id="matches-container">
                            <div class="main-match d-flex">
                                <?php
                                if (have_rows('schedule_match')) :
                                    while (have_rows('schedule_match')) : the_row();
                                        if (have_rows('schedule_score')) :
                                            while (have_rows('schedule_score')) : the_row();
                                                $teams_part = get_sub_field('teams_part');
                                                $time = get_sub_field('time');
                                                $date = get_sub_field('date');
                                                $show_additional_fields = true;
                                
                                                // Format date and time
                                                $date_object = DateTime::createFromFormat('F j, Y', $date);
                                                if ($date_object) {
                                                    // Get the three-letter abbreviation for the day of the week
                                                    $day_of_week = $date_object->format('D');

                                                    // Get the full name of the month
                                                    $month = $date_object->format('F');

                                                    // Get the day of the month and determine the suffix
                                                    $day = $date_object->format('j');
                                                    $suffix = 'th';
                                                    if (!in_array(($day % 100), array(11, 12, 13))) {
                                                        switch ($day % 10) {
                                                            case 1: $suffix = 'st'; break;
                                                            case 2: $suffix = 'nd'; break;
                                                            case 3: $suffix = 'rd'; break;
                                                        }
                                                    }
                                                    $formatted_day = $day . $suffix;
                                                }

                                                 else {
                                                    // Handle error: invalid date format
                                                    $day_of_week = 'Invalid';
                                                    $formatted_date = 'Invalid date';
                                                }
                                
                                                $time_object = DateTime::createFromFormat('h:i A', $time);
                                                if ($time_object) {
                                                    $formatted_time = $time_object->format('H:i') . 'ET';
                                                } else {
                                                    // Handle error: invalid time format
                                                    $formatted_time = 'Invalid time';
                                                }

                                                   // Check if all team scores are empty
                                                $all_scores_empty = true;
                                                $has_filled_scores = false;
                                                if ($teams_part) {
                                                    foreach ($teams_part as $team) {
                                                        if (!empty($team['team_score'])) {
                                                            $all_scores_empty = false;
                                                            break;
                                                        }
                                                    }
                                                }

                                                if ($teams_part) {
                                                    foreach ($teams_part as $team) {
                                                        if (!empty($team['team_score'])) {
                                                            $has_filled_scores = true;
                                                            break;
                                                        }
                                                    }
                                                }

                                                ?>
                                                <div class="match<?php echo $all_scores_empty ? '' : ' no-channel-ticket'; ?>" data-teams="<?php 
                                                    if ($teams_part) {
                                                        $team_slugs = array();
                                                        foreach ($teams_part as $team) {
                                                            $term = get_term($team['team_name']);
                                                            if ($term && !is_wp_error($term)) {
                                                                $team_slugs[] = esc_attr($term->slug);
                                                            }
                                                        }
                                                        echo implode(' ', $team_slugs);
                                                    }
                                                    ?>">
                                                    <div class="match-time-date">
                                                        <div class="day-date-part d-flex">
                                                        <div class="match-week">
                                                            <p><?php echo esc_html($day_of_week); ?></p>
                                                        </div>
                                                        <div class="match-date">
                                                            <p><span><?php echo esc_html($month); ?></span><b><?php echo esc_html($formatted_day); ?></b></p>
                                                        </div>
                                                        </div>
                                                        <div class="match-time">
                                                            <p><?php echo esc_html($formatted_time); ?></p>
                                                        </div>
                                                    </div>

                                                    <?php if ($all_scores_empty): ?>
                                                        <div class="channel-ticket-part d-flex">                
                                                            <?php if ($show_additional_fields): ?>
                                                                <?php if (have_rows('broadcast_tv_channel_image')): ?>
                                                                    <?php while (have_rows('broadcast_tv_channel_image')): the_row(); ?>
                                                                        <div class="channel-image">
                                                                            <?php 
                                                                            $image = get_sub_field('image');
                                                                            if (!empty($image)): ?>
                                                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endwhile; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="match-details-part">
                                                        <?php if ($teams_part): ?>
                                                            <?php foreach ($teams_part as $index => $team): ?>
                                                                <div class="team">
                                                                    <?php 
                                                                    // Retrieve team name from the taxonomy field
                                                                    $team_term = get_term($team['team_name']);
                                                                    if ($team_term && !is_wp_error($team_term)): ?>
                                                                        <div class="team-score">
                                                                            <p><?php echo esc_html($team['team_score']); ?></p>
                                                                        </div>
                                                                        <div class="score-logo">
                                                                            <div class="team-logo">
                                                                                <?php 
                                                                                if (!empty($team['team_score'])) {
                                                                                    $show_additional_fields = false; // If score is not empty, do not show additional fields
                                                                                }
                                                                                $logo = $team['logo'];
                                                                                if (!empty($logo)): ?>
                                                                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="team-name">
                                                                                <p><?php echo esc_html($team_term->name); ?></p>
                                                                            </div>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <p>Team not found</p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if ($index === 0 && count($teams_part) > 1): ?>
                                                                    <div class="versus-text">
                                                                        <p>at</p>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                   <div class="last-part">                 
                                                        <?php if ($has_filled_scores): ?>
                                                            <div class="live-schedule-text">
                                                                <?php $schedule_text_part = get_sub_field("schedule_text_part"); ?>
                                                                <p><?php echo esc_html($schedule_text_part); ?></p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="buy-ticket">                
                                                            <?php if ($all_scores_empty): ?>
                                                                <a href="http://localhost/multisite_demo/tickets/">Buy Tickets</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endwhile;
                                        endif;
                                    endwhile;
                                else : ?>
                                    <p>No matches found.</p>
                                <?php endif; ?>
                                
                            </div>
                    </div>
                    <?php if( have_rows('full_player_details') ): ?>
                            <div class="full-player-details" style="background-image: url(http://localhost/multisite_demo/wp-content/uploads/2024/08/player-bg-image.png);">
                                <?php while( have_rows('full_player_details') ): the_row(); ?>
                                    <div class="player-detail">
                                        <?php 
                                        // Get Right Team Logo
                                        $right_team_logo = get_sub_field('right_team_logo');
                                        if( $right_team_logo ): ?>
                                            <div class="right-team-logo">
                                                <img src="<?php echo esc_url($right_team_logo['url']); ?>" alt="<?php echo esc_attr($right_team_logo['alt']); ?>" />
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php 
                                        // Get Full Player Image
                                        $full_player_image = get_sub_field('full_player_image');
                                        if( $full_player_image ): ?>
                                            <div class="full-player-image">
                                                <img src="<?php echo esc_url($full_player_image['url']); ?>" alt="<?php echo esc_attr($full_player_image['alt']); ?>" />
                                            </div>
                                        <?php endif; ?>

                                        <?php if( have_rows('schedule_player_details') ): ?>
                                            <div class="schedule-player-details">
                                                <table>
                                                    <tbody>
                                                        <?php while( have_rows('schedule_player_details') ): the_row(); ?>
                                                            <?php
                                                            // Get values from the sub-fields
                                                            $name = get_sub_field('name');
                                                            $roll = get_sub_field('roll');
                                                            $team_name = get_sub_field('team_name');
                                                            ?>
                                                            <tr>
                                                                <td><?php echo esc_html($name); ?></td>
                                                                <td><?php echo esc_html($roll); ?></td>
                                                                <td><?php echo esc_html($team_name); ?></td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                <?php endwhile; ?>
                            </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; endif; ?>
