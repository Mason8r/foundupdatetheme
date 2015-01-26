
<div class="masonry-entry" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    
    <div class="masonry-details">
        <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>">
            <div class="masonry-thumbnail">
                <?php the_post_thumbnail('three'); ?>
            </div><!--.masonry-thumbnail-->
        </a>
        <?php endif; ?>
        <h4><?php the_title(); ?></h4>
        <div class="masonry-post-excerpt">
            <p class="blog-date"><?php the_time("dS F, Y"); ?></p>
            <p class="blog-body"><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="readmore" >click here</a>
        </div><!--.masonry-post-excerpt-->
    </div><!--/.masonry-entry-details -->  
    
</div><!--/.masonry-entry-->