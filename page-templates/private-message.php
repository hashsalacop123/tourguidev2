<?php 
// Template Name: Private Message
get_header(); ?>
	<?php title_header(); ?>
	<div class = "container">
	<div class = "row">
				
	   
	    <?php 	
	    	echo do_shortcode('[front-end-pm user="]'); 


	    if (have_posts()) : ?>
	        <?php while (have_posts()):the_post();	?>
	                    <div class = "col-md-12"> <?php  the_content(); ?></div>
	       <?php endwhile; endif;	?>
	   </div>
	</div>
</div>


<?php get_footer(); ?>