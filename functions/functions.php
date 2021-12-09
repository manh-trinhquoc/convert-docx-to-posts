<?php
/**
 * Convert_Docx_To_Posts
 *
 * @package   Convert_Docx_To_Posts
 * @author    Trinh Quoc manh <trinhquocmanh1990@gmail.com>
 * @copyright 2020
 * @license   GPL 2.0+
 * @link      
 */

/**
 * Get the settings of the plugin in a filterable way
 *
 * @since 1.0.0
 * @return array
 */
function cdtp_get_settings() {
	return apply_filters( 'cdtp_get_settings', get_option( CDTP_TEXTDOMAIN . '-settings' ) );
}
