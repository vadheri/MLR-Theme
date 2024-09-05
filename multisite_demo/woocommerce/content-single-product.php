<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @package multisite_demo
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product ) {
    return;
}
?>
<div class="section">
    <div class="container">
        <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'store-item d-flex', $product ); ?>>
            <div class="col-5">
                <div class="image-gallery">
                    <?php
                    $image_gallery = get_field('image_gallery');
                    if ( $image_gallery ) : ?>
                        <div class="gallery-slider">
                            <?php foreach ( $image_gallery as $gallery_item ) :
                                $image = $gallery_item['image'];
                                if ( $image ) : ?>
                                    <div class="zoomable gallery-item" data-scale="1.2">
                                        <a href="<?php echo esc_url( $image['url'] ); ?>" title="<?php echo esc_attr( $image['alt'] ); ?>">
                                            <img class="zoomable__img product-image" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="thumbnails-slider">
                            <?php foreach ( $image_gallery as $gallery_item ) :
                                $image = $gallery_item['image'];
                                if ( $image ) : ?>
                                    <div class="thumbnail-item">
                                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else :
                        // If there's no custom image gallery, use the default WooCommerce gallery
                        woocommerce_show_product_images();
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-5">
                <div class="section-title">
                    <?php 
                    $product_title = get_field("product_title");
                    if ( $product_title ) : ?>
                        <h2><?php echo esc_html( $product_title ); ?></h2>
                    <?php else : ?>
                        <h2><?php the_title(); ?></h2>
                    <?php endif; ?>
                </div>
                <div class="price-part">
                    <?php
                    $prize = get_field('prize');
                    if ( $prize ) : ?>
                        <h3><?php echo esc_html( $prize ); ?></h3>
                    <?php else :
                        // Default WooCommerce price
                        woocommerce_template_single_price();
                    endif;
                    ?>
                </div>
                <div class="product-description">
                    <p><?php echo $product->get_description(); ?></p>
                </div>
                <?php
                $product_sub_title = get_field('product_sub_title');
                if ( $product_sub_title ) : ?>
                    <p class="product-sub-title"><?php echo esc_html( $product_sub_title ); ?></p>
                <?php endif; ?>

                <?php
                $product_details = get_field('product_details');
                if ( $product_details ) : ?>
                    <div class="product-details">
                        <?php echo wp_kses_post( $product_details ); ?>
                    </div>
                <?php else :
                    // Default WooCommerce short description
                    woocommerce_template_single_excerpt();
                endif;
                ?>
                <div class="size-category">    
                    <h3>Sizes</h3>    
                    <?php
                    $terms = get_the_terms( get_the_ID(), 'product-size' );
                    if ( $terms && ! is_wp_error( $terms ) ) : ?>
                        <ul class="store-categories d-flex">
                            <?php foreach ( $terms as $term ) : ?>
                                <li><?php echo esc_html( $term->name ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else :
                        // If there's no custom sizes taxonomy, WooCommerce may display its categories instead
                        woocommerce_template_single_meta();
                    endif;
                    ?>
                </div>
                <div class="product-button-main">
                    <?php
                    $link = get_field('button');
                    if ( $link ) : 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php else :
                        // WooCommerce default add to cart button
                        woocommerce_template_single_add_to_cart();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>