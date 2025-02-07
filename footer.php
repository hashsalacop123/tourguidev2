<!-- staging changes tooo -->
<footer>
    <div class = "footer-wrapper">
        <div class = "container">
            <div class = "row">
                <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-3 footer-col-1">
                  <?php 
                    $footertitle = get_field('title','option');
                    $footerfooter_logo = get_field('footer_logo','option');
                    if($footertitle) :
                      echo '<h4>'.$footertitle.'</h4>';
                    endif;

                      if($footerfooter_logo) :
                      echo '<a href = "'.home_url().'"><img src = "'.$footerfooter_logo['url'].'" alt = "'.$footerfooter_logo['alt'].'" class = "img-fluid"/></a>';
                    endif;
                  ?>
                </div>
                <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-2 footer-col-2">
                    <?php 
                      $footertitle2 = get_field('title2','option');
                      $blogs_url = get_field('blogs_url','option');

                    if($footertitle2) :
                      echo '<h4>'.$footertitle2.'</h4>';
                    endif;

                    echo '<ul class = "blogs-menu">';
                          // Check rows existexists.
                          if( have_rows('blogs_url','option') ):
                              // Loop through rows.
                              while( have_rows('blogs_url','option') ) : the_row();
                                  // Load sub field value.
                                  $blogscontent = get_sub_field('blogs');
                                  echo '<li><a href = "'.$blogscontent->guid.'">'.$blogscontent->post_title.'</a></li>';
                              endwhile;

                          // No value.
                          else :
                              // Do something...
                          endif;
                    echo '</ul>';  ?>
                </div>
                <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-3 footer-col-4">
                  <?php 
                    $menu_id = 20; // Replace 123 with your actual menu ID
                     echo '<h4>Important Links</h4>';
                      $menu_items = wp_get_nav_menu_items($menu_id);

                      if ($menu_items) {
                          // Loop through the menu items
                          echo '<ul class = "blogs-menu">';
                          foreach ($menu_items as $menu_item) {
                              // Access menu item properties
                              $title = $menu_item->title;
                              $url = $menu_item->url;
                              $object_id = $menu_item->object_id;

                              echo '<li><a href = "'.$url.'">'.$title.'</a></li>';
                      
                          }
                          echo '</ul>';
                      } else {
                          echo "Menu ID not found.";
                      }

                  ?>
                </div>
                <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-4 footer-col-3">
                     <?php 
                     $footertitle3 = get_field('title3','option');
                        $text_area2 = get_field('text_area2','option');
                        $social_media_title = get_field('social_media_title','option');

                            if($footertitle3) :
                            echo '<h4>'.$footertitle3.'</h4>';
                          endif;
                           if($text_area2) :
                            echo '<h4>'.$text_area2.'</h4>';
                          endif;

                           if($social_media_title) :
                            echo '<h4>'.$social_media_title.'</h4>';
                          endif;
                      social_media();
                     ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
SocialShareKit.init();
</script>
<?php wp_footer(); ?>
</body>
</html>