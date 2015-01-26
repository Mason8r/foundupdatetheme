<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
	<div role="complementary">
		<div class="widget-area">
			<ul class="sidebar-list">
				<?php dynamic_sidebar( 'sidebar-right' ); ?>
			</ul>
		</div><!-- .widget-area -->
	</div><!-- #secondary -->
<?php endif; ?>

