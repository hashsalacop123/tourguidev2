<?php 
// Template Name: Blog Page
get_header(); ?>

<div class = "blog-page">
	<?php title_header(); ?>
	<div class = "container">
		<div class = "row">

			<?php
									               
						 $the_query = new WP_Query( array(
						'post_type'     => 'post',
						'post_status'   => 'publish',
						 'orderby'      => 'post_date',
						'order'          => 'DESC',
						'posts_per_page' => '-1'
						   )); 
									                    ?>
					<?php if ( $the_query->have_posts() ) : ?>
						
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<div class = "col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
								
												<?php     $thumbnail_id = get_post_thumbnail_id();
														  $content = get_the_content(); // Retrieve the content
														  $trimmed_content = wp_trim_words($content, 20, ' <a href = "'.get_the_permalink().'">...</a>');
													       $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'blog_image');
													       $thumbnail_url = $thumbnail_url[0];
													       $postid = get_the_ID();
													       $author = get_the_author();
													       $date = get_the_date( ' F j, Y' );
													echo '<div class = "post-mini blogs-custommize">';
													
														    echo '<a href = "'.get_the_permalink().'"><img src = "'.$thumbnail_url.'" class = "img-fluid" alt = "blogs"/></a>';
														  	echo '<ul class = "post-meta">';
																	echo '<li class = "author">Post By: '.$author.'</li>';
																	echo '<li class = "date">Posted : '.$date.'</li>';
															echo '</ul>';
														    echo '<h3 class = "title-posts">'.get_the_title().'</h3>';
														    echo $trimmed_content;
													echo '</div>';	
												 ?>
										</div>		
							<?php endwhile; ?>
					<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>