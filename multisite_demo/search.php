<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package multisite_demo
 */

get_header();
?>
<div class="search-page section">
    <div class="container">
        <main id="primary" class="site-main">
            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        /* translators: %s: search query. */
                        printf( esc_html__( 'Search Results for: %s', 'multisite_demo' ), '<span>' . get_search_query() . '</span>' );
                        ?>
                    </h1>
                </header><!-- .page-header -->

                <div class="search-page-main d-flex">
                    <div class="search-content">
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();
                            
                            // Get the template part for displaying search results
                            get_template_part( 'template-parts/content', 'search' );

                        endwhile;

                        // Pagination for the search results
                        the_posts_navigation();

                    else :

                        // Template part for no results
                        get_template_part( 'template-parts/content', 'none' );

                    endif;
                        ?>
                    </div>
                </div>
        </main><!-- #main -->
    </div>
</div>
<?php
get_sidebar();
get_footer();
