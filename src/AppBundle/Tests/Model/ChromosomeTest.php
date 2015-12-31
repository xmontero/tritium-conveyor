<?php

namespace AppBundle\Tests\Model;

use AppBundle\Model\Chromosome;

class ChromosomeTest extends \PHPUnit_Framework_TestCase
{
	public function testNew()
	{
		$positions = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 19 );
		$sut = new Chromosome( $positions );
		$this->assertInstanceOf( 'AppBundle\Model\Chromosome', $sut );
	}

	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testNewFailsIfMissingParameter()
	{
		$sut = new Chromosome();
		$this->assertInstanceOf( 'AppBundle\Model\Chromosome', $sut );
	}
}
