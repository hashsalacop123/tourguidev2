<?php
// SIGNLE TOUR GUIDE VARIABLES
$gallery = get_field('gallery');
	echo '<h4>Gallery</h4>';
		 if( have_rows('gallery') ): ?>
		    <ul class="gallery-single-tour">
		    <?php while( have_rows('gallery') ): the_row(); 
		        $image = get_sub_field('image');
		         $image_caption = get_sub_field('image_caption');

		        ?>
		        <li>
		            <a data-fancybox="gallery"  data-caption="<?php echo $image_caption; ?>" data-src="<?php echo esc_url($image['url']); ?>" class "tourguide-gallery"><img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" /> </a>
  		
		        </li>
		    <?php endwhile; ?>
		    </ul>
		<?php endif; ?>
			<?php wp_reset_postdata();
 ?>