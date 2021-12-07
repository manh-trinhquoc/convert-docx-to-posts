<?php

namespace Convert_Docx_To_Post\Tests\WPUnit;

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
		$classes[] = 'Convert_Docx_To_Post\Backend\ActDeact';
		$classes[] = 'Convert_Docx_To_Post\Backend\Enqueue';
		$classes[] = 'Convert_Docx_To_Post\Backend\ImpExp';
		$classes[] = 'Convert_Docx_To_Post\Backend\Notices';
		$classes[] = 'Convert_Docx_To_Post\Backend\Pointers';
		$classes[] = 'Convert_Docx_To_Post\Backend\Settings_Page';

		$this->assertTrue( is_admin() );
		foreach( $classes as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

}
