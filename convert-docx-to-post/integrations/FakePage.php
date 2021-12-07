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

namespace Convert_Docx_To_Post\Integrations;

use Convert_Docx_To_Post\Engine\Base;

/**
 * Fake Pages inside WordPress
 */
class FakePage extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		new \Fake_Page(
			array(
				'slug'         => 'fake_slug',
				'post_title'   => 'Fake Page Title',
				'post_content' => 'This is the fake page content',
			)
		);
	}

}
