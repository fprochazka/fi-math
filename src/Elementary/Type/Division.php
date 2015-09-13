<?php

namespace FiMath\Elementary\Type;

use FiMath\Node;
use FiMath\Elementary\Behaviour\BinaryOperation;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\ProblemVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 * @method Node|RealNumber getLeft()
 * @method Node|RealNumber getRight()
 */
class Division implements Node
{

	use BinaryOperation;



	public function accept(ProblemVisitor $visitor)
	{
		$visitor->visitDivision($this);
	}

}
