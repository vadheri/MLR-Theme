<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package multisite_demo
 */

get_header();
?>

<main id="primary single news-page" class="site-main">
    <div class="container">
        <?php
        while ( have_posts() ) :
            the_post();
			
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
            // Retrieve the video link field
            $video_link = get_field('video_link', get_the_ID());
			
            if ($video_link && is_array($video_link) && !empty($video_link['url'])):
                // Extract the video URL
                $video_url = esc_url($video_link['url']);
                ?>
                <div class="video-link">
                    <iframe width="560" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?php endif; ?>

            <?php
            // Display the content of the post
            get_template_part( 'template-parts/content', get_post_type() );

            // Navigation for next/previous post
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'multisite_demo' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'multisite_demo' ) . '</span> <span class="nav-title">%title</span>',
                )
            );

            // Load the comment template if comments are open or there are comments
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>           
    </div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>