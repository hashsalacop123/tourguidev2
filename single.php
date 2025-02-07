<?php 
//====THIS ARE THE DEFAULT TEMPLATE====
get_header(); ?>

<div class = "general-template single-post">
	<div class = "container">
	<div class = "row justify-content-center">			
	   
	    <?php 	if (have_posts()) : ?>
	        <?php while (have_posts()):the_post();	?>
	                    <div class = "col-md-8"> <?php 
	                    $image_id = get_post_thumbnail_id();
						$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
						$image_title = get_the_title($image_id);
						$author = get_the_author();
						$date = get_the_date( ' F j, Y' );
	                    	$image_src = wp_get_attachment_image_src($image_id, 'full')[0];

	                    	if(!empty($image_src)) :
	                    		echo '<img src="'.$image_src.'" alt = "'.$image_alt.'" class = "img-fluid"/>';
	                    	endif;
	                    	echo '<h1>'.get_the_title().'</h1>';
							echo '<ul class = "post-meta">';
									echo '<li class = "author"><i class="fa fa-user" aria-hidden="true"></i> '.$author.'</li>';
									echo '<li class = "date"><i class="fa fa-calendar" aria-hidden="true"></i>'.$date.'</li>';
							echo '</ul>'; share_social_media(); ?>

							
	               <?php      the_content(); ?></div>
	       <?php endwhile; endif;	?>
	   </div>
	</div>
</div>

<?php get_footer(); ?>