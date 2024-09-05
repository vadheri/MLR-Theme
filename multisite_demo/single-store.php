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

	<main id="primary" class="section site-main">
		<div class="container">
			<?php
			if (have_posts()) : while (have_posts()) : the_post();
				$prize = get_field('prize');
				$image_gallery = get_field('image_gallery');
				$product_sub_title = get_field('product_sub_title');
				$product_details = get_field('product_details');
				?>
				<div class="store-item d-flex">
					<div class="col-5">
						<div class="image-gallery">
							<?php if ($image_gallery) : ?>
								<div class="gallery-slider">
									<?php foreach ($image_gallery as $gallery_item) : ?>
										<?php $image = $gallery_item['image']; ?>
										<?php if ($image) : ?>
											<div class="zoomable gallery-item" data-scale="1.2">
												<a href="<?php echo esc_url($image['url']); ?>" title="<?php echo esc_attr($image['alt']); ?>">
													<img class="zoomable__img product-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
												</a>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
								<div class="thumbnails-slider">
									<?php foreach ($image_gallery as $gallery_item) : ?>
										<?php $image = $gallery_item['image']; ?>
										<?php if ($image) : ?>
											<div class="thumbnail-item">
												<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-5">
						<div class="section-title">
						<?php 
						$product_title = get_field("product_title"); 
						if ($product_title) : ?>
							<div class="section-title">
								<h2><?php echo esc_html($product_title); ?></h2>
							</div>
						<?php else : ?>
							<div class="section-title">
								<h2><?php the_title();?></h2>
							</div>
						<?php endif; ?>
						<div class="prize">
							<?php if ($prize) : ?>
								<h3><?php echo esc_html($prize); ?></h3>
							<?php endif; ?>
						</div>
						<?php if ($product_sub_title) : ?>
							<p class="product-sub-title"><?php echo esc_html($product_sub_title); ?></p>
						<?php endif; ?>
						<?php if ($product_details) : ?>
							<div class="product-details">
								<?php echo wp_kses_post($product_details); ?>
							</div>
						<?php endif; ?>
						<div class="size-category">	
							<?php
							$terms = get_the_terms( get_the_ID(), 'product-size' );
							if ( $terms && ! is_wp_error( $terms ) ) : ?>
								<h3>Sizes</h3>	
								<ul class="store-categories d-flex">
									<?php foreach ( $terms as $term ) : ?>
										<li><?php echo esc_html( $term->name ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
						<div class="button-main">
							<?php 
							$link = get_field('button');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>

			<?php endwhile; endif; ?>
		</div>
	</main>
	
<?php
get_sidebar();
get_footer();
