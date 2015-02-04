<div class="large-post">
    <h3><?php the_title(); ?></h3>
    <?php echo get_the_post_thumbnail( get_the_ID() ); ?> 
    <p><?php the_excerpt(); ?></p>
    <p><a href="<?php the_permalink(); ?>" class="button" >Read More</a></p>
</div>
