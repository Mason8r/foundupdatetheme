<?php get_header(); ?>
<!-- Content -->
<div id="content">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="row">
                <div class="large-12 columns">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif;?>
</div><!-- ./End Content-->
<?php get_footer(); ?>