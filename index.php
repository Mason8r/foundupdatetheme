<?php get_header(); ?>
<!-- Content -->
<div id="content">

    <section id="ad-top">
        <div class="row">
            <div class="small-12 columns">
                <?php set_query_var( 'advertStyle' , 'auto' ); // Set variable top add ?>
                <?php get_template_part( 'content', 'adverts' ) ?>
            </div>
        </div>
    </section>
    <section id="hero">
        <?php $args = array(
            'posts_per_page'   => 1,
            'offset'           => 0,
            'category_name'    => 'hero-post',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_status'      => 'publish',
        );
        
        query_posts( $args ); ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <div class="row">
                <div class="small-5 columns">
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_excerpt(); ?></p>
                    <p><a href="<?php the_permalink(); ?>" class="button" >Read More</a></p>
                </div>
                <div class="small-7 columns">
                    <a href="<?php the_permalink(); ?>" ><?php echo get_the_post_thumbnail( get_the_ID() ); ?></a>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <div class="underline"></div>
                </div>
            </div>
        <?php endwhile; wp_reset_query(); ?>
    </section>

    <section id="main">

        <div class="row">

            <div class="medium-4 columns">
                <div id="ad-loop">

                    <?php set_query_var( 'advertStyle', 'auto' ); // Set variable for left side ads ?>
                    <?php for($i = 0; $i < 3; $i++) : ?>
                        <?php get_template_part( 'content', 'adverts' ) ?>
                    <?php endfor; ?>

                </div><!--/#ad-loop-->
            </div>

            <div class="medium-8  columns">
                
                <section id="featured-posts">
                    <h3 class="page-heading">Featured Posts</h3>
                    <?php $args = array(
                        'posts_per_page'   => 4,
                        'offset'           => 0,
                        'category_name'    => 'featured-posts',
                        'orderby'          => 'post_date',
                        'order'            => 'DESC',
                        'post_status'      => 'publish',
                    );
                    query_posts( $args ); ?>

                    <?php if ( have_posts() ) : ?>
                       <ul class="small-block-grid-4">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <li>
                                    <small><?php the_date(); ?></small>
                                    <?php the_post_thumbnail(); ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endwhile; wp_reset_query(); ?>
                        </ul>
                    <?php endif;?>
                </section>

                <section id="recent-posts">
                    <h3 class="page-heading">Popular Posts</h3>
                    <?php $args = array(
                        'posts_per_page'   => 5,
                        'offset'           => 0,
                        'orderby'          => 'post_date',
                        'order'            => 'DESC',
                        'post_status'      => 'publish',
                    );
                    query_posts( $args ); ?>

                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'content', 'largeposts' ) ?>
                        <?php endwhile; wp_reset_query(); ?>
                    <?php endif;?>
                </section>
            </div>
        </div>
    </section>

</div><!-- ./End Content-->
<?php get_footer(); ?>