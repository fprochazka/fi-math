<?php

namespace FiMath\Elementary\Type;

use FiMath\Element;
use FiMath\Elementary\Behaviour\BinaryOperation;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\ElementContainer;
use FiMath\ProblemVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 *
 * @method Element|RealNumber getLeft()
 * @method Element|RealNumber getRight()
 */
class Subtraction implements ElementContainer
{

	use BinaryOperation;



	public function accept(ProblemVisitor $visitor)
	{
		$visitor->visitSubtraction($this);
	}

}
