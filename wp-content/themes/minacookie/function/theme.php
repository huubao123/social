<?php

/*
 * THEME
 ----------------------------------------------------------------------------
 */
//Disable emoji
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

// add size image
if ( function_exists( 'add_image_size' ) ) {
 add_image_size( 'small', 50, 50);
}

/*
 * Paginate
 ----------------------------------------------------------------------------
 */
function paginate_posts(){
  global $the_query, $wp_rewrite;
  $total = $the_query->max_num_pages;
  if ( $total > 1 )  {
    if(is_home() || is_front_page()){
        $pagetitle = 'page';
    }else{
        $pagetitle = 'paged';
    }

    if ( !$current_page = get_query_var($pagetitle) )
    $current_page = 1;
     if( get_option('permalink_structure') ) {
         $format = 'page/%#%';
     } else {
         $format = 'page/%#%/';
     }
     $pagelink = get_pagenum_link(1);
     $pagelink = explode('?',$pagelink);
     $pagelink[0] .=  '%_%';
     echo paginate_links(array(
          'base'     => $pagelink[0],
          'format'   => $format,
          'current'  => $current_page,
          'total'    => $total,
          'mid_size' => 4,   
          'type'     => 'list',
            'prev_text'          => __('BACK'),
            'next_text'          => __('NEXT'),                            
     ));
  }
}

/*
 * Add Breadcrumb
 ----------------------------------------------------------------------------
 */


function the_breadcrumb() {
  global $post;
  $delimiter = '<span class="separator icon-4"></span>';
  echo '<nav aria-label="breadcrumbs" class="breadcrumbs"><ol itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList" role="list">';
  if (!is_home()) {
    echo '<a class="item" href="'. esc_url( home_url( '/' ) ). '"'. _e("Home").'</a>' . $delimiter ;
    if (is_category()) {
        echo single_cat_title();
    } elseif(is_single() && !is_attachment()) {
        $cats = get_the_category();
        $totalCat = count($cats);
        if($totalCat>1){
          $cat = $cats[$totalCat-2];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        }else{
          $parent_id = $cats[$totalCat-1]->category_parent; //category's parent ID
          if($parent_id)
            echo get_category_parents($parent_id, true, $delimiter);
        }
        $lastCategory = $cats[$totalCat-1];
        echo '<a href="'.get_category_link($cats[$totalCat-1]).'">'.$lastCategory->name.'</a>';
        // echo " / ";
        // echo the_title();
    }       
    elseif (is_search()) {
        echo $delimiter . 'search';
    }       
    elseif (is_page() && $post->post_parent) {
        echo $delimiter. '<a href="'.get_permalink($post->post_parent).'">';
        echo get_the_title($post->post_parent);
        echo "</a>";
        echo the_title();  
    }
    elseif (is_page() || is_attachment()) {
        echo $delimiter; 
        echo the_title();
    }
    elseif (is_author()) {
        echo wp_title(' / Profilo');
        echo "";
    }
    elseif (is_404()) {
        echo $delimiter ; 
    }       
    elseif (is_archive()) {
        echo wp_title(' / ');       
    }
  }
  echo '</ol></nav>';

}

// End Breadcrumb : the_breadcrumb(); 


/*
 * SEO HEADER
 ----------------------------------------------------------------------------
 */
function insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;

        if(is_front_page()) {
            $titlepage = get_bloginfo();
            $type = 'website';
        }else{
            $titlepage = get_the_title();
            $type = 'article';
        }
        if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
            $timage= esc_url(get_template_directory_uri()).'/assets/images/logo.svg';
        }
        else{
            $timage1 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            $timage = esc_attr( $timage1[0] );
        }
        // $seo_desc = get_field('seo_desc');
        // $seo_keywords = get_field('seo_keywords');

        //echo '<meta property="fb:admins" content="YOUR USER ID"/>';
        //echo '<meta property="fb:app_id" content="552380901503618" />';
        //echo '<meta name="google-site-verification" content="d7ivSI67s5D3VWWtSEuI7SHkz9tqniTx4eE_RNzOKsk" />';

        // echo '<meta name="description" content="'.$seo_desc.'" />';
        // echo '<meta name="keywords" content="' . $seo_keywords . '"/>';
        // echo '<meta property="og:title" content="' . $titlepage . '" />';                
        // echo '<meta property="og:description" content="'.$seo_desc.'" />';
        // echo '<meta property="og:url" content="' . get_permalink() . '" />';        
        // echo '<meta property="og:image" content="'.$timage.'" />';
        // //echo '<meta property="og:image:url" content="'.$timage.'" />';
        // echo '<meta property="og:site_name" content="' . $titlepage . '" />';
        // echo '<meta property="og:type" content="'. $type .'" />';
        //echo '<meta property="og:image:alt" content="' . $titlepage . '" />';
}
// add_action( 'wp_head', 'insert_fb_in_head', 5 );


// echo do_shortcode('[listpost id="xxx" class="xxxx" type="post" pp="5" taxo="category:5" layout="1"]');




/*
 * ADD SHORTCODE OF WIDGET
 ----------------------------------------------------------------------------
 */

function widgetShortcode($tag, $func){
         $scfn = 'add_'.'shortcode';
         $scfn ($tag, $func);
}
 
function xyst_widget_shortcode( $atts ){
  $abc=extract( shortcode_atts( array(
    'id' => ''
  ), $atts ) );
  $widget = '';
  global $wp_registered_sidebars, $wp_registered_widgets;
  if ( !isset($wp_registered_widgets[$id]) ) return ('Widget "'.$id.'" do not exists!');
  ob_start();
  $sidebar = array(
    'name' => esc_html__( 'Register Shortcode', 'wpsimple' ),
    'id' => 'sidebar_register_shortcode',
    'before_widget' => '<aside id="%1$s" class="widget  %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) ;//$wp_registered_sidebars['sidebar_register_shortcode'];
  
  $params = array_merge(
      array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
      (array) $wp_registered_widgets[$id]['params']
    );
  // Substitute HTML id and class attributes into before_widget
  $classname_ = '';
  foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
    if ( is_string($cn) )
      $classname_ .= '_' . $cn;
    elseif ( is_object($cn) )
      $classname_ .= '_' . get_class($cn);
  }
  $classname_ = ltrim($classname_, '_');
  $params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);
  $params = apply_filters( 'dynamic_sidebar_params', $params );
  $callback = $wp_registered_widgets[$id]['callback'];
  do_action( 'dynamic_sidebar', $wp_registered_widgets[$id] );

  if ( is_callable($callback) ) {
    call_user_func_array($callback, $params);
    $did_one = true;
  }
  $widget = ob_get_contents();
  ob_end_clean();    
 
  return $widget;
}
widgetShortcode( 'scwidget', 'xyst_widget_shortcode' );
//end add shortcode id widget
function xyst_in_widget_form($instance)
{   
    $number = $instance->number;
    $active = $number != '__i__' && is_numeric( $number );
    $id = $instance->id;
    if ($active){
        echo '<p>Copy shortcode below to display on page.</p><input class="widefat" type="text" readonly="readonly" style="font-family: monospace; background:#gray; border: 1px solid red; text-align:center;" value="'. esc_html( '[scwidget id="'.$id.'"]' ) .'" />';
    }
}
add_action('in_widget_form', 'xyst_in_widget_form'); 


/*
 * CUT STRING
 ----------------------------------------------------------------------------
 */
function cut_string($str,$len,$more){
  if ($str=="" || $str==NULL) return $str;
  if (is_array($str)) return $str;
  $str = trim($str);
  if (strlen($str) <= $len) return $str;
  $str = substr($str,0,$len);
  if ($str != "") {
  if (!substr_count($str," ")) {
  if ($more) $str .= " ...";
  return $str;
  }
  while(strlen($str) && ($str[strlen($str)-1] != " ")) {
  $str = substr($str,0,-1);
  }
  $str = substr($str,0,-1);
  if ($more) $str .= " ...";
  }
  return $str;
}

/*
 * LIMIT TITLE
 ----------------------------------------------------------------------------
 */
function limit_title($numberlimit){
  $tit = the_title('','',FALSE);
  echo substr($tit, 0, $numberlimit);
  if (strlen($tit) > $numberlimit) echo " ...";
}

/*
 * DISABLE SRCSET
 ----------------------------------------------------------------------------
 */

// function meks_disable_srcset( $sources ) {
//     return false;
// }
// add_filter( 'wp_calculate_image_srcset', 'meks_disable_srcset' );


/*
 * META DATE
 ----------------------------------------------------------------------------
 */
if ( ! function_exists( 'blog_entry_date' ) ) :
  function blog_entry_date() {
    global $post;
    $dates=date('Y/m/d',strtotime($post->post_date));
    $dates_arr= explode("/",$dates);
    
    $date = sprintf( '<span class="entry-date">%4$s</span>',
      esc_url(get_day_link($dates_arr[0],$dates_arr[1],$dates_arr[2])),
      esc_attr( get_the_time() ),
      esc_attr( date('Y/m/d H:i:s',strtotime($post->post_date)) ),
      esc_html( get_the_date('Y.m.d') )
    );
    printf(
      $date
    );
  }
endif;

/*
 * DOCTYPE
 ----------------------------------------------------------------------------
 */
//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
add_filter('language_attributes', 'add_opengraph_doctype');



/*
 * RANGE META QUERY
 ----------------------------------------------------------------------------
 */
function create_range_meta_query($name, $range, $delimiter = '-'){
    $query = array();
    switch($range[0]){
        case '<': $query[] = array('key' => $name, 'value' => substr($range,1), 'compare' => '<', 'type' => 'NUMERIC'); break;
        case '>': $query[] = array('key' => $name, 'value' => (int)substr($range,1), 'compare' => '>', 'type' => 'NUMERIC'); break;
        default:
            $range = explode($delimiter,$range);
            if(count($range) == 1){
                $query[] = array('key' => $name, 'value' => substr($range,1), 'compare' => '=', 'type' => 'NUMERIC');
            }else{
                $query[] = array('key' => $name, 'value' => $range[0], 'compare' => '>=', 'type' => 'NUMERIC');
                $query[] = array('key' => $name, 'value' => $range[1], 'compare' => '<', 'type' => 'NUMERIC');
            } 
    }
    return $query;
}
 
/*=========================Tho_dang=========================*/
/*
*action: add class to link in post's content
*/
function posts_link_next_class($format){
  $format = str_replace('href=', 'class="c-page2__btn1 next" href=', $format);
  return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="c-page2__btn1 prev" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');

// Polylang Shortcode - https://wordpress.org/plugins/polylang/
// Add this code in your functions.php
// Put shortcode [polylang] to post/page for display flags
function polylang_shortcode() {
  ob_start();
  pll_the_languages(array('show_flags'=>0,'show_names'=>1));
  $flags = ob_get_clean();
  return $flags;
}
add_shortcode( 'polylang', 'polylang_shortcode' );

/*
@Custom field
*/
//I just added '!' below at Match 1 2019, if false, please delete it!^^

// if ( function_exists("acf_add_options_page") ) {
//   acf_add_options_page();

//   acf_add_options_page(array(
//     "page_title" => "Theme Options",
//     "menu_title" => 'Theme Options',
//     "menu_slug" => 'theme-options',
//     'capability' => 'edit_posts',
//     'parent_slug' => '',
//     'position' => false,
//     'icon_url' => false,
//     'redirect' => false
//   ));

//   acf_add_options_page(array(
//     "page_title" => "Header",
//     "menu_title" => 'Header',
//     "menu_slug" => 'theme-options-header',
//     'capability' => 'edit_posts',
//     'parent_slug' => 'theme-options',
//     'position' => false,
//     'icon_url' => false
//   ));

//   acf_add_options_page(array(
//     "page_title" => "Footer",
//     "menu_title" => 'Footer',
//     "menu_slug" => 'theme-options-footer',
//     'capability' => 'edit_posts',
//     'parent_slug' => 'theme-options',
//     'position' => false,
//     'icon_url' => false
//   ));

//   acf_add_options_page(array(
//     "page_title" => "sidebar",
//     "menu_title" => 'Sidebar',
//     "menu_slug" => 'theme-options-sidebar-vn',
//     'capability' => 'edit_posts',
//     'parent_slug' => 'theme-options',
//     'position' => false,
//     'icon_url' => false
//   ));
// }

// /*
// *Custom Post type(Video)
// */
// function createCustomPostType_Video() {
//   //$label uses for contain text which relative to the name
//   //of post type
//   $label = array(
//     'name' => 'Video',
//     'singular_name' => 'video'
//   );

//   $array = array(
//     'labels' => $label,
//     'supports' => array(
//       'title',
//       'editor',
//       'excerpt',
//       'author',
//       'thumbnail',
//       'comments',
//       'trackbacks',
//       'revisions',
//       'custom-fields'
//     ),
//     'hierarchical' => false, //allow decentralization, if false => like post, true => like page
//     'public' => true, //activated post type
//     'show_ui' => true, //show manager box like Post/Page
//     'show_in_menu' => true, //show on Admin menu(left)
//     'show_in_nav_menus' => true, //show on Appearance -> Menus
//     'show_in_admin_bar' => true, //show on Admin bar(black)
//     'menu_position' => 5, //order show in menu(left)
//     'menu_icon' => '',
//     'can_export' => true, //Can export content by Tools -> Export
//     'has_archive' => true, //allow store (month, date, year)
//     'exclude_from_search' => false, //delete from search result
//     'publicly_queryable' => true, //Show parameters on query, must to set true.
//     'capability_type' => 'post', //
//     //taxonomys be admit to separate contents
//     'taxonomies' => array( 'video_categories', 'post_tag' )
//   );

//   register_post_type("Video", $array);
// }
// add_action('init', 'createCustomPostType_Video');

// //show custom post type in main layout
// add_filter('pre_get_posts', 'getCustomPostType_Video');
// function getCustomPostType_Video($query) {
//   if(is_home() && $query -> is_main_query()) {
//     $query-> set('post_type', array('post', 'Video'));
//   }
//   return $query;
// }

// // Register Custom Taxonomy
// function video_taxonomy() {
//   $labels = array(
//     'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
//     'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
//     'menu_name'                  => __( 'Categories', 'text_domain' ),
//     'all_items'                  => __( 'All Items', 'text_domain' ),
//     'parent_item'                => __( 'Parent Item', 'text_domain' ),
//     'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
//     'new_item_name'              => __( 'New Item Name', 'text_domain' ),
//     'add_new_item'               => __( 'Add New Item', 'text_domain' ),
//     'edit_item'                  => __( 'Edit Item', 'text_domain' ),
//     'update_item'                => __( 'Update Item', 'text_domain' ),
//     'view_item'                  => __( 'View Item', 'text_domain' ),
//     'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
//     'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
//     'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
//     'popular_items'              => __( 'Popular Items', 'text_domain' ),
//     'search_items'               => __( 'Search Items', 'text_domain' ),
//     'not_found'                  => __( 'Not Found', 'text_domain' ),
//     'no_terms'                   => __( 'No items', 'text_domain' ),
//     'items_list'                 => __( 'Items list', 'text_domain' ),
//     'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
//   );
//   $args = array(
//     'labels'                     => $labels,
//     'hierarchical'               => true,
//     'public'                     => true,
//     'show_ui'                    => true,
//     'show_admin_column'          => true,
//     'show_in_nav_menus'          => true,
//     'show_tagcloud'              => true,
//     'rewrite'           => array(
//       'slug'              => 'videos',
//       'hierarchical'      => true
//     )
//   );
//   register_taxonomy( 'video_categories', array( 'video' ), $args );
// }
// add_action( 'init', 'video_taxonomy', 0 );


/**
* @add link category in list post
**/
if ( !function_exists("addLinkCategory")) {
  function addLinkCategory($catName) {
    $catID = get_cat_ID($catName);
    $catLink = get_category_link($catID);
    //----------------------------------------
    return $catLink;
  }
}

/**
* @pagination for category
**/
if (!function_exists("pagination")) {
  function pagination($query) {
    global $wp_query;
    $big = 999999999; // need an unlikely integer

    if ($query == NULL) {
      $query = $wp_query;
    } else $query = $query;

    $html = paginate_links( array(
      'paged' =>  ( get_query_var('paged') ) ? absint(get_query_var('paged')) : 1,
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'total' => $query->max_num_pages,
      'show_all' => false,
      'end_size' => 2,
      'mid_size' => 0,
      'prev_next' => true,
      'prev_text' => __("<i class=\"icon iconmoon-back1\"></i>"),
      'next_text' => __("<i class=\"icon iconmoon-next\"></i>")
    ));
    echo $html;
  }
}

/**
 * Filter the except length to 50 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 70;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// add more link to excerpt
function themify_custom_excerpt_more($more) {
   global $post;
   // return '<a class="more-link" href="'. get_permalink($post->ID) . '">'. __('[...]', 'themify') .'</a>';
}
add_filter('excerpt_more', 'themify_custom_excerpt_more');

/** 
* ACTION: Sort posts was pinged on the top of the list in page home, then show remain posts.
*/
function checkAnyPostWasPing($array) {
  $check = false;
  foreach($array as $k => $v) {
    if(get_field('ping_post', $v->ID)) {
      $check = true;
      break;
    }
  }
  return $check;
}

function quicksort($array) {
  if(count($array) < 2) return $array;

  $left = $right = array();
  $backup = $array;
  $hasPing = false;
  end($array);
  $pivot_key = key($array);
  $pivot = array_pop($array);

  foreach($array as $k => $v) {
    if(get_field('ping_post', $v->ID)) {
      $left[$k] = $v;
    } else {
      $right[$k] = $v;
    }
  }
  return array_merge(quicksort($left), array($pivot_key => $pivot), quicksort($right));
}

/**
 *Action: change url search page
*/
// function wpb_change_search_url() {
//   if ( is_search() && ! empty( $_GET['s'] ) ) {
//     wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
//     exit();
//   }   
// }
// add_action( 'template_redirect', 'wpb_change_search_url' );

/** 
* ACTION: Change title page search
*/
// add_filter('pre_get_document_title', 'change_search_title', 50);
// function change_search_title($title) {
//   if(is_search()) {
//     global $wp_query;
//     $title = $wp_query->found_posts.__(' ', 'wp-mango').get_search_query();
//   }
//   return $title;
// }



