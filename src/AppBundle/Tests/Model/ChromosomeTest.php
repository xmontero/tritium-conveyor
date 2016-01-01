<?php

namespace AppBundle\Tests\Model;

use AppBundle\Model\Chromosome;

class ChromosomeTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider newProvider
	 */
	public function testNew( $positions )
	{
		$sut = new Chromosome( $positions );
		$this->assertInstanceOf( 'AppBundle\Model\Chromosome', $sut );
	}

	public function newProvider()
	{
		return array
		(
			array( array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ) ),
			array( array( 1, 19, 2, 18, 3, 17, 4, 16, 5, 15, 6, 14, 7, 13, 8, 12, 9, 11, 10 ) ),
			array( array( 1, 19, 9, 18, 3, 13, 4, 16, 5, 6, 15, 14, 7, 17, 8, 12, 2, 11, 10 ) ),
			array( array( 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1 ) ),
		);
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
	 * @expectedException InvalidArgumentException
	 */
	public function testNewFailsIfParameterIsOfInvalidType( $positions )
	{
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

	/**
	 * @dataProvider newFailsIfParameterHasAnInvalidContentProvider
	 * @expectedException DomainException
	 */
	public function testNewFailsIfParameterHasAnInvalidContent( $positions )
	{
		$sut = new Chromosome( $positions );
	}

	public function newFailsIfParameterHasAnInvalidContentProvider()
	{
		return array
		(
			array( array( 1, 19, 2, 14 /*18*/, 3, 17, 4, 16, 5, 15, 6, 14, 7, 13, 8, 12, 9, 11, 10 ) ),	// Duplicated 14.
			array( array( 1, 19, 2, 20 /*18*/, 3, 17, 4, 16, 5, 15, 6, 14, 7, 13, 8, 12, 9, 11, 10 ) ),	// Number greater than 19.
			array( array( 1, 19, 2,  0 /*18*/, 3, 17, 4, 16, 5, 15, 6, 14, 7, 13, 8, 12, 9, 11, 10 ) ),	// Number smaller than 1.
		);
	}
}
