<?php 
// Template Name: How it Works
get_header(); ?>
<div class = "how-it-works">
	<?php title_header(); ?>
	<div class = "container">
		<div class = "row justify-content-center">
			<div class = "col-md-6">
	

					<?php 
						$step_1 = get_field('step_1');
						$image_step_1 = get_field('image_step_1');
						$step_2 = get_field('step_2');
						$image_step_2 = get_field('image_step_2');
						$step_3 = get_field('step_3');
						$image_step_3 = get_field('image_step_3');
						$step_4 = get_field('step_4');
						$image_step_4 = get_field('image_step_4');
						$step_5 = get_field('step_5');
						$image_step_5 = get_field('image_step_5');
						// echo '<pre>';
						// print_r($image_step_1['sizes']);
						// echo '</pre>';
					?>


					<div class = "steps">
							<img src = "<?php echo $image_step_1['sizes']['medium']; ?>" class = "img-fluid" alt = "$image_step_1['alt']">
							<h4><?php echo $step_1; ?></h4>
							<h6>STEP 1</h6>
							<i class="fa fa-long-arrow-down" aria-hidden="true"></i>

					</div>
					<div class = "steps">
							<img src = "<?php echo $image_step_2['sizes']['medium']; ?>" class = "img-fluid" alt = "$image_step_2['alt']">
							<h4><?php echo $step_2; ?></h4>
							<h6>STEP 2</h6>
							<i class="fa fa-long-arrow-down" aria-hidden="true"></i>

					</div>
					<div class = "steps">
							<img src = "<?php echo $image_step_3['sizes']['medium']; ?>" class = "img-fluid" alt = "$image_step_3['alt']">
							<h4><?php echo $step_3; ?></h4>
							<h6>STEP 3</h6>
							<i class="fa fa-long-arrow-down" aria-hidden="true"></i>

					</div>
					<div class = "steps">
							<img src = "<?php echo $image_step_4['sizes']['medium']; ?>" class = "img-fluid" alt = "$image_step_4['alt']">
							<h4><?php echo $step_4; ?></h4>
							<h6>STEP 4</h6>
							<i class="fa fa-long-arrow-down" aria-hidden="true"></i>

					</div>
					<div class = "steps">
							<img src = "<?php echo $image_step_5['sizes']['medium']; ?>" class = "img-fluid" alt = "<?php echo $image_step_5['alt']; ?>">
							<h4><?php echo $step_5; ?></h4>
							<h6>STEP 5</h6>
							<a href = "<?php echo get_home_url(); ?>">Start Searching your tour guide</a>

					</div>
			
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>