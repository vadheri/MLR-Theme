<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package multisite_demo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fortless' ); ?></a>
	<header>
		<div class="container">
			<div id="masthead" class="site-header d-flex">
				<div class="header-top">
					<div class="site-branding">
						<?php
						the_custom_logo();
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						$fortless_description = get_bloginfo( 'description', 'display' );
						if ( $fortless_description || is_customize_preview() ) :
							?>
							<p class="site-description">
								<?php echo $fortless_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</p>
						<?php endif; ?>
					</div>
                    <?php if (have_rows('score_slider', 'option')) : ?>
                        <div class="score-slider">
                            <?php 
                            $first_slide = true; // Flag to track the first slide
                            while (have_rows('score_slider', 'option')) : the_row(); ?>
                                <div class="slide">
                                    <?php if (have_rows('teams_part')) : ?>
                                        <div class="main-team-part d-flex">
                                            <div class="team-first-row d-flex">
                                                <div class="teams-part">
                                                    <?php while (have_rows('teams_part')) : the_row(); ?>
                                                        <div class="team">
                                                            <?php 
                                                                $team = get_sub_field('team'); 
                                                                $team_score = get_sub_field('team_score'); 
                                                                $logo = get_sub_field('logo'); 
                                                            ?>
                                                            <div class="team-logo">
                                                                <?php if ($logo): ?>
                                                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="team-score-number d-flex">
                                                                <p class="team-name"><?php echo esc_html($team); ?></p> 
                                                                <p class="team-score"><?php echo esc_html($team_score); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endwhile; ?>
                                                </div>
                                                <div class="rank">
                                                    <p><?php the_sub_field('match_rank'); ?></p>
                                                </div>
                                            </div>
                                            <div class="inner-team-part d-flex">
                                                <?php
                                                    $match_date = get_sub_field('date');
                                                    $match_time = get_sub_field('time');
                                                    $today = date('d/m/Y');
                                                ?>
                                                <?php if ($first_slide && date('d/m/Y', strtotime($match_date)) == $today) : ?>
                                                    <p class="live-text">live</p>
                                                    <?php $first_slide = false; // Set first slide flag to false after displaying live text ?>
                                                <?php else : ?>
                                                    <p><?php echo esc_html(date('d/m', strtotime($match_date))); ?></p>
                                                <?php endif; ?>
                                                <p><?php echo esc_html($match_time); ?></p>
                                            </div>                    
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
				</div>	
			</div><!-- #masthead -->
		</div>
		<div class="nav-and-social">
				<div class="container">
					<div class="d-flex">
						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
								<?php esc_html_e( '', 'fortless' ); ?>
								<span></span>
								<span></span>
								<span></span>										
							</button>
							<div class="mobile-menu">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu',
									)
								);
								?>
								<div class="search-container-mobile">
									<?php get_search_form(); // WordPress built-in search form ?>					
								</div>
							</div>			
						</nav><!-- #site-navigation -->
						<div class="social-back">	
							<div class="social-icon-part">
								<?php if( have_rows('header_social_media', 'option') ): ?>
										<div class="social-icon d-flex">
											<?php while( have_rows('header_social_media', 'option') ): the_row(); ?>
												<?php 
												$link = get_sub_field('social_media_link');
												if( $link ): ?>
													<a class="social-button" href="<?php echo esc_url( $link ); ?>">
														<?php 
														$image = get_sub_field('social_media_icon');
														if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
													</a>
												<?php endif; ?>
											<?php endwhile; ?>
										</div>
								<?php endif; ?>		
								<div class="search-toggle">
									<button class="search-icon icon-search"><i class="fa fa-fw fa-search"></i></button>
									<button class="search-icon icon-close"><i class="fa fa-fw  fa-close"></i></button>
								</div>
							</div>
						</div>
						<div class="search-container">
							<?php get_search_form(); // WordPress built-in search form ?>						
						</div>
					</div>	
				</div>
		</div>
	</header>
</div>	
