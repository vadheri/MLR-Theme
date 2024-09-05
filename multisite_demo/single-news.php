<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package multisite_demo
 */

get_header();
$heading = get_field('ticket_heading');
$sub_heading = get_field('ticket_sub_heading');

?>

<main id="primary single news-page" class="site-main">
    <div class="container">
        <div class="section">
            <div class="main-content-part">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="custom-post-thumbnail">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div class="col col-7">
                                <div class="content-main">
                                    <div class="section-title">
                                        <h1><?php the_title(); ?></h1>
                                    </div>
                                    <div class="content">
                                        <?php the_content(); ?>
                                    </div>
                                    <?php if( have_rows('image_and_paragraph') ): ?>
                                        <?php while( have_rows('image_and_paragraph') ): the_row(); ?>
                                            <div class="image-and-paragraph d-flex">
                                                <?php 
                                                $left_image = get_sub_field('left_image');
                                                if( $left_image ): ?>
                                                    <div class="left-image">
                                                        <img src="<?php echo esc_url($left_image['url']); ?>" alt="<?php echo esc_attr($left_image['alt']); ?>" />
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <div class="right-paragraph">
                                                    <?php $right_paragraph = get_sub_field('right_paragraph');
                                                     echo $right_paragraph; ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                    <?php if( have_rows('paragraph_and_heading') ): ?>
                                        <?php while( have_rows('paragraph_and_heading') ): the_row(); ?>
                                            <div class="paragraph-and-largeheading d-flex">
                                                <?php 
                                                $left_paragraph = get_sub_field('left_paragraph');
                                                if( $left_paragraph ): ?>
                                                    <div class="left-paragraph">
                                                        <?php echo $left_paragraph; ?>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <div class="large-heading">
                                                    <?php $large_right_text = get_sub_field('large_right_text');
                                                     echo $large_right_text; ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <div class="news-point">
                                        <?php $news_point = get_field('news_point'); echo $news_point; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>     
                    <div class="col col-3">
                        <div class="buy-ticket-container">
                            <div class="top-row">
                            <?php 
                            $link = get_field('ticket_link');
                            if( $link ): 
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <div class="ticket-text">
                                    <div class="mlr-logo"></div>
                                    <div>
                                        <div class="buy-text">
                                            <h2><?php echo $heading;?></h2>
                                        </div>
                                        <div class="see-text">
                                            <p><?php echo $sub_heading;?></p>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            <?php endif; ?>
                            </div>
                            <div class="single-news-post d-flex">
                                <?php
                                $args = array(
                                    'post_type' => 'news', 
                                    'posts_per_page' => 4,
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
                                                    <div class="post-content">
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
                        </div>
                    </div>  
                </div>
                <div class="form-part">
					<?php echo do_shortcode( '[gravityform id=2 title=false description=false ajax=true]' ); ?>
				</div>
             </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>