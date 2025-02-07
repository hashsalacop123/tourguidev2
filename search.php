<?php
get_header(); // Include the header template

?>

<main role="main">
    <section class="searchesresults">
        <div class="container">
           <!--  <h1>Search Results</h1> -->
           <div class = "row">
 

            <?php
          $taxonomy = 'places';
          $term_slug = $_GET['s']; // Assuming the search term matches the slug of the specific "places" taxonomy term
          $term = get_term_by('slug', $term_slug, $taxonomy);
          $featured = get_field('featured_images', $term);
          $args = array(
              'post_type' => 'tour_guide',
              'tax_query' => array(
                  array(
                      'taxonomy' => $taxonomy,
                      'field' => 'slug',
                      'terms' => $term_slug,
                  ) ,
              ) ,
          ); 
          $query = new WP_Query($args);
          ?>
           
                          <div class = "col-xl-8 col-lg-8 col-md-12 col-sm-12">
                              <div class = "wrapper-content-places">
                                  <?php if($featured) { ?>
                                  <img src = "<?php echo $featured['sizes']['conver_photo_user']; ?>" class = "img-fluid" alt = "<?php echo $featured['alt']; ?>">
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
                   
                                  <?php loop_tour_guide_(); ?>
                               </div>
                            </div>
                                           <div class = "col-xl-2 col-lg-2 col-md-12 col-sm-12 more-destination">
                    <h5>More Distination</h5>
                </div>
                <div class = "col-xl-10 col-lg-10 col-md-12 col-sm-12 more-destination">
                    <?php 

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

                              $base_url = home_url().'/?s='.$term->name.'&taxonomy=places&search-guide=Search';

                                echo '<li><a href = "'.$base_url .'">'.$term->name.'</a></li>';
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

