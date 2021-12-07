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
 * All the WP pointers.
 */
class Pointers extends Base {

	/**
	 * Initialize the Pointers.
	 *
	 * @since 1.0.0
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		new \PointerPlus( array( 'prefix' => CDTP_TEXTDOMAIN ) );
		\add_filter( 'convert_docx_to_post-pointerplus_list', array( $this, 'custom_initial_pointers' ), 10, 2 );
	}

	/**
	 * Add pointers.
	 * Check on https://github.com/Mte90/pointerplus/blob/master/pointerplus.php for examples
	 *
	 * @param array  $pointers The list of pointers.
	 * @param string $prefix   For your pointers.
	 * @since 1.0.0
	 * @return array
	 */
	public function custom_initial_pointers( array $pointers, string $prefix ) {
		return \array_merge(
			$pointers,
			array(
				$prefix . '_contextual_help' => array(
					'selector'   => '#show-settings-link',
					'title'      => \__( 'Boilerplate Help', CDTP_TEXTDOMAIN ),
					'text'       => \__( 'A pointer for help tab.<br>Go to Posts, Pages or Users for other pointers.', CDTP_TEXTDOMAIN ),
					'edge'       => 'top',
					'align'      => 'left',
					'icon_class' => 'dashicons-welcome-learn-more',
				),
			)
		);
	}

}
