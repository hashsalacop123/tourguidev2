<?php 

// YOU CAN RE USE THIS FUNCTION IN ANY OF THE PAGE
function loop_tour_guide_() {
  global $args; 

    $query = new WP_Query($args);


      $have_posts = $query->have_posts();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <div class = "col-xl-6 col-lg-6 col-md-12 col-sm-12 wrapper-tour-guide">
                <div class = "row tour-wrapper-row ">
                    <div class = "col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xm col-4 tour-pusers">
                        <?php     

                         $post_id = get_the_ID();


                         $comment_count = get_comments_number($post_id);

                            //GET THE FIRST TERMS
                            $post_tour_guide_id = get_the_ID();
                            $taxonomy = 'places';
                            $terms = get_the_terms($post_tour_guide_id, $taxonomy);


                            //description
                            //
                            $tour_guide_id = get_the_author_meta("ID");
                             $user_data = get_userdata($tour_guide_id);
                             $short_desc = get_field("short_description_", "user_" . $tour_guide_id);
                            if (!empty($short_desc)) {
                                $removned = strip_tags($short_desc);
                                $short_desc2 = wp_trim_words($removned , 20, '...' );

                                $short_des = '<p class="shrt_dsc">"' . $short_desc2 . '"</p>';
                            } else {
                                $short_des = '<p class="none">N/A</p>';
                            }

                            $star = get_template_directory_uri() . "/img/star-filled.png";

                             $profile_tour_id = get_the_ID();
                             $tour_guide_id = get_the_author_meta("ID");
                             $user_data = get_userdata($tour_guide_id);
                             $userprofile = get_field("user_profile", "user_" . $tour_guide_id);
                                    if (!empty($userprofile)) {
                                             $userpf = $userprofile["sizes"]["image_track"];
                                        } else {
                                            $userpf = get_template_directory_uri() . "/img/profile.jpg";
                                         }
                                echo '<div class = "div-wrapper">';
                                echo '<a href = "'.get_the_permalink().'"><img src="' . $userpf . '" alt="user-profile" class = "img-fluid "></a>'; 
                                echo '</div>';
                            ?>
                       
                    </div>
         

                    <div class = "col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 right-side-tour">
                        <div class = "right-side-wrapper">
                       <div class = "tp-header">
                 <?php
                            $hourly_rate_range = get_field('hourly_rate_range');
                                        $rate = '';
                                         if($hourly_rate_range) {
                                            $rate = '$'.$hourly_rate_range.'/hr';

                                        }else {
                                            $rate = 'FREE';
                                        }
                                      
       
                        echo '<ul>';
                                echo '<li> <h6>'.$first_name = $user_data->first_name.'</h6>';
                                    if ($terms && !is_wp_error($terms)) {
                                            $first_term = reset($terms);
                                            $first_term_name = $first_term->name;
                                            echo '<p class = "loc">'.$first_term_name.', Philippines</p>';;
                                        }
                                echo '</li>';
                                echo '<li class = "range">'.$rate.'</li>';
                        echo '</ul>';
                        echo '<div class = "clearfix"></div>';
                        echo  '</div>';
                        echo '<hr>';
                        echo '<div class = "tp-body">';
                                echo '<i class="fa fa-quote-left" aria-hidden="true"></i> ' . $short_des . '<i class="fa fa-quote-right" aria-hidden="true"></i>';
                        echo '</div>';
                        
                          echo '<div class = "clearfix"></div>';
                          echo '<hr>';
                        ?>
                        <div class = "tp-footer">

                            <ul>
                                <li><p class = "tour-review">Reviews</p>
                                    <p class = "tr-number"><?php echo $comment_count; ?></li></li>
                                <li>
                                        <img src="<?php echo  $star; ?>" alt="star"/>
                                        <img src="<?php echo  $star; ?>" alt="star"/>
                                        <img src="<?php echo  $star; ?>" alt="star"/>
                                        <img src="<?php echo  $star; ?>" alt="star"/>
                                        <img src="<?php echo  $star; ?>" alt="star"/>
                                </li>
                            </ul>
                        </div>
                        <div class = "clearfix"></div>
                  </div>
                  </div>
                </div>
            </div>
            <?php
        }

        wp_reset_postdata();
    } else {
    //     // No posts found for the current term
 
     }
}


function basic_loop() {

  echo 'testing';
}

function blog_slider() {
?>

    <div class = "latest-news">
        <div class = "container">


            <h3>Latest News</h3>
            <?php                              
                        $the_query = new WP_Query( array(
                            'post_type'     => 'post',
                            'post_status'   => 'publish',
                            'orderby'      => 'post_date',
                            'order'          => 'DESC',
                            'posts_per_page' => '8'
                               )); 
                            echo '<div class = "latest-blogs">';                                ?>
                        <?php if ( $the_query->have_posts() ) : ?>
                            
                                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                                
                                                <?php     $thumbnail_id = get_post_thumbnail_id();
                                                          $content = get_the_content(); // Retrieve the content
                                                          $trimmed_content = wp_trim_words($content, 20, ' <a href = "'.get_the_permalink().'">...</a>');
                                                          $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'blog_image');
                                                          $thumbnail_url = $thumbnail_url[0];
                                                          $author = get_the_author();
                                                          $date = get_the_date( ' F j, Y' );
                                                    echo '<div class = "post-mini">';
                                                            echo '<a href = "'.get_the_permalink().'"><img src = "'.$thumbnail_url.'" class = "img-fluid" alt = "blogs"/></a>';
                                                                    echo '<ul class = "post-meta">';
                                                                            echo '<li class = "author"><i class="fa fa-user" aria-hidden="true"></i> '.$author.'</li>';
                                                                            echo '<li class = "date"><i class="fa fa-calendar" aria-hidden="true"></i>'.$date.'</li>';
                                                                    echo '</ul>';
                                                            echo '<h3 class = "title-posts">'.get_the_title().'</h3>';
                                                            echo $trimmed_content;
                                                    echo '</div>';  
                                                 ?>
                                <?php endwhile; ?>
                        <?php endif; 
                        echo '</div>'; ?>
            </div>
    </div>
<?php }


function social_media() {

                        
                        $twitter = get_field('twitter','option');
                        $facebook = get_field('facebook','option');
                        $youtube = get_field('youtube','option');
                        $instagram = get_field('instagram','option');

                    
                          echo '<ul class = "social_media-footer">';
                                  if($twitter):
                                    echo '<li><a href = "'.$twitter.'" class = "twitter" target = "_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
                                endif;
                                if($facebook):
                                    echo '<li><a href = "'.$facebook.'" class = "facebook" target = "_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>';
                                endif;
                                if($youtube):
                                    echo '<li><a href = "'.$youtube.'" class = "youtube" target = "_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i>
</a></li>';
                                endif;
                                  if($instagram):
                                    echo '<li><a href = "'.$instagram.'" class = "instagram" target = "_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>';
                                endif;
                          echo '</ul>';
}

function title_header() {


  if(!empty(get_the_post_thumbnail_url())) { ?>
      <div class = "top-title-wrapper" style = "background-image: url( <?php echo get_the_post_thumbnail_url(get_the_ID(),'conver_photo_user'); ?>);">  
        <div class="overlay"></div>
        <h1><?php echo get_the_title(); ?></h1>
           <?php  if (have_posts()) : ?>
          <?php while (have_posts()):the_post();  ?>
                    <div class = "container"><?php echo '<p>'.get_the_excerpt().'</p>'; ?></div>
         <?php endwhile; endif; ?>
    </div>

  <?php } else { ?>
    <div class = "title-page">
      <div class = "title-wrapper"><h1><?php echo get_the_title(); ?></h1></div>
   </div>

  <?php }
  echo '<div class = "clearfix"></div>';
}

function share_social_media() {

  echo  '<div class="ssk-group" data-url="<?php echo home_url(); ?>" data-text="Share text default" >
                  <a href="" class="ssk ssk-facebook"></a>
                  <a href="" class="ssk ssk-twitter" data-text="Share text for twitter"></a>
                  <a href="" class="ssk ssk-google-plus"></a>
              </div>';
}

function global_search() { ?>

    <form  method="get" action="<?php echo home_url(); ?>" role="search">
          <div class="form-group">
            <div class = "input-container">
              <input  type="search" id="search-input"  class="form-control places-inputs" name="s" placeholder = "Where do you want to go?" required>
               <input type="hidden" name="taxonomy" value="places">
              <input type="submit" class="global-button input-btn-places" name="search-guide" value="Search" disabled role="button">
            </div>
          </div>
        
        </form>

<?php }
?>