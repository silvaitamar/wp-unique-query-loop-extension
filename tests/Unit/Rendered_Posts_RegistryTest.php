<?php
/**
 * Unit tests for the rendered posts registry.
 *
 * @package UniqueQueryLoopExtension
 */

namespace UniqueQueryLoopExtension\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use UniqueQueryLoopExtension\Registry\Rendered_Posts_Registry;

/**
 * @covers \UniqueQueryLoopExtension\Registry\Rendered_Posts_Registry
 */
final class Rendered_Posts_RegistryTest extends TestCase {

	/**
	 * Reset the registry static state before each test.
	 */
	protected function setUp(): void {
		parent::setUp();

		$reflection = new ReflectionClass( Rendered_Posts_Registry::class );

		$ids = $reflection->getProperty( 'post_ids' );
		$ids->setAccessible( true );
		$ids->setValue( null, array() );

		$depth = $reflection->getProperty( 'tracking_depth' );
		$depth->setAccessible( true );
		$depth->setValue( null, 0 );
	}

	public function test_not_tracking_by_default(): void {
		$this->assertFalse( Rendered_Posts_Registry::is_tracking() );
		$this->assertSame( array(), Rendered_Posts_Registry::get_ids() );
	}

	public function test_begin_and_end_tracking_toggle_state(): void {
		Rendered_Posts_Registry::begin_tracking();
		$this->assertTrue( Rendered_Posts_Registry::is_tracking() );

		Rendered_Posts_Registry::end_tracking();
		$this->assertFalse( Rendered_Posts_Registry::is_tracking() );
	}

	public function test_nested_tracking_requires_matching_end_calls(): void {
		Rendered_Posts_Registry::begin_tracking();
		Rendered_Posts_Registry::begin_tracking();
		$this->assertTrue( Rendered_Posts_Registry::is_tracking() );

		Rendered_Posts_Registry::end_tracking();
		$this->assertTrue( Rendered_Posts_Registry::is_tracking() );

		Rendered_Posts_Registry::end_tracking();
		$this->assertFalse( Rendered_Posts_Registry::is_tracking() );
	}

	public function test_end_tracking_never_goes_negative(): void {
		Rendered_Posts_Registry::end_tracking();
		Rendered_Posts_Registry::end_tracking();
		$this->assertFalse( Rendered_Posts_Registry::is_tracking() );

		Rendered_Posts_Registry::begin_tracking();
		$this->assertTrue( Rendered_Posts_Registry::is_tracking() );
	}

	public function test_register_is_ignored_when_not_tracking(): void {
		Rendered_Posts_Registry::register( 10 );
		$this->assertSame( array(), Rendered_Posts_Registry::get_ids() );
	}

	public function test_register_collects_ids_while_tracking(): void {
		Rendered_Posts_Registry::begin_tracking();
		Rendered_Posts_Registry::register( 10 );
		Rendered_Posts_Registry::register( 20 );
		$this->assertSame( array( 10, 20 ), Rendered_Posts_Registry::get_ids() );
	}

	public function test_register_deduplicates_ids(): void {
		Rendered_Posts_Registry::begin_tracking();
		Rendered_Posts_Registry::register( 10 );
		Rendered_Posts_Registry::register( 10 );
		$this->assertSame( array( 10 ), Rendered_Posts_Registry::get_ids() );
	}

	public function test_register_ignores_non_positive_ids(): void {
		Rendered_Posts_Registry::begin_tracking();
		Rendered_Posts_Registry::register( 0 );
		Rendered_Posts_Registry::register( -5 );
		$this->assertSame( array(), Rendered_Posts_Registry::get_ids() );
	}
}
