<?php

/*
 * Plugin Name:       Noob Auth
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Password management made easy.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Goutom Dash
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       noob
 * Domain Path:       /languages
 */

require_once plugin_dir_path(__FILE__) . 'functions/init.php';
require_once plugin_dir_path(__FILE__) . 'functions/create_custom_table.php';

add_action('init', 'noob_init');

register_activation_hook(__FILE__, 'create_custom_table');

