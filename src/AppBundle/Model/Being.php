<?php

namespace AppBundle\Model;

/**
 * Being is an object representing the intentions of solutions to the problem.
 * A Being "fits" if it is a solution and "does not fit" if it is not a solution.
 * Form of the Being is the following:
 *      a1--a2--a3
 *     / \     / \
 *    b1  b2  b3  b4
 *   /     \ /     \
 *  c1--c2--c3--c4--c5
 *   \     / \     /
 *    d1  d2  d3  d4
 *     \ /     \ /
 *      e1--e2--e3
 */
class Being
{
	private $sumTriads;
	private $chromosome;
	private $locations;

	function __construct( Chromosome $chromosome )
	{
		$this->initSumTriads();
		$this->chromosome = $chromosome;
		$this->grabPhenotype();
	}

	public function getChromosome()
	{
		return $this->chromosome;
	}

	private function initSumTriads()
	{
		$this->sumTriads = array();

		$this->sumTriads[ 'a2' ] = array( 'a1', 'a2', 'a3' );

		$this->sumTriads[ 'b1' ] = array( 'a1', 'b1', 'c1' );
		$this->sumTriads[ 'b2' ] = array( 'a1', 'b2', 'c3' );
		$this->sumTriads[ 'b3' ] = array( 'a3', 'b3', 'c3' );
		$this->sumTriads[ 'b4' ] = array( 'a3', 'b4', 'c5' );

		$this->sumTriads[ 'c2' ] = array( 'c1', 'c2', 'c3' );
		$this->sumTriads[ 'c4' ] = array( 'c3', 'c4', 'c5' );

		$this->sumTriads[ 'd1' ] = array( 'e1', 'd1', 'c1' );
		$this->sumTriads[ 'd2' ] = array( 'e1', 'd2', 'c3' );
		$this->sumTriads[ 'd3' ] = array( 'e3', 'd3', 'c3' );
		$this->sumTriads[ 'd4' ] = array( 'e3', 'd4', 'c5' );

		$this->sumTriads[ 'e2' ] = array( 'e1', 'e2', 'e3' );
	}

	private function grabPhenotype()
	{
		$this->locations = array();
		$phenotypeLocations = array( 'a1', 'a2', 'a3', 'b1', 'b2', 'b3', 'b4', 'c1', 'c2', 'c3', 'c4', 'c5', 'd1', 'd2', 'd3', 'd4', 'e1', 'e2', 'e3' );

		for( $i = 1; $i <= 19; $i++ )
		{
			$this->locations[ $phenotypeLocations[ $i - 1 ] ] = $this->chromosome->getPosition( $i );
		}
	}

	public function getPosition( $position )
	{
		return $this->locations[ $position ];
	}

	public function getSum( $position )
	{
		$sumTriads = $this->sumTriads[ $position ];
		$term1 = $this->locations[ $sumTriads[ 0 ] ];
		$term2 = $this->locations[ $sumTriads[ 1 ] ];
		$term3 = $this->locations[ $sumTriads[ 2 ] ];

		$result = $term1 + $term2 + $term3;
		return $result;
	}

	public function getSumAverage()
	{
		$accumulator = 0;
		foreach( $this->sumTriads as $key => $value )
		{
			$term = $this->getSum( $key );
			$accumulator += $term;
		}

		$result = $accumulator / count( $this->sumTriads );
		return $result;
	}

	public function getErrorRms()
	{
		$sumAverage = $this->getSumAverage();

		$accumulator = 0;
		foreach( $this->sumTriads as $key => $value )
		{
			$term = $this->getSum( $key );
			$error = $term - $sumAverage;
			$errorSquare = $error * $error;
			$accumulator += $errorSquare;
		}

		$errorMeanSquare = $accumulator / count( $this->sumTriads );
		$errorRootMeanSquare = sqrt( $errorMeanSquare );

		return $errorRootMeanSquare;
	}
}
