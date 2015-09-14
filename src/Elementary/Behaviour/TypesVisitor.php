<?php

namespace FiMath\Elementary\Behaviour;

use FiMath\Elementary\Type;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
trait TypesVisitor
{

	public function visitDecimal(Type\Decimal $decimal)
	{
	}



	public function visitFraction(Type\Fraction $fraction)
	{
	}



	public function visitAddition(Type\Addition $addition)
	{
	}



	public function visitSubtraction(Type\Subtraction $subtraction)
	{
	}



	public function visitMultiplication(Type\Multiplication $multiplication)
	{
	}



	public function visitDivision(Type\Division $division)
	{
	}

}
