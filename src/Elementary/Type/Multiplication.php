<?php

namespace FiMath\Elementary\Type;

use FiMath\Elementary\Behaviour\BinaryOperation;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\Engine\Node;
use FiMath\Engine\ProblemVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 * @method Node|RealNumber getLeft()
 * @method Node|RealNumber getRight()
 */
class Multiplication implements Node
{

	use BinaryOperation;



	public function accept(ProblemVisitor $visitor)
	{
		$visitor->visitMultiplication($this);
	}

}
