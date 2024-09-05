<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package multisite_demo
 */

get_header();
?>
<div class="section">
	<div class="container">
        <div class="error-404">
			<div class="heading">
            	<h1>404</h1>
			</div>
			<div class="sub-heading">
            	<h2>Oops! Page Not Found</h2>
			</div>
			<div class="description">
            	<p>Sorry, but the page you are looking for does not exist, has been removed, or is temporarily unavailable.</p>
			</div>
			<div class="button-main">
				<a href="<?php echo home_url(); ?>" class="button">Back to Home</a>
			</div>
        </div>
    </div>
</div>
<?php
get_footer();
