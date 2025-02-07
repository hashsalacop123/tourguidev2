<?php 
function custom_login_form_shortcode() {
    // Check if user is already logged in
    if (is_user_logged_in()) {
        return 'You are already logged in.';
    }
    // Output custom login form HTML code
    ob_start(); ?>

    <div class="custom-login-form">
        <!-- Your custom login form HTML code here -->
        <form action="<?php echo esc_url(wp_login_url()); ?>" method="post">
             <div class="form-group">
                <label for="user_login">Username</label>
                <input class="form-control" type="text" name="log" id="user_login">
                <label for="user_pass">Password</label>
                <input class="form-control" type="password" name="pwd" id="user_pass">
                <?php
                // Check if the user has a tour_guide custom post type
                $tour_guide_posts = get_posts(array(
                    'post_type' => 'tour_guide',
                    'author' => get_current_user_id(),
                    'posts_per_page' => 1
                ));
                if (count($tour_guide_posts) > 0) {
                    // Get the URL of the user's tour_guide custom post type
                    $tour_guide_url = get_permalink($tour_guide_posts[0]);
                    // Add a hidden input field with the tour_guide URL as the value
                    echo '<input type="hidden" name="redirect_to" value="' . esc_url($tour_guide_url) . '">';
                } else {
                    // Otherwise, redirect the user to the tour_guide custom post type archive page
                    $tour_guide_archive_url = get_post_type_archive_link('tour_guide');
                    echo '<input type="hidden" name="redirect_to" value="' . esc_url($tour_guide_archive_url) . '">';
                }
                ?>
                <input type="submit" class="global-button" value="Login">
             </div>
        </form>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('custom_login_form', 'custom_login_form_shortcode');

// Redirect the user to their own tour guide custom post type account page after login
function custom_login_redirect_to_tour_guide_account( $redirect_to, $request, $user ) {
    if ( !is_wp_error($user) && is_a($user, 'WP_User') ) {
        $tour_guide_posts = get_posts(array(
            'post_type' => 'tour_guide',
            'author' => $user->ID,
            'posts_per_page' => 1
        ));
        if (count($tour_guide_posts) > 0) {
            // Get the URL of the user's tour_guide custom post type
            $tour_guide_url = get_permalink($tour_guide_posts[0]);
            // Redirect to the user's tour_guide custom post type account page
            return $tour_guide_url;
        }
    }
    // Otherwise, redirect to the tour_guide custom post type archive page
    $tour_guide_archive_url = get_post_type_archive_link('tour_guide');
    return $tour_guide_archive_url;
}
add_filter('login_redirect', 'custom_login_redirect_to_tour_guide_account', 10, 3);


// Custom registration form shortcode
function custom_registration_form() {
    // Check if user is already logged in
    if (is_user_logged_in()) {
        return 'You are already registered and logged in.';
    }

    // Output custom registration form HTML code
    ob_start(); ?>

    <div class="custom-registration-form">
        <!-- Your custom registration form HTML code here -->
        <form action="<?php echo esc_url(wp_registration_url()); ?>" method="post" enctype="multipart/form-data">
             <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" required>
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" required>
                    <label for="user_login">Username</label>
                    <input type="text" class="form-control" name="user_login" id="user_login" required>
                    <label for="user_email">Email</label>
                    <input type="email" class="form-control" name="user_email" id="user_email" required>
                    <label for="valid_id">Any of two Valid ID <span class = "validid">(UMID, Driver License, PRC ID, Passport, Senior Citizen ID, SSS ID, <a href = "https://www.gsis.gov.ph/ginhawa-for-all/list-of-acceptable-valid-ids/" target = "_blank">List of Valid ID<a>)</span></label>
                    <input type="file" class="form-control" name="valid_id" id="valid_id" required>
                    <br>
                    <input type="file" class="form-control" name="valid_id_2" id="valid_id_2" required>
                    <input type="submit" class = "global-button" value="Register">
             </div>
        </form>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('custom_registration_form', 'custom_registration_form');

function custom_registration_submit($user_id) {
    // Get user data from registration form
    $username = $_POST['user_login'];
    $email = $_POST['user_email'];
    $valid_id = $_FILES['valid_id'];
    $valid_id_2 = $_FILES['valid_id_2'];

    // Check if the valid_id file is uploaded
    if (!empty($valid_id['tmp_name'])) {
        // Load the necessary WordPress file functions
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Process uploaded image file for valid_id field
        $upload_overrides = array('test_form' => false); // Allow upload of any file type

        // Upload the file
        $uploaded_file = wp_handle_upload($valid_id, $upload_overrides);

        if ($uploaded_file && !isset($uploaded_file['error'])) {
            $image_url = $uploaded_file['url'];
            $image_file = $uploaded_file['file'];
            $image_type = $uploaded_file['type'];

            // Create an attachment for the uploaded image
            $attachment = array(
                'post_mime_type' => $image_type,
                'post_title' => sanitize_file_name($valid_id['name']),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            // Insert the attachment into the media library
            $attachment_id = wp_insert_attachment($attachment, $image_file, 0);

            // Update the attachment metadata
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $image_file);
            wp_update_attachment_metadata($attachment_id, $attachment_data);

            // Update the ACF field with the attachment ID
            update_field('valid_id', $attachment_id, 'user_' . $user_id);

            // Set the attachment as the user's profile picture (optional)
            update_user_meta($user_id, 'profile_picture', $attachment_id);
        }
    }
    if (!empty($valid_id_2['tmp_name'])) {
        // Load the necessary WordPress file functions
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Process uploaded image file for valid_id_2 field
        $upload_overrides = array('test_form' => false); // Allow upload of any file type

        // Upload the file
        $uploaded_file = wp_handle_upload($valid_id_2, $upload_overrides);

        if ($uploaded_file && !isset($uploaded_file['error'])) {
            $image_url = $uploaded_file['url'];
            $image_file = $uploaded_file['file'];
            $image_type = $uploaded_file['type'];

            // Create an attachment for the uploaded image
            $attachment = array(
                'post_mime_type' => $image_type,
                'post_title' => sanitize_file_name($valid_id_2['name']),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            // Insert the attachment into the media library
            $attachment_id = wp_insert_attachment($attachment, $image_file, 0);

            // Update the attachment metadata
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $image_file);
            wp_update_attachment_metadata($attachment_id, $attachment_data);

            // Update the ACF field with the attachment ID
            update_field('valid_id_2', $attachment_id, 'user_' . $user_id);

            // Set the attachment as the user's profile picture (optional)
            update_user_meta($user_id, 'profile_picture', $attachment_id);
        }
    }

    // Update user role to empty (no role assigned)
    $update_user = wp_update_user(array(
        'ID' => $user_id,
        'role' => ''
    ));

    // Update user meta with first name and last name
    update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
    update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));

    // Send email notification to the registered user
    $to = $email;
    $subject = 'Thank you for registering';
    $message = 'Thank you for registering. Your application will be reviewed within 24 hours.';
    $headers = 'From: Your Site <noreply@yoursite.com>' . "\r\n";
    wp_mail($to, $subject, $message, $headers);

    // Redirect to the registration success page
    wp_redirect(home_url('/registration-success/'));
    exit;
}
add_action('user_register', 'custom_registration_submit', 10, 1);

function create_tour_guide_page_on_user_role_change($user_id, $new_role, $old_role) {
    // Get current user's ID
    $current_user_id = get_current_user_id();

    // Check if the user role is changed to "subscriber" and if the current user is an administrator
    if ($new_role === 'subscriber' && $old_role !== 'subscriber' && user_can($current_user_id, 'administrator')) {
        // Get user data
        $user_data = get_userdata($user_id);

        // Get user first name and last name
        $first_name = $user_data->first_name;
        $last_name = $user_data->last_name;

        // Generate the tour guide page title with full name
        $title = $first_name . ' ' . $last_name;

        // Prepare the tour guide post data
        $post_data = array(
            'post_title' => $title,
            'post_status' => 'publish',
            'post_type' => 'tour_guide'
        );

        // Insert the tour guide post
        $post_id = wp_insert_post($post_data);

        // Update the tour guide post author to the current user
        wp_update_post(array(
            'ID' => $post_id,
            'post_author' => $user_id
        ));

        // Generate a new random password for the user
        $new_password = wp_generate_password();

        // Set the new password for the user
        wp_set_password($new_password, $user_id);

        // Send email notification to the user
        $to = $user_data->user_email;
        $subject = 'Congratulations! Your Tour Guide application has been approved.';
        $message = '<html><body>';
        $message .= '<h2>Dear ' . $first_name . ' ' . $last_name . ',</h2>';
        $message .= '<p>Congratulations! Your Tour Guide application has been approved. You can now view your Tour Guide page with the title "' . $title . '".</p>';
        $message .= '<p>"You can now login in this link using your username and password <a href = "'.site_url('/join-us/').'">Login Here</a>".</p>';
        $message .= '<p>Your username is: ' . $user_data->user_email . '</p>';
        $message .= '<p>Your password is: ' . $new_password . '</p>';
        $message .= '<p>Please make sure to change your password after logging in for the first time.</p>';
        $message .= '<p>Thank you for your interest in becoming a Tour Guide.</p>';
        $message .= '<p>Best regards,<br>Your Site Team</p>';
        $message .= '</body></html>';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $message, $headers);
    }
}
add_action('set_user_role', 'create_tour_guide_page_on_user_role_change', 10, 3);

// Add custom column to user list table
function custom_user_columns($columns) {
    $columns['user_status'] = 'User Status';
    return $columns;
}
add_filter('manage_users_columns', 'custom_user_columns');

// Display user status in custom column
function custom_user_column_content($value, $column_name, $user_id) {
    if ($column_name === 'user_status') {
        $user = get_user_by('ID', $user_id);
        $user_role = reset($user->roles);

        if (empty($user_role)) {
            $value = '<p style = "color:red;font-weight:bold;">Pending</p>';
        } else {
            $value = '<p style = "color:green;font-weight:bold;">Approved</p>';
        }
    }
    return $value;
}
add_filter('manage_users_custom_column', 'custom_user_column_content', 10, 3);

// Make custom column sortable
function custom_user_column_sortable($columns) {
    $columns['user_status'] = 'user_status';
    return $columns;
}
add_filter('manage_users_sortable_columns', 'custom_user_column_sortable');

// Define custom column as sortable
function custom_user_column_orderby($query) {
    if (isset($query->query['orderby']) && $query->query['orderby'] === 'user_status') {
        $query->set('meta_key', 'wp_capabilities');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_users', 'custom_user_column_orderby');

// THE IMAGES SETTINGS SIZES
add_image_size( 'conver_photo_user', 1439, 357,true );
add_image_size( 'user_profile', 308, 308, true );
add_image_size( 'tax_featured', 800, 450, true );
add_image_size( 'tax_gallery', 500, 300, true );
add_image_size( 'image_track', 300, 450, true );
add_image_size( 'tour_guide_sm', 90, 90, true );
add_image_size( 'slider_banner', 1440, 577, true );
add_image_size( 'blog_image', 300, 188, true );
   // if (!headers_sent()) {
// Add this code to your theme's functions.php or custom plugin file



function tour_guide_review_box() {
    // Check if we are on a single tour_guide post
    if (is_singular('tour_guide')) {
        // Check if the user has already submitted a review
        $user_id = get_current_user_id();
        $existing_comment = get_comments(array(
            'post_type' => 'tour_guide',
            'user_id' => $user_id,
            'status' => 'approve',
        ));

        if (!empty($existing_comment)) {
            // User has already submitted a review
            echo '<div class="tour-guide-review-box">';
            echo '<p>You have already submitted a review for this tour guide.</p>';
            echo '</div>';
            return; // Stop further execution of the function
        }

        // Output the review/comment box HTML
        $output = '<div class="tour-guide-review-box">';
        $output .= '<h2>Leave a Review</h2>';

        if (isset($_POST['submit_tour_guide_review']) && wp_verify_nonce($_POST['tour_guide_review_nonce'], 'submit_tour_guide_review')) {
            // Form submitted, process the review
            $tour_guide_id = $_POST['tour_guide_id'];
            $review_name = sanitize_text_field($_POST['review_name']);
            $review_email = sanitize_email($_POST['review_email']);
            $review_text = wp_kses_post($_POST['review_text']);
            $review_rating = intval($_POST['review_rating']);

            // Insert the comment
            $commentdata = array(
                'comment_post_ID' => $tour_guide_id,
                'comment_author' => $review_name,
                'comment_author_email' => $review_email,
                'comment_content' => $review_text,
                'comment_type' => 'tour_guide_review',
                'comment_meta' => array(
                    'rating' => $review_rating,
                    'user_id' => $user_id
                ),
            );
            $comment_id = wp_insert_comment($commentdata);

            if (!is_wp_error($comment_id)) {
                echo '<div class="tour-guide-review-box">';
                echo 'Review submitted successfully.';
                echo '</div>';
                return; // Stop further execution of the function
            } else {
                $output .= '<p>Error submitting the review.</p>';
            }
        }
        $output .= '<form action="" method="post">';
        $output .= '<div class="form-group">';
        $output .= '<input type="hidden" name="submit_tour_guide_review" value="1">';
        $output .= '<input type="hidden" name="tour_guide_id" value="' . get_the_ID() . '">';
        $output .= '<label for="review_name">Name</label>';
        $output .= '<input type="text" class="form-control" id="review_name" name="review_name" required>';
        $output .= '<label for="review_email">Email</label>';
        $output .= '<input type="email" class="form-control" id="review_email" name="review_email" required>';
        $output .= '<label for="review_text">Your Review</label>';
        $output .= '<textarea id="review_text" class="form-control" name="review_text" required></textarea>';
        $output .= '<label for="review_rating">Rating</label>';
        $output .= '<select id="review_rating" class="form-control" name="review_rating" required>';
        $output .= '<option value="">Select a Rating</option>';
        $output .= '<option value="5">5 Stars</option>';
        $output .= '<option value="4">4 Stars</option>';
        $output .= '<option value="3">3 Stars</option>';
        $output .= '<option value="2">2 Stars</option>';
        $output .= '<option value="1">1 Star</option>';
        $output .= '</select>';
        $output .= wp_nonce_field('submit_tour_guide_review', 'tour_guide_review_nonce', true, false);
        $output .= '<br>';
        $output .= '<button type="submit" class="global-button">Submit Review</button>';
        $output .= '</div>';
        $output .= '</form>';
        $output .= '</div>';

        echo $output;
    }
}



       


function is_author_logged_in() {
    $current_user = wp_get_current_user(); // Get the current user
    if ( $current_user->ID && $current_user->ID == get_the_author_meta( 'ID' ) ) {
        return true; // User is logged in and is the author of the post
    } else {
        return false; // User is not logged in or is not the author of the post
    }
}
?>