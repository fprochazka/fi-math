<?php

namespace FiMath\Elementary\Operation;

use FiMath\Node;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\Elementary\Type;
use FiMath\ProblemTree\CollectionResult;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Subtraction extends BaseRealNumber
{

	/**
	 * @param Type\Subtraction $subtraction
	 * @param CollectionResult $tree
	 * @return Node
	 */
	protected function calculateReplacement(Node $subtraction, CollectionResult $tree)
	{
		return new Type\Decimal($this->evaluate($subtraction->getLeft(), $subtraction->getRight()));
	}



	protected function evaluate(RealNumber $left, RealNumber $right)
	{
		return (string) $left->toNumber()->minus($right->toNumber());
	}



	protected function getCandidateType()
	{
		return Type\Subtraction::class;
	}

}
