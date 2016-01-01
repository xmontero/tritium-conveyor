<?php

namespace AppBundle\Model;

/**
 * Chromosome is an array of 19 integers containing the numbers 1 to 19 in any order. The Phenotype shall map this chromosome to the hexagon of the problem.
 */
class Chromosome
{
	function __construct( $positions )
	{
		$this->assertInputIsArrayOf19Ints( $positions );
		$this->assertInputContainsNumbersFrom1To19( $positions );
	}

	private function assertInputIsArrayOf19Ints( $positions )
	{
		if( ! is_array ( $positions ) )
		{
			throw new \InvalidArgumentException( 'Constructor of Chromosome should be an array (of 19 elements, all being integers).' );
		}

		if( count( $positions ) != 19 )
		{
			throw new \InvalidArgumentException( 'Constructor of Chromosome should be an array of 19 elements (all being integers).' );
		}

		foreach( $positions as $allele )
		{
			if( ! is_int( $allele ) )
			{
				throw new \InvalidArgumentException( 'Constructor of Chromosome should be an array of 19 elements, all being integers.' );
			}
		}
	}

	private function assertInputContainsNumbersFrom1To19( $positions )
	{
		$clonedPositions = $this->cloneArray( $positions );
		sort( $clonedPositions );

		for( $i = 1; $i <= 19; $i++ )
		{
			if( $clonedPositions[ $i - 1 ] != $i )
			{
				throw new \DomainException( 'The constructor parameter of the Chromosome should contain the numbers 1 to 19.' );
			}
		}
	}

	private function cloneArray( $source )
	{
		$result = array();

		for( $i = 0; $i < 19; $i++ )
		{
			$result[ $i ] = $source[ $i ];
		}

		return $result;
	}
}
