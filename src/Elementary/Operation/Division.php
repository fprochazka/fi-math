<?php

namespace FiMath\Elementary\Operation;

use FiMath\Node;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\Elementary\Type;
use FiMath\ProblemTree\CollectionResult;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Division extends BaseRealNumber
{

	const SCALE = 10;



	/**
	 * @param Type\Division $division
	 * @param CollectionResult $tree
	 * @return Node
	 */
	protected function calculateReplacement(Node $division, CollectionResult $tree)
	{
		return new Type\Decimal($this->evaluate($division->getLeft(), $division->getRight()));
	}



	protected function evaluate(RealNumber $left, RealNumber $right)
	{
		return rtrim((string) $left->toNumber()->toBigDecimal()->dividedBy($right->toNumber(), self::SCALE), '0');
	}



	protected function getCandidateType()
	{
		return Type\Division::class;
	}

}
