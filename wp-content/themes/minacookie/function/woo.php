<?php
function woocommerce_ajax_add_to_cart_js() {
    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('woocommerce-ajax-add-to-cart', get_template_directory_uri() . '/assets/js/ajax-add-to-cart.js', array('jquery'), '', true);
    }
}
add_action('wp_enqueue_scripts', 'woocommerce_ajax_add_to_cart_js', 99);


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
        
function woocommerce_ajax_add_to_cart() {
 
            $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
            $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
            $variation_id = absint($_POST['variation_id']);
            $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
            $product_status = get_post_status($product_id);
 
            if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
 
                do_action('woocommerce_ajax_added_to_cart', $product_id);
 
                if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                    wc_add_to_cart_message(array($product_id => $quantity), true);
                }
 
                WC_AJAX :: get_refreshed_fragments();
            } else {
 
                $data = array(
                    'error' => true,
                    'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
 
                echo wp_send_json($data);
            }
 
            wp_die();
}


// Add Shortcode
// function custom_mini_cart() {

//     echo '<a href="#" class="dropdown-back" data-toggle="dropdown"> ';
//         echo '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
//         echo '<div class="basket-item-count" style="display: inline;">';
//             echo '<span class="cart-items-count count">';
//                 echo WC()->cart->get_cart_contents_count();
//             echo '</span>';
//         echo '</div>';
//     echo '</a>';
//     echo '<ul class="dropdown-menu dropdown-menu-mini-cart">';
//             echo '<li> <div class="widget_shopping_cart_content">';
//                       woocommerce_mini_cart();
//                 echo '</div></li></ul>';

// }
// add_shortcode( '[custom-mini-cart]', 'custom_mini_cart' );

?>