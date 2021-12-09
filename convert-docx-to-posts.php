<?php

/**
 * @package   Convert_Docx_To_Posts
 * @author    Trinh Quoc manh <trinhquocmanh1990@gmail.com>
 * @copyright 2020
 * @license   GPL 2.0+
 * @link
 *
 * Plugin Name:     Convert Docx To Posts
 * Plugin URI:      https://github.com/manh-trinhquoc/convert-docx-to-posts
 * Description:     Convert docx file to post. header 1 is used as separator and post title
 * Version:         1.0.0
 * Author:          Trinh Quoc manh
 * Author URI:      https://github.com/manh-trinhquoc/
 * Text Domain:     convert-docx-to-posts
 * License:         GPL 2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.0
 * WordPress-Plugin-Boilerplate-Powered: v3.2.0
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die('We\'re sorry, but you can not directly access this file.');
}

define('CDTP_VERSION', '1.0.0');
define('CDTP_TEXTDOMAIN', 'convert-docx-to-posts');
define('CDTP_NAME', 'Convert Docx To Posts');
define('CDTP_PLUGIN_ROOT', plugin_dir_path(__FILE__));
define('CDTP_PLUGIN_ABSOLUTE', __FILE__);
define('CDTP_MIN_PHP_VERSION', '7.0');
define('CDTP_WP_VERSION', '5.3');

// xác định xem có dùng symlink không
$file = __FILE__;
global $is_symlink;
$is_symlink = false;
if (strpos($file, 'plugins\convert-docx-to-posts') == false &&
    strpos($file, 'convert-docx-to-posts\convert-docx-to-posts') !== false) {
    $is_symlink = true;
}
// var_dump($file);
// var_dump(strpos($file, 'plugins\convert-docx-to-posts'));
// var_dump($is_symlink);

if (version_compare(PHP_VERSION, CDTP_MIN_PHP_VERSION, '<=')) {
    add_action(
        'admin_init',
        static function () {
            deactivate_plugins(plugin_basename(__FILE__));
        }
    );
    add_action(
        'admin_notices',
        static function () {
            echo wp_kses_post(
                sprintf(
                    '<div class="notice notice-error"><p>%s</p></div>',
                    __('"Convert Docx To Posts" requires PHP 5.6 or newer.', CDTP_TEXTDOMAIN)
                )
            );
        }
    );

    // Return early to prevent loading the plugin.
    return;
}

$convert_docx_to_posts_libraries = require_once CDTP_PLUGIN_ROOT . 'vendor/autoload.php';

require_once CDTP_PLUGIN_ROOT . 'functions/functions.php';

// Add your new plugin on the wiki: https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Plugin-made-with-this-Boilerplate




if (! wp_installing()) {
    add_action(
        'plugins_loaded',
        static function () use ($convert_docx_to_posts_libraries) {
            new \Convert_Docx_To_Posts\Engine\Initialize($convert_docx_to_posts_libraries);
        }
    );
}