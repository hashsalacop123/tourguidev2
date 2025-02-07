<?php
//====THIS IS 404 TEMPLATE====
 get_header(); ?>

<div class = "error">
    <div class = "container">
        <h1>404</h1>
        <h2>OPPS! PAGE NOT FOUND</h2>
        <?php 

        ?>
        <a href = "<?php echo home_url(); ?>"><img src= "<?php echo get_template_directory_uri(); ?>/img/404.jpg" class = "img-fluid" alt = "404 page"/></a>
        <p>We are unable to locate the page you were looking for. Use the menu above to find your way, thanks.</p>
     
        
    </div>
</div>
<?php get_footer(); ?>