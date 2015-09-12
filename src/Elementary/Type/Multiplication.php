<?php

namespace FiMath\Elementary\Type;

use FiMath\Elementary\Behaviour\BinaryOperation;
use FiMath\ElementContainer;
use FiMath\ProblemVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Multiplication implements ElementContainer
{

	use BinaryOperation;



	public function accept(ProblemVisitor $visitor)
	{
		$visitor->visitMultiplication($this);
	}

}
