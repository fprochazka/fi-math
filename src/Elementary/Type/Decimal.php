<?php

namespace FiMath\Elementary\Type;

use Brick\Math\BigNumber;
use FiMath\Element;
use FiMath\ProblemTreeVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Decimal implements Element
{

	/**
	 * @var string
	 */
	private $value;



	public function __construct($value)
	{
		$this->value = $value;
	}



	public function getValue()
	{
		return $this->value;
	}



	/**
	 * @return BigNumber
	 */
	public function toNumber()
	{
		return BigNumber::of($this->getValue());
	}



	public function accept(ProblemTreeVisitor $visitor)
	{
		$visitor->visitDecimal($this);
	}

}
