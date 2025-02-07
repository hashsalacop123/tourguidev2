<?php 
function edit_profile_colum_two() {
    $tourguide_id = get_the_ID();
    ob_start(); // start output buffering
    acf_form(
        array(
            'post_id' => $tourguide_id,
            'post_title' => false,
            'fields' => array('places','age','hourly_rate_range','about_tour_guide', 'gallery', 'skills', 'languages', 'education'),
            'submit_value' => 'Save',
            'html_submit_button'  => '<button type="submit" class="global-button acf-form-submit">%s</button>',
            'html_updated_message' => '<div class="acf-notice">%s</div>',
            'return' => false,
        )
    );
    ob_end_flush();
}

add_filter('acf/load_field/name=places', 'modify_places_field');

function modify_places_field($field) {
    // Get the taxonomy terms for the "places" taxonomy
    $terms = get_terms(array(
        'taxonomy' => 'places',
        'hide_empty' => false,
    ));

    // Modify the "choices" setting of the "places" field
    $field['choices'] = array();
    foreach ($terms as $term) {
        $field['choices'][$term->term_id] = $term->name;
    }

    return $field;
}

function edit_profile_colum_one() {
    $tourguide_id = get_the_ID();
        ob_start(); // start output buffering
             acf_form(array(
                    'post_id'       => 'user_' . get_current_user_id(),
                    'field_groups'  => array('group_6434d459270c5'),
                    'return'        => add_query_arg('updated', 'true', get_permalink()),
                    'submit_value'  => 'Update Profile',
                    'html_submit_button'  => '<button type="submit" class="global-button acf-form-submit">%s</button>',
                    'html_updated_message' => '<div class="acf-notice">%s</div>',
                    'fields'        => array('first_name', 'last_name','short_description_','cover_photo', 'user_profile', 'short_description', 'cellphone_number', 'email', 'address', 'facebook', 'twitter', 'instagram', 'youtube'),
                    'uploader'      => 'wp', // Change this to 'basic' if you want to use the basic uploader instead of the WP media uploader.
                ));

        ob_end_flush();
}

