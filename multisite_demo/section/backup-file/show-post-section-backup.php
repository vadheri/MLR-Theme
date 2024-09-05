 <div class="show-post-right">
                    <div class="top-title-container d-flex">
                    <!-- title top -->
                        <div class="title">
                            <?php $title_top = get_sub_field('title_top');
                                if($title_top) : ?>
                                   <h3 class="white-c"><?php echo esc_html($title_top); ?></h3>
                            <?php endif; ?>
                        </div>
                    <!-- dropdown -->
                        <?php if(have_rows('dropdown')): ?>
                        <div class="dropdown">
                            <select id="teams" class="dropbtn">
                                <?php while(have_rows('dropdown')): the_row(); ?>

                                <?php $dropdown_text = get_sub_field('dropdown_text');
                                if($dropdown_text) : ?>
                                   <option><?php echo esc_html($dropdown_text); ?></option>
                                 <?php endif; ?>
                                 
                                 <?php endwhile; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                    </div>    
                    <!-- Player Stats -->
                        <?php
                                $args = array(
                                    'post_type' => 'news',
                                    'post_status' => 'publish',
                                    'posts_per_page' => '8',
                                    'paged' => 1,
                                );
                                $blog_posts = new WP_Query( $args );
                                ?>
                        <div class="entry-content">
                            <?php if ( $blog_posts->have_posts() ) : ?>
                            <div class="blog-posts d-flex">
                                <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
                                <div class="blog-list">
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
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
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
                                <a style="color:<?php echo $color;?>;" class="<?php echo $class;?> button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                            <p class="no-posts-message" style="display: none;">No posts</p>
                            <?php endif; ?>
                        </div><!-- .entry-content -->
                </div>  