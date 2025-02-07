<?php 
			$tour_guide_id = get_the_author_meta('ID');
			$user_data = get_userdata($tour_guide_id);
			
			$userprofile = get_field('user_profile','user_'. $tour_guide_id);
			$shortDescription = get_field('short_description_','user_'. $tour_guide_id);
			$cellphone_number = get_field('cellphone_number','user_'. $tour_guide_id);
			$email = get_field('email','user_'. $tour_guide_id);
			$address = get_field('address','user_'. $tour_guide_id);
			$facebook = get_field('facebook','user_'. $tour_guide_id);
			$twitter = get_field('twitter','user_'. $tour_guide_id);
			$instagram = get_field('instagram','user_'. $tour_guide_id);
			$youtube = get_field('youtube','user_'. $tour_guide_id);
			$hourly_rate_range = get_field('hourly_rate_range');

	

			$profile = '';
			if(!empty($userprofile)) {
				$profile = $userprofile['sizes']['user_profile'];
			}else {
				$profile =  get_template_directory_uri().'/img/profile.jpg';
			}


	
echo '<img src = "'.$profile.'" alt = "profile Picture" class = "img-fluid"/>';
		

	echo '<h2>Hi, My Name is '. $user_data->first_name.' '.$user_data->last_name.'</h2>';
	if(!empty($shortDescription)) :
		echo '<p>'.$shortDescription.'</p>';
	endif;
	echo '<h3>Lets Talk!</h3>';

	echo '<ul class = "tourguide-contact">';
			if(!empty($cellphone_number)) {
				echo '<li><a href = "tel:'.$cellphone_number.'"><i class="fa fa-phone" aria-hidden="true"></i> '.$cellphone_number.'</a></li>';
				}else { echo '<li><a href ="#" ><i class="fa fa-phone" aria-hidden="true"></i> Phone N/A</a></li>'; }
			if(!empty($email)) {
				echo '<li><a href = "mailto:'.$email.'"><i class="fa fa-envelope" aria-hidden="true"></i> '.$email.'</a></li>';
			}else { 
				echo '<li><a href = "#"><i class="fa fa-envelope" aria-hidden="true"></i> Email N/A</a></li>';
			 }
			if(!empty($address)) {
				echo '<li><i class="fa fa-map-marker" aria-hidden="true"></i> '.$address.'</li>';
			}else { echo '<li><i class="fa fa-map-marker" aria-hidden="true"></i> Address N/A </li>'; }
	echo '</ul>';
	
		echo '<h4>follow me</h4>';

			echo '<ul class = "tourguide-socialmedia">';
				if($facebook) :
					echo '<li><a href = "'.$facebook.'" target = "_blank"><i class="fa fa-facebook"></i></a></li>';
				endif;
				if($twitter) :
					echo '<li><a href = "'.$twitter.'" target = "_blank"><i class="fa fa-twitter"></i></a></li>';
				endif;
				if($instagram) :
					echo '<li><a href = "'.$instagram.'" target = "_blank"><i class="fa fa-instagram"></i></a></li>';
				endif;
				if($youtube) :
					echo '<li><a href = "'.$youtube.'" target = "_blank"><i class="fa fa-youtube"></i></a></li>';
				endif;
		echo '</ul>';
if($hourly_rate_range) {

		echo '<p class = "rate">Hourly Rate: <span>$'.$hourly_rate_range.'/hr</span></p>';

	}else {
		echo '<p class = "rate"><span>Free</span></p>';
	}