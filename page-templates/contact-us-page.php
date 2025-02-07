<?php 
// Template Name: Contact Us
get_header(); ?>
<div class = "contact-page">
	<?php title_header(); ?>
	<div class = "container">
		<div class = "row">
	 <?php 	if (have_posts()) : ?>
		        <?php while (have_posts()):the_post();	?>
		        	<div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12 right-contact-page">
		                    <?php the_content(); 
		                    	$tel = get_field('telephone');
		                    	$email = get_field('email');
		                    	$address = get_field('address');

		                    echo '<ul class = "contact-form-address">';
		                    		if(!empty($tel )) :
		                    			echo '<li><i class="fa fa-phone" aria-hidden="true"></i> '.$tel.'</li>';
		                    		endif;
		                    		if(!empty($email )) :
		                    			echo '<li><i class="fa fa-envelope" aria-hidden="true"></i> '.$email.'</li>';
		                    		endif;
		                    		if(!empty($address )) :
		                    			echo '<li><i class="fa fa-location-arrow" aria-hidden="true"></i> '.$address.'</li>';
		                    		endif;
		                    echo '</ul>';
    					$social_media_title = get_field('social_media_title','option');
                        $twitter = get_field('twitter','option');
                        $facebook = get_field('facebook','option');
                        $youtube = get_field('youtube','option');
                        $instagram = get_field('instagram','option');

                       
                  

               			echo '<h4>Follow us on our Social Media</h4>';
                    
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
		                    ?>
		 			</div>
		 			<div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12 left-contact-page">
		 				<?php echo get_field('content_right'); ?>
		 			</div>
		      <?php endwhile; endif;	 ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>