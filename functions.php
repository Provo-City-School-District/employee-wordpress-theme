<?php
/*==========================================================================================
Theme Setup
============================================================================================*/
function pcsd_scripts_styles() {
	/*   REGISTER ALL JS FOR SITE */
	wp_register_script( 'slick_slider', 'https://globalassets.provo.edu/slick/slick.min.js', array('jquery'), '1.00.01', true);
	wp_register_script( '404easterEgg', 'https://globalassets.provo.edu/js/404.js', '', '1.0.01', true );
	// wp_register_script( 'mega_menu', 'https://globalassets.provo.edu/js/jquery-accessibleMegaMenu.js', array('jquery'), '1.00.02', true);
	// wp_register_script( 'cookie_script', 'https://globalassets.provo.edu/js/cookie.js', array('jquery'), '', true);
	// wp_register_script( 'global_scripts', 'https://globalassets.provo.edu/js/scripts.js', array('jquery','slick_slider'), filemtime('https://globalassets.provo.edu/js/scripts.js'), true);

	/*   REGISTER ALL CSS FOR SITE */
	/*   CALL ALL CSS AND SCRIPTS FOR SITE */
	wp_enqueue_style('variables', get_template_directory_uri() . '/assets/css/variables.css', '', '1.0.01', false);
	
	wp_enqueue_style( 'style', get_stylesheet_uri(), array('parent_style'), '1.00.03', false);
	wp_enqueue_style('header', get_template_directory_uri() . '/assets/css/header.css', '', '1.0.03', false);
	wp_enqueue_script( 'theme_scripts',get_template_directory_uri() .'/assets/js/scripts.js', array() , '1.00.01', true);
	wp_enqueue_script( 'slick_slider');
	
	//wp_enqueue_script( 'mega_menu');
	//wp_enqueue_script( 'cookie_script');
	wp_enqueue_script( 'global_scripts', 'https://globalassets.provo.edu/js/scripts.js', array('jquery','slick_slider'), '1.00.01', true);
	
	
	
	wp_enqueue_style( 'parent_style', get_template_directory_uri().'/assets/css/employee-parent-styles.css', '', '1.00.08', false);
	if(!is_page_template('template-EmployeeHome-2023.php')) {
	}
	if(is_page_template('template-EmployeeHome-2023.php')) {
		// wp_enqueue_style( 'department-styles', get_template_directory_uri() . '/assets/css/department-styles.css','','0.0.01', false);
		wp_enqueue_style( 'front_page', get_template_directory_uri() . '/assets/css/frontpage-employee.css', array(),'1.00.02', false);
	}

	if (is_page_template(
		array(
			'template-department_2022.php',
			'template-department_2022_links.php',
			'template-department_2022-tiles-news.php',
			'template-department_2022_no_top_menu.php'
		)
	)) {
		// wp_enqueue_style('department', get_template_directory_uri() . '/assets/css/department-styles.css', '', '1.0.01', false);
		// wp_enqueue_style('tiles', get_template_directory_uri() . '/assets/css/tiles.css', '', '1.0.0', false);
		wp_enqueue_style( 'front_page', get_template_directory_uri() . '/assets/css/frontpage-employee.css', array(),'1.00.01', false);
	}	
	if ( is_404() ) {
		wp_enqueue_script( '404easterEgg');
	}
	//load front page specific style sheet
	if ( is_front_page() ) {
		wp_enqueue_style( 'front_page', get_template_directory_uri() . '/assets/css/frontpage-employee.css', array(),'1.00.01', false);
	}
	wp_enqueue_style( 'parent_2023_styles', get_template_directory_uri().'/assets/css/2023-styleupdate.css', '', '0.00.01', false);
	if( is_page_template( array('template-department_repeater_slider.php') )) {
		// wp_enqueue_style( 'parent_styles_2022', get_template_directory_uri() . '/assets/css/2022-parent-styles.css','','1.0.02', false);
		// wp_enqueue_style( 'department', get_template_directory_uri() . '/assets/css/department-styles.css','1.0.02', false);
		wp_enqueue_style( 'tiles', get_template_directory_uri() . '/assets/css/tiles.css','','0.0.01', false);

	}
}
add_action('wp_enqueue_scripts', 'pcsd_scripts_styles', 9999);

// Enable Featured Images
add_theme_support( 'post-thumbnails' );
// Enable Dashboard Menus
add_theme_support( 'menus' );
// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
/*==========================================================================================
// Favicon
============================================================================================*/
function pcsd_add_favicon(){ ?>
	<!-- Custom Favicons -->
		<link rel="apple-touch-icon" sizes="180x180" href="//globalassets.provo.edu/image/favicons/public/apple-touch-icon.png">
		<link rel="icon" type="image/png" href="https://globalassets.provo.edu/image/favicons/public/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="https://globalassets.provo.edu/image/favicons/public/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="https://globalassets.provo.edu/image/favicons/public/manifest.json">
		<link rel="mask-icon" href="https://globalassets.provo.edu/image/favicons/public/safari-pinned-tab.svg">
	<?php }
//add the favicon link to the live site head
add_action('wp_head','pcsd_add_favicon');
//add the favicon to the login page
add_action('login_head','pcsd_add_favicon');
/*==========================================================================================
// custom Login Page
============================================================================================*/
function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

function my_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
return 'Employee Support Website Beta';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
/*==========================================================================================
block WordPress User Enumeration Scans
============================================================================================*/
if (!is_admin()) {
	// default URL format
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
	add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
}
function shapeSpace_check_enum($redirect, $request) {
	// permalink URL format
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}
//================================Display Modified Date on Dashboard for Posts===================================

// Register Modified Date Column for both posts & pages
function modified_column_register( $columns ) {
	$columns['Modified'] = __( 'Modified Date', 'show_modified_date_in_admin_lists' );
	return $columns;
}
add_filter( 'manage_posts_columns', 'modified_column_register' );
add_filter( 'manage_pages_columns', 'modified_column_register' );

function modified_column_display( $column_name, $post_id ) {
	switch ( $column_name ) {
	case 'Modified':
		global $post;
	       	echo '<p class="mod-date">';
	       	echo '<em>'.get_the_modified_date().' '.get_the_modified_time().'</em><br />';
			echo '<small>' . esc_html__( 'by ', 'show_modified_date_in_admin_lists' ) . '<strong>'.get_the_modified_author().'<strong></small>';
			echo '</p>';
		break; // end all case breaks
	}
}
add_action( 'manage_posts_custom_column', 'modified_column_display', 10, 2 );
add_action( 'manage_pages_custom_column', 'modified_column_display', 10, 2 );

function modified_column_register_sortable( $columns ) {
	$columns['Modified'] = 'modified';
	return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'modified_column_register_sortable' );
add_filter( 'manage_edit-page_sortable_columns', 'modified_column_register_sortable' );

//[directory url=""]
function directory_func($atts)
{
    $category = shortcode_atts(array(
        'url' => 'something',
    ), $atts);
    $directory_url = "{$category['url']}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $directory_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // TODO: to verify certificate, but path to cerificate may move or change in the future. want to think through something so this doesn't get disjointed or forgotten, going to not verify for now
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/wildcard/star_provo_edu.crt'); // Path to CA certificates bundle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $output = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $output = '<div class="staff-member-listing">' . $output . '</div>';
    return $output;
}
add_shortcode('directory', 'directory_func');

/*-------------------------------------------------------*/
/* Add Length Column to the Wordpress Dashboard
/*-------------------------------------------------------*/
//For Posts

	//Add the Length column, next to the Title column:

add_filter('manage_post_posts_columns', function ( $columns )
{
    $_columns = [];

    foreach( (array) $columns as $key => $label )
    {
        $_columns[$key] = $label;
        if( 'title' === $key )
            $_columns['wpse_post_content_length'] = __( 'Length' );
    }
    return $_columns;
} );

	//Fill that column with the post content length values:

add_action( 'manage_post_posts_custom_column', function ( $column_name, $post_id )
{
    if ( $column_name == 'wpse_post_content_length')
        echo mb_strlen( get_post( $post_id )->post_content );

}, 10, 2 );

	//Make our Length column orderable:

add_filter( 'manage_edit-post_sortable_columns', function ( $columns )
{
  $columns['wpse_post_content_length'] = 'wpse_post_content_length';
  return $columns;
} );
	//Finally we implement the ordering through the posts_orderby filter:

add_filter( 'posts_orderby', function( $orderby, \WP_Query $q )
{
    $_orderby = $q->get( 'orderby' );
    $_order   = $q->get( 'order' );

    if(
           is_admin()
        && $q->is_main_query()
        && 'wpse_post_content_length' === $_orderby
        && in_array( strtolower( $_order ), [ 'asc', 'desc' ] )
    ) {
        global $wpdb;
        $orderby = " LENGTH( {$wpdb->posts}.post_content ) " . $_order . " ";
    }
    return $orderby;
}, 10, 2 );

//For Pages

	//Add the Length column, next to the Title column:

add_filter('manage_page_posts_columns', function ( $columns )
{
    $_columns = [];

    foreach( (array) $columns as $key => $label )
    {
        $_columns[$key] = $label;
        if( 'title' === $key )
            $_columns['wpse_post_content_length'] = __( 'Length' );
    }
    return $_columns;
} );

	//Fill that column with the post content length values:

add_action( 'manage_page_posts_custom_column', function ( $column_name, $post_id )
{
    if ( $column_name == 'wpse_post_content_length')
        echo mb_strlen( get_post( $post_id )->post_content );

}, 10, 2 );

	//Make our Length column orderable:

add_filter( 'manage_edit-page_sortable_columns', function ( $columns )
{
  $columns['wpse_post_content_length'] = 'wpse_post_content_length';
  return $columns;
} );
	//Finally we implement the ordering through the posts_orderby filter:

add_filter( 'posts_orderby', function( $orderby, \WP_Query $q )
{
    $_orderby = $q->get( 'orderby' );
    $_order   = $q->get( 'order' );

    if(
           is_admin()
        && $q->is_main_query()
        && 'wpse_post_content_length' === $_orderby
        && in_array( strtolower( $_order ), [ 'asc', 'desc' ] )
    ) {
        global $wpdb;
        $orderby = " LENGTH( {$wpdb->posts}.post_content ) " . $_order . " ";
    }
    return $orderby;
}, 10, 2 );
//Notes

//If you want to target other post types, than we just have to modify the

//manage_post_posts_columns         -> manage_{POST_TYPE}_posts_columns
//manage_post_posts_custom_column   -> manage_{POST_TYPE}_posts_custom_column
//manage_edit-post_sortable_columns -> manage_edit-{POST_TYPE}_sortable_columns

//where POST_TYPE is the wanted post type.
/*==========================================================================================
post application approval forms
============================================================================================*/
remove_all_filters ('wpcf7_before_send_mail');
add_action('wpcf7_before_send_mail', 'my_wpcf7_save',1);
function my_wpcf7_save($cfdata) {
	$formtitle = $cfdata->title;
	$formdata = $cfdata->posted_data;
		if ( $formtitle == 'App Approval Form') {

			// create a new post
			$newpost = array(
				'post_title'  => $_POST['app-name'],
				'post_type'   => 'approved_application',
				'post_status' => 'draft'
			);

			//Insert New Post
			$newpostid = wp_insert_post($newpost);
			add_post_meta($newpostid, 'submitter_name', $_POST['submitterName']);
			add_post_meta($newpostid, 'submitter_email', $_POST['submitter-email']);
			add_post_meta($newpostid, 'link_to_application', $_POST['url-659']);
			add_post_meta($newpostid, 'description', $_POST['description']);
			}
		}


/*
=============================================================================================
define allowed block types
=============================================================================================
*/
add_filter( 'allowed_block_types', 'pcsd_allowed_block_types' );

function pcsd_allowed_block_types( $allowed_blocks ) {

	return array(
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/gallery',
		'core/list',
		'core/audio',
		'core/video',
		'core/table',
		'core/text-columns', // — Columns
		'core/buttons',
		//'core/quote', - need styling
		//'core/cover', //(previously core/cover-image)
		//'core/file', - we want to take a closer look at this one later
		//'core/verse', - revisit
		//'core/code', - needs styling
		//'core/freeform', // — Classic
		//'core/html', // — Custom HTML
		//'core/preformatted',
		//'core/pullquote', - revisit
		//(Deprecated) 'core/subhead', — Subheading
		//'core/media-text', // — Media and Text Revisit this one later
		//'core/more',
		//'core/nextpage', //— Page break
		//'core/separator',
		//'core/spacer',
		//'core/shortcode',
		//'core/archives',
		'core/categories',
		//'core/latest-comments',
		//'core/latest-posts',
		//'core/calendar',
		//'core/rss',
		//'core/search',
		//'core/tag-cloud',
		//'core/embed',
		//'core-embed/twitter',
		//'core-embed/youtube',
		//'core-embed/facebook',
		//'core-embed/instagram',
		//'core-embed/wordpress',
		//'core-embed/soundcloud',
		//'core-embed/spotify',
		//'core-embed/flickr',
		//'core-embed/vimeo',
		//'core-embed/animoto',
		//'core-embed/cloudup',
		//'core-embed/collegehumor',
		//'core-embed/dailymotion',
		//'core-embed/funnyordie',
		//'core-embed/hulu',
		//'core-embed/imgur',
		//'core-embed/issuu',
		//'core-embed/kickstarter',
		//'core-embed/meetup-com',
		//'core-embed/mixcloud',
		//'core-embed/photobucket',
		//'core-embed/polldaddy',
		//'core-embed/reddit',
		//'core-embed/reverbnation',
		//'core-embed/screencast',
		//'core-embed/scribd',
		//'core-embed/slideshare',
		//'core-embed/smugmug',
		//'core-embed/speaker',
		//'core-embed/ted',
		//'core-embed/tumblr',
		//'core-embed/videopress',
		//'core-embed/wordpress-tv'
	);
}
/*
=============================================================================================
register or unregister block patterns
=============================================================================================
*/
function my_plugin_unregister_my_patterns() {
	  remove_theme_support('core-block-patterns');
	  unregister_block_pattern_category('columns');
	  unregister_block_pattern_category('gallery');
	  unregister_block_pattern_category('text');
  }
add_action( 'init', 'my_plugin_unregister_my_patterns' );
// adds class .active to top menu item if the current active page is the page in the menu 
// so that we can style that differently.
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}