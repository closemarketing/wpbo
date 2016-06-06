<?php
/*
Author: David Perez
URL: https://www.closemarketing.es

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// Set content width
if ( ! isset( $content_width ) ) $content_width = 580;

/************* THEME OPTIONS *************/
function wpbo_theme_settings_functions() {
    // Thumbnail sizes
    add_image_size( 'wpbo-featured', 848, 300, true );
    add_image_size( 'wpbo-featured-home', 970, 311, true);
    add_image_size( 'wpbo-featured-carousel', 970, 400, true);

    /*** Title Tag since version WordPress 4.1 ***/
    add_theme_support( 'title-tag' );

    /*** Title Tag since version WordPress 4.5 ***/
    add_theme_support( 'custom-logo', array(
    	'height'      => 100,
    	'width'       => 200,
    	'flex-height' => true,
    	'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'wpbo_theme_settings_functions', 11 );

/**** THEME BLOCKS ***/
function wpbo_preheader() {
?>
<meta charset="utf-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php
do_action('wpbo_preheader');
}
function wpbo_doctype() {
?><!doctype html>
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<?php
do_action('wpbo_preheader');
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function wpbo_bootstrap_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => __('Main Sidebar','wpbo'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'description' => __('Used on every page BUT the homepage page template.','wpbo'),
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => __('Homepage Sidebar','wpbo'),
    	'description' => __('Used only on the homepage page template.','wpbo'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
    	'id' => 'sidebar-contact',
    	'name' => __('Contact Page Sidebar','wpbo'),
    	'description' => __('Used only on the homepage page template.','wpbo'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer1',
      'name' => __('Footer 1','wpbo'),
      'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer2',
      'name' => __('Footer 2','wpbo'),
      'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer3',
      'name' => __('Footer 3','wpbo'),
      'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
if ( ! function_exists( 'wpbo_bootstrap_comments' ) ) :
function wpbo_bootstrap_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard clearfix">
				<div class="avatar col-sm-3">
					<?php echo get_avatar( $comment, $size='75' ); ?>
				</div>
				<div class="col-sm-9 comment-text">
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit','wpbo'),'<span class="edit-comment btn btn-sm btn-info"><i class="glyphicon-white glyphicon-pencil"></i>','</span>') ?>

                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','wpbo') ?></p>
          				</div>
					<?php endif; ?>

                    <?php comment_text() ?>

                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>

					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!
endif;

// Display trackbacks/pings callback function
if ( ! function_exists( 'wpbo_list_pings' ) ) :
function wpbo_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php
}
endif;
/************* PAGE NAVI *****************/
if ( ! function_exists( 'wpbo_pagenavi' ) ) :
function wpbo_pagenavi()
{
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'   => TRUE,
			'prev_text'    => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
			'next_text'    => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<ul class="pagination">';
            foreach ( $pages as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul>';
        }
}
endif;
/************* SEARCH FORM LAYOUT *****************/

/****************** password protected post form *****/

add_filter( 'the_password_form', 'wpbo_custom_password_form' );

if ( ! function_exists( 'wpbo_custom_password_form' ) ) :
function wpbo_custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'wpbo') . '</p>' . '
	<label for="' . $label . '">' . __( "Password:" ,'wpbo') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'wpbo' ) . '" /></div>
	</form></div>
	';
	return $o;
}
endif;
/*********** update standard wp tag cloud widget so it looks better ************/

add_filter( 'widget_tag_cloud_args', 'wpbo_my_widget_tag_cloud_args' );

if ( ! function_exists( 'wpbo_my_widget_tag_cloud_args' ) ) :
function wpbo_my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}
endif;

// filter tag clould output so that it can be styled by CSS
if ( ! function_exists( 'wpbo_add_tag_class' ) ) :
function wpbo_add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";

    foreach( $tags as $tag ) {
    	$tagn[] = preg_replace($regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag );
    }

    $taglinks = implode('</a>', $tagn);

    return $taglinks;
}
endif;

add_action( 'wp_tag_cloud', 'wpbo_add_tag_class' );

add_filter( 'wp_tag_cloud','wpbo_tag_cloud_filter', 10, 2) ;

if ( ! function_exists( 'wpbo_tag_cloud_filter' ) ) :
function wpbo_tag_cloud_filter( $return, $args )
{
  return '<div id="tag-cloud">' . $return . '</div>';
}
endif;
// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

// Disable jump in 'read more' link
if ( ! function_exists( 'wpbo_remove_more_jump_link' ) ) :
function wpbo_remove_more_jump_link( $link ) {
	$offset = strpos($link, '#more-');
	if ( $offset ) {
		$end = strpos( $link, '"',$offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
endif;
add_filter( 'the_content_more_link', 'wpbo_remove_more_jump_link' );

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'wpbo_remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'wpbo_remove_thumbnail_dimensions', 10 );

if ( ! function_exists( 'wpbo_remove_thumbnail_dimensions' ) ) :
function wpbo_remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
endif;

// Add the Meta Box to the homepage template
if ( ! function_exists( 'wpbo_add_homepage_meta_box' ) ) :
function wpbo_add_homepage_meta_box() {
	global $post;

	// Only add homepage meta box if template being used is the homepage template
	// $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

	if ( $template_file == 'page-homepage.php' ){
	    add_meta_box(
	        'homepage_meta_box', // $id
	        'Optional Homepage Tagline', // $title
	        'wpbo_show_homepage_meta_box', // $callback
	        'page', // $page
	        'normal', // $context
	        'high'); // $priority
    }
}
endif;

add_action( 'add_meta_boxes', 'wpbo_add_homepage_meta_box' );

// Field Array
$prefix = 'custom_';
$wpbo_custom_meta_fields = array(
    array(
        'label'=> __('Homepage tagline area','wpbo'),
        'desc'  => __('Displayed underneath page title. Only used on homepage template. HTML can be used.','wpbo'),
        'id'    => $prefix.'tagline',
        'type'  => 'textarea'
    )
);

// The Homepage Meta Box Callback
if ( ! function_exists( 'wpbo_show_homepage_meta_box' ) ) :
function wpbo_show_homepage_meta_box() {
  global $wpbo_custom_meta_fields, $post;

  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );

  // Begin the field table and loop
  echo '<table class="form-table">';

  foreach ( $wpbo_custom_meta_fields as $field ) {
      // get value of this field if it exists for this post
      $meta = get_post_meta($post->ID, $field['id'], true);
      // begin a table row with
      echo '<tr>
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
              <td>';
              switch($field['type']) {
                  // text
                  case 'text':
                      echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" />
                          <br /><span class="description">'.$field['desc'].'</span>';
                  break;

                  // textarea
                  case 'textarea':
                      echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea>
                          <br /><span class="description">'.$field['desc'].'</span>';
                  break;
              } //end switch
      echo '</td></tr>';
  } // end foreach
  echo '</table>'; // end table
}
endif;

// Save the Data
if ( ! function_exists( 'wpbo_save_homepage_meta' ) ) :
function wpbo_save_homepage_meta( $post_id ) {

    global $wpbo_custom_meta_fields;

    // verify nonce
    if ( !isset( $_POST['wpbs_nonce'] ) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)) )
        return $post_id;

    // check autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
    }

    // loop through fields and save the data
    foreach ( $wpbo_custom_meta_fields as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta( $post_id, $field['id'], $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }
    } // end foreach
}
endif;
add_action( 'save_post', 'wpbo_save_homepage_meta' );

// Add thumbnail class to thumbnail links
if ( ! function_exists( 'wpbo_add_class_attachment_link' ) ) :
function wpbo_add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
    return $html;
}
endif;
add_filter( 'wp_get_attachment_link', 'wpbo_add_class_attachment_link', 10, 1 );

// Add lead class to first paragraph
if( !function_exists('wpbo_first_paragraph') ) {
function wpbo_first_paragraph( $content ){
    global $post;

    // if we're on the homepage, don't add the lead class to the first paragraph of text
    if( is_page_template( 'page-homepage.php' ) )
        return $content;
    else
        return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
}
add_filter( 'the_content', 'wpbo_first_paragraph' );
}
// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	 $class_names = $value = '';

		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;

		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	// if ( $args->has_children ) {
		  // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    // }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function

  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'wpbo_add_active_class', 10, 2 );

if ( ! function_exists( 'wpbo_add_active_class' ) ) :
function wpbo_add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}

  return $classes;
}
endif;

// enqueue styles
if( !function_exists("wpbo_theme_styles") ) {
    function wpbo_theme_styles() {
        // This is the main file for bootstrap
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'bootstrap' );

        // This is the main file for bootstrap
        wp_register_style( 'wpbo', get_template_directory_uri() . '/library/css/wpbo.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'wpbo' );

        // For child themes
        wp_register_style( 'wpbo-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'wpbo-style' );

        //Font Awesome
        wp_enqueue_style( 'wpbo-font-awesome', get_template_directory_uri() . '/library/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );
    }
}
add_action( 'wp_enqueue_scripts', 'wpbo_theme_styles' );


add_action( 'init', 'wpbo_add_editor_styles' );
/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function wpbo_add_editor_styles() {
    add_editor_style( 'library/css/editor-style.css' );
}

// enqueue javascript
if( !function_exists( "wpbo_theme_js" ) ) {
  function wpbo_theme_js(){

    wp_register_script( 'bootstrap',
      get_template_directory_uri() . '/library/js/bootstrap.min.js',
      array('jquery'),
      '1.2' );

    wp_register_script( 'wpbo-scripts',
      get_template_directory_uri() . '/library/js/scripts.js',
      array('jquery'),
      '1.2' );

    wp_enqueue_script('bootstrap');
    wp_enqueue_script('wpbo-scripts');
    //wp_enqueue_script('modernizr');
    //wp_enqueue_script('animate-it');
  }
}
add_action( 'wp_enqueue_scripts', 'wpbo_theme_js' );

// Adding Translation Option
load_theme_textdomain( 'wpbo', get_template_directory().'/languages' );

// loading jquery reply elements on single pages automatically
function wpbo_bootstrap_queue_js(){ if (!is_admin()){ if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script( 'comment-reply' ); }
}
// reply on comments script
add_action('wp_enqueue_scripts', 'wpbo_bootstrap_queue_js');

// Fixing the Read More in the Excerpts
// This removes the annoying ... to a Read More link
function wpbo_bootstrap_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="'.__('Read','wpbo').'  '.get_the_title($post->ID).'">'.__('Read more','wpbo').' &raquo;</a>';
}
add_filter('excerpt_more', 'wpbo_bootstrap_excerpt_more');

// Adding WP 3+ Functions & Theme Support
function wpbo_bootstrap_theme_support() {
	add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
	set_post_thumbnail_size(125, 125, true);   // default thumb size
	add_theme_support( 'custom-background' );  // wp custom background
	add_theme_support('automatic-feed-links'); // rss thingy
	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/
	// adding post format support
/*	add_theme_support( 'post-formats',      // post formats
		array(
			'aside',   // title less blurb
			'gallery', // gallery of images
			'link',    // quick link to other site
			'image',   // an image
			'quote',   // a quick quote
			'status',  // a Facebook like status update
			'video',   // video
			'audio',   // audio
			'chat'     // chat transcript
		)
	);*/
	add_theme_support( 'menus' );            // wp menus
	register_nav_menus(                      // wp3+ menus
		array(
			'main_nav' => __('The Main Menu','wpbo'),   // main nav in header
			'footer_links' => __('Footer Links','wpbo') // secondary nav in footer
		)
	);
}

// launching this stuff after theme setup
add_action('after_setup_theme','wpbo_bootstrap_theme_support');

// adding sidebars to WordPress (these are created in functions.php)
add_action( 'widgets_init', 'wpbo_bootstrap_register_sidebars' );

function wpbo_bootstrap_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(
    	array(
    		'menu' => 'main_nav', /* menu name */
    		'menu_class' => 'nav navbar-nav',
    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
    		'container' => 'false', /* container class */
    		'fallback_cb' => 'wpbo_bootstrap_main_nav_fallback', /* menu fallback */
    		// 'depth' => '2',  suppress lower levels for now
    		'walker' => new Bootstrap_walker()
    	)
    );
}

function wpbo_bootstrap_footer_links() {
	// display the wp3 menu if available
    wp_nav_menu(
    	array(
    		'menu' => 'footer_links', /* menu name */
    		'theme_location' => 'footer_links', /* where in the theme it's assigned */
    		'container_class' => 'footer-links clearfix', /* container class */
    		'fallback_cb' => 'wpbo_bootstrap_footer_links_fallback' /* menu fallback */
    	)
	);
}

// this is the fallback for header menu
function wpbo_bootstrap_main_nav_fallback() {
	// Figure out how to make this output bootstrap-friendly html
	//wp_page_menu( 'show_home=Home&menu_class=nav' );
}

// this is the fallback for footer menu
function wpbo_bootstrap_footer_links_fallback() {
	/* you can put a default here if you like */
}


/****************** PLUGINS & EXTRA FEATURES **************************/

/*********************
RELATED POSTS FUNCTION
*********************/
// Related Posts Function (call using bones_related_posts(); )
function wpbo_bones_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'wpbo' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end bones related posts function */

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function wpbo_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'wpbo_filter_ptags_on_images');
