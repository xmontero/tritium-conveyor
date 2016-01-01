<?php

namespace AppBundle\Tests\Model;

use AppBundle\Model\Being;

class BeingTest extends \PHPUnit_Framework_TestCase
{
	public function testNew()
	{
		$sut = new Being();
		$this->assertInstanceOf( 'AppBundle\Model\Being', $sut );
	}
}
