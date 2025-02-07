<?php
$skills = get_field('skills');
$languages = get_field('languages');
$education = get_field('education');
$places = get_field('places');

if(!empty($places)) :
	echo '<h4>Location</h4>';
	echo '<ul class = "tour-guide-skill-lang">';
			foreach ($places as $place) {
				echo '<li>'.$place->name.'</li>';
			}
		echo '</ul>';
	wp_reset_postdata();
endif;

echo '<h4>Skills</h4>';
	echo '<ul class = "tour-guide-skill-lang">';
	if( have_rows('skills') ):
	    while( have_rows('skills') ) : the_row();
	        $language = get_sub_field('skill');
	       echo '<li>'.$language.'</li>';
	    endwhile;
	else :
	endif;
	echo '</ul>';
wp_reset_postdata();
echo '<h4>Languages</h4>';
	echo '<ul class = "tour-guide-skill-lang">';
	if( have_rows('languages') ):
	    while( have_rows('languages') ) : the_row();
	        $language = get_sub_field('language');
	       echo '<li>'.$language.'</li>';
	    endwhile;
	else :
	endif;
	echo '</ul>';
wp_reset_postdata();
echo '<h4>Education</h4>';
	echo '<ul class = "education">';
		if( have_rows('education') ):
	    while( have_rows('education') ) : the_row();
	        $school = get_sub_field('school');
	        $year = get_sub_field('year');
	       echo '<li>'.$school. ' - '.$year.'</li>';
	    endwhile;
	else :
	endif;
	echo '</ul>';
wp_reset_postdata();  ?>