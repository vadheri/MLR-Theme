<?php
/**
 * The template for displaying search forms
 *
 * @package multisite_demo
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'multisite_demo' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'multisite_demo' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span><?php echo esc_html_x( 'Search', 'submit button', 'multisite_demo' ); ?></span></button>
</form>
