<?php

namespace FiMath\Elementary\Type;

use Brick\Math\BigNumber;
use FiMath\Element;
use FiMath\ProblemVisitor;



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



	public function accept(ProblemVisitor $visitor)
	{
		$visitor->visitDecimal($this);
	}

}
