<?php 
//THIS THE FUCNTION OR API THAT SUPPORT ON THE BLANK TEMP
function theme_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( 'font-awesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'bootstrap.min', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css' );
    wp_enqueue_style( 'roboto-font', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' );
     //=============SLICK=========C:\Users\Administrator\Local Sites\goph\app\public\wp-content\themes\tourguidethemes\api-blocks\social-share-kit-1.0.14
     //
    wp_enqueue_style( 'social-share-kit', get_template_directory_uri() . '/api-blocks/social-share-kit-1.0.14/dist/css/social-share-kit.css' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/api-blocks/slick/slick/slick.css' );
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/api-blocks/slick/slick/slick-theme.css' );
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
        if ( is_singular( 'tour_guide' ) || is_tax( 'places' ) ) :
            if(is_singular( 'tour_guide' )) :
              wp_enqueue_style( 'user-dashboard.css', get_template_directory_uri() . '/css/user-dashboard.css' );
            endif;
       
        endif;
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/api-blocks/fancyapps/fancybox.css');
    wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css' );
    //=============FANCYBOX=========    
    //

    wp_register_script('ajaxscripts', get_template_directory_uri() . '/js/ajaxscripts.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ajaxscripts');
    
    wp_localize_script('ajaxscripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
     wp_enqueue_script('jquery');
     wp_enqueue_script( 'bootstrap.min.js','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array( 'jquery' ));

       wp_enqueue_script('jquery-ui-autocomplete');


     //====SLICK JS=====
      wp_enqueue_script( 'social-share-kit.min.js',get_stylesheet_directory_uri() . '/api-blocks/social-share-kit-1.0.14/dist/js/social-share-kit.min.js');
      wp_enqueue_script( 'slick.min.js',get_stylesheet_directory_uri() . '/api-blocks/slick/slick/slick.min.js', array( 'jquery' ));
    //=============FANCYBOX=========
    wp_enqueue_script('fancybox.umd',get_stylesheet_directory_uri() . '/api-blocks/fancyapps/fancybox.umd.js', array( 'jquery' ));  
         if ( is_singular( 'tour_guide' ) || is_tax( 'places' )) : 
             wp_enqueue_script( 'tourguide.js',get_stylesheet_directory_uri() . '/js/tourguide.js', array( 'jquery' ));
             wp_enqueue_script( 'message.js',get_stylesheet_directory_uri() . '/js/message.js', array( 'jquery' ));
             wp_localize_script( 'tourguide.js', 'tourguide_data', array(
                'theme_directory_uri' => get_stylesheet_directory_uri(),
              ) );
         endif;
     wp_enqueue_script( 'jquery-scripts.js',get_stylesheet_directory_uri() . '/js/jquery-scripts.js', array( 'jquery' ));

    }
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
