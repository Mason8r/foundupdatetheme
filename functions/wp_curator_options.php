<?php

function colour_customizer( $wp_customize ) {
     
    $wp_customize->add_setting(
        'bar-color',
        array(
            'default' => '#CC0000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
     

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'bar-color',
            array(
                'label' => 'Tagline BG Color',
                'section' => 'colors',
                'settings' => 'bar-color'
            )
        )
    );

    $wp_customize->add_setting(
        'font-color',
        array(
            'default' => '#CC0000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
     

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'font-color',
            array(
                'label' => 'Font Color',
                'section' => 'colors',
                'settings' => 'font-color'
            )
        )
    );

    
}
add_action( 'customize_register', 'colour_customizer' );

/* Create a custom page for theme with a little 'Curator' link */
add_action('admin_menu', 'my_admin_menu');

function themeslug_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'themeslug_logo_section' , array(
    'title' => __( 'Logo', 'themeslug' ),
    'priority' => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );
    $wp_customize->add_setting( 'themeslug_logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
    'label' => __( 'Logo', 'themeslug' ),
    'section' => 'themeslug_logo_section',
    'settings' => 'themeslug_logo',
    ) ) );
}

add_action('customize_register', 'themeslug_theme_customizer');

function my_admin_menu() {
    add_menu_page('Curator options', 'Curator', 'add_users','neo_options', 'overview', get_bloginfo("template_url") .'/assets/img/icon.png');
	add_action( 'admin_init', 'register_mysettings' ); //call register settings function
 }

/* Register the settings required for the form */
function register_mysettings() {
	register_setting( 'myoption-group', 'adsense_id' );
	register_setting( 'myoption-group', 'site_url_one' );
    register_setting( 'myoption-group', 'site_url_two' );
    register_setting( 'myoption-group', 'site_url_three' );
    register_setting( 'myoption-group', 'site_url_four' );
    register_setting( 'myoption-group', 'site_url_five' );
    register_setting( 'myoption-group', 'site_font' );
    register_setting( 'myoption-group', 'site_total_posts' );
    register_setting( 'myoption-group', 'site_randomise_posts' );
    register_setting( 'myoption-group', 'site_show_curator_posts' );
 } 

/* HTML for Theme Form - AdSense and Site RSS URL */
function overview() { ?>

    <div class="wrap">
        <h2>Theme Option Panel</h2>
            
            <form method="post" action="options.php">

            <?php settings_fields( 'myoption-group' ); ?>

            <h3>Show Own Posts  <?php echo get_option('site_show_curator_posts'); ?></h3>

            <p>To show your own posts at the top of the curator page, categorise them as 'curator' posts (you may need to add new category when creating the first post).</p>

            <table class="form-table">
                <tr valign="top">
                <th scope="row">Show Own Posts</th>
                <td>
                    <input type="radio" name="site_show_curator_posts" value="true" <?php echo get_option('site_show_curator_posts')  == 'true' ? 'checked' : ''; ?> > Yes, display my posts categorised as 'curator'.<br />
                    <input type="radio" name="site_show_curator_posts" value="false" <?php echo get_option('site_show_curator_posts')  == 'false' ? 'checked' : ''; ?> > No, do not display my posts.
                </td>
                </tr>
            </table>
            
            <h3>Adsense ID</h3>
            <p>Enter your full AdSense ID (e.g. <i>ca-pub-7084264959981451</i> ). Always test to see if the adverts are loading once you have entered one.</p>

            <table class="form-table">
                <tr valign="top">
                <th scope="row">Your Adsense ID:</th>
                <td><input type="text" name="adsense_id" value="<?php echo get_option('adsense_id')  == '' ? 'ca-pub-7084264959981451' : get_option('adsense_id'); ?>" /></td>
                </tr>
            </table>

            <hr />

            <h3>Sites to Curate</h3>
            <p>Enter a valid RSS feed (e.g. <i><a href="http://coolsandfools.com/feed" target="_blank">www.coolsandfools.com/feed</a></i>) from a site you want to curate from. If we can't find any image, we don't display the post. <br />
            The decription (if there) will be shorted to 200 characters and a 'Read More...' link is attached. Always test to see if the feed works once you have entered one.</p>
               
                    
            <table class="form-table">
                <tr valign="top">
                <th scope="row">Site One:</th>
                <td><input type="text" name="site_url_one" value="<?php echo esc_attr( get_option('site_url_one') ); ?>" /></td>
                </tr>
                <tr valign="top">
                <th scope="row">Site Two:</th>
                <td><input type="text" name="site_url_two" value="<?php echo esc_attr( get_option('site_url_two') ); ?>" /></td>
                </tr>
                <tr valign="top">
                <th scope="row">Site Three:</th>
                <td><input type="text" name="site_url_three" value="<?php echo esc_attr( get_option('site_url_three') ); ?>" /></td>
                </tr>
                 <tr valign="top">
                <th scope="row">Site Four:</th>
                <td><input type="text" name="site_url_four" value="<?php echo esc_attr( get_option('site_url_four') ); ?>" /></td>
                </tr>
                 <tr valign="top">
                <th scope="row">Site Five:</th>
                <td><input type="text" name="site_url_five" value="<?php echo esc_attr( get_option('site_url_five') ); ?>" /></td>
                </tr>
            </table>

            <hr />

            <h3>RSS Feed options</h3>
            <p>Total posts is the number of posts displayed on the home page. Randomise posts to jumble up the RSS feeds.</p>
               
            <table class="form-table">
                <tr valign="top">
                <th scope="row">Randomise Posts</th>
                <td>
                    <input type="radio" name="site_randomise_posts" value="true" <?php echo get_option('site_randomise_posts')  == 'true' ? 'checked' : ''; ?> > Yes, display posts randomly.<br />
                    <input type="radio" name="site_randomise_posts" value="false" <?php echo get_option('site_randomise_posts')  == 'false' ? 'checked' : ''; ?> > No thanks. Keep them in the order they are on the sites they come from.
                </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Total Posts:</th>
                    <td><input type="text" name="site_total_posts" value="<?php echo get_option('site_total_posts')  == '' ? '20' : get_option('site_total_posts'); ?>" /></td>
                </tr>
            </table>

            <hr />

            <h3>Site Font</h3>
            <p>Select the font type you like the most below.</p>
               
            <table class="form-table">
                <tr valign="top">
                <th scope="row">Font:</th>
                <td>
                    <input type="radio" name="site_font" value="Arial" <?php echo get_option('site_font')  == 'Arial' ? 'checked' : ''; ?> ><span style="font-family: Arial;">Arial</span><br>
                    <input type="radio" name="site_font" value="Times New Roman" <?php echo get_option('site_font')  == 'Times New Roman' ? 'checked' : ''; ?> ><span style="font-family: 'Times New Roman';">Times New Roman</span><br>
                    <input type="radio" name="site_font" value="Comic Sans MS" <?php echo get_option('site_font')  == 'Comic Sans MS' ? 'checked' : ''; ?> ><span style="font-family: 'Comic Sans MS';">Comic Sans</span><br>
                    <input type="radio" name="site_font" value="Big Caslon" <?php echo get_option('site_font')  == 'Big Caslon' ? 'checked' : ''; ?> ><span style="font-family: 'Big Caslon';">Big Caslon</span><br>
                    <input type="radio" name="site_font" value="Courier New" <?php echo get_option('site_font')  == 'Courier New' ? 'checked' : ''; ?> ><span style="font-family: 'Courier New';">Courier New</span><br>
                    <input type="radio" name="site_font" value="Helvetica" <?php echo get_option('site_font')  == 'Helvetica' ? 'checked' : ''; ?> ><span style="font-family: 'Helvetica';">Helvetica</span><br>
                    <input type="radio" name="site_font" value="Impact" <?php echo get_option('site_font')  == 'Impact' ? 'checked' : ''; ?> ><span style="font-family: 'Impact';">Impact</span><br>
                    <input type="radio" name="site_font" value="Rockwell" <?php echo get_option('site_font')  == 'Rockwell' ? 'checked' : ''; ?> ><span style="font-family: 'Rockwell';">Rockwell</span><br>
                </td>
                </tr>
            </table>

           <?php submit_button(); ?>
        </form>
    </div>

<?php } 

if ( function_exists('register_sidebar') ) {

   register_sidebar(array(
   'name' => 'left',
   'before_widget' => '<div id="left-section" class="widget %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<h2>',
   'after_title' => '</h2>'
   ));

    register_sidebar(array(
   'name' => 'right',
   'before_widget' => '<div id="right-section" class="widget %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<h2>',
   'after_title' => '</h2>'
   ));
}

add_action('create_rss_feed', 'get_rss_stuff');

function adplease_func( $atts = false ){

	$code = get_option('adsense_id');
        
        $ad =      '<div class="adplease"><ins class="adsbygoogle"';
        $ad .=          'style="display:block;"';
        $ad .=          'data-ad-client="'.$code.'"';
        $ad .=          'data-ad-format="auto"></ins>';
        $ad .=     '<script>';
        $ad .=     '(adsbygoogle = window.adsbygoogle || []).push({});';
        $ad .=     '</script></div>';
        
	return $ad;
}

add_shortcode( 'adplease', 'adplease_func' );

?>