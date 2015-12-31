<?php

namespace AppBundle\Tests\Model;

use AppBundle\Model\Chromosome;

class ChromosomeTest extends \PHPUnit_Framework_TestCase
{
	public function testNew()
	{
		$positions = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 );
		$sut = new Chromosome( $positions );
		$this->assertInstanceOf( 'AppBundle\Model\Chromosome', $sut );
	}

	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testNewFailsIfMissingParameter()
	{
		$sut = new Chromosome();
	}

	/**
	 * @dataProvider newFailsIfParameterIsOfInvalidTypeProvider
	 */
	public function testNewFailsIfParameterIsOfInvalidType( $positions )
	{
		$this->setExpectedException( 'InvalidArgumentException' );
		$sut = new Chromosome( $positions );
	}

	public function newFailsIfParameterIsOfInvalidTypeProvider()
	{
		return array
		(
			array( 33 ),																			// Constructor parameter should be an array, not an integer.
			array( array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ) ),							// Constructor parameter should be an array, and have 19 elements.
			array( array( 1, 2, 3, 4, 5, 6, 7, 8, 9.0, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ) ),	// Constructor parameter should be an array, and have 19 elements, all integers.
		);
	}
}
