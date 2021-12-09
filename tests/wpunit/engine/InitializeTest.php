<?php

namespace Convert_Docx_To_Posts\Tests\WPUnit;

class InitializeTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

	wp_set_current_user(0);
	wp_logout();
	wp_safe_redirect(wp_login_url());
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be front
	 */
	public function it_should_be_front() {
		$classes   = array();
		$classes[] = 'Convert_Docx_To_Posts\Internals\PostTypes';
		$classes[] = 'Convert_Docx_To_Posts\Internals\Shortcode';
		$classes[] = 'Convert_Docx_To_Posts\Internals\Transient';
		$classes[] = 'Convert_Docx_To_Posts\Integrations\CMB';
		$classes[] = 'Convert_Docx_To_Posts\Integrations\Cron';
		$classes[] = 'Convert_Docx_To_Posts\Integrations\FakePage';
		$classes[] = 'Convert_Docx_To_Posts\Integrations\Template';
		$classes[] = 'Convert_Docx_To_Posts\Integrations\Widgets';
		$classes[] = 'Convert_Docx_To_Posts\Ajax\Ajax';
		$classes[] = 'Convert_Docx_To_Posts\Ajax\Ajax_Admin';
		$classes[] = 'Convert_Docx_To_Posts\Frontend\Enqueue';
		$classes[] = 'Convert_Docx_To_Posts\Frontend\extras\Body_Class';

		foreach( $classes as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

}
