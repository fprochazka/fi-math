<?php

namespace FiMath\Elementary\Type;

use Brick\Math\BigNumber;
use FiMath\Node;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\NotSupportedException;
use FiMath\ProblemVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Decimal implements Node, RealNumber
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



	public function toNumber()
	{
		return BigNumber::of($this->getValue());
	}



	public function accept(ProblemVisitor $visitor)
	{
		$visitor->visitDecimal($this);
	}



	public function getChildNodes()
	{
		return [];
	}



	public function copyWithReplaced(Node $original, Node $replacement)
	{
		throw new NotSupportedException;
	}

}
