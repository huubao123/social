<?php
  //load posts by Ajax
  if (!function_exists("getPost")) {
    function getPost() {
      if(!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'bobz')) {
        die('Permission denied!');
        $response = [
          'status'  => 500,
          'message' => 'Something is wrong, please try again later ...',
          'content' => false,
          'found'   => 0
        ];
      }

      $tax = $_POST['params']['tax'] ? 
            sanitize_text_field($_POST['params']['tax']): 'wpsl_store_category';
      $term = $_POST['params']['term'];
      $page = intval($_POST['params']['page']);
      $qty  = intval($_POST['params']['qty']) ? intval($_POST['params']['qty']): 6;
      $search = trim($_POST['params']['search']);
      
      if(trim($term) !== '' && trim($term) !== 'all') {
        $tax_qry[] = [
          'taxonomy' => $tax,
          'field'    => 'slug',
          'terms'    => $term,
        ];
      } else {
        $tax_qry[] = [
          'post_type'      => 'wpsl_stores',
          'post_status' => array('future', 'publish'),
        ];
      }

      $args = [
        'paged'          => $page,
        'post_type'      => 'wpsl_stores',
        'post_status' => array('future', 'publish'),
        'posts_per_page' => $qty,
        'tax_query'      => $tax_qry,
        'orderby' => 'title', // example: date
        'order' => 'ASC', // example: ASC
        's' => $search
      ];

      $query = new WP_Query($args);

      ob_start();
      $i = 0;
      ?>
      <div id="container-async-data" data-paged="<?php echo $qty; ?>"
      data-filter="<?php echo $tax; ?>"
      data-term="<?php echo $term; ?>">
        <div class="c-row-list1 c-row-list1-js">
          <div class="row">
            <?php
              if($query->have_posts()):
              while($query->have_posts()) : $query->the_post();
                $post_id = get_the_ID();
                $city = get_post_meta($post_id,'wpsl_city');
                $address = get_post_meta($post_id,'wpsl_address');
                $phone = get_post_meta($post_id, 'wpsl_phone');
                $lat = get_post_meta($post_id, 'wpsl_lat');
                $lng = get_post_meta($post_id, 'wpsl_lng');
                $email = get_post_meta($post_id, 'wpsl_email');
                $type = get_post_meta($post_id, 'wpsl_type_store');
                $url_web = get_post_meta($post_id, 'wpsl_url');
                $i++;
            ?>
            <div class="list1_card1 col-md-6 col-lg-4 efch-<?php echo $i; ?> ef-img-t">
              <div class="list1_inner">
                <div class="list1_img1 tRes_57">
                  <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                </div>

                <div class="list1_content1">
                  <h2 class="list1_title1"><?php echo get_the_title(); ?></h2>

                  <div class="info1">
                    <i class="icon icon-map-pin"></i>
                    <p class="info1_text1 text1-js text-capitalize"><?php echo $address[0]; ?></p>
                  </div>

                  <?php if($type): ?>
                  <div class="info1">
                    <i class="icon icon-map-pin"></i>
                    <p class="info1_text1"><?php echo $type[0]; ?></p>
                  </div>
                  <?php endif;?>

                  <a href="tel:<?php echo $phone[0]; ?>" class="info1 info1_link1">
                    <i class="icon icon-phone"></i>
                    <p class="info1_text1"><?php echo $phone[0]; ?></p>
                  </a>

                  <?php if($email): ?>
                  <a href="mailto:<?php echo $email[0]; ?>" class="info1 info1_link1">
                    <i class="icon icon-mail-1"></i>
                    <p class="info1_text1"><?php echo $email[0]; ?></p>
                  </a>
                  <?php endif;?>

                  <?php if($url_web): ?>
                  <a href="<?php echo $url_web[0]; ?>" class="info1 info1_link1" target="_blank">
                    <i class="icon icon-language"></i>
                    <p class="info1_text1"><?php echo $url_web[0]; ?></p>
                  </a>
                  <?php endif;?>
                </div>

                <a href="https://maps.google.com/?q=<?php echo $lat[0].','.$lng[0]; ?>" class="list1_btn1" target="_blank">
                  <i class="icon icon-map2"></i><span>Tìm đường</span>
                </a>
              </div>
            </div>
            <?php 
              endwhile; wp_reset_postdata();
              $response = [
                'status'=> 200,
                'found' => $query->found_posts
              ];
              else:
                $response = [
                  'status'  => 201,
                  'message' => 'Xin lỗi, không tìm thấy !'
                ];
              endif;?>
          </div>
        </div>

        <div class="c-page c-page-numbers">
          <?php pagination_tab($query,$page); ?>
        </div>
      </div>
      <?php
        $response['content'] = ob_get_clean();
        die(json_encode($response));
    }
  }

  add_action('wp_ajax_do_filter_posts', 'getPost');

  //handling AJAX requests from unauthenticated users
  add_action('wp_ajax_nopriv_do_filter_posts', 'getPost');

  /*
  @create shortcode for pagination
  */
  if (!function_exists("createShortCode")) {
    function createShortCode($atts) {
      $status = shortcode_atts( array(
        'tax' => 'wpsl_store_category',
        'active'   => false,
      ), $atts );

      $result = NULL;
        ob_start(); ?>
        <div id="container-async">
          <div id="container-async-data" data-paged="<?php echo $atts['per_page']; ?>"
          data-filter="<?php echo $status['tax']; ?>"
          data-term="">
            <div class="c-row-list1 c-row-list1-js">
              <div class="row">
                <?php
                  $query = new WP_Query(array(
                    'post_type'         => 'wpsl_stores',
                    'posts_per_page'    => $atts['per_page'],
                    'orderby' => 'title', // example: date
                    'order' => 'ASC', // example: ASC
                    'post_status' => array('future', 'publish'),
                    'paged' => get_query_var('page')
                  ));
                  if($query->have_posts()):
                    $i = 0;
                  while($query->have_posts()) : $query->the_post();
                    $post_id = get_the_ID();
                    $city = get_post_meta($post_id,'wpsl_city');
                    $address = get_post_meta($post_id,'wpsl_address');
                    $phone = get_post_meta($post_id, 'wpsl_phone');
                    $lat = get_post_meta($post_id, 'wpsl_lat');
                    $lng = get_post_meta($post_id, 'wpsl_lng');
                    $email = get_post_meta($post_id, 'wpsl_email');
                    $type = get_post_meta($post_id, 'wpsl_type_store');
                    $url_web = get_post_meta($post_id, 'wpsl_url');
                    $i++;
                ?>
                <div class="list1_card1 col-md-6 col-lg-4 efch-<?php echo $i; ?> ef-img-t">
                  <div class="list1_inner">
                    <div class="list1_img1 tRes_57">
                      <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                    </div>

                    <div class="list1_content1">
                      <h2 class="list1_title1"><?php echo get_the_title(); ?></h2>

                      <div class="info1">
                        <i class="icon icon-map-pin"></i>
                        <p class="info1_text1 text1-js text-capitalize"><?php echo $address[0]; ?></p>
                      </div>

                      <?php if($type): ?>
                      <div class="info1">
                        <i class="icon icon-home"></i>
                        <p class="info1_text1"><?php echo $type[0]; ?></p>
                      </div>
                      <?php endif; ?>

                      <a href="tel:<?php echo $phone[0]; ?>" class="info1 info1_link1">
                        <i class="icon icon-phone"></i>
                        <p class="info1_text1"><?php echo $phone[0]; ?></p>
                      </a>

                      <?php if($email): ?>
                      <a href="mailto:<?php echo $email[0]; ?>" class="info1 info1_link1">
                        <i class="icon icon-mail-1"></i>
                        <p class="info1_text1"><?php echo $email[0]; ?></p>
                      </a>
                      <?php endif; ?>

                      <?php if($url_web): ?>
                      <a href="<?php echo $url_web[0]; ?>" class="info1 info1_link1" target="_blank">
                        <i class="icon icon-language"></i>
                        <p class="info1_text1"><?php echo $url_web[0]; ?></p>
                      </a>
                      <?php endif;?>
                    </div>
                    <a href="https://maps.google.com/?q=<?php echo $lat[0].','.$lng[0]; ?>" class="list1_btn1" target="_blank">
                      <i class="icon icon-map2"></i><span>Tìm đường</span>
                    </a>
                  </div>
                </div>
                <?php 
                  endwhile; wp_reset_postdata();
                  else: _e('Xin lỗi, không tìm thấy.');
                  endif;?>
              </div>
            </div>

            <div class="c-page c-page-numbers">
              <?php pagination_tab($query,1); ?>
            </div>
          </div>
        </div>
      <?php $result = ob_get_clean();
      return $result;
    }
  }
  add_shortcode('multitab_ajax', 'createShortCode');

  function pagination_tab( $query = null, $paged = 1 ) {
    if (!$query)
      return;
    $big = 999999999; // need an unlikely interger
    
    $html = paginate_links( array(
      'paged' =>  (get_query_var('page')) ? absint(get_query_var('page')) : 1,
      'base'      => '%_%',
      'total' => $query->max_num_pages,
      'current'   => max(1, $paged),
      'show_all' => false,
      'end_size' => 0,
      'mid_size' => 1,
      'prev_next' => true,
      'prev_text' => __("<i class=\"icon icon-left-arrow\"></i>"),
      'next_text' => __("<i class=\"icon icon-arrow-4\"></i>")
    ));
    echo $html;
  }
?>
