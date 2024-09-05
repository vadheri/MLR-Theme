<?php if (get_row_layout() == 'standings_points_table') : 
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
                        <h2><?php echo esc_html($section_title); ?></h2>
                    </div>

                    <?php if( have_rows('standings_points') ): ?>
                        <table class="standings-table">
                            <thead>
                                <tr>
                                    <th>mp</th>
                                    <th>w</th>
                                    <th>l</th>
                                    <th>d</th>
                                    <th>Pd</th>
                                    <th>Td</th>
                                    <th>Bp</th>
                                    <th>Tp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; // Initialize index ?>
                                <?php while( have_rows('standings_points') ): the_row(); ?>
                                    <tr>
                                        <td><?php echo $index; ?></td> <!-- Display Index -->
                                        <td class="team-logo">
                                            <?php 
                                            $team_logo = get_sub_field('team_logo');
                                            if( $team_logo ) : ?>
                                                <img src="<?php echo esc_url($team_logo['url']); ?>" alt="<?php echo esc_attr($team_logo['alt']); ?>" />
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo esc_html(get_sub_field('played')); ?></td>
                                        <td><?php echo esc_html(get_sub_field('wins')); ?></td>
                                        <td><?php echo esc_html(get_sub_field('loose')); ?></td>
                                        <td><?php echo esc_html(get_sub_field('draw')); ?></td>
                                        <td><?php echo esc_html(get_sub_field('pd')); ?></td>
                                        <td><?php echo esc_html(get_sub_field('td')); ?></td>
                                        <td><?php echo esc_html(get_sub_field('bp')); ?></td>
                                        <td><?php echo esc_html(get_sub_field('tp')); ?></td>
                                    </tr>
                                    <?php $index++; // Increment index for the next row ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No standings available.</p>
                    <?php endif; ?>

                        
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


                    <?php $match_points_fullform = get_sub_field('match_points_fullform');?>
                    <div class="match-points-fullform">
                        <?php echo $match_points_fullform; ?>
                    </div>
                    <?php $full_player_details = get_sub_field('match_rules');?>
                    <div class="match-rules">
                        <?php echo $full_player_details; ?>
                    </div>

            </div>
        </div>
    </section>
<?php } endif; ?>