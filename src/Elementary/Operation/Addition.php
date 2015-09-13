<?php

namespace FiMath\Elementary\Operation;

use FiMath\Node;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\Elementary\Type;
use FiMath\InvalidArgumentException;
use FiMath\Operation;
use FiMath\ProblemTree\CollectionResult;
use FiMath\ProblemTree\NodeReplacer;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Addition implements Operation
{

	public function findCandidates(CollectionResult $tree)
	{
		foreach (array_reverse($tree->getByType(Type\Addition::class)) as $addition) {
			if (!$this->validateArguments($addition)) {
				continue;
			}

			yield $addition;
		}
	}



	public function apply(Node $element, CollectionResult $tree)
	{
		if (!$element instanceof Type\Addition) {
			throw InvalidArgumentException::unexpectedType($element, Type\Addition::class);
		}

		$replacement = new Type\Decimal($this->evaluate($element->getLeft(), $element->getRight()));

		return (new NodeReplacer())->replaceNode($element, $replacement, $tree);
	}



	private function evaluate(RealNumber $left, RealNumber $right)
	{
		return (string) $left->toNumber()->toBigDecimal()->plus($right->toNumber());
	}



	private function validateArguments(Type\Addition $addition)
	{
		return (bool) array_filter($addition->getChildNodes(), [$this, 'validateArgument']);
	}



	private function validateArgument(Node $arg)
	{
		return $arg instanceof RealNumber;
	}

}
