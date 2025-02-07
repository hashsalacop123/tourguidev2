<?php 
// Register Tour Guide custom post type
function register_tour_guide_post_type() {
  $labels = array(
    'name'                  => _x( 'Tour Guides', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Tour Guide', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Tour Guides', 'text_domain' ),
    'name_admin_bar'        => __( 'Tour Guide', 'text_domain' ),
    'archives'              => __( 'Tour Guide Archives', 'text_domain' ),
    'attributes'            => __( 'Tour Guide Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Tour Guide:', 'text_domain' ),
    'all_items'             => __( 'All Tour Guides', 'text_domain' ),
    'add_new_item'          => __( 'Add New Tour Guide', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Tour Guide', 'text_domain' ),
    'edit_item'             => __( 'Edit Tour Guide', 'text_domain' ),
    'update_item'           => __( 'Update Tour Guide', 'text_domain' ),
    'view_item'             => __( 'View Tour Guide', 'text_domain' ),
    'view_items'            => __( 'View Tour Guides', 'text_domain' ),
    'search_items'          => __( 'Search Tour Guides', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into Tour Guide', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Tour Guide', 'text_domain' ),
    'items_list'            => __( 'Tour Guides list', 'text_domain' ),
    'items_list_navigation' => __( 'Tour Guides list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter Tour Guides list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Tour Guide', 'text_domain' ),
    'description'           => __( 'Tour Guide Description', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions','author' ),
    'taxonomies'            => array( 'places' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-location-alt',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite' => array( 'slug' => 'tour-guide' )
  );
  register_post_type( 'tour_guide', $args );
}
add_action( 'init', 'register_tour_guide_post_type', 0 );

// Register Places taxonomy
function register_places_taxonomy() {
  $labels = array(
    'name'                       => _x( 'Places', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Place', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Places', 'text_domain' ),
    'all_items'                  => __( 'All Places', 'text_domain' ),
    'parent_item'                => __( 'Parent Place', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Place:', 'text_domain' ),
    'new_item_name'              => __( 'New Place Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Place', 'text_domain' ),
    'edit_item'                  => __( 'Edit Place', 'text_domain' ),
    'update_item'                => __( 'Update Place', 'text_domain' ),
    'view_item'                  => __( 'View Place', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate Places with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove Places', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Places', 'text_domain' ),
    'search_items'               => __( 'Search Places', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No Places', 'text_domain' ),
    'items_list'                 => __( 'Places list', 'text_domain' ),
    'items_list_navigation'      => __( 'Places list navigation', 'text_domain' ),

  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'places', array( 'tour_guide' ), $args );
}
add_action( 'init', 'register_places_taxonomy', 0 );