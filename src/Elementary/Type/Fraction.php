<?php

namespace FiMath\Elementary\Type;

use Brick\Math\BigRational;
use FiMath\Node;
use FiMath\Elementary\Numbers\RealNumber;
use FiMath\NotSupportedException;
use FiMath\ProblemVisitor;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Fraction implements Node, RealNumber
{

	/**
	 * @var string
	 */
	private $numerator;

	/**
	 * @var string
	 */
	private $denominator;



	public function __construct($numerator, $denominator)
	{
		$this->numerator = $numerator;
		$this->denominator = $denominator;
	}



	/**
	 * @return string
	 */
	public function getDenominator()
	{
		return $this->denominator;
	}



	/**
	 * @return string
	 */
	public function getNumerator()
	{
		return $this->numerator;
	}



	public function toNumber()
	{
		return BigRational::nd($this->getNumerator(), $this->getDenominator());
	}



	public function accept(ProblemVisitor $visitor)
	{
		$visitor->visitFraction($this);
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
