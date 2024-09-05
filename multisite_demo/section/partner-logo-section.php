<?php if (get_row_layout() == 'partner_logo_section') : 
if(get_sub_field('section_enabledisable') == 'enable'){
    $title = get_sub_field('title');
    $text_align = get_sub_field('text_align');
    $section_spacing = get_sub_field('section_spacing');
    $color = get_sub_field('color');
    $background_style = get_sub_field('background_style');
    $main_heading_tag_list = get_sub_field('main_heading_tag_list');
    $partner_logo_list = get_sub_field('partner_logo_list');
    ?>
    <section class="section pertner-logo-section <?php echo esc_attr($section_spacing); ?>">
        <div class="container">
            <div class="logo-container">
                <?php if ($title): ?>
                    <h3 class="<?php echo esc_attr($text_align); ?>"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <!-- Display the Partner Logo List -->
                <?php if ($partner_logo_list): ?>
                    <div class="partner-logo-list d-flex">
                        <?php foreach ($partner_logo_list as $logo_item):
                            $link = $logo_item['link'];
                            $logo_image = $logo_item['logo_image'];
                            if ($logo_image):
                                $logo_url = $logo_image['url'];
                                $logo_alt = $logo_image['alt'];
                                $logo_width = $logo_image['width'];
                                $logo_height = $logo_image['height'];
                            ?>
                                <a href="<?php echo esc_url($link); ?>">
                                    <div class="partner-logo">
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>" width="<?php echo esc_attr($logo_width); ?>" height="<?php echo esc_attr($logo_height); ?>">
                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php } endif; ?>
