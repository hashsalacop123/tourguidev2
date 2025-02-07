<?php 
 acf_form_head();
get_header();   ?> 
<div class = "single-tour-guide">
<?php	if (have_posts()) :
	  while (have_posts()) : the_post();	
			$tour_guide_id = get_the_author_meta('ID');
			$user_data = get_userdata($tour_guide_id);
		
			// print_r($tour_guide_id);

			// ====TOUR GUIDE ACF====
			$about_tour_guide = get_field('about_tour_guide');
			$coverphoto = get_field('cover_photo','user_'. $tour_guide_id); 
			$converphoto = '';
			if(!empty($coverphoto)) {
				$converphoto = $coverphoto['sizes']['conver_photo_user'];
			}else {
				$converphoto = get_template_directory_uri().'/img/coverphoto.jpg';
			}

?>
	<div class = "cover-photo" style="background-image: url(<?php echo $converphoto; ?>)">
	</div>
		<div class = "container">
			<div class = "row">
				<div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 left-tour-guide">
					<?php 
					get_template_part( 'tourguide-template-parts/contacts' );
						if ( is_author_logged_in() ) :
							echo '<div class = "edit-profile">';
								echo '<a  data-fancybox data-src="#edit-profile-link" class = "edit-profile-link" href="#">Eidt Profile <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
							echo '</div>';

						echo '<div id = "edit-profile-link" class = "container">';
									//Display the ACF form
								 edit_profile_colum_one();
							echo '</div>';		
						endif;
					
					?>
					
				</div>
				<div class = "col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 right-tour-guide">

						<div class = "messages-plugin">
								<?php
								
								 ?>
							
						</div>
				
						<h1>About <?php echo $user_data->first_name; ?></h1>

						
						<?php

							if(!empty($about_tour_guide)) {
								echo $about_tour_guide;


							}else {
								if ( is_author_logged_in() ) :
									// echo '<a href = "" >About You</a>';
								endif;
							}

						$images = get_field('gallery');
							if(!empty($images)) {
								get_template_part( 'tourguide-template-parts/gallery' );
							?>

							<?php 
							} else {
								if ( is_author_logged_in() ) :
									echo '<a href = "" ><img src = "'.get_template_directory_uri().'/img/gallery.jpg" class = "img-fluid" /></a>';
								endif;
							}

							get_template_part( 'tourguide-template-parts/others' );
					
						if ( is_author_logged_in() ) :
								echo '<div class = "edit-profile">';
											echo '<a data-fancybox data-src="#edit-profile-link2" class = "edit-profile-link2" href="#">Eidt Profile <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
								echo '</div>';

							echo '<div id = "edit-profile-link2" class = "container">';
											//Display the ACF form
										 edit_profile_colum_two();
									echo '</div>';		 	

						endif;
						echo '<h4>Share this tour guide</h4>';
						echo share_social_media(); 
		
					?>
				</div>
				<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 tour-guide-review">
					<h4>Ratings</h4>
					<?php tour_guide_review_box(); 

						    if ( comments_open() || get_comments_number() ) {
							      comments_template();
							    }
					?>
				</div>
			</div>
		</div>

<?php endwhile;
		endif; ?>
</div>	


							
 <?php get_footer(); ?>