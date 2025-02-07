<?php 
// Template Name: Home Page
get_header(); 

$headings = get_field('headings');
$sub_heading = get_field('subheadings');
$gallerys = get_field('gallery_slider');
 ?>

<div class = "main-home">
	<div class = "container-wrapper-slide">
		<div class = "container">
			<div class = "main-container-wrapper">
				<h1><?php echo $headings; ?></h1>
				<h2><?php echo $sub_heading; ?></h2>
					<?php global_search(); ?>

					<?php 
						$args = array(
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

						echo '<div class = "quick-search">';
						   echo '<button id = "quick-search">';
                                echo 'Suggested Distination <i class="fa fa-search" aria-hidden="true"></i>';
                          echo '</button>';
                         echo '</div>';

						$terms = get_terms($args);
						echo '<ul class = "places-featured places-mobile-hide">';
						if (!empty($terms)) {
						  foreach ($terms as $term) {
						  	  $term_link = get_term_link($term);
						  	 //  $base_url = home_url().'/?s='.$term->name.'&taxonomy=places&search-guide=Search';
						  	   
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
	<div class = "slider-wrapper">
	<?php 


		foreach ($gallerys as $gallery) {
				echo '<div class = "image-slide"><img src = "'.$gallery['sizes']['slider_banner'].'" alt ="'.$gallery['alt'].'" />';
				echo '</div>';
		}
	?>
		
	</div>
	<?php echo  blog_slider(); ?>
</div>

     <div id="more-destination" style="display:none;max-width:100%;">
                <?php    ?> 

             
                          <div class = "footer-mobile">

                          	<?php 

                          	echo '<h5>Do a quick search!</h5>';

		                          $args = array(
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


								$terms = get_terms($args);
								echo '<ul class = "places-featured mobile-customize">';
								if (!empty($terms)) {
								  foreach ($terms as $term) {
								  	  $term_link = get_term_link($term);
								  	  // $base_url = home_url().'/?s='.$term->name.'&taxonomy=places&search-guide=Search';
								  	   
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
<?php get_footer(); ?>