<?php
get_header(); // Include the header template

?>

<main role="main">
    <section class="searchesresults">
        <div class="container">
           <!--  <h1>Search Results</h1> -->
           <div class = "row">
 

            <?php

            $term = get_queried_object();
            $featuredimages = get_field('featured_images',$term);
            // 	echo '<pre>';
            // 	print_r($featuredimages['alt']);
            // 	echo '</pre>';
            // // die();

          ?>
           
                          <div class = "col-xl-8 col-lg-8 col-md-12 col-sm-12">
                              <div class = "wrapper-content-places">
                                  <?php if($featuredimages) { ?>
                                  <img src = "<?php echo $featuredimages['sizes']['slider_banner']; ?>" class = "img-fluid" alt = "<?php echo $featuredimages['alt']; ?>">
                                  <?php }else {
                                    echo '<img src = "'.get_template_directory_uri().'/img/placeholder.jpg" class = "img-fluid" alt = "placeholder image">';
                                  } ?>
                                  <h1><?php echo $term->name; ?></h1>
                                 
                                  
                              </div>
                          </div>
                            <div class = "col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                  <?php
                          $description = category_description($term->term_id);
                          $limited_description = wp_trim_words($description, 100);

                          echo '<p>' . $limited_description . '</p>'; ?>
                                <a href = "#" class = "a-tag-global" data-toggle="modal" data-target=".bd-example-modal-lg">About <?php echo $term->name; ?>...</a>
                                  <div class="tax-modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class = "modal-header">
                                         <h5> ABOUT <?php echo $term->name; ?></h5>
                                        </div>
                                        <?php echo $description; ?>

                                        <div class = "modal-footer">
                                          <button type="button" class="global-button" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            <div class = "col-md-12 spacing-top-bottom">
                                <div class="ssk-group" data-url="<?php echo home_url(); ?>" data-text="Share text default" >
                  <a href="" class="ssk ssk-facebook"></a>
                  <a href="" class="ssk ssk-twitter" data-text="Share text for twitter"></a>
                  <a href="" class="ssk ssk-google-plus"></a>
              </div>
                              <h3>Find your local guide in <?php echo $term->name; ?></h3>
                                  <p>Imagine what it would be like to explore <?php echo $term->name; ?> with a like-minded local friend? A local who can help you plan your trip and tailor your activities to your interests so that once you get there, you can find the best things to do and the most interesting places to visit in <?php echo $term->name; ?>, <?php echo $term->name; ?>. You’d also have no trouble discovering plenty of hidden gems as well as unique nooks and crannies when you have a knowledgeable insider by your side.</p>
                            </div>
                            <div class = "col-md-12">
                                <div class = "tour-guide-data row">
                   
                                  <?php
								    if (have_posts()) {
								        while (have_posts()) {
								            the_post(); ?>
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
								 
								     } ?>
                               </div>
                            </div>
                                           <div class = "col-xl-2 col-lg-2 col-md-12 col-sm-12 more-destination">
                    <h5>More Distination</h5>
                </div>
                <div class = "col-xl-10 col-lg-10 col-md-12 col-sm-12 more-destination">
                    <?php 

                    // http://goph.local/places/Bohol/

                        $argument_cat = array(
                          'hide_empty' => false,
                          'taxonomy' => 'places',
                          'meta_query' => array(
                            array(
                              'key' => 'featured',
                              'value' => 'yes',
                              'compare' => '=',
                            ),
                          ),
                        );

                        $terms2 = get_terms($argument_cat);
                        echo '<ul class = "places-featured search-page">';
                        if (!empty($terms2)) {
                          foreach ($terms2 as $term) {
                              $term_link = get_term_link($term);

                                echo '<li><a href = "'.$term_link .'">'.$term->name.'</a></li>';
                            // $term->name
                          }
                        } else {
                          // No terms found
                        }
                        echo '</ul>';

                    ?>
                </div>
                      </div>
                  </div>
              </section>
</main>

<?php get_footer(); // Include the footer template

