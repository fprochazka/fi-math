<?php

namespace FiMath\Elementary\Operation;

use FiMath\Elementary\Numbers\RealNumber;
use FiMath\Elementary\Type;
use FiMath\Engine\BaseOperation;
use FiMath\Engine\CollectionResult;
use FiMath\Engine\Node;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
abstract class BaseRealNumber extends BaseOperation
{

	public function findCandidates(CollectionResult $tree)
	{
		foreach (array_reverse($tree->getByType($this->getCandidateType())) as $addition) {
			if (!$this->validateArguments($addition)) {
				continue;
			}

			yield $addition;
		}
	}



	protected function validateArguments(Node $node)
	{
		return (bool) array_filter($node->getChildNodes(), [$this, 'validateArgument']);
	}



	protected function validateArgument(Node $arg)
	{
		return $arg instanceof RealNumber;
	}



	/**
	 * @return string
	 */
	abstract protected function getCandidateType();

}
