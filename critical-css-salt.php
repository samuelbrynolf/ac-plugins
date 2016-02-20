<?php if(!defined('WPINC')) // MUST have WordPress.
    exit('Do NOT access this file directly: '.basename(__FILE__));

function critical_css_salt_plugin() {
    $ac = $GLOBALS['zencache__advanced_cache'];
    $ac->add_filter(get_class($ac).'__version_salt', 'critical_css_salt_shaker');
}
critical_css_salt_plugin(); 

function critical_css_salt_shaker($version_salt) {
    if ( isset($_COOKIE['fullCSS']) && $_COOKIE['fullCSS'] === 'true' )
        $version_salt .= 'fullcss';
    else $version_salt .= 'inlinecss';
    return $version_salt;
}