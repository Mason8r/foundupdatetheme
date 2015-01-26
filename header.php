<!DOCTYPE html>
<html>
<head>
	<title> <?php wp_title(''); ?> <?php bloginfo('name'); ?></title>
	<?php wp_head(); ?>
</head>
<body>
<header>
    <div class="row">
        <div class="large-4 columns">
            <a href="<?php echo home_url(); ?>"><h1 id="logo"><?php bloginfo('name'); ?></h1></a>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <div class="top-bar-container">
                <nav class="top-bar">
                    <ul class="title-area">         
                        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                    </ul>
                    <section class="top-bar-section">
                        <?php foundation_top_bar_l(); ?>

                        <?php foundation_top_bar_r(); ?>
                    </section>
                </nav>
            </div>
        </div>
    </div>
</header>

