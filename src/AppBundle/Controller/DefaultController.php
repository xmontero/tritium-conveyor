<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction( Request $request )
	{
		// replace this example code with whatever you need
		$solution = array();

		$solution[ '11' ] = 1;
		$solution[ '12' ] = 2;
		$solution[ '13' ] = 3;

		$solution[ '21' ] = 4;
		$solution[ '22' ] = 5;
		$solution[ '23' ] = 6;
		$solution[ '24' ] = 7;

		$solution[ '31' ] = 8;
		$solution[ '32' ] = 9;
		$solution[ '33' ] = 10;
		$solution[ '34' ] = 11;
		$solution[ '35' ] = 12;

		$solution[ '41' ] = 13;
		$solution[ '42' ] = 14;
		$solution[ '43' ] = 15;
		$solution[ '44' ] = 16;

		$solution[ '51' ] = 17;
		$solution[ '52' ] = 18;
		$solution[ '53' ] = 19;

		$data = array( 'solution' => $solution );
		return $this->render( '@AppBundle/Resources/views/Default/index.html.twig', $data );
	}
}
