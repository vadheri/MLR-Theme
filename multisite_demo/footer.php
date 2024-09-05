<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package multisite_demo
 */

?>

	<footer id="colophon" class="footer site-footer">
		<div class="main-footer">
			<div class="container">
				<div class="footer-top">
					<div class="site-info d-flex">
						<!-- Sociel Icons -->
						<div class="col-5 left-footer">
							<div class="footer-logo">
								<div class="footer-logo-img">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<img src="http://localhost/multisite_demo/wp-content/uploads/2024/06/footer-logo.png" alt="footer-logo">
									</a>	
								</div>
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
							</div>
							
						</div>
						<div class="col-5 right-footer">
							<!-- Subscribe text -->
							<?php $subscribe_text =  get_field('subscribe_text', 'option'); ?>
							<?php if (!empty($subscribe_text)): ?>
								<div class="subscribe_text">
									<h2><?php echo $subscribe_text; ?></h2>
								</div>
							<?php endif; ?>

							<!-- Subscribe text -->
							<?php $subcribe_sub_text =  get_field('subcribe_sub_text', 'option'); ?>
							<?php if (!empty($subcribe_sub_text)): ?>
								<div class="subcribe-sub-text white-c">
									<p><?php echo $subcribe_sub_text; ?></p>
								</div>
							<?php endif; ?>
							
							<!-- submit form -->
							<div class="form-part">
								<?php echo do_shortcode( '[gravityform id=1 title=false description=false ajax=true]' ); ?>
							</div>
						</div>
					</div><!-- .site-info -->
					<!-- policy part -->
					<div class="policy-part center">
						<div class="policy-link">
							<?php 
							$link = get_field('privacy_link', 'option');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						</div>
						<!-- all right reserved text -->
							<?php $all_right_reserved_text =  get_field('all_right_reserved_text', 'option'); ?>
							<?php if (!empty($all_right_reserved_text)): ?>
								<div class="all-right-reserved">
									<p><?php echo $all_right_reserved_text; ?></p>
								</div>
							<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="powered-by-part center">
					<?php $powered_by_text =  get_field('powered_by_text', 'option'); ?>
					<?php if (!empty($powered_by_text)): ?>
						<div class="powered-by-text">
							<?php echo $powered_by_text; ?>
						</div>
					<?php endif; ?>								
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
