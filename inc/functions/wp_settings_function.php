<?php 
//=============SUPPORT OF THE  THEME MENUS==========
    add_action( 'after_setup_theme', 'my_setup' );
     if ( ! function_exists( 'my_setup' ) ) {
      function my_setup() {
       if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
        add_theme_support( 'post-thumbnails' );
       }

       add_theme_support( 'menus' );

       if ( function_exists( 'register_nav_menus' ) ) {
        register_nav_menus(
         array(
           'header_menu' => 'Header Menu',
           'footer_menu' => 'Footer Menu'
         )
        );
       }   
      }
     }
//=============SUPPORT OF THE THEME WIDGETS==========
    function arphabet_widgets_init() {
        register_sidebar( array(
            'name'          => 'Left footer',
            'id'            => 'home_right_1',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="rounded">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name'          => 'Right footer',
            'id'            => 'home_right_2',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="rounded">',
            'after_title'   => '</h2>',
        ) );
    }
    add_action( 'widgets_init', 'arphabet_widgets_init' );

    // MENU CLASS


class My_Walker_Nav_Menu extends Walker_Nav_Menu {
   function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"my-hash-menu \">\n";
  }
}

function add_menuclass($ulclass) {
   return preg_replace('/<a /', '<a class="nav-link "', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');


if ( ! function_exists( 'post_pagination' ) ) :
   function post_pagination() {
     global $wp_query;
     $pager = 999999999; // need an unlikely integer
 
        echo paginate_links( array(
             'base' => str_replace( $pager, '%#%', esc_url( get_pagenum_link( $pager ) ) ),
             'format' => '?paged=%#%',
             'current' => max( 1, get_query_var('paged') ),
             'total' => $wp_query->max_num_pages
        ) );
   }
endif;
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));   
}

function save_review_form_data() {
    if (isset($_POST['submit_review'])) {
        $email = sanitize_email($_POST['email']);
        $comment_name = sanitize_text_field($_POST['comment_name']);
        $message = sanitize_textarea_field($_POST['message']);
        $review = sanitize_text_field($_POST['review']);

        // Update the post meta using WordPress update_post_meta() function
        update_post_meta(get_queried_object_id(), 'email', $email);
        update_post_meta(get_queried_object_id(), 'comment_name', $comment_name);
        update_post_meta(get_queried_object_id(), 'message', $message);
        update_post_meta(get_queried_object_id(), 'review', $review);

        // Optionally, you can perform additional validation or processing here

        // Redirect or display a success message
        wp_redirect(get_permalink());
        exit;
    }
}

// Hook the save_review_form_data function to the 'init' action
add_action('init', 'save_review_form_data');


function get_tour_guide_average_rating($tour_guide_id) {
    $comments = get_comments(array(
        'post_type' => 'tour_guide',
        'post_id' => $tour_guide_id,
        'status' => 'approve',
        'meta_key' => 'rating',
    ));

    $total_ratings = 0;
    $rating_count = 0;

    foreach ($comments as $comment) {
        $rating = get_comment_meta($comment->comment_ID, 'rating', true);
        if ($rating) {
            $total_ratings += intval($rating);
            $rating_count++;
        }
    }

    if ($rating_count > 0) {
        $average_rating = round($total_ratings / $rating_count, 1);
        return $average_rating;
    }

    return 0;
}




// Create AJAX callback function for handling the auto-suggest request
function auto_suggest_callback() {
    $term = sanitize_text_field($_GET['term']);
    
    // Query the places taxonomy for matching terms
    $args = array(
        'hide_empty' => false,
        'taxonomy' => 'places',
        'name__like' => $term,
    );
    
    $terms = get_terms($args);
    
    $suggestions = array();
    
    if ($terms) {
        foreach ($terms as $term) {
            $suggestions[] = array(
                'label' => $term->name,
                'value' => $term->name,
            );
        }
    }
    
    wp_send_json($suggestions);
}
add_action('wp_ajax_auto_suggest', 'auto_suggest_callback');
add_action('wp_ajax_nopriv_auto_suggest', 'auto_suggest_callback');


add_post_type_support( 'page', 'excerpt' );


// functions.php

// Add custom rewrite rules for the "places" URL structure
function custom_rewrite_rules() {
    add_rewrite_rule(
        '^places/([^/]+)/?$',
        'index.php?taxonomy=places&term=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_rewrite_rules');

// Flush rewrite rules on theme activation (run it once, then you can remove it)
function flush_rewrite_rules_on_activation() {
    custom_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'flush_rewrite_rules_on_activation');
function custom_rewrite_rule() {
    add_rewrite_rule('^places/([^/]*)/?','index.php?s=$matches[1]&taxonomy=places&search-guide=Search','top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);

function change_search_url() {
    if (is_search() && !empty($_GET['s'])) {
        wp_redirect(home_url("/places/" . urlencode(get_query_var('s')) . "/"));
        exit();
    }
}
add_action('template_redirect', 'change_search_url');
function disable_admin_bar_for_users() {
    if (is_user_logged_in()) {
        show_admin_bar(false);
    }
}
add_filter('show_admin_bar', 'disable_admin_bar_for_users');