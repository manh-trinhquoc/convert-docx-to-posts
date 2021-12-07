<?php

/**
 * Convert_Docx_To_Post
 *
 * @package   Convert_Docx_To_Post
 * @author    Trinh Quoc manh <trinhquocmanh1990@gmail.com>
 * @copyright 2020
 * @license   GPL 2.0+
 * @link      
 */

namespace Convert_Docx_To_Post\Backend;

use Convert_Docx_To_Post\Engine\Base;

/**
 * This class contain the Enqueue stuff for the backend
 */
class Enqueue extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// Load admin style sheet and JavaScript.
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}


	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_styles() {
		$admin_page = \get_current_screen();

		if ( !\is_null( $admin_page ) && 'toplevel_page_convert-docx-to-post' === $admin_page->id ) {
			\wp_enqueue_style( CDTP_TEXTDOMAIN . '-settings-styles', \plugins_url( 'assets/css/settings.css', CDTP_PLUGIN_ABSOLUTE ), array( 'dashicons' ), CDTP_VERSION );
		}

		\wp_enqueue_style( CDTP_TEXTDOMAIN . '-admin-styles', \plugins_url( 'assets/css/admin.css', CDTP_PLUGIN_ABSOLUTE ), array( 'dashicons' ), CDTP_VERSION );
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_scripts() {
		$admin_page = \get_current_screen();

		if ( !\is_null( $admin_page ) && 'toplevel_page_convert-docx-to-post' === $admin_page->id ) {
			\wp_enqueue_script( CDTP_TEXTDOMAIN . '-settings-script', \plugins_url( 'assets/js/settings.js', CDTP_PLUGIN_ABSOLUTE ), array( 'jquery', 'jquery-ui-tabs' ), CDTP_VERSION, false );
		}

		\wp_enqueue_script( CDTP_TEXTDOMAIN . '-admin-script', \plugins_url( 'assets/js/admin.js', CDTP_PLUGIN_ABSOLUTE ), array( 'jquery' ), CDTP_VERSION, false );
	}


}
