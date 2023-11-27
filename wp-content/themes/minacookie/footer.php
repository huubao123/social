<?php
/**
* The template for displaying the footer
*
* Contains the closing of the "site-content" div and all content after.
*
* @package WordPress
* @subpackage Twenty_Fifteen
* @since Twenty Fifteen 1.0
*/
?>
 <?php
  $header = get_field('info', 'option');
  ?>
</div><!-- .site-content -->

      <div id="footer-pc" class=" group-ef lazy-hidden">
        <div class="container-fluid">
          <div class="row grid-space-10">
            <div class="col-sm-5 col-lg-4 col-md-5 efch-1 ef-img-t">
              <div class="widget widget-info">
                <h3 class="title1"><?php echo $header['title_footer']?></h3>
                <p>Address: <?php echo $header['address']?></p>
                <p>Email: <?php echo $header['email']?></p>
                <p>Phone: <a href="tel: <?php echo $header['phone']?>"><?php echo $header['phone']?></a></p>
                <ul class="blog-item-social ">
                  <li><a class="item" title="" target="_blank" href="<?php echo $header['link_f']?>"><i class="icon-facebook"></i></a></li>
                  <li><a class="item" title="" target="_blank" href="<?php echo $header['link_in']?>"><i class="icon-linkedin"></i></a></li>
                </ul>             
              </div>   
                <?php if ( is_active_sidebar( 'widget-footer' ) ) : ?>
                  <?php dynamic_sidebar( 'widget-footer' ); ?>
                <?php endif; ?>    
            </div>

            <div class="col-sm-7 col-lg-8 col-md-7">
              <div class="row">
                  <div class="col-sm-6 col-lg-3 col-md-6  efch-1 ef-img-t">
                    <div class="widget">
                      <h4 class="widget-title">GIỚI THIỆU</h4>
                    <?php
                      wp_nav_menu(
                          array(
                              'theme_location' => 'footer1',
                              'menu_class'     => 'menu footer-menu',
                              'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                          )
                      );
                      ?>
                      </div>
                  </div>
                  <div class="col-sm-6 col-lg-3 col-md-6  efch-1 ef-img-t">
                    <div class="widget">
                      <h4 class="widget-title">DỊCH VỤ</h4>
                      <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer2',
                                'menu_class'     => 'menu footer-menu',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            )
                        );
                        ?>
                    </div>
                  </div>


                  <div class="col-sm-6 col-lg-3 col-md-6  efch-1 ef-img-t">
                    <div class="widget">
                      <h4 class="widget-title">THÔNG TIN</h4>
                  <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer3',
                            'menu_class'     => 'menu footer-menu',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        )
                    );
                    ?>
                    </div>

                  </div>

                  <div class="col-sm-6 col-lg-3 col-md-6  efch-1 ef-img-t">
                    <div class="widget">
                      <h4 class="widget-title">LIÊN HỆ</h4>
                    <?php
                      wp_nav_menu(
                          array(
                              'theme_location' => 'footer4',
                              'menu_class'     => 'menu footer-menu',
                              'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                          )
                      );
                      ?>
                    </div>
                  </div>

              </div>
            </div>  
          </div>
        </div>

        <a id="back-top" class="back-top-1 show" href="#"><i class="icon-1 it"></i> <span>TOP</span></a>
      </div>

      <div id="footer-mb" class=" group-ef lazy-hidden">
        <div class="container">
          <div class="widget widget-info">
            <div><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"> 
              <img src="<?php echo $header['logo_header']['url']?>" 
              alt="logo.png"></a>
              </div>
            <?php if ( is_active_sidebar( 'widget-footer' ) ) : ?>
                  <?php dynamic_sidebar( 'widget-footer' ); ?>
            <?php endif; ?>    
          </div>

          <div class="accodion accodion-0">
            <div class="accodion-tab ">
              <input type="checkbox" id="chck_mf">
              <label class="accodion-title" for="chck_mf"><span> Mở rộng </span> <span class="triangle"><i class="icon-plus"></i></span> </label>
              <div class="accodion-content">
                <div class="inner">
                  <div class="row grid-space-10">

                  <div class="col-md-3 col-6  efch-2 ef-img-t">
                    <div class="widget">
                      <h4 class="widget-title">GIỚI THIỆU</h4>
                    <?php
                      wp_nav_menu(
                          array(
                              'theme_location' => 'footer1',
                              'menu_class'     => 'menu footer-menu',
                              'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                          )
                      );
                      ?>
                      </div>
                  </div>
                  <div class="col-md-3 col-6  efch-2 ef-img-t">
                    <div class="widget">
                      <h4 class="widget-title">DỊCH VỤ</h4>
                      <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer2',
                                'menu_class'     => 'menu footer-menu',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            )
                        );
                        ?>
                    </div>
                  </div>


                  <div class="col-md-3 col-6  efch-2 ef-img-t">
                    <div class="widget">
                      <h4 class="widget-title">THÔNG TIN</h4>
                  <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer3',
                            'menu_class'     => 'menu footer-menu',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        )
                    );
                    ?>
                    </div>

                  </div>

                  <div class="col-md-3 col-6  efch-2 ef-img-t">
                    <div class="widget">
                      <h4 class="widget-title">LIÊN HỆ</h4>
                    <?php
                      wp_nav_menu(
                          array(
                              'theme_location' => 'footer4',
                              'menu_class'     => 'menu footer-menu',
                              'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                          )
                      );
                      ?>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!--End footer mobie-->
    </div> <!--End #Wrapper-->
    <?php wp_footer(); ?>
    <?php $assets = 'https://luxlisa.com'; ?>
    <!-- <script defer type='text/javascript' src='<?php //echo esc_url(get_template_directory_uri()); ?>/assets/js/responsive.js'></script> -->
  </body>
</html>
