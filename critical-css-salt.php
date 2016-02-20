<?php

    if(!defined('WPINC')) // MUST have WordPress.
        exit('Do NOT access this file directly: '.basename(__FILE__));
    /*
     * If implemented; this file should go in this special directory.
     *    `/wp-content/ac-plugins/my-ac-plugin.php`
     */
    function critical_css_salt_plugin() {
        /**
         * All plugins need a reference to this class object instance.
         *
         * @var $ac \zencache\advanced_cache Object instance.
         */
        $ac = $GLOBALS['zencache__advanced_cache']; // See: `advanced-cache.php`.
        /*
         * This plugin will dynamically modify the version salt.
         */
        $ac->add_filter(get_class($ac).'__version_salt', 'critical_css_salt_shaker');
    }
    critical_css_salt_plugin(); // Run this plugin.
    /*
     * Any other function(s) that may support your plugin.
     */
    function critical_css_salt_shaker($version_salt) {
        if ( isset($_COOKIE['fullCSS']) && $_COOKIE['fullCSS'] === 'true' )
            $version_salt .= 'fullcss'; // Give users with cached CSS files their own variation of the cache.
        else $version_salt .= 'inlinecss'; // A default group for all others.
        return $version_salt;
    }