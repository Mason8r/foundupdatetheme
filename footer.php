<footer>
	<div class="row">
		<div class="large-12 columns">
			<p><a href="<?php echo home_url(); ?>"><div id="footer-logo"><?php bloginfo('name'); ?></div></a><br />
			&copy; <?php echo date('Y' , strtotime('today') ); ?>. All Rights Reserved</p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>