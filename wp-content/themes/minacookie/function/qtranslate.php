<?php
/**
 * Language Selector Shortcode
*/
function qtranxf_dropdown() {
    global $q_config;

    if(is_404()) $url = get_option('home'); else $url = '';
    //print_r($q_config);

    $lang = 'ENGLISH';
    if($q_config['language'] == 'vi'){
        $lang = 'Tiếng Việt';
    } else if($q_config['language'] == 'ja'){
        $lang = '日本語';
    } 

    echo PHP_EOL.'<div class="lang-sel DropDown hover"><a class="DropDown-title cell" href="#"> <i class="icon-24"> </i><span>'.$lang.'</span></a><ul class="DropDown-content">'.PHP_EOL;
        foreach(qtranxf_getSortedLanguages() as $language) {
                //$alt = $q_config['language_name'][$language].' ('.$language.')';
                $alt = $q_config['language_name'][$language];
                $classes = array('lang-'.$language);
                if($language == $q_config['language']) $classes[] = 'active';
                echo '<li class="'. implode(' ', $classes) .'"><a href="'.qtranxf_convertURL($url, $language, false, true).'"';
                // set hreflang
                echo ' hreflang="'.$language.'"';
                echo ' title="'.$alt.'"';
                echo ' >';
                echo '<span >'.$alt.'</span>';
                echo '</a></li>'.PHP_EOL;
        }
    echo '</ul></div>'.PHP_EOL;
}
add_shortcode('qtranslate_dropdown', 'qtranxf_dropdown'); 

function qtranxf_list() {
    global $q_config;

    if(is_404()) $url = get_option('home'); else $url = '';

    echo PHP_EOL.'<ul class="language">'.PHP_EOL;
        foreach(qtranxf_getSortedLanguages() as $language) {
                $alt = $q_config['language_name'][$language].' ('.$language.')';
                $title = $q_config['language_name'][$language];
                $image = get_template_directory_uri().'/assets/images/flags/'.$q_config['flag'][$language];

                $classes = array('lang-'.$language);
                if($language == $q_config['language']) $classes[] = 'active';
                echo '<li class="'. implode(' ', $classes) .'"><a href="'.qtranxf_convertURL($url, $language, false, true).'"';
                echo ' hreflang="'.$language.'"';
                echo ' title="'.$alt.'"';
                echo ' >';
                echo '<span >'.$title.'</span>';
                //echo '<img src="'.$image.'"> <span >'.$title.'</span>';
                echo '</a></li>'.PHP_EOL;
        }
    echo '</ul>'.PHP_EOL;
}
add_shortcode('qtranslate_list', 'qtranxf_list'); 

