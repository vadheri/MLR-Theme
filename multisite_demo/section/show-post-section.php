<?php if (get_row_layout() == 'show_post_section') : 
if (get_sub_field('section_enabledisable') == 'enable') {
    $text_align = get_sub_field('text_align');
    $section_spacing = get_sub_field('section_spacing');
    $section_class = get_sub_field('section_class');
    $background_option = get_sub_field('background_option');
    $image = get_sub_field('background_image');
    ?>
    <section class="<?php echo esc_attr($section_class); ?> section show-post-section <?php echo esc_attr($section_spacing); ?>" 
        <?php if ($background_option == 'enable' && !empty($image)): ?> style="background-image: url('<?php echo esc_url($image['url']); ?>');"
        <?php endif; ?>
    >
        <div class="container">
            <div class="main-show-post d-flex no-wrap">
                <!-- left-part -->
                <div class="show-post-left">
                    <!-- left player image -->
                    <div class="one-image-container">
                        <img src="http://localhost/multisite_demo/wp-content/uploads/2024/06/white-b-logo-r.png" alt="show post logo">
                    </div>
                    <div class="player-image"></div>
                    <!-- player details -->
                    <?php if(have_rows('player_details')): ?>
                        <div class="player-details-container">
                            <?php while(have_rows('player_details')): the_row(); ?>
                                <?php 
                                    $name = get_sub_field('name');
                                    if($name): ?>
                                    <div class="player-name">
                                        <h4><?php echo esc_html($name); ?></h4>
                                    </div>    
                                <?php endif; ?>
                                <?php 
                                    $roll = get_sub_field('roll');
                                    if($roll): ?>
                                    <div class="player-roll">
                                        <h5><?php echo esc_html($roll); ?></h5>
                                    </div>
                                <?php endif; ?>
                                <?php 
                                    $team_name = get_sub_field('team_name');
                                    if($team_name): ?>
                                    <div class="team-name">
                                        <h5><?php echo esc_html($team_name); ?></h5>
                                    </div>    
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="show-post-right">
                    <div class="top-title-container d-flex">
                        <div class="title">
                            <?php 
                            $title_top = get_sub_field('title_top');
                            if ($title_top) : ?>
                                <h3 class="white-c"><?php echo esc_html($title_top); ?></h3>
                            <?php endif; ?>
                        </div>
                        <div class="dropdown">
                            <select id="category-dropdown" class="dropbtn">
                                <option value="all">Show Everything</option>
                                <?php
                                $categories = get_categories();
                                foreach ($categories as $category) {
                                    ?>
                                    <option value="<?php echo esc_attr($category->term_id); ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="posts-container" class="d-flex">
                        <?php
                        $args = array(
                            'post_type' => 'news', 
                            'posts_per_page' => 8,
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="news-post">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="blog-content">
                                            <?php 
                                                if (has_post_thumbnail()) : 
                                                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                    else : 
                                                    $thumbnail_url = get_template_directory_uri() . '/images/dummy-image.png';
                                                endif;
                                            ?>
                                            <div class="post-thumbnail" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
                                            </div>
                                            <div class="post-content <?php echo esc_attr($text_align); ?>">
                                                <p class="post-title"><?php the_title(); ?></p>
                                                <div class="post-dic">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile;
                        else :
                            echo "No posts found.";
                        endif;

                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="button-main helo">
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
                            <a style="color:<?php echo $color;?>;" class="<?php echo $class;?> button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php echo esc_html( $link_title ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } endif; ?>



