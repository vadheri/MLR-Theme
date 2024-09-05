add_action('wp_ajax_filter_matches', 'filter_matches');
add_action('wp_ajax_nopriv_filter_matches', 'filter_matches');

function filter_matches() {
    $team_option = isset($_POST['team_option']) ? sanitize_text_field($_POST['team_option']) : '';

    ob_start();

    if (have_rows('schedule_match')) :
        while (have_rows('schedule_match')) : the_row();
            if (get_sub_field('team_option') == $team_option || $team_option == '') {

                // Output match details (same as in the displaying section)
                // ...
            }
        endwhile;
    else :
        echo 'No matches found.';
    endif;

    wp_die(ob_get_clean());
}

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-ajax', get_template_directory_uri() . '/js/custom-ajax.js', array('jquery'), null, true);
    wp_localize_script('custom-ajax', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
