<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */

require_once 'detect/Mobile_Detect.php';
$detect = new Mobile_Detect;
global $detect;

//include 'loadpost-ajax/loadposts-ajax.php';

/*
*function remove margin-top: 31px !important;
*/
// function remove_admin_login_header() {
//   remove_action('wp_head', '_admin_bar_bump_cb');
// }
// add_action('get_header', 'remove_admin_login_header');

// flush_rewrite_rules( false );
// if ( ! isset( $content_width ) ) {
// 	$content_width = 860;
// }

//require get_template_directory() . '/options/options.php';

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'wp-mango' to the name of your theme in all the template files
	 */
	// load_theme_textdomain( 'wp-mango' );
	// Loads wp-content/languages/themes/kova-it_IT.mo.
	load_theme_textdomain( 'wp-mango', trailingslashit( WP_LANG_DIR ) . '/loco/themes' );

	// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
	load_theme_textdomain( 'wp-mango', get_stylesheet_directory() . '/languages' );

	// Loads wp-content/themes/kova/languages/it_IT.mo.
	load_theme_textdomain( 'wp-mango', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	//add_theme_support( 'automatic-feed-links' );

	//th fix
	remove_action('wp_head', 'feed_links_extra', 3 );
	remove_action('wp_head', 'feed_links', 2 );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );


	set_post_thumbnail_size( 680, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __('Primary Menu',      'wp-mango' ),
		'footer1' => __('Footer Menu 1',      'wp-mango' ),
		'footer2' => __('Footer Menu 2',      'wp-mango' ),
		'footer3' => __('Footer Menu 3',      'wp-mango' ),
		'footer4' => __('Footer Menu 4',      'wp-mango' ),

		// 'sitemap' => __('Sitemap Menu',      'wp-mango' ),
		'social'  => __('taxonomy Post', 'wp-mango' ),
	) );


	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );


	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentyfifteen_setup

add_action( 'after_setup_theme', 'twentyfifteen_setup' );



/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {


	register_sidebar( array(
		'name'          => __( 'Sidebar area 1', 'wp-mango' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar 1 shop.', 'wp-mango' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s c-sidebar1">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar area 2', 'wp-mango' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar 2 shop.', 'wp-mango' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s c-sidebar2">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );


	register_sidebar( array(
		'name'          => __( 'Widget Footer', 'wp-mango' ),
		'id'            => 'widget-footer',
		'description'   => __( 'Add widgets here to appear in your footer.', 'wp-mango' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => __( 'Widget Form subscribe', 'wp-mango' ),
		'id'            => 'widget-form-subs',
		'description'   => __( 'Add widgets here to appear Form subscribe', 'wp-mango' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'wp-mango' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'wp-mango' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'wp-mango' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'wp-mango' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );


/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Fifteen 1.7
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentyfifteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyfifteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyfifteen_resource_hints', 10, 2 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */


/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Fifteen 1.9
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyfifteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 22;
	$args['smallest'] = 8;
	$args['unit']     = 'pt';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyfifteen_widget_tag_cloud_args' );


/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';


/* ADD FUNCTION */
require get_template_directory() . '/function/theme.php';
//require get_template_directory() . '/function/woo.php';
//require get_template_directory() . '/function/qtranslate.php';


/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '1.0' );

	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0' );
	wp_enqueue_style( 'recruit', get_template_directory_uri() . '/assets/css/recruit.css', array(), '1.0' );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0' );
	// wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0' );

	wp_enqueue_style( 'style-wp', get_template_directory_uri() . '/style.css', array(), '1.0' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '', true );
	// wp_enqueue_script( 'owl', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '', true );
	//wp_enqueue_script( 'script-mango', 'https://mangoads.vn/scripts/custom.js', array( 'jquery' ), '', true );
	// wp_enqueue_script( 'script-owl', get_template_directory_uri() . '/assets/js/script_owl.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

// function add_ajax_to_js() {
//   wp_enqueue_script( 'loadstores-js', get_template_directory_uri() 
// 		. '/assets/js/stores/stores.js', ['jquery'], null, true );
//   wp_localize_script( 'loadstores-js', 'bobz', array(
//     'nonce' => wp_create_nonce( 'bobz' ),
//     'ajax_url' => admin_url( 'admin-ajax.php' )
//   ));
// }
// add_action( 'wp_enqueue_scripts', 'add_ajax_to_js' );


// [listpost type="wpsl_stores" meta="wpsl_city:binh duong" taxo="" pp="" layout="" id="1" class=""]
function create_post_shortcode( $args, $content ) {
    $meta= $args['meta'];   
    $taxo= $args['taxo'];
    if(isset($args['relation'])){
    	$meta_query = array('relation' => $args['relation']);
    	$tax_query = array('relation' => $args['relation']);
    }
    else{
    	$meta_query = [];
    	$tax_query = [];
    }
    

    if($meta != "") {
        $mt= explode("||",$meta);   
        $c1 = count($mt);
        for($i = 0; $i < $c1; $i++) {
            $sub = explode(":",$mt[$i]);    
            $vl= explode(",",$sub[1]);  
            $c2 = count($vl);
            for($j = 0; $j < $c2; $j++) { 
                $meta_query[]=array(
                    'key'     => $sub[0],
                    'value'   => $vl[$j],
                );  
            }
        }
    }

    if($taxo != "") {
        $tx= explode("||",$taxo);   
        $ct1 = count($tx);
        for($i = 0; $i < $ct1; $i++) {
            $subt = explode(":",$tx[$i]); 
            $term = explode(",",$subt[1]);    
            $tax_query[]=array(
                'taxonomy' => $subt[0],
                'field'    => 'id',
                'terms'    => $term,
            );
        }
    }
    $query = array(
        'post_type'=>$args['type'],
        'posts_per_page'=>$args['pp'],
        'orderby'=>'post_date',
        'order'=>'desc', 
        'meta_query' => $meta_query,
        'tax_query' => $tax_query,
    );

    $the_query = new WP_Query($query);
    ob_start();
    if($the_query->have_posts()): 
    	if($args['layout']=='') $args['layout'] = 1;
        echo '<div id="'.$args['id'].'" class="sc-post  sc-'.$args['layout'].'  '.$args['class'].'" data-owl-items="3">';
        $i=1;
        while ($the_query->have_posts() ) : $the_query->the_post();
            include('layout/sc-'.$args['layout'].'.php');  
            $i++;
        endwhile;
        echo '</div>';

        wp_reset_query();
    else:
    ?>
        <div class=" alert alert-danger" role="alert"> Không tìm thấy bài viết</div>
    <?php
    endif;
    $content = ob_get_contents(); 
    ob_end_clean();
    return $content;

}
add_shortcode('listpost', 'create_post_shortcode');

// 

if ( ! function_exists( 'wp_mango_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Twenty Fifteen 1.0
	 */
	function wp_mango_entry_meta() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'wp-mango' ) );
		}
	
		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
				sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'wp-mango' ) ),
				esc_url( get_post_format_link( $format ) ),
				get_post_format_string( $format )
			);
		}
	
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published link" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}
	
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date(),
				esc_attr( get_the_modified_date( 'c' ) ),
				get_the_modified_date()
			);
	
			printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
				_x( 'Posted on', 'Used before publish date.', 'wp-mango' ),
				esc_url( get_permalink() ),
				$time_string
			);
		}
	
		if ( 'post' == get_post_type() ) {
			if ( is_singular() || is_multi_author() ) {
				printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><i class="fa fa-user"></i><a class="url fn n" href="%2$s">%3$s</a></span></span>',
					_x( 'Author', 'Used before post author name.', 'wp-mango' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				);
			}

		}
	
		if ( is_attachment() && wp_attachment_is_image() ) {
			// Retrieve attachment metadata.
			$metadata = wp_get_attachment_metadata();
	
			printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
				_x( 'Full size', 'Used before full size attachment link.', 'wp-mango' ),
				esc_url( wp_get_attachment_url() ),
				$metadata['width'],
				$metadata['height']
			);
		}
	
		// if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		// 	echo '<span class="comments-link">';
		// 	comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'wp-mango' ), get_the_title() ) );
		// 	echo '</span>';
		// }
	}
	endif;


if ( ! function_exists( 'meta_categories' ) ) {

	function meta_categories(){
		// $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'wp-mango' ) );
		// if ( $categories_list && twentyfifteen_categorized_blog() ) {
		// 	printf( '<div class="article__meta--primary cat-links tags"><span class="screen-reader-text">%1$s </span>%2$s</div>',
		// 		_x( 'Categories', 'Used before category names.', 'wp-mango' ),
		// 		$categories_list
		// 	);
		// }

		// $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'wp-mango' ) );
		// if ( $tags_list && ! is_wp_error( $tags_list ) ) {
		// 	printf( '<div class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</div>',
		// 		_x( 'Tags', 'Used before tag names.', 'wp-mango' ),
		// 		$tags_list
		// 	);
		// }

		/*tho*/
		//get list category level1(parent, not child)
		$categories_list = get_the_category();
		$html_block = '<div class="article__meta--primary cat-links tags"><span class="screen-reader-text">'._x( 'Categories', 'Used before category names.', 'wp-mango' ).'</span>{{CATE}}</div>';
		$html_list = '';
		foreach($categories_list as $category) {
			if ($category->category_parent == 0) {
			    $html_list .= '<a href="'.get_category_link($category->cat_ID).'">'.$category->cat_name.'</a>, ';
			}
		}
		$html_list = substr($html_list, 0, -2);
		$html_block = str_replace('{{CATE}}',$html_list, $html_block);
		echo $html_block;
	}
}


// add_shortcode('wpblog_cat', 'wpblog_cat_des');
// add_filter('widget_text', 'do_shortcode');

// function wpblog_cat_des() {
// 	$demo = '<ul>';
// 	$listcat = get_terms( 'category' );
// 	if ( ! empty( $listcat ) ) {
// 		foreach ( $listcat as $key => $item ) {
// 			$demo .= '<li>'. $item->description . '</li>';
// 		}
// 	}
// 	$demo .= '</ul>';
// 	return $demo;
// }

if ( ! function_exists( 'ma_paginate_links' ) ) {

	function ma_paginate_links($wp_query){
		global $detect;
		if ( $detect->isMobile() ){
			if (  $wp_query->max_num_pages > 1 )
				echo '<div class="cm_loadmore">Xem thêm</div>';
		}else{
			echo '<nav class="pagination-wrapper" aria-label="Pagination">';
			$big = 999999999; // need an unlikely integer
			$translated = __( 'Page', 'wp-mango' ); // Supply translatable string
			
			echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
							'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
			) );
			
			echo '</nav>';
		}
	}
}

if ( ! function_exists( 'ma_blognav' ) ) {

	function ma_blognav(){
		?>
		<nav class=" marketing-nav marketing-nav--secondary" aria-label="Section Navigation">
		<ul  class="hidden-xs list-category marketing-nav__items">
						<?php wp_list_categories( array(
								'orderby'    => 'name',
								'show_count' => false,
								'exclude'    => array( 1 ),
								'use_desc_for_title' => false,
								// 'child_of'           => 121,
								'depth'               => 0,
								'hierarchical'        => true,
								'title_li'	=> ''
						) ); ?> 
		</ul>

		
	<div class="dropdown visible-xs">
		<button class="btn btn-outline dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Latest Articles
			<span class="caret"></span>
		</button>
			<ul  class="list-category dropdown-menu" aria-labelledby="dropdownMenu1">
						<?php wp_list_categories( array(
								'orderby'    => 'name',
								'show_count' => false,
								'exclude'    => array( 1 ),
								'use_desc_for_title' => false,
								// 'child_of'           => 121,
								'depth'               => 0,
								'hierarchical'        => true,
								'title_li'	=> ''

						) ); ?> 
			</ul>
	</div>

	</nav>
	<?php
	}

}


function add_description_to_menu($item_output, $item, $depth, $args) {

	if (strlen($item->description) > 0 ) {
		 $item_output .= sprintf('<span class="description">%s</span>', esc_html($item->description));
	}   
	return $item_output;
}
add_filter('walker_nav_menu_start_el', 'add_description_to_menu', 10, 4);


function cm_load_more_scripts() {
	global $wp_query; 
 
	wp_enqueue_script('jquery');
	wp_register_script( 'cm_loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array('jquery') );
	wp_localize_script( 'cm_loadmore', 'cm_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
		'is_home' => is_home()
	) );
 	wp_enqueue_script( 'cm_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'cm_load_more_scripts' );

function cm_loadmore_ajax_handler(){
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
	if($_POST['is_home']){
		$sticky = get_option( 'sticky_posts' );
		$args['post__not_in'] = $sticky;
	}

	query_posts( $args );
 
	if( have_posts() ) :
 
		while( have_posts() ): the_post();

			echo '<div class="col-xs-12 col-md-6">';
			get_template_part( 'content', get_post_format() );
			echo '</div>';
 
		endwhile;
 
	endif;
	die;
}
 
add_action('wp_ajax_loadmore', 'cm_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'cm_loadmore_ajax_handler');


/*
 * THEME
 ----------------------------------------------------------------------------
 */

// Theme option
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'  => 'Theme options', // Title hiển thị khi truy cập vào Options page
    'menu_title'  => 'Theme options', // Tên menu hiển thị ở khu vực admin
    'menu_slug'   => 'theme-settings', // Url hiển thị trên đường dẫn của options page
    'capability'  => 'edit_posts',
    'redirect'  => false
  ));
}

// require get_template_directory() . '/tuyen/functions.php';


function add_meta_tags() {
    global $post;
    if ( is_singular('post') ) {
        $content = new DOMDocument();
		$content->loadHTML(mb_convert_encoding($post->post_content, 'HTML-ENTITIES', 'UTF-8'));
		$finder = new DomXPath( $content );
		$classname = 'steps';
		$metas = $finder->query("//*[contains(@class, '$classname')]");
		$value = '';
		for( $i = 0; $i < $metas->length; $i++ ){
			$value .= $metas->item( $i )->nodeValue;
		}
		$value = str_replace( array("\n", "\r", "\t"), ' ', $value );

		echo '<meta name="description" content="' . trim($value) . '" />' . "\n";
        echo '<meta name="og:description" content="' . trim($value) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'add_meta_tags' , 2 );



add_filter( 'wpseo_opengraph_desc', 'remove_yoast_meta_description' );
function remove_yoast_meta_description( $myfilter ) {
    if ( is_singular ( 'post' ) ) {
        return false;
    }
    return $myfilter;
}