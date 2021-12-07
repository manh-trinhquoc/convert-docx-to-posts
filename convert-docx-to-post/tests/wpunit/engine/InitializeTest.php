<?php

namespace Convert_Docx_To_Post\Tests\WPUnit;

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
		$classes[] = 'Convert_Docx_To_Post\Internals\PostTypes';
		$classes[] = 'Convert_Docx_To_Post\Internals\Shortcode';
		$classes[] = 'Convert_Docx_To_Post\Internals\Transient';
		$classes[] = 'Convert_Docx_To_Post\Integrations\CMB';
		$classes[] = 'Convert_Docx_To_Post\Integrations\Cron';
		$classes[] = 'Convert_Docx_To_Post\Integrations\FakePage';
		$classes[] = 'Convert_Docx_To_Post\Integrations\Template';
		$classes[] = 'Convert_Docx_To_Post\Integrations\Widgets';
		$classes[] = 'Convert_Docx_To_Post\Ajax\Ajax';
		$classes[] = 'Convert_Docx_To_Post\Ajax\Ajax_Admin';
		$classes[] = 'Convert_Docx_To_Post\Frontend\Enqueue';
		$classes[] = 'Convert_Docx_To_Post\Frontend\extras\Body_Class';

		foreach( $classes as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

}
