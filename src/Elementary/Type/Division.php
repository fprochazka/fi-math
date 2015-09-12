<?php

namespace FiMath\Elementary\Type;

use FiMath\Elementary\Behaviour\BinaryOperation;
use FiMath\ElementContainer;
use FiMath\ProblemTreeVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Division implements ElementContainer
{

	use BinaryOperation;



	public function accept(ProblemTreeVisitor $visitor)
	{
		$visitor->visitDivision($this);
	}

}
