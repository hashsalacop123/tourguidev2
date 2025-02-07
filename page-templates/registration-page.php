<?php 
// Template Name: Registration Page
get_header(); ?>

<div class = "container global-space">
	<div class = "row">
		<?php 
			$titleleft = get_field('title_left');
			$titleright = get_field('title_right');
			$leftcontent = get_field('left_content');
			$rightcontent = get_field('right_content');

		?>
		<div class = "col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<?php if($titleleft) :
					echo '<h2>'.$titleleft.'</h2>';
				endif;

				if($leftcontent) :
					echo $leftcontent;
				endif; ?>
		</div>
		<div class = "col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<?php if($titleright) :
					echo '<h2>'.$titleright.'</h2>';
				endif;

				if($rightcontent) :
					echo $rightcontent;
				endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>