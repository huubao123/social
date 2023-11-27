<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php //language_attributes(); ?> >
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/favicon1.ico">
    <?php wp_head(); ?>
    <link rel="canonical" href="https://minacookie.com" />
    <meta property="fb:pages" content="" />
    <link hreflang="x-default" href="https://minacookie.com" rel="alternate" />
    <link hreflang="en" href="https://minacookie.com" rel="alternate" />
  </head>
  <?php
  $header = get_field('info', 'option');
  ?>
  <body <?php body_class('l-body headertype_sticky headerpos_top'); ?>>
    <div id="wrapper" class="main">
      <!-- HEADER -->
      <?php global $detect; ?>
      <header id="header" class="l-header c-header">
        <div class="l-header-h">
          <div class="l-subheader">
            <div class="l-subheader-h i-cf">
              <div class="w-logo">
                <div class="w-logo-h">
                  <a class="w-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img class="w-logo-img" src="<?php echo $header['logo_header']['url']?>" alt="logo.png">
                  </a>
                </div>
              </div>
              <?php if(!$detect->isMobile()):?>
                <nav class="w-nav">
                  <div class="w-nav-h">
                    <div class="w-nav-control">
                      <i class="icon icon-7"></i>
                    </div>
                    <div class="w-nav-list layout_hor width_auto level_1">
                      <?php
                        wp_nav_menu(array(
                          'theme_location' => 'primary',
                          'menu_class' => 'w-nav-list-h ' 
                        ));
                      ?>
                    </div>
                  </div>
                </nav>
                <?php else:?>
                <span class="menu-btn x"><span></span></span>
              <?php endif;?>
              <div class="search-header">
                <?php 	get_search_form(); ?>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- /HEADER -->
      <!-- End Mainmenu --> 
    
      <?php if($detect->isMobile()):?>
      <div class="wrap-menu-mb" data-style="1">
        <div class="wrapul main mobile-center">
          <?php
              wp_nav_menu(
                  array(
                      'theme_location' => 'primary',
                      'menu_class'     => 'menu',
                      'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                  )
              );
          ?>
        </div> 
      </div>
      <?php endif;?>
      <!-- / wrap-menu-mb -->