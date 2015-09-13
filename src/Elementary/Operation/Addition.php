<?php

namespace FiMath\Elementary\Operation;

use FiMath\Node;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\Elementary\Type;
use FiMath\ProblemTree\CollectionResult;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Addition extends BaseRealNumber
{

	/**
	 * @param Type\Addition $addition
	 * @param CollectionResult $tree
	 * @return Node
	 */
	protected function calculateReplacement(Node $addition, CollectionResult $tree)
	{
		return new Type\Decimal($this->evaluate($addition->getLeft(), $addition->getRight()));
	}



	protected function evaluate(RealNumber $left, RealNumber $right)
	{
		return (string) $left->toNumber()->plus($right->toNumber());
	}



	protected function getCandidateType()
	{
		return Type\Addition::class;
	}

}
