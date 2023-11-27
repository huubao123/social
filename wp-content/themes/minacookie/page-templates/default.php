<?php 

/**
 * Template Name: Default page
 * 
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in JV Gold consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 * @package WordPress
 * @subpackage Ufree
 * @since 1.0
 * @version 1.0
 */
 
// Start the session
//session_start();

// RENDER AFFIX 

get_header(); 
$detect = new Mobile_Detect;

?>

<?php 
if( $detect->isMobile() && !$detect->isTablet()  ){ ?>     
<?php 
}else { 
?>
<?php
}
?>


<section class="p-contact2 mg65 section"  >
  <?php the_content();?>
</section>


<?php get_footer(); ?>
