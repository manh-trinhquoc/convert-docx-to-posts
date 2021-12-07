<?php

namespace Convert_Docx_To_Posts\Tests\WPUnit;

class InitializeAdminTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

	$user_id = $this->factory->user->create( array( 'role' => 'administrator' ) );
		wp_set_current_user( $user_id );
		set_current_screen( 'edit.php' );
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be admin
	 */
	public function it_should_be_admin() {
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
		$classes[] = 'Convert_Docx_To_Posts\Backend\ActDeact';
		$classes[] = 'Convert_Docx_To_Posts\Backend\Enqueue';
		$classes[] = 'Convert_Docx_To_Posts\Backend\ImpExp';
		$classes[] = 'Convert_Docx_To_Posts\Backend\Notices';
		$classes[] = 'Convert_Docx_To_Posts\Backend\Pointers';
		$classes[] = 'Convert_Docx_To_Posts\Backend\Settings_Page';

		$this->assertTrue( is_admin() );
		foreach( $classes as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

}
