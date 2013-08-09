<?php
/*
  Plugin Name: WP-CORS
  Plugin URI: https://github.com/zenozeng/wp-cors/
  Description: Yet another wordpress cross domain plugin
  Version: 0.0.1
  Author: Zeno Zeng
  Author: http://zenoes.com/
  License: GNU General Public License Version 3
*/

function wp_cors() {
    $origin = get_option('Access-Control-Allow-Origin');
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Authorization");
}

# This header should be sent above all
# $priority
# (int) Used to specify the order in which the functions
# associated with a particular action are executed.
# Lower numbers correspond with earlier execution,
# and functions with the same priority
# are executed in the order in which they were added to the action.
# Default: 10
add_action('init', 'wp_cors', 0);


# register setting
function wp_cors_register_setting() {
    add_settings_field('Access-Control-Allow-Origin',
                       'Access-Control-Allow-Origin',
                       'wp_cors_option',
                       'general');

    register_setting('general','Access-Control-Allow-Origin');
}
add_action( 'admin_init', 'wp_cors_register_setting' );

function wp_cors_option() {
    $name = 'Access-Control-Allow-Origin';
    $val = get_option($name);
    echo '<input name="'.$name.'" class="regular-text code" id="'.$name.'" type="text" value="'.$val.'" /> <p class="description">(eg. http://example.com)</p>';
}

