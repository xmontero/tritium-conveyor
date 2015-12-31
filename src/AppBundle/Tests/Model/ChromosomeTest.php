<?php

namespace AppBundle\Tests\Model;

use AppBundle\Model\Chromosome;

class ChromosomeTest extends \PHPUnit_Framework_TestCase
{
	public function testNew()
	{
		$sut = new Chromosome;
		$this->assertInstanceOf( 'AppBundle\Model\Chromosome', $sut );
	}
}
