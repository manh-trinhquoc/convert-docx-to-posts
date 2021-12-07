<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Convert_Docx_To_Posts
 * @author    Trinh Quoc manh <trinhquocmanh1990@gmail.com>
 * @copyright 2020
 * @license   GPL 2.0+
 * @link
 */
?>

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <div id="tabs" class="settings-tab">
        <ul>
            <li><a href="#tabs-1"><?php esc_html_e('Settings', CDTP_TEXTDOMAIN); ?></a></li>
            <?php
            ?>
        </ul>
        <?php
        require_once plugin_dir_path(__FILE__) . 'settings.php';
        ?>
        <?php
        ?>
    </div>

</div>