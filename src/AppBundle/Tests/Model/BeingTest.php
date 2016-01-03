<?php

namespace AppBundle\Tests\Model;

use AppBundle\Model\Chromosome;
use AppBundle\Model\Being;

class BeingTest extends \PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->chromosome = new Chromosome( array( 1, 19,  2, 18,  3, 17,  4, 16 , 5, 15,  6, 14,  7, 13,  8, 12,  9, 11, 10 ) );
		                                       /*  1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 */
		                                       /* a1, a2, a3, b1, b2, b3, b4, c1, c2, c3, c4, c5, d1, d2, d3, d4, e1, e2, e3 */
		//      1---19--2 
		//     / \     / \
		//    18  3   17  4
		//   /     \ /     \
		//  16--5---15--6---14
		//   \     / \     /
		//    7   13  8   12
		//     \ /     \ /
		//      9---11--10

		$this->sut = new Being( $this->chromosome );
	}

	public function testNew()
	{
		$this->assertInstanceOf( 'AppBundle\Model\Being', $this->sut );
	}

	public function testGetChromosome()
	{
		$chromosome2 = $this->sut->getChromosome();
		$this->assertSame( $this->chromosome, $chromosome2 );
	}

	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testNewFailsIfMissingParameter()
	{
		$sut = new Being();
	}

	public function testGetSum()
	{
		// c3 + d2 + e1 (positions)
		// 15 + 13 + 9 (values) = 37
		$this->assertEquals( 37, $this->sut->getSum( 'd2' ) );
	}

	public function testGetPosition()
	{
		$this->assertEquals( 3, $this->sut->getPosition( 'b2' ) );
	}

	public function testSumAverage()
	{
		$expected =
		(
			( 1 + 19 + 2 ) +
			( 1 + 18 + 16 ) + ( 1 + 3 + 15 ) + ( 2 + 17 + 15 ) + ( 2 + 4 + 14 ) +
			( 16 + 5 + 15 ) + ( 15 + 6 + 14 ) +
			( 16 + 7 + 9 ) + ( 15 + 13 + 9 ) + ( 15 + 8 + 10 ) + ( 14 + 12 + 10 ) +
			( 9 + 11 + 10 )
		) / 12;
		$this->assertEquals( $expected, $this->sut->getSumAverage(), '', 0.000001 );
	}

	public function testErrorRms()
	{
		$terms = array();

		$terms[  1 ] = ( 1 + 19 + 2 );

		$terms[  2 ] = ( 1 + 18 + 16 );
		$terms[  3 ] = ( 1 + 3 + 15 );
		$terms[  4 ] = ( 2 + 17 + 15 );
		$terms[  5 ] = ( 2 + 4 + 14 );

		$terms[  6 ] = ( 16 + 5 + 15 );
		$terms[  7 ] = ( 15 + 6 + 14 );

		$terms[  8 ] = ( 16 + 7 + 9 );
		$terms[  9 ] = ( 15 + 13 + 9 );
		$terms[ 10 ] = ( 15 + 8 + 10 );
		$terms[ 11 ] = ( 14 + 12 + 10 );

		$terms[ 12 ] = ( 9 + 11 + 10 );

		$average =
		(
			$terms[ 1 ] +
			$terms[ 2 ] + $terms[ 3 ] + $terms[ 4 ] + $terms[ 5 ] +
			$terms[ 6 ] + $terms[ 7 ] +
			$terms[ 8 ] + $terms[ 9 ] + $terms[ 10 ] + $terms[ 11 ] +
			$terms[ 12 ]
		) / 12;

		$termRms = array();

		$accumulator = 0;
		for( $i = 1; $i <= 12; $i++ )
		{
			$termErrorSquare = pow( $terms[ $i ] - $average , 2 );
			$accumulator += $termErrorSquare;
		}

		$termErrorMeanSquare = $accumulator / 12;
		$termErrorRootMeanSquare = sqrt( $termErrorMeanSquare );

		$this->assertEquals( $termErrorRootMeanSquare, $this->sut->getErrorRms(), '', 0.000001 );
	}
}
