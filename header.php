<?php  ?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <!-- from my local changes -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php wp_title('|',TRUE,'right'); bloginfo('name'); ?></title>
<!--    <link rel="shortcut icon" href="/wp-content/uploads/2016/08/cropped-favicon-32x32.png" />-->
</head>
    <?php wp_head(); ?>
    <body <?php body_class(); ?>>
    <header id = "header_bg_color">
        <div class = "header-wrapper">
            <div class = "container"  id="navbar">
            <div class = "row">
              <?php 
                $phone = get_field('phone_number','option');
                $email = get_field('email','option');


              ?>
              <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class = "left-header">
                    <?php if($phone) :
                            echo '<i class="fa fa-phone" aria-hidden="true"></i><a href = "tel:'.$phone.'"> '.$phone.'</a>'; 
                          endif;
                           if($email) :
                            echo ' <i class="fa fa-envelope" aria-hidden="true"></i><a href = "mailto:'.$email.'"> '.$email.'</a>';
                          endif;
                     ?>
                  </div>
              </div>
              <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class = "right-header">
                     
                      <?php if(is_user_logged_in()) {

                          $user_id = get_current_user_id();
                          $user_info = get_user_meta($user_id );


                      $args = array(
                          'post_type' => 'tour_guide',
                          'author'    => $user_id,
                          'posts_per_page' => -1, // Retrieve all posts
                      );

                      $query = new WP_Query( $args );
                          // echo '<pre>';
                          //   print_r($query);
                          // echo '</pre>';
                      $logout_url = wp_logout_url( home_url() );
                          echo '<div class = "container-top-user-menu">';
                                     echo '<i class="fa fa-user" aria-hidden="true"></i> <a href = "#">Hi, '.$user_info['first_name'][0].'</a>';
                                      echo '<ul>';
                                      if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {
                                        $query->the_post();

                                        $permalink = get_permalink(); // Retrieve the post URL
                                        echo '<li><a href = "'.$permalink.'">View Profile</a></li>';
                                    }
                                    
                                    // Restore the original post data
                                    wp_reset_postdata();
                                }
                                     
                                        echo '<li><a href = "/private-message/">Message</a></li>';
                                        echo '<li><a href = "'.$logout_url .'">Sign Out</a></li>';
                                      echo '</ul>';

                          echo '</div>';

                      }else {
                          echo '<a href = "/join-us/" class = "global-button">Sign Up as Local</a>';
                      }?>
                      
                  </div>
              </div>
                 <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class = "logo">
                    <?php 
                      $logo = get_field('logo','option');
                    if (!empty($logo))  : // get_search_form(); ?>
                        <a href = "<?php echo get_home_url(); ?>">
                          <img src = "<?php echo  $logo['url'] ?>"  class = "img-fluid" alt = "<?php echo $logo['alt']; ?>"/>
                        </a>
                  <?php  endif; ?>
                    </div>
                 </div>
          
              
                </div>
                   </div> 
                   <div class = "bar-width">
                       <button id = "mobile-menu">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                         </button>
                        </div>
                         <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                       
                            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                                   <?php    if ( has_nav_menu('header_menu') ) :
                                             wp_nav_menu( array( 'theme_location'  => 'header_menu',
                                                                'container_class' => 'collapse navbar-collapse',
                                                                'container_id'    => 'navbarNavDropdown',
                                                                'menu_class'      => 'navbar-nav ml-auto',
                                                                'walker' => new My_Walker_Nav_Menu()
                                                      ) ); 
                                            endif;  ?> 
                   </nav>

                 
             
                <div>
                <div id="menumobile-data" style="display:none;max-width:100%;">
                <?php    if ( has_nav_menu('header_menu') ) :
                           wp_nav_menu( array( 'theme_location'  => 'header_menu',
                                              'walker' => new My_Walker_Nav_Menu()
                                    ) ); 
                          endif;  ?> 


                          <div class = "footer-mobile">
                              <?php  social_media(); ?>
                          </div>
                </div>
                </div>
    </header>
    