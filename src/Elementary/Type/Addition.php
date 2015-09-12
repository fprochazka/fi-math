<?php

namespace FiMath\Elementary\Type;

use FiMath\Element;
use FiMath\Elementary\Behaviour\BinaryOperation;
use FiMath\ElementContainer;
use FiMath\ProblemTreeVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Addition implements ElementContainer
{

	use BinaryOperation;



	public function accept(ProblemTreeVisitor $visitor)
	{
		$visitor->visitAddition($this);
	}

}
