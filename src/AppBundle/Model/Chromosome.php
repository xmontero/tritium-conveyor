<?php

namespace AppBundle\Model;

class Chromosome
{
	function __construct( $positions )
	{
		if( ! is_array ( $positions ) )
		{
			throw new \InvalidArgumentException( "Constructor of Chromosome should be an array (of 19 elements, all being integers)." );
		}

		if( count( $positions ) != 19 )
		{
			throw new \InvalidArgumentException( "Constructor of Chromosome should be an array of 19 elements (all being integers)." );
		}

		foreach( $positions as $allele )
		{
			if( ! is_int( $allele ) )
			{
				throw new \InvalidArgumentException( "Constructor of Chromosome should be an array of 19 elements, all being integers." );
			}
		}
	}
}
