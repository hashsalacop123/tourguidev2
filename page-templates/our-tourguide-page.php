<?php
// Template Name: Tour Guide
get_header(); ?>
<div class = "tour-guidecontainer">
  <?php title_header(); ?>
  

	<div class = "container">
		<div class = "row">
						<?php
      $args = [
          "hide_empty" => true,
          "taxonomy" => "places",
      ];

      $terms = get_terms($args);

      if (!empty($terms)) {
          foreach ($terms as $term) {
              $term_link = get_term_link($term);
              echo '<div class = "col-md-12">';
              echo "<h3>" . $term->name . "</h3>";
              echo "</div>";

              // Display posts related to the current term
              $args = [
                  "post_type" => "tour_guide", // Replace with your post type
                  "tax_query" => [
                      [
                          "taxonomy" => "places", // Replace with your taxonomy slug
                          "field" => "slug",
                          "terms" => $term->slug,
                      ],
                  ],
              ];

              loop_tour_guide_(); //THE FUNCTION IS LOCATED IN THE reuse_functions.php
          }
      } else {
          // No terms found
      }
      ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
