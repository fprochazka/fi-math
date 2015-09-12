<?php

namespace FiMath;

use FiMath\Elementary\Type\Addition;
use FiMath\Elementary\Type\Decimal;
use FiMath\Elementary\Type\Division;
use FiMath\Elementary\Type\Fraction;
use FiMath\Elementary\Type\Multiplication;
use FiMath\Elementary\Type\Subtraction;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
abstract class ProblemVisitor
{

	public function visitDecimal(Decimal $decimal)
	{
	}



	public function visitFraction(Fraction $fraction)
	{
	}



	public function visitAddition(Addition $addition)
	{
	}



	public function visitSubtraction(Subtraction $subtraction)
	{
	}



	public function visitMultiplication(Multiplication $multiplication)
	{
	}



	public function visitDivision(Division $division)
	{
	}

}
