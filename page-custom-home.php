<?php
	/*
	Template Name: Home Page
	*/

	get_header(); 
?>
<div id="home" >
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="row">
                <div class="large-7 columns">
                    <?php the_content(); ?>
                </div>
                <div class="large-5 columns">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif;?>
</div>
<?php get_footer(); ?>
