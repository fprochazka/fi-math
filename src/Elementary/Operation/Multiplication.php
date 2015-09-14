<?php

namespace FiMath\Elementary\Operation;

use FiMath\Elementary\Numbers\RealNumber;
use FiMath\Elementary\Type;
use FiMath\Engine\CollectionResult;
use FiMath\Engine\Node;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Multiplication extends BaseRealNumber
{

	/**
	 * @param Type\Multiplication $multiplication
	 * @param CollectionResult $tree
	 * @return Node
	 */
	protected function calculateReplacement(Node $multiplication, CollectionResult $tree)
	{
		return new Type\Decimal($this->evaluate($multiplication->getLeft(), $multiplication->getRight()));
	}



	protected function evaluate(RealNumber $left, RealNumber $right)
	{
		return (string) $left->toNumber()->multipliedBy($right->toNumber());
	}



	protected function getCandidateType()
	{
		return Type\Multiplication::class;
	}

}
