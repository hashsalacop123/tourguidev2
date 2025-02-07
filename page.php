<?php 
//====THIS ARE THE DEFAULT TEMPLATE====
get_header(); ?>

<div class = "general-template">
	<?php title_header(); ?>
	<div class = "container">
	<div class = "row justify-content-center">			
	   
	    <?php 	if (have_posts()) : ?>
	        <?php while (have_posts()):the_post();	?>
	                    <div class = "col-md-8"> <?php  the_content(); ?></div>
	       <?php endwhile; endif;	?>
	   </div>
	</div>
</div>

<?php get_footer(); ?>